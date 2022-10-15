-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15-Out-2022 às 03:30
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `circo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `artistas_espetaculos`
--

CREATE TABLE `artistas_espetaculos` (
  `id` int(11) NOT NULL,
  `artista` int(11) NOT NULL,
  `espetaculo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `artistas_espetaculos`
--

INSERT INTO `artistas_espetaculos` (`id`, `artista`, `espetaculo`) VALUES
(1, 1, 2),
(8, 15, 2),
(10, 15, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `espetaculos`
--

CREATE TABLE `espetaculos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `capacidade` int(11) NOT NULL,
  `data` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `espetaculos`
--

INSERT INTO `espetaculos` (`id`, `titulo`, `capacidade`, `data`) VALUES
(2, 'Espetaculo numero um', 22, '2022-10-07'),
(3, 'Cantarena de la sierra loca', 20000, '2022-10-12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sorteios`
--

CREATE TABLE `sorteios` (
  `id` int(11) NOT NULL,
  `espectador` int(11) NOT NULL,
  `data` date NOT NULL,
  `data_sistema` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `sorteios`
--

INSERT INTO `sorteios` (`id`, `espectador`, `data`, `data_sistema`) VALUES
(1, 8, '2022-10-14', '2022-10-14 22:12:46'),
(2, 17, '2022-10-14', '2022-10-14 22:15:07'),
(3, 16, '2022-10-14', '2022-10-14 22:16:51'),
(4, 17, '2022-10-14', '2022-10-14 22:16:53'),
(5, 16, '2022-10-14', '2022-10-14 22:16:54'),
(6, 8, '2022-10-14', '2022-10-14 22:16:54'),
(7, 11, '2022-10-14', '2022-10-14 22:16:57'),
(8, 17, '2022-10-14', '2022-10-14 22:18:51'),
(9, 17, '2022-10-14', '2022-10-14 22:18:53'),
(10, 8, '2022-10-14', '2022-10-14 22:18:54');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `user`, `password`, `type`) VALUES
(1, 'wesley', '202cb962ac59075b964b07152d234b70', 2),
(8, 'andre@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
(11, 'larissinhaa', '202cb962ac59075b964b07152d234b70', 1),
(15, 'andr22e@gmail.com', '202cb962ac59075b964b07152d234b70', 2),
(16, 'andreia@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
(17, 'teste@gmail.com', '202cb962ac59075b964b07152d234b70', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_type`
--

CREATE TABLE `users_type` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users_type`
--

INSERT INTO `users_type` (`id`, `type`) VALUES
(1, 'Espectador'),
(2, 'Artista');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `artistas_espetaculos`
--
ALTER TABLE `artistas_espetaculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artista` (`artista`),
  ADD KEY `espetaculo` (`espetaculo`);

--
-- Índices para tabela `espetaculos`
--
ALTER TABLE `espetaculos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sorteios`
--
ALTER TABLE `sorteios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `espectador` (`espectador`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- Índices para tabela `users_type`
--
ALTER TABLE `users_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `artistas_espetaculos`
--
ALTER TABLE `artistas_espetaculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `espetaculos`
--
ALTER TABLE `espetaculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `sorteios`
--
ALTER TABLE `sorteios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `users_type`
--
ALTER TABLE `users_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `artistas_espetaculos`
--
ALTER TABLE `artistas_espetaculos`
  ADD CONSTRAINT `artistas_espetaculos_ibfk_1` FOREIGN KEY (`artista`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `artistas_espetaculos_ibfk_2` FOREIGN KEY (`espetaculo`) REFERENCES `espetaculos` (`id`);

--
-- Limitadores para a tabela `sorteios`
--
ALTER TABLE `sorteios`
  ADD CONSTRAINT `sorteios_ibfk_1` FOREIGN KEY (`espectador`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`type`) REFERENCES `users_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
