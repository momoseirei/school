<?php
require_once __DIR__."/db.php";
$conf = include(__DIR__."/../config/conf.php");

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header('Content-Type: application/json; charset=utf-8');
    $ret = ["success" => false, "msg" => ""];

    $post_id = filter_input(INPUT_POST, "post_id", FILTER_SANITIZE_NUMBER_INT);

    if (empty($post_id)) {
      $ret["msg"] = "不正なリクエストです";
      echo json_encode($ret, JSON_UNESCAPED_UNICODE);
      return;
    }

    $delete_post = delete_post($conf, $post_id);
    if ($delete_post !== true) {
      $ret["msg"] = "削除に失敗しました";
      echo json_encode($ret, JSON_UNESCAPED_UNICODE);
      return;
    }
    $ret["success"] = true;
    echo json_encode($ret, JSON_UNESCAPED_UNICODE);
    return;
  }
}