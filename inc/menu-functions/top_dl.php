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

function top_dl() {
    $smarty = common::getSmarty(); //Use Smarty
    $qry = common::$sql['default']->select("SELECT `id`,`kat`,`download`,`date`,`hits` "
                      . "FROM `{prefix_downloads}`".(common::permission('dlintern') ? "" : " WHERE `intern` = 0")." "
                      . "ORDER BY `hits` ".(!settings::get('m_topdl') ? "DESC LIMIT ".settings::get('m_topdl').";" : ";"));
    $top_dl = '';
    if(common::$sql['default']->rowCount()) {
        foreach($qry as $get) {
            $getkat = common::$sql['default']->fetch("SELECT `name` FROM `{prefix_download_kat}` WHERE `id` = ?;", [$get['kat']]);
            $info = 'onmouseover="DZCP.showInfo(\''.common::jsconvert(stringParser::decode($get['download'])).'\', \''._datum.';'._dl_dlkat.';'._hits.'\', \''.date("d.m.Y H:i", $get['date'])._uhr.';'.
                common::jsconvert(stringParser::decode($getkat['name'])).';'.$get['hits'].'\')" onmouseout="DZCP.hideInfo()"';
            $smarty->caching = false;
            $smarty->assign('id',$get['id']);
            $smarty->assign('titel',common::cut(stringParser::decode($get['download']),settings::get('l_topdl')));
            $smarty->assign('info',$info);
            $smarty->assign('hits',$get['hits']);
            $top_dl .= $smarty->fetch('file:['.common::$tmpdir.']menu/top_dl/top_dl.tpl');
            $smarty->clearAllAssign();
        }
    }

    return empty($top_dl) ? '<div style="margin:2px 0;text-align:center;">'._no_entrys.'</div>' : '<table class="navContent" cellspacing="0">'.$top_dl.'</table>';
}