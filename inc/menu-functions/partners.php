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

function partners() {
    $smarty = common::getSmarty(); //Use Smarty
    $qry = common::$sql['default']->select("SELECT `textlink`,`link`,`banner` FROM `{prefix_partners}` ORDER BY `textlink` ASC;");
    $partners = '';
    if(common::$sql['default']->rowCount()) {
        foreach($qry as $get) {
            if($get['textlink']) {
                $smarty->caching = false;
                $smarty->assign('link',stringParser::decode($get['link']));
                $smarty->assign('name',stringParser::decode($get['banner']));
                $partners .= $smarty->fetch('file:['.common::$tmpdir.']menu/partners_textlink.tpl');
                $smarty->clearAllAssign();
            } else {
                $smarty->caching = false;
                $smarty->assign('link',stringParser::decode($get['link']));
                $smarty->assign('title',htmlspecialchars(str_replace('http://', '', stringParser::decode($get['link']))));
                $smarty->assign('banner',stringParser::decode($get['banner']));
                $partners .= $smarty->fetch('file:['.common::$tmpdir.']menu/partners.tpl');
                $smarty->clearAllAssign();
            }

            $table = strstr($partners, '<tr>') ? true : false;
        }
    }

    return empty($partners) ? '<div style="margin:2px 0;text-align:center;">'._no_entrys.'</div>' : ($table ? '<table class="navContent" cellspacing="0">'.$partners.'</table>' : $partners);
}