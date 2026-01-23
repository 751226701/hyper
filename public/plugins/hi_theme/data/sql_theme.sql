
--
-- 表的结构 `cmf_plugin_theme`
--

CREATE TABLE IF NOT EXISTS `cmf_plugin_theme` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `theme_url` varchar(100) CHARACTER SET utf8mb4 NOT NULL COMMENT '域名',
  `pc_theme` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '电脑端模板',
  `mobile_theme` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '移动端模板',
  `msg` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '备注',
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT '0' COMMENT '状态;1:正常;0:禁用',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `more` text COMMENT '扩展属性',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='插件 模板演示表';
