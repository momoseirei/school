<?php
require_once __DIR__."/func/db.php";
$conf = include(__DIR__."/config/conf.php");

if (!isset($_SESSION)) {
  @session_start();
}

$fetch_tasks = fetch_tasks($conf);

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header('Content-Type: application/json; charset=utf-8');
    $ret = ["success" => false, "msg" => ""];

    $task_name = filter_input(INPUT_POST, "task_name", FILTER_SANITIZE_SPECIAL_CHARS);
    $delivery = filter_input(INPUT_POST, "delivery", FILTER_SANITIZE_SPECIAL_CHARS);
    $user_id = $_SESSION["userid"];

    if (empty($task_name) || empty($delivery)) {
      $ret["msg"] = "入力項目が不足しています";
      echo json_encode($ret, JSON_UNESCAPED_UNICODE);
      return;
    }

    $insert_task = insert_task($conf, $task_name, $delivery, $user_id);
    if ($insert_task !== true) {
      $ret["msg"] = "登録に失敗しました";
      echo json_encode($ret, JSON_UNESCAPED_UNICODE);
      return;
    }
    $ret["success"] = true;
    echo json_encode($ret, JSON_UNESCAPED_UNICODE);
    return;
  }
}

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </head>
  <body>
  
    <header class="d-flex justify-content-between p-3 align-items-center">
      <div class="header-ttl">
        <p>社内タスク管理表</p>
      </div>
      <?php if (!isset($_SESSION["username"])) { ?>
        <div class="signin">
          <a href="/login.php">Sign in</a>
        </div>
      <?php } else { ?>
        <div class="text-center">
          <p>ログイン中: <?= $_SESSION["username"]; ?></p>
          <a href="/func/logout.php" class="btn btn-secondary">ログアウト</a>
        </div>
      <?php } ?>
    </header>

    <?php if (isset($_SESSION["username"])) { ?>
      <div class="post-msg">
        <form action="" method="">
          <p>タスク</p>
          <input type="text" id="task_name" class="form-control">
          <p class="mt-3">完了予定日</p>
          <input type="date" id="delivery" class="form-control" min="<?= date("Y-m-d"); ?>" value="<?= date("Y-m-d"); ?>">
          <input type="submit" id="submit" value="投稿">
          <span class="text-success"></span>
          <span class="text-danger"></span>
        </form>
      </div>
    <?php } ?>
    
    <div class="show-tasks <?php if (!isset($_SESSION["username"])) echo "unlogined"; ?>">
      <table>
        <thead>
          <tr>
            <th width="60%">タスク名</th>
            <th width="15%">担当者</th>
            <th width="15%">完了予定日</th>
            <th width="10%" class="text-center">完了</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($fetch_tasks as $task) { ?>
            <tr>
              <td><?= $task["task_name"]; ?></td>
              <td><?= $task["username"]; ?></td>
              <td><?= $task["delivery"]; ?></td>
              <td class="text-center"><i class="fas fa-check-circle done" data-taskid="<?= $task["id"]; ?>"></i></td>
            </tr>
          <? } ?>
        </tbody>
      </table>
    </div>
    
  </body>
  <script type="text/javascript" src="/js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="/js/index.js"></script>
</html>