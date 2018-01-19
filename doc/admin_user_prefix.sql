CREATE TABLE `admin_user_prefix` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prefix` varchar(255) NOT NULL DEFAULT '' COMMENT '前缀',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '业务员id',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `update_user` varchar(255) NOT NULL DEFAULT '' COMMENT '更新人',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_prefix_user` (`prefix`,`user_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
