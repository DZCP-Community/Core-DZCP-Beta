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
 * Usage {rotationsbanner}
 * @param $params
 * @param $smarty
 * @return string
 */
function smarty_function_rotationsbanner($params, &$smarty) {
    $smarty_rotationsbanner = common::getSmarty(true); //Use Smarty
    $qry = common::$sql['default']->select("SELECT `id`,`link`,`bend`,`blink` FROM `{prefix_sponsoren}` WHERE `banner` = 1 ORDER BY RAND() LIMIT 1;");
    $rotationbanner = '';
    if(common::$sql['default']->rowCount()) {
        foreach($qry as $get) {
            $smarty_rotationsbanner->caching = false;
            $smarty_rotationsbanner->assign('id',$get['id']);
            $smarty_rotationsbanner->assign('title',htmlspecialchars(str_replace('http://', '', stringParser::decode($get['link']))));
            $smarty_rotationsbanner->assign('banner',(empty($get['blink']) ? "../banner/sponsors/banner_".$get['id'].".".$get['bend'] : stringParser::decode($get['blink'])));
            $rotationbanner .= $smarty_rotationsbanner->fetch('file:['.common::$tmpdir.']sponsors/sponsors_bannerlink.tpl');
            $smarty_rotationsbanner->clearAllAssign();
        }
    }

    return empty($rotationbanner) ? '' : $rotationbanner;
}