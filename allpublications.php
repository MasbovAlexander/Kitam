<?php       //это нужно для правильного отображения языка
if(isset($_GET[lang])){
    switch($_GET[lang]){
        case 'ru':
            setcookie("lang", "ru");
            $uri = $_SERVER['REQUEST_URI'];
            if($_COOKIE[lang] != "ru"){
            echo "<meta http-equiv=\"refresh\" content=\"0; url=".$uri."\">";   // перезагружает страничку что бы применился язык
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
    switch($_COOKIE[lang]){             // некоторые слова и выбор перевода в зависимости от куки
        case 'ru':
            $pageID = "1";              //выбор из табл ятроки языка
            $title = "Все публикации";
            $search = "Искать здесь...";
            break;
        case 'ua':
            $pageID = "2";
            $title = "Всі публікації";
            $search = "Шукати тут ...";
            break;
        case 'en':
            $pageID = "3";
            $title = "Scientific and technical journal";
            $search = "Search here ...";
            break;
        default:
            $pageID = "2";
            $title = "Всі публікації";
            $search = "Шукати тут ...";
            break;
    }

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title><?=$title?></title>

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
            include_once('publications.php');       //подключение реализации вывода всех публикаций(по сути все из файла можно вставить сюда потому что это единственный раз когда я включал этот файл)
             ?>

        </div>
    </main>

    <?php
        include_once 'footer.php';      //подключение футера
        ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/main.js"></script>
</body>
