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

/**
 * Usage {avatar} || {avatar id="1"} || {avatar id="1" height="100" width="70"} || {avatar height="100" width="70"}
 * @param $params
 * @param $smarty
 * @return string
 */
function smarty_function_avatar($params, &$smarty) {
    $smarty = common::getSmarty(); //Use Smarty
    $avatar = '';
    if(common::$chkMe >= 1) {
        $uid = 0; $width=70; $height=100;
        if(array_key_exists('id',$params)) {
            $uid = (int)$params['id'];
        }

        if(array_key_exists('height',$params)) {
            $height = (int)$params['height'];
        }

        if(array_key_exists('width',$params)) {
            $width = (int)$params['width'];
        }

        $smarty->caching = false;
        $smarty->assign('avatar_show', common::useravatar($uid, $width, $height));
        $avatar = $smarty->fetch('file:[' . common::$tmpdir . ']menu/avatar/avatars.tpl');
        $smarty->clearAllAssign();
    }

    return $avatar;
}