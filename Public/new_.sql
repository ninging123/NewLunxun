/*
 Navicat Premium Data Transfer

 Source Server         : 本地mysql
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : new_

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 19/12/2019 11:35:38
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for l_admin
-- ----------------------------
DROP TABLE IF EXISTS `l_admin`;
CREATE TABLE `l_admin`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户名',
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码',
  `rule` varchar(99) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '权限',
  `insert_time` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '创建时间',
  `update_time` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '最后修改时间',
  `bindMobile` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '手机号',
  `bindMail` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '邮箱',
  `identifier` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '第二身份标识',
  `token` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '永久登陆标识',
  `timeout` int(11) UNSIGNED NULL DEFAULT NULL COMMENT '永久登陆超时时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of l_admin
-- ----------------------------
INSERT INTO `l_admin` VALUES (1, 'admin', '964a3fe0b97aacd20e481a3287e5c8fd', '', '1576671537', NULL, '17629357052', '972341480@qq.com', '1b937f521a6b7cad9c19f946b95e8b8b', '86458fe802ec400996198b48041671fa', 1577315303);
INSERT INTO `l_admin` VALUES (2, 'home', '123456', '', '1576671537', NULL, '17629357051', NULL, NULL, NULL, NULL);
INSERT INTO `l_admin` VALUES (3, 'ceshi', '123456', '', '1576671537', NULL, '', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for l_admin_log
-- ----------------------------
DROP TABLE IF EXISTS `l_admin_log`;
CREATE TABLE `l_admin_log`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT ' ',
  `uid` int(11) UNSIGNED NOT NULL,
  `ip` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `city` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '地区',
  `type` tinyint(1) UNSIGNED NOT NULL COMMENT '1 管理员登陆  2用户登陆',
  `login_time` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_del` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否删除   0 未删除  1已删除',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 149 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of l_admin_log
-- ----------------------------
INSERT INTO `l_admin_log` VALUES (35, 1, '127.0.0.1', '内网IP内网IP', 1, '1576699966', 0);
INSERT INTO `l_admin_log` VALUES (36, 1, '127.0.0.1', '内网IP内网IP', 1, '1576700011', 0);
INSERT INTO `l_admin_log` VALUES (37, 1, '127.0.0.1', '内网IP内网IP', 1, '1576700039', 0);
INSERT INTO `l_admin_log` VALUES (38, 1, '127.0.0.1', '内网IP内网IP', 1, '1576700056', 0);
INSERT INTO `l_admin_log` VALUES (39, 1, '127.0.0.1', '内网IP内网IP', 1, '1576700127', 0);
INSERT INTO `l_admin_log` VALUES (40, 1, '127.0.0.1', '内网IP内网IP', 1, '1576700131', 0);
INSERT INTO `l_admin_log` VALUES (41, 1, '127.0.0.1', '内网IP内网IP', 1, '1576700141', 0);
INSERT INTO `l_admin_log` VALUES (42, 1, '127.0.0.1', '内网IP内网IP', 1, '1576700188', 0);
INSERT INTO `l_admin_log` VALUES (43, 1, '127.0.0.1', '内网IP内网IP', 1, '1576700308', 0);
INSERT INTO `l_admin_log` VALUES (44, 1, '127.0.0.1', '内网IP内网IP', 1, '1576700363', 0);
INSERT INTO `l_admin_log` VALUES (45, 1, '127.0.0.1', '内网IP内网IP', 1, '1576700377', 0);
INSERT INTO `l_admin_log` VALUES (46, 1, '127.0.0.1', '内网IP内网IP', 1, '1576700430', 0);
INSERT INTO `l_admin_log` VALUES (47, 1, '127.0.0.1', '内网IP内网IP', 1, '1576700515', 0);
INSERT INTO `l_admin_log` VALUES (48, 1, '127.0.0.1', '内网IP内网IP', 1, '1576700573', 0);
INSERT INTO `l_admin_log` VALUES (49, 1, '127.0.0.1', '内网IP内网IP', 1, '1576700630', 0);
INSERT INTO `l_admin_log` VALUES (50, 1, '127.0.0.1', '内网IP内网IP', 1, '1576700670', 0);
INSERT INTO `l_admin_log` VALUES (51, 1, '127.0.0.1', '内网IP内网IP', 1, '1576700695', 0);
INSERT INTO `l_admin_log` VALUES (61, 1, '127.0.0.1', '内网IP内网IP', 1, '1576700705', 0);
INSERT INTO `l_admin_log` VALUES (60, 1, '127.0.0.1', '内网IP内网IP', 1, '1576700715', 0);
INSERT INTO `l_admin_log` VALUES (59, 1, '127.0.0.1', '内网IP内网IP', 1, '1576700734', 0);
INSERT INTO `l_admin_log` VALUES (55, 1, '127.0.0.1', '外网IP外网IP', 1, '1576700744', 0);
INSERT INTO `l_admin_log` VALUES (56, 1, '127.0.0.1', '中国福建福州电信', 1, '1576700758', 0);
INSERT INTO `l_admin_log` VALUES (57, 1, '127.0.0.1', '中国四川成都电信', 1, '1576700761', 0);

-- ----------------------------
-- Table structure for l_config
-- ----------------------------
DROP TABLE IF EXISTS `l_config`;
CREATE TABLE `l_config`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `max_error_num` int(11) NOT NULL COMMENT '错误最大次数',
  `login_ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '允许登陆ip',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of l_config
-- ----------------------------
INSERT INTO `l_config` VALUES (1, 10, '');

-- ----------------------------
-- Table structure for l_mail
-- ----------------------------
DROP TABLE IF EXISTS `l_mail`;
CREATE TABLE `l_mail`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `is_open` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0  关闭   1 开启',
  `mail_host` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mail_port` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mail_user` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'SMTP服务器用户名',
  `mail_pass` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'SMTP服务器密码',
  `mail_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'SMTP服务器发件人用户名',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '邮箱配置' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of l_mail
-- ----------------------------
INSERT INTO `l_mail` VALUES (1, 1, 'smtp.qq.com', '465', '972341480@qq.com', 'jxkwrxrgzlzhbbaa', '未安网络');

-- ----------------------------
-- Table structure for l_sms
-- ----------------------------
DROP TABLE IF EXISTS `l_sms`;
CREATE TABLE `l_sms`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `is_open` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否开启，0关闭，1开启',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '配置表' ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of l_sms
-- ----------------------------
INSERT INTO `l_sms` VALUES (1, 1);

-- ----------------------------
-- Table structure for l_sms_source
-- ----------------------------
DROP TABLE IF EXISTS `l_sms_source`;
CREATE TABLE `l_sms_source`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mobile` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `createtime` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '异常手机号码列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of l_sms_source
-- ----------------------------
INSERT INTO `l_sms_source` VALUES (1, '17629357050', '1576681261');
INSERT INTO `l_sms_source` VALUES (2, '17629357050', '1576681392');
INSERT INTO `l_sms_source` VALUES (3, '17629357050', '1576681540');
INSERT INTO `l_sms_source` VALUES (4, '17629357050', '1576681874');

-- ----------------------------
-- Table structure for l_sms_template
-- ----------------------------
DROP TABLE IF EXISTS `l_sms_template`;
CREATE TABLE `l_sms_template`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标题',
  `template_code` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '阿里云模板代码',
  `call_index` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '调用字符串',
  `template_content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '模板内容',
  `createtime` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of l_sms_template
-- ----------------------------
INSERT INTO `l_sms_template` VALUES (1, '账户登陆', 'SMS_111795375', 'loginSend', '您的验证码为：${code} ，你正在进行${opration}操作，该验证码 5 分钟内有效，请勿泄露于他人。', '1527670734');

SET FOREIGN_KEY_CHECKS = 1;
