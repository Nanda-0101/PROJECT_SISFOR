-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2026 at 06:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_si`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_admin`, `created_at`, `updated_at`) VALUES
(1, 'admin_sivenpus', 'admin1', 'Prof. Made Wira Adi, S.Si., Ph.D.', '2026-06-26 14:32:56', '2026-07-02 00:09:03'),
(2, 'admin_sipenvus2', 'admin2', 'Rico Mulawarman', '2026-06-26 14:32:56', '2026-07-02 00:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `data_peserta`
--

CREATE TABLE `data_peserta` (
  `id_data` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `id_field` int(11) NOT NULL,
  `nilai` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_peserta`
--

INSERT INTO `data_peserta` (`id_data`, `id_peserta`, `id_field`, `nilai`, `created_at`, `updated_at`) VALUES
(7, 2, 1, '2408561051', '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(8, 2, 2, 'Anwar Santoso', '2026-06-26 14:32:56', '2026-07-01 23:39:50'),
(9, 2, 3, 'anwar@student.unud.ac.id', '2026-06-26 14:32:56', '2026-07-01 23:40:09'),
(10, 2, 4, '081234567802', '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(11, 2, 5, 'Informatika', '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(12, 2, 6, '6', '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(13, 3, 1, '2408561110', '2026-06-26 14:32:57', '2026-06-26 14:32:57'),
(14, 3, 2, 'Benjamin Wijaya', '2026-06-26 14:32:57', '2026-07-01 23:40:23'),
(15, 3, 3, 'benjamin@student.unud.ac.id', '2026-06-26 14:32:57', '2026-07-01 23:40:36'),
(16, 3, 4, '081234567803', '2026-06-26 14:32:57', '2026-06-26 14:32:57'),
(17, 3, 5, 'Informatika', '2026-06-26 14:32:57', '2026-06-26 14:32:57'),
(18, 3, 6, '6', '2026-06-26 14:32:57', '2026-06-26 14:32:57'),
(25, 5, 1, '2408561140', '2026-06-26 14:32:57', '2026-06-26 14:32:57'),
(26, 5, 2, 'Maharani Putri', '2026-06-26 14:32:57', '2026-07-01 23:40:51'),
(27, 5, 3, 'putri@student.unud.ac.id', '2026-06-26 14:32:57', '2026-07-01 23:41:04'),
(28, 5, 4, '081234567805', '2026-06-26 14:32:57', '2026-06-26 14:32:57'),
(29, 5, 5, 'Informatika', '2026-06-26 14:32:57', '2026-06-26 14:32:57'),
(30, 5, 6, '6', '2026-06-26 14:32:57', '2026-06-26 14:32:57'),
(31, 8, 1, '2408571132', '2026-07-01 13:28:10', '2026-07-01 23:41:34'),
(32, 8, 2, 'Natha Wibawa', '2026-07-01 13:28:10', '2026-07-01 23:41:38'),
(33, 8, 3, 'natha@student.unud.ac.id', '2026-07-01 13:28:10', '2026-07-01 23:41:49'),
(34, 8, 4, '081234567805', '2026-07-01 13:28:10', '2026-07-01 23:41:59'),
(35, 8, 5, 'hukum', '2026-07-01 13:28:10', '2026-07-01 13:28:10'),
(36, 8, 6, '2', '2026-07-01 13:28:10', '2026-07-01 13:28:10'),
(37, 9, 1, '081234567805', '2026-07-01 13:33:27', '2026-07-01 23:42:05'),
(38, 9, 2, 'Frangky Alexander', '2026-07-01 13:33:27', '2026-07-01 23:42:36'),
(39, 9, 3, 'Alexander@gmail.com', '2026-07-01 13:33:27', '2026-07-01 23:43:02'),
(40, 9, 4, '0808561158', '2026-07-01 13:33:27', '2026-07-01 23:43:26'),
(41, 9, 5, 'Kedokteran', '2026-07-01 13:33:27', '2026-07-01 13:33:27'),
(42, 9, 6, '3', '2026-07-01 13:33:27', '2026-07-01 13:33:27'),
(43, 10, 1, '2408561159', '2026-07-01 13:36:23', '2026-07-01 23:43:31'),
(44, 10, 2, 'Agung Dharma', '2026-07-01 13:36:23', '2026-07-01 23:44:01'),
(45, 10, 3, 'Dharma@gmail.com', '2026-07-01 13:36:23', '2026-07-01 23:44:18'),
(46, 10, 4, '0808561158', '2026-07-01 13:36:24', '2026-07-01 23:44:40'),
(47, 10, 5, 'Kedokteran', '2026-07-01 13:36:24', '2026-07-01 13:36:24'),
(48, 10, 6, '2508561158', '2026-07-01 13:36:24', '2026-07-01 23:44:47'),
(49, 11, 1, '2408165512', '2026-07-01 13:37:03', '2026-07-01 23:45:24'),
(50, 11, 2, 'Joko Pranoto', '2026-07-01 13:37:03', '2026-07-01 23:45:14'),
(51, 11, 3, 'ada@gmail.com', '2026-07-01 13:37:03', '2026-07-01 13:37:03'),
(52, 11, 4, '08190121112', '2026-07-01 13:37:03', '2026-07-01 23:45:36'),
(53, 11, 5, 'Kedokteran', '2026-07-01 13:37:03', '2026-07-01 13:37:03'),
(54, 11, 6, '2', '2026-07-01 13:37:03', '2026-07-01 13:37:03'),
(55, 12, 1, '2102121123', '2026-07-01 13:38:04', '2026-07-01 23:46:06'),
(56, 12, 2, 'Suardana Permana', '2026-07-01 13:38:04', '2026-07-01 23:46:22'),
(57, 12, 3, 'Permana@gmail.com', '2026-07-01 13:38:04', '2026-07-01 23:46:30'),
(58, 12, 4, '081231456323', '2026-07-01 13:38:04', '2026-07-01 23:46:41'),
(59, 12, 5, 'Kedokteran', '2026-07-01 13:38:04', '2026-07-01 13:38:04'),
(60, 12, 6, '2', '2026-07-01 13:38:04', '2026-07-01 13:38:04'),
(61, 13, 1, '2308531322', '2026-07-01 13:41:15', '2026-07-01 23:46:54'),
(62, 13, 2, 'Eka Putra', '2026-07-01 13:41:15', '2026-07-01 23:47:10'),
(63, 13, 3, 'putra@gmail.com', '2026-07-01 13:41:15', '2026-07-01 23:47:26'),
(64, 13, 4, '089010821', '2026-07-01 13:41:15', '2026-07-01 23:47:34'),
(65, 13, 5, 'Kedokteran', '2026-07-01 13:41:15', '2026-07-01 13:41:15'),
(66, 13, 6, '2', '2026-07-01 13:41:15', '2026-07-01 13:41:15'),
(67, 14, 1, '23090102100', '2026-07-01 13:41:51', '2026-07-01 23:47:46'),
(68, 14, 2, 'Cokorda Gede', '2026-07-01 13:41:51', '2026-07-01 23:48:04'),
(69, 14, 3, 'gede@gmail.com', '2026-07-01 13:41:51', '2026-07-01 23:48:14'),
(70, 14, 4, '081190219878', '2026-07-01 13:41:51', '2026-07-01 23:48:22'),
(71, 14, 5, 'Kedokteran', '2026-07-01 13:41:51', '2026-07-01 13:41:51'),
(72, 14, 6, '2', '2026-07-01 13:41:51', '2026-07-01 13:41:51'),
(73, 15, 1, '24087613199', '2026-07-01 13:43:38', '2026-07-01 23:48:32'),
(74, 15, 2, 'Wawan Waguna', '2026-07-01 13:43:38', '2026-07-01 23:48:56'),
(75, 15, 3, 'www@gmail.com', '2026-07-01 13:43:38', '2026-07-01 13:43:38'),
(76, 15, 4, '0818567310', '2026-07-01 13:43:38', '2026-07-01 23:49:18'),
(77, 15, 5, 'hukum', '2026-07-01 13:43:38', '2026-07-01 13:43:38'),
(78, 15, 6, '3', '2026-07-01 13:43:38', '2026-07-01 13:43:38'),
(79, 16, 1, '2408567310', '2026-07-01 13:44:25', '2026-07-01 23:49:23'),
(80, 16, 2, 'Wira Erlangga', '2026-07-01 13:44:25', '2026-07-01 23:49:34'),
(81, 16, 3, 'erlangga@gmai.com', '2026-07-01 13:44:25', '2026-07-01 23:49:49'),
(82, 16, 4, '081293203231', '2026-07-01 13:44:25', '2026-07-01 23:50:00'),
(83, 16, 5, 'hukum', '2026-07-01 13:44:25', '2026-07-01 13:44:25'),
(84, 16, 6, '3', '2026-07-01 13:44:25', '2026-07-01 13:44:25');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id_event` int(11) NOT NULL,
  `nama_event` varchar(150) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal_event` date DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `jenis_event` enum('gratis','berbayar') DEFAULT 'gratis',
  `biaya` decimal(12,2) DEFAULT 0.00,
  `status_event` enum('draft','publikasi','selesai','dibatalkan') DEFAULT 'draft',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id_event`, `nama_event`, `deskripsi`, `tanggal_event`, `lokasi`, `jenis_event`, `biaya`, `status_event`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'Seminar Nasional Artificial Intelligence', 'Seminar nasional berskala besar ini diselenggarakan sebagai sebuah platform kolaboratif strategis yang secara khusus mempertemukan para pemimpin teknologi, direktur inovasi, dan praktisi pembuat keputusan dari sektor industri komersial dengan para profesor, peneliti senior, serta pakar teoretis dari kalangan akademisi terkemuka guna mengupas tuntas seluruh dinamika, peta jalan, tantangan implementasi, serta tren perkembangan terkini dari teknologi Artificial Intelligence di Indonesia. Melalui integrasi dua sudut pandang yang saling melengkapi ini, forum tersebut dirancang untuk membedah penerapan praktis kecerdasan buatan dalam lanskap bisnis modern termasuk otomatisasi operasional dan kebutuhan talenta digital masa depan sekaligus menyelaraskannya dengan pengembangan riset fundamental, etika pemanfaatan teknologi, dan perancangan kurikulum pendidikan tinggi yang relevan. Dengan memfasilitasi dialog interaktif yang komprehensif ini, acara ini tidak hanya bertujuan untuk menjembatani kesenjangan antara teori ilmiah di kampus dan kebutuhan riil di lapangan kerja, tetapi juga berfungsi sebagai katalisator dalam merumuskan rekomendasi kebijakan strategis serta mempercepat terciptanya ekosistem inovasi digital nasional yang mandiri, aman, inklusif, dan berdaya saing tinggi di tingkat global.', '2026-07-25', 'Auditorium Widya Sabha, Universitas Udayana', 'gratis', 0.00, 'publikasi', 1, 1, '2026-06-26 14:32:56', '2026-07-02 00:01:16'),
(3, 'Bootcamp Data Science & Machine Learning', 'Program pelatihan intensif berdurasi tiga hari ini dirancang secara khusus sebagai gerbang awal bagi para pemula dari berbagai latar belakang yang ingin mempelajari bidang sains data secara menyeluruh mulai dari tingkat dasar paling nol. Seluruh peserta akan dibimbing secara langsung oleh para praktisi data profesional untuk menguasai fondasi penting seperti statistika dasar, bahasa pemrograman untuk pengolahan data, hingga teknik visualisasi informasi yang krusial bagi kebutuhan industri modern saat ini.', '2026-08-10', 'Gedung Informatika Lt.2, Universitas Udayana', 'berbayar', 250000.00, 'publikasi', 2, 2, '2026-06-26 14:32:56', '2026-07-02 00:04:31'),
(4, 'Lomba Competitive Programming', 'Kompetisi pemrograman tingkat nasional ini diselenggarakan sebagai wadah bergengsi bagi seluruh mahasiswa aktif dari berbagai perguruan tinggi di Indonesia untuk menguji kemampuan teknis, logika berpikir, dan kecepatan dalam memecahkan masalah komputasi yang rumit. Selain menjadi ajang pembuktian bakat digital terbaik di tanah air, ajang perlombaan berskala besar ini juga memperebutkan total hadiah uang tunai hingga mencapai puluhan juta rupiah sebagai bentuk apresiasi atas inovasi dan kreativitas para talenta muda.', '2026-08-05', 'Lab Komputer Lt.1, Universitas Udayana', 'berbayar', 75000.00, 'publikasi', 3, 3, '2026-06-26 14:32:56', '2026-07-02 00:04:49'),
(5, 'Pelatihan Desain Grafis untuk Pemula', 'Program peningkatan keterampilan ini hadir sebagai solusi praktis bagi siapa saja yang ingin mendalami dunia seni visual digital melalui pelatihan intensif penggunaan perangkat lunak Canva dan Adobe Photoshop secara optimal. Melalui kombinasi materi teoretis dan praktik langsung, para peserta akan diajarkan mulai dari teknik perancangan tata letak yang instan namun estetis menggunakan aplikasi berbasis komputasi awan hingga teknik penyuntingan gambar tingkat lanjut yang presisi menggunakan standar industri profesional.', '2026-07-20', 'Lab Multimedia Lt.2, Teknik Sipil, Universitas Udayana', 'gratis', 0.00, 'publikasi', 1, 1, '2026-06-26 14:32:56', '2026-07-02 00:07:13'),
(6, 'Lomba Competitive Programming Nasional 2026: Battle of Logic', 'Debat kompetitif adalah kegiatan adu argumentasi yang diselenggarakan secara formal dalam bentuk perlombaan atau kompetisi. Berbeda dengan debat politis, debat kompetitif tidak bertujuan untuk menghasilkan suatu keputusan, melainkan untuk melatih kemampuan berpikir kritis, logis, terstruktur, dan seni berbicara di depan umum.', '2026-08-12', 'Teknik Elektro, Universira6 Udayana', 'gratis', 0.00, 'selesai', 2, 2, '2026-07-01 06:21:05', '2026-07-02 00:06:22'),
(7, 'Lomba Inovasi Teknologi Hijau: Solusi Ramah Lingkungan untuk Masa Depan', 'Lomba Inovasi Teknologi Hijau ini dikemas dalam bentuk kegiatan adu argumentasi ilmiah yang diselenggarakan secara formal dalam format perlombaan atau kompetisi debat akademis tingkat tinggi bagi para generasi muda. Berbeda dengan debat politis pada umumnya yang seringkali berfokus pada pencapaian konsensus atau perebutan kekuasaan, debat kompetitif ini sama sekali tidak bertujuan untuk menghasilkan suatu keputusan praktis melainkan berfokus penuh untuk melatih ketajaman kemampuan berpikir kritis, penalaran logis, penyusunan ide yang terstruktur, serta penguasaan seni berbicara di depan umum secara persuasif dalam mempertahankan solusi ramah lingkungan demi masa depan bumi yang berkelanjutan.', '2027-02-09', 'Fakultas Kedokteran, Universiras Udayana', 'gratis', 0.00, 'publikasi', 2, 2, '2026-07-01 16:20:21', '2026-07-02 00:05:22'),
(8, 'Debate Competition III', 'Kompetisi debat akademik tingkat nasional ini diselenggarakan sebagai sebuah forum adu argumentasi ilmiah yang dikemas secara formal dalam bentuk perlombaan atau kompetisi gagasan antar generasi muda berprestasi dari seluruh penjuru tanah air. Berbeda dengan debat politis yang umumnya berfokus pada pencapaian konsensus mufakat atau pembentukan opini publik untuk memenangkan kekuasaan, debat kompetitif ini sama sekali tidak bertujuan untuk menghasilkan suatu keputusan praktis atau kebijakan mutlak. Sebaliknya, esensi utama dari perlombaan ini adalah sebagai sarana olahraga artikulasi yang dirancang khusus untuk menguji sekaligus melatih ketajaman kemampuan berpikir kritis, metode penalaran logis, penyusunan struktur argumen yang sistematis, serta penguasaan teknik retorika dan seni berbicara di depan umum secara persuasif di bawah tekanan waktu yang ketat.', '2027-02-09', 'Fakultas Hukum, Universiras Udayana', 'berbayar', 30000.00, 'publikasi', 2, 2, '2026-07-01 16:23:53', '2026-07-02 00:05:46');

-- --------------------------------------------------------

--
-- Table structure for table `field_kategori`
--

CREATE TABLE `field_kategori` (
  `id_field` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_field` varchar(100) NOT NULL,
  `tipe_field` enum('text','number','email','tel','date','textarea') DEFAULT 'text',
  `wajib` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `field_kategori`
--

INSERT INTO `field_kategori` (`id_field`, `id_kategori`, `nama_field`, `tipe_field`, `wajib`, `created_at`, `updated_at`) VALUES
(1, 1, 'NIM', 'number', 1, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(2, 1, 'Nama Lengkap', 'text', 1, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(3, 1, 'Email', 'email', 1, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(4, 1, 'Nomor WhatsApp', 'tel', 1, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(5, 1, 'Program Studi', 'text', 1, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(6, 1, 'Semester', 'number', 0, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(7, 2, 'NIM', 'number', 1, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(8, 2, 'Nama Lengkap', 'text', 1, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(9, 2, 'Email', 'email', 1, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(10, 2, 'Nomor WhatsApp', 'tel', 1, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(11, 2, 'Tahun Lulus', 'number', 0, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(12, 3, 'NIDN', 'number', 1, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(13, 3, 'Nama Lengkap', 'text', 1, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(14, 3, 'Email Institusi', 'email', 1, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(15, 3, 'Nomor WhatsApp', 'tel', 1, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(16, 3, 'Fakultas', 'text', 0, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(17, 4, 'NIK', 'number', 0, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(18, 4, 'Nama Lengkap', 'text', 1, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(19, 4, 'Email', 'email', 1, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(20, 4, 'Nomor WhatsApp', 'tel', 1, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(21, 4, 'Instansi', 'text', 0, '2026-06-26 14:32:56', '2026-06-26 14:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_peserta`
--

CREATE TABLE `kategori_peserta` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_peserta`
--

INSERT INTO `kategori_peserta` (`id_kategori`, `nama_kategori`, `deskripsi`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Mahasiswa Aktif', 'Mahasiswa yang sedang terdaftar aktif di perguruan tinggi', 1, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(2, 'Mahasiswa Alumni', 'Alumni perguruan tinggi', 1, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(3, 'Dosen', 'Tenaga pendidik/dosen', 1, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(4, 'Umum', 'Masyarakat umum', 1, '2026-06-26 14:32:56', '2026-06-26 14:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `id_metode` int(11) NOT NULL,
  `nama_metode` varchar(50) DEFAULT NULL,
  `tipe` enum('qris','ewallet','virtual_account') DEFAULT 'qris',
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`id_metode`, `nama_metode`, `tipe`, `status`, `created_at`) VALUES
(1, 'QRIS (Scan Barcode)', 'qris', 'aktif', '2026-06-26 14:32:56'),
(2, 'DANA', 'ewallet', 'aktif', '2026-06-26 14:32:56'),
(3, 'OVO', 'ewallet', 'aktif', '2026-06-26 14:32:56'),
(4, 'Bank BNI Virtual Account', 'virtual_account', 'aktif', '2026-06-26 14:32:56'),
(5, 'Bank Mandiri Virtual Account', 'virtual_account', 'aktif', '2026-06-26 14:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `panitia`
--

CREATE TABLE `panitia` (
  `id_panitia` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_panitia` varchar(100) NOT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `panitia`
--

INSERT INTO `panitia` (`id_panitia`, `username`, `password`, `nama_panitia`, `status`, `created_at`, `updated_at`) VALUES
(1, 'panitia_workshop', 'panitia1', 'Bagus Ngurah', 'aktif', '2026-06-26 14:32:56', '2026-07-01 23:52:42'),
(2, 'panitia_seminar', 'panitia2', 'Gunardi Asta', 'aktif', '2026-06-26 14:32:56', '2026-07-01 23:52:59'),
(3, 'panitia_lomba', 'panitia3', 'Sanji Pancayana', 'nonaktif', '2026-06-26 14:32:56', '2026-07-01 23:53:31');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pendaftaran` int(11) NOT NULL,
  `id_metode` int(11) NOT NULL,
  `kode_pembayaran` varchar(50) DEFAULT NULL,
  `nominal` decimal(12,2) DEFAULT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `status_pembayaran` enum('pending','berhasil','ditolak','expired') DEFAULT 'pending',
  `tanggal_pembayaran` datetime DEFAULT NULL,
  `diverifikasi_oleh` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pendaftaran`, `id_metode`, `kode_pembayaran`, `nominal`, `bukti_pembayaran`, `status_pembayaran`, `tanggal_pembayaran`, `diverifikasi_oleh`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'PAY-DS-20260810-001', 250000.00, NULL, 'pending', NULL, NULL, '2026-06-26 14:32:57', '2026-06-26 14:32:57'),
(2, 8, 1, 'PAY-2QVMWZ0NWJA3', 250000.00, NULL, 'pending', NULL, NULL, '2026-07-01 13:28:10', '2026-07-01 13:28:10'),
(3, 9, 3, 'PAY-WKEP1OIH7Z96', 75000.00, NULL, 'pending', NULL, NULL, '2026-07-01 13:33:27', '2026-07-01 13:33:27'),
(4, 11, 3, 'PAY-W2FIKYNWBGZP', 75000.00, NULL, 'pending', NULL, NULL, '2026-07-01 13:37:03', '2026-07-01 13:37:03'),
(5, 12, 3, 'PAY-EWAA3G7PQFDX', 75000.00, NULL, 'berhasil', '2026-07-01 13:39:09', NULL, '2026-07-01 13:38:04', '2026-07-01 13:39:09'),
(6, 13, 3, 'PAY-NRYEY56XMFQE', 75000.00, NULL, 'berhasil', '2026-07-01 13:41:21', NULL, '2026-07-01 13:41:15', '2026-07-01 13:41:21'),
(7, 14, 3, 'PAY-QIBMVHPRY2NG', 75000.00, NULL, 'berhasil', '2026-07-01 13:42:09', NULL, '2026-07-01 13:41:51', '2026-07-01 13:42:09'),
(8, 16, 1, 'PAY-3PQZR7ZFQNQ9', 250000.00, NULL, 'berhasil', '2026-07-01 13:44:35', NULL, '2026-07-01 13:44:25', '2026-07-01 13:44:35');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_pendaftaran` int(11) NOT NULL,
  `id_sesi` int(11) NOT NULL,
  `kode_pendaftaran` varchar(50) NOT NULL,
  `waktu_daftar` datetime DEFAULT current_timestamp(),
  `status_pendaftaran` enum('menunggu_pembayaran','menunggu_verifikasi','terdaftar','dibatalkan') DEFAULT 'menunggu_verifikasi',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_pendaftaran`, `id_sesi`, `kode_pendaftaran`, `waktu_daftar`, `status_pendaftaran`, `created_at`, `updated_at`) VALUES
