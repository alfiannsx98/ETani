-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2019 at 10:46 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsipadifinal1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(128) NOT NULL,
  `nama_admin` varchar(256) NOT NULL,
  `email_admin` varchar(256) NOT NULL,
  `gambar_admin` varchar(256) NOT NULL,
  `password_admin` varchar(256) NOT NULL,
  `admin_created` int(20) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email_admin`, `gambar_admin`, `password_admin`, `admin_created`, `alamat`, `level`) VALUES
('ADM1101', 'Alfian Rochmatul Irman', 'alfianrochmatul77@gmail.com', '5dd634ca141df.jpg', '$2y$10$/QtnRHsS7PN8fucdrcR21OcByYy8sf6WaCCAJcr/hoWP22fq5rIba', 1572078167, 'Kediri Hiri Hiri', 1),
('ADM1102', 'Wildan', 'wildanmangli29@gmail.com', '5dc7c8eb6e88e.jpg', '$2y$10$/QtnRHsS7PN8fucdrcR21OcByYy8sf6WaCCAJcr/hoWP22fq5rIba', 1573374168, 'Banyuwangi', 2),
('ADM1103', 'Teddy', 'teddy@gmail.com', '5dd6349136a2b.png', '$2y$10$/QtnRHsS7PN8fucdrcR21OcByYy8sf6WaCCAJcr/hoWP22fq5rIba', 11, 'Madura', 1),
('ADM1104', 'Myco', 'mycojihan@gmail.com', '5dd63499421b3.png', '$2y$10$/QtnRHsS7PN8fucdrcR21OcByYy8sf6WaCCAJcr/hoWP22fq5rIba', 1, 'Jember', 1),
('ADM1105', 'agoy', 'yoga@gmail.com', '5dd634aaa96b4.jpg', '$2y$10$/QtnRHsS7PN8fucdrcR21OcByYy8sf6WaCCAJcr/hoWP22fq5rIba', 1, 'Banyuwangi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_brg` varchar(256) NOT NULL,
  `nama_brg` varchar(256) NOT NULL,
  `id_ktg` varchar(128) NOT NULL,
  `gambar_brg` varchar(256) NOT NULL,
  `harga_brg` int(128) NOT NULL,
  `deskripsi_brg` varchar(256) NOT NULL,
  `tgl_upload` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dtl_brg`
--

CREATE TABLE `dtl_brg` (
  `id_brg` varchar(128) NOT NULL,
  `stok` int(11) NOT NULL,
  `id_exp` varchar(11) NOT NULL,
  `expired` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dtl_transaksi`
--

CREATE TABLE `dtl_transaksi` (
  `id_transaksi` varchar(256) NOT NULL,
  `id_barang` varchar(256) NOT NULL,
  `harga_satuan` int(20) NOT NULL,
  `jml_dibeli_tmp` int(10) NOT NULL,
  `jumlah_beli` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dtl_transaksi`
--

INSERT INTO `dtl_transaksi` (`id_transaksi`, `id_barang`, `harga_satuan`, `jml_dibeli_tmp`, `jumlah_beli`) VALUES
('IDTR1118191901', 'IDB1102', 12000, 2, 0),
('IDTR1118191901', 'IDB1102', 100000, 1, 0),
('1212ads', 'IDB1102', 12000, 12, 0),
('IDTR1119191902', 'IDB1101', 7000, 3, 0),
('IDTR1119191903', 'IDB1101', 9000, 5, 0),
('IDTR1119191905', 'IDB1101', 99, 20, 0),
('IDTR1119191907', 'IDB1101', 129, 10, 0),
('IDTR1119191908', 'IDB1101', 1, 6, 0),
('IDTR11191901', 'IDB1101', 12000, 7, 0),
('IDTR11191902', 'IDB1101', 12222, 12, 0),
('IDTR11201903', 'IDB1102', 9000, 12, 0),
('IDTR11201904', 'IDB1101', 500000, 10, 0),
('IDTR11201905', 'IDB1101', 500000, 5, 0),
('IDTR11201907', 'IDB1101', 500000, 2, 0),
('IDTR11201908', 'IDB1101', 500000, 8, 0),
('IDTR11201909', 'IDB1101', 500000, 215, 0),
('IDTR112019010', 'IDB1101', 500000, 10, 0),
('IDTR112019011', 'IDB1101', 500000, 10, 0);

--
-- Triggers `dtl_transaksi`
--
DELIMITER $$
CREATE TRIGGER `grosiran` AFTER INSERT ON `dtl_transaksi` FOR EACH ROW BEGIN
UPDATE dtl_brg SET stok=stok-new.jml_dibeli
WHERE id_brg=new.id_barang 
AND expired in (SELECT MIN(expired) FROM dtl_brg);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `expired`
--

CREATE TABLE `expired` (
  `id` int(11) NOT NULL,
  `expired` varchar(128) NOT NULL,
  `id_brg` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` varchar(128) NOT NULL,
  `nama_kategori` varchar(256) NOT NULL,
  `gmbr` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `gmbr`) VALUES
