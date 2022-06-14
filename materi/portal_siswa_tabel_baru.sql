-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2022 at 08:36 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal_siswa_tabel_baru`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(100) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `id_kelas` int(100) NOT NULL,
  `id_pelajaran` int(100) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('hadir','tidak hadir','izin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `nama_siswa`, `id_kelas`, `id_pelajaran`, `tanggal`, `status`) VALUES
(348, 'abcd', 2, 3, '2022-06-13', 'tidak hadir'),
(421, 'Steven Justin Saputra', 3, 3, '2022-05-10', 'izin'),
(428, 'Steven Justin Saputra', 3, 3, '2022-05-04', 'izin'),
(435, 'Steven Justin Saputra', 3, 3, '2022-05-02', 'hadir'),
(1318, 'Steven Justin Saputra', 3, 2, '2022-06-07', 'izin'),
(2657, 'Selly Marsenia', 3, 3, '2022-05-26', 'tidak hadir'),
(3013, 'Steven Justin Saputra', 3, 3, '2022-06-13', 'izin'),
(3052, 'afgggg', 3, 6, '2022-06-06', 'tidak hadir'),
(3107, 'Steven Justin Saputra', 3, 2, '2022-06-08', 'hadir'),
(3118, 'Steven Justin Saputra', 3, 3, '2022-06-10', 'tidak hadir'),
(3130, 'Steven Justin Saputra', 3, 2, '2022-05-30', 'izin'),
(3143, 'Steven Justin Saputra', 3, 3, '2022-06-08', 'tidak hadir'),
(3154, 'Selly Marsenia', 3, 3, '2022-06-07', 'tidak hadir'),
(3207, 'Steven Justin Saputra', 3, 3, '2022-06-14', 'izin'),
(4156, 'Steven Justin Saputra', 3, 3, '2022-06-07', 'hadir');

-- --------------------------------------------------------

--
-- Table structure for table `bulan`
--

CREATE TABLE `bulan` (
  `id_bulan` int(100) NOT NULL,
  `nama_bulan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bulan`
--

INSERT INTO `bulan` (`id_bulan`, `nama_bulan`) VALUES
(1, 'Juli'),
(2, 'Agustus'),
(3, 'September'),
(4, 'Oktober'),
(5, 'November'),
(6, 'Desember'),
(7, 'Januari'),
(8, 'Februari'),
(9, 'Maret'),
(10, 'April'),
(11, 'Mei'),
(12, 'Juni'),
(13, 'Out ot month');

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `id_comment` int(11) NOT NULL,
  `id_comment_parent` int(11) NOT NULL,
  `comment` varchar(2500) CHARACTER SET utf8 NOT NULL,
  `nama_user` varchar(40) CHARACTER SET utf8 NOT NULL,
  `status` enum('guru','murid') NOT NULL,
  `id_pelajaran` int(50) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id_comment`, `id_comment_parent`, `comment`, `nama_user`, `status`, `id_pelajaran`, `id_kelas`, `tanggal`) VALUES
