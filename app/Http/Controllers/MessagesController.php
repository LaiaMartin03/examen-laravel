<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class MessagesController extends Controller
{
    public function index()
    {
        $messages = Message::where('from', auth()->id())
            ->with('toUser')
            ->orderByDesc('data')
            ->get();

        return view('message.index', compact('messages'));
    }

    public function show(Message $message)
    {
        if (!$message->state) {
            $message->state = true;
            $message->save();
        }

        return view('message.show', compact('message'));
    }

    public function create()
    {
        $users = User::all();

        return view('message.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'to' => 'required',
            'caption' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $data['from'] = auth()->id();
        $data['state'] = false;
        $data['data'] = now();

        Message::create($data);

        return redirect()->route('dashboard')->with('success', 'Missatge enviat correctament.');
    }
}
