<?php

namespace App\Http\Controllers;

use App\Models\sucesos;
use Illuminate\Http\Request;

class SucesosController extends Controller
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
        $sucesos = sucesos::all()->sortBy('nombre');
        return view ('sucesos',['suceso'=>$sucesos]);
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
        $agrego = new sucesos();
        $agrego->nombresuc = $request->nombre;
        $agrego->desc = $request->desc;
        $agrego->vigencia = $request->vigencia;
        $agrego->tipo = $request->tipo;
        $agrego->save();
        return redirect()->route('sucesos.index')->with('mensajeOk', $request->nombre.' se generó correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(sucesos $sucesos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sucesos $sucesos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, sucesos $s)
    {
        $upd = sucesos::find($s->id);
        $upd->nombresuc = $request->nombre;
        $upd->desc = $request->desc;
        $upd->vigencia = $request->vigencia;
        $upd->tipo = $request->tipo;
        $upd->save();
        return redirect()->route('sucesos.index')->with('mensajeOk',$request->nombre.' se actualizó');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sucesos $sucesos)
    {
        //
    }
}
