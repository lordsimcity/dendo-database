<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$server="localhost";
$user="iris";
$pass="password";
$db="dendo_jitensha";

try{
    $connection= new PDO("mysql:host=$server; dbname=$db", $user, $pass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();

}

?>
