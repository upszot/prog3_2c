<?php

/*
4- (2pts.) caso: inscribirAlumno (get): 
Se recibe nombre, apellido, email del alumno, materia y código de la materia 
y se guarda en el archivo inscripciones.txt 
restando un cupo a la materia en el archivo materias.txt.
Si no hay cupo o la materia no existe informar cada caso particular.
*/

class Inscripciones {

    private $nombre; 
    private $apellido;
    private $email; 
    private $codigo; 
    private $materia;

    function __construct($nombre,$apellido,$email,$codigo,$materia)
    {//{"nombre":"pepe","apellido":"perez","email":"pepe@lala.com","codigo":"002","materia":"prog4"}

        $this->nombre= $nombre;
        $this->apellido= $apellido;
        $this->email= $email;
        $this->codigo= $codigo;
        $this->materia= $materia;        
    }

    //GETTER && SETTERS
    public function __get($property)
    {
        if(property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value){
        if(property_exists($this, $property)) {
            $this->$property = $value;
        }
    }


    //---- Funciones ---
    public function __toString()
    {
        return "nombre: $this->nombre || apellido: $this->apellido || email: $this->email || codigo: $this->codigo || materia: $this->materia </br>";
    }
}
?>
