
<?php
    //require_once './clases/Alumno.php';    
    require_once './clases/Materia.php';
    require_once './clases/Inscripciones.php';
    require_once './clases/upload.php';
    

    require_once './clases/Usuario.php';
    require_once './clases/Log.php';

class Facultad {
    
    //PUNTO - 1    PARCIAL 
    static public function AltaUsuario( $legajo, $email, $nombre,  $clave,$foto1, $foto2 )
    {
        echo "<br>Entro en alta Usuario con datos: $legajo, $email, $nombre,  $clave,$foto1, $foto2 </br>";
        $lista = Usuario::leerFromJSON(PATH_ARCHIVOS ."/Usuario.txt");        
        $Usuario=self::BuscaXCriterio($lista, "legajo", $legajo);
        
        if($Usuario!=null)
        {
            echo "<br>El Usuario ya existe<br>";
        }
        else
        {      
            //echo "<br>Nuevo Usuario<br>";             
            $nomFoto1 = "SIN_FOTO"; 
            $nomFoto2 = "SIN_FOTO"; 
            if ($foto1 != null) {                
                $nomFoto1="foto_01_".$legajo;
                Upload::cargarImagenPorNombre($foto1, $nomFoto1, "./fotosUsuario/");
            }
            if ($foto2 != null) {                
                $nomFoto2="foto_02_".$legajo;
                Upload::cargarImagenPorNombre($foto2, $nomFoto2, "./fotosUsuario/");
            }
            $Usuario=new Usuario($legajo, $email, $nombre,  $clave,$nomFoto1, $nomFoto2 );
            array_push($lista, $Usuario);

            self::guardarJSON($lista, PATH_ARCHIVOS ."/Usuario.txt");
        }
    }
    

    //PUNTO -2 PARCIAL
    static public function login($legajo , $clave)
    {
        echo "<br>Entro en login con datos:  $legajo , $clave </br>";    
        $lista = Usuario::leerFromJSON(PATH_ARCHIVOS ."/Usuario.txt");        
        $Usuario=self::BuscaXCriterio($lista, "legajo", $legajo);
        
        if($Usuario==null)
        {
            echo "<br>El Usuario NO existe<br>";
        }
        else
        {      
            echo "<br>validar pass Usuario<br>";
            if($Usuario->clave==$clave)
            {
                echo $Usuario;
            }
            else
            {
                echo "<br>Clave incorrecta<br>";
            }


           
        }
    }

    //Punto - 3 bis
    static public function log($caso ,$hora,$ip)
    {
        $lista = Log::leerFromJSON(PATH_ARCHIVOS ."/Log.txt");
        echo "<br>Entro log con datos: $caso ,$hora,$ip </br>";
        $Log=new Log($caso ,$hora,$ip);
        array_push($lista, $Log);
        self::guardarJSON($lista, PATH_ARCHIVOS ."/Log.txt");
    }

    //PUNTO - 3 PARCIAL
    static public function modificarUsuario($legajo, $email,  $nombre ,  $clave, $foto1 , $foto2)    
    {
        //echo "<br>Entro en modificarUsuario con datos: $legajo, $email,  $nombre ,  $clave, $foto1 , $foto2 </br>";
        $lista = Usuario::leerFromJSON(PATH_ARCHIVOS ."/Usuario.txt");
        $Usuario=self::BuscaXCriterio($lista, "legajo", $legajo);
        
        if($Usuario==null)
        {
            echo "<br>El Usuario NO existe, no se puede modificar<br>";
        }
        else
        {      
            //echo "<br>Modifica Usuario<br>";             
            $nomFoto1 = "SIN_FOTO"; 
            $nomFoto2 = "SIN_FOTO"; 
            if ($foto1 != null) {                
                $nomFoto1="foto_01_".$legajo;
                Upload::cargarImagenPorNombre($foto1, $nomFoto1, "./fotosUsuario/");
            }
            if ($foto2 != null) {                
                $nomFoto2="foto_02_".$legajo;
                Upload::cargarImagenPorNombre($foto2, $nomFoto2, "./fotosUsuario/");
            }            
            //modificado con seters magicos XD            
            $Usuario->email=$email;
            $Usuario->nombre=$nombre;
            $Usuario->clave=$clave;
            $Usuario->nomFoto1=$nomFoto1;
            $Usuario->nomFoto2=$nomFoto2;
            //self::guardarJSON($lista, PATH_ARCHIVOS ."/Usuario.txt", "Usuario");
            self::guardarJSON($lista, PATH_ARCHIVOS ."/Usuario.txt");
        }
    }
    
