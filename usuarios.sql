-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26-Abr-2018 às 04:19
-- Versão do servidor: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `estatistica`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nomeUsuario` varchar(255) CHARACTER SET utf8 NOT NULL,
  `emailUsuario` varchar(255) CHARACTER SET utf8 NOT NULL,
  `mensagemUsuario` varchar(255) CHARACTER SET utf8 NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nomeUsuario`, `emailUsuario`, `mensagemUsuario`, `tipo`) VALUES
(10, 'Lapis', 'octaviolabos@gmail.com', 'asd', 0),
(11, 'Lapis', 'octaviolabos@gmail.com', 'asd', 0),
(12, 'Lapis', '', 'aweras', 0),
(13, 'Lapis', '', 'aweras', 0),
(14, 'Lapis', '', 'aweras', 0),
(15, 'Lapis', '', 'aweras', 0),
(16, 'Lapis', '', 'aweras', 0),
(17, 'asdasd', 'matheus_3604@hotmail.com', 'asd', 0),
(18, 'asdasd', 'matheus_3604@hotmail.com', 'asd', 0),
(19, 'asdasd', 'matheus_3604@hotmail.com', 'asd', 0),
(20, 'Matheus', 'matheus_3604@hotmail.com', 'OlÃ¡', 0),
(21, 'Matheus', 'matheus_3604@hotmail.com', 'OlÃ¡', 0),
(22, 'Matheus', 'matheus_3604@hotmail.com', 'OlÃ¡, teste', 0),
(23, 'Matheus', 'jeny_claudio@hotmail.com', 'okyjgh', 0),
(24, 'Matheus', 'jeny_claudio@hotmail.com', 'okyjgh', 0),
(25, 'Matheus', 'jeny_claudio@hotmail.com', 'okyjgh', 0),
(26, 'Matheus', 'jeny_claudio@hotmail.com', 'okyjgh', 0),
(27, 'Jessica Roberta Negri Paes', 'asd@teste.com', 'chagh', 0),
(28, 'Jessica Roberta Negri Paes', 'asd@teste.com', 'chagh', 0),
(29, 'renassd', 'jorge@hotmail.com', 'asd', 0),
(30, 'renassd', 'jorge@hotmail.com', 'asd', 0),
(31, 'felipe melo', 'jorge@hotmail.com', 'asd', 0),
(32, 'salah', 'jorge@hotmail.com', 'asd', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
