-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 25/09/2020 às 22:37
-- Versão do servidor: 5.7.31
-- Versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pizzapi`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cargos`
--

DROP TABLE IF EXISTS `cargos`;
CREATE TABLE IF NOT EXISTS `cargos` (
  `codCargos` int(11) NOT NULL AUTO_INCREMENT,
  `descricaoCargos` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codCargos`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `cargos`
--

INSERT INTO `cargos` (`codCargos`, `descricaoCargos`) VALUES
(1, 'GERENTE');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `codCliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
  PRIMARY KEY (`codCliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco`
--

DROP TABLE IF EXISTS `endereco`;
CREATE TABLE IF NOT EXISTS `endereco` (
  `codEndereco` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `numero` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bairro` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `complemento` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codCliente` int(11) NOT NULL,
  KEY `fk_Endereco_Cliente_idx` (`codCliente`)
  PRIMARY KEY (`codEndereco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `itenspedido`
--

DROP TABLE IF EXISTS `itenspedido`;
CREATE TABLE IF NOT EXISTS `itenspedido` (
  `codPedido` int(11) NOT NULL,
  `codProdutos` int(11) NOT NULL,
  `quatidade` int(11) NOT NULL,
  `valorFinal` decimal(10,2) NOT NULL,
  PRIMARY KEY (`codPedido`,`codProdutos`),
  KEY `fk_Pedido_has_Produtos_Produtos1_idx` (`codProdutos`),
  KEY `fk_Pedido_has_Produtos_Pedido1_idx` (`codPedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
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
-- Despejando dados para a tabela `produtos`
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
-- Estrutura para tabela `statuspedido`
--

DROP TABLE IF EXISTS `statuspedido`;
CREATE TABLE IF NOT EXISTS `statuspedido` (
  `codStatusPedido` int(11) NOT NULL AUTO_INCREMENT,
  `statusDescricao` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codStatusPedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipoproduto`
--

DROP TABLE IF EXISTS `tipoproduto`;
CREATE TABLE IF NOT EXISTS `tipoproduto` (
  `codTipoProduto` int(11) NOT NULL AUTO_INCREMENT,
  `descricaoTipo` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codTipoProduto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `tipoproduto`
--

INSERT INTO `tipoproduto` (`codTipoProduto`, `descricaoTipo`) VALUES
(1, 'PIZZA'),
(2, 'BEBIDA');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
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
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`codUsuario`, `nome`, `login`, `senha`, `codCargos`) VALUES
(1, 'Danilo Ferreira', 'danilo', '202cb962ac59075b964b07152d234b70', 1);

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `cliente`
--
ALTER TABLE `endereco``
  ADD CONSTRAINT `fk_Endereco_Cliente_idx` FOREIGN KEY (`codCliente`) REFERENCES `cliente` (`codCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `itenspedido`
--
ALTER TABLE `itenspedido`
  ADD CONSTRAINT `fk_ItensPedido_Pedido1` FOREIGN KEY (`codPedido`) REFERENCES `pedido` (`codPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ItensPedido_Produtos1` FOREIGN KEY (`codProdutos`) REFERENCES `produtos` (`codProdutos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_Pedido_Cliente` FOREIGN KEY (`codCliente`) REFERENCES `cliente` (`codCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedido_StatusPedido1` FOREIGN KEY (`codStatusPedido`) REFERENCES `statuspedido` (`codStatusPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedido_Usuario` FOREIGN KEY (`codUsuarioRegistro`) REFERENCES `usuario` (`codUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_Produtos_TipoProduto1` FOREIGN KEY (`codTipoProduto`) REFERENCES `tipoproduto` (`codTipoProduto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_Cargos1` FOREIGN KEY (`codCargos`) REFERENCES `cargos` (`codCargos`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
