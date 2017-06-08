<?php
/**
 * DZCP - deV!L`z ClanPortal - Mainpage ( dzcp.de )
 * deV!L`z Clanportal ist ein Produkt von CodeKing,
 * geändert dürch my-STARMEDIA und Codedesigns.
 *
 * Diese Datei ist ein Bestandteil von dzcp.de
 * Diese Version wurde speziell von Lucas Brucksch (Codedesigns) für dzcp.de entworfen bzw. verändert.
 * Eine Weitergabe dieser Datei außerhalb von dzcp.de ist nicht gestattet.
 * Sie darf nur für die Private Nutzung (nicht kommerzielle Nutzung) verwendet werden.
 *
 * Homepage: http://www.dzcp.de
 * E-Mail: info@web-customs.com
 * E-Mail: lbrucksch@codedesigns.de
 * Copyright 2017 © CodeKing, my-STARMEDIA, Codedesigns
 */

//-> Ladezeit berechen
function getmicrotime() {
    list($usec,$sec) = explode(" ",microtime());
    return((float)$usec+(float)$sec);
}
define('start_time',getmicrotime());

if(!defined('is_api')) { define('is_api', false); }
if(!defined('is_ajax')) { define('is_ajax', false); }
if(!defined('is_thumbgen')) { define('is_thumbgen', false); }

## INCLUDES ##
require_once(basePath."/vendor/autoload.php");
//require_once(basePath."/vendor/nbbc/nbbc.php");
require_once(basePath."/inc/debugger.php");
require_once(basePath."/inc/configs/config.php");
require_once(basePath."/inc/database.php");
require_once(basePath.'/inc/crypt.php');
require_once(basePath.'/inc/sessions.php');
require_once(basePath.'/inc/secure.php');
require_once(basePath."/inc/cookie.php");
require_once(basePath."/inc/dbc_index.php");
require_once(basePath."/inc/javascript.php");
require_once(basePath."/inc/stringParser.php");
require_once(basePath."/inc/sfs.php");
require_once(basePath."/inc/bbcode.php");

if(!is_api) {
    require_once(basePath . '/inc/securimage/securimage_color.php');
    require_once(basePath . '/inc/securimage/securimage.php');
}

require_once(basePath.'/inc/settings.php');
require_once(basePath.'/inc/notification.php');

use Jaybizzle\CrawlerDetect\CrawlerDetect;

//-> Global
if(!is_api) {
    $action = isset($_GET['action']) ? secure_global_imput($_GET['action']) : (isset($_POST['action']) ? secure_global_imput($_POST['action']) : 'default');
    $page = isset($_GET['page']) ? (int)(trim($_GET['page'])) : (isset($_POST['page']) ? (int)(trim($_POST['page'])) : 1);
    $do = isset($_GET['do']) ? secure_global_imput($_GET['do']) : (isset($_POST['do']) ? secure_global_imput($_POST['do']) : '');
} $index = ''; $show = ''; $color = 0;

new common(); //Main Construct

require_once(basePath.'/inc/sfs.php');

/**
 * Class common
 */
class common {
    //Public
    public static $database = NULL;
    public static $sql = [];
    public static $securimage = NULL;
    public static $httphost = NULL;
    public static $userip = NULL;
    public static $userid = 0;
    public static $smarty = NULL;
    public static $gump = NULL;
    public static $sid = NULL;
    public static $domain = NULL;
    public static $pagetitle = NULL;
    public static $sdir = NULL;
    public static $reload = 3600;
    public static $maxpicwidth = 90;
    public static $maxfilesize = NULL;
    public static $UserAgent = NULL;
    public static $designpath = NULL;
    public static $tmpdir = NULL;
    public static $chkMe = 0;
    public static $CrawlerDetect = NULL;
    public static $less = NULL;

    //Private
    private static $menu_index = [];

    //Consts
    const FORUM_DOUBLE_POST_INSERT = 0;
    const FORUM_DOUBLE_POST_TH_ADD = 1;
    const FORUM_DOUBLE_POST_PO_ADD = 2;

    //Functions
    /**
     * common constructor.
     */
    public function __construct()
    {
        //->Set default timezone
        if (function_exists("date_default_timezone_set") && function_exists("date_default_timezone_get") && use_default_timezone) {
            date_default_timezone_set(date_default_timezone_get());
        } else if (!use_default_timezone) {
            date_default_timezone_set(default_timezone);
        } else {
            date_default_timezone_set("Europe/Berlin");
        }

        //->Set Debugger
        if(!is_thumbgen) {
            if(view_error_reporting) {
                error_reporting(E_ALL);

                if (function_exists('ini_set')) {
                    ini_set('display_errors', 1);
                }

                DebugConsole::initCon();

                if (debug_dzcp_handler) {
                    set_error_handler('dzcp_error_handler');
                }
            } else {
                if (function_exists('ini_set')) {
                    ini_set('display_errors', 0);
                }

                error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

                if (debug_dzcp_handler) {
                    set_error_handler('dzcp_error_handler');
                }
            }
        }

        //->Crawler Detect
        self::$CrawlerDetect = new CrawlerDetect;

        //->Init-Database
        self::$gump = new GUMP();

        //->Init-Database
        self::$database = new database();
        self::$database->setConfig('default',config::$SQL_CONNECTION);
        self::$sql['default'] = self::$database->getInstance();

        //->Lade Einstellungen
        settings::load();

        //->Lade Securimage
        if(!is_api && !is_thumbgen) {
            self::$securimage = new Securimage();
        }

        //-> Cookie initialisierung
        if(!is_api && !is_thumbgen) {
            cookie::init('dzcp_' . settings::get('prev'));
        }

        //-> JS initialisierung
        if(!is_api && !is_thumbgen) {
            javascript::set('AnchorMove', '');
            javascript::set('debug', (view_error_reporting && view_javascript_debug));
        }

        //-> Language auslesen oder default setzen
        if(!is_api && !is_thumbgen) {
            $_SESSION['language'] = (cookie::get('language') != false ?
                (file_exists(basePath.'/inc/lang/'.cookie::get('language').'.php') ?
                    cookie::get('language') :
                    settings::get('language')) :
                settings::get('language'));
        }

        if(!is_api && !is_thumbgen) {
            $subfolder = basename(dirname(dirname(self::GetServerVars('PHP_SELF')) . '../'));
            self::$httphost = self::GetServerVars('HTTP_HOST') . (empty($subfolder) ? '' : '/' . $subfolder);
            unset($subfolder);
        }

        //Less Parser
        $options = array( 'compress' => true, 'sourceMap' => false );
        self::$less = new Less_Parser($options);

        //Set User IP & einzelne Definitionen
        self::$userip = self::visitorIp();
        self::$domain = str_replace('www.','',self::$httphost);
        self::$pagetitle = stringParser::decode(settings::get('pagetitel'));
        self::$sdir = stringParser::decode(settings::get('tmpdir'));
        self::$reload = 3600 * 24;
        self::$maxpicwidth = 90;
        self::$maxfilesize = @ini_get('upload_max_filesize');
        self::$UserAgent = trim(self::GetServerVars('HTTP_USER_AGENT'));
        self::$sid=(float)rand()/(float)getrandmax();

        //Nachrichten Check
        self::check_msg_emal();

        //-> Laden der Menus
        if(!is_api) {
            if ($menu_functions_index = self::get_files(basePath . '/inc/menu-functions', false, true, ['php'])) {
                foreach ($menu_functions_index as $mfphp) {
                    $file = str_replace('.php', '', $mfphp);
                    if ($file != 'navi') {
                        self::$menu_index[$file] = file_exists(basePath . '/inc/menu-functions/' . $file . '.php');
                    }
                }
                unset($menu_functions_index, $file, $mfphp);
            }
        }

        //-> Navigation einbinden
        if (!is_api && file_exists(basePath . '/inc/menu-functions/navi.php')) {
            include_once(basePath . '/inc/menu-functions/navi.php');
        }

        //Smarty Template-system
        self::$smarty = self::getSmarty(true);

        self::check_ip(); // IP Prufung * No IPV6 Support *

        //-> Auslesen der Cookies und automatisch anmelden
        if(!is_api && cookie::get('id') != false && cookie::get('pkey') != false && empty($_SESSION['id']) && !self::checkme()) {
            //-> Permanent Key aus der Datenbank suchen
            $get_almgr = self::$sql['default']->fetch("SELECT `id`,`uid`,`update`,`expires` FROM `{prefix_autologin}` WHERE `pkey` = ? AND `uid` = ?;", [cookie::get('pkey'), cookie::get('id')]);
            if(self::$sql['default']->rowCount()) {
                if((!$get_almgr['update'] || (time() < ($get_almgr['update'] + $get_almgr['expires'])))) {
                    //-> User aus der Datenbank suchen
                    $get = self::$sql['default']->fetch("SELECT `id`,`user`,`nick`,`pwd`,`email`,`level`,`time` FROM `{prefix_users}` WHERE `id` = ? AND `level` != 0;", [cookie::get('id')]);
                    if(self::$sql['default']->rowCount()) {
                        //-> Generiere neuen permanent-key
                        $permanent_key = md5(self::mkpwd(8));
                        cookie::put('pkey', $permanent_key);
                        cookie::save();

                        //Update Autologin
                        self::$sql['default']->update("UPDATE `{prefix_autologin}` SET `ssid` = ?, `pkey` = ?, `ip` = ?, `host` = ?, `update` = ?, `expires` = ? WHERE `id` = ?;",
                            [session_id(),$permanent_key,self::$userip,gethostbyaddr(self::$userip),time(),autologin_expire,$get_almgr['id']]);

                        //-> Schreibe Werte in die Server Sessions
                        $_SESSION['id']         = $get['id'];
                        $_SESSION['pwd']        = $get['pwd'];
                        $_SESSION['lastvisit']  = $get['time'];
                        $_SESSION['ip']         = self::$userip;

                        if (self::data("ip", $get['id']) != $_SESSION['ip']) {
                            $_SESSION['lastvisit'] = self::data("time", $get['id']);
                        }

                        if (empty($_SESSION['lastvisit'])) {
                            $_SESSION['lastvisit'] = self::data("time", $get['id']);
                        }

                        //-> Aktualisiere Datenbank
                        self::$sql['default']->update("UPDATE `{prefix_users}` SET `online` = 1, `sessid` = ?, `ip` = ? WHERE `id` = ?;",
                            [session_id(),self::$userip,$get['id']]);

                        //-> Aktualisiere die User-Statistik
                        self::userstats_increase('logins',$get['id']);

                        //-> Aktualisiere Ip-Count Tabelle
                        foreach(self::$sql['default']->select("SELECT `id` FROM `{prefix_clicks_ips}` WHERE `ip` = ? AND `uid` = 0;", [self::$userip]) as $get_ci) {
                            self::$sql['default']->update("UPDATE `{prefix_clicks_ips}` SET `uid` = ? WHERE `id` = ?;", [$get['id'],$get_ci['id']]);
                        }

                        unset($get,$permanent_key,$get_almgr,$get_ci); //Clear Mem
                    } else {
                        self::dzcp_session_destroy();
                        $_SESSION['id']        = '';
                        $_SESSION['pwd']       = '';
                        $_SESSION['ip']        = '';
                        $_SESSION['lastvisit'] = '';
                        $_SESSION['pkey']      = '';
                        $_SESSION['akl_id']    = 0;
                    }
                } else {
                    self::$sql['default']->delete("DELETE FROM `{prefix_autologin}` WHERE `id` = ?;", [$get_almgr['id']]);
                    self::dzcp_session_destroy();
                }
            }
        }

        //-> Sprache aendern
        if(!is_api) {
            if (isset($_GET['set_language']) && !empty($_GET['set_language'])) {
                if (file_exists(basePath . "/inc/lang/" . $_GET['set_language'] . ".php")) {
                    $_SESSION['language'] = $_GET['set_language'];
                    cookie::put('language', $_GET['set_language']);
                    cookie::save();
                }

                header("Location: " . stringParser::decode(self::GetServerVars('HTTP_REFERER')));
                exit();
            }
        }

        self::lang($_SESSION['language']); //Lade Sprache
        self::$userid = (int)(self::userid());
        self::$chkMe = (int)(self::checkme());
        if(!self::$chkMe && (!empty($_SESSION['id']) || !empty($_SESSION['pwd']))) {
            $_SESSION['id']        = '';
            $_SESSION['pwd']       = '';
            $_SESSION['ip']        = self::$userip;
            $_SESSION['lastvisit'] = time();
            $_SESSION['language'] = stringParser::decode(settings::get('language'));
        }

        //-> Prueft ob der User gebannt ist, oder die IP des Clients warend einer offenen session veraendert wurde.
        if(!is_api) {
            if (self::$chkMe && self::$userid && !empty($_SESSION['ip'])) {
                if ($_SESSION['ip'] != self::visitorIp() || self::isBanned(self::$userid, false)) {
                    self::dzcp_session_destroy();
                    header("Location: ../news/");
                }
            }
        }

        /*
         * Aktualisiere die Client DNS & User Agent
         */
        if(!is_api && session_id()) {
            $userdns = self::DNSToIp(self::$userip);
            if(self::$sql['default']->rows("SELECT `id` FROM `{prefix_iptodns}` WHERE `update` <= ? AND `sessid` = ?;", [time(),session_id()])) {
                self::$sql['default']->update("UPDATE `{prefix_iptodns}` SET `time` = ?, `update` = ?, `ip` = ?, `agent` = ?, `dns` = ?, `bot` = ?, `bot_name` = ? WHERE `sessid` = ?;",
                    [(time()+10*60),(time()+60),self::$userip,stringParser::encode(self::$UserAgent),stringParser::encode($userdns),(self::$CrawlerDetect->isCrawler() ? 1 : 0),
                        stringParser::encode(self::$CrawlerDetect->getMatches()),session_id()]);
            } else if(!self::$sql['default']->rows("SELECT `id` FROM `{prefix_iptodns}` WHERE `sessid` = ?;", [session_id()])) {
                self::$sql['default']->insert("INSERT INTO `{prefix_iptodns}` SET `sessid` = ?, `time` = ?, `ip` = ?, `agent` = ?, `dns` = ?, `bot` = ?, `bot_name` = ?;",
                    [session_id(),(time()+10*60),self::$userip,stringParser::encode(self::$UserAgent),stringParser::encode($userdns),
                        (self::$CrawlerDetect->isCrawler() ? 1 : 0),stringParser::encode(self::$CrawlerDetect->getMatches())]);
                unset($bot);
            }

            //-> Cleanup DNS DB
            $qryDNS = self::$sql['default']->select("SELECT `id`,`ip` FROM `{prefix_iptodns}` WHERE `time` <= ?;", [time()]);
            if(self::$sql['default']->rowCount()) {
                foreach($qryDNS as $getDNS) {
                    self::$sql['default']->delete("DELETE FROM `{prefix_iptodns}` WHERE `id` = ?;", [$getDNS['id']]);
                    self::$sql['default']->delete("DELETE FROM `{prefix_counter_whoison}` WHERE `ip` = ?;", [$getDNS['ip']]);
                } unset($getDNS);
            } unset($qryDNS);

            /*
             * Pruft ob mehrere Session IDs von der gleichen DNS kommen, sollte der Useragent keinen Bot Tag enthalten, wird ein Spambot angenommen.
             */
            $get_sb_array = self::$sql['default']->select("SELECT `id`,`ip`,`bot`,`agent` FROM `{prefix_iptodns}` WHERE `dns` LIKE ?;", [stringParser::encode($userdns)]);
            if(self::$sql['default']->rowCount() >= 3 && !self::validateIpV4Range(self::$userip, '[192].[168].[0-255].[0-255]') &&
                !self::validateIpV4Range(self::$userip, '[127].[0].[0-255].[0-255]') &&
                !self::validateIpV4Range(self::$userip, '[10].[0-255].[0-255].[0-255]') &&
                !self::validateIpV4Range(self::$userip, '[172].[16-31].[0-255].[0-255]')) {
                foreach ($get_sb_array as $get_sb) {
                    if (!$get_sb['bot'] && !self::$CrawlerDetect->isCrawler(stringParser::decode($get_sb['agent']))) {
                        if (!self::$sql['default']->rows("SELECT `id` FROM `{prefix_ipban}` WHERE `ip` = ? LIMIT 1;", [self::$userip])) {
                            $data_array = [];
                            $data_array['confidence'] = '';
                            $data_array['frequency'] = '';
                            $data_array['lastseen'] = '';
                            $data_array['banned_msg'] = stringParser::encode('SpamBot detected by System * No BotAgent *');
                            $data_array['agent'] = $get_sb['agent'];
                            self::$sql['default']->insert("INSERT INTO `{prefix_ipban}` SET `time` = ?, `ip` = ?, `data` = ?, `typ` = 3;", [time(), $get_sb['ip'], serialize($data_array)]);
                            self::check_ip(); // IP Prufung * No IPV6 Support *
                            unset($data_array);
                        }
                    }
                }
            }

            unset($get_sb,$get_sb_array);
        }

//-> Templateswitch
        $files = self::get_files(basePath.'/inc/_templates_/',true);
        if(isset($_GET['tmpl_set'])) {
            foreach ($files as $templ) {
                if($templ == $_GET['tmpl_set']) {
                    cookie::put('tmpdir', $templ);
                    cookie::save();
                    header("Location: ".self::GetServerVars('HTTP_REFERER'));
                }
            }
        }

        if(cookie::get('tmpdir') != false && cookie::get('tmpdir') != NULL) {
            if (file_exists(basePath . "/inc/_templates_/" . cookie::get('tmpdir'))) {
                self::$tmpdir = cookie::get('tmpdir');
            } else {
                self::$tmpdir = $files[0];
            }
        } else {
            if (file_exists(basePath . "/inc/_templates_/" . self::$sdir)) {
                self::$tmpdir = self::$sdir;
            } else {
                self::$tmpdir = $files[0];
            }
        }
        unset($files);

        self::$designpath = '../inc/_templates_/'.self::$tmpdir;

        //-> User Hits und Lastvisit aktualisieren
        if(self::$userid >= 1 && !is_ajax && !is_thumbgen && !is_api && isset($_SESSION['lastvisit'])) {
            self::$sql['default']->update("UPDATE `{prefix_userstats}` SET `hits` = (hits+1), `lastvisit` = ? WHERE `user` = ?;",
                [(int)($_SESSION['lastvisit']),(int)(self::$userid)]);
        }


        //dev
        if(isset($_GET['dev']))
        die(self::less());

    }

