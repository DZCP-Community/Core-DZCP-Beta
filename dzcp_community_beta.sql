/*
Navicat MySQL Data Transfer

Source Server         : Root-Online
Source Server Version : 50505
Source Host           : mysql.hammermaps.de:3306
Source Database       : dzcp_community_beta

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-05-28 16:02:02
*/

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
) ENGINE=Aria AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_acomments
-- ----------------------------
INSERT INTO dzcp_acomments VALUES ('2', '3', '', '1493047358', '', '', '1', 'ffdsfsdfdwew3421312312', '88.152.46.77', '&lt;br /&gt;&lt;br /&gt;&lt;i&gt;zuletzt editiert von &lt;img src=&quot;../inc/images/flaggen/de.gif&quot; alt=&quot;&quot; class=&quot;icon&quot; /&gt; &lt;a class=&quot;&quot; href=&quot;../user/?action=user&amp;amp;id=1&quot;&gt;Administrator&lt;/a&gt; am 24.04.2017 17:25 &amp;nbsp;Uhr&lt;/i&gt;');
INSERT INTO dzcp_acomments VALUES ('3', '3', 'Administrator', '1493047416', 'support@hammermaps.de', 'http://www.dzcp.de', '1', 'ffdsfsdfd', '88.152.46.77', null);
INSERT INTO dzcp_acomments VALUES ('5', '2', 'Administrator', '1493050665', 'support@hammermaps.de', 'http://www.dzcp.de', '1', 'cxvxcvxcvxcvxc', '88.152.46.77', null);
INSERT INTO dzcp_acomments VALUES ('6', '4', 'Administrator', '1493050679', 'support@hammermaps.de', 'http://www.dzcp.de', '1', 'xvxcvxcvxc', '88.152.46.77', null);
INSERT INTO dzcp_acomments VALUES ('7', '4', 'Administrator', '1493051383', 'support@hammermaps.de', 'http://www.dzcp.de', '1', 'sdfsdfsdfsdfsdfsd', '88.152.46.77', null);

-- ----------------------------
-- Table structure for `dzcp_addon_mods`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_addon_mods`;
CREATE TABLE `dzcp_addon_mods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(20) NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL DEFAULT '',
  `description` text,
  `edition` varchar(200) NOT NULL DEFAULT 'dev',
  `version` varchar(20) NOT NULL DEFAULT '1.0',
  `enabled` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dzcp_addon_mods
-- ----------------------------
INSERT INTO dzcp_addon_mods VALUES ('1', '9576934', 'Test Addon', 'Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test ', 'dev', '1.0', '1');

-- ----------------------------
-- Table structure for `dzcp_addon_mods_changelog`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_addon_mods_changelog`;
CREATE TABLE `dzcp_addon_mods_changelog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(20) NOT NULL DEFAULT '0',
  `date` int(20) NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL DEFAULT '',
  `text` text,
  `public` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dzcp_addon_mods_changelog
-- ----------------------------
INSERT INTO dzcp_addon_mods_changelog VALUES ('1', '9576934', '123456', 'Version 1.0.77242 (23.05.2017)', 'Bug fixes\r\n\r\nFix eines Fehlers, welcher bewirkte das personalisierte Module ihre Personalisierung verloren nach dem Updaten des TeamViewers aus der Ferne\r\nFix eines Fehlers, welcher den unbeaufsichtigten Zugriffs-Konfigurationsdialog angezeigt wurde, nachdem TeamViewer aus der Ferne geupdatet wurde\r\nFix eines Fehlers, durch den das TeamViewer Fenster hüpfte in den Focus und umgekehrt mit KeePass\r\nFix eines Fehlers, durch den das Laden der Chat Räume nach einiger Zeit gestoppt ist\r\nWeitere Fehler behoben, die Crashs auslösten\r\nKleinere Korrekturen und Verbesserungen', '1');

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
) ENGINE=Aria AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_addon_version
-- ----------------------------
INSERT INTO dzcp_addon_version VALUES ('1', '1.6', '1.6.0.3', 'stable', '10.05.2015', '1603.00.00', '1495980042', '1');
INSERT INTO dzcp_addon_version VALUES ('2', '1.6', '1.6.0.4', 'dev', '24.03.2016', '1604.00.01', '1495980042', '1');
INSERT INTO dzcp_addon_version VALUES ('3', '1.6', '1.6.0.3', 'society', '10.05.2015', '1603.00.00', '1495980042', '1');
INSERT INTO dzcp_addon_version VALUES ('4', '1.7', '1.7.0.0', 'stable', '14.01.2015', '1700.00.33', '1495980043', '1');
INSERT INTO dzcp_addon_version VALUES ('5', '1.7', '1.7.0.0', 'dev', '04.05.2017', '1700.10.01', '1495980043', '1');
INSERT INTO dzcp_addon_version VALUES ('6', '1.7', '1.7', 'society', '00.00.0000', '1700.00.00', '0', '0');

