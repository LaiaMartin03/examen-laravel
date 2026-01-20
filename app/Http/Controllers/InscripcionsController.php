<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcio;
use App\Models\Esdeveniment;
use App\Models\Fitxer;
use Illuminate\Support\Facades\DB;

class InscripcionsController extends Controller
{
    public function index()
    {
        // obtener todas las inscripciones junto a su evento y fitxer relacionado
        $inscripcions = Inscripcio::with(['esdeveniment', 'fitxer'])->get();

        return view('inscripcions.index', compact('inscripcions'));
    }

    public function create($id = null)
    {
        // pasar la lista de esdeveniments para el select
        $esdeveniments = Esdeveniment::all();

        return view('inscripcions.create', [
            'esdeveniments' => $esdeveniments,
            'esdeveniment_id' => $id,
        ]);
    }

    public function store(Request $request)
    {
        // validar datos de formulario (dni se recoge pero no está en la tabla inscripcions según migración)
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // aceptar fichero de imagen para el DNI (requerido en el formulario)
            'dni' => 'required|file|image|max:4096',
            'esdeveniment_id' => 'required|exists:esdeveniments,id',
        ]);

        // asegurar que exista al menos un fitxer para la relación (migración requiere id_fitxer no nulo)

        // usar transacción para que la creación del fitxer e inscripcio sea atómica
        DB::transaction(function () use ($request, $data) {
            $fitxerId = null;

            // si se ha subido un fichero, guardarlo en el disco 'public' y crear registro en fitxers
            if ($request->hasFile('dni')) {
                $file = $request->file('dni');
                $originalName = $file->getClientOriginalName();
                $path = $file->store('dnis', 'public');

                $fitxer = Fitxer::create([
                    'nom' => $originalName,
                    'path' => $path,
                ]);

                $fitxerId = $fitxer->id;
            }

            // si no se sube fichero, asegurar que exista al menos un fitxer por defecto (migración hace la FK no nula)
            if (! $fitxerId) {
                $existing = DB::table('fitxers')->first();
                if ($existing) {
                    $fitxerId = $existing->id;
                } else {
                    $fitxerId = DB::table('fitxers')->insertGetId([
                        'nom' => 'default',
                        'path' => '',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // crear la inscripció
            Inscripcio::create([
                'nom' => $data['nom'],
                'email' => $data['email'],
                'id_esdeveniment' => $data['esdeveniment_id'],
                'id_fitxer' => $fitxerId,
            ]);
        });

        return redirect()->route('dashboard')->with('success', 'Inscripció creada correctament.');
    }
}
