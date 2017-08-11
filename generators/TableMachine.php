<?php

/**
 * Created by PhpStorm.
 * User: bondarenko.iiu
 * Date: 09.08.2017
 * Time: 12:01
 */
class TableMachine
{
    private $link;

    function __construct($link){
        $this->link=$link;

    }


    /*
      * создает таблицу курьеров.
     */
    function creatingTableCouriers(){
        $sql ="CREATE TABLE couriers (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            lastname VARCHAR(30) NOT NULL,
            name VARCHAR(30) NOT NULL,
            middlename VARCHAR(30) NOT NULL
            )";
        if ( $this->link->query($sql)){
            echo " Таблица курьеров готова\r\n";
        }else {
            echo 'Ошибка : ' .  $this->link->connect_error;
        };
    }

    /*
     * создает таблицу регионов
     */
    function creatingTableRegions(){
        $sql ="CREATE TABLE regions (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            regionName VARCHAR(30) NOT NULL,
            outRegion VARCHAR(30) NOT NULL,
            toRegion VARCHAR(30) NOT NULL           
            )";
        if ( $this->link->query($sql)){
            echo " Таблица регионов готова\r\n";
        }else {
            echo 'Ошибка : ' .  $this->link->connect_error;
        };
    }

    /*
      * создает таблицу маршрутов.
     */
    function creatingTableRoutes(){
        $sql ="CREATE TABLE routes (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            courier VARCHAR(30) NOT NULL,
            region VARCHAR(30) NOT NULL,
            dateStart DATE           
            )";
        if ( $this->link->query($sql)){
            echo " Таблица маршрутов готова\r\n";
        }else {
            echo 'Ошибка : ' .  $this->link->connect_error;
        };
    }




}