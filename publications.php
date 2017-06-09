<?php                                                       //некоторый части описания данного участка кода можно посмотреть на страничке publicationByYear.php at line: 96 to 134
    require_once 'db_connection.php';

     $mysqli = new mysqli($dbserver, $dblogin, $dbpassword, $db);           //open connection with db
     $mysqli->query("SET NAMES 'utf8'");                                    //query - отправляет запрос в бд. Установка кодировки для запросов

     if(isset($_POST[delete])){
         $deleteID = $_POST[delete];

         $unlink_file = $mysqli->query("SELECT `save_way` FROM `publication` WHERE id = $deleteID");
         if($row = $unlink_file->fetch_assoc()){
         $url = substr($row[save_way], 1);
     }else{
         echo "Не удалось удалить файл данной публикации. Но из базы данных все успешно удалено.";
         echo $url;
     }
         unlink($url);

         $mysqli->query("DELETE FROM `publication` WHERE id = $deleteID");  //удаление публ из бд с ID = deleteID
         echo "Публикация с id = $deleteID удалена.";
     }

     $result_set = $mysqli->query("SELECT * FROM `publication`");           //get all from sql db
     $mysqli->close();

     if(isset($_COOKIE["autorize"]) && $_COOKIE["autorize"] == true){       //кнопка добавить для авт польз
        echo <<<END
        <form name="saveNewPublication">
        <button formaction="/editPublication.php" formmethod="get" class="btn btn-info">Добавить</button>
        </form>
END;
     }

     printResult($result_set);

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
 ?>
