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

if (!defined('_Kalender')) exit();

$qry = common::$sql['default']->select("SELECT * FROM `{prefix_events}` WHERE DATE_FORMAT(FROM_UNIXTIME(datum), '%d.%m.%Y') = ? ORDER BY `datum`;",array(date("d.m.Y",intval($_GET['time']))));
$events = '';
foreach($qry as $get) {
    $edit = common::permission("editkalender") ? show("page/button_edit_url",
            array("action" => "../admin/?admin=kalender&do=edit&id=".$get['id'], "title" => _button_title_edit)) : '';

    $events .= show($dir."/event_show", array("edit" => $edit,
                                              "show_time" => date("H:i", $get['datum'])._uhr,
                                              "show_event" => bbcode::parse_html($get['event']),
                                              "show_title" => stringParser::decode($get['title'])));
}

$head = show(_kalender_events_head, array("datum" => date("d.m.Y",$_GET['time'])));
$index = show($dir."/event", array("head" => $head, "events" => $events));