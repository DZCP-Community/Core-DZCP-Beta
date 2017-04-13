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

## OUTPUT BUFFER START ##
include("../inc/buffer.php");

## INCLUDES ##
include(basePath."/inc/common.php");

## SETTINGS ##
$where = _site_dl;
$dir = "downloads";
define('_Downloads', true);
$smarty = common::getSmarty(); //Use Smarty

//-> Funktion um ein Datenbankinhalt zu highlighten
function highlight($word) {
    if (substr(phpversion(), 0, 1) == 5) {
        return str_ireplace($word, '<span class="fontRed">' . $word . '</span>', $word);
    } else {
        return str_replace($word, '<span class="fontRed">' . $word . '</span>', $word);
    }
}

if(file_exists(basePath."/downloads/case_".$action.".php"))
    require_once(basePath."/downloads/case_".$action.".php");

## INDEX OUTPUT ##
$title = common::$pagetitle." - ".$where;
common::page($index, $title, $where);