(248, 0, '<p>hallo</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'Rutma Parningotan', 'guru', 3, 2, '2022-06-01 17:27:43'),
(251, 250, '<p>aaaaa</p>\r\n', 'Selly Marsenia', 'guru', 3, 3, '2022-06-02 01:52:32'),
(256, 255, '<p>yessaaaaaaaa</p>\r\n', 'Selly Marsenia', '', 3, 3, '2022-06-02 01:58:24'),
(261, 258, '<p>aaaaa</p>\r\n', 'Selly Marsenia', '', 3, 3, '2022-06-02 02:00:00'),
(262, 258, '<p><s>aaaaaaaaaaaaaaaa</s></p>\r\n', 'Selly Marsenia', '', 3, 3, '2022-06-02 02:00:08'),
(264, 261, '<p>qqqqqq</p>\r\n', 'Selly Marsenia', '', 3, 3, '2022-06-02 02:01:40'),
(267, 265, '<p>yess</p>\r\n', 'Selly Marsenia', '', 3, 3, '2022-06-02 02:02:17'),
(269, 268, '<p>nices</p>\r\n', 'Selly Marsenia', '', 3, 3, '2022-06-02 02:06:22'),
(270, 268, '<p>bagaimana kalo tidak</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'Selly Marsenia', '', 3, 3, '2022-06-02 02:06:32'),
(271, 268, '<p>aaaaaa</p>\r\n', 'Selly Marsenia', '', 3, 3, '2022-06-02 02:08:00'),
(273, 272, '<p>2</p>\r\n', 'Selly Marsenia', '', 3, 3, '2022-06-02 02:09:31'),
(274, 272, '<p>1-3</p>\r\n', 'Selly Marsenia', '', 3, 3, '2022-06-02 02:09:38'),
(275, 272, '<p>akoooooooo</p>\r\n', 'Selly Marsenia', '', 3, 3, '2022-06-02 02:21:36'),
(277, 276, '<p>2</p>\r\n', 'Selly Marsenia', '', 3, 3, '2022-06-02 02:46:49'),
(278, 277, '<p>3</p>\r\n', 'Selly Marsenia', '', 3, 3, '2022-06-02 02:46:54'),
(279, 276, '<p>1-2</p>\r\n', 'Selly Marsenia', '', 3, 3, '2022-06-02 02:47:01'),
(281, 276, '<p>1-3</p>\r\n', 'Selly Marsenia', '', 3, 3, '2022-06-02 02:51:54'),
(283, 249, '<p>1</p>\r\n', 'Selly Marsenia', '', 3, 3, '2022-06-02 02:54:17'),
(285, 284, '<p>2</p>\r\n', 'Selly Marsenia', '', 3, 3, '2022-06-02 02:58:35'),
(286, 285, '<p>3</p>\r\n', 'Selly Marsenia', '', 3, 3, '2022-06-02 02:58:39'),
(287, 285, '<p>33</p>\r\n', 'Selly Marsenia', '', 3, 3, '2022-06-02 02:58:47'),
(288, 284, '<p>3333</p>\r\n', 'Selly Marsenia', '', 3, 3, '2022-06-02 02:58:54'),
(289, 0, '<p>1</p>\r\n', 'Rutma Parningotan', 'guru', 3, 3, '2022-06-02 03:00:19'),
(290, 289, '<p>1-2</p>\r\n', 'Rutma Parningotan', 'guru', 3, 3, '2022-06-02 03:00:28'),
(291, 289, '<p>1-3</p>\r\n', 'Rutma Parningotan', 'guru', 3, 3, '2022-06-02 03:00:36'),
(292, 289, '<p>1-4</p>\r\n', 'Selly Marsenia', '', 3, 3, '2022-06-02 03:01:38'),
(293, 289, '<p>1-6</p>\r\n', 'Rutma Parningotan', 'guru', 3, 3, '2022-06-02 03:02:02'),
(294, 289, '<p>1-7</p>\r\n', 'Rutma Parningotan', 'guru', 3, 3, '2022-06-02 03:03:18'),
(295, 293, '<p>anjayyyy</p>\r\n', 'Rutma Parningotan', 'guru', 3, 3, '2022-06-02 03:03:25'),
(296, 292, '<p>sengol dong</p>\r\n', 'Rutma Parningotan', 'guru', 3, 3, '2022-06-02 03:03:35'),
(297, 0, '<p>1</p>\r\n', 'Kristoforus Gustian', 'guru', 2, 2, '2022-06-02 03:06:03'),
(298, 0, '<p>2</p>\r\n', 'Kristoforus Gustian', 'guru', 2, 2, '2022-06-02 03:06:08'),
(299, 297, '<p>1-1</p>\r\n', 'Kristoforus Gustian', 'guru', 2, 2, '2022-06-02 03:06:12'),
(300, 298, '<p>2-1</p>\r\n', 'Kristoforus Gustian', 'guru', 2, 2, '2022-06-02 03:06:20'),
(301, 297, '<p>1-2</p>\r\n', 'Kristoforus Gustian', 'guru', 2, 2, '2022-06-02 03:06:28'),
(302, 299, '<p>1-1-1</p>\r\n', 'Kristoforus Gustian', 'guru', 2, 2, '2022-06-02 03:07:56'),
(303, 301, '<p>1-2-1</p>\r\n', 'Kristoforus Gustian', 'guru', 2, 2, '2022-06-02 03:08:04'),
(304, 0, '<p>tes09</p>\r\n', 'Rutma Parningotan', 'guru', 3, 3, '2022-06-02 15:30:36'),
(305, 304, '<p>tes10</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'Rutma Parningotan', 'guru', 3, 3, '2022-06-02 15:30:43'),
(306, 305, '<p>tes11</p>\r\n', 'Rutma Parningotan', 'guru', 3, 3, '2022-06-02 15:30:48'),
(307, 305, '<p>tes12</p>\r\n', 'Rutma Parningotan', 'guru', 3, 3, '2022-06-02 15:30:54'),
(308, 305, '<p>tes14</p>\r\n', 'Selly Marsenia', '', 3, 3, '2022-06-02 15:31:22'),
(309, 305, '<p>tes15</p>\r\n', 'Steven Justin Saputra', '', 3, 3, '2022-06-02 15:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `foto_profil`
--

CREATE TABLE `foto_profil` (
  `id_user` int(255) NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(50) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nama_guru`, `tanggal_lahir`, `gender`, `no_hp`, `alamat`) VALUES
(11, 'Kristoforus Gustian', '1979-06-11', 'L', '081528621835', 'Jl. P Suryanata, Perum Bukit Pinang, Blok Q No. 5'),
(12, 'Rutma Parningotan', '1980-10-30', 'P', '085346726572', 'Jl. AM. Sangaji Gg. 14 RT. 10 No. 69'),
(13, 'Binata Prabawa', '1979-02-07', 'L', '08115580556', 'Jl.Turi Putih 4 No. 313. Sempaja Timur'),
(14, 'Martha Sari', '1970-10-15', 'P', '081217653888', 'Jl. Pulau Flores No. 16'),
(15, 'sam', '1222-11-11', 'L', '12', '12'),
(111, 'yulia', '1313-12-13', 'P', '131', '133'),
(222, 'julius cesar', '1414-12-14', 'P', '511', '1551'),
(333, 'tina', '5666-12-04', 'P', '1251', '1412'),
(444, 'pola', '3141-12-12', 'L', '142138', '141414'),
(555, 'ilang', '1515-12-15', 'P', '151', '1111'),
(1251, 'lola', '1944-12-04', 'L', '121', '444');

-- --------------------------------------------------------

--
-- Table structure for table `hari`
--

CREATE TABLE `hari` (
  `id_hari` int(11) NOT NULL,
  `nama_hari` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hari`
--

INSERT INTO `hari` (`id_hari`, `nama_hari`) VALUES
(1, 'Senin'),
(2, 'Selasa'),
(3, 'Rabu'),
(4, 'Kamis'),
(5, 'Jumat'),
(6, 'Sabtu');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_pelajaran` int(50) NOT NULL,
  `id_kelas` int(100) NOT NULL,
  `id_guru` int(100) NOT NULL,
  `jam` varchar(100) NOT NULL,
  `no_hari` varchar(100) NOT NULL,
  `link_vidcon` varchar(100) NOT NULL,
  `materijadwal` text NOT NULL,
  `UTS` varchar(255) DEFAULT NULL,
  `UAS` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_pelajaran`, `id_kelas`, `id_guru`, `jam`, `no_hari`, `link_vidcon`, `materijadwal`, `UTS`, `UAS`) VALUES
(3213140, 2, 2, 11, '07.30 - 08.50', '1', 'https://meet.google.com/fqe-zwxb-hqn', 'Bahasa Inggris.jpeg', NULL, NULL),
(3213141, 3, 2, 12, '10.40 - 12.00', '5', 'https://zoom', 'Sosiologi.JPG', NULL, NULL),
(3213142, 3, 3, 12, '07.30 - 08.50', '5', 'https://meet', 'Sosiologi.JPG', NULL, NULL),
(3213143, 2, 3, 11, '08.00-10.30', '4', 'https://teams', 'Bahasa Inggris.jpeg', NULL, NULL),
(3213144, 9, 4, 13, '16.00 - 17.00', '3', 'https://', 'pelajaran_4_13_20220613_124010_Picture1.jpg', NULL, NULL),
(3213145, 8, 6, 555, '07.30 - 08.50', '4', 'https://', 'pelajaran_6_555_20220613_124052_Picture1.jpg', NULL, NULL),
(3213146, 8, 9, 1251, '10.40 - 12.00', '6', 'https://', 'pelajaran_9_1251_20220613_124212_Picture1.jpg', NULL, NULL),
(3213147, 10, 5, 333, '16.00', '2', 'https://', 'pelajaran_5_333_20220613_124223_WhatsApp Image 2022-06-10 at 4.03.59 PM (2).jpeg', NULL, NULL),
(3213148, 7, 8, 222, '07.30 - 08.50', '5', 'https://', 'pelajaran_8_222_20220613_124302_Picture1.jpg', NULL, NULL),
(3213149, 10, 5, 222, '10.40 - 12.00', '2', 'https://', 'pelajaran_5_222_20220613_124312_WhatsApp Image 2022-06-10 at 4.03.59 PM (2).jpeg', NULL, NULL),
(3213150, 5, 7, 333, '10.40 - 12.00', '5', 'https://', 'pelajaran_7_333_20220613_124325_Screenshot 2022-06-09 231838.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_tugas`
--

CREATE TABLE `jawaban_tugas` (
  `id_jawaban` int(11) NOT NULL,
  `id_tugas` int(100) NOT NULL,
  `id_siswa` text NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `file_jawaban` varchar(250) NOT NULL,
  `tanggal_unggahan` date NOT NULL,
  `nilai` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jawaban_tugas`
--

INSERT INTO `jawaban_tugas` (`id_jawaban`, `id_tugas`, `id_siswa`, `nama_siswa`, `file_jawaban`, `tanggal_unggahan`, `nilai`) VALUES
(27, 1531, '201790', 'Steven Justin Saputra', 'tugas__201790_1531__20220607_144309_MESG0019065.pdf', '2022-06-02', '75'),
(28, 1531, '43472470', 'Selly Marsenia', 'tugas__201790_1531__20220607_144309_MESG0019065.pdf', '2022-06-02', '70'),
(29, 2423, '201790', 'Steven Justin Saputra', 'tugas__43472470_2423__20220607_141609_bussines plan - PPT 2.pptx', '2022-06-02', '90'),
(30, 2423, '43472470', 'Selly Marsenia', 'tugas__43472470_2423__20220607_141609_bussines plan - PPT 2.pptx', '2022-06-02', '75'),
(31, 2332, '201790', 'Steven Justin Saputra', 'tugas__201790_2332__20220607_144331_Presentation.pptx', '2022-06-07', '100');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(50) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'XII-MIPA-1'),
(2, 'XII-IPS-2'),
(3, 'XII-IPS-3'),
(4, '444'),
(5, '555'),
(6, '666'),
(7, '777'),
(8, '888'),
(9, '999'),
(10, '1010'),
(111, '11111'),
(1212, '1212122');

-- --------------------------------------------------------

--
-- Table structure for table `kelompok_pengguna`
--

CREATE TABLE `kelompok_pengguna` (
  `id_users` int(11) NOT NULL,
  `nama_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelompok_pengguna`
--

INSERT INTO `kelompok_pengguna` (`id_users`, `nama_status`) VALUES
(1, 'Waka Kurikulum'),
(2, 'guru'),
(3, 'siswa'),
(4, 'kepala sekolah');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(100) NOT NULL,
  `id_pelajaran` int(50) NOT NULL,
  `id_siswa` int(100) NOT NULL,
  `tugas_siswa` int(11) NOT NULL,
  `uts_siswa` int(11) NOT NULL,
  `uas_siswa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_pelajaran`, `id_siswa`, `tugas_siswa`, `uts_siswa`, `uas_siswa`) VALUES
(3223, 5, 2147483647, 79, 0, 0),
(3602, 2, 201790, 80, 0, 0),
(3703, 3, 43472470, 70, 0, 0),
(3729, 5, 10101, 88, 0, 0),
(3735, 3, 201790, 75, 0, 0),
(3737, 11, 8878, 45, 0, 0),
(3749, 2, 8878, 74, 0, 0),
(3758, 2, 8878, 99, 0, 0),
(3842, 11, 8878, 23, 0, 0),
(3859, 11, 1515151533, 55, 0, 0),
(5134, 2, 43472470, 98, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pelajaran`
--

CREATE TABLE `pelajaran` (
  `id_pelajaran` int(50) NOT NULL,
  `nama_pelajaran` varchar(50) NOT NULL,
  `materi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelajaran`
--

INSERT INTO `pelajaran` (`id_pelajaran`, `nama_pelajaran`, `materi`) VALUES
(1, 'Fisika', 'Fisika.JPG'),
(2, 'Bahasa Inggris', 'Bahasa Inggris.jpeg'),
(3, 'Sosiologi', 'Sosiologi.JPG'),
(4, 'olahraga senam', 'pelajaran_2022_06_13_12_25_17_WhatsApp Image 2022-06-10 at 4.03.59 PM (2).jpeg'),
(5, 'asd', 'pelajaran_2022_06_13_12_26_37_Picture1.jpg'),
(6, 'reqq', 'pelajaran_2022_06_13_12_26_54_Picture1.jpg'),
(7, 'dgdsgfg', 'pelajaran_2022_06_13_12_27_18_Screenshot 2022-06-09 231838.png'),
(8, 'kerlrekj', 'pelajaran_2022_06_13_12_29_34_WhatsApp Image 2022-06-10 at 4.03.59 PM (2).jpeg'),
(9, 'llkl', 'pelajaran_2022_06_13_12_29_54_Picture1.jpg'),
(10, 'grgre', 'pelajaran_2022_06_13_12_30_02_Picture1.jpg'),
(11, 'erqrqr', 'pelajaran_2022_06_13_12_30_08_Screenshot 2022-06-09 231838.png');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(100) NOT NULL,
  `judul` text NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal_pembuatan` date NOT NULL,
  `lampiran` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `judul`, `deskripsi`, `tanggal_pembuatan`, `lampiran`) VALUES
(324234328, 'Pengumuman Try Out', '<p><strong>Ketentuan Pendaftaran :</strong></p>\r\n\r\n<p>1. Biaya pendaftaran untuk mengikuti olimpiade ini sebesar&nbsp;Rp. 5.000, sudah termasuk Akses Olimpiade, File Soal &amp; Kunci Jawaban, 3 E-Sertifikat Nasional, dan Kesempatan Mendapatkan Beasiswa Pendidikan.</p>\r\n\r\n<p>2. Jika kamu ingin mendaftarkan diri pada lebih dari 1 Olimpiade, maka biaya pendaftaran&nbsp;berlaku kelipatan&nbsp;dan pembayaran boleh dilakukan dalam&nbsp;satu kali transfer&nbsp;saja ya. Contoh ; Mendaftar Olimpiade Kimia dan Fisika, boleh melakukan pembayaran dalam 1x (Sekaligus Rp.10.000 untuk 2 Mapel). Daftarkan di masing-masing pilihan olimpiade dan bukti pembayarannya boleh disamakan.</p>\r\n\r\n<p>3. Nama pengirim bisa di isi dengan nama kamu atau nama pemilik rekening/akun shopee/dan lainnya (menyesuaikan).</p>\r\n\r\n<p><em>Silahkan lakukan pembayaran ke salah satu metode pembayaran berikut :</em></p>\r\n\r\n<ol>\r\n	<li>SHOPEEPAY&nbsp;: 0822-1396-4471 (Atas nama UNIVERSITY ID)</li>\r\n	<li>DANA&nbsp;: 0858-7964-7349&nbsp; (Atas nama SU****AN)</li>\r\n	<li>GOPAY&nbsp;: 0858-7964-7349 (Atas nama UNIVERSITYID atau SU****AN)</li>\r\n	<li>BANK&nbsp;: 7725-0100-8236-539 ( BANK BRI - Atas nama Naufal Rizky R )</li>\r\n	<li>OVO&nbsp;: 0822-1396-4471 (Atas nama UNIVERSITYID atau SU****AN)</li>\r\n	<li>PULSA&nbsp;: 0822-1396-4471 (Telkomsel)</li>\r\n	<li>QRIS :&nbsp;<a href=\"http://bit.ly/QRIS-CODE\" target=\"_blank\">Scan Code Qris - Klik Disini</a></li>\r\n</ol>\r\n\r\n<p><em>Pengerjaan Try Out Dibuka pada :&nbsp;<strong>16 - 17 April 2022</strong></em></p>\r\n\r\n<p><em>Panduan Pelaksanaan &amp; Kisi Kisi :&nbsp;</em><a href=\"http://bit.ly/olimpiade5\" target=\"_blank\">Klik Disi Untuk Membuka</a></p>\r\n\r\n<p>Pertanyaan dapat disampaikan melalui email :<em>&nbsp;our.universityid@gmail.com</em></p>\r\n', '2022-04-15', ''),
(324234334, 'Libur Lebaran', '<p>Yth.</p>\r\n\r\n<p><strong>Orangtua/Wali Siswa/i SMA Katolik Santo Fransiskus Assisi</strong></p>\r\n\r\n<p>Tempat</p>\r\n\r\n<p>&nbsp;&nbsp;</p>\r\n\r\n<p>Dengan hormat,</p>\r\n\r\n<p>Salam Fransiskus, Pace e Bene!</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Bersama surat ini kami sampaikan bahwa libur dalam rangka pembukaan puasa bulan Ramadhan 1443 H dimulai tanggal 1 &ndash; 2 April 2022 dan proses belajar mengajar aktif kembali tanggal 4 April 2022 secara Tatap Muka Terbatas.</p>\r\n\r\n<p>Demikian surat pemberitahuan ini kami sampaikan, semoga kita semua sehat selalu dan dalam perlindungan Tuhan Yang Maha Esa, atas perhatian dan kerja sama Bapak/Ibu Orangtua/Wali Siswa kami ucapkan terima kasih.</p>\r\n\r\n<p>Demikian surat pemberitahuan ini untuk dilaksanakan sebagaimana mestinya.</p>\r\n', '2022-03-31', 'Contoh Pengumuman.docx'),
(324234337, '123', '<p>123</p>\r\n', '0000-00-00', 'lampiran_20220613_124335_'),
(324234338, '123', '<p>321</p>\r\n', '0000-00-00', 'lampiran_20220613_124341_'),
(324234339, '321', '<p>551</p>\r\n', '0000-00-00', 'lampiran_20220613_124349_'),
(324234340, '5425', '<p>435345</p>\r\n', '0000-00-00', 'lampiran_20220613_124426_'),
(324234341, '321', '<p>321</p>\r\n', '0000-00-00', 'lampiran_20220613_124438_'),
(324234342, '545', '<p>3453</p>\r\n', '0000-00-00', 'lampiran_20220613_124441_'),
(324234343, '6346', '<p>6346</p>\r\n', '0000-00-00', 'lampiran_20220613_124444_'),
(324234344, '34242', '<p>4234</p>\r\n', '0000-00-00', 'lampiran_20220613_124449_'),
(324234345, '643', '<p>634</p>\r\n', '0000-00-00', 'lampiran_20220613_124456_'),
(324234346, '121', '<p>1243</p>\r\n', '0000-00-00', 'lampiran_20220613_124514_');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `NIS` int(50) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `kelas` int(100) DEFAULT NULL,
  `nama_kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`NIS`, `nama_siswa`, `tanggal_lahir`, `gender`, `no_hp`, `alamat`, `agama`, `kelas`, `nama_kelas`) VALUES
(8878, 'adfg', '2022-05-31', 'P', '74', 'Jl, serdam', 'islam', 7, '777'),
(10101, 'abc', '2022-06-07', 'P', '12314', '15155', 'katolik', 8, '888'),
(201790, 'Steven Justin Saputra', '2005-10-11', 'L', '6282221169777', 'Jl. Ir. Sutami GG. Pusaka RT 22', 'katolik', 3, 'XII-IPS-3'),
(1114444, 'Andi', '1221-12-12', 'L', '79', '79', 'buddha', 5, '555'),
(15151515, 'Budi', '7777-01-07', 'L', '31', 'Jl, serdam', 'buddha', 5, '555'),
(43472470, 'Selly Marsenia', '2004-06-15', 'P', '085332874747', 'Asrama Putri St. Melania Jl. Tekukur No.9 Rt. 19', 'kristen', 3, 'XII-IPS-3'),
(86564546, 'fgssaw', '5666-12-04', 'P', '20', '525', 'buddha', 7, '777'),
(132585858, 'afgggg', '1555-12-04', 'P', '1519', '1551515', 'islam', 7, '777'),
(1231155155, 'Andiqtts', '1455-12-14', 'L', '1555', 'Jl Sungai raya dalam', 'hindu', 3, 'XII-IPS-3'),
(1515151533, 'abcd', '2022-06-02', 'P', '1214', '488', 'kristen', 2, 'XII-IPS-2'),
(2147483647, '55ytyrhgfhhg', '3323-12-23', 'L', '3223', 'Jl. Sungai Raya Dalam', 'kristen', 6, '666');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int(100) NOT NULL,
  `id_kelas` int(50) NOT NULL,
  `id_guru` int(100) NOT NULL,
  `id_pelajaran` int(50) NOT NULL,
  `file_tugas` varchar(100) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `id_kelas`, `id_guru`, `id_pelajaran`, `file_tugas`, `tanggal`) VALUES
(1444, 2, 12, 3, 'Tugas sosio 1.txt', '2022-04-18'),
(1531, 3, 12, 3, 'Tugas Terbaru Sosiologi.txt', '2022-05-09'),
(2300, 2, 12, 3, 'Tugas Sosio 2.txt', '2022-05-12'),
(2332, 3, 12, 3, 'Tugas Sosio 2.txt', '2022-05-24'),
(2423, 3, 11, 2, 'tugas__2423_20220602_212437_ivana-square.jpg', '2022-02-06');

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE `ujian` (
  `id_ujian` int(20) NOT NULL,
  `id_kelas` varchar(100) NOT NULL,
  `id_pelajaran` text NOT NULL,
  `id_guru` text NOT NULL,
  `soal` text NOT NULL,
  `tanggalujian` date NOT NULL,
  `tipeujian` enum('UTS','UAS') NOT NULL,
  `waktumulai` text NOT NULL,
  `waktuakhir` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ujian`
--

INSERT INTO `ujian` (`id_ujian`, `id_kelas`, `id_pelajaran`, `id_guru`, `soal`, `tanggalujian`, `tipeujian`, `waktumulai`, `waktuakhir`) VALUES
(20, '2', '3', '12', 'UTS Sosio.txt', '2022-03-19', 'UTS', '08:00', '09:30'),
(23, '3', '3', '12', 'UTS Sosio.txt', '2022-03-19', 'UTS', '10:30', '12:00'),
(24, '2', '3', '12', 'UAS Sosio.txt', '2022-07-04', 'UAS', '08:00', '09:30'),
(25, '3', '3', '12', 'UAS Sosio.txt', '2022-07-05', 'UAS', '10:30', '12:00'),
(26, '2', '2', '11', 'UTS Bing.txt', '2022-05-03', 'UTS', '08:00', '09:30'),
(30, '3', '2', '11', 'ujian_UTS_3_2_20220607_143725_UTS BING.pdf', '2022-07-07', 'UTS', '10:00', '12:00'),
(31, '7', '10', '444', 'ujian_UTS_7_10_20220613_124545_Screenshot 2022-06-09 231838.png', '2344-12-31', 'UTS', '12:12', '00:12'),
(32, '8', '10', '555', 'ujian_UAS_8_10_20220613_124618_Picture1.jpg', '4144-04-13', 'UAS', '00:12', '12:12'),
(33, '1212', '10', '333', 'ujian_UAS_1212_10_20220613_124728_Screenshot 2022-06-09 231838.png', '0444-02-21', 'UAS', '14:42', '02:24'),
(34, '8', '8', '222', 'ujian_UTS_8_8_20220613_124821_Picture1.jpg', '0244-12-31', 'UTS', '14:14', '00:41'),
(35, '7', '7', '333', 'ujian_UAS_7_7_20220613_125844_Picture1.jpg', '0012-12-12', 'UAS', '00:12', '12:12'),
(36, '3', '9', '444', 'ujian_UTS_3_9_20220613_132641_Picture1.jpg', '1444-12-14', 'UTS', '14:14', '14:55'),
(37, '3', '1', '222', 'ujian_UAS_3_1_20220613_132718_Picture1.jpg', '2222-02-22', 'UAS', '14:14', '15:15'),
(38, '3', '8', '222', 'ujian_UTS_3_8_20220613_132731_WhatsApp Image 2022-06-10 at 4.03.59 PM (2).jpeg', '2525-12-25', 'UTS', '16:16', '17:17'),
(39, '3', '7', '14', 'ujian_UTS_3_7_20220613_132811_Picture1.jpg', '2022-05-31', 'UTS', '14:14', '15:15'),
(40, '3', '8', '111', 'ujian_UAS_3_8_20220613_132829_WhatsApp Image 2022-06-10 at 4.03.59 PM (2).jpeg', '1515-12-15', 'UAS', '00:12', '01:13'),
(41, '3', '4', '222', 'ujian_UTS_3_4_20220613_132848_WhatsApp Image 2022-06-10 at 4.03.59 PM (2).jpeg', '1666-12-15', 'UTS', '15:15', '11:06'),
(42, '1', '1', '11', 'ujian_UTS_1_1_20220613_132931_WhatsApp Image 2022-06-10 at 4.03.59 PM (2).jpeg', '2022-05-10', 'UTS', '03:15', '15:16'),
(43, '3', '7', '333', 'ujian_UAS_3_7_20220613_132945_Screenshot 2022-06-09 231838.png', '2022-06-09', 'UAS', '14:55', '16:06'),
(44, '3', '2', '11', 'ujian_UAS_3_2_20220613_133059_Picture1.jpg', '2022-06-13', 'UAS', '13:12', '13:12');

-- --------------------------------------------------------

--
-- Table structure for table `ujian_murid`
--

CREATE TABLE `ujian_murid` (
  `id_jawaban` int(11) NOT NULL,
  `id_murid` int(11) NOT NULL,
  `id_ujianjawaban` text NOT NULL,
  `jawaban` text DEFAULT NULL,
  `waktusubmit` datetime NOT NULL DEFAULT current_timestamp(),
  `nilai` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ujian_murid`
--

INSERT INTO `ujian_murid` (`id_jawaban`, `id_murid`, `id_ujianjawaban`, `jawaban`, `waktusubmit`, `nilai`) VALUES
(9, 201790, '20', 'JAWABAN UTS SOSIO.txt', '2022-05-18 21:11:24', '90'),
(10, 201790, '24', 'JAWABAN UAS SOSIO.txt', '2022-05-18 21:13:53', '60'),
(11, 201790, '26', 'Jawaban UTS Bing.txt', '2022-05-18 21:26:06', '78'),
(12, 43472470, '23', 'ujian__23_43472470_20220602_214514_mastercard.png', '2022-06-02 21:45:14', '100'),
(13, 201790, '23', 'ujian__23_201790_20220602_220114_rocket-white.png', '2022-06-02 22:01:14', '70'),
(14, 201790, '25', 'ujian__25_201790_20220602_220246_sekolah.jpeg', '2022-06-02 22:02:46', ''),
(15, 43472470, '25', 'ujian__25_43472470_20220602_220331_curved1.jpg', '2022-06-02 22:03:31', ''),
(16, 201790, '28', 'ujian__28_201790_20220602_222525_white-curved.jpeg', '2022-06-02 22:25:25', '90'),
(17, 201790, '29', 'ujian__29_201790_20220602_222603_visa.png', '2022-06-02 22:26:03', '99'),
(18, 43472470, '28', 'ujian__28_43472470_20220602_222701_bruce-mars.jpg', '2022-06-02 22:27:01', ''),
(19, 43472470, '29', 'ujian__29_43472470_20220602_222723_team-3.jpg', '2022-06-02 22:27:23', '77'),
(20, 201790, '41', 'jawaban_UTS__41_Steven Justin Saputra_olahraga senam_20220613_133238_QnA.docx', '2022-06-13 13:32:38', ''),
(21, 201790, '38', 'jawaban_UTS__38_Steven Justin Saputra_kerlrekj_20220613_133437_bussines plan - PPT 2.pptx', '2022-06-13 13:34:37', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `no_role_users` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `namaadmin` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `no_role_users`, `username`, `password`, `namaadmin`) VALUES
(1, 1, 'admin', 'admin', 'admin'),
(11, 4, 'Kristoforus Gustian', '12345', ''),
(12, 2, 'Rutma Parningotan', '12345', ''),
(8878, 3, 'adfg', '12345', ''),
(10101, 3, 'abc', '12345', ''),
(201790, 3, 'Steven Justin Saputra', '12345', ''),
(1114444, 3, 'Andi', '12345', ''),
(15151515, 3, 'Budi', '12345', ''),
(43472470, 3, 'Selly Marsenia', '12345', ''),
(86564546, 3, 'fgssaw', '12345', ''),
(1231155155, 3, 'Andiqtts', '12345', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `kode_kelas` (`id_kelas`),
  ADD KEY `id_pelajaran` (`id_pelajaran`);

--
-- Indexes for table `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id_bulan`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id_comment`) USING BTREE,
  ADD KEY `id_pelajaran` (`id_pelajaran`),
  ADD KEY `kode_kelas` (`id_kelas`);

--
-- Indexes for table `foto_profil`
--
ALTER TABLE `foto_profil`
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `hari`
--
ALTER TABLE `hari`
  ADD PRIMARY KEY (`id_hari`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_pelajaran` (`id_pelajaran`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `NIP` (`id_guru`);

--
-- Indexes for table `jawaban_tugas`
--
ALTER TABLE `jawaban_tugas`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `kode_tugas` (`id_tugas`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `kelompok_pengguna`
--
ALTER TABLE `kelompok_pengguna`
  ADD PRIMARY KEY (`id_users`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `kode_pelajaran` (`id_pelajaran`),
  ADD KEY `kode_siswa` (`id_siswa`);

--
-- Indexes for table `pelajaran`
--
ALTER TABLE `pelajaran`
  ADD PRIMARY KEY (`id_pelajaran`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`NIS`),
  ADD KEY `kelas` (`kelas`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`),
  ADD KEY `kode_kelas` (`id_kelas`),
  ADD KEY `kode_guru` (`id_guru`),
  ADD KEY `kode_pelajaran` (`id_pelajaran`);

--
-- Indexes for table `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id_ujian`);

--
-- Indexes for table `ujian_murid`
--
ALTER TABLE `ujian_murid`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD KEY `FK_user_usergroup` (`no_role_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=310;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3213151;

--
-- AUTO_INCREMENT for table `jawaban_tugas`
--
ALTER TABLE `jawaban_tugas`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `kelompok_pengguna`
--
ALTER TABLE `kelompok_pengguna`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=324234347;

--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `ujian_murid`
--
ALTER TABLE `ujian_murid`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `absensi_ibfk_2` FOREIGN KEY (`id_pelajaran`) REFERENCES `pelajaran` (`id_pelajaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `forum_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `forum_ibfk_3` FOREIGN KEY (`id_pelajaran`) REFERENCES `pelajaran` (`id_pelajaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `jadwal_ibfk_3` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`),
  ADD CONSTRAINT `jadwal_ibfk_4` FOREIGN KEY (`id_pelajaran`) REFERENCES `pelajaran` (`id_pelajaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jawaban_tugas`
--
ALTER TABLE `jawaban_tugas`
  ADD CONSTRAINT `jawaban_tugas_ibfk_1` FOREIGN KEY (`id_tugas`) REFERENCES `tugas` (`id_tugas`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`NIS`),
  ADD CONSTRAINT `nilai_ibfk_3` FOREIGN KEY (`id_pelajaran`) REFERENCES `pelajaran` (`id_pelajaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `tugas_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`),
  ADD CONSTRAINT `tugas_ibfk_3` FOREIGN KEY (`id_pelajaran`) REFERENCES `pelajaran` (`id_pelajaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`no_role_users`) REFERENCES `kelompok_pengguna` (`id_users`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
