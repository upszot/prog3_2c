<?php

// require_once './Persona.php';

class Alumno extends Persona{

    private $legajo; 
    private $cuatrimestre;


    function __construct($nombre, $dni, $legajo, $cuatrimestre)
    {
        parent::__construct($nombre, $dni);
        $this->legajo= $legajo;
        $this->cuatrimestre= $cuatrimestre;
    }

    public function getlegajo()
    {
        return $this->legajo;
    }    
    public function getcuatrimestre()
    {
        return $this->cuatrimestre;
    }    

    public function Mostrar()
    {        
        // $this->mostrar();
        parent::Mostrar();
        echo " legajo: $this->legajo || cuatrimestre: $this->cuatrimestre";
    }

    public function toString()
    {        
        // $this->mostrar();
        // parent::toString();
        return parent::toString() ." legajo: $this->legajo || cuatrimestre: $this->cuatrimestre";
    }
}
?>