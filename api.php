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

define('is_api', true);
define('basePath', dirname(__FILE__));
include(basePath . "/inc/common.php");
if (isset($_GET['conjob'])) {
    //Run by ZendServer @ 30 Min
    $conjob = new conjob();
    $conjob->run();
    echo $conjob->getOutput();
} else {
    $event = new dzcp_event();
    switch ($event->getEvent()) {
        case 'version':
            $version = new dzcp_version();
            $version->getContentType();
            $version->getVersion();
            break;
        case 'news':
            $news = new dzcp_news();
            $news->getContentType();
            $news->getNews();
            break;
    }
}