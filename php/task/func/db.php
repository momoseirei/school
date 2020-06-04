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
 * 　社員一覧
 */
function fetch_users($conf) {
  try {
      $pdo = connect($conf);
      $sql = "SELECT id, username, team FROM users";
      $stmh = $pdo->prepare($sql);
      $stmh->execute();
      $rows = $stmh->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
  } catch(PDOException $Exception) {
      exit("MySQL Connection Error : ".$Exception->getMessage());
  }
}

/**
 * タスク一覧
 */
function fetch_tasks($conf) {
  try {
      $pdo = connect($conf);
      $sql = "SELECT t.id, t.task_name, u.username, t.delivery 
              FROM tasks AS t 
              INNER JOIN users AS u ON t.user_id = u.id 
              WHERE state=0 
              ORDER BY t.delivery;";
      $stmh = $pdo->prepare($sql);
      $stmh->execute();
      $rows = $stmh->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
  } catch(PDOException $Exception) {
      exit("MySQL Connection Error : ".$Exception->getMessage());
  }
}

/**
 * タスク追加
 */
function insert_task($conf, $task_name, $delivery, $user_id) {
    try {
        $pdo = connect($conf);
        $sql = "INSERT INTO tasks (
            user_id, task_name, delivery, state
          ) VALUES (
            :user_id, :task_name, :delivery, 0
          );";
        $stmh = $pdo->prepare($sql);
        $stmh -> bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmh -> bindValue(':task_name', $task_name, PDO::PARAM_STR);
        $stmh -> bindValue(':delivery', $delivery, PDO::PARAM_STR);
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
function serch_user_for_login($conf, $user_id) {
  try {
      $pdo = connect($conf);
      $sql = "SELECT username, password FROM users WHERE id=:user_id;";
      $stmh = $pdo->prepare($sql);
      $stmh -> bindValue(':user_id', $user_id, PDO::PARAM_INT);
      $stmh->execute();
      $row = $stmh->fetch(PDO::FETCH_ASSOC);
      return $row;
  } catch(PDOException $Exception) {
      exit("MySQL Connection Error : ".$Exception->getMessage());
  }
}

/**
 * タスク完了
 */
function update_task_state($conf, $task_id) {
  try {
      $pdo = connect($conf);
      $sql = "UPDATE tasks SET state=1 WHERE id=:task_id;";
      $stmh = $pdo->prepare($sql);
      $stmh -> bindValue(':task_id', $task_id, PDO::PARAM_INT);
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