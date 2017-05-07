SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `dzcp_acomments`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_acomments`;
CREATE TABLE `dzcp_acomments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artikel` int(11) NOT NULL DEFAULT '0',
  `nick` varchar(50) NOT NULL DEFAULT '',
  `datum` int(20) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '',
  `hp` varchar(50) NOT NULL DEFAULT '',
  `reg` int(5) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `ip` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `editby` text,
  PRIMARY KEY (`id`),
  KEY `artikel` (`artikel`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

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
  `updated` int(11) NOT NULL DEFAULT '0',
  `enabled` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `updated` (`updated`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dzcp_addon_version
-- ----------------------------
INSERT INTO dzcp_addon_version VALUES (null, '1.6', '1.6.0.3', 'stable', '10.05.2015', '1603.00.00', '1493926855', '1');
INSERT INTO dzcp_addon_version VALUES (null, '1.6', '1.6.0.4', 'dev', '24.03.2016', '1604.00.01', '1493926855', '1');
INSERT INTO dzcp_addon_version VALUES (null, '1.6', '1.6.0.3', 'society', '10.05.2015', '1603.00.00', '1493926855', '1');
INSERT INTO dzcp_addon_version VALUES (null, '1.7', '1.7.0.0', 'stable', '14.01.2015', '1700.00.33', '1493926855', '1');
INSERT INTO dzcp_addon_version VALUES (null, '1.7', '1.7.0.0', 'dev', '15.01.2016', '1700.10.00', '1493926855', '1');
INSERT INTO dzcp_addon_version VALUES (null, '1.7', '1.7', 'society', '00.00.0000', '1700.00.00', '0', '0');

-- ----------------------------
-- Table structure for `dzcp_artikel`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_artikel`;
CREATE TABLE `dzcp_artikel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autor` int(11) NOT NULL DEFAULT '0',
  `datum` int(20) NOT NULL DEFAULT '0',
  `kat` int(5) NOT NULL DEFAULT '0',
  `titel` varchar(249) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `text` text CHARACTER SET utf8 NOT NULL,
  `link1` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `url1` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `link2` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `url2` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `link3` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `url3` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `public` int(1) NOT NULL DEFAULT '0',
  `viewed` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_autologin`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_autologin`;
