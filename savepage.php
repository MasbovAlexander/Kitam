<?php           //описанно в allpublications.php
    if(isset($_COOKIE["autorize"]) && $_COOKIE["autorize"] == true){
        $page = $_GET[page];
        $id = $_GET[id];
        $all = $_POST[editor1];

        require_once 'db_connection.php';

        $mysqli = new mysqli($dbserver, $dblogin, $dbpassword, $db);           //open connection with db
        $mysqli->query("SET NAMES 'utf8'");                                    //query - отправляет запрос в бд. Установка кодировки для запросов

        $mysqli->query("UPDATE `$page` SET `all`='$all' WHERE  `id`=$id");      //выбор странички для перевода и выбор строки в какой нужно все поменять

        $mysqli->close();

        header("Location: ".$page.".php");
        exit;

    }else{
        echo "Пожалуйста <a href=\"login.php\">авторизируйтесь</a>";
    }
?>
