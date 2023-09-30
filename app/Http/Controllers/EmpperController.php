<?php

namespace App\Http\Controllers;

use App\Models\{empper,empsuc,sucesos,sucapl};
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EmpperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        return redirect()->route('personas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $apl=DB::table('empsucs')
        ->select('sucapls.idSuc','sucapls.vence','sucesos.id','sucesos.nombresuc','empsucs.*',DB::raw("DATEDIFF(sucapls.vence,curdate())AS days"))
        ->join('sucesos','sucesos.id','=','empsucs.idSuc')
        ->leftjoin('sucapls','sucapls.idSuc','=','empsucs.idSuc')
        ->where('empsucs.idEmp','=',$request->idEmp)
        ->where('sucapls.idPer','=',$request->idPer)
        ->orderBy('days')
        ->get();
        //$apl = $ls->unique('sucapls.idSuc');
        $per=DB::table('personas')
        ->where('id','=',$request->idPer)
        ->get();
        $emp=DB::table('empresas')
        ->where('id','=',$request->idEmp)
        ->get();
        return view ('empper',['apl'=>$apl, 'per'=>$per, 'emp'=>$emp]);
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
