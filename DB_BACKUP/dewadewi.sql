/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100427
 Source Host           : localhost:3306
 Source Schema         : dewadewi

 Target Server Type    : MySQL
 Target Server Version : 100427
 File Encoding         : 65001

 Date: 09/03/2023 03:24:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` bigint NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `customers_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (1, 'Aezo27', 'Solo', 'admin@odama.io', 82134626598, '2022-12-09 12:20:18', '2022-12-11 12:20:18');
INSERT INTO `customers` VALUES (2, 'Rama Sullivan', 'Solo', 'ramasullivan27@gmail.com', 82134626598, '2023-03-09 12:20:18', '2023-03-09 12:20:18');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for items
-- ----------------------------
DROP TABLE IF EXISTS `items`;
CREATE TABLE `items`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` bigint NOT NULL,
  `kuantitas` bigint NOT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `items_slug_unique`(`slug`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of items
-- ----------------------------
INSERT INTO `items` VALUES (1, 1, 'Test', 'Test', 20000, 399, NULL, '2022-12-11 10:58:04', '2023-01-02 15:16:27');
INSERT INTO `items` VALUES (2, 1, 'Beras', 'Beras', 10000, 298, 'test.png', '2022-12-17 11:52:33', '2023-03-05 01:46:22');

-- ----------------------------
-- Table structure for kategoris
-- ----------------------------
DROP TABLE IF EXISTS `kategoris`;
CREATE TABLE `kategoris`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `kategoris_nama_unique`(`nama`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kategoris
-- ----------------------------
INSERT INTO `kategoris` VALUES (1, 'Pangan', '2022-12-11 10:56:51', '2022-12-11 10:56:51');

-- ----------------------------
-- Table structure for laporans
-- ----------------------------
DROP TABLE IF EXISTS `laporans`;
CREATE TABLE `laporans`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_invoice` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint UNSIGNED NULL DEFAULT NULL,
  `total_harga` bigint NULL DEFAULT NULL,
  `tanggal_keluar` date NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of laporans
-- ----------------------------
INSERT INTO `laporans` VALUES (1, '1751920556227252', NULL, NULL, '2022-12-11', '2022-12-11 12:27:18', '2022-12-11 12:27:18');
INSERT INTO `laporans` VALUES (2, '1752296257504956', NULL, NULL, '2022-12-15', '2022-12-15 15:58:55', '2022-12-15 15:58:55');
INSERT INTO `laporans` VALUES (3, '1752297425398046', NULL, NULL, '2022-12-15', '2022-12-15 16:17:29', '2022-12-15 16:17:29');
INSERT INTO `laporans` VALUES (4, '1752297506632400', NULL, NULL, '2022-12-15', '2022-12-15 16:18:46', '2022-12-15 16:18:46');
INSERT INTO `laporans` VALUES (5, '1752297556255656', NULL, NULL, '2022-12-15', '2022-12-15 16:19:34', '2022-12-15 16:19:34');
INSERT INTO `laporans` VALUES (6, '1752297596968501', NULL, NULL, '2022-12-15', '2022-12-15 16:20:12', '2022-12-15 16:20:12');
INSERT INTO `laporans` VALUES (7, '1752297615231773', NULL, NULL, '2022-12-15', '2022-12-15 16:20:30', '2022-12-15 16:20:30');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2022_04_09_123620_create_items_table', 1);
INSERT INTO `migrations` VALUES (6, '2022_04_16_212918_create_kategoris_table', 1);
INSERT INTO `migrations` VALUES (7, '2022_06_04_024522_create_penggunas_table', 1);
INSERT INTO `migrations` VALUES (8, '2022_06_27_024530_create_customers_table', 1);
INSERT INTO `migrations` VALUES (9, '2022_07_18_100836_create_produk_keluars_table', 1);
INSERT INTO `migrations` VALUES (10, '2022_07_19_121628_create_produk_masuks_table', 1);
INSERT INTO `migrations` VALUES (11, '2022_07_19_123923_create_suppliers_table', 1);
INSERT INTO `migrations` VALUES (12, '2022_07_21_073129_create_penjualans_table', 1);
INSERT INTO `migrations` VALUES (13, '2022_08_31_092456_create_laporans_table', 1);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for penggunas
-- ----------------------------
DROP TABLE IF EXISTS `penggunas`;
CREATE TABLE `penggunas`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of penggunas
-- ----------------------------

