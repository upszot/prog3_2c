<!DOCTYPE html>
<html lang="es">

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
    require_once './clases/Materia.php';

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
                case 'consultarAlumno':
                    echo '<br>(index) consultarAlumno<br>';
                    require_once 'manejadores/consultarAlumno.php';
                    break;
                case 'inscribirAlumno':
                echo '<br>(index) inscribirAlumno<br>';
                    break;
                
                case 'inscripciones':
                    echo '<br>(index) inscripciones <br>';
                    //con filtro y sin filtro
                    
                    break;
                case 'alumnos':
                    echo '<br>(index) alumnos <br>';              
                
                    break;
                
             }
             break;
        case "POST":
            switch (key($_POST)) 
            {
               
                case 'cargarAlumno':

                    echo '<br>(index) Cargar Alumno (con foto)<br>';
                    require_once 'manejadores/CargaAlumno.php';

                    //Esto si pide Carga Alumno con o sin foto
                    // if (isset($_FILES["foto"])) 
                    // {
                    //     echo '<br>(index) Cargar Alumno (con foto)<br>';
                    //     require_once 'manejadores/CargaAlumno.php';
                    // }
                    // else
                    // {
                    //     echo '<br>(index) Cargar Alumno (Sin foto)<br>';
                    // }
                    break;
                case 'cargarMateria':
                    echo '<br>(index) cargarMateria<br>';
                    require_once 'manejadores/cargarMateria.php';
                    break;

                case 'modificarAlumno':
                    echo '<br>(index) modificarAlumno<br>';
                
                    break;
            }// FIN switch (key($_POST))             
            break;


        } //FIN switch($metodo)    

    ?>


</body>

</html>