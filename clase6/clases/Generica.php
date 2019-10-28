
<?php

//    require_once './clases/upload.php';
//    require_once './clases/Usuario.php';
//    require_once './clases/Log.php';

class Generica {
    
    public static function TraerUno($request, $response,$args)
    {
        return $response->write(" entro en TraerUno");
    }
    public function CargarUno($request, $response,$args)
    {//request => 
        return $response->write(" entro en cargaruno");        
    }
    
    public function TraerTodos($request, $response,$args)
    {
        return $response->write(" entro en TraerTodos");                
    }
    
    public function BorrarUno($request, $response,$args)
    {
        return $response->write(" entro en BorrarUno");                        
    }
    public function ModificarUno($request, $response,$args)
    {
        return $response->write(" entro en ModificarUno");                        
        
    }
    
    //************ DEBUG ********** */
    
    public static function debugAlgo($algo)
    {
        echo "</br> ------- var_dump() -------- </br>";
        var_dump($algo);
        echo "</br>";
    }

}//FIN class Facultad 

?>
