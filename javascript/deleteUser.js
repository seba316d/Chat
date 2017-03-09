function deleteUser(){

    $.ajax({
        type:"post",
        url: "deleteUser.php",
        cache: false,
        success: function (data) {
           // console.log(data);
           // alert(data);
        }
    });
}

setInterval(function(){

var delete_user = deleteUser();

},10000);