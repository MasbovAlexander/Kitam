<?php
    require_once 'authorization.php';   //подключение логина и пароля

    if(isset($_COOKIE["autorize"]) && $_COOKIE["autorize"] == true){    // проверка что бы второй раз не авторизироваться
            echo "<html lang=\"en\"><head><meta charset=\"utf-8\"><title>Login</title></head><body>Вы уже авторизовались. Можете перейти к разделу <a href=\"allpublications.php\">публикаций</a></body></html>";
    }else{
        if(isset($_POST["send"])){
            if($login == $_POST['login'] && $password == $_POST['password']){
                setcookie("autorize", true);   //1 - name, 2 - value, 3 - time of live; пустое третье поле означает что куки будет жить пока пользователь не закроет браузер
                header("Location: allPublications.php");
                exit;
            }else{
                $autorize_err = "<br>Вы ввели не правильный логин или пароль";
            }
        }
        echo<<<END
        <!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name=”robots” content=”index,follow”>
    <meta name=”description” content=””>

    <link rel="icon" type="image/png" href="img/favicon.png">
    <link rel="apple-touch-icon" href="img/favicon.png">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="css/loginstyle.css">

</head>
<body>


    <div class="form">
        <h1>АВТОРИЗАЦИЯ</h1>
        <fieldset>
        <form method="post" action="" name="loginform">
             <label class="color" for="login">Логин:</label>
            <input type="text" name="login"/>
            <br>
            <label class="color" for="login">Пароль:</label>
            <input type="password" name="password"/>
            <input type="submit" name="send" value="Send">
            <span style="color:red">$autorize_err</span>
        </form>
        </form>
        </fieldset>
    </div>
</body>
</html>
END;
    }

 ?>
