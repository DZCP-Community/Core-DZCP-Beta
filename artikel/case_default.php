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

if(defined('_Artikel')) {
    $qry = common::$sql['default']->select("SELECT `id`,`kat`,`titel`,`datum`,`autor`,`text` "
            . "FROM `{prefix_artikel}` "
            . "WHERE `public` = 1 ".common::orderby_sql(array("artikel","titel","datum","kat"), 'ORDER BY `datum` DESC')." "
            . "LIMIT ".($page - 1)*settings::get('m_artikel').",".settings::get('m_artikel').";");

    if(common::$sql['default']->rowCount()) {
        foreach($qry as $get) {
            $getk = common::$sql['default']->fetch("SELECT `kategorie` FROM `{prefix_newskat}` WHERE `id` = ?;",array($get['kat']));
            $titel = '<a style="display:block" href="?action=show&amp;id='.$get['id'].'">'.stringParser::decode($get['titel']).'</a>';
            $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
            $show .= show($dir."/artikel_show", array("titel" => $titel,
                                                      "kat" => stringParser::decode($getk['kategorie']),
                                                      "id" => $get['id'],
                                                      "display" => "none",
                                                      "class" => $class,
                                                      "text" => bbcode::parse_html($get['text']),
                                                      "datum" => date("d.m.Y", $get['datum']),
                                                      "autor" => common::autor($get['autor'])));
        }
    } else {
        $show = show(_no_entrys_yet, array("colspan" => "4"));
    }

    $seiten = common::nav(common::cnt("{prefix_artikel}"),settings::get('m_artikel'),"?page".(isset($_GET['show']) ? $_GET['show'] : 0).common::orderby_nav());
    $index = show($dir."/artikel", array("show" => $show,
                                         "nav" => $seiten,
                                         "order_autor" => common::orderby('autor'),
                                         "order_datum" => common::orderby('datum'),
                                         "order_titel" => common::orderby('titel'),
                                         "order_kat" => common::orderby('kat')));
}