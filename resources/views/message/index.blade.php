@extends('layouts.app')

@section('title', 'Bandeja de salida')

@section('content')
<div class="max-w-6xl mx-auto px-4">
    @if(!empty($param))
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6" role="alert">
            <p class="font-bold">Parámetro recibido</p>
            <p>{{ $param }}</p>
        </div>
    @endif
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <header> 
        <div>
            <h1 class="mb-12 mt-12 text-5xl font-extrabold text-purple-600 text-center">Bon dia, {{ auth()->user()->name }}</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-purple-500 hover:text-white">Cerrar sesion</button>
            </form>
        </div>

        <a href="{{ route('messages.create') }}" class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600">Nou missatge</a>

        <div>
            <a href="{{ route('dashboard') }}" class="text-gray-500">Mensajes de entrada</a>
            <a href="{{ route('messages.index') }}" class="text-purple-500">Mensajes de salida</a>
        </div>
    </header>
        
    <table class="w-full border">
        <thead>
            <tr>
                <th>Data</th>
                <th>Per a</th>
                <th>Assumpte</th>
            </tr>
        </thead>
        <tbody>
            @if ($messages->isEmpty())
                <tr>
                    <td colspan="3">No tienes mensajes</td>
                </tr>
            @else
                @foreach($messages as $message)
                    <tr class="{{ !$message->state ? 'font-bold' : '' }}">
                        <td>
                            <a href="{{ route('messages.show', $message) }}">{{ $message->data->format('d/m/Y H:i') }}</a>
                        </td>
                        <td>
                            <a href="{{ route('messages.show', $message) }}">{{ $message->toUser->name }}</a>
                        </td>
                        <td>
                            <a href="{{ route('messages.show', $message) }}">{{ $message->caption }}</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection
