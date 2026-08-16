-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 16, 2026 at 03:39 AM
-- Server version: 8.0.46-0ubuntu0.22.04.3
-- PHP Version: 8.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kidzCare`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `role`, `email`, `mobile`, `status`) VALUES
(1, 'admin', 'admin', 0, '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int NOT NULL,
  `heading1` varchar(255) NOT NULL,
  `heading2` varchar(255) NOT NULL,
  `btn_txt` varchar(255) DEFAULT NULL,
  `btn_link` varchar(55) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `order_no` int NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `heading1`, `heading2`, `btn_txt`, `btn_link`, `image`, `order_no`, `status`) VALUES
(1, 'Premium care products made with love, safety, and comfort in mind', '💖 Because Your Baby Deserves the Best', 'Shop Now', 'cart.php', '697974054_b1.webp', 2, 1),
(2, 'Safe, gentle, and trusted products for your child’s everyday happiness', '✨ Caring for Little Smiles', 'Shop Now', 'cart.php', '479245131_b2.webp', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `categories` varchar(255) NOT NULL,
  `status` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categories`, `status`) VALUES
(1, 'Baby Hair', 1),
(4, 'Baby Body', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `comment` text NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `comment`, `added_on`) VALUES
(2, 'vishal@gmail.com', '', '1234567890', 'testing', '2020-01-19 07:59:38'),
(3, 'Vishal', 'vishal@gmail.com', '1234567890', 'testing', '2020-01-19 08:00:09'),
(7, 'MasalaQueen', 'admin@dentalclinic.com', '8448557685', 'testing', '2026-08-05 03:36:02');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `address` varchar(250) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pincode` int NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `total_price` float NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `order_status` int NOT NULL,
  `txnid` varchar(20) NOT NULL,
  `mihpayid` varchar(255) DEFAULT NULL,
  `payu_status` varchar(255) DEFAULT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `address`, `city`, `pincode`, `payment_type`, `total_price`, `payment_status`, `order_status`, `txnid`, `mihpayid`, `payu_status`, `added_on`) VALUES
(5, 1, 'mumbai', 'mumbai', 110058, 'COD', 2718, 'Success', 5, 'cd408e186cf9d1b3dcb0', NULL, NULL, '2026-03-18 09:41:32'),
(7, 1, 'C-117, Maharani Enclave hastsal village uttam nagar', 'new delhi', 110059, 'payu', 819, 'success', 2, '8f154d8a803615917fc8', '403993715537022135', NULL, '2026-03-20 09:26:12'),
(8, 1, 'C-117, Maharani Enclave hastsal village uttam nagar', 'mm', 110059, 'COD', 156339, 'Success', 3, '2a7514476a427036202c', NULL, NULL, '2026-08-04 02:58:08'),
(9, 4, 'mm', 'mm', 110059, 'payu', 280, 'pending', 1, '14ca3612624155f78981', NULL, NULL, '2026-08-05 05:52:21'),
(10, 4, 'C-117, Maharani Enclave hastsal village uttam nagar', 'new delhi', 110059, 'payu', 539, 'success', 1, '8b87ed9924be490a5b3b', '613345778912614119', NULL, '2026-08-07 04:47:20'),
(11, 4, 'Uttam nagar', 'new delhi', 110059, 'payu', 280, 'pending', 1, '2ebb5ae57602a545b2e2', NULL, NULL, '2026-08-11 05:49:42'),
(12, 4, 'Uttam nagar', 'new delhi', 110059, 'COD', 280, 'Success', 2, '67058d94da8123de2e27', NULL, NULL, '2026-08-11 05:52:50');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `qty` int NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `qty`, `price`) VALUES
(1, 1, 2, 1, 155800),
(2, 1, 1, 1, 8499),
(3, 2, 10, 1, 10),
(4, 3, 4, 2, 1200),
(5, 4, 11, 1, 50),
(6, 4, 6, 1, 1500),
(7, 4, 4, 1, 1200),
(8, 5, 13, 1, 280),
(9, 5, 14, 1, 1899),
(10, 5, 12, 1, 539),
(11, 6, 13, 1, 280),
(12, 6, 12, 1, 539),
(13, 7, 13, 1, 280),
(14, 7, 12, 1, 539),
(15, 8, 2, 1, 155800),
(16, 8, 12, 1, 539),
(17, 9, 13, 1, 280),
(18, 10, 12, 1, 539),
(19, 11, 13, 1, 280),
(20, 12, 13, 1, 280);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Shipped'),
(4, 'Canceled'),
(5, 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `categories_id` int NOT NULL,
  `sub_categories_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `mrp` float NOT NULL,
  `price` float NOT NULL,
  `qty` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `short_desc` varchar(2000) NOT NULL,
  `description` text NOT NULL,
  `best_seller` int NOT NULL,
  `meta_title` varchar(2000) NOT NULL,
  `meta_desc` varchar(2000) NOT NULL,
  `meta_keyword` varchar(2000) NOT NULL,
  `status` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `categories_id`, `sub_categories_id`, `name`, `mrp`, `price`, `qty`, `image`, `short_desc`, `description`, `best_seller`, `meta_title`, `meta_desc`, `meta_keyword`, `status`) VALUES
