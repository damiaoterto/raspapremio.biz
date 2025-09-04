-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 10/08/2025 às 22:24
-- Versão do servidor: 8.0.36-28
-- Versão do PHP: 8.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `raspagreen2`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `banners`
--

CREATE TABLE `banners` (
  `id` bigint UNSIGNED NOT NULL,
  `banner_img` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ativo` tinyint(1) DEFAULT '1',
  `ordem` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `banners`
--

INSERT INTO `banners` (`id`, `banner_img`, `ativo`, `ordem`) VALUES
(1, '/assets/banners/banner_687cd3a026c04.png', 1, 2),
(2, '/assets/banners/banner_6896b37c38a7d.png', 1, 1),
(3, '/assets/banners/banner_687cd323dee39.png', 1, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `config`
--

CREATE TABLE `config` (
  `id` bigint UNSIGNED NOT NULL,
  `nome_site` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'Raspadinha',
  `logo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deposito_min` float NOT NULL DEFAULT '0',
  `saque_min` float NOT NULL DEFAULT '0',
  `cpa_padrao` float NOT NULL DEFAULT '0',
  `revshare_padrao` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `config`
--

INSERT INTO `config` (`id`, `nome_site`, `logo`, `deposito_min`, `saque_min`, `cpa_padrao`, `revshare_padrao`) VALUES
(1, 'RASPA-GREEN', '/assets/upload/6896b2539f686.png', 10, 10, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `depositos`
--

CREATE TABLE `depositos` (
  `id` int NOT NULL,
  `transactionId` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `cpf` varchar(14) COLLATE utf8mb4_general_ci NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `status` enum('PENDING','PAID') COLLATE utf8mb4_general_ci DEFAULT 'PENDING',
  `qrcode` text COLLATE utf8mb4_general_ci,
  `idempotency_key` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gateway` enum('ondapay') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `webhook_data` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `depositos`
--

INSERT INTO `depositos` (`id`, `transactionId`, `user_id`, `nome`, `cpf`, `valor`, `status`, `qrcode`, `idempotency_key`, `gateway`, `webhook_data`, `created_at`, `updated_at`) VALUES
(20, 'TRX-20250809220325-4009', 1, 'admin', '16079556790', 10.00, 'PENDING', '00020126860014br.gov.bcb.pix2564pix.bancoe2.com.br/qr/v3/at/b1179642-c7d6-4cbf-acf7-312d1913335d5204000053039865802BR5911E2_PAY_LTDA6007BARUERI62070503***6304A2DC', '6897efdb92995', 'ondapay', NULL, '2025-08-10 01:03:25', '2025-08-10 01:03:25'),
(21, 'TRX-20250810172118-8102', 1, 'admin', '16079556790', 10.00, 'PENDING', '00020126860014br.gov.bcb.pix2564pix.bancoe2.com.br/qr/v3/at/0613e88b-de67-4628-bd12-5f6f85427df05204000053039865802BR5911E2_PAY_LTDA6007BARUERI62070503***630467FE', '6898ff3c9917c', 'ondapay', NULL, '2025-08-10 20:21:19', '2025-08-10 20:21:19');

-- --------------------------------------------------------

--
-- Estrutura para tabela `gateway`
--

CREATE TABLE `gateway` (
  `id` int UNSIGNED NOT NULL,
  `active` enum('ondapay') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'ondapay',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `gateway`
--

INSERT INTO `gateway` (`id`, `active`, `created_at`, `updated_at`) VALUES
(1, 'ondapay', '2025-08-10 00:12:26', '2025-08-10 00:12:26');

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico_revshare`
--

CREATE TABLE `historico_revshare` (
  `id` bigint UNSIGNED NOT NULL,
  `afiliado_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `valor_apostado` decimal(10,2) NOT NULL,
  `valor_revshare` decimal(10,2) NOT NULL,
  `percentual` float NOT NULL,
  `tipo` enum('perda_usuario','ganho_usuario') COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ondapay`
--

CREATE TABLE `ondapay` (
  `id` int NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'https://api.digitopayoficial.com.br',
  `client_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `client_secret` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ondapay`
--

INSERT INTO `ondapay` (`id`, `url`, `client_id`, `client_secret`, `created_at`, `updated_at`) VALUES
(1, 'https://api.ondapay.app', '1231231231231', '123123123', '2025-07-19 12:56:52', '2025-08-10 20:24:18');

-- --------------------------------------------------------

--
-- Estrutura para tabela `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `raspadinha_id` int UNSIGNED NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `resultado` enum('loss','gain') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `valor_ganho` decimal(10,2) DEFAULT '0.00',
  `premios_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `raspadinhas`
--

CREATE TABLE `raspadinhas` (
  `id` int UNSIGNED NOT NULL,
  `nome` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_general_ci,
  `banner` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `raspadinhas`
--

INSERT INTO `raspadinhas` (`id`, `nome`, `descricao`, `banner`, `valor`, `created_at`) VALUES
(1, 'SONHO PREMIADO - R$ 2,00 - PRÊMIOS DE ATÉ R$5.000,00 ', 'Com só R$2, você raspa e pode levar prêmios exclusivos, gadgets, ou R$5000 na conta.', '/assets/img/banners/687ce7f33afe8.png', 2.00, '2025-07-11 21:55:04'),
(2, 'MEGA RASPADA BLACK 🖤💰 - R$10,00 - PRÊMIOS DE ATÉ R$20.000,00', 'Com R$10 na raspada você ativa a chance de faturar uma bolada até R$20.000. Prêmio bruto, imediato.', '/assets/img/banners/687ce824a04ed.png', 10.00, '2025-07-11 21:55:04'),
(3, '🔥 PIX TURBINADO - R$ 1,00 - PRÊMIOS DE ATÉ R$2.500,00', 'Raspa por apenas R$1 e pode explodir até R$2500 direto no PIX.', '/assets/img/banners/687ce7af59f64.png', 1.00, '2025-07-16 19:19:31'),
(4, 'OSTENTAÇÃO INSTANTÂNEA 💎 - R$5,00 - PRÊMIOS DE ATÉ R$10.000,00', 'R$5 pra raspar e a chance real de garantir eletrônicos top ou até R$10.000 em PIX.', '/assets/img/banners/687cea40caafd.png', 5.00, '2025-07-19 18:07:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `raspadinha_premios`
--

CREATE TABLE `raspadinha_premios` (
  `id` int UNSIGNED NOT NULL,
  `raspadinha_id` int UNSIGNED NOT NULL,
  `nome` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `icone` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `probabilidade` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `raspadinha_premios`
--

INSERT INTO `raspadinha_premios` (`id`, `raspadinha_id`, `nome`, `icone`, `valor`, `probabilidade`) VALUES
(29, 4, 'NADA 😬', '/assets/img/icons/687c106fb01ac.png', 0.00, 30.00),
(30, 4, 'R$1,00 NO PIX', '/assets/img/icons/687c09ddc2027.png', 1.00, 18.00),
(31, 4, 'R$5,00 NO PIX', '/assets/img/icons/687c09f749f8b.png', 5.00, 12.00),
(32, 4, 'R$10,00 NO PIX', '/assets/img/icons/687c0a1e0b378.png', 10.00, 8.00),
(33, 4, 'R$15,00 NO PIX', '/assets/img/icons/687c24d23eed0.png', 15.00, 6.00),
(34, 4, 'R$20,00 NO PIX', '/assets/img/icons/687c0b01a04a4.png', 20.00, 4.50),
(35, 4, 'R$50,00 NO PIX', '/assets/img/icons/687c0b433da67.png', 50.00, 4.00),
(36, 4, 'R$100,00 NO PIX', '/assets/img/icons/687c0dbbb87e4.png', 100.00, 3.00),
(37, 4, 'R$150,00 NO PIX', '/assets/img/icons/687c263842548.png', 150.00, 2.20),
(38, 4, 'R$200,00 NO PIX', '/assets/img/icons/687c0c3f09c6d.png', 200.00, 2.10),
(39, 4, 'Cafeteira Expresso Dolce Gusto', '/assets/img/icons/687c0c9a1f22a.png', 500.00, 2.00),
(40, 4, 'Lava e Seca Samsung', '/assets/img/icons/687c0cc6bb984.png', 3500.00, 0.40),
(41, 4, 'Notebook Gamer ', '/assets/img/icons/687cd625b0136.png', 4000.00, 1.50),
(42, 4, 'Smart TV Samsung 70\"', '/assets/img/icons/687c0d36c8044.png', 5000.00, 1.40),
(43, 4, 'R$1.000,00 NO PIX', '/assets/img/icons/687c0f4e1f147.png', 1000.00, 1.90),
(44, 4, 'R$3.000,00 NO PIX', '/assets/img/icons/687c0f6ac9a5e.png', 3000.00, 1.60),
(45, 4, 'iPhone 15 PRO MAX', '/assets/img/icons/687c0fe6b612a.png', 6000.00, 0.75),
(46, 4, 'R$10.000,00 NO PIX', '/assets/img/icons/687c1030df2ef.png', 10000.00, 0.30),
(47, 3, 'NADA 😬', '/assets/img/icons/687c0254729ef.png', 0.00, 25.00),
(48, 3, 'R$1,00 NO PIX', '/assets/img/icons/687be92f11610.png', 1.00, 15.00),
(49, 3, 'R$2,00 NO PIX', '/assets/img/icons/687bea587e903.png', 2.00, 11.00),
(50, 3, 'R$5,00 NO PIX', '/assets/img/icons/687bfdd13689e.png', 5.00, 9.00),
(51, 3, 'R$10,00 NO PIX', '/assets/img/icons/687beabea5f53.png', 10.00, 7.70),
(52, 3, 'R$20,00 NO PIX', '/assets/img/icons/687beaf761686.png', 20.00, 6.00),
(53, 3, 'R$15,00 NO PIX', '/assets/img/icons/687c248f70bc8.png', 15.00, 7.50),
(54, 3, 'R$50,00 NO PIX', '/assets/img/icons/687bfad6bca49.png', 50.00, 5.30),
(55, 3, 'TV 32 polegadas Smart', '/assets/img/icons/687be97e55304.png', 1000.00, 1.80),
(56, 3, 'JBL BOOMBOX 3', '/assets/img/icons/687bfb8a5b1c6.png', 2000.00, 0.20),
(57, 3, 'R$1.500,00 NO PIX', '/assets/img/icons/687be9cb1abad.png', 1500.00, 1.50),
(58, 3, 'R$2.500,00 NO PIX', '/assets/img/icons/687bfc8ee5723.png', 2500.00, 0.10),
(59, 1, 'NADA 😬', '/assets/img/icons/687c0272d42cc.png', 0.00, 30.00),
(60, 1, 'R$1,00 NO PIX', '/assets/img/icons/687c029628796.png', 1.00, 15.00),
(61, 1, 'R$5,00 NO PIX', '/assets/img/icons/687c036f22866.png', 5.00, 10.00),
(62, 1, 'R$10,00 NO PIX', '/assets/img/icons/687c072e05d74.png', 10.00, 8.00),
(63, 1, 'R$15,00 NO PIX', '/assets/img/icons/687c24eeda1dd.png', 15.00, 7.00),
(64, 1, 'R$20,00 NO PIX', '/assets/img/icons/687cfac0cda45.png', 20.00, 6.00),
(65, 1, 'R$50,00 NO PIX', '/assets/img/icons/687c032bd36c5.png', 50.00, 4.00),
(66, 1, 'Air Fryer Britânia', '/assets/img/icons/687c03ea8c3b5.png', 400.00, 2.00),
(67, 1, 'Microondas', '/assets/img/icons/687c041d18e2f.png', 500.00, 2.00),
(68, 1, 'R$500,00 NO PIX', '/assets/img/icons/687c07b350a5b.png', 500.00, 4.00),
(69, 1, 'Bicicleta Caloi', '/assets/img/icons/687c046b401b4.png', 800.00, 2.00),
(70, 1, 'Xbox Series S', '/assets/img/icons/687c04dea9970.png', 2000.00, 2.50),
(71, 1, 'R$1.200,00 NO PIX', '/assets/img/icons/687c050c8fc53.png', 1200.00, 2.00),
(72, 1, 'R$2.000,00 NO PIX', '/assets/img/icons/687c055b21ca9.png', 2000.00, 1.50),
(73, 1, 'Shineray PT2X', '/assets/img/icons/687c0598a13d0.png', 5000.00, 1.00),
(74, 2, 'NADA 😬', '/assets/img/icons/687c10c6b1667.png', 0.00, 30.00),
(77, 2, 'R$5,00 NO PIX', '/assets/img/icons/687c114fee310.png', 5.00, 13.00),
(78, 2, 'R$20,00 NO PIX', '/assets/img/icons/687c11ee2bc98.png', 20.00, 6.50),
(79, 2, 'R$15,00 NO PIX', '/assets/img/icons/687c251dd30ab.png', 15.00, 8.00),
(80, 2, 'R$50,00 NO PIX', '/assets/img/icons/687c124f3477d.png', 50.00, 6.00),
(81, 2, 'R$100,00 NO PIX', '/assets/img/icons/687c127d17125.png', 100.00, 3.50),
(82, 2, 'R$200,00 NO PIX', '/assets/img/icons/687c12c9570a1.png', 200.00, 2.50),
(83, 2, 'R$300,00 NO PIX', '/assets/img/icons/687c2d8e3beef.png', 300.00, 2.00),
(84, 2, 'R$500,00 NO PIX', '/assets/img/icons/687c14d2bfc79.png', 500.00, 2.00),
(85, 2, 'R$700,00 NO PIX', '/assets/img/icons/687c169784b00.png', 700.00, 1.80),
(86, 2, 'R$1.000,00 NO PIX', '/assets/img/icons/687c16bf8d4f9.png', 1000.00, 1.40),
(87, 2, 'R$3.000,00 NO PIX', '/assets/img/icons/687c1499d7b9f.png', 3000.00, 1.00),
(88, 2, 'R$5.000,00 NO PIX', '/assets/img/icons/687c17441f4e7.png', 10.00, 0.80),
(89, 2, 'Geladeira Smart LG', '/assets/img/icons/687c17c36902a.png', 9000.00, 0.60),
(90, 2, 'iPhone 16 Pro Max ', '/assets/img/icons/687c17f0a903b.png', 7500.00, 0.00),
(91, 2, 'Moto Honda Pop 110i zero km', '/assets/img/icons/687c1814b5ef1.png', 12500.00, 0.00),
(92, 2, 'MacBook Pro Apple 14\" M4', '/assets/img/icons/687c184b06fd6.png', 14000.00, 0.00),
(93, 2, 'Honda PCX 2025 ', '/assets/img/icons/687c18722f07a.png', 20000.00, 0.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `saques`
--

CREATE TABLE `saques` (
  `id` bigint UNSIGNED NOT NULL,
  `transactionId` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `cpf` varchar(14) COLLATE utf8mb4_general_ci NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `transaction_id_digitopay` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idempotency_key` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `digitopay_idempotency_key` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gateway` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'ondapay',
  `webhook_data` text COLLATE utf8mb4_general_ci,
  `status` enum('PENDING','PAID','CANCELLED','FAILED','PROCESSING','EM PROCESSAMENTO','ANALISE','REALIZADO') COLLATE utf8mb4_general_ci DEFAULT 'PENDING',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `saques`
--

INSERT INTO `saques` (`id`, `transactionId`, `user_id`, `nome`, `cpf`, `valor`, `transaction_id`, `transaction_id_digitopay`, `idempotency_key`, `digitopay_idempotency_key`, `gateway`, `webhook_data`, `status`, `created_at`, `updated_at`) VALUES
(120, 'WTH_6897ec8194005', 1, 'Isaac Roque De Oliveira França', '16079556790', 10.00, '6897eeb6d020d-1754787510', NULL, NULL, NULL, 'ondapay', '{\"status\":1,\"msg\":\"Saque solicitado com sucesso! Voc\\u00ea poder\\u00e1 aprovar ele pelo painel.\"}', 'PAID', '2025-08-10 00:49:05', '2025-08-10 00:58:31'),
(121, 'WTH_6897ef1c549b6', 1, 'Isaac Roque De Oliveira França', '16079556790', 10.00, '6897ef2554c38-1754787621', NULL, NULL, NULL, 'ondapay', '{\"status\":1,\"msg\":\"Saque solicitado com sucesso! Voc\\u00ea poder\\u00e1 aprovar ele pelo painel.\"}', 'PAID', '2025-08-10 01:00:12', '2025-08-10 01:00:21');

-- --------------------------------------------------------

--
-- Estrutura para tabela `transacoes`
--

CREATE TABLE `transacoes` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `tipo` enum('DEPOSIT','WITHDRAW','REFUND') COLLATE utf8mb4_general_ci NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `saldo_anterior` decimal(10,2) NOT NULL,
  `saldo_posterior` decimal(10,2) NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `referencia` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gateway` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `transacoes`
--

INSERT INTO `transacoes` (`id`, `user_id`, `tipo`, `valor`, `saldo_anterior`, `saldo_posterior`, `status`, `referencia`, `gateway`, `descricao`, `created_at`) VALUES
(157, 1, 'REFUND', 10.00, 0.00, 10.00, 'COMPLETED', NULL, NULL, 'Estorno de saque reprovado', '2025-08-10 00:48:33');

-- --------------------------------------------------------

--
-- Estrutura para tabela `transacoes_afiliados`
--

CREATE TABLE `transacoes_afiliados` (
  `id` int NOT NULL,
  `afiliado_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `deposito_id` int NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `telefone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `saldo` decimal(10,2) DEFAULT '0.00',
  `indicacao` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `comissao_cpa` float DEFAULT '0',
  `comissao_revshare` float DEFAULT '0',
  `banido` tinyint(1) DEFAULT '0',
  `admin` int DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `influencer` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `telefone`, `email`, `senha`, `saldo`, `indicacao`, `comissao_cpa`, `comissao_revshare`, `banido`, `admin`, `created_at`, `updated_at`, `influencer`) VALUES
(1, 'admin', '23555487878', 'portalqic@gmail.com', '$2y$12$29f9EjXAmS2a5MmV69s7MOgFtE//hhWryd.aZPVCN66cV6Z4veYYK', 0.00, '', 0, 0, 0, 1, '2025-08-09 22:29:14', '2025-08-10 01:00:12', 0),
(484, 'teste teste', '(11) 22222-2222', 'teste@gmail.com', '$2y$12$X9ake8Tg4lsZ5ZQwX0u5UOmhOG5oTkBjRrzKF8VZs9WQ1BBSfutvK', 0.00, '', 0, 0, 0, 0, '2025-08-09 22:38:22', '2025-08-09 22:38:22', 0),
(487, 'Mayara Bernadete De Santana Souza', '(11) 91707-6982', 'contatowrwork1@gmail.com', '$2y$12$1Mh1GKt1kp.pAOLmTKYJm.b6ocyys.7ICaUxIltX.PCEj8fgNhj.G', 0.00, '', 0, 0, 0, 0, '2025-08-10 02:53:52', '2025-08-10 02:53:52', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_banners_ativo_ordem` (`ativo`,`ordem`);

--
-- Índices de tabela `config`
--
ALTER TABLE `config`
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices de tabela `depositos`
--
ALTER TABLE `depositos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idempotency_key` (`idempotency_key`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status` (`status`);

--
-- Índices de tabela `gateway`
--
ALTER TABLE `gateway`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `historico_revshare`
--
ALTER TABLE `historico_revshare`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ondapay`
--
ALTER TABLE `ondapay`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `raspadinhas`
--
ALTER TABLE `raspadinhas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `raspadinha_premios`
--
ALTER TABLE `raspadinha_premios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `raspadinha_id` (`raspadinha_id`);

--
-- Índices de tabela `saques`
--
ALTER TABLE `saques`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `idx_saques_transaction_id` (`transaction_id`),
  ADD KEY `idx_saques_idempotency_key` (`idempotency_key`),
  ADD KEY `idx_saques_gateway` (`gateway`);

--
-- Índices de tabela `transacoes`
--
ALTER TABLE `transacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `transacoes_afiliados`
--
ALTER TABLE `transacoes_afiliados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `afiliado_id` (`afiliado_id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `deposito_id` (`deposito_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `config`
--
ALTER TABLE `config`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `depositos`
--
ALTER TABLE `depositos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `historico_revshare`
--
ALTER TABLE `historico_revshare`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9520;

--
-- AUTO_INCREMENT de tabela `ondapay`
--
ALTER TABLE `ondapay`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `raspadinhas`
--
ALTER TABLE `raspadinhas`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `raspadinha_premios`
--
ALTER TABLE `raspadinha_premios`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de tabela `saques`
--
ALTER TABLE `saques`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT de tabela `transacoes`
--
ALTER TABLE `transacoes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT de tabela `transacoes_afiliados`
--
ALTER TABLE `transacoes_afiliados`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=488;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `raspadinha_premios`
--
ALTER TABLE `raspadinha_premios`
  ADD CONSTRAINT `raspadinha_premios_ibfk_1` FOREIGN KEY (`raspadinha_id`) REFERENCES `raspadinhas` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `transacoes_afiliados`
--
ALTER TABLE `transacoes_afiliados`
  ADD CONSTRAINT `transacoes_afiliados_ibfk_1` FOREIGN KEY (`afiliado_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `transacoes_afiliados_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `transacoes_afiliados_ibfk_3` FOREIGN KEY (`deposito_id`) REFERENCES `depositos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
