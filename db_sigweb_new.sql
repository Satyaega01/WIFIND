-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_sigweb
CREATE DATABASE IF NOT EXISTS `db_sigweb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_sigweb`;

-- Dumping structure for table db_sigweb.tb_informasi
CREATE TABLE IF NOT EXISTS `tb_informasi` (
  `id_info` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id_info`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table db_sigweb.tb_informasi: 1 rows
DELETE FROM `tb_informasi`;
/*!40000 ALTER TABLE `tb_informasi` DISABLE KEYS */;
INSERT INTO `tb_informasi` (`id_info`, `content`, `last_update`) VALUES
	(1, '&lt;p style=&quot;text-align: justify;&quot;&gt;&lt;img style=&quot;float: left; margin-right: 5px; margin-left: 5px;&quot; src=&quot;/simplegis/admin/source/loremipsum.jpg?1526249437644&quot; alt=&quot;loremipsum&quot; width=&quot;349&quot; height=&quot;219&quot; /&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tincidunt velit placerat, bibendum nibh a, volutpat urna. Donec sollicitudin nulla libero, sed vulputate diam consequat commodo. Ut ultrices consequat nisl vel varius. Vestibulum consequat sem eu turpis luctus ullamcorper. Aliquam eu turpis lobortis elit tempus euismod. Vestibulum id sapien tristique, lacinia elit in, rutrum mauris. In id urna ac augue lobortis dignissim. Vestibulum imperdiet sit amet erat eget porttitor. Nunc nec odio nisl. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed mattis efficitur arcu, lacinia accumsan orci eleifend vitae. Nullam convallis pharetra ligula.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Donec sed aliquam sem, quis dictum ligula. Morbi orci dui, elementum faucibus gravida vel, tristique ut orci. In hac habitasse platea dictumst. Nam sit amet dapibus arcu, quis pharetra nibh. Maecenas efficitur aliquet facilisis. Vestibulum condimentum, velit quis consequat bibendum, ex elit rutrum libero, sit amet congue leo felis eu sem. Morbi et porttitor erat. Curabitur vulputate luctus sem sed luctus. Curabitur eget ultricies lacus, et rhoncus sapien. Donec eu tincidunt purus. Proin cursus ac velit quis ultrices. Donec augue tortor, gravida ut finibus ac, condimentum vel ante.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Duis ultricies lacus vitae ultricies imperdiet. Nullam rutrum enim tellus, et congue ante mollis at. Duis viverra eget elit et varius. Nam quis mollis neque. In sit amet est at elit aliquam pharetra consequat eget nibh. Quisque tincidunt tempor ipsum. Donec id neque a quam commodo tincidunt. Donec condimentum sem sed lectus venenatis, at finibus ligula fermentum.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Duis vestibulum, nisi quis posuere imperdiet, enim mi condimentum nulla, ut pretium enim tellus a ligula. Vestibulum porta nibh eget purus sollicitudin, eget lacinia felis egestas. Nam dignissim urna quis sodales euismod. Donec consectetur condimentum facilisis. Mauris tincidunt neque sed odio iaculis aliquet. Pellentesque quis volutpat erat, id tincidunt enim. Suspendisse iaculis enim vel ligula egestas, vel varius diam venenatis.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Quisque tempor, libero eget tristique mattis, elit diam posuere purus, ut gravida arcu leo vel lectus. Curabitur tortor nunc, auctor vitae orci ut, dignissim tincidunt enim. Vestibulum pharetra semper feugiat. Maecenas accumsan ex vel massa ultricies, ut sodales augue luctus. Maecenas ut odio feugiat libero auctor interdum quis in leo. Vivamus leo lectus, euismod vitae consequat at, pellentesque molestie turpis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus pellentesque augue in leo egestas, sit amet vestibulum ligula dictum. Nam feugiat nisl at dapibus sagittis. Nullam vulputate aliquet mi nec vulputate.&lt;/p&gt;', '2020-05-16 19:25:58');
/*!40000 ALTER TABLE `tb_informasi` ENABLE KEYS */;

-- Dumping structure for table db_sigweb.tb_markers
CREATE TABLE IF NOT EXISTS `tb_markers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `address` varchar(80) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `category` enum('university','hospital','hotel') NOT NULL,
  `foto` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Dumping data for table db_sigweb.tb_markers: 10 rows
DELETE FROM `tb_markers`;
/*!40000 ALTER TABLE `tb_markers` DISABLE KEYS */;
INSERT INTO `tb_markers` (`id`, `name`, `address`, `lat`, `lng`, `category`, `foto`) VALUES
	(1, 'Universitas Udayana', 'Jalan PB Sudirman', -8.672712326049805, 115.21855163574219, 'university', 'img-1.jpg'),
	(2, 'RSUP Sanglah', 'Jalan Diponegoro', -8.6757665793448, 115.21213173866273, 'hospital', 'img-2.jpg'),
	(3, 'RS Prima Medika', 'Jalan Raya Sesetan', -8.678312301635742, 115.214599609375, 'hospital', NULL),
	(4, 'RS Kasih Ibu', 'Jalan Teuku Umar', -8.67765445582382, 115.20529747009279, 'hospital', 'img-4.jpg'),
	(5, 'Fave Hotel Bali', 'Jalan Teuku Umar', -8.678651751587072, 115.2055025100708, 'hotel', NULL),
	(6, 'Stikom Bali', 'Jalan Raya Puputan Renon', -8.673050880432129, 115.2258071899414, 'university', NULL),
	(15, 'Hotel Nusa Dua', 'Nusa Dua', -8.801194172625891, 115.23465156555177, 'hotel', NULL),
	(11, 'Universitas Udayana Kampus Bukit', 'Kampus Bukit Jimbaran', -8.797981109950332, 115.17253579310272, 'university', NULL),
	(14, 'Kuta Hotel', 'Pantai Kuta', -8.729683981712537, 115.16796112060548, 'hotel', NULL);
/*!40000 ALTER TABLE `tb_markers` ENABLE KEYS */;

-- Dumping structure for table db_sigweb.tb_users
CREATE TABLE IF NOT EXISTS `tb_users` (
  `username` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status_blok` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table db_sigweb.tb_users: 1 rows
DELETE FROM `tb_users`;
/*!40000 ALTER TABLE `tb_users` DISABLE KEYS */;
INSERT INTO `tb_users` (`username`, `password`, `name`, `type`, `status_blok`) VALUES
	('admin', '0c64992bd5c227f52897b215b3bd8779', 'Administrator', 'admin', 1);
/*!40000 ALTER TABLE `tb_users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
