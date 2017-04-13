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

if(_adminMenu != 'true') exit;

$where = $where.': '._config_impressum_head;

if($do == "update") {
    if(settings::changed(($key='i_autor'),($var=stringParser::encode($_POST['seitenautor'])))) settings::set($key,$var);
    if(settings::changed(($key='i_domain'),($var=stringParser::encode($_POST['domain'])))) settings::set($key,$var);
    settings::load(true);
    $show = common::info(_config_set, "?admin=impressum");
} else {
    $show = show($dir."/form_impressum", array("domain" =>stringParser::decode(settings::get('i_domain')),
                                               "bbcode" => bbcode::parse_html("seitenautor"),
                                               "postautor" =>stringParser::decode(settings::get('i_autor'))));

    $show = show($dir."/imp", array("what" => "impressum", "value" => _button_value_edit, "show" => $show));
}