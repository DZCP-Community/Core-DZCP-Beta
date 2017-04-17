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

if (!defined('_Downloads')) exit();

$qry = common::$sql['default']->select("SELECT * FROM `{prefix_download_kat}` ORDER BY `name`;");
$t = 1; $cnt = 0; $kats = '';
foreach($qry as $get) {
    $intern =  common::permission('dlintern') ? "" : "AND `intern` = 0 "; $show = "";
    $qrydl = common::$sql['default']->select("SELECT * FROM `{prefix_downloads}` WHERE `kat` = ? ".$intern."ORDER BY `download`;", [$get['id']]);
    if(common::$sql['default']->rowCount()) {
        $display = "none"; $img = "expand";
        foreach($qrydl as $getdl) {
            if(isset($_GET['hl']) && intval($_GET['hl']) == $getdl['id']) {
                $display = "";
                $img = "collapse";
                $download = highlight(stringParser::decode($getdl['download']));
            } else
                $download = stringParser::decode($getdl['download']);

            $link = show(_downloads_link, ["id" => $getdl['id'],
                                                "download" => $download,
                                                "titel" => stringParser::decode($getdl['download'])]);

            $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
            $show .= show($dir."/downloads_show", ["class" => $class,
                                                        "link" => $link,
                                                        "kid" => $get['id'],
                                                        "display" => $display,
                                                        "beschreibung" => bbcode::parse_html($getdl['beschreibung']),
                                                        "hits" => $getdl['hits']]);
        }

        $cntKat = common::cnt("{prefix_downloads}", " WHERE `kat` = ?","id", [$get['id']]);
        $dltitel = ($cntKat == 1 ? _dl_file : _site_stats_files);
        $kat = show(_dl_titel, ["id" => $get['id'],
                                     "file" => $dltitel,
                                     "cnt" => $cntKat,
                                     "name" => stringParser::decode($get['name'])]);

        $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
        $kats .= show($dir."/download_kats", ["kat" => $kat,
                                                   "class" => $class,
                                                   "kid" => $get['id'],
                                                   "img" => $img,
                                                   "show" => $show,
                                                   "display" => $display]);
    }
}

$index = show($dir."/downloads", ["kats" => $kats]);