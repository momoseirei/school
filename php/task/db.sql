CREATE database task;
GRANT ALL PRIVILEGES ON task.* TO momo@localhost;
FLUSH PRIVILEGES;

use task;

CREATE TABLE users (
  id INTEGER AUTO_INCREMENT,

  username VARCHAR(255),
  password VARCHAR(255),
  team VARCHAR(63),

  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  PRIMARY KEY(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE tasks (
  id INTEGER AUTO_INCREMENT,
  
  user_id INTEGER,
  task_name VARCHAR(255),
  delivery DATE,

  state TINYINT(4), -- 0:未完了 1:完了
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  PRIMARY KEY(id),

  INDEX user_index(user_id),
  FOREIGN KEY fk_user(user_id)
  REFERENCES users(id)

)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO users (username, password, team) VALUES ("高橋さん", "$2y$10$6M3JGRTsQW96B4GyebhyC.Ja0svfGnAZFNyd2Uw1VssKYY7E8U2HO", "経理チーム");
INSERT INTO tasks (user_id, task_name, delivery) VALUES (1, "A社訪問", "2020-12-31");