INSERT INTO `admin_menu` (
	`id`,
	`code`,
	`menu_name`,
	`module_id`,
	`display_label`,
	`des`,
	`display_order`,
	`entry_right_name`,
	`entry_url`,
	`action`,
	`controller`,
	`has_lef`,
	`create_user`,
	`create_date`,
	`update_user`,
	`update_date`
)
VALUES
	(
		1,
		'menu_manger',
		'菜单管理',
		1,
		'菜单管理',
		'菜单管理',
		1,
		'菜单管理',
		'admin-module/index',
		'index',
		'backend\\controllers\\AdminMenuController',
		'n',
		'admin',
		'2016-08-11 16:44:11',
		'admin',
		'2016-08-11 16:44:11'
	);


ALTER TABLE `admin_user`
ADD COLUMN `is_super`  tinyint UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否是超级管理员1是，0否';

ALTER TABLE `admin_school`
ADD COLUMN `professional_score`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '专业录取分数text';


ALTER TABLE `admin_school`
MODIFY COLUMN `spec`  varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '特殊属性';


CREATE TABLE `admin_finance` (
  `id` smallint(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `module_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '收费模块id',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '开启状态1：是，0否',
  `fee` decimal(10,0) NOT NULL DEFAULT '0' COMMENT '收费标准',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `update_user` varchar(128) NOT NULL DEFAULT '' COMMENT '修改人',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;








