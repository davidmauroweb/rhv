<?php

namespace App\Http\Controllers;

use App\Models\home;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = DB::select("SELECT CONCAT(W.type, ' - ', W.estado) label, COUNT(W.estado) q FROM (SELECT 'RRHH' type, E.nombre field1, S.nombresuc field2, P.nombre field3, 
        IF(Q.vence IS NULL OR Q.vence < CURDATE(), 'PENDIENTE', 
        IF(DATEDIFF(Q.vence, CURDATE()) <= S.vigencia, 'A VENCERSE', 'CORRECTO'))  estado FROM empresas E
        INNER JOIN empsucs ES ON ES.idEmp = E.id
        INNER JOIN (SELECT id, vigencia, nombresuc FROM sucesos WHERE tipo > 0)  S ON S.id = ES.idSuc
        INNER JOIN emppers EP ON EP.idEmp = E.id
        INNER JOIN personas P ON P.id = EP.idPer
        LEFT JOIN (SELECT idsucapl, idper, idsuc, vence FROM sucapls 
        WHERE sucapls.idsucapl IN (SELECT MAX(idsucapl) idsucapl FROM sucapls WHERE idper IS NOT NULL GROUP BY idper, idsuc))
        Q ON Q.idper = P.id AND Q.idsuc = S.id WHERE P.activo = 1
        UNION
        SELECT 'VEHICULO' type, CONCAT(V.marca, ' ',V.modelo) field1, S.nombresuc field2, V.tipo field3, IF(Q.vence IS NULL OR Q.vence < CURDATE(), 'PENDIENTE', 
        IF(DATEDIFF(Q.vence, CURDATE()) <= S.vigencia, 'A VENCERSE', 'CORRECTO'))  estado FROM vehiculos V
        INNER JOIN vehsucs VS ON VS.idVeh = V.id
        INNER JOIN (SELECT id, vigencia, nombresuc FROM sucesos WHERE tipo = 0)  S 
        ON S.id = VS.idSuc
        LEFT JOIN (SELECT idsucapl, idveh, idsuc, vence FROM sucapls 
        WHERE sucapls.idsucapl IN (SELECT MAX(idsucapl) idsucapl FROM sucapls 
        WHERE idveh IS NOT NULL GROUP BY idveh, idsuc))
        Q ON Q.idveh = V.id AND Q.idsuc = S.id) W
        GROUP BY label");
        return view ('home',['data'=>$data]);
    }
    
    public function show($dt)
    {
        try {
        $data = DB::select("SELECT Y.* FROM (SELECT E.nombre field1, S.nombresuc field2, P.nombre field3, 
        CONCAT('RRHH - ', IF(Q.vence IS NULL OR Q.vence < CURDATE(), 'PENDIENTE', 
        IF(DATEDIFF(Q.vence, CURDATE()) <= S.vigencia, 'A VENCERSE', 'CORRECTO')))  estado FROM empresas E
        INNER JOIN empsucs ES ON ES.idEmp = E.id
        INNER JOIN (SELECT id, vigencia, nombresuc FROM sucesos WHERE tipo > 0)  S ON S.id = ES.idSuc
        INNER JOIN emppers EP ON EP.idEmp = E.id
        INNER JOIN personas P ON P.id = EP.idPer
        LEFT JOIN (SELECT idsucapl, idper, idsuc, vence FROM sucapls 
        WHERE sucapls.idsucapl IN (SELECT MAX(idsucapl) idsucapl FROM sucapls WHERE idper IS NOT NULL GROUP BY idper, idsuc))
        Q ON Q.idper = P.id AND Q.idsuc = S.id WHERE P.activo = 1
        UNION
        SELECT CONCAT(V.marca, ' ',V.modelo) field1, S.nombresuc field2, V.tipo field3, CONCAT('VEHICULO - ', IF(Q.vence IS NULL OR Q.vence < CURDATE(), 'PENDIENTE', 
        IF(DATEDIFF(Q.vence, CURDATE()) <= S.vigencia, 'A VENCERSE', 'CORRECTO')))  estado FROM vehiculos V
        INNER JOIN vehsucs VS ON VS.idVeh = V.id
        INNER JOIN (SELECT id, vigencia, nombresuc FROM sucesos WHERE tipo = 0)  S 
        ON S.id = VS.idSuc
        LEFT JOIN (SELECT idsucapl, idveh, idsuc, vence FROM sucapls 
        WHERE sucapls.idsucapl IN (SELECT MAX(idsucapl) idsucapl FROM sucapls 
        WHERE idveh IS NOT NULL GROUP BY idveh, idsuc))
        Q ON Q.idveh = V.id AND Q.idsuc = S.id) Y WHERE Y.estado = ".$dt);
        }
        catch (\Exception $ex) {
            $data = ['field1' => '-','field2' => '-','field3' => '-'];
        }
        return response()->json($data);
    }
}
