/**
 * Created by s.manczak on 28.03.2017.
 */
function user_priv_submit() {

    /**
     * Created by s.manczak on 07.03.2017.
     */
    var login = document.getElementById("user").value; // Pobieranie nazwy usera z ukrytego inputa tak zwane OD
    var login_do = document.getElementById("do").value; // Pobieranie nazwy usera z ukrytego inputa tak zwane DO
    var message = document.getElementById("message_priv").value; // Pobieranie całej wiadomości
    var submit = document.getElementById("button").value; // Pobieranie wartosci "Czy wysłano"

    var dataString = "login=" + login + "&message=" + message + "&login_do=" + login_do + "&submit_priv=" + submit; //Sklejanie powyżyszych stringów w jeden

    $.ajax({
        type: "post",
        url: "chatPoster.php",
        //dataType: "json",
        data: dataString,
        success: function (data) {

            $(".user_contents").append(data);
            document.getElementById("message_priv").value = "";
            $(".user_contents").scrollTop($(".user_contents")[0].scrollHeight);

        }

    });


    function priv_getMessage() {
        $.ajax({
            type: "post",
            url: "getMessagePriv.php",
            cache: false,
            data: dataString,
            success: function (data) {
                var count1 = $(".user_contents li:last-child").attr('ss');
                $(".user_contents").attr(data);
                $(".user_contents").html(data);
                var count = data.split('<li').length - 2;
                array = [count, count1];
                $(".user_contents").scrollTop($(".user_contents")[0].scrollHeight);

            }
        });

        return array;
    }

    setInterval(function () {

        var num = priv_getMessage();
        // alert(num);
        //console.log(num);
        if (!num[1]) {
            $(".user_contents").scrollTop($(".user_contents")[0].scrollHeight);
        }
        if (num[0] > num[1]) {
            $(".user_contents").scrollTop($(".user_contents")[0].scrollHeight);
        }

    }, 1000);

}

function onLoad_priv(id){
    var login = document.getElementById("user").value; // Pobieranie nazwy usera z ukrytego inputa tak zwane OD
    var login_do = id; // Pobieranie nazwy usera z ukrytego inputa tak zwane DO
    //var message = document.getElementById("message_priv").value; // Pobieranie całej wiadomości
    var submit = document.getElementById("button").value; // Pobieranie wartosci "Czy wysłano"

    var dataString = "login=" + login + "&message=" + message + "&login_do=" + login_do + "&submit_priv=" + submit; //Sklejanie powyżyszych stringów w jeden


    function priv_getMessage() {
        $.ajax({
            type: "post",
            url: "getMessagePriv.php",
            cache: false,
            data: dataString,
            success: function (data) {
                var count1 = $(".user_contents li:last-child").attr('ss');
                $(".user_contents").attr(data);
                $(".user_contents").html(data);
                var count = data.split('<li').length - 2;
                array = [count, count1];
                $(".user_contents").scrollTop($(".user_contents")[0].scrollHeight);

            }
        });

        return array;
    }
    setInterval(function () {
        var num = priv_getMessage();
        },1000)

}