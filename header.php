<?php

require_once 'db_connection.php';

 $mysqli = new mysqli($dbserver, $dblogin, $dbpassword, $db);           //open connection with db
 $mysqli->query("SET NAMES 'utf8'");                                    //query - отправляет запрос в бд. Установка кодировки для запросов

 $result_set = $mysqli->query("SELECT * FROM `header` WHERE `id`= $pageID");           //get all from sql db
 $mysqli->close();


if($row = $result_set->fetch_assoc()){
    if(isset($main_them_on)){
        $main_topic = $row[main_topic];
        $main_subtopic = $row[main_subtopic];
        //текст для вывода зоголовков в хедере
        $main_them = "<div class=\"container padd\"><div class=\"name_jor\"><h1 class=\"text-center\">".$main_topic."</h1></div><div class=\"main_zag\"><h1 class=\"text-center\">".$main_subtopic."</h1></div></div>";
    }
echo <<<_END
<header>
    <nav class="navbar navbar-default menu">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img class="img-circle" src="images/withWhite.png"></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav  ">
                    <li class="active-link"><a href="index.php">$row[main]</a></li>
                    <li><a href="redcolegs.php">$row[redcoleg]</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">$row[author] <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="requirements.php">$row[requirements]</a></li>
                        </ul>
                    </li>
                    <li><a href="contacts.php" class="">$row[contacts]</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">$row[archive]  <span class="caret"></span></a>
                        <ul class="dropdown-menu ">
                            <li><a href="allpublications.php">$row[all_publ]</a></li>
                            <li><a href="publicationBy.php?point=year">$row[for_year]</a></li>
                            <li><a href="publicationBy.php?point=authors">$row[for_author]</a></li>
                            <li><a href="publicationBy.php?point=numbers">$row[for_num]</a></li>
                        </ul>
                    </li>
                </ul>
                <!--<ul class="nav navbar-nav navbar-right icons">
                    <li>
                        <a href="https://www.facebook.com/citam.department/"><img src="images/images.png" height="26" width="27"></a>
                    </li>
                    <li>
                        <a href="https://twitter.com/knure_ua"><img src="images/twitter.jpg" height="26" width="27"></a>
                    </li>
                    <li>
                        <a href="https://vk.com/kaf_tavr"><img src="images/1.png" height="26" width="27"></a>
                    </li>

                </ul>-->
                <ul class="nav navbar-nav navbar-right icons">
                <form action=$_SERVER[REQUEST_URI]>                                             <!--ссылки на выбор языка-->
                <li>
                    <button formaction=$_SERVER[REQUEST_URI] class="btn btn-lg btn-info" formmethod="get" value="en" name="lang">en</button>
                    <button formaction=$_SERVER[REQUEST_URI] class="btn btn-lg btn-info" formmethod="get" value="ru" name="lang">ru</button>
                    <button formaction=$_SERVER[REQUEST_URI] class="btn btn-lg btn-info" formmethod="get" value="ua" name="lang">ua</button>
                </li>
                    </form>
                </ul>
            </div>
            <i class="glyphicon glyphicon-globe globe"></i>
        </div>
    </nav>

        $main_them

</header>
_END;
}else{
    echo "Проблема подключения в бд.";
}
?>
