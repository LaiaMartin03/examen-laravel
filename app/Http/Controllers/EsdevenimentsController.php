<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Esdeveniment;

class EsdevenimentsController extends Controller
{
    public function index()
    {
        // Obtener todos los esdeveniments
        $esdeveniments = Esdeveniment::all();

        // Pasarlos a la vista
        return view('dashboard', compact('esdeveniments'));
    }

    public function create()
    {
        return view('esdeveniments.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'required|string',
            'data' => 'required|date',
        ]);

        Esdeveniment::create($data);

        return redirect()->route('dashboard')->with('success', 'Esdeveniment creat correctament.');
    }
}
