<?php

/**
 * Created by PhpStorm.
 * User: bondarenko.iiu
 * Date: 09.08.2017
 * Time: 12:11
 */
class SQLGetter
{
    /*
     * возвращает массив курьеров где ключ=id, а значение=ФИО.
     */
   static function  getCouriersFromTable($link){
        $couriersArray = array();
        $sql = "SELECT id, lastname, name, middlename FROM couriers";
        $result = $link->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $couriersArray[$row["id"]]= $row["lastname"]." ".$row["name"]." ".$row["middlename"];
            }
        } else {
            return false;
        }
        return $couriersArray;
    }

    /*
     * возвращает массив регионов где ключ=id, а значение=название.
     */
    static function  getRegionsFromTable($link){
        $regionsArray = array();
        $sql = "SELECT * FROM regions";
        $result = $link->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $regionsArray[$row["id"]]= $row["regionName"];
            }
        } else {
            return false;
        }
        return $regionsArray;
    }
}