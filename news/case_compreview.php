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

if(defined('_News') && common::$chkMe >= 1) {
    //-> Edit news comment
    if($do == 'edit') {
        $get = common::$sql['default']->fetch("SELECT `reg`,`datum` FROM `{prefix_newscomments}` WHERE `id` = ?;",array(intval($_GET['cid'])));
        $get_postid = isset($_GET['cid']) && $_GET['cid'] >= 1 ? $_GET['cid'] : 1;
        $get_userid = $get['reg'];
        $get_date = $get['datum'];
        $regCheck = !$get['reg'] ? false : true;
        $editedby = show(_edited_by, array("autor" => common::cleanautor(common::$userid),
                                           "time" => date("d.m.Y H:i", time())._uhr));
    } else { //-> Add new news comment
        $get_postid = common::cnt('{prefix_newscomments}', " WHERE `news` = ".intval($_GET['id']))+1;
        $get_userid = common::$userid;
        $get_date = time();
        $regCheck = common::$chkMe >= 1 ? true : false;
        $editedby = '';
    }

    //-> Homepage Link
    $get_hp = common::data('hp',$get_userid); $hp = "";
    if (!empty($get_hp)) {
        $hp = show(_hpicon_forum, array("hp" => common::links($get_hp)));
    }

    //-> Post titel
    $smarty->caching = false;
    $smarty->assign('postid',$get_postid);
    $smarty->assign('datum',date("d.m.Y", $get_date));
    $smarty->assign('zeit',date("H:i", $get_date));
    $smarty->assign('edit','');
    $smarty->assign('delete','');
    $titel = $smarty->fetch('string:'._eintrag_titel);
    $smarty->clearAllAssign();

    //-> Post Index
    $smarty->caching = false;
    $smarty->assign('titel',$titel);
    $smarty->assign('comment',bbcode::parse_html($_POST['comment']));
    $smarty->assign('nick',common::cleanautor($get_userid));
    $smarty->assign('hp',$hp);
    $smarty->assign('editby',bbcode::parse_html($editedby));
    $smarty->assign('avatar',common::useravatar($get_userid));
    $smarty->assign('onoff',common::onlinecheck($get_userid));
    $smarty->assign('rank',common::getrank($get_userid));
    $smarty->assign('ip',common::$userip._only_for_admins);
    $index = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/comments_show.tpl');
    $smarty->clearAllAssign();

    //-> Update & Output
    common::update_user_status_preview();
    header('Content-Type: text/html; charset=utf-8');
    exit(utf8_encode('<table class="mainContent" cellspacing="1">'.$index.'</table>'));
}