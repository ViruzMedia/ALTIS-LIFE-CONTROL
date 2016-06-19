/*
Navicat MySQL Data Transfer

Source Server         : alc.Pictureclass.de
Source Server Version : 50547
Source Host           : sql378.your-server.de:3306
Source Database       : pic_alc

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2016-04-08 22:04:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for alc_login_attempts
-- ----------------------------
DROP TABLE IF EXISTS `alc_login_attempts`;
CREATE TABLE `alc_login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of alc_login_attempts
-- ----------------------------

-- ----------------------------
-- Table structure for alc_settings
-- ----------------------------
DROP TABLE IF EXISTS `alc_settings`;
CREATE TABLE `alc_settings` (
  `statistic_cash` int(11) NOT NULL DEFAULT '1',
  `statistic_bankacc` int(11) NOT NULL DEFAULT '1',
  `statistic_cop` int(11) NOT NULL DEFAULT '1',
  `statistic_medic` int(11) NOT NULL DEFAULT '1',
  `statistic_admin` int(11) NOT NULL DEFAULT '1',
  `statistic_gangs` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of alc_settings
-- ----------------------------
INSERT INTO `alc_settings` VALUES ('1', '1', '1', '1', '1', '1');

-- ----------------------------
-- Table structure for alc_user
-- ----------------------------
DROP TABLE IF EXISTS `alc_user`;
CREATE TABLE `alc_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  `permission` int(2) NOT NULL DEFAULT '1',
  `activation_key` varchar(10) NOT NULL,
  `date_register` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_activate` datetime NOT NULL,
  `date_last_login` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of alc_user
-- ----------------------------
INSERT INTO `alc_user` VALUES ('18', 'admin', '', 'a3bde199589b523d3c36a71812ed757cc72ba2cd4cf460fcbe8e8d29a098b8eb35a9aeea6f3decc3c449c1c364b955e0d750b91599e5db5d0dd3dec299c95671', 'd020cb71486dcefcca0f1f0d6d0831e8c65eb2f1283ea447cbcb94196811bd232be06e9057d537a41ecf902a3852cff09af548ccf59212abac7c99c236a65e3f', '10', 'IrX9yYZd8o', '2016-04-08 21:59:08', '2016-04-08 22:01:00', '0000-00-00 00:00:00');
