-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2021-07-02 09:51:30
-- サーバのバージョン： 10.4.18-MariaDB
-- PHP のバージョン: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `mydb`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `testtable`
--

DROP TABLE IF EXISTS `testtable`;
CREATE TABLE `testtable` (
  `id` int(11) NOT NULL,
  `userid` varchar(10) NOT NULL,
  `varcharA` varchar(10) NOT NULL,
  `hwork` int(11) NOT NULL,
  `worktime` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `remonth` int(11) NOT NULL,
  `inget` int(11) NOT NULL,
  `fixcost` int(11) NOT NULL,
  `vercost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `testtable`
--

INSERT INTO `testtable` (`id`,`userid`, `varcharA`, `hwork`, `worktime`, `target`, `remonth`, `inget`,`fixcost`,`vercost`,) VALUES
(1,`GFAGA`, `FAHSR4`, 850, 85, 30000, 200000, 2020, 50000, 15000, 5000);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `testtable`
--
ALTER TABLE `testtable`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `testtable`
--
ALTER TABLE `testtable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
