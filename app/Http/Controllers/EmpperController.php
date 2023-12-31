<?php

namespace App\Http\Controllers;

use App\Models\{empper,empsuc,sucesos,sucapl,personas};
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EmpperController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index($ep)
    {
        /**$lista = DB::select('emppers')
        ->select('personas.nombre')
        ->join('personas','emppers.idPer','personas.id')
        ->where('emppers.idEmp','=',$ep)
        ->get();*/
        $lista = DB::select("SELECT S.nombresuc suceso, P.nombre persona, P.activo,
        IF(Q.vence IS NULL OR Q.vence < CURDATE(), '<div class=\"text-danger\"><i class=\"bi bi-shield-fill-x\"><\/i><\/div>', 
        IF(DATEDIFF(Q.vence, CURDATE()) <= S.vigencia, '<div class=\"text-warning\"><i class=\"bi bi-shield-fill-exclamation\"><\/i><\/div>', '<div class=\"text-success\"><i class=\"bi bi-shield-fill-check\"><\/i><\/div>')) estado FROM empresas E
        INNER JOIN empsucs ES ON ES.idEmp = E.id
        INNER JOIN (SELECT id, vigencia, nombresuc FROM sucesos WHERE tipo > 0)  S ON S.id = ES.idSuc
        INNER JOIN emppers EP ON EP.idEmp = E.id
        INNER JOIN personas P ON P.id = EP.idPer
        LEFT JOIN (SELECT idsucapl, idper, idsuc, vence FROM sucapls 
        WHERE sucapls.idsucapl IN (SELECT MAX(idsucapl) idsucapl FROM sucapls WHERE idper IS NOT NULL GROUP BY idper, idsuc))
        Q ON Q.idper = P.id AND Q.idsuc = S.id WHERE P.activo = 1 AND E.id = ".$ep);
        return response()->json($lista);
    }
    public function indexper($ep)
    {
        $lista = DB::table('emppers')
        ->select('emppers.id','personas.nombre')
        ->join('personas','emppers.idPer','personas.id')
        ->where('emppers.idEmp','=',$ep)
        ->where('personas.activo','=',1)
        ->get();
        return response()->json($lista);
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
        $chek = DB::table('emppers')
        ->where('idEmp','=',$request->idEmp)
        ->where('idPer','=',$request->idPer)
        ->select(DB::raw('count(*) as q'))
        ->first();
        /**echo $chek->q;*/
        if ($chek->q == 0){
            $n = new empper;
            $n->idEmp = $request->idEmp;
            $n->idPer = $request->idPer;
            $n->activo = 1;
            $n->save();
            return redirect()->route('personas.index')->with('mensajeOk','Vinculo Generado ');
        }else{
            return redirect()->route('personas.index')->with('mensajeErr','Vinculo Exitente ');
        }  
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $empsuc=DB::select("SELECT CONCAT('<div class=''alert alert-', IF(Q.vence IS NULL OR Q.vence < CURDATE(),'danger',
        IF(DATEDIFF(Q.vence, CURDATE()) < S.vigencia, 'warning', 'success')),''' role=''alert''><b>', S.nombresuc ,'</b>',
        IF(Q.vence IS NOT NULL, CONCAT(' ( Vencimiento : ', DATE_FORMAT(Q.vence, '%d/%m/%Y'), ')'), ''), '</div>') estado
        FROM empsucs ES 
        INNER JOIN sucesos S ON S.id = ES.idSuc
        LEFT JOIN (SELECT idSuc, vence FROM sucapls 
        WHERE idsucapl IN (SELECT MAX(idsucapl) FROM sucapls 
        WHERE (idPer IS NOT NULL AND idPer = $request->idPer) GROUP BY idSuc)) Q
        ON Q.idSuc = ES.idSuc
        WHERE idEmp = $request->idEmp
        ");
        $per=DB::table('personas')
        ->where('id','=',$request->idPer)
        ->get();
        $emp=DB::table('empresas')
        ->where('id','=',$request->idEmp)
        ->get();
        return view ('empper',['empsuc'=>$empsuc, 'per'=>$per, 'emp'=>$emp]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(empper $empper)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, empper $empper)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(empper $ep)
    {
        $del = empper::find($ep->id);
        $del->delete();
        return redirect()->route('empresas.index')->with('mensajeOk','Vínculo eliminado');
    }
}