    //PUNTO - 5 PARCIAL
    static public function verUsuarios()
    {
        echo "<br>Entro en verUsuarios: </br>";    
        $lista = Usuario::leerFromJSON(PATH_ARCHIVOS ."/Usuario.txt");         
    }



    //****************--------------------------- */
    //PUNTO - 3 
    static public function cargarMateria( $nombre, $codigo, $cupo,  $aula)
    {
        //echo "<br>Entro en cargarMateria con datos:  $nombre, $codigo, $cupo, $aula </br>";        
        $lista = Materia::leerFromJSON(PATH_ARCHIVOS ."/Materia.txt");

        $objeto=self::BuscaXCriterio($lista, "codigo", $codigo);
        
        if($objeto!=null)
        {
            echo "<br>La Materia ya existe<br>";
        }
        else
        {      
            //echo "<br>Nueva Materia<br>";
            $Materia=new Materia($nombre, $codigo, $cupo, $aula);
            array_push($lista, $Materia);
            self::guardarJSON($lista, PATH_ARCHIVOS ."/Materia.txt");
        }
    }
    
    //PUNTO - 4
    static public function inscribirAlumno($nombre,$apellido,$email,$materia,$codigo)
    {
        echo "<br>Entro en inscribirAlumno con datos:  $nombre,$apellido,$email,$materia,$codigo </br>";        
        $listaMaterias = Materia::leerFromJSON(PATH_ARCHIVOS ."/Materia.txt");
        $objeto=self::BuscaXCriterio($listaMaterias, "codigo", $codigo);
        
        if($objeto==null)
        {
            echo "<br>La Materia NO existe<br>";
        }
        else
        {
            if($objeto->cupo <= 0)
            {
                echo "<br>No hay Cupo en $objeto->nombre <br>";
            }
            else
            {
                //echo "<br>Nueva Inscripcion <br>";
                $listaInscripciones = Inscripciones::leerFromJSON(PATH_ARCHIVOS ."/Inscripciones.txt");
                //$listaInscripciones = self::LeerJSON(PATH_ARCHIVOS ."/Inscripciones.txt", "Inscripciones");

                //No valido datos: por ejemplo $objeto->nombre == $materia ... (no lo pidieron...)
                $Inscrpcion=new Inscripciones($nombre,$apellido,$email,$codigo,$materia);
                array_push($listaInscripciones, $Inscrpcion);

                //Resto en 1 el cupo, con __set (metodo magico)= __get (metodo magico) -1
                 $objeto->cupo=( $objeto->cupo -1);                
                
                self::guardarJSON($listaMaterias, PATH_ARCHIVOS ."/Materia.txt");
                self::guardarJSON($listaInscripciones, PATH_ARCHIVOS ."/Inscripciones.txt");
            }
        }
    }

    //PUNTO 5y6    
    static public function inscripciones($apellido,$materia)
    {
        $lista = Inscripciones::leerFromJSON(PATH_ARCHIVOS ."/Inscripciones.txt");
        if($apellido==null && $materia==null)
        {
            echo "<br> Muestro Listado de Inscripciones sin filtrar<br>";
            $listaMostrar=$lista;
        }
        else
        {
            if($apellido!=null)
            {
                echo "<br> Muestro Listado de Inscripciones Filtrada por Apellido<br>";
                $listaMostrar=self::SubListaXCriterio($lista, "apellido", $apellido,FALSE);
            }
            else
            {
                echo "<br> Muestro Listado de Inscripciones Filtrada por Materia<br>";
                $listaMostrar=self::SubListaXCriterio($lista, "materia", $materia,FALSE);
            }            
        }
        
        foreach ($listaMostrar as $objeto)
        {
            echo $objeto;
        }               
    }
    

