<?php

namespace App\Http\Controllers\Group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DefGroup\UpdateRequest;

class DefaultGroupController extends Controller
{
     /**
     * Display a listing of the resource.
     */

    public function itemsJson($id)
    {
        $user = auth()->user();
        $defgroup = $user->defaultgroups()->with('items.tags')->findOrFail($id);

        return response()->json([
            'items' => $defgroup->items
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(DefaultGroup $defgroup)
    {
        $categories = Category::all();
        $users = Auth::user();
        return view('defgroup.edit', compact('defgroup', 'categories', 'users'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, DefaultGroup $defgroup)
    {
        $data = $request->validated();

        $defgroup->update($data);

        return redirect()->route('home.index');   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        
    }
}
