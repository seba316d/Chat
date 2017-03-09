/**
 * Created by s.manczak on 07.03.2017.
 */
var priv_message;
$(document).ready(function() {
    $(document).on('submit','#chatForm',function () {

        var login = document.getElementById("user").value; // Pobieranie nazwy usera z ukrytego inputa tak zwane OD
        var login_do = document.getElementById("do").value; // Pobieranie nazwy usera z ukrytego inputa tak zwane DO
        var message = document.getElementById("message").value; // Pobieranie całej wiadomości
        var submit = document.getElementById("button").value; // Pobieranie wartosci "Czy wysłano"

        var dataString = "login="+login+"&message="+message + "&login_do="+login_do + "&submit_priv="+ submit; //Sklejanie powyżyszych stringów w jeden
        priv_message = dataString;
        //alert(dataString);
        $.ajax({
            type:"post",
            url: "chatPoster.php",
            //dataType: "json",
            data: dataString,
            success: function (data) {

                $(".chatMessage").append(data);
                document.getElementById("message").value = "";
                $(".chatMessage").scrollTop($(".chatMessage")[0].scrollHeight);

            }

        })

    })
});


function priv_getMessage(){


    $.ajax({
        type:"post",
        url: "getMessagePriv.php",
        cache: false,
        success: function (data) {
            var count1 = $(".chatMessage li:last-child").attr('ss');
            $(".chatMessage").attr(data);
            $(".chatMessage").html(data);
            var count = data.split('<li').length-2;
            array = [count,count1];


        }
    });

    return array;
}

setInterval(function(){

    var num = priv_getMessage();
    // alert(num);
    //console.log(num);
    if(!num[1]){
        $(".chatMessage").scrollTop($(".chatMessage")[0].scrollHeight);
    }
    if(num[0]>num[1]) {
        $(".chatMessage").scrollTop($(".chatMessage")[0].scrollHeight);
    }

},1000);