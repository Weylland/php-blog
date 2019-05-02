<?php

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "blog";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbName;charset=utf8", $dbUsername, $dbPassword); 
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo 'Echec : ' . $e->getMessage();
}
