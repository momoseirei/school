<?php
require_once __DIR__."/mail.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
  $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
  $sex = filter_input(INPUT_POST, "sex", FILTER_SANITIZE_SPECIAL_CHARS);
  $date = filter_input(INPUT_POST, "date", FILTER_SANITIZE_SPECIAL_CHARS);

  $send_mail_user = send_mail_user($username, $email, $sex, $date);
  $send_mail_management = send_mail_management($username, $email, $sex, $date);

  if ($send_mail_user !== true || $send_mail_management !== true) header("Location: error.php");
  else header("Location: comp.php");
}

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <link href="/bootstrap.min.css" rel="stylesheet">
    <link href="/main.css" rel="stylesheet">
  </head>
  <body>
    <div class="form-ttl mt-5 mb-5 text-center">
      <h2>申し込みフォーム</h2>
    </div>
    <form action="/index.php" method="POST">
      <div class="form-wrap">
        <table>
          <tbody>
            <tr>
              <th><label for="username"><span class="text-danger">*</span>お名前</label></th>
              <td><input type="text" id="username" name="username" class="form-control" required></td>
            </tr>
            <tr>
              <th><label for="email"><span class="text-danger">*</span>メールアドレス</label></th>
              <td><input type="email" id="email" name="email" class="form-control" required></td>
            </tr>
            <tr>
              <th>性別</th>
              <td class="d-flex">
                <input type="radio" name="sex" id="sex" value="男">男
                <input type="radio" name="sex" id="sex" value="女">女
                <input type="radio" name="sex" id="sex" value="その他" checked>その他
              </td>
            </tr>
            <tr>
              <th><label for="date">お申し込み日程</label></th>
              <td>
                <select name="date" id="date" class="form-control">
                  <?php for ($i=7; $i<13; $i++) { ?>
                    <?php if ($i < 10) $i = "0".$i ?>
                    <option value="2020-06-<?= $i; ?>">2020-06-<?= $i; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="modal-open-btn text-center mt-5">
          <p class="modal-open btn btn-primary">内容確認</p>
        </div>
      </div>

      <div class="modal-content">
        <p>以下の内容で送信してもよろしいでしょうか？</p>
        <table class="modal-table">
          <tbody>
            <tr>
              <th>お名前</th>
              <td id="modal_username"></td>
            </tr>
            <tr>
              <th>メールアドレス</th>
              <td id="modal_email"></td>
            </tr>
            <tr>
              <th>性別</th>
              <td id="modal_sex"></td>
            </tr>
            <tr>
              <th>お申し込み日程</th>
              <td id="modal_date"></td>
            </tr>
          </tbody>
        </table>
        <div class="submit-btn d-flex justify-content-around">
          <button class="modal-close btn btn-secondary">キャンセル</button>
          <input type="submit" class="btn btn-primary" value="送信">
        </div>
      </div>

    </form>
  </body>
  <script type="text/javascript" src="/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="/main.js"></script>
</html>