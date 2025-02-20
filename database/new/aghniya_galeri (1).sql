-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 20, 2025 at 07:18 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aghniya_galeri`
--

-- --------------------------------------------------------

--
-- Table structure for table `aghniya_album`
--

CREATE TABLE `aghniya_album` (
  `aghniya_album_id` int NOT NULL,
  `aghniya_nama_album` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `aghniya_deskripsi` text COLLATE utf8mb4_general_ci NOT NULL,
  `aghniya_tanggal_dibuat` date NOT NULL,
  `aghniya_user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aghniya_album`
--

INSERT INTO `aghniya_album` (`aghniya_album_id`, `aghniya_nama_album`, `aghniya_deskripsi`, `aghniya_tanggal_dibuat`, `aghniya_user_id`) VALUES
(1, 'abcde', 'aaabbbcccdddeee', '2025-01-01', 1),
(2, 'uiiaiuiia', 'uiaioa', '2025-01-16', 1),
(5, 'punya dila', 'punya dilaaaaaaaaaaa', '2025-01-22', 3),
(10, 'lele`s', ' leleeeeeeeeeee', '2025-02-06', 8),
(12, 'aaa', 'aaaaaaaaabbccc', '2025-02-12', 3),
(15, 'a', 'a', '2025-02-20', 3),
(16, 'b', 'b', '2025-02-20', 3),
(17, 'c', 'c', '2025-02-20', 3),
(18, 'd', 'd', '2025-02-20', 3),
(21, 'y', 'y', '2025-02-20', 3);

-- --------------------------------------------------------

--
-- Table structure for table `aghniya_foto`
--

