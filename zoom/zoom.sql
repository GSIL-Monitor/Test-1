/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : zoom

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-06-23 12:16:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `animal`
-- ----------------------------
DROP TABLE IF EXISTS `animal`;
CREATE TABLE `animal` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `number` char(5) NOT NULL COMMENT '编号',
  `nickname` varchar(32) NOT NULL COMMENT '昵称',
  `age` smallint(6) NOT NULL COMMENT '年龄',
  `sex` char(1) NOT NULL COMMENT '性别',
  `species_id` int(11) NOT NULL COMMENT '物种ID（species表主键ID）',
  `health` varchar(64) NOT NULL COMMENT '健康',
  `requirement` varchar(256) NOT NULL COMMENT '特殊需求',
  `category` varchar(32) NOT NULL COMMENT '类别',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='动物表';

-- ----------------------------
-- Records of animal
-- ----------------------------
INSERT INTO `animal` VALUES ('3', '1099', '小蚂蚁', '10', '男', '6', '良好健康', '打洞', '喜欢阴冷潮湿的');
INSERT INTO `animal` VALUES ('4', '2901', '红色小象', '10', '男', '5', '中度疾病', '爱扣鼻屎12', '爬行动物');
INSERT INTO `animal` VALUES ('6', '1024', '小猫', '10', '女', '6', '良好健康', '打洞', '私家类动物1');

-- ----------------------------
-- Table structure for `doctor`
-- ----------------------------
DROP TABLE IF EXISTS `doctor`;
CREATE TABLE `doctor` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `name` varchar(8) NOT NULL COMMENT '姓名',
  `age` tinyint(1) NOT NULL COMMENT '年龄',
  `work_years` tinyint(1) NOT NULL COMMENT '工龄',
  `area` varchar(64) NOT NULL COMMENT '区域',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='兽医表';

-- ----------------------------
-- Records of doctor
-- ----------------------------
INSERT INTO `doctor` VALUES ('1', '胡锦', '28', '9', '熊猫区');
INSERT INTO `doctor` VALUES ('3', '发发', '20', '5', '熊猫区');
INSERT INTO `doctor` VALUES ('4', '金三顺', '30', '10', '虎山区');
INSERT INTO `doctor` VALUES ('5', '晋剧', '33', '2', '大象区');

