-- ユーザー作成と権限付与
CREATE USER 'web'@'%' IDENTIFIED BY '0202nesoy';
GRANT ALL PRIVILEGES ON compe2020.* TO 'web'@'%';
FLUSH PRIVILEGES;

-- サンプルテーブルの作成
USE compe2020;

-- サンプルテーブル
CREATE TABLE sample (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name TEXT NOT NULL,
  age INT NOT NULL
);

-- サンプルデータの挿入
INSERT INTO sample (name, age) VALUES
('田中太郎', 22),
('鈴木一郎', 28),
('山田花子', 19),
('佐藤健', 35),
('渡辺直美', 31),
('伊藤誠', 25),
('中村翔', 42),
('小林洋子', 29),
('加藤和彦', 37),
('吉田裕', 27),
('山本明', 33),
('高橋真理', 24),
('石田康弘', 39),
('三浦美咲', 21),
('松本龍', 45),
('木村拓也', 30),
('斎藤結衣', 26),
('清水健太', 34),
('後藤春香', 23),
('井上剛', 41);