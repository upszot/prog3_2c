<?php

/*
1- (2 pt.) caso: cargarAlumno (post): Se deben guardar los siguientes datos: nombre, apellido, email y foto. Los
datos se guardan en el archivo de texto alumnos.txt, tomando el email como identificado
*/

echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>Alta Alumno  <br> </font>";
if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["email"]) && isset($_FILES["foto"])  ) 
{
    Facultad::AltaAlumno($_POST["nombre"], $_POST["apellido"],  $_POST["email"], $_FILES["foto"]);
}
else
{
    echo "faltan datos";
}


?>



