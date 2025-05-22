-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 25-05-20 08:16
-- 서버 버전: 10.4.32-MariaDB
-- PHP 버전: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `testdb`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `createdocument`
--

CREATE TABLE `createdocument` (
  `id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userId` varchar(50) NOT NULL,
  `title` text NOT NULL,
  `document` mediumtext DEFAULT NULL,
  `createDate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `createdocument`
--

INSERT INTO `createdocument` (`id`, `userId`, `title`, `document`, `createDate`) VALUES
(15, '345', 'I love chocolate', 'dream cacao 56percent', '2025-05-18'),
(18, '4321', '안녕하세요', '제 이름은 4321입니다.!!!', '2025-05-20'),
(19, '123', 'test edit', 'hi my name is testName', '2025-05-20');

-- --------------------------------------------------------

--
-- 테이블 구조 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userId` varchar(50) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `userName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `users`
--

INSERT INTO `users` (`id`, `userId`, `userPassword`, `userName`) VALUES
(2, '123', '123', 'SeoYeon'),
(3, '345', '345', 'cacao'),
(4, 'uniCTJ', '1234', 'yunseo'),
(5, '4321', '4321', '4321');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `createdocument`
--
ALTER TABLE `createdocument`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- 테이블의 인덱스 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `createdocument`
--
ALTER TABLE `createdocument`
  MODIFY `id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- 테이블의 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
