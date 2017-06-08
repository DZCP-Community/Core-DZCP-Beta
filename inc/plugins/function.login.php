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
 * Usage {idir}
 * @param $params
 * @param $smarty
 * @return string
 */
function smarty_function_login($params, &$smarty) {
    $login = '';
    if(!common::$chkMe) {
        $smarty_login = common::getSmarty(true); //Use Smarty

        $smarty_login->caching = false;
        $secure = $smarty_login->fetch('file:[' . common::$tmpdir . ']menu/login/secure.tpl');

        $smarty_login->caching = false;
        $smarty_login->assign('secure', $secure);
        $login = $smarty_login->fetch('file:[' . common::$tmpdir . ']menu/login/login.tpl');
        $smarty_login->clearAllAssign();
    }

    return $login;
}