(1, 4, 8, 'Pure Olive Baby Oil', 9999, 8499, 10, '229389124_1_5c54ecdce9.jpg', 'Enriched with vitamin E & omega-3, 6. Only healthy nourishment for neural, cognitive & organ development of your little one.', 'Enriched with vitamin E & omega-3, 6. Only healthy nourishment for neural, cognitive & organ development of your little one. PURE. Non-refined. Non-Adulterated. ZERO Paraffin & Mineral Oils. Zero Chemicals & Preservatives. Paediatrician & Dermatologically Tested.', 1, 'Pure Olive Baby Oil', 'Pure Olive Baby Oil', 'Pure Olive Baby Oil', 1),
(2, 4, 8, 'Pure Virgin Coconut Baby Oil', 165800, 155800, 4, '198964652_1_163b08f0bd.jpg', 'Enriched with vitamin E & omega-3, 6. Only healthy nourishment for neural, cognitive & organ development of your little one.', 'Enriched with vitamin E & omega-3, 6. Only healthy nourishment for neural, cognitive & organ development of your little one. PURE. Non-refined. Non-Adulterated. ZERO Paraffin & Mineral Oils. Zero Chemicals & Preservatives. Paediatrician & Dermatologically Tested.', 1, 'Pure Virgin Coconut Baby Oil', 'Pure Virgin Coconut Baby Oil', 'Pure Virgin Coconut Baby Oil', 1),
(3, 4, 8, 'Pure Almond Baby Oil', 1399, 1299, 10, '189964563_1_16b48a4634.jpg', 'Enriched with vitamin E & omega-3, 6. Only healthy nourishment for neural, cognitive & organ development of your little one.', 'Enriched with vitamin E & omega-3, 6. Only healthy nourishment for neural, cognitive & organ development of your little one. PURE. Non-refined. Non-Adulterated. ZERO Paraffin & Mineral Oils. Zero Chemicals & Preservatives. Paediatrician & Dermatologically Tested.', 1, 'Pure Almond Baby Oil', 'Pure Almond Baby Oil', 'Pure Almond Baby Oil', 1),
(4, 2, 2, 'SHEEN-SOLID TROUSER-OLIVE', 1999, 1200, 3, '697347005_2__1538219531_49.204.69.38_600x.jpg', 'per inceptos himenaeos. Ut commodo ullamcorper quam non pulvinar.', 'Duis a felis congue, feugiat est non, suscipit quam. In elit lacus, auctor sed lacus eget, egestas consectetur leo. Duis pellentesque pharetra ante, ac ornare nibh faucibus id. Integer pulvinar malesuada nisl. Nulla vel orci nunc. Nullam a tellus eu ex ullamcorper mollis. Donec commodo ligula a accumsan fermentum. Mauris sed orci lacinia, posuere leo molestie, pretium mi. Cras sodales, neque id cursus fermentum, mi purus vehicula sem, vel laoreet lorem justo id tortor. Sed ut urna ut ipsum vestibulum commodo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut commodo ullamcorper quam non pulvinar.', 0, 'SHEEN-SOLID TROUSER-OLIVE', 'SHEEN-SOLID TROUSER-OLIVE', 'SHEEN-SOLID TROUSER-OLIVE', 1),
(5, 2, 0, 'NATURE-LINEN SHIRT-GREEN', 2799, 2399, 8, '812581380_nature_green-0224_600x.jpg', 'a nisl pharetra orci, at condimentum nisl lorem elementum ipsum.', 'Nunc auctor turpis ante, eget bibendum mi mollis in. Aliquam quis neque ut libero malesuada auctor. Aliquam interdum enim at commodo gravida. Donec nisl sem, molestie ut quam quis, vulputate venenatis ipsum. Aenean quis ex ut magna accumsan fringilla. Quisque id ex massa. Sed libero ante, fringilla ac condimentum in, porttitor ac risus. Integer mattis odio nec nunc semper imperdiet. In porttitor tellus eget sapien vulputate, eu euismod lacus aliquet. Maecenas molestie elit augue, sit amet fringilla dolor congue et. Nunc eu libero auctor, sollicitudin lectus quis, porta ligula. In vel ullamcorper risus. Nullam viverra, mi sit amet laoreet luctus, urna nisl pharetra orci, at condimentum nisl lorem elementum ipsum.', 0, 'NATURE-LINEN SHIRT-GREEN', 'NATURE-LINEN SHIRT-GREEN', 'T-Shirt, NATURE-LINEN SHIRT-GREEN', 1),
(6, 2, 1, 'Monte Carlo Turquoise Blue Solid Collar T Shirt', 1999, 1500, 8, '931830512__8-(1)-E5x-104831-NJD.jpg', 'lacus quis urna tristique suscipit. Praesent vitae mi mollis dui facilisis convallis eu faucibus augue.', 'Duis in risus quis lectus dictum fringilla. Aenean tempor pellentesque velit id ullamcorper. Ut id aliquam odio. Morbi id pharetra libero, ut tempor nisi. Maecenas a lectus nec risus maximus rutrum. Mauris vel elit ut magna semper laoreet nec sed magna. Quisque eleifend vel sem non malesuada. Interdum et malesuada fames ac ante ipsum primis in faucibus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum eget posuere orci, eu ultrices sapien. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam sit amet ex dictum nisl bibendum elementum non in turpis. In bibendum ipsum nunc, bibendum lacinia lacus maximus eu. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus aliquam lacus quis urna tristique suscipit. Praesent vitae mi mollis dui facilisis convallis eu faucibus augue.', 0, 'Monte Carlo Turquoise Blue Solid Collar T Shirt', 'Monte Carlo Turquoise Blue Solid Collar T Shirt', 'Monte Carlo Turquoise Blue Solid Collar T Shirt', 1),
(7, 4, 8, 'Almond & Date Fresh Baby Malai Lotion', 1900, 1350, 7, '391360703_1_06f1328182.jpg', 'A gentle hug of nourishment for your baby’s delicate skin. Made fresh daily in our Ayurvedic Kitchen with raw milk, desi cow ghee, almond milk, dates, pure butters, & oils, it is an extremely moisturising lotion.', 'A gentle hug of nourishment for your baby’s delicate skin. Made fresh daily in our Ayurvedic Kitchen with raw milk, desi cow ghee, almond milk, dates, pure butters, & oils, it is an extremely moisturising lotion.\r\nBaby’s semi-permeable skin absorbs the richness of Malai’s active vitamins, fats, proteins, & nutrients. It delivers deep moisture, removes flakes, protects the skin, helps regulate their body temperature, leaving MALAI-soft, supple skin with loads of giggles. MALAI care - 100% Natural. 0% Chemicals. Paediatrician & Dermatologically Tested.', 1, 'Almond & Date Fresh Baby Malai Lotion', 'Almond & Date Fresh Baby Malai Lotion', 'Almond & Date Fresh Baby Malai Lotion', 1),
(8, 4, 8, 'Tender Coconut Fresh Baby Malai Lotion', 1499, 1299, 10, '480307626_1_0465ae1396.jpg', 'A gentle hug of nourishment for your baby’s delicate skin. Made fresh daily in our Ayurvedic Kitchen with raw milk, desi cow ghee, tender coconut milk, pure butters, & oils, it is an extremely moisturising lotion.', 'A gentle hug of nourishment for your baby’s delicate skin. Made fresh daily in our Ayurvedic Kitchen with raw milk, desi cow ghee, tender coconut milk, pure butters, & oils, it is an extremely moisturising lotion.\r\nBaby’s semi-permeable skin absorbs the richness of Malai’s active vitamins, fats, proteins, & nutrients. It delivers deep moisture, removes flakes, protects the skin, helps regulate their body temperature, leaving MALAI-soft, supple skin with loads of giggles. MALAI care - 100% Natural. 0% Chemicals. Paediatrician & Dermatologically Tested.', 1, 'Tender Coconut Fresh Baby Malai Lotion', 'Tender Coconut Fresh Baby Malai Lotion', 'Tender Coconut Fresh Baby Malai Lotion', 1),
(9, 1, 5, 'Brahmi Matsyakshi Winter Baby Hair & Scalp Oil', 399, 299, 10, '878134420_3_0c742e96b2.jpg', 'Baby Scalp & Hair Dasabuti Oil, slow heat infused for over 10HRS & fresh blended with desi cow ghee, herbs & cold pressed oils.', 'Baby Scalp & Hair Dasabuti Oil, slow heat infused for over 10HRS & fresh blended with desi cow ghee, herbs & cold pressed oils. All oils are PURE Cold Pressed. ZERO Paraffin & Mineral Oils. Zero Chemicals & Preservatives. Daily head massage with Dasabuti Oil is essential for baby\'s brain, cognitive, eye & hair follicle development.', 1, 'Brahmi Matsyakshi Winter Baby Hair & Scalp Oil', 'Brahmi Matsyakshi Winter Baby Hair & Scalp Oil', 'Brahmi Matsyakshi Winter Baby Hair & Scalp Oil', 1),
(10, 1, 5, 'Brahmi Matsyakshi Summer Baby Hair & Scalp Oil', 4599, 4399, 15, '406535215_2_00138ebddf.jpg', 'Baby Scalp & Hair Dasabuti Oil, slow heat infused for over 10HRS & fresh blended with desi cow ghee, herbs & cold pressed oils.', 'Baby Scalp & Hair Dasabuti Oil, slow heat infused for over 10HRS & fresh blended with desi cow ghee, herbs & cold pressed oils. All oils are PURE Cold Pressed. ZERO Paraffin & Mineral Oils. Zero Chemicals & Preservatives. Daily head massage with Dasabuti Oil is essential for baby\'s brain, cognitive, eye & hair follicle development.', 1, 'Brahmi Matsyakshi Summer Baby Hair & Scalp Oil', 'Brahmi Matsyakshi Summer Baby Hair & Scalp Oil', 'Brahmi Matsyakshi Summer Baby Hair & Scalp Oil', 1),
(11, 2, 1, 'Test1', 100, 50, 10, '457926432_697347005_2__1538219531_49.204.69.38_600x.jpg', 'Test', 'test', 0, '', '', '', 1),
(12, 4, 8, 'Kusha Baby Powder - Shwet Chandan', 549, 539, 10, '738153997_1_a15246ceb8.jpg', '100% natural, absolutely safe baby powder made with potent, activated ingredients to keep babies and kids rash-free & soft.', '100% natural, absolutely safe baby powder made with potent, activated ingredients to keep babies and kids rash-free & soft. Made with sweat-absorbing grains and antimicrobial Ayurvedic herbs like kusha, shwet chandan, and slippery elm, it provides quick relief from rashes, irritation, and aggravated heat on delicate skin. It is talc-free, asbestos-free, and menthol-free. 100% natural with no chemicals and no preservatives. Paediatrician and dermatologically tested.', 1, 'Kusha Baby Powder - Shwet Chandan', 'Kusha Baby Powder - Shwet Chandan', 'Kusha Baby Powder - Shwet Chandan', 1),
(13, 4, 7, 'Tender Coconut Fresh Baby Malai', 350, 280, 15, '976527198_1_b99ff32a93.jpg', 'A gentle hug of nourishment for your baby’s delicate skin. Made fresh daily in our Ayurvedic Kitchen with raw milk, desi cow ghee, tender coconut milk, pure butters, & oils, it is an extremely moisturising cream.', 'A gentle hug of nourishment for your baby’s delicate skin. Made fresh daily in our Ayurvedic Kitchen with raw milk, desi cow ghee, tender coconut milk, pure butters, & oils, it is an extremely moisturising cream.\r\nBaby’s semi-permeable skin absorbs the richness of Malai’s active vitamins, fats, proteins, & nutrients. It delivers deep moisture, removes flakes, protects the skin, helps regulate their body temperature, leaving MALAI-soft, supple skin with loads of giggles. MALAI care - 100% Natural. 0% Chemicals. Paediatrician & Dermatologically Tested.', 1, 'Tender Coconut Fresh Baby Malai', 'Tender Coconut Fresh Baby Malai', 'Tender Coconut Fresh Baby Malai', 1),
(14, 4, 7, 'Prebiotic Anti-Rash Cream for Babies', 1999, 1899, 15, '275855472_1_0d0c8a8c28.jpg', 'It is a super-activated anti-rash treatment & preventive formula from our Ayurvedic Kitchen. Unlike most creams, it works on triple protective action.', 'It is a super-activated anti-rash treatment & preventive formula from our Ayurvedic Kitchen. Unlike most creams, it works on triple protective action. High-grade micro zinc provides an anti-rash barrier on the skin while kusha, coconut oil & other naturals amplify protection, soothe & cool down skin. Extracted chicory prebiotics are added to ensure a healthy biome required for resilience & healthy development of skin. 100% natural care for your little one.', 0, 'Prebiotic Anti-Rash Cream for Babies', 'Prebiotic Anti-Rash Cream for Babies', 'Prebiotic Anti-Rash Cream for Babies', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `rating` varchar(20) NOT NULL,
  `review` text NOT NULL,
  `status` int NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`id`, `product_id`, `user_id`, `rating`, `review`, `status`, `added_on`) VALUES
