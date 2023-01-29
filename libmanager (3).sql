-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 29-Jan-2023 às 19:17
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_aluno`
--

INSERT INTO `tbl_aluno` (`id_aluno`, `nome`, `cpf`, `matricula`, `email`, `data_cadastro`) VALUES
(6, '', '', '', '', '2023-01-22 20:40:51'),
(5, 'Nanderson Matheus', '612.457.843-31', '202306', 'nandersonmatheusmelo@gmail.com', '2023-01-22 20:37:19');

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
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_autor`
--

INSERT INTO `tbl_autor` (`id_autor`, `nome_autor`, `sobrenome_autor`) VALUES
(36, 'Anne', 'Frank'),
(35, 'Julio', 'Verne'),
(37, 'Peter', 'Weill'),
(38, 'Dan', 'Brown'),
(39, 'Matheus', 'Verne'),
(40, ' Steve', 'Krug'),
(41, 'Steven', 'Levitsky'),
(42, 'J.K.', 'Rowling'),
(43, 'Matt', 'Stauffer'),
(44, 'Rafael', 'Longo'),
(45, ' Lua', 'Menezes'),
(46, ' Charles ', 'Soule'),
(47, ' J.R.R.', 'Tolkien'),
(48, ' Antoine', 'de Saint-ExupÃ©ry');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_editora`
--

DROP TABLE IF EXISTS `tbl_editora`;
CREATE TABLE IF NOT EXISTS `tbl_editora` (
  `id_editora` int(11) NOT NULL AUTO_INCREMENT,
  `nome_editora` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_editora`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_editora`
--

INSERT INTO `tbl_editora` (`id_editora`, `nome_editora`) VALUES
(64, 'Via Leitura'),
(63, 'HarperCollins'),
(62, 'Universo geek'),
(61, 'EssÃªncia'),
(60, 'Globo Livros'),
(59, 'Novatec Editora'),
(58, 'Rocco'),
(57, 'Zahar'),
(56, 'Alta Books'),
(55, 'Editora Arqueiro'),
(54, 'M.Books'),
(53, 'Record'),
(52, 'Principis'),
(51, 'Saraiva'),
(50, 'Contexto');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_emprestimo`
--

