-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 07, 2025 at 05:46 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `subway-pay`
--

-- --------------------------------------------------------

--
-- Table structure for table `admlogin`
--

CREATE TABLE `admlogin` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admlogin`
--

INSERT INTO `admlogin` (`email`, `senha`) VALUES
('admin@admin.com', 'admin123@');

-- --------------------------------------------------------

--
-- Table structure for table `app`
--

CREATE TABLE `app` (
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `depositos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saques` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuarios` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faturamento_total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cadastros` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saques_valor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deposito_min` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saques_min` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aposta_max` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dificuldade_jogo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aposta_min` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rollover_saque` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taxa_saque` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_ads_tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook_ads_tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deposito_min_cpa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revenue_share_falso` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_saque_cpa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_por_saque_cpa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revenue_share` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chance_afiliado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome_unico` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome_um` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome_dois` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app`
--

INSERT INTO `app` (`token`, `depositos`, `saques`, `usuarios`, `faturamento_total`, `cadastros`, `saques_valor`, `deposito_min`, `saques_min`, `aposta_max`, `dificuldade_jogo`, `aposta_min`, `rollover_saque`, `taxa_saque`, `google_ads_tag`, `facebook_ads_tag`, `cpa`, `deposito_min_cpa`, `revenue_share_falso`, `max_saque_cpa`, `max_por_saque_cpa`, `revenue_share`, `chance_afiliado`, `nome_unico`, `nome_um`, `nome_dois`) VALUES
('', '', '', '', '', '', '', '20', '100', '1', 'medio', '1', '10', '5', '', '123213213', '5', '20', '20', '100', '100', '0', '80', 'SubwayTeste', 'SUBWAY', 'TESTE');

-- --------------------------------------------------------

--
-- Table structure for table `appconfig`
--

CREATE TABLE `appconfig` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saldo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jogoteste` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkafiliado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `depositou` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `lead_aff` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `leads_ativos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `rollover1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `plano` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `demo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `bloc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `sacou` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `indicados` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `saldo_comissao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `percas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `ganhos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `cpa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpafake` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `jogo_demo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `comissaofake` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `saldo_cpa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `primeiro_deposito` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `status_primeiro_deposito` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `cont_cpa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `data_cadastro` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `afiliado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appconfig`
--

INSERT INTO `appconfig` (`id`, `nome`, `email`, `senha`, `cpf`, `telefone`, `saldo`, `jogoteste`, `linkafiliado`, `depositou`, `lead_aff`, `leads_ativos`, `rollover1`, `plano`, `demo`, `bloc`, `sacou`, `indicados`, `saldo_comissao`, `percas`, `ganhos`, `cpa`, `cpafake`, `jogo_demo`, `comissaofake`, `saldo_cpa`, `primeiro_deposito`, `status_primeiro_deposito`, `cont_cpa`, `data_cadastro`, `afiliado`) VALUES
('1', NULL, 'contato@daanrox.com', 'Rox123456@', NULL, '(31) 99281-2273', '9', '1', 'https://subway-pay.test/cadastrar/?aff=1', '0', '', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '5', '0', '0', '0', '0', '0', '0', '0', '07-11-2025 13:32', '');

-- --------------------------------------------------------

--
-- Table structure for table `confirmar_deposito`
--

CREATE TABLE `confirmar_deposito` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `externalreference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `out_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gateway`
--

CREATE TABLE `gateway` (
  `id` int NOT NULL,
  `client_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_secret` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateway`
--

INSERT INTO `gateway` (`id`, `client_id`, `client_secret`) VALUES
(2, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ggr`
--

CREATE TABLE `ggr` (
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ggr_taxa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `situacao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_ganhos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percas_24h` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percas_1m` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_percas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ggr_24h` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ggr_1m` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credito_ggr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debito_ggr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ggr_pago` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_ggr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ggr_total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saldo_inserido` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pix`
--

CREATE TABLE `pix` (
  `id` int NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pix_deposito`
--

CREATE TABLE `pix_deposito` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `planos`
--

CREATE TABLE `planos` (
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rev` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `indicacao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor_saque_maximo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saque_diario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `situacao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saques`
--

CREATE TABLE `saques` (
  `email` varchar(255) DEFAULT NULL,
  `externalreference` varchar(255) DEFAULT NULL,
  `destino` varchar(255) DEFAULT NULL,
  `chavepix` varchar(255) DEFAULT NULL,
  `data` varchar(255) DEFAULT NULL,
  `valor` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `saque_afiliado`
--

CREATE TABLE `saque_afiliado` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pix` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admlogin`
--
ALTER TABLE `admlogin`
  ADD KEY `idx_email` (`email`);

--
-- Indexes for table `app`
--
ALTER TABLE `app`
  ADD PRIMARY KEY (`token`);

--
-- Indexes for table `appconfig`
--
ALTER TABLE `appconfig`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_lead_aff` (`lead_aff`);

--
-- Indexes for table `confirmar_deposito`
--
ALTER TABLE `confirmar_deposito`
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_externalreference` (`externalreference`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD KEY `idx_email` (`email`);

--
-- Indexes for table `gateway`
--
ALTER TABLE `gateway`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ggr`
--
ALTER TABLE `ggr`
  ADD PRIMARY KEY (`token`),
  ADD KEY `idx_data` (`data`);

--
-- Indexes for table `pix`
--
ALTER TABLE `pix`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pix_deposito`
--
ALTER TABLE `pix_deposito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_email` (`email`);

--
-- Indexes for table `planos`
--
ALTER TABLE `planos`
  ADD PRIMARY KEY (`nome`),
  ADD KEY `idx_data` (`data`);

--
-- Indexes for table `saques`
--
ALTER TABLE `saques`
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_externalreference` (`externalreference`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD KEY `idx_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gateway`
--
ALTER TABLE `gateway`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pix`
--
ALTER TABLE `pix`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
