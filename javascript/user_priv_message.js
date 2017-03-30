/**
 * Created by s.manczak on 13.03.2017.
 */

var count = 0;


function user_priv_message(id) {
    //var isset_chat = document.getElementsByClassName("user_message_"+id);
    var isset_chat = document.getElementById("user_message_"+id);
    //alert(isset_chat);
    if (isset_chat != null) {
        document.getElementById("user_message_"+id).style.display = "inline-block";
        //  for (var i =0; i<isset_chat.length; i++){
        //     isset_chat[i].style.display='block';

    }
    else if (isset_chat==null){

        var user = id;
        var dataString = "login=" + user + "&count=" + count;
        // alert(count);
        $.ajax({
            type: "post",
            url: "createMessage.php",
            data: dataString,
            success: function (data) {
                console.log(data);

                $(".user_message_container").append(data);

            }

        })
        //count++;
    }
}

function user_close(id){
   // var isset_chat = document.getElementsByClassName("user_message_"+id);
    document.getElementById("user_message_"+id).style.display = "none";
    //for (var i =0; i<isset_chat.length; i++){
    //    isset_chat[i].style.display='none';
   // }
    count = 0;
}