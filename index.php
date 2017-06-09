<?php                       //все описанно в allpublications.php
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
            $main_them_on = "on";
            $title = "Научно-технический журнал";
            $search = "Искать здесь...";
            break;
        case 'ua':
            $pageID = "2";
            $main_them_on = "on";
            $title = "Науково-технічний журнал";
            $search = "Шукати тут ...";
            break;
        case 'en':
            $pageID = "3";
            $main_them_on = "on";
            $title = "Scientific and technical journal";
            $search = "Search here ...";
            break;
        default:
            $pageID = "2";
            $main_them_on = "on";
            $title = "Науково-технічний журнал";
            $search = "Шукати тут ...";
            break;
    }


    require_once 'db_connection.php';

     $mysqli = new mysqli($dbserver, $dblogin, $dbpassword, $db);           //open connection with db
     $mysqli->query("SET NAMES 'utf8'");                                    //query - отправляет запрос в бд. Установка кодировки для запросов

     $result_set = $mysqli->query("SELECT * FROM `index` WHERE `id`= $pageID");           //get all from sql db
     $mysqli->close();
     if(!$row = $result_set->fetch_assoc()){
         echo "Проблема подключения в бд.";
     }

     $all = $row[all];

     if(isset($_COOKIE["autorize"]) && $_COOKIE["autorize"] == true){        //кнопки "изменить заголовок" для аторизированного пользователя
             $editTitle = "<a href=\"saveTitle.php?id=".$pageID."\" class=\"btn btn-info\">Изменить заголовок</a>";
  }
 ?>

<!DOCTYPE html>
<html lang="<?=$_COOKIE[lang]?>">

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

    <script src="ckeditor/ckeditor.js"></script>
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
                <br>
                <?=$editTitle?>
            </div>
            <div class="row">
               <div class="col-md-12">
                   <div class="d9">
                            <?=$all?>
                    </div>
                </div>
            </div>
            <?php
            if(isset($_COOKIE["autorize"]) && $_COOKIE["autorize"] == true){       //редактор для авторизированного пользователя
               echo <<<END
            <form method="post" action='savepage.php?page=index&id=$pageID'>
                    <textarea name="editor1" value= $all ></textarea>
                        <script>CKEDITOR.replace( 'editor1' );</script>
                    <p><input type="submit"></p>
            </form>
END;
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
