@extends('layouts.app')
@section('title', 'Crear Inscripció')

@section('content')
<div class="max-w-3xl mx-auto px-4 mt-20">
    <a href="{{ route('dashboard') }}" class="text-purple-500 hover:underline flex items-center mb-6 space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
        <span>Tornar</span>
    </a>
    <h1 class="text-3xl font-bold mb-6 text-purple-600">Inscriu-te</h1>

    <form method="POST" action="{{ route('inscripcions.store') }}" class="space-y-6" enctype="multipart/form-data">
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
            <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="mt-1 block w-full border rounded-lg p-2" required>
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 block w-full border rounded-lg p-2" required>
        </div>
        <div>
            <label for="dni" class="block text-sm font-medium text-gray-700">DNI</label>
            <input type="file" name="dni" id="dni" accept="image/*" class="mt-1 block w-full border rounded-lg p-2" required>
        </div>
        <div>
            <label for="esdeveniment_id" class="block text-sm font-medium text-gray-700">Esdeveniment:</label>
            <select name="esdeveniment_id" id="esdeveniment_id" class="mt-1 block w-full border rounded-lg p-2" required>
                @foreach($esdeveniments as $esdeveniment)
                    <option value="{{ $esdeveniment->id }}" {{ old('esdeveniment_id') == $esdeveniment->id ? 'selected' : '' }}>
                        {{ $esdeveniment->nom }} - {{ $esdeveniment->data }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600">Crear Inscripció</button>
        </div>
    </form>
</div>
@endsection