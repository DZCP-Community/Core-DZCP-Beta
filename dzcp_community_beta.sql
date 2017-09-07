/*
Navicat MySQL Data Transfer

Source Server         : Root-Online
Source Server Version : 50505
Source Host           : mysql.hammermaps.de:3306
Source Database       : dzcp_community_beta

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-09-07 16:32:34
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `dzcp_addon_mods`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_addon_mods`;
CREATE TABLE `dzcp_addon_mods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` bigint(12) NOT NULL DEFAULT 0,
  `title` varchar(200) NOT NULL DEFAULT '',
  `description` text DEFAULT NULL,
  `dzcp_edition` varchar(200) NOT NULL DEFAULT 'dev',
  `dzcp_version` varchar(10) NOT NULL DEFAULT '1.7',
  `version` varchar(20) NOT NULL DEFAULT '1.0',
  `beta` int(1) NOT NULL DEFAULT 0,
  `enabled` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`)
) ENGINE=Aria AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=1;

-- ----------------------------
-- Table structure for `dzcp_addon_mods_changelog`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_addon_mods_changelog`;
CREATE TABLE `dzcp_addon_mods_changelog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` bigint(12) NOT NULL DEFAULT 0,
  `date` int(20) NOT NULL DEFAULT 0,
  `title` varchar(200) NOT NULL DEFAULT '',
  `text` text DEFAULT NULL,
  `public` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`)
) ENGINE=Aria AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=1;

-- ----------------------------
-- Table structure for `dzcp_addon_version`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_addon_version`;
CREATE TABLE `dzcp_addon_version` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `static_version` varchar(30) NOT NULL DEFAULT '1.6',
  `version` varchar(10) NOT NULL DEFAULT '1.6',
  `edition` varchar(50) NOT NULL DEFAULT 'stable',
  `release` varchar(19) NOT NULL DEFAULT '00.00.0000',
  `build` varchar(30) NOT NULL DEFAULT '1700.00.00',
  `updated` int(11) NOT NULL DEFAULT 0,
  `enabled` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `updated` (`updated`)
) ENGINE=Aria AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_artikel`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_artikel`;
CREATE TABLE `dzcp_artikel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autor` int(11) NOT NULL DEFAULT 0,
  `datum` int(20) NOT NULL DEFAULT 0,
  `kat` int(5) NOT NULL DEFAULT 0,
  `titel` varchar(249) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  `link1` varchar(100) NOT NULL DEFAULT '',
  `url1` varchar(200) NOT NULL DEFAULT '',
  `link2` varchar(100) NOT NULL DEFAULT '',
  `url2` varchar(200) NOT NULL DEFAULT '',
  `link3` varchar(100) NOT NULL DEFAULT '',
  `url3` varchar(200) NOT NULL DEFAULT '',
  `public` int(1) NOT NULL DEFAULT 0,
  `viewed` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_artikel_comments`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_artikel_comments`;
CREATE TABLE `dzcp_artikel_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artikel` int(11) NOT NULL DEFAULT 0,
  `nick` varchar(50) NOT NULL DEFAULT '',
  `datum` int(20) NOT NULL DEFAULT 0,
  `email` varchar(100) NOT NULL DEFAULT '',
  `hp` varchar(50) NOT NULL DEFAULT '',
  `reg` int(5) NOT NULL DEFAULT 0,
  `comment` text NOT NULL,
  `ipv4` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `ipv6` varchar(128) NOT NULL DEFAULT 'xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx',
  `editby` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `artikel` (`artikel`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_autologin`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_autologin`;
CREATE TABLE `dzcp_autologin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT 0,
  `ssid` varchar(50) NOT NULL DEFAULT '',
  `pkey` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(60) NOT NULL DEFAULT '',
  `ipv4` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `ipv6` varchar(128) NOT NULL DEFAULT 'xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx',
  `host` varchar(150) DEFAULT NULL,
  `date` int(11) NOT NULL DEFAULT 0,
  `update` int(11) NOT NULL DEFAULT 0,
  `expires` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `ssid` (`ssid`) USING BTREE,
  KEY `pkey` (`pkey`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_captcha`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_captcha`;
CREATE TABLE `dzcp_captcha` (
  `id` varchar(40) NOT NULL,
  `namespace` varchar(32) NOT NULL,
  `code` varchar(32) NOT NULL,
  `code_display` varchar(32) NOT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`,`namespace`),
  KEY `created` (`created`) USING BTREE
) ENGINE=Aria DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_clicks_ips`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_clicks_ips`;
CREATE TABLE `dzcp_clicks_ips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipv4` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `ipv6` varchar(128) NOT NULL DEFAULT 'xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx',
  `uid` int(11) NOT NULL DEFAULT 0,
  `ids` int(11) NOT NULL DEFAULT 0,
  `side` varchar(30) NOT NULL DEFAULT '',
  `time` int(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `ip` (`ipv4`) USING BTREE,
  KEY `ipv6` (`ipv6`)
) ENGINE=Aria AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_counter_ips`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_counter_ips`;
CREATE TABLE `dzcp_counter_ips` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ipv4` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `ipv6` varchar(128) NOT NULL DEFAULT 'xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx',
  `datum` int(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `ip` (`ipv4`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=333 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_counter_whoison`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_counter_whoison`;
CREATE TABLE `dzcp_counter_whoison` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipv4` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `ipv6` varchar(128) NOT NULL DEFAULT 'xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx',
  `ssid` varchar(50) NOT NULL DEFAULT '',
  `online` int(20) NOT NULL DEFAULT 0,
  `whereami` text DEFAULT NULL,
  `login` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip` (`ssid`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=376 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_downloads`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_downloads`;
CREATE TABLE `dzcp_downloads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `download` varchar(249) NOT NULL DEFAULT '',
  `url` varchar(249) NOT NULL DEFAULT '',
  `beschreibung` text DEFAULT NULL,
  `hits` int(20) NOT NULL DEFAULT 0,
  `kat` int(5) NOT NULL DEFAULT 0,
  `date` int(20) NOT NULL DEFAULT 0,
  `last_dl` int(20) NOT NULL DEFAULT 0,
  `intern` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_download_kat`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_download_kat`;
CREATE TABLE `dzcp_download_kat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(249) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_events`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_events`;
CREATE TABLE `dzcp_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` int(20) NOT NULL DEFAULT 0,
  `title` varchar(30) NOT NULL DEFAULT '',
  `event` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_forum_abo`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_forum_abo`;
CREATE TABLE `dzcp_forum_abo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(10) NOT NULL,
  `datum` int(20) NOT NULL,
  `user` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=Aria DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_forum_access`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_forum_access`;
CREATE TABLE `dzcp_forum_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(10) NOT NULL DEFAULT 0,
  `pos` int(5) NOT NULL DEFAULT 0,
  `forum` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `user` (`user`) USING BTREE,
  KEY `forum` (`forum`) USING BTREE,
  KEY `pos` (`pos`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_forum_kats`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_forum_kats`;
CREATE TABLE `dzcp_forum_kats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kid` int(10) NOT NULL DEFAULT 0,
  `name` varchar(50) NOT NULL DEFAULT '',
  `intern` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_forum_posts`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_forum_posts`;
CREATE TABLE `dzcp_forum_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kid` int(2) NOT NULL DEFAULT 0,
  `sid` int(2) NOT NULL DEFAULT 0,
  `date` int(20) NOT NULL DEFAULT 0,
  `nick` varchar(50) NOT NULL DEFAULT '',
  `reg` int(11) NOT NULL DEFAULT 0,
  `email` varchar(100) NOT NULL DEFAULT '',
  `text` text DEFAULT NULL,
  `edited` text DEFAULT NULL,
  `ipv4` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `ipv6` varchar(128) NOT NULL DEFAULT 'xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx',
  `hp` varchar(249) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `sid` (`sid`) USING BTREE,
  KEY `date` (`date`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=83670 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_forum_sub_kats`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_forum_sub_kats`;
CREATE TABLE `dzcp_forum_sub_kats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(10) NOT NULL DEFAULT 0,
  `kattopic` varchar(150) NOT NULL DEFAULT '',
  `subtopic` varchar(150) NOT NULL DEFAULT '',
  `pos` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `sid` (`sid`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_forum_threads`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_forum_threads`;
CREATE TABLE `dzcp_forum_threads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kid` int(10) NOT NULL DEFAULT 0,
  `t_date` int(20) NOT NULL DEFAULT 0,
  `topic` varchar(249) NOT NULL DEFAULT '',
  `subtopic` varchar(100) NOT NULL DEFAULT '',
  `t_nick` varchar(100) NOT NULL DEFAULT '',
  `t_reg` int(11) NOT NULL DEFAULT 0,
  `t_email` varchar(100) NOT NULL DEFAULT '',
  `t_text` text DEFAULT NULL,
  `hits` int(10) NOT NULL DEFAULT 0,
  `first` int(1) NOT NULL DEFAULT 0,
  `lp` int(11) NOT NULL DEFAULT 0,
  `sticky` int(1) NOT NULL DEFAULT 0,
  `closed` int(1) NOT NULL DEFAULT 0,
  `edited` text DEFAULT NULL,
  `global` int(1) NOT NULL DEFAULT 0,
  `ipv4` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `ipv6` varchar(128) NOT NULL DEFAULT 'xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx',
  `t_hp` varchar(249) NOT NULL DEFAULT '',
  `vote` varchar(200) DEFAULT NULL,
  `posts` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `kid` (`kid`) USING BTREE,
  KEY `lp` (`lp`) USING BTREE,
  KEY `topic` (`topic`) USING BTREE,
  KEY `first` (`first`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=16200 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_groups`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_groups`;
CREATE TABLE `dzcp_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `beschreibung` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_group_user`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_group_user`;
CREATE TABLE `dzcp_group_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(5) NOT NULL DEFAULT 0,
  `group` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_ipban`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_ipban`;
CREATE TABLE `dzcp_ipban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipv4` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `ipv6` varchar(128) NOT NULL DEFAULT 'xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx',
  `time` int(11) NOT NULL DEFAULT 0,
  `data` text DEFAULT NULL,
  `typ` int(1) NOT NULL DEFAULT 0,
  `enable` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `ip` (`ipv4`) USING BTREE,
  KEY `ipv6` (`ipv6`)
) ENGINE=Aria AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_iptodns`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_iptodns`;
CREATE TABLE `dzcp_iptodns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sessid` varchar(50) NOT NULL DEFAULT '',
  `time` int(11) NOT NULL DEFAULT 0,
  `update` int(11) NOT NULL DEFAULT 0,
  `ipv4` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `ipv6` varchar(128) NOT NULL DEFAULT 'xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx',
  `dns` varchar(200) NOT NULL DEFAULT '',
  `agent` varchar(250) NOT NULL DEFAULT '',
  `bot` int(1) NOT NULL DEFAULT 0,
  `bot_name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `sessid` (`sessid`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=197 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_ip_action`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_ip_action`;
CREATE TABLE `dzcp_ip_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipv4` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `ipv6` varchar(128) NOT NULL DEFAULT 'xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx',
  `user_id` int(11) NOT NULL DEFAULT 0,
  `what` varchar(40) NOT NULL DEFAULT '',
  `time` int(20) NOT NULL DEFAULT 0,
  `created` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `ip` (`ipv4`) USING BTREE,
  KEY `what` (`what`) USING BTREE,
  KEY `user_id` (`user_id`),
  KEY `ipv6` (`ipv6`)
) ENGINE=Aria AUTO_INCREMENT=501 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_links`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_links`;
CREATE TABLE `dzcp_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(249) NOT NULL DEFAULT '',
  `text` varchar(249) NOT NULL DEFAULT '',
  `banner` int(1) NOT NULL DEFAULT 0,
  `beschreibung` text DEFAULT NULL,
  `hits` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_messages`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_messages`;
CREATE TABLE `dzcp_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` int(20) NOT NULL DEFAULT 0,
  `von` int(5) NOT NULL DEFAULT 0,
  `an` int(5) NOT NULL DEFAULT 0,
  `see_u` int(1) NOT NULL DEFAULT 0,
  `page` int(1) NOT NULL DEFAULT 0,
  `titel` varchar(150) NOT NULL DEFAULT '',
  `nachricht` text DEFAULT NULL,
  `see` int(1) NOT NULL DEFAULT 0,
  `readed` int(1) NOT NULL DEFAULT 0,
  `sendmail` int(1) NOT NULL DEFAULT 0,
  `senduser` int(5) NOT NULL DEFAULT 0,
  `sendnewsuser` int(5) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `an` (`an`) USING BTREE,
  KEY `page` (`page`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_navi`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_navi`;
CREATE TABLE `dzcp_navi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pos` int(20) NOT NULL DEFAULT 0,
  `kat` varchar(20) NOT NULL DEFAULT '',
  `shown` int(1) NOT NULL DEFAULT 0,
  `name` varchar(249) NOT NULL DEFAULT '',
  `url` varchar(249) NOT NULL DEFAULT '',
  `target` int(1) NOT NULL DEFAULT 0,
  `type` int(1) NOT NULL DEFAULT 0,
  `internal` int(1) NOT NULL DEFAULT 0,
  `wichtig` int(1) NOT NULL DEFAULT 0,
  `editor` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `url` (`url`) USING BTREE,
  KEY `kat` (`kat`) USING BTREE,
  KEY `shown` (`shown`) USING BTREE,
  KEY `pos` (`pos`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_navi_kats`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_navi_kats`;
CREATE TABLE `dzcp_navi_kats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `placeholder` varchar(200) NOT NULL DEFAULT '',
  `level` int(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `placeholder` (`placeholder`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_news`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_news`;
CREATE TABLE `dzcp_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autor` int(5) NOT NULL DEFAULT 0,
  `datum` int(20) NOT NULL DEFAULT 0,
  `kat` int(2) NOT NULL DEFAULT 0,
  `titel` varchar(249) NOT NULL DEFAULT '',
  `intern` int(1) NOT NULL DEFAULT 0,
  `sticky` int(20) NOT NULL DEFAULT 0,
  `text` text DEFAULT NULL,
  `more` text DEFAULT NULL,
  `link1` varchar(100) NOT NULL DEFAULT '',
  `url1` varchar(200) NOT NULL DEFAULT '',
  `link2` varchar(100) NOT NULL DEFAULT '',
  `url2` varchar(200) NOT NULL DEFAULT '',
  `link3` varchar(100) NOT NULL DEFAULT '',
  `url3` varchar(200) NOT NULL DEFAULT '',
  `viewed` int(10) NOT NULL DEFAULT 0,
  `public` int(1) NOT NULL DEFAULT 0,
  `timeshift` int(14) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=265 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_news_comments`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_news_comments`;
CREATE TABLE `dzcp_news_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news` int(10) NOT NULL DEFAULT 0,
  `nick` varchar(50) NOT NULL DEFAULT '',
  `datum` int(20) NOT NULL DEFAULT 0,
  `email` varchar(100) NOT NULL DEFAULT '',
  `hp` varchar(50) NOT NULL DEFAULT '',
  `reg` int(5) NOT NULL DEFAULT 0,
  `comment` text DEFAULT NULL,
  `ipv4` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `ipv6` varchar(128) NOT NULL DEFAULT 'xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx',
  `editby` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=3175 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_news_kats`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_news_kats`;
CREATE TABLE `dzcp_news_kats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `katimg` varchar(200) NOT NULL DEFAULT '',
  `kategorie` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_partners`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_partners`;
CREATE TABLE `dzcp_partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(150) NOT NULL DEFAULT '',
  `banner` varchar(100) NOT NULL DEFAULT '',
  `textlink` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_permissions`;
CREATE TABLE `dzcp_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(5) NOT NULL DEFAULT 0,
  `pos` int(1) NOT NULL DEFAULT 0,
  `positions` int(1) NOT NULL DEFAULT 0,
  `intforum` int(1) NOT NULL DEFAULT 0,
  `config` int(1) NOT NULL DEFAULT 0,
  `editusers` int(1) NOT NULL DEFAULT 0,
  `editsquads` int(1) NOT NULL DEFAULT 0,
  `editkalender` int(1) NOT NULL DEFAULT 0,
  `news` int(1) NOT NULL DEFAULT 0,
  `partners` int(1) NOT NULL DEFAULT 0,
  `profile` int(1) NOT NULL DEFAULT 0,
  `protocol` int(1) NOT NULL DEFAULT 0,
  `forum` int(1) NOT NULL DEFAULT 0,
  `forumkats` int(1) NOT NULL DEFAULT 0,
  `votes` int(1) NOT NULL DEFAULT 0,
  `votesadmin` int(1) NOT NULL DEFAULT 0,
  `links` int(1) NOT NULL DEFAULT 0,
  `downloads` int(1) NOT NULL DEFAULT 0,
  `newsletter` int(1) NOT NULL DEFAULT 0,
  `intnews` int(1) NOT NULL DEFAULT 0,
  `impressum` int(1) NOT NULL DEFAULT 0,
  `artikel` int(1) NOT NULL DEFAULT 0,
  `editor` int(1) NOT NULL DEFAULT 0,
  `dlintern` int(1) NOT NULL DEFAULT 0,
  `ipban` int(1) NOT NULL DEFAULT 0,
  `startpage` int(1) NOT NULL DEFAULT 0,
  `activateusers` int(1) NOT NULL DEFAULT 0,
  `editby` int(1) NOT NULL DEFAULT 0,
  `dzcpaddons` int(1) NOT NULL DEFAULT 0,
  `dzcpversion` int(1) NOT NULL DEFAULT 0,
  `fileman` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `user` (`user`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_positions`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_positions`;
CREATE TABLE `dzcp_positions` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `pid` int(2) NOT NULL DEFAULT 0,
  `position` varchar(50) NOT NULL DEFAULT '',
  `nletter` int(1) NOT NULL DEFAULT 0,
  `color` varchar(7) NOT NULL DEFAULT '#000000',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_sessions`;
CREATE TABLE `dzcp_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ssid` varchar(200) NOT NULL DEFAULT '',
  `time` int(11) NOT NULL DEFAULT 0,
  `data` blob DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ssid` (`ssid`) USING BTREE,
  KEY `time` (`time`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_settings`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_settings`;
CREATE TABLE `dzcp_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(200) NOT NULL DEFAULT '',
  `value` text DEFAULT NULL,
  `default` text DEFAULT NULL,
  `length` int(11) NOT NULL DEFAULT 1,
  `type` varchar(20) NOT NULL DEFAULT 'int' COMMENT 'int/string',
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=86 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_settings
-- ----------------------------
INSERT INTO dzcp_settings VALUES ('1', 'eml_fabo_npost', '&lt;p&gt;Hallo [nick],&lt;br /&gt;&lt;br /&gt; [postuser] hat auf das Thema: [topic] auf der Website: &quot;[titel]&quot; geantwortet.&lt;br /&gt;&lt;br /&gt; Den neuen Beitrag erreichst Du ber folgenden Link:&lt;br /&gt; &lt;a href=&quot;http://[domain]/?index=forum&amp;amp;action=showthread&amp;amp;id=[id]&amp;amp;page=[page]#p[entrys]&quot;&gt;http://[domain]/?index=forum&amp;amp;action=showthread&amp;amp;id=[id]&amp;amp;page=[page]#p[entrys]&lt;/a&gt;&lt;/p&gt;\r\n&lt;table border=&quot;0&quot; cellspacing=&quot;2&quot; cellpadding=&quot;2&quot; style=&quot;width: 400px;&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td height=&quot;30&quot;&gt;[postuser] hat folgenden Text geschrieben:&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;[text]&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;p&gt;Mit freundlichen Gr&uuml;&szlig;en,&lt;br /&gt;&lt;br /&gt;Dein [clan]&lt;/p&gt;\r\n&lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '&lt;p&gt;Hallo [nick],&lt;br /&gt;&lt;br /&gt; [postuser] hat auf das Thema: [topic] auf der Website: &quot;[titel]&quot; geantwortet.&lt;br /&gt;&lt;br /&gt; Den neuen Beitrag erreichst Du ber folgenden Link:&lt;br /&gt; &lt;a href=&quot;http://[domain]/?index=forum&amp;amp;action=showthread&amp;amp;id=[id]&amp;amp;page=[page]#p[entrys]&quot;&gt;http://[domain]/?index=forum&amp;amp;action=showthread&amp;amp;id=[id]&amp;amp;page=[page]#p[entrys]&lt;/a&gt;&lt;/p&gt;\r\n&lt;table border=&quot;0&quot; cellspacing=&quot;2&quot; cellpadding=&quot;2&quot; style=&quot;width: 400px;&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td height=&quot;30&quot;&gt;[postuser] hat folgenden Text geschrieben:&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;[text]&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;p&gt;Mit freundlichen Gr&uuml;&szlig;en,&lt;br /&gt;&lt;br /&gt;Dein [clan]&lt;/p&gt;\r\n&lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '0', 'string');
INSERT INTO dzcp_settings VALUES ('2', 'eml_fabo_npost_subj', 'Neuer Beitrag auf abonniertes Thema im [titel]', 'Neuer Beitrag auf abonniertes Thema im [titel]', '0', 'string');
INSERT INTO dzcp_settings VALUES ('3', 'eml_fabo_pedit', '&lt;p&gt;Hallo [nick],&lt;br /&gt;&lt;br /&gt; Ein Beitrag im Thread mit dem Titel: [topic] auf der Website: &quot;[titel]&quot; wurde soeben von [postuser] bearbeitet.&lt;br /&gt; &lt;br /&gt; Den bearbeitete Beitrag erreichst Du ber folgenden Link:&lt;br /&gt; &lt;a href=&quot;http://[domain]/?index=forum&amp;action=showthread&amp;id=[id]&amp;page=[page]#p[entrys]&quot;&gt;http://[domain]/?index=forum&amp;action=showthread&amp;id=[id]&amp;page=[page]#p[entrys]&lt;/a&gt;&lt;/p&gt; &lt;table style=&quot;width: 400px;&quot; cellpadding=&quot;2&quot; cellspacing=&quot;2&quot; border=&quot;0&quot;&gt; &lt;tbody&gt; &lt;tr&gt; &lt;td height=&quot;30&quot;&gt;[postuser] hat folgenden neuen Text geschrieben:&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;[text]&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;/tbody&gt; &lt;/table&gt; &lt;p&gt;Mit freundlichen Gr&uuml;&szlig;en,&lt;br /&gt;&lt;br /&gt;Dein [clan]&lt;/p&gt; &lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '&lt;p&gt;Hallo [nick],&lt;br /&gt;&lt;br /&gt; Ein Beitrag im Thread mit dem Titel: [topic] auf der Website: &quot;[titel]&quot; wurde soeben von [postuser] bearbeitet.&lt;br /&gt; &lt;br /&gt; Den bearbeitete Beitrag erreichst Du ber folgenden Link:&lt;br /&gt; &lt;a href=&quot;http://[domain]/?index=forum&amp;amp;action=showthread&amp;amp;id=[id]&amp;amp;page=[page]#p[entrys]&quot;&gt;http://[domain]/?index=forum&amp;amp;action=showthread&amp;amp;id=[id]&amp;amp;page=[page]#p[entrys]&lt;/a&gt;&lt;/p&gt;\r\n&lt;table border=&quot;0&quot; cellspacing=&quot;2&quot; cellpadding=&quot;2&quot; style=&quot;width: 400px;&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td height=&quot;30&quot;&gt;[postuser] hat folgenden neuen Text geschrieben:&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;[text]&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;p&gt;Mit freundlichen Gr&uuml;&szlig;en,&lt;br /&gt;&lt;br /&gt;Dein [clan]&lt;/p&gt;\r\n&lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '0', 'string');
INSERT INTO dzcp_settings VALUES ('4', 'eml_fabo_pedit_subj', 'Beitrag auf abonniertes Thema im [titel] wurde bearbeitet', 'Beitrag auf abonniertes Thema im [titel] wurde bearbeitet', '0', 'string');
INSERT INTO dzcp_settings VALUES ('5', 'eml_fabo_tedit_subj', 'Thread auf abonniertes Thema im [titel] wurde bearbeitet', 'Thread auf abonniertes Thema im [titel] wurde bearbeitet', '0', 'string');
INSERT INTO dzcp_settings VALUES ('6', 'eml_nletter', '&lt;p&gt;{$text}&lt;br /&gt;&lt;br /&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '&lt;p&gt;[text]&lt;br /&gt;&lt;br /&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '0', 'string');
INSERT INTO dzcp_settings VALUES ('8', 'eml_nletter_subj', 'Newsletter', 'Newsletter', '0', 'string');
INSERT INTO dzcp_settings VALUES ('10', 'eml_pn_subj', 'Neue PN auf [domain]', 'Neue PN auf [domain]', '0', 'string');
INSERT INTO dzcp_settings VALUES ('12', 'eml_pwd_subj', 'Deine Zugangsdaten', 'Deine Zugangsdaten', '0', 'string');
INSERT INTO dzcp_settings VALUES ('13', 'eml_reg_subj', 'Deine Registrierung', 'Deine Registrierung', '0', 'string');
INSERT INTO dzcp_settings VALUES ('16', 'securelogin', '1', '1', '1', 'int');
INSERT INTO dzcp_settings VALUES ('18', 'badwords', 'arsch,Arsch,arschloch,Arschloch,hure,Hure', '', '0', 'string');
INSERT INTO dzcp_settings VALUES ('19', 'clanname', 'Dein Clanname hier!', 'Dein Clanname hier!', '80', 'string');
INSERT INTO dzcp_settings VALUES ('20', 'db_version', '1.7.0.0', '1.7.0.0', '7', 'string');
INSERT INTO dzcp_settings VALUES ('21', 'default_pwd_encoder', '2', '2', '1', 'int');
INSERT INTO dzcp_settings VALUES ('22', 'direct_refresh', '1', '0', '1', 'int');
INSERT INTO dzcp_settings VALUES ('23', 'domain', '169.254.164.198', '127.0.0.1', '150', 'string');
INSERT INTO dzcp_settings VALUES ('24', 'double_post', '1', '1', '1', 'int');
INSERT INTO dzcp_settings VALUES ('25', 'forum_vote', '1', '1', '1', 'int');
INSERT INTO dzcp_settings VALUES ('26', 'f_artikelcom', '20', '20', '5', 'int');
INSERT INTO dzcp_settings VALUES ('27', 'f_forum', '20', '20', '5', 'int');
INSERT INTO dzcp_settings VALUES ('28', 'f_newscom', '20', '20', '5', 'int');
INSERT INTO dzcp_settings VALUES ('29', 'language', 'de', 'de', '50', 'string');
INSERT INTO dzcp_settings VALUES ('30', 'l_forumsubtopic', '50', '20', '5', 'int');
INSERT INTO dzcp_settings VALUES ('31', 'l_forumtopic', '50', '20', '5', 'int');
INSERT INTO dzcp_settings VALUES ('32', 'l_ftopics', '28', '28', '5', 'int');
INSERT INTO dzcp_settings VALUES ('33', 'l_lartikel', '18', '18', '5', 'int');
INSERT INTO dzcp_settings VALUES ('34', 'l_lnews', '22', '22', '5', 'int');
INSERT INTO dzcp_settings VALUES ('35', 'l_lreg', '12', '12', '5', 'int');
INSERT INTO dzcp_settings VALUES ('36', 'l_newsadmin', '20', '20', '5', 'int');
INSERT INTO dzcp_settings VALUES ('37', 'l_newsarchiv', '20', '20', '5', 'int');
INSERT INTO dzcp_settings VALUES ('38', 'l_topdl', '20', '20', '5', 'int');
INSERT INTO dzcp_settings VALUES ('39', 'mailfrom', 'info@dzcp.de', 'info@127.0.0.1', '100', 'string');
INSERT INTO dzcp_settings VALUES ('40', 'mail_extension', 'sendmail', 'mail', '20', 'string');
INSERT INTO dzcp_settings VALUES ('41', 'maxwidth', '400', '400', '5', 'int');
INSERT INTO dzcp_settings VALUES ('44', 'm_adminartikel', '15', '15', '5', 'int');
INSERT INTO dzcp_settings VALUES ('45', 'm_adminnews', '20', '20', '5', 'int');
INSERT INTO dzcp_settings VALUES ('46', 'm_archivnews', '30', '30', '5', 'int');
INSERT INTO dzcp_settings VALUES ('47', 'm_artikel', '15', '15', '5', 'int');
INSERT INTO dzcp_settings VALUES ('48', 'm_comments', '10', '10', '5', 'int');
INSERT INTO dzcp_settings VALUES ('49', 'm_events', '5', '5', '5', 'int');
INSERT INTO dzcp_settings VALUES ('50', 'm_fposts', '10', '10', '5', 'int');
INSERT INTO dzcp_settings VALUES ('51', 'm_fthreads', '50', '20', '5', 'int');
INSERT INTO dzcp_settings VALUES ('52', 'm_ftopics', '6', '6', '5', 'int');
INSERT INTO dzcp_settings VALUES ('53', 'm_lartikel', '5', '5', '5', 'int');
INSERT INTO dzcp_settings VALUES ('54', 'm_lnews', '6', '6', '5', 'int');
INSERT INTO dzcp_settings VALUES ('55', 'm_lreg', '5', '5', '5', 'int');
INSERT INTO dzcp_settings VALUES ('56', 'm_news', '5', '5', '5', 'int');
INSERT INTO dzcp_settings VALUES ('57', 'm_topdl', '5', '5', '5', 'int');
INSERT INTO dzcp_settings VALUES ('58', 'm_userlist', '40', '40', '5', 'int');
INSERT INTO dzcp_settings VALUES ('59', 'news_feed', '1', '1', '1', 'int');
INSERT INTO dzcp_settings VALUES ('60', 'pagetitel', 'Dein Seitentitel hier!', 'Dein Seitentitel hier!', '50', 'string');
INSERT INTO dzcp_settings VALUES ('61', 'prev', 'ijgf9i5t', 'hs4', '3', 'string');
INSERT INTO dzcp_settings VALUES ('7', 'eml_fabo_tedit', '&lt;p&gt;Hallo [nick],&lt;br /&gt; &lt;br /&gt; Der Thread mit dem Titel: [topic] auf der Website: &quot;[titel]&quot; wurde soeben von [postuser] bearbeitet.&lt;br /&gt; Den bearbeitete Beitrag erreichst Du ber folgenden Link:&lt;br /&gt; &lt;a href=&quot;http://[domain]/?index=forum&amp;action=showthread&amp;id=[id]&quot;&gt;http://[domain]/?index=forum&amp;action=showthread&amp;id=[id]&lt;/a&gt;&lt;/p&gt; &lt;table style=&quot;width: 400px;&quot; cellpadding=&quot;2&quot; cellspacing=&quot;2&quot; border=&quot;0&quot;&gt; &lt;tbody&gt; &lt;tr&gt; &lt;td height=&quot;30&quot;&gt;[postuser] hat folgenden neuen Text geschrieben:&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;[text]&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;/tbody&gt; &lt;/table&gt; &lt;p&gt;Mit freundlichen Gr&uuml;&szlig;en,&lt;br /&gt;&lt;br /&gt;Dein [clan]&lt;/p&gt; &lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '&lt;p&gt;Hallo [nick],&lt;br /&gt; &lt;br /&gt; Der Thread mit dem Titel: [topic] auf der Website: &quot;[titel]&quot; wurde soeben von [postuser] bearbeitet.&lt;br /&gt; Den bearbeitete Beitrag erreichst Du ber folgenden Link:&lt;br /&gt; &lt;a href=&quot;http://[domain]/?index=forum&amp;amp;action=showthread&amp;amp;id=[id]&quot;&gt;http://[domain]/?index=forum&amp;amp;action=showthread&amp;amp;id=[id]&lt;/a&gt;&lt;/p&gt;\r\n&lt;table border=&quot;0&quot; cellspacing=&quot;2&quot; cellpadding=&quot;2&quot; style=&quot;width: 400px;&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td height=&quot;30&quot;&gt;[postuser] hat folgenden neuen Text geschrieben:&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;[text]&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;p&gt;Mit freundlichen Gr&uuml;&szlig;en,&lt;br /&gt;&lt;br /&gt;Dein [clan]&lt;/p&gt;\r\n&lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '0', 'string');
INSERT INTO dzcp_settings VALUES ('9', 'eml_pn', '&lt;p&gt;Hallo {$nick},&lt;br /&gt;&lt;br /&gt; Du hast eine neue Nachricht in deinem Postfach.&lt;/p&gt; &lt;table border=&quot;0&quot; cellspacing=&quot;2&quot; cellpadding=&quot;2&quot; style=&quot;width: 400px;&quot;&gt; &lt;tbody&gt; &lt;tr&gt; &lt;td height=&quot;30&quot;&gt;Titel: {$titel}&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;&lt;a href=&quot;http://{$domain}/user/index.php?action=msg&quot;&gt;Zum Nachrichten-Center&lt;/a&gt;&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;/tbody&gt; &lt;/table&gt; &lt;p&gt;Mit freundlichen Gr&uuml;&szlig;en,&lt;br /&gt;&lt;br /&gt;Dein {$clan}&lt;/p&gt; &lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '&lt;p&gt;Hallo [nick],&lt;br /&gt;&lt;br /&gt; Du hast eine neue Nachricht in deinem Postfach.&lt;/p&gt;\n&lt;table border=&quot;0&quot; cellspacing=&quot;2&quot; cellpadding=&quot;2&quot; style=&quot;width: 400px;&quot;&gt;\n&lt;tbody&gt;\n&lt;tr&gt;\n&lt;td height=&quot;30&quot;&gt;Titel: [titel]&lt;/td&gt;\n&lt;/tr&gt;\n&lt;tr&gt;\n&lt;td&gt;&lt;hr /&gt;&lt;/td&gt;\n&lt;/tr&gt;\n&lt;tr&gt;\n&lt;td&gt;&lt;a href=&quot;http://[domain]/user/index.php?action=msg&quot;&gt;Zum Nachrichten-Center&lt;/a&gt;&lt;/td&gt;\n&lt;/tr&gt;\n&lt;tr&gt;\n&lt;td&gt;&lt;hr /&gt;&lt;/td&gt;\n&lt;/tr&gt;\n&lt;/tbody&gt;\n&lt;/table&gt;\n&lt;p&gt;Mit freundlichen Gr&uuml;&szlig;en,&lt;br /&gt;&lt;br /&gt;Dein [clan]&lt;/p&gt;\n&lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '0', 'string');
INSERT INTO dzcp_settings VALUES ('11', 'eml_pwd', '&lt;p&gt;Ein neues Passwort wurde f&uuml;r deinen Account generiert!&lt;/p&gt; &lt;table style=&quot;width: 400px;&quot; cellpadding=&quot;2&quot; cellspacing=&quot;2&quot; border=&quot;0&quot;&gt; &lt;tbody&gt; &lt;tr&gt; &lt;td colspan=&quot;2&quot; height=&quot;30&quot;&gt;Deine Logindaten lauten:&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td width=&quot;120&quot;&gt;Login-Name:&lt;/td&gt; &lt;td&gt;{$user}&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;Passwort:&lt;/td&gt; &lt;td&gt;{$pwd}&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;/tbody&gt; &lt;/table&gt; &lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '&lt;p&gt;Ein neues Passwort wurde f&amp;uuml;r deinen Account generiert!&lt;/p&gt;\r\n&lt;table border=&quot;0&quot; cellspacing=&quot;2&quot; cellpadding=&quot;2&quot; style=&quot;width: 400px;&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td height=&quot;30&quot; colspan=&quot;2&quot;&gt;Deine Logindaten lauten:&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td width=&quot;120&quot;&gt;Login-Name:&lt;/td&gt;\r\n&lt;td&gt;[user]&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;Passwort:&lt;/td&gt;\r\n&lt;td&gt;[pwd]&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '0', 'string');
INSERT INTO dzcp_settings VALUES ('62', 'regcode', '1', '1', '1', 'int');
INSERT INTO dzcp_settings VALUES ('63', 'reg_artikel', '1', '1', '1', 'int');
INSERT INTO dzcp_settings VALUES ('64', 'reg_dl', '1', '1', '1', 'int');
INSERT INTO dzcp_settings VALUES ('84', 'm_tutorials', '10', '10', '5', 'int');
INSERT INTO dzcp_settings VALUES ('66', 'reg_newscomments', '1', '1', '1', 'int');
INSERT INTO dzcp_settings VALUES ('67', 'sendmail_path', '/usr/sbin/sendmail', '/usr/sbin/sendmail', '150', 'string');
INSERT INTO dzcp_settings VALUES ('68', 'smtp_hostname', '192.168.1.1', 'localhost', '100', 'string');
INSERT INTO dzcp_settings VALUES ('69', 'smtp_password', 'I\\Y5Di`\0I\nuDi`FQt2SZ#\n]	~.', '', '0', 'string');
INSERT INTO dzcp_settings VALUES ('70', 'smtp_port', '25', '25', '11', 'int');
INSERT INTO dzcp_settings VALUES ('71', 'smtp_tls_ssl', '0', '0', '1', 'int');
INSERT INTO dzcp_settings VALUES ('72', 'smtp_username', 'websender@hammermaps.de', '', '150', 'string');
INSERT INTO dzcp_settings VALUES ('73', 'tmpdir', 'version1.6', 'version1.6', '50', 'string');
INSERT INTO dzcp_settings VALUES ('74', 'upicsize', '270', '100', '5', 'int');
INSERT INTO dzcp_settings VALUES ('75', 'urls_linked', '1', '1', '1', 'int');
INSERT INTO dzcp_settings VALUES ('76', 'wmodus', '0', '0', '1', 'int');
INSERT INTO dzcp_settings VALUES ('78', 'pwd_encoder', '2', '2', '1', 'int');
INSERT INTO dzcp_settings VALUES ('79', 'eml_akl_register_subj', 'Dein Aktivierungslink', 'Dein Aktivierungslink', '0', 'string');
INSERT INTO dzcp_settings VALUES ('81', 'use_akl', '1', '1', '1', 'int');
INSERT INTO dzcp_settings VALUES ('82', 'eml_lpwd_key_subj', '', null, '0', 'string');
INSERT INTO dzcp_settings VALUES ('83', 'eml_lpwd_key', '', null, '0', 'string');
INSERT INTO dzcp_settings VALUES ('85', 'm_tutorial_comments', '10', '10', '5', 'int');
INSERT INTO dzcp_settings VALUES ('15', 'eml_reg', '&lt;p&gt;Du hast dich erfolgreich auf unserer Seite registriert!&lt;/p&gt; &lt;table style=&quot;width: 400px;&quot; cellpadding=&quot;2&quot; cellspacing=&quot;2&quot; border=&quot;0&quot;&gt; &lt;tbody&gt; &lt;tr&gt; &lt;td colspan=&quot;2&quot; height=&quot;30&quot;&gt;Deine Logindaten lauten:&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td width=&quot;120&quot;&gt;Login-Name:&lt;/td&gt; &lt;td&gt;{$user}&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;Passwort:&lt;/td&gt; &lt;td&gt;{$pwd}&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;/tbody&gt; &lt;/table&gt; &lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '&lt;p&gt;Du hast dich erfolgreich auf unserer Seite registriert!&lt;/p&gt;\r\n&lt;table style=&quot;width: 400px;&quot; cellpadding=&quot;2&quot; cellspacing=&quot;2&quot; border=&quot;0&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td colspan=&quot;2&quot; height=&quot;30&quot;&gt;Deine Logindaten lauten:&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td width=&quot;120&quot;&gt;Login-Name:&lt;/td&gt;\r\n&lt;td&gt;[user]&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;Passwort:&lt;/td&gt;\r\n&lt;td&gt;[pwd]&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '0', 'string');
INSERT INTO dzcp_settings VALUES ('80', 'eml_akl_register', '&lt;p&gt;Hallo {$nick},&lt;br /&gt;&lt;br /&gt; Dein Account muss noch aktiviert werden, danach kannst du dich anmelden.&lt;/p&gt; &lt;table border=&quot;0&quot; cellspacing=&quot;2&quot; cellpadding=&quot;2&quot; style=&quot;width: 600px;&quot;&gt; &lt;tbody&gt; &lt;tr&gt; &lt;td height=&quot;30&quot; colspan=&quot;2&quot;&gt;Deine Aktivierung:&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td width=&quot;120&quot;&gt;Aktivierungslink:&lt;/td&gt; &lt;td&gt;{$link}&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;Aktivierungscode:&lt;/td&gt; &lt;td&gt;{$guid}&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;/tbody&gt; &lt;/table&gt; &lt;br /&gt; &lt;p&gt;Falls der Link nicht funktioniert, kannst du den Aktivierungscode auch auf &quot;{$link_page}&quot; eingeben.&lt;br /&gt;&lt;br /&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '<p>Hallo [nick],<br /> Dein Account muss noch aktiviert werden, danach kannst du dich anmelden.</p>\\r\\n<table border=\"0\" cellspacing=\"2\" cellpadding=\"2\" style=\"width: 600px;\">\\r\\n<tbody>\\r\\n<tr>\\r\\n<td height=\"30\" colspan=\"2\">Deine Aktivierung:</td>\\r\\n</tr>\\r\\n<tr>\\r\\n<td colspan=\"2\"><hr /></td>\\r\\n</tr>\\r\\n<tr>\\r\\n<td width=\"120\">Aktivierungslink:</td>\\r\\n<td>[link]</td>\\r\\n</tr>\\r\\n<tr>\\r\\n<td>Aktivierungscode:</td>\\r\\n<td>[guid]</td>\\r\\n</tr>\\r\\n<tr>\\r\\n<td colspan=\"2\"><hr /></td>\\r\\n</tr>\\r\\n</tbody>\\r\\n</table>\\r\\n<p>Falls der Link nicht funktioniert, kannst du den Aktivierungscode auch auf \"[link_page]\" eingeben.</p>\\r\\n<p>[ Diese Email wurde automatisch generiert, bitte nicht antworten ]</p>', '0', 'string');

-- ----------------------------
-- Table structure for `dzcp_sites`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_sites`;
CREATE TABLE `dzcp_sites` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `titel` text DEFAULT NULL,
  `text` text DEFAULT NULL,
  `html` int(1) NOT NULL,
  `php` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=Aria DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_sponsoren`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_sponsoren`;
CREATE TABLE `dzcp_sponsoren` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(249) NOT NULL DEFAULT '',
  `link` varchar(249) NOT NULL DEFAULT '',
  `beschreibung` text DEFAULT NULL,
  `site` int(1) NOT NULL DEFAULT 0,
  `slink` varchar(249) NOT NULL DEFAULT '',
  `banner` int(1) NOT NULL DEFAULT 0,
  `bend` varchar(5) NOT NULL DEFAULT '',
  `blink` varchar(249) NOT NULL DEFAULT '',
  `box` int(1) NOT NULL DEFAULT 0,
  `xend` varchar(5) NOT NULL DEFAULT '',
  `xlink` varchar(255) NOT NULL DEFAULT '',
  `pos` int(5) NOT NULL,
  `hits` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `banner` (`banner`) USING BTREE,
  KEY `pos` (`pos`) USING BTREE,
  KEY `site` (`site`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_startpage`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_startpage`;
CREATE TABLE `dzcp_startpage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `level` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_tutorials`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_tutorials`;
CREATE TABLE `dzcp_tutorials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kat` int(2) NOT NULL DEFAULT 1,
  `pos` int(11) NOT NULL DEFAULT 1,
  `datum` int(15) NOT NULL,
  `autor` int(5) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `beschreibung` text CHARACTER SET latin1 NOT NULL,
  `tutorial` text CHARACTER SET latin1 NOT NULL,
  `difficulty` int(1) NOT NULL DEFAULT 1,
  `votes` int(10) NOT NULL,
  `rating` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `public` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `datum` (`datum`)
) ENGINE=Aria AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PAGE_CHECKSUM=1;

-- ----------------------------
-- Table structure for `dzcp_tutorials_comments`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_tutorials_comments`;
CREATE TABLE `dzcp_tutorials_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tutorial` int(10) NOT NULL DEFAULT 0,
  `nick` varchar(50) NOT NULL DEFAULT '',
  `datum` int(20) NOT NULL DEFAULT 0,
  `email` varchar(100) NOT NULL DEFAULT '',
  `hp` varchar(50) NOT NULL DEFAULT '',
  `reg` int(5) NOT NULL DEFAULT 0,
  `comment` text DEFAULT NULL,
  `ipv4` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `ipv6` varchar(128) NOT NULL DEFAULT 'xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx',
  `editby` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=Aria DEFAULT CHARSET=utf8 PAGE_CHECKSUM=1;

-- ----------------------------
-- Table structure for `dzcp_tutorials_kats`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_tutorials_kats`;
CREATE TABLE `dzcp_tutorials_kats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pos` int(5) NOT NULL DEFAULT 1,
  `level` int(1) NOT NULL DEFAULT 0,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `beschreibung` text CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PAGE_CHECKSUM=1;

-- ----------------------------
-- Table structure for `dzcp_users`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_users`;
CREATE TABLE `dzcp_users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `user` varchar(200) NOT NULL DEFAULT '',
  `nick` varchar(200) NOT NULL DEFAULT '',
  `pwd` varchar(255) NOT NULL DEFAULT '',
  `pwd_encoder` int(1) NOT NULL DEFAULT 0,
  `sessid` varchar(32) NOT NULL DEFAULT '',
  `actkey` varchar(100) NOT NULL DEFAULT '',
  `lostpwd_key` varchar(100) NOT NULL DEFAULT '',
  `country` varchar(20) NOT NULL DEFAULT 'de',
  `ipv4` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `ipv6` varchar(128) NOT NULL DEFAULT 'xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx:xxxx',
  `regdatum` int(20) NOT NULL DEFAULT 0,
  `email` varchar(200) NOT NULL DEFAULT '',
  `level` int(2) NOT NULL DEFAULT 0,
  `banned` int(1) NOT NULL DEFAULT 0,
  `rlname` varchar(200) NOT NULL DEFAULT '',
  `city` varchar(200) NOT NULL DEFAULT '',
  `sex` int(1) NOT NULL DEFAULT 0,
  `bday` varchar(200) NOT NULL DEFAULT '',
  `hp` varchar(200) NOT NULL DEFAULT '',
  `signatur` text DEFAULT NULL,
  `position` int(2) NOT NULL DEFAULT 0,
  `time` int(20) NOT NULL DEFAULT 0,
  `listck` int(1) NOT NULL DEFAULT 0,
  `online` int(1) NOT NULL DEFAULT 0,
  `nletter` int(1) NOT NULL DEFAULT 1,
  `whereami` text DEFAULT NULL,
  `url2` varchar(249) NOT NULL DEFAULT '',
  `url3` varchar(249) NOT NULL DEFAULT '',
  `beschreibung` text DEFAULT NULL,
  `pnmail` int(1) NOT NULL DEFAULT 1,
  `profile_access` int(1) NOT NULL DEFAULT 1,
  `startpage` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `pwd` (`pwd`) USING BTREE,
  KEY `time` (`time`) USING BTREE,
  KEY `bday` (`bday`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=41475 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_user_buddys`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_user_buddys`;
CREATE TABLE `dzcp_user_buddys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(5) NOT NULL DEFAULT 0,
  `buddy` int(5) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `user` (`user`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_user_posis`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_user_posis`;
CREATE TABLE `dzcp_user_posis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(5) NOT NULL DEFAULT 0,
  `posi` int(5) NOT NULL DEFAULT 0,
  `group` int(5) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `user` (`user`) USING BTREE,
  KEY `squad` (`group`) USING BTREE,
  KEY `posi` (`posi`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_user_stats`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_user_stats`;
CREATE TABLE `dzcp_user_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(10) NOT NULL DEFAULT 0,
  `logins` int(11) NOT NULL DEFAULT 0,
  `writtenmsg` int(10) NOT NULL DEFAULT 0,
  `lastvisit` int(20) NOT NULL DEFAULT 0,
  `hits` int(11) NOT NULL DEFAULT 0,
  `votes` int(5) NOT NULL DEFAULT 0,
  `profilhits` int(20) NOT NULL DEFAULT 0,
  `forumthreads` int(11) NOT NULL DEFAULT 0,
  `forumposts` int(5) NOT NULL DEFAULT 0,
  `akl` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `user` (`user`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_votes`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_votes`;
CREATE TABLE `dzcp_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` int(20) NOT NULL DEFAULT 0,
  `titel` varchar(249) NOT NULL DEFAULT '',
  `intern` int(1) NOT NULL DEFAULT 0,
  `menu` int(1) NOT NULL DEFAULT 0,
  `closed` int(1) NOT NULL DEFAULT 0,
  `von` int(10) NOT NULL DEFAULT 0,
  `forum` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Table structure for `dzcp_vote_results`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_vote_results`;
CREATE TABLE `dzcp_vote_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vid` int(5) NOT NULL DEFAULT 0,
  `what` varchar(5) NOT NULL DEFAULT '',
  `sel` varchar(80) NOT NULL DEFAULT '',
  `stimmen` int(5) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `vid` (`vid`) USING BTREE,
  KEY `what` (`what`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;
