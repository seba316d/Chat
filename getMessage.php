<?php
/**
 * Created by PhpStorm.
 * User: s.manczak
 * Date: 02.03.2017
 * Time: 14:00
 */

require_once ('config/config.php');


Connection_Database($config);

function Connection_Database($config)
{
    $licznik = 0;

    $dns = sprintf("mysql:host=%s;dbname=%s;port=%s", $config['host'], $config['dbname'], $config['port']);

    @$pdo = new PDO($dns, $config['username'], $config['password']);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = 'SELECT * FROM message';

    $stmt = $pdo->prepare($query);

    $result = $stmt->execute();
    $count = $stmt->rowCount();
    if ($result !== false) {
        while ($row = $stmt->fetch()) {
            $time = $row['time'];
            $user = $row['user'];
            $message = $row['message'];
            $id = $row['id'];

            echo '<li class="msg" id="' . $id . '" ss="' . $licznik . '"><p>' . $time . '</p><b> ' . $user . ': ' . ' </b>' . $message . '</li>';
            $licznik++;
        }
    }

    $stmt->closeCursor();
    unset($stmt);
    $pdo=null;

}

