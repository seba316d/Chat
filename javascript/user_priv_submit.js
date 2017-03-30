/**
 * Created by s.manczak on 28.03.2017.
 */
function user_priv_submit(id) {

    /**
     * Created by s.manczak on 07.03.2017.
     */
    var login = document.getElementById("user").value; // Pobieranie nazwy usera z ukrytego inputa tak zwane OD
    var login_do = id//document.getElementById("do").value; // Pobieranie nazwy usera z ukrytego inputa tak zwane DO
    var message = document.getElementById("message_priv_"+id).value; // Pobieranie całej wiadomości
    var submit = document.getElementById("button").value; // Pobieranie wartosci "Czy wysłano"

    var dataString = "login=" + login + "&message=" + message + "&login_do=" + login_do + "&submit_priv=" + submit; //Sklejanie powyżyszych stringów w jeden

    $.ajax({
        type: "post",
        url: "chatPoster.php",
        data: dataString,
        success: function (data) {

            $(".user_contents_"+id).append(data);
            document.getElementById("message_priv_"+id).value = "";
            $(".user_contents_"+id).scrollTop($(".user_contents_"+id)[0].scrollHeight);

        }

    });


    function priv_getMessage(id) {
        $.ajax({
            type: "post",
            url: "getMessagePriv.php",
            cache: false,
            data: dataString,
            success: function (data) {
                var count1_priv = $(".user_contents_"+id+" li:last-child").attr('ss');
                $(".user_contents_"+id).attr(data);
                $(".user_contents_"+id).html(data);
                var count_priv = data.split('<li').length - 2;
                array_sub = [count_priv, count1_priv];

            }
        });

        return array_sub;
    }

}

function onLoad_priv(id){
    var login = document.getElementById("user").value; // Pobieranie nazwy usera z ukrytego inputa tak zwane OD
    var login_do = id; // Pobieranie nazwy usera z ukrytego inputa tak zwane DO
    //var message = document.getElementById("message_priv").value; // Pobieranie całej wiadomości
    var submit = document.getElementById("button").value; // Pobieranie wartosci "Czy wysłano"

    var dataString = "login=" + login + "&message=" + message + "&login_do=" + login_do + "&submit_priv=" + submit; //Sklejanie powyżyszych stringów w jeden


    function priv_getMessagee(id) {
        $.ajax({
            type: "post",
            url: "getMessagePriv.php",
            cache: false,
            data: dataString,
            success: function (data) {
                var count1_priv = $(".user_contents_"+id+" li:last-child").attr('ss');
                $(".user_contents_"+id).attr(data);
                $(".user_contents_"+id).html(data);
                var count_priv = data.split('<li').length - 2;
                array_priv = [count_priv,count1_priv];
                if(count1_priv > count1_priv) {
                    $(".user_contents_" + id).scrollTop($(".user_contents_" + id)[0].scrollHeight);
                }
            }
        });

        return array_priv;
    }
//debugger
    setInterval(function () {

        //debugger

        var num_priv = priv_getMessagee(id);
        if(id=="w3") {
            //alert(num_priv[1]);
            //$(".user_contents_w3").scrollTop($(".user_contents_"+id)[0].scrollHeight);
        }
        if (!num_priv[1]) {
            $(".user_contents_"+id).scrollTop($(".user_contents_"+id)[0].scrollHeight);
        }
        if (num_priv[0] > num_priv[1]) {
            $(".user_contents_"+id).scrollTop($(".user_contents_"+id)[0].scrollHeight);
        }

    }, 1000);

}