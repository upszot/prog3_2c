
<?php
    require_once './clases/Alumno.php';
    require_once './clases/Materia.php';
    require_once './clases/Inscripciones.php';
    require_once './clases/upload.php';
    

class Facultad {
    
    //PUNTO - 1
    static public function AltaAlumno( $nombre, $apellido, $email,  $foto)
    {
     //   echo "<br>Entro en alta alumno con datos: $nombre, $apellido, $email </br>";
        $lista = Alumno::leerFromJSON(PATH_ARCHIVOS ."/Alumno.txt");        
        $Alumno=self::BuscaXCriterio($lista, "email", $email);
        
        if($Alumno!=null)
        {
            echo "<br>El Alumno ya existe<br>";
        }
        else
        {      
            //echo "<br>Nuevo Alumno<br>";             
            $nomFoto = "SIN_FOTO"; 
            if ($foto != null) {                
                $nomFoto="foto_".$email;
                Upload::cargarImagenPorNombre($foto, $nomFoto, "./fotosAlumno/");
            }
            
            $Alumno=new Alumno($nombre, $apellido, $email, $nomFoto);
            array_push($lista, $Alumno);

            self::guardarJSON($lista, PATH_ARCHIVOS ."/Alumno.txt");
        }
    }
    
    //PUNTO - 2    
    static public function consultarAlumno($apellido)
    {
        //echo "<br>Entro en consultarAlumno con datos:  $apellido </br>";        
        $lista = Alumno::leerFromJSON(PATH_ARCHIVOS ."/Alumno.txt");
        $listaFiltrada=self::SubListaXCriterio($lista, "apellido", $apellido,FALSE);        
        
        if($listaFiltrada==null)
        {
            echo "<br>No existe alumno con apellido: $apellido<br>";
        }
        else
        {      
            echo "<br> Muestro Listado de Alumnos<br>";
            foreach ($listaFiltrada as $objeto)
            {
                //metodo Magico toString() XD
                echo $objeto;
            }            
        }
    }

    
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
    
    //PUNTO - 7
    static public function modificarAlumno( $nombre, $apellido, $email,  $foto)
    {
        //echo "<br>Entro en modificarAlumno con datos: $nombre, $apellido, $email </br>";        
        $lista = Alumno::leerFromJSON(PATH_ARCHIVOS ."/Alumno.txt");
        $Alumno=self::BuscaXCriterio($lista, "email", $email);
        
        if($Alumno==null)
        {
            echo "<br>El Alumno NO existe, no se puede modificar<br>";
        }
        else
        {      
            //echo "<br>Modifica Alumno<br>";             
            $nomFoto = "SIN_FOTO"; 
            if ($foto != null) {                
                $nomFoto="foto_".$email;
                Upload::cargarImagenPorNombre($foto, $nomFoto, "./fotosAlumno/");
            }
            
            //modificado con seters magicos XD
            $Alumno->nombre=$nombre;
            $Alumno->apellido=$apellido;
            $Alumno->nomFoto=$nomFoto;
            
            self::guardarJSON($lista, PATH_ARCHIVOS ."/Alumno.txt", "Alumno");
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


/*

    if($objeto->getNomfotoHelado()!="SIN_FOTO")
    {
        $img="./fotosVentas/".$objeto->getNomfotoHelado().".png";
        $strHtml.= "<td><img src=" . $img . " alt=" . " border=3 height=30% width=30%></img></td>";
    }
    else
    {// Buscar imagen que diga No Disponible
        $strHtml.= "<td>".$objeto->getNomfotoHelado()."</td>";
    }
*/

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
        
        /*   */
        if(!$caseSensitive)
        {//Si esta en FALSE paso Todo a minisculas (Array y dato)
            $lista = array_map('strtolower', $lista);  //Esta Mierda no me esta andando aca...
            $dato=strtolower($dato);
        }        
        
        //self::debugAlgo($lista);        
        foreach ($lista as $objeto) 
        {            
            //if ($objeto->$criterio == $dato) 
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
