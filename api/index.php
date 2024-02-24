<?php
require_once "./src/Database.php";
require_once "./src/Mysql.php";
require_once "./src/Route.php";


$Database = new Database("root", "", "tibor_paragh", "localhost");
if(!$Database->tryConnect()){
    return;
}

$databaseAction = new DatabaseAction(); 

session_start();
header("Access-Control-Allow-Headers: *");

$request = $_SERVER["REQUEST_URI"];
$headers = getallheaders();
$Router = new Route();

$Router->get("/api/getData", function($params) use ($databaseAction){
    $responose = $databaseAction->Select("SELECT * FROM blogs");
    for( $i = 0; $i < count($responose->response); $i++){
       $i > 0 ? print_r("<br>") : "";
       echo "UserName: ". $responose->response[$i]["userName"]."<br>";
       echo "Title: ". $responose->response[$i]["title"]."<br>";
       echo "Description: ". $responose->response[$i]["description"]."<br>";
       echo "Time: ". $responose->response[$i]["dateTime"]."<br>";
       echo "----------------------------------------------------------";
     
    }
    print_r("<br>".$responose->responseJson);
}); 

$Router->execute($request);
?>
