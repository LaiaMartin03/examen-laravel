@extends('layouts.app')

@section('title', 'Login')

@section('content')
<h1 class="text-2xl font-bold mb-4">Iniciar sesión</h1>

<form method="POST" action="{{ route('login') }}" class="bg-white p-6 rounded shadow-md">
    @csrf
    <div class="mb-4">
        <label class="block mb-1">Email:</label>
        <input type="email" name="email" class="border rounded p-2 w-full" required>
    </div>
    <div class="mb-4">
        <label class="block mb-1">Contraseña:</label>
        <input type="password" name="password" class="border rounded p-2 w-full" required>
    </div>
    <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600">Entrar</button>
    <a href="{{ route('dashboard') }}" class="text-purple-500 hover:underline">Tornar a esdeveniments</a>
</form>
@endsection
