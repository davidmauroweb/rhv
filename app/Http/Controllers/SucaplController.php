<?php

namespace App\Http\Controllers;

use App\Models\{sucapl, personas, vehiculos, sucesos, vehsuc};
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SucaplController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($sa)
    {
        $ls = DB::table('sucapls')
            ->select('sucapls.*','sucesos.*','vehiculos.*',DB::raw("DATEDIFF(sucapls.vence,now())AS days"))
            ->join('sucesos','sucesos.id','=','idSuc')
            ->join('vehiculos','vehiculos.id','=','idVeh')
            ->where('idVeh','=',$sa)
            ->orderBy('days')
            ->get();
            $lista = $ls->unique('idSuc');
        $lsuc = DB::table('vehsucs')
        ->join('sucesos','sucesos.id','=','idSuc')
        ->where('idVeh','=',$sa)
        ->get();
        $ent = vehiculos::all()->where('id','=',$sa);
        return view ('sucapl',['sucapl'=>$lista,'lsuc'=>$lsuc,'ent'=>$ent]);
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
        $n = new sucapl;
        $n->idPer = $request->idPer;
        $n->idVeh = $request->idVeh;
        $n->idSuc = $request->idSuc;
        $n->fecha = $request->fecha;
        $n->vence = $request->vence;
        $n->save();
        if(!empty($request->idVeh)){
            $r = "sucapl.index";
            $d = $request->idVeh;
        }
        if(!empty($request->idPer)){
            $r = "sucapl.show";
            $d = $request->idPer;
        }
        return redirect()->route($r,$d);
    }

    /**
     * Display the specified resource.
     */
    public function show($sa)
    {
        $ls = DB::table('sucapls')
        ->select('sucapls.*','sucesos.*','personas.*',DB::raw("DATEDIFF(sucapls.vence,now())AS days"))
        ->join('sucesos','sucesos.id','=','idSuc')
        ->join('personas','personas.id','=','idPer')
        ->where('idPer','=',$sa)
        ->orderBy('days')
        ->get();
        $lista = $ls->unique('idSuc');
    $lsuc = sucesos::select('id','nombresuc')->where('tipo','>',0)->get();
    $ent = personas::all()->where('id','=',$sa);
    return view ('sucapl',['sucapl'=>$ls,'lsuc'=>$lsuc,'ent'=>$ent]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sucapl $sucapl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, sucapl $sucapl)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sucapl $sa)
    {
        $del = sucapl::find($sa->idsucapl);
        $del->delete();
        if(!empty($sa->idVeh)){
            $r = "sucapl.index";
            $d = $sa->idVeh;
        }
        if(!empty($sa->idPer)){
            $r = "sucapl.show";
            $d = $sa->idPer;
        }
        return redirect()->route($r,$d);
    }

}
