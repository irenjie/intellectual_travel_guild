/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 80011
Source Host           : localhost:3306
Source Database       : travelguide

Target Server Type    : MYSQL
Target Server Version : 80011
File Encoding         : 65001

Date: 2019-10-03 22:28:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `Admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `addedBy` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'ma', '123456', 'ma@gmail.com', 'ma@gmail.com');
INSERT INTO `admin` VALUES ('2', 'root', '123456', 'ma@163.com', 'ma@gmail.com');
INSERT INTO `admin` VALUES ('4', 'Fu', '123456', 'fu@163.com', 'ma@gmail.com');

-- ----------------------------
-- Table structure for `bookingtable`
-- ----------------------------
DROP TABLE IF EXISTS `bookingtable`;
CREATE TABLE `bookingtable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bookingplace` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hotel` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `bookedby` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time` date NOT NULL,
  `TrxID` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `status` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'applied',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of bookingtable
-- ----------------------------
INSERT INTO `bookingtable` VALUES ('7', '上海', '桔子水晶上海国际旅游度假区周浦万达酒店', 'fu@163.com', '18112345678', '2019-10-17', '1', '500', 'applied');

-- ----------------------------
-- Table structure for `hotelinfo`
-- ----------------------------
DROP TABLE IF EXISTS `hotelinfo`;
CREATE TABLE `hotelinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `place` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of hotelinfo
-- ----------------------------
INSERT INTO `hotelinfo` VALUES ('3', '杭州汇和君亭酒店', '杭州', '杭州市江干区新风路619号汇和城购物中心F1', '200');
INSERT INTO `hotelinfo` VALUES ('4', '桔子水晶上海国际旅游度假区周浦万达酒店', '上海', '上海 浦东新区 沪南公路3655弄2号', '500');
INSERT INTO `hotelinfo` VALUES ('5', '嘉虹酒店（上海虹桥机场店）', '上海', '上海 长宁区 沪青平公路38号', '300');

-- ----------------------------
-- Table structure for `placetable`
-- ----------------------------
DROP TABLE IF EXISTS `placetable`;
CREATE TABLE `placetable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plcaeName` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `details` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hotel` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastEdit` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `capacity` int(11) NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of placetable
-- ----------------------------
INSERT INTO `placetable` VALUES ('1', '上海', '上海外滩 、 南京路步行街 、 东方明珠 、 上海城隍庙 、 豫园 、 上海杜莎夫人蜡像馆 、 上海老街 、 文莱馆 、 上海滩第一私家花园 、 黑石公寓 、 朱敏堂宅......', '桔子水晶上海国际旅游度假区周浦万达酒店', 'fountain', 'ma@gmail.com', '45', '500');
INSERT INTO `placetable` VALUES ('13', '杭州', '西湖、苏堤、白堤、三潭印月、孤山、西泠印社、苏东坡纪念馆、素竹园、曲院风荷、花港观鱼、岳王庙(25元)、长桥公园、柳浪闻莺、断桥残雪、钱塘江、河坊街、南宋御街、雷峰塔......', '杭州汇和君亭酒店', 'cultural', 'ma@gmail.com', '50', '200');

-- ----------------------------
-- Table structure for `usertable`
-- ----------------------------
DROP TABLE IF EXISTS `usertable`;
CREATE TABLE `usertable` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of usertable
-- ----------------------------
INSERT INTO `usertable` VALUES ('4', 'Ma', '$2y$10$8/AhlKf31wdPfWbRS6sGbODutyUMjrrhnZhDQo84BecnIfPd2ZBUu', 'ma@gmail.com', '13282412329');
INSERT INTO `usertable` VALUES ('5', 'Fu', '$2y$10$TRqOy2hqw4CiIdUn6VsnWOlW60UOSS4iePeDkmGA/JmRjqvpu4sQC', 'fu@163.com', '18112345678');
