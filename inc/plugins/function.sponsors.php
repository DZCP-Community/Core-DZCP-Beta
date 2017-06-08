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

function smarty_function_sponsors($params, &$smarty) {
    $smarty_sponsors = common::getSmarty(true); //Use Smarty
    $qry = common::$sql['default']->select("SELECT `id`,`xlink`,`xend`,`link` FROM `{prefix_sponsoren}` WHERE `box` = 1 ORDER BY `pos`;");
    $sponsors = '';
    if(common::$sql['default']->rowCount()) {
        foreach($qry as $get) {
            $smarty_sponsors->caching = false;
            $smarty_sponsors->assign('id',$get['id']);
            $smarty_sponsors->assign('title',htmlspecialchars(str_replace('http://', '', stringParser::decode($get['link']))));
            $smarty_sponsors->assign('banner',(empty($get['xlink']) ? "../banner/sponsors/box_".$get['id'].".".$get['xend'] : stringParser::decode($get['xlink'])));
            $banner = $smarty_sponsors->fetch('file:['.common::$tmpdir.']menu/sponsors/sponsors_bannerlink.tpl');
            $smarty_sponsors->clearAllAssign();

            $smarty_sponsors->caching = false;
            $smarty_sponsors->assign('banner',$banner);
            $sponsors .= $smarty_sponsors->fetch('file:['.common::$tmpdir.']menu/sponsors/sponsors.tpl');
            $smarty_sponsors->clearAllAssign();
        }
    }

    return empty($sponsors) ? '<div style="margin:2px 0;text-align:center;">'._no_entrys.'</div>' : '<table class="navContent" cellspacing="0">'.$sponsors.'</table>';
}