<?php

namespace App\Http\Controllers;

use App\Models\{vehsuc, sucesos, vehiculos, sucapl};
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VehsucController extends Controller
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
        if($request->idSuc != "*")
        {
            $chek = DB::table('vehsucs')
            ->where('idVeh','=',$request->idVeh)
            ->where('idSuc','=',$request->idSuc)
            ->select(DB::raw('count(*) as q'))
            ->first();
            if ($chek->q == 0){
                $n = new vehsuc;
                $n->idVeh = $request->idVeh;
                $n->idSuc = $request->idSuc;
                $n->save();
                return redirect()->route('vehsuc.show', $request->idVeh)->with('mensajeOk','Vinculo Generado');;
            }else{
                return redirect()->route('vehsuc.show', $request->idVeh)->with('mensajeErr','Vinculo Exitente ');
            }
        }
        else
        {
            return redirect()->route('vehsuc.show', $request->idVeh);
   
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($v)
    {
        $ls = DB::table('vehsucs')
        ->where('idVeh','=', $v)
        ->join('sucesos','sucesos.id','=','idSuc')
        ->get();
        $ve = DB::table('vehiculos')
        ->where('id','=', $v)
        ->get();
        $suc = sucesos::all()->where('tipo','=',0)->sortBy('nombresuc');
        return view('vehsuc',['ls'=>$ls,'ve'=>$ve, 'suc'=>$suc]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(vehsuc $vehsuc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, vehsuc $vehsuc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(vehsuc $vs)
    {
        $del = vehsuc::find($vs->idvehsuc);
        $del->delete();
        return redirect()->route('vehsuc.show',$vs->idVeh);
    }
}
