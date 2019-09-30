<?php

class Alumno {

    private $nombre; 
    private $apellido; 
    private $email;
    private $nomFoto;
    

    function __construct($nombre, $apellido, $email, $nomFoto)
    {
        $this->nombre= $nombre;
        $this->apellido= $apellido;
        $this->email= $email;
        $this->nomFoto= $nomFoto;        
    }


// ------- Getters && Setters Magicos ------------------- 
// de esta forma me ahorro de hacer todos los getters y setters a mano

    public function __get($property){
        if(property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value){
        if(property_exists($this, $property)) {
            $this->$property = $value;
        }
    }



    
    //------------ Funciones ---------------
    public function __toString()
    {
        return "nombre: $this->nombre || apellido: $this->apellido || email: $this->email </br>";
    }


    /** Devuelve array con nombres de las propiedades de la clase (para los headers de la tabla) */
    public static function getPublicProperties(){
        return array('nombre','apellido','email','nomFoto');
    }

    /** seria un tojson*/
    public function jsonSerialize()
    {
        return 
        [
            'nombre'   => $this->nombre,
            'apellido' => $this->apellido,
            'email' => $this->email,
            'nomFoto' => $this->nomFoto
        ];
    }

    /** Lee archivo (array de json de objeto)
     * 
     * $path = Ubicacion del archivo
     *  Retorna un listado de json de objetos de la clase
     */
    public static function leerFromJSON($path)
    {
        $retorno = array();
        $json = file_get_contents($path);
        $json_data = json_decode($json,true);
        //var_dump($json_data);
        foreach ($json_data as $key => $value) 
        {
            array_push($retorno,new Alumno($json_data[$key]['nombre'],$json_data[$key]['apellido'],$json_data[$key]['email'],$json_data[$key]['nomFoto']));          
        }
        return $retorno;
    }
    

}
?>