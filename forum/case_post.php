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

if(defined('_Forum')) {
    switch ($do) {
        case 'edit':
            include(basePath."/forum/test/edit.php");
        break;
        case 'editpost':
            include(basePath."/forum/test/editpost.php");
        break;
        case 'add':
            include(basePath."/forum/test/add.php");
        break;
        case 'addpost':
            include(basePath."/forum/test/addpost.php");
        break;
        case 'delete':
            include(basePath."/forum/test/delete.php");
        break;
    }
}