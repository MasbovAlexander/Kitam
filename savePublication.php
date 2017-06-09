<?php

    if (isset($_COOKIE["autorize"]) && $_COOKIE["autorize"] == true) {  //проверка авторизации
        include_once('db_connection.php');                              //подкл бд

        $publicationId = $_POST[id];
        $name = $_POST[name];
        $authors = $_POST[authors];
        $description = $_POST[description];
        $year = $_POST[year];
        $numbers = $_POST[numbers];

        $en_name = $_POST[en_name];
        $en_authors = $_POST[en_authors];
        $en_description = $_POST[en_description];

        $ua_name = $_POST[ua_name];
        $ua_authors = $_POST[ua_authors];
        $ua_description = $_POST[ua_description];

        if(!isset($year) || $year < 2010){              //если год меньше 2010 или его не указали то ему устанавливаеться год который есть сейчас
            global $year;
            $year = date("Y");
        }

        $save_dir = "\\publication";            //укаание папки в корне сайта для сохранения файлов публикаций
        $url = dirname(__FILE__).$save_dir;     //системы от корня системы до указанной папки в корне сайта

        if ($name == "") {  //проверка поля на пустоту
            echo "<span style=\"color:red\">Вы не ввели название публикации на русском</span><br>";
            $error = true;
        }
        if ($authors == "") {   //проверка поля на пустоту
            echo "<span style=\"color:red\">Вы не ввели автора публикации на русском</span><br>";
            $error = true;
        }
        if ($description == "") {   //проверка поля на пустоту
            echo "<span style=\"color:red\">Вы не ввели описание публикации на русском</span><br>";
            $error = true;
        }
        if ($ua_name == "") {  //проверка поля на пустоту
            echo "<span style=\"color:red\">Вы не ввели название публикации на украинском</span><br>";
            $error = true;
        }
        if ($ua_authors == "") {   //проверка поля на пустоту
            echo "<span style=\"color:red\">Вы не ввели автора публикации на украинском</span><br>";
            $error = true;
        }
        if ($ua_description == "") {   //проверка поля на пустоту
            echo "<span style=\"color:red\">Вы не ввели описание публикации на украинском</span><br>";
            $error = true;
        }
        if ($en_name == "") {  //проверка поля на пустоту
            echo "<span style=\"color:red\">Вы не ввели название публикации на английском</span><br>";
            $error = true;
        }
        if ($en_authors == "") {   //проверка поля на пустоту
            echo "<span style=\"color:red\">Вы не ввели автора публикации на английском</span><br>";
            $error = true;
        }
        if ($en_description == "") {   //проверка поля на пустоту
            echo "<span style=\"color:red\">Вы не ввели описание публикации на английском</span><br>";
            $error = true;
        }
        if ($numbers == "") {   //проверка поля на пустоту
            echo "<span style=\"color:red\">Вы не ввели номер журнала</span><br>";
            $error = true;
        }
        if (!$error) {  //проверка на наличие ошибки в введенных данны пользователя

// проверяем isset файла из отправленной формы данных
        if (isset($_FILES['FILE']['name'])){
                //проверяем функцией is_uploaded_file
                //if(is_uploaded_file($_FILES['FILE']['tmp_name']))
                //{
                    // проверяется перемещение файла
                    // в файловую систему хостинга
                    if (move_uploaded_file($_FILES['FILE']['tmp_name'],
                    $url."\\".basename($_FILES['FILE']['name']))) {
                        $mysqli = new mysqli($dbserver, $dblogin, $dbpassword, $db);           //open connection with db
                        $mysqli->query("SET NAMES 'utf8'");                                    //query - отправляет запрос в бд. Установка кодировки для запросов
                        $save_way = str_replace("\\", "\\\\", $save_dir."\\".basename($_FILES['FILE']['name']));    //for normal save in db. Bcs "\" - dosn't print in it.
                        if ($publicationId != "") {     //проверка на изменение или добавление публ(для добавления id должен быть пустым)
                            $colValue = "`name`='".$name."', `en_name`='".$en_name."', `ua_name`='".$ua_name."', `description`='".$description."', `en_description`='".$en_description."', `ua_description`='".$ua_description."', `authors`='".$authors."', `en_authors`='".$en_authors."', `ua_authors`='".$ua_authors."', `save_way`='".$save_way."', `year`='".$year."', `numbers`='".$numbers."'";
                            $result_set = $mysqli->query("UPDATE `publication` SET $colValue WHERE  `id`= $publicationId");
                        } else {
                            $colValue = "'".$name."', '".$en_name."', '".$ua_name."', '".$description."', '".$en_description."', '".$ua_description."', '".$authors."', '".$en_authors."', '".$ua_authors."', '".$save_way."', '".$year."', '".$numbers."'";
                            $result_set = $mysqli->query("INSERT INTO `publication` (`name`, `en_name`, `ua_name`, `description`, `en_description`, `ua_description`, `authors`, `en_authors`, `ua_authors`, `save_way`, `year`, `numbers`) VALUES ($colValue)");
                        }
                        mysqli_close($mysqli);
                        header("Location: allPublications.php");    //переправка пользователя на сайт с публикациями
                        exit;
                    } else {    //тут происходить проверка на то был ли загружен файл(если нет) и идет исправление, то все нормально, если нет и идет добавление то просят изменить введ данные
                        echo "Проблема с путем сохранения файла $url. Или файл не был выбран(если вы изменяли только текстовые данные, то они записались в базу).";
                        $mysqli = new mysqli($dbserver, $dblogin, $dbpassword, $db);           //open connection with db
                        $mysqli->query("SET NAMES 'utf8'");                                    //query - отправляет запрос в бд. Установка кодировки для запросов
                        if ($publicationId != "") { //вот тут(к пред комменту возле else блока)
                            $colValue = "`name`='".$name."', `en_name`='".$en_name."', `ua_name`='".$ua_name."', `description`='".$description."', `en_description`='".$en_description."', `ua_description`='".$ua_description."', `authors`='".$authors."', `en_authors`='".$en_authors."', `ua_authors`='".$ua_authors."', `year`='".$year."', `numbers`='".$numbers."'";
                            $result_set = $mysqli->query("UPDATE `publication` SET $colValue WHERE  `id`= $publicationId");
                            mysqli_close($mysqli);
                        }
                        echo 'Вы можете вернуться к <a href="allPublications.php">Публикациям</a>';
                    }
                //}else{
                //    echo "Файл не был загружен во временную папку.";
            //}
                    } else {
                        echo "Файла не существует.";
                    }
        } else {
            echo '<br>Вы можете все исправить перейдя по этой <a href="'.$_SERVER["HTTP_REFERER"].'">ссылке</a>';   //ссылка на страничку с вводом данных
        }
    } else {
        exit;
    }
