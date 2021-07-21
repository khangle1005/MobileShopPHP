-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 28, 2020 lúc 11:29 AM
-- Phiên bản máy phục vụ: 10.4.13-MariaDB
-- Phiên bản PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ecommerce`
--

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getcat` (IN `cid` INT)  SELECT * FROM categories WHERE cat_id=cid$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_info`
--

CREATE TABLE `admin_info` (
  `admin_id` int(10) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(300) NOT NULL,
  `admin_password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `admin_info`
--

INSERT INTO `admin_info` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'admin', 'admin@gmail.com', '25f9e794323b453885f5181f1b624d0b');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(100) NOT NULL,
  `brand_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'HP'),
(2, 'Samsung'),
(3, 'Apple'),
(4, 'motorolla'),
(5, 'LG'),
(6, 'Acer\r\n'),
(7, 'Dell');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Electronics'),
(6, 'Home Appliances'),
(7, 'Electronics Gadgets');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `email_info`
--

CREATE TABLE `email_info` (
  `email_id` int(100) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `email_info`
--

INSERT INTO `email_info` (`email_id`, `email`) VALUES
(3, 'admin@gmail.com'),
(4, 'puneethreddy951@gmail.com'),
(5, 'puneethreddy@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `order_date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `paid_status` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `quantity`, `total`, `paid_status`, `status`) VALUES
(35, 12, '2020-12-26', 2, 1000024, 0, 1),
(36, 12, '2020-12-26', 3, 90000, 0, 1),
(37, 12, '2020-12-26', 4, 650012, 0, 1),
(40, 12, '2020-12-28', 2, 36490, 0, 1),
(41, 12, '2020-12-28', 2, 36490, 0, 0),
(42, 12, '2020-12-28', 1, 250001, 0, 0),
(43, 12, '2020-12-28', 2, 500002, 0, 0),
(44, 12, '2020-12-28', 1, 250001, 0, 0),
(45, 37, '2020-12-28', 3, 540002, 0, 0),
(46, 12, '2020-12-28', 2, 5200000, 0, 0);

--
-- Bẫy `orders`
--
DELIMITER $$
CREATE TRIGGER `trigger_currentdate` BEFORE INSERT ON `orders` FOR EACH ROW SET NEW.order_date=CURDATE()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_info`
--

CREATE TABLE `order_info` (
  `order_info_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `note` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `order_info`
--

INSERT INTO `order_info` (`order_info_id`, `order_id`, `user_id`, `name`, `phone`, `email`, `address`, `note`) VALUES
(32, 35, 12, 'Khang Lê', '123145', 'lephuckhang@gmail.com', 'dia chi', '11'),
(33, 36, 12, 'Khang Lê', '123145', 'lephuckhang@gmail.com', 'dia chi', '111'),
(34, 37, 12, 'Khang Lê', '123145', 'lephuckhang@gmail.com', 'dia chi', 'moi nhat'),
(37, 40, 12, 'Lê Khang', '9448121558', 'lephuckhang1005@gmail.com', 'tphcm', 'alao'),
(38, 41, 12, 'Lê Khang', '9448121558', 'lephuckhang1005@gmail.com', 'tphcm', 'alao'),
(39, 42, 12, 'Lê Khang', '9448121558', 'lephuckhang1005@gmail.com', 'tphcm', '5'),
(40, 43, 12, 'Lê Khang', '9448121558', 'lephuckhang1005@gmail.com', 'tphcm', 'q'),
(41, 44, 12, 'Khang Lê', '123145', 'lephuckhang@gmail.com', 'dia chi', 'd'),
(42, 45, 37, 'phan khoa', '002999', 'pk@gmail.com', 'Nha trang', 'dat hang'),
(43, 46, 12, 'Lê Khang', '9448121558', 'lephuckhang1005@gmail.com', 'tphcm', 'note');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `order_items_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `unit_price`) VALUES
(31, 35, 1, 1, 500012),
(32, 35, 1, 1, 500012),
(34, 36, 3, 3, 90000),
(36, 37, 1, 1, 500012),
(37, 37, 7, 3, 150000),
(41, 40, 72, 1, 3500),
(42, 40, 96, 1, 32990),
(43, 41, 72, 1, 3500),
(44, 41, 96, 1, 32990),
(45, 42, 2, 1, 250001),
(46, 43, 2, 2, 500002),
(47, 44, 2, 1, 250001),
(48, 44, 0, 0, 0),
(49, 45, 2, 2, 500002),
(50, 45, 8, 1, 40000),
(51, 46, 74, 2, 5200000);

--
-- Bẫy `order_items`
--
DELIMITER $$
CREATE TRIGGER `trigger_delete_item` AFTER DELETE ON `order_items` FOR EACH ROW BEGIN
SELECT SUM(quantity) INTO @quan
FROM order_items
WHERE order_id=OLD.order_id;
UPDATE orders SET quantity=@quan WHERE order_id=OLD.order_id;

SELECT SUM(unit_price) INTO @price
FROM order_items
WHERE order_id=OLD.order_id;
UPDATE orders SET total=@price WHERE order_id=OLD.order_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trigger_insert_item` AFTER INSERT ON `order_items` FOR EACH ROW BEGIN
SELECT SUM(quantity) INTO @quan
FROM order_items
WHERE order_id=NEW.order_id;
UPDATE orders SET quantity=@quan WHERE order_id=NEW.order_id;

