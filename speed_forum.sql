-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2020 at 04:39 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `speed_forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `categroies`
--

CREATE TABLE `categroies` (
  `catid` int(30) NOT NULL,
  `catname` varchar(500) NOT NULL,
  `grouping` varchar(100) NOT NULL,
  `catdescription` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categroies`
--

INSERT INTO `categroies` (`catid`, `catname`, `grouping`, `catdescription`) VALUES
(1, 'GUR', 'GUR', 'general university requirement'),
(2, 'share', 'Chat', 'school life sharing'),
(3, 'Applied and Media Arts', 'Arts', 'Bachelor of Arts (Honours) in Applied and Media Arts'),
(4, 'Bussiness', 'Arts', 'Bachelor of Arts (Honours) in Business'),
(5, 'Bilingual Studies', 'Arts', 'Bachelor of Arts (Honours) in Bilingual Studies'),
(6, 'Housing Management', 'Arts', 'Bachelor of Arts (Honours) in Housing Management'),
(7, 'Marketing and public Relations', 'Arts', 'Bachelor of Arts (Honours) in Marketing and Public Relations'),
(8, 'Professional Communication', 'Arts', 'Bachelor of Arts (Honours) in Professional Communication'),
(9, 'Arts Scheme in Business', 'Arts', 'Bachelor of Arts (Honours) Scheme in Business (with specialism in Finance, Health Services Management, Human Resource Management, International Business, Operations and SCM, General Business'),
(10, 'Arts Scheme in Hospitality and Tourism Management', 'Arts', 'Bachelor of Arts (Honours) Scheme in Hospitality and Tourism Management (with specialism in Convention and Event Management, Hospitality Management, Travel Industry Management)'),
(11, 'Arts Scheme in Marketing', 'Arts', 'Bachelor of Arts (Honours) Scheme in Marketing (with specialism in Marketing Management, Marketing and Digital Strategy, Marketing and Public Relations and Retail and Service Management)'),
(12, 'Business Adminstration', 'Business', 'Bachelor of Business Administration (Honours) in Accountancy'),
(13, 'Engineering in Electrical Engineering', 'Engineering', 'Bachelor of Engineering (Honours) in Electrical Engineering*'),
(14, 'Engineering in Mechanical Engineering', 'Engineering', 'Bachelor of Engineering (Honours) in Mechanical Engineering'),
(15, 'Building Engineering and Management', 'Science', 'Bachelor of Science (Honours) in Building Engineering and Management'),
(16, 'Surveying', 'Science', 'Bachelor of Science (Honours) in Surveying'),
(17, 'Applied Sciences', 'Science', 'Bachelor of Science (Honours) Scheme in Applied Sciences (with specialism in Information Systems and Web Technologies, Health Studies or Statistics and Data Science)'),
(18, 'Social Sciences', 'Science', 'Bachelor of Social Sciences (Honours) Scheme \r\n(with specialism in Psychology, Public Administration or general Social Sciences)'),
(19, 'Active Ageing', 'Diploma', 'Diploma in Active Ageing*');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `cid` int(30) NOT NULL,
  `sid` int(30) NOT NULL,
  `tutorName` varchar(30) NOT NULL,
  `year_finished` varchar(50) NOT NULL,
  `grades` varchar(10) NOT NULL,
  `workload` varchar(10) NOT NULL,
  `comment_group_project` int(11) NOT NULL,
  `comment_assignment` int(11) NOT NULL,
  `comment_test` int(11) NOT NULL,
  `comment_exam` int(11) NOT NULL,
  `comment_Identity` int(11) NOT NULL,
  `comment_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments_content` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`cid`, `sid`, `tutorName`, `year_finished`, `grades`, `workload`, `comment_group_project`, `comment_assignment`, `comment_test`, `comment_exam`, `comment_Identity`, `comment_datetime`, `comments_content`) VALUES
