<?php                       //описание в allPublications.php
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
            $title = "Сортировка по ";
            $search = "Искать здесь...";
            $just_word_publ = " публикации(й).";
            $take_word = "Для начала выберите по чем бы вы хотели сортировать:";
                    switch ($_GET[point]) {                                                      //вывод конкретной информации для определеной странички
                        case 'numbers':
                            $point = "numbers";
                            $sortBy = "Номеру";
                            $takesort = "Выберите номер журнала";
                            $sayNum = "В журнале под номером <b>".$_GET[value]."</b> было опубликовано: <b>";
                        break;
                        case 'authors':
                            $point = "authors";
                            $sortBy = "автору";
                            $takesort = "Выберите автора";
                            $sayNum = "<b>".$_GET[value]."</b> было опубликовано: <b>";
                        break;
                        case 'year':
                            $point = "year";
                            $sortBy = "году";
                            $takesort = "Выберите год публикации";
                            $sayNum = "В <b>".$_GET[value]."</b> году было опубликовано: <b>";
                        break;
                        default:
                            $ifNothin = "<li><a href='publicationBy.php?point=year'>По годам</a></li><li><a href='publicationBy.php?point=authors'>По авторам</a></li><li><a href='publicationBy.php?point=numbers'>По номеру журнала</a></li>";
                        break;
                        }
            break;
        case 'ua':
            $pageID = "2";
            $title = "Сортування за ";
            $search = "Шукати тут ...";
            $just_word_publ = " публікації(й).";
            $take_word = "Для початку виберіть по чому ви хотіли сортувати:";
                    switch ($_GET[point]) {
                        case 'numbers':
                            $point = "numbers";
                            $sortBy = "номером";
                            $takesort = "Виберіть номер журналу";
                            $sayNum = "У журналі під номером <b>".$_GET[value]."</b> було опубліковано: <b>";
                        break;
                        case 'authors':
                            $point = "authors";
                            $sortBy = "автором";
                            $takesort = "Виберіть автора";
                            $sayNum = "<b>".$_GET[value]."</b> було опубліковано: <b>";
                        break;
                        case 'year':
                            $point = "year";
                            $sortBy = "роком";
                            $takesort = "Виберіть рік публікації";
                            $sayNum = "В <b>".$_GET[value]."</b> році було опубліковано: <b>";
                        break;
                        default:
                            $ifNothin = "<li><a href='publicationBy.php?point=year'>За рокамы</a></li><li><a href='publicationBy.php?point=authors'>За авторами</a></li><li><a href='publicationBy.php?point=numbers'>За номером журнала</a></li>";
                        break;
                        }
            break;
        case 'en':
            $pageID = "1";
            $title = "Sort by ";
            $search = "Search here ...";
            $just_word_publ = " publication (s).";
            $take_word = "To start, click on what you would sort: ";
                    switch ($_GET[point]) {
                        case 'numbers':
                            $point = "numbers";
                            $sortBy = "numbers";
                            $takesort = "Choose number of magazine";
                            $sayNum = "The magazine numbered <b> ".$_GET[value]." </b> has been published:<b>";
                        break;
                        case 'authors':
                            $point = "authors";
                            $sortBy = "author";
                            $takesort = "Select author";
                            $sayNum = "<b>".$_GET[value]."</b> published: <b>";
                        break;
                        case 'year':
                            $point = "year";
                            $sortBy = "year";
                            $takesort = "Select year of publication";
                            $sayNum = "In <b>".$_GET[value]."</b> was published: <b>";
                        break;
                        default:
                            $ifNothin = "<li><a href='publicationBy.php?point=year'>By year</a></li><li><a href='publicationBy.php?point=authors'>By authors</a></li><li><a href='publicationBy.php?point=numbers'>By magazine number</a></li>";
                        break;
                        }
            break;
        default:
            $pageID = "2";
            $title = "Сортування за ";
            $search = "Шукати тут ...";
            $just_word_publ = " публікації(й).";
            $take_word = "Для початку виберіть по чому ви хотіли сортувати:";
                    switch ($_GET[point]) {
                        case 'numbers':
                                $point = "numbers";
                                $sortBy = "номером";
                                $takesort = "Виберіть номер журналу";
                                $sayNum = "У журналі під номером <b>".$_GET[value]."</b> було опубліковано: <b>";
                            break;
                            case 'authors':
                                $point = "authors";
                                $sortBy = "автором";
                                $takesort = "Виберіть автора";
                                $sayNum = "<b>".$_GET[value]."</b> було опубліковано: <b>";
                            break;
                            case 'year':
                                $point = "year";
                                $sortBy = "роком";
                                $takesort = "Виберіть рік публікації";
                                $sayNum = "В <b>".$_GET[value]."</b> році було опубліковано: <b>";
                            break;
                            default:
                                $ifNothin = "<li><a href='publicationBy.php?point=year'>За рокамы</a></li><li><a href='publicationBy.php?point=authors'>За авторами</a></li><li><a href='publicationBy.php?point=numbers'>За номером журнала</a></li>";
                            break;
                        }
        break;
    }
 ?>
<?php

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title><?=$title.$sortBy?></title>

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


require_once 'db_connection.php';                               // подключение конфигурации к бд

 $mysqli = new mysqli($dbserver, $dblogin, $dbpassword, $db);           //открытие подключения к бд
 $mysqli->query("SET NAMES 'utf8'");                                    //query - отправляет запрос в бд. Установка кодировки для запросов

    if(isset($_GET[value])){         //проверка данных на инициализацию
        $value = $_GET[value];
        $result_set = $mysqli->query("SELECT * FROM `publication` WHERE `$point` = '$value'");   //доставание данных из базы ($point - служит для указания таблицы из которой нужно доставать данные по чем сортировать)
        $mysqli->close();
        if(isset($_COOKIE["autorize"]) && $_COOKIE["autorize"] == true){        //если пользователь авторизирован добавляеться кнопка"добавить"
           echo <<<END
           <form name="saveNewPublication">
           <button formaction="/editPublication.php" formmethod="get" class="btn btn-info">Добавить</button>
           </form>
END;
        }
        printResult($result_set);               //вызов печати публикации

        echo $sayNum." ".$num."</b>".$just_word_publ;    //печать количества опред публ
    }else{ //если пользователь не ввел метод сортировки, то выведеться меню выбора года
            $mysqli = new mysqli($dbserver, $dblogin, $dbpassword, $db);           //открытие подключения к бд
            $mysqli->query("SET NAMES 'utf8'");                                    //query - отправляет запрос в бд. Установка кодировки для запросов
            $result_set = $mysqli->query("SELECT DISTINCT `$point` FROM `publication` ORDER BY `$point`");        //нахождение уникальх значений в опред табличке
            if (!isset($ifNothin)) {        //если не выбранно по чем происходит сортировка, выводиться список по чем возможно сортировать
                echo "<p><h3>".$takesort.":</h3></p>";
                while(($row = $result_set->fetch_assoc()) != false){
                    echo "<li><a href='publicationBy.php?point=".$point."&value=".$row[$point]."'>".$row[$point]."</a></li>";
                }
            }else{
                echo "<p><h3>".$take_word."</h3></p>";
                echo $ifNothin;
            }
    }

        function printResult($result_set){          //функция реализирующая вывод публикаций по году
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
}
        if (isset($_GET[point]) || $num < 2) {                                           // что бы футер не залез
            echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
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
