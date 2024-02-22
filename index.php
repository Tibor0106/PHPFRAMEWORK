<?php
require_once "DatabaseActions/Database.php";
require_once "./Route.php";
require_once "./APIAuthentication/authentication.php";

$databaseAction = new DatabaseAction();
$request = $_SERVER["REQUEST_URI"];

Route::get("/", function($params) {
    echo "ASD";
});

Route::get("/authentication", function($params) {
    $headers = getallheaders();
    if(APIAuthentication::Validate($headers['accessUsername'], $headers['accessPassword'])) {
        setcookie("accessToken",  $_SESSION["Token"]);
        echo "";
    } else {
        http_response_code(401);
    }
});
Route::get("/getData", function($params) {
    $headers = getallheaders();
    if(isset($headers["accessToken"])) {
        $token = $headers["accessToken"];
        if(APIAuthentication::ValidateToken($token)) {
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

/*
Route::get("/user/{username}", function($params) use ($databaseAction) {
    $responseHolder = $databaseAction->Select("SELECT * FROM blogs WHERE userName like '{$params[0]}'");
    http_response_code($responseHolder->state_code);
    echo $responseHolder->response;
});
*/


Route::execute($request);

?>
