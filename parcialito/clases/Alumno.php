<?php

require_once './Clases/Persona.php';

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


    
	public static function siguienteId($array)
	{
		$proximolegajo = 0;
		if (isset($array))
		{
			foreach ($array as $objetc)
			{
				if ($objetc->legajo > $proximolegajo)
				{
					$proximolegajo = $objetc->legajo;
				}
			}
		}
		return $proximolegajo + 1;
    }
}
?>