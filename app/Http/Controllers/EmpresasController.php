<?php

namespace App\Http\Controllers;

use App\Models\empresas;
use Illuminate\Support\Facades\DB;
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
        $empresas = DB::select("SELECT E.id, E.nombre, E.cuit, COUNT(DISTINCT P.idper) q_personas,  COUNT(DISTINCT ES.idsuc) q_sucesos, IFNULL(GROUP_CONCAT(distinct Z.x SEPARATOR ' '), '<span class=\"badge rounded-pill bg-secondary\">0<\/span>') x FROM empresas E
        LEFT JOIN (SELECT  idPer, idEmp FROM emppers INNER JOIN personas ON personas.id = emppers.idper 
        WHERE personas.activo = 1) P ON P.idemp = E.id
        LEFT JOIN empsucs ES ON ES.idemp = E.id
        LEFT JOIN (SELECT W.idEmp, CONCAT(W.estado, COUNT(W.estado), '<\/span>') x FROM
        (SELECT ES.idEmp, IF(Q.vence IS NULL OR Q.vence < CURDATE(), '<span class=\"badge rounded-pill bg-danger\">', 
        IF(DATEDIFF(Q.vence, CURDATE()) <= S.vigencia, '<span class=\"badge rounded-pill bg-warning\">', '<span class=\"badge rounded-pill bg-success\">'))  estado, Q.idsucapl 
        FROM empsucs ES INNER JOIN (SELECT id, vigencia FROM sucesos WHERE tipo > 0)  S ON S.id = ES.idSuc
        INNER JOIN emppers EP ON EP.idEmp = ES.idEmp
        INNER JOIN personas P ON P.id = EP.idPer
        LEFT JOIN (SELECT idsucapl, idper, idsuc, vence FROM sucapls 
        WHERE sucapls.idsucapl IN (SELECT MAX(idsucapl) idsucapl FROM sucapls WHERE idper IS NOT NULL GROUP BY idper, idsuc))
        Q ON Q.idper = P.id AND Q.idsuc = S.id WHERE P.activo = 1) W
        GROUP BY W.idEmp, W.estado ORDER BY W.estado) Z ON Z.idEmp = E.id
        GROUP BY E.id, E.nombre, E.cuit");
        //var_dump($empresas);
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
