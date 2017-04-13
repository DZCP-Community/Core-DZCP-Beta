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

if (!defined('_Links')) exit();

$qry = common::$sql['default']->select("SELECT * FROM `{prefix_links}` ORDER BY banner DESC;");
if(common::$sql['default']->rowCount()) {
    foreach($qry as $get) {
        if($get['banner']) {
            $banner = show(_links_bannerlink, array("id" => $get['id'],
                                                    "banner" => stringParser::decode($get['text'])));
        } else {
            $banner = show(_links_textlink, array("id" => $get['id'],
                                                  "text" => str_replace('http://','',stringParser::decode($get['url']))));
        }

        $show .= show($dir."/links_show", array("beschreibung" => bbcode::parse_html($get['beschreibung']),
                                                "hits" => $get['hits'],
                                                "banner" => $banner));
    }
}

if(empty($show))
    $show = _no_entrys_yet;

$index = show($dir."/links", array("show" => $show));