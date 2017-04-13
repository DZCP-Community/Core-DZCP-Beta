<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 * Menu: Top Downloads
 */

function top_dl() {
    $qry = common::$sql['default']->select("SELECT `id`,`kat`,`download`,`date`,`hits` "
                      . "FROM `{prefix_downloads}`".(common::permission('dlintern') ? "" : " WHERE `intern` = 0")." "
                      . "ORDER BY `hits` ".(!settings::get('m_topdl') ? "DESC LIMIT ".settings::get('m_topdl').";" : ";"));
    $top_dl = '';
    if(common::$sql['default']->rowCount()) {
        foreach($qry as $get) {
            $info = '';
            if(settings::get('allowhover') == 1) {
                $getkat = common::$sql['default']->fetch("SELECT `name` FROM `{prefix_download_kat}` WHERE `id` = ?;",array($get['kat']));
                $info = 'onmouseover="DZCP.showInfo(\''.common::jsconvert(stringParser::decode($get['download'])).'\', \''._datum.';'._dl_dlkat.';'._hits.'\', \''.date("d.m.Y H:i", $get['date'])._uhr.';'.common::jsconvert(stringParser::decode($getkat['name'])).';'.$get['hits'].'\')" onmouseout="DZCP.hideInfo()"';
            }

            $top_dl .= show("menu/top_dl", array("id" => $get['id'],
                                                 "titel" => common::cut(stringParser::decode($get['download']),settings::get('l_topdl')),
                                                 "info" => $info,
                                                 "hits" => $get['hits']));
        }
    }

    return empty($top_dl) ? '<center style="margin:2px 0">'._no_entrys.'</center>' : '<table class="navContent" cellspacing="0">'.$top_dl.'</table>';
}