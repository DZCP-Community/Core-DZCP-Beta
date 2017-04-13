<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 * Menu: Events
 */

function events() {
    $qry = common::$sql['default']->select("SELECT `id`,`datum`,`title`,`event` "
                      . "FROM `{prefix_events}` "
                      . "WHERE `datum` > ? "
                      . "ORDER BY `datum` LIMIT ".settings::get('m_events').";",array(time()));
    $eventbox = '';
    if(common::$sql['default']->rowCount()) {
        foreach($qry as $get) {
            $info = 'onmouseover="DZCP.showInfo(\''.common::jsconvert(stringParser::decode($get['title'])).'\', \''._kalender_uhrzeit.';'.
                    _datum.'\', \''.date("H:i", $get['datum'])._uhr.';'.
                    date("d.m.Y", $get['datum']).'\')" onmouseout="DZCP.hideInfo()"';
            
            $events = show(_next_event_link, array("datum" => date("d.m.",$get['datum']),
                                                   "timestamp" => $get['datum'],
                                                   "event" => stringParser::decode($get['title']),
                                                   "info" => $info));

            $eventbox .= show("menu/event", array("events" => $events, "info" => $info));
        }
    }

    return empty($eventbox) ? '<center style="margin:2px 0">'._no_events.'</center>' : '<table class="navContent" cellspacing="0">'.$eventbox.'</table>';;
}
