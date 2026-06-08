<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return view('auth.login');
        }

        $messages = Message::with('fromUser')
            ->where('to', Auth::id())
            ->orderByDesc('data')
            ->get();

        return view('dashboard', compact('messages'));
    }

}
