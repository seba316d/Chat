<?php
/**
 * Created by PhpStorm.
 * User: s.manczak
 * Date: 06.03.2017
 * Time: 14:02
 */

/*
$time1 = "2017-03-06 13:55:50";
$time_now = date('Y-m-d H:i:s',strtotime("now"));
$wynik =  floor((strtotime($time_now) - strtotime($time1))/3600)  ;
$wynik .= floor(((strtotime($time_now) - strtotime($time1))/60) % 60);
echo $wynik;
*/

require_once ('config/config.php');

if(Delete_User($config)>0){
    echo "Baza odświeżona - usunięto uzytkowników";
}
else{
    echo "Baza odświeżona - nie ma co usuwać";
}

function Delete_User($config)
{

    $dns = sprintf("mysql:host=%s;dbname=%s;port=%s", $config['host'], $config['dbname'], $config['port']);

    @$pdo = new PDO($dns, $config['username'], $config['password']);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = 'DELETE FROM `users` WHERE time_status < NOW() - INTERVAL 5 minute';

    $stmt = $pdo->prepare($query);

    $stmt->execute();
    $count = $stmt->rowCount();

    return $count;

    $stmt->closeCursor();
    unset($stmt);
    $pdo = null;

}
