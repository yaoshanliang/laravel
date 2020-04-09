/*
 Navicat Premium Data Transfer

 Source Server         : iat.net.cn
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : iat.net.cn:3306
 Source Schema         : laravel

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 09/04/2020 09:55:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for activity_log
-- ----------------------------
DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE `activity_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `subject_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `causer_id` int(11) DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of activity_log
-- ----------------------------
BEGIN;
INSERT INTO `activity_log` VALUES (1, 'default', 'created', 11, 'App\\Models\\Admin', NULL, NULL, '{\"attributes\":{\"account\":\"1\",\"name\":\"\",\"email\":\"\",\"phone\":\"\"}}', '2018-02-15 14:39:23', '2018-02-15 14:39:23');
INSERT INTO `activity_log` VALUES (2, 'default', 'updated', 11, 'App\\Models\\Admin', NULL, NULL, '{\"attributes\":{\"account\":\"222\"},\"old\":{\"account\":\"221\"}}', '2018-02-15 14:55:48', '2018-02-15 14:55:48');
INSERT INTO `activity_log` VALUES (3, 'default', 'updated', 11, 'App\\Models\\Admin', NULL, NULL, '{\"attributes\":{\"account\":\"2221\"},\"old\":{\"account\":\"222\"}}', '2018-02-15 14:58:32', '2018-02-15 14:58:32');
INSERT INTO `activity_log` VALUES (4, 'default', 'updated', 10, 'App\\Models\\Admin', NULL, NULL, '{\"attributes\":{\"account\":\"112222\"},\"old\":{\"account\":\"112\"}}', '2018-02-15 14:58:59', '2018-02-15 14:58:59');
INSERT INTO `activity_log` VALUES (5, 'default', 'updated', 8, 'App\\Models\\Admin', NULL, NULL, '{\"attributes\":{\"account\":\"6922\"},\"old\":{\"account\":\"69\"}}', '2018-02-15 15:00:53', '2018-02-15 15:00:53');
INSERT INTO `activity_log` VALUES (6, 'default', 'created', 12, 'App\\Models\\Admin', NULL, NULL, '{\"attributes\":{\"account\":\"1\",\"name\":\"\",\"email\":\"\",\"phone\":\"\"}}', '2018-02-15 15:02:30', '2018-02-15 15:02:30');
INSERT INTO `activity_log` VALUES (7, 'default', 'deleted', 12, 'App\\Models\\Admin', NULL, NULL, '{\"attributes\":{\"account\":\"1\",\"name\":\"\",\"email\":\"\",\"phone\":\"\"}}', '2018-02-15 15:02:33', '2018-02-15 15:02:33');
INSERT INTO `activity_log` VALUES (8, 'default', 'created', 9, 'App\\Models\\Admin', NULL, NULL, '{\"attributes\":{\"account\":\"tester\",\"name\":\"\",\"email\":\"\",\"phone\":\"\",\"role_id\":null,\"role_name\":\"\"}}', '2019-10-17 21:05:26', '2019-10-17 21:05:26');
INSERT INTO `activity_log` VALUES (9, 'default', 'updated', 9, 'App\\Models\\Admin', NULL, NULL, '{\"attributes\":{\"role_name\":\"\\u8d85\\u7ea7\\u7ba1\\u7406\\u5458\"},\"old\":{\"role_name\":\"\"}}', '2019-10-17 21:05:39', '2019-10-17 21:05:39');
INSERT INTO `activity_log` VALUES (10, 'default', 'updated', 9, 'App\\Models\\Admin', NULL, NULL, '{\"attributes\":{\"name\":\"What can I do if I forget the password?!\"},\"old\":{\"name\":\"\"}}', '2019-10-17 21:07:03', '2019-10-17 21:07:03');
INSERT INTO `activity_log` VALUES (11, 'default', 'updated', 9, 'App\\Models\\Admin', NULL, NULL, '{\"attributes\":{\"name\":\"What can I do if I forget the password?\"},\"old\":{\"name\":\"What can I do if I forget the password?!\"}}', '2019-10-17 21:07:22', '2019-10-17 21:07:22');
COMMIT;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `account` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '账号',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '真实姓名',
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '邮箱',
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '手机号',
  `role_id` int(11) DEFAULT NULL COMMENT '角色ID',
  `role_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '角色',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '密码',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '记住密码',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '管理员状态(0:正常,1:不可登录)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admins_email_index` (`email`),
  KEY `admins_phone_index` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of admins
-- ----------------------------
BEGIN;
INSERT INTO `admins` VALUES (1, 'admin', '1', '1329517386@qq.com', '', 0, '超级管理员', '$2y$10$eOr1uZwYZ.rsUzKFGV1y3uvKwvZF7lf74M3hTWOLUi5lxAYsgIwu.', 'LKB9lpu5AlyH9Nn4HuZeZJDWGj9qSWl52bEAO0zdOgI7RttVfpCXbJ51lqbG', 0, '2017-04-08 15:01:15', '2018-12-15 14:23:05');
INSERT INTO `admins` VALUES (4, '21', '', '', '', 0, '超级管理员', '$2y$10$d7pJUxndAdr67XH3ZLkEMeSy/IBjXtZu9VMkhbvFnX6y8OOTaRsHG', NULL, 0, '2017-04-12 10:14:11', '2018-01-04 17:00:50');
INSERT INTO `admins` VALUES (5, '111', '', '', '', 0, '超级管理员', '$2y$10$J6n5rtPJTAtOL1bnFVarnudFmApDHnnS9hB7fcah6urdVooNnRhlK', NULL, 0, '2017-04-13 10:50:46', '2018-01-04 17:00:42');
INSERT INTO `admins` VALUES (6, '1111', '', '', '', NULL, '', '$2y$10$AcQs0qp0lS/ocCrRbpn4we6BKA2c1cphPz9B.cEKmMAEiZUq6YMRa', NULL, 0, '2018-02-14 21:24:44', '2018-02-14 21:24:44');
INSERT INTO `admins` VALUES (8, '226922', '', '', '', NULL, '', '$2y$10$IVNB3Ndnhu7NqlbVSS27geq35h18yIhkJY.KmwqWHXG//7wOiNxiu', NULL, 0, '2018-02-15 11:50:16', '2018-02-15 15:01:14');
INSERT INTO `admins` VALUES (9, 'tester', 'What can I do if I forget the password?', '', '', 0, '超级管理员', '$2y$10$FpGxZc66636gzLm7i0IFROrgEUVuiiNuFrPh4jO90j2PHGQHOCmK6', NULL, 0, '2019-10-17 21:05:26', '2019-10-17 21:07:22');
COMMIT;

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  UNIQUE KEY `cache_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cache
-- ----------------------------
BEGIN;
INSERT INTO `cache` VALUES ('laravel5da6181fbeac60a899bdc677ea4c64352daad608', 'eyJpdiI6IjdpbjBqUE00RDhic2FXV0V4VWI4OFE9PSIsInZhbHVlIjoiUFg3RWdDQ0lIcFJ1UWVvVlVnZ3dtQT09IiwibWFjIjoiNjc4MzA2ZjI3ZDExMTg0NDI0ZDU3ODRiMzM5MTEwODY3YWNkZTNkYzQ2OThhZDZkMmRlMDhmZDdjZDM5ODM0NyJ9', 1492495462);
INSERT INTO `cache` VALUES ('laravela28014ea0ecf6696758118c4e90892a8831b258b', 'eyJpdiI6ImkwVFlqZDE3enRmYjJhOUM5UFh5RVE9PSIsInZhbHVlIjoiNEVzM3VqejBZZjZ3V1ZhUms4REwyUT09IiwibWFjIjoiZmU1YWVmYzYzODJjNDc3ZTdkNDllMzNlZjdjYzU4NzZhMTEwZDkzNmE2ZmM5YzU3MzJmMGYyNWY5ZTYyNzZiNiJ9', 1492498287);
INSERT INTO `cache` VALUES ('laravelc0818a0c21b9dac8587669897a2a431152fb484c', 'eyJpdiI6IkY5XC9LaHZsWUhCcm9ZOTZQR1wvQmpTQT09IiwidmFsdWUiOiJiYldJSUNURlhNQ2lodFIyNmlYbHB3PT0iLCJtYWMiOiI3Y2UzMTRmNjc3MTg2NjJmZWU1ODRjYTMzMDRhODIxM2I3MWE2ZDUyMzM0MGFkYTE4MDMyYWUyZjJiYjUyNTc0In0=', 1492497639);
COMMIT;

-- ----------------------------
-- Table structure for images
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '文件名',
  `file_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '文件路径',
  `public_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '对外url',
  `extension` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '文件扩展名',
  `mime_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'minetype',
  `size` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '文件大小',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `width` int(11) NOT NULL COMMENT '宽',
  `height` int(11) NOT NULL COMMENT '高',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of images
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_reserved_at_index` (`queue`,`reserved_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for logs
-- ----------------------------
DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `guard` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '来源',
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `request_method` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '请求方式',
  `request_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '请求地址',
  `request_params` text COLLATE utf8_unicode_ci COMMENT '请求参数',
  `response_code` int(11) DEFAULT NULL COMMENT '返回码',
  `response_message` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '返回消息',
  `response_data` text COLLATE utf8_unicode_ci COMMENT '返回数据',
  `user_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户IP',
  `user_agent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户agent',
  `server_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '服务器IP',
  `request_time_float` double(14,4) NOT NULL COMMENT '请求时间',
  `pushed_time_float` double(14,4) NOT NULL COMMENT '响应时间',
  `poped_time_float` double(14,4) NOT NULL COMMENT '处理时间',
  `created_time_float` double(14,4) NOT NULL COMMENT '写库时间',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1352 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of logs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sessions
-- ----------------------------
BEGIN;
INSERT INTO `sessions` VALUES ('7ITSfcRvQL4H6qctfh5JFa0zVmewa6MR177IzJS7', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.108 Safari/537.36', 'YTo4OntzOjM6InVybCI7YTowOnt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sYXJhdmVsLmRldi5jb20vYWRtaW4vc2VsZi9pbmZvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6Ik5JUGZ3QVVGUlhDRmgyaWFkTkJvRTJQT2lLWTN6Yk5kODZ0Z2w2REMiO3M6NzoiY2FwdGNoYSI7czo1OiJiaGp6NSI7czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTM6Imxhc3RfYWN0aXZpdHkiO2k6MTUxNTExMzQxMDtzOjk6Il9zZjJfbWV0YSI7YTozOntzOjE6InUiO2k6MTUxNTExMzQxMDtzOjE6ImMiO2k6MTUxNTA0OTc3MztzOjE6ImwiO3M6MToiMCI7fX0=', 1515113411);
COMMIT;

-- ----------------------------
-- Table structure for system_configs
-- ----------------------------
DROP TABLE IF EXISTS `system_configs`;
CREATE TABLE `system_configs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'key',
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'value',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '描述',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of system_configs
-- ----------------------------
BEGIN;
INSERT INTO `system_configs` VALUES (4, 'WECHAT_OFFICIAL_ACCOUNT_APPID', 'wxc38aac81d04571b3', '公众号appid', '2018-01-31 10:24:58', '2018-01-31 10:24:58');
INSERT INTO `system_configs` VALUES (5, 'WECHAT_OFFICIAL_ACCOUNT_SECRET', '1014c5852e6c3e091162c11d8443055b', '公众号appsecret', '2018-01-31 10:25:31', '2018-01-31 10:25:31');
INSERT INTO `system_configs` VALUES (6, 'WECHAT_OFFICIAL_ACCOUNT_TOKEN', 'laravel', '公众号token', '2018-01-31 10:25:49', '2018-01-31 10:25:49');
INSERT INTO `system_configs` VALUES (7, 'WECHAT_OFFICIAL_ACCOUNT_AES_KEY', 'AoYJdy8dobtmMDdHhQKYGzO5TrFafF5Aak6VdlOxEFh', '公众号aes key', '2018-01-31 10:26:23', '2018-01-31 10:26:23');
INSERT INTO `system_configs` VALUES (8, 'ALIYUN_ACCESS_KEY_ID', 'LTAIPfS2U5rj91Eu', '阿里短信key id', '2018-01-31 10:27:00', '2018-01-31 10:27:00');
INSERT INTO `system_configs` VALUES (9, 'ALIYUN_ACCESS_KEY_SECRET', 'LD0pWgjohAr3ZWb53jAOUtOvXNVJ0H', '阿里短信key secret', '2018-01-31 10:27:18', '2018-01-31 10:27:18');
INSERT INTO `system_configs` VALUES (10, 'ALIYUN_SIGN_NAME', '猎鹰品牌推广', '阿里短信签名', '2018-01-31 10:27:42', '2018-01-31 10:27:42');
INSERT INTO `system_configs` VALUES (11, 'ALIYUN_TEMPLATE_ID', 'SMS_109490178', '阿里短信模板id', '2018-01-31 10:28:04', '2018-02-01 09:17:02');
COMMIT;

-- ----------------------------
-- Table structure for tokens
-- ----------------------------
DROP TABLE IF EXISTS `tokens`;
CREATE TABLE `tokens` (
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '令牌',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `client` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '来源',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `expired_at` timestamp NULL DEFAULT NULL COMMENT '失效时间',
  PRIMARY KEY (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tokens
-- ----------------------------
BEGIN;
INSERT INTO `tokens` VALUES ('1', 1, NULL, '2017-04-18 14:03:26', '2017-04-18 14:03:26', '2017-04-28 14:03:26');
INSERT INTO `tokens` VALUES ('87173d4de630041164d07b464559f230', 1, NULL, '2017-04-18 14:01:31', '2017-04-18 14:01:31', '2017-04-28 14:01:31');
INSERT INTO `tokens` VALUES ('89a6ed79757e12edd54ea23a5e3771dc', 1, NULL, '2017-04-18 14:01:08', '2017-04-18 14:01:08', '2017-04-28 14:01:08');
INSERT INTO `tokens` VALUES ('8caf4304446f43371b1d8e4d04210c24', 1, NULL, '2017-04-18 14:01:47', '2017-04-18 14:01:47', '2017-04-28 14:01:47');
INSERT INTO `tokens` VALUES ('95851561a34061dbcde15b68fe6e63d8', 1, NULL, '2017-04-18 14:03:23', '2017-04-18 14:03:23', '2017-04-28 14:03:23');
INSERT INTO `tokens` VALUES ('9d0e25f0cc96a6b848fef5727872a3da', 1, NULL, '2017-04-18 14:01:13', '2017-04-18 14:01:13', '2017-04-28 14:01:13');
INSERT INTO `tokens` VALUES ('ec863bacebecd29eee369ef23584e889', 1, NULL, '2017-04-18 14:01:42', '2017-04-18 14:01:42', '2017-04-28 14:01:42');
INSERT INTO `tokens` VALUES ('ff18593847bd97005f79c7e803df904c', 1, NULL, '2017-04-18 14:03:30', '2017-04-18 14:03:30', '2017-04-28 14:03:30');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `account` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '账号',
  `realname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '真实姓名',
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '邮箱',
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '手机号',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '密码',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '记住密码',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '管理员状态(0:正常,1:不可登录)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `openid` varchar(255) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '微信openid',
  `headimgurl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '头像',
  `nickname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '昵称',
  `weapp_openid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '小程序openid',
  `weapp_nickname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '昵称',
  `weapp_avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '头像',
  PRIMARY KEY (`id`),
  KEY `users_email_index` (`email`),
  KEY `users_phone_index` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 'user', '', '', '', '$2y$10$ZfuX/8jzzYf8X7sBsJ3qXOhu4OhSv1qKPAbk8Iw1gHyXPQtfOZRHC', NULL, 0, '2017-04-08 15:25:51', '2017-04-08 15:25:51', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (2, '', '', '', '', '', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (9, '121', '', '', '', '$2y$10$H5tL2X0bedyNMGsEg1C1b./mRbsLo8jUxBJWhJ9xekJekRF5pfpRK', NULL, 0, '2017-10-31 10:56:34', '2017-10-31 10:56:34', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (11, '2121', '2121', '21@qq.com', '21111111111', '$2y$10$AqZtb0ESn03dkmMIZGeVy.EJcOuKVPPWmir2E/DAQL/IEGAcyb3Mu', NULL, 0, '2017-10-31 10:57:19', '2017-10-31 10:57:19', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (12, '234', '张', '56@qq.com', '13376748236', '$2y$10$cLHlz88HEDDX60K3Uzx9/ONLze0MRm3CqvfnGO3vjszM1MnFRJAjm', NULL, 0, '2017-11-01 09:27:25', '2017-11-01 09:27:25', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (14, '26', 'uu', '34@qq.com', '25377944323', '$2y$10$mWMhi6JM992ljIaLouDudO308/WQo3IJaAk1JDm6OcQA6AqdxO76G', NULL, 0, '2017-11-01 09:39:39', '2017-11-01 10:14:27', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (15, '3232', '32323111', '111@1.com', '11111111111', '$2y$10$4n0leNfz0OM1dEY5OefXMOxdzTt6gswv.bLjLGUBJD3cVmovSA7eO', NULL, 0, '2018-01-10 15:25:02', '2018-01-10 15:25:26', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (16, '0518', '朱', '4545@qq.com', '18385425154', '$2y$10$QK72yNMC1I60KeFwnsNrrObXpMQdalcir6MZutqdNnqBYaTa6ye.m', NULL, 0, '2019-04-17 17:01:36', '2019-04-17 17:01:36', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (31, '', NULL, NULL, NULL, '', NULL, 0, '2019-08-21 17:23:19', '2019-09-04 15:49:56', '', NULL, NULL, 'oz2Ty5JbKU06evyynPfTZFYNYlBQ', '如果明天过后', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIk8gmzibwZ3mPgU3S5FWEXnbvEibzNkKBaeq1oia0mhE5U9MZcPnOumqCpN0cx4HFj34tuFCLajnLnw/132');
INSERT INTO `users` VALUES (32, 'hello', 'Hello, everyone! I\'m not the site developer.', '', '', '$2y$10$VDlUa6NUGS/wNMwzK94FXugKApCjwuhjze4DsQKqiJtx.WyHUlveS', NULL, 0, '2019-10-17 21:04:06', '2019-10-17 21:10:35', '', NULL, NULL, NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for wechat_menus
-- ----------------------------
DROP TABLE IF EXISTS `wechat_menus`;
CREATE TABLE `wechat_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '菜单类型（0：链接；1：发送消息；2：跳转小程序）',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单名',
  `has_sub` tinyint(4) NOT NULL DEFAULT '0' COMMENT '有无子菜单',
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '地址',
  `sort` tinyint(4) NOT NULL DEFAULT '1' COMMENT '排序',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父id',
  `app_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '小程序appid',
  `page_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '小程序pagepath',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of wechat_menus
-- ----------------------------
BEGIN;
INSERT INTO `wechat_menus` VALUES (1, 0, '个人中心', 0, 'https://www.baidu.com', 1, 0, NULL, NULL, '2018-01-25 18:26:31', '2018-01-25 18:26:31');
INSERT INTO `wechat_menus` VALUES (2, 0, '菜单2', 1, '', 2, 0, NULL, NULL, '2018-03-30 16:10:22', '2018-03-30 16:10:22');
INSERT INTO `wechat_menus` VALUES (3, 0, '11', 0, '11', 1, 1, NULL, NULL, '2018-03-30 16:14:31', '2018-03-30 16:14:31');
INSERT INTO `wechat_menus` VALUES (5, 0, '22', 1, '', 3, 0, NULL, NULL, '2018-03-30 16:24:36', '2018-03-30 16:24:36');
COMMIT;

-- ----------------------------
-- Table structure for wechat_replys
-- ----------------------------
DROP TABLE IF EXISTS `wechat_replys`;
CREATE TABLE `wechat_replys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '0:文本回复,1:单图文',
  `keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '关键字',
  `content` text COLLATE utf8_unicode_ci NOT NULL COMMENT '回复内容',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '图文标题',
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '图文封面',
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '链接地址',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of wechat_replys
-- ----------------------------
BEGIN;
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
