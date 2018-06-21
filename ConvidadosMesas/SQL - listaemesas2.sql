-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 21-Jun-2018 às 06:34
-- Versão do servidor: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `listaemesas2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `convidado`
--

CREATE TABLE `convidado` (
  `idconvidado` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telefone` varchar(30) NOT NULL,
  `ladofamilia` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `convidado`
--

INSERT INTO `convidado` (`idconvidado`, `nome`, `email`, `telefone`, `ladofamilia`, `status`) VALUES
(1, 'Convidado 2', 'c2@upf.br', '123456', 'noiva', 1),
(2, 'Convidado 3', 'c3@upf.br', '12345', 'noivo', 1),
(11, 'Convidado 1', 'c1@upf.br', '33333', 'Noiva', 1),
(12, 'Convidado 4', 'c4@upf.br', '2222', 'Noiva', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `mesa`
--

CREATE TABLE `mesa` (
  `idmesa` int(10) NOT NULL,
  `mesanumero` int(10) NOT NULL,
  `numerodelugares` int(10) NOT NULL,
  `descricao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mesa`
--

INSERT INTO `mesa` (`idmesa`, `mesanumero`, `numerodelugares`, `descricao`) VALUES
(1, 1, 5, 'Esta mesa ja é a mesa 1.1'),
(3, 2, 5, 'Descricao desta mesa 2'),
(4, 3, 4, 'Terceira mesa'),
(5, 4, 6, 'Mesa 4 com 6 lugares'),
(6, 5, 4, 'Mesa para teste numero 5');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mesaconvidado`
--

CREATE TABLE `mesaconvidado` (
  `idmontagem` int(10) NOT NULL,
  `idmesa` int(11) NOT NULL,
  `idconvidado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mesaconvidado`
--

INSERT INTO `mesaconvidado` (`idmontagem`, `idmesa`, `idconvidado`) VALUES
(89, 1, 2),
(90, 5, 11),
(92, 4, 12),
(93, 4, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `codusuario` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `login` varchar(40) NOT NULL,
  `senha` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`codusuario`, `email`, `login`, `senha`) VALUES
(6, 'alemao@upf.br', 'alemao', '123'),
(7, 'teste@teste.upf.br', 'pedro', '123'),
(8, 'alessandro@upf.br', 'Alessandro', '123'),
(9, 'eueu@upf.br', 'eueueu', '123'),
(10, 'alumao@upf.br', 'alumao', '123'),
(11, 'eu@upf.br', 'eu', '123'),
(12, 'teste@teste.upf.br', 'alemaozitus', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `convidado`
--
ALTER TABLE `convidado`
  ADD PRIMARY KEY (`idconvidado`);

--
-- Indexes for table `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`idmesa`);

--
-- Indexes for table `mesaconvidado`
--
ALTER TABLE `mesaconvidado`
  ADD PRIMARY KEY (`idmontagem`),
  ADD UNIQUE KEY `idconvidado` (`idconvidado`),
  ADD KEY `idmesa` (`idmesa`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codusuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `convidado`
--
ALTER TABLE `convidado`
  MODIFY `idconvidado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mesa`
--
ALTER TABLE `mesa`
  MODIFY `idmesa` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mesaconvidado`
--
ALTER TABLE `mesaconvidado`
  MODIFY `idmontagem` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `mesaconvidado`
--
ALTER TABLE `mesaconvidado`
  ADD CONSTRAINT `mesaconvidado_ibfk_1` FOREIGN KEY (`idmesa`) REFERENCES `mesa` (`idmesa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mesaconvidado_ibfk_2` FOREIGN KEY (`idconvidado`) REFERENCES `convidado` (`idconvidado`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