(6, 57, 'testing', '0000-00-00', 'B', 'heavy', 0, 0, 0, 0, 0, '0000-00-00 00:00:00', 'IDK'),
(7, 57, 'IDKKKK', '0000-00-00', 'F', '', 0, 0, 0, 0, 0, '0000-00-00 00:00:00', 'qwer'),
(8, 57, 'hello', '0000-00-00', 'D', '', 0, 0, 0, 0, 0, '0000-00-00 00:00:00', 'DONE~~~~~~~~~~~~~~!!!!!!!!!!!!!!!~~~~~~~~~~~~!!!!!!!!!!!!!!!!!~~~~~~~~~~~~~~asdfasdfdasdfasdfasdfasdfadsfasdfasdfasdfasdfasdfsadcasdc'),
(9, 57, '', '0000-00-00', 'C+', '', 0, 0, 0, 0, 0, '2018-04-09 23:36:58', ''),
(11, 57, '', '0000-00-00', 'C', '', 0, 0, 0, 0, 0, '2018-04-09 23:37:08', ''),
(13, 57, '', '0000-00-00', 'D+', '', 0, 0, 0, 0, 0, '2018-04-09 23:38:14', ''),
(14, 57, '', '0000-00-00', 'B+', '', 0, 0, 0, 0, 0, '2018-04-09 23:38:24', ''),
(15, 57, 'sdf', '2015/16 SEM A', 'A+', 'Very Light', 12, 123, 12, 123, 0, '2018-04-11 00:00:00', 'sdfasesdf'),
(16, 57, 'asdfsadf', '2015/16 SEM A', 'F', 'Very Heavy', 10, 10, 10, 10, 0, '2018-04-11 00:00:00', 'asdfwaefasdfsadfvasdrvase'),
(17, 57, 'sdfawe', '2017/18 SEM B', 'C', 'Very Heavy', 20, 20, 20, 20, 0, '2018-04-11 00:00:00', 'OMGGGGGGGQERRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRrrOMGGGGGGGQERRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRrrOMGGGGGGGQERRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRrrOMGGGGGGGQERRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRrrOMGGGGGGGQERRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRrrOMGGGGGGGQERRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRrrOMGGGGGGGQERRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRrr'),
(18, 57, 'wrwae', '2017/18 SEM B', 'A+', 'Very Light', 20, 20, 20, 20, 0, '2018-04-11 00:00:00', 'asfqwefasdcoasijdf561351231321231233123121asfqwefasdcoasijdf561351231321231233123121asfqwefasdcoasijdf561351231321231233123121asfqwefasdcoasijdf561351231321231233123121asfqwefasdcoasijdf561351231321231233123121asfqwefasdcoasijdf561351231321231233123121asfqwefasdcoasijdf561351231321231233123121asfqwefasdcoasijdf561351231321231233123121asfqwefasdcoasijdf561351231321231233123121asfqwefasdcoasijdf561351231321231233123121asfqwefasdcoasijdf561351231321231233123121'),
(22, 59, '', '2015/16 SEM A', 'A+', 'Very Light', 0, 0, 0, 0, 0, '2018-04-19 04:16:57', 'qwefqwefasdvc'),
(23, 60, '', '2015/16 SEM A', 'A+', 'Very Light', 0, 0, 0, 0, 0, '2018-04-19 04:18:37', 'qwefcfwqased'),
(24, 60, '', '2015/16 SEM A', 'A+', 'Very Light', 0, 0, 0, 0, 0, '2018-04-19 04:18:45', 'qwefcfwqased'),
(25, 51, '', '2015/16 SEM A', 'A+', 'Very Light', 0, 0, 0, 0, 0, '2018-04-19 04:18:57', 'qwevrqwetrqwetvqewrtwert234234v2'),
(26, 58, '', '2015/16 SEM A', 'A+', 'Very Light', 0, 0, 0, 0, 0, '2018-04-19 04:19:15', 'cqwf23q441234c32wqrwercasd'),
(27, 57, 'dfaef', '2015/16 SEM A', 'A+', 'Very Light', 2, 2, 2, 2, 25, '2020-07-14 04:39:08', 'GOOD');

-- --------------------------------------------------------

--
-- Table structure for table `logbook`
--

