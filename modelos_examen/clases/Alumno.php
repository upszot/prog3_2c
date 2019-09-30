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




    
    //function __get()  -> buscar metodos magicos

// ------- Getters && Setters Magicos ------------------- 
// de esta forma me ahorro de hacer todos los getters y setters a mano
// Todavia no lo uso pq me genero unos lios... 

    public function __get($property){
        if(property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($propiedad, $valor){
        $this->propiedad = $valor;
    }


    // ----------------------------------------------- 

    //GETTER && SETTERS
    public function getnombre()
    {
        return $this->nombre;
    }
    public function getapellido()
    {
        return $this->apellido;
    }
    public function getemail()
    {
        return $this->email;
    }
        public function getnomFoto()
    {
        return $this->nomFoto;
    }


    public function setnombre($var)
    {
        $this->nombre = $var;
    }
    public function setapellido($var)
    {
        $this->apellido = $var;
    }
    
    public function setemail($var)
    {
        $this->email = $var;
    }
    public function setnomFoto($var)
    {
        $this->nomFoto=$var;
    }

    
    //funciones
    public function Mostrar()
    {
        echo "nombre: $this->nombre || apellido: $this->apellido || email: $this->email ";
    }

    public  function toArray()
    {
        $arrayAux = array();
        array_push($arrayAux, $this->email);
        array_push($arrayAux, $this->nombre);
        array_push($arrayAux, $this->apellido);        
        array_push($arrayAux, $this->nomFoto);
        array_push($arrayAux, "\n");

        return $arrayAux;
    }


}
?>