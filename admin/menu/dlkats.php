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
$where = $where.': '._admin_dlkat;

switch ($do) {
    case 'edit':
        $get = common::$sql['default']->fetch("SELECT `name` FROM `{prefix_download_kat}` WHERE `id` = ?;",
                array(intval($_GET['id'])));
        $show = show($dir."/dlkats_form", array("newhead" => _dl_edit_head,
                                                "do" => "editkat&amp;id=".$_GET['id']."",
                                                "kat" => stringParser::decode($get['name']),
                                                "what" => _button_value_edit));
    break;
    case 'editkat':
        if(empty($_POST['kat'])) {
            $show = common::error(_dl_empty_kat,1);
        } else {
            common::$sql['default']->update("UPDATE `{prefix_download_kat}` SET `name` = ? WHERE `id` = ?;",
                    array(stringParser::encode($_POST['kat']),intval($_GET['id'])));
            $show = common::info(_dl_admin_edited, "?admin=dlkats");
        }
    break;
    case 'delete':
        common::$sql['default']->delete("DELETE FROM `{prefix_download_kat}` WHERE `id` = ?;",
                array(intval($_GET['id'])));
        $show = common::info(_dl_admin_deleted, "?admin=dlkats");
    break;
    case 'new':
        $show = show($dir."/dlkats_form", array("newhead" => _dl_new_head,
                                                "do" => "add",
                                                "kat" => "",
                                                "what" => _button_value_add));
    break;
    case 'add':
        if(empty($_POST['kat'])) {
            $show = common::error(_dl_empty_kat,1);
        } else {
            common::$sql['default']->insert("INSERT INTO `{prefix_download_kat}` SET `name` = ?;",
                  array(stringParser::encode($_POST['kat'])));
            $show = common::info(_dl_admin_added, "?admin=dlkats");
        }
    break;
    default:
        $qry = common::$sql['default']->select("SELECT * FROM `{prefix_download_kat}` ORDER BY `name`;");
        foreach($qry as $get) {
            $edit = common::getButtonEditSingle($get['id'],"admin=".$admin."&amp;do=edit");

            $delete = show("page/button_delete_single", array("id" => $get['id'],
                                                              "action" => "admin=dlkats&amp;do=delete",
                                                              "title" => _button_title_del,
                                                              "del" => _confirm_del_kat));

            $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
            $show .= show($dir."/dlkats_show", array("edit" => $edit,
                                                     "name" => stringParser::decode($get['name']),
                                                     "class" => $class,
                                                     "delete" => $delete));
        }

        $show = show($dir."/dlkats", array("show" => $show));
    break;
}