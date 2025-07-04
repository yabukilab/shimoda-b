-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2025-07-04 12:17:35
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `payment_search`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `stores`
--

DROP TABLE IF EXISTS `stores`;
CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `category` varchar(50) NOT NULL,
  `payment_methods` text NOT NULL,
  `hours` varchar(255) NOT NULL,
  `holidays` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `stores`
--

INSERT INTO `stores` (`id`, `store_name`, `area`, `address`, `category`, `payment_methods`, `hours`, `holidays`, `notes`) VALUES
(26, '旬菜ダイニング花火', '東京都', '東京都渋谷区道玄坂2-8-5', 'food', 'credit,qr', '11:00~23:00', '毎週火', '旬の和食を提供'),
(27, 'アオバ電機 秋葉原本店', '東京都', '東京都千代田区外神田1-12-9', 'retail', 'emoney,cash', '10:00~20:00', '第2水,第4水', '最新家電を豊富に揃えています'),
(28, 'スマイルヘアーサロン', '大阪府', '大阪府大阪市中央区南船場4-2-11', 'service', 'credit,qr,emoney,cash', '9:00~19:00', '最終日', '予約優先、男性歓迎'),
(29, '炭火焼鳥とり松', '福岡県', '福岡県福岡市中央区今泉1-7-15', 'food', 'cash', '17:00~24:00', '毎週月,毎週木', 'お一人様歓迎のカウンター完備'),
(30, '手仕事雑貨つむぎ', '京都府', '京都府京都市中京区蛸薬師通烏丸東入一蓮社町', 'retail', 'credit,emoney', '11:00~18:30', '毎週水,第3日', '和の手工芸品専門店です');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
