<?php
require_once( "generators/TableMachine.php" );
require_once( "generators/MainConnectGenerator.php" );
require_once("sqlGetters/SQLGetter.php");
require_once("generators/DataGenerator.php");
/**
 * класс нужен для генерации начальных таблиц и значений
 */
class MainGenegator
{
    private $link;

    function __construct($link){
        $this->link=$link;
    }

    public function generateAll(){
        $this->createTables();
        $this->generateDataInTables();
    }

    private function createTables(){
        $tableMachime = new TableMachine($this->link);
        $tableMachime->creatingTableCouriers();
        $tableMachime->creatingTableRegions();
        $tableMachime->creatingTableRoutes();
    }

    private function generateDataInTables(){
        $datagenerator=new DataGenerator($this->link);
        $datagenerator->generateCouriers();
        $datagenerator->generateRegions();
        $datagenerator->generateRoutes();
    }
}