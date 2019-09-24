<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/estilos.css">
    <title>Modelo 1er Parcial - utn</title>
</head>

<body>
    
    <?php
    require_once './clases/Alumno.php';
    require_once './clases/Facultad.php';
    require_once './clases/Materias.php';

    #require_once './clases/Generales.php';
//    $PATH_ARCHIVOS = './archivos';

   define("PATH_ARCHIVOS", "./archivos"); 

   

    date_default_timezone_set('America/Argentina/Buenos_Aires');

    $metodo = $_SERVER['REQUEST_METHOD'];
    echo "Metodo= " . $metodo . "<br>";
    switch ($metodo)
     {
        case "GET":
             switch (key($_GET)) 
             {
                case 'cargarAlumno':
                    echo '<br>(index) Cargar Alumno<br>';
                    
                    break;
                    
             }
             break;
        case "POST":
            switch (key($_POST)) 
            {
                case 'cargarAlumno':


                    if (isset($_FILES["foto"])) 
                    {
                        echo '<br>(index) Cargar Alumno (con foto)<br>';
                        require_once 'manejadores/CargaAlumno.php';
                    }
                    else
                    {
                        echo '<br>(index) Cargar Alumno <br>';
                    }
                    break;
                                  
            }// FIN switch (key($_POST))             
            break;


        } //FIN switch($metodo)    

    ?>


</body>

</html>