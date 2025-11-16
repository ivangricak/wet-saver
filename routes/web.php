<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Group\GroupController;
use App\Http\Controllers\Group\DefaultGroupController;
use App\Http\Controllers\Online\MainOnlineController;
use App\Http\Controllers\Item\ItemController;
use App\Http\Controllers\Profile\FollowController;

Route::get('/', [MainController::class, 'main'])->name('home.welcome');

//REGISTER/LOGIN/LOGOUT
Route::get('/register', [RegisterController::class, 'create'])->name('user.create');
Route::post('/register', [RegisterController::class, 'store'])->name('user.store');

//LOGIN
Route::get('/login', [LoginController::class, 'show'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('user.login');

//LOGOUT
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');


//GROUP MOVING

Route::post('/groups/{id}/copy', [GroupController::class, 'copyGroup']);

//SHOW GROUPS
Route::get('/groups', [GroupController::class, 'index'])->name('groups.view.show');
//CREATING
Route::get('/group/create', [GroupController::class, 'create'])->name('group.view.create');
Route::post('/group/create', [GroupController::class, 'store'])->name('groups.create');
//EDITING
Route::get('/groups/{group}/edit', [GroupController::class, 'edit'])->name('group.view.edit');
Route::put('/groups/{group}', [GroupController::class, 'update'])->name('groups.update');
//DELETE
Route::delete('/groups/{group}', [GroupController::class, 'destroy'])->name('groups.destroy');





//DEFAULT GROUP MOVING
//EDITING

//!!!!! поки що цього не має но всеодно там має бути defgroup а не group
// Route::get('/defgroups/{defgroup}/edit', [GroupController::class, 'edit'])->name('defgroup.view.edit'); 
// Route::put('/defgroup/{defgroup}', [GroupController::class, 'update'])->name('defgroups.update');

Route::get('/defgroups/{id}/items', [DefaultGroupController::class, 'itemsJson'])->name('groups.items.json');


//CATEGORIES
//LOADING CATEGORIES
Route::get('/categories', function() {
    return response()->json(\App\Models\Category::all());
});


//ITEM MOVING
//CREATING
Route::get('/groups/{id}/items', [GroupController::class, 'itemsJson'])->name('groups.items.json');

Route::get('/item/create', [ItemController::class, 'create'])->name('item.view.create');
Route::post('/item/create', [ItemController::class, 'store'])->name('item.create');
Route::put('/items/{item}', [ItemController::class, 'update']);
Route::get('/items/{item}', [ItemController::class, 'showJson']);
//DELETE
Route::delete('/items/{item}', [ItemController::class, 'destroy']);

//PRIVATE
Route::get('/home', [MainController::class, 'index'])->name('home.index');
//PRIVATE->PROFILE
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::patch('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

//PUBLIC/ONLINE
Route::get('/online', [MainOnlineController::class, 'index'])->name('view.index');
Route::get('/online/groups', [MainOnlineController::class, 'show'])->name('view.show.groups');
Route::get('/online/group/{id}/items', [MainOnlineController::class, 'itemsByGroup']);

//PROFILE
Route::get('/online/profile/{user}', [ProfileController::class, 'show'])->name('view.online.profile');

//Follow Group/ADD GROUP
Route::post('/follow/group/add', [FollowController::class, 'add'])->middleware('auth');

// підписатися / відписатися (через контролер FollowController)
Route::post('/follow/{user}', [FollowController::class, 'store'])
    ->name('follow.store')->middleware('auth');

Route::delete('/follow/{user}', [FollowController::class, 'destroy'])
    ->name('follow.destroy')->middleware('auth');

// зробив вроді норм схему но чекни перевір, треба ще перевірити і подумати над схемою як воно буде робити бо зараз це те від чого буде залежити майбутнє проекту
// перевірити defaultGroups, groups, items
// є ідея зробити manyTomany для groups i items щоб можна було перекидуватись групами між користувачами в майбутніх версіях 