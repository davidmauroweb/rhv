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
        $personas = DB::select("SELECT P.id, P.nombre, P.dni, P.sx, P.ingreso, P.activo, IFNULL(GROUP_CONCAT(DISTINCT E.nombre), 'SIN ASIGNAR') empresas , SUM(IF(Q.vence IS NULL OR CURDATE() > Q.vence, 0, 1)) f, COUNT(S.id) r FROM personas P
        LEFT JOIN emppers EP ON EP.idper = P.id
        LEFT JOIN empresas E ON E.id = EP.idemp
        LEFT JOIN empsucs ES ON ES.idemp = E.id
        LEFT JOIN (SELECT id, vigencia, nombresuc FROM sucesos WHERE tipo > 0)  S ON S.id = ES.idSuc
        LEFT JOIN (SELECT idsucapl, idper, idsuc, vence FROM sucapls 
        WHERE sucapls.idsucapl IN (SELECT MAX(idsucapl) idsucapl FROM sucapls WHERE idper IS NOT NULL GROUP BY idper, idsuc))
        Q ON Q.idper = P.id AND Q.idsuc = S.id
        GROUP BY P.id, P.nombre, P.dni, P.sx, P.ingreso, P.activo");
        $empresas = empresas::all()->where('act', '=', 1)->sortBy('nombre');
        //var_dump($personas);
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
        $upd->activo = $request->activo;
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
