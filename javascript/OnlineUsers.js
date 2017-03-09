/**
 * Created by s.manczak on 06.03.2017.
 */
function OnlineUsers(){

    $.ajax({
        type:"post",
        url: "onlineUsers.php",
        cache: false,
        success: function (data) {
            //console.log(data);
            // alert(data);
            $(".chatUserL").html(data);
        }
    });
}

setInterval(function(){

    var delete_user = OnlineUsers();

},1000);
