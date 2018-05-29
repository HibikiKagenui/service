/*
 Navicat Premium Data Transfer

 Source Server         : mysql
 Source Server Type    : MySQL
 Source Server Version : 100131
 Source Host           : localhost:3306
 Source Schema         : service_motor

 Target Server Type    : MySQL
 Target Server Version : 100131
 File Encoding         : 65001

 Date: 29/05/2018 09:43:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `id` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `no_ktp` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `no_kontak` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gender` enum('L','P') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for mechanics
-- ----------------------------
DROP TABLE IF EXISTS `mechanics`;
CREATE TABLE `mechanics`  (
  `id` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `no_kontak` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gender` enum('L','P') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gaji` decimal(10, 0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for part_details
-- ----------------------------
DROP TABLE IF EXISTS `part_details`;
CREATE TABLE `part_details`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_part` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `part_serial_num` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` enum('available','broken','booked','sold') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_id_barang`(`id_part`) USING BTREE,
  INDEX `part_serial_num`(`part_serial_num`) USING BTREE,
  CONSTRAINT `fk_id_barang` FOREIGN KEY (`id_part`) REFERENCES `parts` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for parts
-- ----------------------------
DROP TABLE IF EXISTS `parts`;
CREATE TABLE `parts`  (
  `id` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `harga` decimal(10, 0) NOT NULL,
  `stok` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for parts_transaction_details
-- ----------------------------
DROP TABLE IF EXISTS `parts_transaction_details`;
CREATE TABLE `parts_transaction_details`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaction` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_part` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `part_serial_num` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jumlah_terbayar` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_id_part`(`id_part`) USING BTREE,
  INDEX `fk_part_serial_num`(`part_serial_num`) USING BTREE,
  INDEX `fk_id_transaction_part`(`id_transaction`) USING BTREE,
  CONSTRAINT `fk_id_part` FOREIGN KEY (`id_part`) REFERENCES `parts` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_id_transaction_part` FOREIGN KEY (`id_transaction`) REFERENCES `transactions` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_part_serial_num` FOREIGN KEY (`part_serial_num`) REFERENCES `part_details` (`part_serial_num`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for service_transaction_details
-- ----------------------------
DROP TABLE IF EXISTS `service_transaction_details`;
CREATE TABLE `service_transaction_details`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `id_transaction` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_service` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_mechanic` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jumlah_terbayar` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_id_transaction_service`(`id_transaction`) USING BTREE,
  INDEX `fk_id_service`(`id_service`) USING BTREE,
  INDEX `fk_id_mechanic`(`id_mechanic`) USING BTREE,
  CONSTRAINT `fk_id_mechanic` FOREIGN KEY (`id_mechanic`) REFERENCES `mechanics` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_id_service` FOREIGN KEY (`id_service`) REFERENCES `services` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_id_transaction_service` FOREIGN KEY (`id_transaction`) REFERENCES `transactions` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for services
-- ----------------------------
DROP TABLE IF EXISTS `services`;
CREATE TABLE `services`  (
  `id` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kategori` enum('1','2','3') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `biaya` decimal(10, 0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for transactions
-- ----------------------------
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions`  (
  `id` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_customer` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jenis_kendaraan` enum('mobil','truk','motor') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `waktu` datetime(0) NOT NULL,
  `jumlah_terbayar` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_id_customer`(`id_customer`) USING BTREE,
  CONSTRAINT `fk_id_customer` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `username` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jabatan` enum('kasir','manajer') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`username`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('hibikikagenui', '05121998', 'Muhammad Nabillah', 'manajer');

-- ----------------------------
-- Triggers structure for table part_details
-- ----------------------------
DROP TRIGGER IF EXISTS `update_stock`;
delimiter ;;
CREATE TRIGGER `update_stock` AFTER UPDATE ON `part_details` FOR EACH ROW UPDATE parts set parts.stok = (parts.stok - 1) WHERE parts.id = NEW.id_part
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table parts_transaction_details
-- ----------------------------
DROP TRIGGER IF EXISTS `update_status`;
delimiter ;;
CREATE TRIGGER `update_status` AFTER INSERT ON `parts_transaction_details` FOR EACH ROW UPDATE part_details SET part_details.`status` = 'sold' WHERE part_details.part_serial_num = NEW.part_serial_num
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
