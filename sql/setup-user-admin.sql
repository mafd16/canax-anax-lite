
-- CREATE DATABASE IF NOT EXISTS melogin;
-- GRANT ALL ON melogin.* TO user@localhost IDENTIFIED BY "pass";

-- CREATE DATABASE IF NOT EXISTS mafd16;
-- GRANT ALL ON mafd16.* TO user@localhost IDENTIFIED BY "pass";

-- USE melogin;
USE mafd16;


-- Ensure UTF8 as chacrter encoding within connection.
SET NAMES utf8;


--
-- Create table for my own movie database
--
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`
(
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `pass` VARCHAR(100) NOT NULL,
  `firstname` VARCHAR(100),
  `lastname` VARCHAR(100),
  `age` int,
  `city` VARCHAR(100),
  `profession` VARCHAR(100),
  `interest` VARCHAR(100),
  `admin` int DEFAULT 0
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;



--
-- Create index for users.name
--
CREATE INDEX index_name ON users(name);




DELETE FROM `users`;
INSERT INTO `users` (`name`, `pass`, `firstname`, `lastname`, `age`, `city`, `profession`, `interest`, `admin`) VALUES
  ('admin', '$2y$10$lXlRzd5Q6G3qGi5WqZbLvOL6Ka9XI7bqLNEOStzFkAjKQYsCdjpVm', 'Admin', 'Admin', 49, 'Admintown', 'Admin', 'Databases', 1),
  ('doe', '$2y$10$zLxWm1K.CDuyeBNTMr0c7u7rzzdXP.uOfKAO8A4OmtECzO310/AsS', 'John', 'Doe', 51, 'Chicago', 'Banker', 'Money', 0),
  ('marton', '$2y$10$6N5XNywnQBan.1pMkIX/e.ojcJ6El0dH8dcwnlTlzNRt6qdQTusya', 'Martin', 'Fagerlund', 33, 'Örebro', 'Student', 'Turf', 1),
  ('tomten', '$2y$10$NZHJs1o8F3PCk18rdExMvuyIKQNKtevLieW1BB28F2nw5i6/j/kLW', 'Santa', 'Claus', 123, 'Nordpolen', 'Tomte', 'Klappar', 0),
  ('xminister', '$2y$10$AfpIGChZVlbu31lkGcNR6ut0Y840FebmwanR8LTucoTkBs7Bq8cMW', 'Göran', 'Persson', 61, 'Stockholm', 'Pensionär', 'mat', 0),
  ('pepe', '$2y$10$S3rIWRdp/aNbP1kQ8x.ZkOyB/WUpQ.5YuS52CWsrY3/hj4J.SYGJq', 'Peps', 'Persson', 75, 'Skåne', 'Musiker', 'Progg', 0)
;




-- UPDATE users SET admin = 1 WHERE id = 1;

SELECT * FROM `users`;

-- SELECT * FROM users ORDER BY id asc LIMIT 4 OFFSET 0;

-- DELETE FROM `users` WHERE id = 9;