CREATE TABLE `aghniya_foto` (
  `aghniya_foto_id` int NOT NULL,
  `aghniya_judul_foto` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `aghniya_deskripsi_foto` text COLLATE utf8mb4_general_ci NOT NULL,
  `aghniya_tanggal_unggah` date NOT NULL,
  `aghniya_lokasi_file` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `aghniya_album_id` int NOT NULL,
  `aghniya_user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aghniya_foto`
--

INSERT INTO `aghniya_foto` (`aghniya_foto_id`, `aghniya_judul_foto`, `aghniya_deskripsi_foto`, `aghniya_tanggal_unggah`, `aghniya_lokasi_file`, `aghniya_album_id`, `aghniya_user_id`) VALUES
(1, 'nature.jpg', 'aa', '0000-00-00', 'public/nature.jpg', 1, 1),
(6, 'uuuuuuu', 'uuuuuuuu', '2025-01-16', 'public/abc.png', 2, 1),
(7, 'o', 'o', '2025-01-16', 'public/abcd.jpg', 1, 1),
(8, 'rrrrrr', 'rrrrrr', '2025-01-16', 'public/music.jpg', 2, 1),
(9, 'p', 'p', '2025-01-16', 'public/arts.jpg', 2, 1),
(10, 'bebek', 'bebek', '2025-01-22', 'public/bebek_.jpg', 5, 3),
(11, 'cat', 'catttt', '2025-01-22', 'public/cat_3.jpg', 5, 3),
(12, 'mweheheh', 'MWEHEHEHE', '2025-01-22', 'public/mweheheh_1.jpg', 2, 1),
(22, 'pkl', 'timeline pkl', '2025-01-30', 'public/pkl_3.png', 5, 3),
(27, 'rkw', 'rurukakawawa', '2025-02-06', 'public/rkw_8.jpg', 10, 8),
(29, 'cek', 'cek', '2025-02-12', 'public/cek_3.png', 12, 3),
(35, 'e', 'e', '2025-02-20', 'public/e_3.jpg', 12, 3);

-- --------------------------------------------------------

--
-- Table structure for table `aghniya_komentar_foto`
--

CREATE TABLE `aghniya_komentar_foto` (
  `aghniya_komentar_id` int NOT NULL,
  `aghniya_foto_id` int NOT NULL,
  `aghniya_user_id` int NOT NULL,
  `aghniya_isi_komentar` text COLLATE utf8mb4_general_ci NOT NULL,
  `aghniya_tanggal_komentar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aghniya_komentar_foto`
--

INSERT INTO `aghniya_komentar_foto` (`aghniya_komentar_id`, `aghniya_foto_id`, `aghniya_user_id`, `aghniya_isi_komentar`, `aghniya_tanggal_komentar`) VALUES
(1, 1, 1, 'ababab', '0000-00-00'),
(2, 6, 1, 'ab ab ab ab aba ab aba ba ababa ab ab ab ab ab aba ab aba ba ababa ab ab ab ab ab aba ab aba ba ababa ab ab ab ab ab aba ab aba ba ababa ab ', '2025-01-15'),
(3, 6, 3, 'hiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii', '2025-01-22'),
(4, 6, 3, 'ow', '2025-01-22'),
(5, 6, 3, 'knph', '2025-01-22'),
(6, 10, 3, 'hlow', '2025-01-22'),
(7, 10, 3, 'kesukaan niya', '2025-01-22'),
(8, 11, 3, 'a', '2025-01-22'),
(9, 7, 3, 'hii', '2025-01-23'),
(10, 9, 1, 'hiii', '2025-01-23'),
(11, 9, 1, 'hiii', '2025-01-23'),
(12, 7, 3, 'hii', '2025-01-23'),
(13, 9, 1, 'hiii', '2025-01-23'),
(14, 11, 1, 'waw', '2025-01-23'),
(15, 11, 3, 'test', '2025-01-23'),
(16, 11, 3, 'lucu amayy\r\n', '2025-01-23'),
(17, 10, 3, 'hi\r\n', '2025-01-23'),
(18, 9, 3, 'omg uwowowowowow\r\n', '2025-01-30'),
(19, 9, 3, 'can i use this picture for my instagram?', '2025-01-30'),
(20, 9, 3, 'thank  so much!', '2025-01-30'),
(21, 9, 3, 'uwiwiwiwiwiwi', '2025-01-30'),
(22, 9, 3, 'mweeeeeeeeee', '2025-01-30'),
(23, 9, 3, 'a', '2025-01-30'),
(24, 9, 3, 'o', '2025-01-30'),
(25, 9, 3, 'w', '2025-01-30'),
(26, 9, 3, 'ow', '2025-01-30'),
(27, 10, 1, 'p', '2025-02-05'),
(28, 10, 1, 'p', '2025-02-05'),
(29, 11, 3, 'ppp', '2025-02-05'),
(30, 22, 3, 'OW', '2025-02-05'),
(31, 22, 3, 'OW', '2025-02-05'),
(32, 1, 3, 'hi', '2025-02-06'),
(33, 11, 1, 'q', '2025-02-06'),
(34, 11, 1, 'uiiia\r\n', '2025-02-06'),
(35, 11, 3, 'o\r\n', '2025-02-06'),
(37, 12, 1, 'wowow', '2025-02-06'),
(38, 22, 1, 'byk yhh', '2025-02-06'),
(41, 10, 3, 'y', '2025-02-12'),
(42, 29, 3, 'aaaaaaaaaaaa', '2025-02-12'),
(43, 29, 3, 'okokok', '2025-02-12'),
(44, 7, 3, 'oy', '2025-02-18'),
(45, 11, 3, 'oyyyyyyyyyyyyooyoyoyooy', '2025-02-18'),
(46, 11, 3, '', '2025-02-18'),
(47, 11, 3, 'uw', '2025-02-18'),
(48, 11, 3, 'pow', '2025-02-18'),
(49, 11, 3, 'ayayaya', '2025-02-18'),
(50, 11, 3, 'hiw', '2025-02-18'),
(51, 29, 3, 'uwuw', '2025-02-18'),
(54, 6, 10, 'hjkl', '2025-02-18'),
(55, 11, 10, 'y', '2025-02-18'),
(60, 7, 10, 'yoy', '2025-02-18'),
(73, 1, 10, 'ooo', '2025-02-18'),
(74, 11, 3, 'ooo', '2025-02-18'),
(75, 11, 3, 'pop\r\n', '2025-02-18'),
(76, 11, 3, 'ow', '2025-02-18'),
(77, 11, 3, 'pow', '2025-02-18'),
(78, 7, 4, 'yay', '2025-02-19'),
(79, 35, 3, 'ok\r\n', '2025-02-21'),
(80, 7, 1, 'wuw', '2025-02-21');

-- --------------------------------------------------------

--
-- Table structure for table `aghniya_like_foto`
--

CREATE TABLE `aghniya_like_foto` (
  `aghniya_like_id` int NOT NULL,
  `aghniya_foto_id` int NOT NULL,
  `aghniya_user_id` int NOT NULL,
  `aghniya_tanggal_like` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aghniya_like_foto`
--

INSERT INTO `aghniya_like_foto` (`aghniya_like_id`, `aghniya_foto_id`, `aghniya_user_id`, `aghniya_tanggal_like`) VALUES
(2, 6, 1, '2025-01-14'),
(12, 1, 3, '2025-01-22'),
(42, 9, 3, '2025-01-30'),
(47, 8, 1, '2025-01-30'),
(51, 12, 1, '2025-01-30'),
(52, 22, 1, '2025-01-30'),
(53, 1, 1, '2025-01-30'),
(56, 9, 1, '2025-01-30'),
(57, 7, 1, '2025-01-30'),
(58, 11, 1, '2025-01-30'),
(59, 10, 1, '2025-02-05'),
(60, 22, 3, '2025-02-05'),
(61, 10, 9, '2025-02-06'),
(70, 11, 10, '2025-02-18'),
(74, 1, 10, '2025-02-18'),
(97, 6, 10, '2025-02-18'),
(107, 29, 4, '2025-02-18'),
(112, 12, 3, '2025-02-18'),
(117, 27, 3, '2025-02-18'),
(118, 29, 3, '2025-02-18'),
(119, 7, 3, '2025-02-18'),
(120, 10, 3, '2025-02-18'),
(121, 8, 3, '2025-02-18'),
(122, 11, 3, '2025-02-18'),
(133, 6, 4, '2025-02-19'),
(134, 1, 4, '2025-02-19'),
(135, 7, 4, '2025-02-19'),
(136, 29, 1, '2025-02-20'),
(137, 6, 3, '2025-02-21');

-- --------------------------------------------------------

--
-- Table structure for table `aghniya_notifikasi`
--

CREATE TABLE `aghniya_notifikasi` (
  `aghniya_notifikasi_id` int NOT NULL,
  `aghniya_foto_id` int NOT NULL,
  `aghniya_komentar_id` int NOT NULL,
  `aghniya_user_id` int NOT NULL,
  `created_at` date NOT NULL,
  `aghniya_user_photo_id` int NOT NULL,
  `is_read` int NOT NULL,
  `aghniya_like_id` int NOT NULL,
  `is_notif` int NOT NULL,
  `mark_read` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aghniya_notifikasi`
--

INSERT INTO `aghniya_notifikasi` (`aghniya_notifikasi_id`, `aghniya_foto_id`, `aghniya_komentar_id`, `aghniya_user_id`, `created_at`, `aghniya_user_photo_id`, `is_read`, `aghniya_like_id`, `is_notif`, `mark_read`) VALUES
(27, 8, 0, 1, '2025-01-30', 1, 1, 47, 1, 1),
(31, 12, 0, 1, '2025-01-30', 1, 1, 51, 0, 1),
(32, 22, 0, 1, '2025-01-30', 3, 1, 52, 1, 1),
(33, 1, 0, 1, '2025-01-30', 1, 1, 53, 1, 1),
(35, 9, 0, 1, '2025-01-30', 1, 1, 56, 1, 1),
(36, 7, 0, 1, '2025-01-30', 1, 1, 57, 1, 1),
(37, 11, 0, 1, '2025-01-30', 3, 1, 58, 1, 1),
(39, 10, 28, 1, '2025-02-05', 3, 1, 0, 1, 1),
(41, 22, 0, 3, '2025-02-05', 3, 1, 60, 1, 1),
(42, 22, 31, 3, '2025-02-05', 3, 1, 0, 1, 1),
(43, 1, 32, 3, '2025-02-06', 1, 1, 0, 1, 1),
(45, 11, 34, 1, '2025-02-06', 3, 1, 0, 1, 1),
(48, 12, 37, 1, '2025-02-06', 1, 1, 0, 1, 1),
(49, 22, 38, 1, '2025-02-06', 3, 1, 0, 1, 1),
(50, 10, 0, 9, '2025-02-06', 3, 1, 61, 1, 1),
(73, 11, 55, 10, '2025-02-18', 3, 1, 0, 1, 1),
(74, 11, 0, 10, '2025-02-18', 3, 1, 70, 1, 1),
(78, 1, 0, 10, '2025-02-18', 1, 1, 74, 1, 1),
(101, 6, 0, 10, '2025-02-18', 1, 1, 97, 1, 1),
(124, 1, 73, 10, '2025-02-18', 1, 1, 0, 1, 1),
(125, 29, 0, 4, '2025-02-18', 3, 1, 107, 1, 1),
(130, 12, 0, 3, '2025-02-18', 1, 1, 112, 1, 1),
(135, 27, 0, 3, '2025-02-18', 8, 0, 117, 0, 0),
(136, 29, 0, 3, '2025-02-18', 3, 1, 118, 1, 1),
(137, 7, 0, 3, '2025-02-18', 1, 1, 119, 1, 1),
(138, 10, 0, 3, '2025-02-18', 3, 1, 120, 1, 1),
(139, 8, 0, 3, '2025-02-18', 1, 1, 121, 1, 1),
(142, 11, 0, 3, '2025-02-18', 3, 1, 122, 1, 1),
(143, 11, 76, 3, '2025-02-18', 3, 1, 0, 1, 1),
(144, 11, 77, 3, '2025-02-18', 3, 1, 0, 1, 1),
(155, 6, 0, 4, '2025-02-19', 4, 0, 133, 1, 0),
(156, 1, 0, 4, '2025-02-19', 1, 1, 134, 0, 1),
(157, 7, 0, 4, '2025-02-19', 1, 1, 135, 0, 1),
(158, 7, 78, 4, '2025-02-19', 1, 1, 0, 0, 1),
(159, 29, 0, 1, '2025-02-20', 3, 1, 136, 1, 1),
(160, 35, 79, 3, '2025-02-21', 3, 1, 0, 1, 1),
(161, 6, 0, 3, '2025-02-21', 1, 1, 137, 1, 1),
(162, 7, 80, 1, '2025-02-21', 1, 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `aghniya_role`
--

CREATE TABLE `aghniya_role` (
  `aghniya_role_id` int NOT NULL,
  `aghniya_role` varchar(225) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aghniya_role`
--

INSERT INTO `aghniya_role` (`aghniya_role_id`, `aghniya_role`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `aghniya_user`
--

CREATE TABLE `aghniya_user` (
  `aghniya_user_id` int NOT NULL,
  `aghniya_username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `aghniya_password` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `aghniya_email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `aghniya_nama_lengkap` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `aghniya_alamat` text COLLATE utf8mb4_general_ci NOT NULL,
  `aghniya_role_id` int NOT NULL,
  `aghniya_verifikasi` int NOT NULL,
  `aghniya_foto_profile` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aghniya_user`
--

INSERT INTO `aghniya_user` (`aghniya_user_id`, `aghniya_username`, `aghniya_password`, `aghniya_email`, `aghniya_nama_lengkap`, `aghniya_alamat`, `aghniya_role_id`, `aghniya_verifikasi`, `aghniya_foto_profile`) VALUES
(1, 'niyaww', '0567746eccb450e95b9211335cb932ae', 'niya@gmail.com', 'niyaww', 'a', 2, 1, ''),
(2, 'adyila', 'dilaa', 'd@gmail.com', 'adyila', 'aaa', 2, 1, ''),
(3, 'dila', '35862fcf105f1aaa0b4f29ca71b96236', 'dila@gmail.com', 'dila', 'aa', 2, 1, 'profile/dila_3.jpg'),
(4, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 'admin', 'admin', 1, 1, 'profile/admin_4.jpg'),
(6, 'devi', 'f5c2db1f19bdde37e740e86b70d0534f', 'sasa@gmail.com', 'devi', 'aaaa', 2, 0, ''),
(7, 'mamal', '743f3cb228516818298313d422b0ffdf', 'sasa@gmail.com', 'mamal', 'aaaa', 2, 0, ''),
(8, 'kyamalia', '4a3be234543f00d86378c0d6d40d8ecc', 'sasa@gmail.com', 'kyamalia', 'jl abcde', 2, 1, NULL),
(9, 'amel', 'da0e22de18e3fbe1e96bdc882b912ea4', 'ica@gmail.com', 'amel', 'amel', 2, 1, NULL),
(10, 'ambar2555', 'a7caf003ad647f5f6fcb76bf9e306430', 'dhiyyaambar@gmail.com', 'dhiyyaambarrrr', 'haji haris', 2, 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aghniya_album`
--
ALTER TABLE `aghniya_album`
  ADD PRIMARY KEY (`aghniya_album_id`),
  ADD KEY `idx_aghniya_user_id` (`aghniya_user_id`);

--
-- Indexes for table `aghniya_foto`
--
ALTER TABLE `aghniya_foto`
  ADD PRIMARY KEY (`aghniya_foto_id`),
  ADD KEY `idx_album_id` (`aghniya_album_id`),
  ADD KEY `idx_user_id` (`aghniya_user_id`);

--
-- Indexes for table `aghniya_komentar_foto`
--
ALTER TABLE `aghniya_komentar_foto`
  ADD PRIMARY KEY (`aghniya_komentar_id`),
  ADD KEY `idx_foto_id` (`aghniya_foto_id`),
  ADD KEY `idx_user_id` (`aghniya_user_id`);

--
-- Indexes for table `aghniya_like_foto`
--
ALTER TABLE `aghniya_like_foto`
  ADD PRIMARY KEY (`aghniya_like_id`),
  ADD KEY `idx_foto_id` (`aghniya_foto_id`),
  ADD KEY `idx_user_id` (`aghniya_user_id`);

--
-- Indexes for table `aghniya_notifikasi`
--
ALTER TABLE `aghniya_notifikasi`
  ADD PRIMARY KEY (`aghniya_notifikasi_id`),
  ADD KEY `idx_user_id` (`aghniya_user_id`),
  ADD KEY `idx_users_id` (`aghniya_user_photo_id`),
  ADD KEY `idx_foto_id` (`aghniya_foto_id`),
  ADD KEY `idx_komentar_id` (`aghniya_komentar_id`);

--
-- Indexes for table `aghniya_role`
--
ALTER TABLE `aghniya_role`
  ADD PRIMARY KEY (`aghniya_role_id`);

--
-- Indexes for table `aghniya_user`
--
ALTER TABLE `aghniya_user`
  ADD PRIMARY KEY (`aghniya_user_id`),
  ADD KEY `role` (`aghniya_role_id`),
  ADD KEY `idx_aghniya_role_id` (`aghniya_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aghniya_album`
--
ALTER TABLE `aghniya_album`
  MODIFY `aghniya_album_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `aghniya_foto`
--
ALTER TABLE `aghniya_foto`
  MODIFY `aghniya_foto_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `aghniya_komentar_foto`
--
ALTER TABLE `aghniya_komentar_foto`
  MODIFY `aghniya_komentar_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `aghniya_like_foto`
--
ALTER TABLE `aghniya_like_foto`
  MODIFY `aghniya_like_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `aghniya_notifikasi`
--
ALTER TABLE `aghniya_notifikasi`
  MODIFY `aghniya_notifikasi_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `aghniya_role`
--
ALTER TABLE `aghniya_role`
  MODIFY `aghniya_role_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `aghniya_user`
--
ALTER TABLE `aghniya_user`
  MODIFY `aghniya_user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aghniya_album`
--
ALTER TABLE `aghniya_album`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`aghniya_user_id`) REFERENCES `aghniya_user` (`aghniya_user_id`);

--
-- Constraints for table `aghniya_foto`
--
ALTER TABLE `aghniya_foto`
  ADD CONSTRAINT `fk_album_id` FOREIGN KEY (`aghniya_album_id`) REFERENCES `aghniya_album` (`aghniya_album_id`),
  ADD CONSTRAINT `fk_users_id` FOREIGN KEY (`aghniya_user_id`) REFERENCES `aghniya_user` (`aghniya_user_id`);

--
-- Constraints for table `aghniya_komentar_foto`
--
ALTER TABLE `aghniya_komentar_foto`
  ADD CONSTRAINT `fk_komentar_id` FOREIGN KEY (`aghniya_foto_id`) REFERENCES `aghniya_foto` (`aghniya_foto_id`),
  ADD CONSTRAINT `fk_usersss_id` FOREIGN KEY (`aghniya_user_id`) REFERENCES `aghniya_user` (`aghniya_user_id`);

--
-- Constraints for table `aghniya_like_foto`
--
ALTER TABLE `aghniya_like_foto`
  ADD CONSTRAINT `fk_like_id` FOREIGN KEY (`aghniya_foto_id`) REFERENCES `aghniya_foto` (`aghniya_foto_id`),
  ADD CONSTRAINT `fk_userss_id` FOREIGN KEY (`aghniya_user_id`) REFERENCES `aghniya_user` (`aghniya_user_id`);

--
-- Constraints for table `aghniya_notifikasi`
--
ALTER TABLE `aghniya_notifikasi`
  ADD CONSTRAINT `fk_foto_notification_id` FOREIGN KEY (`aghniya_foto_id`) REFERENCES `aghniya_foto` (`aghniya_foto_id`),
  ADD CONSTRAINT `fk_user_notification_id` FOREIGN KEY (`aghniya_user_id`) REFERENCES `aghniya_user` (`aghniya_user_id`),
  ADD CONSTRAINT `fk_users_notification_id` FOREIGN KEY (`aghniya_user_photo_id`) REFERENCES `aghniya_user` (`aghniya_user_id`);

--
-- Constraints for table `aghniya_user`
--
ALTER TABLE `aghniya_user`
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`aghniya_role_id`) REFERENCES `aghniya_role` (`aghniya_role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
