<?php

namespace App\Models\ORM;

use App\Models\ORM\User;
use App\Models\ORM\Ingreso;
use App\Models\ORM\Egreso;
use App\Models\AutentificadorJWT;
use App\Models\Encripta_password;

include_once __DIR__ . '../../modelORM/ingreso.php';
include_once __DIR__ . '../../modelORM/user.php';
include_once __DIR__ . '../../modelORM/egreso.php';

class listadoController
{

    public function TraerUno($request, $response, $args)
    {
        $token = $request->getAttribute('tokenEnviado');
        $data = AutentificadorJWT::ObtenerData($token);
        $email = $data->email;
        $egresos = Egreso::where("usuario","=",$email)->select("usuario","legajo","created_at")->get();
        if(count($egresos) != 0)
        {
            $newResponse = $response->withJson($egresos, 200);
        }
        else
        {
            $newResponse = $response->withJson("El usuario no tiene egresos", 200);
        }
        return $newResponse;
    }


    public function traerUltimosIngresos($request, $response, $args)
    {
        $token = $request->getAttribute('tokenEnviado');
        $data = AutentificadorJWT::ObtenerData($token);
        $rol = $data->rol;
        if($rol == "admin")
        {
            $usuarios = Ingreso::distinct()->get(["usuario"])->toArray();
            if($usuarios != null)
            {

                for($i=0;$i<count($usuarios);$i++)
                {
                    $ingresos = Ingreso::where("usuario","=", $usuarios[$i]["usuario"])
                    ->select("usuario","created_at")
                    ->orderBy("created_at","desc")
                    ->first()
                    ->toArray();
                    $ultimosIngresos[] = $ingresos;
                }
                $newResponse = $response->withJson($ultimosIngresos, 200);
            }
            else{
                $newResponse = $response->withJson("No hay ingresos", 200);
            }
        }
        else
        {
            $newResponse = $response->withJson("Esta accion solo la puede cumplir un Admin", 200);
        }
        return $newResponse;

    }
    
}
