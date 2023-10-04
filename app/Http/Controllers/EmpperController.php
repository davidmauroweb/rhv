<?php

namespace App\Http\Controllers;

use App\Models\{empper,empsuc,sucesos,sucapl,personas};
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EmpperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($ep)
    {
        $lista = DB::table('emppers')
        ->select('personas.nombre')
        ->join('personas','emppers.idPer','personas.id')
        ->where('emppers.idEmp','=',$ep)
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
        $n = new empper;
        $n->idEmp = $request->idEmp;
        $n->idPer = $request->idPer;
        $n->save();
        echo $request;
        return redirect()->route('personas.index')->with('mensajeOk','Vinculo Generado ');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $aplicados=DB::table('sucapls')
        ->select('sucesos.id','sucesos.nombresuc','sucapls.*',DB::raw("DATEDIFF(sucapls.vence,curdate())AS days"))
        ->join('sucesos','sucesos.id','=','sucapls.idSuc')
        ->where('sucapls.idPer','=',$request->idPer)
        ->orderBy('days')
        ->get();
        $apl = $aplicados->unique('sucapls.idSuc');
        $empsuc=DB::table('empsucs')
        ->select('sucesos.id','sucesos.nombresuc','empsucs.*')
        ->join('sucesos','sucesos.id','=','empsucs.idSuc')
        ->where('empsucs.idEmp','=',$request->idEmp)
        ->get();
        $per=DB::table('personas')
        ->where('id','=',$request->idPer)
        ->get();
        $emp=DB::table('empresas')
        ->where('id','=',$request->idEmp)
        ->get();
        return view ('empper',['apl'=>$apl, 'empsuc'=>$empsuc, 'per'=>$per, 'emp'=>$emp]);
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
    public function destroy(empper $empper)
    {
        //
    }
}
