<?php
use App\Models\User;
use App\Models\Group;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiLoginController;

Route::post('/login', [ApiLoginController::class, 'login']);
//LOGOUT

Route::post('/logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'message' => 'Logged out'
    ]);
})->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->get('/users/nicks', function () {
    return User::pluck('nick');
});

Route::middleware('auth:sanctum')->get('user/groups', function () {

    $user = auth()->user();

    $groups = $user->groups ?? collect();

    $items = $groups->flatMap(function ($group) {
        return $group->items;
    });

    $defgroups = $user->defaultgroups ?? collect();

    $defItems = $defgroups->flatMap(function ($defgroup) {
        return $defgroup->items;
    });

    return response()->json([
        'groups' => $groups,
        'items' => $items,
        'default_groups' => $defgroups,
        'default_items' => $defItems
    ]);
});

Route::middleware('auth:sanctum')->get('online/group', function () {
    $user = auth()->user(); 

    $offset = request()->query('offset', 0);
    $limit = request()->query('limit', 10);

    $groups = Group::where('state', 1)
        ->whereHas('items', function ($query) {
            $query->where('state', 1);
        })
        ->with(['items' => function ($query) {
            $query->where('state', 1);
        }, 'users' => function ($q) {
            $q->select('users.id', 'nick', 'login')
            ->withPivot('role');
        }
    ])
    ->skip($offset)
    ->take($limit)
    ->get();

    return response()->json([
        'groups' => $groups,
        'me' => $user
    ]);
});

Route::middleware('authLsanctum'->get('create/item', function (Request $request) {
    $data = $request->validated();

    $data['state'] = $data['state'] ?? 1;

    if(!empty($data['group_id'])) {
        $userRole = auth()->user()
        ->groups()
        ->where('group_id', $data['group_id'])
        ->value('role');
    if(!in_array($userRole, [0, 2])) {
        abort(403, 'Ви не маєте прав для створення елементу у цій групі.');
    }
    
        $data['default_group_id'] = null;
    } elseif(!empty($data['default_group_id'])) {
        $data['group_id'] = null;
    }

    $item = Item::create($data);

    if (!empty($data['tags'])) {
        $item->tags()->attach($data['tags']); // sync замінює існуючі, attach додає
    }
    $item->load('tags');
    // $item->with('items.tags')->findOrFail($id);
    // Перевіряємо, чи запит був AJAX / fetch

    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'item' => $item
        ]);
    }
}));