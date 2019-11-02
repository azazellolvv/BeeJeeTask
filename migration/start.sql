CREATE TABLE `tasks` (
  `name` CHAR(52) NOT NULL,
  `email` CHAR(52) NOT NULL PRIMARY KEY,
  `text` TEXT NOT NULL,
  `did` INT(1) NOT NULL DEFAULT 0,
  `adminEdit` INT(1) NOT NULL DEFAULT 0
) ENGINE=INNODB DEFAULT CHARSET=utf8;

INSERT INTO `tasks` VALUES ('name1','name1@qwe.ty','do sdfsdf werwer', 0, 0);
INSERT INTO `tasks` VALUES ('name2','name2@qwe.ty','do sdfsdf werwer', 0, 0);
INSERT INTO `tasks` VALUES ('name3','name3@qwe.ty','do sdfsdf werwer', 0, 0);

