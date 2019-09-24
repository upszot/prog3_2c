

<?php

/*
3- (1 pts.) caso: cargarMateria (post): 
Se recibe el nombre de la materia, código de materia, el cupo de alumnos y
el aula donde se dicta y se guardan los datos en el archivo materias.txt, tomando como identificador el código de
la materia
*/

class Materias {

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


}
?>
