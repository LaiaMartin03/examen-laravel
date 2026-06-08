@extends('layouts.app')
@section('title', 'Nou missatge')

@section('content')
<div class="max-w-3xl mx-auto px-4 mt-20">
    <a href="{{ route('dashboard') }}" class="text-purple-500 hover:underline flex items-center mb-6 space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
        <span>Tornar</span>
    </a>
    <h1 class="text-3xl font-bold mb-6 text-purple-600">{{ $message->caption }}</h1>
    
    <div>
        <div>
            <span>De:</span>
            <span>{{ $message->fromUser->name }}</span>
        </div>
        <div>
            <span>Para:</span>
            <span>{{ $message->toUser->name }}</span>
        </div>
        <div>
            <span>Data:</span>
            <span>{{ $message->data }}</span>
        </div>
        <div>
            <span>Missatge:</span>
            <span>{{ $message->message }}</span>
        </div>
    </div>
    
</div>
@endsection