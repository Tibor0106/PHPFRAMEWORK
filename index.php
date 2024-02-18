<?php
require_once "DatabaseActions/Database.php";
$databaseAction = new DatabaseAction();
echo $databaseAction->Select("SELECT * FROM blogs")->response;
 ?>