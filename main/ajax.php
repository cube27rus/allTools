<?php

require_once( "sqlSetters/SQLSetter.php" );
require_once( "generators/MainConnectGenerator.php" );
$serverName="localhost";
$userName="root";
$password="";
$dbname = "allTools";

function createConnect($serverName,$userName,$password,$dbname){
    // Create connection
    return new mysqli($serverName, $userName, $password, $dbname);

}
$link = new mysqli($serverName, $userName,$password,$dbname);

$courier = $_POST["COURIER"];
$region = $_POST["REGION"];
$dateStart=$_POST["DATE_START"];

echo SQLSetter::inspectAndSetRout($link,$courier,$region,$dateStart);
/*echo $datestart = "'". date("Y-m-d",strtotime($_POST["DATE_START"]))."'";
$sql="INSERT INTO routes (`courier`, `region`, `dateStart`) 
        VALUES ($courier, $region, $datestart)";
if ($link->query($sql)){
    echo "Готово";
}else{
    echo 'Ошибка : ' . $link->connect_error;
};*/
