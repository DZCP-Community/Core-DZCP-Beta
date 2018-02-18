<?php
/**
 * DZCP - deV!L`z ClanPortal - Mainpage ( dzcp.de )
 * deV!L`z Clanportal ist ein Produkt von CodeKing,
 * geändert durch my-STARMEDIA und Codedesigns.
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

if (file_exists(basePath . '/inc/additional-kernel/addon_api/common.php')) {
    if (!defined('basePathAPI')) {
        define('basePathAPI', basePath . "/inc/additional-kernel/addon_api");
    }
    require_once(basePath . '/inc/additional-kernel/addon_api/common.php');
} else DebugConsole::insert_warning('additional-kernel/addon_api.php', basePath . '/inc/additional-kernel/addon_api/common.php not found!');