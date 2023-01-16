-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 16-Jan-2023 às 02:29
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
-- Estrutura da tabela `tbl_aluno`
--

DROP TABLE IF EXISTS `tbl_aluno`;
CREATE TABLE IF NOT EXISTS `tbl_aluno` (
  `id_aluno` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `matricula` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `data_cadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_aluno`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_aluno`
--

INSERT INTO `tbl_aluno` (`id_aluno`, `nome`, `cpf`, `matricula`, `email`, `data_cadastro`) VALUES
(3, 'aluno', '995.111.960-30', '202303', 'aluno@gmail.com', '2023-01-15 23:19:28');

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
  `cpf` varchar(14) NOT NULL,
  `data_cadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_funcionario`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_funcionario`
--

INSERT INTO `tbl_funcionario` (`id_funcionario`, `nome_funcionario`, `cpf`, `data_cadastro`) VALUES
(2, 'Flavio do Pneu', '878.239.330-39', '2023-01-15 19:21:55');

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
(9, 'A volta ao mundo em 80 dias', '1', '978-8594318145', 'Aventura', 1, 39, 52, 'capas/63b367e1ea425.jpg'),
(12, 'Da Terra Ã  Lua', '1', '6555521732', 'Aventura', 1, 35, 52, 'capas/63ab77a2434fb.jpg'),
(13, 'GovernanÃ§a de TI - Tecnologia da InformaÃ§Ã£o', '1', '8589384780', 'TI', 1, 37, 54, 'capas/63b1d6126e1d3.jpg'),
(14, 'O CÃ³digo Da Vinci (Robert Langdon - Livro 2) ', '1', '978-6555651041', 'Suspense', 1, 38, 55, 'capas/63ab7be2efc9f.jpg'),
(15, 'NÃ£o me faÃ§a pensar: atualizado', 'EdiÃ§Ã£o atualizada', '978-8576088509', 'TI', 1, 40, 56, 'capas/63b1d81c04b24.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_matriculas`
--

DROP TABLE IF EXISTS `tbl_matriculas`;
CREATE TABLE IF NOT EXISTS `tbl_matriculas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricula` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2023203 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_matriculas`
--

INSERT INTO `tbl_matriculas` (`id`, `matricula`) VALUES
(1, '202301'),
(2, '202302'),
(3, '202303');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_perfil`
--

DROP TABLE IF EXISTS `tbl_perfil`;
CREATE TABLE IF NOT EXISTS `tbl_perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perfil` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_perfil`
--

INSERT INTO `tbl_perfil` (`id`, `perfil`) VALUES
(1, 'funcionario'),
(2, 'aluno');

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
  `perfil` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `cpf_usuario` (`cpf_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_usuario`, `nome_usuario`, `email_usuario`, `cpf_usuario`, `senha_usuario`, `telefone_usuario`, `endereco_usuario`, `perfil`) VALUES
(32, 'Nanderson Matheus', 'nandersonmatheusmelo@gmail.com', '555.666.777-89', '$2y$10$mbanbCu/02MtQIIPneQfoe2Fbv097nXRX4otUlIZ7aZrfvAzT9NcS', '(99) 98118-9635', 'aaaaaaaaaaaaaaaaa', 1),
(36, 'aluno', 'aluno@gmail.com', '995.111.960-30', '$2y$10$AvUdyF6quMSxVvjU7IXLleQfBxG3by6tF8hkrrkERC1XTzbfruzhm', '(99) 98118-9635', '111111111111', 0),
(35, 'Flavio do Pneu', 'flaviopneu@gmail.com', '878.239.330-39', '$2y$10$Ao.7631Vg4taoiSdCo82f.8Vr6WUbaegMUfMDSsF85FZAK7.JSJA.', '(99) 98118-9635', 'Rua do carai', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
