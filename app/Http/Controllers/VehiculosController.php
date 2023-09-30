<?php

namespace App\Http\Controllers;

use App\Models\{vehiculos,sucesos};
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VehiculosController extends Controller
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
        $v = DB::select("SELECT V.id, V.patente, V.marca, V.modelo, V.tipo, V.created_at registrado,
            SUM(IF(Q.vence IS NULL OR CURDATE() > Q.vence, 0, 1)) fro, COUNT(S.id) frq FROM vehiculos V
            LEFT JOIN vehsucs VS ON VS.idVeh = V.id
            LEFT JOIN (SELECT id, vigencia, nombresuc FROM sucesos WHERE tipo = 0)  S ON S.id = VS.idSuc
            LEFT JOIN (SELECT idsucapl, idveh, idsuc, vence FROM sucapls 
            WHERE sucapls.idsucapl IN (SELECT MAX(idsucapl) idsucapl FROM sucapls WHERE idveh IS NOT NULL GROUP BY idveh, idsuc))
            Q ON Q.idveh = V.id AND Q.idsuc = S.id
            GROUP BY V.id, V.patente, V.marca, V.modelo, V.tipo, registrado");
        $sucesos = sucesos::all()->where('tipo','=',0);
        return view ('vehiculos',['vehiculo' => $v, 'suc' => $sucesos]);

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
        $agrego = new vehiculos();
        $agrego->patente = strtoupper($request->patente);
        $agrego->marca = $request->marca;
        $agrego->modelo = $request->modelo;
        $agrego->tipo = $request->tipo;
        $agrego->save();
        return redirect()->route('vehiculos.index')->with('mensajeOk','Vehículo Agregado');
    }

    /**
     * Display the specified resource.
     */
    public function show(vehiculos $vehiculos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(vehiculos $vehiculos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, vehiculos $v)
    {
        $upd = vehiculos::find($v->id);
        $upd->patente = $request->patente;
        $upd->marca = $request->marca;
        $upd->modelo = $request->modelo;
        $upd->tipo = $request->tipo;
        $upd->save();
        return redirect()->route('vehiculos.index')->with('mensajeOk','Vehículo Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(vehiculos $v)
    {
        $del = vehiculos::find($v->id);
        $del->delete();
        return redirect()->route('vehiculos.index')->with('mensajeOk','Vehículo Dado de Baja');
    }
}
