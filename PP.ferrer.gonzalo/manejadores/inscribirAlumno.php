<?php

/*
4- (2pts.) caso: inscribirAlumno (get): 
Se recibe nombre, apellido, email del alumno, materia y código de la materia 
y se guarda en el archivo inscripciones.txt 
restando un cupo a la materia en el archivo materias.txt.
Si no hay cupo o la materia no existe informar cada caso particular.
*/

echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>inscribir Alumno  <br> </font>";

//nombre, apellido, email , materia y código de la materia

if (isset($_GET["nombre"]) && isset($_GET["apellido"]) && isset($_GET["email"]) && isset($_GET["materia"]) && isset($_GET["codigo"] ) ) 
{
    Facultad::inscribirAlumno($_GET["nombre"],$_GET["apellido"],$_GET["email"],$_GET["materia"],$_GET["codigo"] );
}
else
{
    echo "faltan datos";
}


?>



