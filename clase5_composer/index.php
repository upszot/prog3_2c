<?php

require 'vendor/autoload.php';
require_once './clases/IApiUsable.php';
require_once './clases/Facultad.php';

define("PATH_ARCHIVOS", "./archivos"); 


 $config['displayErrorDetails']=true;
 $config['addContentLengthHeader']=false;

 $app=new \Slim\App(["settings" => $config]);

$app->get('/',function( $request,  $response,$args=[]){
   return $response->withStatus(200)->write("hola mundo");
} );


$app->group('/usuario',function(){

    $this->post('/cargar',\Facultad::class . ":CargarUno" );
});
 
$app->run();
?>
