<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 * Menu: Last Articles
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