<?php
require_once __DIR__."/db.php";
$conf = include(__DIR__."/../config/conf.php");

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header('Content-Type: application/json; charset=utf-8');
    $ret = ["success" => false, "msg" => ""];

    $task_id = filter_input(INPUT_POST, "taskid", FILTER_SANITIZE_NUMBER_INT);

    if (empty($task_id)) {
      $ret["msg"] = "不正なリクエストです";
      echo json_encode($ret, JSON_UNESCAPED_UNICODE);
      return;
    }

    $update_task_state = update_task_state($conf, $task_id);
    if ($update_task_state !== true) {
      $ret["msg"] = "完了処理に失敗しました";
      echo json_encode($ret, JSON_UNESCAPED_UNICODE);
      return;
    }
    $ret["success"] = true;
    echo json_encode($ret, JSON_UNESCAPED_UNICODE);
    return;
  }
}