/**
 * Created by s.manczak on 28.03.2017.
 */
function user_priv_submit(id) {

    /**
     * Created by s.manczak on 07.03.2017.
     */
    var login = document.getElementById("user").value; // Pobieranie nazwy usera z ukrytego inputa tak zwane OD
    var login_do = id; //document.getElementById("do").value; // Pobieranie nazwy usera z ukrytego inputa tak zwane DO
    var message = document.getElementById("message_priv_"+id).value; // Pobieranie całej wiadomości
    var submit = document.getElementById("button").value; // Pobieranie wartosci "Czy wysłano"

    var dataString = "login=" + login + "&message=" + message + "&login_do=" + login_do + "&submit_priv=" + submit; //Sklejanie powyżyszych stringów w jeden
    //alert(dataString);
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

    function getCoordinates() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(alertPosition);
        } else {
            alert('twoja przeglądarka nie wspiera geolokacji...');
        }
    }

    alert(getCoordinates());


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
                //console.log("Count priv: "+ count_priv + " count_priv1: "+ count1_priv+" ID dla tego: "+id);
                array_priv = [count_priv,count1_priv,id];
            }
        });

        return array_priv;
    }


    setInterval(function () {


        var num_priv = priv_getMessagee(id);
        if (!num_priv[1]) {

            $(".user_contents_" + num_priv[2]).scrollTop($(".user_contents_" + num_priv[2])[0].scrollHeight);
        }
        if (num_priv[0] > num_priv[1]) {
            $(".user_contents_"+num_priv[2]).scrollTop($(".user_contents_"+num_priv[2])[0].scrollHeight);

        }

    }, 1000);

}
