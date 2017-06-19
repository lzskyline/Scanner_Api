/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 100121
Source Host           : localhost:3306
Source Database       : scanner

Target Server Type    : MYSQL
Target Server Version : 100121
File Encoding         : 65001

Date: 2017-06-18 00:54:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for s_logistics
-- ----------------------------
DROP TABLE IF EXISTS `s_logistics`;
CREATE TABLE `s_logistics` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `oid` int(6) NOT NULL,
  `uid` int(6) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique logistics` (`oid`,`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_logistics
-- ----------------------------
INSERT INTO `s_logistics` VALUES ('1', '1', '1', '2017-06-07 20:58:05');

-- ----------------------------
-- Table structure for s_order
-- ----------------------------
DROP TABLE IF EXISTS `s_order`;
CREATE TABLE `s_order` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `express` varchar(32) NOT NULL,
  `uid` int(6) NOT NULL,
  `s_name` varchar(15) NOT NULL,
  `s_address` varchar(100) NOT NULL,
  `s_mobile` varchar(11) NOT NULL,
  `r_name` varchar(15) NOT NULL,
  `r_address` varchar(100) NOT NULL,
  `r_mobile` varchar(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `image` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_order
-- ----------------------------
INSERT INTO `s_order` VALUES ('1', '1234567890123', '1', 'sender', 'senderAddress', '13000000000', 'receiver', 'receiverAddress', '13000000001', '2017-06-07 20:57:53', '59455c722a9e7.png');

-- ----------------------------
-- Table structure for s_user
-- ----------------------------
DROP TABLE IF EXISTS `s_user`;
CREATE TABLE `s_user` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_user
-- ----------------------------
INSERT INTO `s_user` VALUES ('1', 'test', 'e10adc3949ba59abbe56e057f20f883e', '13131313131', '天津市');
