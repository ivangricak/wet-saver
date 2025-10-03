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

    public function index()
    {
       //
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

        $group->users()->attach($user->id);

        return redirect()->route('home.index');
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
        $data = $request->validated();

        $group->update($data);

        return redirect()->route('home.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {

        if(! $group->users->contains(auth()->id())){
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
