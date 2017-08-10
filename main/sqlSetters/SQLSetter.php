<?php

/**
 * Created by PhpStorm.
 * User: bondarenko.iiu
 * Date: 10.08.2017
 * Time: 9:33
 */
class SQLSetter
{
    //проверяет не занят ли курьер, если нет, то добавляет запись в таблицу маршрутов
    static function inspectAndSetRout($link,$courier, $region, $datestart){
        $date = "'". date("Y-m-d",strtotime($datestart))."'";

        $sql="SELECT * FROM `routes`,`regions` WHERE routes.courier=$courier AND regions.id=routes.region AND $date>=routes.dateStart AND $date<=DATE_ADD(routes.dateStart,INTERVAL (regions.outRegion+regions.toRegion) DAY)";

        $result = $link->query($sql);
        if ($result->num_rows > 0) {
            return false;
        }else{
            $sql="INSERT INTO routes (`courier`, `region`, `dateStart`) 
                  VALUES ($courier, $region, $date)";
            if ($link->query($sql)){
                return true;
            }else{
                echo 'Ошибка  ' . $link->connect_error;
                return false;
            };
        }
    }
}