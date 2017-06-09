<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Сохранение заголовка</title>
        <meta name=”robots” content=”index,follow”>
        <meta name=”description” content=””>

        <link rel="icon" type="image/png" href="img/favicon.png">
        <link rel="apple-touch-icon" href="img/favicon.png">

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

        <script src="ckeditor/ckeditor.js"></script>
    </head>
    <body>
        <?php
        if(isset($_COOKIE["autorize"]) && $_COOKIE["autorize"] == true){        //кнопки "изменить" и "удалить" для авт польз
                $pageID = $_GET[id];
                require_once 'db_connection.php';

                 $mysqli = new mysqli($dbserver, $dblogin, $dbpassword, $db);           //open connection with db
                 $mysqli->query("SET NAMES 'utf8'");                                    //query - отправляет запрос в бд. Установка кодировки для запросов

                 $result_set = $mysqli->query("SELECT `main_topic`,`main_subtopic` FROM `header` WHERE `id`= $pageID");
                 $mysqli->close();
                 if(!$row = $result_set->fetch_assoc()){
                     echo "Проблема подключения в бд.";
                 }

                 if($_POST[main_topic] == "" || $_POST[main_subtopic] == ""){
                echo <<< END
                    <div class="container">
                        <div class="row">
                            <form method="post" action="">
                                <label>Главная тема: </label><br>
                                <textarea name="main_topic" cols="50" rows="5">$row[main_topic]</textarea><br><br>

                                <label>Подтема: </label><br>
                                <textarea name="main_subtopic" cols="100" rows="5">$row[main_subtopic]</textarea><br><br>

                                <input type='submit' name='addFile' value='Изменить' />
                                <br><br><br><br>
                            </form>
                        </div>
                    </div>
END;
                }else{
                    $main_topic = $_POST[main_topic];
                    $main_subtopic = $_POST[main_subtopic];

                    require_once 'db_connection.php';

                     $mysqli = new mysqli($dbserver, $dblogin, $dbpassword, $db);           //open connection with db
                     $mysqli->query("SET NAMES 'utf8'");                                    //query - отправляет запрос в бд. Установка кодировки для запросов

                     $result_set = $mysqli->query("UPDATE `header` SET `main_topic`='$main_topic', `main_subtopic`='$main_subtopic' WHERE  `id`= $pageID");           //get all from sql db
                     $mysqli->close();

                     echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";
                }
     }else{
         echo "<h3>Пожалуйста авторизируйтесь</h3></body></html>";
     }
         ?>
