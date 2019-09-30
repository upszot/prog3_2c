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
    require_once './clases/Facultad.php';
    #require_once './clases/Generales.php';

   define("PATH_ARCHIVOS", "./archivos"); 

   

    date_default_timezone_set('America/Argentina/Buenos_Aires');



    $metodo = $_SERVER['REQUEST_METHOD'];
    echo "Metodo= " . $metodo . "<br>";

    switch ($metodo)
     {
        case "GET":
             switch (key($_GET)) 
             {
                case 'login':
                //PARCIAL
                    //echo '<br>(index) Login<br>';
                    require_once 'manejadores/login.php';
                    break;  
                case 'verUsuarios':
                    //PARCIAL
                        echo '<br>(index) verUsuarios<br>';
                        require_once 'manejadores/verUsuarios.php';
                        break;                      
                    
                    
                case 'consultarAlumno':
                    echo '<br>(index) consultarAlumno<br>';
                    require_once 'manejadores/consultarAlumno.php';
                    break;
                case 'inscribirAlumno':
                echo '<br>(index) inscribirAlumno<br>';
                    require_once 'manejadores/inscribirAlumno.php';
                    break;
                
                case 'inscripciones':
                    echo '<br>(index) inscripciones <br>';
                    require_once 'manejadores/inscripciones.php';
                    //con filtro y sin filtro
                    
                    break;
                case 'alumnos':
                    echo '<br>(index) alumnos <br>';              
                    require_once 'manejadores/alumnos.php';
                    break;
                
             }
             $caso=key($_GET);
             require_once 'manejadores/manejador_log.php';

             break;
        case "POST":
            switch (key($_POST)) 
            {
               
                case 'cargarUsuario':
                //PARCIAL
                    // echo '<br>(index) Cargar Usuario (con foto)<br>';
                    require_once 'manejadores/cargarUsuario.php';
                    break;
                case 'cargarMateria':
                    echo '<br>(index) cargarMateria<br>';
                    require_once 'manejadores/cargarMateria.php';
                    break;

                case 'modificarUsuario':
                    //PARCIAL
                    //echo '<br>(index) modificarUsuario<br>';
                    require_once 'manejadores/modificarUsuario.php';
                    break;
            }// FIN switch (key($_POST))             
            $caso=key($_POST);
             require_once 'manejadores/manejador_log.php';
            break;


        } //FIN switch($metodo)    

    ?>


</body>

</html>