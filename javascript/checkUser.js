/**
 * Created by s.manczak on 06.03.2017.
 */
function checkUser(){
    var login = document.getElementById('user').value; // Pobieranie nazwy usera
    var dataString_add = "login="+login;

    $.ajax({
        type:"post",
        url: "addUser.php",
        dataType: 'json',
        data: dataString_add,
        cache: false,
        success: function (data) {

            // alert(data['error_code']);

            if(data['error_code']==100){
                $("p").text(data['response']);
                var now = new Date();
                now.setTime(now.getTime() + (5*60*1000));
                alert(now);
            }
            if(data['error_code']==101){
                var now = new Date();
                now.setTime(now.getTime() + (5*60*1000)); // ustawienie czasu zycia cookie
                document.cookie = 'login=' + login + ';expires=' + now ;
                alert(data['response']);
                location.reload(); // przeładowanie strony
            }

        }
    });
    return false;
}