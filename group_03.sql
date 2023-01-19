-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-06-14 11:03:58
-- 伺服器版本： 10.4.17-MariaDB
-- PHP 版本： 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `group_03`
--
CREATE DATABASE IF NOT EXISTS `group_03` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `group_03`;

-- --------------------------------------------------------

--
-- 資料表結構 `board`
--

CREATE TABLE `board` (
  `account` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `board_date` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `board`
--

INSERT INTO `board` (`account`, `content`, `board_date`) VALUES
('admin', 'Very fresh!', '2021-06-08'),
('member', 'NICE!', '2021-06-14');

-- --------------------------------------------------------

--
-- 資料表結構 `checkout`
--

CREATE TABLE `checkout` (
  `checkout_id` int(10) NOT NULL,
  `account` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` text COLLATE utf8_unicode_ci NOT NULL,
  `product_amount` text COLLATE utf8_unicode_ci NOT NULL,
  `total` int(5) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `checkout`
--

INSERT INTO `checkout` (`checkout_id`, `account`, `product_name`, `product_amount`, `total`, `date`) VALUES
(267456620, 'admin', '鮭魚', '109', 4360, '2021-05-30'),
(378786572, 'admin', '炙燒起司鮮蝦,極上蟹肉棒', '1,1', 140, '2021-06-08'),
(946235531, 'member', '鮭魚,鹽味牛排,玉子,極上鰻魚', '1,1,1,1', 180, '2021-06-14');

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `ID` int(5) NOT NULL,
  `p_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `picture` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `price` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`ID`, `p_name`, `picture`, `content`, `price`) VALUES
(1, '鮪魚', 'tuna.png', '有「海上黑金」美譽的黑鮪魚</br>甘甜入口的滋味⁣⁣，被視為海鮮中的夢幻逸品⁣⁣', 40),
(2, '鮭魚', 'salmon.png', '肉質鮮美富含油脂</br>滑順口感，頂級的鮭魚生魚片⁣⁣壽司', 40),
(3, '洋蔥鮭魚', 'onion_salmon.png', '肥美的新鮮大切生鮭魚，搭配清爽洋蔥</br>口感豐富第一首選⁣⁣', 40),
(4, '炙燒起司鮮蝦', 'cheese_shrimp.png', '迷人的炙燒風味，搭配濃郁起司</br>佐以彈牙的鮮蝦，是令人一吃難忘的美味⁣⁣', 40),
(5, '甜蝦', 'sweet_shrimp.png', '肉質甜嫩細滑，蝦膏甘香</br>甘甜鮮美，經典不敗好滋味⁣⁣', 40),
(6, '麻辣赤蝦', 'spicy_shrimp.png', '炸過的白蔥絲帶來豐富層次</br>微微麻辣又開胃，讓你更吃得出甘甜鮮美的滋味', 40),
(7, '花枝', 'squid.png', '享受花枝在舌尖跳動的Q彈口感⁣⁣</br>滑溜口感，能品嘗到最真實的風味⁣⁣', 40),
(8, '極上蟹肉棒', 'crab.png', '鮮甜的夢幻食材，細緻蟹肉口感飽滿</br>濃郁鮮甜的蟹味，嘗過一口就無法忘懷⁣⁣', 40),
(9, '玉子', 'egg.png', '甘甜厚實的玉子燒，搭配日本產壽司專用米</br>絕對不會讓您失望的經典美味\r\n⁣⁣', 40),
(10, '鮮蝦3貫', '3shrimp.png', '甜蝦、鮮蝦、赤蝦，三種美味一次滿足</br>每一口都是豐厚彈牙的肉質，帶給您難忘好滋味⁣⁣', 60),
(11, '極上鰻魚', 'eel.png', '費時費工，堅持以先蒸後烤的方式製成⁣⁣</br>更能品嘗到鰻魚軟嫩肉質跟豐厚油脂⁣⁣', 60),
(12, '醬烤日本產貝柱', 'scallop.png', '火烤新鮮干貝搭配鮮甜醬油</br>每一口都嚐得出鹹甜迷人的好滋味', 60),
(13, '特大草蝦天婦羅', 'big_shrimp.png', '酥脆麵衣佐頂級大草蝦</br>口感扎實鮮美，脆而不油，鮮美雙享受', 80),
(14, '甜蝦軍艦', 'sweet_shrimp_warship.png', '精心挑選天然新鮮的鮮蝦</br>水晶般的蝦肉佐以美乃滋，鮮甜美味的味覺饗宴', 40),
(15, '炸蝦酪梨卷', 'Avocado.png', '鮮甜魚卵、玉子和炸蝦，口感層次再升級</br>美味豐富好滋味，絕對滿足您的味蕾', 40),
(16, '照燒豬五花', 'pig.png', '經典豬五花，下飯第一首選</br>每一口都是鹹甜迷人的照燒風味', 40),
(17, '炙燒起司培根', 'cheese_Bacon.png', '鹹香培根佐以濃郁起司</br>香氣豐沛，絕對不會失敗的肉壽司', 40),
(18, '炙燒辣味明太子', 'Mentaiko.png', '外皮酥脆，獨特口感</br>獨家炙燒風味，讓您忍不住一口接著一口', 60),
(19, '鹽味牛排', 'steak.png', '黑胡椒和牛排的完美搭配</br>香氣豐沛，肉壽司第一首選', 40),
(20, '黑胡椒煙燻合鴨', 'duck.png', '入味燻鴨搭配黑楜椒</br>厚實滋味，帶出豐富口感層次', 40),
(21, '飛魚卵軍艦', 'Roe.png', '爆汁鮮甜口感，老少咸宜</br>色澤晶亮且飽滿的魚卵，視覺與味覺雙享受', 40),
(22, '蝦肉沙拉軍艦', 'salad.png', '蝦肉甘香，口感紮實滑順</br>入口清爽，夏日壽司標配', 40),
(23, '玉米沙拉軍艦', 'corn.png', '入口便能感受到玉米的鮮甜與韻味</br>滿滿香脆玉米，口感味覺的饗宴', 40),
(24, '納豆軍艦', 'Natto.png', '傳統發酵工法，黏稠的獨特風味</br>納豆愛好者絕對不能錯過', 40);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `account` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `u_name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(10) NOT NULL,
  `privilege` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='儲存使用者資料，權限分三等，從1到3';

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`account`, `password`, `email`, `u_name`, `phone`, `privilege`) VALUES
('jessie1130', 'jessie891130', 'jessie891130@gmail.com', '唐孟婕', 975054873, 3),
('joyce123', '12345600', ' jiayihsu0518@gmail.com', '許加宜', 939227067, 3),
('member', 'member123456', 'member@gmail.com', 'member', 912345678, 2),
('admin', 'admin123456', 'admin@gmail.com', 'admin', 987654321, 3);

-- --------------------------------------------------------

--
-- 資料表結構 `wish_list`
--

CREATE TABLE `wish_list` (
  `id` int(20) NOT NULL,
  `account` varchar(50) NOT NULL,
  `p_id` int(50) NOT NULL,
  `p_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `wish_list`
--

INSERT INTO `wish_list` (`id`, `account`, `p_id`, `p_name`) VALUES
(1795727474, 'member', 3, '洋蔥鮭魚'),
(298903785, 'member', 6, '麻辣赤蝦'),
(1659594755, 'member', 8, '極上蟹肉棒'),
(1765760045, 'admin', 3, '洋蔥鮭魚');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
