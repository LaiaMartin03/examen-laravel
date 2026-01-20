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
    <header class="flex justify-end space-x-4">
        <!--<form class="mb-12 flex items-center space-x-2" method="GET" action="">
            @csrf
            <input type="text" placeholder="Buscar..." class="border rounded-lg p-2" name="buscar">
            <button class="bg-purple-500 text-white p-2 rounded-lg hover:bg-purple-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </button>
        </form>-->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-purple-200 text-white px-2 py-2 rounded-lg hover:bg-purple-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                </svg>
            </button>
        </form>
    </header>

    <h1 class="mb-12 text-5xl font-extrabold text-purple-600 text-center">Esdeveniments</h1>

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
