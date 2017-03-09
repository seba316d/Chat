<?php
/**
 * Created by PhpStorm.
 * User: s.manczak
 * Date: 02.03.2017
 * Time: 14:00
 */
require_once ('config/config.php');
require_once ('users.php');

if(isset($_POST['submit'])) {
    try {
        $user = htmlspecialchars($_POST['login']);
        $message = htmlspecialchars($_POST['message']);
        $status = "Online";
        $chat = new chatPoster($user, $message); // Tworzenie instancji chatPoster która dodaje wiadomość
        $updateUser = new AddUsers($user,$config); // Nowa instacja AddUser
        $updateUser->UpdateUser(); // Odświeżanie czasu na bazie w tabeli users
        echo $chat->Connection_Database($config);
    }catch (Exception $e){
        echo "Bład z wysyłaniem wiadomości. Prosze o kontakt z administracją";
    }
}
elseif(isset($_POST['submit_priv'])){
    try{
        $od = htmlspecialchars($_POST['login']);
        $do = htmlspecialchars($_POST['login_do']);
        $message = htmlspecialchars($_POST['message']);
        $priv_message = new chatPoster($od,$message);
        $priv_message->Priv_message($do,$config);
        $updateUser = new AddUsers($od,$config); // Nowa instacja AddUser
        $updateUser->UpdateUser(); // Odświeżanie czasu na bazie w tabeli users
    }
    catch (Exception $e){
        echo "Bład z wysyłaniem prywatnej wiadomości. Zgoś się do seby";
    }
}
else{
    echo "Wiadomość nie została wysłana";
}


class chatPoster
{

    private $user;
    private $message;

    public function __construct($user,$message)
    {
        $this->user=$user;
        $this->message=$message;
    }

    public function Connection_Database($config)
    {
        $time = date('H:i:s');

        $dns = sprintf("mysql:host=%s;dbname=%s;port=%s", $config['host'], $config['dbname'], $config['port']);

        @$pdo = new PDO($dns, $config['username'], $config['password']);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = 'INSERT INTO message(user,message,time) VALUES (:user,:message,:time)';

        $stmt = $pdo->prepare($query);

        $stmt->bindValue(':user',$this->user,PDO::PARAM_STR);
        $stmt->bindValue(':message',$this->message,PDO::PARAM_STR);
        $stmt->bindValue(':time',$time,PDO::PARAM_STR);

        $result = $stmt->execute();


        echo '<li class="msg"><p>'.$time.'</p><b> '.$this->user.': '.' </b>'.$this->message.'</li>';

        setcookie("login","$this->user",time()-1);
        setcookie("login","$this->user",time()+300);
        $stmt->closeCursor();
        unset($stmt);
        $pdo=null;
    }

    public function Priv_message ($do,$config)
    {
        $time = date('H:i:s');

        $dns = sprintf("mysql:host=%s;dbname=%s;port=%s", $config['host'], $config['dbname'], $config['port']);

        @$pdo = new PDO($dns, $config['username'], $config['password']);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = 'INSERT INTO priv_message(od,do,message) VALUES (:od,:do,:message)';

        $stmt = $pdo->prepare($query);

        $stmt->bindValue(':od',$this->user,PDO::PARAM_STR);
        $stmt->bindValue(':do',$do,PDO::PARAM_STR);
        $stmt->bindValue(':message',$this->message,PDO::PARAM_STR);

        $result = $stmt->execute();


        echo '<li class="msg" id="' . "1" . '" ss="' . "2" . '"><p>' . $this->user . '</p><b> ' . $do . ': ' . ' </b>' . $this->message . '</li>';

        setcookie("login","$this->user",time()-1);
        setcookie("login","$this->user",time()+300);
        $stmt->closeCursor();
        unset($stmt);
        $pdo=null;
    }



}

