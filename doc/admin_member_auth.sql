/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : gzgkzysjpt

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-01-18 23:43:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_member_auth
-- ----------------------------
DROP TABLE IF EXISTS `admin_member_auth`;
CREATE TABLE `admin_member_auth` (
  `id` int(10) NOT NULL,
  `prefix` varchar(255) DEFAULT '' COMMENT '前缀',
  `userid` int(10) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_member_auth
-- ----------------------------