(9, 1, 1, 'Fantastic', 'nice products!', 1, '2026-03-17 11:22:18'),
(10, 1, 1, 'Fantastic', 'nice products!', 1, '2026-03-17 11:23:06'),
(16, 10, 4, 'Worst', 'goood', 1, '2026-08-05 06:18:56');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int NOT NULL,
  `categories_id` int NOT NULL,
  `sub_categories` varchar(100) NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `categories_id`, `sub_categories`, `status`) VALUES
(1, 2, 'T-Shirt', 1),
(2, 2, 'Trouser', 1),
(3, 4, 'Baby Face Wash', 1),
(4, 1, 'Baby Shampoo', 1),
(5, 1, 'Baby hair oil', 1),
(6, 1, 'Baby Conditioner', 1),
(7, 4, 'Baby Body Wash', 1),
(8, 4, 'Baby Butter Lotion', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `mobile`, `added_on`) VALUES
(2, 'Amit', 'amit', 'amir@gmail.com', '1234567890', '2020-05-14 00:00:00'),
(3, 'Vishal', 'vishal', 'ytlearnwebdevelopment@gmail.com', '9540608104', '2020-05-16 01:24:15'),
(4, 'vivek', 'admin', 'jhav668@gmail.com', '8448557680', '2026-03-15 09:58:57');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `added_on`) VALUES
(31, 4, 13, '2026-08-16 03:13:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
