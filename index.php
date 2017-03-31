<?php
/**
 * Created by PhpStorm.
 * User: s.manczak
 * Date: 02.03.2017
 * Time: 14:00
 */
session_start();

$user = $_COOKIE['login'];

if(!isset($user) && !isset($_COOKIE['login'])){
    header("Location: login.php");
}
elseif(isset($_COOKIE['login'])){
    $user = $_COOKIE['login'];
    $_SESSION['user'] = $user;
}
if(isset($user)){
    setcookie("login","$user",time()+300);
?>


<!DOCTYPE html>
<html>

<head>
   <title>CHAT v1.0.1</title>
    <script src="http://ts3-tnt.pl/script/jquery-3.1.1.min.js"></script>
    <script src="javascript/script.js" type="text/javascript"></script>
    <script src="javascript/deleteUser.js" type="text/javascript"></script>
    <script src="javascript/OnlineUsers.js" type="text/javascript"></script>
    <script src="javascript/checkCookie.js" type="text/javascript"></script>
    <script src="javascript/user_priv_message.js" type="text/javascript"></script>
    <script src="javascript/user_priv_submit.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script>
        function show_user(){
            document.getElementById("chatUserL").style.display = "inline-block";
            document.getElementById("close").style.display = "block";
           // alert("LALA");
        }

        function hide_user() {
            document.getElementById("chatUserL").style.display = "none";
            document.getElementById("close").style.display = "none";
        }

         x = document.getElementById('geolocation');

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = 'Geolocation is not supported by this browser.';
            }
        }

        function showPosition(position) {
            var latLon = position.coords.latitude + ',' + position.coords.longitude,
                imgUrl = 'http://maps.googleapis.com/maps/api/staticmap?center='+latLon+'&zoom=14&size=400x300&sensor=true';
            console.log(latLon);

            document.getElementById('geolocation').innerHTML = '<img src="' + imgUrl + '" />';
        }

        getLocation();

    </script>

</head>

<body>
<div id="geolocation"></div>
    <div class="container">

        <div class="chatUser">
            <h1><?php echo "Witaj ".$user ?></h1>
        </div>
        <div class="user_online"><span onclick="show_user();">Online</span></div>

        <div class="chatMessage" id="chatMessage">
        </div>


        <div class="chatUserL" id="chatUserL">
            <p >Użytkownicy Online</p>
        </div>
        <span class="close" id="close" onclick="hide_user()">X</span>
        <div style="clear: both;"></div>

        <div class="chatSubmit">
            <form action="#" onsubmit="return false" method="post" id="chatForm">
                <input type="hidden" name="user" id="user" value="<?php echo $user?>">
                <input type="text" name="message" placeholder="Napisz wiadomość..." value="" id="message">
                <input type="submit" name="submit" value="Wyślij" id="button">
            </form>
        </div>

    </div>

    <div class="user_message_container" id="user_message_container">

    </div>



</body>

</html>
 <?php }
 else {
    header("Location: login.php");
 }?>
