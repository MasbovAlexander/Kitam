<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Редактирование публикации</title>

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
        <div class="container">
            <div class="row">
<?php

if(isset($_COOKIE["autorize"]) && $_COOKIE["autorize"] == true){        // проверка пользователя на валидность

    require_once 'db_connection.php';                               // подключение конфигурации к бд

     $mysqli = new mysqli($dbserver, $dblogin, $dbpassword, $db);           //открытие подключения к бд
     $mysqli->query("SET NAMES 'utf8'");                                    //query - отправляет запрос в бд. Установка кодировки для запросов
     if(isset($_GET[edit])){                                                //edit - id публикации которая редактируется
         $publicationId = $_GET[edit];
         $result_set = $mysqli->query("SELECT * FROM `publication` WHERE id = $publicationId"); //доставание нужной публикации

         if (($row = $result_set->fetch_assoc()) != false){                     //fetch_assoc() - достает одну строчку из бд //вывод формы для изменения публ.//скрытая передача ид
             echo <<< END
             <form action="savePublication.php" method="post" enctype="multipart/form-data">
             <center><h1><strong>Форма для русского</strong></h1></center><br>
             <!--Скрытое поле hidden -->
             <input type="hidden" name="id" value="$publicationId"\>

             <label>Название публикации: </label>
             <input type="text" name="name" value="$row[name]"/><br><br>

             <label>Автор : </label>
             <input type="text" name="authors" value="$row[authors]"/><br><br>

             <label>Номер журнала : </label>
             <input type="text" name="numbers" value="$row[numbers]"/><br><br>

             <label>Год публикации : </label>
             <input type="number" name="year" value="$row[year]"/> (если год не будет указан, то будет использован текущий год.)<br><br>

             <label>Краткое описание : </label><br>
             <textarea name="description" cols="40" rows="10">$row[description]</textarea><br><br>

             <!-- Поле файла и кнопка Обзор -->
             <input type='file' name='FILE'/>
             <br>

             <hr>
             <center><h1><strong>Form for england</strong></h1></center><br>
             <!--Скрытое поле hidden -->
             <input type="hidden" name="id" value="$publicationId"\>

             <label>Название публикации: </label>
             <input type="text" name="en_name" value="$row[en_name]"/><br><br>

             <label>Автор : </label>
             <input type="text" name="en_authors" value="$row[en_authors]"/><br><br>

             <label>Краткое описание : </label><br>
             <textarea name="en_description" cols="40" rows="10">$row[en_description]</textarea><br><br>
             <br>


             <hr>
             <center><h1><strong>Форма для українського</strong></h1></center><br>
             <!--Скрытое поле hidden -->
             <input type="hidden" name="id" value="$publicationId"\>

             <label>Название публикации: </label>
             <input type="text" name="ua_name" value="$row[ua_name]"/><br><br>

             <label>Автор : </label>
             <input type="text" name="ua_authors" value="$row[ua_authors]"/><br><br>

             <label>Краткое описание : </label><br>
             <textarea name="ua_description" cols="40" rows="10">$row[ua_description]</textarea><br>

             <!-- Кнопка отправки данных -->
             <input type='submit' name='addFile' value='Добавить' />
             <br><br><br><br>
             </form>
END;
         }
                    //эта часть (блок else) нужен для вывода формы добавления новой публ
     }else{                                 //можно было обойтись и без этого(я просто не ищу легких путей). Тоже самое что и перед этим, только все поля остаються пустыми
         echo <<< END
         <form action="savePublication.php" method="post" enctype="multipart/form-data">
         <center><h1><strong>Форма для русского</strong></h1></center><br>
         <!--Скрытое поле hidden -->
         <input type="hidden" name="id"\>

         <label>Название публикации: </label>
         <input type="text" name="name"/><br><br>

         <label>Автор : </label>
         <input type="text" name="authors"/><br><br>

         <label>Номер журнала : </label>
         <input type="text" name="numbers"/><br><br>

         <label>Год публикации : </label>
         <input type="number" name="year"/> (если год не будет указан, то будет использован текущий год.)<br><br>

         <label>Краткое описание : </label><br>
         <textarea name="description" cols="40" rows="10"></textarea><br><br>

         <!-- Поле файла и кнопка Обзор -->
         <input type='file' name='FILE'/>
         <br>


         <hr>
         <center><h1><strong>Form for england</strong></h1></center><br>
         <!--Скрытое поле hidden -->
         <input type="hidden" name="id"\>

         <label>Название публикации: </label>
         <input type="text" name="en_name"/><br><br>

         <label>Автор : </label>
         <input type="text" name="en_authors"/><br><br>

         <label>Краткое описание : </label><br>
         <textarea name="en_description" cols="40" rows="10"></textarea><br><br>
         <br>


         <hr>
         <center><h1><strong>Форма для українського</strong></h1></center><br>
         <!--Скрытое поле hidden -->
         <input type="hidden" name="id"\>

         <label>Название публикации: </label>
         <input type="text" name="ua_name"/><br><br>

         <label>Автор : </label>
         <input type="text" name="ua_authors"/><br><br>

         <label>Краткое описание : </label><br>
         <textarea name="ua_description" cols="40" rows="10"></textarea><br><br>
         <br>

         <!-- Кнопка отправки данных -->
         <input type='submit' name='addFile' value='Добавить' />
         </form><br><br><br><br>
END;
  }
}else{
    echo "Пожалуйста авторизируйтесь для того, что бы видеть содержимое этой странички.<br> Это можно сделать пройдя по <a href=\"/login.php\">ссылке</a>";
}
 ?>
            </div>
        </div>
    </body>
</html>
