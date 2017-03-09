<?php
/**
 * Created by PhpStorm.
 * User: s.manczak
 * Date: 03.03.2017
 * Time: 12:12
 */

//require_once ('config/config.php');

/*
$status = "Offline";
$user = $_COOKIE['login'];

if(isset($_COOKIE['login'])){

    $status = "Online";
    $addUser = new AddUsers($user,$config);

    if($addUser->CheckUser()>0){

        $addUser->UpdateUser($status);
    }
    else{
        $addUser->AddUser($status);
    }
}
else{

}
*/



class AddUsers{

    private $user;
    private $config;

    function __construct($user,$config)
    {
        $this->user=$user;
        $this->config = $config;
    }

    function AddUser($status){

        $time = date('Y-m-d H:i:s',strtotime("now"));
        $message = "";

        $dns = sprintf("mysql:host=%s;dbname=%s;port=%s", $this->config['host'], $this->config['dbname'], $this->config['port']);
        @$pdo = new PDO($dns, $this->config['username'], $this->config['password']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = 'INSERT INTO users(users,time_status,status,message) VALUES (:users,:time_status,:status,:message)';

        $stmt = $pdo->prepare($query);

        $stmt->bindValue(':users',$this->user,PDO::PARAM_STR);
        $stmt->bindValue(':time_status',$time,PDO::PARAM_STR);
        $stmt->bindValue(':status',$status,PDO::PARAM_STR);
        $stmt->bindValue(':message',$message,PDO::PARAM_STR);

        $stmt->execute();

        $stmt->closeCursor();
        unset($stmt);
        $pdo=null;

    }

    function CheckUser(){

        $dns = sprintf("mysql:host=%s;dbname=%s;port=%s", $this->config['host'], $this->config['dbname'], $this->config['port']);
        @$pdo = new PDO($dns, $this->config['username'], $this->config['password']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = ' SELECT users FROM users WHERE users=:users ';

        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':users',$this->user,PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();

        $stmt->closeCursor();
        unset($stmt);
        $pdo=null;


        return $count;
    }


    function UpdateUser(){
        $status = "Online";
        $time = date('Y-m-d H:i:s',strtotime("now"));
        $dns = sprintf("mysql:host=%s;dbname=%s;port=%s", $this->config['host'], $this->config['dbname'], $this->config['port']);
        @$pdo = new PDO($dns, $this->config['username'], $this->config['password']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = 'UPDATE users SET status=:status, time_status=:time_e WHERE users=:users';

        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':status',$status,PDO::PARAM_STR);
        $stmt->bindValue(':users',$this->user,PDO::PARAM_STR);
        $stmt->bindValue(':time_e',$time,PDO::PARAM_STR);
        $stmt->execute();

        $stmt->closeCursor();
        unset($stmt);
        $pdo=null;

    }

    function Delete_User_Name(){

        $dns = sprintf("mysql:host=%s;dbname=%s;port=%s", $this->config['host'], $this->config['dbname'], $this->config['port']);
        @$pdo = new PDO($dns, $this->config['username'], $this->config['password']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = 'DELETE FROM users WHERE users=:users';

        $stmt= $pdo->prepare($query);

        $stmt->bindValue(':users',$this->user,PDO::PARAM_STR);

        $stmt->execute();

        $stmt->closeCursor();
        unset($stmt);
        $pdo=null;

    }

}