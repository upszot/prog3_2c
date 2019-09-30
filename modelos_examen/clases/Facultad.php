
<?php
    require_once './clases/Alumno.php';
    require_once './clases/Materias.php';
    require_once './clases/upload.php';

class Facultad {
    
    
    static public function AltaAlumno( $nombre, $apellido, $email,  $foto)
    {
     //   echo "<br>Entro en alta alumno con datos: $nombre, $apellido, $email </br>";
        $lista = self::LeerJSON(PATH_ARCHIVOS ."/Alumno.txt", "Alumno");        
        //$Alumno=self::ExisteAlumno($lista, $email);
        $Alumno=self::BuscaXCriterio($lista, "email", $email);
        
        if($Alumno!=null)
        {
            echo "<br>El Alumno ya existe<br>";
        }
        else
        {      
            //echo "<br>Nuevo Alumno<br>";             
            $nomFoto = "SIN_FOTO"; 
            if ($foto != null) {                
                $nomFoto="foto_".$email;
                Upload::cargarImagenPorNombre($foto, $nomFoto, "./fotosAlumno/");
            }
            
            $Alumno=new Alumno($nombre, $apellido, $email, $nomFoto);            
            self::guardarJSON($lista, PATH_ARCHIVOS ."/Alumno.txt", "Alumno");
        }
    }


    /**Funcion de Busqueda Generica en listado
     * Usa los metodos magicos __get para buscar por atributo del objeto
     * criterio= atributo del objeto
     * dato = dato a buscar en dicho atributo
     * 
     * Si encuentra devuelve el objeto, si no devuelve null
     */
    public static function BuscaXCriterio($lista, $criterio, $dato)
    {
        $retorno=null;
        foreach ($lista as $objeto) {
            if ( $objeto->$criterio == $dato) 
            {          
                $retorno= $objeto;
                break;
            }
        }
        return $retorno;
    }

    public static function existeAlumno($lista, $email)
    {
        $retorno=null;
        foreach ($lista as $objeto) {
            // if ( $objeto->getapellido() == $apellido)
            if ( $objeto->email == $email) 
            {          
                $retorno= $objeto;
                break;
            }
        }
        return $retorno;
    }

//************ archiovos ********** */
    public static function LeerJSON($nombreArchivo, $tipo)
    {
        $ruta = $nombreArchivo;

        if (file_exists($ruta)) {

            $archivo = fopen($ruta, "r");
            $listado = array();
            while (!feof($archivo)) {
                $renglon = fgets($archivo);
                if ($renglon != "") 
                {
                    $objeto = json_decode($renglon);                            
                    switch ($tipo) {
                            /* 
                        case 'Materias':
                            $Materias = new Materias($objeto->sabor ,$objeto->tipo, $objeto->email , $objeto->cantidad, $objeto->nomFoto);                            
                            array_push($listado, $Materias);             
                            break;
                        */
                        case 'Alumno':
                            //$Alumno = new Alumno($objeto->get("nombre") ,$objeto->get("apellido") , $objeto->get("email") ,$objeto->get("nomFoto") );
                            $Alumno = new Alumno($objeto->nombre ,$objeto->apellido, $objeto->email , $objeto->nomFoto);
                            array_push($listado, $Alumno);             
                            break;                            
                    }
                }
            }
            fclose($archivo);
            if (count($listado) > 0) {
                
                return $listado;
            }
        }
        return null;
    }


    
    public static function guardarJSON($listado, $nombreArchivo, $tipo) 
    {
        $archivo = fopen($nombreArchivo, "w");

        foreach($listado as $objeto) 
        {
            switch ($tipo) 
            {
             
                case 'Materias':
                    if (!($key->getSabor() == '' || $key->getSabor() == '\n')) {
                        $array = array('sabor' => $key->getSabor(), 'tipo' => $key->getTipo(),'email' => $key->getemail(), 'cantidad' => $key->getCantidad(),'nomFoto' => $key->getnomFoto() );
                        array_push($listado, $array);
                        fputs($archivo,  json_encode($array) . PHP_EOL);
                    }
                    break;
                case 'Alumno':                        
                        //$array = array('nombre' => $key->get("nombre"), 'apellido' => $key->get("apellido"),'email' => $key->get("email"),'nomFoto' => $key->get("nomFoto") );                        
                        $array = array('nombre' => $objeto->nombre, 'apellido' => $objeto->apellido,'email' => $objeto->email,'nomFoto' => $objeto->nomFoto );
                        array_push($listado, $array);
                        fputs($archivo,  json_encode($array) . PHP_EOL);                    
                    break;                    
            }
        }

        fclose($archivo);
        return $listado;
    }

}
?>