-- ----------------------------
-- Table structure for `feeder`
-- ----------------------------
DROP TABLE IF EXISTS `feeder`;
CREATE TABLE `feeder` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `name` varchar(8) NOT NULL COMMENT '姓名',
  `age` tinyint(4) NOT NULL COMMENT '年龄',
  `work_years` tinyint(1) NOT NULL COMMENT '工龄',
  `sex` char(1) NOT NULL COMMENT '性别',
  `is_captain` char(1) NOT NULL DEFAULT '否' COMMENT '是否是队长',
  `team_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='饲养员表';

-- ----------------------------
-- Records of feeder
-- ----------------------------
INSERT INTO `feeder` VALUES ('1', '马田', '20', '5', '男', '否', '2');
INSERT INTO `feeder` VALUES ('3', '望三', '19', '11', '男', '否', '2');
INSERT INTO `feeder` VALUES ('4', '罗京', '33', '11', '女', '是', '2');
INSERT INTO `feeder` VALUES ('5', '海清', '34', '2', '男', '是', '3');

-- ----------------------------
-- Table structure for `feed_log`
-- ----------------------------
DROP TABLE IF EXISTS `feed_log`;
CREATE TABLE `feed_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `animal_id` int(11) NOT NULL COMMENT '动物id',
  `feeder_id` int(11) NOT NULL COMMENT '饲养员id',
  `food_id` int(11) NOT NULL COMMENT '饲料id',
  `record_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '记录时间',
  `use_stock` int(11) NOT NULL COMMENT '投喂量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='喂养记录表';

-- ----------------------------
-- Records of feed_log
-- ----------------------------
INSERT INTO `feed_log` VALUES ('1', '3', '1', '2', '2018-06-16 17:27:43', '2');
INSERT INTO `feed_log` VALUES ('2', '3', '3', '3', '2018-06-16 20:37:52', '1');
INSERT INTO `feed_log` VALUES ('3', '6', '1', '6', '2018-06-17 10:05:37', '2');

-- ----------------------------
-- Table structure for `food`
-- ----------------------------
DROP TABLE IF EXISTS `food`;
CREATE TABLE `food` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL COMMENT '饲料名',
  `production_date` date NOT NULL COMMENT '生产日期',
  `period` smallint(6) NOT NULL COMMENT '保质期',
  `price` decimal(10,2) NOT NULL COMMENT '价格',
  `unit` varchar(8) NOT NULL COMMENT '单位',
  `stock` int(11) NOT NULL COMMENT '库存',
  `channel` varchar(64) NOT NULL COMMENT '进货渠道',
  `method` varchar(64) NOT NULL COMMENT '使用方法',
  `object` varchar(256) NOT NULL COMMENT '适用类别',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='饲料表';

-- ----------------------------
-- Records of food
-- ----------------------------
INSERT INTO `food` VALUES ('1', '晋剧', '2011-10-22', '102', '200.02', '吨', '228', '直接2', '使用2', '爬行动物');
INSERT INTO `food` VALUES ('2', '复合肥', '2017-12-02', '330', '290.00', '吨', '61', '托运', '投喂', '喜欢阴冷潮湿的');
INSERT INTO `food` VALUES ('3', '毛球', '2017-12-02', '200', '100.00', '吨', '99', '购买', '喷射', '喜欢阴冷潮湿的,爬行动物');
INSERT INTO `food` VALUES ('4', '大米', '2011-11-11', '200', '200.00', '吨', '20', '赠送', '投喂', '喜欢阴冷潮湿的,爬行动物');
INSERT INTO `food` VALUES ('5', '小弄下', '2018-06-14', '1', '290.00', 'kg', '100', '赠与', '是非', '爬行动物');
INSERT INTO `food` VALUES ('7', '泥鳅', '2018-01-01', '100', '200.00', 'kg', '100', '赠送', '是非', '喜欢阴冷潮湿的');

-- ----------------------------
-- Table structure for `health_log`
-- ----------------------------
DROP TABLE IF EXISTS `health_log`;
CREATE TABLE `health_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `animal_id` int(11) NOT NULL COMMENT '动物id',
  `doctor_id` int(11) NOT NULL COMMENT '饲养员id',
  `old` varchar(64) NOT NULL COMMENT '治疗前',
  `new` varchar(64) NOT NULL COMMENT '治疗后',
  `record_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '记录时间',
  `remark` varchar(256) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='治疗记录表';

-- ----------------------------
-- Records of health_log
-- ----------------------------
INSERT INTO `health_log` VALUES ('2', '4', '1', '轻微疾病', '一般健康', '2018-06-16 18:03:10', 'duoheshui');
INSERT INTO `health_log` VALUES ('3', '4', '1', '轻微疾病', '良好健康', '2018-06-16 18:09:42', '');
INSERT INTO `health_log` VALUES ('4', '4', '3', '轻微疾病', '中度疾病', '2018-06-16 22:15:01', '治不好了');

-- ----------------------------
-- Table structure for `message`
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `record_time` datetime NOT NULL COMMENT '记录时间',
  `message` varchar(256) NOT NULL COMMENT '消息',
  `food_id` int(11) NOT NULL COMMENT '饲料id',
  `flag` char(1) NOT NULL DEFAULT '否' COMMENT '阅读标示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='系统消息';

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES ('1', '0000-00-00 00:00:00', '库存不足请及时进货', '0', '是');
INSERT INTO `message` VALUES ('2', '0000-00-00 00:00:00', '库存不足请及时进货', '0', '是');
INSERT INTO `message` VALUES ('3', '0000-00-00 00:00:00', '库存不足请及时进货', '0', '是');
INSERT INTO `message` VALUES ('4', '0000-00-00 00:00:00', '库存不足请及时进货', '0', '是');
INSERT INTO `message` VALUES ('5', '0000-00-00 00:00:00', '请注意饲料已过期！！！', '0', '是');
INSERT INTO `message` VALUES ('6', '0000-00-00 00:00:00', '库存不足请及时进货', '0', '是');
INSERT INTO `message` VALUES ('7', '0000-00-00 00:00:00', '请注意饲料已过期！！！', '0', '是');
INSERT INTO `message` VALUES ('8', '0000-00-00 00:00:00', '库存不足请及时进货', '0', '是');
INSERT INTO `message` VALUES ('9', '0000-00-00 00:00:00', '请注意饲料已过期！！！', '0', '是');
INSERT INTO `message` VALUES ('10', '0000-00-00 00:00:00', '库存不足请及时进货', '0', '是');
INSERT INTO `message` VALUES ('11', '0000-00-00 00:00:00', '请注意饲料已过期！！！', '0', '是');
INSERT INTO `message` VALUES ('12', '0000-00-00 00:00:00', '请注意饲料已过期！！！', '0', '是');
INSERT INTO `message` VALUES ('13', '0000-00-00 00:00:00', '请注意饲料已过期！！！', '0', '是');
INSERT INTO `message` VALUES ('14', '2018-06-16 21:44:54', '库存不足请及时进货', '0', '是');
INSERT INTO `message` VALUES ('15', '2018-06-16 21:44:54', '请注意饲料已过期！！！', '0', '是');
INSERT INTO `message` VALUES ('16', '2018-06-16 21:45:17', '库存不足请及时进货', '0', '是');
INSERT INTO `message` VALUES ('17', '2018-06-16 21:45:17', '请注意饲料已过期！！！', '0', '是');
INSERT INTO `message` VALUES ('18', '2018-06-17 09:41:34', '请注意饲料已过期！！！', '0', '是');
INSERT INTO `message` VALUES ('19', '2018-06-17 10:05:37', '库存不足请及时进货', '0', '是');
INSERT INTO `message` VALUES ('20', '2018-06-17 13:58:02', '请注意饲料已过期！！！', '7', '是');
INSERT INTO `message` VALUES ('21', '2018-06-17 13:58:33', '请注意饲料已过期！！！', '5', '是');

-- ----------------------------
-- Table structure for `species`
-- ----------------------------
DROP TABLE IF EXISTS `species`;
CREATE TABLE `species` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `name` varchar(64) NOT NULL COMMENT '物种名',
  `lifetime` smallint(6) NOT NULL COMMENT '寿命',
  `protection_level` tinyint(1) NOT NULL COMMENT '保护级别',
  `habit` varchar(256) NOT NULL COMMENT '习性',
  `habitat` varchar(64) NOT NULL COMMENT '栖息地',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='物种表';

-- ----------------------------
-- Records of species
-- ----------------------------
INSERT INTO `species` VALUES ('5', '香茅', '80', '3', '喜欢水', '水族馆');
INSERT INTO `species` VALUES ('6', '蚂蚁', '10', '2', '喜欢黑暗', '洞穴');
INSERT INTO `species` VALUES ('7', '水生生物', '100', '3', '阴冷潮湿', '大海');

-- ----------------------------
-- Table structure for `team`
-- ----------------------------
DROP TABLE IF EXISTS `team`;
CREATE TABLE `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `name` varchar(32) NOT NULL COMMENT '队名',
  `area` varchar(64) NOT NULL COMMENT '区域',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='饲养队';

