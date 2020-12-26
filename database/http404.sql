-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           8.0.21 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Versão:              11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for adc_http404
DROP DATABASE IF EXISTS `adc_http404`;
CREATE DATABASE IF NOT EXISTS `adc_http404` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `adc_http404`;

-- Dumping structure for table adc_http404.clientes
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `IDCliente` int NOT NULL AUTO_INCREMENT,
  `Nome` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NIF` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Telemovel` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Pais` char(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Morada` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Cod_Postal` char(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ValorTotalCompras` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto` longblob,
  PRIMARY KEY (`IDCliente`),
  KEY `FKCodigoPostal` (`Cod_Postal`),
  CONSTRAINT `FKCodigoPostal` FOREIGN KEY (`Cod_Postal`) REFERENCES `cod_postal` (`IDCod_Postal`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci COMMENT='Clientes que se registaram através do checkout na loja online ou numa loja física';

-- Dumping data for table adc_http404.clientes: ~3 rows (approximately)
DELETE FROM `clientes`;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`IDCliente`, `Nome`, `NIF`, `Email`, `Telemovel`, `Pais`, `Morada`, `Cod_Postal`, `ValorTotalCompras`, `foto`) VALUES
	(1, 'Jacob Alexender', '999 999 999', 'jacobalexender@thisemailsdoesnotexist.com', '999 123 123 ', 'Portugal', 'Rua Aleatoria, Porta 12, 5º Direito', '8800-070', '70.000€', _binary ''),
	(2, 'James Momem Nirob', '123 123 123 ', 'jamesnirob@randommail.com', '123 812 000', 'Portugal', 'Rua Direita, Porta 21,  12º Esquerdo', '8300-100', '83.500€', NULL),
	(3, 'Pedro Gomes', '290 189 213', 'pedrogomes123@emailnaoexiste.com', '122 231 123', 'Portugal', 'Avenida Central, Edificio Rosas, 2º Direito', '8700-171', '489€', NULL);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

-- Dumping structure for table adc_http404.cod_postal
DROP TABLE IF EXISTS `cod_postal`;
CREATE TABLE IF NOT EXISTS `cod_postal` (
  `IDCod_Postal` char(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Localidade` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IDCod_Postal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Dumping data for table adc_http404.cod_postal: ~4 rows (approximately)
DELETE FROM `cod_postal`;
/*!40000 ALTER TABLE `cod_postal` DISABLE KEYS */;
INSERT INTO `cod_postal` (`IDCod_Postal`, `Localidade`) VALUES
	('8300-100', 'Silves'),
	('8700-171', 'Olhao'),
	('8800-070', 'Tavira'),
	('8800-295', 'Faro');
/*!40000 ALTER TABLE `cod_postal` ENABLE KEYS */;

-- Dumping structure for table adc_http404.interessados
DROP TABLE IF EXISTS `interessados`;
CREATE TABLE IF NOT EXISTS `interessados` (
  `IDInteressado` int NOT NULL AUTO_INCREMENT,
  `Email` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`IDInteressado`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci COMMENT='"Semi-clientes" que apenas colocaram seu email no site';

-- Dumping data for table adc_http404.interessados: ~5 rows (approximately)
DELETE FROM `interessados`;
/*!40000 ALTER TABLE `interessados` DISABLE KEYS */;
INSERT INTO `interessados` (`IDInteressado`, `Email`) VALUES
	(1, 'jacobalexender@thisemailsdoesnotexist.com'),
	(2, 'jamesnirob@randommail.com'),
	(3, 'pedrogomes123@emailnaoexiste.com'),
	(4, 'andorelouise@gmail.com'),
	(5, 'a70648@ualg.pt');
/*!40000 ALTER TABLE `interessados` ENABLE KEYS */;

-- Dumping structure for table adc_http404.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cargo` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Dumping data for table adc_http404.users: ~4 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id_users`, `nome`, `email`, `pass`, `cargo`) VALUES
	(1, 'André Pereira', 'andorelouise@gmail.com', '88462331', 'admin'),
	(2, 'Rui Fernandes', 'a70648@ualg.pt', '12345', 'admin'),
	(3, 'José Garcia', 'a70658@ualg.pt', '12345', 'admin'),
	(4, 'Kleyton Trovão', 'a69258@ualg.pt', '12345', 'admin');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table adc_http404.veiculos
DROP TABLE IF EXISTS `veiculos`;
CREATE TABLE IF NOT EXISTS `veiculos` (
  `IDVeiculo` int NOT NULL AUTO_INCREMENT,
  `Tipoveiculo` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `preco` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `modelo` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `marca` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `estadoveiculo` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `velocidademaxima` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `peso` float NOT NULL,
  `consumomedio` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cambio` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `combustivel` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IDVeiculo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Dumping data for table adc_http404.veiculos: ~4 rows (approximately)
DELETE FROM `veiculos`;
/*!40000 ALTER TABLE `veiculos` DISABLE KEYS */;
INSERT INTO `veiculos` (`IDVeiculo`, `Tipoveiculo`, `preco`, `modelo`, `marca`, `estadoveiculo`, `velocidademaxima`, `peso`, `consumomedio`, `cambio`, `combustivel`) VALUES
	(1, 'Carro', '50.000€', 'RC 200t', 'Lexus', 'Novo', '230 km/h', 1755, ' 7.2 litros/100km', 'Automatico', 'Gasolina'),
	(2, 'Carro', '30.000€', 'S60 T6 AWD R-Design Platinum 2017', 'Volvo', 'Novo', '230 km/h', 1684, ' 10 litros/100km', 'Automatico', 'Gasolina'),
	(3, 'Carro', '66.000€', 'GR Supra', 'Toyota', 'Novo', '250 km/h', 1815, '6 litros/100km', 'Automatico', 'Gasolina'),
	(4, 'Moto', '17.000€', 'K 1600 GT', 'BMW', 'Novo', '250 km/h', 306, '6 litros/100km', 'Manual', 'Gasolina');
/*!40000 ALTER TABLE `veiculos` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
