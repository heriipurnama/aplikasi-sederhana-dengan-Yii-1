-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 24, 2015 at 08:39 AM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `negara`
--

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE IF NOT EXISTS `kota` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `provinsi_id` int(20) NOT NULL,
  `nm_kota` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_kota` (`provinsi_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id`, `provinsi_id`, `nm_kota`) VALUES
(1, 1, 'kodya jogja'),
(2, 2, 'sleman'),
(3, 3, 'GuKid'),
(4, 1, 'bantul'),
(5, 1, 'klaten'),
(6, 2, 'magelang'),
(7, 2, 'mesum');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `nip` int(20) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `agama` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE IF NOT EXISTS `provinsi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provinsi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id`, `provinsi`) VALUES
(1, 'Daerah Istimewa Yogyakarta'),
(2, 'Jawa Tenggah'),
(3, 'Jawa Barat'),
(4, 'Jawa Timur'),
(5, 'Banten'),
(6, 'Bali');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kota`
--
ALTER TABLE `kota`
  ADD CONSTRAINT `FK_kota` FOREIGN KEY (`provinsi_id`) REFERENCES `provinsi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
