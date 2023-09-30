<?php

namespace App\Http\Controllers;

use App\Models\empresas;
use Illuminate\Http\Request;

class EmpresasController extends Controller
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
        $empresas = empresas::all()->where('act', '=', 1)->sortBy('nombre');
        return view ('empresas',['empresa'=>$empresas]);
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
        $agrego = new empresas();
        $agrego->nombre = $request->nombre;
        $agrego->cuit = $request->cuit;
        $agrego->act = "1";
        $agrego->save();
        return redirect()->route('empresas.index')->with('mensajeOk', 'Se cargó correctamente a '.$request->nombre);
    }

    /**
     * Display the specified resource.
     */
    public function show(empresas $empresas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(empresas $empresas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, empresas $e)
    {
        $upd = empresas::find($e->id);
        $upd->nombre = $request->nombre;
        $upd->cuit = $request->cuit;
        $upd->save();
        return redirect()->route('empresas.index')->with('mensajeOk','Se actualizó correctamente a '.$request->nombre);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(empresas $empresas)
    {
        //
    }
}
