-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2022 at 02:54 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `canceled_order`
--

CREATE TABLE `canceled_order` (
  `cancel_id` varchar(40) NOT NULL,
  `delivery_id` varchar(60) NOT NULL,
  `cart_number` varchar(60) NOT NULL,
  `username` varchar(150) NOT NULL,
  `full_address` varchar(200) NOT NULL,
  `postal` varchar(200) NOT NULL,
  `sub_total` int(60) NOT NULL,
  `delivery_fee` int(60) NOT NULL,
  `total_price` int(60) NOT NULL,
  `reason` varchar(200) NOT NULL,
  `date_canceled` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `canceled_order`
--

INSERT INTO `canceled_order` (`cancel_id`, `delivery_id`, `cart_number`, `username`, `full_address`, `postal`, `sub_total`, `delivery_fee`, `total_price`, `reason`, `date_canceled`) VALUES
('CNL0001', 'SHP0005', 'CRT0001', 'Sansan', 'Hulo St. 786, Pandi, Bulacan', '3014', 145, 10, 155, 'Found cheaper elsewhere', '2022-04-26 18:03:23'),
('CNL0002', 'SHP0004', 'CRT0001', 'Sansan', 'Hulo St. 786, Pandi, Bulacan', '3014', 2810, 10, 2820, 'Found cheaper elsewhere', '2022-04-26 18:03:27'),
('CNL0003', 'SHP0003', 'CRT0001', 'Sansan', 'Hulo St. 786, Pandi, Bulacan', '3014', 3750, 10, 3760, 'Need to change delivery address', '2022-04-26 18:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` varchar(60) NOT NULL,
  `cart_number` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `product_id` varchar(60) NOT NULL,
  `product_image` varchar(80) NOT NULL,
  `product_title` varchar(60) NOT NULL,
  `product_price` int(60) NOT NULL,
  `quantity` int(50) NOT NULL DEFAULT 1,
  `cart_price` int(100) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `cart_number`, `username`, `product_id`, `product_image`, `product_title`, `product_price`, `quantity`, `cart_price`, `date_added`) VALUES
('CID0001', 'CRT0001', 'Sansan', 'P00001', './assets/images/uploads/PRO-61f74757440385.37473470.png', 'MyGrocery farm - beef brisket', 250, 1, 250, '2022-04-26 20:19:23');

-- --------------------------------------------------------

--
-- Table structure for table `cart_history`
--

CREATE TABLE `cart_history` (
  `primary` int(4) NOT NULL,
  `delivery_id` varchar(60) NOT NULL,
  `cart_number` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `product_id` varchar(80) NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_price` int(60) NOT NULL,
  `quantity` int(60) NOT NULL,
  `cart_price` int(60) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_history`
--

INSERT INTO `cart_history` (`primary`, `delivery_id`, `cart_number`, `username`, `product_id`, `product_image`, `product_title`, `product_price`, `quantity`, `cart_price`, `date_added`) VALUES
(8, 'SHP0002', 'CRT0002', 'Jouie0123', 'P00006', './assets/images/uploads/PRO-61f751c8476837.66102035.png', 'calcheese - cheese wafer', 50, 6, 300, '2022-04-20'),
(9, 'SHP0002', 'CRT0002', 'Jouie0123', 'P00018', './assets/images/uploads/PRO-61f754631edc41.57672780.png', 'cream-o - chocolate-milk cookie', 40, 5, 200, '2022-04-20'),
(43, 'SHP0003', 'CRT0001', 'Sansan', 'P00001', './assets/images/uploads/PRO-61f74757440385.37473470.png', 'MyGrocery farm - beef brisket', 250, 15, 3750, '2022-04-26'),
(44, 'SHP0004', 'CRT0001', 'Sansan', 'P00001', './assets/images/uploads/PRO-61f74757440385.37473470.png', 'MyGrocery farm - beef brisket', 250, 6, 1500, '2022-04-26'),
(45, 'SHP0004', 'CRT0001', 'Sansan', 'P00007', './assets/images/uploads/PRO-61f751e39f9179.58580375.png', 'century tuna - flakes in oil', 60, 7, 420, '2022-04-26'),
(46, 'SHP0004', 'CRT0001', 'Sansan', 'P00005', './assets/images/uploads/PRO-61f751a193fd01.89048549.png', 'gardenia - classic white bread', 80, 8, 640, '2022-04-26'),
(47, 'SHP0004', 'CRT0001', 'Sansan', 'P00009', './assets/images/uploads/PRO-61f75285c3df61.20491806.png', 'cheez whiz -  pimiento', 50, 5, 250, '2022-04-26'),
(48, 'SHP0005', 'CRT0001', 'Sansan', 'P00003', './assets/images/uploads/PRO-61f747b2057d45.37543458.png', 'argentina - beef loaf', 29, 5, 145, '2022-04-26'),
(49, 'SHP0003', 'CRT0001', 'Sansan', 'P00001', './assets/images/uploads/PRO-61f74757440385.37473470.png', 'MyGrocery farm - beef brisket', 250, 5, 1250, '2022-04-26');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `username` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `cart_number` varchar(60) NOT NULL,
  `gender` varchar(60) NOT NULL,
  `date_of_birth` varchar(60) NOT NULL,
  `civil_status` varchar(50) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `postal` varchar(30) NOT NULL,
  `street` varchar(150) NOT NULL,
  `barangay` varchar(60) NOT NULL,
  `city_municipal` varchar(255) NOT NULL,
  `province` varchar(100) NOT NULL,
  `display` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`username`, `email`, `firstname`, `lastname`, `cart_number`, `gender`, `date_of_birth`, `civil_status`, `contact_number`, `postal`, `street`, `barangay`, `city_municipal`, `province`, `display`) VALUES
('Jouie0123', 'jouiefajardo.15@gmail.com', 'Jouie', 'Fajardo', 'CRT0002', 'Male', '2022-04-13', 'Single', '09971882635', '3023', 'Blk. 1, Ph1, Lot 20, S8, P-2000', 'Muzon', 'City Of San Jose Del Monte', 'Bulacan', '../assets/images/customers_dp/default-male.jpeg'),
('Natnat', 'Natnat@gmail.com', '', '', 'CRT0003', 'Female', '', '', '', '', '', '', '', '', '../assets/images/customers_dp/default-female.png'),
('Sansan', 'shunngerold17@gmail.com', 'Shunn Gerold', 'Villagonza', 'CRT0001', 'Male', '2022-04-10', 'Single', '09971882635', '3014', 'Hulo St. 786', 'Bagong Barrio', 'Pandi', 'Bulacan', '../assets/images/customers_dp/Sansan.png'),
('Sansan12', 'shunngerold@yahoo.com', '', '', 'CRT0004', 'Male', '', '', '', '', '', '', '', '', '../assets/images/customers_dp/default-male.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_id` varchar(60) NOT NULL,
  `cart_number` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `full_address` varchar(200) NOT NULL,
  `postal` int(60) NOT NULL,
  `sub_total` int(60) NOT NULL,
  `delivery_fee` int(60) NOT NULL,
  `total_price` int(60) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `delivery_status` varchar(100) DEFAULT 'to_pay'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`delivery_id`, `cart_number`, `username`, `full_address`, `postal`, `sub_total`, `delivery_fee`, `total_price`, `order_date`, `delivery_status`) VALUES
('SHP0002', 'CRT0002', 'Jouie0123', 'Blk. 1, Ph1, Lot 20, S8, P-2000, City Of San Jose Del Monte, Bulacan', 3023, 500, 35, 570, '2022-04-20 20:48:56', 'to_pay'),
('SHP0003', 'CRT0001', 'Sansan', 'Hulo St. 786, Pandi, Bulacan', 3014, 1250, 10, 1260, '2022-04-26 19:08:23', 'to_pay');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `zip` int(4) NOT NULL,
  `city_municipal` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `distance_km` int(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`zip`, `city_municipal`, `province`, `distance_km`) VALUES
(1000, 'Manila CPO – Ermita', 'Metro Manila', 37),
(1001, 'Quiapo', 'Metro Manila', 36),
(1002, 'Intramuros', 'Metro Manila', 41),
(1003, 'Sta. Cruz South', 'Metro Manila', 33),
(1004, 'Malate', 'Metro Manila', 39),
(1005, 'San Miguel', 'Metro Manila', 46),
(1007, 'Paco', 'Metro Manila', 37),
(1008, 'Sampaloc East', 'Metro Manila', 34),
(1009, 'Sta. Ana', 'Metro Manila', 39),
(1010, 'San Nicolas', 'Metro Manila', 40),
(1011, 'Pandacan', 'Metro Manila', 37),
(1012, 'Tondo South', 'Metro Manila', 38),
(1013, 'Tondo North', 'Metro Manila', 38),
(1014, 'Sta. Cruz North', 'Metro Manila', 33),
(1015, 'Sampaloc West', 'Metro Manila', 34),
(1016, 'Sta. Mesa', 'Metro Manila', 37),
(1017, 'San Andres Bukid', 'Metro Manila', 39),
(1018, 'Port Area (South)', 'Metro Manila', 41),
(3000, 'City of Malolos', 'Bulacan', 22),
(3001, 'Paombong', 'Bulacan', 29),
(3002, 'Hagonoy', 'Bulacan', 37),
(3003, 'Calumpit', 'Bulacan', 28),
(3004, 'Plaridel', 'Bulacan', 11),
(3005, 'Pulilan', 'Bulacan', 19),
(3006, 'Baliuag', 'Bulacan', 16),
(3007, 'Bustos', 'Bulacan', 9),
(3008, 'San Rafael', 'Bulacan', 18),
(3010, 'San Ildefonso', 'Bulacan', 34),
(3011, 'San Miguel', 'Bulacan', 42),
(3012, 'Angat', 'Bulacan', 13),
(3013, 'Norzagaray', 'Bulacan', 30),
(3014, 'Pandi', 'Bulacan', 0),
(3015, 'Guiguinto', 'Bulacan', 12),
(3016, 'Balagtas', 'Bulacan', 12),
(3017, 'Bulacan', 'Bulacan', 16),
(3018, 'Bocaue', 'Bulacan', 13),
(3019, 'Marilao', 'Bulacan', 21),
(3020, 'City of Meycauayan', 'Bulacan', 18),
(3021, 'Obando', 'Bulacan', 26),
(3022, 'Santa Maria', 'Bulacan', 9),
(3023, 'City of San Jose del Monte', 'Bulacan', 22);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notif_id` int(11) NOT NULL,
  `msg_from` varchar(60) NOT NULL,
  `msg_to` varchar(60) NOT NULL,
  `message` varchar(200) NOT NULL,
  `date_issued` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` varchar(60) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `stock_number` int(255) NOT NULL,
  `expiry_date` varchar(255) NOT NULL,
  `price` int(60) NOT NULL DEFAULT 0,
  `kilo_pcs_pack` varchar(200) NOT NULL,
  `category` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL,
  `stock_type` int(1) NOT NULL COMMENT '1 = new, 0 = old',
  `images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_title`, `stock_number`, `expiry_date`, `price`, `kilo_pcs_pack`, `category`, `description`, `stock_type`, `images`) VALUES
