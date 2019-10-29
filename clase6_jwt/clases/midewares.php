<?php
    require_once 'vendor/firebase/php-jwt/JWT.php';

class midewares {

    static function mid1 ($request, $response, $next){

        $response->getBody()->write(" |Antes 1| ");
        
        $request= $next($request,$response);

        $response->getBody()->write(" |despues 1| ");

        return $response;
    }
    function mid2 ($request, $response, $next){
        $response->getBody()->write(" |Antes 2| ");
        
        $request= $next($request,$response);
        
        $response->getBody()->write(" |despues 2| ");
        return $response;
    }
    function mid3 ($request, $response, $next){
        $response->getBody()->write(" |Antes 3| ");
        
        $request= $next($request,$response);
        
        $response->getBody()->write(" |despues 3| ");
        return $response;
    }
    function Auth ($request, $response, $next){
        $response->getBody()->write(" |Antes 3| ");
        
        $request= $next($request,$response);
        
        $response->getBody()->write(" |despues 3| ");
        return $response;
    }

    /*
    Token de prueba admin
    name=upszot
    password=password

    eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6InVwc3pvdCIsImlhdCI6MTUxNjIzOTAyMiwiYWRtaW4iOnRydWV9.k97je6zj6dJhHhi4360fTnkDtGfC7GnkqGfkNfRDqqU

    */
    function Auth_admin ($request, $response, $next){
        $response->getBody()->write(" |Antes 3| ");
        
        $request= $next($request,$response);
        
        $response->getBody()->write(" |despues 3| ");
        return $response;
    }
}
    

?>