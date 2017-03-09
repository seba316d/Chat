/**
 * Created by s.manczak on 07.03.2017.
 */
function checkCookie(){

    $.ajax({
        type:"post",
        url: "checkCookie.php",
        cache: false,
        success: function (data) {
            if(data=='OK'){
               // console.log("OK");
            }
            else {
                alert("Nic nie robiłeś, zostałeś wylogowany");
                location.reload();
            }
        }
    });
}

setInterval(function(){

    var delete_user = checkCookie();

},10000);