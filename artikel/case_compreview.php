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
    if($do == 'edit') {
        $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_acomments}` WHERE `id` = ?;",array(intval($_GET['cid'])));

        $get_id = '?';
        $get_userid = $get['reg'];
        $get_date = $get['datum'];
        $regCheck = false;

        if($get['reg']) {
            $regCheck = true;
            $pUId = $get['reg'];
        }

        $editedby = show(_edited_by, array("autor" => common::cleanautor(common::$userid),
                                           "time" => date("d.m.Y H:i", time())._uhr));
    } else {
        $get_id = common::cnt("{prefix_acomments}", " WHERE `artikel` = ?;","id",array(intval($_GET['id'])))+1;
        $get_userid = common::$userid;
        $get_date = time();
        $regCheck = false;
        $editedby = '';

        if(!common::$chkMe) {
            $regCheck = true;
            $pUId = common::$userid;
        }
    }

    if($regCheck) {
        $get_hp = isset($_POST['hp']) ? $_POST['hp'] : '';
        $get_email = isset($_POST['email']) ? $_POST['email'] : '';
        $get_nick = isset($_POST['nick']) ? $_POST['nick'] : '';

        $hp = $get_hp ? show(_hpicon_forum, array("hp" => common::links($get_hp))) : "";
        $email = $get_email ? '<br />'.common::CryptMailto($get_email,_emailicon_forum) : "";
        $onoff = ""; $avatar = "";


        $smarty->caching = true;
        $smarty->assign('nick',stringParser::decode($get_nick));
        $smarty->assign('email',$get_email);
        $nick = $smarty->fetch('string:'._link_mailto,common::getSmartyCacheHash('_link_mailto_'.$get_email.'_'.stringParser::decode($get_nick)));
        $smarty->clearAllAssign();
    } else {
        $hp = "";
        $email = "";
        $onoff = common::onlinecheck($get_userid);
        $nick = common::cleanautor($get_userid);
    }

    $titel = show(_eintrag_titel, array("postid" => $get_id,
                                        "datum" => date("d.m.Y", $get_date),
                                        "zeit" => date("H:i", $get_date)._uhr,
                                        "edit" => '',
                                        "delete" => ''));

    $index = show("page/comments_show", array("titel" => $titel,
                                              "comment" => bbcode::parse_html($_POST['comment']),
                                              "nick" => $nick,
                                              "editby" => bbcode::parse_html($editedby),
                                              "email" => $email,
                                              "hp" => $hp,
                                              "avatar" => common::useravatar($get_userid),
                                              "onoff" => $onoff,
                                              "rank" => common::getrank($get_userid),
                                              "ip" => common::$userip._only_for_admins));

    common::update_user_status_preview();
    header("Content-Type: text/html; charset=utf-8");
    exit(utf8_encode('<table class="mainContent" cellspacing="1">'.$index.'</table>'));
}