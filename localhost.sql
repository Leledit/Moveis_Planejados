-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 21-Fev-2020 às 22:22
-- Versão do servidor: 5.7.23-23
-- versão do PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wwwtest4_macomp`
--
CREATE DATABASE IF NOT EXISTS `wwwtest4_macomp` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `wwwtest4_macomp`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `caracteristica`
--

CREATE TABLE `caracteristica` (
  `carc_cod` int(10) UNSIGNED NOT NULL,
  `Tipos_tip_cod` int(10) UNSIGNED NOT NULL,
  `Produtos_prod_cod` int(10) UNSIGNED NOT NULL,
  `carc_valor` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `carc_ativo` enum('S','N') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `caracteristica`
--

INSERT INTO `caracteristica` (`carc_cod`, `Tipos_tip_cod`, `Produtos_prod_cod`, `carc_valor`, `carc_ativo`) VALUES
(1, 1, 6, 'Amarelo, Azul e Vermelho', 'S'),
(2, 2, 6, '1.2 cm', 'S'),
(3, 1, 5, 'Marrom', 'S'),
(4, 2, 5, '80 cm', 'S'),
(5, 1, 4, 'Branca e bege', 'S'),
(6, 2, 4, '1 m', 'S'),
(7, 1, 3, 'Marrom', 'N'),
(8, 1, 2, 'Marrom', 'S'),
(9, 1, 1, 'Branco e Vermehlo', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagens`
--

CREATE TABLE `imagens` (
  `img_cod` int(10) UNSIGNED NOT NULL,
  `img_titulo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_src` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `imagens`
--

INSERT INTO `imagens` (`img_cod`, `img_titulo`, `img_src`) VALUES
(1, '2.jpg', 'Imagens/Produtos/1/1.jpg'),
(2, '10.jpg', 'Imagens/Produtos/2/2.jpg'),
(3, '14.jpg', 'Imagens/Produtos/3/3.jpg'),
(4, '19.png', 'Imagens/Produtos/4/4.png'),
(5, '15.jpg', 'Imagens/Produtos/5/5.jpg'),
(6, '1.jpg', 'Imagens/Produtos/6/6.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento`
--

CREATE TABLE `orcamento` (
  `orc_cod` int(10) UNSIGNED NOT NULL,
  `Produtos_prod_cod` int(10) UNSIGNED NOT NULL,
  `orc_nome_clien` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `orc_celular_clien` int(10) UNSIGNED DEFAULT NULL,
  `orc_email_clien` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `orc_qtd_prod` int(10) UNSIGNED DEFAULT NULL,
  `orc_valor_total` int(10) UNSIGNED DEFAULT NULL,
  `orc_status` enum('Encerrado','Aberto') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `orcamento`
--

INSERT INTO `orcamento` (`orc_cod`, `Produtos_prod_cod`, `orc_nome_clien`, `orc_celular_clien`, `orc_email_clien`, `orc_qtd_prod`, `orc_valor_total`, `orc_status`) VALUES
(1, 2, 'José Garcias', 0, 'Jose.Garcias@gmail.com', 5, 1200, 'Encerrado'),
(2, 6, 'José Garcias', 0, 'Jose.Garcias@gmail.com', 2, 840, 'Aberto'),
(3, 1, 'Leandro ', 0, 'Leandro_ricardo99@outlook.com', 1, 720, 'Aberto');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `prod_cod` int(10) UNSIGNED NOT NULL,
  `Imagens_img_cod` int(10) UNSIGNED NOT NULL,
  `prod_titulo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prod_descricao` varchar(1200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prod_valor` float DEFAULT NULL,
  `prod_parcelamento` int(10) UNSIGNED DEFAULT NULL,
  `prod_desconto` int(10) UNSIGNED DEFAULT NULL,
  `prod_ativo` enum('S','N') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`prod_cod`, `Imagens_img_cod`, `prod_titulo`, `prod_descricao`, `prod_valor`, `prod_parcelamento`, `prod_desconto`, `prod_ativo`) VALUES
(1, 1, 'Conjunto de mesa e cadeiras de jardim', 'Conjunto de mesa e cadeiras de jardim, feitas a partir de injeção termoplástica.', 720, 4, 5, 'S'),
(2, 2, 'Alongadeiro', 'Cadeira perfeita para tomar um delicioso banho de sol ao lado de uma piscina.', 240, 0, 0, 'S'),
(3, 3, 'Sofá cama', 'Sofá de quatro lugares, que pode ser usado como cama caso seja necessário.        ', 1400, 7, 5, 'S'),
(4, 4, 'Poltrona', 'Poltrona super confortável e alta durabilidade, para seu maior conforto e segurança.', 360, 3, 0, 'S'),
(5, 5, 'Cadeira de balcão', 'Cadeira usada em balcões de bares e outros estabelecimentos.', 70, 0, 0, 'S'),
(6, 6, 'Cadeira de balanço', 'Cadeira de balanço confortável e de alta durabilidade para sua segurança e conforto.', 420, 4, 12, 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos`
--

CREATE TABLE `tipos` (
  `tip_cod` int(10) UNSIGNED NOT NULL,
  `tip_nome` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tipos`
--

INSERT INTO `tipos` (`tip_cod`, `tip_nome`) VALUES
(1, 'Cor'),
(2, 'Altura'),
(3, 'Material'),
(4, 'Largura'),
(5, 'Comprimento'),
(6, 'Peso');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `usu_cod` int(10) UNSIGNED NOT NULL,
  `usu_nome` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usu_usuario` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usu_senha` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`usu_cod`, `usu_nome`, `usu_usuario`, `usu_senha`) VALUES
(1, 'Usuário administrativo Macomp', 'UserAdminMAuro', '22d2221ba9326ef3ca7d076d49ba049f');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `caracteristica`
--
ALTER TABLE `caracteristica`
  ADD PRIMARY KEY (`carc_cod`,`Tipos_tip_cod`,`Produtos_prod_cod`),
  ADD KEY `Caracteristica_FKIndex1` (`Tipos_tip_cod`),
  ADD KEY `Caracteristica_FKIndex2` (`Produtos_prod_cod`);

--
-- Indexes for table `imagens`
--
ALTER TABLE `imagens`
  ADD PRIMARY KEY (`img_cod`);

--
-- Indexes for table `orcamento`
--
ALTER TABLE `orcamento`
  ADD PRIMARY KEY (`orc_cod`,`Produtos_prod_cod`),
  ADD KEY `Orçamento_FKIndex1` (`Produtos_prod_cod`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`prod_cod`),
  ADD KEY `Produtos_FKIndex1` (`Imagens_img_cod`);

--
-- Indexes for table `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`tip_cod`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usu_cod`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `caracteristica`
--
ALTER TABLE `caracteristica`
  MODIFY `carc_cod` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `imagens`
--
ALTER TABLE `imagens`
  MODIFY `img_cod` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orcamento`
--
ALTER TABLE `orcamento`
  MODIFY `orc_cod` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `prod_cod` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tipos`
--
ALTER TABLE `tipos`
  MODIFY `tip_cod` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usu_cod` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
