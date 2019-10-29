<?php

/*
    Instalar slim
        * Crear carpeta y ejecutar:    composer require slim/slim "^3.12"
    Ocultar index.php
        * Copiar .htaccess

    Autenticacion con token (JWT) 
        Buscar cualquier metodo ya hecho =>   https://jwt.io/#debugger
        Aca elegi uno: https://github.com/firebase/php-jwt
        
        * composer require firebase/php-jwt

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
