<?php

$serverName="localhost";
$userName="root";
$password="";
$dbname = "allTools";


$link = new mysqli($serverName, $userName,$password,$dbname);

// считает сколько дней пути до выбранного региона
$region = $_POST["REGION_ID"];

$sql="SELECT toRegion,outRegion FROM regions WHERE id=$region";
$result = $link->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "В регион: ".$row["toRegion"]."д. Обратная дорога: ".$row["outRegion"]."д.";
    }
}


