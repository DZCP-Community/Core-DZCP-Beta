<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */

## OUTPUT BUFFER START ##
include("../inc/buffer.php");

## INCLUDES ##
include(basePath."/inc/common.php");

## SETTINGS ##
$dir = "user";
$where = _site_user;
define('_UserMenu', true);
$smarty = common::getSmarty(); //Use Smarty

/**
 * @param int $kid
 * @return array
 */
function custom_content($kid=1) {
    $custom_content = ''; $i = 0;
    $qrycustom = common::$sql['default']->select("SELECT `feldname`,`type`,`name` FROM `{prefix_profile}` WHERE `kid` = ? AND `shown` = 1 ORDER BY id ASC;",array($kid));
    if(common::$sql['default']->rowCount()) {
        foreach($qrycustom as $getcustom) {
            $getcontent = common::$sql['default']->fetch("SELECT `".$getcustom['feldname']."` FROM `{prefix_users}` WHERE `id` = ? LIMIT 1;",array(intval($_GET['id'])));
            if(!empty($getcontent[$getcustom['feldname']])) {
                switch($getcustom['type']) {
                    case 2:
                        $custom_content .= show(_profil_custom_url, array("name" =>stringParser::decode(pfields_name($getcustom['name'])), "value" => stringParser::decode($getcontent[$getcustom['feldname']])));
                        break;
                    case 3:
                        $custom_content .= show(_profil_custom_mail, array("name" =>stringParser::decode(pfields_name($getcustom['name'])), "value" => common::CryptMailto(stringParser::decode($getcontent[$getcustom['feldname']]),_link_mailto)));
                        break;
                    default:
                        $custom_content .= show(_profil_custom, array("name" =>stringParser::decode(pfields_name($getcustom['name'])), "value" => stringParser::decode($getcontent[$getcustom['feldname']])));
                        break;
                }

                $i++;
            }
        }
    }

    return array('count' => $i, 'content' => $custom_content);
}

/**
 * Funktion fuer die Sprachdefinierung der Profilfelder
 * @param $name
 * @return mixed
 */
function pfields_name($name) {
    $pattern = array("=_city_=Uis");
    $replacement = array(_profil_city);
    return preg_replace($pattern, $replacement, $name);
}

/**
 * @param int $kid
 * @param int $user
 * @return string
 */
function getcustom($kid=1,$user=0) {
    if (!$kid) { return ""; }
    $set_id = ($user != 0 ? intval($user) : common::$userid);
    $qrycustom = common::$sql['default']->select("SELECT `feldname`,`name` FROM `{prefix_profile}` WHERE `kid` = ? AND `shown` = 1 ORDER BY id ASC",array($kid)); $custom = "";
    foreach($qrycustom as $getcustom) {
        $getcontent = common::$sql['default']->fetch("SELECT `".$getcustom['feldname']."` FROM `{prefix_users}` WHERE `id` = ? LIMIT 1;",array($set_id));
        $custom .= show(_profil_edit_custom, array("name" =>stringParser::decode(pfields_name($getcustom['name'])) . ":",
                                                   "feldname" => $getcustom['feldname'],
                                                   "value" => stringParser::decode($getcontent[$getcustom['feldname']])));
    }
                            
    return $custom;
}

/**
 * Prueft ob ein User schon in der Buddyliste vorhanden ist
 * @param $buddy
 * @return bool
 */
function check_buddy($buddy) {
    return !common::$sql['default']->rows("SELECT `buddy` FROM `{prefix_userbuddys}` WHERE `user` = ? AND `buddy` = ?;",
            array(intval(common::$userid),intval($buddy))) ? true : false;
}

//Load Index
if (file_exists(basePath . "/user/case_" . $action . ".php")) {
    require_once(basePath . "/user/case_" . $action . ".php");
}

## INDEX OUTPUT ##
$whereami = preg_replace_callback("#autor_(.*?)$#",create_function('$id', 'return stringParser::decode(common::data("nick","$id[1]"));'),$where);
$title = common::$pagetitle." - ".$whereami.""; unset($whereami);
common::page($index, $title, $where);