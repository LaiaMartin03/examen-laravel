@extends('layouts.app')

@section('title', 'Inicio')

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
        <a href="{{ route('login') }}" class="bg-purple-200 text-white px-3 py-2 rounded-lg hover:bg-purple-500 inline-block">
            Inscripcions
        </a>
        
        <h1 class="mb-12 mt-12 text-5xl font-extrabold text-purple-600 text-center">Esdeveniments</h1>
    </header>
        
    <table class="w-full border">
        <thead>
            <tr>
                <th>Nom de l'esdeveniment</th>
                <th>Descripció</th>
                <th>Data</th>
                <th>Inscriu-te</th>
            </tr>
        </thead>
        <tbody>
            @foreach($esdeveniments as $esdeveniment)
                <tr>
                    <td>{{ $esdeveniment->nom }}</td>
                    <td>{{ $esdeveniment->descripcio }}</td>
                    <td>{{ $esdeveniment->data }}</td>
                    <td>
                        <a href="{{ route('inscripcions.create', ['id' => $esdeveniment->id]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
