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

function events() {
    $qry = common::$sql['default']->select("SELECT `id`,`datum`,`title`,`event` "
                      . "FROM `{prefix_events}` "
                      . "WHERE `datum` > ? "
                      . "ORDER BY `datum` LIMIT ".settings::get('m_events').";", [time()]);
    $eventbox = '';
    if(common::$sql['default']->rowCount()) {
        foreach($qry as $get) {
            $info = 'onmouseover="DZCP.showInfo(\''.common::jsconvert(stringParser::decode($get['title'])).'\', \''._kalender_uhrzeit.';'.
                    _datum.'\', \''.date("H:i", $get['datum'])._uhr.';'.
                    date("d.m.Y", $get['datum']).'\')" onmouseout="DZCP.hideInfo()"';
            
            $events = show(_next_event_link, ["datum" => date("d.m.",$get['datum']),
                                                   "timestamp" => $get['datum'],
                                                   "event" => stringParser::decode($get['title']),
                                                   "info" => $info]);

            $eventbox .= show("menu/event", ["events" => $events, "info" => $info]);
        }
    }

    return empty($eventbox) ? '<center style="margin:2px 0">'._no_events.'</center>' : '<table class="navContent" cellspacing="0">'.$eventbox.'</table>';;
}
