-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2022 at 02:52 PM
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
(828, 'Steven Justin Saputra', 2, 3, '2022-02-17', 'izin'),
(1032, 'Selly Marsenia', 3, 3, '2022-05-18', 'hadir'),
(2621, 'Steven Justin Saputra', 2, 3, '2022-05-04', 'tidak hadir'),
(2657, 'Selly Marsenia', 3, 3, '2022-05-26', 'tidak hadir'),
(3601, 'Steven Justin Saputra', 2, 2, '2022-05-10', 'tidak hadir');

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
(247, 0, 'Selamat pagi', 'Kristoforus Gustian', 'guru', 2, 2, '2022-05-18 14:35:27');

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
(14, 'Martha Sari', '1970-10-15', 'P', '081217653888', 'Jl. Pulau Flores No. 16');

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
(3213143, 2, 3, 11, '08.00-10.30', '4', 'https://teams', 'Bahasa Inggris.jpeg', NULL, NULL);

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
(12, 1444, '201790', 'Steven Justin Saputra', 'Jawaban sosio 1.txt', '0000-00-00', '80'),
(13, 2300, '201790', 'Steven Justin Saputra', 'Jawaban sosio 2.txt', '0000-00-00', '95'),
(14, 1531, '43472470', 'Selly Marsenia', 'Jawaban sosio 1.txt', '0000-00-00', '85'),
(15, 2332, '43472470', 'Selly Marsenia', 'Jawaban sosio 2.txt', '0000-00-00', '75');

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
(3, 'XII-IPS-3');

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
(1528, 2, 201790, 70, 0, 0),
(3703, 3, 43472470, 70, 0, 0),
(3735, 3, 201790, 75, 0, 0),
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
(3, 'Sosiologi', 'Sosiologi.JPG');

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
(324234334, 'Libur Lebaran', '<p>Yth.</p>\r\n\r\n<p><strong>Orangtua/Wali Siswa/i SMA Katolik Santo Fransiskus Assisi</strong></p>\r\n\r\n<p>Tempat</p>\r\n\r\n<p>&nbsp;&nbsp;</p>\r\n\r\n<p>Dengan hormat,</p>\r\n\r\n<p>Salam Fransiskus, Pace e Bene!</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Bersama surat ini kami sampaikan bahwa libur dalam rangka pembukaan puasa bulan Ramadhan 1443 H dimulai tanggal 1 &ndash; 2 April 2022 dan proses belajar mengajar aktif kembali tanggal 4 April 2022 secara Tatap Muka Terbatas.</p>\r\n\r\n<p>Demikian surat pemberitahuan ini kami sampaikan, semoga kita semua sehat selalu dan dalam perlindungan Tuhan Yang Maha Esa, atas perhatian dan kerja sama Bapak/Ibu Orangtua/Wali Siswa kami ucapkan terima kasih.</p>\r\n\r\n<p>Demikian surat pemberitahuan ini untuk dilaksanakan sebagaimana mestinya.</p>\r\n', '2022-03-31', 'Contoh Pengumuman.docx');

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
(201790, 'Steven Justin Saputra', '2005-10-11', 'L', '6282221169777', 'Jl. Ir. Sutami GG. Pusaka RT 22', 'katolik', 2, 'XII-IPS-2'),
(43472470, 'Selly Marsenia', '2004-06-15', 'P', '085332874747', 'Asrama Putri St. Melania Jl. Tekukur No.9 Rt. 19', 'kristen', 3, 'XII-IPS-3');

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
(2332, 3, 12, 3, 'Tugas Sosio 2.txt', '2022-05-24');

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
(26, '2', '2', '11', 'UTS Bing.txt', '2022-05-03', 'UTS', '08:00', '09:30');

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
(11, 201790, '26', 'Jawaban UTS Bing.txt', '2022-05-18 21:26:06', '78');

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
(201790, 3, 'Steven Justin Saputra', '12345', ''),
(43472470, 3, 'Selly Marsenia', '12345', '');

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
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3213144;

--
-- AUTO_INCREMENT for table `jawaban_tugas`
--
ALTER TABLE `jawaban_tugas`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kelompok_pengguna`
--
ALTER TABLE `kelompok_pengguna`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=324234337;

--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `ujian_murid`
--
ALTER TABLE `ujian_murid`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
