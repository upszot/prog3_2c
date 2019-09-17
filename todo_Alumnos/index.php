<?php

require_once './Clases/Alumno.php';

$metodo= $_SERVER['REQUEST_METHOD'];

echo $metodo . "<br>";

switch ($metodo) 
{
    case "GET":
        switch (key($_GET)) {
            case 'listar':
                include "Funciones/Listar.php";
                break;
                }
        break;
    case "POST":
        switch (key($_POST)) 
        {
            case 'guardarAlumno':
            if (isset($_FILES["foto"]))
            {
                echo "<br>(index) Alta Alumno - Con Imagen<br>";
                require_once "manejadores/AltaAlumnoFoto.php";
            }                     
            else 
            {
                echo "<br>(index) Alta Alumno<br>";
                require_once "Funciones/GuardarAlumno.php";
            }

        }
        break;
}

?>