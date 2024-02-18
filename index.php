<?php

require_once "DatabaseActions/Database.php";
$databaseAction = new DatabaseAction();

$request = $_SERVER["REQUEST_URI"];

$folder = "/PHPFRAMEWORK/";
switch ($request) {
    case $folder."getBlogMessages":
        $responseHolder = $databaseAction->Select("SELECT * FROM blogs");
        http_response_code($responseHolder->state_code);
        echo $responseHolder->response;
        break;
    case $folder."home":
        require "./Pages/index.html";
        break;
    case $folder."":
        echo "asd";
        break;
    default:
        http_response_code(404);   
}
 ?>