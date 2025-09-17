<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'group_id',
        'default_group_id',
        'name',
        'description', 
        'link', 
        'state', 
    ];

    protected $attributes = [
        'state' => 1,
    ];

    public function group() {
        return $this->belongsTo(Group::class);
    }
    public function defaultGroup() {
        return $this->belongsTo(DefaultGroup::class);
    }
    public function tags() {
        return $this->belongsToMany(Tag::class, 'item_tag');
    }
}