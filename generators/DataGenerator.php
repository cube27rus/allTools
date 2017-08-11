<?php
/**
 * Created by PhpStorm.
 * User: bondarenko.iiu
 * Date: 09.08.2017
 * Time: 13:09
 */
require_once( "sqlSetters/SQLSetter.php" );
class DataGenerator
{

    private $link;

    function __construct($link){
        $this->link=$link;

    }
    /*
      * добавляет курьеров.
     */
    function generateCouriers(){
        $sql="INSERT INTO couriers (lastname, name, middlename) 
            VALUES ('Ivanov', 'Ivan', 'Ivanovich'),
            ('Petrov', 'Petr', 'Vavons'),
            ('Pokrov', 'Nikolay', 'Nikolayev'),
            ('Sidorov', 'Sidr', 'Ivanovich'),
            ('Ilyin', 'Petr', 'Ryabinovich'),
            ('Alekseen', 'Danila', 'Papinovich'),
            ('Yahoo', 'Petr', 'Ivanovich'),
            ('Viniaminov', 'Renat', 'Sidrovich'),
            ('Golubev', 'Aleksandr', 'Yuriev'),
            ('Muhhamad', 'Ahmed', 'Laden')";
        if ($this->link->query($sql)){
            echo "Курьеры готовы\r\n";
        }else {
            echo 'Ошибка : ' . $this->link->connect_error;
        };
    }
    /*
      * добавляет регионы.
     */
    function generateRegions(){
        $sql="INSERT INTO regions (regionName, outRegion, toRegion) 
            VALUES ('Saint-Petersburg', '8', '9'),
            ('Ufa', '4', '5'),
            ('Novgorod', '5', '5'),
            ('Vladimir', '9', '8'),
            ('Kostroma', '2', '2'),
            ('Ekaterinburg', '5', '8'),
            ('Kovrov', '4', '6'),
            ('Voronesh', '8', '8'),
            ('Samara', '7', '7'),
            ('Astrachan', '4', '5')";
        if ($this->link->query($sql)){
            echo "Регионы готовы\r\n";
        }else {
            echo 'Ошибка : ' . $this->link->connect_error;
        };
    }
    /*
     * генерирует и добавляет маршруты.
     * до применения неопходимо заполнить таблицы регионов и курьеров.
    */
    function generateRoutes(){
        $sql = "SELECT id FROM couriers";
        $result = $this->link->query($sql);
        $couriersId=array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $couriersId[]= $row["id"];
            }
        }
        $sql = "SELECT id FROM regions";
        $result = $this->link->query($sql);
        $regionsId=array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $regionsId[]= $row["id"];
            }
        }

        for($i=0;$i<26;$i++){
            $curent_curier=rand(0,count($couriersId)-1);
            $curent_region=rand(0,count($regionsId)-1);
            $date = date("Y-m-d",strtotime( "2015-06-$i +$i month" ));
            $added=false;
            while(!$added) {
                if(SQLSetter::inspectAndSetRout($this->link, $couriersId[$curent_curier], $regionsId[$curent_region], $date)) $added=true;
            }
            /*$sql="INSERT INTO routes (courier, region, dateStart)
            VALUES ($couriersId[$curent_curier],$regionsId[$curent_region],$date)";
            $this->link->query($sql);*/
        }

    }
}