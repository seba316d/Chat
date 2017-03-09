<?php
/**
 * Created by PhpStorm.
 * User: s.manczak
 * Date: 07.03.2017
 * Time: 10:59
 */
session_start();
$user_message = $_GET['user'];
$me = $_COOKIE['login'];
$_SESSION['do'] = $user_message;

if(!isset($me) && !isset($_COOKIE['login'])){
    header("Location: login.php");
}
elseif(isset($_COOKIE['login'])){
    $user = $_COOKIE['login'];
    $_SESSION['user'] = $me;
}
if(isset($me)){
setcookie("login","$user",time()+300);

?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Wiadomość prywatna do: <?php echo $user?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="http://ts3-tnt.pl/script/jquery-3.1.1.min.js"></script>
    <script src="javascript/priv_message.js"></script>
    <script src="javascript/checkCookie.js" type="text/javascript"></script>
    <script src="javascript/deleteUser.js" type="text/javascript"></script>
    <script src="javascript/OnlineUsers.js" type="text/javascript"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script>

        function napisz(){
            alert("Wychodzisz :(");
        }
    </script>
</head>

<body onunload="napisz();">
<div class="container">

    <div class="chatUser">
        <h1><?php echo "Wiadomość prywatna do:  ".$user_message ?></h1>
    </div>

    <div class="chatMessage" id="chatMessage">
    </div>


    <div class="chatUserL">


    </div>
    <div style="clear: both;"></div>

    <div class="chatSubmit">
        <form action="#" onsubmit="return false" method="post" id="chatForm">
            <input type="hidden" name="user" id="user" value="<?php echo $user?>">
            <input type="hidden" name="user" id="do" value="<?php echo $_GET['user']; ?>">
            <input type="text" name="message" placeholder="Napisz wiadomość..." value="" id="message">
            <input type="submit" name="submit_priv" value="Wyślij" id="button">
        </form>
    </div>

</div>

</body>

</html>
<?php }
else {
    header("Location: login.php");
}
?>