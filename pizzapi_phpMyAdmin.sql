-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 14, 2020 at 03:54 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `cargos`
--

DROP TABLE IF EXISTS `cargos`;
CREATE TABLE IF NOT EXISTS `cargos` (
  `codCargos` int(11) NOT NULL AUTO_INCREMENT,
  `descricaoCargos` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codCargos`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cargos`
--

INSERT INTO `cargos` (`codCargos`, `descricaoCargos`) VALUES
(1, 'GERENTE'),
(2, 'BALCONISTA');

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `codCliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`codCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`codCliente`, `nome`, `telefone`) VALUES
(20, 'Danilo dos Santos Ferreira', '91-98301-1363'),
(21, 'Viviane Quaresma Silva', '91-98307-1363'),
(22, 'LUIZA SILVA DOS SANTOS', '91-93249-5985'),
(23, 'JOSÉ SANTOS', '91-90001-1363'),
(24, 'MARIA SILVA', '91-99999-5555'),
(25, 'REGIANE QUARESMA SILVA', '91-98307-1363'),
(28, 'THIAGO SILVA', '91-88888-9999');

-- --------------------------------------------------------

--
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
CREATE TABLE IF NOT EXISTS `endereco` (
  `codEndereco` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `numero` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bairro` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `complemento` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cep` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codCliente` int(11) NOT NULL,
  PRIMARY KEY (`codEndereco`),
  KEY `fk_Endereco_Cliente_idx` (`codCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `endereco`
--

INSERT INTO `endereco` (`codEndereco`, `logradouro`, `numero`, `bairro`, `complemento`, `cep`, `codCliente`) VALUES
(3, 'Tv 25 De Junho 138a', '138', 'GUAMÁ', 'CASA A', NULL, 20),
(4, 'Rua Nova Segunda', '404', 'CONDOR', 'ESQUINA TUPINANBAS', NULL, 21),
(5, 'TRAVESSA 25 AGOSTO', '138', 'CONDOR', 'ESQUINA TUPINANBAS', NULL, 22),
(6, 'Tv 25 De OUTUBRO', '1600', 'NAZARÉ', 'ENTRE A E B', '66075-699', 23),
(7, 'RUA BANDEIRANTE', '11', 'SOUZA', 'ENTRE A E C', '66666-333', 24),
(8, 'TRAVESSA DOS TUPINAMBáS', '11', 'JURUNAS', 'ESQUINA RUA NOVA 2', '66033-850', 25),
(11, 'RUA BANDEIRANTE', '30', 'MARCO', 'ENTRE A E J', '66666-777', 28);

-- --------------------------------------------------------

--
-- Table structure for table `itenspedido`
--

DROP TABLE IF EXISTS `itenspedido`;
CREATE TABLE IF NOT EXISTS `itenspedido` (
  `codPedido` int(11) NOT NULL,
  `codProdutos` int(11) NOT NULL,
  `quatidade` int(11) NOT NULL,
  `valorFinal` decimal(10,2) NOT NULL,
  `observacaoItem` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`codPedido`,`codProdutos`),
  KEY `fk_Pedido_has_Produtos_Produtos1_idx` (`codProdutos`),
  KEY `fk_Pedido_has_Produtos_Pedido1_idx` (`codPedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `itenspedido`
--

INSERT INTO `itenspedido` (`codPedido`, `codProdutos`, `quatidade`, `valorFinal`, `observacaoItem`) VALUES
(9, 4, 1, '22.00', ''),
(9, 9, 1, '8.00', ''),
(10, 1, 1, '19.00', 'Sem cebola'),
(10, 2, 1, '20.00', 'Sem cebola'),
(10, 9, 1, '8.00', ''),
(11, 1, 2, '38.00', ''),
(11, 4, 1, '22.00', ''),
(11, 7, 1, '8.00', ''),
(12, 2, 1, '20.00', ''),
(12, 7, 1, '8.00', ''),
(13, 1, 2, '38.00', ''),
(13, 7, 1, '8.00', ''),
(14, 1, 2, '38.00', ''),
(14, 7, 1, '8.00', ''),
(15, 5, 1, '19.00', ''),
(15, 9, 1, '8.00', ''),
(16, 7, 1, '8.00', ''),
(16, 9, 1, '8.00', ''),
(17, 2, 1, '20.00', ''),
(17, 9, 2, '16.00', ''),
(18, 1, 2, '38.00', ''),
(18, 9, 1, '8.00', ''),
(19, 2, 1, '20.00', ''),
(19, 6, 1, '18.00', ''),
(20, 2, 1, '20.00', ''),
(20, 6, 1, '18.00', ''),
(21, 1, 1, '19.00', ''),
(21, 9, 1, '8.00', 'Gelada'),
(22, 1, 1, '19.00', ''),
(22, 9, 1, '8.00', 'Gelada'),
(23, 4, 1, '22.00', ''),
(23, 8, 1, '5.50', ''),
(24, 3, 2, '42.00', 'com oregano'),
(25, 1, 1, '19.00', ''),
(25, 3, 2, '42.00', 'com oregano'),
(26, 6, 3, '54.00', ''),
(27, 6, 2, '36.00', ''),
(27, 9, 1, '8.00', ''),
(28, 9, 1, '8.00', ''),
(28, 10, 1, '5.50', '');

-- --------------------------------------------------------

--
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `codPedido` int(11) NOT NULL AUTO_INCREMENT,
  `codStatusPedido` int(11) NOT NULL,
  `codCliente` int(11) NOT NULL,
  `codUsuarioRegistro` int(11) NOT NULL,
  `dataCriacao` datetime NOT NULL,
  `valorPedido` decimal(10,2) NOT NULL,
  `codUsuarioEntrega` int(11) DEFAULT NULL,
  `dataEntrega` datetime DEFAULT NULL,
  `codUsuarioExclusao` int(11) DEFAULT NULL,
  `dataExclusao` datetime DEFAULT NULL,
  PRIMARY KEY (`codPedido`),
  KEY `fk_Pedido_StatusPedido_idx` (`codStatusPedido`),
  KEY `fk_Pedido_Cliente_idx` (`codCliente`),
  KEY `fk_Pedido_Usuario_idx` (`codUsuarioRegistro`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pedido`
--

INSERT INTO `pedido` (`codPedido`, `codStatusPedido`, `codCliente`, `codUsuarioRegistro`, `dataCriacao`, `valorPedido`, `codUsuarioEntrega`, `dataEntrega`, `codUsuarioExclusao`, `dataExclusao`) VALUES
(9, 1, 25, 1, '2020-10-13 17:57:58', '30.00', NULL, NULL, NULL, NULL),
(10, 1, 25, 1, '2020-10-13 22:30:29', '47.00', NULL, NULL, NULL, NULL),
(11, 1, 25, 1, '2020-10-13 22:34:25', '68.00', NULL, NULL, NULL, NULL),
(12, 1, 25, 1, '2020-10-13 23:17:19', '28.00', NULL, NULL, NULL, NULL),
(13, 1, 25, 1, '2020-10-13 23:25:00', '46.00', NULL, NULL, NULL, NULL),
(14, 1, 25, 1, '2020-10-13 23:25:07', '46.00', NULL, NULL, NULL, NULL),
(15, 1, 25, 1, '2020-10-13 23:27:52', '27.00', NULL, NULL, NULL, NULL),
(16, 1, 25, 1, '2020-10-13 23:38:18', '16.00', NULL, NULL, NULL, NULL),
(17, 1, 25, 1, '2020-10-13 23:42:49', '36.00', NULL, NULL, NULL, NULL),
(18, 1, 25, 1, '2020-10-13 23:46:23', '46.00', NULL, NULL, NULL, NULL),
(19, 1, 25, 1, '2020-10-13 23:48:01', '38.00', NULL, NULL, NULL, NULL),
(20, 1, 25, 1, '2020-10-13 23:56:21', '38.00', NULL, NULL, NULL, NULL),
(21, 1, 25, 1, '2020-10-13 23:58:14', '27.00', NULL, NULL, NULL, NULL),
(22, 1, 25, 1, '2020-10-13 23:58:22', '27.00', NULL, NULL, NULL, NULL),
(23, 1, 25, 1, '2020-10-14 00:00:20', '27.50', NULL, NULL, NULL, NULL),
(24, 1, 25, 1, '2020-10-14 00:02:51', '42.00', NULL, NULL, NULL, NULL),
(25, 1, 25, 1, '2020-10-14 00:03:17', '61.00', NULL, NULL, NULL, NULL),
(26, 1, 25, 1, '2020-10-14 00:04:44', '54.00', NULL, NULL, NULL, NULL),
(27, 1, 25, 1, '2020-10-14 00:11:48', '44.00', NULL, NULL, NULL, NULL),
(28, 1, 25, 1, '2020-10-14 00:12:36', '13.50', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `codProdutos` int(11) NOT NULL AUTO_INCREMENT,
  `nomeProduto` varchar(100) CHARACTER SET utf8 NOT NULL,
  `descricaoProduto` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `codTipoProduto` int(11) NOT NULL,
  `statusAtivo` bit(1) NOT NULL,
  PRIMARY KEY (`codProdutos`),
  KEY `fk_Produtos_TipoProduto1_idx` (`codTipoProduto`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `produtos`
--

INSERT INTO `produtos` (`codProdutos`, `nomeProduto`, `descricaoProduto`, `valor`, `codTipoProduto`, `statusAtivo`) VALUES
(1, 'MUSSARELA', 'Queijo mussarela e oregano.', '19.00', 1, b'1'),
(2, 'CALABRESA', 'Mussarela, calabresa e cebola, oregano.', '20.00', 1, b'1'),
(3, '3 QUEIJOS', 'Mussarela, requeijão, oregano e parmesão ralado.', '21.00', 1, b'1'),
(4, 'FRANGO COM REQUEIJÃO', 'Frango desfiado, cebola, oregano e requeijão', '22.00', 1, b'1'),
(5, 'BAURU', 'Mussarela, presunto, requeijão, oregano e tomate.', '19.00', 1, b'1'),
(6, 'MARGHERITA', 'Mussarela, tomate, oregano e manjericão', '18.00', 1, b'1'),
(7, 'COCA-COLA 2L', 'Refrigerante Coca-cola de 2 litros.', '8.00', 2, b'1'),
(8, 'COCA-COLA LATA', 'Refrigerante Coca-cola lata de 350ml.', '5.50', 2, b'1'),
(9, 'FANTA LARANJA 2L', 'Refrigerante Fanta Laranja de 2 litros.', '8.00', 2, b'1'),
(10, 'FANTA LARANJA LATA', 'Refrigerante Fanta Laranja lata lata de 350ml.', '5.50', 2, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `statuspedido`
--

DROP TABLE IF EXISTS `statuspedido`;
CREATE TABLE IF NOT EXISTS `statuspedido` (
  `codStatusPedido` int(11) NOT NULL AUTO_INCREMENT,
  `statusDescricao` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codStatusPedido`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `statuspedido`
--

INSERT INTO `statuspedido` (`codStatusPedido`, `statusDescricao`) VALUES
(1, 'NOVO PEDIDO'),
(2, 'EM PRODUÇÃO'),
(3, 'PRONTO'),
(4, 'EM ENTREGA'),
(5, 'PEDIDO CONCLUÍDO'),
(6, 'CANCELADO');

-- --------------------------------------------------------

--
-- Table structure for table `tipoproduto`
--

DROP TABLE IF EXISTS `tipoproduto`;
CREATE TABLE IF NOT EXISTS `tipoproduto` (
  `codTipoProduto` int(11) NOT NULL AUTO_INCREMENT,
  `descricaoTipo` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codTipoProduto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tipoproduto`
--

INSERT INTO `tipoproduto` (`codTipoProduto`, `descricaoTipo`) VALUES
(1, 'PIZZA'),
(2, 'BEBIDA');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `codUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `codCargos` int(11) NOT NULL,
  PRIMARY KEY (`codUsuario`),
  KEY `fk_Usuario_Cargos1_idx` (`codCargos`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`codUsuario`, `nome`, `login`, `senha`, `codCargos`) VALUES
(1, 'Danilo Ferreira', 'danilo', '202cb962ac59075b964b07152d234b70', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `fk_Endereco_Cliente_idx` FOREIGN KEY (`codCliente`) REFERENCES `cliente` (`codCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `itenspedido`
--
ALTER TABLE `itenspedido`
  ADD CONSTRAINT `fk_ItensPedido_Pedido1` FOREIGN KEY (`codPedido`) REFERENCES `pedido` (`codPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ItensPedido_Produtos1` FOREIGN KEY (`codProdutos`) REFERENCES `produtos` (`codProdutos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_Pedido_Cliente` FOREIGN KEY (`codCliente`) REFERENCES `cliente` (`codCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedido_StatusPedido1` FOREIGN KEY (`codStatusPedido`) REFERENCES `statuspedido` (`codStatusPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedido_Usuario` FOREIGN KEY (`codUsuarioRegistro`) REFERENCES `usuario` (`codUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_Produtos_TipoProduto1` FOREIGN KEY (`codTipoProduto`) REFERENCES `tipoproduto` (`codTipoProduto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_Cargos1` FOREIGN KEY (`codCargos`) REFERENCES `cargos` (`codCargos`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
