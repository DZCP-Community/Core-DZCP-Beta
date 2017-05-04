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
    $where = _site_ulist;
    $entrys = common::cnt('{prefix_users}'," WHERE level != 0");
    $show_sql = isset($_GET['show']) ? $_GET['show'] : '';
    $limit_sql = ($page - 1)*settings::get('m_userlist').",".settings::get('m_userlist');
    $select_sql = "`id`,`nick`,`level`,`email`,`hp`,`bday`,`sex`,`status`,`position`,`regdatum`";
    
    switch (isset($_GET['show']) ? $_GET['show'] : '') {
        case 'search':
            $qry = common::$sql['default']->select("SELECT ".$select_sql." "
                              . "FROM `{prefix_users}` "
                              . "WHERE `nick` LIKE ? AND `level` != 0 "
                              . common::orderby_sql(array("nick","bday"), 'ORDER BY `nick`')." "
                              . "LIMIT ".$limit_sql.";",
                    array('%'.stringParser::encode($_GET['search']).'%'));
        break;
        case 'newreg':
            $qry = common::$sql['default']->select("SELECT ".$select_sql." "
                              . "FROM `{prefix_users}` "
                              . "WHERE regdatum > ? AND `level` != 0 "
                              . common::orderby_sql(array("nick","bday"), 'ORDER BY `regdatum` DESC,`nick`')." "
                              . "LIMIT ".$limit_sql.";",
                    array($_SESSION['lastvisit']));
        break;
        case 'lastlogin':
            $qry = common::$sql['default']->select("SELECT ".$select_sql." "
                              . "FROM `{prefix_users}` "
                              . "WHERE `level` != 0 "
                              . common::orderby_sql(array("nick","bday"), 'ORDER BY `time` DESC,`nick`')." "
                              . "LIMIT ".$limit_sql.";");
        break;
        case 'lastreg':
            $qry = common::$sql['default']->select("SELECT ".$select_sql." "
                              . "FROM `{prefix_users}` "
                              . "WHERE `level` != 0 "
                              . common::orderby_sql(array("nick","bday"), 'ORDER BY `regdatum` DESC,`nick`')." "
                              . "LIMIT ".$limit_sql.";");
        break;
        case 'online':
            $qry = common::$sql['default']->select("SELECT ".$select_sql." "
                              . "FROM `{prefix_users}` "
                              . "WHERE `level` != 0 "
                              . common::orderby_sql(array("nick","bday"), 'ORDER BY `time` DESC,`nick`')." "
                              . "LIMIT ".$limit_sql.";");
        break;
        case 'country':
            $qry = common::$sql['default']->select("SELECT ".$select_sql." "
                              . "FROM `{prefix_users}` "
                              . "WHERE `level` != 0 "
                              . common::orderby_sql(array("nick","bday"), 'ORDER BY `country`,`nick`')." "
                              . "LIMIT ".$limit_sql.";");
        break;
        case 'sex':
            $qry = common::$sql['default']->select("SELECT ".$select_sql." "
                              . "FROM `{prefix_users}` "
                              . "WHERE `level` != 0 "
                              . common::orderby_sql(array("nick","bday"), 'ORDER BY `sex` DESC')." "
                              . "LIMIT ".$limit_sql.";");
        break;
        case 'banned':
            $qry = common::$sql['default']->select("SELECT ".$select_sql." "
                              . "FROM `{prefix_users}` "
                              . "WHERE `level` = 0 "
                              . common::orderby_sql(array("nick","bday"), 'ORDER BY `nick`')." "
                              . "LIMIT ".$limit_sql.";");
        break;
        default:
            $qry = common::$sql['default']->select("SELECT ".$select_sql." "
                              . "FROM `{prefix_users}` "
                              . "WHERE `level` != 0 "
                              . common::orderby_sql(array("nick","bday"), 'ORDER BY `level` DESC,`nick`')." "
                              . "LIMIT ".$limit_sql.";");
        break;
    }

    $userliste = '';
    foreach($qry as $get) {
        $hp = empty($get['hp']) ? "-" : show(_hpicon, array("hp" => $get['hp']));
        $getstatus = $get['status'] ? _aktiv_icon : _inaktiv_icon;
        common::$sql['default']->fetch("SELECT `id` FROM `{prefix_groupuser}` WHERE `user` = 1;");
        $status = common::data("level",$get['id']) > 1 && common::$sql['default']->rowCount() ? $getstatus : "-";
        $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;

        $edit = ""; $delete = ""; $full_delete = "";
        if(common::permission("editusers")) {
            //Bearbeiten link
            $smarty->caching = false;
            $smarty->assign('id',0);
            $smarty->assign('action',"action=admin&amp;edit=".$get['id']);
            $smarty->assign('title',_button_title_edit);
            $edit = $smarty->fetch('file:['.common::$tmpdir.']page/buttons/button_edit.tpl');
            $smarty->clearAllAssign();

            //Loschen link ohne Forum Posts/Threads
            $smarty->caching = false;
            $smarty->assign('id',$get['id']);
            $smarty->assign('action',"action=admin&amp;do=delete");
            $smarty->assign('title',_button_title_del.' ohne Forum Posts/Threads');
            $delete = $smarty->fetch('file:['.common::$tmpdir.']page/buttons/button_delete.tpl');
            $smarty->clearAllAssign();

            //Loschen link mit Forum Posts/Threads
            $smarty->caching = false;
            $smarty->assign('id',$get['id']);
            $smarty->assign('action',"action=admin&amp;do=full_delete");
            $smarty->assign('title',_button_title_del.' mit Forum Posts/Threads');
            $full_delete = $smarty->fetch('file:['.common::$tmpdir.']page/buttons/button_delete_full.tpl');
            $smarty->clearAllAssign();
        }

        //Show User
        $smarty->caching = true;
        $smarty->assign('nick',common::autor($get['id'],'','',10));
        $smarty->assign('level',common::getrank($get['id']));
        $smarty->assign('status',$status,true);
        $smarty->assign('age',common::getAge($get['bday']));
        $smarty->assign('mf',($get['sex'] == 1 ? _maleicon : ($get['sex'] == 2 ? _femaleicon : '-')));
        $smarty->assign('edit',$edit);
        $smarty->assign('delete',$delete);
        $smarty->assign('full_delete',$full_delete);
        $smarty->assign('class',$class);
        $smarty->assign('onoff',common::onlinecheck($get['id']),true);
        $smarty->assign('hp',$hp);
        $userliste .= $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/userliste/userliste_show.tpl',common::getSmartyCacheHash('userlist_id_'.$get['id']));
        $smarty->clearAllAssign();
    }
    
    $userliste = (empty($userliste) ? show(_no_entrys_found, array("colspan" => "13")) : $userliste);
    $seiten = common::nav($entrys,settings::get('m_userlist'),"?action=userlist".(!empty($show_sql) ? "&show=".$show_sql : "").common::orderby_nav());
    $edel = common::permission("editusers") ? '<td class="contentMainTop" colspan="3">&nbsp;</td>' : "";
    $search = isset($_GET['search']) && !empty($_GET['search']) ? $_GET['search'] : _nick;

    //Show Userlist
    $smarty->caching = false;
    $smarty->assign('cnt',$entrys." "._user);
    $smarty->assign('edel',$edel);
    $smarty->assign('search',$search);
    $smarty->assign('nav',$seiten);
    $smarty->assign('order_nick',common::orderby('nick'));
    $smarty->assign('order_age',common::orderby('bday'));
    $smarty->assign('show',$userliste);
    $index = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/userliste/userliste.tpl');
    $smarty->clearAllAssign();
}