-- ----------------------------
-- Records of team
-- ----------------------------
INSERT INTO `team` VALUES ('2', 'zoom二队', '大象区');
INSERT INTO `team` VALUES ('3', 'zoom一队', '熊猫区');
DROP TRIGGER IF EXISTS `stock_notice_insert`;
DELIMITER ;;
CREATE TRIGGER `stock_notice_insert` AFTER INSERT ON `food` FOR EACH ROW begin
DECLARE leftstock int;
set leftstock = NEW.stock ;
if( leftstock<100) then
insert into message(message,food_id,record_time) 
values('库存不足请及时进货',NEW.id,NOW());
end if;
if( datediff(NOW() ,NEW.production_date) >NEW.period) then
insert into message(message,food_id,record_time) 
values('请注意饲料已过期！！！',NEW.id,NOW());
end if;
end
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `stock_notice_update`;
DELIMITER ;;
CREATE TRIGGER `stock_notice_update` AFTER UPDATE ON `food` FOR EACH ROW begin
DECLARE leftstock int;
set leftstock = NEW.stock ;
if( leftstock<100) then
insert into message(message,food_id,record_time) 
values('库存不足请及时进货',NEW.id,NOW());
end if;
if( datediff(NOW() ,NEW.production_date) >NEW.period) then
insert into message(message,food_id,record_time) 
values('请注意饲料已过期！！！',NEW.id,NOW());
end if;
end
;;
DELIMITER ;
