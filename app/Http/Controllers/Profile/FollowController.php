<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile\Profile;
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

    public function add()
    {
        $userId = auth()->id();

        $data = request()->validate([
            'group_id' => 'required|integer',
        ]);

        // ✅ 1. Перевіряємо, чи запис уже існує
        $exists = \DB::table('group_user')
            ->where('group_id', $data['group_id'])
            ->where('user_id', $userId)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Already followed'
            ], 409);
        }

        // ✅ 2. Якщо немає — створюємо новий
        \DB::table('group_user')->insert([
            'group_id' => $data['group_id'],
            'user_id'  => $userId,
            'role'     => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Group followed'
        ]);
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
