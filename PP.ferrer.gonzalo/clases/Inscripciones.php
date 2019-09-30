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


    /** Devuelve array con nombres de las propiedades de la clase (para los headers de la tabla) */
    public static function getPublicProperties(){
        return array('nombre','apellido','email','codigo','materia');
    }

    /** seria un tojson*/
    public function jsonSerialize()
    {
        return 
        [
            'nombre'   => $this->nombre,
            'apellido' => $this->apellido,
            'email' => $this->email,
            'codigo' => $this->codigo,
            'materia' => $this->materia
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
            array_push($retorno,new Inscripciones($json_data[$key]['nombre'],$json_data[$key]['apellido'],$json_data[$key]['email'],$json_data[$key]['materia'],$json_data[$key]['materia']));          
        }
        return $retorno;
    }

    
}
?>
