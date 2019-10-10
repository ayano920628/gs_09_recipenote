-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2019 年 10 月 10 日 21:56
-- サーバのバージョン： 5.7.26
-- PHP のバージョン: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `gs_db4`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_an_table`
--

CREATE TABLE `gs_an_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `naiyou` text COLLATE utf8_unicode_ci,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_an_table`
--

INSERT INTO `gs_an_table` (`id`, `name`, `email`, `naiyou`, `indate`) VALUES
(1, 'TEST1', 'test1@test.jp', 'test', '2019-10-05 15:37:39'),
(2, 'TEST2', 'test2@test.jp', 'test', '2019-10-05 15:37:50'),
(3, 'TEST3', 'test3@test.jp', 'test', '2019-10-05 15:38:07');

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_user_table`
--

CREATE TABLE `gs_user_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `lid` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `lpw` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_user_table`
--

INSERT INTO `gs_user_table` (`id`, `name`, `lid`, `lpw`, `kanri_flg`, `life_flg`) VALUES
(1, 'テスト１管理者', 'test1', '$2y$10$ykOV2pAaUwJ08U/AtqtTXuEsbdHlbq/izvn2gYZ.jZ5hhbqa.DKUO', 1, 0),
(2, 'テスト2一般', 'test2', '$2y$10$UJ6jICE7eCkRN7hPL.fGNuQdicL534mfxTxL5KQxRql0FQ4zfon0e', 0, 0),
(3, 'テスト３', 'test3', 'test3', 0, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `recipe`
--

CREATE TABLE `recipe` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `ingredient1` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `ingredient2` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ingredient3` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recipememo` text COLLATE utf8_unicode_ci,
  `season` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `review` text COLLATE utf8_unicode_ci,
  `original` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `inputdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `recipe`
--

INSERT INTO `recipe` (`id`, `userid`, `title`, `ingredient1`, `ingredient2`, `ingredient3`, `url`, `recipememo`, `season`, `review`, `original`, `author`, `inputdate`) VALUES
(1, 13, 'タコのマリネ', '茹でダコ', 'トマト', 'きゅうり', 'https://www.kurashiru.com/recipes/f2d2f67a-4eca-4a7c-a512-d19bb43a8113', 'オリーブオイルと塩胡椒。簡単！', 'all', '好評！', 0, 13, '2019-10-06 11:41:00'),
(2, 13, 'ミートソース', '牛ひき肉', 'トマト', '赤ワイン', 'https://cookpad.com/recipe/1496502', '時間かかるけどうまくできた！', 'all', '', 0, 13, '2019-10-06 11:44:09'),
(3, 13, '麻婆茄子', '豚ひき肉', 'ナス', 'ピーマン', '', '生姜入れると美味しい！', 'all', '豆板醤多めが好き。', 0, 13, '2019-10-06 14:09:55'),
(4, 13, '肉団子スープ', '鶏ひき肉', '白菜', 'チンゲン菜', '', '味覇があればなんでも美味しい！生姜入れると温まる。', 'all', 'さっぱり好評！', 0, 13, '2019-10-06 14:12:02'),
(5, 1, 'タコのマリネ', '茹でダコ', 'トマト', 'きゅうり', 'https://www.kurashiru.com/recipes/f2d2f67a-4eca-4a7c-a512-d19bb43a8113', 'オリーブオイルと塩胡椒。簡単！', 'all', '美味しそう', 1, 13, '2019-10-06 15:40:22'),
(6, 1, 'ミートソース', '牛ひき肉', 'トマト', '赤ワイン', 'https://cookpad.com/recipe/1496502', '時間かかるけどうまくできた！', 'all', '', 1, 13, '2019-10-06 17:47:19'),
(7, 1, 'サンマの炊き込みご飯', 'サンマ', '', '', 'https://www.kikkoman.co.jp/homecook/search/recipe/00002113/index.html', '缶でできる！', 'autumn', '', 0, 1, '2019-10-06 17:49:06'),
(8, 2, 'クロックムッシュ', '食パン', 'ハム', 'チーズ', '', '焦げないように気をつける', 'all', 'これならできるぞ！', 0, 2, '2019-10-07 20:52:36'),
(9, 2, '肉じゃが', '牛肉', 'じゃがいも', 'にんじん', 'http://www.kikkoman.co.jp/homecook/search/recipe/00004691/index.html', 'じゃがいもが崩れないように気をつける', 'winter', 'お弁当に入れた◎', 0, 2, '2019-10-07 20:54:03'),
(10, 14, '麻婆豆腐', '豚ひき肉', '豆腐', '', '', '豆板醤を使わないパターン！胡椒で味付け◎', 'summer', '', 0, 14, '2019-10-07 20:56:18'),
(11, 12, '黒豆', '黒豆', '鉄釘', '砂糖', '', 'おせち料理の定番！じっくりストーブで一晩煮込む！', 'winter', '大粒のお豆が美味しいね。', 0, 12, '2019-10-07 21:03:52'),
(12, 12, 'ポテトサラダ', 'じゃがいも', '玉ねぎ', 'きゅうり', '', '玉ねぎのみじん切りを入れるのがポイント！マヨネーズは入れすぎない。', 'all', 'いつでも人気〜', 0, 12, '2019-10-07 21:04:51'),
(13, 10, 'つくね', '鶏ひき肉', '長ネギ', '生姜', '', 'シソ入れるといい香り。', 'all', '圭ちゃんお気に入り', 0, 10, '2019-10-07 21:06:07'),
(14, 8, 'ハヤシライス', '牛肉', '赤ワイン', 'トマト', 'https://cookpad.com/recipe/1411096', '煮込めばなんとかなる！', 'all', '赤ワインが余ったらこれ！', 0, 8, '2019-10-09 20:21:11'),
(15, 8, 'シャケご飯', '鮭', 'もち米', 'シソ', '', 'もち米半分で炊くとモチモチ！', 'autumn', 'シソとごまで香りがいい！！', 0, 8, '2019-10-09 20:22:50'),
(16, 1, '麻婆茄子', '豚ひき肉', 'ナス', 'ピーマン', '', '生姜入れると美味しい！', 'all', '豆板醤多めが好き。', 1, 13, '2019-10-10 21:52:53');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `lifeflg` int(12) NOT NULL,
  `kanriflg` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `lifeflg`, `kanriflg`) VALUES
(1, 'ayano', 'ayano@test.jp', '$2y$10$W9Vo2vCOfwkuEkEHhz8EfuEpUUiiKEQcsWdK.VwLfRrJkEGBZsuvq', 0, 1),
(2, 'yuki', 'yuki@test.jp', '$2y$10$qhUGHSOoYJ7D7WgToD6cKe42gjyLjR.BeLenwpk.Msu5oKJhx2Snm', 1, 0),
(8, 'junko', 'junko@test.jp', '$2y$10$ohW52TXKDz6u3YtyoNMw3enkWNoqw1qjbbJEwGQzrCBWm6fMC91dq', 0, 0),
(10, 'minami', 'minami@test.jp', '$2y$10$8CIbVlqGgbWJbcp607qpPuqJTm37cNQLyyz3dUhFjGaYPQ4lcvyji', 0, 0),
(11, 'keichiro', 'keichiro@test.jp', '$2y$10$W46PXOEkLE.AWAvYbdShke8zqQ7h90HAFeQ4MfpMk6sPtjVhPRcvS', 1, 0),
(12, 'yukako', 'yukako@test.jp', '$2y$10$ZVLw7U0/MR0HP2cdYYq/Yu7lyzSB6FwQilhXRQAqxRgXUZa8ESYU.', 0, 0),
(13, 'misako', 'misako@test.jp', '$2y$10$cwLtejTr.bSXWB2d5hvcQupzkvS4ukb/eultHRxw5aosHYeU4EfZi', 0, 0),
(15, 'hidetoshi', 'hidetoshi@test.jp', '$2y$10$7SaiwgI0zTijj/r3fWwOU.u60wKR7wZmTUQ76HyZ49Za81Sxfza5q', 0, 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_an_table`
--
ALTER TABLE `gs_an_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `gs_user_table`
--
ALTER TABLE `gs_user_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `gs_an_table`
--
ALTER TABLE `gs_an_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルのAUTO_INCREMENT `gs_user_table`
--
ALTER TABLE `gs_user_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルのAUTO_INCREMENT `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- テーブルのAUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
