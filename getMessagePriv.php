<?php
/**
 * Created by PhpStorm.
 * User: s.manczak
 * Date: 07.03.2017
 * Time: 12:06
 */
session_start();
require_once ('config/config.php');

$od = htmlspecialchars($_COOKIE['login']);
$do = htmlspecialchars($_POST['login_do']);

Connection_Database($config,$od,$do);


function Connection_Database($config,$od,$do)
{
    $licznik = 0;

    $dns = sprintf("mysql:host=%s;dbname=%s;port=%s", $config['host'], $config['dbname'], $config['port']);

    @$pdo = new PDO($dns, $config['username'], $config['password']);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = 'SELECT * FROM priv_message WHERE od=:od AND do=:do OR od=:do AND do=:od';

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':od',$od,PDO::PARAM_STR);
    $stmt->bindValue(':do',$do,PDO::PARAM_STR);

    $result = $stmt->execute();

    $count = $stmt->rowCount();
    if ($result !== false) {
        while ($row = $stmt->fetch()) {
            $id = $row['id'];
            $od = $row['od'];
            $do = $row['do'];
            $message = $row['message'];

            echo '<li class="msg" id="' . $id . '" ss="' . $licznik . '"><p>' . $od . '</p><b> ' . $do . ': ' . ' </b>' . $message . '</li>';
            $licznik++;
        }
    }

    $stmt->closeCursor();
    unset($stmt);
    $pdo=null;

}

