-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 19/09/2020 às 21:02
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
-- Estrutura para tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `codProdutos` int(11) NOT NULL AUTO_INCREMENT,
  `nomeProduto` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descricaoProduto` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
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
(6, 'Margherita', 'Mussarela, tomate, oregano e manjericão', '18.00', 1, b'1'),
(7, 'COCA-COLA 2L', 'Refrigerante Coca-cola de 2 litros.', '8.00', 2, b'1'),
(8, 'COCA-COLA LATA', 'Refrigerante Coca-cola lata de 350ml.', '5.50', 2, b'1'),
(9, 'FANTA LARANJA 2L', 'Refrigerante Fanta Laranja de 2 litros.', '8.00', 2, b'1'),
(10, 'FANTA LARANJA LATA', 'Refrigerante Fanta Laranja lata lata de 350ml.', '5.50', 2, b'1');

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_Produtos_TipoProduto1` FOREIGN KEY (`codTipoProduto`) REFERENCES `tipoproduto` (`codTipoProduto`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
