-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 16/04/2014 às 16:23
-- Versão do servidor: 5.5.36-cll
-- Versão do PHP: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Banco de dados: `leolondo_aranha`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `bancos`
--

CREATE TABLE IF NOT EXISTS `bancos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `b_paypal` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `b_pagseg` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `b_nome` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `b_numero` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `b_ag` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `b_ag_dig` char(3) COLLATE latin1_general_ci NOT NULL,
  `b_conta` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `b_conta_dig` char(3) COLLATE latin1_general_ci NOT NULL,
  `b_conta_tipo` char(1) COLLATE latin1_general_ci NOT NULL,
  `obs` text COLLATE latin1_general_ci NOT NULL,
  `nome` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `sobrenomes` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `user_id` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tipo` char(1) COLLATE latin1_general_ci NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `saque_status` char(1) COLLATE latin1_general_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `copia`
--

CREATE TABLE IF NOT EXISTS `copia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meutime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `creditos` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ecards` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `creditos`
--

CREATE TABLE IF NOT EXISTS `creditos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo_cred` char(1) COLLATE latin1_general_ci NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `status` char(1) COLLATE latin1_general_ci NOT NULL,
  `saldo` decimal(6,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cupons`
--

CREATE TABLE IF NOT EXISTS `cupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(12) COLLATE latin1_general_ci NOT NULL,
  `valor` int(11) NOT NULL,
  `usado` char(1) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ecards`
--

CREATE TABLE IF NOT EXISTS `ecards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ecard` varchar(12) COLLATE latin1_general_ci NOT NULL,
  `ecard` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `sorteio_data` date NOT NULL,
  `user_id` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `sentence` char(2) COLLATE latin1_general_ci NOT NULL,
  `design` char(2) COLLATE latin1_general_ci NOT NULL,
  `distribuicao` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` char(1) COLLATE latin1_general_ci NOT NULL,
  `atual` char(1) COLLATE latin1_general_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `prem_dilu`
--

CREATE TABLE IF NOT EXISTS `prem_dilu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sorteio_num` int(11) NOT NULL,
  `sorteio_data` date NOT NULL,
  `id_winner` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `rede` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `valor` decimal(7,2) NOT NULL,
  `missed` char(1) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `prem_info`
--

CREATE TABLE IF NOT EXISTS `prem_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sorteio_num` int(11) NOT NULL,
  `sorteio_data` date NOT NULL,
  `sorteio_result` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `num_win_1` int(3) NOT NULL,
  `num_win_2` int(3) NOT NULL,
  `val_total` decimal(8,2) NOT NULL,
  `num_dilu` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `prem_sorteios`
--

CREATE TABLE IF NOT EXISTS `prem_sorteios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sorteio_num` int(11) NOT NULL,
  `sorteio_data` date NOT NULL,
  `id_winner` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `prim_ou_seg` char(1) COLLATE latin1_general_ci NOT NULL,
  `valor` decimal(7,2) NOT NULL,
  `ecard` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `pontuacao` int(3) NOT NULL,
  `id_ecard` varchar(12) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `results_temp`
--

CREATE TABLE IF NOT EXISTS `results_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sorteio_num` int(11) NOT NULL,
  `sorteio_data` date NOT NULL,
  `user_id` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `total_pontos` int(3) NOT NULL,
  `ecard` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `id_ecard` varchar(12) COLLATE latin1_general_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `user_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email_temp` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email_tipo` char(1) COLLATE latin1_general_ci NOT NULL,
  `cpf` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `cel` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `perg` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `resp` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` char(1) COLLATE latin1_general_ci NOT NULL,
  `key_reg` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=93 ;

--
-- Fazendo dump de dados para tabela `users`
--

INSERT INTO `users` (`id`, `user_id`, `password`, `user_name`, `email`, `email_temp`, `email_tipo`, `cpf`, `cel`, `perg`, `resp`, `status`, `key_reg`, `date_added`) VALUES
(1, 'a1', '698d51a19d8a121ce581499d7b701668', 'WEBECARD.net', '', '', 'n', 'webecard_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(2, 'a1b1', '698d51a19d8a121ce581499d7b701668', 'Leandro', 'leo_cintrao-2013@yahoo.co.uk', 'leo_cintrao-2013@yahoo.co.uk', 'r', '22311379844', '4365474677', 'Qual3 o nome do meu primeiro carro?', 'logus3', '', '3fc29cb07d6d8bc9fe1e0235326c110e', '2014-04-02 13:09:34'),
(3, 'a1b1c1', '698d51a19d8a121ce581499d7b701668', 'Sophiabarros', '', '', 'n', 'leandro_filho_1_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(4, 'a1b1c1d1', '698d51a19d8a121ce581499d7b701668', 'Thempanince', '', '', 'n', 'leandro_neto_1_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(5, 'a1b1c1d2', '698d51a19d8a121ce581499d7b701668', 'Le_souza', '', '', 'n', 'leandro_neto_2_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(6, 'a1b1c1d3', '698d51a19d8a121ce581499d7b701668', 'Samuelpinto', '', '', 'n', 'leandro_neto_3_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(7, 'a1b1c1d4', '698d51a19d8a121ce581499d7b701668', 'Gomes1688', '', '', 'n', 'leandro_neto_4_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(8, 'a1b1c1d5', '698d51a19d8a121ce581499d7b701668', 'Lavinia_ramese', '', '', 'n', 'leandro_neto_5_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(9, 'a1b1c2', '698d51a19d8a121ce581499d7b701668', 'Flonflon', '', '', 'n', 'leandro_filho_2_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(10, 'a1b1c2d1', '698d51a19d8a121ce581499d7b701668', 'Renanaud3', '', '', 'n', 'leandro_neto_6_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(11, 'a1b1c2d2', '698d51a19d8a121ce581499d7b701668', 'Inin1960', '', '', 'n', 'leandro_neto_7_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(12, 'a1b1c2d3', '698d51a19d8a121ce581499d7b701668', 'Quer1992', '', '', 'n', 'leandro_neto_8_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(13, 'a1b1c2d4', '698d51a19d8a121ce581499d7b701668', 'Gabriellegoncalves', '', '', 'n', 'leandro_neto_9_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(14, 'a1b1c2d5', '698d51a19d8a121ce581499d7b701668', 'Duat1967', '', '', 'n', 'leandro_neto_10_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(15, 'a1b2', '698d51a19d8a121ce581499d7b701668', 'Marcel', '', '', 'n', 'marcel_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(16, 'a1b2c1', '698d51a19d8a121ce581499d7b701668', 'Diogogai', '', '', 'n', 'marcel_filho_1_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(17, 'a1b2c1d1', '698d51a19d8a121ce581499d7b701668', 'Sivand', '', '', 'n', 'marcel_neto_1_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(18, 'a1b2c1d2', '698d51a19d8a121ce581499d7b701668', 'Jliolima', '', '', 'n', 'marcel_neto_2_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(19, 'a1b2c1d3', '698d51a19d8a121ce581499d7b701668', 'Lify1941', '', '', 'n', 'marcel_neto_3_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(20, 'a1b2c1d4', '698d51a19d8a121ce581499d7b701668', 'Nangahv', '', '', 'n', 'marcel_neto_4_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(21, 'a1b2c1d5', '698d51a19d8a121ce581499d7b701668', 'Emanoti', '', '', 'n', 'marcel_neto_5_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(22, 'a1b2c2', '698d51a19d8a121ce581499d7b701668', 'Shangoo7', '', '', 'n', 'marcel_filho_2_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(23, 'a1b2c2d1', '698d51a19d8a121ce581499d7b701668', 'Fifor1994', '', '', 'n', 'marcel_neto_6_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(24, 'a1b2c2d2', '698d51a19d8a121ce581499d7b701668', 'Kauan_london', '', '', 'n', 'marcel_neto_7_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(25, 'a1b2c2d3', '698d51a19d8a121ce581499d7b701668', 'Diany1968', '', '', 'n', 'marcel_neto_8_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(26, 'a1b2c2d4', '698d51a19d8a121ce581499d7b701668', 'Voo777', '', '', 'n', 'marcel_neto_9_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(27, 'a1b2c2d5', '698d51a19d8a121ce581499d7b701668', 'Larisocus', '', '', 'n', 'marcel_neto_10_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(28, 'a1b3', '698d51a19d8a121ce581499d7b701668', 'Ligia1605', '', '', 'n', 'ligia_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(29, 'a1b3c1', '698d51a19d8a121ce581499d7b701668', 'Joi1975', '', '', 'n', 'ligia_filho_1_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(30, 'a1b3c1d1', '698d51a19d8a121ce581499d7b701668', 'Camila_ca', '', '', 'n', 'ligia_neto_1_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(31, 'a1b3c1d2', '698d51a19d8a121ce581499d7b701668', 'Fefa_1234', '', '', 'n', 'ligia_neto_2_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(32, 'a1b3c1d3', '698d51a19d8a121ce581499d7b701668', 'Imperatriz', '', '', 'n', 'ligia_neto_3_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(33, 'a1b3c1d4', '698d51a19d8a121ce581499d7b701668', 'Itaide', '', '', 'n', 'ligia_neto_4_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(34, 'a1b3c1d5', '698d51a19d8a121ce581499d7b701668', 'Omeato', '', '', 'n', 'ligia_neto_5_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(35, 'a1b3c2', '698d51a19d8a121ce581499d7b701668', 'Coad1977', '', '', 'n', 'ligia_filho_2_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(36, 'a1b3c2d1', '698d51a19d8a121ce581499d7b701668', 'Bighato', '', '', 'n', 'ligia_neto_6_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(37, 'a1b3c2d2', '698d51a19d8a121ce581499d7b701668', 'Eduardo_melo', '', '', 'n', 'ligia_neto_7_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(38, 'a1b3c2d3', '698d51a19d8a121ce581499d7b701668', 'Alexandrina', '', '', 'n', 'ligia_neto_8_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(39, 'a1b3c2d4', '698d51a19d8a121ce581499d7b701668', 'Paixao_ze', '', '', 'n', 'ligia_neto_9_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(40, 'a1b3c2d5', '698d51a19d8a121ce581499d7b701668', 'Felipealves', '', '', 'n', 'ligia_neto_10_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(41, 'a1b4', '698d51a19d8a121ce581499d7b701668', 'Joao1977', '', '', 'n', 'joao_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(42, 'a1b4c1', '698d51a19d8a121ce581499d7b701668', 'Citage_1960', '', '', 'n', 'joao_filho_1_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(43, 'a1b4c1d1', '698d51a19d8a121ce581499d7b701668', 'Bleme1966', '', '', 'n', 'joao_neto_1_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(44, 'a1b4c1d2', '698d51a19d8a121ce581499d7b701668', 'A_araujo', '', '', 'n', 'joao_neto_2_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(45, 'a1b4c1d3', '698d51a19d8a121ce581499d7b701668', 'Mandi_c', '', '', 'n', 'joao_neto_3_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(46, 'a1b4c1d4', '698d51a19d8a121ce581499d7b701668', 'Cardosodade', '', '', 'n', 'joao_neto_4_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(47, 'a1b4c1d5', '698d51a19d8a121ce581499d7b701668', 'Correia28', '', '', 'n', 'joao_neto_5_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(48, 'a1b4c2', '698d51a19d8a121ce581499d7b701668', 'Podi1962', '', '', 'n', 'joao_filho_2_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(49, 'a1b4c2d1', '698d51a19d8a121ce581499d7b701668', 'Isabelll', '', '', 'n', 'joao_neto_6_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(50, 'a1b4c2d2', '698d51a19d8a121ce581499d7b701668', 'someard1984', '', '', 'n', 'joao_neto_7_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(51, 'a1b4c2d3', '698d51a19d8a121ce581499d7b701668', 'Guaratingueta', '', '', 'n', 'joao_neto_8_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(52, 'a1b4c2d4', '698d51a19d8a121ce581499d7b701668', 'Tindin', '', '', 'n', 'joao_neto_9_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(53, 'a1b4c2d5', '698d51a19d8a121ce581499d7b701668', 'Cameras1982', '', '', 'n', 'joao_neto_10_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(54, 'a1b5', '698d51a19d8a121ce581499d7b701668', 'Fabiosoft', '', '', 'n', 'fabio_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(55, 'a1b5c1', '698d51a19d8a121ce581499d7b701668', 'Rafaela_21', '', '', 'n', 'fabio_filho_1_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(56, 'a1b5c1d1', '698d51a19d8a121ce581499d7b701668', 'Souza_eu', '', '', 'n', 'fabio_neto_1_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(57, 'a1b5c1d2', '698d51a19d8a121ce581499d7b701668', 'Montevelho', '', '', 'n', 'fabio_neto_2_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(58, 'a1b5c1d3', '698d51a19d8a121ce581499d7b701668', 'Bombom1986', '', '', 'n', 'fabio_neto_3_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(59, 'a1b5c1d4', '698d51a19d8a121ce581499d7b701668', 'Godagoda', '', '', 'n', 'fabio_neto_4_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(60, 'a1b5c1d5', '698d51a19d8a121ce581499d7b701668', 'Cacupecity', '', '', 'n', 'fabio_neto_5_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(61, 'a1b5c2', '698d51a19d8a121ce581499d7b701668', 'Jacinto_oz', '', '', 'n', 'fabio_filho_2_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(62, 'a1b5c2d1', '698d51a19d8a121ce581499d7b701668', 'Lussantos', '', '', 'n', 'fabio_neto_6_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(63, 'a1b5c2d2', '698d51a19d8a121ce581499d7b701668', 'Evelyn', '', '', 'n', 'fabio_neto_7_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(64, 'a1b5c2d3', '698d51a19d8a121ce581499d7b701668', 'Diegosurf', '', '', 'n', 'fabio_neto_8_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(65, 'a1b5c2d4', '698d51a19d8a121ce581499d7b701668', 'Barros_ro', '', '', 'n', 'fabio_neto_9_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(66, 'a1b5c2d5', '698d51a19d8a121ce581499d7b701668', 'Tiagobetim', '', '', 'n', 'fabio_neto_10_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(67, 'a1b6', '698d51a19d8a121ce581499d7b701668', 'Regina', '', '', 'n', 'regina_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(68, 'a1b6c1', '698d51a19d8a121ce581499d7b701668', 'Missuti', '', '', 'n', 'regina_filho_1_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(69, 'a1b6c1d1', '698d51a19d8a121ce581499d7b701668', 'Gluglu1977', '', '', 'n', 'regina_neto_1_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(70, 'a1b6c1d2', '698d51a19d8a121ce581499d7b701668', 'Andregoncalves', '', '', 'n', 'regina_neto_2_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(71, 'a1b6c1d3', '698d51a19d8a121ce581499d7b701668', 'Zoio_santos', '', '', 'n', 'regina_neto_3_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(72, 'a1b6c1d4', '698d51a19d8a121ce581499d7b701668', 'Juliasilvaaraujo', '', '', 'n', 'regina_neto_4_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(73, 'a1b6c1d5', '698d51a19d8a121ce581499d7b701668', 'Fer_martinz', '', '', 'n', 'regina_neto_5_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(74, 'a1b6c2', '698d51a19d8a121ce581499d7b701668', 'Marizaca', '', '', 'n', 'regina_filho_2_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(75, 'a1b6c2d1', '698d51a19d8a121ce581499d7b701668', 'Bene_rosa', '', '', 'n', 'regina_neto_6_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(76, 'a1b6c2d2', '698d51a19d8a121ce581499d7b701668', 'Carol_eve', '', '', 'n', 'regina_neto_7_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(77, 'a1b6c2d3', '698d51a19d8a121ce581499d7b701668', 'Tomsribeiro', '', '', 'n', 'regina_neto_8_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(78, 'a1b6c2d4', '698d51a19d8a121ce581499d7b701668', 'Antruldis', '', '', 'n', 'regina_neto_9_cpf', '', 'Qual o nome do meu primeiro carro', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(79, 'a1b6c2d5', '698d51a19d8a121ce581499d7b701668', 'Lazararodrigues', '', '', 'n', 'regina_neto_10_cpf', '', 'Qual o nome do meu primeiro cachorro?', 'abcabc abcabc abcabc abcabc', '', '[value-13] ', '2014-04-02 13:09:34'),
(80, 'a1b7', '698d51a19d8a121ce581499d7b701668', 'Carolthebest', '', '', 'n', 'carol_cpf', '', 'Qual o primeiro nome da minha mãe', 'maria', '', '1', '2014-04-16 14:20:22'),
(81, 'a1b7c1', '698d51a19d8a121ce581499d7b701668', 'Ara_melo', '', '', 'n', 'carol_filho_1_cpf', '', 'Qual o primeiro nome da minha mãe', 'maria', '', '1', '2014-04-16 14:20:22'),
(82, 'a1b7c1d1', '698d51a19d8a121ce581499d7b701668', 'Eu70257973', '', '', 'n', 'carol_neto_1_cpf', '', 'Qual o primeiro nome da minha mãe', 'maria', '', '1', '2014-04-16 14:20:22'),
(83, 'a1b7c1d2', '698d51a19d8a121ce581499d7b701668', 'Julieta', '', '', 'n', 'carol_neto_2_cpf', '', 'Qual o primeiro nome da minha mãe', 'maria', '', '1', '2014-04-16 14:20:22'),
(84, 'a1b7c1d3', '698d51a19d8a121ce581499d7b701668', 'Card_p', '', '', 'n', 'carol_neto_3_cpf', '', 'Qual o primeiro nome da minha mãe', 'maria', '', '1', '2014-04-16 14:20:22'),
(85, 'a1b7c1d4', '698d51a19d8a121ce581499d7b701668', 'March_eut', '', '', 'n', 'carol_neto_4_cpf', '', 'Qual o primeiro nome da minha mãe', 'maria', '', '1', '2014-04-16 14:20:22'),
(86, 'a1b7c1d5', '698d51a19d8a121ce581499d7b701668', 'Lima_pereira', '', '', 'n', 'carol_neto_5_cpf', '', 'Qual o primeiro nome da minha mãe', 'maria', '', '1', '2014-04-16 14:20:22'),
(87, 'a1b7c2', '698d51a19d8a121ce581499d7b701668', 'Sarg_zaca', '', '', 'n', 'carol_filho_2_cpf', '', 'Qual o primeiro nome da minha mãe', 'maria', '', '1', '2014-04-16 14:20:22'),
(88, 'a1b7c2d1', '698d51a19d8a121ce581499d7b701668', 'Prof_omi', '', '', 'n', 'carol_neto_6_cpf', '', 'Qual o primeiro nome da minha mãe', 'maria', '', '1', '2014-04-16 14:20:22'),
(89, 'a1b7c2d2', '698d51a19d8a121ce581499d7b701668', 'Conobrasil', '', '', 'n', 'carol_neto_7_cpf', '', 'Qual o primeiro nome da minha mãe', 'maria', '', '1', '2014-04-16 14:20:22'),
(90, 'a1b7c2d3', '698d51a19d8a121ce581499d7b701668', 'Tibaloca', '', '', 'n', 'carol_neto_8_cpf', '', 'Qual o primeiro nome da minha mãe', 'maria', '', '1', '2014-04-16 14:20:22'),
(91, 'a1b7c2d4', '698d51a19d8a121ce581499d7b701668', 'Jacomel', '', '', 'n', 'carol_neto_9_cpf', '', 'Qual o primeiro nome da minha mãe', 'maria', '', '1', '2014-04-16 14:20:22'),
(92, 'a1b7c2d5', '698d51a19d8a121ce581499d7b701668', 'Pinha33', '', '', 'n', 'carol_neto_10_cpf', '', 'Qual o primeiro nome da minha mãe', 'maria', '', '1', '2014-04-16 14:20:22');
