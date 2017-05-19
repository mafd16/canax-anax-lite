
CREATE DATABASE IF NOT EXISTS melogin;
-- GRANT ALL ON oophp.* TO user@localhost IDENTIFIED BY "pass";
USE melogin;

GRANT ALL ON melogin.* TO user@localhost IDENTIFIED BY "pass";

-- Ensure UTF8 as chacrter encoding within connection.
SET NAMES utf8;


--
-- Create table for my own movie database
--
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`
(
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  `pass` VARCHAR(100) NOT NULL,
  `firstname` VARCHAR(100),
  `lastname` VARCHAR(100),
  `age` int,
  `city` VARCHAR(100),
  `profession` VARCHAR(100),
  `interest` VARCHAR(100)
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;



--
-- Create index for users.name
--
CREATE INDEX index_name ON users(username);




/*
DELETE FROM `movie`;
INSERT INTO `movie` (`title`, `year`, `image`) VALUES
  ('Pulp fiction', 1994, 'img/pulp-fiction.jpg'),
  ('American Pie', 1999, 'img/american-pie.jpg'),
  ('Pokémon The Movie 2000', 1999, 'img/pokemon.jpg'),
  ('Kopps', 2003, 'img/kopps.jpg'),
  ('From Dusk Till Dawn', 1996, 'img/from-dusk-till-dawn.jpg')
;
*/

/*
SELECT * FROM `movie`;
*/
