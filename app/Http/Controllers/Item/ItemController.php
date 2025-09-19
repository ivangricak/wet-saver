<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
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
        // $categories = Category::all();
        $users = Auth::user();
        $groups = auth()->user()->groups()->with('items.tags')->get();
        $defgroups = auth()->user()->defaultGroups()->with('items.tags')->get();
        $tags = Tag::all();
        return view('item.index', compact('tags', 'users', 'groups', 'defgroups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'group_id' => 'nullable|integer|exists:groups,id|required_without:default_group_id',
            'default_group_id' => 'nullable|integer|exists:groups,id|required_without:group_id',

            'name' => 'string|required',
            'description' => 'string|required',
            'link' => 'string|required',
            'state' => 'integer|nullable',

            'tags' => 'array|nullable',          // масив id тегів
            'tags.*' => 'integer|exists:tags,id' // перевірка кожного id
        ]);

        $data['state'] = $data['state'] ?? 1;

        if(!empty($data['group_id'])) {
            $data['default_group_id'] = null;
        } elseif(!empty($data['default_group_id'])) {
            $data['group_id'] = null;
        }

        $item = Item::create($data);

        if (!empty($data['tags'])) {
            $item->tags()->attach($data['tags']); // sync замінює існуючі, attach додає
        }

        return redirect()->route('home.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
