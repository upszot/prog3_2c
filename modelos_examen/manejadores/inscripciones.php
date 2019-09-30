<?php

/*
5- (1pt.) caso: inscripciones(get): 
Se devuelve un tabla con todos los alumnos inscriptos a todas las materias.

6- (2pts.) caso: inscripciones(get): 
Puede recibir el parámetro materia o apellido y filtra la tabla de acuerdo al parámetro pasado.
*/

echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>inscripciones  <br> </font>";

$apellido=null;
$materia=null;
$flag=0;

if (isset($_GET["apellido"]) ) 
{
    $apellido=$_GET["apellido"];
    $flag=1;
}

if (isset($_GET["materia"]))
{
    $materia=$_GET["materia"];
    $flag=$flag+1;
}

if ($flag==0 ||$flag=1 ) 
{
    Facultad::inscripciones($apellido,$materia);
}
else
{
    echo "se ingresaron datos de mas";
}


?>



