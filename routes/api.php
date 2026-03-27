<?php
use App\Models\User;
use App\Models\Group;
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