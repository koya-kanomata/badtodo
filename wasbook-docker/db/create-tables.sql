CREATE DATABASE wasbook;
CREATE DATABASE todo;
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP ON wasbook.* TO wasbook;

use wasbook;

CREATE TABLE `books` (
  `id` varchar(10) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `author` varchar(250) DEFAULT NULL,
  `publisher` varchar(250) DEFAULT NULL,
  `date` varchar(250) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `comment` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `books` (`id`, `title`, `author`, `publisher`, `date`, `price`, `comment`) VALUES
('1001', '夏の夜の夢', 'Shakespeare', '青森書籍', '1979/01', 600, ''),
('1002', 'ハムレット', 'Shakespeare', '岩手書房', '1997/04', 1260, ''),
('1003', 'マクベス', 'Shakespeare', '山形出版', '2001/05', 1530, ''),
('1004', 'リア王', 'Shakespeare', '秋田公論社', '2004/07', 1890, '');

CREATE TABLE `users` (
  `id` varchar(16) DEFAULT NULL,
  `pwd` varchar(16) DEFAULT NULL,
  `mail` varchar(32) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `addr` varchar(64) DEFAULT NULL,
  `tel` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `pwd`, `mail`, `name`, `addr`, `tel`) VALUES
('yamada', 'pass1', 'yamada@example.jp', '山田太一', '神奈川県川崎市', '046-123-4567'),
('tanaka', 'pass1', 'takana@example.com', '山石京子', '東京都港区三田', '03-1234-5678'),
('sato', 'password', 'sato@example.net', '佐藤一志', '神奈川県横浜市', '045-123-4567');


use todo;
CREATE TABLE `todos` (
  `id` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `todo` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `c_date` date DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `due_date` date DEFAULT NULL,
  `done` int(11) NOT NULL DEFAULT 0,
  `org_filename` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `real_filename` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `public` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `todos` (`id`, `owner`, `todo`, `c_date`, `due_date`, `done`, `org_filename`, `real_filename`, `public`) VALUES
(1, 1, 'パソコンを買う',   CURDATE(), DATE_ADD(CURDATE(), INTERVAL 1 DAY), 0, NULL, NULL, 1),
(2, 2, '依頼の原稿を書く', CURDATE(), DATE_ADD(CURDATE(), INTERVAL 7 DAY), 0, 'memo.txt', 'memo.txt', 1),
(3, 1, '政府高官との会食アポ', CURDATE(), DATE_ADD(CURDATE(), INTERVAL 3 DAY), 0, NULL, NULL, 0);

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `pwd` varchar(6) NOT NULL,
  `email` varchar(64) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `super` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `userid`, `pwd`, `email`, `icon`, `super`) VALUES
(1, 'admin', 'passwd', 'root@example.jp', 'ockeghem.png', 1),
(2, 'wasbook', 'wasboo', 'wasbook@example.jp', 'elephant.png', 0);

ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `todos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;--
