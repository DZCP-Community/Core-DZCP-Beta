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

if (!defined('_Sponsors')) exit();

$qry = common::$sql['default']->select("SELECT `id`,`link`,`slink`,`beschreibung`,`hits` FROM `{prefix_sponsoren}` WHERE `site` = 1 ORDER BY `pos`;");
foreach($qry as $get) {
    if(empty($get['slink'])) {
        foreach(["jpg", "gif", "png"] AS $end) {
            if(file_exists(basePath.'/banner/sponsors/site_'.$get['id'].'.'.$end))
                break;
        }

        $banner = show(_sponsors_bannerlink, ["id" => $get['id'],
                                                   "title" => str_replace('http://', '', stringParser::decode($get['link'])),
                                                   "banner" => "../banner/sponsors/site_".$get['id'].".".$end]);
    } else {
        $banner = show(_sponsors_bannerlink, ["id" => $get['id'],
                                                   "title" => str_replace('http://', '', stringParser::decode($get['link'])),
                                                   "banner" => $get['slink']]);
    }

    $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
    $show .= show($dir."/sponsors_show", ["class" => $class,
                                               "beschreibung" => bbcode::parse_html($get['beschreibung']),
                                               "hits" => $get['hits'],
                                               "banner" => $banner]);
}

if(empty($show))
    $show = '<tr><td colspan="2" class="contentMainSecond">'._no_entrys.'</td></tr>';

$index = show($dir."/sponsors", ["show" => $show]);