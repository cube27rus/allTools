<?php

/**
 * Created by PhpStorm.
 * User: bondarenko.iiu
 * Date: 09.08.2017
 * Time: 16:49
 */
class CreateDB
{
    //создает базу данных
    static function creatingDB($dbname,&$conn){
        $sql ="CREATE DATABASE ".$dbname." CHARACTER SET utf8 COLLATE utf8_general_ci ";
        if ( $conn->query($sql)){
            echo "База данных успешно создана\n";
        }else {
            echo 'Ошибка при создании базы данных';
        };
        $conn->close();
        return $dbname;
    }
}