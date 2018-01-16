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
ADD COLUMN `is_super`  tinyint UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否是超级管理员1是，0否' AFTER `update_date`;

ALTER TABLE `admin_school`
ADD COLUMN `professional_score`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '专业录取分数text' AFTER `professional_score`;