SELECT SUM(unit_price) INTO @price
FROM order_items
WHERE order_id=NEW.order_id;
UPDATE orders SET total=@price WHERE order_id=NEW.order_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trigger_update_item` AFTER UPDATE ON `order_items` FOR EACH ROW BEGIN
SELECT SUM(quantity) INTO @quan
FROM order_items
WHERE order_id=NEW.order_id;
UPDATE orders SET quantity=@quan WHERE order_id=NEW.order_id;

SELECT SUM(unit_price) INTO @price
FROM order_items
WHERE order_id=NEW.order_id;
UPDATE orders SET total=@price WHERE order_id=NEW.order_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_cat` int(100) NOT NULL,
  `product_brand` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `product_keywords` text NOT NULL,
  `stock` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_keywords`, `stock`) VALUES
(1, 2, 2, 'Samsung galaxy s7 edge', 7500000, 'Samsung galaxy s7 edge', 'product07.png', 'samsung mobile electronics', 49),
(2, 1, 3, 'iPhone 5s', 4000000, 'iphone 5s', 'http___pluspng.com_img-png_iphone-hd-png-iphone-apple-png-file-550.png', 'mobile iphone apple', 44),
(3, 3, 3, 'iPad air 2', 8000000, 'ipad apple brand', 'da4371ffa192a115f922b1c0dff88193.png', 'apple ipad tablet', 50),
(4, 1, 3, 'iPhone 6s', 6000000, 'Apple iPhone ', 'http___pluspng.com_img-png_iphone-6s-png-iphone-6s-gold-64gb-1000.png', 'iphone apple mobile', 50),
(6, 1, 2, 'samsung Laptop r series', 15000000, 'samsung Black combination Laptop', 'laptop_PNG5939.png', 'samsung laptop ', 50),
(7, 1, 1, 'Laptop Pavillion', 14500000, 'Laptop Hp Pavillion', 'laptop_PNG5930.png', 'Laptop Hp Pavillion', 50),
(8, 1, 4, 'Sony', 7600000, 'Sony Mobile', '530201353846AM_635_sony_xperia_z.png', 'sony mobile', 49),
(32, 5, 0, 'Book Shelf', 2500, 'book shelf', 'furniture-book-shelf-250x250.jpg', 'book shelf furniture', 50),
(33, 6, 2, 'Refrigerator', 18500000, 'Refrigerator', 'CT_WM_BTS-BTC-AppliancesHome_20150723.jpg', 'refrigerator samsung', 50),
(34, 6, 4, 'Emergency Light', 500000, 'Emergency Light', 'emergency light.JPG', 'emergency light', 50),
(35, 6, 0, 'Vaccum Cleaner', 60000, 'Vaccum Cleaner', 'may-hut-bui-vacuum-cleaner-jk-2004-1.jpg', 'Vaccum Cleaner', 50),
(36, 6, 5, 'Iron', 400000, 'gj', 'iron.JPG', 'iron', 50),
(37, 6, 5, 'LED TV', 25000000, 'LED TV', 'l37.png', 'led tv lg', 50),
(38, 6, 4, 'Microwave Oven', 15000000, 'Microwave Oven', 'lovisong1.png', 'Microwave Oven', 50),
(39, 6, 5, 'Mixer Grinder', 7000000, 'Mixer Grinder', 'singer-mixer-grinder-mg-46-medium_4bfa018096c25dec7ba0af40662856ef.jpg', 'Mixer Grinder', 50),
(47, 4, 6, 'Laptop', 25000000, 'nbk', 'product01.png', 'Dell Laptop', 50),
(48, 1, 7, 'Headphones', 1250000, 'Headphones', 'product05.png', 'Headphones Sony', 50),
(49, 1, 7, 'Headphones', 2500000, 'Headphones', 'product05.png', 'Headphones Sony', 50),
(71, 1, 2, 'Samsung galaxy s7', 7500000, 'Samsung galaxy s7', 'product07.png', 'samsung mobile electronics', 50),
(72, 7, 2, 'sony Headphones', 2500000, 'sony Headphones', 'product02.png', 'sony Headphones electronics gadgets', 48),
(73, 7, 2, 'samsung Headphones', 3500000, 'samsung Headphones', 'product05.png', 'samsung Headphones electronics gadgets', 50),
(74, 1, 1, 'HP i5 laptop', 2600000, 'HP i5 laptop', 'product01.png', 'HP i5 laptop electronics', 48),
(75, 1, 1, 'HP i7 laptop 8gb ram', 2800000, 'HP i7 laptop 8gb ram', 'product03.png', 'HP i7 laptop 8gb ram electronics', 50),
(76, 1, 5, 'sony note 6gb ram', 9000000, 'sony note 6gb ram', 'product04.png', 'sony note 6gb ram mobile electronics', 50),
(77, 1, 4, 'MSV laptop 16gb', 1700000, 'MSV laptop 16gb ram', 'product06.png', 'MSV laptop 16gb ram NVIDEA Graphics electronics', 50),
(78, 1, 5, 'dell laptop', 23500000, 'dell laptop 8gb ram intel integerated Graphics', 'product08.png', 'dell laptop 8gb ram intel integerated Graphics electronics', 50),
(79, 7, 2, 'camera with 3D pixels', 21000000, 'camera with 3D pixels', 'product09.png', 'camera with 3D pixels camera electronics gadgets', 50),
(96, 1, 3, 'iPhone 12 Pro Max', 27000000, 'iPhone 12 Pro Max', 'product001.jpg', 'iPhone 12 Pro Max', 48),
(97, 1, 3, 'iPhone 11 White 128GB', 19000000, 'iPhone 11 White 128GB', 'apple-iphone-11-2-1.jpg', 'iPhone 11 White 128GB', 23),
(98, 1, 2, 'Galaxy Watch3 Bluetooth ', 9500000, 'Galaxy Watch3 Bluetooth ', 'vn-feature-galaxy-watch3-bluetooth-45mm-139-275057926.webp', 'Galaxy Watch3 Bluetooth ', 32),
(99, 1, 2, 'Galaxy Watch3 LTE (45mm)', 9000000, 'Galaxy Watch3 LTE (45mm)', 'samsung-galaxy-watch-3-lte-45mm-ava-1-600x600.jpg', 'Galaxy Watch3 LTE ', 23),
(100, 1, 2, 'Galaxy Z Fold2 5G Black', 3200000, 'Galaxy Z Fold2 5G Black', '5090291_Samsung-Galaxy-Z-Fold-2-5G-Black.jpg', 'Galaxy Z Fold2 5G Black', 12),
(101, 1, 2, 'Galaxy Note10+', 14000000, 'Galaxy Note10+', 'samsung-galaxy-note-10-plus-silver-new-600x600.jpg', 'Galaxy Note10', 31),
(102, 1, 2, 'Galaxy Z Fold2 5G Bronze', 32500000, 'Galaxy Z Fold2 5G Bronze', '001_Z-Fold2-MysticBronze-dynamic-GalleryImage-MO-img80.webp', 'Galaxy Z Fold2 5G Bronze', 12),
(103, 6, 2, 'Smart TV 8K QLED', 25000000, 'Smart TV 8K QLED 85 inch Q950TS 2020', 'SMART TV 8K QLED 85 INCH Q950TS 2020.png', 'Smart TV 8K QLED 85 inch Q950TS 2020', 123),
(105, 6, 2, 'Màn hình LED cong\r\n', 14000000, 'Màn hình LED cong C27F591FDE\r\n', '33518_samsung_lc27f591fd__3_.png', 'Màn hình LED cong', 23),
(106, 6, 5, 'LG LED TV 43\'\'', 13000000, 'LG LED TV 43\'\'', 'tivi-lg-43lh605t-org-1.jpg', 'LG LED TV 43\'\'', 32),
(107, 6, 2, 'LG LED TV LF510T', 13000000, 'LG LED TV LF510T', 'UF64_LF51_A_zoom_01_inscreen(LF51).webp', 'LG LED TV LF510T', 232),
(108, 1, 5, 'Laptop LG gram 15\"', 17000000, 'Laptop LG gram 15\" Intel® Core™ i5 Gen10, 512GB', 'D-03.webp', 'Laptop LG ', 212),
(109, 1, 5, 'Laptop Gram 14', 17000000, 'Laptop Gram 14’’ Z980-G', '33455_laptop_lg_gram_15z980_g_ah55a5_1_1.jpg', 'Laptop Gram ', 2121),
(110, 6, 5, 'Dieu hoa LG', 12000000, 'dieu hoa lg', '00030086_FEATURE_59154.jpg', 'dieu hoa lg', 323),
(111, 6, 5, 'May loc khong khi', 5000000, 'may loc khong khi lg', '10045748-may-loc-khong-khi-lg-as95gdwv0-3_rbhk-08.jpg', 'may loc khong khi lg', 21),
(112, 6, 5, 'Bo loc thay the', 3500000, 'bo loc thay the cho may loc khong khi', '20200311_193801_2f73594f5f7040aeba4327e700f06c7a_master.jpg', 'bo loc thay the ', 32),
(114, 1, 1, 'Laptop HP 15s i5', 16500000, 'Laptop HP 15s du1103TU i5 10210U/8GB/512GB/Win10', 'LAPTOP HP 15S DU1103TU I5.png', 'Laptop HP ', 23),
(115, 1, 1, 'Laptop HP Pavilion 15', 17000000, 'Laptop HP Pavilion 15 cs3119TX i5 1035G1/4GB/256GB/2GB MX250/Win10', 'Laptop HP Pavilion 15 cs3119TX i5.png', 'Laptop HP ', 34),
(116, 1, 1, 'Laptop HP ProBook 445 G7', 18750000, 'Laptop HP ProBook 445 G7 R5 4500U/8GB/512GB/Win10', 'LAPTOP HP PROBOOK 445 G7 R5 4500U.jpg', 'Laptop HP ', 31),
(117, 1, 6, 'Laptop Accer i5', 14000000, 'Laptop Accer i5', 'acer-aspire-a315-54-52ht-i5-10210u-4gb-256gb-win-1-16-600x600.jpg', 'Laptop Accer i5', 332),
(118, 1, 6, 'Laptop Acer Nitro 5', 14500000, 'Laptop Acer Nitro 5 A515 55 72R2 i7 10870H/8GB/512GB/144Hz/4GB GTX1650Ti/Win10', 'ae90b44e967162341a48dede39080eee.jpg', 'Laptop Acer Nitro 5 A515 55 72R2 i7 10870H/8GB/512GB/144Hz/4GB GTX1650Ti/Win10', 123),
(119, 1, 6, 'Laptop Acer Swift 5 ', 18000000, 'Laptop Acer Swift 5 ', '636959565770058811_acer-swift-5-sf514-53t-58pn-1.png', 'Laptop Acer Swift 5 ', 22),
(120, 1, 6, 'Laptop Acer Swift 5 ', 18000000, 'Laptop Acer Swift 5 ', 'img_0509_800x450.jpg', 'Laptop Acer Swift 5 ', 322),
(121, 1, 6, 'Laptop Acer Aspire 3 ', 18000000, 'Laptop Acer Aspire 3 ', '5278_acer_aspire_3_a315_55g_504m_2.jpg', 'Laptop Acer Aspire 3 ', 12),
(122, 1, 7, 'Laptop Dell Vostro ', 9500000, 'Laptop Dell Vostro ', 'dell-vostro-5568-077m52-vangdong-450x300-450x300-600x600.png', 'Laptop Dell Vostro ', 1),
(123, 1, 7, 'Laptop Dell XPS', 25000000, 'Laptop Dell XPS', 'dell-xps-13-9370-i7-8550u-8gb-256gb-office365-win1-1-1-600x600.jpg', 'Laptop Dell XPS', 12),
(124, 1, 7, 'Laptop Dell Vostro', 14000000, 'Laptop Dell Vostro', '173769.jpg', 'Laptop Dell Vostro', 12),
(125, 1, 7, 'Laptop Dell Inspiron ', 17000000, 'Laptop Dell Inspiron ', 'dell-inspiron-5584-i5-8265u-4gb-1tb-mx130-win10-n-20-1-1-600x600.jpg', 'Laptop Dell Inspiron ', 1),
(126, 1, 7, 'Laptop Dell Vostro 3590 i7', 17000000, 'Laptop Dell Vostro 3590 i7', 'dell-vostro-3590-i7-grmgk2-220718-220718-600x600.jpg', 'Laptop Dell Vostro 3590 i7', 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `comment` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `reviews`
--

INSERT INTO `reviews` (`review_id`, `product_id`, `user_id`, `comment`) VALUES
(1, 2, 12, 'Sản phẩm chất lượng'),
(2, 2, 15, 'Sản phẩm ok'),
(3, 2, 12, 'ok'),
(4, 2, 12, 'day la binh luan'),
(5, 1, 12, 'Sản phẩm ok'),
(6, 2, 12, 'alo'),
(7, 74, 12, 'ok'),
(1234, 2, 12, '2');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `address2` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `user_info`
--

INSERT INTO `user_info` (`user_id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address1`, `address2`) VALUES
(12, 'Lê', 'Khang', 'lephuckhang1005@gmail.com', '1', '9448121558', 'tphcm', 'tp hcm'),
(15, 'hemu', 'ajhgdg', 'hemu@gmail.com', '1', '536487276', ',mdnbca', 'asdmhmhvbv'),
(16, 'venky', 'vs', 'venkey@gmail.com', '1', '9877654334', 'snhdgvajfehyfygv', 'asdjbhfkeur'),
(19, 'abhishek', 'bs', 'abhishekbs@gmail.com', '1', '9871236534', 'bangalore', 'hassan'),
(21, 'prajval', 'mcta', 'prajvalmcta@gmail.com', '1', '202-555-01', 'bangalore', 'kumbalagodu'),
(22, 'puneeth', 'v', 'hemu@gmail.com', '1', '9877654334', 'snhdgvajfehyfygv', 'asdjbhfkeur'),
(23, 'hemanth', 'reddy', 'hemanth@gmail.com', '1', '9876543234', 'Bangalore', 'Kumbalagodu'),
(24, 'newuser', 'user', 'newuser@gmail.com', '1', '9535688928', 'Bangalore', 'Kumbalagodu'),
(25, 'otheruser', 'user', 'otheruser@gmail.com', '1', '9535688928', 'Bangalore', 'Kumbalagodu'),
(26, 'admin', 'admin', 'admin@gmail.com', 'admin', '1231523', 'address', 'address'),
(28, 'Nh?t ', 'tân', 'ntan@gmail.com', '123', '323', 'Pleiku', 'Gia lai'),
(29, 'Nh?t ', 'tân', 'ntan@gmail.com', '123', '323', 'Sài Gòn', 'Sài gòn'),
(30, 'nguyen', 'long', 'ln@gmail.com', '222', '23999', 'Ba Ria', 'Vung Tau'),
(31, 'Tran', 'tlong', 'daclong@gmail.com', '123', '0000000', 'Viet nam', 'Viet nam'),
(32, 'khang', 'phuc', 'pk@gmail.com', '123', '0399', 'vlvl', 'ss'),
(33, 'tan', 'nguyen', 'tn@gmail.com', '123', '0f0k', 'Bac Ninh', 'Bac ninh'),
(34, 'Le', 'Long', 'lelong@gmail.com', '123', '00000', 'sg', 'sg'),
(35, 'nguyen', 'nhi', 'nn@gmail.com', '123', '2999', 'Binh duong', 'binh duong'),
(36, 'huy', 'nguyen', 'huy@gmail.com', 'nh@gmail.com', '123', 'Ben Tre', 'Ben tre'),
(37, 'phan', 'khoa', 'pk@gmail.com', '123', '002999', 'Nha trang', 'nha trang'),
(38, 'staff', 'staff', 'staff@gmail.com', 'staff', '12315', 'dia chi', 'dia chi');

--
-- Bẫy `user_info`
--
DELIMITER $$
CREATE TRIGGER `after_user_info_insert` AFTER INSERT ON `user_info` FOR EACH ROW BEGIN 
INSERT INTO user_info_backup VALUES(new.user_id,new.first_name,new.last_name,new.email,new.password,new.mobile,new.address1,new.address2);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_info_backup`
--

