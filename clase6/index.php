<?php

/*
Instalar slim
    composer require slim/slim "^3.12"
*/

require 'vendor/autoload.php'; //Esta ponerla siempre es de slim
require_once './clases/midewares.php';
require_once './clases/Generica.php';


 $config['displayErrorDetails']=true;
 $config['addContentLengthHeader']=false;

 $app=new \Slim\App(["settings" => $config]);

//  $app->add(\midewares::class . ":mid2");
 
 $app->get('/',function( $request,  $response,$args=[]){
    return $response->withStatus(200)->write("Clase midewares");
 } );

$app->group('/usuario',function(){

    $this->get('/TraerUno',\Generica::class . ":TraerUno" );
    $this->post('/CargarUno',\Generica::class . ":CargarUno" );
    $this->get('/TraerTodos',\Generica::class . ":TraerTodos" );
    $this->delete('/BorrarUno',\Generica::class . ":BorrarUno" );
    $this->put('/ModificarUno',\Generica::class . ":ModificarUno" );

})->add(\midewares::class . ":mid1");

$app->run();
?>
