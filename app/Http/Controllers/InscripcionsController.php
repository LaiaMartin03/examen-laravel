<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcio;
use App\Models\Esdeveniment;
use App\Models\Fitxer;
use Illuminate\Support\Facades\DB;

class InscripcionsController extends Controller
{
    public function index(Request $request)
    {
        $ordenarPor = $request->get('ordenarPor', '');
        $direccion = $request->get('direccion', 'asc');

        $esdevenimentNom = $request->get('esdeveniment_nom', '');
        $data = $request->get('data', ''); 

        $inscripcions = Inscripcio::with('esdeveniment', 'fitxer');

        if ($ordenarPor === 'esdeveniment') {
            $inscripcions = $inscripcions
                ->join('esdeveniments', 'inscripcions.id_esdeveniment', '=', 'esdeveniments.id')
                ->orderBy('esdeveniments.nom', $direccion)
                ->select('inscripcions.*');
        } elseif ($ordenarPor === 'nom') {
            $inscripcions = $inscripcions->orderBy('inscripcions.nom', $direccion);
        } elseif ($ordenarPor === 'created_at') {
            $inscripcions = $inscripcions->orderBy('inscripcions.created_at', $direccion);
        }

        $inscripcions = $inscripcions->get();

        return view('inscripcions.index', compact('inscripcions', 'ordenarPor', 'direccion'))
            ->with('esdeveniment_nom', $esdevenimentNom)
            ->with('data', $data);
    }

    public function create($id = null)
    {
        $esdeveniments = Esdeveniment::all();

        return view('inscripcions.create', [
            'esdeveniments' => $esdeveniments,
            'esdeveniment_id' => $id,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'dni' => 'required|file|image|max:4096',
            'esdeveniment_id' => 'required|exists:esdeveniments,id',
        ]);


        DB::transaction(function () use ($request, $data) {
            $fitxerId = null;

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
