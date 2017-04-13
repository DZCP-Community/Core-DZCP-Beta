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

if(defined('_UserMenu')) {
    header("Content-type: text/html; charset=utf-8");
    if($regCheck) {
        $get_hp = $_POST['hp'];
        $get_email = $_POST['email'];
        $get_nick = $_POST['nick'];

        $onoff = ""; $avatar = "";
        $nick = common::CryptMailto($get_email,_link_mailto,array("nick" => stringParser::decode($get_nick)));
    } else {
        $get_hp = common::data('hp');
        $email = common::data('email');
        $onoff = common::onlinecheck(common::$userid);
        $get_nick = common::autor(common::$userid);
    }

    $gbhp =  $get_hp ? show(_hpicon, array("hp" => common::links($get_hp))) : "";
    $gbemail = $get_email ? common::CryptMailto($get_email,_emailicon) : "";
    $titel = show(_eintrag_titel, array("postid" => $get_id,
                                        "datum" => date("d.m.Y", time()),
                                        "zeit" => date("H:i", time())._uhr,
                                        "edit" => $edit,
                                        "delete" => $delete));

    $posted_ip = common::$chkMe == 4 || common::permission('ipban') ? common::visitorIp() : _logged;
    $index .= show("page/comments_show", array("titel" => $titel,
                                             "comment" => bbcode::parse_html(stringParser::decode($_POST['eintrag']),1),
                                             "nick" => $get_nick,
                                             "hp" => $gbhp,
                                             "editby" => $editby,
                                             "email" => $gbemail,
                                             "avatar" => common::useravatar(),
                                             "onoff" => $onoff,
                                             "rank" => common::getrank(common::$userid),
                                             "ip" => $posted_ip));

    common::update_user_status_preview();
    exit(utf8_encode('<table class="mainContent" cellspacing="1">'.$index.'</table>'));
}
