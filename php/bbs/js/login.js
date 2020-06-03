$(function() {
  
  $("#submit").on("click", function() {
    const data = {
      "username": $("#username").val(),
      "password": $("#password").val(),
      "token": $("#token").val(),
    };
    $.ajax({ type: "POST", url: "/login.php", json: true, data: data, })
    .done((res)=> {
      if (res.success === true) {
        setTimeout(function(){ window.location.href="/index.php" });
      } else {
        $(".text-danger").text(res.msg);
      }
    })
    .fail((XMLHttpRequest, textStatus, errorThrown)=> {
      alert("Error : " + errorThrown);
    });
    return false;
  });

})