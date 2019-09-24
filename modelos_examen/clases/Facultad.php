
<?php
    require_once './clases/upload.php';

class Facultad {
    
    
    static public function AltaAlumno( $nombre, $apellido, $email,  $foto)
    {
        echo "entro";        

        $lista = self::LeerJSON(PATH_ARCHIVOS ."/Alumno.txt", "Alumno");
        $Alumno=self::ExisteAlumno($lista, $apellido);

        if($Alumno!=null)
        {
            echo "<br>El Alumno ya existe<br>";
        }
        else
        {         
            $nomFoto = "SIN_FOTO"; 
            if ($foto != null) {                
                $nomFoto="foto_".$email;
                Upload::cargarImagenPorNombre($foto, $nomFoto, "./fotosAlumno/");
            }

            $Alumno=new Alumno($nombre, $apellido, $email,   $nomFoto);
            array_push($lista, $Alumno);
            self::guardarJSON($lista, PATH_ARCHIVOS ."/Alumno.txt", "Alumno");
        }
    }


    public static function existeAlumno($lista, $apellido)
    {
        $retorno=null;
        foreach ($lista as $objeto) {
            // if ( $objeto->getapellido() == $apellido) 
            if ( $objeto->get("alumno") == $apellido) 
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
                if ($renglon != "") {
                    $objeto = json_decode($renglon);
                    switch ($tipo) {
                            /* 
                        case 'Materias':
                            $Materias = new Materias($objeto->sabor ,$objeto->tipo, $objeto->email , $objeto->cantidad, $objeto->nomFoto);                            
                            array_push($listado, $Materias);             
                            break;
                        */
                        case 'Alumno':
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


    
    public static function guardarJSON($lista, $nombreArchivo, $tipo) 
    {
        $listado = $lista;
        $archivo = fopen($nombreArchivo, "w");

        foreach($listado as $key) 
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
                        $array = array('nombre' => $key->getnombre(), 'apellido' => $key->getapellido(),'email' => $key->getemail(),'nomFoto' => $key->getnomFoto() );
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
