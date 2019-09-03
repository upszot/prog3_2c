<?php

$PATH_ARCHIVOS = './archivos';

require_once './clases/persona.php';
require_once './clases/alumno.php';

date_default_timezone_set('America/Argentina/Buenos_Aires');

$metodo = $_SERVER['REQUEST_METHOD'];
echo "Metodo= " . $metodo . "<br>";

switch ($metodo)
{
   case "GET":
        if (isset($_GET["listado"])
        {
            require_once 'manejadores/lista_alumnos.php';
        }
        
        break;
    case "POST":
    if (isset($_POST["lista"]
    { 
        require_once 'manejadores/AltaAlumno.php';
    }
        
        break;

}
?>