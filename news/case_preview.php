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

if(defined('_News')) {
    header("Content-type: text/html; charset=utf-8");
    $klapp = "";
    if($_POST['klapptitel']) {
        $klapp = show(_news_klapplink, ["klapplink" => stringParser::decode($_POST['klapptitel']),
                                             "which" => "collapse",
                                             "id" => "_prev"]);
    }

    $links1 = ""; $rel = "";
    if(!empty($_POST['url1'])) {
        $rel = _related_links;
        $links1 = show(_news_link, ["link" => stringParser::decode($_POST['link1']),
                                         "url" => common::links($_POST['url1'])]);
    }

    $links2 = "";
    if(!empty($_POST['url2'])) {
        $rel = _related_links;
        $links2 = show(_news_link, ["link" => stringParser::decode($_POST['link2']),
                                         "url" => common::links($_POST['url2'])]);
    }

    $links3 = "";
    if(!empty($_POST['url3'])) {
        $rel = _related_links;
        $links3 = show(_news_link, ["link" => stringParser::decode($_POST['link3']),
                                         "url" => common::links($_POST['url3'])]);
    }

    $links = '';
    if(!empty($links1) || !empty($links2) || !empty($links3)) {
        $links = show(_news_links, ["link1" => $links1,
                                         "link2" => $links2,
                                         "link3" => $links3,
                                         "rel" => $rel]);
    }

    $intern = ''; $sticky = '';
    if(isset($_POST['intern']) && $_POST['intern'] == 1) {
        $intern = _votes_intern;
    }
    
    if (isset($_POST['sticky']) && $_POST['sticky'] == 1) {
        $sticky = _news_sticky;
    }

    $newsimage = '../inc/images/newskat/'.stringParser::decode(common::$sql['default']->fetch("SELECT `katimg` FROM `{prefix_newskat}` WHERE `id` = ?;", [intval($_POST['kat'])],'katimg'));
    $viewed = show(_news_viewed, ["viewed" => '0']);
    $index = show($dir."/news_show_full", ["titel" => $_POST['titel'],
                                           "kat" => $newsimage,
                                           "id" => '_prev',
                                           "comments" => _news_comments_prev,
                                           "showmore" => "",
                                           "dp" => "",
                                           "notification_page" => "",
                                           "dir" => $designpath,
                                           "intern" => $intern,
                                           "sticky" => $sticky,
                                           "klapp" => $klapp,
                                           "more" => bbcode::parse_html($_POST['morenews']),
                                           "viewed" => $viewed,
                                           "text" => bbcode::parse_html($_POST['newstext']),
                                           "datum" => date("d.m.y H:i", time())._uhr,
                                           "links" => $links,
                                           "autor" => common::autor($_SESSION['id'])]);

    common::update_user_status_preview();
    header('Content-Type: text/html; charset=utf-8');
    exit(utf8_encode('<table class="mainContent" cellspacing="1">'.$index.'</table>'));
}