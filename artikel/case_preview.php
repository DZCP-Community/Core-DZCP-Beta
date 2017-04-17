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
    $getkat = common::$sql['default']->fetch("SELECT `katimg` FROM `{prefix_newskat}` WHERE `id` = ?;", [intval($_POST['kat'])]);
    $links1 = ""; $links2 = ""; $links3 = ""; $links = "";
    if($_POST['url1']) {
        $rel = _related_links;
        $links1 = show(_artikel_link, ["link" => stringParser::decode($_POST['link1']),
                                            "url" => common::links(stringParser::decode($_POST['url1']))]);
    }
    
    if($_POST['url2']) {
        $rel = _related_links;
        $links2 = show(_artikel_link, ["link" => stringParser::decode($_POST['link2']),
                                            "url" => common::links(stringParser::decode($_POST['url2']))]);
    }
    
    if($_POST['url3']) {
        $rel = _related_links;
        $links3 = show(_artikel_link, ["link" => stringParser::decode($_POST['link3']),
                                            "url" => common::links(stringParser::decode($_POST['url3']))]);
    }

    if(!empty($links1) || !empty($links2) || !empty($links3)) {
        $links = show(_artikel_links, ["link1" => $links1,
                                            "link2" => $links2,
                                            "link3" => $links3,
                                            "rel" => $rel]);
    }

    $artikelimage = '../inc/images/newskat/'.stringParser::decode($getkat['katimg']);
    foreach(["jpg", "gif", "png"] as $tmpendung) {
        if(file_exists(basePath."/inc/images/uploads/artikel/".$get['id'].".".$tmpendung)) {
            $artikelimage = '../inc/images/uploads/artikel/'.$get['id'].'.'.$tmpendung;
            break;
        }
    }

    //BBCODE TEST
    $input = stringParser::decode($_POST['artikel'],false);

    $bbcode = new BBCode();
    $bbcode->SetTagMarker('[');
    $bbcode->SetAllowAmpersand(false);
    $bbcode->SetEnableSmileys(false);
    $bbcode->SetDetectURLs(true);
    $bbcode->SetPlainMode(false);

    $html = $bbcode->Parse($input);
    
    $index = show($dir."/show_more", ["titel" => $_POST['titel'],
                                           "id" => $get['id'],
                                           "comments" => "",
                                           "display" => "inline",
                                           "kat" => $artikelimage,
                                           "notification_page" => "",
                                           "showmore" => $showmore,
                                           "text" => $html,
                                           "datum" => date("j.m.y H:i")._uhr,
                                           "links" => $links,
                                           "autor" => common::autor(common::$userid)]);

    common::update_user_status_preview();
    header('Content-Type: text/html; charset=utf-8');
    exit(utf8_encode('<table class="mainContent" cellspacing="1">'.$index.'</table>'));
}