('KTG1101', 'Bakterisida', '5dd4f63d1b964.png'),
('KTG1102', 'ok', '5dd6c78812619.png');

-- --------------------------------------------------------

--
-- Table structure for table `kurir`
--

CREATE TABLE `kurir` (
  `id_kurir` varchar(128) NOT NULL,
  `nama_kurir` varchar(128) NOT NULL,
  `kota_tujuan` varchar(255) NOT NULL,
  `ongkir_kurir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kurir`
--

INSERT INTO `kurir` (`id_kurir`, `nama_kurir`, `kota_tujuan`, `ongkir_kurir`) VALUES
('IKR1101', 'JNE OKE', 'Bangkalan', 7000),
('IKR1102', 'JNE OKE', 'Banyuwangi ', 6000),
('IKR1103', 'JNE OKE ', 'Blitar', 7000),
('IKR1104', 'JNE OKE', 'Bondowoso', 6000),
('IKR1105', 'JNE OKE ', 'Bojonegoro', 6000),
('IKR1106', 'JNE OKE', 'Gresik', 7000),
('IKR1107', 'JNE OKE', 'Jombang', 7000),
('IKR1108', 'JNE OKE ', 'Kediri', 8000),
('IKR1109', 'JNE OKE ', 'Lamongan ', 7000),
('IKR1110', 'JNE OKE', 'Lumajang', 7000),
('IKR1111', 'JNE OKE ', 'Madiun', 8000),
('IKR1112', 'JNE OKE', 'Magetan', 7000),
('IKR1113', 'JNE OKE ', 'Malang', 7000),
('IKR1114', 'JNE OKE ', 'Mojokerto', 7000),
('IKR1115', 'JNE OKE', 'Nganjuk', 7000),
('IKR1116', 'JNE OKE ', 'Pacitan', 7000),
('IKR1117', 'JNE OKE ', 'Pamekasan', 7000),
('IKR1118', 'JNE OKE ', 'Pasuruan', 7000),
('IKR1119', 'JNE OKE ', 'Ponorogo', 7000),
('IKR1120', 'JNE OKE', 'Probolinggo ', 7000),
('IKR1121', 'JNE OKE', 'Sampang', 7000),
('IKR1122', 'JNE OKE', 'Sidoarjo', 8000),
('IKR1123', 'JNE OKE', 'Situbondo', 7000),
('IKR1124', 'JNE OKE', 'Sumenep', 11000),
('IKR1125', 'JNE OKE', 'Surabaya', 7000),
('IKR1126', 'JNE OKE ', 'Tuban', 7000),
('IKR1127', 'JNE OKE', 'Trenggalek', 7000),
('IKR1128', 'JNE OKE ', 'Tulungagung ', 7000);

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `id` int(11) NOT NULL,
  `nama_pembeli` varchar(256) NOT NULL,
  `email_pembeli` varchar(256) NOT NULL,
  `password_pembeli` varchar(256) NOT NULL,
  `nomor_hp` varchar(128) NOT NULL,
  `nik_pembeli` varchar(128) NOT NULL,
  `user_created` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `gambar_pembeli` varchar(256) NOT NULL,
  `gmbr_nik_pembeli` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `token_admin`
--

CREATE TABLE `token_admin` (
  `id` int(11) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `token_admin`
--

INSERT INTO `token_admin` (`id`, `kode`, `email`) VALUES
(22, '15dcb5a4f2e6e5', 'wildanmangli29@gmail.com'),
(23, '15dcb5beeaa5f0', 'adsasdok@gmail.com'),
(25, '15dcb5f509a374', 'wildanmangli29@gmail.com'),
(27, '15dd145507c5a5', 'alfianrochmatul77@gmail.com'),
(28, '15dd145735da95', 'alfianrochmatul77@gmail.com'),
(29, '15dd1457eb312f', 'alfianrochmatul77@gmail.com'),
(30, '15dd1459f8d4f2', 'alfianrochmatul77@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` varchar(128) NOT NULL,
  `nama_toko` varchar(256) NOT NULL,
  `alamat_toko` varchar(256) NOT NULL,
  `gambar_sampul` varchar(255) NOT NULL,
  `deskripsi_toko` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `alamat_toko`, `gambar_sampul`, `deskripsi_toko`) VALUES
('IDT001', 'SiPadi', 'Jember', '5dcd66d14c926.jpg', 'Menjual segala macam kebutuhan pokok');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(256) NOT NULL,
  `id_admin` varchar(128) NOT NULL,
  `id_pembeli` varchar(128) NOT NULL,
  `id_toko` varchar(128) NOT NULL,
  `alamat_kirim` varchar(256) NOT NULL,
  `tgl_kirim` int(64) NOT NULL,
  `kota_pembeli` varchar(128) NOT NULL,
  `ongkir_kurir` int(20) NOT NULL,
  `total_harga` int(20) NOT NULL,
  `total_final` int(20) NOT NULL,
  `status_bayar` int(11) NOT NULL,
  `status_kirim` int(11) NOT NULL,
  `tgl_transaksi` varchar(128) NOT NULL,
  `bukti_transfer` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_admin`, `id_pembeli`, `id_toko`, `alamat_kirim`, `tgl_kirim`, `kota_pembeli`, `ongkir_kurir`, `total_harga`, `total_final`, `status_bayar`, `status_kirim`, `tgl_transaksi`, `bukti_transfer`) VALUES
('IDTR11191901', 'ADM1101', 'IDB001', 'IDT001', 'asd', 1574152240, 'surabaya', 7000, 12000, 80000, 1, 1, '1574145451', '5dd38dc51b59c.png'),
('IDTR11191902', 'ADM1101', 'IDB001', 'IDT001', 'asd', 1574152503, 'surabaya', 7000, 122112, 12121212, 1, 1, '1574152479', '5dd3a92f544cf.png'),
('IDTR112019010', 'ADM1101', 'IDB001', 'IDT001', 'asd', 1574319991, 'surabaya', 7000, 1, 12, 1, 1, '1574217961', '5dd4a90f2dbad.png'),
('IDTR112019011', 'Belum Terkonfirmasi', 'IDB001', 'IDT001', 'asd', 0, 'surabaya', 7000, 11, 11, 0, 0, '1574218008', '5dd4a92bd8527.png'),
('IDTR11201903', 'ADM1103', 'IDB001', 'IDT001', 'asdsd', 1574210436, 'surabaya', 7000, 80000, 800090, 1, 1, '1574210299', '5dd48b11c2d03.png'),
('IDTR11201904', 'ADM1101', 'IDB001', 'IDT001', 'ASDAS', 1574213233, 'surabaya', 7000, 9, 9, 1, 1, '1574212455', '5dd4938690e2f.png'),
('IDTR11201905', 'ADM1101', 'IDB001', 'IDT001', 'ko', 1574217925, 'surabaya', 7000, 12000, 10000, 1, 1, '1574214594', '5dd49be5acac7.png'),
('IDTR11201906', 'Belum Terkonfirmasi', 'IDB001', 'IDT001', 'asdasd', 0, 'surabaya', 7000, 900, 90000, 0, 0, '1574214737', '5dd49c6aa9e91.png'),
('IDTR11201907', 'Belum Terkonfirmasi', 'IDB001', 'IDT001', 'ads', 0, 'surabaya', 7000, 1, 21, 0, 0, '1574215352', '5dd49ed54f7e8.png'),
('IDTR11201908', 'Belum Terkonfirmasi', 'IDB001', 'IDT001', 'asdokdasko', 0, 'surabaya', 7000, 12392139, 12392139, 0, 0, '1574215411', '5dd49f150bb60.png'),
('IDTR11201909', 'Belum Terkonfirmasi', 'IDB001', 'IDT001', 'ok1293', 0, 'surabaya', 7000, 129219, 12939132, 0, 0, '1574215520', '5dd49f734b7ca.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_brg`),
  ADD KEY `id_ktg` (`id_ktg`);

--
-- Indexes for table `dtl_transaksi`
--
ALTER TABLE `dtl_transaksi`
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`id_kurir`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token_admin`
--
ALTER TABLE `token_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pembeli` (`id_pembeli`,`id_toko`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `token_admin`
--
ALTER TABLE `token_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
