<?php

/*
3- (1 pts.) caso: cargarMateria (post): 
Se recibe el nombre de la materia, código de materia, el cupo de alumnos y
el aula donde se dicta y se guardan los datos en el archivo materias.txt, tomando como identificador el código de
la materia
*/

class Materia {

    private $nombre; 
    private $codigo; 
    private $cupo;
    private $aula;

    function __construct($nombre, $codigo, $cupo, $aula)
    {
        $this->nombre= $nombre;
        $this->codigo= $codigo;
        $this->cupo= $cupo;
        $this->aula= $aula;        
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
        return "nombre: $this->nombre || codigo: $this->codigo || cupo: $this->cupo || aula: $this->aula </br>";
    }


    /** Devuelve array con nombres de las propiedades de la clase (para los headers de la tabla) */
    public static function getPublicProperties(){
        return array('nombre','codigo','cupo','aula');
    }

    /** seria un tojson*/
    public function jsonSerialize()
    {
        return 
        [
            'nombre'   => $this->nombre,
            'codigo' => $this->codigo,
            'cupo' => $this->cupo,
            'aula' => $this->aula
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
            array_push($retorno,new Materia($json_data[$key]['nombre'],$json_data[$key]['codigo'],$json_data[$key]['cupo'],$json_data[$key]['aula']));
        }
        return $retorno;
    }


}
?>
