
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cmf_plugin_guestbook
-- ----------------------------
DROP TABLE IF EXISTS `cmf_plugin_guestbook`;
CREATE TABLE `cmf_plugin_guestbook` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID号',
  `name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `tel` varchar(15) DEFAULT NULL COMMENT '电话',
  `phone` varchar(15) DEFAULT NULL COMMENT '手机',
  `area` varchar(15) DEFAULT NULL COMMENT '地区',
  `fax` varchar(15) DEFAULT NULL COMMENT '传真',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `wechat` varchar(50) DEFAULT NULL COMMENT '微信',
  `qq` varchar(15) DEFAULT NULL COMMENT 'QQ号',
  `subject` varchar(255) DEFAULT NULL COMMENT '标题',
  `message` text COMMENT '留言信息',
  `siteUrl` text COMMENT '留言页面地址',
  `isread` tinyint(2) DEFAULT '1' COMMENT '是否查看过',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of cmf_plugin_guestbook
-- ----------------------------
SET FOREIGN_KEY_CHECKS=1;
