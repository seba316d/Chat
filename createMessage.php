<?php
/**
 * Created by PhpStorm.
 * User: s.manczak
 * Date: 13.03.2017
 * Time: 14:45
 */

// Ta funkcja odpowiada za utworzenie małego okienka na stronie index.php która pozwala rozmiawiać coś jak na facebook

$user = htmlspecialchars($_POST['login']); //pobierania z js "user_priv_message" loginu uzytkownika - czyli do kogo
$count = $_POST['count'];
CreateDiv($user,$count);

function CreateDiv($user,$count){
if($count==0) {
    echo '
        <div class="user_message user_message_'.$user.'" id="user_message" onload="return user_priv_submit()">
        <span onclick="user_close()">Zamknij</span>
            <div class="user_login">
            <p >' . $user . '</p>
            </div>
            <div class="user_contents">
            </div>
            <div class="user_sending">
                 <form method="post" id="chatForm_priv">
                    <input type="hidden" name="user" id="user" value="<?php echo $_COOKIE[\'login\'] ?>">
                    <input type="hidden" name="user" id="do" value="'.$user.'">
                    <input type="text" name="message" placeholder="Napisz wiadomość..." value="" id="message_priv">
                    <input type="submit_priv" name="submit_priv" value="Wyślij" id="button" onClick="return user_priv_submit()">
                </form>
            </div>
        
        </div>
    
    ';
}
}

?>