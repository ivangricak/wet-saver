<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function main() {
        return view('welcome');
    }

    public function index() {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login.show');
        }

        // Всі групи користувача
        $groups = $user->groups ?? collect();

        // Збираємо всі items цих груп
        $items = $groups->flatMap(function($group) {
            return $group->items;
        });

        // Дефолтні групи користувача
        $defgroups = $user->defaultgroups ?? collect();

        return view('private.index', compact('groups', 'defgroups', 'items'));
    }

    public function blog() {
        return view('viewBlog');
    }

    public function about() {
        return view('about');
    }

    public function contact() {
        return view('contact');
    }
}
