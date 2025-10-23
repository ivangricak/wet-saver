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
        // $groups = Group::whereHas('items')
        // ->with('items')
        // ->get();

        // return response()->json([
        //     'groups' => $groups
        // ]);

        $offset = request()->query('offset', 0);
        $limit = request()->query('limit', 10);

        $groups = Group::whereHas('items', function ($query){
                $query->where('state', 1);
            })
            ->with(['items' => function ($query) {
                $query->where('state', 1);
            }])
            ->with('items')
            ->skip($offset)
            ->take($limit)
            ->get();

        return response()->json([
            'groups' => $groups
        ]);
    }

    public function itemsByGroup($groupId, Request $request)
    {
        $perPage = 10;
        $page = (int) $request->get('page', 1);

        $group = \App\Models\Group::with(['items' => function ($q) use ($perPage, $page) {
            $q->where('state', 1)
            ->with('tags')
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->orderBy('id', 'desc'); // для стабільного порядку
        }])->findOrFail($groupId);

        $total = \App\Models\Item::where('group_id', $groupId)->where('state', 1)->count();

        $hasMore = $total > $page * $perPage;

        return response()->json([
            'items' => $group->items,
            'has_more' => $hasMore,
        ]);
    }


}