<?php

namespace App\Http\Controllers\Group;

use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Group\StoreRequest;
use App\Http\Requests\Group\UpdateRequest;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function itemsJson($id)
    {
        $user = auth()->user();
        $group = $user->groups()->with('items.tags')->findOrFail($id);

        return response()->json([
            'items' => $group->items
        ]);
    }

    public function itemsOnlineJson($id)
    {
        $group = Group::with('items.tags')->findOrFail($id);

        return response()->json([
            'items' => $group->items
        ]);
    }

    public function index()
    {
        $user = auth()->user();
        $groups = $user->groups->map(function ($group) {
            $role = $group->pivot->role;
            $owner_id = $group->pivot->user_id;

            if($role == 1) {
                $ownerPivot = $group->users()
                                ->where(function ($q) {
                                    $q->where('group_user.role', 0)
                                    ->orWhereNull('group_user.role'); //only for test in the future delete it, only 0 must be
                                })
                                ->first();
                if($ownerPivot) {
                    $owner_id = $ownerPivot->id;
                }
            }

            return [
                'id' => $group->id,
                'name' => $group->name,
                'role' => $group->pivot->role,
                'owner' => $owner_id
            ];
        });

        return response()->json([
            'groups' => $groups
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $users = Auth::user();
        return view('group.create', compact('categories', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $group = Group::create($data);
        
        $user = auth()->user();

        $group->users()->attach($user->id, ['role' => 0]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'group' => $group
            ]);
        }

        return redirect()->route('home.index');
    }


    public function copyGroup($group_id) {
        $newUser = auth()->user();

        $original = Group::with('items')->FindOrFail($group_id);

        $newGroup = Group::create([
            'name' => $original->name,
            'category_id' => $original->category_id,
            'state' => 0
        ]);

        $newGroup->users()->attach($newUser->id, [
            'role' => 0 // owner
        ]);

        foreach($original->items as $item) {
            $newGroup->items()->create([
                'name' => $item->name,
                'description' => $item->description,
                'link' => $item->link,
                'state' => $item->state
            ]);
        }

        $newGroup->load('items');

        return response()->json($newGroup);
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        $categories = Category::all();
        $users = Auth::user();
        return view('group.edit', compact('group', 'categories', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Group $group)
    {
        $userRole = $group->users()
        ->where('user_id', auth()->id())
        ->value('role');

        // перевіряємо, чи має роль 0 або 2
        if (!in_array($userRole, [0, 2])) {
            abort(403, 'Ви не маєте прав для редагування цієї групи.');
        }

        $data = $request->validated();

        $group->update($data);

        return response()->json([
            'success' => true,
            'group' => $group
        ]);

        // return redirect()->route('home.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $userRole = $group->users()
        ->where('user_id', auth()->id())
        ->value('role', 0);

        if($userRole !== 0){
            abort(403, 'Ви не належите до цієї групи.');
        }

        $group->users()->detach();
        $group->items()->delete();
        $group->delete();

        try {
            return response()->json([
                'success' => true,
                'group_id' => $group->id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
        // return redirect()->route('home.index')->with('status', 'Групу успішно видалено.');
    }
}
