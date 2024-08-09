-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Jul 2024 pada 12.35
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_imas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_absensi_guru`
--

CREATE TABLE `tb_absensi_guru` (
  `id_absensi` int(11) NOT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` enum('Hadir','Sakit','Izin','Alpha','Telat','Bolos') DEFAULT NULL,
  `id_semester` int(11) DEFAULT NULL,
  `id_thajaran` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_absensi_staff`
--

CREATE TABLE `tb_absensi_staff` (
  `id_absensi` int(11) NOT NULL,
  `id_staff` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` enum('Hadir','Sakit','Izin','Alpha','Telat','Bolos') NOT NULL,
  `id_semester` int(11) NOT NULL,
  `id_thajaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `aktif` varchar(5) NOT NULL,
  `foto` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_lengkap`, `username`, `password`, `aktif`, `foto`) VALUES
(1, 'Cep Akil Fikraattausi ', 'cepakil17@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Y', 'man (2).png'),
(2, 'Admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Y', 'LOGO1.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` int(11) NOT NULL,
  `nip` varchar(15) NOT NULL,
  `nama_guru` varchar(120) NOT NULL,
  `email` varchar(65) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `nip`, `nama_guru`, `email`, `password`, `foto`, `status`) VALUES
(12, 'A', 'Ajang Suryana, S.Pd.I', '-', '6dcd4ce23d88e2ee9568ba546c007c63d9131c1b', 'user man.png', 'Y'),
(13, 'B', 'Anggiani, S.Pd', '-', 'ae4f281df5a5d0ff3cad6371f76d5c29b6d953ec', 'user female.png', 'Y'),
(14, 'C', 'Aprilia Kusuma Dewi, S.Pd', '-', '32096c2e0eff33d844ee6d675407ace18289357d', 'user female.png', 'Y'),
(15, 'D', 'Deni Purnama, S.Pd ', '-', '50c9e8d5fc98727b4bbc93cf5d64a68db647f04f', 'user man.png', 'Y'),
(16, 'F', 'Dra. Hj. N. Neneng Nurasiah', '-', 'e69f20e9f683920d3fb4329abd951e878b1f9372', 'user female.png', 'Y'),
(17, 'G', 'Dra. Weti Rahmawati ', '-', 'a36a6718f54524d846894fb04b5b885b4e43e63b', 'user female.png', 'Y'),
(18, 'H', 'Drs. Wawang Dermawan', '-', '7cf184f4c67ad58283ecb19349720b0cae756829', 'user man.png', 'Y'),
(19, 'J', 'H. Maman,. S.Pd., M. Si ', '-', '58668e7669fd564d99db5d581fcdb6a5618440b5', 'user man.png', 'Y'),
(20, 'K', 'Inggit Sri Rahayu, S.Pd ', '-', 'a7ee38bb7be4fc44198cb2685d9601dcf2b9f569', 'user female.png', 'Y'),
(21, 'L', 'Jono Tarjono ', '-', 'd160e0986aca4714714a16f29ec605af90be704d', 'user man.png', 'Y'),
(22, 'M', 'Mithan Anggita Rahman, S.Pd', '-', 'c63ae6dd4fc9f9dda66970e827d13f7c73fe841c', 'user female.png', 'Y'),
(23, 'N', 'Nifal Nugraha', '-', 'b51a60734da64be0e618bacbea2865a8a7dcd669', 'user man.png', 'Y'),
(24, 'P', 'Resti Puji Lestari, S.Pd', '-', '511993d3c99719e38a6779073019dacd7178ddb9', 'user female.png', 'Y'),
(25, 'R', 'Verra Sandraini, S.Pd', '-', '06576556d1ad802f247cad11ae748be47b70cd9c', 'user female.png', 'Y'),
(26, 'Q', 'Wahyu Muhamad Adam', '-', 'c3156e00d3c2588c639e0d3cf6821258b05761c7', 'user man.png', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kepsek`
--

CREATE TABLE `tb_kepsek` (
  `id_kepsek` int(11) NOT NULL,
  `nip` varchar(15) NOT NULL,
  `nama_kepsek` varchar(120) NOT NULL,
  `email` varchar(65) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kepsek`
--

INSERT INTO `tb_kepsek` (`id_kepsek`, `nip`, `nama_kepsek`, `email`, `password`, `foto`, `status`) VALUES
(1, '19023L013021224', 'Ahmad Farid, S.Pd,I', '-', '4ce8e48be6c978348e4a6f4754b050de5581be4b', 'man (1).png', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_master_mapel`
--

CREATE TABLE `tb_master_mapel` (
  `id_mapel` int(11) NOT NULL,
  `kode_mapel` varchar(40) NOT NULL,
  `mapel` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_master_mapel`
--

INSERT INTO `tb_master_mapel` (`id_mapel`, `kode_mapel`, `mapel`) VALUES
(10, 'A1', 'Aswaja'),
(11, 'A2', 'PAIBD'),
(12, 'B1', 'Projek IPAS'),
(13, 'C1', 'Bisnis Online '),
(14, 'C2', 'P. Bisnis Ritel '),
(16, 'C3', 'Penataan Produk XI'),
(17, 'C4', 'Adm Transaksi XII '),
(18, 'D1', 'PJOK '),
(19, 'F1', 'PAIBD'),
(20, 'G1', 'B. Indonesia'),
(21, 'H1', 'Sejarah'),
(22, 'H2', 'Seni Budaya'),
(23, 'J1', 'Pend. Pancasila'),
(24, 'K1', 'B. Inggris '),
(25, 'L1', 'Mesin (PMKR)'),
(26, 'L2', 'Kelistrikan (PKKR)'),
(27, 'M1', 'B. Sunda'),
(28, 'M2', 'Pend. Pancasila'),
(29, 'BK', 'BK'),
(30, 'N1', 'Dasar-dasar Otomotif '),
(31, 'N2', 'PKK TKR'),
(32, 'N3', 'Informatika'),
(33, 'P1', 'Matematika '),
(34, 'R1', 'Dasar-dasar Pemasaran'),
(35, 'R2', 'PKK BD'),
(36, 'R3', 'Adm Transaksi XI'),
(37, 'R4', 'Penataan Produk XII'),
(38, 'Q1', 'Mesin (PMKR)'),
(39, 'Q2', 'Chasis (PSKR) ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mengajar`
--

CREATE TABLE `tb_mengajar` (
  `id_mengajar` int(11) NOT NULL,
  `kode_pelajaran` varchar(30) NOT NULL,
  `hari` varchar(40) NOT NULL,
  `jam_mengajar` varchar(60) NOT NULL,
  `jamke` varchar(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_mkelas` int(11) NOT NULL,
  `id_semester` int(11) NOT NULL,
  `id_thajaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_mengajar`
--

INSERT INTO `tb_mengajar` (`id_mengajar`, `kode_pelajaran`, `hari`, `jam_mengajar`, `jamke`, `id_guru`, `id_mapel`, `id_mkelas`, `id_semester`, `id_thajaran`) VALUES
(135, '', 'Senin, Selasa', '07.40-09.40/11.10-11.50', '2-4/6', 24, 33, 10, 4, 13),
(136, '', 'Senin, Selasa', '07.40-09.40 / 11.10-11.50', '2-4 / 6', 24, 33, 9, 4, 13),
(137, '', 'Senin', '10.30-11.50', '5-6', 12, 10, 9, 4, 13),
(139, '', 'Senin', '10.30-11.50', '5-6', 12, 10, 10, 4, 13),
(140, '', 'Senin', '113.30-15.50', '9-12', 23, 32, 9, 4, 13),
(141, '', 'Selasa', '07.00-08.20', '1-2', 18, 21, 9, 4, 13),
(142, '', 'Senin, Rabu', '12.20-13.30 / 08.20-09.40', '7-8 / 3-4', 17, 20, 9, 4, 13),
(143, '', 'Senin, Rabu', '12.20-13.30 / 08.20-09.40', '7-8 / 3-4', 17, 20, 10, 4, 13),
(144, '', 'Selasa', '08.20-11.10', '3-5', 15, 18, 9, 4, 13),
(145, '', 'Senin', '13.30-15.50', '9-12', 23, 32, 10, 4, 13),
(147, '', 'Selasa, Kamis, Jumat', '12.20-14.40 / 07.00-09.40 / 08.20-11.50', '7-10 / 1-4 ', 23, 30, 9, 4, 13),
(148, '', 'Selasa', '07.00-08.20', '1-2', 18, 21, 10, 4, 13),
(149, '', 'Rabu', '07.00-08.20', '1-2', 18, 22, 9, 4, 13),
(150, '', 'Selasa', '08.20-11.10', '3-5', 15, 18, 10, 4, 13),
(151, '', 'Selasa', '14.40 - 15-15', '11', 22, 29, 9, 4, 13),
(152, '', 'Rabu', '10.30-11.50', '5-6', 22, 28, 9, 4, 13),
(153, '', 'Rabu, Jumat', '12.20-14.40 / 07.00-08.20', '7-10 / 1-2', 13, 12, 9, 4, 13),
(154, '', 'Selasa, Kamis, Jumat', '12.20-14.40 / 07.00-09.40 / 08.20-09.40', '7-10 / 1-4 ', 25, 34, 10, 4, 13),
(155, '', 'Selasa', '14.40-15.15', '11', 22, 29, 10, 4, 13),
(156, '', 'Rabu', '10.30-12.55', '5-7', 16, 19, 9, 4, 13),
(157, '', 'Kamis', '12.55-15.15', '8-11', 20, 24, 9, 4, 13),
(158, '', 'Rabu', '07.00-08.20', '1-2', 18, 22, 10, 4, 13),
(159, '', 'Senin', '07.40-09.40', '2-4', 17, 20, 11, 4, 13),
(160, '', 'Rabu', '10.30 - 11.50', '5-6', 22, 28, 10, 4, 13),
(161, '', 'Senin', '10.30-15.50', '5-12', 26, 38, 11, 4, 13),
(162, '', 'Selasa', '07.00-09.00', '1-3', 20, 24, 11, 4, 13),
(163, '', 'Rabu, Jumat', '12.20-14.40 / 07.00 -08.20', '7-10 / 1-2', 13, 12, 10, 4, 13),
(164, '', 'Selasa', '09.00-15.15', '4-11', 26, 39, 11, 4, 13),
(165, '', 'Kamis', '10.30-12.55', '5-7', 16, 19, 10, 4, 13),
(166, '', 'Rabu', '07.00-09.00', '1-3', 16, 19, 11, 4, 13),
(167, '', 'Kamis', '12.55-15.15', '8-11', 20, 24, 10, 4, 13),
(168, '', 'Rabu', '09.00-09.40', '4', 22, 29, 11, 4, 13),
(169, '', 'Rabu, Jumat', '10.30-13.30 / 08.20-11.50', '5-8 / 3-6', 21, 26, 11, 4, 13),
(170, '', 'Rabu, Kamis', '13.30-15.15 / 13.30-14.40', '9-11 / 9-10', 23, 31, 11, 4, 13),
(171, '', 'Senin, Kamis', '07.40-09.00 / 07.00 - 09.40', '2-3 / 1-4', 14, 14, 12, 4, 13),
(172, '', 'Kamis', '07.00-08.20', '1-2', 22, 28, 11, 4, 13),
(173, '', 'Senin', '09.00-11.10', '4-5', 22, 27, 12, 4, 13),
(174, '', 'Senin', '11.10-15.50', '6-12', 25, 36, 12, 4, 13),
(175, '', 'Kamis', '08.20-11.50', '3-6', 24, 33, 11, 4, 13),
(176, '', 'Kamis', '12.20-13.30', '7-8', 15, 18, 11, 4, 13),
(177, '', 'Selasa, Jumat', '07.00-09.00 / 07.00-08.20', '1-3 / 1-2', 25, 35, 12, 4, 13),
(178, '', 'Kamis', '07.00-08.20', '1-2', 22, 27, 11, 4, 13),
(179, '', 'Selasa', '09.00 -11.50 ', '4-6', 20, 24, 12, 4, 13),
(180, '', 'Selasa', '12.20-12.55', '7', 22, 29, 12, 4, 13),
(181, '', 'Selasa, Kamis', '12.55-15.15 / 13.30-15.15', '8-11 / 9-11', 14, 13, 12, 4, 13),
(182, '', 'Rabu', '07.40-09.40', '1-4', 14, 16, 12, 4, 13),
(183, '', 'Senin, Selasa', '07.40-09.40 / 12.55-14.05', '2-4 / 8-9', 23, 31, 13, 4, 13),
(184, '', 'Rabu', '10.30-12.55', '5-7', 17, 20, 12, 4, 13),
(185, '', 'Senin', '10.30-11.50', '5-6', 17, 20, 13, 4, 13),
(186, '', 'Rabu', '12.55-14.40', '8-10', 12, 11, 12, 4, 13),
(187, '', 'Senin', '12.20-13.30', '7-8', 22, 27, 13, 4, 13),
(188, '', 'Kamis', '10.30-11.50', '5-6', 15, 18, 12, 4, 13),
(189, '', 'Kamis', '12.20-13.30', '7-8', 22, 28, 12, 4, 13),
(190, '', 'Senin', '13.30-15.50', '9-12', 20, 24, 13, 4, 13),
(191, '', 'Selasa', '07.00-09.40', '1-4', 24, 33, 13, 4, 13),
(192, '', 'Jumat', '08.20-11.50', '3-6', 24, 33, 12, 4, 13),
(193, '', 'Selasa, Rabu', '09.00-15.15 / 07.40-11.50', '4-11 / 2-6', 26, 38, 13, 4, 13),
(194, '', 'Senin', '07.40-09.00', '2-3', 22, 27, 15, 4, 13),
(195, '', 'Rabu', '07.00-07.40', '1', 22, 29, 13, 4, 13),
(196, '', 'Rabu', '12.20-14.05', '7-9', 16, 19, 13, 4, 13),
(197, '', 'Senin, Kamis', '09.00-11.10 / 12.55 - 14.40', '4-5 / 8-10', 25, 35, 15, 4, 13),
(198, '', 'Senin', '11.10-15.15', '6-11', 14, 14, 15, 4, 13),
(199, '', 'Selasa', '07.00-11.50', '1-6', 14, 17, 15, 4, 13),
(200, '', 'Kamis', '07.00-08.20', '1-2', 19, 23, 13, 4, 13),
(201, '', 'Selasa', '12.20-14.40', '7-10', 20, 24, 15, 4, 13),
(202, '', 'Kamis', '08.20-14.40', '3-10', 26, 39, 13, 4, 13),
(203, '', 'Jumat', '07.00-13.30', '1-8', 21, 26, 13, 4, 13),
(204, '', 'Rabu', '07.00-08.20', '1-2', 17, 20, 15, 4, 13),
(205, '', 'Senin', '07.40-14.05', '2-8', 26, 39, 14, 4, 13),
(206, '', 'Rabu', '08.20-13.30', '3-8', 25, 37, 15, 4, 13),
(207, '', 'Senin', '14.05-14.40', '10', 22, 29, 14, 4, 13),
(208, '', 'Rabu, Jumat', '13.30-15.15 / 08.20-11.50', '9-11 / 3-6', 14, 13, 15, 4, 13),
(209, '', 'Selasa', '07.00-08.20', '1-2', 17, 20, 14, 4, 13),
(210, '', 'Kamis, Jumat', '07.00-08.20 / 07.00-08.20', '1-2 / 1-2', 24, 33, 15, 4, 13),
(211, '', 'Selasa', '08.20 - 09.40', '3 - 4 ', 22, 27, 14, 4, 13),
(212, '', 'Kamis', '08.20-09.40', '3-4', 19, 23, 15, 4, 13),
(213, '', 'Kamis', '10.30-12.55', '5-7', 12, 11, 15, 4, 13),
(214, '', 'Kamis', '14.40-15.15', '11', 22, 29, 15, 4, 13),
(215, '', 'Selasa, Rabu', '10.30-11.50 / 07.00-09.00', '5-6 / 1-3', 23, 31, 14, 4, 13),
(216, '', 'Selasa', '12.20-14.40', '7-10', 24, 33, 14, 4, 13),
(217, '', 'Rabu', '09.00-15.15', '4-11', 21, 25, 14, 4, 13),
(218, '', 'Kamis', '07.00-09.00', '1-3', 16, 19, 14, 4, 13),
(219, '', 'Kamis', '09.00-12.55', '4-7', 20, 24, 14, 4, 13),
(220, '', 'Kamis', '12.55-14.05', '8-9', 19, 23, 14, 4, 13),
(221, '', 'Jumat', '07.00-13.30', '1-8', 21, 26, 14, 4, 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mkelas`
--

CREATE TABLE `tb_mkelas` (
  `id_mkelas` int(11) NOT NULL,
  `kd_kelas` varchar(40) NOT NULL,
  `nama_kelas` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_mkelas`
--

INSERT INTO `tb_mkelas` (`id_mkelas`, `kd_kelas`, `nama_kelas`) VALUES
(9, 'KL-1721886327', 'X TKR'),
(10, 'KL-1721886348', 'X BDP'),
(11, 'KL-1721886357', 'XI TKR'),
(12, 'KL-1721886370', 'XI BDP'),
(13, 'KL-1721886390', 'XII TKR 1'),
(14, 'KL-1721886405', 'XII TKR 2'),
(15, 'KL-1721886415', 'XII BDP');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_orangtua`
--

CREATE TABLE `tb_orangtua` (
  `id_orangtua` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `nama_orangtua` varchar(120) CHARACTER SET latin1 DEFAULT NULL,
  `nama_siswa` varchar(120) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_orangtua`
--

INSERT INTO `tb_orangtua` (`id_orangtua`, `id_siswa`, `nama_orangtua`, `nama_siswa`) VALUES
(3, 8, '-', 'AJENG NESYA OKTAVIA'),
(4, 9, '-', 'INDAH LESTARI'),
(5, 10, '-', 'NAZWA ALIPAH PUTERI SAMSURI'),
(6, 11, '-', 'RESTI'),
(7, 12, '-', 'SALMA PUTRI JAYANTI'),
(8, 13, '-', 'WULAN DARMAWAN'),
(9, 14, '-', 'DIRGA ADITYA PAMUNGKAS'),
(10, 15, '-', 'MUHAMMAD FAHRI'),
(11, 16, '-', 'MUHAMMAD SYAHRAFA ELFAUZI'),
(12, 17, '-', 'NABIL AL-MUGHNI'),
(13, 18, '-', 'RENDI'),
(14, 19, '-', 'RIVA FAUZI MAULANA'),
(15, 20, '-', 'SATRIA APRILIYANA SYAH'),
(16, 21, '-', 'SENDI'),
(18, 23, '-', 'AGNIYA NURUL AZIZAH'),
(19, 24, '-', 'AI RISMA JULIANI'),
(20, 25, '-', 'ASYIFA RAISA AL ZAHIRA'),
(21, 26, '-', 'AZAHRA ARDENTA'),
(22, 27, '-', 'ELSA NUR SAMSIAH'),
(23, 28, '-', 'LINDA MELIANAWATI'),
(24, 29, '-', 'NOVA RIFA FADILAH'),
(25, 30, '-', 'SERLI NURHAYATI'),
(26, 31, '-', 'WISNU RAHAYU'),
(27, 32, '-', 'ADRIAN SUWANDI'),
(28, 33, '-', 'AFRIZAL MUBARAQ'),
(29, 34, '-', 'ANDRIANA MUHAMAD RIZKI'),
(30, 35, '-', 'DAVA KAWASENDA'),
(32, 37, '-', 'DEMA'),
(33, 38, '-', 'DIKI MAULANA'),
(34, 39, '-', 'DEDE ANWAR MIFTAHUDIN'),
(35, 40, '-', 'FERDI JOHAN WIJAYA'),
(36, 41, '-', 'HAMDAN MUSTOPA'),
(37, 42, '-', 'IQBAL NURJAMIL'),
(38, 43, '-', 'MUHAMMAD NABIEL AL FARIZI'),
(39, 44, '-', 'NAUFAL DELIANA'),
(40, 45, '-', 'NUR FAUZI'),
(41, 46, '-', 'REISYA AL ZAHRA'),
(42, 47, '-', 'RIDWAN RAMDANI'),
(43, 48, '-', 'RIKO RAHADIANSYAH'),
(44, 49, '-', 'SEPI SEPTIAN'),
(45, 50, '-', 'SONY ROHIMAT'),
(46, 51, '-', 'TEJA AHMAD FAUZAN'),
(47, 52, '-', 'AI INDI MAULIDA'),
(48, 53, '-', 'APRIL LEVANIA PUTRI'),
(49, 54, '-', 'AULIA MAULANI'),
(50, 55, '-', 'AYU SRI MALA'),
(51, 56, '-', 'DEDE LESTARI'),
(52, 57, '-', 'DIANI NUR RAHMAWATI'),
(53, 58, '-', 'HANI HASTI RAMDANI'),
(54, 59, '-', 'JULPA'),
(55, 60, '-', 'KARINA ZAHRA AULIA'),
(56, 61, '-', 'MIA ROSMIATI'),
(57, 62, '-', 'OKTAVIA MUTIARA AUSTHINE'),
(58, 63, '-', 'SELLY FITRIANI'),
(59, 64, '-', 'SITI AMALIA'),
(60, 65, '-', 'TAZKIYAH AINUN NAJAH'),
(61, 66, '-', 'ADITYA PRATAMA'),
(62, 67, '-', 'AHMAD HIDAYAT'),
(63, 68, '-', 'ANDI NOVAL ANSHORI'),
(64, 69, '-', 'ARYA AWALLUDIN'),
(65, 70, '-', 'EGI PERMANA'),
(66, 71, '-', 'FAHRI RIZAL'),
(67, 72, '-', 'FEBI FIRMANSYAH'),
(68, 73, '-', 'HAIKAL SAHDA MAULANA'),
(69, 74, '-', 'IHSAN ARIPBILAH'),
(70, 75, '-', 'MOCHAMAD NOUFAL FEBRIAN'),
(71, 76, '-', 'MOCHAMMAD ZAQI RAMDHANI'),
(72, 77, '-', 'MUHAMAD GILANG SAPUTRA'),
(73, 78, '-', 'MUHAMMAD ANWAR RAMDANI'),
(74, 79, '-', 'REFI ILHAM MAULANA'),
(75, 80, '-', 'RIDHO RAMADHAN BURHANUDIN'),
(76, 81, '-', 'RIZWAN MULHAK'),
(77, 82, '-', 'SANSAN SEPTIA RAMADAN'),
(78, 83, '-', 'USEP FAHMI HAKIM'),
(79, 84, '-', 'YADI NURDIANTO'),
(80, 85, '-', 'ADITYA JULYANSYAH'),
(81, 86, '-', 'AGIL ALI PAJRIAN'),
(82, 87, '-', 'AHMAD RIDWAN'),
(83, 88, '-', 'AJI MUHAMMAD AJILLAH'),
(84, 89, '-', 'AMIR'),
(85, 90, '-', 'ARIP'),
(86, 91, '-', 'DANI NURSAMSI'),
(87, 92, '-', 'EKO SUPRASETIO'),
(88, 93, '-', 'FAIQ MUHAMAD NAJWAN'),
(89, 94, '-', 'FATHUL HILMAN ASYAHIDI'),
(90, 95, '-', 'HAIKHAL ADI PUTRA'),
(91, 96, '-', 'IQBAL NUGRAHA'),
(92, 97, '-', 'MUHAMAD DEVAN HERYANTO'),
(93, 98, '-', 'MUHAMAD ILHAM'),
(94, 99, '-', 'MUHAMAD RAMDAN'),
(95, 100, '-', 'MUHAMMAD ALBAR MUTAQIN'),
(96, 101, '-', 'MULDAN FAWAZ HAQ'),
(97, 102, '-', 'NABIL TAUFIK RAHMAN'),
(98, 103, '-', 'RANGGA WIJAYA'),
(99, 104, '-', 'RIAN ARDIANSAH'),
(100, 105, '-', 'RIO SATRIO'),
(101, 106, '-', 'SANDI SETIAWAN'),
(103, 108, '-', 'SIHABUDIN'),
(104, 109, '-', 'WILMA RAMDANI'),
(105, 110, '-', 'SURYA RAMDANI SUHENDAR');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_semester`
--

CREATE TABLE `tb_semester` (
  `id_semester` int(11) NOT NULL,
  `semester` varchar(45) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_semester`
--

INSERT INTO `tb_semester` (`id_semester`, `semester`, `status`) VALUES
(4, 'Ganjil', 1),
(5, 'Genap', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(60) NOT NULL,
  `nama_siswa` varchar(120) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` varchar(15) NOT NULL,
  `th_angkatan` year(4) NOT NULL,
  `id_mkelas` int(11) NOT NULL,
  `nama_orangtua` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `nis`, `nama_siswa`, `tempat_lahir`, `tgl_lahir`, `jk`, `alamat`, `password`, `foto`, `status`, `th_angkatan`, `id_mkelas`, `nama_orangtua`) VALUES
(8, '0091488787', 'AJENG NESYA OKTAVIA', '-', '0000-00-00', 'P', '-', 'ff8c36d8b16eef78ae708fe1258829e39b6cc239', 'user female.png', '1', 2024, 10, '-'),
(9, '0087958436', 'INDAH LESTARI', '-', '0000-00-00', 'P', '-', '55032a88882e373b21a73396046b679f63bde4c6', 'user female.png', '1', 2024, 10, '-'),
(10, '0084645863', 'NAZWA ALIPAH PUTERI S', '-', '0000-00-00', 'P', '-', 'f9d9318d969c24482b657100f2bd182b554e07ad', 'user female.png', '1', 2024, 10, '-'),
(11, '0083830253', 'RESTI', '-', '0000-00-00', 'P', '-', '20394b854ca255d9e536760ef9fef4ceb112cdc5', 'user female.png', '1', 2024, 10, '-'),
(12, '0089109296', 'SALMA PUTRI JAYANTI', '-', '0000-00-00', 'P', '-', 'ea9a72e15c56b5b106746998e135cccd37067469', 'user female.png', '1', 2024, 10, '-'),
(13, '3091675332', 'WULAN DARMAWAN', '-', '0000-00-00', 'P', '-', 'c4a2fd6ae72b76158806c87673ee456aac44521d', 'user female.png', '1', 2024, 10, '-'),
(14, '0081331858', 'DIRGA ADITYA PAMUNGKAS', '-', '0000-00-00', 'L', '-', 'b542c62e9020d4ea61bf651414fde95a8ed28f96', 'user man.png', '1', 2024, 9, '-'),
(15, '0089827086', 'MUHAMMAD FAHRI', '-', '0000-00-00', 'L', '-', '230a80455306ffeb8dcb2f34fcf7df7f33762279', 'user man.png', '1', 2024, 9, '-'),
(16, '0082200985', 'MUHAMMAD SYAHRAFA ELFAUZI', '-', '0000-00-00', 'L', '-', '4468907e2a147a1491546b3613ddf3a79d56184c', 'user man.png', '1', 2024, 9, '-'),
(17, '0084694764', 'NABIL AL-MUGHNI', '-', '0000-00-00', 'L', '-', 'fd5e26a211a771ce2f9fdc239db1eaf6ed7918ae', 'user man.png', '1', 2024, 9, '-'),
(18, '0086797896', 'RENDI', '-', '0000-00-00', 'L', '-', 'a7d20bbd418879601a367cb11f4aeb8441ad5dcf', 'user man.png', '1', 2024, 9, '-'),
(19, '0076756099', 'RIVA FAUZI MAULANA', '-', '0000-00-00', 'L', '-', 'dfb72bfb205c45204e7cff3b14a2042495957591', 'user man.png', '1', 2024, 9, '-'),
(20, '0097192307', 'SATRIA APRILIYANA SYAH', '-', '0000-00-00', 'L', '-', '722ec60a65eda0b217d72a065b221cb89c412446', 'user man.png', '1', 2024, 9, '-'),
(21, '0074232326', 'SENDI', '-', '0000-00-00', 'L', '-', '037105e6123f69fb9c35ef4417fab2ade8a57ac8', 'user man.png', '1', 2024, 9, '-'),
(23, '23240018', 'AGNIYA NURUL AZIZAH', '-', '0000-00-00', 'L', '-', '89f8093fa5f9ad70ada1285a90c1bfb4506f80dd', 'user female.png', '1', 2023, 12, '-'),
(24, '23240019', 'AI RISMA JULIANI', '-', '0000-00-00', 'P', '-', 'dba7c85e1bcd3fea0bf7283982a8c6e157e78bc6', 'user female.png', '1', 2023, 12, '-'),
(25, '23240020', 'ASYIFA RAISA AL ZAHIRA', '-', '0000-00-00', 'P', '-', '6608c0a0ca31445a123919bce333d24e2293e0dd', 'user female.png', '1', 2023, 12, '-'),
(26, '23240021', 'AZAHRA ARDENTA', '-', '0000-00-00', 'P', '-', 'b45812abeda587cda6bccba6cee86abd9f4f4dfd', 'user female.png', '1', 2023, 12, '-'),
(27, '23240022', 'ELSA NUR SAMSIAH', '-', '0000-00-00', 'P', '-', 'ac3971d0a27f2572c3e2f4e3637fdb4396d46701', 'user female.png', '1', 2023, 12, '-'),
(28, '23240023', 'LINDA MELIANAWATI', '-', '0000-00-00', 'P', '-', 'f2ab23e19c8f8e0b73340d39f7b9a29218dac9d3', 'user female.png', '1', 2023, 12, '-'),
(29, '23240024', 'NOVA RIFA FADILAH', '-', '0000-00-00', 'P', '-', '40427de8404fd6a8e2992bc3c8a631e7303f0a6e', 'user female.png', '1', 2023, 12, '-'),
(30, '23240025', 'SERLI NURHAYATI', '-', '0000-00-00', 'P', '-', '4119dfc23c24d931e5bda35dcd44ef058e804f55', 'user female.png', '1', 2023, 12, '-'),
(31, '23240026', 'WISNU RAHAYU', '-', '0000-00-00', 'P', '-', 'ee2ade454b4a90e0af0102231ef5462e1d5940e6', 'user female.png', '1', 2023, 12, '-'),
(32, '23240001', 'ADRIAN SUWANDI', '-', '0000-00-00', 'L', '-', 'aaf70c62b419f86d79538f904fffd6cfbb117b03', 'user man.png', '1', 2023, 11, '-'),
(33, '23240002', 'AFRIZAL MUBARAQ', '-', '0000-00-00', 'L', '-', '4cfbe241898711670a1a0e323c4d6fc120387f2a', 'user man.png', '1', 2023, 11, '-'),
(34, '23240003', 'ANDRIANA MUHAMAD RIZKI', '-', '0000-00-00', 'L', '-', '90452aa25bde95878ca5ccc8d498b28aa583c389', 'user man.png', '1', 2023, 11, '-'),
(35, '23240027', 'DAVA KAWASENDA', '-', '0000-00-00', 'L', '-', '638fa90a1f251052402a5dda19e715ae424db25c', 'user man.png', '1', 2023, 11, '-'),
(37, '23240004', 'DEMA', '-', '0000-00-00', 'L', '-', 'a6ce314ac5db8e6bbefe9aef99e1dac12da8619e', 'user man.png', '1', 2023, 11, '-'),
(38, '23240005', 'DIKI MAULANA', '-', '0000-00-00', 'L', '-', 'dbf2de14446a98eec95ede729200b4f2cd1dd381', 'user man.png', '1', 2023, 11, '-'),
(39, '23240028', 'DEDE ANWAR MIFTAHUDIN', '-', '0000-00-00', 'L', '-', '5948409b35e4c0f5756f4dffcd56adc9a60280b6', 'user man.png', '1', 2023, 11, '-'),
(40, '23240006', 'FERDI JOHAN WIJAYA', '-', '0000-00-00', 'L', '-', 'faf845990586b339b5e59f9ec4680487989615bb', 'user man.png', '1', 2023, 11, '-'),
(41, '23240007', 'HAMDAN MUSTOPA', '-', '0000-00-00', 'L', '-', '593cc82bbf4458e9ba9fd4a3d5da07687126ae5f', 'user man.png', '1', 2023, 11, '-'),
(42, '23240008', 'IQBAL NURJAMIL', '-', '0000-00-00', 'L', '-', 'e26e8f58190a49261adea857155aa72fe34ee01a', 'user man.png', '1', 2023, 11, '-'),
(43, '23240009', 'MUHAMMAD NABIEL AL FARIZI', '-', '0000-00-00', 'L', '-', 'ac1eb42bd889f2bd82f99c9b4b083bea49377faf', 'user man.png', '1', 2023, 11, '-'),
(44, '23240010', 'NAUFAL DELIANA', '-', '0000-00-00', 'L', '-', 'b06a4313d080343c59d3d2afea84968c2efdddd3', 'user man.png', '1', 2023, 11, '-'),
(45, '23240011', 'NUR FAUZI', '-', '0000-00-00', 'L', '-', '563707ece3318d9b194e662ec90df71bb8f6a4cb', 'user man.png', '1', 2023, 11, '-'),
(46, '23240012', 'REISYA AL ZAHRA', '-', '0000-00-00', 'L', '-', 'ca8aae68c6fa5a19ba8ff31e761ad59b852306fd', 'user man.png', '1', 2023, 11, '-'),
(47, '23240013', 'RIDWAN RAMDANI', '-', '0000-00-00', 'L', '-', '129ab21d45ec6c3c28278cc42e9b60d09b332a9f', 'user man.png', '1', 2023, 11, '-'),
(48, '23240014', 'RIKO RAHADIANSYAH', '-', '0000-00-00', 'L', '-', 'faab0f083a224964e7f7542a77485a09944d0013', 'user man.png', '1', 2023, 11, '-'),
(49, '23240015', 'SEPI SEPTIAN', '-', '0000-00-00', 'L', '-', '5afb099223260c0dd556c1ecf0f9f6c56b16c0a8', 'user man.png', '1', 2023, 11, '-'),
(50, '23240016', 'SONY ROHIMAT', '-', '0000-00-00', 'L', '-', '289874257c46c0557af09ac574fd61b543d1a435', 'user man.png', '1', 2023, 11, '-'),
(51, '23240017', 'TEJA AHMAD FAUZAN', '-', '0000-00-00', 'L', '-', 'f1fa609603291638c5fc42ca9b42719e78c87fac', 'user man.png', '1', 2023, 11, '-'),
(52, '22230045', 'AI INDI MAULIDA', '-', '0000-00-00', 'P', '-', '9ae50ec27c9e8b9590cd5ddef294d18b0d167f81', 'user female.png', '1', 2022, 15, '-'),
(53, '22230046', 'APRIL LEVANIA PUTRI', '-', '0000-00-00', 'P', '-', '8678c6721c79d2eada54b1fe7787723e9dc1135d', 'user female.png', '1', 2022, 15, '-'),
(54, '22230047', 'AULIA MAULANI', '-', '0000-00-00', 'P', '-', '9c895c393c6bbd31b2d03fbdcd231226f53635a8', 'user female.png', '1', 2022, 15, '-'),
(55, '22230048', 'AYU SRI MALA', '-', '0000-00-00', 'L', '-', 'ab35fd356ed5c4d491904d84f2825ff8c4f9234a', 'user female.png', '1', 2022, 15, '-'),
(56, '22230049', 'DEDE LESTARI', '-', '0000-00-00', 'P', '-', '663748193da5e3eeda57f239687e960b8a3a7ad4', 'user female.png', '1', 2022, 15, '-'),
(57, '22230050', 'DIANI NUR RAHMAWATI', '-', '0000-00-00', 'P', '-', '1e1647e234a0e2789086dad4f018979f6d7b78b6', 'user female.png', '1', 2022, 15, '-'),
(58, '22230051', 'HANI HASTI RAMDANI', '-', '0000-00-00', 'P', '-', 'a12224dc210ad3e5aa61dd7c8ac461389b70eaab', 'user female.png', '1', 2022, 15, '-'),
(59, '22230052', 'JULPA', '-', '0000-00-00', 'P', '-', '565e5845c7d079f0a25b7e1ae8aa32c33dbf67c9', 'user female.png', '1', 2022, 15, '-'),
(60, '22230053', 'KARINA ZAHRA AULIA', '-', '0000-00-00', 'P', '-', 'e9b1cdf383dab24f40599ccf8ac9bff8badf64d7', 'user female.png', '1', 2022, 15, '-'),
(61, '22230054', 'MIA ROSMIATI', '-', '0000-00-00', 'P', '-', '3bec680f6e784924b86339b11d847823eb9e9ce5', 'user female.png', '1', 2022, 15, '-'),
(62, '22230055', 'OKTAVIA MUTIARA AUSTHINE', '-', '0000-00-00', 'P', '-', '2e83b0b45ff97541d0abf0e428c57a262f4e3f40', 'user female.png', '1', 2022, 15, '-'),
(63, '22230056', 'SELLY FITRIANI', '-', '0000-00-00', 'P', '-', '6b9fc5243f09c90549f6898617928b919d9332a0', 'user female.png', '1', 2022, 15, '-'),
(64, '22230058', 'SITI AMALIA', '-', '0000-00-00', 'P', '-', '2542d1feac65dbc0761f3c82925cbd1e4c6b7b09', 'user female.png', '1', 2022, 15, '-'),
(65, '22230061', 'TAZKIYAH AINUN NAJAH', '-', '0000-00-00', 'P', '-', '219d9ae8fb8176aa15dca1d1b95c965fa0eadf66', 'user female.png', '1', 2022, 15, '-'),
(66, '22230001', 'ADITYA PRATAMA', '-', '0000-00-00', 'L', '-', 'c342a4d5ae8bd5d0fe40e0ad942daca181c277cc', 'user man.png', '1', 2022, 13, '-'),
(67, '22230003', 'AHMAD HIDAYAT', '-', '0000-00-00', 'L', '-', '2a70c8d3d1d861b296effae6c88c0223a371dae5', 'user man.png', '1', 2022, 13, '-'),
(68, '22230006', 'ANDI NOVAL ANSHORI', '-', '0000-00-00', 'L', '-', 'db3abbce84de218ad361c5d7ca4abf30c3e204fc', 'user man.png', '1', 2022, 13, '-'),
(69, '22230008', 'ARYA AWALLUDIN', '-', '0000-00-00', 'L', '-', 'afedd2d4a9dea0a1aacd3bc678268b531fed6f5f', 'user man.png', '1', 2022, 13, '-'),
(70, '22230065', 'EGI PERMANA', '-', '0000-00-00', 'L', '-', '8390df63cc017bfbf22cc2a2d3a7e25e4231f704', 'user man.png', '1', 2022, 13, '-'),
(71, '22230012', 'FAHRI RIZAL', '-', '0000-00-00', 'L', '-', '391e24ae607cb385319125e0781504782090c9b8', 'user man.png', '1', 2022, 13, '-'),
(72, '22230016', 'FEBI FIRMANSYAH', '-', '0000-00-00', 'L', '-', '300091bfa361e5218fa42de220ca35fc43830fe8', 'user man.png', '1', 2022, 13, '-'),
(73, '22230063', 'HAIKAL SAHDA MAULANA', '-', '0000-00-00', 'L', '-', 'b50ac613737801bcc74ae9662f08a406bca45af6', 'user man.png', '1', 2022, 13, '-'),
(74, '22230018', 'IHSAN ARIPBILAH', '-', '0000-00-00', 'L', '-', '1ba8a3dd09741e1ac4565689c6d9efb8e8c213cf', 'user man.png', '1', 2022, 13, '-'),
(75, '22230024', 'MOCHAMAD NOUFAL FEBRIAN', '-', '0000-00-00', 'L', '-', 'd84e0d2df68451eeefa661c29d33671b31815883', 'user man.png', '1', 2022, 13, '-'),
(76, '22230026', 'MOCHAMMAD ZAQI RAMDHANI', '-', '0000-00-00', 'L', '-', '04ab3f3c2057d97b60e05007793f5fa8db92a145', 'user man.png', '1', 2022, 13, '-'),
(77, '22230022', 'MUHAMAD GILANG SAPUTRA', '-', '0000-00-00', 'L', '-', 'de589b4031b3259520bb14c3fdc1d67e359e14dc', 'user man.png', '1', 2022, 13, '-'),
(78, '22230020', 'MUHAMMAD ANWAR RAMDANI', '-', '0000-00-00', 'L', '-', '6723dbdca3aa8d02e78e0317cf999c4fa7620af2', 'user man.png', '1', 2022, 13, '-'),
(79, '22230032', 'REFI ILHAM MAULANA', '-', '0000-00-00', 'L', '-', '4dcd2e3b9461693443f3376faa6b68259ca43ede', 'user man.png', '1', 2022, 13, '-'),
(80, '22230034', 'RIDHO RAMADHAN BURHANUDIN', '-', '0000-00-00', 'L', '-', 'a46b15bca026be200c7673d97791f4bfe1187b16', 'user man.png', '1', 2022, 13, '-'),
(81, '22230037', 'RIZWAN MULHAK', '-', '0000-00-00', 'L', '-', 'd4c2e97ada90ede59d280a2da5f9544ad9554688', 'user man.png', '1', 2022, 13, '-'),
(82, '22230040', 'SANSAN SEPTIA RAMADAN', '-', '0000-00-00', 'L', '-', '02082032985c3a87c6ed83ca92cd48dd2178145e', 'user man.png', '1', 2022, 13, '-'),
(83, '22230042', 'USEP FAHMI HAKIM', '-', '0000-00-00', 'L', '-', '1896e8ef88391b8ad89b62cb952bf3ed700e1e06', 'user man.png', '1', 2022, 13, '-'),
(84, '22230044', 'YADI NURDIANTO', '-', '0000-00-00', 'L', '-', '9203b87c571a449a97df1c3c3c6708f53cc4b291', 'user man.png', '1', 2022, 13, '-'),
(85, '22230064', 'ADITYA JULYANSYAH', '-', '0000-00-00', 'L', '-', '5b7a90c06014c63d866387f67320dfeb37c654d0', 'user man.png', '1', 2022, 14, '-'),
(86, '22230002', 'AGIL ALI PAJRIAN', '-', '0000-00-00', 'L', '-', '2ecf75487e2b355594067503c6a5b400e0ece8d3', 'user man.png', '1', 2022, 14, '-'),
(87, '22230004', 'AHMAD RIDWAN', '-', '0000-00-00', 'L', '-', 'c4f8e1c2f9b9ff0384817c418b1d1651ee5ee18a', 'user man.png', '1', 2022, 14, '-'),
(88, '22230005', 'AJI MUHAMMAD AJILLAH', '-', '0000-00-00', 'L', '-', 'e13bcbdacf9816c32e167bf92b466c219605f7ca', 'user man.png', '1', 2022, 14, '-'),
(89, '22230062', 'AMIR', '-', '0000-00-00', 'L', '-', '7eba18ada9a189aee83692326e88fa68bc5fb3a9', 'user man.png', '1', 2022, 14, '-'),
(90, '22230007', 'ARIP', '-', '0000-00-00', 'L', '-', 'f2145f3199486e8d974f153c3c6e30c10c91fd10', 'user man.png', '1', 2022, 14, '-'),
(91, '22230009', 'DANI NURSAMSI', '-', '0000-00-00', 'L', '-', 'a2330daa08ce8f83d0b4dde266e890520cdd608a', 'user man.png', '1', 2022, 14, '-'),
(92, '22230011', 'EKO SUPRASETIO', '-', '0000-00-00', 'L', '-', 'bea16e194fc26e90471badc9a405a4c3a7a9f8a3', 'user man.png', '1', 2022, 14, '-'),
(93, '22230013', 'FAIQ MUHAMAD NAJWAN', '-', '0000-00-00', 'L', '-', 'fb2d645b6a3076cb948869690ee3d6c2e9cfa677', 'user man.png', '1', 2022, 14, '-'),
(94, '22230015', 'FATHUL HILMAN ASYAHIDI', '-', '0000-00-00', 'L', '-', '8b6a77e585b02e6ff8c950835ae075327d326f49', 'user man.png', '1', 2022, 14, '-'),
(95, '22230017', 'HAIKHAL ADI PUTRA', '-', '0000-00-00', 'L', '-', 'c897a3f64d96909a4c34841a6f10fc88acec9425', 'user man.png', '1', 2022, 14, '-'),
(96, '22230019', 'IQBAL NUGRAHA', '-', '0000-00-00', 'L', '-', '378c07b6821a99a55b3b2d70914d36da3a2de81a', 'user man.png', '1', 2022, 14, '-'),
(97, '22230027', 'MUHAMAD DEVAN HERYANTO', '-', '0000-00-00', 'L', '-', 'e5e17f1322a0eacec3971b89ade28b0a9c4a5bef', 'user man.png', '1', 2022, 14, '-'),
(98, '22230025', 'MUHAMAD ILHAM', '-', '0000-00-00', 'L', '-', '1ff71d14a0b7bdc5cc7d426b01a127a15d5cff03', 'user man.png', '1', 2022, 14, '-'),
(99, '22230023', 'MUHAMAD RAMDAN', '-', '0000-00-00', 'L', '-', 'aefb096f6c0dde57ad2c9a6126e3db850a03e280', 'user man.png', '1', 2022, 14, '-'),
(100, '22230021', 'MUHAMMAD ALBAR MUTAQIN', '-', '0000-00-00', 'L', '-', '3a8dff3dfbc59dd689c41e3c4e38f8b506a6dc58', 'user man.png', '1', 2022, 14, '-'),
(101, '22230028', 'MULDAN FAWAZ HAQ', '-', '0000-00-00', 'L', '-', 'cd03bd08f6a95f784211a4a4c7ea400492d1fe1d', 'user man.png', '1', 2022, 14, '-'),
(102, '22230029', 'NABIL TAUFIK RAHMAN', '-', '0000-00-00', 'L', '-', '7eb0172c30b079df363c88386d4cffc7c5b96d29', 'user man.png', '1', 2022, 14, '-'),
(103, '22230031', 'RANGGA WIJAYA', '-', '0000-00-00', 'L', '-', '4ed68c96c5566e68979ccceaaa0b195a496b05d6', 'user man.png', '1', 2022, 14, '-'),
(104, '22230033', 'RIAN ARDIANSAH', '-', '0000-00-00', 'L', '-', '8487df646c26207da8fdb07ee36f87fc181db494', 'user man.png', '1', 2022, 14, '-'),
(105, '22230035', 'RIO SATRIO', '-', '0000-00-00', 'L', '-', 'e5fc457e56acbf41f79cb8b597cbcd67ff0d8217', 'user man.png', '1', 2022, 14, '-'),
(106, '22230039', 'SANDI SETIAWAN', '-', '0000-00-00', 'L', '-', 'b24743d67a9b17426053b9e87a04a0ec94c959ce', 'user man.png', '1', 2022, 14, '-'),
(108, '22230057', 'SIHABUDIN', '-', '0000-00-00', 'L', '-', 'cc8e577cde0dcbe4c2d39f75a231e32dd546d7ed', 'user man.png', '1', 2022, 14, '-'),
(109, '22230043', 'WILMA RAMDANI', '-', '0000-00-00', 'L', '-', '838f20423e05e3531832f2856e3ba9eca9cd1852', 'user man.png', '1', 2022, 14, '-'),
(110, '22230059', 'SURYA RAMDANI SUHENDAR', '-', '0000-00-00', 'L', '-', '18210473757deafddb09338fa7439177445008f9', 'user man.png', '1', 2022, 13, '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_staff`
--

CREATE TABLE `tb_staff` (
  `id_staff` int(11) NOT NULL,
  `nama_staff` varchar(120) CHARACTER SET latin1 NOT NULL,
  `email` varchar(65) CHARACTER SET latin1 NOT NULL,
  `password` int(100) NOT NULL,
  `foto` varchar(255) CHARACTER SET latin1 NOT NULL,
  `status` varchar(5) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_staff`
--

INSERT INTO `tb_staff` (`id_staff`, `nama_staff`, `email`, `password`, `foto`, `status`) VALUES
(4, 'Dewi Fitri Hapsari', '-', 4, 'user female.png', 'Y'),
(5, 'Sopia Yuliani', '-', 2147483647, 'user female.png', 'Y'),
(6, 'Eli Sulastri', '-', 0, 'user female.png', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_thajaran`
--

CREATE TABLE `tb_thajaran` (
  `id_thajaran` int(11) NOT NULL,
  `tahun_ajaran` varchar(30) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_thajaran`
--

INSERT INTO `tb_thajaran` (`id_thajaran`, `tahun_ajaran`, `status`) VALUES
(13, '2024/2025', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_walikelas`
--

CREATE TABLE `tb_walikelas` (
  `id_walikelas` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_mkelas` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(5) NOT NULL,
  `nip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_walikelas`
--

INSERT INTO `tb_walikelas` (`id_walikelas`, `id_guru`, `id_mkelas`, `password`, `status`, `nip`) VALUES
(12, 5, 5, 'walikelas', 'aktif', 'A'),
(13, 6, 6, 'walikelas', 'aktif', 'B'),
(14, 7, 8, 'walikelas', 'aktif', 'B'),
(15, 10, 5, 'walikelas', 'aktif', 'A'),
(16, 24, 9, 'walikelas', 'aktif', 'P'),
(17, 24, 10, 'walikelas', 'aktif', 'P'),
(18, 26, 11, 'walikelas', 'aktif', 'Q'),
(19, 25, 12, 'walikelas', 'aktif', 'R'),
(20, 20, 13, 'walikelas', 'aktif', 'K'),
(21, 22, 14, 'walikelas', 'aktif', 'M'),
(22, 14, 15, 'walikelas', 'aktif', 'C');

-- --------------------------------------------------------

--
-- Struktur dari tabel `_logabsensi`
--

CREATE TABLE `_logabsensi` (
  `id_presensi` int(11) NOT NULL,
  `id_mengajar` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `tgl_absen` date NOT NULL,
  `ket` enum('H','I','S','T','A','B') NOT NULL,
  `pertemuan_ke` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_absensi_guru`
--
ALTER TABLE `tb_absensi_guru`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_semester` (`id_semester`),
  ADD KEY `id_thajaran` (`id_thajaran`);

--
-- Indeks untuk tabel `tb_absensi_staff`
--
ALTER TABLE `tb_absensi_staff`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `id_staff` (`id_staff`);

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indeks untuk tabel `tb_kepsek`
--
ALTER TABLE `tb_kepsek`
  ADD PRIMARY KEY (`id_kepsek`);

--
-- Indeks untuk tabel `tb_master_mapel`
--
ALTER TABLE `tb_master_mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indeks untuk tabel `tb_mengajar`
--
ALTER TABLE `tb_mengajar`
  ADD PRIMARY KEY (`id_mengajar`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indeks untuk tabel `tb_mkelas`
--
ALTER TABLE `tb_mkelas`
  ADD PRIMARY KEY (`id_mkelas`);

--
-- Indeks untuk tabel `tb_orangtua`
--
ALTER TABLE `tb_orangtua`
  ADD PRIMARY KEY (`id_orangtua`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indeks untuk tabel `tb_semester`
--
ALTER TABLE `tb_semester`
  ADD PRIMARY KEY (`id_semester`);

--
-- Indeks untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indeks untuk tabel `tb_staff`
--
ALTER TABLE `tb_staff`
  ADD PRIMARY KEY (`id_staff`);

--
-- Indeks untuk tabel `tb_thajaran`
--
ALTER TABLE `tb_thajaran`
  ADD PRIMARY KEY (`id_thajaran`);

--
-- Indeks untuk tabel `tb_walikelas`
--
ALTER TABLE `tb_walikelas`
  ADD PRIMARY KEY (`id_walikelas`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indeks untuk tabel `_logabsensi`
--
ALTER TABLE `_logabsensi`
  ADD PRIMARY KEY (`id_presensi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_absensi_guru`
--
ALTER TABLE `tb_absensi_guru`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=334;

--
-- AUTO_INCREMENT untuk tabel `tb_absensi_staff`
--
ALTER TABLE `tb_absensi_staff`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `tb_kepsek`
--
ALTER TABLE `tb_kepsek`
  MODIFY `id_kepsek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_master_mapel`
--
ALTER TABLE `tb_master_mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `tb_mengajar`
--
ALTER TABLE `tb_mengajar`
  MODIFY `id_mengajar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT untuk tabel `tb_mkelas`
--
ALTER TABLE `tb_mkelas`
  MODIFY `id_mkelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_orangtua`
--
ALTER TABLE `tb_orangtua`
  MODIFY `id_orangtua` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT untuk tabel `tb_semester`
--
ALTER TABLE `tb_semester`
  MODIFY `id_semester` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT untuk tabel `tb_staff`
--
ALTER TABLE `tb_staff`
  MODIFY `id_staff` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_thajaran`
--
ALTER TABLE `tb_thajaran`
  MODIFY `id_thajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_walikelas`
--
ALTER TABLE `tb_walikelas`
  MODIFY `id_walikelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `_logabsensi`
--
ALTER TABLE `_logabsensi`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_absensi_guru`
--
ALTER TABLE `tb_absensi_guru`
  ADD CONSTRAINT `tb_absensi_guru_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `tb_guru` (`id_guru`),
  ADD CONSTRAINT `tb_absensi_guru_ibfk_2` FOREIGN KEY (`id_semester`) REFERENCES `tb_semester` (`id_semester`),
  ADD CONSTRAINT `tb_absensi_guru_ibfk_3` FOREIGN KEY (`id_thajaran`) REFERENCES `tb_thajaran` (`id_thajaran`);

--
-- Ketidakleluasaan untuk tabel `tb_absensi_staff`
--
ALTER TABLE `tb_absensi_staff`
  ADD CONSTRAINT `tb_absensi_staff_ibfk_1` FOREIGN KEY (`id_staff`) REFERENCES `tb_staff` (`id_staff`);

--
-- Ketidakleluasaan untuk tabel `tb_orangtua`
--
ALTER TABLE `tb_orangtua`
  ADD CONSTRAINT `tb_orangtua_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `tb_siswa` (`id_siswa`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
