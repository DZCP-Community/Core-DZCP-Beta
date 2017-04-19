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

switch ($do) {
    case 'delete':
        common::$sql['default']->delete("DELETE FROM `{prefix_startpage}` WHERE `id` = ?;",array(intval($_GET['id'])));
        notification::add_success(_admin_startpage_deleted, "?admin=startpage");
    break;
    case 'edit':
        $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_startpage}` WHERE `id` = ?;",array(intval($_GET['id'])));
        if(isset($_POST['name']) && isset($_POST['url']) && isset($_POST['level'])) {
            if(empty($_POST['name']))
                notification::add_error(_admin_startpage_no_name);
            else if(empty($_POST['url']))
                notification::add_error(_admin_startpage_no_url);
            else {
                common::$sql['default']->update("UPDATE `{prefix_startpage}` SET `name` = ?, `url` = ?, `level` = ? WHERE `id` = ?;",
                        array(stringParser::encode($_POST['name']),stringParser::encode($_POST['url']),intval($_POST['level']),intval($_GET['id'])));
                
                notification::add_success(_admin_startpage_editd, "?admin=startpage");
            }
        }

        if(!notification::is_success()) {
            if(notification::has()) {
                javascript::set('AnchorMove', 'notification-box');
            }
            
            $selu = $get['level'] == 1 ? 'selected="selected"' : '';
            $selt = $get['level'] == 2 ? 'selected="selected"' : '';
            $selm = $get['level'] == 3 ? 'selected="selected"' : '';
            $sela = $get['level'] == 4 ? 'selected="selected"' : '';
            $elevel = show(_elevel_startpage_select, array("selu" => $selu,
                                                           "selt" => $selt,
                                                           "selm" => $selm,
                                                           "sela" => $sela));
            
            $show = show($dir."/startpage_form", array("head" => _admin_startpage_edit,
                                                        "do" => "edit&amp;id=".$_GET['id'],
                                                        "name" => (isset($_POST['name']) && !empty($_POST['name']) ? $_POST['name'] : stringParser::decode($get['name'])),
                                                        "url" => (isset($_POST['url']) ? $_POST['url'] : stringParser::decode($get['url'])),
                                                        "level" => $elevel,
                                                        "what" => _button_value_edit,
                                                        "error" => (!empty($error) ? show("errors/errortable", array("error" => $error)) : "")));
        }
    break;
    case 'new':
        if(isset($_POST['name']) && isset($_POST['url']) && isset($_POST['level'])) {
            if(empty($_POST['name']))
                notification::add_error(_admin_startpage_no_name);
            else if(empty($_POST['url']))
                notification::add_error(_admin_startpage_no_url);
            else {
                common::$sql['default']->insert("INSERT INTO `{prefix_startpage}` SET `name` = ?, `url` = ?, `level` = ?;",
                        array(stringParser::encode($_POST['name']),stringParser::encode($_POST['url']),intval($_POST['level'])));
                
                notification::add_success(_admin_startpage_added, "?admin=startpage");
            }
        }

        if(!notification::is_success()) {
            if(notification::has()) {
                javascript::set('AnchorMove', 'notification-box');
            }
            
            $elevel = show(_elevel_startpage_select, array("selu" => '',
                                                           "selt" => '',
                                                           "selm" => '',
                                                           "sela" => ''));
            
            $show = show($dir."/startpage_form", array("head" => _admin_startpage_add_head, "do" => "new", "name" => (isset($_POST['name']) ? $_POST['name'] : ''),
            "url" => (isset($_POST['url']) ? $_POST['url'] : ''), "level" => $elevel, "what" => _button_value_add, "error" => (!empty($error) ? show("errors/errortable", array("error" => $error)) : "")));
        }
    break;
    default:
        $qry = common::$sql['default']->select("SELECT * FROM `{prefix_startpage}`;"); $color = 0; $show = '';
        foreach($qry as $get) {
            $edit = show("page/button_edit_single", array("id" => $get['id'], "action" => "admin=startpage&amp;do=edit", "title" => _button_title_edit));
            $delete = show("page/button_delete_single", array("id" => $get['id'], "action" => "admin=startpage&amp;do=delete", "title" => _button_title_del, "del" => _confirm_del_entry));
            $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
            $show .= show($dir."/startpage_show", array("edit" => $edit, "name" => stringParser::decode($get['name']), "url" => stringParser::decode($get['url']), "class" => $class, "delete" => $delete));
        }

        if(empty($show)) {
            $smarty->caching = false;
            $smarty->assign('colspan',4);
            $show = $smarty->fetch('string:'._no_entrys_yet);
            $smarty->clearAllAssign();
        }

        $show = show($dir."/startpage", array("show" => $show));
    break;
}