<?php

/*
1- (2 pt.) caso: cargarAlumno (post): Se deben guardar los siguientes datos: nombre, apellido, email y foto. Los
datos se guardan en el archivo de texto alumnos.txt, tomando el email como identificado
*/

echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>cargar Materia  <br> </font>";
if (isset($_POST["nombre"]) && isset($_POST["codigo"]) && isset($_POST["cupo"]) && isset($_POST["aula"])  ) 
{
    Facultad::cargarMateria($_POST["nombre"], $_POST["codigo"],  $_POST["cupo"],  $_POST["aula"]);
}
else
{
    echo "faltan datos";
}


?>



