<?php
require_once __DIR__."/func/auth.php";
require_once __DIR__."/func/db.php";
$conf = include(__DIR__."/config/conf.php");

if (!isset($_SESSION)) {
  @session_start();
}

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header('Content-Type: application/json; charset=utf-8');
    $ret = ["success" => false, "msg" => ""];

    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    $token = filter_input(INPUT_POST, "token", FILTER_SANITIZE_SPECIAL_CHARS);
    
    $user_password = serch_user_for_login($conf, $username);
    if (!$user_password["password"]) {
      $ret["msg"] = "このユーザー名では登録がありません";
      echo json_encode($ret, JSON_UNESCAPED_UNICODE);
      return;
    }
    
    if (validate_token($token) && password_verify($password, $user_password["password"])) {
      session_regenerate_id(true);
      $_SESSION['userid'] = $user_password["id"];
      $_SESSION['username'] = $username;
      $ret["success"] = true;
      echo json_encode($ret, JSON_UNESCAPED_UNICODE);
      return;
    } else {
      $ret["msg"] = "パスワードが違います";
      echo json_encode($ret, JSON_UNESCAPED_UNICODE);
      return;
    }
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
    <div class="form-wrap">
      <div class="login-ttl text-center">
        <p>掲示板ログイン</p>
      </div>
      <form action="" method="">
        <table>
          <tbody>
            <tr>
              <th><label for="username">ログインユーザー</label></th>
              <td><input type="text" id="username" class="form-control"></td>
            </tr>
            <tr>
              <th><label for="password">パスワード</label></th>
              <td>
                <input type="password" id="password" class="form-control">
                <input type="hidden" id="token" value="<?= h(generate_token()); ?>">
              </td>
            </tr>
          </tbody>
        </table>
        <div class="submit-btn text-center">
          <input type="submit" id="submit" value="ログイン">
          <span class="text-success"></span>
          <span class="text-danger"></span>
        </div>
      </form>
    </div>
  </body>
  <script type="text/javascript" src="/js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="/js/login.js"></script>
</html>