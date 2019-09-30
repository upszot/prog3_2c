
<?php
    require_once './clases/Alumno.php';
    require_once './clases/Materia.php';
    require_once './clases/upload.php';

class Facultad {
    
    //PUNTO - 1
    static public function AltaAlumno( $nombre, $apellido, $email,  $foto)
    {
     //   echo "<br>Entro en alta alumno con datos: $nombre, $apellido, $email </br>";
        $lista = self::LeerJSON(PATH_ARCHIVOS ."/Alumno.txt", "Alumno");        
        //$Alumno=self::ExisteAlumno($lista, $email); //no la uso mas... tengo la de abajo que es generica
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
            self::guardarJSON($lista, PATH_ARCHIVOS ."/Alumno.txt", "Alumno");
        }
    }
    
    //PUNTO - 2    
    static public function consultarAlumno($apellido)
    {
        //echo "<br>Entro en consultarAlumno con datos:  $apellido </br>";
        $lista = self::LeerJSON(PATH_ARCHIVOS ."/Alumno.txt", "Alumno");        
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
                //$objeto->Mostrar();
                echo $objeto;
            }            
        }
    }

    
    //PUNTO - 3
    static public function cargarMateria( $nombre, $codigo, $cupo,  $aula)
    {
        echo "<br>Entro en cargarMateria con datos:  $nombre, $codigo, $cupo, $aula </br>";
        $lista = self::LeerJSON(PATH_ARCHIVOS ."/Materia.txt", "Materia");  
        self::debugAlgo($lista);      

        $objeto=self::BuscaXCriterio($lista, "codigo", $codigo);
        
        if($objeto!=null)
        {
            echo "<br>La Materia ya existe<br>";
        }
        else
        {      
            echo "<br>Nueva Materia<br>";

            $Materia=new Materia($nombre, $codigo, $cupo, $aula);
            array_push($lista, $Materia);
            self::guardarJSON($lista, PATH_ARCHIVOS ."/Materia.txt", "Materia");
        }
    }
    

    //**********  OTRAS FUNCIONES ***********/

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

    public static function existeAlumno($lista, $email)
    {
        $retorno=null;
        foreach ($lista as $objeto) {
            // if ( $objeto->getapellido() == $apellido)
            if ( $objeto->email == $email) 
            {          
                $retorno= $objeto;
                break;
            }
        }
        return $retorno;
    }

//************ ARCHIVOS ********** */
    public static function LeerJSON($nombreArchivo, $tipo)
    {
        $ruta = $nombreArchivo;

        if (file_exists($ruta)) {

            $archivo = fopen($ruta, "r");
            $listado = array();
            while (!feof($archivo)) {
                $renglon = fgets($archivo);
                if ($renglon != "") 
                {
                    $objeto = json_decode($renglon);                            
                    switch ($tipo) 
                    {                        
                        case 'Materia':                           
                            $Materia = new Materia($objeto->nombre ,$objeto->codigo, $objeto->cupo , $objeto->aula);
                            array_push($listado, $Materia);             
                            break;                        
                        case 'Alumno':
                            //$Alumno = new Alumno($objeto->get("nombre") ,$objeto->get("apellido") , $objeto->get("email") ,$objeto->get("nomFoto") );
                            $Alumno = new Alumno($objeto->nombre ,$objeto->apellido, $objeto->email , $objeto->nomFoto);
                            array_push($listado, $Alumno);             
                            break;                            
                    }
                }
            }
            fclose($archivo);
            if (count($listado) > 0) {
                
                return $listado;
            }
        }
        return null;
    }


    
    public static function guardarJSON($listado, $nombreArchivo, $tipo) 
    {
        $archivo = fopen($nombreArchivo, "w");

        foreach($listado as $objeto) 
        {
            switch ($tipo) 
            {             
                case 'Materia':                
                    $array = array('nombre' => $objeto->nombre, 'codigo' => $objeto->codigo,'cupo' => $objeto->cupo,'aula' => $objeto->aula );                
                    array_push($listado, $array);
                    fputs($archivo,  json_encode($array) . PHP_EOL);                
                    break;
                case 'Alumno':                        
                        //$array = array('nombre' => $key->get("nombre"), 'apellido' => $key->get("apellido"),'email' => $key->get("email"),'nomFoto' => $key->get("nomFoto") );                        
                        $array = array('nombre' => $objeto->nombre, 'apellido' => $objeto->apellido,'email' => $objeto->email,'nomFoto' => $objeto->nomFoto );
                        array_push($listado, $array);
                        fputs($archivo,  json_encode($array) . PHP_EOL);                    
                    break;                    
            }
        }

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
