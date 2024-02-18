<?php

require_once "DatabaseActions/Database.php";
$databaseAction = new DatabaseAction();

$request = $_SERVER["REQUEST_URI"];

$folder = "/PHPFRAMEWORK/";
switch ($request) {
    case $folder."getBlogMessages":
        echo $databaseAction->Select("SELECT * FROM blogs")->response;
        break;
    case $folder."home":
        require "./Pages/index.html";
    default:
        http_response_code(404);   
}
 ?>