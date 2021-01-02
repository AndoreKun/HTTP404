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
CREATE DATABASE IF NOT EXISTS `adc_http404` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `adc_http404`;

-- Dumping structure for table adc_http404.artigos
CREATE TABLE IF NOT EXISTS `artigos` (
  `IDArtigo` int NOT NULL AUTO_INCREMENT,
  `Nome` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Descricao` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Tipo_artigo` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `preco` float NOT NULL,
  `Em_Stock` char(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IDArtigo`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table adc_http404.artigos: ~12 rows (approximately)
DELETE FROM `artigos`;
/*!40000 ALTER TABLE `artigos` DISABLE KEYS */;
INSERT INTO `artigos` (`IDArtigo`, `Nome`, `Descricao`, `Tipo_artigo`, `preco`, `Em_Stock`) VALUES
	(1, 'Performance Machine Supra Real Wheel', 'Rodas para mota', 'Peças', 1399, 'Sim'),
	(2, 'Motorcycle Radiator Cooler For Kawasaki Ninja', 'Radiador para mota', 'Peças', 83, 'Sim'),
	(3, 'Universal Motorcycle Retro Diamond Flat Style Seat', 'Assento para mota', 'Peças', 40, 'Sim'),
	(4, 'Halo Motorcycle Headlight', 'Farol da frente para mota', 'Peças', 79, 'Sim'),
	(5, 'Dished Wassell Peanut Motorcycle Gas Tank', 'Tanque de gasolina para mota', 'Peças', 1999.99, 'Sim'),
	(6, 'Fydun Motorcycle Speedometer', 'Velocimetro', 'Peças', 69.99, 'Sim'),
	(7, 'Adult Full Face Matto Blue Helmet', 'Capacete ', 'Acessorios', 63.88, 'Sim'),
	(8, '\nRacing 3 Leather Jacket\n', 'Casaco desportivo para moto ', 'Acessorios', 489, 'Sim'),
	(9, '\nFORMA Adventure Off-Road Motorcycle Boots\n', 'Botas ', 'Acessorios', 270, 'Sim'),
	(10, '\nHEROBIKER Motorcycle Knee Pads\n', 'Joelheiras', 'Acessorios', 36, 'Sim'),
	(11, 'Daianese V E1 Elbow Guards\n', 'Cotoveleiras', 'Acessorios', 64, 'Sim'),
	(12, 'LS2 Helmets Full Face Blaze Adventure Motorcycle Helmet, Matte Titanium 436B-103', 'Capacete', 'Acessorios', 134, 'Sim');
/*!40000 ALTER TABLE `artigos` ENABLE KEYS */;

-- Dumping structure for table adc_http404.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `IDNIF_Cliente` char(9) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Nome` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Telemovel` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Pais` char(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Morada` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Cod_Postal` char(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `foto` longblob,
  PRIMARY KEY (`IDNIF_Cliente`) USING BTREE,
  KEY `FKCodigoPostal` (`Cod_Postal`),
  CONSTRAINT `FKCodigoPostal` FOREIGN KEY (`Cod_Postal`) REFERENCES `cod_postal` (`IDCod_Postal`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Clientes que se registaram através do checkout na loja online ou numa loja física';

-- Dumping data for table adc_http404.clientes: ~3 rows (approximately)
DELETE FROM `clientes`;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`IDNIF_Cliente`, `Nome`, `Email`, `Telemovel`, `Pais`, `Morada`, `Cod_Postal`, `foto`) VALUES
	('123123123', 'James Momem Nirob', 'jamesnirob@randommail.com', '123 812 000', 'Portugal', 'Rua Direita, Porta 21,  12º Esquerdo', '8300-100', NULL),
	('290189213', 'Pedro Gomes', 'pedrogomes123@emailnaoexiste.com', '122 231 123', 'Portugal', 'Avenida Central, Edificio Rosas, 2º Direito', '8700-171', NULL),
	('999999999', 'Jacob Alexender', 'jacobalexender@thisemailsdoesnotexist.com', '999 123 123 ', 'Portugal', 'Rua Aleatoria, Porta 12, 5º Direito', '8800-070', NULL);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

-- Dumping structure for table adc_http404.cod_postal
CREATE TABLE IF NOT EXISTS `cod_postal` (
  `IDCod_Postal` char(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Localidade` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IDCod_Postal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
CREATE TABLE IF NOT EXISTS `interessados` (
  `IDInteressado` int NOT NULL AUTO_INCREMENT,
  `Email` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IDInteressado`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='"Semi-clientes" que apenas colocaram seu email no site';

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
CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cargo` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table adc_http404.users: ~5 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id_users`, `nome`, `email`, `pass`, `cargo`) VALUES
	(1, 'André Pereira', 'andorelouise@gmail.com', 'http404#2021%', 'admin'),
	(2, 'Rui Fernandes', 'a70648@ualg.pt', 'http404#2021%', 'admin'),
	(3, 'José Garcia', 'a70658@ualg.pt', 'http404#2021%', 'admin'),
	(4, 'Kleyton Trovão', 'a69258@ualg.pt', 'http404#2021%', 'admin'),
	(5, 'Matombina Lopes', 'patraoml@http404.com', 'patrao&%2021', 'patrao'),
	(6, 'Lisdália Guerreiro', 'lguerreiro@http404.com', 'vendedores$2021*', 'vendedores');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table adc_http404.veiculos
CREATE TABLE IF NOT EXISTS `veiculos` (
  `IDVeiculo` int NOT NULL AUTO_INCREMENT,
  `modelo` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `marca` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `preco` float NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table adc_http404.veiculos: ~6 rows (approximately)
DELETE FROM `veiculos`;
/*!40000 ALTER TABLE `veiculos` DISABLE KEYS */;
INSERT INTO `veiculos` (`IDVeiculo`, `modelo`, `marca`, `preco`, `Tipoveiculo`, `estadoveiculo`, `velocidademaxima`, `peso`, `consumomedio`, `cambio`, `combustivel`, `Em_stock`, `pronto_adicionar_stock`) VALUES
	(1, 'RC 200t', 'Lexus', 50000, 'Carro', 'Novo', '230 km/h', 1755, ' 7.2 litros/100km', 'Automatico', 'Gasolina', 'Sim', NULL),
	(2, 'S60 T6 AWD R-Design Platinum 2017', 'Volvo', 30000, 'Carro', 'Novo', '230 km/h', 1684, ' 10 litros/100km', 'Automatico', 'Gasolina', 'Sim', NULL),
	(3, 'GR Supra', 'Toyota', 66000, 'Carro', 'Novo', '250 km/h', 1815, '6 litros/100km', 'Automatico', 'Gasolina', 'Sim', NULL),
	(4, 'K 1600 GT', 'BMW', 17000, 'Moto', 'Novo', '250 km/h', 306, '6 litros/100km', 'Manual', 'Gasolina', 'Sim', NULL),
	(5, '525 D PACK M AUTO', 'BMW', 51000, 'Carro', 'Semi-Novo', '243 km/h', 1725, '6.2 litros/100km', 'Semi-Automatico', 'Gasolina', 'Não', 'Sim'),
	(6, 'Tracer 700', 'Yamaha', 8700, 'Moto', 'Novo', '201 km/h', 196, '4.3 litros/100km', 'Manual', 'Gasolina', 'Não', 'Sim');
/*!40000 ALTER TABLE `veiculos` ENABLE KEYS */;

-- Dumping structure for table adc_http404.vendas
CREATE TABLE IF NOT EXISTS `vendas` (
  `IDVenda` int NOT NULL AUTO_INCREMENT,
  `IDNIF_Cliente` char(9) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `IDVeiculo` int DEFAULT NULL,
  `IDArtigo` int DEFAULT NULL,
  `ValorVenda` float NOT NULL,
  `DataVenda` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IDFuncionario` int NOT NULL,
  PRIMARY KEY (`IDVenda`),
  KEY `FKIDVeiculo` (`IDVeiculo`),
  KEY `FKIDArtigo` (`IDArtigo`),
  KEY `FKid_users` (`IDFuncionario`) USING BTREE,
  KEY `FKIDNIF_Cliente` (`IDNIF_Cliente`),
  CONSTRAINT `FKIDArtigo` FOREIGN KEY (`IDArtigo`) REFERENCES `artigos` (`IDArtigo`) ON UPDATE CASCADE,
  CONSTRAINT `FKIDFuncionario` FOREIGN KEY (`IDFuncionario`) REFERENCES `users` (`id_users`) ON UPDATE CASCADE,
  CONSTRAINT `FKIDNIF_Cliente` FOREIGN KEY (`IDNIF_Cliente`) REFERENCES `clientes` (`IDNIF_Cliente`) ON UPDATE CASCADE,
  CONSTRAINT `FKIDVeiculo` FOREIGN KEY (`IDVeiculo`) REFERENCES `veiculos` (`IDVeiculo`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table adc_http404.vendas: ~7 rows (approximately)
DELETE FROM `vendas`;
/*!40000 ALTER TABLE `vendas` DISABLE KEYS */;
INSERT INTO `vendas` (`IDVenda`, `IDNIF_Cliente`, `IDVeiculo`, `IDArtigo`, `ValorVenda`, `DataVenda`, `IDFuncionario`) VALUES
	(1, '999999999', 3, NULL, 66000, '2020-11-21 18:32:31', 6),
	(2, '123123123', 1, NULL, 50000, '2020-12-27 10:27:45', 6),
	(3, '123123123', 4, NULL, 17000, '2020-12-27 10:30:45', 6),
	(4, '123123123', NULL, 7, 64.88, '2020-12-28 15:31:59', 6),
	(5, '123123123', NULL, 8, 489, '2020-12-28 15:31:59', 6),
	(6, '290189213', NULL, 8, 489, '2020-12-28 18:48:37', 6),
	(7, '290189213', NULL, 9, 270, '2020-12-30 13:53:17', 6);
/*!40000 ALTER TABLE `vendas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
