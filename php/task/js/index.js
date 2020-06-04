$(function() {
  
  $("#submit").on("click", function() {
    const data = {
      "task_name": $("#task_name").val(),
      "delivery": $("#delivery").val(),
    };
    $.ajax({ type: "POST", url: "/index.php", json: true, data: data, })
    .done((res)=> {
      if (res.success === true) {
        alert("タスクを登録しました");
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

  $(".done").on("click", function() {
    const data = {
      "taskid": $(this).data("taskid"),
    };
    $.ajax({ type: "POST", url: "/func/task_done.php", json: true, data: data, })
    .done((res)=> {
      if (res.success === true) {
        alert("タスクを完了しました");
        location.reload();
      } else {
        alert(res.msg);
      }
    })
    .fail((XMLHttpRequest, textStatus, errorThrown)=> {
      alert("Error : " + errorThrown);
    });
    return false;
  });

})