-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.3.13-MariaDB-log - mariadb.org binary distribution
-- Операционная система:         Win64
-- HeidiSQL Версия:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных tournament
CREATE DATABASE IF NOT EXISTS `tournament` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tournament`;

-- Дамп структуры для таблица tournament.results
CREATE TABLE IF NOT EXISTS `results` (
  `team1` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `team2` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `res1` int(11) NOT NULL,
  `res2` int(11) NOT NULL,
  `tour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы tournament.results: ~45 rows (приблизительно)
/*!40000 ALTER TABLE `results` DISABLE KEYS */;
INSERT INTO `results` (`team1`, `team2`, `res1`, `res2`, `tour`) VALUES
	('Command-1', 'Command-2', 5, 5, 1),
	('Command-3', 'Command-4', 4, 3, 1),
	('Command-5', 'Command-6', 1, 2, 1),
	('Command-7', 'Command-8', 3, 5, 1),
	('Command-9', 'Command-10', 1, 3, 1),
	('Command-1', 'Command-3', 4, 2, 2),
	('Command-5', 'Command-2', 2, 2, 2),
	('Command-7', 'Command-4', 5, 2, 2),
	('Command-9', 'Command-6', 1, 2, 2),
	('Command-10', 'Command-8', 5, 5, 2),
	('Command-1', 'Command-5', 1, 1, 3),
	('Command-7', 'Command-3', 4, 4, 3),
	('Command-9', 'Command-2', 1, 0, 3),
	('Command-10', 'Command-4', 4, 2, 3),
	('Command-8', 'Command-6', 2, 1, 3),
	('Command-1', 'Command-7', 4, 5, 4),
	('Command-9', 'Command-5', 2, 1, 4),
	('Command-10', 'Command-3', 2, 5, 4),
	('Command-8', 'Command-2', 4, 2, 4),
	('Command-6', 'Command-4', 3, 4, 4),
	('Command-1', 'Command-9', 2, 1, 5),
	('Command-10', 'Command-7', 3, 5, 5),
	('Command-8', 'Command-5', 3, 1, 5),
	('Command-6', 'Command-3', 2, 0, 5),
	('Command-4', 'Command-2', 4, 2, 5),
	('Command-1', 'Command-10', 1, 4, 6),
	('Command-8', 'Command-9', 2, 5, 6),
	('Command-6', 'Command-7', 3, 1, 6),
	('Command-4', 'Command-5', 5, 1, 6),
	('Command-2', 'Command-3', 3, 4, 6),
	('Command-1', 'Command-8', 2, 4, 7),
	('Command-6', 'Command-10', 5, 0, 7),
	('Command-4', 'Command-9', 4, 4, 7),
	('Command-2', 'Command-7', 1, 1, 7),
	('Command-1', 'Command-6', 5, 5, 8),
	('Command-3', 'Command-5', 2, 0, 7),
	('Command-4', 'Command-8', 5, 3, 8),
	('Command-2', 'Command-10', 4, 0, 8),
	('Command-3', 'Command-9', 0, 4, 8),
	('Command-5', 'Command-7', 2, 3, 8),
	('Command-1', 'Command-4', 3, 0, 9),
	('Command-2', 'Command-6', 5, 1, 9),
	('Command-3', 'Command-8', 2, 2, 9),
	('Command-5', 'Command-10', 5, 3, 9),
	('Command-7', 'Command-9', 3, 5, 9);
/*!40000 ALTER TABLE `results` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
