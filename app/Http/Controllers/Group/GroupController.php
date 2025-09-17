<?php

namespace App\Http\Controllers\Group;

use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => 'string|required',
            'category_id' => 'integer|required|exists:categories,id',
        ]);

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
    public function update(Request $request, Group $group)
    {
        $data = request()->validate([
            'name' => 'string|required',
            'category_id' => 'integer|required|exists:categories,id',
        ]);

        $group->update($data);

        return redirect()->route('home.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $group->users()->detach();
        $group->items()->delete();

        $group->delete();

        return redirect()->route('home.index');
    }
}
