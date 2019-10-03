-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2019 年 10 月 03 日 21:46
-- サーバのバージョン： 5.7.26
-- PHP のバージョン: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `gs_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_an_table`
--

CREATE TABLE `gs_an_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `naiyou` text COLLATE utf8_unicode_ci,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_an_table`
--

INSERT INTO `gs_an_table` (`id`, `name`, `email`, `naiyou`, `indate`) VALUES
(1, '大森', 'test@test.jp', '無いよ', '2019-09-21 16:15:36'),
(2, '大森', 'test1@test.jp', '無いよ', '2019-09-21 16:20:42'),
(3, '榎原', 'test2@test.jp', '無いよ', '2019-09-21 16:20:42'),
(4, '田中', 'test10@test.jp', '無いよ', '2019-09-21 16:20:42'),
(5, '鈴木', 'test20@test.jp', '無いよ', '2019-09-21 16:20:42'),
(6, '佐藤', 'test3@test.jp', '無いよ', '2019-09-21 16:20:42'),
(7, '高橋', 'test30@test.jp', '無いよ', '2019-09-21 16:20:42'),
(9, 'ayano', 'test@test.jp', 'ARIGATO', '2019-09-21 17:37:45'),
(10, 'test', 'test', 'hey', '2019-09-21 18:26:06'),
(11, 'omeri', 'omeri', 'omeri', '2019-09-21 18:40:59'),
(12, 'test', 'test', 'https://www.amazon.co.jp/%E5%AD%A6%E3%81%B3%E3%82%92%E7%B5%90%E6%9E%9C%E3%81%AB%E5%A4%89%E3%81%88%E3%82%8B%E3%82%A2%E3%82%A6%E3%83%88%E3%83%97%E3%83%83%E3%83%88%E5%A4%A7%E5%85%A8-Sanctuary-books-%E6%A8%BA%E6%B2%A2%E7%B4%AB%E8%8B%91/dp/4801400558?pf_rd_p=70a8bcbb-73aa-4620-85e8-1b1a69e34b2f&pd_rd_wg=pFBDB&pf_rd_r=V1G3J2FTQEV3W8XYRPDM&ref_=pd_gw_cr_simh&pd_rd_w=d1YSO&pd_rd_r=1336d912-6506-4ecb-9cca-fdf43b63a914', '2019-09-22 09:20:29'),
(13, 'testtest', 'test', '', '2019-09-23 16:20:24');

-- --------------------------------------------------------

--
-- テーブルの構造 `news`
--

CREATE TABLE `news` (
  `id` int(12) NOT NULL,
  `url` varchar(2083) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `attribute` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `inputdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `news`
--

INSERT INTO `news` (`id`, `url`, `title`, `comment`, `attribute`, `inputdate`) VALUES
(1, 'sample.com', 'amazon', '無いよ', '仕事', '2019-09-23 16:22:34'),
(2, 'https://www.nikkei.com/article/DGXMZO50103920S9A920C1MM8000/', 'amazon', '無いよ', '仕事', '2019-09-23 16:28:27'),
(5, 'https://news.yahoo.co.jp/byline/syunsukeyamasaki/20190925-00144124/', '来週から増税対策で国が５％還元！（ただし中小店舗でのキャッシュレス決済に限る）対象店舗の見分け方は？', '増税！', '家族', '2019-09-25 20:47:39'),
(6, 'https://www.lifehacker.jp/2019/09/199296quick-ways-to-connect-with-your-kids-when-youre-busy.html', '子どもに愛情を伝えられる｢5分習慣｣7選｜育児ハック', '５分', '家族', '2019-09-25 20:57:52'),
(12, 'https://www.asahi.com/articles/ASM9V6FQ2M9VUHBI02Y.html', '仏シラク元大統領が死去イラク戦争反対、大相撲好き…', '大事なニュース', '趣味', '2019-09-28 14:21:27'),
(13, 'https://newspicks.com/news/4258828/?ref=index', '無償化に便乗認可外の保育施設で理由なく利用料値上げプレミアムプラン', 'aaa', '仕事', '2019-09-28 15:04:13');

-- --------------------------------------------------------

--
-- テーブルの構造 `post`
--

CREATE TABLE `post` (
  `id` int(12) NOT NULL,
  `userid` int(12) NOT NULL,
  `post` text COLLATE utf8_unicode_ci NOT NULL,
  `inputdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `post`
--

INSERT INTO `post` (`id`, `userid`, `post`, `inputdate`) VALUES
(8, 10, 'hi', '2019-09-29 18:08:06'),
(9, 9, '終わらない。。。', '2019-10-03 19:59:18'),
(10, 8, '間に合わない！！', '2019-10-03 20:00:55'),
(12, 8, 'もう２１じはん。。', '2019-10-03 21:24:34'),
(13, 9, '終わらないよーーー', '2019-10-03 21:42:26'),
(14, 4, '初投稿！', '2019-10-03 21:43:04'),
(15, 4, 'どんどん書くぞ', '2019-10-03 21:43:12'),
(16, 9, 'もう眠い', '2019-10-03 21:45:35'),
(17, 11, 'ワクワク', '2019-10-03 21:46:04');

-- --------------------------------------------------------

--
-- テーブルの構造 `relationship`
--

CREATE TABLE `relationship` (
  `id` int(12) NOT NULL,
  `followinguser` int(12) NOT NULL,
  `followeduser` int(12) NOT NULL,
  `life` int(12) NOT NULL,
  `inputdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `relationship`
--

INSERT INTO `relationship` (`id`, `followinguser`, `followeduser`, `life`, `inputdate`) VALUES
(2, 8, 9, 1, '2019-10-01 21:17:47'),
(5, 4, 8, 1, '2019-10-03 21:44:34'),
(6, 10, 9, 1, '2019-10-03 21:44:43'),
(7, 9, 4, 1, '2019-10-03 21:45:06');

-- --------------------------------------------------------

--
-- テーブルの構造 `user`
--

CREATE TABLE `user` (
  `id` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `administrator` int(1) DEFAULT NULL,
  `lifeflg` int(1) DEFAULT NULL,
  `inputdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `administrator`, `lifeflg`, `inputdate`) VALUES
(4, 'junko', 'junko@test', 'junko', 2, 2, '2019-09-29 08:46:03'),
(8, 'shinya', 'shinya@test.jp', 'shinya', 2, 2, '2019-09-29 18:01:36'),
(9, 'minami', 'minami@test', 'minami', 2, 2, '2019-09-29 18:05:25'),
(10, 'yuta', 'yuta@test', 'yuta', 2, 2, '2019-09-29 18:07:56'),
(11, 'keichiro', 'keichiro@test', 'keichiro', 2, 2, '2019-10-03 21:45:58');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_an_table`
--
ALTER TABLE `gs_an_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `relationship`
--
ALTER TABLE `relationship`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `gs_an_table`
--
ALTER TABLE `gs_an_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- テーブルのAUTO_INCREMENT `news`
--
ALTER TABLE `news`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- テーブルのAUTO_INCREMENT `post`
--
ALTER TABLE `post`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- テーブルのAUTO_INCREMENT `relationship`
--
ALTER TABLE `relationship`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- テーブルのAUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
