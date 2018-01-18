/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : gzgkzysjpt

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-01-18 23:43:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_member
-- ----------------------------
DROP TABLE IF EXISTS `admin_member`;
CREATE TABLE `admin_member` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '用户名',
  `password` varchar(200) NOT NULL COMMENT '密码',
  `num` int(50) NOT NULL DEFAULT '20' COMMENT '用户登录权限',
  `last_ip` varchar(50) DEFAULT NULL COMMENT '最近一次登录ip',
  `status` smallint(6) DEFAULT '10' COMMENT '状态',
  `create_user` varchar(100) NOT NULL COMMENT '创建人',
  `create_date` datetime NOT NULL COMMENT '创建时间',
  `update_user` varchar(101) NOT NULL COMMENT '更新人',
  `update_date` datetime NOT NULL COMMENT '更新时间',
  `price` varchar(255) DEFAULT '0' COMMENT '账户余额',
  `price_add_date` datetime DEFAULT NULL COMMENT ' 充值时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5275 DEFAULT CHARSET=utf8;
