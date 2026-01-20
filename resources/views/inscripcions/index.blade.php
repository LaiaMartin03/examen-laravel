@extends('layouts.app')

@section('title', 'Llistat')

@section('content')
<div class="max-w-6xl mx-auto px-4">
	@if(!empty($param))
		<div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6" role="alert">
			<p class="font-bold">Paràmetre rebut</p>
			<p>{{ $param }}</p>
		</div>
	@endif
	@if(session('success'))
		<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
			<p>{{ session('success') }}</p>
		</div>
	@endif
	<header>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-purple-200 text-white px-2 py-2 rounded-lg hover:bg-purple-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                </svg>
            </button>
        </form>
        
		<h1 class="mb-12 mt-20 text-5xl font-extrabold text-purple-600 text-center">Inscripcions</h1>
	</header>
        
	<table class="w-full border">
		<thead>
			<tr>
				<th>Nom</th>
				<th>Email</th>
				<th>
					<a href="{{ route('inscripcions.index', ['ordenarPor' => 'esdeveniment', 'direccion' => ($ordenarPor == 'esdeveniment' && $direccion == 'asc') ? 'desc' : 'asc']) }}" class="hover:text-purple-500">
						Nom Esdeveniment
					</a>
				</th>
				<th>DNI</th>
				<th>
					<a href="{{ route('inscripcions.index', ['ordenarPor' => 'created_at', 'direccion' => ($ordenarPor == 'created_at' && $direccion == 'asc') ? 'desc' : 'asc']) }}" class="hover:text-purple-500">
						Data de creació
					</a>
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach($inscripcions as $inscripcio)
				<tr>
					<td>{{ $inscripcio->nom }}</td>
					<td>{{ $inscripcio->email }}</td>
					<td>{{ optional($inscripcio->esdeveniment)->nom ?? '—' }}</td>
					<td>
						<a class="hover:text-purple-500" href="{{ asset('storage/' . $inscripcio->fitxer->path) }}" download="{{ $inscripcio->fitxer->nom ?? 'Fitxer' }}">{{ $inscripcio->fitxer->nom ?? 'Fitxer' }}</a>
					</td>
					<td>{{ $inscripcio->created_at->format('d/m/Y') }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection
