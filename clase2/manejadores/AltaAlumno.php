<?php

echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>Alta VENTA con imagen <br> </font>";

if (isset($_POST["nombre"]&& isset($_POST["dni"]) && isset($_POST["legajo"] ) && isset($_POST["cuatrimestre"]))
//    Pizzeria::AltaVenta($_POST["sabor"], $_POST["tipo"], $_POST["cantidad"], $_POST["email"],$_FILES["foto"]);
    Facultad::AgregarAlumno($_POST["nombre"], $_POST["dni"], $_POST["legajo"], $_POST["cuatrimestre"]);
}
else
{
    echo "Falta cargar algun dato";
}

?>

