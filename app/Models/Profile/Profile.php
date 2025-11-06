<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'group_user';
    protected $fillable = [
        'group_id',
        'role',
        'user_id'
    ];
}
