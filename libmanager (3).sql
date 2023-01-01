-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 01-Jan-2023 às 19:16
-- Versão do servidor: 5.7.36
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `libmanager`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_autor`
--

DROP TABLE IF EXISTS `tbl_autor`;
CREATE TABLE IF NOT EXISTS `tbl_autor` (
  `id_autor` int(11) NOT NULL AUTO_INCREMENT,
  `nome_autor` varchar(50) CHARACTER SET utf8 NOT NULL,
  `sobrenome_autor` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_autor`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_autor`
--

INSERT INTO `tbl_autor` (`id_autor`, `nome_autor`, `sobrenome_autor`) VALUES
(36, 'Anne', 'Frank'),
(35, 'Julio', 'Verne'),
(37, 'Peter', 'Weill'),
(38, 'Dan', 'Brown'),
(39, 'Matheus', 'Verne'),
(40, ' Steve', 'Krug');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_editora`
--

DROP TABLE IF EXISTS `tbl_editora`;
CREATE TABLE IF NOT EXISTS `tbl_editora` (
  `id_editora` int(11) NOT NULL AUTO_INCREMENT,
  `nome_editora` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_editora`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_editora`
--

INSERT INTO `tbl_editora` (`id_editora`, `nome_editora`) VALUES
(56, 'Alta Books'),
(55, 'Editora Arqueiro'),
(54, 'M.Books'),
(53, 'Record'),
(52, 'Principis'),
(51, 'Saraiva'),
(50, 'Contexto');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_funcionario`
--

DROP TABLE IF EXISTS `tbl_funcionario`;
CREATE TABLE IF NOT EXISTS `tbl_funcionario` (
  `id_funcionario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_funcionario` varchar(20) NOT NULL,
  PRIMARY KEY (`id_funcionario`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_funcionario`
--

INSERT INTO `tbl_funcionario` (`id_funcionario`, `nome_funcionario`) VALUES
(1, 'Nanderson Pinto');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_livro`
--

DROP TABLE IF EXISTS `tbl_livro`;
CREATE TABLE IF NOT EXISTS `tbl_livro` (
  `id_livro` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `edicao` varchar(20) DEFAULT NULL,
  `isbn` varchar(15) NOT NULL,
  `assunto` varchar(20) NOT NULL,
  `situacao` tinyint(1) NOT NULL,
  `id_autor` int(11) NOT NULL,
  `id_editora` int(11) NOT NULL,
  `path` varchar(100) NOT NULL,
  PRIMARY KEY (`id_livro`),
  KEY `id_autor` (`id_autor`),
  KEY `id_editora` (`id_editora`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_livro`
--

INSERT INTO `tbl_livro` (`id_livro`, `titulo`, `edicao`, `isbn`, `assunto`, `situacao`, `id_autor`, `id_editora`, `path`) VALUES
(11, 'Vinte mil lÃ©guas submarinas', '1', '8594318774', 'Aventura', 1, 35, 52, 'capas/63ab776ee6ec0.jpg'),
(9, 'A volta ao mundo em 80 dias', '1', '978-8594318145', 'Aventura', 1, 39, 52, 'capas/63b1d5f0a4d10.jpg'),
(12, 'Da Terra Ã  Lua', '1', '6555521732', 'Aventura', 1, 35, 52, 'capas/63ab77a2434fb.jpg'),
(13, 'GovernanÃ§a de TI - Tecnologia da InformaÃ§Ã£o', '1', '8589384780', 'TI', 1, 37, 54, 'capas/63b1d6126e1d3.jpg'),
(14, 'O CÃ³digo Da Vinci (Robert Langdon - Livro 2) ', '1', '978-6555651041', 'Suspense', 1, 38, 55, 'capas/63ab7be2efc9f.jpg'),
(15, 'NÃ£o me faÃ§a pensar: atualizado', 'EdiÃ§Ã£o atualizada', '978-8576088509', 'TI', 1, 40, 56, 'capas/63b1d81c04b24.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_usuario`
--

DROP TABLE IF EXISTS `tbl_usuario`;
CREATE TABLE IF NOT EXISTS `tbl_usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(20) NOT NULL,
  `email_usuario` varchar(50) DEFAULT NULL,
  `cpf_usuario` varchar(14) NOT NULL,
  `senha_usuario` varchar(255) NOT NULL,
  `telefone_usuario` varchar(15) NOT NULL,
  `endereco_usuario` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `cpf_usuario` (`cpf_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_usuario`, `nome_usuario`, `email_usuario`, `cpf_usuario`, `senha_usuario`, `telefone_usuario`, `endereco_usuario`) VALUES
(32, 'Nanderson Matheus', 'nandersonmatheusmelo@gmail.com', '555.666.777-89', '$2y$10$mbanbCu/02MtQIIPneQfoe2Fbv097nXRX4otUlIZ7aZrfvAzT9NcS', '(99) 98118-9635', 'aaaaaaaaaaaaaaaaa');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
