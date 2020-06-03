$(function() {
  
  $("#submit").on("click", function() {
    const data = {
      "title": $("#title").val(),
      "content": $("#content").val(),
    };
    $.ajax({ type: "POST", url: "/index.php", json: true, data: data, })
    .done((res)=> {
      if (res.success === true) {
        alert("投稿しました");
        location.reload();
      } else {
        $(".text-danger").text(res.msg);
      }
    })
    .fail((XMLHttpRequest, textStatus, errorThrown)=> {
      alert("Error : " + errorThrown);
    });
    return false;
  });
  
  $("#submit-delete").on("click", function() {
    const data = {
      "post_id": $("#post_id").val(),
    };
    $.ajax({ type: "POST", url: "/func/delete_post.php", json: true, data: data, })
    .done((res)=> {
      if (res.success === true) {
        alert("削除しました");
        setTimeout(function(){ window.location.href="/index.php" });
      } else {
        alert("削除に失敗しました");
      }
    })
    .fail((XMLHttpRequest, textStatus, errorThrown)=> {
      alert("Error : " + errorThrown);
    });
    return false;
  });

})