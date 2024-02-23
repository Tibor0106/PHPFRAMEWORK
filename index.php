<?php
require_once "DatabaseActions/Database.php";
require_once "./Route.php";
require_once "./APIAuthentication/authentication.php";
session_start();

header("Access-Control-Allow-Headers: *");

$request = $_SERVER["REQUEST_URI"];
 $databaseAction = new DatabaseAction();

Route::get("/", function ($params) {
    echo "ASD";
});

Route::get("/authentication", function ($params) {
    $headers = getallheaders();
    if (APIAuthentication::Validate("asd", "asd")) {
        echo json_encode(array("accessToken" => $_SESSION["Token"]));
    } else {
        http_response_code(401);
        echo "Invalid credentials.";
    }
    header("Access-Control-Allow-Origin: *");
    die();
});


Route::get("/getData", function ($params) {
    header("Access-Control-Allow-Origin: http://localhost:3000");   
    header("Content-Type: application/json; charset=UTF-8");    
    header("Access-Control-Allow-Methods: POST, DELETE, OPTIONS");    
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");    
    $headers = getallheaders();
    if (isset($headers["accessToken"])) {
        $token = $headers["accessToken"];
        if (APIAuthentication::ValidateToken($token)) {
            echo "A klines kiszolgálható";
        } else {
            
            http_response_code(401);
            echo "invalid access token";
        }
    } else {
        http_response_code(401);
        echo "access token not found";
    }
    
});

Route::get("/getBlogs", function($params) use ($databaseAction) {
    header("Access-Control-Allow-Origin: http://localhost:3000");   
    header("Content-Type: application/json; charset=UTF-8");    
    header("Access-Control-Allow-Methods: POST, DELETE, OPTIONS");    
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");    
    $headers = getallheaders();
    if (isset($headers["accessToken"])) {
        $token = $headers["accessToken"];
        if (APIAuthentication::ValidateToken($token)) {
            $responseHolder = $databaseAction->Select("SELECT * FROM blogs");
            echo $responseHolder->response;
           
            
           
        } else {
            http_response_code(401);
            echo "invalid access token";
        }
    } else {
        http_response_code(401);
        echo "access token not found";
    }   
});
Route::get("/user/{username}", function($params) use ($databaseAction) {
    
});

Route::execute($request);
