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

-- Dumping structure for table adc_http404.artigos
DROP TABLE IF EXISTS `artigos`;
CREATE TABLE IF NOT EXISTS `artigos` (
  `IDArtigo` int NOT NULL AUTO_INCREMENT,
  `Tipo_artigo` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Nome` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Preço` char(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Descricao` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`IDArtigo`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table adc_http404.artigos: ~0 rows (approximately)
DELETE FROM `artigos`;
/*!40000 ALTER TABLE `artigos` DISABLE KEYS */;
INSERT INTO `artigos` (`IDArtigo`, `Tipo_artigo`, `Nome`, `Preço`, `Descricao`) VALUES
	(1, 'Peças', 'Performance Machine Supra Real Wheel', '1399', 'Rodas para mota'),
	(2, 'Peças', 'Motorcycle Radiator Cooler For Kawasaki Ninja', '83', 'Radiador para mota'),
	(3, 'Peças', 'Universal Motorcycle Retro Diamond Flat Style Seat', '40', 'Assento para mota'),
	(4, 'Peças', 'Halo Motorcycle Headlight', '79', 'Farol da frente para mota'),
	(5, 'Peças', 'Dished Wassell Peanut Motorcycle Gas Tank', '1999.99', 'Tanque de gasolina para mota'),
	(6, 'Peças', 'Fydun Motorcycle Speedometer', '69.99', 'Velocimetro'),
	(7, 'Acessorios', 'Adult Full Face Matto Blue Helmet', '63.88', 'Capacete '),
	(8, 'Acessorios', '\nRacing 3 Leather Jacket\n', '489', 'Casaco desportivo para moto '),
	(9, 'Acessorios', '\nFORMA Adventure Off-Road Motorcycle Boots\n', '270', 'Botas '),
	(10, 'Acessorios', '\nHEROBIKER Motorcycle Knee Pads\n', '36', 'Joelheiras'),
	(11, 'Acessorios', 'Daianese V E1 Elbow Guards\n', '64', 'Cotoveleiras'),
	(12, 'Acessorios', 'LS2 Helmets Full Face Blaze Adventure Motorcycle Helmet, Matte Titanium 436B-103', '134', 'Capacete');
/*!40000 ALTER TABLE `artigos` ENABLE KEYS */;

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
	(1, 'Jacob Alexender', '999 999 999', 'jacobalexender@thisemailsdoesnotexist.com', '999 123 123 ', 'Portugal', 'Rua Aleatoria, Porta 12, 5º Direito', '8800-070', '66.000', NULL),
	(2, 'James Momem Nirob', '123 123 123 ', 'jamesnirob@randommail.com', '123 812 000', 'Portugal', 'Rua Direita, Porta 21,  12º Esquerdo', '8300-100', '67.552,88', NULL),
	(3, 'Pedro Gomes', '290 189 213', 'pedrogomes123@emailnaoexiste.com', '122 231 123', 'Portugal', 'Avenida Central, Edificio Rosas, 2º Direito', '8700-171', '489', NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Dumping data for table adc_http404.users: ~4 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id_users`, `nome`, `email`, `pass`, `cargo`) VALUES
	(1, 'André Pereira', 'andorelouise@gmail.com', 'http404#2021%', 'admin'),
	(2, 'Rui Fernandes', 'a70648@ualg.pt', 'http404#2021%', 'admin'),
	(3, 'José Garcia', 'a70658@ualg.pt', 'http404#2021%', 'admin'),
	(4, 'Kleyton Trovão', 'a69258@ualg.pt', 'http404#2021%', 'admin'),
	(5, 'Matombina Lopes', 'patraoml@http404.com', 'patrao&%2021', 'patrao');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table adc_http404.veiculos
DROP TABLE IF EXISTS `veiculos`;
CREATE TABLE IF NOT EXISTS `veiculos` (
  `IDVeiculo` int NOT NULL AUTO_INCREMENT,
  `modelo` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `marca` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `preco` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Tipoveiculo` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `estadoveiculo` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `velocidademaxima` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `peso` float NOT NULL,
  `consumomedio` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cambio` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `combustivel` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Em_stock` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pronto_adicionar_stock` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`IDVeiculo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Dumping data for table adc_http404.veiculos: ~4 rows (approximately)
DELETE FROM `veiculos`;
/*!40000 ALTER TABLE `veiculos` DISABLE KEYS */;
INSERT INTO `veiculos` (`IDVeiculo`, `modelo`, `marca`, `preco`, `Tipoveiculo`, `estadoveiculo`, `velocidademaxima`, `peso`, `consumomedio`, `cambio`, `combustivel`, `Em_stock`, `pronto_adicionar_stock`) VALUES
	(1, 'RC 200t', 'Lexus', '50.000', 'Carro', 'Novo', '230 km/h', 1755, ' 7.2 litros/100km', 'Automatico', 'Gasolina', 'Sim', NULL),
	(2, 'S60 T6 AWD R-Design Platinum 2017', 'Volvo', '30.000', 'Carro', 'Novo', '230 km/h', 1684, ' 10 litros/100km', 'Automatico', 'Gasolina', 'Sim', NULL),
	(3, 'GR Supra', 'Toyota', '66.000', 'Carro', 'Novo', '250 km/h', 1815, '6 litros/100km', 'Automatico', 'Gasolina', 'Sim', NULL),
	(4, 'K 1600 GT', 'BMW', '17.000', 'Moto', 'Novo', '250 km/h', 306, '6 litros/100km', 'Manual', 'Gasolina', 'Sim', NULL),
	(5, '525 D PACK M AUTO', 'BMW', '51.000', 'Carro', 'Semi-Novo', '243 km/h', 1725, '6.2 litros/100km', 'Semi-Automatico', 'Gasolina', 'Não', 'Sim'),
	(6, 'Tracer 700', 'Yamaha', '8.700', 'Moto', 'Novo', '201 km/h', 196, '4.3 litros/100km', 'Manual', 'Gasolina', 'Não', 'Sim');
/*!40000 ALTER TABLE `veiculos` ENABLE KEYS */;

-- Dumping structure for table adc_http404.vendas
DROP TABLE IF EXISTS `vendas`;
CREATE TABLE IF NOT EXISTS `vendas` (
  `IDVenda` int NOT NULL AUTO_INCREMENT,
  `IDCliente` int NOT NULL,
  `IDVeiculo` int DEFAULT NULL,
  `IDArtigo` int DEFAULT NULL,
  `ValorVenda` char(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `DataVenda` datetime NOT NULL,
  PRIMARY KEY (`IDVenda`),
  KEY `FKIDCliente` (`IDCliente`),
  KEY `FKIDVeiculo` (`IDVeiculo`),
  KEY `FKIDArtigo` (`IDArtigo`),
  CONSTRAINT `FKIDArtigo` FOREIGN KEY (`IDArtigo`) REFERENCES `artigos` (`IDArtigo`) ON UPDATE CASCADE,
  CONSTRAINT `FKIDCliente` FOREIGN KEY (`IDCliente`) REFERENCES `clientes` (`IDCliente`) ON UPDATE CASCADE,
  CONSTRAINT `FKIDVeiculo` FOREIGN KEY (`IDVeiculo`) REFERENCES `veiculos` (`IDVeiculo`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table adc_http404.vendas: ~0 rows (approximately)
DELETE FROM `vendas`;
/*!40000 ALTER TABLE `vendas` DISABLE KEYS */;
INSERT INTO `vendas` (`IDVenda`, `IDCliente`, `IDVeiculo`, `IDArtigo`, `ValorVenda`, `DataVenda`) VALUES
	(1, 1, 3, NULL, '66.000', '2020-12-21 18:32:31'),
	(2, 2, 1, NULL, '50.000', '2020-12-27 10:27:45'),
	(3, 2, 4, NULL, '17.000', '2020-12-27 10:30:45'),
	(4, 2, NULL, 7, '64,88', '2020-12-28 15:31:59'),
	(5, 2, NULL, 8, '489', '2020-12-28 15:31:59'),
	(6, 3, NULL, 8, '489', '2020-12-28 18:48:37');
/*!40000 ALTER TABLE `vendas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
