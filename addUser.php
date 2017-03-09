<?php
/**
 * Created by PhpStorm.
 * User: s.manczak
 * Date: 03.03.2017
 * Time: 14:23
 */

require_once ('config/config.php');
require_once ('users.php');

@$user = $_POST['login']; // Pobieranie użytkownika
$addUser = new AddUsers($user,$config); //Utworzenie instacji addUser
$status = "Offline"; //ustawienie statusu domyślnie na offline

if(isset($user)){
    $status = "Online";
}

//Sprawdzanie czy użytkownik istenieje

if(CheckUser_ajax($user,$config)>0){
    Response(100,"Uzytkownik juz istenieje");
}
else{
    $addUser->AddUser($status);
    Response(101,"Pomyslnie dosałeś się na czat");
}

function CheckUser_ajax($user,$config){

    $dns = sprintf("mysql:host=%s;dbname=%s;port=%s", $config['host'], $config['dbname'], $config['port']);
    @$pdo = new PDO($dns, $config['username'], $config['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = ' SELECT users FROM users WHERE users=:users ';

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':users',$user ,PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->rowCount();

    $stmt->closeCursor();
    unset($stmt);
    $pdo=null;


    return $count;
}

function Response($error_code,$message){
    header('Content-Type: application/json');
    echo json_encode(
        array(
            'response'=>$message,
            'error_code'=>$error_code
        ),JSON_FORCE_OBJECT);
    exit();
}

