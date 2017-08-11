<?php

require_once("../sqlSetters/SQLSetter.php");
require_once("../generators/MainConnectGenerator.php");

$serverName="localhost";
$userName="root";
$password="";
$dbname = "allTools";


$link = new mysqli($serverName, $userName,$password,$dbname);

$courier = $_POST["COURIER"];
$region = $_POST["REGION"];
$dateStart=$_POST["DATE_START"];

//добавляет маршрут если курьер не занят
echo SQLSetter::inspectAndSetRout($link,$courier,$region,$dateStart);