    /**
     * @param bool $new_instance
     * @return null|Smarty
     */
    public static function getSmarty(bool $new_instance = false) {
        if($new_instance) {
            $smarty = new Smarty;
            $smarty->force_compile = true;
            $smarty->debugging = false;
            $smarty->caching = false;
            $smarty->cache_lifetime = 120;
            $smarty->allow_php_templates = true;

            $smarty->setTemplateDir(basePath.'/inc/_templates_')
                ->setCompileDir(basePath.'/inc/_templates_c_')
                ->setCacheDir(basePath.'/inc/_cache_')
                ->setPluginsDir([basePath.'/inc/plugins',
                    basePath.'/vendor/smarty/libs/plugins'])
                ->setConfigDir(basePath.'/inc/configs');

            if($folders = self::get_files(basePath.'/inc/_templates_',true)) {
                foreach($folders as $folder) {
                    $smarty->addTemplateDir(basePath.'/inc/_templates_/'.strtolower($folder),strtolower($folder));
                } unset($folders,$folder);
            }

            return $smarty;
        }

        return self::$smarty;
    }

    /**
     * @param string $tag
     * @return string
     */
    public static function getSmartyCacheHash(string $tag='') {
        return md5($tag.'_'.$_SESSION['language']);
    }

    /**
     * Nickausgabe mit Profillink oder Emaillink (reg/nicht reg)
     * @param int $uid
     * @param string $class
     * @param string $nick
     * @param string $email
     * @param string $cut
     * @param string $add
     * @return mixed|string
     */
    public static function autor(int $uid=0,string $class="",string $nick="",string $email="",string $cut="",string $add="") {
        $smarty = self::getSmarty(true);
        $uid = (!$uid ? self::$userid : $uid);
        if(!$uid) return '* No UserID! *';
        if(!dbc_index::issetIndex('user_'.(int)($uid))) {
            $get = self::$sql['default']->fetch("SELECT * FROM `{prefix_users}` WHERE `id` = ?;", [(int)($uid)]);
            if(self::$sql['default']->rowCount()) {
                dbc_index::setIndex('user_'.$get['id'], $get);
            } else {
                $nickname = (!empty($cut)) ? self::cut(stringParser::decode($nick), $cut) : stringParser::decode($nick);
                return self::CryptMailto($email,_user_link_noreg, ["nick" => $nickname, "class" => $class]);
            }
        }

        $nickname = (!empty($cut)) ? self::cut(stringParser::decode(dbc_index::getIndexKey('user_'.(int)($uid), 'nick')), $cut) :stringParser::decode(dbc_index::getIndexKey('user_'.(int)($uid), 'nick'));

        $smarty->caching = false;
        $smarty->assign('id',$uid);
        $smarty->assign('country',self::flag(dbc_index::getIndexKey('user_'.(int)($uid), 'country')));
        $smarty->assign('class',$class);
        $smarty->assign('get',$add);
        $smarty->assign('nick',$nickname);
        $user = $smarty->fetch('file:['.common::$tmpdir.']user/user_link.tpl');
        $smarty->clearAllAssign();
        return $user;
    }

    /**
     * Nickausgabe mit Profillink (reg + position farbe)
     * @param int $uid
     * @param string $class
     * @param string $cut
     * @return mixed|string
     */
    public static function autorcolerd(int $uid=0, $class="", $cut="") {
        /* TODO: dbc_index */

        $getp = self::$sql['default']->fetch("SELECT `position` FROM `{prefix_users}` WHERE `id` = ?;", [(int)($uid)]);
        $get = self::$sql['default']->fetch("SELECT `id`,`color` FROM `{prefix_positions}` WHERE `id` = ?;", [$getp['position']]);
        if(!$getp['position'] || !self::$sql['default']->rowCount()) {
            return self::autor($uid,$class,'','',$cut);
        }

        $nickname = (!empty($cut)) ? self::cut(stringParser::decode(dbc_index::getIndexKey('user_'.(int)($uid), 'nick')), $cut) : stringParser::decode(dbc_index::getIndexKey('user_'.(int)($uid), 'nick'));

        $smarty = self::getSmarty(true);
        $smarty->caching = false;
        $smarty->assign('id',$uid);
        $smarty->assign('country',self::flag(self::data('country',$uid)));
        $smarty->assign('class',$class);
        $smarty->assign('color',stringParser::decode($get['color']));
        $smarty->assign('nick',$nickname);
        $autor = $smarty->fetch('file:['.common::$tmpdir.']user/user_link_colerd.tpl');
        $smarty->clearAllAssign();
        return $autor;
    }

    /**
     * @param int $uid
     * @param string $class
     * @param string $nick
     * @param string $email
     * @return mixed|string
     */
    public static function cleanautor(int $uid=0, $class="", $nick="", $email="") {
        /* TODO: Replace dbc_index */
        $smarty = self::getSmarty(true);

        if(!dbc_index::issetIndex('user_'.(int)($uid))) {
            $get = self::$sql['default']->fetch("SELECT * FROM `{prefix_users}` WHERE `id` = ?;", [(int)($uid)]);
            if(self::$sql['default']->rowCount()) {
                dbc_index::setIndex('user_' . $get['id'], $get);
            } else {
                return self::CryptMailto($email, _user_link_noreg, ["nick" => stringParser::decode($nick), "class" => $class]);
            }
        }

        $smarty->caching = false;
        $smarty->assign('id',$uid);
        $smarty->assign('country',self::flag(dbc_index::getIndexKey('user_'.(int)($uid), 'country')));
        $smarty->assign('class',$class);
        $smarty->assign('nick',stringParser::decode(dbc_index::getIndexKey('user_'.(int)($uid), 'nick')));
        $user = $smarty->fetch('file:['.common::$tmpdir.']user/user_link_preview.tpl');
        $smarty->clearAllAssign();
        return $user;
    }

    /**
     * @param int $uid
     * @return string
     */
    public static function rawautor(int $uid=0) {
        /* TODO: Replace dbc_index */
        if(!dbc_index::issetIndex('user_'.(int)($uid))) {
            $get = self::$sql['default']->fetch("SELECT * FROM `{prefix_users}` WHERE `id` = ?;", [(int)($uid)]);
            if(self::$sql['default']->rowCount()) {
                dbc_index::setIndex('user_' . $get['id'], $get);
            } else {
                return self::rawflag('') . " " . self::jsconvert(stringParser::decode($uid));
            }
        }

        return self::rawflag(dbc_index::getIndexKey('user_'.(int)($uid), 'country'))." ".
        self::jsconvert(stringParser::decode(dbc_index::getIndexKey('user_'.(int)($uid), 'nick')));
    }

    /**
     * Nickausgabe ohne Profillink oder Emaillink fr das ForenAbo
     * @param int $uid
     * @return mixed|string
     */
    public static function fabo_autor(int $uid) {
        /* TODO: Replace dbc_index */
        if(!dbc_index::issetIndex('user_'.(int)($uid))) {
            $get = self::$sql['default']->fetch("SELECT * FROM `{prefix_users}` WHERE `id` = ?;", [(int)($uid)]);
            if(self::$sql['default']->rowCount()) {
                dbc_index::setIndex('user_' . $get['id'], $get);
                return stringParser::decode($get['nick']);
            }
        } else {
            return stringParser::decode(stringParser::decode(dbc_index::getIndexKey('user_'.(int)($uid), 'nick')));
        }

        return '';
    }

    /**
     * Rechte abfragen
     * @param string $txt
     * @return mixed
     */
    public static function jsconvert(string $txt)
    { return str_replace(["'","&#039;","\"","\r","\n"], ["\'","\'","&quot;","",""],$txt); }

    /**
     * interner Forencheck
     * @param int $id
     * @return bool
     */
    public static function forum_intern(int $id=0) {
        if(!self::$chkMe) {
            $fget = self::$sql['default']->fetch("SELECT s1.`intern`,s2.`id` FROM `{prefix_forumkats}` AS `s1` LEFT JOIN `{prefix_forumsubkats}` AS `s2` ON s2.`sid` = s1.`id` WHERE s2.`id` = ?;",
                [(int)($id)]);
            return (!$fget['intern']);
        } else if(self::$chkMe == 4) {
            return true;
        } else {
            $team = self::$sql['default']->rows("SELECT s1.`id` FROM `{prefix_forum_access}` AS `s1` LEFT JOIN `{prefix_userposis}` AS `s2` ON s1.`pos` = s2.`posi` WHERE s2.`user` = ? AND s2.`posi` != 0 AND s1.`forum` = ?;",
                [(int)(self::$userid),(int)($id)]);
            $user = self::$sql['default']->rows("SELECT `id` FROM `{prefix_forum_access}` WHERE `user` = ? AND `forum` = ?;",
                [(int)(self::$userid),(int)($id)]);
            return ($user || $team);
        }
    }

    /**
     * Einzelne Userdaten ermitteln
     * @param string $what
     * @param int $tid
     * @return string
     */
    public static function data(string $what='id',int $tid=0) {
        /* TODO: Cacheing & Indexing a User */
        if (!$tid) { $tid = self::$userid; }
        if(!dbc_index::issetIndex('user_'.$tid)) {
            $get = self::$sql['default']->fetch("SELECT * FROM `{prefix_users}` WHERE `id` = ?;", [(int)($tid)]);
            dbc_index::setIndex('user_'.$tid, $get);
        }

        return stripslashes(dbc_index::getIndexKey('user_'.$tid, $what));
    }

    /**
     * @param string $address
     * @return bool|string
     */
    public static function DNSToIp(string $address='') {
        if (!preg_match('#^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$#', $address)) {
            if (!($result = gethostbyname($address))) {
                return false;
            }

            if ($result === $address) {
                $result = false;
            }
        } else {
            $result = $address;
        }

        return $result;
    }

    /**
     * Errormmeldung ausgeben
     * @param string $error
     * @param int $back
     * @return mixed|string
     */
    public static function error(string $error,int $back=3) {
        $smarty = self::getSmarty(true);
        $smarty->caching = false;
        $smarty->assign('error',$error);
        $smarty->assign('back',$back);
        $error = $smarty->fetch('file:['.common::$tmpdir.']errors/error.tpl');
        $smarty->clearAllAssign();
        return $error;
    }

    /**
     * Email wird auf korrekten Syntax
     * @param string $email
     * @return bool
     */
    public static function check_email(string $email) {
        $rules = ['email' => 'required|valid_email'];
        $filters = ['email' => 'trim|sanitize_email'];
        return self::$gump->validate(self::$gump->filter(['email'=>$email], $filters), $rules) === TRUE ? true : false;
    }

    /**
     * Bilder verkleinern
     * @param string $img
     * @return string
     */
    public static function img_size(string $img) {
        return "<a href=\"../".$img."\" rel=\"lightbox[l_".(int)($img)."]\"><img src=\"../thumbgen.php?img=".$img."\" alt=\"\" /></a>";
    }

