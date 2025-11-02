<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function store(User $user)
    {
        $follower = auth()->user();

        if ($follower->id === $user->id) {
            return response()->json(['error' => 'Cannot follow yourself'], 400);
        }

        if ($follower->followings()->where('followed_id', $user->id)->exists()) {
            return response()->json(['error' => 'Already following'], 409);
        }

        $follower->followings()->attach($user->id);
        return response()->json(['status' => 'followed']);
    }

    public function destroy(User $user)
    {
        $follower = auth()->user();

        if ($follower->id === $user->id) {
            return response()->json(['error' => 'Cannot unfollow yourself'], 400);
        }

        $follower->followings()->detach($user->id);
        return response()->json(['status' => 'unfollowed']);
    }
}