CREATE TABLE `logbook` (
  `target_table` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `col1` varchar(500) NOT NULL,
  `col2` varchar(500) NOT NULL,
  `col3` varchar(500) NOT NULL,
  `col4` varchar(500) NOT NULL,
  `col5` varchar(500) NOT NULL,
  `col6` varchar(500) NOT NULL,
  `col7` varchar(500) NOT NULL,
  `col8` varchar(500) NOT NULL,
  `col9` varchar(500) NOT NULL,
  `col10` varchar(500) NOT NULL,
  `col11` varchar(500) NOT NULL,
  `col12` varchar(500) NOT NULL,
  `col13` varchar(500) NOT NULL,
  `col14` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logbook`
--

INSERT INTO `logbook` (`target_table`, `action`, `col1`, `col2`, `col3`, `col4`, `col5`, `col6`, `col7`, `col8`, `col9`, `col10`, `col11`, `col12`, `col13`, `col14`) VALUES
('userinfo', 'delete', '22', 'admin233', '12345678a', 'S', 'asd13f', '2018-03-23 20:49:32', '', '', '', '', '', '', '', ''),
('userinfo', 'delete', '20', 'admin1233', 'a1s2d3f1', 'S', 'ewa', '2018-03-18 23:13:29', '', '', '', '', '', '', '', ''),
('userinfo', 'delete', '21', 'mytest233', '10101010a', 'S', 'aefqwe15623', '2018-03-23 19:50:07', '', '', '', '', '', '', '', ''),
('userinfo', 'update', '19', 'admin123', 'asdf123456', 'S', '123456', '2018-03-18 22:56:00', '', '', '', '', '', '', '', ''),
('userinfo', 'update', '1', 'admin', '', 'F', 'admin@gmail.com', '2018-02-12 12:00:00', '', '', '', '', '', '', '', ''),
('userinfo', 'delete', '17', 'qwf', 'qwef', 'S', 'fqwe', '2018-03-18 18:33:49', '', '', '', '', '', '', '', ''),
('userinfo', 'delete', '19', 'admin123', 'asdf123456', 'F', '123456', '2018-03-18 22:56:00', '', '', '', '', '', '', '', ''),
('userinfo', 'delete', '19', 'admin123', 'asdf123456', 'F', '123456', '2018-03-18 22:56:00', '', '', '', '', '', '', '', ''),
('userinfo', 'delete', '19', 'admin123', 'asdf123456', 'F', '123456', '2018-03-18 22:56:00', '', '', '', '', '', '', '', ''),
('userinfo', 'update', '16', 'warCraft', '321', 'S', '', '2018-01-10 10:10:56', '', '', '', '', '', '', '', ''),
('userinfo', 'delete', '16', 'warCraft123', '321', 'S', '', '2018-01-10 10:10:56', '', '', '', '', '', '', '', ''),
('userinfo', 'update', '1', 'admin', '', 'S', 'abc@gmail.com', '2018-01-12 12:00:00', '', '', '', '', '', '', '', ''),
('subject', 'update', '25', 'SPD2310', 'Personal Management', 'GUR', 'CAR', '2', 'English', '', '', '', '', '', '', ''),
('subject', 'update', '25', 'SPD2310', 'Personal Management', 'CAR', 'GUR', '2', 'English', '', '', '', '', '', '', ''),
('subject', 'update', '25', 'SPD2310', 'Personal Management1', 'GUR', 'CAR', '2', 'English', '', '', '', '', '', '', ''),
('subject', 'update', '25', 'SPD2310', 'Personal Management', 'CAR', 'GUR', '2', 'English', '', '', '', '', '', '', ''),
('subject', 'update', '25', 'SPD2310', 'Personal Management123', 'CAR', 'GUR', '1', 'CHINESE', '', '', '', '', '', '', ''),
('subject', 'delete', '999', 'tesxting', 'tseting', '', '', '', '', '', '', '', '', '', '', ''),
('replies', 'update', '1', '1', '1', '1', '0000-00-00 00:00:00', 'abc', '', '', '', '', '', '', '', ''),
('replies', 'delete', '99', '40', '6', '24', '2018-04-20 23:57:20', '', '', '', '', '', '', '', '', ''),
('comments', 'update', '7', '57', 'IDKKKK', '0000-00-00', 'F', '', '0', '0', '0', '0', '0', '0000-00-00 00:00:00', 'qwfefqfasdfasdcjkasdhcjkdahskcjljkchqwiuehciudsahcjksbcjklsadncknsdajklcnnqeiwuobfhcjkldsbnckljadnvcijknqeajklvnajksdnvjkasndjklvnaskdjlcnjknaksjdncjknqwieujnckljadsncjklasnicuewqncjknadskljcnkjladsnicunuqweicnkjasdncl,knqijowencijndsaklnvklajsd', ''),
('comments', 'update', '7', '57', 'IDKKKK', '0000-00-00', 'F', '', '0', '0', '0', '0', '0', '0000-00-00 00:00:00', 'qwfefqfasdfasdcjkasdhcjkdahskcjljkchqwiuehciudsahcjksbcjklsadncknsdajklcnnqeiwuobfhcjkldsbnckljadnvcijknqeajklvnajksdnvjkasndjklvnaskdjlcnjknaksjdncjknqwieujnckljadsncjklasnicuewqncjknadskljcnkjladsnicunuqweicnkjasdncl,knqijowencijndsaklnvklajsd', ''),
('comments', 'update', '7', '57', 'IDKKKK', '0000-00-00', 'F', '', '0', '0', '0', '0', '0', '0000-00-00 00:00:00', 'qwfefqfasdfasdcjkasdhcjkdahskcjljkchqwiuehciudsahcjksbcjklsadncknsdajklcnnqeiwuobfhcjkldsbnckljadnvcijknqeajklvnajksdnvjkasndjklvnaskdjlcnjknaksjdncjknqwieujnckljadsncjklasnicuewqncjknadskljcnkjladsnicunuqweicnkjasdncl,knqijowencijndsaklnvklajsd', ''),
('comments', 'delete', '28', '57', 'FF', '2015/16 SEM A', 'F', 'Very Light', '1', '1', '1', '1', '0', '2018-04-22 05:31:23', 'FFFFFF', ''),
('comments', 'delete', '27', '57', 'let me have a check of identit', '2015/16 SEM A', 'A+', 'Very Light', '1', '1', '0', '0', '1', '2018-04-22 08:51:21', 'go!', ''),
('subject', 'delete', '1005', 'SPD998', '', '', '', '', '', '', '', '', '', '', '', ''),
('subject', 'delete', '1002', 'SPD999', 'TESTING2', '', '', '', '', '', '', '', '', '', '', ''),
('subject', 'delete', '1000', 'SDP9999', 'TESTING', 'GUR', 'CAR', '1', 'English', '', '', '', '', '', '', ''),
('replies', 'update', '51', '3', '2', '1', '2018-04-20 21:52:46', 'Let me have a reply', '', '', '', '', '', '', '', ''),
('comments', 'update', '6', '57', 'testing', '0000-00-00', 'B', 'heavy', '0', '0', '0', '0', '0', '0000-00-00 00:00:00', 'IDKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKK', ''),
('userinfo', 'update', '1', 'admin', '', 'S', 'DBC@gmail.com', '2018-01-12 12:00:00', '', '', '', '', '', '', '', ''),
('userinfo', 'update', '1', 'admin', '123', 'S', 'DBC@gmail.com', '2018-01-12 12:00:00', '', '', '', '', '', '', '', ''),
('userinfo', 'update', '1', 'admin', '', 'S', 'DBC@gmail.com', '2018-01-12 12:00:00', '', '', '', '', '', '', '', ''),
('userinfo', 'update', '1', 'admin', '123', 'S', 'DBC@gmail.com', '2018-01-12 12:00:00', '', '', '', '', '', '', '', ''),
('userinfo', 'update', '1', 'admin', '', 'S', 'DBC@gmail.com', '2018-01-12 12:00:00', '', '', '', '', '', '', '', ''),
('userinfo', 'update', '1', 'admin', '123', 'S', 'DBC@gmail.com', '2018-01-12 12:00:00', '', '', '', '', '', '', '', ''),
('userinfo', 'update', '1', 'admin', '', 'S', 'DBC@gmail.com', '2018-01-12 12:00:00', '', '', '', '', '', '', '', ''),
('userinfo', 'delete', '18', 'jfieksu', 'aaaaaaaa1', 'S', '1706377456', '2018-03-18 21:42:01', '', '', '', '', '', '', '', ''),
('replies', 'update', '4', '4', '2', '1', '2018-04-19 12:32:30', 'OMG TESTINGINGINGINGINGING\r\n', '', '', '', '', '', '', '', ''),
('subject', 'update', '25', 'SPD2310', 'Personal Management', 'GUR', 'CAR', '2', 'English', '', '', '', '', '', '', ''),
('subject', 'update', '25', 'SPD2310', 'Personal Management', 'CAR', 'GUR', '3', 'English', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `postinfo`
--

CREATE TABLE `postinfo` (
  `pid` int(30) NOT NULL,
  `uid` int(30) NOT NULL,
  `catid` int(30) NOT NULL,
  `post_title` text NOT NULL,
  `post_numberOfvisits` int(20) NOT NULL,
  `post_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postinfo`
--

INSERT INTO `postinfo` (`pid`, `uid`, `catid`, `post_title`, `post_numberOfvisits`, `post_datetime`) VALUES
(1, 1, 3, 'Test123123 29/3/2018', 207, '2018-03-29 00:00:00'),
(3, 1, 3, 'another test', 117, '2018-04-10 00:00:00'),
(4, 23, 3, 'Let Me Try this effect!!!!!!!', 145, '2018-04-19 11:54:45'),
(32, 1, 2, 'OMG', 36, '2018-04-20 21:53:12'),
(36, 1, 3, 'I could not believe that', 17, '2018-04-20 22:39:56'),
(37, 1, 1, 'CHECK alert problem', 3, '2018-04-20 22:55:45'),
(38, 1, 1, 'fhwquiefh', 1, '2018-04-20 22:59:49'),
(39, 1, 1, 'OMGASDGASDGASD', 3, '2018-04-20 23:04:54'),
(40, 24, 1, 'i am female', 20, '2018-04-20 23:42:59'),
(41, 24, 16, 'Hello surveying', 15, '2018-04-21 00:02:38');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `replies_id` int(11) NOT NULL,
  `pid` int(30) NOT NULL,
  `rid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `replies_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`replies_id`, `pid`, `rid`, `uid`, `replies_datetime`, `content`) VALUES
(1, 1, 1, 1, '0000-00-00 00:00:00', 'abcasd'),
(2, 3, 1, 1, '2018-04-18 20:59:15', ''),
(3, 4, 1, 23, '2018-04-19 11:56:56', 'OMG this so difficult to do it'),
(4, 4, 2, 1, '2018-04-19 12:32:30', '2018/4/27'),
(51, 3, 2, 1, '2018-04-20 21:52:46', 'reply'),
(52, 32, 1, 1, '2018-04-20 21:53:12', 'it is really work!!!!!!!!!!!!!'),
(53, 32, 2, 1, '2018-04-20 21:53:27', 'YES it it workable'),
(54, 4, 3, 1, '2018-04-20 21:57:11', 'YES, finally, the bug is fixed'),
(55, 1, 2, 23, '2018-04-20 22:03:42', 'let me give you a new reply\n'),
(56, 32, 3, 1, '2018-04-20 22:33:15', 'yes'),
(57, 33, 1, 1, '2018-04-20 22:37:42', ''),
(58, 34, 1, 1, '2018-04-20 22:38:35', ''),
(59, 35, 1, 1, '2018-04-20 22:39:03', ''),
(60, 36, 1, 1, '2018-04-20 22:39:56', 'YES i could not believe that'),
(61, 36, 2, 1, '2018-04-20 22:49:20', ''),
(63, 36, 3, 1, '2018-04-20 22:49:20', ''),
(64, 36, 4, 1, '2018-04-20 22:49:40', 'what was that'),
(65, 36, 5, 1, '2018-04-20 22:49:40', ''),
(66, 36, 6, 1, '2018-04-20 22:49:40', ''),
(67, 36, 7, 1, '2018-04-20 22:49:40', ''),
(68, 36, 8, 1, '2018-04-20 22:49:57', 'why'),
(69, 36, 9, 1, '2018-04-20 22:50:06', 'IDK'),
(71, 4, 4, 1, '2018-04-20 22:50:59', 'NO!!!!!!'),
(72, 3, 3, 1, '2018-04-20 22:51:43', 'can you see it'),
(73, 4, 5, 1, '2018-04-20 22:52:01', 'i cant see it'),
(74, 3, 4, 1, '2018-04-20 22:52:19', 'innerHTML'),
(75, 1, 3, 1, '2018-04-20 22:53:35', 'can i give you a reply'),
(76, 3, 5, 1, '2018-04-20 22:54:58', 'qwf'),
(77, 37, 1, 1, '2018-04-20 22:55:45', 'it is work?'),
(78, 36, 10, 1, '2018-04-20 22:56:48', 'let me reload it'),
(79, 1, 4, 1, '2018-04-20 22:57:20', 'location.reload (), is my last method'),
(80, 1, 5, 1, '2018-04-20 22:57:39', 'i dont like that~_~'),
(81, 38, 1, 1, '2018-04-20 22:59:49', 'sdfhqwieufhasdjkcnasd'),
(82, 39, 1, 1, '2018-04-20 23:04:54', 'afseasdfvasdvcwera'),
(83, 36, 11, 1, '2018-04-20 23:05:30', 'SO HAPPY AND SO MANY BUGSSSSSSSSSSSSSS'),
(84, 1, 6, 22, '2018-04-20 23:07:43', 'LET ME HAVE A NEW REPLY'),
(85, 1, 7, 22, '2018-04-20 23:07:43', ''),
(86, 1, 8, 22, '2018-04-20 23:07:43', ''),
(87, 1, 9, 22, '2018-04-20 23:08:00', ''),
(88, 1, 9, 22, '2018-04-20 23:08:00', ''),
(89, 1, 9, 22, '2018-04-20 23:08:00', '???????'),
(90, 1, 9, 22, '2018-04-20 23:08:00', ''),
(91, 1, 10, 22, '2018-04-20 23:08:25', 'ANOTHER BUG IS FOUND ~_~~~_~_~_~_~_~'),
(92, 1, 11, 22, '2018-04-20 23:08:40', ''),
(93, 1, 11, 22, '2018-04-20 23:08:40', 'WHY!!!!'),
(94, 40, 1, 24, '2018-04-20 23:42:59', 'hello'),
(95, 40, 2, 24, '2018-04-20 23:55:08', 'yes we are girls'),
(96, 40, 3, 24, '2018-04-20 23:55:08', ''),
(97, 40, 4, 24, '2018-04-20 23:55:25', ''),
(98, 40, 5, 24, '2018-04-20 23:55:25', 'why do i submit two statement'),
(100, 40, 7, 24, '2018-04-20 23:58:25', 'YO!'),
(101, 40, 8, 24, '2018-04-20 23:58:44', 'i found the reason~~~~~~~~~~~~~~~~~~\n'),
(102, 41, 1, 24, '2018-04-21 00:02:38', 'I am now studying IT');

-- --------------------------------------------------------

--
-- Table structure for table `reply_like`
--

CREATE TABLE `reply_like` (
  `likeId` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reply_like`
--

INSERT INTO `reply_like` (`likeId`, `pid`, `rid`, `uid`) VALUES
(71, 1, 1, 1),
(72, 3, 1, 1),
(73, 3, 1, 23),
(74, 1, 1, 23),
(75, 4, 2, 23),
(76, 4, 3, 23),
(78, 32, 2, 23),
(79, 3, 2, 1),
(80, 4, 2, 1),
(81, 32, 3, 1),
(82, 3, 3, 1),
(83, 3, 4, 1),
(84, 3, 5, 1),
(85, 39, 1, 1),
(86, 36, 11, 1),
(87, 36, 9, 1),
(88, 36, 11, 23),
(89, 36, 11, 22),
(90, 1, 10, 22),
(93, 41, 1, 1),
(94, 4, 3, 1),
(97, 40, 2, 24),
(98, 40, 8, 24),
(99, 40, 3, 1),
(100, 4, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sid` int(30) NOT NULL,
  `subject_code` varchar(20) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `subject_categories` varchar(20) NOT NULL,
  `subject_subgroup` varchar(30) NOT NULL,
  `subject_level` varchar(10) NOT NULL,
  `subject_language` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sid`, `subject_code`, `subject_name`, `subject_categories`, `subject_subgroup`, `subject_level`, `subject_language`) VALUES
(25, 'SPD2310', 'Personal Management', 'CAR', 'GUR', '2', 'English'),
(26, 'SPD2311', 'Leadership in Practice', 'GUR', 'CAR', '2', 'English'),
(28, 'SPD2319', 'Health, Nutrition and Lifestyl', 'GUR', 'CAR', '2', 'English'),
(30, 'SPD2312', 'Contemporary China', 'GUR', 'CAR', '2', 'Chinese'),
(31, 'SPD2313', 'China and the World', 'GUR', 'CAR', '2', 'Chinese'),
(32, 'SPD2316', 'Language Culture of Hong Kong and the Chinese Mainland', 'GUR', 'CAR', '2', 'Chinese'),
(33, 'SPD2318', 'Exploring International Relati', 'GUR', 'CAR', '2', 'English'),
(34, 'SPD2325', 'Mass Media and Society', 'GUR', 'CAR', '2', 'English'),
(40, 'SPD2326', 'Intimacy and Identity in Moder', 'GUR', 'CAR', '2', 'English'),
(41, 'SPD2337', 'Digital Tools and Skills for A', 'GUR', 'CAR', '2', 'English'),
(47, 'SPD2321', 'Chinese Civilization and Moder', 'GUR', 'CAR', '2', 'Chinese'),
(48, 'SPD2328', 'Using Human-Centered Design to', 'GUR', 'Service-Learning', '2', 'Chinese'),
(49, 'SPD3271', 'Breaking the Digital Divide fo', 'GUR', 'Service-Learning', '3', 'Chinese'),
(50, 'SPD2291', 'Introduction to Psychology', 'GUR', 'Free Elective', '2', 'English'),
(51, 'SPD2294', 'Introduction to Hospitality Industry', 'GUR', 'Free Elective', '2', 'English'),
(52, 'SPD2296', 'Introduction to Business', 'GUR', 'Free Elective', '2', 'English'),
(53, 'SPD2314', 'Culture and Ways of Life', 'GUR', 'Free Elective', '2', 'English'),
(54, 'SPD2315', 'Films and Storytelling', 'GUR', 'Free Elective', '2', 'English'),
(55, 'SPD3249', 'Introduction to Complementary ', 'GUR', 'Free Elective', '3', 'English'),
(56, 'SPD3298', 'Introduction to Personal Finan', 'GUR', 'Free Elective', '3', 'English'),
(57, 'SPD1087', 'English for Academic Studies I', 'GUR', 'LCR', '1', 'English'),
(58, 'SPD1088', 'English for Academic Studies II', 'GUR', 'LCR', '1', 'English'),
(59, 'SPD1091', 'Chinese Communication for College Students\r\n', 'GUR', 'LCR', '1', 'Chinese'),
(60, 'SPD1092', 'Elementary Chinese', 'GUR', 'LCR', '1', 'Chinese'),
(1006, 'SPD995', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf'),
(1007, 'SPD222222', 'asdf', 'asdf', 'asdf', '2', 'asdf');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `uid` int(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `user_password` varchar(30) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_datatime` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`uid`, `username`, `user_password`, `sex`, `email`, `user_datatime`) VALUES
(1, 'admin', '1234', 'S', 'DBC@gmail.com', '2018-01-12 12:00:00'),
(23, 'helloIamUser', 'asdf1234', 'S', 'helloIamUser', '2018-04-19 11:51:53'),
(24, 'iamfemale', 'asdf1234', 'F', '17052151121', '2018-04-20 23:42:33'),
(25, 'steveleungtest', 'test1234', 'S', '1705213ss', '2020-07-14 10:38:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categroies`
--
ALTER TABLE `categroies`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `cid` (`cid`);

--
-- Indexes for table `postinfo`
--
ALTER TABLE `postinfo`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`replies_id`);

--
-- Indexes for table `reply_like`
--
ALTER TABLE `reply_like`
  ADD PRIMARY KEY (`likeId`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `sid` (`sid`),
  ADD UNIQUE KEY `subject_code` (`subject_code`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `uid` (`uid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `cid` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `postinfo`
--
ALTER TABLE `postinfo`
  MODIFY `pid` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `replies_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `reply_like`
--
ALTER TABLE `reply_like`
  MODIFY `likeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `sid` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1008;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `uid` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