    /**
     *  CSS Basierend - Blaetterfunktion
     * [Previous][1][Next]
     * [Previous][1][2][3][4][Next]
     * [Previous][1][2][3][4][...][20][Next]
     * [Previous][1][...][16][17][18][19][20][Next]
     * [Previous][1][...][13][14][15][16][...][20][Next]
     * @param $entrys
     * @param $perpage
     * @param string $urlpart
     * @param int $recall
     * @return string
     */
    public static function nav(int $entrys,int $perpage,string $urlpart='',int $recall = 0) {
        global $page;
        if(!$entrys || !$perpage) {
            $entrys = 1;
            $perpage = 10;
        }

        $total_pages  = ceil($entrys / $perpage);
        $maximum_links = ((9 - $recall) / 2);
        $no_recall = !$recall ? false : true;
        $offset_izq = ($page - $maximum_links) < 0 ? $page - $maximum_links : 0;
        $offset_der = ($total_pages - $page) < $maximum_links ? $maximum_links - ($total_pages - $page) : 0;
        $pagination =""; $urlpart_extended = empty($urlpart) ? '?' : '&amp;'; $recall = 0;

        if(!show_empty_paginator && $total_pages == 1) {
            return '';
        }

        if ($page == 1) {
            $pagination.= "<div class='pagination active'>"._paginator_previous."</div>";
        } else {
            $pagina_anterior = $page - 1;
            $pagination .= "<a href='".$urlpart.$urlpart_extended."page=".$pagina_anterior."' class='pagination'>"._paginator_previous."</a>";
        }

        $pager = []; $pagination_f = '';
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i <= ($page - $maximum_links) - $offset_der || $i > ($page + $maximum_links) - $offset_izq) { $pager[$i] = false; continue; }
            $pagination_f .= ($i == $page ? "<div class='pagination active'>" .$i. "</div>" : "<a href='".$urlpart.$urlpart_extended."page=".$i."' class='pagination'>".$i."</a>");
            $pager[$i] = true;
        }

        if(!$pager[1]) {
            $pagination.= "<a href='".$urlpart.$urlpart_extended."page=1' class='pagination'>1</a>";
            $pagination.= "<div class='pagination active'>...</div>";
            $recall = ($recall+1);
        }

        $pagination.= $pagination_f;
        if(!$pager[$total_pages]) {
            $pagination.= "<div class='pagination active'>...</div>";
            $pagination.= "<a href='".$urlpart.$urlpart_extended."page=".$total_pages."' class='pagination'>".$total_pages."</a>";
            $recall = ($recall+1);
        }

        if($recall && !$no_recall) {
            return self::nav($entrys, $perpage, $urlpart, $recall);
        }

        if ($page == $total_pages) {
            $pagination.= "<div class='pagination active'>"._paginator_next."</div>";
        } else {
            $pagina_posterior = $page + 1;
            $pagination.= "<a href='".$urlpart.$urlpart_extended."page=".$pagina_posterior."' class='pagination'>"._paginator_next."</a>";
        }

        return $pagination."</div>";
    }
    
    /**
     * Liste der Laender ausgeben
     * @param string $i
     * @return string
     */
    public static function show_countrys(string $i="") {
        if ($i != "") {
            $options = preg_replace('#<option value="' . $i . '">(.*?)</option>#', '<option value="' . $i . '" selected="selected"> \\1</option>', _country_list);
        } else {
            $options = preg_replace('#<option value="de"> Deutschland</option>#', '<option value="de" selected="selected"> Deutschland</option>', _country_list);
        }

        return '<select id="land" name="land" class="dropdown">'.$options.'</select>';
    }

    /**
     * Funktion um bei DB-Eintraegen URLs einem http:// zuzuweisen
     * @param string $hp
     * @return string
     */
    public static function links(string $hp) {
        if(!empty($hp)) {
            //SSL
            $count = 0;
            $hp = str_replace("https://", "", $hp, $count);
            if ($count >= 1) {
                return 'https://' . $hp;
            }

            $count = 0;
            $hp = str_replace("http://", "", $hp, $count);
            if ($count >= 1) {
                return 'http://' . $hp;
            }
        }

        return $hp;
    }

    /**
     * Funktion um Passwoerter generieren zu lassen
     * @param int $passwordLength
     * @param bool $specialcars
     * @return string
     */
    public static function mkpwd(int $passwordLength=8,bool $specialcars=true) {
        $componentsCount = count(config::$passwordComponents);

        if(!$specialcars && $componentsCount == 4) {
            unset(config::$passwordComponents[3]);
            $componentsCount = count(config::$passwordComponents);
        }

        shuffle(config::$passwordComponents); $password = '';
        for ($pos = 0; $pos < $passwordLength; $pos++) {
            $componentIndex = ($pos % $componentsCount);
            $componentLength = strlen(config::$passwordComponents[$componentIndex]);
            $random = rand(0, $componentLength-1);
            $password .= config::$passwordComponents[$componentIndex]{ $random };
        }

        unset($random,$componentLength,$componentIndex);
        return $password;
    }

    /**
     * Einzelne Userstatistiken ermitteln
     * @param string $what
     * @param int $tid
     * @return int
     */
    public static function userstats(string $what='id',int $tid=0) {
        /*
        TODO: Use PHPFastCache - Cache in Memory
        */
        if (!$tid) { $tid = self::$userid; }
        $stats = self::$sql['default']->fetch("SELECT `".$what."` FROM `{prefix_userstats}` WHERE `user` = ?;", [(int)($tid)]);
        if(!common::$sql['default']->rowCount() && $tid >= 1) {
            self::$sql['default']->insert("INSERT INTO `{prefix_userstats}` SET `user` = ?;", [(int)($tid)]);
            return 0;
        }

        return $stats[$what];
    }

    /**
     * Einzelne Userstatistiken ermitteln
     * @param string $what
     * @param int $tid
     * @return int
     */
    public static function userstats_increase(string $what='profilhits',int $tid=0) {
        /*
        TODO: Use PHPFastCache - Cache in Memory
        */
        if (!$tid) { $tid = self::$userid; }
        self::$sql['default']->fetch("SELECT `".$what."` FROM `{prefix_userstats}` WHERE `user` = ?;", [(int)($tid)]);
        if(common::$sql['default']->rowCount() && $tid >= 1) {
            self::$sql['default']->update("UPDATE `{prefix_userstats}` SET `".$what."` = (".$what."+1) WHERE `user` = ?;", [(int)($tid)]);
        } else if(!common::$sql['default']->rowCount() && $tid >= 1) {
            self::$sql['default']->insert("INSERT INTO `{prefix_userstats}` SET `user` = ?;", [(int)($tid)]);
            self::$sql['default']->update("UPDATE `{prefix_userstats}` SET `".$what."` = (".$what."+1) WHERE `user` = ?;", [(int)($tid)]);
        }
    }

    /**
     * Funktion zum versenden von Emails
     * @param string $mailto
     * @param string $subject
     * @param string $content
     * @return bool
     * @throws phpmailerException
     */
    public static function sendMail(string $mailto,string $subject,string $content) {
            $mail = new PHPMailer;
            $mail->CharSet = 'utf-8';
            switch (settings::get('mail_extension')) {
                case 'smtp':
                    $mail->isSMTP();
                    $mail->Host = stringParser::decode(settings::get('smtp_hostname'));
                    $mail->Port = (int)(settings::get('smtp_port'));
                    switch (settings::get('smtp_tls_ssl')) {
                        case 1:
                            if($mail->Port == 25)
                                $mail->Port = 465;

                            $mail->SMTPSecure = 'tls';
                            break;
                        case 2:
                            if($mail->Port == 25)
                                $mail->Port = 465;

                            $mail->SMTPSecure = 'ssl';
                            break;
                        default:
                            $mail->SMTPSecure = '';
                            break;
                    }
                    $mail->SMTPAuth = (empty(settings::get('smtp_username')) && empty(settings::get('smtp_password')) ? false : true);
                    $mail->Username = stringParser::decode(settings::get('smtp_username'));
                    $mail->Password = session::decode(settings::get('smtp_password'));
                    break;
                case 'sendmail':
                    $mail->isSendmail();
                    $mail->Sendmail = stringParser::decode(settings::get('sendmail_path'));
                    break;
            }

            $mail->From = ($mailfrom =stringParser::decode(settings::get('mailfrom')));
            $mail->FromName = $mailfrom;
            $mail->AddAddress(preg_replace('/(\\n+|\\r+|%0A|%0D)/i', '',$mailto));
            $mail->Subject = $subject;
            $mail->msgHTML($content);
            $mail->setLanguage(($_SESSION['language']=='deutsch')?'de':'en', basePath.'/vendor/phpmailer/phpmailer/language/');
            return $mail->Send();
    }

    /**
     * Ersetzt Platzhalter im HTML Code
     * @param string $tpl
     * @param string $dir
     * @param array $array
     * @param array $array_lang_constant
     * @param array $array_block
     * @return mixed|string
     * @internal param bool $addon
     */
    public static function show_runner(string $tpl="", string $dir="", array $array= [], array $array_lang_constant= [], array $array_block= []) {
        if(!empty($tpl) && $tpl != null) {
            $template = basePath."/".$dir.$tpl;
            if(file_exists($template.".html") && is_file($template.".html")) {
                $tpl = file_get_contents($template.".html");
                if (substr($tpl, 0, 3) === pack("CCC", 0xef, 0xbb, 0xbf)) {
                    $tpl = substr($tpl, 3);
                }
            }

            //put placeholders in array
            $array['dir'] = '../inc/_templates_/'.self::$tmpdir;
            $array['idir'] = '../inc/images'; //Image DIR [idir]

            $pholder = explode("^",self::pholderreplace($tpl));
            for($i=0;$i<=count($pholder)-1;$i++) {
                if (in_array($pholder[$i], $array_block) || array_key_exists($pholder[$i], $array) ||
                    (!strstr($pholder[$i], 'lang_') && !strstr($pholder[$i], 'func_'))) {
                    continue;
                }

                if (defined(substr($pholder[$i], 4))) {
                    $array[$pholder[$i]] = (count($array_lang_constant) >= 1 ? show(constant(substr($pholder[$i], 4)), $array_lang_constant) : constant(substr($pholder[$i], 4)));
                    continue;
                }

                if (function_exists(substr($pholder[$i], 5))) {
                    $function = substr($pholder[$i], 5);
                    $array[$pholder[$i]] = $function();
                }
            }

            unset($pholder);

            $tpl = (!self::$chkMe ? preg_replace("|<logged_in>.*?</logged_in>|is", "", $tpl) : preg_replace("|<logged_out>.*?</logged_out>|is", "", $tpl));
            $tpl = str_ireplace(["<logged_in>","</logged_in>","<logged_out>","</logged_out>"], '', $tpl);

            if(count($array) >= 1) {
                foreach($array as $value => $code)
                { $tpl = str_replace('['.$value.']', $code, $tpl); }
            }
        }

        return $tpl;
    }

    /**
     * filter placeholders
     * @param $pholder
     * @return mixed
     */
    public static function pholderreplace(string $pholder) {
        $search = ['@<script[^>]*?>.*?</script>@si','@<style[^>]*?>.*?</style>@siU','@<[\/\!][^<>]*?>@si','@<![\s\S]*?--[ \t\n\r]*>@'];
        $pholder = preg_replace("#<script(.*?)</script>#is","",$pholder);
        $pholder = preg_replace("#<style(.*?)</style>#is","",$pholder);
        $pholder = preg_replace($search, '', $pholder);
        $pholder = str_replace(" ","",$pholder);
        $pholder = preg_replace("#&(.*?);#s","",$pholder);
        $pholder = str_replace("\r","",$pholder);
        $pholder = str_replace("\n","",$pholder);
        $pholder = preg_replace("#\](.*?)\[#is","][",$pholder);
        $pholder = str_replace("][","^",$pholder);
        $pholder = preg_replace("#^(.*?)\[#s","",$pholder);
        $pholder = preg_replace("#\](.*?)$#s","",$pholder);
        $pholder = str_replace("[","",$pholder);
        return str_replace("]","",$pholder);
    }

    /**
     * Userpic ausgeben
     * @param $userid
     * @param int $width
     * @param int $height
     * @return mixed|string
     */
    public static function userpic(int $userid,int $width=170,int $height=210) {
        /* TODO: Use PHPFastCache */
        $smarty = self::getSmarty(true);
        foreach(["jpg", "gif", "png"] as $endung) {
            if (file_exists(basePath . "/inc/images/uploads/userpics/" . $userid . "." . $endung)) {
                $smarty->caching = false;
                $smarty->assign('id',$userid);
                $smarty->assign('endung',$endung);
                $smarty->assign('width',$width);
                $smarty->assign('height',$height);
                $pic = $smarty->fetch('file:['.common::$tmpdir.']page/userpic_link.tpl');
                $smarty->clearAllAssign();
                break;
            } else {
                $smarty->caching = false;
                $smarty->assign('width',$width);
                $smarty->assign('height',$height);
                $pic = $smarty->fetch('file:['.common::$tmpdir.']page/no_userpic.tpl');
                $smarty->clearAllAssign();
            }
        }

        return $pic;
    }

    /**
     * Useravatar ausgeben
     * @param int $uid
     * @param int $width
     * @param int $height
     * @return mixed|string
     */
    public static function useravatar(int $uid=0, int $width=100,int $height=100) {
        $smarty = self::getSmarty(true);
        $uid = ($uid == 0 ? self::$userid : $uid);
        foreach(["jpg", "gif", "png"] as $endung) {
            if (file_exists(basePath . "/inc/images/uploads/useravatare/" . $uid . "." . $endung)) {
                $smarty->caching = false;
                $smarty->assign('id',$uid);
                $smarty->assign('endung',$endung);
                $smarty->assign('width',$width);
                $smarty->assign('height',$height);
                $pic = $smarty->fetch('file:['.common::$tmpdir.']page/userava_link.tpl');
                $smarty->clearAllAssign();
                break;
            } else {
                $smarty->caching = false;
                $smarty->assign('width',$width);
                $smarty->assign('height',$height);
                $pic = $smarty->fetch('file:['.common::$tmpdir.']page/no_userava.tpl');
                $smarty->clearAllAssign();
            }
        }

        return $pic;
    }

    /**
     * @param string $day
     * @param string $month
     * @param string $year
     * @return string
     */
    public static function dropdown_date(string $day, string $month, string $year) {
        $smarty = self::getSmarty(true);
        $smarty->caching = false;
        $smarty->assign('day',$day);
        $smarty->assign('month',$month);
        $smarty->assign('year',$year);
        $dropdown_date = $smarty->fetch('file:['.common::$tmpdir.']page/dropdown_date.tpl');
        $smarty->clearAllAssign();
        return $dropdown_date;
    }

    /**
     * @param string $hour
     * @param string $minute
     * @return string
     */
    public static function dropdown_time(string $hour, string $minute) {
        $smarty = self::getSmarty(true);
        $smarty->caching = false;
        $smarty->assign('hour',$hour);
        $smarty->assign('minute',$minute);
        $dropdown_time = $smarty->fetch('file:['.common::$tmpdir.']page/dropdown_time.tpl');
        $smarty->clearAllAssign();
        return $dropdown_time;
    }

    /**
     * Umfrageantworten selektieren
     * @param $what
     * @param $vid
     * @return string
     */
    public static function voteanswer(string $what, int $vid) {
        //TODO: Cache
        $data = self::$sql['default']->select("SELECT `what`,`sel` FROM `{prefix_vote_results}` WHERE `vid` = ?;", [(int)($vid)]);
        foreach ($data as $value) {
            if(strtolower($value['what']) == strtolower($what)) {
                return $value['sel'];
            }
        }

        return '';
    }

    /**
     * Konvertiert Platzhalter in die jeweiligen bersetzungen
     * @param $name
     * @return mixed|string
     */
    public static function navi_name(string $name) {
        $name = trim($name);
        if(preg_match("#^_(.*?)_$#Uis",$name)) {
            $name = preg_replace("#_(.*?)_#Uis", "$1", $name);
            if (defined("_" . $name)) {
                return constant("_" . $name);
            }
        }

        return $name;
    }
    
    /**
     * @param string $tpl
     * @param array $array
     * @param array $array_lang_constant
     * @param array $array_block
     * @return mixed|string
     */
    public static function show(string $tpl="", array $array= [], array $array_lang_constant= [], array $array_block= []) {
        return self::show_runner($tpl,"inc/_templates_/".self::$tmpdir."/",$array,$array_lang_constant,$array_block);
    }/** @noinspection PhpDocSignatureInspection */

    /**
     * Checkt versch. Dinge anhand der Hostmaske eines Users
     * @param $what
     * @param string $time
     * @return bool
     */
    public static function ipcheck(string $what,int $time = 0) {
        $get = self::$sql['default']->fetch("SELECT `time`,`what` FROM `{prefix_ip_action}` WHERE `what` = ? AND `ip` = ? ORDER BY `time` DESC;", [$what,self::$userip]);
        if(self::$sql['default']->rowCount()) {
            if (preg_match("#vid#", $get['what'])) {
                return true;
            } else {
                if($get['time'] + $time < time()) {
                    self::$sql['default']->delete("DELETE FROM `{prefix_ip_action}` WHERE `what` = ? AND `ip` = ? AND time+?<?;", [$what,self::$userip,$time,time()]);
                }

                return ($get['time'] + $time > time() ? true : false);
            }
        }

        return false;
    }

    /**
     * Setzt bei einem Tag >10 eine 0 vorran (Kalender)
     * @param int $i
     * @return int|mixed|string
     */
    public static function cal(int $i) {
        if (preg_match("=10|20|30=Uis", $i) == FALSE) {
            $i = preg_replace("=0=", "", $i);
        }

        if ($i < 10) {
            $tag_nr = "0" . $i;
        } else {
            $tag_nr = $i;
        }

        return $tag_nr;
    }

    /**
     * Geburtstag errechnen
     * @param int $bday
     * @return bool|string
     */
    public static function getAge(int $bday) {
        if (!empty($bday) && $bday) {
            $bday = date('d.m.Y', $bday);
            list($tiday, $iMonth, $iYear) = explode(".", $bday);
            $iCurrentDay = date('j');
            $iCurrentMonth = date('n');
            $iCurrentYear = date('Y');
            if (($iCurrentMonth > $iMonth) || (($iCurrentMonth == $iMonth) && ($iCurrentDay >= $tiday))) {
                return $iCurrentYear - $iYear;
            } else {
                return $iCurrentYear - ($iYear + 1);
            }
        }

        return '-';
    }

    public static function check_msg_emal() {
        $smarty = self::getSmarty(true);
        if(!is_ajax && !is_thumbgen && !is_api && !self::$CrawlerDetect->isCrawler() && !self::$sql['default']->rows("SELECT `id` FROM `{prefix_iptodns}` WHERE `sessid` = ? AND `bot` = 1;", [session_id()])) {
            $qry = self::$sql['default']->select("SELECT s1.`an`,s1.`page`,s1.`titel`,s1.`sendmail`,s1.`id` AS `mid`, "
                . "s2.`id`,s2.`nick`,s2.`email`,s2.`pnmail` FROM `{prefix_messages}` AS `s1` "
                . "LEFT JOIN `{prefix_users}` AS `s2` ON s2.`id` = s1.`an` WHERE `page` = 0 AND `sendmail` = 0;");
            if(self::$sql['default']->rowCount()) {
                foreach($qry as $get) {
                    if($get['pnmail']) {
                        self::$sql['default']->update("UPDATE `{prefix_messages}` SET `sendmail` = 1 WHERE `id` = ?;", [$get['mid']]);

                        $smarty->caching = false;
                        $smarty->assign('domain',self::$httphost);
                        $subj = $smarty->fetch('string:'.stringParser::decode(settings::get('eml_pn_subj')));
                        $smarty->clearAllAssign();

                        $smarty->caching = false;
                        $smarty->assign('nick',stringParser::decode($get['nick']));
                        $smarty->assign('domain',self::$httphost);
                        $smarty->assign('titel',stringParser::decode($get['titel']));
                        $smarty->assign('clan',stringParser::decode(settings::get('clanname')));
                        $message = $smarty->fetch('string:'.self::bbcode_email(settings::get('eml_pn')));
                        $smarty->clearAllAssign();

                        self::sendMail(stringParser::decode($get['email']), $subj, $message);
                    }
                }
            }
        }
    }

    /**
     * Gibt einen Edit button aus ( button_edit_single.tpl )
     * @param int $id
     * @param string $action
     * @param string $title
     * @return string
     */
    public static function getButtonEditSingle(int $id=0,string $action='',string $title=_button_title_edit) {
        $smarty = self::getSmarty(true); //Use Smarty
        $smarty->caching = true;
        $smarty->assign('id', $id);
        $smarty->assign('action', $action);
        $smarty->assign('title', $title);
        $edit = $smarty->fetch('file:[' . common::$tmpdir . ']page/buttons/button_edit_single.tpl',
            self::getSmartyCacheHash('button_'.$id.'_'.$action));
        $smarty->clearAllAssign();
        return $edit;
    }

    /**
     * Checkt ob ein Ereignis neu ist
     * @param int $datum
     * @param bool $output
     * @param int $datum2
     * @return bool|string
     */
    public static function check_new(int $datum = 0, bool $output=false, int $datum2 = 0) {
        if(self::$userid) {
            $lastvisit = self::userstats('lastvisit', self::$userid);
            if ($datum >= $lastvisit || $datum2 >= $lastvisit) {
                return (!$output ? true : $output);
            }
        }

        return (!$output ? false : '');
    }

    /**
     * DropDown Mens Date/Time
     * @param string $what
     * @param int $wert
     * @param int $age
     * @return string
     */
    public static function dropdown(string $what, int $wert, int $age = 0) {
        if($what == "day") {
            $return = ($age == 1 ? '<option value="" class="dropdownKat">'._day.'</option>'."\n" : '');
            for($i=1; $i<32; $i++) {
                if ($i == $wert) {
                    $return .= "<option value=\"" . $i . "\" selected=\"selected\">" . $i . "</option>\n";
                } else {
                    $return .= "<option value=\"" . $i . "\">" . $i . "</option>\n";
                }
            }
        } else if($what == "month") {
            $return = ($age == 1 ? '<option value="" class="dropdownKat">'._month.'</option>'."\n" : '');
            for($i=1; $i<13; $i++) {
                if ($i == $wert) {
                    $return .= "<option value=\"" . $i . "\" selected=\"selected\">" . $i . "</option>\n";
                } else {
                    $return .= "<option value=\"" . $i . "\">" . $i . "</option>\n";
                }
            }
        } else if($what == "year") {
            if($age == 1) {
                $return ='<option value="" class="dropdownKat">'._year.'</option>'."\n";
                for($i=date("Y",time())-80; $i<date("Y",time())-10; $i++) {
                    if ($i == $wert) {
                        $return .= "<option value=\"" . $i . "\" selected=\"selected\">" . $i . "</option>\n";
                    } else {
                        $return .= "<option value=\"" . $i . "\">" . $i . "</option>\n";
                    }
                }
            } else {
                $return = '';
                for($i=date("Y",time())-3; $i<date("Y",time())+3; $i++) {
                    if ($i == $wert) {
                        $return .= "<option value=\"" . $i . "\" selected=\"selected\">" . $i . "</option>\n";
                    } else {
                        $return .= "<option value=\"" . $i . "\">" . $i . "</option>\n";
                    }
                }
            }
        } else if($what == "hour") {
            $return = '';
            for($i=0; $i<24; $i++) {
                if ($i == $wert) {
                    $return .= "<option value=\"" . $i . "\" selected=\"selected\">" . $i . "</option>\n";
                } else {
                    $return .= "<option value=\"" . $i . "\">" . $i . "</option>\n";
                }
            }
        } else if($what == "minute") {
            $return = '';
            for($i="00"; $i<60; $i++) {
                if($i == 0 || $i == 15 || $i == 30 || $i == 45) {
                    if ($i == $wert) {
                        $return .= "<option value=\"" . $i . "\" selected=\"selected\">" . $i . "</option>\n";
                    } else {
                        $return .= "<option value=\"" . $i . "\">" . $i . "</option>\n";
                    }
                }
            }
        }

        return $return;
    }

    /**
     * Funktion um Ausgaben zu kuerzen
     * @param string $str
     * @param int|null $length
     * @param bool $dots
     * @return string
     */
    public static function cut(string $str, int $length = null, bool $dots = true) {
        if($length === 0)
            return '';

        $start = 0;
        $dots = ($dots == true && strlen(html_entity_decode($str)) > $length) ? '...' : '';

        if(strpos($str, '&') === false)
            return (($length === null) ? substr($str, $start) : substr($str, $start, $length)).$dots;

        $chars = preg_split('/(&[^;\s]+;)|/', $str, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_OFFSET_CAPTURE);
        $html_length = count($chars);

        if(($html_length === 0) || ($start >= $html_length) || (isset($length) && ($length <= -$html_length)))
            return '';

        if($start >= 0)
            $real_start = $chars[$start][1];
        else {
            $start = max($start,-$html_length);
            $real_start = $chars[$html_length+$start][1];
        }

        if (!isset($length))
            return substr($str, $real_start).$dots;
        else if($length > 0)
            return (($start+$length >= $html_length) ? substr($str, $real_start) : substr($str, $real_start, $chars[max($start,0)+$length][1] - $real_start)).$dots;
        else
            return substr($str, $real_start, $chars[$html_length+$length][1] - $real_start).$dots;
    }

    /**
     * Ausgabe der Position des einzelnen Members
     * @param int $tid
     * @param int $squad
     * @param bool $profil
     * @return string
     */
    public static function getrank(int $tid=0, int $squad=0, bool $profil=false) {
        $tid = (!$tid ? self::$userid : $tid);
        if(!$tid) return '* No UserID! *';
        if($squad) {
            if ($profil) {
                $qry = self::$sql['default']->select("SELECT s1.`posi`,s2.`name` FROM `{prefix_userposis}` AS `s1` LEFT JOIN `{prefix_groups}` AS `s2` ON s1.`group` = s2.`id` "
                    . "WHERE s1.`user` = ? AND s1.`group` = ? AND s1.`posi` != 0;", [(int)($tid),(int)($squad)]);
            } else {
                $qry = self::$sql['default']->select("SELECT `posi` FROM `{prefix_userposis}` WHERE `user` = ? AND `group` = ? AND `posi` != 0;", [(int)($tid),(int)($squad)]);
            }

            if(self::$sql['default']->rowCount()) {
                foreach($qry as $get) {
                    $position = self::$sql['default']->fetch("SELECT `position` FROM `{prefix_positions}` WHERE `id` = ?;", [(int)($get['posi'])],'position');
                    $squadname = (!empty($get['name']) ? '<b>' . $get['name'] . ':</b> ' : '');
                    return ($squadname.$position);
                }
            } else {
                $get = self::$sql['default']->fetch("SELECT `level`,`banned` FROM `{prefix_users}` WHERE `id` = ?;", [(int)($tid)]);
                if (!$get['level'] && !$get['banned']) {
                    return _status_unregged;
                } elseif ($get['level'] == 1) {
                    return _status_user;
                } elseif ($get['level'] == 2) {
                    return _status_trial;
                } elseif ($get['level'] == 3) {
                    return _status_member;
                } elseif ($get['level'] == 4) {
                    return _status_admin;
                } elseif (!$get['level'] && $get['banned']) {
                    return _status_banned;
                } else {
                    return _gast;
                }
            }
        } else {
            $get = self::$sql['default']->fetch("SELECT s1.*,s2.`position` FROM `{prefix_userposis}` AS `s1` LEFT JOIN `{prefix_positions}` AS `s2` "
                . "ON s1.`posi` = s2.`id` WHERE s1.`user` = ? AND s1.`posi` != 0 ORDER BY s2.pid ASC;", [(int)($tid)]);
            if(self::$sql['default']->rowCount()) {
                return $get['position'];
            } else {
                $get = self::$sql['default']->fetch("SELECT `level`,`banned` FROM `{prefix_users}` WHERE `id` = ?;", [(int)($tid)]);
                if (!$get['level'] && !$get['banned']) {
                    return _status_unregged;
                } elseif ($get['level'] == 1) {
                    return _status_user;
                } elseif ($get['level'] == 2) {
                    return _status_trial;
                } elseif ($get['level'] == 3) {
                    return _status_member;
                } elseif ($get['level'] == 4) {
                    return _status_admin;
                } elseif (!$get['level'] && $get['banned']) {
                    return _status_banned;
                } else {
                    return _gast;
                }
            }
        }
    }

    /**
     * Gibt Informationen uber Server und Ausfuhrungsumgebung zuruck
     * @param string $var
     * @return string
     */
    public static function GetServerVars(string $var) {
        if (array_key_exists($var, $_SERVER) && !empty($_SERVER[$var])) {
            return utf8_encode($_SERVER[$var]);
        } else if (array_key_exists($var, $_ENV) && !empty($_ENV[$var])) {
            return utf8_encode($_ENV[$var]);
        }

        if($var=='HTTP_REFERER') { //Fix for empty HTTP_REFERER
            return self::GetServerVars('REQUEST_SCHEME').'://'.self::GetServerVars('HTTP_HOST').
            self::GetServerVars('DOCUMENT_URI');
        }

        return false;
    }

    /**
     * Funktion um Dateien aus einem Verzeichnis auszulesen
     * @param string|null $dir
     * @param bool $only_dir
     * @param bool $only_files
     * @param array $file_ext
     * @param bool $preg_match
     * @param array $blacklist
     * @param bool $blacklist_word
     * @return array
     */
    public static function get_files(string $dir=null, bool $only_dir=false, bool $only_files=false, array $file_ext= [], bool $preg_match=false, array $blacklist= [], bool $blacklist_word=false) {
        $files = [];
        if(!file_exists($dir) && !is_dir($dir)) return $files;
        if($handle = @opendir($dir)) {
            if($only_dir) {
                while(false !== ($file = readdir($handle))) {
                    if($file != '.' && $file != '..' && !is_file($dir.'/'.$file)) {
                        if(!count($blacklist) && (!$blacklist_word || strpos(strtolower($file), $blacklist_word) === false) && ($preg_match ? preg_match($preg_match,$file) : true))
                            $files[] = $file;
                        else {
                            if(!in_array($file, $blacklist) && (!$blacklist_word || strpos(strtolower($file), $blacklist_word) === false) && ($preg_match ? preg_match($preg_match,$file) : true))
                                $files[] = $file;
                        }
                    }
                } //while end
            } else if($only_files) {
                while(false !== ($file = readdir($handle))) {
                    if($file != '.' && $file != '..' && is_file($dir.'/'.$file)) {
                        if(!in_array($file, $blacklist) && (!$blacklist_word || strpos(strtolower($file), $blacklist_word) === false) && !count($file_ext) && ($preg_match ? preg_match($preg_match,$file) : true))
                            $files[] = $file;
                        else {
                            ## Extension Filter ##
                            $exp_string = array_reverse(explode(".", $file));
                            if(!in_array($file, $blacklist) && (!$blacklist_word || strpos(strtolower($file), $blacklist_word) === false) && in_array(strtolower($exp_string[0]), $file_ext) && ($preg_match ? preg_match($preg_match,$file) : true))
                                $files[] = $file;
                        }
                    }
                } //while end
            } else {
                while(false !== ($file = readdir($handle))) {
                    if($file != '.' && $file != '..' && is_file($dir.'/'.$file)) {
                        if(!in_array($file, $blacklist) && (!$blacklist_word || strpos(strtolower($file), $blacklist_word) === false) && !count($file_ext) && ($preg_match ? preg_match($preg_match,$file) : true))
                            $files[] = $file;
                        else {
                            ## Extension Filter ##
                            $exp_string = array_reverse(explode(".", $file));
                            if(!in_array($file, $blacklist) && (!$blacklist_word || strpos(strtolower($file), $blacklist_word) === false) && in_array(strtolower($exp_string[0]), $file_ext) && ($preg_match ? preg_match($preg_match,$file) : true))
                                $files[] = $file;
                        }
                    } else {
                        if(!in_array($file, $blacklist) && (!$blacklist_word || strpos(strtolower($file), $blacklist_word) === false) && $file != '.' && $file != '..' && ($preg_match ? preg_match($preg_match,$file) : true))
                            $files[] = $file;
                    }
                } //while end
            }

            if(is_resource($handle))
                closedir($handle);

            if(!count($files))
                return false;

            return $files;
        }
        else
            return false;
    }

    /**
     * Generiert eine XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX unique id
     * @return string
     */
    public static function GenGuid() {
        $s = strtoupper(md5(uniqid(rand(),true)));
        return substr($s,0,8) .'-'.substr($s,8,4).'-'.substr($s,12,4).'-'.substr($s,16,4).'-'. substr($s,20);
    }

    /**
     * Checkt welcher User gerade noch online ist
     * @param int $tid
     * @return string
     */
    public static function onlinecheck(int $tid = 0) {
        $tid = !$tid ? self::$userid : $tid;
        $row = self::$sql['default']->rows("SELECT `id` FROM `{prefix_users}` WHERE `id` = ? AND (time+1800)>? AND `online` = 1;", [(int)($tid),time()]);
        return $row ? "<img src=\"../inc/images/online.png\" alt=\"\" class=\"icon\" />" : "<img src=\"../inc/images/offline.png\" alt=\"\" class=\"icon\" />";
    }

    /**
     * Session fuer den letzten Besuch setzen
     * @param int $userid
     */
    public static function set_lastvisit(int $userid = 0) {
        $userid = !$userid ? self::$userid : $userid;
        if(!self::$sql['default']->rows("SELECT `id` FROM `{prefix_users}` WHERE `id` = ? AND (time+1800)>?;", [(int)($userid),time()])) {
            $_SESSION['lastvisit'] = (int)(self::data("time"));
        }
    }

    /**
     * Pruft eine IP gegen eine IP-Range
     * @param ipv4|string $ip
     * @param string $range $range
     * @return bool
     */
    public static function validateIpV4Range(string $ip,string $range) {
        if (!is_array($range)) {
            $counter = 0;
            $tip = explode('.', $ip);
            $rip = explode('.', $range);
            foreach ($tip as $targetsegment) {
                $rseg = $rip[$counter];
                $rseg = preg_replace('=(\[|\])=', '', $rseg);
                $rseg = explode('-', $rseg);
                if (!isset($rseg[1])) {
                    $rseg[1] = $rseg[0];
                }

                if ($targetsegment < $rseg[0] || $targetsegment > $rseg[1]) {
                    return false;
                }
                $counter++;
            }
        } else {
            foreach ($range as $range_num) {
                $counter = 0;
                $tip = explode('.', $ip);
                $rip = explode('.', $range_num);
                foreach ($tip as $targetsegment) {
                    $rseg = $rip[$counter];
                    $rseg = preg_replace('=(\[|\])=', '', $rseg);
                    $rseg = explode('-', $rseg);
                    if (!isset($rseg[1])) {
                        $rseg[1] = $rseg[0];
                    }

                    if ($targetsegment < $rseg[0] || $targetsegment > $rseg[1]) {
                        return false;
                    }
                    $counter++;
                }
            }
        }

        return true;
    }

    /**
     * Gibt die IP des Besuchers / Users zuruck
     * Forwarded IP Support
     */
    public static function visitorIp() {
        $SetIP = '0.0.0.0';
        $ServerVars = ['REMOTE_ADDR','HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED',
            'HTTP_FORWARDED_FOR','HTTP_FORWARDED','HTTP_VIA','HTTP_X_COMING_FROM','HTTP_COMING_FROM'];
        foreach ($ServerVars as $ServerVar) {
            if($IP=self::detectIP($ServerVar)) {
                if (self::isIP($IP) && !self::validateIpV4Range($IP, '[192].[168].[0-255].[0-255]') &&
                    !self::validateIpV4Range($IP, '[127].[0].[0-255].[0-255]') &&
                    !self::validateIpV4Range($IP, '[10].[0-255].[0-255].[0-255]') &&
                    !self::validateIpV4Range($IP, '[172].[16-31].[0-255].[0-255]')) {
                    return $IP;
                } else {
                    $SetIP = $IP;
                }

                //IPV6
                if(self::isIP($IP, true)) { return $IP; }
            }
        }

        return $SetIP;
    }

    /**
     * @param $var
     * @return bool|string
     */
    public static function detectIP($var) {
        if(!empty($var) && ($REMOTE_ADDR = self::GetServerVars($var)) && !empty($REMOTE_ADDR)) {
            $REMOTE_ADDR = trim($REMOTE_ADDR);
            if (self::isIP($REMOTE_ADDR) || self::isIP($REMOTE_ADDR, true)) {
                return $REMOTE_ADDR;
            }
        }

        return false;
    }

    /**
     * Check given ip for ipv6 or ipv4.
     * @param    string        $ip
     * @param    boolean       $v6
     * @return   boolean
     */
    public static function isIP(string $ip,bool $v6=false) {
        if (!$v6 && $ip == "0.0.0.0") { return false; }
        if(!$v6 && substr_count($ip,":") < 1) {
            return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ? true : false;
        }

        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) ? true : false;
    }

    /**
     * Pruft ob die IP gesperrt und gultig ist
     */
    public static function check_ip() {
        if(!dbc_index::issetIndex('ip_check')) {
            dbc_index::setIndex('ip_check', []);
        }

        if(!self::isIP(self::$userip, true)) {
            if((!self::isIP(self::$userip) && !self::isIP(self::$userip,true)) || self::$userip == false || empty(self::$userip)) {
                self::dzcp_session_destroy();
                die('Deine IP ist ung&uuml;ltig!<p>Your IP is invalid!');
            }

            if(empty(self::$UserAgent)) {
                self::dzcp_session_destroy();
                die("Script wird nicht ausgef&uuml;hrt, da kein User Agent &uuml;bermittelt wurde.\n");
            }

            //Banned IP
            if(!dbc_index::getIndexKey('ip_check', md5(self::$userip))) {
                $ips = dbc_index::getIndex('ip_check');
                foreach(self::$sql['default']->select("SELECT `id`,`typ`,`data` FROM `{prefix_ipban}` WHERE `ip` = ? AND `enable` = 1;", [self::$userip]) as $banned_ip) {
                    if($banned_ip['typ'] == 2 || $banned_ip['typ'] == 3) {
                        self::dzcp_session_destroy();
                        $banned_ip['data'] = unserialize($banned_ip['data']);
                        die('Deine IP ist gesperrt!<p>Your IP is banned!<p>MSG: '.$banned_ip['data']['banned_msg']);
                    }
                }
                unset($banned_ip);

                if((ini_get('allow_url_fopen') == 1) && self::isIP(self::$userip) && !self::validateIpV4Range(self::$userip, '[192].[168].[0-255].[0-255]') &&
                    !self::validateIpV4Range(self::$userip, '[127].[0].[0-255].[0-255]') &&
                    !self::validateIpV4Range(self::$userip, '[10].[0-255].[0-255].[0-255]') &&
                    !self::validateIpV4Range(self::$userip, '[172].[16-31].[0-255].[0-255]')) {
                    sfs::check(); //SFS Update
                    if(sfs::is_spammer()) {
                        self::$sql['default']->delete("DELETE FROM `{prefix_iptodns}` WHERE `sessid` = ?;",
                            [session_id()]);
                        self::dzcp_session_destroy();
                        die('Deine IP-Adresse ist auf <a href="http://www.stopforumspam.com/" target="_blank">http://www.stopforumspam.com/</a> gesperrt, die IP wurde zu oft fÃ¼r Spam Angriffe auf Webseiten verwendet.<p>
                             Your IP address is known on <a href="http://www.stopforumspam.com/" target="_blank">http://www.stopforumspam.com/</a>, your IP has been used for spam attacks on websites.');
                    }
                }

                $ips[md5(self::$userip)] = true;
                dbc_index::setIndex('ip_check', $ips, 30);
            }
        }
    }

    /**
     * Loscht und erstellt eine neue session
     */
    public static final function dzcp_session_destroy() {
        $_SESSION['id']        = '';
        $_SESSION['pwd']       = '';
        $_SESSION['ip']        = '';
        $_SESSION['lastvisit'] = '';
        $_SESSION['akl_id']    = 0;
        session_unset();
        session_destroy();
        session_regenerate_id();
        cookie::clear();
    }

    /**
     * Passwort in md5 oder sha1 bis 512 codieren
     * @param $password
     * @param int $encoder
     * @return string
     */
    public static final function pwd_encoder(string $password,int $encoder=-1) {
        $encoder = ($encoder != -1 ? $encoder :
            settings::get('default_pwd_encoder'));
        switch ($encoder) {
            case 0: return md5($password);
            case 1: return sha1($password);
            default:
            case 3: return hash('sha256', $password);
            case 2: return hash('sha512', $password);
        }
    }

    /**
     * Funktion um notige Erweiterungen zu prufen
     * @return boolean
     **/
    public static function fsockopen_support() {
        return ((!fsockopen_support_bypass && (self::disable_functions('fsockopen') || self::disable_functions('fopen'))) ? false : true);
    }

    /**
     * @param string $function
     * @return bool
     */
    public static function disable_functions(string $function='') {
        if (!function_exists($function)) { return true; }
        $disable_functions = ini_get('disable_functions');
        if (empty($disable_functions)) { return false; }
        $disabled_array = explode(',', $disable_functions);
        foreach ($disabled_array as $disabled) {
            if (strtolower(trim($function)) == strtolower(trim($disabled))) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $address
     * @param int $port
     * @param int $timeout
     * @param bool $udp
     * @return bool
     */
    public static function ping_port(string $address='',int $port=0000,int $timeout=2,bool $udp=false) {
        if (!self::fsockopen_support()) {
            return false;
        }

        $errstr = NULL; $errno = NULL;
        if(!$ip = self::DNSToIp($address)) {
            return false;
        }

        if($fp = @fsockopen(($udp ? "udp://".$ip : $ip), $port, $errno, $errstr, $timeout)) {
            unset($ip,$port,$errno,$errstr,$timeout);
            fclose($fp);
            return true;
        }

        return false;
    }

    /**
     * Funktion um eine Datei im Web auf Existenz zu prufen und abzurufen
     * @param string $url
     * @param bool $post
     * @param bool $nogzip
     * @param int $timeout
     * @return String
     */
    public static function get_external_contents(string $url,bool $post=false,bool $nogzip=false,int $timeout=file_get_contents_timeout) {
        if((!(ini_get('allow_url_fopen') == 1) && !use_curl || (use_curl && !extension_loaded('curl'))))
            return false;

        $url_p = @parse_url($url);
        $host = $url_p['host'];
        $port = isset($url_p['port']) ? $url_p['port'] : 80;
        $port = (($url_p['scheme'] == 'https' && $port == 80) ? 443 : $port);
        if(!self::ping_port($host,$port,$timeout)) return false;
        unset($host);

        if(class_exists('\\Snoopy\\Snoopy') && $url_p['scheme'] != 'https') { //Use Snoopy HTTP Client
            $snoopy = new Snoopy\Snoopy;
            if(count($post) >= 1 && $post != false) {
                $snoopy->rawheaders["Pragma"] = "no-cache";
                $snoopy->submit($url, $post);
            } else {
                $snoopy->rawheaders["Pragma"] = "no-cache";
                if (!$snoopy->fetch($url)) {
                    return false;
                }
            }

            return ((string)(trim($snoopy->results)));
        }

        if(use_curl && extension_loaded('curl')) {
            if(!$curl = curl_init())
                return false;

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_AUTOREFERER, true);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
            curl_setopt($curl, CURLOPT_USERAGENT, "DZCP-HTTP-CLIENT");
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT , $timeout);
            curl_setopt($curl, CURLOPT_TIMEOUT, $timeout * 2); // x 2

            //For POST
            if(count($post) >= 1 && $post != false) {
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
                curl_setopt($curl, CURLOPT_VERBOSE , 0 );
            }

            $gzip = false;
            if(function_exists('gzinflate') && !$nogzip) {
                $gzip = true;
                curl_setopt($curl, CURLOPT_HTTPHEADER, ['Accept-Encoding: gzip,deflate']);
                curl_setopt($curl, CURLINFO_HEADER_OUT, true);
            }

            if($url_p['scheme'] == 'https') { //SSL
                curl_setopt($curl, CURLOPT_PORT , $port);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            }

            $content = curl_exec($curl);
            if (empty($content) || (is_bool($content) && !$content)) {
                return false;
            }

            if($gzip) {
                $curl_info = curl_getinfo($curl,CURLINFO_HEADER_OUT);
                if(stristr($curl_info, 'accept-encoding') && stristr($curl_info, 'gzip')) {
                    $content = gzinflate( substr($content,10,-8) );
                }
            }

            @curl_close($curl);
            unset($curl);
        } else {
            if($url_p['scheme'] == 'https') //HTTPS not Supported!
                $url = str_replace('https', 'http', $url);

            $opts = [];
            $opts['http']['method'] = "GET";
            $opts['http']['timeout'] = $timeout * 2;

            $gzip = false;
            if(function_exists('gzinflate') && !$nogzip) {
                $gzip = true;
                $opts['http']['header'] = 'Accept-Encoding:gzip,deflate'."\r\n";
            }

            $context = stream_context_create($opts);
            if(!$content = @file_get_contents($url, false, $context, -1, 40000))
                return false;

            if($gzip) {
                foreach($http_response_header as $c => $h) {
                    if(stristr($h, 'content-encoding') && stristr($h, 'gzip')) {
                        $content = gzinflate( substr($content,10,-8) );
                    }
                }
            }
        }

        return ((string)(trim($content)));
    }

    /**
     * Verschlusselt eine E-Mail Adresse per Javascript
     * @param string $email
     * @param string $template
     * @param array $custom
     * @return string
     */
    public static function CryptMailto(string $email='',string $template=_emailicon,array $custom= []) {
        $smarty = self::getSmarty(true); //Use Smarty
        if(empty($template) || empty($email) || !self::permission("editusers")) return '';
        $character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz';
        $key = str_shuffle($character_set); $cipher_text = ''; $id = 'e'.rand(1,999999999);
        for ($i=0;$i<strlen($email);$i+=1) $cipher_text.= $key[strpos($character_set,$email[$i])];
        $script = 'var a="'.$key.'";var b=a.split("").sort().join("");var c="'.$cipher_text.'";var d="";';
        $script.= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));';
        if(!empty($custom) && count($custom) >= 1) {
            $smarty->caching = false;
            foreach ($custom as $key => $var) {
                $smarty->assign($key,$var);
            }

            $template = $smarty->fetch('string:'.$template);
            $smarty->clearAllAssign();
        }

        $script.= 'document.getElementById("'.$id.'").innerHTML="'.$template.'"';
        $script = "eval(\"".str_replace(["\\",'"'], ["\\\\",'\"'], $script)."\")";
        $script = '<script type="text/javascript">/*<![CDATA[*/'.$script.'/*]]>*/</script>';
        return '<span id="'.$id.'">[javascript protected email address]</span>'.$script;
    }

    /**
     * Schreibe in die IPCheck Tabelle
     * @param string $what
     * @param bool $time
     */
    public static function setIpcheck(string $what = '',bool $time = true) {
        self::$sql['default']->insert("INSERT INTO `{prefix_ip_action}` SET `ip` = ?, `user_id` = ?, `what` = ?, `time` = ?, `created` = ?;",
            [self::visitorIp(),(int)(self::userid()),$what,($time ? time() : 0),time()]);
    }

    /**
     * Preuft ob alle clicks nur einmal gezahlt werden *gast/user
     * @param string $side_tag
     * @param int $clickedID
     * @param bool $update
     * @return bool
     */
    public static function count_clicks(string $side_tag='',int $clickedID=0,bool $update=true) {
        if(!self::$CrawlerDetect->isCrawler()) {
            $qry = self::$sql['default']->select("SELECT `id`,`side` FROM `{prefix_clicks_ips}` WHERE `uid` = 0 AND `time` <= ?;", [time()]);
            if(self::$sql['default']->rowCount()) {
                foreach($qry as $get) {
                    if($get['side'] != 'vote') {
                        self::$sql['default']->delete("DELETE FROM `{prefix_clicks_ips}` WHERE `id` = ?;", [$get['id']]);
                    }
                }
            }

            if(self::$chkMe != 'unlogged') {
                if (self::$sql['default']->rows("SELECT `id` FROM `{prefix_clicks_ips}` WHERE `uid` = ? AND `ids` = ? AND `side` = ?;", [(int)(self::$userid),(int)($clickedID),$side_tag])) {
                    return false;
                }

                if(self::$sql['default']->rows("SELECT `id` FROM `{prefix_clicks_ips}` WHERE `ip` = ? AND `ids` = ? AND `side` = ?;", [self::$userip,(int)($clickedID),$side_tag])) {
                    if($update) {
                        self::$sql['default']->update("UPDATE `{prefix_clicks_ips}` SET `uid` = ?, `time` = ? WHERE `ip` = ? AND `ids` = ? AND `side` = ?;",
                            [(int)(self::$userid),(time()+count_clicks_expires),self::$userip,(int)($clickedID),$side_tag]);
                    }

                    return false;
                } else {
                    if($update) {
                        self::$sql['default']->insert("INSERT INTO `{prefix_clicks_ips}` SET `ip` = ?, `uid` = ?, `ids` = ?, `side` = ?, `time` = ?;",
                            [self::$userip, (int)(self::$userid), (int)($clickedID), $side_tag, (time() + count_clicks_expires)]);
                    }

                    return true;
                }
            } else {
                if(!self::$sql['default']->rows("SELECT id FROM `{prefix_clicks_ips}` WHERE `ip` = ? AND `ids` = ? AND `side` = ?;", [self::$userip,(int)($clickedID),$side_tag])) {
                    if($update) {
                        self::$sql['default']->insert("INSERT INTO `{prefix_clicks_ips}` SET `ip` = ?, `uid` = 0, `ids` = ?, `side` = ?, `time` = ?;",
                            [self::$userip,(int)($clickedID),$side_tag,(time()+count_clicks_expires)]);
                    }

                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Rechte abfragen
     * @param int $checkID
     * @param int $pos
     * @return string
     */
    public static function getPermissions(int $checkID = 0, int $pos = 0) {
        //Rechte des Users oder des Teams suchen
        if(!empty($checkID)) {
            $check = empty($pos) ? 'user' : 'pos'; $checked = [];
            $qry = self::$sql['default']->fetch("SELECT * FROM `{prefix_permissions}` WHERE `".$check."` = ?;", [(int)($checkID)]);
            if (self::$sql['default']->rowCount()) {
                foreach($qry as $k => $v) {
                    if($k != 'id' && $k != 'user' && $k != 'pos' && $k != 'intforum') {
                        $checked[$k] = $v;
                    }
                }
            }
        }

        //Liste der Rechte zusammenstellen
        $permission = [];
        $qry = self::$sql['default']->show("SHOW COLUMNS FROM `dzcp_permissions`;");
        if(self::$sql['default']->rowCount()) {
            foreach($qry as $get) {
                if($get['Field'] != 'id' && $get['Field'] != 'user' && $get['Field'] != 'pos' && $get['Field'] != 'intforum') {
                    $lang = constant('_perm_'.$get['Field']);
                    $chk = empty($checked[$get['Field']]) ? '' : ' checked="checked"';
                    $permission[$lang] = '<input type="checkbox" class="checkbox" id="'.$get['Field'].'" name="perm[p_'.$get['Field'].']" value="1"'.$chk.' /><label for="'.$get['Field'].'"> '.$lang.'</label> ';
                }
            }
        }

        $permissions = '';
        if(count($permission)) {
            natcasesort($permission); $break = 1;
            foreach($permission AS $perm) {
                $br = ($break % 2) ? '<br />' : ''; $break++;
                $permissions .= $perm.$br;
            }
        }

        return $permissions;
    }

    /**
     * interne Foren-Rechte abfragen
     * @param int $checkID
     * @param int $pos
     * @return string
     */
    public static function getBoardPermissions(int $checkID = 0,int $pos = 0) {
        $break = 0; $i_forum = ''; $fkats = '';
        $qry = self::$sql['default']->select("SELECT `id`,`name` FROM `{prefix_forumkats}` WHERE `intern` = 1 ORDER BY `kid` ASC;");
        if(self::$sql['default']->rowCount()) {
            foreach($qry as $get) {
                unset($kats, $fkats, $break);
                $kats = (empty($katbreak) ? '' : '<div style="clear:both">&nbsp;</div>').'<table class="hperc" cellspacing="1"><tr><td class="contentMainTop"><b>'.stringParser::decode($get["name"]).'</b></td></tr></table>';
                $katbreak = 1; $break = 0; $fkats = '';

                $qry2 = self::$sql['default']->select("SELECT `kattopic`,`id` FROM `{prefix_forumsubkats}` WHERE `sid` = ? ORDER BY `kattopic` ASC;", [$get['id'],]);
                if(self::$sql['default']->rowCount()) {
                    foreach($qry2 as $get2) {
                        $br = ($break % 2) ? '<br />' : ''; $break++;
                        $chk = (self::$sql['default']->rows("SELECT `id` FROM `{prefix_forum_access}` WHERE `".(empty($pos) ? 'user' : 'pos')."` = ? AND ".(empty($pos) ? 'user' : 'pos')." != 0 AND `forum` = ?;", [(int)($checkID),$get2['id']]) ? ' checked="checked"' : '');
                        $fkats .= '<input type="checkbox" class="checkbox" id="board_'.$get2['id'].'" name="board['.$get2['id'].']" value="'.$get2['id'].'"'.$chk.' /><label for="board_'.$get2['id'].'"> '.stringParser::decode($get2['kattopic']).'</label> '.$br;
                    }
                }

                $i_forum .= $kats.$fkats;
            }
        }

        return $i_forum;
    }
    
    /**
     * Adminberechtigungen ueberpruefen
     * @param int $userid
     * @return bool
     */
    public static function admin_perms(int $userid) {
        if (empty($userid)) {
            return false;
        }

        if(self::rootAdmin($userid) || self::$chkMe == 4) {
            return true;
        }

        // no need for these admin areas & check user permission
        $e = ['editusers', 'votes', 'contact', 'intnews', 'forum', 'dlintern','intforum'];
        $qry = self::$sql['default']->fetch("SELECT * FROM `{prefix_permissions}` WHERE `user` = ?;", [(int)($userid)]);
        if(self::$sql['default']->rowCount()) {
            foreach($qry as $v => $k) {
                if($v != 'id' && $v != 'user' && $v != 'pos' && !in_array($v, $e)) {
                    if($k == 1) {
                        return true;
                        break;
                    }
                }
            }
        }

        // check rank permission
        $qry = self::$sql['default']->select("SELECT s1.* FROM `{prefix_permissions}` AS `s1` LEFT JOIN `{prefix_userposis}` AS `s2` ON s1.`pos` = s2.`posi` WHERE s2.`user` = ? AND s2.`posi` != 0;",
            [(int)($userid)]);
        foreach($qry as $get) {
            foreach($get AS $v => $k) {
                if($v != 'id' && $v != 'user' && $v != 'pos' && !in_array($v, $e)) {
                    if($k == 1) {
                        return true;
                        break;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Zugriffsberechtigung auf die Seite
     * @return bool
     */
    public static function check_internal_url() {
        if (self::$chkMe >= 1) {
            return false;
        }
        $install_pfad = explode("/",dirname(dirname(self::GetServerVars('SCRIPT_NAME'))."../"));
        $now_pfad = explode("/",self::GetServerVars('REQUEST_URI')); $pfad = '';
        foreach($now_pfad as $key => $value) {
            if(!empty($value)) {
                if(!isset($install_pfad[$key]) || $value != $install_pfad[$key]) {
                    $pfad .= "/".$value;
                }
            }
        }

        list($pfad) = explode('&',$pfad);
        $pfad = "..".$pfad;

        if (strpos($pfad, "?") === false && strpos($pfad, ".php") === false) {
            $pfad .= "/";
        }

        if (strpos($pfad, "index.php") !== false) {
            $pfad = str_replace('index.php', '', $pfad);
        }

        $url = $pfad.'index.php';
        $get_navi = self::$sql['default']->fetch("SELECT `internal` FROM `{prefix_navi}` WHERE `url` = ? OR `url` = ?;", [$pfad,$url]);
        if(self::$sql['default']->rowCount()) {
            if ($get_navi['internal']) {
                return true;
            }
        }

        return false;
    }

    /**
     * Checkt, ob neue Nachrichten vorhanden sind
     * @return bool|mixed|string
     */
    public static function check_msg() {
        if(self::$sql['default']->rows("SELECT `id` FROM `{prefix_messages}` WHERE `an` = ? AND `page` = 0;", [(int)($_SESSION['id'])])) {
            self::$sql['default']->update("UPDATE `{prefix_messages}` SET `page` = 1 WHERE `an` = ?;", [(int)($_SESSION['id'])]);
            $smarty = self::getSmarty(true);
            $smarty->caching = false;
            $msg = $smarty->fetch('file:['.common::$tmpdir.']user/msg/new_msg.tpl');
            $smarty->clearAllAssign();
            return $msg;
        }

        return '';
    }

    /**
     * Flaggen ausgeben
     * @param string $code
     * @return string
     */
    public static function flag(string $code) {
        if (empty($code)) {
            return '<img src="../inc/images/flaggen/nocountry.gif" alt="" class="icon" />';
        }

        foreach(["jpg", "gif", "png"] as $end) {
            if (file_exists(basePath . "/inc/images/flaggen/" . $code . "." . $end)) {
                break;
            }
        }

        if (file_exists(basePath . "/inc/images/flaggen/" . $code . "." . $end)) {
            return'<img src="../inc/images/flaggen/' . $code . '.' . $end . '" alt="" class="icon" />';
        }

        return '<img src="../inc/images/flaggen/nocountry.gif" alt="" class="icon" />';
    }

    /**
     * @param $code
     * @return string
     */
    public static function rawflag($code) {
        if (empty($code)) {
            return '<img src=../inc/images/flaggen/nocountry.gif alt= class=icon />';
        }

        foreach(["jpg", "gif", "png"] as $end) {
            if (file_exists(basePath . "/inc/images/flaggen/" . $code . "." . $end)) {
                break;
            }
        }

        if (file_exists(basePath . "/inc/images/flaggen/" . $code . "." . $end)) {
            return '<img src=../inc/images/flaggen/' . $code . '.' . $end . ' alt= class=icon />';
        }

        return '<img src=../inc/images/flaggen/nocountry.gif alt= class=icon />';
    }

    /**
     * Aktualisierung des Online Status *preview
     */
    public static function update_user_status_preview() {
        ## User aus der Datenbank suchen ##
        $get = self::$sql['default']->fetch("SELECT `id`,`time` FROM `{prefix_users}` "
            . "WHERE `id` = ? AND `sessid` = ? AND `ip` = ? AND level != 0;",
            [(int)($_SESSION['id']),session_id(),stringParser::encode(self::$userip)]);

        if(self::$sql['default']->rowCount()) {
            ## Schreibe Werte in die Server Sessions ##
            $_SESSION['lastvisit']  = $get['time'];

            if(stringParser::decode(self::data("ip",$get['id'])) != $_SESSION['ip'])
                $_SESSION['lastvisit'] = self::data($get['id'], "time");

            if(empty($_SESSION['lastvisit']))
                $_SESSION['lastvisit'] = self::data($get['id'], "time");

            ## Aktualisiere Datenbank ##
            self::$sql['default']->update("UPDATE `{prefix_users}` SET `online` = 1 WHERE `id` = ?;", [$get['id']]);
        }
    }

    /**
     * Prueft, ob der User gesperrt ist und meldet ihn ab
     * @param int $userid_set
     * @param bool $logout
     * @return bool
     */
    public static function isBanned(int $userid_set=0,bool $logout=true) {
        $userid_set = $userid_set ? $userid_set : self::$userid;
        if(self::checkme($userid_set) >= 1 || $userid_set) {
            $get = self::$sql['default']->fetch("SELECT `banned` FROM `{prefix_users}` WHERE `id` = ? LIMIT 1;", [(int)($userid_set)]);
            if($get['banned']) {
                if($logout) {
                    self::dzcp_session_destroy();
                }

                return true;
            }
        }

        return false;
    }

    /**
     * Prueft, ob ein User diverse Rechte besitzt
     * @param string $check
     * @param int $uid
     * @return bool
     */
    public static function permission(string $check,int $uid=0) {
        //TODO: Add Live Cache
        if (!$uid) { $uid = self::$userid; }
        if(self::rootAdmin($uid))
            return true;

        if(self::$chkMe == 4) {
            return true;
        } else {
            if ($uid) {
                if(!self::$sql['default']->rows("SELECT `id` FROM `{prefix_permissions}` WHERE `user` = ?;", [(int)($uid)]) && $uid >= 1) {
                    self::$sql['default']->insert("INSERT INTO `{prefix_permissions}` SET `user` = ?;", [(int)($uid)]);
                }

                // check rank permission
                if (self::$sql['default']->rows("SELECT s1.`" . $check . "` FROM `{prefix_permissions}` AS `s1` LEFT JOIN `{prefix_userposis}` AS `s2` ON s1.`pos` = s2.`posi`"
                    . "WHERE s2.`user` = ? AND s1.`" . $check . "` = 1 AND s2.`posi` != 0;", [(int)($uid)])) {
                    return true;
                }

                // check user permission
                if (!dbc_index::issetIndex('user_permission_' . (int)($uid))) {
                    $permissions = self::$sql['default']->fetch("SELECT * FROM `{prefix_permissions}` WHERE `user` = ?;", [(int)($uid)]);
                    dbc_index::setIndex('user_permission_' . (int)($uid), $permissions);
                }

                return dbc_index::getIndexKey('user_permission_' . (int)($uid), $check) ? true : false;
            } else {
                return false;
            }
        }
    }

    /**
     * Prueft, wieviele registrierte User gerade online sind
     * @param string $where
     * @param bool $like
     * @return int
     */
    public static function online_reg(string $where='',bool $like=false) {
        if(!self::$CrawlerDetect->isCrawler()) {
            $whereami = (empty($where) ? '' :
                ($like ? " AND `whereami` LIKE '%".$where."%'" :
                    " AND `whereami` = ".self::$sql['default']->quote($where)));
            return self::cnt('{prefix_users}', " WHERE (time+1800)>".time()."".$whereami." AND `online` = 1");
        }

        return 0;
    }

    /**
     * Prueft, ob der User eingeloggt ist und wenn ja welches Level besitzt er
     * @param int $userid_set
     * @return bool|int
     */
    public static function checkme(int $userid_set=0) {
        if (empty($_SESSION['id']) || empty($_SESSION['pwd'])) { return 0; }
        if (!$userid = ($userid_set != 0 ? (int)($userid_set) : self::userid())) { return 0; }
        if (self::rootAdmin($userid)) { return 4; }
        if(!dbc_index::issetIndex('user_'.(int)($userid))) {
            $get = self::$sql['default']->fetch("SELECT * FROM `{prefix_users}` WHERE `id` = ? AND `pwd` = ? AND `ip` = ?;", [(int)($userid),$_SESSION['pwd'],$_SESSION['ip']]);
            if (!self::$sql['default']->rowCount()) { return 0; }
            dbc_index::setIndex('user_'.$get['id'], $get);
            return $get['level'];
        }

        return dbc_index::getIndexKey('user_'.(int)($userid), 'level');
    }

    /**
     * Infomeldung ausgeben
     * @param string $msg
     * @param string $url
     * @param int $timeout
     * @param bool $direct_refresh
     * @return mixed|string|void
     */
    public static function info(string $msg,string $url="",int $timeout = 5,bool $direct_refresh = true) {
        if (settings::get('direct_refresh') && $direct_refresh) {
            return header('Location: ' . str_replace('&amp;', '&', $url));
        }

        $u = parse_url($url); $parts = '';
        $u['query'] = array_key_exists('query', $u) ? $u['query'] : '';
        $u['query'] = str_replace('&amp;', '&', $u['query']);
        foreach(explode('&', $u['query']) as $p) {
            $p = explode('=', $p);
            if (count($p) == 2) {
                $parts .= '<input type="hidden" name="' . $p[0] . '" value="' . $p[1] . '" />' . "\r\n";
            }
        }

        if (!array_key_exists('path', $u)) {
            $u['path'] = '';
        }

        $smarty = self::getSmarty(true);
        $smarty->caching = false;
        $smarty->assign('msg',$msg);
        $smarty->assign('url',$u['path']);
        $smarty->assign('rawurl',html_entity_decode($url));
        $smarty->assign('parts',$parts);
        $smarty->assign('timeout',$timeout);
        $info = $smarty->fetch('file:['.common::$tmpdir.']errors/info.tpl');
        $smarty->clearAllAssign();
        return $info;
    }

    /**
     * Updatet die Maximalen User die gleichzeitig online sind
     */
    public static function update_maxonline() {
        $maxonline = self::$sql['default']->fetch("SELECT `maxonline` FROM `{prefix_counter}` WHERE `today` = ?;", [date("j.n.Y")],'maxonline');
        if ($maxonline < ($count = self::cnt('{prefix_counter_whoison}'))) {
            self::$sql['default']->update("UPDATE `{prefix_counter}` SET `maxonline` = ? WHERE `today` = ?;", [$count,date("j.n.Y")]);
        }
    }

    /**
     * Aktualisiert die Position der Gaste & User
     * @param string $where
     */
    public static function update_online(string $where='') {
        if(!self::$CrawlerDetect->isCrawler() && !empty($where) && !self::$sql['default']->rows("SELECT `id` FROM `{prefix_iptodns}` WHERE `sessid` = ? AND `bot` = 1;", [session_id()])) {
            if(self::$sql['default']->rows("SELECT `id` FROM `{prefix_counter_whoison}` WHERE `online` < ?;", [time()])) { //Cleanup
                self::$sql['default']->delete("DELETE FROM `{prefix_counter_whoison}` WHERE `online` < ?;", [time()]);
            }

            $get = self::$sql['default']->fetch("SELECT `id` FROM `{prefix_counter_whoison}` WHERE `ip` = ? AND `ssid` = ?;", [self::$userip,session_id()]); //Update Move
            if(self::$sql['default']->rowCount()) {
                self::$sql['default']->update("UPDATE `{prefix_counter_whoison}` SET `whereami` = ?, `online` = ?, `login` = ?  WHERE `id` = ?;",
                    [stringParser::encode($where),(time()+1800),(!self::$chkMe ? 0 : 1),$get['id']]);
            } else {
                self::$sql['default']->insert("INSERT INTO `{prefix_counter_whoison}` SET `ip` = ?, `ssid` = ?, `online` = ?, `whereami` = ?, `login` = ?;",
                    [self::$userip, session_id(),(time()+1800),stringParser::encode($where),(!self::$chkMe ? 0 : 1)]);
            }

            if(self::$chkMe) {
                self::$sql['default']->update("UPDATE `{prefix_users}` SET `time` = ?, `whereami` = ? WHERE `id` = ?;", [time(),stringParser::encode($where),(int)(self::$userid)]);
            }
        }
    }

    /**
     * Prueft, wieviele Besucher gerade online sind
     * @param string $where
     * @param bool $like
     * @return int
     */
    public static function online_guests(string $where='',bool $like=false) {
        if(!self::$CrawlerDetect->isCrawler()) {
            $whereami = (empty($where) ? '' :
                ($like ? " AND `whereami` LIKE '%".$where."%'" :
                    " AND `whereami` = ".self::$sql['default']->quote($where)));
            return self::cnt('{prefix_counter_whoison}'," WHERE (online+1800)>".time()."".$whereami." AND `login` = 0");
        }

        return 0;
    }

    /**
     * Counter updaten
     */
    public static function updateCounter() {
        $datum = time();
        $get_agent = self::$sql['default']->fetch("SELECT `id`,`agent`,`bot` FROM `{prefix_iptodns}` WHERE `ip` = ?;", [stringParser::encode(self::$userip)]);
        if(self::$sql['default']->rowCount()) {
            if(!$get_agent['bot'] && !self::$CrawlerDetect->isCrawler(stringParser::decode($get_agent['agent']))) {
                if(self::$sql['default']->rows("SELECT id FROM `{prefix_counter_ips}` WHERE datum+? <= ? OR FROM_UNIXTIME(datum,'%d.%m.%Y') != ?;", [self::$reload,time(),date("d.m.Y")])) {
                    self::$sql['default']->delete("DELETE FROM `{prefix_counter_ips}` WHERE datum+? <= ? OR FROM_UNIXTIME(datum,'%d.%m.%Y') != ?;", [self::$reload,time(),date("d.m.Y")]);
                }

                $get = self::$sql['default']->fetch("SELECT `datum` FROM `{prefix_counter_ips}` WHERE `ip` = ? AND FROM_UNIXTIME(datum,'%d.%m.%Y') = ?;", [stringParser::encode(self::$userip),date("d.m.Y")]);
                if(self::$sql['default']->rowCount()) {
                    $sperrzeit = $get['datum']+self::$reload;
                    if($sperrzeit <= time()) {
                        self::$sql['default']->delete("DELETE FROM `{prefix_counter_ips}` WHERE `ip` = ?;", [stringParser::encode(self::$userip)]);
                        if (self::$sql['default']->rows("SELECT `id` FROM `{prefix_counter}` WHERE `today` = '" . date("j.n.Y") . "';", [date("j.n.Y")])) {
                            self::$sql['default']->update("UPDATE `{prefix_counter}` SET `visitors` = (visitors+1) WHERE `today` = ?;", [date("j.n.Y")]);
                        } else {
                            self::$sql['default']->insert("INSERT INTO `{prefix_counter}` SET `visitors` = 1 WHERE `today` = ?;", [date("j.n.Y")]);
                        }

                        self::$sql['default']->insert("INSERT INTO `{prefix_counter_ips}` SET `ip` = ?, `datum` = ?;", [stringParser::encode(self::$userip),(int)($datum)]);
                    }
                } else {
                    if(self::$sql['default']->rows("SELECT `id` FROM `{prefix_counter}` WHERE `today` = ?;", [date("j.n.Y")])) {
                        self::$sql['default']->update("UPDATE `{prefix_counter}` SET `visitors` = (visitors+1) WHERE `today` = ?;", [date("j.n.Y")]);
                    } else {
                        self::$sql['default']->insert("INSERT INTO `{prefix_counter}` SET `visitors` = 1, `today` = ?;", [date("j.n.Y")]);
                    }

                    self::$sql['default']->insert("INSERT INTO `{prefix_counter_ips}` SET `ip` = ?, `datum` = ?;", [stringParser::encode(self::$userip),(int)($datum)]);
                }
            }
        }
    }

    public static function less() {
        //TODO: Use Cache
        $main_dir = basePath . "/inc/_templates_/" . self::$sdir."/_less";
        $auto_imports = array();
        if($auto_import = common::get_files(basePath . "/inc/_templates_/" . self::$sdir."/_less/auto_imports/",false,true, ['php'])) {
            foreach($auto_import AS $dir)
            {
                $auto_imports[basePath.'/inc/_templates_/'.self::$sdir.'/_less/auto_imports/'.$dir.'/'] = '/inc/_templates_/'.self::$sdir.'/_less/auto_imports/'.$dir.'/';
            }
            unset($auto_import,$dir);
        }

        if(count($auto_imports) >= 1) {
            self::$less->SetImportDirs($auto_imports);
        }

        self::$less->parseFile( $main_dir.'/theme.less', "/inc/_templates_/" . self::$sdir."/_less/");
        return self::$less->getCss();
    }

    /**
     * Generiert die Select-Felder für ein Dropdown Menu
     * @param string $value
     * @param bool $is_selected
     * @param string $what
     * @return string
     */
    public static function editor_is_reg(array $get = array()) {
        $get['reg'] = (array_key_exists('reg',$get) ? $get['reg'] : (array_key_exists('t_reg',$get) ? $get['t_reg'] : self::$userid)); //Fix for thread/post
        $smarty = self::getSmarty(true);
        $smarty->caching = false;
        if($get['reg'] != 0) {
            $smarty->assign('nick',self::autor($get['reg']));
            $editor = $smarty->fetch('file:['.common::$tmpdir.']page/editor_regged.tpl');
        } else {
            if(!array_key_exists('email',$get)) { $get['email'] = array_key_exists('t_email',$get) ? $get['t_email'] : ''; } //Fix for thread/post
            if(!array_key_exists('hp',$get)) { $get['hp'] = array_key_exists('t_hp',$get) ? $get['t_hp'] : ''; } //Fix for thread/post
            if(!array_key_exists('nick',$get)) { $get['nick'] = array_key_exists('t_nick',$get) ? $get['t_nick'] : ''; } //Fix for thread/post
            $smarty->assign('postemail',stringParser::decode($get['email']));
            $smarty->assign('posthp',stringParser::decode($get['hp']));
            $smarty->assign('postnick',stringParser::decode($get['nick']));
            $editor = $smarty->fetch('file:['.common::$tmpdir.']page/editor_notregged.tpl');
        }

        $smarty->clearAllAssign();
        return $editor;
    }

    /**
     * Generiert die Select-Felder für ein Dropdown Menu
     * @param string $value
     * @param bool $is_selected
     * @param string $what
     * @param string $class
     * @return string
     */
    public static function select_field(string $value,bool $is_selected=false,string $what,string $class = null) {
        $sel = ($is_selected ? ' selected="selected"' : '');
        $class = !empty($class) ? ' class="'.$class.'"' : '';
        $smarty = self::getSmarty(true);
        $smarty->caching = false;
        $smarty->assign('value',$value);
        $smarty->assign('sel',$sel);
        $smarty->assign('what',$what);
        $smarty->assign('class',$class);
        $select_field = $smarty->fetch('file:['.common::$tmpdir.']page/select_field.tpl');
        $smarty->clearAllAssign();
        return $select_field;
    }

    /**
     * Generiert die Select-Felder für ein Dropdown Menu
     * @param string $id
     * @param string $action
     * @param string $title
     * @param string $del
     * @return string
     * @internal param string $value
     * @internal param bool $is_selected
     * @internal param string $what
     */
    public static function button_delete_single(string $id,string $action,string $title=_button_title_del,string $del=_confirm_del_entry) {
        $smarty = self::getSmarty(true);
        $smarty->caching = false;
        $smarty->assign('id',$id);
        $smarty->assign('action',$action);
        $smarty->assign('title',$title);
        $smarty->assign('del',$del);
        $delete = $smarty->fetch('file:['.common::$tmpdir.']page/buttons/button_delete_single.tpl');
        $smarty->clearAllAssign();
        return $delete;
    }

    /**
     * @param string $sort
     * @return string
     */
    public static function orderby(string $sort) {
        $split = explode("&",self::GetServerVars('QUERY_STRING'));
        $url = "?";

        foreach($split as $part) {
            if(strpos($part,"orderby") === false && strpos($part,"order") === false && !empty($part)) {
                $url .= $part;
                $url .= "&";
            }
        }

        if(isset($_GET['orderby']) && $_GET['order']) {
            if ($_GET['orderby'] == $sort && $_GET['order'] == "ASC") {
                return $url . "orderby=" . $sort . "&order=DESC";
            }
        }

        return $url."orderby=".$sort."&order=ASC";
    }

    /**
     * @param array $order_by
     * @param string $default_order
     * @param string $join
     * @param array $order
     * @return string
     */
    public static function orderby_sql(array $order_by= [], string $default_order='', string $join='', array $order = ['ASC','DESC']) {
        if (!isset($_GET['order']) || empty($_GET['order']) || !in_array($_GET['order'], $order) ||
            !isset($_GET['orderby']) || empty($_GET['orderby']) || !in_array($_GET['orderby'], $order_by) ||
            empty($_GET['orderby']) || empty($_GET['order'])) {
            return $default_order;
        }
        $key = array_search($_GET['orderby'], $order_by);   // $key = 1;
        $order_by = (in_array($_GET['orderby'], $order_by) ? '`'.$order_by[$key].'` ' : '`id` ');
        $order = (in_array(strtoupper($_GET['order']), $order) ? (strtoupper($_GET['order']) == 'DESC' ? 'DESC ' : 'ASC ') : 'DESC ');
        return 'ORDER BY '.(!empty($join) ? $join.'.' : '').$order_by.$order;
    }

    /**
     * @return string
     */
    public static function orderby_nav() {
        $orderby = isset($_GET['orderby']) ? "&orderby".$_GET['orderby'] : "";
        $orderby .= isset($_GET['order']) ? "&order=".$_GET['order'] : "";
        return $orderby;
    }

    /**
     * Funktion um diverse Dinge aus Tabellen auszaehlen zu lassen
     * @param string $db
     * @param string $where
     * @param string $what
     * @param array $sql_std
     * @return int
     */
    public static function cnt(string $db,string $where = "",string $what = "id",array $sql_std= []) {
        $cnt = self::$sql['default']->fetch("SELECT COUNT(`".$what."`) AS `cnt` FROM `".$db."` ".$where.";",$sql_std,'cnt');
        if(self::$sql['default']->rowCount() >= 1) {
            return $cnt;
        }

        return 0;
    }

    /**
     * Funktion um diverse Dinge aus Tabellen auszaehlen zu lassen
     * @param string $db
     * @param string $where
     * @param array $whats
     * @param array $sql_std
     * @return array
     */
    public static function cnt_multi(string $db, string $where = "", array $whats = ['id'], array $sql_std=[]) {
        $cnt_sql = "";
        foreach ($whats as $what) {
            $cnt_sql .= "COUNT(`".$what."`) AS `cnt_".$what."`,";
        }
        $cnt_sql = substr($cnt_sql, 0, -1);
        $cnt = self::$sql['default']->fetch("SELECT ".$cnt_sql." FROM `".$db."` ".$where.";",$sql_std);
        if (self::$sql['default']->rowCount()) {
            return $cnt;
        }

        return [];
    }

    /**
     * Funktion um diverse Dinge aus Tabellen zusammenzaehlen zu lassen
     * @param string $db
     * @param string $where
     * @param string $what
     * @param array $sql_std
     * @return int
     */
    public static function sum(string $db,string $where = "",string $what = "id",array $sql_std=[]) {
        $sum = self::$sql['default']->fetch("SELECT SUM(`".$what."`) AS `sum` FROM `".$db."` ".$where.";",$sql_std,'sum');
        if(self::$sql['default']->rowCount() >= 1) {
            return $sum;
        }

        return 0;
    }

    /**
     * Funktion um diverse Dinge aus Tabellen zusammenzaehlen zu lassen
     * @param string $db
     * @param string $where
     * @param array $whats
     * @param array $sql_std
     * @return array
     */
    public static function sum_multi(string $db, string $where = "", array $whats = ['id'], array $sql_std=[]) {
        $sum_sql = "";
        foreach ($whats as $what) {
            $sum_sql .= "SUM(`".$what."`) AS `sum_".$what."`,";
        }
        $sum_sql = substr($sum_sql, 0, -1);
        $sum = self::$sql['default']->fetch("SELECT ".$sum_sql." FROM `".$db."` ".$where.";",$sql_std);
        if (self::$sql['default']->rowCount()) {
            return $sum;
        }

        return [];
    }

    /**
     * @param string $str
     * @param int $width
     * @param string $break
     * @param bool $cut
     * @return string
     */
    public static function wrap(string $str,int $width = 75,string $break = "\n",bool $cut = true) {
        return strtr(str_replace(htmlentities($break), $break, htmlentities(wordwrap(html_entity_decode($str), $width, $break, $cut), ENT_QUOTES)), array_flip(get_html_translation_table(HTML_SPECIALCHARS, ENT_COMPAT)));
    }

    /**
     * @param string $var
     * @param array $search
     * @return bool
     */
    public static function array_var_exists(string $var,array $search) {
        foreach($search as $key => $var_) {
            if($var_==$var) return true;
        }
        return false;
    }

    /**
     * @param string $txt
     * @return mixed
     */
    public static function bbcode_email(string $txt) {
        return str_replace(["&#91;","&#93;"],
            ["[","]"],bbcode::parse_html($txt));
    }

    /**
     * Prueft ob der User ein Rootadmin ist
     * @param int $userid
     * @return bool
     */
    public static function rootAdmin(int $userid=0) {
        $userid = (!$userid ? self::userid() : $userid);
        if (!count(config::$rootAdmins)) { return false; }
        return in_array($userid, config::$rootAdmins);
    }

    /**
     * Languagefiles einlesen
     * @param string $lng
     */
    public static function lang(string $lng) {
        if(!file_exists(basePath."/inc/lang/".$lng.".php")) {
            $files = self::get_files(basePath.'/inc/lang/',false,true,['php']);
            $lng = str_replace('.php','',$files[0]);
        }

        include(basePath."/inc/lang/global.php");
        include(basePath."/inc/lang/".$lng.".php");
    }

    /**
     * Auslesen der UserID
     * @return integer
     **/
    public static function userid() {
        if (empty($_SESSION['id']) || empty($_SESSION['pwd'])) { return 0; }
        if(!dbc_index::issetIndex('user_'.(int)($_SESSION['id']))) {
            $get = self::$sql['default']->fetch("SELECT * FROM `{prefix_users}` WHERE `id` = ? AND `pwd` = ?;",
                [(int)($_SESSION['id']),$_SESSION['pwd']]);
            if (!self::$sql['default']->rowCount()) { return 0; }
            dbc_index::setIndex('user_'.$get['id'], $get, 2);
            return $get['id'];
        }

        return dbc_index::getIndexKey('user_'.(int)($_SESSION['id']), 'id');
    }

    /**
     * Wandelt bytes in eine lesbare Größe.
     * @param int $bytes
     * @param int $decimals
     * @return string
     */
    public static function parser_filesize(int $bytes, int $decimals = 2) {
        $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }

    /**
     * Gibt den Wartungsmodus aus.
     * @param string $title
     * @return mixed|string
     */
    public static function wmodus(string $title) {
        $smarty = self::getSmarty(true);

        // JS-Dateine einbinden * json *
        $java_vars = '<script language="javascript" type="text/javascript">var json=\''.javascript::encode().'\',dzcp_config=JSON&&JSON.parse(json)||$.parseJSON(json);</script>'."\n";

        //Sicherheitsscode
        $secure='';
        if(settings::get('securelogin')) {
            $smarty->caching = false;
            $secure = $smarty->fetch('file:['.common::$tmpdir.']user/access/secure.tpl');
        }

        $smarty->caching = false;
        $smarty->assign('secure',$secure);
        $login = $smarty->fetch('file:['.common::$tmpdir.']errors/wmodus_login.tpl');
        $smarty->clearAllAssign();

        cookie::save(); //Save Cookie

        $smarty->caching = false;
        $smarty->assign('java_vars',$java_vars);
        $smarty->assign('title',strip_tags(stringParser::decode($title)));
        $smarty->assign('login',$login);
        $wmodus = $smarty->fetch('file:['.common::$tmpdir.']errors/wmodus.tpl');
        $smarty->clearAllAssign();

        return $wmodus;
    }

    /**
     * Ausgabe des Indextemplates
     * @param string $index
     * @param string $title
     * @param string $where
     * @param string $index_templ
     */
    public static final function page(string $index='',string $title='',string $where='',string $index_templ='index') {
        global $dir;

        //JS SetOptions
        javascript::set('lng',($_SESSION['language']=='deutsch'?'de':'en'));
        javascript::set('maxW',settings::get('maxwidth'));
        javascript::set('autoRefresh',1);  // Enable Auto-Refresh for Ajax
        javascript::set('debug',view_javascript_debug);  // Enable JS Debug
        javascript::set('dir',self::$designpath);  // Designpath
        javascript::set('dialog_button_00',_yes);
        javascript::set('dialog_button_01',_no);
        javascript::set('onlyBBCode',true); // nur BBCode Verwenden

        //Check Wartungsmodus
        if(settings::get("wmodus") && self::$chkMe != 4) {
            echo wmodus($title);
        } else {
            if(!self::$CrawlerDetect->isCrawler()) {
                self::updateCounter();
                self::update_maxonline();
            }

            // JS-Dateine einbinden * json *
            $java_vars = '<script language="javascript" type="text/javascript">var json=\''.javascript::encode().'\',dzcp_config=JSON&&JSON.parse(json)||$.parseJSON(json);</script>'."\n";
            $java_vars .= '<script language="javascript" type="text/javascript" src="../vendor/ckeditor/ckeditor/ckeditor.js"></script>'."\n";
            $java_vars .= '<script language="javascript" type="text/javascript" src="../vendor/ckeditor/ckeditor/adapters/jquery.js"></script>'."\n";

            //check permissions
            $check_msg = '';
            if(self::$chkMe) {
                $check_msg = self::check_msg();
                self::set_lastvisit(self::$userid);
            }

            $headtitle =stringParser::decode(settings::get("clanname"));
            $title =stringParser::decode(strip_tags($title));

            if (self::check_internal_url()) {
                $index = self::error(_error_have_to_be_logged, 1);
            }

            $where = preg_replace_callback("#autor_(.*?)$#",create_function('$id', 'return stringParser::decode(common::data("nick","$id[1]"));'),$where);
            $index = empty($index) ? '' : (!$check_msg ? '' : $check_msg).'<table class="mainContent" cellspacing="1">'.$index.'</table>';
            self::update_online($where); //Update Stats

            //template index autodetect
            $index_templ = ($index_templ == 'index' && file_exists(self::$designpath.'/index_'.$dir.'.html') ? 'index_'.$dir : $index_templ);

            //check if placeholders are given
            $pholder = file_get_contents(self::$designpath."/".$index_templ.".html");

            //filter placeholders
            $dir = self::$designpath; //after template index autodetect!!!
            $blArr = ["[clanname]","[title]","[java_vars]","[headtitle]", "[index]","[dir]","[where]"];
            $pholdervars = '';
            for($i=0;$i<=count($blArr)-1;$i++) {
                if (preg_match("#" . $blArr[$i] . "#", $pholder)) {
                    $pholdervars .= $blArr[$i];
                }
            }

            for ($i = 0; $i <= count($blArr) - 1; $i++) {
                $pholder = str_replace($blArr[$i], "", $pholder);
            }

            $pholder = self::pholderreplace($pholder);
            $pholdervars = self::pholderreplace($pholdervars);

            //put placeholders in array
            $arr = [];
            $pholder = explode("^",$pholder);
            for($i=0;$i<=count($pholder)-1;$i++) {
                if (strstr($pholder[$i], 'nav_')) {
                    $arr[$pholder[$i]] = navi($pholder[$i]);
                } else {
                    if (array_key_exists($pholder[$i], self::$menu_index) && self::$menu_index[$pholder[$i]]) {
                        require_once(basePath . '/inc/menu-functions/' . $pholder[$i] . '.php');
                    }

                    if (function_exists($pholder[$i])) {
                        $arr[$pholder[$i]] = $pholder[$i]();
                    }
                }
            }


            $pholdervars = explode("^",$pholdervars);
            foreach ($pholdervars as $pholdervar) {
                /** @noinspection PhpVariableVariableInspection */
                $arr[$pholdervar] = $$pholdervar;
            }

            $arr['sid'] = self::$sid; //Math.random() like

            //index output
            $index = (file_exists(basePath."/inc/_templates_/".self::$tmpdir."/".$index_templ.".html") ? show($index_templ, $arr) : show("index", $arr));
            cookie::save(); //Save Cookie
            DebugConsole::insert_info('common::page()','Memory Usage: '.self::parser_filesize(memory_get_usage()));
            DebugConsole::insert_info('common::page()','Memory-Peak Usage: '.self::parser_filesize(memory_get_peak_usage()));
            DebugConsole::insert_info('common::page()',sprintf("Page generated in %.8f seconds", (getmicrotime() - start_time)));

            $index = (!self::$chkMe ? preg_replace("|<logged_in>.*?</logged_in>|is", "", $index) : preg_replace("|<logged_out>.*?</logged_out>|is", "", $index));
            $index = str_ireplace(["<logged_in>","</logged_in>","<logged_out>","</logged_out>"], '', $index);

            if (debug_save_to_file) {
                DebugConsole::save_log();
            } //Debug save to file
            $output = view_error_reporting || DebugConsole::get_warning_enable() ? DebugConsole::show_logs().$index : $index; //Debug Console + Index Out
            gz_output($output); // OUTPUT BUFFER END
        }
    }
}

//###########################
//OLD CODE
//###########################
/**
 * @param string $tpl
 * @param array $array
 * @param array $array_lang_constant
 * @param array $array_block
 * @return mixed|string
 */
function show(string $tpl="", array $array= [], array $array_lang_constant= [], array $array_block= []) {
    return common::show($tpl,$array,$array_lang_constant,$array_block);
}

/**
 * ###########################################################
 *                       API Loader
 * ###########################################################
 */

//-> Neue Kernel Funktionen einbinden, sofern vorhanden
if($functions_files = common::get_files(basePath.'/inc/additional-kernel/',false,true, ['php'])) {
    foreach($functions_files AS $func) {
        include(basePath.'/inc/additional-kernel/'.$func);
    } unset($functions_files,$func);
}

//-> Neue Languages einbinden, sofern vorhanden
if($language_files = common::get_files(basePath.'/inc/additional-languages/'.$_SESSION['language'].'/',false,true, ['php'])) {
    foreach($language_files AS $languages)
    { include(basePath.'/inc/additional-languages/'.$_SESSION['language'].'/'.$languages); }
    unset($language_files,$languages);
}

//-> Neue Funktionen einbinden, sofern vorhanden
if($functions_files = common::get_files(basePath.'/inc/additional-functions/',false,true, ['php'])) {
    foreach($functions_files AS $func)
    { include(basePath.'/inc/additional-functions/'.$func); }
    unset($functions_files,$func);
}
