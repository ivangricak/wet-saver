<?php
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiLoginController;

Route::post('/login', [ApiLoginController::class, 'login']);
//LOGOUT
Route::post('/logout', function () {
    $user = auth()->user();
    if($user) {
        $user()->tokens()->delete();
    }
    return response()->json(['mwssage' => 'Logged Out']);
});


Route::middleware('auth:sanctum')->get('/users/nicks', function () {
    return User::pluck('nick');
});

Route::middleware('auth:sanctum')->get('user/groups', function () {

    $user = auth()->user();

    $groups = $user->groups ?? collect();

    $items = $groups->flatMap(function ($group) {
        return $group->items;
    });

    $defgroups = $user->defaultgroups ?? collect();

    return response()->json([
        'groups' => $groups,
        'items' => $items,
        'default_groups' => $defgroups
    ]);
});