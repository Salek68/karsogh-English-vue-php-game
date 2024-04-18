-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2024 at 07:40 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amirkabir_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL COMMENT 'لیست مدیر ها و معلمان\nمعلم باید به کلاس ها متصل شود',
  `fname` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `ismodir` tinyint(1) NOT NULL COMMENT 'با ismodir تفاوت معلم و مدیر شناخته میشود',
  `school_id` int(11) DEFAULT NULL COMMENT 'مدیر باید به یک مدرسه متصل شود',
  `personnel_code` int(11) NOT NULL COMMENT 'کد پرسنلی افراد\nدر آموزش و پرورش ثبت میشود'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `fname`, `lname`, `username`, `password`, `email`, `phone`, `location`, `ismodir`, `school_id`, `personnel_code`) VALUES
(1, 'علیرضا', 'یوسفی', 'alireza', '0000', 'dssds', '09334650695', 'sss', 1, 1, 1),
(2, 'قربان علی', 'عربی', 'aliarabi', '0000', 'fr3fr', '09334650655', 'g4trgtr', 0, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_class`
--

CREATE TABLE `tbl_admin_class` (
  `admin_id` int(11) NOT NULL COMMENT 'نشان دهنده این است که معلم به کدام کلاس ها دسترسی دارد',
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin_class`
--

INSERT INTO `tbl_admin_class` (`admin_id`, `class_id`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_question`
--

CREATE TABLE `tbl_admin_question` (
  `admin_id` int(11) NOT NULL COMMENT 'ممشخص کردن نویسنده یا ادمین هر سوال',
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin_question`
--

INSERT INTO `tbl_admin_question` (`admin_id`, `question_id`) VALUES
(2, 56),
(2, 58),
(2, 59),
(2, 60),
(2, 61),
(2, 62),
(2, 63),
(2, 64),
(2, 65),
(2, 66),
(2, 67),
(2, 68),
(2, 69),
(2, 70),
(2, 71),
(2, 72),
(2, 73),
(2, 74),
(2, 75),
(2, 76),
(2, 77);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_answer`
--

CREATE TABLE `tbl_answer` (
  `id` int(11) NOT NULL COMMENT 'لیست پاسخ ها',
  `question_id` int(11) NOT NULL,
  `iscorect` tinyint(1) NOT NULL,
  `text` text COLLATE utf8_persian_ci NOT NULL,
  `switch` int(11) NOT NULL COMMENT 'ایدی جواب در یک سوال به خصوص\nمثلا 1,2,3,4\n1,2\n1,2,3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci COMMENT='لیست پاسخ سوالات\nswitch برای عدد گزینه هر سوال است';

--
-- Dumping data for table `tbl_answer`
--

INSERT INTO `tbl_answer` (`id`, `question_id`, `iscorect`, `text`, `switch`) VALUES
(1, 1, 0, '35', 1),
(2, 1, 1, '40', 2),
(3, 1, 0, '42', 3),
(4, 1, 0, '45', 4),
(5, 2, 0, '10', 1),
(6, 2, 0, '15', 2),
(7, 2, 1, '30', 3),
(8, 2, 0, '75', 4),
(9, 3, 0, '21', 1),
(10, 3, 0, '14', 2),
(11, 3, 0, '49', 3),
(12, 3, 1, '28', 4),
(13, 4, 0, '22%', 1),
(14, 4, 0, '25%', 2),
(15, 4, 1, '20%', 3),
(16, 4, 0, '15%', 4),
(17, 5, 1, 'بله', 1),
(18, 5, 0, 'خیر', 2),
(19, 5, 0, 'اطلاعات کافی نیست', 3),
(20, 5, 0, 'سوال نادرست است', 4),
(21, 6, 0, '40', 1),
(22, 6, 0, '30', 2),
(23, 6, 1, '36', 3),
(24, 6, 0, '18', 4),
(25, 7, 0, '67%', 1),
(26, 7, 1, '80%', 2),
(27, 7, 0, '70%', 3),
(28, 7, 0, '90%', 4),
(29, 8, 0, '5', 1),
(30, 8, 0, '6', 2),
(31, 8, 0, '3', 3),
(32, 8, 1, '2', 4),
(33, 9, 0, '3500', 1),
(34, 9, 0, '3.5', 2),
(35, 9, 0, '350', 3),
(36, 9, 1, '35', 4),
(37, 10, 0, '35%', 1),
(38, 10, 0, '55%', 2),
(39, 10, 0, '45%', 3),
(40, 10, 1, '50%', 4),
(41, 11, 1, '24', 1),
(42, 11, 0, '12', 2),
(43, 11, 0, '42', 3),
(44, 11, 0, '30', 4),
(45, 12, 0, '15', 1),
(46, 12, 1, '30', 2),
(47, 12, 0, '40', 3),
(48, 12, 0, '60', 4),
(49, 13, 0, '48', 1),
(50, 13, 0, '12', 2),
(51, 13, 1, '24', 3),
(52, 13, 0, '18', 4),
(53, 14, 1, 'بله', 1),
(54, 14, 0, 'خیر', 2),
(55, 14, 0, 'اطلاعات کافی نیست', 3),
(56, 14, 0, 'سوال نادرست است', 4),
(57, 15, 0, '35', 1),
(58, 15, 1, '30', 2),
(59, 15, 0, '25', 3),
(60, 15, 0, '20', 4),
(61, 16, 1, '6', 1),
(62, 16, 0, '7', 2),
(63, 16, 0, '5', 3),
(64, 16, 0, '8', 4),
(65, 17, 0, '77', 1),
(66, 17, 0, '35', 2),
(67, 17, 0, '17', 3),
(68, 17, 1, '70', 4),
(69, 18, 0, '1200', 1),
(70, 18, 0, '1.2', 2),
(71, 18, 1, '12', 3),
(72, 18, 0, '120', 4),
(73, 19, 1, '5', 1),
(74, 19, 0, '4', 2),
(75, 19, 0, '6', 3),
(76, 19, 0, '3', 4),
(77, 20, 0, '20', 1),
(78, 20, 1, '24', 2),
(79, 20, 0, '12', 3),
(80, 20, 0, '15', 4),
(81, 71, 1, 'y', 1),
(82, 71, 0, 'n', 2),
(83, 71, 1, 'cvh', 3),
(84, 71, 0, 'ch', 4),
(85, 71, 1, 'cdvh', 5),
(86, 71, 0, 'cdh', 6),
(87, 72, 0, 'q', 1),
(88, 72, 1, 'w', 2),
(89, 72, 0, 'e', 3),
(90, 56, 1, 'dfxgf', 3),
(91, 74, 0, 'jhb', 1),
(92, 76, 0, 'wefwfw', 1),
(93, 76, 0, 'efwfwef', 2),
(94, 76, 1, 'efwfwewfwefew f', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class`
--

CREATE TABLE `tbl_class` (
  `id` int(11) NOT NULL COMMENT 'لیست کلاس ها',
  `school_id` int(11) NOT NULL,
  `name` varchar(35) COLLATE utf8_persian_ci NOT NULL,
  `grade_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tbl_class`
--

INSERT INTO `tbl_class` (`id`, `school_id`, `name`, `grade_id`) VALUES
(1, 1, '203', 1),
(2, 1, '202', 1),
(5, 1, '204', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dars`
--

CREATE TABLE `tbl_dars` (
  `id` int(11) NOT NULL COMMENT 'لیست درس ها \nباید با این فرمت باشد\nریاضی - فنی , فارسی - تجربی',
  `name` varchar(35) COLLATE utf8_persian_ci NOT NULL,
  `grade_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tbl_dars`
--

INSERT INTO `tbl_dars` (`id`, `name`, `grade_id`) VALUES
(4, 'ریاضی', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fasl`
--

CREATE TABLE `tbl_fasl` (
  `id` int(11) NOT NULL,
  `fasl` text NOT NULL,
  `dars_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_fasl`
--

INSERT INTO `tbl_fasl` (`id`, `fasl`, `dars_id`) VALUES
(4, 'فصل 1', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fixed_scores`
--

CREATE TABLE `tbl_fixed_scores` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `calculated_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grade`
--

CREATE TABLE `tbl_grade` (
  `id` int(11) NOT NULL COMMENT 'لیست پایه ها',
  `grade` varchar(30) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tbl_grade`
--

INSERT INTO `tbl_grade` (`id`, `grade`) VALUES
(1, 'یازدهم');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ostan`
--

CREATE TABLE `tbl_ostan` (
  `id` int(11) NOT NULL COMMENT 'لیست استان ها',
  `name` varchar(35) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tbl_ostan`
--

INSERT INTO `tbl_ostan` (`id`, `name`) VALUES
(1, 'خراسان رضوی');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_participate`
--

CREATE TABLE `tbl_participate` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `start_time` int(11) DEFAULT NULL COMMENT 'its timestamp'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_privacy`
--

CREATE TABLE `tbl_privacy` (
  `id` int(11) NOT NULL,
  `ispublic` tinyint(1) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question`
--

CREATE TABLE `tbl_question` (
  `id` int(11) NOT NULL COMMENT 'لیست سوالات',
  `text` text COLLATE utf8_persian_ci NOT NULL,
  `score` int(11) NOT NULL COMMENT 'نمره هر سوال',
  `level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci COMMENT='لیست سوالات\nمتن\nنمره';

--
-- Dumping data for table `tbl_question`
--

INSERT INTO `tbl_question` (`id`, `text`, `score`, `level`) VALUES
(1, 'حاصل ضرب 5 و 8 چقدر است؟', 2, 1),
(2, 'اگر یک دایره با قطر 10 سانتیمتر داشته باشد، محیط آن چند سانتی متر است؟ (عدد پی = 3)', 1, 2),
(3, 'محیط یک مربع با طول ضلع 7 سانتیمتر چقدر است؟', 1, 1),
(4, 'چند درصد افزایش می‌یابد اگر قیمت یک کالا از 100 دلار به 120 دلار برسد؟', 1, 2),
(5, 'اگر یک مثلث با اطوال 7، 8 و 9 سانتیمتر داشته باشد، آیا این مثلث مستطیلی است؟', 1, 3),
(6, 'اگر یک مستطیل ابعاد طول و عرض به ترتیب 12 و 6 سانتیمتر داشته باشد، محیط آن چقدر است؟', 1, 1),
(7, 'چند درصد از 80، 64 است؟', 1, 3),
(8, 'اگر عدد 4 را به عدد 6 اضافه کنیم و سپس عدد حاصل را در 5 تقسیم کنیم، عدد چندی به دست می‌آید؟', 1, 1),
(9, 'چند میلی‌متر معادل 3.5 سانتی‌متر است؟', 1, 2),
(10, 'چند درصد از 50 برابر 25 است؟', 1, 1),
(11, 'در یک دایره با شعاع 4 سانتیمتر، محیط دایره چقدر است؟ (عدد پی = 3)', 1, 2),
(12, 'اگر یک مثلث با ارتفاع 10 سانتیمتر و پایه 6 سانتیمتر داشته باشد، مساحت آن چقدر است؟', 1, 3),
(13, 'کمترین مضرب مشترک 8 و 12 چیست؟', 1, 2),
(14, 'اگر یک زاویه 90 درجه باشد، آیا آن زاویه مستقیمی است؟', 1, 3),
(15, 'اگر یک متر مربع از فرش با قیمت 30 دلار بخریم، چقدر هزینه می‌کنیم؟', 1, 1),
(16, 'یک مکعب با ضلع 5 سانتیمتر دارای چند وجه است؟', 1, 3),
(17, 'حاصل ضرب 7 و 10 چقدر است؟', 1, 1),
(18, 'چند سانتی متر معادل  120 میلیمتر است؟', 1, 2),
(19, 'چند ضلع دارد یک پنج ضلعی؟', 1, 1),
(20, 'اگر یک مستطیل طول آن 6 سانتیمتر و عرض آن 4 سانتیمتر باشد، چقدر مساحت آن است؟', 1, 2),
(55, 'text', 0, 0),
(56, 'salam', 1, 3),
(57, '1+1=?', 2, 1),
(58, '1+1=?', 2, 1),
(59, '1+1=?', 2, 1),
(60, 'fxg', 0, 3),
(61, 'fch', 0, 3),
(62, 'srzdfx', 0, 3),
(63, 'asf', 0, 3),
(64, 'ghjb', 0, 3),
(65, 'kgvj', 0, 3),
(66, 'vjh', 0, 3),
(67, 'afsd', 0, 3),
(68, '542', 2, 3),
(69, '654321', 2, 3),
(70, 'aya alan 5:46 ast?', 5, 3),
(71, 'alan 5:49?', 9, 3),
(72, 'tfgh', 3, 3),
(73, 'gjh', 0, 2),
(74, 'xghc', 0, 2),
(75, 'fsdrewgrgerwgerewrw', 2, 1),
(76, 'wefwefwe', 3, 2),
(77, '', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question_quiz`
--

CREATE TABLE `tbl_question_quiz` (
  `quiz_id` int(11) NOT NULL COMMENT 'اتصال سوالات به آزمون\nنشان دهنده این است که در یک ازمون چه سوال هایی استفاده شده است',
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_question_quiz`
--

INSERT INTO `tbl_question_quiz` (`quiz_id`, `question_id`) VALUES
(110, 1),
(110, 2),
(110, 3),
(110, 4),
(110, 5),
(110, 6),
(110, 7),
(110, 8),
(110, 9),
(110, 10),
(110, 11),
(110, 12),
(110, 13),
(110, 14),
(110, 15),
(110, 16),
(110, 17),
(110, 18),
(110, 19),
(110, 20),
(110, 58),
(110, 59),
(111, 56),
(112, 60),
(112, 61),
(112, 62),
(112, 63),
(112, 64),
(112, 65),
(112, 66),
(112, 67),
(112, 68),
(112, 69),
(112, 70),
(112, 71),
(112, 72),
(113, 73),
(113, 74),
(114, 75),
(116, 76),
(116, 77),
(117, 18),
(117, 76),
(117, 77),
(119, 2),
(119, 3),
(119, 4),
(119, 5),
(119, 6),
(119, 7),
(119, 9),
(119, 10),
(119, 11),
(119, 12),
(119, 75),
(119, 76),
(119, 77),
(120, 1),
(120, 2),
(121, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quiz`
--

CREATE TABLE `tbl_quiz` (
  `id` int(11) NOT NULL COMMENT 'لیست آزمون ها',
  `name` varchar(30) COLLATE utf8_persian_ci NOT NULL,
  `fasl_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tbl_quiz`
--

INSERT INTO `tbl_quiz` (`id`, `name`, `fasl_id`, `admin_id`, `level`, `deleted`) VALUES
(110, 'فصل 1 ریاضی یازدهم', 4, 2, 2, 0),
(111, 'xcvb', 4, 2, 3, 0),
(112, 'fgb', 4, 2, 3, 0),
(113, 'test', 4, 2, 2, 0),
(114, 'یسسس', 4, 1, 1, 0),
(116, 'یسسس', 4, 2, 2, 0),
(117, 'fas aesfevw', 4, 2, 2, 0),
(119, '43dqrf3qw', 4, 2, 2, 0),
(120, 'ertgerg', 4, 2, 1, 0),
(121, 'ali', 4, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quiz_class`
--

CREATE TABLE `tbl_quiz_class` (
  `quiz_id` int(11) NOT NULL COMMENT 'نشان دهنده این است که یک ازمون برای کدام کلاس ها تعریف شده است',
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quiz_user`
--

CREATE TABLE `tbl_quiz_user` (
  `quiz_id` int(11) NOT NULL COMMENT 'نشان دهنده این است که آزمون برای کدام دانش آموزان تعریف شده است',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_quiz_user`
--

INSERT INTO `tbl_quiz_user` (`quiz_id`, `user_id`) VALUES
(110, 3),
(119, 1),
(120, 1),
(121, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_region`
--

CREATE TABLE `tbl_region` (
  `id` int(11) NOT NULL COMMENT 'لیست نواحی',
  `name` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `shahr_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tbl_region`
--

INSERT INTO `tbl_region` (`id`, `name`, `shahr_id`) VALUES
(1, 'nahie 7', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_school`
--

CREATE TABLE `tbl_school` (
  `id` int(11) NOT NULL COMMENT 'لیست مدارس',
  `name` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `school_code` int(11) NOT NULL COMMENT 'کد مدرسه\nثبت شده در آموزش و پرورش',
  `region_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tbl_school`
--

INSERT INTO `tbl_school` (`id`, `name`, `school_code`, `region_id`) VALUES
(1, 'امیرکبیر', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shahr`
--

CREATE TABLE `tbl_shahr` (
  `id` int(11) NOT NULL COMMENT 'لیست شهر ها',
  `ostan_id` int(11) NOT NULL,
  `name` varchar(35) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tbl_shahr`
--

INSERT INTO `tbl_shahr` (`id`, `ostan_id`, `name`) VALUES
(1, 1, 'مشهد');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sid`
--

CREATE TABLE `tbl_sid` (
  `id` int(11) NOT NULL,
  `sid` text COLLATE utf8mb4_persian_ci NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `adminid` int(11) DEFAULT NULL,
  `emtyaz` int(11) NOT NULL,
  `marhale` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `tbl_sid`
--

INSERT INTO `tbl_sid` (`id`, `sid`, `userid`, `adminid`, `emtyaz`, `marhale`) VALUES
(4, 'asdfsgsfgdhcxbdzxch', NULL, 1, 0, 1),
(5, '347e1c1a704650b5', NULL, 2, 0, 1),
(6, 'e4a647621f8c992c', 1, NULL, 18, 2),
(7, '47e1c1a704650b50', 3, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL COMMENT 'لیست دانش آموزان\nباید بین شماره تلفن یا ایمیل حداقل یک مورد وارد شود',
  `fname` varchar(35) COLLATE utf8_persian_ci NOT NULL,
  `lname` varchar(35) COLLATE utf8_persian_ci NOT NULL,
  `username` varchar(16) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `phone` varchar(11) COLLATE utf8_persian_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `address` text COLLATE utf8_persian_ci DEFAULT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `fname`, `lname`, `username`, `password`, `email`, `phone`, `location`, `address`, `class_id`) VALUES
(1, 'صالح', 'کشاورز', '0928776311', '0928776312', 'adsads', '09334650695', 'sxaas', NULL, 1),
(3, 'محمد', ' کریمی', 'karimi', '123', 'fsgvf', '43554', '', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_useranswer`
--

CREATE TABLE `tbl_useranswer` (
  `id` int(11) NOT NULL COMMENT 'لیست پاسخ های دانش آموزان به سوالات',
  `user_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `quiestion_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tbl_useranswer`
--

INSERT INTO `tbl_useranswer` (`id`, `user_id`, `quiz_id`, `quiestion_id`, `answer_id`) VALUES
(9, 3, 110, 19, 73),
(10, 3, 110, 20, 79),
(11, 3, 111, 69, 31),
(12, 1, 111, 69, 76),
(13, 3, 112, 58, 32),
(14, 1, 119, 2, 5),
(15, 1, 119, 3, 10),
(16, 1, 119, 4, 15),
(17, 1, 119, 5, 18),
(18, 1, 119, 6, 22),
(19, 1, 119, 7, 25),
(20, 1, 119, 9, 35),
(21, 1, 119, 10, 39),
(22, 1, 119, 11, 42),
(23, 1, 119, 12, 46),
(24, 1, 119, 76, 92),
(36, 3, 121, 1, 2),
(37, 1, 120, 1, 2),
(38, 1, 120, 2, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personnel_code` (`personnel_code`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `school_id` (`school_id`,`ismodir`) USING BTREE;

--
-- Indexes for table `tbl_admin_class`
--
ALTER TABLE `tbl_admin_class`
  ADD PRIMARY KEY (`admin_id`,`class_id`),
  ADD KEY `fk_tbl_admin_class_tbl_class` (`class_id`);

--
-- Indexes for table `tbl_admin_question`
--
ALTER TABLE `tbl_admin_question`
  ADD PRIMARY KEY (`admin_id`,`question_id`),
  ADD KEY `fk_tbl_admin_question_tbl_question` (`question_id`);

--
-- Indexes for table `tbl_answer`
--
ALTER TABLE `tbl_answer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_tbl_answer_0` (`question_id`,`text`) USING HASH,
  ADD KEY `fk_tbl_answer_tbl_question` (`question_id`);

--
-- Indexes for table `tbl_class`
--
ALTER TABLE `tbl_class`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `school_id` (`school_id`,`name`),
  ADD KEY `fk_tbl_class_tbl_grade_0` (`grade_id`);

--
-- Indexes for table `tbl_dars`
--
ALTER TABLE `tbl_dars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_tbl_dars` (`name`,`grade_id`),
  ADD KEY `fk_tbl_dars_tbl_grade_0` (`grade_id`);

--
-- Indexes for table `tbl_fasl`
--
ALTER TABLE `tbl_fasl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_fasl_tbl_dars` (`dars_id`);

--
-- Indexes for table `tbl_fixed_scores`
--
ALTER TABLE `tbl_fixed_scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_fixed_scores_tbl_quiz` (`quiz_id`),
  ADD KEY `fk_tbl_fixed_scores_tbl_user` (`user_id`);

--
-- Indexes for table `tbl_grade`
--
ALTER TABLE `tbl_grade`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unq_tbl_grade_id` (`id`),
  ADD UNIQUE KEY `idx_tbl_grade` (`grade`);

--
-- Indexes for table `tbl_ostan`
--
ALTER TABLE `tbl_ostan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_participate`
--
ALTER TABLE `tbl_participate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_participate_tbl_quiz` (`quiz_id`),
  ADD KEY `fk_tbl_participate_tbl_user` (`user_id`);

--
-- Indexes for table `tbl_privacy`
--
ALTER TABLE `tbl_privacy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_privacy_tbl_question` (`question_id`);

--
-- Indexes for table `tbl_question`
--
ALTER TABLE `tbl_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_question_quiz`
--
ALTER TABLE `tbl_question_quiz`
  ADD PRIMARY KEY (`quiz_id`,`question_id`),
  ADD KEY `fk_tbl_question_quiz_tbl_quiz` (`question_id`);

--
-- Indexes for table `tbl_quiz`
--
ALTER TABLE `tbl_quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_quiz_tbl_admin` (`admin_id`),
  ADD KEY `fk_tbl_quiz_tbl_dars` (`fasl_id`);

--
-- Indexes for table `tbl_quiz_class`
--
ALTER TABLE `tbl_quiz_class`
  ADD PRIMARY KEY (`quiz_id`,`class_id`),
  ADD KEY `fk_tbl_quiz_class_tbl_class` (`class_id`);

--
-- Indexes for table `tbl_quiz_user`
--
ALTER TABLE `tbl_quiz_user`
  ADD PRIMARY KEY (`quiz_id`,`user_id`),
  ADD KEY `fk_tbl_quiz_user_tbl_user` (`user_id`);

--
-- Indexes for table `tbl_region`
--
ALTER TABLE `tbl_region`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_tbl_region` (`shahr_id`,`name`),
  ADD KEY `fk_tbl_region_tbl_shahr` (`shahr_id`);

--
-- Indexes for table `tbl_school`
--
ALTER TABLE `tbl_school`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `school_code` (`school_code`,`region_id`),
  ADD KEY `fk_tbl_school_tbl_region` (`region_id`);

--
-- Indexes for table `tbl_shahr`
--
ALTER TABLE `tbl_shahr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_shahr_tbl_ostan_0` (`ostan_id`);

--
-- Indexes for table `tbl_sid`
--
ALTER TABLE `tbl_sid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_sid_tbl_user` (`userid`),
  ADD KEY `fk_tbl_sid_tbl_admin` (`adminid`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fname` (`fname`),
  ADD KEY `fk_tbl_user_tbl_class` (`class_id`);

--
-- Indexes for table `tbl_useranswer`
--
ALTER TABLE `tbl_useranswer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_useranswer_tbl_user_0` (`user_id`),
  ADD KEY `fk_tbl_useranswer_tbl_quiz_0` (`quiz_id`),
  ADD KEY `fk_tbl_useranswer_tbl_answer_0` (`answer_id`),
  ADD KEY `fk_tbl_useranswer_tbl_question_0` (`quiestion_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'لیست مدیر ها و معلمان\nمعلم باید به کلاس ها متصل شود', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_answer`
--
ALTER TABLE `tbl_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'لیست پاسخ ها', AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `tbl_class`
--
ALTER TABLE `tbl_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'لیست کلاس ها', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_dars`
--
ALTER TABLE `tbl_dars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'لیست درس ها \nباید با این فرمت باشد\nریاضی - فنی , فارسی - تجربی', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_fasl`
--
ALTER TABLE `tbl_fasl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_fixed_scores`
--
ALTER TABLE `tbl_fixed_scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_ostan`
--
ALTER TABLE `tbl_ostan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'لیست استان ها', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_participate`
--
ALTER TABLE `tbl_participate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_privacy`
--
ALTER TABLE `tbl_privacy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_question`
--
ALTER TABLE `tbl_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'لیست سوالات', AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `tbl_quiz`
--
ALTER TABLE `tbl_quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'لیست آزمون ها', AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `tbl_region`
--
ALTER TABLE `tbl_region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'لیست نواحی', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_school`
--
ALTER TABLE `tbl_school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'لیست مدارس', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_shahr`
--
ALTER TABLE `tbl_shahr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'لیست شهر ها', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_sid`
--
ALTER TABLE `tbl_sid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'لیست دانش آموزان\nباید بین شماره تلفن یا ایمیل حداقل یک مورد وارد شود', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_useranswer`
--
ALTER TABLE `tbl_useranswer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'لیست پاسخ های دانش آموزان به سوالات', AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD CONSTRAINT `fk_tbl_admin_tbl_school` FOREIGN KEY (`school_id`) REFERENCES `tbl_school` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `tbl_admin_class`
--
ALTER TABLE `tbl_admin_class`
  ADD CONSTRAINT `fk_tbl_admin_class_tbl_admin` FOREIGN KEY (`admin_id`) REFERENCES `tbl_admin` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_admin_class_tbl_class` FOREIGN KEY (`class_id`) REFERENCES `tbl_class` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_admin_question`
--
ALTER TABLE `tbl_admin_question`
  ADD CONSTRAINT `fk_tbl_admin_question_tbl_admin` FOREIGN KEY (`admin_id`) REFERENCES `tbl_admin` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_admin_question_tbl_question` FOREIGN KEY (`question_id`) REFERENCES `tbl_question` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_answer`
--
ALTER TABLE `tbl_answer`
  ADD CONSTRAINT `fk_tbl_answer_tbl_question` FOREIGN KEY (`question_id`) REFERENCES `tbl_question` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_class`
--
ALTER TABLE `tbl_class`
  ADD CONSTRAINT `fk_tbl_class_tbl_grade_0` FOREIGN KEY (`grade_id`) REFERENCES `tbl_grade` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_class_tbl_school` FOREIGN KEY (`school_id`) REFERENCES `tbl_school` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_dars`
--
ALTER TABLE `tbl_dars`
  ADD CONSTRAINT `fk_tbl_dars_tbl_grade_0` FOREIGN KEY (`grade_id`) REFERENCES `tbl_grade` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_fasl`
--
ALTER TABLE `tbl_fasl`
  ADD CONSTRAINT `fk_tbl_fasl_tbl_dars` FOREIGN KEY (`dars_id`) REFERENCES `tbl_dars` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_fixed_scores`
--
ALTER TABLE `tbl_fixed_scores`
  ADD CONSTRAINT `fk_tbl_fixed_scores_tbl_quiz` FOREIGN KEY (`quiz_id`) REFERENCES `tbl_quiz` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_fixed_scores_tbl_user` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_participate`
--
ALTER TABLE `tbl_participate`
  ADD CONSTRAINT `fk_tbl_participate_tbl_quiz` FOREIGN KEY (`quiz_id`) REFERENCES `tbl_quiz` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_participate_tbl_user` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_privacy`
--
ALTER TABLE `tbl_privacy`
  ADD CONSTRAINT `fk_tbl_privacy_tbl_question` FOREIGN KEY (`question_id`) REFERENCES `tbl_question` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_question_quiz`
--
ALTER TABLE `tbl_question_quiz`
  ADD CONSTRAINT `fk_tbl_question_quiz_tbl_question_0` FOREIGN KEY (`question_id`) REFERENCES `tbl_question` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_question_quiz_tbl_quiz` FOREIGN KEY (`quiz_id`) REFERENCES `tbl_quiz` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_quiz`
--
ALTER TABLE `tbl_quiz`
  ADD CONSTRAINT `fk_tbl_quiz_tbl_admin` FOREIGN KEY (`admin_id`) REFERENCES `tbl_admin` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_quiz_tbl_fasl` FOREIGN KEY (`fasl_id`) REFERENCES `tbl_fasl` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_quiz_class`
--
ALTER TABLE `tbl_quiz_class`
  ADD CONSTRAINT `fk_tbl_quiz_class_tbl_class` FOREIGN KEY (`class_id`) REFERENCES `tbl_class` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_quiz_class_tbl_quiz` FOREIGN KEY (`quiz_id`) REFERENCES `tbl_quiz` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_quiz_user`
--
ALTER TABLE `tbl_quiz_user`
  ADD CONSTRAINT `fk_tbl_quiz_user_tbl_quiz` FOREIGN KEY (`quiz_id`) REFERENCES `tbl_quiz` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_quiz_user_tbl_user` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_region`
--
ALTER TABLE `tbl_region`
  ADD CONSTRAINT `fk_tbl_region_tbl_shahr` FOREIGN KEY (`shahr_id`) REFERENCES `tbl_shahr` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_school`
--
ALTER TABLE `tbl_school`
  ADD CONSTRAINT `fk_tbl_school_tbl_region` FOREIGN KEY (`region_id`) REFERENCES `tbl_region` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_shahr`
--
ALTER TABLE `tbl_shahr`
  ADD CONSTRAINT `fk_tbl_shahr_tbl_ostan_0` FOREIGN KEY (`ostan_id`) REFERENCES `tbl_ostan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_sid`
--
ALTER TABLE `tbl_sid`
  ADD CONSTRAINT `fk_tbl_sid_tbl_admin` FOREIGN KEY (`adminid`) REFERENCES `tbl_admin` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_sid_tbl_user` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `fk_tbl_user_tbl_class` FOREIGN KEY (`class_id`) REFERENCES `tbl_class` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_useranswer`
--
ALTER TABLE `tbl_useranswer`
  ADD CONSTRAINT `fk_tbl_useranswer_tbl_answer_0` FOREIGN KEY (`answer_id`) REFERENCES `tbl_answer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_useranswer_tbl_question_0` FOREIGN KEY (`quiestion_id`) REFERENCES `tbl_question` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_useranswer_tbl_quiz_0` FOREIGN KEY (`quiz_id`) REFERENCES `tbl_quiz` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tbl_useranswer_tbl_user_0` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
