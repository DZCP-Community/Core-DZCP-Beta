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

function l_artikel() {
    $qry = common::$sql['default']->select("SELECT `id`,`titel`,`text`,`autor`,`datum`,`kat`,`public` "
            . "FROM `{prefix_artikel}` "
            . "WHERE `public` = 1 "
            . "ORDER BY `id` DESC LIMIT ".settings::get('m_lartikel').";");

    $l_articles = '';
    if(common::$sql['default']->rowCount()) {
        foreach($qry as $get) {
            $getkat = common::$sql['default']->fetch("SELECT `kategorie` FROM `{prefix_newskat}` WHERE `id` = ?;",array($get['kat']));
            $text = strip_tags(stringParser::decode($get['text']));
            $info = !settings::get('allowhover') == 1 ? '' : 'onmouseover="DZCP.showInfo(\''.common::jsconvert(stringParser::decode($get['titel'])).'\', \''._datum.';'.
                    _autor.';'._news_admin_kat.';'._comments_head.'\', \''.date("d.m.Y H:i", $get['datum'])._uhr.';'.
                common::fabo_autor($get['autor']).';'.common::jsconvert(stringParser::decode($getkat['kategorie'])).';'.
                common::cnt('{prefix_acomments}',"WHERE `artikel` = ?","id",array($get['id'])).'\')" onmouseout="DZCP.hideInfo()"';
            
            $l_articles .= show("menu/last_artikel", array("id" => $get['id'],
                                                           "titel" => common::cut(stringParser::decode($get['titel']),settings::get('l_lartikel')),
                                                           "text" => common::cut(bbcode::parse_html($text),260),
                                                           "datum" => date("d.m.Y", $get['datum']),
                                                           "info" => $info));
        }
    }

    return empty($l_articles) ? '<center style="margin:2px 0">'._no_entrys.'</center>' : '<table class="navContent" cellspacing="0">'.$l_articles.'</table>';
}