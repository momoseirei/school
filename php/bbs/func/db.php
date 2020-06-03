<?php
/**
 * コネクション
 */
function connect($conf) {
  try {
    if ($conf["release"] === true) {
      $host = $conf["db"]["remote"]["host"];
      $name = $conf["db"]["remote"]["name"];
      $user = $conf["db"]["remote"]["user"];
      $pass = $conf["db"]["remote"]["pass"];
      $pdo = new PDO("mysql:host=".$host.";dbname=".$name.";charset=utf8mb4;", $user, $pass);
    } else {
      $host = $conf["db"]["local"]["host"];
      $name = $conf["db"]["local"]["name"];
      $user = $conf["db"]["local"]["user"];
      $pass = $conf["db"]["local"]["pass"];
      $pdo = new PDO("mysql:host=".$host.";dbname=".$name.";charset=utf8mb4;unix_socket=/tmp/mysql.sock", $user, $pass);
    };
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    return $pdo;
  } catch(PDOException $Exception) {
    exit("MySQL Connection Error : ".$Exception->getMessage());
  }
}


/**
 * 投稿全件取得
 */
function fetch_post_contents($conf) {
  try {
      $pdo = connect($conf);
      $sql = "SELECT * FROM bbs ORDER BY created_at DESC";
      $stmh = $pdo->prepare($sql);
      $stmh->execute();
      $rows = $stmh->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
  } catch(PDOException $Exception) {
      exit("MySQL Connection Error : ".$Exception->getMessage());
  }
}
/**
 * 投稿
 */
function insert_post_content($conf, $title, $contributor, $contributor_id, $content) {
    try {
        $pdo = connect($conf);
        $sql = "INSERT INTO bbs (
            title, contributor, contributor_id, content
          ) VALUES (
            :title, :contributor, :contributor_id, :content
          );";
        $stmh = $pdo->prepare($sql);
        $stmh -> bindValue(':title', $title, PDO::PARAM_STR);
        $stmh -> bindValue(':contributor', $contributor, PDO::PARAM_STR);
        $stmh -> bindValue(':contributor_id', $contributor_id, PDO::PARAM_INT);
        $stmh -> bindValue(':content', $content, PDO::PARAM_STR);
        $stmh->execute();
        
        if ($stmh->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    } catch(PDOException $Exception) {
        exit("MySQL Connection Error : ".$Exception->getMessage());
        return false;
    }
}

/**
 * ログインするユーザーの検索
 */
function serch_user_for_login($conf, $username) {
  try {
      $pdo = connect($conf);
      $sql = "SELECT id, password FROM users WHERE username=:username;";
      $stmh = $pdo->prepare($sql);
      $stmh -> bindValue(':username', $username, PDO::PARAM_STR);
      $stmh->execute();
      $row = $stmh->fetch(PDO::FETCH_ASSOC);
      return $row;
  } catch(PDOException $Exception) {
      exit("MySQL Connection Error : ".$Exception->getMessage());
  }
}

/**
 * 投稿の削除
 */
function delete_post($conf, $post_id) {
  try {
      $pdo = connect($conf);
      $sql = "DELETE FROM bbs WHERE id=:post_id;";
      $stmh = $pdo->prepare($sql);
      $stmh -> bindValue(':post_id', $post_id, PDO::PARAM_INT);
      $stmh->execute();
      
      if ($stmh->rowCount() > 0) {
          return true;
      } else {
          return false;
      }
  } catch(PDOException $Exception) {
      exit("MySQL Connection Error : ".$Exception->getMessage());
  }
}