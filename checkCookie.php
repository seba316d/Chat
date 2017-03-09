<?php
/**
 * Created by PhpStorm.
 * User: s.manczak
 * Date: 07.03.2017
 * Time: 08:43
 */
session_start();

require_once ('users.php');
require_once ('config/config.php');

$user = $_COOKIE['login'];


if(isset($user) || isset($_COOKIE['login'])){
    $update_user = new AddUsers($user,$config);
    $update_user->UpdateUser();
    echo "OK";
}
else{
    $delete_user = new AddUsers($_SESSION['user'],$config);
    $delete_user->Delete_User_Name();
    echo "Błąd";
    unset($_SESSION['user']);
}