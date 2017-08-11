<?php

/**
 * Created by PhpStorm.
 * User: bondarenko.iiu
 * Date: 09.08.2017
 * Time: 12:02
 */
class MainConnectGenerator
{

    private $serverName;
    private $userName;
    private $password;
    private $dbname;

    function __construct($serverName,$userName,$password,$dbname){
        $this->serverName=$serverName;
        $this->userName=$userName;
        $this->password=$password;
        $this->dbname=$dbname;
    }

    /*
     * возвращает  соединение к созданной бд.
    */
    function createMainConnect(){
        // Create connection
        $con = new mysqli($this->serverName, $this->userName,$this->password,$this->dbname);

        return $con;
    }

    /*
     * возвращает  соединение.
    */
     function createConnectNonDB(){
        $con = new mysqli($this->serverName, $this->userName,$this->password);

        return $con;
    }

}