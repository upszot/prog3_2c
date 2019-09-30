<?php

/*
7- (2 pts.) caso: modificarAlumno(post):
Debe poder modificar todos los datos del alumno menos el email y 
guardar la foto antigua en la carpeta /backUpFotos , el nombre será el apellido y la fecha.
*/

echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>modificar Alumno  <br> </font>";
if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["email"]) && isset($_FILES["foto"])  ) 
{
    Facultad::modificarAlumno($_POST["nombre"], $_POST["apellido"],  $_POST["email"], $_FILES["foto"]);
}
else
{
    echo "faltan datos";
}


?>



