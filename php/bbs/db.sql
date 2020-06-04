CREATE TABLE bbs (
  id INTEGER AUTO_INCREMENT,
  
  title VARCHAR(63),
  contributor VARCHAR(255),
  contributor_id INTEGER,
  content TEXT,

  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  PRIMARY KEY(id),

  INDEX user_index(contributor_id),
  FOREIGN KEY fk_user(contributor_id)
  REFERENCES users(id)

)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE users (
  id INTEGER AUTO_INCREMENT,

  username VARCHAR(255),
  password VARCHAR(255),

  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  PRIMARY KEY(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO users (username, password) VALUES ("田中 太郎", "$2y$10$6M3JGRTsQW96B4GyebhyC.Ja0svfGnAZFNyd2Uw1VssKYY7E8U2HO");
INSERT INTO bbs (title, contributor, contributor_id, content) VALUES ("おはよう", "田中 太郎", 1, "テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト");