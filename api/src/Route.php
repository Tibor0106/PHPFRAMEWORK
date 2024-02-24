<?php 
class RouteData {
    public string $path;
    public string $method;
    public $callback;

    public function __construct(string $path, string $method, $callback) { 
        $this->path = $path;
        $this->method = $method;
        $this->callback = $callback;
    }
}
class RouteResponse {
    public $Get;
    public $Post;
    public function __construct($get, $post) {
        $this->Get = $get;
        $this->Post = $post;
    }
}
class Route{
    public array $params = [];

    public function __construct() {
    }
    public function get($path, $callback){
        $this->params[] = new RouteData($path, "GET", $callback);
    }
    public function post($path, $callback){
        $this->params[] = new RouteData($path, "POST", $callback);
    }
    public function put($path, $callback){
        $this->params[] = new RouteData($path, "PUT", $callback);
    }
    public function delete($path, $callback){
        $this->params[] = new RouteData($path, "DELETE", $callback);
    }
    public function execute($request){
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($request, PHP_URL_PATH);
        $found = false;
        foreach ($this->params as $route) {
            if($route->path === $path){
                $found = true;
                if ($route->method === $method) {
                    $callback = $route->callback; 
                    
        
                    if (is_callable($callback)) {
                        call_user_func($callback, new RouteResponse($_GET, $_POST));
                        return;
                    } else {
                        echo "Error: Callback for $method $path is not callable";
                        return;
                    }
                } else {
                    http_response_code(405);
                    break;
                }
            }  
            $found ? "" : http_response_code(404);    
        }        
    }   
}
?>