('P00001', 'MyGrocery farm - beef brisket', 506, '2022-03-15', 250, '1 kilo', 'meats and poultry', 'Fresh from the morning wet market. Perfect for all beef dishes.', 0, './assets/images/uploads/PRO-61f74757440385.37473470.png'),
('P00002', 'MyGrocery farm - beef giniling', 519, '2022-03-15', 230, '1 kilo', 'meats and poultry', 'Fresh ground beef from the morning wet market. Perfect for making burger patties or ground beef meat dishes.', 0, './assets/images/uploads/PRO-61f7476ec761a6.37890024.png'),
('P00003', 'argentina - beef loaf', 5, '2023-07-30', 29, '1 pc', 'canned products', 'Beef loaf can refer to several types of loaves made with beef, when made with ground beef.', 0, './assets/images/uploads/PRO-61f747b2057d45.37543458.png'),
('P00004', 'MyGrocery farm - beef shank', 6, '2022-03-15', 240, '1 kilo', 'meats and poultry', 'Beef shank is the leg portion of a steer or heifer.', 0, './assets/images/uploads/PRO-61f747cdbf1a97.41076652.png'),
('P00005', 'gardenia - classic white bread', 508, '2022-03-17', 80, '1 pack', 'breads and spreads', 'it is a kind of bread which contains vitamins A and B complex, minerals like iron, iodine and calcium they need for good eyesight and strong bones and teeth. ', 0, './assets/images/uploads/PRO-61f751a193fd01.89048549.png'),
('P00006', 'calcheese - cheese wafer', 553, '2022-08-18', 50, '1 pack', 'snacks and chips', 'Its a new cheese wafer biscuit made from real cheddar cheese and milk and a great source of calcium and vitamins A, B1, B2, B6, and B12. ', 0, './assets/images/uploads/PRO-61f751c8476837.66102035.png'),
('P00007', 'century tuna - flakes in oil', 127, '2022-01-12', 60, '1 pc', 'canned products', 'A classic, all-time favorite made with real and healthy meat. It is made from large tuna flakes and has Omega 3 DHA that is good for the heart and mind.', 0, './assets/images/uploads/PRO-61f751e39f9179.58580375.png'),
('P00008', 'century tuna big - flakes in vegetable oil', 555, '2023-11-23', 50, '1 pc', 'canned products', 'A classic, all-time favorite made with real and healthy meat. It is made from large tuna flakes and has Omega 3 DHA that is good for the heart and mind.', 0, './assets/images/uploads/PRO-61f75224014197.65169996.png'),
('P00009', 'cheez whiz -  pimiento', 500, '2023-11-30', 50, '1 pc', 'breads and spreads', 'Pimiento is a spreadable cheese spread with sweet peppers. This is more of a sandwich spread rather than a dip. ', 0, './assets/images/uploads/PRO-61f75285c3df61.20491806.png'),
('P00010', 'MyGrocery farm - chicken drum', 500, '2022-03-16', 150, '1 kilo', 'meats and poultry', 'Chicken drum is the lower, meaty leg portion of the chicken.', 0, './assets/images/uploads/PRO-61f752d730f403.90264415.png'),
('P00011', 'MyGrocery farm - chicken wings', 500, '2022-03-15', 160, '1 kilo', 'meats and poultry', 'Chicken wings are white meat, even though they\'re juicier and have a more concentrated poultry flavor, like dark meat.', 0, './assets/images/uploads/PRO-61f752f0a22f54.85026391.png'),
('P00012', 'chips ahoy - original ', 400, '2023-03-15', 12, '1 pack', 'snacks and chips', 'Chips ahoy cookies are packed with chocolate chips baked into every bite.', 0, './assets/images/uploads/PRO-61f75364eab440.07083892.png'),
('P00013', 'cheez whiz original', 504, '2023-07-30', 70, '1 pc', 'breads and spreads', 'Cheez whiz orig is a processed cheese spread used commonly for crackers and sandwiches, and melted for use as a dip or sauce.', 0, './assets/images/uploads/PRO-61f7539c900ea7.38455005.png'),
('P00014', 'leslies - clover chips', 495, '2022-07-30', 6, '1 pc', 'snacks and chips', 'Clover these are small, thin, shell-shaped chips made from a corn dough, with a good, tangy cheese flavoring.', 0, './assets/images/uploads/PRO-61f753bad38f87.33406500.png'),
('P00015', 'monde - butter coconut biscuit', 500, '2022-11-16', 14, '1 pack', 'snacks and chips', 'Coco butter a crisp, sweet cracker with coconut flavor.', 0, './assets/images/uploads/PRO-61f753dc5d8713.91350808.png'),
('P00016', 'argentina corned beef', 523, '2024-03-30', 29, '1 pc', 'canned products', 'Corned beef is meat that has been cured in a salt solution. ', 0, './assets/images/uploads/PRO-61f75418ee0558.21209197.png'),
('P00017', 'argentina - corned beef big', 499, '2024-03-18', 39, '1 pc', 'canned products', 'Corned beef is meat that has been cured in a salt solution. ', 0, './assets/images/uploads/PRO-61f754470ec3e4.32029283.png'),
('P00018', 'cream-o - chocolate-milk cookie', 545, '2022-07-20', 40, '1 pack', 'snacks and chips', 'Cream o soft chocolate cookies filled with chocolate flavored cream.', 0, './assets/images/uploads/PRO-61f754631edc41.57672780.png'),
('P00019', 'dingdong - mixed nuts', 500, '2023-06-30', 29, '1 pack', 'snacks and chips', 'Dingdong a fun medley of greaseless peanuts, corn bits, green peas, corn chips and curls, it has everything you want in a snack pack. ', 0, './assets/images/uploads/PRO-61f754fc9b7a65.22918548.png'),
('P00020', 'dorito - nacho cheese', 500, '2023-03-30', 39, '1 pc', 'snacks and chips', 'Dorito is an American brand of flavored tortilla chips. ', 0, './assets/images/uploads/PRO-61f755110abc27.40868435.png'),
('P00021', 'eggnog - cookies', 500, '2023-07-30', 29, '1 pack', 'snacks and chips', 'Eggnog cookies rich with egg and nutmeg.', 0, './assets/images/uploads/PRO-61f75527747080.65590406.png'),
('P00022', 'fita - crakers', 500, '2023-03-30', 29, '1 pack', 'snacks and chips', 'Fita crackers are round biscuits that is individually wrapped.', 0, './assets/images/uploads/PRO-61f7553ec99cf4.17491023.png'),
('P00023', 'fudgee bar - milk chocolate cake', 500, '2023-02-21', 49, '1 pack', 'snacks and chips', 'Fudgeebar it is a bar of fudge in a semi-circular cross-section covered in a layer of milk chocolate.', 0, './assets/images/uploads/PRO-61f75564595ea6.94465183.png'),
('P00024', 'gardenia - wheat loaf bread', 500, '2023-02-28', 70, '1 pack', 'breads and spreads', 'Gardenia wheat high fiber whole wheat bread.', 0, './assets/images/uploads/PRO-61f7557ce2d6d5.79214336.png'),
('P00025', 'hello panda - chocolate cookie', 500, '2023-07-18', 10, '1 pack', 'snacks and chips', 'Hello panda each biscuit consists of a small hollow shortbread layer, filled with crème of various flavors.', 0, './assets/images/uploads/PRO-61f75595744af2.91662171.png'),
('P00026', 'ligo - sardines green', 500, '2023-08-30', 19, '1 pc', 'canned products', 'Ligo green a good quality sardine, better in taste, texture and quantity. ', 0, './assets/images/uploads/PRO-61f755cd6c3bf7.29726129.png'),
('P00027', 'ligo -  sardines red', 500, '2023-11-30', 19, '1 pc', 'canned products', 'Ligo red tomato sauce chili added is well-known for its excellent taste worldwide.', 0, './assets/images/uploads/PRO-61f755e6a29a59.76824676.png'),
('P00028', 'lucky me mami - beef na beef', 498, '2023-07-24', 8, '1 pc', 'packed noodles', 'Lucky me beef instant noodles beef lets you experience noodle goodness that captures the true taste of beef.', 0, './assets/images/uploads/PRO-61f7560ac413d3.48079981.png'),
('P00029', 'lucky me mami - chicken na chicken', 498, '2023-10-23', 8, '1 pc', 'packed noodles', 'Lucky me chicken instant noodles chicken lets you experience noodle goodness that captures the true taste of chicken.', 0, './assets/images/uploads/PRO-61f756261c12c9.73128091.png'),
('P00030', 'lucky me mami - spicy labuyo beef', 500, '2023-10-23', 8, '1 pc', 'packed noodles', 'Lucky me spicy beef spicy beef flavor instant noodles.', 0, './assets/images/uploads/PRO-61f7564327c330.35960976.png'),
('P00031', 'argentina - meat loaf', 500, '2023-11-30', 19, '1 pc', 'canned products', 'Meatloaf is a dish of ground meat that has been combined with other ingredients and formed into the shape of a loaf, then baked or smoked. ', 0, './assets/images/uploads/PRO-61f75663b2efc9.40657302.png'),
('P00032', 'monde - classic mamon', 500, '2022-11-30', 19, '1 pack', 'snacks and chips', 'Monde classic mamon delicious classic sponge cake.', 0, './assets/images/uploads/PRO-61f7567f38e470.04338077.png'),
('P00033', 'payless - xtra big pancit canton', 499, '2023-10-23', 10, '1 pc', 'packed noodles', 'Xtra big pancit canton the noodles are chewy and the flavoring coasts nice and has a sweet and salty taste. ', 0, './assets/images/uploads/PRO-61f756a5dccf23.35344324.png'),
('P00034', 'nutella ferrero - chocolate spread', 502, '2023-06-20', 59, '1 pc', 'breads and spreads', 'Nutella is a sweetened hazelnut cocoa spread.', 0, './assets/images/uploads/PRO-61f756b8d95257.67050485.png'),
('P00035', 'lucky me big - pancit canton extra hot chili', 500, '2023-10-30', 8, '1 pc', 'packed noodles', 'Chilli pancit canton noodles have the typical flavor of the savory filipino national dish and are especially for spicy food lovers. ', 0, './assets/images/uploads/PRO-61f756db82e636.64853615.png'),
('P00036', 'lucky me - pancit canton chilli mansi', 500, '2023-10-30', 8, '1 pc', 'packed noodles', 'Chili-mansi pancit canton noodles are simply instant ramen noodles cooked down and then coated in a savoury, spicy, slightly sweet sauce with that nice kick of acidity and tang from the calamansi juice.', 0, './assets/images/uploads/PRO-61f756fcec8df3.13897547.png'),
('P00037', 'lucky me - pancit canton original', 500, '2023-10-23', 8, '1 pc', 'packed noodles', 'Original pancit canton captures the tast of traditional pancit canton, with the rich flavors of sauteed onion, garlic, and savory chicken.', 0, './assets/images/uploads/PRO-61f7627cef4d35.77108650.png'),
('P00038', 'lucky me - pancit canton sweet n spicy', 500, '2023-10-23', 8, '1 pc', 'packed noodles', 'Sweet and spicy pansit canton an exciting mix of sweet soy sauce and mild chili. If you\\\'re looking for just the right level of spiciness, then sweet & spicy is for you this flavor offers a sweet soy sauce taste with a hint of spiciness.', 0, './assets/images/uploads/PRO-61f762a64de506.40017939.png'),
('P00039', 'jack n jill - piatos cheese', 500, '2023-02-28', 12, '1 pc', 'snacks and chips', 'Piatos cheese cheese flavored potato crisps.  These chips are light and crispy and packed with cheese flavor.  ', 0, './assets/images/uploads/PRO-61f762cfa501c3.90004358.png'),
('P00040', 'jack n jill - piatos bbq', 500, '2023-06-21', 12, '1 pc', 'snacks and chips', 'Piatos bbq barbeque potato crisps.These chips are light and crispy and packed with barbeque flavor.  ', 0, './assets/images/uploads/PRO-61f76320b97a23.44087957.png'),
('P00041', 'oishi - pillows choco-filled crackers', 500, '2023-02-20', 8, '1 pc', 'snacks and chips', 'Pillows crunchy crackers bursting with yummy chocolate filling. ', 0, './assets/images/uploads/PRO-61f76372185a91.63171292.png'),
('P00043', 'MyGrocery farm - pork chop', 500, '2022-03-16', 160, '1 kilo', 'meats and poultry', 'Pork chop is a small piece of meat cut from the ribs of a pig.', 0, './assets/images/uploads/PRO-61f763db2033d8.09564120.png'),
('P00044', 'MyGrocery farm - pork giniling', 500, '2022-03-16', 130, '1 kilo', 'meats and poultry', 'Freshly made from the morning wet market. Ground pork is used for making shanghai wraps and other filipino dishes.', 0, './assets/images/uploads/PRO-61f763f2923628.06737662.png'),
('P00045', 'MyGrocery farm - pork pata', 500, '2022-03-23', 220, '1 kilo', 'meats and poultry', 'Fresh Pata cuts from the morning wet market. This part is the Pork\\\'s leg. It\\\'s perfect for making the traditional Filipino dish Crispy Pata.', 0, './assets/images/uploads/PRO-61f7640a680876.68208689.png'),
('P00046', 'MyGrocery farm - banana', 499, '2022-03-09', 70, '1 kilo', 'fresh fruits and veggies', 'Banana is a curved, yellow fruit with a thick skin and soft sweet flesh.', 0, './assets/images/uploads/PRO-61f764274c61d4.90233832.png'),
('P00047', 'MyGrocery farm - tomato', 500, '2022-03-16', 30, '1 kilo', 'fresh fruits and veggies', 'Tomato they are usually red, scarlet, or yellow, though green and purple varieties do exist, and they vary in shape from almost spherical to oval and elongate to pear-shaped.Each fruit contains at least two cells of small seeds surrounded by jellylike pul', 0, './assets/images/uploads/PRO-61f7643c15aa25.71428378.png'),
('P00048', 'MyGrocery farm - orange', 499, '2022-03-16', 60, '1 kilo', 'fresh fruits and veggies', 'Orange a globose berry with a yellowish to reddish-orange rind and a sweet edible pulp.', 0, './assets/images/uploads/PRO-61f76450584aa7.02951513.png'),
('P00050', 'MyGrocery farm - grapes', 500, '2022-03-16', 80, '1 kilo', 'fresh fruits and veggies', 'Grapes are fleshy, rounded fruits that grow in clusters made up of many fruits of greenish, yellowish or purple skin. The pulp is juicy and sweet, and it contain several seeds or pips.', 0, './assets/images/uploads/PRO-61f764bc6ba055.83293267.png'),
('P00051', 'imported from USA - almonds', 500, '2022-03-16', 250, '1 kilo', 'fresh fruits and veggies', 'Almonds is the edible kernel of the fruit of the sweet almond tree. It is consumed as dry fruit, fried and/or salted.', 0, './assets/images/uploads/PRO-61f764d31f5287.19894474.png'),
('P00052', 'MyGrocery farm - apples', 500, '2022-03-16', 60, '1 kilo', 'fresh fruits and veggies', 'Apple is a pome fleshy fruit, in which the ripened ovary and surrounding tissue both become fleshy and edible. ', 0, './assets/images/uploads/PRO-61f764e511ed44.86403898.png'),
('P00053', 'MyGrocery farm - butter', 502, '2022-03-16', 60, '1 pc', 'breads and spreads', 'Butter a yellow-to-white solid emulsion of fat globules, water, and inorganic salts produced by churning the cream from cows\\\' milk. ', 0, './assets/images/uploads/PRO-61f764fea97ae5.26714059.png'),
('P00054', 'MyGrocery farm - carrots', 500, '2022-03-16', 60, '1 kilo', 'fresh fruits and veggies', 'Perfect for Chopseuy and other vegetable dishes. Carrots are a good source of beta carotene.', 0, './assets/images/uploads/PRO-61f765116d2550.41630594.png'),
('P00055', 'hansel chocolate sandwich - cream-filled biscuits', 500, '2022-11-21', 49, '1 pack', 'snacks and chips', 'Hansel Choco sandwich is the best biscuit sandwich snack for those who prefer soft-crunch biscuits. Its salty-sweet taste and distinct aroma create a unique, delicious cookie sandwich and flavor chocolate.', 0, './assets/images/uploads/PRO-61f765279ac210.40088011.png'),
('P00056', 'rebisco crackers', 500, '2022-11-30', 19, '1 pack', 'snacks and chips', 'Rebisco crackers garlic flavored crackers that are a treat for healthy snackers. Crunchy crackers flavored with honey and butter, with a sprinkling of sugar on top.', 0, './assets/images/uploads/PRO-61f7654982ed27.94066744.png'),
('P00057', 'hansel mocha sandwich - cream-filled biscuits', 500, '2022-03-08', 19, '1 pack', 'snacks and chips', 'Hansel mocha sandwich is the best biscuit sandwich snack for those who prefer soft-crunch biscuits. Its salty-sweet taste and distinct aroma create a unique, delicious cookie sandwich and flavor mocha.', 0, './assets/images/uploads/PRO-61f76565bbe621.02512070.png'),
('P00058', 'jack n jill - roller coaster potato rings', 500, '2023-07-17', 8, '1 pc', 'snacks and chips', 'Roller Coaster is a fabricated Potato Chip with ring shape, that turns an ordinary activity like snacking into a fun and playful experience.', 0, './assets/images/uploads/PRO-61f76578210388.86894905.png'),
('P00059', 'samyang cheese - hot chicken flavor ramen', 500, '2023-03-15', 10, '1 pc', 'packed noodles', 'Samyang hot chicken flavor ramen.', 0, './assets/images/uploads/PRO-61f765909c3c79.08311315.png'),
('P00060', 'M.Y san - sky flakes crackers', 500, '2022-04-21', 19, '1 pack', 'snacks and chips', 'Skyflakes its crisp taste and retention of oven-baked biscuit freshness.', 0, './assets/images/uploads/PRO-61f765ae266ce0.82133274.png'),
('P00061', 'spam big - fully cooked luncheon meat', 500, '2023-08-30', 60, '1 pc', 'canned products', 'Spam big is a brand of canned cooked pork.', 0, './assets/images/uploads/PRO-61f765c81ceaf1.89577514.png'),
('P00062', 'magnolia - star margarine classic', 500, '2023-03-14', 40, '1 pc', 'breads and spreads', 'Star margarine non refrigerated margarine made from a special blend of refined oils. ', 0, './assets/images/uploads/PRO-61f765dec8fc85.73166934.png'),
('P00063', 'jack n jill - vcut spicy bbq (Party pack)', 500, '2023-03-30', 12, '1 pc', 'snacks and chips', 'Vcut potato chips onion garlic flavor is a rump chips from the Philippines with a delicious onion, garlic flavor. ', 0, './assets/images/uploads/PRO-61f765f1376cd2.34478920.png'),
('P00064', 'MyGrocery farm - whole chicken', 499, '2022-03-22', 150, '1 kilo', 'meats and poultry', 'Whole chicken with all parts intact, generally including the giblets stuffed in the cavity. ', 0, './assets/images/uploads/PRO-61f766041e8141.28822180.png'),
('P00067', 'best foods - peanut spreads', 500, '2023-05-24', 20, '1 pc', 'breads and spreads', 'Peanut butter also contains omega-6. This fatty acid lowers bad (LDL) cholesterol and increases protective (HDL) cholesterol. ', 0, './assets/images/uploads/default-product-image.png'),
('P00068', 'ladys choice  - creamy peanut butter', 500, '2023-05-24', 20, '1 pc', 'breads and spreads', 'Peanut butter also contains omega-6. This fatty acid lowers bad (LDL) cholesterol and increases protective (HDL) cholesterol. ', 0, './assets/images/uploads/default-product-image.png'),
('P00069', 'MyGrocery Farm - Strawberry', 500, '2023-05-22', 70, '1 kg', 'fruits and veggies', 'Packed with vitamins, fiber, and particularly high levels of antioxidants known as polyphenols, strawberries are a sodium-free, fat-free, cholesterol-free, low-calorie food.', 0, './assets/images/uploads/default-product-image.png'),
('P00070', 'monde - Special Mamon Classic', 500, '2023-05-23', 8, '1 pack', 'snacks and chips', 'Available in classic and mocha flavors and made from real fresh eggs and imported wheat flour and milk, each uniquely Pinoy creation is fluffy, moist and light, with just the right amount of sweetness that makes it the ideal every day snack or treat.', 0, './assets/images/uploads/default-product-image.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `auth` int(1) NOT NULL DEFAULT 0 COMMENT '1 = true',
  `verify_email` int(1) NOT NULL DEFAULT 0,
  `code` int(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `password`, `role`, `auth`, `verify_email`, `code`) VALUES
('admin', 'mygrocery.customersurvey@gmail.com', '$2y$10$QOJGKBGD86Arln2QwSZRcOXm77mL2OgeYSn42slIlCK2465reAqB2', 'admin', 0, 1, 141512),
('Admin2', 'shunngerold@gmail.com', '$2y$10$YDel1AshXfDyiSiOkZ0CAe8oq5DHK0MxYuJVCcCgspm6noOBLlwo6', 'admin', 1, 1, 0),
('Jouie0123', 'jouiefajardo.15@gmail.com', '$2y$10$vd5cbGS7OuAIZXMz226VPegJrJpokJZK31GMEMkXfdOlropErnKVe', 'user', 0, 1, 191428),
('Sansan', 'shunngerold17@gmail.com', '$2y$10$6sU4CPISdlbvsUfAoW/4Cur4WBkZgE4mOk5jh28teuVp/r2mNarSO', 'user', 0, 1, 121117),
('Sansan12', 'shunngerold@yahoo.com', '$2y$10$E3cuoyMIOYLA.bPh/nw4YezAT7bsT3obe3BqzSmeJ/1G0BpDR30Ju', 'user', 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `canceled_order`
--
ALTER TABLE `canceled_order`
  ADD PRIMARY KEY (`cancel_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `cart_history`
--
ALTER TABLE `cart_history`
  ADD PRIMARY KEY (`primary`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`zip`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_history`
--
ALTER TABLE `cart_history`
  MODIFY `primary` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
