<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;

class MainOnlineController extends Controller
{
    public function index() {

        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login.show');
        }

        // Всі групи користувача
        $groups = Group::where('state', 1)->whereHas('items')->get();

        // Збираємо всі items цих груп
        $items = $groups->flatMap(function($group) {
            return $group->items;
        });

        return view('online.index', compact('groups', 'items'));
    }
}
