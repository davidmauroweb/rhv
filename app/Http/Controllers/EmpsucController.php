<?php

namespace App\Http\Controllers;

use App\Models\{empsuc, empresas, sucesos};
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EmpsucController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index($es)
    
    {
        $lista = empsuc::select('empsucs.id','sucesos.nombresuc')->join('sucesos','sucesos.id','idSuc')->where('idEmp','=',$es)->get();
        $lsuc = sucesos::select('id','nombresuc')->where('tipo','>',0)->get();
        $emp = empresas::all()->where('id','=',$es);
        return view ('empsuc',['empsuc'=>$lista,'lsuc'=>$lsuc,'emp'=>$emp]);
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
        $chek = DB::table('empsucs')
        ->where('idEmp','=',$request->idEmp)
        ->where('idSuc','=',$request->idSuc)
        ->select(DB::raw('count(*) as q'))
        ->first();
        if ($chek->q == 0){
            $n = new empsuc;
            $n->idEmp = $request->idEmp;
            $n->idSuc = $request->idSuc;
            $n->save();
            return redirect()->route('empsuc.index',$request->idEmp)->with('mensajeOk','Vinculo Generado');
        }else{
            return redirect()->route('empsuc.index',$request->idEmp)->with('mensajeErr','Vinculo Exitente ');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(empsuc $empsuc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, empsuc $empsuc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(empsuc $es)
    {
        $del = empsuc::find($es->id);
        $del->delete();
        return redirect()->route('empsuc.index',$es->idEmp);
    }
}
