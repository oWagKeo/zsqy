SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `zs_member`;
CREATE TABLE `zs_member` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `member_name` varchar(50) NOT NULL DEFAULT '' COMMENT '会员名称',
  `member_phone` varchar(15) NOT NULL DEFAULT '' COMMENT '会员电话',
  `member_email` varchar(50) NOT NULL DEFAULT '' COMMENT '会员邮箱',
  `real_name` varchar(10) NOT NULL DEFAULT '' COMMENT '真实名称',
  `nike_name` varchar(50) NOT NULL DEFAULT '' COMMENT '会员昵称',
  `add_time` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `lottery` int(10) NOT NULL DEFAULT '50' COMMENT '抽奖次数',
  `is_use` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否运行使用',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '会员状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

insert into `zs_member`(`id`,`member_name`,`member_phone`,`member_email`,`real_name`,`nike_name`,`add_time`,`update_time`,`lottery`,`is_use`,`status`) values('2','b','15828230599','','','','0','0','50','1','1');
