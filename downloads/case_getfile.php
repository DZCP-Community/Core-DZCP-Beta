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

if(settings::get("reg_dl") && !common::$chkMe)
    $index = common::error(_error_unregistered,1);
else {
    $get = common::$sql['default']->fetch("SELECT `url`,`id` FROM `{prefix_downloads}` WHERE `id` = ?;",array(intval($_GET['id'])));
    $file = preg_replace("#added...#Uis", "", stringParser::decode($get['url']));
    if(preg_match("=added...=Uis",stringParser::decode($get['url'])) != FALSE)
        $dlFile = "files/".$file;
    else
        $dlFile = stringParser::decode($get['url']);

    if(common::count_clicks('download',$get['id']))
        common::$sql['default']->update("UPDATE `{prefix_downloads}` SET `hits` = (hits+1), `last_dl` = ? WHERE `id` = ?;",array(time(),$get['id']));

    ## download file ##
    header("Location: ".$dlFile);
}