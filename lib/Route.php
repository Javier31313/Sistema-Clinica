<?php

namespace Lib;

class Route
{
    private static $routes = [];

    //function get() se encarga de agregar rutas get al array $routes   
    public static function get($uri, $callback) 
    {
        $uri = trim($uri,'/'); // trim verifica si al principio o al final de $uri hay '/' y los elimina, ejemplo: /contact/ => contact
        self::$routes['GET'][$uri] = $callback;
    }

    //function post se encargar de agregar rutas post al array $routes
    public static function post($uri, $callback)
    {
        $uri = trim($uri,'/');
        self::$routes['POST'][$uri] = $callback;
    }

    public static function dispatch() 
    {
        $uri = $_SERVER['REQUEST_URI']; //Recuperar $uri osea todo lo que viene después de localhost en la url
        $uri = trim($uri, '/');

        $method = $_SERVER['REQUEST_METHOD']; // devuelve GET $method trae todos los get sin necesidad de traer tmb los post

        foreach(self::$routes[$method] as $route => $callback){ //$route lo que almacena es = '/', '/contact' , '/about' Y $callback almacena las function() que hay en web.php
            
            if(strpos($route, ':') !== false) {
                $route = preg_replace('#:[a-zA-Z]+#', '([a-zA-Z]+)', $route);
            }

            if(preg_match("#^$route$#", $uri, $matches)) {

                $params = array_slice($matches, 1); // le pedimos a array_slice que genere otro array a parte de $matches y que comience a partir del indice 1

                // ['a', 'b', 'c'] esto hace: ...
                //$response = $callback(...$params);
                if(is_callable($callback)) {
                    $response = $callback(...$params);
                }

                if(is_array($callback)){
                    $controller = new $callback[0];
                    $response = $controller->{$callback[1]}(...$params);
                }

                if(is_array($response) || is_object($response)){ 

                    header('Content-Type: application/json');

                    echo json_encode($response);
                }else {
                    echo $response;
                }
                return ;
            }
        }
        echo '404 Not Found';
    }
}