DROP TABLE IF EXISTS `tbl_emprestimo`;
CREATE TABLE IF NOT EXISTS `tbl_emprestimo` (
  `id_emprestimo` int(11) NOT NULL AUTO_INCREMENT,
  `id_livro` int(11) NOT NULL,
  `cpf_aluno` varchar(14) NOT NULL,
  `status` varchar(30) NOT NULL,
  `data_emprestimo` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_devolucao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_emprestimo`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_emprestimo`
--

INSERT INTO `tbl_emprestimo` (`id_emprestimo`, `id_livro`, `cpf_aluno`, `status`, `data_emprestimo`, `data_devolucao`) VALUES
(5, 13, '612.457.843-31', 'devolvido', '2023-01-29 15:18:33', '2023-01-29 15:18:53'),
(4, 9, '612.457.843-31', 'devolvido', '2023-01-28 01:16:13', '2023-01-29 15:18:53'),
(3, 9, '612.457.843-31', 'devolvido', '2023-01-28 00:53:44', '2023-01-29 15:18:53'),
(6, 11, '612.457.843-31', 'ativo', '2023-01-29 15:28:04', NULL),
(7, 20, '612.457.843-31', 'ativo', '2023-01-29 15:28:19', NULL),
(8, 18, '612.457.843-31', 'ativo', '2023-01-29 15:28:31', NULL);

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
  `status` varchar(30) NOT NULL,
  `path` varchar(100) NOT NULL,
  PRIMARY KEY (`id_livro`),
  KEY `id_autor` (`id_autor`),
  KEY `id_editora` (`id_editora`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_livro`
--

INSERT INTO `tbl_livro` (`id_livro`, `titulo`, `edicao`, `isbn`, `assunto`, `situacao`, `id_autor`, `id_editora`, `status`, `path`) VALUES
(11, 'Vinte mil lÃ©guas submarinas', '1', '8594318774', 'Aventura', 1, 35, 52, 'reservado', 'capas/63d4759c061af.jpg'),
(9, 'A volta ao mundo em 80 dias', '1', '978-8594318145', 'Aventura', 1, 39, 52, 'disponivel', 'capas/63b367e1ea425.jpg'),
(12, 'Da Terra Ã  Lua', '1', '6555521732', 'Aventura', 1, 35, 52, 'disponivel', 'capas/63ab77a2434fb.jpg'),
(13, 'GovernanÃ§a de TI - Tecnologia da InformaÃ§Ã£o', '1', '8589384780', 'TI', 1, 37, 54, 'disponivel', 'capas/63d6b7cf3ffad.jpg'),
(14, 'O CÃ³digo Da Vinci (Robert Langdon - Livro 2) ', '1', '978-6555651041', 'Suspense', 1, 38, 55, 'disponivel', 'capas/63ab7be2efc9f.jpg'),
(15, 'NÃ£o me faÃ§a pensar: atualizado', 'EdiÃ§Ã£o atualizada', '978-8576088509', 'TI', 1, 40, 56, 'disponivel', 'capas/63d6b7b109d21.jpg'),
(16, 'Como as democracias morrem', '1', '9788537818008', 'CiÃªncias Sociais', 1, 41, 57, 'disponivel', 'capas/63d475136bb7a.jpg'),
(17, 'A ilha misteriosa', '1', '6555521740', 'Aventura', 1, 35, 52, 'disponivel', 'capas/63d4756feed48.jpg'),
(18, 'Harry Potter e a Pedra Filosofal: 1', '1', '8532530788', 'Fantasia', 1, 42, 58, 'reservado', 'capas/63d476535784e.jpg'),
(19, 'Harry Potter e a CÃ¢mara Secreta', '1', '8532530796', 'Fantasia', 1, 42, 58, 'disponivel', 'capas/63d4769caa596.jpg'),
(20, 'O livro da histÃ³ria', '1', '8525064149', 'HistÃ³ria', 1, 44, 60, 'reservado', 'capas/63d4776a4b0c8.jpg'),
(21, 'Rio Profano: Romance', '1', '655535609X', 'Romance', 1, 45, 61, 'disponivel', 'capas/63d6b71c6de54.jpg'),
(22, 'Star Wars: Luz dos Jedi (The High Republic)', '1', '6556090875', 'FicÃ§Ã£o CientÃ­fica', 1, 46, 62, 'disponivel', 'capas/63d6b789e8a7f.jpg'),
(23, 'O Senhor dos AnÃ©is: A Sociedade do Anel', '3', '8595084750', 'Aventura', 1, 47, 63, 'disponivel', 'capas/63d6b8f45ec7f.jpg'),
(24, 'O Senhor dos AnÃ©is: As duas torres ', '3', '8595084769', 'Aventura', 1, 47, 63, 'disponivel', 'capas/63d6b9285b5e0.jpg'),
(25, 'O Silmarillion', '3', '8595084378', 'Aventura', 1, 47, 63, 'disponivel', 'capas/63d6b9624c730.jpg'),
(26, 'O Pequeno PrÃ­ncipe', '1', '856709710X', 'Infantil', 1, 48, 64, 'disponivel', 'capas/63d6ba4139118.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_matriculas`
--

DROP TABLE IF EXISTS `tbl_matriculas`;
CREATE TABLE IF NOT EXISTS `tbl_matriculas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricula` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2023207 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_matriculas`
--

INSERT INTO `tbl_matriculas` (`id`, `matricula`) VALUES
(1, '202301'),
(2, '202302'),
(3, '202303'),
(2023203, '202304'),
(2023204, '202305'),
(2023205, '202306'),
(2023206, '202307');

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
-- Estrutura da tabela `tbl_status`
--

DROP TABLE IF EXISTS `tbl_status`;
CREATE TABLE IF NOT EXISTS `tbl_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_status`
--

INSERT INTO `tbl_status` (`id`, `descricao`) VALUES
(1, 'reservado'),
(2, 'disponivel'),
(3, 'extraviado');

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
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_usuario`, `nome_usuario`, `email_usuario`, `cpf_usuario`, `senha_usuario`, `telefone_usuario`, `endereco_usuario`, `perfil`) VALUES
(32, 'Nanderson Matheus', 'nandersonmatheusmelo@gmail.com', '555.666.777-89', '$2y$10$mbanbCu/02MtQIIPneQfoe2Fbv097nXRX4otUlIZ7aZrfvAzT9NcS', '(99) 98118-9635', 'aaaaaaaaaaaaaaaaa', 1),
(38, 'Nanderson Matheus', 'nandersonmatheusmelo@gmail.com', '612.457.843-31', '$2y$10$KMuYQX2nMoPaFIUm/rSCrOf8tQB1wXAq8l9tID5RHr1emO4Xt3O4u', '(99) 98118-9635', 'Rua desgraÃ§ada', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
