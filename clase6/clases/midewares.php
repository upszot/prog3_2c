<?php

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
}
    

?>