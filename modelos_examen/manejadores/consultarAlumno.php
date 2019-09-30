<?php

/*
1- (2 pt.) caso: cargarAlumno (post): Se deben guardar los siguientes datos: nombre, apellido, email y foto. Los
datos se guardan en el archivo de texto alumnos.txt, tomando el email como identificado
*/

echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>Consultar Alumno  <br> </font>";
if (isset($_GET["apellido"])   ) 
{
    Facultad::consultarAlumno($_GET["apellido"]);
}
else
{
    echo "faltan datos";
}


?>



