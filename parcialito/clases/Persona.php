<?php

class Persona{
    private $nombre;
    private $dni;
    private $NomFoto;

    function __construct($nombre, $dni, $PNomFoto)
    {
        $this->nombre= $nombre;
        $this->dni= $dni;
        $this->NomFoto = $PNomFoto;
    }

    public function getNombre()
    {
        return $this->nombre;
    }    
    public function getDni()
    {
        return $this->dni;
    }    
    public function setNombre($nom)
    {
        $this->nombre= $nom;
    }    
    public function setDni($dni)
    {
        $this->dni= $dni;
    }   
    
    
    //funciones
    public function Mostrar()
    {
        echo "nombre: $this->nombre || dni: $this->dni || foto: $this->NomFoto";
    }
} 
?>