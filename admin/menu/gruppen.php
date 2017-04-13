<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
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
        common::$sql['default']->delete("DELETE FROM `{prefix_groups}` WHERE `id` = ?;",array(intval($_GET['id'])));
        common::$sql['default']->delete("DELETE FROM `{prefix_groupuser}` WHERE `group` = ?;",array(intval($_GET['id'])));
        $show = common::info(_admin_squad_deleted, "?admin=gruppen");
    break;
    case 'edit':
        if(isset($_POST)) {
            if (empty($_POST['group']))
                $show = common::error(_admin_squad_no_squad, 1);
            else {
                common::$sql['default']->update("UPDATE `{prefix_groups}` SET `name` = ?, `beschreibung` = ? WHERE `id` = ?;",
                    array(stringParser::encode($_POST['group']),stringParser::encode($_POST['beschreibung']),intval($_GET['id'])));

                $show = common::info(_admin_squad_edit_successful, "?admin=gruppen");
            }
        }

        $get = common::$sql['default']->fetch("SELECT `id`,`name`,`beschreibung` FROM `{prefix_groups}` WHERE id = '".intval($_GET['id'])."'");
        $show = show($dir."/groups_edit", array("id" => $get['id'],
                                                "sgroup" => stringParser::decode($get['name']),
                                                "beschreibung" => stringParser::decode($get['beschreibung'])));
    break;
    default:
        $qry = common::$sql['default']->select("SELECT * FROM `{prefix_groups}` ORDER BY id"); $groups = '';
        foreach($qry as $get) {
            $edit = show("page/button_edit_single", array("id" => $get['id'],
                    "action" => "admin=gruppen&amp;do=edit",
                    "title" => _button_title_edit));

            $delete = show("page/button_delete_single", array("id" => $get['id'],
                    "action" => "admin=gruppen&amp;do=delete",
                    "title" => _button_title_del,
                    "del" => _confirm_del_team));

            $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
            $groups .= show($dir."/groups_show", array("squad" => stringParser::decode($get['name']),"edit" => $edit, "class" => $class, "delete" => $delete));
        }

        $show = show($dir."/groups", array("groups" => $groups));
    break;
}