-- ----------------------------
-- Table structure for `dzcp_artikel`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_artikel`;
CREATE TABLE `dzcp_artikel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autor` int(11) NOT NULL DEFAULT '0',
  `datum` int(20) NOT NULL DEFAULT '0',
  `kat` int(5) NOT NULL DEFAULT '0',
  `titel` varchar(249) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  `link1` varchar(100) NOT NULL DEFAULT '',
  `url1` varchar(200) NOT NULL DEFAULT '',
  `link2` varchar(100) NOT NULL DEFAULT '',
  `url2` varchar(200) NOT NULL DEFAULT '',
  `link3` varchar(100) NOT NULL DEFAULT '',
  `url3` varchar(200) NOT NULL DEFAULT '',
  `public` int(1) NOT NULL DEFAULT '0',
  `viewed` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_artikel
-- ----------------------------
INSERT INTO dzcp_artikel VALUES ('1', '1', '1422295535', '1', 'Testartikel', '&lt;p&gt;Hier k&ouml;nnte dein Artikel stehen!&lt;/p&gt;\r\n&lt;p&gt; &lt;/p&gt;', '', '', '', '', '', '', '0', '10');
INSERT INTO dzcp_artikel VALUES ('2', '1', '1492631770', '1', 'sadasdasdas', '[quote][b]vxcxcvxcv[/b] [i]sdfsdfsdfsdf[/i][/quote]\r\n', '', '', '', '', '', '', '0', '1');
INSERT INTO dzcp_artikel VALUES ('3', '1', '1492631773', '0', 'dsfsdfdsfsdfsd', '&ouml;&uuml;&auml; [b]Big[/b] [i]Kusiv[/i] DSS\r\n[list=1]\r\n[*]List 1\r\n[*]List 2\r\n[*]List 3\r\n[*]List 4\r\n[/list]\r\n[list]\r\n[*]List 5\r\n[*]List 6\r\n[*]List 7\r\n[/list]\r\n[quote]Quote ï¿½TEXTTEXTTEXTTEXT[/quote]\r\n [url=http://fsdfdsfsdfsdfsdfsd]LINK[/url] [img]http://test.hammermaps.de/inc/_templates_/version1.6/images/clanlogo.png[/img]', '&ouml;', 'http://&ouml;&ouml;&ouml;', '&auml;', 'http://&auml;&auml;&auml;', '&uuml;&uuml;&uuml;', 'http://&uuml;&uuml;&uuml;&uuml;', '0', '1');
INSERT INTO dzcp_artikel VALUES ('4', '6', '1492631772', '1', 'Features', 'Server-Voraussetzungen\r\n[list]\r\n[*]PHP 5.4 oder h&ouml;her\r\n[*]MySQL-Datenbank (getestet auf 5.1.x bis 5.6)\r\n[*]GDlib Libary\r\n[*]MySQLi Erweiterung\r\n[*]Voller FTP-Zugriff\r\n[*]Unterst&uuml;tzung der folgenden PHP-Funktionen: fopen(), fsockopen(), mail(), imagettftext()\r\n[/list]\r\n Optimal * Nicht zwingend notwendig *\r\n[list]\r\n[*]APC (Alternative PHP Cache)\r\n[*]Mcrypt\r\n[/list]\r\n', '', '', '', '', '', '', '0', '2');
INSERT INTO dzcp_artikel VALUES ('5', '1', '1493634767', '1', 'Github', '[url]https://github.com/DZCP-Community/Core-DZCP-Beta/commit/37c85afec05166fc83c138c0c05e55202087adf8[/url]//\r\n&lt;p&gt;&lt;p&gt;&lt;p&gt;&lt;br&gt;\r\nIn jeder index.php bereits vorhanden!&lt;p&gt;\r\n$smarty = common::getSmarty();&lt;p&gt;\r\n&lt;p&gt;&lt;p&gt;&lt;br&gt;\r\n//TPL von Datei&lt;p&gt;\r\n$smarty-&gt;caching = false;&lt;p&gt;\r\n$smarty-&gt;assign(\'link1\',$links1);&lt;p&gt;\r\n$smarty-&gt;assign(\'link2\',$links2);&lt;p&gt;\r\n$smarty-&gt;assign(\'link3\',$links3);&lt;p&gt;\r\n$links = $smarty-&gt;fetch(\'file:[\'.common::$tmpdir.\']\'.$dir.\'/artikel_links.tpl\');&lt;p&gt;\r\n$smarty-&gt;clearAllAssign();&lt;p&gt;\r\n&lt;p&gt;&lt;p&gt;&lt;br&gt;\r\n//TPL von String&lt;p&gt;\r\n$smarty-&gt;caching = false;&lt;p&gt;\r\n$smarty-&gt;assign(\'hp\',\'http://12345.de\');&lt;p&gt;\r\n$hp = $smarty-&gt;fetch(\'string:\'._hpicon_forum);&lt;p&gt;\r\n$smarty-&gt;clearAllAssign();&lt;p&gt;\r\n&lt;p&gt;&lt;p&gt;&lt;br&gt;\r\n&lt;p&gt;&lt;p&gt;&lt;br&gt;\r\n//HTML und Platzhalter&lt;p&gt;\r\n[hp] =&gt; {$hp}&lt;p&gt;&lt;br&gt;\r\n&lt;p&gt;&lt;p&gt;&lt;br&gt;\r\n//Sprache und Texte&lt;p&gt;\r\n{lang msgID=&quot;artikel_comments_write_head&quot;} &lt;br&gt;//Holt den Text von &quot;_artikel_comments_write_head&quot; aus der sprachdatei.&lt;p&gt;', '', '', '', '', '', '', '1', '2');

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
) ENGINE=Aria AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_autologin
-- ----------------------------

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
-- Records of dzcp_captcha
-- ----------------------------

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
) ENGINE=Aria AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_clicks_ips
-- ----------------------------
INSERT INTO dzcp_clicks_ips VALUES ('1', '88.152.46.77', '5', '1', 'news', '1490726042');
INSERT INTO dzcp_clicks_ips VALUES ('2', '88.152.46.77', '1', '1', 'userprofil', '1489438591');
INSERT INTO dzcp_clicks_ips VALUES ('3', '91.66.242.200', '6', '6', 'userprofil', '1489444909');
INSERT INTO dzcp_clicks_ips VALUES ('4', '91.66.242.200', '6', '5', 'sponsoren', '1489444960');
INSERT INTO dzcp_clicks_ips VALUES ('5', '91.66.242.200', '6', '6', 'vote', '1489445109');
INSERT INTO dzcp_clicks_ips VALUES ('6', '91.66.242.200', '6', '1', 'artikel', '1489445166');
INSERT INTO dzcp_clicks_ips VALUES ('7', '91.66.242.200', '6', '2', 'download', '1489445184');
INSERT INTO dzcp_clicks_ips VALUES ('8', '88.152.46.77', '5', '5', 'userprofil', '1494321492');
INSERT INTO dzcp_clicks_ips VALUES ('9', '88.152.46.77', '1', '6', 'userprofil', '1489446202');
INSERT INTO dzcp_clicks_ips VALUES ('10', '84.119.21.40', '1', '1', 'vote', '1489495376');
INSERT INTO dzcp_clicks_ips VALUES ('11', '84.119.21.40', '1', '1', 'news', '1489495448');
INSERT INTO dzcp_clicks_ips VALUES ('12', '84.119.21.40', '1', '1', 'userprofil', '1489495628');
INSERT INTO dzcp_clicks_ips VALUES ('13', '84.119.21.40', '1', '6', 'vote', '1489495962');
INSERT INTO dzcp_clicks_ips VALUES ('14', '88.152.46.77', '1', '6', 'vote', '1489497497');
INSERT INTO dzcp_clicks_ips VALUES ('15', '213.239.211.57', '0', '1', 'vote', '1489604532');
INSERT INTO dzcp_clicks_ips VALUES ('17', '88.152.46.77', '1', '5', 'sponsoren', '1489787892');
INSERT INTO dzcp_clicks_ips VALUES ('18', '91.66.237.247', '6', '1', 'vote', '1490294378');
INSERT INTO dzcp_clicks_ips VALUES ('19', '88.152.46.77', '1', '9', 'userprofil', '1490536085');
INSERT INTO dzcp_clicks_ips VALUES ('20', '91.66.244.64', '6', '1', 'news', '1490727203');
INSERT INTO dzcp_clicks_ips VALUES ('21', '91.66.244.64', '6', '4', 'artikel', '1490737487');
INSERT INTO dzcp_clicks_ips VALUES ('22', '88.152.46.77', '1', '1', 'artikel', '1492620677');
INSERT INTO dzcp_clicks_ips VALUES ('23', '88.152.46.77', '1', '4', 'artikel', '1492804578');
INSERT INTO dzcp_clicks_ips VALUES ('24', '88.152.46.77', '1', '2', 'artikel', '1492804599');
INSERT INTO dzcp_clicks_ips VALUES ('25', '88.152.46.77', '1', '1', 'vote', '1492888020');
INSERT INTO dzcp_clicks_ips VALUES ('27', '88.152.46.77', '1', '3', 'artikel', '1493151088');
INSERT INTO dzcp_clicks_ips VALUES ('28', '88.152.46.77', '1', '5', 'artikel', '1493807583');
INSERT INTO dzcp_clicks_ips VALUES ('29', '91.4.242.152', '1', '5', 'artikel', '1494536767');
INSERT INTO dzcp_clicks_ips VALUES ('30', '88.152.46.77', '1', '2', 'userprofil', '1495571333');

-- ----------------------------
-- Table structure for `dzcp_counter`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_counter`;
CREATE TABLE `dzcp_counter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visitors` int(20) NOT NULL DEFAULT '0',
  `today` varchar(10) NOT NULL DEFAULT '0',
  `maxonline` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `today` (`today`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_counter
-- ----------------------------
INSERT INTO dzcp_counter VALUES ('1', '1', '11.3.2017', '4');
INSERT INTO dzcp_counter VALUES ('2', '3', '12.3.2017', '3');
INSERT INTO dzcp_counter VALUES ('3', '3', '13.3.2017', '3');
INSERT INTO dzcp_counter VALUES ('4', '2', '14.3.2017', '1');
INSERT INTO dzcp_counter VALUES ('5', '2', '15.3.2017', '1');
INSERT INTO dzcp_counter VALUES ('6', '1', '16.3.2017', '1');
INSERT INTO dzcp_counter VALUES ('7', '1', '18.3.2017', '1');
INSERT INTO dzcp_counter VALUES ('8', '1', '21.3.2017', '1');
INSERT INTO dzcp_counter VALUES ('9', '2', '22.3.2017', '2');
INSERT INTO dzcp_counter VALUES ('10', '1', '24.3.2017', '2');
INSERT INTO dzcp_counter VALUES ('11', '2', '26.3.2017', '4');
INSERT INTO dzcp_counter VALUES ('12', '2', '29.3.2017', '1');
INSERT INTO dzcp_counter VALUES ('13', '1', '30.3.2017', '1');
INSERT INTO dzcp_counter VALUES ('14', '1', '31.3.2017', '0');
INSERT INTO dzcp_counter VALUES ('15', '1', '1.4.2017', '1');
INSERT INTO dzcp_counter VALUES ('16', '2', '13.4.2017', '2');
INSERT INTO dzcp_counter VALUES ('17', '1', '17.4.2017', '1');
INSERT INTO dzcp_counter VALUES ('18', '1', '19.4.2017', '2');
INSERT INTO dzcp_counter VALUES ('19', '1', '20.4.2017', '1');
INSERT INTO dzcp_counter VALUES ('20', '1', '21.4.2017', '1');
INSERT INTO dzcp_counter VALUES ('21', '1', '23.4.2017', '1');
INSERT INTO dzcp_counter VALUES ('22', '1', '24.4.2017', '1');
INSERT INTO dzcp_counter VALUES ('23', '1', '26.4.2017', '1');
INSERT INTO dzcp_counter VALUES ('24', '1', '27.4.2017', '1');
INSERT INTO dzcp_counter VALUES ('25', '1', '28.4.2017', '1');
INSERT INTO dzcp_counter VALUES ('26', '1', '30.4.2017', '0');
INSERT INTO dzcp_counter VALUES ('27', '1', '1.5.2017', '1');
INSERT INTO dzcp_counter VALUES ('28', '1', '2.5.2017', '1');
INSERT INTO dzcp_counter VALUES ('29', '1', '3.5.2017', '1');
INSERT INTO dzcp_counter VALUES ('30', '1', '4.5.2017', '1');
INSERT INTO dzcp_counter VALUES ('31', '1', '5.5.2017', '2');
INSERT INTO dzcp_counter VALUES ('32', '1', '6.5.2017', '1');
INSERT INTO dzcp_counter VALUES ('33', '1', '7.5.2017', '3');
INSERT INTO dzcp_counter VALUES ('34', '2', '8.5.2017', '3');
INSERT INTO dzcp_counter VALUES ('35', '3', '9.5.2017', '1');
INSERT INTO dzcp_counter VALUES ('36', '2', '10.5.2017', '1');
INSERT INTO dzcp_counter VALUES ('37', '1', '12.5.2017', '1');
INSERT INTO dzcp_counter VALUES ('38', '1', '14.5.2017', '2');
INSERT INTO dzcp_counter VALUES ('39', '2', '15.5.2017', '2');
INSERT INTO dzcp_counter VALUES ('40', '1', '16.5.2017', '1');
INSERT INTO dzcp_counter VALUES ('41', '2', '17.5.2017', '1');
INSERT INTO dzcp_counter VALUES ('42', '1', '19.5.2017', '1');
INSERT INTO dzcp_counter VALUES ('43', '1', '21.5.2017', '3');
INSERT INTO dzcp_counter VALUES ('44', '1', '22.5.2017', '3');
INSERT INTO dzcp_counter VALUES ('45', '1', '23.5.2017', '1');
INSERT INTO dzcp_counter VALUES ('46', '1', '24.5.2017', '1');
INSERT INTO dzcp_counter VALUES ('47', '1', '25.5.2017', '1');
INSERT INTO dzcp_counter VALUES ('48', '1', '26.5.2017', '1');
INSERT INTO dzcp_counter VALUES ('49', '2', '27.5.2017', '2');
INSERT INTO dzcp_counter VALUES ('50', '2', '28.5.2017', '2');

-- ----------------------------
-- Table structure for `dzcp_counter_ips`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_counter_ips`;
CREATE TABLE `dzcp_counter_ips` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `datum` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=260 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_counter_ips
-- ----------------------------
INSERT INTO dzcp_counter_ips VALUES ('258', '91.4.240.17', '1495922568');
INSERT INTO dzcp_counter_ips VALUES ('259', '88.152.46.77', '1495966364');

-- ----------------------------
-- Table structure for `dzcp_counter_whoison`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_counter_whoison`;
CREATE TABLE `dzcp_counter_whoison` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `ssid` varchar(50) NOT NULL DEFAULT '',
  `online` int(20) NOT NULL DEFAULT '0',
  `whereami` text,
  `login` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip` (`ssid`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=200 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_counter_whoison
-- ----------------------------
INSERT INTO dzcp_counter_whoison VALUES ('199', '88.152.46.77', '2vdrbvs2mhukmddo00m7dsatlsr3s1kg', '1495981891', 'News', '1');

-- ----------------------------
-- Table structure for `dzcp_downloads`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_downloads`;
CREATE TABLE `dzcp_downloads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `download` varchar(249) NOT NULL DEFAULT '',
  `url` varchar(249) NOT NULL DEFAULT '',
  `beschreibung` text,
  `hits` int(20) NOT NULL DEFAULT '0',
  `kat` int(5) NOT NULL DEFAULT '0',
  `date` int(20) NOT NULL DEFAULT '0',
  `last_dl` int(20) NOT NULL DEFAULT '0',
  `intern` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_downloads
-- ----------------------------
INSERT INTO dzcp_downloads VALUES ('1', 'Testdownload', 'http://www.url.de/test.zip', '&lt;p&gt;Das ist ein Testdownload&lt;/p&gt;', '0', '1', '1422295536', '0', '0');
INSERT INTO dzcp_downloads VALUES ('2', 'fdgdfg', '../inc/tinymce_files/FileZilla_3.11.0.1_win64-setup.exe', 'khjkjhkhjk', '2', '2', '1432825906', '1489272384', '0');

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
-- Records of dzcp_download_kat
-- ----------------------------
INSERT INTO dzcp_download_kat VALUES ('1', 'Downloads');
INSERT INTO dzcp_download_kat VALUES ('2', 'Demos');
INSERT INTO dzcp_download_kat VALUES ('4', 'Test');

-- ----------------------------
-- Table structure for `dzcp_events`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_events`;
CREATE TABLE `dzcp_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` int(20) NOT NULL DEFAULT '0',
  `title` varchar(30) NOT NULL DEFAULT '',
  `event` text,
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_events
-- ----------------------------
INSERT INTO dzcp_events VALUES ('1', '1422385534', 'Testevent', '&lt;p&gt;Das ist nur ein Testevent! :)&lt;/p&gt;');
INSERT INTO dzcp_events VALUES ('2', '1434711600', 'ghg', 'gjgh');

-- ----------------------------
-- Table structure for `dzcp_forumkats`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_forumkats`;
CREATE TABLE `dzcp_forumkats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kid` int(10) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `intern` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_forumkats
-- ----------------------------
INSERT INTO dzcp_forumkats VALUES ('1', '4', 'Hauptforum', '0');
INSERT INTO dzcp_forumkats VALUES ('2', '5', 'OFFtopic', '0');
INSERT INTO dzcp_forumkats VALUES ('3', '6', 'Moderatoren-Forum', '1');
INSERT INTO dzcp_forumkats VALUES ('4', '3', 'xcvcvxcxv', '0');
INSERT INTO dzcp_forumkats VALUES ('5', '2', 'xcvxcvxcvxcv', '0');
INSERT INTO dzcp_forumkats VALUES ('6', '1', 'ertrterte', '0');
INSERT INTO dzcp_forumkats VALUES ('7', '7', 'Ablage', '1');

-- ----------------------------
-- Table structure for `dzcp_forumposts`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_forumposts`;
CREATE TABLE `dzcp_forumposts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kid` int(2) NOT NULL DEFAULT '0',
  `sid` int(2) NOT NULL DEFAULT '0',
  `date` int(20) NOT NULL DEFAULT '0',
  `nick` varchar(50) NOT NULL DEFAULT '',
  `reg` int(1) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '',
  `text` text,
  `edited` text,
  `ip` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `hp` varchar(249) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `sid` (`sid`) USING BTREE,
  KEY `date` (`date`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_forumposts
-- ----------------------------
INSERT INTO dzcp_forumposts VALUES ('1', '1', '1', '1450481157', '', '2', '', 'Hallloooo', null, '192.168.1.38', '');
INSERT INTO dzcp_forumposts VALUES ('5', '2', '2', '1495922597', '', '1', '', 'test', null, '91.4.240.17', '');
INSERT INTO dzcp_forumposts VALUES ('3', '1', '5', '1495469057', '', '1', '', 'sdffsdfsdsfd', null, '88.152.46.77', '');
INSERT INTO dzcp_forumposts VALUES ('4', '1', '5', '1495469105', '', '9', '', '453245435', null, '88.152.46.77', '');

-- ----------------------------
-- Table structure for `dzcp_forumsubkats`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_forumsubkats`;
CREATE TABLE `dzcp_forumsubkats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(10) NOT NULL DEFAULT '0',
  `kattopic` varchar(150) NOT NULL DEFAULT '',
  `subtopic` varchar(150) NOT NULL DEFAULT '',
  `pos` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sid` (`sid`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_forumsubkats
-- ----------------------------
INSERT INTO dzcp_forumsubkats VALUES ('1', '1', 'Allgemein', 'Allgemeines...', '2');
INSERT INTO dzcp_forumsubkats VALUES ('2', '1', 'Homepage', 'Kritiken/Anregungen/Bugs', '3');
INSERT INTO dzcp_forumsubkats VALUES ('3', '1', 'Server', 'Serverseitige Themen...', '4');
INSERT INTO dzcp_forumsubkats VALUES ('4', '1', 'Spam', 'Spamt die Bude voll ;)', '5');
INSERT INTO dzcp_forumsubkats VALUES ('5', '2', 'Sonstiges', '', '6');
INSERT INTO dzcp_forumsubkats VALUES ('6', '2', 'OFFtopic', '', '7');
INSERT INTO dzcp_forumsubkats VALUES ('7', '3', 'internes Forum', 'interne Angelegenheiten', '8');
INSERT INTO dzcp_forumsubkats VALUES ('8', '3', 'Server intern', 'interne Serverangelegenheiten', '9');
INSERT INTO dzcp_forumsubkats VALUES ('9', '3', 'War Forum', 'Alles &uuml;ber und rundum Clanwars', '10');
INSERT INTO dzcp_forumsubkats VALUES ('10', '7', 'Papierkorb ', 'Hier alles Thriets rein, die gel&ouml;scht werden sollen', '0');

-- ----------------------------
-- Table structure for `dzcp_forumthreads`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_forumthreads`;
CREATE TABLE `dzcp_forumthreads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kid` int(10) NOT NULL DEFAULT '0',
  `t_date` int(20) NOT NULL DEFAULT '0',
  `topic` varchar(249) NOT NULL DEFAULT '',
  `subtopic` varchar(100) NOT NULL DEFAULT '',
  `t_nick` varchar(100) NOT NULL DEFAULT '',
  `t_reg` int(11) NOT NULL DEFAULT '0',
  `t_email` varchar(100) NOT NULL DEFAULT '',
  `t_text` text,
  `hits` int(10) NOT NULL DEFAULT '0',
  `first` int(1) NOT NULL DEFAULT '0',
  `lp` int(11) NOT NULL DEFAULT '0',
  `sticky` int(1) NOT NULL DEFAULT '0',
  `closed` int(1) NOT NULL DEFAULT '0',
  `global` int(1) NOT NULL DEFAULT '0',
  `edited` text,
  `ip` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `t_hp` varchar(249) NOT NULL DEFAULT '',
  `vote` int(11) NOT NULL DEFAULT '0',
  `posts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `kid` (`kid`) USING BTREE,
  KEY `lp` (`lp`) USING BTREE,
  KEY `topic` (`topic`) USING BTREE,
  KEY `first` (`first`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_forumthreads
-- ----------------------------
INSERT INTO dzcp_forumthreads VALUES ('1', '1', '1428342277', 'Test1234', 'Test Test Test', '', '1', '', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.&lt;br /&gt;&lt;br /&gt;&lt;span class=&quot;fontBold&quot;&gt;Nachtrag von &lt;/span&gt;&lt;img src=&quot;../inc/images/flaggen/de.gif&quot; alt=&quot;&quot; class=&quot;icon&quot; /&gt; &lt;a href=&quot;../user/?action=user&amp;id=1&quot;&gt;masterbee&lt;/a&gt;:&lt;br /&gt;&lt;br /&gt;Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.&lt;br /&gt;&lt;br /&gt;&lt;object width=&quot;425&quot; height=&quot;344&quot; data=&quot;http://www.youtube.com/v/LtQUJMBH8uE&amp;hl=de_DE&amp;fs=1&amp;color1=0x3a3a3a&amp;color2=0x999999&amp;border=0&quot; type=&quot;application/x-shockwave-flash&quot;&gt;&lt;param name=&quot;allowFullScreen&quot; value=&quot;true&quot; /&gt;&lt;param name=&quot;allowscriptaccess&quot; value=&quot;always&quot; /&gt;&lt;param name=&quot;wmode&quot; value=&quot;opaque&quot; /&gt;&lt;param name=&quot;src&quot; value=&quot;http://www.youtube.com/v/LtQUJMBH8uE&amp;hl=de_DE&amp;fs=1&amp;color1=0x3a3a3a&amp;color2=0x999999&amp;border=0&quot; /&gt;&lt;param name=&quot;allowfullscreen&quot; value=&quot;true&quot; /&gt;&lt;/object&gt;&lt;br /&gt;&lt;br /&gt;&lt;img class=&quot;content&quot; src=&quot;../inc/images/smileys/king.gif&quot; alt=&quot;king.gif&quot; border=&quot;0&quot; /&gt;&lt;img class=&quot;content&quot; src=&quot;../inc/images/smileys/grin.gif&quot; alt=&quot;grin.gif&quot; border=&quot;0&quot; /&gt;&lt;img class=&quot;content&quot; src=&quot;../inc/images/smileys/bunny.gif&quot; alt=&quot;bunny.gif&quot; border=&quot;0&quot; /&gt;&lt;img class=&quot;content&quot; src=&quot;../inc/images/smileys/applause.gif&quot; alt=&quot;applause.gif&quot; border=&quot;0&quot; width=&quot;29&quot; height=&quot;15&quot; /&gt;&lt;img class=&quot;content&quot; src=&quot;../inc/images/smileys/bounce.gif&quot; alt=&quot;bounce.gif&quot; border=&quot;0&quot; /&gt;&lt;img class=&quot;content&quot; src=&quot;../inc/images/smileys/cool.gif&quot; alt=&quot;cool.gif&quot; border=&quot;0&quot; /&gt;&nbsp;&nbsp;&lt;img class=&quot;content&quot; src=&quot;../inc/images/smileys/zunge.gif&quot; alt=&quot;zunge.gif&quot; border=&quot;0&quot; /&gt;&lt;img class=&quot;content&quot; src=&quot;../inc/images/smileys/sleep.gif&quot; alt=&quot;sleep.gif&quot; border=&quot;0&quot; /&gt;&lt;br /&gt;&lt;br /&gt;&lt;br /&gt; &lt;blockquote&gt;Eine Test Blockquote&lt;/blockquote&gt;&lt;p&gt;&nbsp;&lt;/p&gt;&lt;p&gt;&nbsp;&lt;/p&gt;&lt;span class=&quot;fontBold&quot;&gt;Nachtrag von &lt;/span&gt;&lt;img src=&quot;../inc/images/flaggen/de.gif&quot; alt=&quot;&quot; class=&quot;icon&quot; /&gt; &lt;a class=&quot;&quot; href=&quot;../user/?action=user&amp;id=1&quot;&gt;masterbee&lt;/a&gt;:&lt;p&gt;&nbsp;&lt;/p&gt;sdfdsfdfssdfsdfdsfsdfsdfdf', '1008', '0', '1450481157', '0', '0', '1', '', '127.0.0.1', '', '6', '0');
INSERT INTO dzcp_forumthreads VALUES ('2', '2', '1450025962', 'rteterter', 'terter', '', '2', '', 'tertert', '399', '0', '1495922597', '0', '0', '0', null, '192.168.1.38', '', '0', '0');
INSERT INTO dzcp_forumthreads VALUES ('3', '1', '1495397620', 'test', '1234', '', '1', '', 'rwerewrw', '3', '1', '1495397620', '0', '0', '0', null, '88.152.46.77', '', '0', '0');
INSERT INTO dzcp_forumthreads VALUES ('4', '1', '1495397683', '123456', '222222', '1234', '2', 'ddd@gg.de', 'noch ein test', '3', '1', '1495397683', '0', '0', '0', null, '88.152.46.77', 'rfrrwerwerw', '0', '0');
INSERT INTO dzcp_forumthreads VALUES ('5', '1', '1495398971', 'sdfdfsfsdfsdfsdsfd', 'sdfdsfdfs', '', '2', '', 'sdfdssdfdfsfds', '68', '0', '1495469105', '0', '0', '0', null, '88.152.46.77', '', '0', '2');
INSERT INTO dzcp_forumthreads VALUES ('6', '1', '1495723609', 'gdfgdf', 'dfgfgdfdggdfgfd', '', '1', '', 'fgdgdffgfgdgdf', '7', '1', '0', '1', '1', '0', null, '88.152.46.77', '', '16', '0');

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
-- Records of dzcp_forum_abo
-- ----------------------------

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
) ENGINE=Aria AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_forum_access
-- ----------------------------
INSERT INTO dzcp_forum_access VALUES ('1', '0', '1', '7');
INSERT INTO dzcp_forum_access VALUES ('2', '0', '1', '9');
INSERT INTO dzcp_forum_access VALUES ('3', '2', '0', '8');
INSERT INTO dzcp_forum_access VALUES ('4', '2', '0', '9');
INSERT INTO dzcp_forum_access VALUES ('5', '0', '5', '7');
INSERT INTO dzcp_forum_access VALUES ('6', '0', '6', '7');
INSERT INTO dzcp_forum_access VALUES ('7', '0', '6', '8');
INSERT INTO dzcp_forum_access VALUES ('8', '16', '0', '7');
INSERT INTO dzcp_forum_access VALUES ('9', '16', '0', '9');
INSERT INTO dzcp_forum_access VALUES ('10', '17', '0', '7');
INSERT INTO dzcp_forum_access VALUES ('11', '17', '0', '9');
INSERT INTO dzcp_forum_access VALUES ('12', '6', '0', '7');
INSERT INTO dzcp_forum_access VALUES ('13', '6', '0', '8');
INSERT INTO dzcp_forum_access VALUES ('14', '6', '0', '9');
INSERT INTO dzcp_forum_access VALUES ('15', '6', '0', '10');

-- ----------------------------
-- Table structure for `dzcp_groups`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_groups`;
CREATE TABLE `dzcp_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `beschreibung` text,
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_groups
-- ----------------------------
INSERT INTO dzcp_groups VALUES ('1', 'DZCP-Stuff', 'gdfgdfg');

-- ----------------------------
-- Table structure for `dzcp_groupuser`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_groupuser`;
CREATE TABLE `dzcp_groupuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(5) NOT NULL DEFAULT '0',
  `group` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_groupuser
-- ----------------------------
INSERT INTO dzcp_groupuser VALUES ('6', '5', '1');
INSERT INTO dzcp_groupuser VALUES ('7', '1', '1');
INSERT INTO dzcp_groupuser VALUES ('13', '6', '1');

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
) ENGINE=Aria AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_ipban
-- ----------------------------
INSERT INTO dzcp_ipban VALUES ('1', '88.152.46.77', '1495877563', 'a:5:{s:9:\"frequency\";i:0;s:7:\"appears\";i:0;s:7:\"country\";s:2:\"de\";s:3:\"asn\";i:6830;s:10:\"banned_msg\";s:0:\"\";}', '0', '1');
INSERT INTO dzcp_ipban VALUES ('2', '91.66.242.200', '1489271733', 'a:5:{s:9:\"frequency\";i:0;s:7:\"appears\";i:0;s:7:\"country\";s:2:\"de\";s:3:\"asn\";i:31334;s:10:\"banned_msg\";s:0:\"\";}', '0', '1');
INSERT INTO dzcp_ipban VALUES ('3', '84.119.21.40', '1489579283', 'a:5:{s:9:\"frequency\";i:0;s:7:\"appears\";i:0;s:7:\"country\";s:2:\"at\";s:3:\"asn\";i:6830;s:10:\"banned_msg\";s:0:\"\";}', '0', '1');
INSERT INTO dzcp_ipban VALUES ('4', '213.239.211.57', '1489431719', 'a:5:{s:9:\"frequency\";i:0;s:7:\"appears\";i:0;s:7:\"country\";s:2:\"de\";s:3:\"asn\";i:24940;s:10:\"banned_msg\";s:0:\"\";}', '0', '1');
INSERT INTO dzcp_ipban VALUES ('5', '91.66.237.247', '1490121485', 'a:5:{s:9:\"frequency\";i:0;s:7:\"appears\";i:0;s:7:\"country\";s:2:\"de\";s:3:\"asn\";i:31334;s:10:\"banned_msg\";s:0:\"\";}', '0', '1');
INSERT INTO dzcp_ipban VALUES ('6', '91.66.224.60', '1490217002', 'a:5:{s:9:\"frequency\";i:0;s:7:\"appears\";i:0;s:7:\"country\";s:2:\"de\";s:3:\"asn\";i:31334;s:10:\"banned_msg\";s:0:\"\";}', '0', '1');
INSERT INTO dzcp_ipban VALUES ('7', '91.66.244.64', '1490544202', 'a:5:{s:9:\"frequency\";i:0;s:7:\"appears\";i:0;s:7:\"country\";s:2:\"de\";s:3:\"asn\";i:31334;s:10:\"banned_msg\";s:0:\"\";}', '0', '1');
INSERT INTO dzcp_ipban VALUES ('8', '84.135.45.96', '1492770942', 'a:5:{s:9:\"frequency\";i:0;s:7:\"appears\";i:0;s:7:\"country\";s:2:\"de\";s:3:\"asn\";i:3320;s:10:\"banned_msg\";s:0:\"\";}', '0', '1');
INSERT INTO dzcp_ipban VALUES ('9', '91.66.240.25', '1492103516', 'a:5:{s:9:\"frequency\";i:0;s:7:\"appears\";i:0;s:7:\"country\";s:2:\"de\";s:3:\"asn\";i:31334;s:10:\"banned_msg\";s:0:\"\";}', '0', '1');
INSERT INTO dzcp_ipban VALUES ('10', '91.4.243.201', '1494272248', 'a:5:{s:9:\"frequency\";i:0;s:7:\"appears\";i:0;s:7:\"country\";s:2:\"de\";s:3:\"asn\";i:3320;s:10:\"banned_msg\";s:0:\"\";}', '0', '1');
INSERT INTO dzcp_ipban VALUES ('11', '91.4.242.152', '1494361633', 'a:5:{s:9:\"frequency\";i:0;s:7:\"appears\";i:0;s:7:\"country\";s:2:\"de\";s:3:\"asn\";i:3320;s:10:\"banned_msg\";s:0:\"\";}', '0', '1');
INSERT INTO dzcp_ipban VALUES ('12', '91.4.242.152', '1494361633', 'a:5:{s:9:\"frequency\";i:0;s:7:\"appears\";i:0;s:7:\"country\";s:2:\"de\";s:3:\"asn\";i:3320;s:10:\"banned_msg\";s:0:\"\";}', '0', '1');
INSERT INTO dzcp_ipban VALUES ('13', '91.4.242.152', '1494361633', 'a:5:{s:9:\"frequency\";i:0;s:7:\"appears\";i:0;s:7:\"country\";s:2:\"de\";s:3:\"asn\";i:3320;s:10:\"banned_msg\";s:0:\"\";}', '0', '1');
INSERT INTO dzcp_ipban VALUES ('14', '91.4.249.88', '1494796468', 'a:5:{s:9:\"frequency\";i:0;s:7:\"appears\";i:0;s:7:\"country\";s:2:\"de\";s:3:\"asn\";i:3320;s:10:\"banned_msg\";s:0:\"\";}', '0', '1');
INSERT INTO dzcp_ipban VALUES ('15', '91.4.249.88', '1494796468', 'a:5:{s:9:\"frequency\";i:0;s:7:\"appears\";i:0;s:7:\"country\";s:2:\"de\";s:3:\"asn\";i:3320;s:10:\"banned_msg\";s:0:\"\";}', '0', '1');
INSERT INTO dzcp_ipban VALUES ('16', '91.4.249.88', '1494796468', 'a:5:{s:9:\"frequency\";i:0;s:7:\"appears\";i:0;s:7:\"country\";s:2:\"de\";s:3:\"asn\";i:3320;s:10:\"banned_msg\";s:0:\"\";}', '0', '1');
INSERT INTO dzcp_ipban VALUES ('17', '91.4.252.181', '1494891938', 'a:5:{s:9:\"frequency\";i:0;s:7:\"appears\";i:0;s:7:\"country\";s:2:\"de\";s:3:\"asn\";i:3320;s:10:\"banned_msg\";s:0:\"\";}', '0', '1');
INSERT INTO dzcp_ipban VALUES ('18', '91.4.250.29', '1494977891', 'a:5:{s:9:\"frequency\";i:0;s:7:\"appears\";i:0;s:7:\"country\";s:2:\"de\";s:3:\"asn\";i:3320;s:10:\"banned_msg\";s:0:\"\";}', '0', '1');
INSERT INTO dzcp_ipban VALUES ('19', '91.4.250.12', '1495152109', 'a:5:{s:9:\"frequency\";i:0;s:7:\"appears\";i:0;s:7:\"country\";s:2:\"de\";s:3:\"asn\";i:3320;s:10:\"banned_msg\";s:0:\"\";}', '0', '1');
INSERT INTO dzcp_ipban VALUES ('20', '91.4.244.184', '1495495797', 'a:5:{s:9:\"frequency\";i:0;s:7:\"appears\";i:0;s:7:\"country\";s:2:\"de\";s:3:\"asn\";i:3320;s:10:\"banned_msg\";s:0:\"\";}', '0', '1');
INSERT INTO dzcp_ipban VALUES ('21', '91.4.244.184', '1495495797', 'a:5:{s:9:\"frequency\";i:0;s:7:\"appears\";i:0;s:7:\"country\";s:2:\"de\";s:3:\"asn\";i:3320;s:10:\"banned_msg\";s:0:\"\";}', '0', '1');
INSERT INTO dzcp_ipban VALUES ('22', '91.4.244.184', '1495495797', 'a:5:{s:9:\"frequency\";i:0;s:7:\"appears\";i:0;s:7:\"country\";s:2:\"de\";s:3:\"asn\";i:3320;s:10:\"banned_msg\";s:0:\"\";}', '0', '1');
INSERT INTO dzcp_ipban VALUES ('23', '91.4.254.39', '1495585431', 'a:5:{s:9:\"frequency\";i:0;s:7:\"appears\";i:0;s:7:\"country\";s:2:\"de\";s:3:\"asn\";i:3320;s:10:\"banned_msg\";s:0:\"\";}', '0', '1');
INSERT INTO dzcp_ipban VALUES ('24', '91.4.240.17', '1495922143', 'a:5:{s:9:\"frequency\";i:0;s:7:\"appears\";i:0;s:7:\"country\";s:2:\"de\";s:3:\"asn\";i:3320;s:10:\"banned_msg\";s:0:\"\";}', '0', '1');

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
) ENGINE=Aria AUTO_INCREMENT=109 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_iptodns
-- ----------------------------
INSERT INTO dzcp_iptodns VALUES ('108', '2vdrbvs2mhukmddo00m7dsatlsr3s1kg', '1495980641', '1495980101', '88.152.46.77', '88.152.46.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '0', '');

-- ----------------------------
-- Table structure for `dzcp_ip_action`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_ip_action`;
CREATE TABLE `dzcp_ip_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `what` varchar(40) NOT NULL DEFAULT '',
  `time` int(20) NOT NULL DEFAULT '0',
  `created` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`) USING BTREE,
  KEY `what` (`what`) USING BTREE,
  KEY `user_id` (`user_id`)
) ENGINE=Aria AUTO_INCREMENT=407 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_ip_action
-- ----------------------------
INSERT INTO dzcp_ip_action VALUES ('192', '91.66.242.200', '6', 'vid_6', '0', '1489272309');
INSERT INTO dzcp_ip_action VALUES ('197', '84.119.21.40', '0', 'vid_1', '0', '1489322576');
INSERT INTO dzcp_ip_action VALUES ('205', '84.119.21.40', '1', 'vid_6', '0', '1489323162');
INSERT INTO dzcp_ip_action VALUES ('208', '88.152.46.77', '0', 'vid_6', '0', '1489324697');
INSERT INTO dzcp_ip_action VALUES ('217', '213.239.211.57', '0', 'vid_1', '0', '1489431732');
INSERT INTO dzcp_ip_action VALUES ('234', '91.66.237.247', '6', 'vid_1', '0', '1490121578');
INSERT INTO dzcp_ip_action VALUES ('285', '88.152.46.77', '0', 'vid_1', '0', '1492715220');
INSERT INTO dzcp_ip_action VALUES ('399', '88.152.46.77', '1', 'logout(1)', '1495878412', '1495878412');
INSERT INTO dzcp_ip_action VALUES ('400', '88.152.46.77', '1', 'login(1)', '1495879418', '1495879418');
INSERT INTO dzcp_ip_action VALUES ('401', '88.152.46.77', '1', 'login(1)', '1495883868', '1495883868');
INSERT INTO dzcp_ip_action VALUES ('402', '91.4.240.17', '1', 'login(1)', '1495922184', '1495922184');
INSERT INTO dzcp_ip_action VALUES ('404', '91.4.240.17', '1', 'fid(2)', '1495922597', '1495922597');
INSERT INTO dzcp_ip_action VALUES ('405', '91.4.240.17', '1', 'logout(1)', '1495922628', '1495922628');
INSERT INTO dzcp_ip_action VALUES ('406', '88.152.46.77', '1', 'login(1)', '1495967421', '1495967421');

