-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2018 at 11:48 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

--SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
--SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_mvc`
--


DROP DATABASE IF EXISTS php_mvc;
CREATE DATABASE IF NOT EXISTS php_mvc DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE php_mvc;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE Table role
(
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    roles varchar(255) NOT NULL
);

--
-- Table structure for table `user`
--

CREATE table user
(
    ID  INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    role_id INT NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL, 
    FOREIGN KEY (role_ID) REFERENCES role (ID),
    UNIQUE KEY unique_username (username)
);

--
-- Table structure for table `session`
--

CREATE table session
(
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    start_date TIMESTAMP NOT NULL,
    end_date TIMESTAMP NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(ID)
);

--
-- Table structure for table `post`
--

CREATE table post
(
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    content LONGTEXT NOT NULL,
    user_id INT NOT NULL,
    author VARCHAR(255) NOT NULL,
    post_date TIMESTAMP NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(ID)
);


--
-- Table structure for table `Comments`
--

CREATE TABLE comment (
    ID int PRIMARY KEY AUTO_INCREMENT,
    content varchar(1000) NOT NULL ,
    datetime date NOT NULL,
    user_id int NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(ID)
);

--
-- Table structure for table `tags`
--

CREATE TABLE tag (
    ID int PRIMARY KEY AUTO_INCREMENT,
    tag varchar(255) NOT NULL
);


--
-- Table structure for table `posttag`
--

CREATE TABLE posttag (
    post_id INT NOT NULL,
    tag_id INT NOT NULL,
    FOREIGN KEY (post_id) REFERENCES post(ID),
    FOREIGN KEY (tag_id) REFERENCES tag(ID)
);

--
-- Table structure for table `like`
--

CREATE TABLE likes (
    ID int PRIMARY KEY AUTO_INCREMENT,
    post_id INT NOT NULL,
    FOREIGN KEY (post_id) REFERENCES post(ID)
);


