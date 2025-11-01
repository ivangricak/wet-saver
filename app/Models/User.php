<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'users';

    protected $fillable = [
        'nick',
        'login',
        'password',
    ];

    public function groups() {
        return $this->belongsToMany(Group::class, 'group_user');
    }

    public function defaultgroups() {
        return $this->hasMany(DefaultGroup::class);
    }

    public function follows() {
        return $this->belongsToMany(
            User::class,
            'follows',
            'followed_id',
            'follower_id'
        );
    }

    public function followings() {
        return $this->belongsToMany(
            User::class,
            'follow',
            'follower_id',
            'followed_id'
        );
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function username()
    {
        return 'login'; // замість email
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'login_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
