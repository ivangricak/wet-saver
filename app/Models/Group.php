<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'state'
    ];

    public function items() {
        return $this->hasMany(Item::class);
    }
    public function users() {
        return $this->belongsToMany(User::class, 'group_user');
    }
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
