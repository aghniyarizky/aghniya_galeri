-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jan 2025 pada 09.16
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `aghniya_album`
--

CREATE TABLE `aghniya_album` (
  `aghniya_album_id` int(11) NOT NULL,
  `aghniya_nama_album` varchar(255) NOT NULL,
  `aghniya_deskripsi` text NOT NULL,
  `aghniya_tanggal_dibuat` date NOT NULL,
  `aghniya_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `aghniya_album`
--

INSERT INTO `aghniya_album` (`aghniya_album_id`, `aghniya_nama_album`, `aghniya_deskripsi`, `aghniya_tanggal_dibuat`, `aghniya_user_id`) VALUES
(1, 'abcde', 'aaabbbcccdddeee', '2025-01-01', 1),
(2, 'uiiaiuiia', 'uiaioa', '2025-01-16', 1),
(3, 'aaaaaaaa', 'bbbbbbbb', '2025-01-16', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `aghniya_foto`
--

CREATE TABLE `aghniya_foto` (
  `aghniya_foto_id` int(11) NOT NULL,
  `aghniya_judul_foto` varchar(255) NOT NULL,
  `aghniya_deskripsi_foto` text NOT NULL,
  `aghniya_tanggal_unggah` date NOT NULL,
  `aghniya_lokasi_file` varchar(255) NOT NULL,
  `aghniya_album_id` int(11) NOT NULL,
  `aghniya_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `aghniya_foto`
--

INSERT INTO `aghniya_foto` (`aghniya_foto_id`, `aghniya_judul_foto`, `aghniya_deskripsi_foto`, `aghniya_tanggal_unggah`, `aghniya_lokasi_file`, `aghniya_album_id`, `aghniya_user_id`) VALUES
(1, 'nature.jpg', 'aa', '0000-00-00', 'public/nature.jpg', 1, 1),
(6, 'uuuuuuu', 'uuuuuuuu', '2025-01-16', 'public/abc.png', 2, 1),
(7, 'o', 'o', '2025-01-16', 'public/abcd.jpg', 1, 1),
(8, 'rrrrrr', 'rrrrrr', '2025-01-16', 'public/music.jpg', 2, 1),
(9, 'p', 'p', '2025-01-16', 'public/arts.jpg', 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `aghniya_komentar_foto`
--

CREATE TABLE `aghniya_komentar_foto` (
  `aghniya_komentar_id` int(11) NOT NULL,
  `aghniya_foto_id` int(11) NOT NULL,
  `aghniya_user_id` int(11) NOT NULL,
  `aghniya_isi_komentar` text NOT NULL,
  `aghniya_tanggal_komentar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `aghniya_komentar_foto`
--

INSERT INTO `aghniya_komentar_foto` (`aghniya_komentar_id`, `aghniya_foto_id`, `aghniya_user_id`, `aghniya_isi_komentar`, `aghniya_tanggal_komentar`) VALUES
(1, 1, 1, 'ababab', '0000-00-00'),
(2, 6, 1, 'aaaaa', '2025-01-15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `aghniya_like_foto`
--

CREATE TABLE `aghniya_like_foto` (
  `aghniya_like_id` int(11) NOT NULL,
  `aghniya_foto_id` int(11) NOT NULL,
  `aghniya_user_id` int(11) NOT NULL,
  `aghniya_tanggal_like` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `aghniya_like_foto`
--

INSERT INTO `aghniya_like_foto` (`aghniya_like_id`, `aghniya_foto_id`, `aghniya_user_id`, `aghniya_tanggal_like`) VALUES
(1, 1, 1, '0000-00-00'),
(2, 6, 1, '2025-01-14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `aghniya_user`
--

CREATE TABLE `aghniya_user` (
  `aghniya_user_id` int(11) NOT NULL,
  `aghniya_username` varchar(255) NOT NULL,
  `aghniya_password` varchar(225) NOT NULL,
  `aghniya_email` varchar(255) NOT NULL,
  `aghniya_nama_lengkap` varchar(255) NOT NULL,
  `aghniya_alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `aghniya_user`
--

INSERT INTO `aghniya_user` (`aghniya_user_id`, `aghniya_username`, `aghniya_password`, `aghniya_email`, `aghniya_nama_lengkap`, `aghniya_alamat`) VALUES
(1, 'niyaww', '0567746eccb450e95b9211335cb932ae', 'niya@gmail.com', 'niyaww', 'a'),
(2, 'adyila', 'dilaa', 'd@gmail.com', 'adyila', 'aaa');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aghniya_album`
--
ALTER TABLE `aghniya_album`
  ADD PRIMARY KEY (`aghniya_album_id`);

--
-- Indeks untuk tabel `aghniya_foto`
--
ALTER TABLE `aghniya_foto`
  ADD PRIMARY KEY (`aghniya_foto_id`);

--
-- Indeks untuk tabel `aghniya_komentar_foto`
--
ALTER TABLE `aghniya_komentar_foto`
  ADD PRIMARY KEY (`aghniya_komentar_id`);

--
-- Indeks untuk tabel `aghniya_like_foto`
--
ALTER TABLE `aghniya_like_foto`
  ADD PRIMARY KEY (`aghniya_like_id`);

--
-- Indeks untuk tabel `aghniya_user`
--
ALTER TABLE `aghniya_user`
  ADD PRIMARY KEY (`aghniya_user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aghniya_album`
--
ALTER TABLE `aghniya_album`
  MODIFY `aghniya_album_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `aghniya_foto`
--
ALTER TABLE `aghniya_foto`
  MODIFY `aghniya_foto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `aghniya_komentar_foto`
--
ALTER TABLE `aghniya_komentar_foto`
  MODIFY `aghniya_komentar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `aghniya_like_foto`
--
ALTER TABLE `aghniya_like_foto`
  MODIFY `aghniya_like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `aghniya_user`
--
ALTER TABLE `aghniya_user`
  MODIFY `aghniya_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
