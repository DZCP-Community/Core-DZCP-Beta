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

function sponsors() {
    $qry = common::$sql['default']->select("SELECT `id`,`xlink`,`xend`,`link` FROM `{prefix_sponsoren}` WHERE `box` = 1 ORDER BY `pos`;");
    $sponsors = '';
    if(common::$sql['default']->rowCount()) {
        foreach($qry as $get) {
            $banner = show(_sponsors_bannerlink, array("id" => $get['id'],
                                                       "title" => htmlspecialchars(str_replace('http://', '', stringParser::decode($get['link']))),
                                                       "banner" => (empty($get['xlink']) ? "../banner/sponsors/box_".$get['id'].".".$get['xend'] : stringParser::decode($get['xlink']))));

            $sponsors .= show("menu/sponsors", array("banner" => $banner));
        }
    }

    return empty($sponsors) ? '<center style="margin:2px 0">'._no_entrys.'</center>' : '<table class="navContent" cellspacing="0">'.$sponsors.'</table>';
}