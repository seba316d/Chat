<?php
/**
 * Created by PhpStorm.
 * User: s.manczak
 * Date: 02.03.2017
 * Time: 14:00
 */

if(isset($_COOKIE['login'])){
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>CHAT v1.0.1</title>
    <script src="http://ts3-tnt.pl/script/jquery-3.1.1.min.js"></script>
    <script src="javascript/checkUser.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
</head>

<body>

    <form class="login_form">
        <input type="text" name="user" id="user">
        <input type="submit" name="submit" value="Wejdź" id="button" onClick="return checkUser()">
    </form>

<p></p>
</body>

</html>
