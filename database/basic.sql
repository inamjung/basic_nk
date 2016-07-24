/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50525
Source Host           : localhost:3306
Source Database       : basic

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2016-07-24 23:11:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for account
-- ----------------------------
DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `properties` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of account
-- ----------------------------

-- ----------------------------
-- Table structure for departments
-- ----------------------------
DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL COMMENT 'กลุ่มงาน',
  `department` varchar(255) DEFAULT NULL COMMENT 'แผนก',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of departments
-- ----------------------------
INSERT INTO `departments` VALUES ('1', '3', 'ซ่อมบำรุง');
INSERT INTO `departments` VALUES ('2', '1', 'งานคลังยา');
INSERT INTO `departments` VALUES ('3', '1', 'งานคุ้มครองผู้บริโภค');
INSERT INTO `departments` VALUES ('4', '3', 'งานยานยนต์');

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namegroup` varchar(255) DEFAULT NULL COMMENT 'ชื่อกลุ่มงาน',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', 'กลุ่มงานเภสัชกรรมชุมชน');
INSERT INTO `groups` VALUES ('2', 'กลุ่มงานทันตกรรม');
INSERT INTO `groups` VALUES ('3', 'กลุ่มงานบริหารจัดการทั่วไป');

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1469173746');
INSERT INTO `migration` VALUES ('m140209_132017_init', '1469175028');

-- ----------------------------
-- Table structure for profile
-- ----------------------------
DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of profile
-- ----------------------------
INSERT INTO `profile` VALUES ('1', null, null, null, null, null, null, null);
INSERT INTO `profile` VALUES ('2', null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for social_account
-- ----------------------------
DROP TABLE IF EXISTS `social_account`;
CREATE TABLE `social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `data` text,
  `code` varchar(32) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`) USING BTREE,
  UNIQUE KEY `account_unique_code` (`code`) USING BTREE,
  KEY `fk_user_account` (`user_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of social_account
-- ----------------------------

-- ----------------------------
-- Table structure for token
-- ----------------------------
DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE KEY `token_unique` (`user_id`,`code`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of token
-- ----------------------------
INSERT INTO `token` VALUES ('1', '7y_pDm-cE4sxPzNo8Jo5HjEehhsPxYfr', '1469176694', '0');
INSERT INTO `token` VALUES ('2', 'kamDivya0t4vM3tefJHEQpTfozEUGvGx', '1469176739', '0');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_email` (`email`),
  UNIQUE KEY `user_unique_username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'admin@localhost.com', '$2y$12$yxF.ki3qxU62ciAzMtvsy.60q5k1WiT.83k8e4gO.vEqSChGv0XW.', 'Y8vDnMIITuH-OgSjIUzDh-7dGQxblkFI', null, null, null, '::1', '1469176693', '1469176693', '0');
INSERT INTO `user` VALUES ('2', 'user', 'user@localhost.com', '$2y$12$GgZCWBYluYpdK/S9webu9OtP1Y3gjM10O0pp3U7KRK5PgIvlCA9uK', 'ULV1hXTB2JGm5oNi-4-TPIrxtJMXHAzH', null, null, null, '::1', '1469176738', '1469176738', '0');
