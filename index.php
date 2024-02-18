<?php
require_once "DatabaseActions/Database.php";
require_once "./Route.php";

$databaseAction = new DatabaseAction();
$request = $_SERVER["REQUEST_URI"];

Route::get("/", function($request) {
    require "./Pages/index.html";
});

Route::get("/user/{username}", function($params) use ($databaseAction) {
    $responseHolder = $databaseAction->Select("SELECT * FROM blogs WHERE userName like '{$params[0]}'");
    http_response_code($responseHolder->state_code);
    echo $responseHolder->response;
});

Route::execute($request);

?>
