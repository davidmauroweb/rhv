<?php

namespace App\Http\Controllers;

use App\Models\{personas, empresas};
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PersonasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personas = personas::all()->where('activo', '=', 1)->sortBy('nombre');
        $empresas = empresas::all()->where('act', '=', 1)->sortBy('nombre');
        return view ('personas',['persona'=>$personas, 'empresas'=>$empresas]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $agrego = new personas();
        $agrego->nombre = $request->nombre;
        $agrego->dni = $request->dni;
        $agrego->sx = $request->sx;
        $agrego->ingreso = $request->ingreso;
        $agrego->activo = "1";
        $agrego->save();
        return redirect()->route('personas.index')->with('mensajeOk', 'Se cargó correctamente a '.$request->nombre);
    }

    /**
     * Display the specified resource.
     */
    public function show(personas $personas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(personas $personas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, personas $p)
    {
        $upd = personas::find($p->id);
        $upd->nombre = $request->nombre;
        $upd->dni = $request->dni;
        $upd->sx = $request->sx;
        $upd->ingreso = $request->ingreso;
        $upd->save();
        return redirect()->route('personas.index')->with('mensajeOk','Se actualizó correctamente a '.$request->nombre);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(personas $p)
    {
        $susp = personas::find($p->id);
        $susp->activo = 0;
        $susp->save();
        return redirect()->route('personas.index')->with('mensajeOk','Se suspendió correctamente a '.$p->nombre);
    }
}
