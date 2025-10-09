<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];
    
    public function group() {
        return $this->hasMany(Group::class); 
    }

    public function index()
    {
        $categories = Category::select('id','name')->get(); // або ->all()
        return view('private.index', compact('categories'));
        // або: return view('your.view.name')->with('categories', $categories);
    }
}
