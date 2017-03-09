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
            //echo '<li>Ja</li>';
        }
        else{
            echo '<li><a href="priv.php?user='.$user.'" target="_blank">'.$user.'</li>';
        }

    }

    $stmt->closeCursor();
    unset($stmt);
    $pdo=null;
}