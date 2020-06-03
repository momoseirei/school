<?php
require_once __DIR__."/func/db.php";
$conf = include(__DIR__."/config/conf.php");

if (!isset($_SESSION)) {
  @session_start();
}

$fetch_post_contents = fetch_post_contents($conf);

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header('Content-Type: application/json; charset=utf-8');
    $ret = ["success" => false, "msg" => ""];

    $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_SPECIAL_CHARS);
    $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_SPECIAL_CHARS);
    $contributor = $_SESSION["username"];
    $contributor_id = $_SESSION["userid"];

    if (empty($title) || empty($content)) {
      $ret["msg"] = "入力項目が不足しています";
      echo json_encode($ret, JSON_UNESCAPED_UNICODE);
      return;
    }

    $insert_post_content = insert_post_content($conf, $title, $contributor, $contributor_id, $content);
    if ($insert_post_content !== true) {
      $ret["msg"] = "投稿に失敗しました";
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
        <p>掲示板</p>
      </div>
      <?php if (!isset($_SESSION["username"])) { ?>
        <div class="signin">
          <a href="/login.php">Sign in</a>
        </div>
      <?php } else { ?>
        <div class="text-center">
          <p>ようこそ! <?= $_SESSION["username"]; ?> さん</p>
          <a href="/func/logout.php" class="btn btn-secondary">ログアウト</a>
        </div>
      <?php } ?>
    </header>

    <?php if (isset($_SESSION["username"])) { ?>
      <div class="post-msg">
        <form action="" method="">
          <p>タイトル</p>
          <input type="text" id="title" class="form-control">
          <p class="mt-3">内容</p>
          <textarea id="content" class="form-control" rows="2"></textarea>
          <input type="submit" id="submit" value="投稿">
          <span class="text-success"></span>
          <span class="text-danger"></span>
        </form>
      </div>
    <?php } ?>

    <div class="main-contents <?php if (!isset($_SESSION["username"])) echo "unlogined"; ?>">
      <?php foreach ($fetch_post_contents as $post) { ?>
        <?php 
        $mypost = false;
        if ($post["contributor"] === $_SESSION["username"]) {
          $mypost = true; 
        } 
        ?>
        <div class="post-content <?php if ($mypost === true) echo "mypost"; ?>">
          <div class="post-ttl d-flex justify-content-between">
            <p><?= $post["title"]; ?></p>
            <p><?= $post["created_at"]; ?></p>
          </div>
          <div class="post-username">
            <p>投稿者: <?= $post["contributor"]; ?></p>
          </div>
          <div class="post-text">
            <p><?= $post["content"]; ?></p>
          </div>
          <?php if ($mypost === true) { ?>
            <div class="delete-btn">
              <form action="" method="">
                <input type="hidden" id="post_id" value="<?= $post["id"] ?>">
                <input type="submit" id="submit-delete" class="btn btn-danger" value="削除">
              </form>
            </div>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
  </body>
  <script type="text/javascript" src="/js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="/js/index.js"></script>
</html>