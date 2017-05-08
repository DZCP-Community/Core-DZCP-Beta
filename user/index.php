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