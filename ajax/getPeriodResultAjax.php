<?php
$serverName="localhost";
$userName="root";
$password="";
$dbname = "allTools";


$link = new mysqli($serverName, $userName,$password,$dbname);

//выбирает маршруты за период
$dateTo = "'". date("Y-m-d",strtotime($_POST["DATE_TO"]))."'";
$dateFrom = "'". date("Y-m-d",strtotime($_POST["DATE_FROM"]))."'";

$sql="SELECT couriers.lastname,couriers.name,regions.regionName,routes.dateStart FROM routes,couriers,regions WHERE routes.courier=couriers.id AND routes.region=regions.id AND DATE(dateStart) BETWEEN $dateFrom AND $dateTo ";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row["lastname"]." ".$row["name"]." go to ".$row["regionName"]." start in  ".$row["dateStart"]."</br>";
    }
}
