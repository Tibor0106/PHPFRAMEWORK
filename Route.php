<?php

class Route {
    private static $routes = [];

    public static function get($path, $callback) {
        self::$routes['GET'][$path] = $callback;
    }

    public static function post($path, $callback) {
        self::$routes['POST'][$path] = $callback;
    }

    public static function execute($request) {
        $method = $_SERVER['REQUEST_METHOD'];
        
        if (isset(self::$routes[$method])) {
            foreach (self::$routes[$method] as $path => $callback) {
                if (self::matchRoute($path, $request, $params)) {
                    call_user_func($callback, $params);
                    return;
                }
            }
        } 
        http_response_code(405); //Ha nem a megott metódussal történik a hívás
    }
    private static function matchRoute($pattern, $request, &$params) {
        $pattern = str_replace('/', '\/', $pattern);
        $pattern = preg_replace('/{[^\/]+}/', '([^\/]+)', $pattern);
        $pattern = '/^' . $pattern . '$/';

        if (preg_match($pattern, $request, $matches)) {
            array_shift($matches);
            $params = $matches;
            return true;
        }
        return false;
    }
}
?>
