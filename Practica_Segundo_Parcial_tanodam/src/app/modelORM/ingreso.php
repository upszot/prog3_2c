<?php  
namespace App\Models\ORM;
 
 use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class Ingreso extends \Illuminate\Database\Eloquent\Model {  
  protected $usuario;
  protected $legajo;

}
