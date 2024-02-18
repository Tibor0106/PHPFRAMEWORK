<?php 
class Route {
    private static $routes = [];

    public static function get($path, $callback) {
        self::$routes[$path] = $callback;
    }
    public static function execute($request) {
        foreach (self::$routes as $path => $callback) {
            if (self::matchRoute($path, $request, $params)) {
                call_user_func($callback, $params);
                return;
            }
        }
        require "./Pages/NotFound/index.html";
        http_response_code(404);
    }
    private static function matchRoute($pattern, $request, &$params) {
        $pattern = str_replace('/', '\/', $pattern);
        $pattern = preg_replace('/{[^\/]+}/', '([^\/]+)', $pattern);
        $pattern = '/^' . $pattern . '$/';

        if (preg_match($pattern, $request, $matches)) {
            array_shift($matches); // remove the full match
            $params = $matches;
            return true;
        }
        return false;
    }
}
?>