<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainOnlineController extends Controller
{
    public function index() {

        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login.show');
        }
        return view('online.index');
    }
}