    //PUNTO - 8
    static public function alumnos()
    {
        $listaHead = Alumno::getPublicProperties();
        echo self::crearTablaHeader($listaHead);
        $lista = Alumno::leerFromJSON(PATH_ARCHIVOS ."/Alumno.txt");        
        echo self::crearTablaBody($lista,"Alumno");
    }
    

    //**********  OTRAS FUNCIONES ***********/

    /**Devuelve Tabla con Head cargados en base a un array con los nombres de los Head */
    public static function crearTablaHeader($listaHead)
    {
        $strHtml="<table border='1'>";
        $strHtml.="<thead>";
        
        foreach($listaHead as $header){
            $strHtml.="<th>".$header."</th>";     
        }
        $strHtml.= "</thead>";
        return $strHtml;        
    }

    /** Devuelve Cuerpo de la Tabla en base a un listado
     * Recibe Listado de 
     */
    public static function crearTablaBody($lista,$tipo)
    {
        $strHtml.="<tbody>";
        //$listaHead = Alumno::getPublicProperties();

        $listaHead = $tipo::getPublicProperties();
        foreach($lista as $objeto){
            $strHtml.= "<tr>";
            foreach ($listaHead as $propertyName) {
                if($propertyName=='nomFoto')
                {//OJO esto adaptarlo segun el nombre del campo donde se guarda el nombre de las imagenes

                    if($objeto->{$propertyName}!="SIN_FOTO")
                    {
                        $img="./fotos".$tipo."/".$objeto->{$propertyName}.".png";
                        $strHtml.= "<td><img src=" . $img . " alt=" . " border=3 height=30% width=30%></img></td>";                        
                    }

                }else
                {
                    $strHtml.="<td>".$objeto->{$propertyName}."</td>";
                }
            }
            $strHtml.= "</tr>";
        }
        
        $strHtml.= "</tbody>";
        return $strHtml;        
    }


    /**Funcion de Busqueda Generica en listado
     * Usa los metodos magicos __get para buscar por atributo del objeto
     * criterio= atributo del objeto
     * dato = dato a buscar en dicho atributo
     * 
     * Si encuentra devuelve el objeto, si no devuelve null
     */
    public static function BuscaXCriterio($lista, $criterio, $dato)
    {
        $retorno=null;
        foreach ($lista as $objeto) {
            if ( $objeto->$criterio == $dato) 
            {          
                $retorno= $objeto;
                break;
            }
        }
        return $retorno;
    }

    /**Genera una lista filtrada por criterio 
     * 
     * lista = lista de objetos donde buscar
     * criterio = atributo del objeto a buscar
     * dato = valor a buscar en el atributo del objeto
     * caseSensitive = TRUE /FALSE
    */
    public static function SubListaXCriterio($lista, $criterio, $dato,$caseSensitive)
    {
        $retorno=null;        
        $sublista=array();
        
        /*  
        if(!$caseSensitive)
        {//Si esta en FALSE paso Todo a minisculas (Array y dato)
            $lista = array_map('strtolower', $lista);  //Esta Mierda no me esta andando aca...
            $dato=strtolower($dato);
        }        
        */
        //self::debugAlgo($lista);        
        foreach ($lista as $objeto) 
        {   
            //echo "$criterio , $dato</br>";
        //    self::debugAlgo($objeto);         
            //if ($objeto->criterio == $dato) 
            if ( strtolower($objeto->$criterio) == strtolower($dato) )
            {//si encuentra lo agrego en la sublista
                array_push($sublista, $objeto);
            }
        }

        if(count($sublista)>0)
        {
            $retorno= $sublista;
        }
        return $retorno;
    }


//************ ARCHIVOS ********** */
    
    public static function guardarJSON($listado, $nombreArchivo) 
    {
        $archivo = fopen($nombreArchivo, "w");
        $array = array();
        foreach($listado as $objeto){
            array_push($array,$objeto->jsonSerialize());
        }
        fputs($archivo,  json_encode($array) . PHP_EOL);                    

        fclose($archivo);
        return $listado;
    }

    
    //************ DEBUG ********** */
    
    public static function debugAlgo($algo)
    {
        echo "</br> ------- var_dump() -------- </br>";
        var_dump($algo);
        echo "</br>";
    }

}//FIN class Facultad 

?>
