<?php

namespace App\Http\Controllers\Online\item;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Item\StoreRequest;

class ItemOnlineController extends Controller
{
    public function itemsJson($id)
    {
        $group = groups()->with('items.tags')->findOrFail($id);

        return response()->json([
            'items' => $group->items
        ]);
    }
}
