<?php
function send_mail($to, $subject, $message) {
    mb_language("Japanese");
    mb_internal_encoding("UTF-8");
    $from = mb_encode_mimeheader('PHP課題[メール送信]', 'iso-2022-jp').'<lazy.walker0701@gmail.com>';
    $from_mail = 'lazy.walker0701@gmail.com';

    $from_name = mb_encode_mimeheader('PHP課題[メール送信]', 'iso-2022-jp');
    $message = $message;
    $headers = '';
    $headers .= 'Content-Type: text/html; charset="ISO-2022-JP"'."\r\n";
    $headers .= "Return-Path: " . $from_mail . " \r\n";
    $headers .= "From: " . $from ." \r\n";
    $headers .= "Sender: " . $from ." \r\n";
    $headers .= "Reply-To: " . $from_mail . " \r\n";
    $headers .= "Organization: " . $from_name . " \r\n";
    $headers .= "X-Sender: " . $from_mail . " \r\n";
    $headers .= "X-Priority: 3 \r\n";

    try {
        return(mb_send_mail($to, $subject, $message, $headers));
    } catch (Exception $e){
        var_export($e);
        return false;
    }
    return false;
}


/**
 * for user
 */
function send_mail_user($username, $email, $sex, $date) {
  $to = $email;
  $subject = "お申し込みありがとうございます";
  $msg = <<<EOM
<p>${username} 様</p>

<p>この度はお申し込みいただき、ありがとうございます</p>

<p>以下の内容でお申し込みを受け付けましたのでご確認いただきますよう、お願いいたします</p>

<ul>
  <li>お名前 : ${username} 様</li>
  <li>メールアドレス : ${email}</li>
  <li>性別 : ${sex}</li>
  <li>お申し込みお日にち : ${date}</li>
</ul>
EOM;
  return send_mail($to, $subject, $msg);
}

/**
 * for management
 */
function send_mail_management($username, $email, $sex, $date) {
  $to = "rrzdibzrm473@gmail.com";
  $subject = "お申し込み申請がありました";
  $msg = <<<EOM

<p>以下の内容で新規お申し込みがありました</p>

<ul>
  <li>お名前 : ${username} 様</li>
  <li>メールアドレス : ${email}</li>
  <li>性別 : ${sex}</li>
  <li>お申し込みお日にち : ${date}</li>
</ul>
EOM;
  return send_mail($to, $subject, $msg);
}