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
$where = $where.': '._member_admin_header;

switch ($do) {
    case "add":
        if(isset($_POST)) {
            if(empty($_POST['group']))
                $show = common::error(_admin_squad_no_squad, 1);
            else {
                common::$sql['default']->insert("INSERT INTO `{prefix_groups}` SET `name` = ?,`beschreibung` = ?",
                    array(stringParser::encode($_POST['group']),stringParser::encode($_POST['beschreibung'])));

                $show = common::info(_admin_squad_add_successful, "?admin=gruppen");
            }
        }

        $show = show($dir."/groups_add");
    break;
    case 'delete':
        common::$sql['default']->delete("DELETE FROM `{prefix_groups}` WHERE `id` = ?;",array((int)($_GET['id'])));
        common::$sql['default']->delete("DELETE FROM `{prefix_groupuser}` WHERE `group` = ?;",array((int)($_GET['id'])));
        $show = common::info(_admin_squad_deleted, "?admin=gruppen");
    break;
    case 'edit':
        if(isset($_POST)) {
            if (empty($_POST['group']))
                $show = common::error(_admin_squad_no_squad, 1);
            else {
                common::$sql['default']->update("UPDATE `{prefix_groups}` SET `name` = ?, `beschreibung` = ? WHERE `id` = ?;",
                    array(stringParser::encode($_POST['group']),stringParser::encode($_POST['beschreibung']),(int)($_GET['id'])));

                $show = common::info(_admin_squad_edit_successful, "?admin=gruppen");
            }
        }

        $get = common::$sql['default']->fetch("SELECT `id`,`name`,`beschreibung` FROM `{prefix_groups}` WHERE id = '".(int)($_GET['id'])."'");
        $show = show($dir."/groups_edit", array("id" => $get['id'],
                                                "sgroup" => stringParser::decode($get['name']),
                                                "beschreibung" => stringParser::decode($get['beschreibung'])));
    break;
    default:
        $qry = common::$sql['default']->select("SELECT * FROM `{prefix_groups}` ORDER BY id"); $groups = '';
        foreach($qry as $get) {
            $edit = common::getButtonEditSingle($get['id'],"admin=".$admin."&amp;do=edit");
            $delete = common::button_delete_single($get['id'],"admin=".$admin."&amp;do=delete",_button_title_del,_confirm_del_team);

            $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
            $groups .= show($dir."/groups_show", array("squad" => stringParser::decode($get['name']),"edit" => $edit, "class" => $class, "delete" => $delete));
        }

        $show = show($dir."/groups", array("groups" => $groups));
    break;
}