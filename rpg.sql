-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/12/2023 às 20:02
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `rpg`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `estudo`
--

CREATE TABLE `estudo` (
  `nome_personagem` varchar(30) NOT NULL,
  `NomeJogador` varchar(30) NOT NULL,
  `Agilidade` bit(1) NOT NULL,
  `Forca` bit(1) NOT NULL,
  `Intelecto` bit(1) NOT NULL,
  `Presenca` bit(1) NOT NULL,
  `Vigor` bit(1) NOT NULL,
  `Origem` varchar(255) NOT NULL,
  `Classe` varchar(255) NOT NULL,
  `Nex` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estudo`
--

INSERT INTO `estudo` (`nome_personagem`, `NomeJogador`, `Agilidade`, `Forca`, `Intelecto`, `Presenca`, `Vigor`, `Origem`, `Classe`, `Nex`) VALUES
('a', 'a', b'0', b'0', b'0', b'0', b'0', 'a', 'a', 0),
('aa', 'aa', b'0', b'0', b'0', b'0', b'0', 'aa', 'aa', 0),
('aa', 'aa', b'0', b'0', b'0', b'0', b'0', 'aa', 'aa', 0),
('aa', 'aa', b'0', b'0', b'0', b'0', b'0', 'aa', 'aa', 0),
('aa', 'aa', b'0', b'0', b'0', b'0', b'0', 'aa', 'aa', 0),
('aa', 'aa', b'0', b'0', b'0', b'0', b'0', 'aa', 'aa', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

CREATE TABLE `user` (
  `username` varchar(30) NOT NULL,
  `password` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('ed', '$2y$10$y.e5mOhgxbE'),
('ed', '$2y$10$Bmz02clcAzg'),
('sammmmgay', '$2y$10$AqA8lu4lI89'),
('samgay', '$2y$10$lLjmCD1YI40'),
('samgay', '$2y$10$8WHKKAGm9ko'),
('123', '$2y$10$FfKxuDGWS6U'),
('123', '$2y$10$MHiTr9mkLe1'),
('123', '123'),
('123', '1234'),
('aaa', 'aaa');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