-- ----------------------------
-- Table structure for `dzcp_links`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_links`;
CREATE TABLE `dzcp_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(249) NOT NULL DEFAULT '',
  `text` varchar(249) NOT NULL DEFAULT '',
  `banner` int(1) NOT NULL DEFAULT '0',
  `beschreibung` text,
  `hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_links
-- ----------------------------
INSERT INTO dzcp_links VALUES ('1', 'http://www.dzcp.de', 'http://www.dzcp.de/banner/dzcp.gif', '1', 'deV!L`z Clanportal', '1');

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
  `titel` varchar(150) NOT NULL DEFAULT '',
  `nachricht` text,
  `see` int(1) NOT NULL DEFAULT '0',
  `readed` int(1) NOT NULL DEFAULT '0',
  `sendmail` int(1) NOT NULL DEFAULT '0',
  `senduser` int(5) NOT NULL DEFAULT '0',
  `sendnewsuser` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `an` (`an`) USING BTREE,
  KEY `page` (`page`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_messages
-- ----------------------------
INSERT INTO dzcp_messages VALUES ('1', '1432469641', '0', '3', '0', '0', 'Buddies', 'Der User &lt;span class=&quot;fontBold&quot;&gt;&lt;img src=&quot;../inc/images/flaggen/de.gif&quot; alt=&quot;&quot; class=&quot;icon&quot; /&gt; &lt;a class=&quot;&quot; href=&quot;../user/?action=user&amp;amp;id=1&quot;&gt;masterbee&lt;/a&gt;&lt;/span&gt; hat dich soeben als Buddy geadded!', '0', '0', '0', '0', '0');
INSERT INTO dzcp_messages VALUES ('2', '1432470162', '0', '3', '0', '0', 'Buddies', 'Der User &lt;span class=&quot;fontBold&quot;&gt;&lt;img src=&quot;../inc/images/flaggen/de.gif&quot; alt=&quot;&quot; class=&quot;icon&quot; /&gt; &lt;a class=&quot;&quot; href=&quot;../user/?action=user&amp;amp;id=1&quot;&gt;masterbee&lt;/a&gt;&lt;/span&gt; hat dich soeben als Buddy gel&amp;ouml;scht!', '0', '0', '0', '0', '0');
INSERT INTO dzcp_messages VALUES ('3', '1432470802', '0', '2', '0', '1', 'Buddies', 'Der User &lt;span class=&quot;fontBold&quot;&gt;&lt;img src=&quot;../inc/images/flaggen/de.gif&quot; alt=&quot;&quot; class=&quot;icon&quot; /&gt; &lt;a class=&quot;&quot; href=&quot;../user/?action=user&amp;amp;id=1&quot;&gt;masterbee&lt;/a&gt;&lt;/span&gt; hat dich soeben als Buddy gel&amp;ouml;scht!', '0', '0', '0', '0', '0');
INSERT INTO dzcp_messages VALUES ('4', '1432470887', '0', '2', '0', '1', 'Buddies', 'Der User &lt;span class=&quot;fontBold&quot;&gt;&lt;img src=&quot;../inc/images/flaggen/de.gif&quot; alt=&quot;&quot; class=&quot;icon&quot; /&gt; &lt;a class=&quot;&quot; href=&quot;../user/?action=user&amp;amp;id=1&quot;&gt;masterbee&lt;/a&gt;&lt;/span&gt; hat dich soeben als Buddy geadded!', '0', '1', '0', '0', '0');
INSERT INTO dzcp_messages VALUES ('5', '1494148717', '5', '1', '0', '1', 'Test123', 'HALO Test &ouml;&uuml;&auml;&szlig;', '0', '1', '0', '0', '0');
INSERT INTO dzcp_messages VALUES ('6', '1494150872', '1', '5', '0', '0', 'sdfsdffsd', 'fsdsfdsfdfsd', '1', '0', '1', '0', '0');

-- ----------------------------
-- Table structure for `dzcp_navi`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_navi`;
CREATE TABLE `dzcp_navi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pos` int(20) NOT NULL DEFAULT '0',
  `kat` varchar(20) NOT NULL DEFAULT '',
  `shown` int(1) NOT NULL DEFAULT '0',
  `name` varchar(249) NOT NULL DEFAULT '',
  `url` varchar(249) NOT NULL DEFAULT '',
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
) ENGINE=Aria AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_navi
-- ----------------------------
INSERT INTO dzcp_navi VALUES ('1', '1', 'nav_main', '1', '_news_', '../news/', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES ('2', '2', 'nav_main', '1', '_newsarchiv_', '../news/?action=archiv', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES ('3', '3', 'nav_main', '1', '_artikel_', '../artikel/', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES ('4', '4', 'nav_main', '1', '_forum_', '../forum/', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES ('7', '7', 'nav_main', '1', '_kalender_', '../kalender/', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES ('8', '14', 'nav_main', '1', '_votes_', '../votes/', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES ('9', '15', 'nav_main', '1', '_links_', '../links/', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES ('10', '17', 'nav_main', '1', '_sponsoren_', '../sponsors/', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES ('11', '24', 'nav_main', '1', '_downloads_', '../downloads/', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES ('12', '25', 'nav_main', '1', '_userlist_', '../user/?action=userlist', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES ('27', '1', 'nav_admin', '1', '_admin_', '../admin/', '0', '1', '1', '1', '0');
INSERT INTO dzcp_navi VALUES ('28', '1', 'nav_user', '1', '_lobby_', '../user/?action=userlobby', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES ('29', '2', 'nav_user', '1', '_nachrichten_', '../user/?action=msg', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES ('30', '3', 'nav_user', '1', '_buddys_', '../user/?action=buddys', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES ('31', '4', 'nav_user', '1', '_edit_profile_', '../user/?action=editprofile', '0', '1', '0', '0', '0');
INSERT INTO dzcp_navi VALUES ('32', '6', 'nav_user', '1', '_logout_', '../user/?action=logout', '0', '1', '0', '1', '0');
INSERT INTO dzcp_navi VALUES ('44', '30', 'nav_main', '1', '_impressum_', '../impressum/', '0', '2', '0', '0', '0');
INSERT INTO dzcp_navi VALUES ('45', '5', 'nav_main', '1', 'GitHub Projekt', 'https://github.com/DZCP-Community', '1', '2', '0', '0', '0');

-- ----------------------------
-- Table structure for `dzcp_navi_kats`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_navi_kats`;
CREATE TABLE `dzcp_navi_kats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `placeholder` varchar(200) NOT NULL DEFAULT '',
  `level` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `placeholder` (`placeholder`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_navi_kats
-- ----------------------------
INSERT INTO dzcp_navi_kats VALUES ('2', 'Main Navigation', 'nav_main', '0');
INSERT INTO dzcp_navi_kats VALUES ('6', 'Admin Navigation', 'nav_admin', '4');
INSERT INTO dzcp_navi_kats VALUES ('7', 'User Navigation', 'nav_user', '1');

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
  `titel` varchar(249) NOT NULL DEFAULT '',
  `intern` int(1) NOT NULL DEFAULT '0',
  `text` text,
  `more` text,
  `link1` varchar(100) NOT NULL DEFAULT '',
  `url1` varchar(200) NOT NULL DEFAULT '',
  `link2` varchar(100) NOT NULL DEFAULT '',
  `url2` varchar(200) NOT NULL DEFAULT '',
  `link3` varchar(100) NOT NULL DEFAULT '',
  `url3` varchar(200) NOT NULL DEFAULT '',
  `viewed` int(10) NOT NULL DEFAULT '0',
  `public` int(1) NOT NULL DEFAULT '0',
  `timeshift` int(14) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_news
-- ----------------------------
INSERT INTO dzcp_news VALUES ('1', '1', '1422295535', '1', '0', 'deV!L`z Clanportal', '0', 'Bitte http://beta.dzcp.de/user/?action=login zum login verwenden, Nav Login hat einen bug.', 'Mehr TEXT', 'Link1', 'http://www.test1.de', 'Link2', 'http://www.test2.de', 'Link3', 'http://www.test3.de', '8', '1', '0');
INSERT INTO dzcp_news VALUES ('2', '1', '0', '0', '0', 'Test', '0', 'test', '', '', '', '', '', '', '', '0', '0', '0');

-- ----------------------------
-- Table structure for `dzcp_newscomments`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_newscomments`;
CREATE TABLE `dzcp_newscomments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news` int(10) NOT NULL DEFAULT '0',
  `nick` varchar(50) NOT NULL DEFAULT '',
  `datum` int(20) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '',
  `hp` varchar(50) NOT NULL DEFAULT '',
  `reg` int(5) NOT NULL DEFAULT '0',
  `comment` text,
  `ip` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `editby` text,
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_newscomments
-- ----------------------------
INSERT INTO dzcp_newscomments VALUES ('7', '1', 'Administrator', '1493067489', 'support@hammermaps.de', 'http://www.dzcp.de', '1', 'cxvxcvxcv', '88.152.46.77', null);
INSERT INTO dzcp_newscomments VALUES ('8', '1', 'Administrator', '1493068694', 'support@hammermaps.de', 'http://www.dzcp.de', '1', 'cxvxcvxcv', '88.152.46.77', null);
INSERT INTO dzcp_newscomments VALUES ('9', '1', '', '1493068850', '', '', '1', 'cxvxcvxcv', '88.152.46.77', '&lt;br /&gt;&lt;br /&gt;&lt;i&gt;zuletzt editiert von &lt;img src=&quot;../inc/images/flaggen/de.gif&quot; alt=&quot;&quot; class=&quot;icon&quot; /&gt; &lt;a class=&quot;&quot; href=&quot;../user/?action=user&amp;amp;id=1&quot;&gt;Administrator&lt;/a&gt; am 26.04.2017 18:10 &amp;nbsp;Uhr&lt;/i&gt;');

-- ----------------------------
-- Table structure for `dzcp_newskat`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_newskat`;
CREATE TABLE `dzcp_newskat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `katimg` varchar(200) NOT NULL DEFAULT '',
  `kategorie` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_newskat
-- ----------------------------
INSERT INTO dzcp_newskat VALUES ('1', 'hp.jpg', 'Homepage');
INSERT INTO dzcp_newskat VALUES ('2', 'hp.jpg', 'ertrte');
INSERT INTO dzcp_newskat VALUES ('3', 'hp.jpg', 'gdfgdfdfg');
INSERT INTO dzcp_newskat VALUES ('4', 'hp.jpg', 'dfgfgdgfddfggdf');

-- ----------------------------
-- Table structure for `dzcp_partners`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_partners`;
CREATE TABLE `dzcp_partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(150) NOT NULL DEFAULT '',
  `banner` varchar(100) NOT NULL DEFAULT '',
  `textlink` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

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
  `profile` int(1) NOT NULL DEFAULT '0',
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
  `editby` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user` (`user`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_permissions
-- ----------------------------
INSERT INTO dzcp_permissions VALUES ('1', '2', '0', '0', '0', '0', '1', '1', '0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO dzcp_permissions VALUES ('2', '16', '0', '0', '0', '0', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO dzcp_permissions VALUES ('3', '3', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO dzcp_permissions VALUES ('4', '4', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO dzcp_permissions VALUES ('5', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO dzcp_permissions VALUES ('6', '0', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO dzcp_permissions VALUES ('7', '0', '3', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO dzcp_permissions VALUES ('8', '5', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '1', '0', '0', '0');
INSERT INTO dzcp_permissions VALUES ('9', '6', '0', '1', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0');
INSERT INTO dzcp_permissions VALUES ('11', '8', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO dzcp_permissions VALUES ('12', '9', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO dzcp_permissions VALUES ('14', '11', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for `dzcp_positions`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_positions`;
CREATE TABLE `dzcp_positions` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `pid` int(2) NOT NULL DEFAULT '0',
  `position` varchar(50) NOT NULL DEFAULT '',
  `nletter` int(1) NOT NULL DEFAULT '0',
  `color` varchar(7) NOT NULL DEFAULT '#000000',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_positions
-- ----------------------------
INSERT INTO dzcp_positions VALUES ('1', '28', 'Coder', '0', '#ff0000');
INSERT INTO dzcp_positions VALUES ('2', '24', 'Translator', '0', '#953734');
INSERT INTO dzcp_positions VALUES ('3', '1', 'VIP', '0', '#548dd4');
INSERT INTO dzcp_positions VALUES ('4', '27', 'Moderator', '0', '#ffc000');
INSERT INTO dzcp_positions VALUES ('5', '0', 'Lizenzinhaber', '0', '#000000');

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
) ENGINE=Aria AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_sessions
-- ----------------------------
INSERT INTO dzcp_sessions VALUES ('7', 's6ggmvt3rcno6cahv0661fi267', '1441144552', 0x566B392B486B6F446348514D57694E465178527548304A4B6533514D576864735A79594A64324935446A7855516E59664655342F4867524B6143464543695A64465534754867464C4E773D3D);
INSERT INTO dzcp_sessions VALUES ('8', '6bj7lgk54gjb0k4oqvveo7i9e7', '1441561860', 0x566B392B486B6F446348514D57694E465178527548304A4B6533514D576864735A79594A64324935446A7855516E59664655342F4867524B6143464543695A64465534754867464C4E773D3D);
INSERT INTO dzcp_sessions VALUES ('9', 'dtoeplcidvkqihdadhjds4b7a4', '1441562301', 0x566B392B486B6F446348514D57694E465178527548304A4B6533514D576864735A79594A64324935446A7855516E59664655342F4867524B6143464543695A64465534754867464C4E773D3D);

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
) ENGINE=Aria AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

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
INSERT INTO dzcp_settings VALUES ('30', 'l_forumsubtopic', '20', '20', '5', 'int');
INSERT INTO dzcp_settings VALUES ('31', 'l_forumtopic', '20', '20', '5', 'int');
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
INSERT INTO dzcp_settings VALUES ('51', 'm_fthreads', '20', '20', '5', 'int');
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
INSERT INTO dzcp_settings VALUES ('66', 'reg_newscomments', '1', '1', '1', 'int');
INSERT INTO dzcp_settings VALUES ('67', 'sendmail_path', '/usr/sbin/sendmail', '/usr/sbin/sendmail', '150', 'string');
INSERT INTO dzcp_settings VALUES ('68', 'smtp_hostname', '192.168.1.1', 'localhost', '100', 'string');
INSERT INTO dzcp_settings VALUES ('69', 'smtp_password', 'SVxZCDVEaRUSYABJEgoQdURpGBJgXRBRX1MrfyUQCnkXElNREC9FIUBRYF9KXFsJMw==', '', '0', 'string');
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
INSERT INTO dzcp_settings VALUES ('15', 'eml_reg', '&lt;p&gt;Du hast dich erfolgreich auf unserer Seite registriert!&lt;/p&gt; &lt;table style=&quot;width: 400px;&quot; cellpadding=&quot;2&quot; cellspacing=&quot;2&quot; border=&quot;0&quot;&gt; &lt;tbody&gt; &lt;tr&gt; &lt;td colspan=&quot;2&quot; height=&quot;30&quot;&gt;Deine Logindaten lauten:&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td width=&quot;120&quot;&gt;Login-Name:&lt;/td&gt; &lt;td&gt;{$user}&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;Passwort:&lt;/td&gt; &lt;td&gt;{$pwd}&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;/tbody&gt; &lt;/table&gt; &lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '&lt;p&gt;Du hast dich erfolgreich auf unserer Seite registriert!&lt;/p&gt;\r\n&lt;table style=&quot;width: 400px;&quot; cellpadding=&quot;2&quot; cellspacing=&quot;2&quot; border=&quot;0&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td colspan=&quot;2&quot; height=&quot;30&quot;&gt;Deine Logindaten lauten:&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td width=&quot;120&quot;&gt;Login-Name:&lt;/td&gt;\r\n&lt;td&gt;[user]&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;Passwort:&lt;/td&gt;\r\n&lt;td&gt;[pwd]&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;p&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '0', 'string');
INSERT INTO dzcp_settings VALUES ('80', 'eml_akl_register', '&lt;p&gt;Hallo {$nick},&lt;br /&gt;&lt;br /&gt; Dein Account muss noch aktiviert werden, danach kannst du dich anmelden.&lt;/p&gt; &lt;table border=&quot;0&quot; cellspacing=&quot;2&quot; cellpadding=&quot;2&quot; style=&quot;width: 600px;&quot;&gt; &lt;tbody&gt; &lt;tr&gt; &lt;td height=&quot;30&quot; colspan=&quot;2&quot;&gt;Deine Aktivierung:&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td width=&quot;120&quot;&gt;Aktivierungslink:&lt;/td&gt; &lt;td&gt;{$link}&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;Aktivierungscode:&lt;/td&gt; &lt;td&gt;{$guid}&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td colspan=&quot;2&quot;&gt;&lt;hr /&gt;&lt;/td&gt; &lt;/tr&gt; &lt;/tbody&gt; &lt;/table&gt; &lt;br /&gt; &lt;p&gt;Falls der Link nicht funktioniert, kannst du den Aktivierungscode auch auf &quot;{$link_page}&quot; eingeben.&lt;br /&gt;&lt;br /&gt;[ Diese Email wurde automatisch generiert, bitte nicht antworten ]&lt;/p&gt;', '<p>Hallo [nick],<br /> Dein Account muss noch aktiviert werden, danach kannst du dich anmelden.</p>\\r\\n<table border=\"0\" cellspacing=\"2\" cellpadding=\"2\" style=\"width: 600px;\">\\r\\n<tbody>\\r\\n<tr>\\r\\n<td height=\"30\" colspan=\"2\">Deine Aktivierung:</td>\\r\\n</tr>\\r\\n<tr>\\r\\n<td colspan=\"2\"><hr /></td>\\r\\n</tr>\\r\\n<tr>\\r\\n<td width=\"120\">Aktivierungslink:</td>\\r\\n<td>[link]</td>\\r\\n</tr>\\r\\n<tr>\\r\\n<td>Aktivierungscode:</td>\\r\\n<td>[guid]</td>\\r\\n</tr>\\r\\n<tr>\\r\\n<td colspan=\"2\"><hr /></td>\\r\\n</tr>\\r\\n</tbody>\\r\\n</table>\\r\\n<p>Falls der Link nicht funktioniert, kannst du den Aktivierungscode auch auf \"[link_page]\" eingeben.</p>\\r\\n<p>[ Diese Email wurde automatisch generiert, bitte nicht antworten ]</p>', '0', 'string');

-- ----------------------------
-- Table structure for `dzcp_sites`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_sites`;
CREATE TABLE `dzcp_sites` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `titel` text,
  `text` text,
  `html` int(1) NOT NULL,
  `php` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=Aria DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_sites
-- ----------------------------

-- ----------------------------
-- Table structure for `dzcp_sponsoren`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_sponsoren`;
CREATE TABLE `dzcp_sponsoren` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(249) NOT NULL DEFAULT '',
  `link` varchar(249) NOT NULL DEFAULT '',
  `beschreibung` text,
  `site` int(1) NOT NULL DEFAULT '0',
  `slink` varchar(249) NOT NULL DEFAULT '',
  `banner` int(1) NOT NULL DEFAULT '0',
  `bend` varchar(5) NOT NULL DEFAULT '',
  `blink` varchar(249) NOT NULL DEFAULT '',
  `box` int(1) NOT NULL DEFAULT '0',
  `xend` varchar(5) NOT NULL DEFAULT '',
  `xlink` varchar(255) NOT NULL DEFAULT '',
  `pos` int(5) NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `banner` (`banner`) USING BTREE,
  KEY `pos` (`pos`) USING BTREE,
  KEY `site` (`site`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_sponsoren
-- ----------------------------
INSERT INTO dzcp_sponsoren VALUES ('5', 'eSport-Designs', 'http://esport-designs.de', '&lt;p&gt;Jedes Team das keine gut strukturierte und &uuml;bersichtlich gestaltete Webseite besitzt, die sich von der breiten Masse abhebt, gelingt es schwer oder teilweise gar nicht sich im Web zu pr&auml;sentieren. eSport-Designs bietet vorgefertigte DZCP Templates, Logo Designs oder Onlineshop L&ouml;sungen komplett nach Kundenwunsch an.&lt;/p&gt;', '1', '../banner/sponsors/ed468x60.png', '1', '', '../banner/sponsors/ed468x60.png', '1', '', '../banner/sponsors/ed88x31.gif', '8', '4');

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
) ENGINE=Aria AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_startpage
-- ----------------------------
INSERT INTO dzcp_startpage VALUES ('1', 'Artikel', 'artikel/', '1');
INSERT INTO dzcp_startpage VALUES ('2', 'News', 'news/', '1');
INSERT INTO dzcp_startpage VALUES ('3', 'Forum', 'forum/', '1');

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
) ENGINE=Aria DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_userbuddys
-- ----------------------------

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
) ENGINE=Aria AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_userposis
-- ----------------------------
INSERT INTO dzcp_userposis VALUES ('5', '5', '3', '1');
INSERT INTO dzcp_userposis VALUES ('6', '1', '1', '1');
INSERT INTO dzcp_userposis VALUES ('12', '6', '4', '1');

-- ----------------------------
-- Table structure for `dzcp_users`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_users`;
CREATE TABLE `dzcp_users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `user` varchar(200) NOT NULL DEFAULT '',
  `nick` varchar(200) NOT NULL DEFAULT '',
  `pwd` varchar(255) NOT NULL DEFAULT '',
  `pwd_encoder` int(1) NOT NULL DEFAULT '0',
  `sessid` varchar(32) NOT NULL DEFAULT '',
  `actkey` varchar(100) NOT NULL DEFAULT '',
  `lostpwd_key` varchar(100) NOT NULL DEFAULT '',
  `country` varchar(20) NOT NULL DEFAULT 'de',
  `ip` varchar(50) NOT NULL DEFAULT '',
  `regdatum` int(20) NOT NULL DEFAULT '0',
  `email` varchar(200) NOT NULL DEFAULT '',
  `level` int(2) NOT NULL DEFAULT '0',
  `banned` int(1) NOT NULL DEFAULT '0',
  `rlname` varchar(200) NOT NULL DEFAULT '',
  `city` varchar(200) NOT NULL DEFAULT '',
  `sex` int(1) NOT NULL DEFAULT '0',
  `bday` int(11) NOT NULL DEFAULT '0',
  `hp` varchar(200) NOT NULL DEFAULT '',
  `signatur` text,
  `position` int(2) NOT NULL DEFAULT '0',
  `time` int(20) NOT NULL DEFAULT '0',
  `listck` int(1) NOT NULL DEFAULT '0',
  `online` int(1) NOT NULL DEFAULT '0',
  `nletter` int(1) NOT NULL DEFAULT '1',
  `whereami` text,
  `url2` varchar(249) NOT NULL DEFAULT '',
  `url3` varchar(249) NOT NULL DEFAULT '',
  `beschreibung` text,
  `pnmail` int(1) NOT NULL DEFAULT '1',
  `profile_access` int(1) NOT NULL DEFAULT '1',
  `startpage` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pwd` (`pwd`) USING BTREE,
  KEY `time` (`time`) USING BTREE,
  KEY `bday` (`bday`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_users
-- ----------------------------
INSERT INTO dzcp_users VALUES ('1', 'admin', 'Administrator', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '2', '2vdrbvs2mhukmddo00m7dsatlsr3s1kg', '', '', 'de', '88.152.46.77', '1422295535', 'support@hammermaps.de', '4', '0', 'bn', 'Erkrath', '1', '860277600', 'http://www.dzcp.de', 'nbmbnmnbmbn', '1', '1495980091', '0', '1', '1', 'News', '', '', '', 'bnmbnm', '1', '0', '1', '1', '0');
INSERT INTO dzcp_users VALUES ('2', 'test', 'testuser', 'ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff', '2', '', '', '', 'de', '88.152.46.77', '1458082154', 'testuser@domain.de', '1', '0', '', '', '2', '-306982800', '', null, '0', '1495398981', '0', '0', '1', 'Logout', '', '', '', null, '1', '0', '1', '1', '0');
INSERT INTO dzcp_users VALUES ('6', 'acecom', 'acecom', 'acbb0887561410f3ae5b0d2efa18a5bfb5132f27f5e04b7e9f3761687ca7f8d3fe02977bf179d881f7c8381e442de4ec486dc45b2451e1290b10ed7d67cca7f7', '2', '0i50nlap38noifmueicq6kh5c9i8tubo', '', '', 'de', '91.66.240.25', '1489271768', 'acecom@freenet.de', '4', '0', 'Patrick', 'Berlin', '1', '358466400', '', '', '0', '1492119007', '0', '1', '1', 'Downloads', '', '', '', '', '1', '0', '1', '1', '3');
INSERT INTO dzcp_users VALUES ('8', 'pre', 'pre', '96f1e657a68e2b2552e521188a938d35323206de4b325cd2dbd52954a7844d8494aacfe64e77e640a95820122ef2e61e9f719cb2d22807d742e04dbe50f931a1', '2', '', 'D3141283-4231-C362-8B0C-8A2423D3A344', '', 'de', '84.119.21.40', '1489322620', 'brvnet@gmx.de', '0', '0', '', '', '0', '0', '', null, '0', '1489322620', '0', '0', '1', null, '', '', '', null, '1', '0', '1', '1', '0');
INSERT INTO dzcp_users VALUES ('9', '7nd', '7nd', '2e0901852667b2203c07eabbf50dc3c15a70b58c63a025cdbc0ff8a07cf870d6bc320e52f11fbdb258ccd03d9d93701476aa7dd7b27079161297feda43ab452c', '2', '', '', '', 'de', '88.152.46.77', '1489385602', 'info@7nd.de', '1', '0', 'Steve S.', 'Lage', '1', '0', '', null, '0', '1495469110', '0', '0', '1', 'Logout', '', '', '', null, '1', '0', '1', '1', '0');
INSERT INTO dzcp_users VALUES ('11', 'masterbee', 'Lucas', '365064f991660efe79aa752a620cabd3a9507ea05bf4c7899fea2e6c8fc974f7ecc3ee8fb9b8377569d06ed97f12821649c0682c9592b95dab0e0ad99d0cf76e', '2', '', '187E06B0-248B-FA54-1B2A-BB06CA50B0AD', '', 'de', '88.152.46.77', '1494010036', 'lbrucksch@hammermaps.de', '0', '0', '', '', '0', '0', '', null, '0', '1494010036', '0', '0', '1', null, '', '', '', null, '1', '0', '1', '1', '0');

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
) ENGINE=Aria AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_userstats
-- ----------------------------
INSERT INTO dzcp_userstats VALUES ('1', '1', '430', '11', '1495978679', '12243', '4', '247', '2', '8', '0');
INSERT INTO dzcp_userstats VALUES ('2', '2', '5', '1', '1495397715', '207', '0', '3', '2', '1', '1');
INSERT INTO dzcp_userstats VALUES ('3', '3', '0', '0', '1432427606', '0', '0', '1', '0', '0', '3');
INSERT INTO dzcp_userstats VALUES ('4', '3', '0', '0', '1457261410', '0', '0', '0', '0', '0', '3');
INSERT INTO dzcp_userstats VALUES ('5', '4', '0', '0', '1457998526', '0', '0', '1', '0', '0', '0');
INSERT INTO dzcp_userstats VALUES ('6', '6', '12', '0', '1492106481', '189', '2', '2', '0', '0', '0');
INSERT INTO dzcp_userstats VALUES ('8', '8', '0', '0', '1489322620', '0', '0', '0', '0', '0', '0');
INSERT INTO dzcp_userstats VALUES ('9', '9', '2', '0', '1495399541', '19', '0', '2', '0', '1', '0');
INSERT INTO dzcp_userstats VALUES ('11', '11', '0', '0', '1494010036', '0', '0', '0', '0', '0', '1');

-- ----------------------------
-- Table structure for `dzcp_votes`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_votes`;
CREATE TABLE `dzcp_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` int(20) NOT NULL DEFAULT '0',
  `titel` varchar(249) NOT NULL DEFAULT '',
  `intern` int(1) NOT NULL DEFAULT '0',
  `menu` int(1) NOT NULL DEFAULT '0',
  `closed` int(1) NOT NULL DEFAULT '0',
  `von` int(10) NOT NULL DEFAULT '0',
  `forum` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=Aria AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_votes
-- ----------------------------
INSERT INTO dzcp_votes VALUES ('1', '1495736970', 'sadsad', '0', '0', '0', '1', '1');
INSERT INTO dzcp_votes VALUES ('2', '1495788894', 'dftertert', '0', '0', '0', '1', '1');
INSERT INTO dzcp_votes VALUES ('3', '1495788929', 'dftertert', '0', '0', '0', '1', '1');

-- ----------------------------
-- Table structure for `dzcp_vote_results`
-- ----------------------------
DROP TABLE IF EXISTS `dzcp_vote_results`;
CREATE TABLE `dzcp_vote_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vid` int(5) NOT NULL DEFAULT '0',
  `what` varchar(5) NOT NULL DEFAULT '',
  `sel` varchar(80) NOT NULL DEFAULT '',
  `stimmen` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `vid` (`vid`) USING BTREE,
  KEY `what` (`what`) USING BTREE
) ENGINE=Aria AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 PAGE_CHECKSUM=0 TRANSACTIONAL=0;

-- ----------------------------
-- Records of dzcp_vote_results
-- ----------------------------
INSERT INTO dzcp_vote_results VALUES ('1', '1', 'a1', 'sadasd', '0');
INSERT INTO dzcp_vote_results VALUES ('2', '1', 'a2', 'sadasd', '0');
INSERT INTO dzcp_vote_results VALUES ('3', '1', 'a3', 'asdas', '0');
INSERT INTO dzcp_vote_results VALUES ('4', '1', 'a4', 'dasd', '0');
INSERT INTO dzcp_vote_results VALUES ('5', '1', 'a5', 'sadas', '0');
INSERT INTO dzcp_vote_results VALUES ('6', '1', 'a6', 'dasd', '0');
INSERT INTO dzcp_vote_results VALUES ('7', '1', 'a7', 'asdas', '0');
INSERT INTO dzcp_vote_results VALUES ('8', '1', 'a8', 'dasd', '0');
INSERT INTO dzcp_vote_results VALUES ('9', '1', 'a9', 'asdas', '0');
INSERT INTO dzcp_vote_results VALUES ('10', '1', 'a10', 'dasd', '0');
INSERT INTO dzcp_vote_results VALUES ('11', '2', 'a1', 'erter', '0');
INSERT INTO dzcp_vote_results VALUES ('12', '2', 'a2', 'ert', '0');
INSERT INTO dzcp_vote_results VALUES ('13', '2', 'a3', 'erte', '0');
INSERT INTO dzcp_vote_results VALUES ('14', '2', 'a4', 'ertert', '0');
INSERT INTO dzcp_vote_results VALUES ('15', '3', 'a1', 'erter', '0');
INSERT INTO dzcp_vote_results VALUES ('16', '3', 'a2', 'ert', '0');
INSERT INTO dzcp_vote_results VALUES ('17', '3', 'a3', 'erte', '0');
INSERT INTO dzcp_vote_results VALUES ('18', '3', 'a4', 'ertert', '0');
