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
        $groups = Group::where('state', 1)
            ->whereHas('items', function ($q) {
                $q->where('state', 1);
            })
            ->with(['items' => function($q) {
                $q->where('state', 1);
            }])
            ->get();

        // Збираємо всі items цих груп
        $items = $groups->flatMap->items;

        // return response()->json([
        //     'groups' => $groups,
        //     'items' => $items
        //    ]);

        return view('online.index', compact('groups', 'items'));
    }

    public function show () {
        $user = auth()->user(); 
        $groups = Group::whereHas('items')
        ->with('items')
        ->get();

        return response()->json([
            'groups' => $groups
        ]);
    }

    public function itemsByGroup($groupId, Request $request)
{
        $perPage = 10; // кількість елементів на сторінку
        $page = $request->get('page', 1);

        $group = \App\Models\Group::with(['items' => function ($q) use ($perPage, $page) {
            $q->where('state', 1)
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->with('tags');
        }])->findOrFail($groupId);

        $totalItems = $group->items()->where('state', 1)->count();
        $hasMore = $totalItems > $page * $perPage;

        return response()->json([
            'items' => $group->items,
            'has_more' => $hasMore,
        ]);
    }

}