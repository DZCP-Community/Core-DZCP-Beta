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
$where = $where.': '._ipban_head_admin;
switch ($do) {
    case 'add':
        if(empty($_POST['ip']))
            $show = common::error(_ip_empty);
        else if(common::validateIpV4Range($_POST['ip'], '[192].[168].[0-255].[0-255]') ||
                common::validateIpV4Range($_POST['ip'], '[127].[0].[0-255].[0-255]') ||
                common::validateIpV4Range($_POST['ip'], '[10].[0-255].[0-255].[0-255]') ||
                common::validateIpV4Range($_POST['ip'], '[172].[16-31].[0-255].[0-255]'))
            $show = common::error(_ipban_error_pip);
        else {
            if(empty($_POST['info']))
                $info = '*Keine Info*';
            else
                $info = stringParser::encode($_POST['info']);

            $data_array = array();
            $data_array['confidence'] = ''; $data_array['frequency'] = ''; $data_array['lastseen'] = '';
            $data_array['banned_msg'] = $info;
            common::$sql['default']->insert("INSERT INTO `{prefix_ipban}` SET `time` = ?, `ip` = ?,, `data` = ?, `typ` = 3;",
                    array(time(),stringParser::encode($_POST['ip']),serialize($data_array)));
            $show = common::info(_ipban_admin_added, "?admin=ipban");
        }
    break;
    case 'delete':
        common::$sql['default']->delete("DELETE FROM `{prefix_ipban}` WHERE `id` = ?;",array((int)($_GET['id'])));
        $show = common::info(_ipban_admin_deleted, "?admin=ipban");
    break;
    case 'edit':
        $get = common::$sql['default']->fetch("SELECT `ip`,`data` FROM `{prefix_ipban}` WHERE `id` = ?;",array((int)($_GET['id'])));
        $data_array = unserialize($get['data']);
        $show = show($dir."/ipban_form", array("newhead" => _ipban_edit_head,
            "do" => "edit_save&amp;id=".$_GET['id']."","ip_set" => stringParser::decode($get['ip']),
            "info" => stringParser::decode($data_array['banned_msg']),"what" => _button_value_edit));
    break;
    case 'edit_save':
        if(empty($_POST['ip']))
            $show = common::error(_ip_empty);
        else {
            $get = common::$sql['default']->fetch("SELECT `id`,`data` FROM `{prefix_ipban}` WHERE `id` = ?;",array((int)($_GET['id'])));
            $data_array = unserialize($get['data']);
            $data_array['banned_msg'] = stringParser::decode($_POST['info']);
            common::$sql['default']->update("UPDATE `{prefix_ipban}` SET `ip` = ?, `time` = ?, `data` = ? WHERE `id` = ?;",
                    array(stringParser::encode($_POST['ip']),time(),serialize($data_array),(int)($get['id'])));
            $show = common::info(_ipban_admin_edited, "?admin=ipban");
        }
    break;
    case 'enable':
        $get = common::$sql['default']->fetch("SELECT `id`,`enable` FROM `{prefix_ipban}` WHERE `id` = ?;",array((int)($_GET['id'])));
        common::$sql['default']->update("UPDATE `{prefix_ipban}` SET `enable` = ? WHERE `id` = ?;",array(($get['enable'] ? 0 : 1),$get['id']));
        $show = header("Location: ?admin=ipban&sfs_side=".(isset($_GET['sfs_side']) ? $_GET['sfs_side'] : 1)."&ub_side=".(isset($_GET['ub_side']) ? $_GET['ub_side'] : 1));
    break;
    case 'new':
        $show = show($dir."/ipban_form", array("newhead" => _ipban_new_head, "do" => "add", "ip_set" => '', "info" => '', "what" => _button_value_add));
    break;
    case 'search':
        $qry = common::$sql['default']->select("SELECT * FROM `{prefix_ipban}` WHERE `ip` LIKE '%?%' ORDER BY `ip` ASC;",array(stringParser::encode($_POST['ip']))); //Suche
        $color = 1; $show_search = '';
        foreach($qry as $get) {
            $data_array = unserialize($get['data']);

            $edit = '';
            if($get['typ'] == '3')
                $edit = common::getButtonEditSingle($get['id'],"admin=".$admin."&amp;do=edit");
            
            $action = "?admin=ipban&amp;do=enable&amp;id=".$get['id']."&amp;ub_side=".(isset($_GET['ub_side']) ? $_GET['ub_side'] : 1)."&amp;sfs_side=".(isset($_GET['sfs_side']) ? $_GET['sfs_side'] : 1);
            $unban = ($get['enable'] ? show(_ipban_menu_icon_enable, array("id" => $get['id'], "action" => $action, "info" => show(_confirm_disable_ipban,array('ip'=>$get['ip'])))) : show(_ipban_menu_icon_disable, array("id" => $get['id'], "action" => $action, "info" => show(_confirm_enable_ipban,array('ip'=>$get['ip'])))));
            $delete = common::button_delete_single($get['id'],"admin=".$admin."&amp;do=delete",_button_title_del,_confirm_del_ipban);
            $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
            $show_search .= show($dir."/ipban_show_user", array("ip" => stringParser::decode($get['ip']), "bez" => stringParser::decode($data_array['banned_msg']), "rep" => stringParser::decode($data_array['frequency']), "zv" => stringParser::decode($data_array['confidence']).'%', "class" => $class, "delete" => $delete, "edit" => $edit, "unban" => $unban));
        }

        if(empty($show_search))
            $show_search = '<tr><td colspan="7" class="contentMainSecond">'._no_entrys.'</td></tr>';

        $show = show($dir."/ipban_search", array("value" => _button_value_save, "show" => $show_search));
    break;
    default:
        //typ: 0 = Off, 1 = GSL, 2 = SysBan, 3 = Ipban
        $show = ''; $show_sfs = ''; $show_user = '';
        $pager_sfs = ''; $pager_user = '';

        $count_spam = common::$sql['default']->rows("SELECT `id` FROM `{prefix_ipban}` WHERE `typ` = 1;"); //Type 1 => Global Stopforumspam.com List
        if($count_spam >= 1) {
            $site = (isset($_GET['sfs_side']) ? $_GET['sfs_side'] : 1);
            if($site < 1) $site = 1; $end = $site*20; $start = $end-20;
            $count_spam_nav = common::$sql['default']->rows("SELECT id FROM `{prefix_ipban}` WHERE `typ` = 1 ORDER BY `id` DESC LIMIT ".$start.", 20;"); //Type Userban ROW
            if($start != 0)
                $pager_sfs = '<a href="?admin=ipban&sfs_side='.($site-1).'&ub_side='.(isset($_GET['ub_side']) ? $_GET['ub_side'] : 1).'"><img align="absmiddle" src="../inc/images/previous.png" alt="left" /></a>';
            else
                $pager_sfs = '<img src="../inc/images/previous.png" align="absmiddle" alt="left" class="disabled" />';

            $pager_sfs .=  '&nbsp;'.($start+1).' bis '.($count_spam_nav+$start).'&nbsp;';

            if($count_spam_nav >= 20 )
                $pager_sfs .=  '<a href="?admin=ipban&sfs_side='.($site+1).'&ub_side='.(isset($_GET['ub_side']) ? $_GET['ub_side'] : 1).'"><img align="absmiddle" src="../inc/images/next.png" alt="right" /></a>';
            else
                $pager_sfs .= '<img src="../inc/images/next.png" alt="right" align="absmiddle" class="disabled" />';

            $qry = common::$sql['default']->select("SELECT * FROM `{prefix_ipban}` WHERE `typ` = 1 ORDER BY `id` DESC LIMIT ".$start.", 20;"); $color = 1;
            foreach($qry as $get) {
                $data_array = unserialize($get['data']);
                $delete = common::button_delete_single($get['id'],"admin=".$admin."&amp;do=delete",_button_title_del,_confirm_del_ipban);
                $action = "?admin=ipban&amp;do=enable&amp;id=".$get['id']."&amp;sfs_side=".($site)."&amp;ub_side=".(isset($_GET['ub_side']) ? $_GET['ub_side'] : 1);
                $unban = ($get['enable'] ? show(_ipban_menu_icon_enable, array("id" => $get['id'], "action" => $action, "info" => show(_confirm_disable_ipban,array('ip'=>$get['ip'])))) : show(_ipban_menu_icon_disable, array("id" => $get['id'], "action" => $action, "info" => show(_confirm_enable_ipban,array('ip'=>$get['ip'])))));
                $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
                $show_sfs .= show($dir."/ipban_show_sfs", array("ip" => stringParser::decode($get['ip']), "bez" => stringParser::decode($data_array['banned_msg']), "rep" => stringParser::decode($data_array['frequency']), "zv" => stringParser::decode($data_array['confidence']).'%', "class" => $class, "delete" => $delete, "unban" => $unban));
            }
        }

        //Empty
        if(empty($show_sfs))
            $show_sfs = '<tr><td colspan="8" class="contentMainSecond">'._no_entrys.'</td></tr>';

        $count_user = common::$sql['default']->rows("SELECT id FROM `{prefix_ipban}` WHERE typ = 3;"); //Type 3 => Usersban
        if($count_user >= 1) {
            $site = (isset($_GET['ub_side']) ? $_GET['ub_side'] : 1);

            if($site < 1) $site = 1;
            $end = $site*20;
            $start = $end-20;

            $count_user_nav = common::$sql['default']->rows("SELECT id FROM `{prefix_ipban}` WHERE typ = 3 ORDER BY id DESC LIMIT ".$start.", 20;"); //Type System Ban ROW

            if($start != 0)
                $pager_user = '<a href="?admin=ipban&ub_side='.($site-1).'&sfs_side='.(isset($_GET['sfs_side']) ? $_GET['sfs_side'] : 1).'"><img align="absmiddle" src="../inc/images/previous.png" alt="left" /></a>';
            else
                $pager_user = '<img src="../inc/images/previous.png" align="absmiddle" alt="left" class="disabled" />';

            $pager_user .=  '&nbsp;'.($start+1).' bis '.($count_user_nav+$start).'&nbsp;';

            if($count_user_nav >= 20 )
                $pager_user .=  '<a href="?admin=ipban&ub_side='.($site+1).'&sfs_side='.(isset($_GET['sfs_side']) ? $_GET['sfs_side'] : 1).'"><img align="absmiddle" src="../inc/images/next.png" alt="right" /></a>';
            else
                $pager_user .= '<img src="../inc/images/next.png" alt="right" align="absmiddle" class="disabled" />';

            $qry = common::$sql['default']->select("SELECT * FROM `{prefix_ipban}` WHERE typ = 3 ORDER BY id DESC LIMIT ".$start.", 20;"); $color = 1;
            foreach($qry as $get) {
                $data_array = unserialize($get['data']);
                $edit = common::getButtonEditSingle($get['id'],"admin=".$admin."&amp;do=edit");
                $delete = common::button_delete_single($get['id'],"admin=".$admin."&amp;do=delete",_button_title_del,_confirm_del_ipban);
                $action = "?admin=ipban&amp;do=enable&amp;id=".$get['id']."&amp;ub_side=".($site)."&amp;sfs_side=".(isset($_GET['sfs_side']) ? $_GET['sfs_side'] : 1);
                $unban = ($get['enable'] ? show(_ipban_menu_icon_enable, array("id" => $get['id'], "action" => $action, "info" => show(_confirm_disable_ipban,array('ip'=>$get['ip'])))) : show(_ipban_menu_icon_disable, array("id" => $get['id'], "action" => $action, "info" => show(_confirm_enable_ipban,array('ip'=>$get['ip'])))));
                $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
                $show_user .= show($dir."/ipban_show_user", array("ip" => stringParser::decode($get['ip']), "bez" => stringParser::decode($data_array['banned_msg']), "class" => $class, "delete" => $delete, "edit" => $edit, "unban" => $unban));
            }
        }

        if(empty($show_user))
            $show_user = '<tr><td colspan="8" class="contentMainSecond">'._no_entrys.'</td></tr>';

        $show = show($dir."/ipban", array("show_spam" => $show_sfs,
                                          "show_user" => $show_user,
                                          "count_user" => $count_user,
                                          "count_spam" => $count_spam,
                                          "pager_sfs" => $pager_sfs,
                                          "pager_user" => $pager_user));
    break;
}