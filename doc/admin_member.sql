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
  `update_date` datetime DEFAULT NULL COMMENT '更新时间',
  `wallet_balance` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '账户余额',
  `wallet_create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '钱包充值时间',
  `prefix_name` varchar(255) NOT NULL DEFAULT '' COMMENT '前缀名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5275 DEFAULT CHARSET=utf8;