(2, 6, 'REG-DS-20260810-0001', '2026-05-21 10:30:00', 'menunggu_pembayaran', '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(3, 4, 'REG-AI-20260725-0001', '2026-05-22 09:00:00', 'terdaftar', '2026-06-26 14:32:57', '2026-06-26 14:32:57'),
(5, 7, 'REG-DS-20260817-0001', '2026-05-24 11:00:00', 'menunggu_verifikasi', '2026-06-26 14:32:57', '2026-06-26 14:32:57'),
(8, 7, 'REG-SMYYG6E3', '2026-07-01 13:28:10', 'menunggu_pembayaran', '2026-07-01 13:28:10', '2026-07-01 13:28:10'),
(9, 8, 'REG-DXKKBY9T', '2026-07-01 13:33:27', 'menunggu_pembayaran', '2026-07-01 13:33:27', '2026-07-01 13:33:27'),
(10, 13, 'REG-SLBRB0DY', '2026-07-01 13:36:23', 'terdaftar', '2026-07-01 13:36:23', '2026-07-01 13:36:23'),
(11, 9, 'REG-W4LGLNDA', '2026-07-01 13:37:03', 'menunggu_pembayaran', '2026-07-01 13:37:03', '2026-07-01 13:37:03'),
(12, 9, 'REG-U9OX6RHU', '2026-07-01 13:38:04', 'terdaftar', '2026-07-01 13:38:04', '2026-07-01 13:39:10'),
(13, 9, 'REG-GPDRI91N', '2026-07-01 13:41:15', 'terdaftar', '2026-07-01 13:41:15', '2026-07-01 13:41:21'),
(14, 9, 'REG-JIDDSDQX', '2026-07-01 13:41:51', 'terdaftar', '2026-07-01 13:41:51', '2026-07-01 13:41:58'),
(15, 13, 'REG-G8E0JM5X', '2026-07-01 13:43:38', 'terdaftar', '2026-07-01 13:43:38', '2026-07-01 13:43:38'),
(16, 6, 'REG-C8OLJAOR', '2026-07-01 13:44:25', 'terdaftar', '2026-07-01 13:44:25', '2026-07-01 13:44:35');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `id_pendaftaran` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `id_pendaftaran`, `created_at`, `updated_at`) VALUES
(2, 2, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(3, 3, '2026-06-26 14:32:57', '2026-06-26 14:32:57'),
(5, 5, '2026-06-26 14:32:57', '2026-06-26 14:32:57'),
(8, 8, '2026-07-01 13:28:10', '2026-07-01 13:28:10'),
(9, 9, '2026-07-01 13:33:27', '2026-07-01 13:33:27'),
(10, 10, '2026-07-01 13:36:23', '2026-07-01 13:36:23'),
(11, 11, '2026-07-01 13:37:03', '2026-07-01 13:37:03'),
(12, 12, '2026-07-01 13:38:04', '2026-07-01 13:38:04'),
(13, 13, '2026-07-01 13:41:15', '2026-07-01 13:41:15'),
(14, 14, '2026-07-01 13:41:51', '2026-07-01 13:41:51'),
(15, 15, '2026-07-01 13:43:38', '2026-07-01 13:43:38'),
(16, 16, '2026-07-01 13:44:25', '2026-07-01 13:44:25');

-- --------------------------------------------------------

--
-- Table structure for table `sesi`
--

CREATE TABLE `sesi` (
  `id_sesi` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_sesi` varchar(100) DEFAULT NULL,
  `waktu_mulai` datetime DEFAULT NULL,
  `waktu_selesai` datetime DEFAULT NULL,
  `kuota_maksimal` int(11) DEFAULT NULL,
  `status_sesi` enum('buka','tutup') DEFAULT 'buka',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sesi`
--

INSERT INTO `sesi` (`id_sesi`, `id_event`, `id_kategori`, `nama_sesi`, `waktu_mulai`, `waktu_selesai`, `kuota_maksimal`, `status_sesi`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(4, 2, 1, 'Sesi Pagi', '2026-07-25 08:00:00', '2026-07-25 12:00:00', 150, 'buka', 1, 1, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(5, 2, 3, 'Sesi Dosen', '2026-07-25 08:00:00', '2026-07-25 12:00:00', 30, 'buka', 1, 1, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(6, 3, 1, 'Batch 1 (Full Day)', '2026-08-10 08:00:00', '2026-08-12 16:00:00', 25, 'buka', 2, 2, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(7, 3, 1, 'Batch 2 (Full Day)', '2026-08-17 08:00:00', '2026-08-19 16:00:00', 25, 'buka', 2, 2, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(8, 4, 1, 'Gelombang 1', '2026-08-05 08:00:00', '2026-08-05 11:00:00', 30, 'buka', 3, 3, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(9, 4, 1, 'Gelombang 2', '2026-08-05 13:00:00', '2026-08-05 16:00:00', 30, 'buka', 3, 3, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(10, 5, 1, 'Sesi 1', '2026-07-20 09:00:00', '2026-07-20 12:00:00', 40, 'tutup', 1, 1, '2026-06-26 14:32:56', '2026-07-01 23:57:21'),
(11, 5, 1, 'Sesi 2', '2026-07-20 13:00:00', '2026-07-20 16:00:00', 40, 'tutup', 1, 1, '2026-06-26 14:32:56', '2026-07-01 23:57:14'),
(12, 5, 4, 'Sesi Umum', '2026-07-20 09:00:00', '2026-07-20 16:00:00', 15, 'tutup', 1, 1, '2026-06-26 14:32:56', '2026-06-26 14:32:56'),
(13, 7, 1, 'Sesi Pagi', '2026-07-01 04:19:00', '2026-07-16 06:19:00', 23, 'buka', 2, 2, '2026-07-01 08:20:21', '2026-07-01 08:20:21'),
(14, 7, 1, 'Sesi Siang', '2026-07-07 16:19:00', '2026-07-15 16:20:00', 1000, 'buka', 2, 2, '2026-07-01 08:20:21', '2026-07-01 23:55:34'),
(15, 8, 1, 'Sesi Pagi', '2026-07-10 16:23:00', '2026-07-13 16:23:00', 333, 'buka', 2, 2, '2026-07-01 08:23:53', '2026-07-01 08:23:53'),
(16, 8, 1, 'Sesi Siang', '2026-07-21 16:23:00', '2026-07-30 16:23:00', 50, 'buka', 2, 2, '2026-07-01 08:23:53', '2026-07-01 08:23:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `uk_username` (`username`);

--
-- Indexes for table `data_peserta`
--
ALTER TABLE `data_peserta`
  ADD PRIMARY KEY (`id_data`),
  ADD UNIQUE KEY `uk_peserta_field` (`id_peserta`,`id_field`),
  ADD KEY `id_field` (`id_field`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `field_kategori`
--
ALTER TABLE `field_kategori`
  ADD PRIMARY KEY (`id_field`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori_peserta`
--
ALTER TABLE `kategori_peserta`
  ADD PRIMARY KEY (`id_kategori`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id_metode`);

--
-- Indexes for table `panitia`
--
ALTER TABLE `panitia`
  ADD PRIMARY KEY (`id_panitia`),
  ADD UNIQUE KEY `uk_username` (`username`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_pendaftaran` (`id_pendaftaran`),
  ADD KEY `id_metode` (`id_metode`),
  ADD KEY `diverifikasi_oleh` (`diverifikasi_oleh`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`),
  ADD UNIQUE KEY `uk_kode_pendaftaran` (`kode_pendaftaran`),
  ADD KEY `id_sesi` (`id_sesi`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD KEY `id_pendaftaran` (`id_pendaftaran`);

--
-- Indexes for table `sesi`
--
ALTER TABLE `sesi`
  ADD PRIMARY KEY (`id_sesi`),
  ADD KEY `id_event` (`id_event`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_peserta`
--
ALTER TABLE `data_peserta`
  MODIFY `id_data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `field_kategori`
--
ALTER TABLE `field_kategori`
  MODIFY `id_field` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `kategori_peserta`
--
ALTER TABLE `kategori_peserta`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id_metode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `panitia`
--
ALTER TABLE `panitia`
  MODIFY `id_panitia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sesi`
--
ALTER TABLE `sesi`
  MODIFY `id_sesi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_peserta`
--
ALTER TABLE `data_peserta`
  ADD CONSTRAINT `data_peserta_ibfk_1` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`) ON DELETE CASCADE,
  ADD CONSTRAINT `data_peserta_ibfk_2` FOREIGN KEY (`id_field`) REFERENCES `field_kategori` (`id_field`);

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `panitia` (`id_panitia`),
  ADD CONSTRAINT `event_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `panitia` (`id_panitia`);

--
-- Constraints for table `field_kategori`
--
ALTER TABLE `field_kategori`
  ADD CONSTRAINT `field_kategori_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_peserta` (`id_kategori`) ON DELETE CASCADE;

--
-- Constraints for table `kategori_peserta`
--
ALTER TABLE `kategori_peserta`
  ADD CONSTRAINT `kategori_peserta_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `panitia` (`id_panitia`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_pendaftaran`) REFERENCES `pendaftaran` (`id_pendaftaran`),
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_metode`) REFERENCES `metode_pembayaran` (`id_metode`),
  ADD CONSTRAINT `pembayaran_ibfk_3` FOREIGN KEY (`diverifikasi_oleh`) REFERENCES `panitia` (`id_panitia`) ON DELETE SET NULL;

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_ibfk_1` FOREIGN KEY (`id_sesi`) REFERENCES `sesi` (`id_sesi`);

--
-- Constraints for table `peserta`
--
ALTER TABLE `peserta`
  ADD CONSTRAINT `peserta_ibfk_1` FOREIGN KEY (`id_pendaftaran`) REFERENCES `pendaftaran` (`id_pendaftaran`) ON DELETE CASCADE;

--
-- Constraints for table `sesi`
--
ALTER TABLE `sesi`
  ADD CONSTRAINT `sesi_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `event` (`id_event`) ON DELETE CASCADE,
  ADD CONSTRAINT `sesi_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_peserta` (`id_kategori`),
  ADD CONSTRAINT `sesi_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `panitia` (`id_panitia`),
  ADD CONSTRAINT `sesi_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `panitia` (`id_panitia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
