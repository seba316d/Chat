<?php
/**
 * Created by PhpStorm.
 * User: s.manczak
 * Date: 06.03.2017
 * Time: 15:03
 */
require_once ('config/config.php');

onlineUsers($config);

function onlineUsers($config){

    $dns = sprintf("mysql:host=%s;dbname=%s;port=%s", $config['host'], $config['dbname'], $config['port']);

    @$pdo = new PDO($dns, $config['username'], $config['password']);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = 'SELECT * FROM users';

    $stmt = $pdo->prepare($query);

    $stmt->execute();
echo '<p> Użytkownicy Online</p>';
    while ($row = $stmt->fetch()){

        $user = $row['users'];
        if(@$_COOKIE['login']==$user){  // tutaj blokuje wyświetlanie się samego siebie
           // echo '<li id="'.$_COOKIE['login'].'" onclick="user_priv_message(this.id)">Ja</li>';
        }
        else{

           // echo '<li id=".$user"><a href="priv.php?user='.$user.'" target="_blank">'.$user.'</li>';
            echo '<li  id="'.$user.'" class="lst_online" onclick="user_priv_message(this.id);onLoad_priv(this.id)">'.$user.'</li>';
        }

    }

    $stmt->closeCursor();
    unset($stmt);
    $pdo=null;
}