-- ----------------------------
-- Table structure for penjualans
-- ----------------------------
DROP TABLE IF EXISTS `penjualans`;
CREATE TABLE `penjualans`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `produk_id` bigint UNSIGNED NOT NULL,
  `no_invoice` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kuantitas` bigint NULL DEFAULT NULL,
  `harga` bigint NOT NULL,
  `subtotal` bigint NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `customer_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of penjualans
-- ----------------------------
INSERT INTO `penjualans` VALUES (1, 2, '1752461707995719', 1, 10000, 10000, '2023-03-07 13:18:30', '2023-01-02 13:18:30', 1);
INSERT INTO `penjualans` VALUES (3, 1, '1753916911199045', 1, 20000, 20000, '2023-03-09 01:16:27', '2022-12-25 15:16:27', 1);
INSERT INTO `penjualans` VALUES (4, 2, '1753924331553144', 1, 10000, 10000, '2023-03-09 01:46:22', '2023-03-05 01:46:22', 1);
INSERT INTO `penjualans` VALUES (5, 1, '1753924331553144', 2, 20000, 40000, '2023-03-09 01:46:22', '2023-03-05 01:46:22', 2);

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for produk_keluars
-- ----------------------------
DROP TABLE IF EXISTS `produk_keluars`;
CREATE TABLE `produk_keluars`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `produk_id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `kuantitas` bigint NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of produk_keluars
-- ----------------------------
INSERT INTO `produk_keluars` VALUES (1, 1, 1, 20, '2022-12-12', '2022-12-11 12:21:45', '2022-12-11 12:21:45');

-- ----------------------------
-- Table structure for produk_masuks
-- ----------------------------
DROP TABLE IF EXISTS `produk_masuks`;
CREATE TABLE `produk_masuks`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `produk_id` bigint UNSIGNED NOT NULL,
  `supplier_id` bigint UNSIGNED NOT NULL,
  `kuantitas` bigint NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of produk_masuks
-- ----------------------------
INSERT INTO `produk_masuks` VALUES (1, 1, 1, 200, '2022-12-11', '2022-12-11 12:21:14', '2022-12-11 12:21:14');
INSERT INTO `produk_masuks` VALUES (2, 2, 1, 100, '2023-01-04', '2023-01-04 12:28:23', '2023-01-04 12:28:23');

-- ----------------------------
-- Table structure for suppliers
-- ----------------------------
DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` bigint NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `suppliers_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of suppliers
-- ----------------------------
INSERT INTO `suppliers` VALUES (1, 'Aezo27 Tech', 'Wirorejan, Ngadirejo', 'stillhopeyou@gmail.com', 82134626598, '2022-12-11 12:20:34', '2022-12-11 12:20:34');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', 'admin@gmail.com', '$2y$10$Z/tUvRBwCHnMnah2Fpjn2ufWOI8D//NmuKWd8dcBahdbZ77Xc3Fjy', 'staff', 1, '', '2022-07-18 06:52:14', '2022-07-18 06:52:14');

-- ----------------------------
-- View structure for lap_juals
-- ----------------------------
DROP VIEW IF EXISTS `lap_juals`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `lap_juals` AS SELECT
	penjualans.id, 
	penjualans.no_invoice, 
	items.id AS id_produk, 
	items.nama, 
	penjualans.kuantitas, 
	penjualans.harga, 
	penjualans.subtotal, 
	customers.nama AS nama_pembeli, 
	penjualans.created_at, 
	penjualans.updated_at, 
	items.gambar
FROM
	penjualans
	INNER JOIN
	items
	ON 
		penjualans.produk_id = items.id
	INNER JOIN
	customers
	ON 
		penjualans.customer_id = customers.id ;

-- ----------------------------
-- View structure for lap_masuks
-- ----------------------------
DROP VIEW IF EXISTS `lap_masuks`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `lap_masuks` AS SELECT
	produk_masuks.id, 
	items.nama, 
	suppliers.nama AS nama_suplier, 
	produk_masuks.kuantitas, 
	items.harga, 
	(items.harga * produk_masuks.kuantitas) as total,
	produk_masuks.tanggal_masuk
FROM
	produk_masuks
	INNER JOIN
	items
	ON 
		produk_masuks.produk_id = items.id
	INNER JOIN
	suppliers
	ON 
		produk_masuks.supplier_id = suppliers.id ; ;

SET FOREIGN_KEY_CHECKS = 1;