CREATE TABLE `dzcp_autologin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `ssid` varchar(50) NOT NULL DEFAULT '',
  `pkey` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(60) NOT NULL DEFAULT '',
  `ip` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `host` varchar(150) NOT NULL DEFAULT '',
  `date` int(11) NOT NULL DEFAULT '0',
  `update` int(11) NOT NULL DEFAULT '0',
  `expires` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ssid` (`ssid`) USING BTREE,
  KEY `pkey` (`pkey`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_clicks_ips`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_clicks_ips`;
CREATE TABLE `dzcp_clicks_ips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `uid` int(11) NOT NULL DEFAULT '0',
  `ids` int(11) NOT NULL DEFAULT '0',
  `side` varchar(30) NOT NULL DEFAULT '',
  `time` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_counter`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_counter`;
CREATE TABLE `dzcp_counter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visitors` int(20) NOT NULL DEFAULT '0',
  `today` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `maxonline` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `today` (`today`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_counter_ips`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_counter_ips`;
CREATE TABLE `dzcp_counter_ips` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) CHARACTER SET utf8 NOT NULL DEFAULT '0.0.0.0',
  `datum` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_counter_whoison`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_counter_whoison`;
CREATE TABLE `dzcp_counter_whoison` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `ssid` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `online` int(20) NOT NULL DEFAULT '0',
  `whereami` text CHARACTER SET utf8,
  `login` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip` (`ssid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_downloads`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_downloads`;
CREATE TABLE `dzcp_downloads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `download` varchar(249) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `url` varchar(249) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `beschreibung` text CHARACTER SET utf8,
  `hits` int(20) NOT NULL DEFAULT '0',
  `kat` int(5) NOT NULL DEFAULT '0',
  `date` int(20) NOT NULL DEFAULT '0',
  `last_dl` int(20) NOT NULL DEFAULT '0',
  `intern` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_download_kat`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_download_kat`;
CREATE TABLE `dzcp_download_kat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(249) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dzcp_download_kat
-- ----------------------------
INSERT INTO dzcp_download_kat VALUES (null, 'Downloads');
INSERT INTO dzcp_download_kat VALUES (null, 'Demos');

-- ----------------------------
-- Table structure for `dzcp_events`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_events`;
CREATE TABLE `dzcp_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` int(20) NOT NULL DEFAULT '0',
  `title` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `event` text CHARACTER SET utf8,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_forumkats`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_forumkats`;
CREATE TABLE `dzcp_forumkats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kid` int(10) NOT NULL DEFAULT '0',
  `name` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `intern` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_forumposts`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_forumposts`;
CREATE TABLE `dzcp_forumposts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kid` int(2) NOT NULL DEFAULT '0',
  `sid` int(2) NOT NULL DEFAULT '0',
  `date` int(20) NOT NULL DEFAULT '0',
  `nick` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `reg` int(1) NOT NULL DEFAULT '0',
  `email` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `text` text CHARACTER SET utf8,
  `edited` text CHARACTER SET utf8,
  `ip` varchar(15) CHARACTER SET utf8 NOT NULL DEFAULT '0.0.0.0',
  `hp` varchar(249) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `sid` (`sid`) USING BTREE,
  KEY `date` (`date`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_forumsubkats`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_forumsubkats`;
CREATE TABLE `dzcp_forumsubkats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(10) NOT NULL DEFAULT '0',
  `kattopic` varchar(150) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `subtopic` varchar(150) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `pos` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sid` (`sid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_forumthreads`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_forumthreads`;
CREATE TABLE `dzcp_forumthreads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kid` int(10) NOT NULL DEFAULT '0',
  `t_date` int(20) NOT NULL DEFAULT '0',
  `topic` varchar(249) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `subtopic` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `t_nick` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `t_reg` int(11) NOT NULL DEFAULT '0',
  `t_email` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `t_text` text CHARACTER SET utf8,
  `hits` int(10) NOT NULL DEFAULT '0',
  `first` int(1) NOT NULL DEFAULT '0',
  `lp` int(20) NOT NULL DEFAULT '0',
  `sticky` int(1) NOT NULL DEFAULT '0',
  `closed` int(1) NOT NULL DEFAULT '0',
  `global` int(1) NOT NULL DEFAULT '0',
  `edited` text CHARACTER SET utf8,
  `ip` varchar(15) CHARACTER SET utf8 NOT NULL DEFAULT '0.0.0.0',
  `t_hp` varchar(249) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `vote` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `kid` (`kid`) USING BTREE,
  KEY `lp` (`lp`) USING BTREE,
  KEY `topic` (`topic`) USING BTREE,
  KEY `first` (`first`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_forum_access`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_forum_access`;
CREATE TABLE `dzcp_forum_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(10) NOT NULL DEFAULT '0',
  `pos` int(5) NOT NULL DEFAULT '0',
  `forum` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user` (`user`) USING BTREE,
  KEY `forum` (`forum`) USING BTREE,
  KEY `pos` (`pos`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_groups`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_groups`;
CREATE TABLE `dzcp_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `beschreibung` text CHARACTER SET utf8,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dzcp_groups
-- ----------------------------
INSERT INTO dzcp_groups VALUES (null, 'DZCP-Stuff', 'Beschreibung');

-- ----------------------------
-- Table structure for `dzcp_groupuser`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_groupuser`;
CREATE TABLE `dzcp_groupuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(5) NOT NULL DEFAULT '0',
  `group` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dzcp_groupuser
-- ----------------------------
INSERT INTO dzcp_groupuser VALUES (null, '1', '1');

-- ----------------------------
-- Table structure for `dzcp_ipban`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_ipban`;
CREATE TABLE `dzcp_ipban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `time` int(11) NOT NULL DEFAULT '0',
  `data` text,
  `typ` int(1) NOT NULL DEFAULT '0',
  `enable` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_iptodns`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_iptodns`;
CREATE TABLE `dzcp_iptodns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sessid` varchar(50) NOT NULL DEFAULT '',
  `time` int(11) NOT NULL DEFAULT '0',
  `update` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `dns` varchar(200) NOT NULL DEFAULT '',
  `agent` varchar(250) NOT NULL DEFAULT '',
  `bot` int(1) NOT NULL DEFAULT '0',
  `bot_name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `sessid` (`sessid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_ip_action`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_ip_action`;
CREATE TABLE `dzcp_ip_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) CHARACTER SET utf8 NOT NULL DEFAULT '0.0.0.0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `what` varchar(40) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `time` int(20) NOT NULL DEFAULT '0',
  `created` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`) USING BTREE,
  KEY `what` (`what`) USING BTREE,
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_links`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_links`;
CREATE TABLE `dzcp_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(249) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `text` varchar(249) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `banner` int(1) NOT NULL DEFAULT '0',
  `beschreibung` text CHARACTER SET utf8,
  `hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_messages`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_messages`;
CREATE TABLE `dzcp_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` int(20) NOT NULL DEFAULT '0',
  `von` int(5) NOT NULL DEFAULT '0',
  `an` int(5) NOT NULL DEFAULT '0',
  `see_u` int(1) NOT NULL DEFAULT '0',
  `page` int(1) NOT NULL DEFAULT '0',
  `titel` varchar(80) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `nachricht` text CHARACTER SET utf8,
  `see` int(1) NOT NULL DEFAULT '0',
  `readed` int(1) NOT NULL DEFAULT '0',
  `sendmail` int(1) DEFAULT '0',
  `sendnews` int(1) NOT NULL DEFAULT '0',
  `senduser` int(5) NOT NULL DEFAULT '0',
  `sendnewsuser` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `an` (`an`) USING BTREE,
  KEY `page` (`page`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_navi`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_navi`;
CREATE TABLE `dzcp_navi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pos` int(20) NOT NULL DEFAULT '0',
  `kat` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `shown` int(1) NOT NULL DEFAULT '0',
  `name` varchar(249) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `url` varchar(249) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `target` int(1) NOT NULL DEFAULT '0',
  `type` int(1) NOT NULL DEFAULT '0',
  `internal` int(1) NOT NULL DEFAULT '0',
  `wichtig` int(1) NOT NULL DEFAULT '0',
  `editor` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `url` (`url`) USING BTREE,
  KEY `kat` (`kat`) USING BTREE,
  KEY `shown` (`shown`) USING BTREE,
  KEY `pos` (`pos`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dzcp_navi
-- ----------------------------
INSERT INTO dzcp_navi VALUES (null, '1', 'nav_main', '1', '_news_', '../news/', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES (null, '2', 'nav_main', '1', '_newsarchiv_', '../news/?action=archiv', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES (null, '3', 'nav_main', '1', '_artikel_', '../artikel/', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES (null, '4', 'nav_main', '1', '_forum_', '../forum/', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES (null, '7', 'nav_main', '1', '_kalender_', '../kalender/', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES (null, '14', 'nav_main', '1', '_votes_', '../votes/', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES (null, '15', 'nav_main', '1', '_links_', '../links/', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES (null, '17', 'nav_main', '1', '_sponsoren_', '../sponsors/', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES (null, '24', 'nav_main', '1', '_downloads_', '../downloads/', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES (null, '25', 'nav_main', '1', '_userlist_', '../user/?action=userlist', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES (null, '1', 'nav_admin', '1', '_admin_', '../admin/', '0', '1', '1', '1', '0');
INSERT INTO dzcp_navi VALUES (null, '1', 'nav_user', '1', '_lobby_', '../user/?action=userlobby', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES (null, '2', 'nav_user', '1', '_nachrichten_', '../user/?action=msg', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES (null, '3', 'nav_user', '1', '_buddys_', '../user/?action=buddys', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES (null, '4', 'nav_user', '1', '_edit_profile_', '../user/?action=editprofile', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES (null, '6', 'nav_user', '1', '_logout_', '../user/?action=logout', '0', '1', '0', '1', '0');
INSERT INTO dzcp_navi VALUES (null, '30', 'nav_main', '1', '_impressum_', '../impressum/', '0', '2', '0', '0', '0');
INSERT INTO dzcp_navi VALUES (null, '5', 'nav_main', '1', 'GitHub Projekt', 'https://github.com/DZCP-Community', '1', '2', '0', '0', '0');

-- ----------------------------
-- Table structure for `dzcp_navi_kats`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_navi_kats`;
CREATE TABLE `dzcp_navi_kats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `placeholder` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `level` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `placeholder` (`placeholder`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dzcp_navi_kats
-- ----------------------------
INSERT INTO dzcp_navi_kats VALUES (null, 'Main Navigation', 'nav_main', '0');
INSERT INTO dzcp_navi_kats VALUES (null, 'Admin Navigation', 'nav_admin', '4');
INSERT INTO dzcp_navi_kats VALUES (null, 'User Navigation', 'nav_user', '1');

-- ----------------------------
-- Table structure for `dzcp_news`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_news`;
CREATE TABLE `dzcp_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autor` int(5) NOT NULL DEFAULT '0',
  `datum` int(20) NOT NULL DEFAULT '0',
  `kat` int(2) NOT NULL DEFAULT '0',
  `sticky` int(20) NOT NULL DEFAULT '0',
  `titel` varchar(249) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `intern` int(1) NOT NULL DEFAULT '0',
  `text` text CHARACTER SET utf8,
  `more` text CHARACTER SET utf8,
  `link1` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `url1` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `link2` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `url2` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `link3` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `url3` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `viewed` int(10) NOT NULL DEFAULT '0',
  `public` int(1) NOT NULL DEFAULT '0',
  `timeshift` int(14) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_newscomments`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_newscomments`;
CREATE TABLE `dzcp_newscomments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news` int(10) NOT NULL DEFAULT '0',
  `nick` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `datum` int(20) NOT NULL DEFAULT '0',
  `email` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `hp` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `reg` int(5) NOT NULL DEFAULT '0',
  `comment` text CHARACTER SET utf8,
  `ip` varchar(15) CHARACTER SET utf8 NOT NULL DEFAULT '0.0.0.0',
  `editby` text CHARACTER SET utf8,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_newskat`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_newskat`;
CREATE TABLE `dzcp_newskat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `katimg` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `kategorie` varchar(60) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dzcp_newskat
-- ----------------------------
INSERT INTO dzcp_newskat VALUES ('1', 'hp.jpg', 'Homepage');

-- ----------------------------
-- Table structure for `dzcp_partners`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_partners`;
CREATE TABLE `dzcp_partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(150) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `banner` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `textlink` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dzcp_partners
-- ----------------------------
INSERT INTO dzcp_partners VALUES ('4', 'http://www.dzcp.de', 'dzcp.gif', '0');

-- ----------------------------
-- Table structure for `dzcp_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_permissions`;
CREATE TABLE `dzcp_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(5) NOT NULL DEFAULT '0',
  `pos` int(1) NOT NULL DEFAULT '0',
  `positions` int(1) NOT NULL DEFAULT '0',
  `intforum` int(1) NOT NULL DEFAULT '0',
  `config` int(1) NOT NULL DEFAULT '0',
  `editusers` int(1) NOT NULL DEFAULT '0',
  `editsquads` int(1) NOT NULL DEFAULT '0',
  `editkalender` int(1) NOT NULL DEFAULT '0',
  `news` int(1) NOT NULL DEFAULT '0',
  `partners` int(1) NOT NULL DEFAULT '0',
  `protocol` int(1) NOT NULL DEFAULT '0',
  `forum` int(1) NOT NULL DEFAULT '0',
  `forumkats` int(1) NOT NULL DEFAULT '0',
  `votes` int(1) NOT NULL DEFAULT '0',
  `votesadmin` int(1) NOT NULL DEFAULT '0',
  `links` int(1) NOT NULL DEFAULT '0',
  `downloads` int(1) NOT NULL DEFAULT '0',
  `newsletter` int(1) NOT NULL DEFAULT '0',
  `intnews` int(1) NOT NULL DEFAULT '0',
  `impressum` int(1) NOT NULL DEFAULT '0',
  `artikel` int(1) NOT NULL DEFAULT '0',
  `editor` int(1) NOT NULL DEFAULT '0',
  `dlintern` int(1) NOT NULL DEFAULT '0',
  `ipban` int(1) NOT NULL DEFAULT '0',
  `startpage` int(1) NOT NULL DEFAULT '0',
  `activateusers` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user` (`user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dzcp_permissions
-- ----------------------------
INSERT INTO dzcp_permissions VALUES (null, '2', '0', '0', '0', '0', '1', '1', '0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for `dzcp_positions`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_positions`;
CREATE TABLE `dzcp_positions` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `pid` int(2) NOT NULL DEFAULT '0',
  `position` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `nletter` int(1) NOT NULL DEFAULT '0',
  `color` varchar(7) NOT NULL DEFAULT '#000000',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dzcp_positions
-- ----------------------------
INSERT INTO dzcp_positions VALUES (null, '28', 'Coder', '0', '#ff0000');
INSERT INTO dzcp_positions VALUES (null, '24', 'Translator', '0', '#953734');
INSERT INTO dzcp_positions VALUES (null, '1', 'VIP', '0', '#548dd4');
INSERT INTO dzcp_positions VALUES (null, '27', 'Moderator', '0', '#ffc000');
INSERT INTO dzcp_positions VALUES (null, '0', 'Lizenzinhaber', '0', '#000000');

-- ----------------------------
-- Table structure for `dzcp_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_sessions`;
CREATE TABLE `dzcp_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ssid` varchar(200) NOT NULL DEFAULT '',
  `time` int(11) NOT NULL DEFAULT '0',
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `ssid` (`ssid`) USING BTREE,
  KEY `time` (`time`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_settings`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_settings`;
CREATE TABLE `dzcp_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(200) NOT NULL DEFAULT '',
  `value` text,
  `default` text,
  `length` int(11) NOT NULL DEFAULT '1',
  `type` varchar(20) NOT NULL DEFAULT 'int' COMMENT 'int/string',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dzcp_settings
-- ----------------------------
INSERT INTO dzcp_settings VALUES (null, 'eml_fabo_npost', '&lt;p&gt;Hallo [nick],&lt;br /&gt;&lt;br /&gt; [postuser] hat auf das Thema: [topic] auf der Website: &quot;[titel]&quot; geantwortet.&lt;br /&gt;&lt;br /&gt; Den neuen Beitrag erreichst Du ber folgenden Link:&lt;br /&gt; &lt;a href=&quot;http://[domain]/?index=forum&amp;action=showthread&amp;id=[id]&amp;page=[page]#p[entrys]&quot;&gt;http://[domain]/?index=forum&amp;action=showthread&amp;id=[id]&amp;page=[page]#p[entrys]&lt;/a&gt;&lt;/p&gt; &lt;table border=&quot;0&quot; cellspacing=&quot;2&quot; cellpadding=&quot;2&quot; style=&quot;width: 400px;&quot;&gt; &lt;tbody&gt; &lt;tr&gt; &lt;td height=&quot;30&quot;&gt;[postuser] hat folgenden Text geschrieben:&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;[text]&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;/tbody&gt; &lt;/table&gt; &lt;p&gt;Mit freundlichen Gr&uuml;&szlig;en,&lt;br /&gt;&lt;br /&gt;Dein [clan]&lt;/p&gt; &lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '&lt;p&gt;Hallo [nick],&lt;br /&gt;&lt;br /&gt; [postuser] hat auf das Thema: [topic] auf der Website: &quot;[titel]&quot; geantwortet.&lt;br /&gt;&lt;br /&gt; Den neuen Beitrag erreichst Du ber folgenden Link:&lt;br /&gt; &lt;a href=&quot;http://[domain]/?index=forum&amp;amp;action=showthread&amp;amp;id=[id]&amp;amp;page=[page]#p[entrys]&quot;&gt;http://[domain]/?index=forum&amp;amp;action=showthread&amp;amp;id=[id]&amp;amp;page=[page]#p[entrys]&lt;/a&gt;&lt;/p&gt;\r\n&lt;table border=&quot;0&quot; cellspacing=&quot;2&quot; cellpadding=&quot;2&quot; style=&quot;width: 400px;&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td height=&quot;30&quot;&gt;[postuser] hat folgenden Text geschrieben:&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;[text]&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;p&gt;Mit freundlichen Gr&uuml;&szlig;en,&lt;br /&gt;&lt;br /&gt;Dein [clan]&lt;/p&gt;\r\n&lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '0', 'string');
INSERT INTO dzcp_settings VALUES (null, 'eml_fabo_npost_subj', 'Neuer Beitrag auf abonniertes Thema im [titel]', 'Neuer Beitrag auf abonniertes Thema im [titel]', '0', 'string');
INSERT INTO dzcp_settings VALUES (null, 'eml_fabo_pedit', '&lt;p&gt;Hallo [nick],&lt;br /&gt;&lt;br /&gt; Ein Beitrag im Thread mit dem Titel: [topic] auf der Website: &quot;[titel]&quot; wurde soeben von [postuser] bearbeitet.&lt;br /&gt; &lt;br /&gt; Den bearbeitete Beitrag erreichst Du ber folgenden Link:&lt;br /&gt; &lt;a href=&quot;http://[domain]/?index=forum&amp;action=showthread&amp;id=[id]&amp;page=[page]#p[entrys]&quot;&gt;http://[domain]/?index=forum&amp;action=showthread&amp;id=[id]&amp;page=[page]#p[entrys]&lt;/a&gt;&lt;/p&gt; &lt;table style=&quot;width: 400px;&quot; cellpadding=&quot;2&quot; cellspacing=&quot;2&quot; border=&quot;0&quot;&gt; &lt;tbody&gt; &lt;tr&gt; &lt;td height=&quot;30&quot;&gt;[postuser] hat folgenden neuen Text geschrieben:&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;[text]&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;/tbody&gt; &lt;/table&gt; &lt;p&gt;Mit freundlichen Gr&uuml;&szlig;en,&lt;br /&gt;&lt;br /&gt;Dein [clan]&lt;/p&gt; &lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '&lt;p&gt;Hallo [nick],&lt;br /&gt;&lt;br /&gt; Ein Beitrag im Thread mit dem Titel: [topic] auf der Website: &quot;[titel]&quot; wurde soeben von [postuser] bearbeitet.&lt;br /&gt; &lt;br /&gt; Den bearbeitete Beitrag erreichst Du ber folgenden Link:&lt;br /&gt; &lt;a href=&quot;http://[domain]/?index=forum&amp;amp;action=showthread&amp;amp;id=[id]&amp;amp;page=[page]#p[entrys]&quot;&gt;http://[domain]/?index=forum&amp;amp;action=showthread&amp;amp;id=[id]&amp;amp;page=[page]#p[entrys]&lt;/a&gt;&lt;/p&gt;\r\n&lt;table border=&quot;0&quot; cellspacing=&quot;2&quot; cellpadding=&quot;2&quot; style=&quot;width: 400px;&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td height=&quot;30&quot;&gt;[postuser] hat folgenden neuen Text geschrieben:&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;[text]&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;p&gt;Mit freundlichen Gr&uuml;&szlig;en,&lt;br /&gt;&lt;br /&gt;Dein [clan]&lt;/p&gt;\r\n&lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '0', 'string');
INSERT INTO dzcp_settings VALUES (null, 'eml_fabo_pedit_subj', 'Beitrag auf abonniertes Thema im [titel] wurde bearbeitet', 'Beitrag auf abonniertes Thema im [titel] wurde bearbeitet', '0', 'string');
INSERT INTO dzcp_settings VALUES (null, 'eml_fabo_tedit_subj', 'Thread auf abonniertes Thema im [titel] wurde bearbeitet', 'Thread auf abonniertes Thema im [titel] wurde bearbeitet', '0', 'string');
INSERT INTO dzcp_settings VALUES (null, 'eml_nletter', '&lt;p&gt;[text]&lt;br /&gt;&lt;br /&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '&lt;p&gt;[text]&lt;br /&gt;&lt;br /&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '0', 'string');
INSERT INTO dzcp_settings VALUES (null, 'eml_fabo_tedit', '&lt;p&gt;Hallo [nick],&lt;br /&gt; &lt;br /&gt; Der Thread mit dem Titel: [topic] auf der Website: &quot;[titel]&quot; wurde soeben von [postuser] bearbeitet.&lt;br /&gt; Den bearbeitete Beitrag erreichst Du ber folgenden Link:&lt;br /&gt; &lt;a href=&quot;http://[domain]/?index=forum&amp;action=showthread&amp;id=[id]&quot;&gt;http://[domain]/?index=forum&amp;action=showthread&amp;id=[id]&lt;/a&gt;&lt;/p&gt; &lt;table style=&quot;width: 400px;&quot; cellpadding=&quot;2&quot; cellspacing=&quot;2&quot; border=&quot;0&quot;&gt; &lt;tbody&gt; &lt;tr&gt; &lt;td height=&quot;30&quot;&gt;[postuser] hat folgenden neuen Text geschrieben:&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;[text]&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;/tbody&gt; &lt;/table&gt; &lt;p&gt;Mit freundlichen Gr&uuml;&szlig;en,&lt;br /&gt;&lt;br /&gt;Dein [clan]&lt;/p&gt; &lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '&lt;p&gt;Hallo [nick],&lt;br /&gt; &lt;br /&gt; Der Thread mit dem Titel: [topic] auf der Website: &quot;[titel]&quot; wurde soeben von [postuser] bearbeitet.&lt;br /&gt; Den bearbeitete Beitrag erreichst Du ber folgenden Link:&lt;br /&gt; &lt;a href=&quot;http://[domain]/?index=forum&amp;amp;action=showthread&amp;amp;id=[id]&quot;&gt;http://[domain]/?index=forum&amp;amp;action=showthread&amp;amp;id=[id]&lt;/a&gt;&lt;/p&gt;\r\n&lt;table border=&quot;0&quot; cellspacing=&quot;2&quot; cellpadding=&quot;2&quot; style=&quot;width: 400px;&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td height=&quot;30&quot;&gt;[postuser] hat folgenden neuen Text geschrieben:&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;[text]&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;p&gt;Mit freundlichen Gr&uuml;&szlig;en,&lt;br /&gt;&lt;br /&gt;Dein [clan]&lt;/p&gt;\r\n&lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '0', 'string');
INSERT INTO dzcp_settings VALUES (null, 'eml_nletter_subj', 'Newsletter', 'Newsletter', '0', 'string');
INSERT INTO dzcp_settings VALUES (null, 'eml_pn', '&lt;p&gt;Hallo [nick],&lt;br /&gt;&lt;br /&gt; Du hast eine neue Nachricht in deinem Postfach.&lt;/p&gt; &lt;table border=&quot;0&quot; cellspacing=&quot;2&quot; cellpadding=&quot;2&quot; style=&quot;width: 400px;&quot;&gt; &lt;tbody&gt; &lt;tr&gt; &lt;td height=&quot;30&quot;&gt;Titel: [titel]&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;&lt;a href=&quot;http://[domain]/user/index.php?action=msg&quot;&gt;Zum Nachrichten-Center&lt;/a&gt;&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;/tbody&gt; &lt;/table&gt; &lt;p&gt;Mit freundlichen Gr&uuml;&szlig;en,&lt;br /&gt;&lt;br /&gt;Dein [clan]&lt;/p&gt; &lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt; &lt;p&gt;Mit freundlichen Gr&uuml;&szlig;en,&lt;br /&gt;&lt;br /&gt;Dein [clan]&lt;/p&gt; &lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '&lt;p&gt;Hallo [nick],&lt;br /&gt;&lt;br /&gt; Du hast eine neue Nachricht in deinem Postfach.&lt;/p&gt;\r\n&lt;table border=&quot;0&quot; cellspacing=&quot;2&quot; cellpadding=&quot;2&quot; style=&quot;width: 400px;&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td height=&quot;30&quot;&gt;Titel: [titel]&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;a href=&quot;http://[domain]/user/index.php?action=msg&quot;&gt;Zum Nachrichten-Center&lt;/a&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;p&gt;Mit freundlichen Gr&uuml;&szlig;en,&lt;br /&gt;&lt;br /&gt;Dein [clan]&lt;/p&gt;\r\n&lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '0', 'string');
INSERT INTO dzcp_settings VALUES (null, 'eml_pn_subj', 'Neue PN auf [domain]', 'Neue PN auf [domain]', '0', 'string');
INSERT INTO dzcp_settings VALUES (null, 'eml_pwd', '&lt;p&gt;Ein neues Passwort wurde f&uuml;r deinen Account generiert!&lt;/p&gt; &lt;table style=&quot;width: 400px;&quot; cellpadding=&quot;2&quot; cellspacing=&quot;2&quot; border=&quot;0&quot;&gt; &lt;tbody&gt; &lt;tr&gt; &lt;td colspan=&quot;2&quot; height=&quot;30&quot;&gt;Deine Logindaten lauten:&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td width=&quot;120&quot;&gt;Login-Name:&lt;/td&gt; &lt;td&gt;[user]&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;Passwort:&lt;/td&gt; &lt;td&gt;[pwd]&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;/tbody&gt; &lt;/table&gt; &lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '&lt;p&gt;Ein neues Passwort wurde f&amp;uuml;r deinen Account generiert!&lt;/p&gt;\r\n&lt;table border=&quot;0&quot; cellspacing=&quot;2&quot; cellpadding=&quot;2&quot; style=&quot;width: 400px;&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td height=&quot;30&quot; colspan=&quot;2&quot;&gt;Deine Logindaten lauten:&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td width=&quot;120&quot;&gt;Login-Name:&lt;/td&gt;\r\n&lt;td&gt;[user]&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;Passwort:&lt;/td&gt;\r\n&lt;td&gt;[pwd]&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '0', 'string');
INSERT INTO dzcp_settings VALUES (null, 'eml_pwd_subj', 'Deine Zugangsdaten', 'Deine Zugangsdaten', '0', 'string');
INSERT INTO dzcp_settings VALUES (null, 'eml_reg_subj', 'Deine Registrierung', 'Deine Registrierung', '0', 'string');
INSERT INTO dzcp_settings VALUES (null, 'eml_reg', '&lt;p&gt;Du hast dich erfolgreich auf unserer Seite registriert!&lt;/p&gt; &lt;table style=&quot;width: 400px;&quot; cellpadding=&quot;2&quot; cellspacing=&quot;2&quot; border=&quot;0&quot;&gt; &lt;tbody&gt; &lt;tr&gt; &lt;td colspan=&quot;2&quot; height=&quot;30&quot;&gt;Deine Logindaten lauten:&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td width=&quot;120&quot;&gt;Login-Name:&lt;/td&gt; &lt;td&gt;[user]&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;Passwort:&lt;/td&gt; &lt;td&gt;[pwd]&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;/tbody&gt; &lt;/table&gt; &lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '&lt;p&gt;Du hast dich erfolgreich auf unserer Seite registriert!&lt;/p&gt;\r\n&lt;table style=&quot;width: 400px;&quot; cellpadding=&quot;2&quot; cellspacing=&quot;2&quot; border=&quot;0&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td colspan=&quot;2&quot; height=&quot;30&quot;&gt;Deine Logindaten lauten:&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td width=&quot;120&quot;&gt;Login-Name:&lt;/td&gt;\r\n&lt;td&gt;[user]&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;Passwort:&lt;/td&gt;\r\n&lt;td&gt;[pwd]&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '0', 'string');
INSERT INTO dzcp_settings VALUES (null, 'securelogin', '1', '1', '1', 'int');
INSERT INTO dzcp_settings VALUES (null, 'badwords', 'arsch,Arsch,arschloch,Arschloch,hure,Hure', '', '0', 'string');
INSERT INTO dzcp_settings VALUES (null, 'clanname', 'Dein Clanname hier!', 'Dein Clanname hier!', '80', 'string');
INSERT INTO dzcp_settings VALUES (null, 'db_version', '1.7.0.0', '1.7.0.0', '7', 'string');
INSERT INTO dzcp_settings VALUES (null, 'default_pwd_encoder', '2', '2', '1', 'int');
INSERT INTO dzcp_settings VALUES (null, 'direct_refresh', '1', '0', '1', 'int');
INSERT INTO dzcp_settings VALUES (null, 'domain', '169.254.164.198', '127.0.0.1', '150', 'string');
INSERT INTO dzcp_settings VALUES (null, 'double_post', '1', '1', '1', 'int');
INSERT INTO dzcp_settings VALUES (null, 'forum_vote', '1', '1', '1', 'int');
INSERT INTO dzcp_settings VALUES (null, 'f_artikelcom', '20', '20', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'f_forum', '20', '20', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'f_newscom', '20', '20', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'language', 'de', 'de', '50', 'string');
INSERT INTO dzcp_settings VALUES (null, 'l_forumsubtopic', '20', '20', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'l_forumtopic', '20', '20', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'l_ftopics', '28', '28', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'l_lartikel', '18', '18', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'l_lnews', '22', '22', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'l_lreg', '12', '12', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'l_newsadmin', '20', '20', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'l_newsarchiv', '20', '20', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'l_topdl', '20', '20', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'mailfrom', 'support@hammermaps.de', 'info@127.0.0.1', '100', 'string');
INSERT INTO dzcp_settings VALUES (null, 'mail_extension', 'mail', 'mail', '20', 'string');
INSERT INTO dzcp_settings VALUES (null, 'maxwidth', '400', '400', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'm_adminartikel', '15', '15', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'm_adminnews', '20', '20', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'm_archivnews', '30', '30', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'm_artikel', '15', '15', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'm_comments', '10', '10', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'm_events', '5', '5', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'm_fposts', '10', '10', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'm_fthreads', '20', '20', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'm_ftopics', '6', '6', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'm_lartikel', '5', '5', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'm_lnews', '6', '6', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'm_lreg', '5', '5', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'm_news', '5', '5', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'm_topdl', '5', '5', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'm_userlist', '40', '40', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'news_feed', '1', '1', '1', 'int');
INSERT INTO dzcp_settings VALUES (null, 'pagetitel', 'Dein Seitentitel hier!', 'Dein Seitentitel hier!', '50', 'string');
INSERT INTO dzcp_settings VALUES (null, 'prev', 'ijgf9i5t', 'hs4', '3', 'string');
INSERT INTO dzcp_settings VALUES (null, 'regcode', '1', '1', '1', 'int');
INSERT INTO dzcp_settings VALUES (null, 'reg_artikel', '1', '1', '1', 'int');
INSERT INTO dzcp_settings VALUES (null, 'reg_dl', '1', '1', '1', 'int');
INSERT INTO dzcp_settings VALUES (null, 'reg_forum', '1', '1', '1', 'int');
INSERT INTO dzcp_settings VALUES (null, 'reg_newscomments', '1', '1', '1', 'int');
INSERT INTO dzcp_settings VALUES (null, 'sendmail_path', '/usr/sbin/sendmail', '/usr/sbin/sendmail', '150', 'string');
INSERT INTO dzcp_settings VALUES (null, 'smtp_hostname', 'master.hammermaps.de', 'localhost', '100', 'string');
INSERT INTO dzcp_settings VALUES (null, 'smtp_password', 'SVxZCDVEaRUSYABJEgoQdURpGRJgDEReUwt3RCcDEzFeHVxJUzxFMlgKeQYSVlBP', '', '0', 'string');
INSERT INTO dzcp_settings VALUES (null, 'smtp_port', '25', '25', '11', 'int');
INSERT INTO dzcp_settings VALUES (null, 'smtp_tls_ssl', '0', '0', '1', 'int');
INSERT INTO dzcp_settings VALUES (null, 'smtp_username', 'godkiller_nt@hammermaps.de', '', '150', 'string');
INSERT INTO dzcp_settings VALUES (null, 'tmpdir', 'version1.6', 'version1.6', '50', 'string');
INSERT INTO dzcp_settings VALUES (null, 'upicsize', '270', '100', '5', 'int');
INSERT INTO dzcp_settings VALUES (null, 'urls_linked', '1', '1', '1', 'int');
INSERT INTO dzcp_settings VALUES (null, 'wmodus', '0', '0', '1', 'int');
INSERT INTO dzcp_settings VALUES (null, 'pwd_encoder', '2', '2', '1', 'int');
INSERT INTO dzcp_settings VALUES (null, 'eml_akl_register_subj', 'Dein Aktivierungslink', 'Dein Aktivierungslink', '0', 'string');
INSERT INTO dzcp_settings VALUES (null, 'eml_akl_register', '&lt;p&gt;Hallo [nick],&lt;br /&gt;&lt;br /&gt; Dein Account muss noch aktiviert werden, danach kannst du dich anmelden.&lt;/p&gt; &lt;table border=&quot;0&quot; cellspacing=&quot;2&quot; cellpadding=&quot;2&quot; style=&quot;width: 600px;&quot;&gt; &lt;tbody&gt; &lt;tr&gt; &lt;td height=&quot;30&quot; colspan=&quot;2&quot;&gt;Deine Aktivierung:&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td width=&quot;120&quot;&gt;Aktivierungslink:&lt;/td&gt; &lt;td&gt;[link]&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;Aktivierungscode:&lt;/td&gt; &lt;td&gt;[guid]&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;/tbody&gt; &lt;/table&gt; &lt;br /&gt; &lt;p&gt;Falls der Link nicht funktioniert, kannst du den Aktivierungscode auch auf &quot;[link_page]&quot; eingeben.&lt;br /&gt;&lt;br /&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '<p>Hallo [nick],<br /> Dein Account muss noch aktiviert werden, danach kannst du dich anmelden.</p>\\r\\n<table border=\"0\" cellspacing=\"2\" cellpadding=\"2\" style=\"width: 600px;\">\\r\\n<tbody>\\r\\n<tr>\\r\\n<td height=\"30\" colspan=\"2\">Deine Aktivierung:</td>\\r\\n</tr>\\r\\n<tr>\\r\\n<td colspan=\"2\"><hr /></td>\\r\\n</tr>\\r\\n<tr>\\r\\n<td width=\"120\">Aktivierungslink:</td>\\r\\n<td>[link]</td>\\r\\n</tr>\\r\\n<tr>\\r\\n<td>Aktivierungscode:</td>\\r\\n<td>[guid]</td>\\r\\n</tr>\\r\\n<tr>\\r\\n<td colspan=\"2\"><hr /></td>\\r\\n</tr>\\r\\n</tbody>\\r\\n</table>\\r\\n<p>Falls der Link nicht funktioniert, kannst du den Aktivierungscode auch auf \"[link_page]\" eingeben.</p>\\r\\n<p>[ Diese Email wurde automatisch generiert, bitte nicht antworten ]</p>', '0', 'string');
INSERT INTO dzcp_settings VALUES (null, 'use_akl', '1', '1', '1', 'int');

-- ----------------------------
-- Table structure for `dzcp_sites`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_sites`;
CREATE TABLE `dzcp_sites` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `titel` text CHARACTER SET utf8,
  `text` text CHARACTER SET utf8,
  `html` int(1) NOT NULL,
  `php` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_sponsoren`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_sponsoren`;
CREATE TABLE `dzcp_sponsoren` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(249) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `link` varchar(249) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `beschreibung` text CHARACTER SET utf8,
  `site` int(1) NOT NULL DEFAULT '0',
  `slink` varchar(249) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `banner` int(1) NOT NULL DEFAULT '0',
  `bend` varchar(5) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `blink` varchar(249) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `box` int(1) NOT NULL DEFAULT '0',
  `xend` varchar(5) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `xlink` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `pos` int(5) NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `banner` (`banner`) USING BTREE,
  KEY `pos` (`pos`) USING BTREE,
  KEY `site` (`site`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_startpage`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_startpage`;
CREATE TABLE `dzcp_startpage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `level` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dzcp_startpage
-- ----------------------------
INSERT INTO dzcp_startpage VALUES (null, 'Artikel', 'artikel/', '1');
INSERT INTO dzcp_startpage VALUES (null, 'News', 'news/', '1');
INSERT INTO dzcp_startpage VALUES (null, 'Forum', 'forum/', '1');

-- ----------------------------
-- Table structure for `dzcp_userbuddys`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_userbuddys`;
CREATE TABLE `dzcp_userbuddys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(5) NOT NULL DEFAULT '0',
  `buddy` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user` (`user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_userposis`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_userposis`;
CREATE TABLE `dzcp_userposis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(5) NOT NULL DEFAULT '0',
  `posi` int(5) NOT NULL DEFAULT '0',
  `group` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user` (`user`) USING BTREE,
  KEY `squad` (`group`) USING BTREE,
  KEY `posi` (`posi`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dzcp_userposis
-- ----------------------------
INSERT INTO dzcp_userposis VALUES (null, '1', '1', '1');

-- ----------------------------
-- Table structure for `dzcp_users`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_users`;
CREATE TABLE `dzcp_users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `user` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `nick` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `pwd` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `pwd_encoder` int(1) NOT NULL DEFAULT '0',
  `sessid` varchar(32) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `actkey` varchar(100) NOT NULL DEFAULT '',
  `country` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT 'de',
  `ip` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `regdatum` int(20) NOT NULL DEFAULT '0',
  `email` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `level` int(2) NOT NULL DEFAULT '0',
  `banned` int(1) NOT NULL DEFAULT '0',
  `rlname` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `city` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `sex` int(1) NOT NULL DEFAULT '0',
  `bday` int(11) NOT NULL DEFAULT '0',
  `hp` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `cpu` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `ram` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `monitor` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `maus` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mauspad` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `headset` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `board` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `os` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `graka` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `hdd` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `inet` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `signatur` text CHARACTER SET utf8,
  `position` int(2) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `time` int(20) NOT NULL DEFAULT '0',
  `listck` int(1) NOT NULL DEFAULT '0',
  `online` int(1) NOT NULL DEFAULT '0',
  `nletter` int(1) NOT NULL DEFAULT '1',
  `whereami` text CHARACTER SET utf8,
  `rasse` varchar(249) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `url2` varchar(249) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `url3` varchar(249) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `beschreibung` text CHARACTER SET utf8,
  `pnmail` int(1) NOT NULL DEFAULT '1',
  `perm_gallery` int(1) NOT NULL DEFAULT '0',
  `perm_gb` int(1) NOT NULL DEFAULT '1',
  `profile_access` int(1) NOT NULL DEFAULT '1',
  `startpage` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pwd` (`pwd`) USING BTREE,
  KEY `time` (`time`) USING BTREE,
  KEY `bday` (`bday`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dzcp_users
-- ----------------------------
INSERT INTO dzcp_users VALUES (null, 'admin', 'Administrator', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '2', '4r0a92rh4215p817k314bbrl72b021jt', '', 'de', '', '1422295535', 'support@hammermaps.de', '4', '0', 'bn', 'Erkrath', '1', '860277600', 'http://www.dzcp.de', '', '', '', '', '', '', '', '', '', '', '', 'nbmbnmnbmbn', '1', '0', '1493918540', '0', '1', '1', '', '', '', '', 'bnmbnm', '1', '0', '1', '1', '0');

-- ----------------------------
-- Table structure for `dzcp_userstats`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_userstats`;
CREATE TABLE `dzcp_userstats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(10) NOT NULL DEFAULT '0',
  `logins` int(11) NOT NULL DEFAULT '0',
  `writtenmsg` int(10) NOT NULL DEFAULT '0',
  `lastvisit` int(20) NOT NULL DEFAULT '0',
  `hits` int(11) NOT NULL DEFAULT '0',
  `votes` int(5) NOT NULL DEFAULT '0',
  `profilhits` int(20) NOT NULL DEFAULT '0',
  `forumthreads` int(11) NOT NULL DEFAULT '0',
  `forumposts` int(5) NOT NULL DEFAULT '0',
  `akl` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user` (`user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dzcp_userstats
-- ----------------------------
INSERT INTO dzcp_userstats VALUES (null, '1', '0', '0', '0', '0', '0', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for `dzcp_votes`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_votes`;
CREATE TABLE `dzcp_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` int(20) NOT NULL DEFAULT '0',
  `titel` varchar(249) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `intern` int(1) NOT NULL DEFAULT '0',
  `menu` int(1) NOT NULL DEFAULT '0',
  `closed` int(1) NOT NULL DEFAULT '0',
  `von` int(10) NOT NULL DEFAULT '0',
  `forum` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `dzcp_vote_results`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_vote_results`;
CREATE TABLE `dzcp_vote_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vid` int(5) NOT NULL DEFAULT '0',
  `what` varchar(5) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `sel` varchar(80) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `stimmen` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `vid` (`vid`) USING BTREE,
  KEY `what` (`what`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

