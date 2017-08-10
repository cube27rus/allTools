<?
require_once( "generators/TableMachine.php" );
require_once( "generators/CreateDB.php" );
require_once( "generators/MainConnectGenerator.php" );
require_once( "generators/MainGenegator.php" );
require_once("sqlGetters/SQLGetter.php");
require_once("generators/DataGenerator.php");

//данные для подключения к бд (!warning - hardcode!)
$serverName="localhost";
$userName="root";
$password="";
$dbname = "allTools";


//-------------функции для создания базы данных и ее заполнения,запускать если базы данных нет или она не заполнена------------------
// создает подключение для создания бд
function createDB($serverName, $userName,$password,$dbname){
    $connectGenerator = new MainConnectGenerator($serverName, $userName,$password,$dbname);
    $linkNoDb=$connectGenerator->createConnectNonDB($serverName,$userName,$password);
    $dbname = CreateDB::creatingDB($dbname,$linkNoDb);

    return $dbname;
}

//заполняет нужную бд
function createDataInDB($serverName, $userName,$password,$dbname){
    $connectGenerator = new MainConnectGenerator($serverName, $userName, $password, $dbname);
    $link = $connectGenerator->createMainConnect();
    $arrayCouriers=SQLGetter::getCouriersFromTable($link);
    $arrayRegions=SQLGetter::getRegionsFromTable($link);
    if(empty($arrayCouriers)&&
        empty($arrayRegions)){
        $mainGen = new MainGenegator($link);
        $mainGen->generateAll();
        $link->close();
    }else{
        echo "БД уже заполнены";
    }
}
//-------------конец функций------------------
if(isset($_POST['BD_CREATE']))
{
    createDB($_POST["SERVER_NAME"],$_POST["USER_NAME"],$_POST["PASSWORD"],$_POST["BASE_NAME"]);
}
if(isset($_POST['BD_SETTING']))
{
    createDataInDB($_POST["SERVER_NAME"],$_POST["USER_NAME"],$_POST["PASSWORD"],$_POST["BASE_NAME"]);
}

//cоздать соединение для работы внутри документа
$connectGenerator = new MainConnectGenerator($serverName, $userName, $password, $dbname);
$link = $connectGenerator->createMainConnect();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Document</title>
</head>

<body>
<div id="content">
    <form action="" id="createBD" method="POST">
        <label for="createBD">Создать и заполнить бд</label>
        <input name="SERVER_NAME" value="<?=$serverName?>" type="text" readonly="readonly">
        <input name="USER_NAME" value="<?=$userName?>" type="text" readonly="readonly">
        <input name="PASSWORD" value="<?=$password?>" type="text" readonly="readonly">
        <input name="BASE_NAME" value="<?=$dbname?>" type="text" readonly="readonly">
        <button name="BD_CREATE" id="creatingBD">Создать базу данных</button>
        <button name="BD_SETTING" id="settingBD">Заполнить базу данных</button>
    </form>

    <form action="/main/getPeriodResultAjax.php" id="period" method="POST">
        <label for="period">Посмотреть отправления за период</label>
        <input type="date" name="DATE_FROM" placeholder="Дата от">
        <input type="date" name="DATE_TO" placeholder="Дата до">
        <div id="resultPeroid"></div>
        <button type="submit">OK</button>
    </form>

    <form action="/main/ajax.php" id="setRoutes" method="POST">
        <label for="setRoutes">Добавить новый маршрут</label>
        <select name="REGION" id="region">
            <option value="" disabled selected>Выбрать регион</option>
            <?foreach (SQLGetter::getRegionsFromTable($link) as $id=>$Region):?>
                <option value="<?=$id?>"><?=$Region?></option>
            <?endforeach;?>
        </select>
        <input type="date" name="DATE_START" placeholder="Дата выезда">
        <select name="COURIER" id="courier">
            <option value="" disabled selected>Выбрать курьера</option>
            <?foreach (SQLGetter::getCouriersFromTable($link) as $id=>$FIO):?>
            <option value="<?=$id?>"><?=$FIO?></option>
            <?endforeach;?>
        </select>
        <div class="time">Время до пункта: <span id="timeToDeliver"></span></div>
        <button type="submit">OK</button>
    </form>
</div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="script.js"></script>
<?
$link->close();
?>