CREATE TABLE `user_info_backup` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `address2` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `user_info_backup`
--

INSERT INTO `user_info_backup` (`user_id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address1`, `address2`) VALUES
(12, 'puneeth', 'Reddy', 'puneethreddy951@gmail.com', '123456789', '9448121558', '123456789', 'sdcjns,djc'),
(14, 'hemanthu', 'reddy', 'hemanthreddy951@gmail.com', '123456788', '6526436723', 's,dc wfjvnvn', 'b efhfhvvbr'),
(15, 'hemu', 'ajhgdg', 'keeru@gmail.com', '346778', '536487276', ',mdnbca', 'asdmhmhvbv'),
(16, 'venky', 'vs', 'venkey@gmail.com', '1234534', '9877654334', 'snhdgvajfehyfygv', 'asdjbhfkeur'),
(19, 'abhishek', 'bs', 'abhishekbs@gmail.com', 'asdcsdcc', '9871236534', 'bangalore', 'hassan'),
(20, 'pramod', 'vh', 'pramod@gmail.com', '124335353', '9767645653', 'ksbdfcdf', 'sjrgrevgsib'),
(21, 'prajval', 'mcta', 'prajvalmcta@gmail.com', '1234545662', '202-555-01', 'bangalore', 'kumbalagodu'),
(22, 'puneeth', 'v', 'hemu@gmail.com', '1234534', '9877654334', 'snhdgvajfehyfygv', 'asdjbhfkeur'),
(23, 'hemanth', 'reddy', 'hemanth@gmail.com', 'Puneeth@123', '9876543234', 'Bangalore', 'Kumbalagodu'),
(24, 'newuser', 'user', 'newuser@gmail.com', 'puneeth@123', '9535688928', 'Bangalore', 'Kumbalagodu'),
(25, 'otheruser', 'user', 'otheruser@gmail.com', 'puneeth@123', '9535688928', 'Bangalore', 'Kumbalagodu'),
(26, 'admin', 'admin', 'admin', 'admin', '1231523', 'address', 'address'),
(27, 'new', 'new', 'mail', '1234', '1234', '123qwe', 'q?e'),
(28, 'Nh?t ', 'tân', 'ntan@gmail.com', '123', '323', 'sdsgb', '32fff'),
(29, 'Nh?t ', 'tân', 'ntan@gmail.com', '123', '323', 'sdsgb', '32fff'),
(30, 'nguyen', 'long', 'ln@gmail.com', '222', '23999', 'dbbb', 'llll'),
(31, 'Tran', 'tlong', 'daclong@gmail.com', '123', '0000000', 'fkfkll', 'vjm'),
(32, 'khang', 'phuc', 'pk@gmail.com', '123', '0399', 'vlvl', 'vlvl'),
(33, 'tan', 'nguyen', 'tn@gmail.com', '123', '0f0k', 'kvkkkk', 'v00l'),
(34, 'Le', 'Long', 'lelong@gmail.com', '123', '00000', 'sg', 'sg'),
(35, 'nguyen', 'nhi', 'nn@gmail.com', '123', '2999', 'Binh duong', 'binh duong'),
(36, '', 'nguyen', 'huy', 'nh@gmail.com', '123', 'Ben Tre', 'Ben tre'),
(37, 'phan', 'khoa', 'pk@gmail.com', '123', '002999', 'Nha trang', 'nha trang'),
(38, 'staff', 'staff', 'staff@gmail.com', 'staff', '12315', 'dia chi', 'dia chi');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Chỉ mục cho bảng `email_info`
--
ALTER TABLE `email_info`
  ADD PRIMARY KEY (`email_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_info`
--
ALTER TABLE `order_info`
  ADD PRIMARY KEY (`order_info_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_items_id`),
  ADD KEY `oder_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- Chỉ mục cho bảng `user_info_backup`
--
ALTER TABLE `user_info_backup`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `email_info`
--
ALTER TABLE `email_info`
  MODIFY `email_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `order_info`
--
ALTER TABLE `order_info`
  MODIFY `order_info_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_items_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1235;

--
-- AUTO_INCREMENT cho bảng `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `user_info_backup`
--
ALTER TABLE `user_info_backup`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_user` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`);

--
-- Các ràng buộc cho bảng `order_info`
--
ALTER TABLE `order_info`
  ADD CONSTRAINT `fk_order_info_user` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`),
  ADD CONSTRAINT `fk_order_infor_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_item_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reivews_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `fk_reviews_user` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
