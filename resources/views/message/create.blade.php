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
    <h1 class="text-3xl font-bold mb-6 text-purple-600">Envia un nou missatge</h1>

    <form method="POST" action="{{ route('messages.store') }}" class="space-y-6">
        @csrf
        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <label for="to" class="block text-sm font-medium text-gray-700">Destinatari:</label>

            <select name="to" id="to" class="mt-1 block w-full border rounded-lg p-2">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" @selected(old('to') == $user->id)>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="caption" class="block text-sm font-medium text-gray-700">Assumpte:</label>
            <input type="text" name="caption" id="caption" class="mt-1 block w-full border rounded-lg p-2" required value="{{ old('caption') }}">
        </div>
        <div>
            <label for="message" class="block text-sm font-medium text-gray-700">Cos del missatge:</label>
            <textarea name="message" id="message" rows="4" class="mt-1 block w-full border rounded-lg p-2" required>{{ old('message') }}</textarea>
        </div>
        <div>
            <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600">Enviar</button>
            <a href="{{ route('dashboard') }}" class="hover:text-purple-500">Cancelar</a>
        </div>
    </form>
</div>
@endsection