<?php
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

$region = $_POST["REGION_ID"];

$sql="SELECT toRegion FROM regions WHERE $region='id'";
if ($link->query($sql)){
    echo $region;
}else {
    echo 'Ошибка : ' . $link->connect_error;
};
