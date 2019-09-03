<?php


require_once './clases/Alumno.php';


class Facultad
{
    private $nombre;
    private $listaAlumnos;
   
    //Constructores
    function __construct($nom)
    {
        $this->nombre = $nom;
        $this->listaAlumnos = array();   
    }

    //Archivos
    public static function Leer($formato, $nombreArchivo, $tipo)
    {
        $listado = array();

        switch ($formato) {
            case "csv":
                $archivo = fopen($nombreArchivo, "r");
                break;
            case "txt":
                $archivo = fopen($nombreArchivo, "r");
                break;
        }
        while (!feof($archivo)) {
            $renglon = fgets($archivo);

            $arrayDeDatos = explode(',', $renglon);

            if (isset($arrayDeDatos)) {

                switch ($tipo) {
                    case 'Alumno':
                        $Alumno = new Alumno($arrayDeDatos[0], $arrayDeDatos[1], $arrayDeDatos[2], $arrayDeDatos[3]);
                        array_push($listado, $Alumno);
                    // case 'venta':
                    //     $venta=new Venta($arrayDeDatos[0],$arrayDeDatos[1],$arrayDeDatos[2],$arrayDeDatos[3],$arrayDeDatos[4],$arrayDeDatos[5]);
                    //     array_push($listado, $venta);
                }
            }
        }
        fclose($archivo);
        return $listado;
    }


    public static function guardarJSON($lista, $nombreArchivo, $tipo) 
    {
        $listado = $lista;
        $archivo = fopen($nombreArchivo, "w");

        foreach($listado as $key) 
        {
            switch ($tipo) 
            {
                case 'Alumno':
                    if (!($key->getlegajo() == '' || $key->getlegajo() == '\n')) 
                    {

                        $array = array(get_object_vars($key));
                        // $array = array('legajo' => $key->getlegajo(), 'sabor' => $key->getSabor(), 'tipo' => $key->getTipo(), 'cantidad' => $key->getCantidad() , 'precio' => $key->getPrecio());
                        array_push($listado, $array);
                        fputs($archivo,  json_encode($array) . PHP_EOL);
                    }
                    break;                   
            }
        }

        fclose($archivo);
        return $listado;
    }

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
                        case 'Alumno':
                            if (isset($objeto)) {
                                $Alumno = new Alumno($objeto->nombre, $objeto->dni, $objeto->legajo, $objeto->cuatrimestre);
                                array_push($listado, $Alumno);
                            }
                            break;                        
                        // case 'venta':
                        //     $venta=new Venta($objeto->sabor ,$objeto->tipo, $objeto->cliente , $objeto->precio, $objeto->cantidadKg, $objeto->NomfotoAlumno);
                        //     array_push($listado, $venta);
                        //     break;
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
    
    
    //funciones
    
    public static function existeAlumno($lista,$legajo)
    {
        $retorno=null;
        foreach ($lista as $objeto) 
        {
            if ($objeto->getlegajo() == $legajo) 
            {
                $retorno= $objeto;
                break;
            }
        }
        return $retorno;
    }


    public static function AgregarAlumno($nombre,$dni,$legajo,$cuatrimestre)
    {
        global $PATH_ARCHIVOS;
        $lista = self::LeerJSON("$PATH_ARCHIVOS/Alumnos.txt", "Alumno");
        $Alumno = self::existeAlumno($lista,$legajo);

        if ($Alumno == null) {
            echo "<font size='3' color='red'  face='verdana' style='font-weight:bold' <br>Este Alumno NO se Encuentra en  Facultad,Se agregara <br> </font>";
            $nuevoAlumno = new Alumno($nombre,$dni,$legajo,$cuatrimestre);
            array_push($lista, $nuevoAlumno);
        }
        else
        {// Ya existe el Alumno, incrementar la cantidad
            echo "<font size='3' color='red'  face='verdana' style='font-weight:bold' <br>Este Alumno ya se Encuentra en  Facultad<br> </font>";     
        }
        self::guardarJsonFacultad($lista, "$PATH_ARCHIVOS/Alumnos.txt", "Alumno");
    }

    public static function MostrarAlumnos()
    {
        global $PATH_ARCHIVOS;
        $lista = self::LeerJSON("$PATH_ARCHIVOS/Alumnos.txt", "Alumno");
        foreach($lista as $objeto)
        {
            $objeto->Mostrar();
            echo  $objeto->toString() . "</br>";
        }
    }
}    
?>