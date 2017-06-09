<?php               //описанно в allpublications.php
if(isset($_GET[lang])){
    switch($_GET[lang]){
        case 'ru':
            setcookie("lang", "ru");
            $uri = $_SERVER['REQUEST_URI'];
            if($_COOKIE[lang] != "ru"){
            echo "<meta http-equiv=\"refresh\" content=\"0; url=".$uri."\">";
            }
            break;
        case 'ua':
            setcookie("lang", "ua");
            $uri = $_SERVER['REQUEST_URI'];
            if($_COOKIE[lang] != "ua"){
            echo "<meta http-equiv=\"refresh\" content=\"0; url=".$uri."\">";
            }
            break;
        case 'en':
            setcookie("lang", "en");
            $uri = $_SERVER['REQUEST_URI'];
            if($_COOKIE[lang] != "en"){
            echo "<meta http-equiv=\"refresh\" content=\"0; url=".$uri."\">";
            }
            break;
    }
}

    switch($_COOKIE[lang]){
        case 'ru':
                $pageID = "1";
                $title = "Поиск по сайту \"";
                $search = "Искать здесь...";
                $firsPart = "По вашему запросу <b>\"";
                $secondPart = "\"</b> було знайдено: <b>";
                $thirdPart = "</b> публикации(й).";
            break;
        case 'ua':
                $pageID = "2";
                $title = "Пошук по сайту \"";
                $search = "Шукати тут ...";
                $firsPart = "За вашим запитом <b>\"";
                $secondPart = "\"</b> was found: <b>";
                $thirdPart = "</b> публікації (й).";
            break;
        case 'en':
                $pageID = "3";
                $title = "Site search \"";
                $search = "Search here ...";
                $firsPart = "By your request <b>\"";
                $secondPart = "\"</b> was found: <b>";
                $thirdPart = "</b> publication (s).";
            break;
        default:
                $pageID = "2";
                $title = "Пошук по сайту \"";
                $search = "Шукати тут ...";
                $firsPart = "За вашим запитом <b>\"";
                $secondPart = "\"</b> was found: <b>";
                $thirdPart = "</b> публікації (й).";
            break;
    }
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title><?=$title.$_POST[search]?>"</title>

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


</head>

<body>

    <?php
        include_once 'header.php';
     ?>

    <main>
        <div class="container">
            <div class="sertech">
                <form action="search.php" method="POST">
                    <input name="search" type="text" placeholder="<?=$search?>">
                    <button type="submit"></button>
                </form>
            </div>



            <?php
                $search = $_POST[search];

                include_once 'db_connection.php';               //написанно в publications.php
                $mysqli = new mysqli($dbserver, $dblogin, $dbpassword, $db);           //open connection with db
                $mysqli->query("SET NAMES 'utf8'");                                    //query - отправляет запрос в бд. Установка кодировки для запросов
                $result_set = $mysqli->query("SELECT * FROM `publication` WHERE CONVERT(LOWER(`name`) USING utf8mb4) LIKE '%$search%' OR CONVERT(LOWER(`en_name`) USING utf8mb4) LIKE '%$search%' OR CONVERT(LOWER(`ua_name`) USING utf8mb4) LIKE '%$search%'");    //запрос на поиск слова в бд

                if(isset($_COOKIE["autorize"]) && $_COOKIE["autorize"] == true){    //кнопка "добавить"" для авт польз
                   echo <<<END
                   <form name="saveNewPublication">
                   <button formaction="/editPublication.php" formmethod="get" class="btn btn-info">Добавить</button>
                   </form>
END;
                }

                $num = 0;

                printResult($result_set);           //подобное описанно в publications.php

                function printResult($result_set){
                    global $num;
                  while(($row = $result_set->fetch_assoc()) != false){  //fetch_assoc - доставание значений
                       echo <<< _END
                       <div class="panel panel-info">
                       <div class="panel-heading"><h3>$row[name]</h3></div>
                       <div class="panel-body">
                       $row[description]
                       <p align="right"><b>$row[authors]</b></p>
                       <p align="right">Публикация была опубликована в <b>$row[year]</b></p>
                       Вы можете прочитать эту публикацию <a href="$row[save_way]">тут</a>
                       <hr>
                       <h3>$row[ua_name]</h3>
                       <hr>
                       $row[ua_description]
                       <p align="right"><b>$row[ua_authors]</b></p>
                       <p align="right">Публікація була опублікована у <b>$row[year]</b></p>
                       Ви можете прочитати цю публікацію <a href="$row[save_way]">тут</a>
                       <hr>
                       <h3>$row[en_name]</h3>
                       <hr>
                       $row[en_description]
                       <p align="right"><b>$row[en_authors]</b></p>
                       <p align="right">The publication was published in <b>$row[year]</b></p>
                       You can read this publication <a href="$row[save_way]">here</a>
_END;
                       if(isset($_COOKIE["autorize"]) && $_COOKIE["autorize"] == true){        //кнопки "изменить" и "удалить" для авт польз
                               echo <<< _END
                                   <form name="editAndDeleteForm">
                                   <button formaction="/editPublication.php" formmethod="get" value="$row[id]" name="edit" class="btn btn-info">Изменить</button>
                                   <button formaction="/allPublications.php" formmethod="post" value="$row[id]" name="delete" class="btn btn-info">Удалить</button>
                                   </form></div></div>
_END;
                    }else{
                        echo "</div></div>";
                  }
                  $num++;
            }
                global  $firsPart, $search, $secondPart, $thirdPart;
                echo $firsPart.$search.$secondPart.$num.$thirdPart;     //вывод строки на разных языках (переменных много из-за "мультиязычности")
                if ($num < 2) {
                    echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                }
            }
             ?>

        </div>
    </main>

    <?php
        include_once 'footer.php';
        ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/main.js"></script>
</body>
