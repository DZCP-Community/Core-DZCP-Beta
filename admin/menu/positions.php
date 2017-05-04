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

if(_adminMenu != 'true') exit();
$where = $where.': '._admin_pos;

switch ($do) {
    case 'edit':
        $qry = common::$sql['default']->select("SELECT `pid`,`position` FROM `{prefix_positions}` ORDER BY `pid` DESC;"); $positions = '';
        foreach($qry as $get) {
            $positions .= show(_select_field, array("value" => ($get['pid']+1),
                                                    "what" => _nach.' '.stringParser::decode($get['position']),
                                                    "sel" => ""));
        }

        $id = intval($_GET['id']);
        $get = common::$sql['default']->fetch("SELECT `position`,`color` FROM `{prefix_positions}` WHERE `id` = ?;",array($id));
        $show = show($dir."/form_pos", array("newhead" => _pos_edit_head,
                                             "do" => "editpos&amp;id=".$id."",
                                             "kat" => stringParser::decode($get['position']),
                                             "color" => stringParser::decode($get['color']),
                                             "getpermissions" => common::getPermissions($id, 1),
                                             "getboardpermissions" => common::getBoardPermissions($id, 1),
                                             "positions" => $positions,
                                             "what" => _button_value_edit));
        unset($positions,$qry,$get);
    break;
    case 'editpos':
        if(empty($_POST['kat'])) {
            $show = common::error(_pos_empty_kat,1);
        } else {
            $id = intval($_GET['id']);
            if($_POST['pos'] != 'lazy') {
                $posid = intval($_POST['pos']);
                common::$sql['default']->update("UPDATE `{prefix_positions}` SET `pid` = (pid+1) WHERE `pid` " . ($_POST['pos'] == "1" || $_POST['pos'] == "2" ? ">= " : "> ")
                    . " ?;", array(intval($_POST['pos'])));
            }

            common::$sql['default']->update("UPDATE `{prefix_positions}` SET `position` = ? ".
                    ($_POST['pos'] == "lazy" ? "" : ",`pid` = ".intval($_POST['pos'])).", `color` = ? WHERE `id` = ?;",
                    array(stringParser::encode($_POST['kat']),stringParser::encode($_POST['color']),$id));

            // Permissions Update
            if(empty($_POST['perm'])) {
                $_POST['perm'] = array();
            }

            $qry_fields = common::$sql['default']->show("SHOW FIELDS FROM `{prefix_permissions}`;"); $sql_update = '';
            foreach($qry_fields as $get) {
                if($get['Field'] != 'id' && $get['Field'] != 'user' && $get['Field'] != 'pos' && $get['Field'] != 'intforum') {
                    $qry = array_key_exists('p_'.$get['Field'], $_POST['perm']) ? '`'.$get['Field'].'` = 1' : '`'.$get['Field'].'` = 0';
                    $sql_update .= $qry.', ';
                }
            }

            // Check group Permissions is exists
            if(!common::$sql['default']->rows('SELECT `id` FROM `{prefix_permissions}` WHERE `pos` = ? LIMIT 1;',array($id))) {
                common::$sql['default']->insert("INSERT INTO `{prefix_permissions}` SET `pos` = ?;",array($id));
            }

            // Update Permissions
            common::$sql['default']->update('UPDATE `{prefix_permissions}` SET '.substr($sql_update, 0, -2).' WHERE `pos` = ? LIMIT 1;',array($id));

            // Internal Boardpermissions Update
            if(empty($_POST['board'])) {
                $_POST['board'] = array();
            }

            // Cleanup Boardpermissions
            $qry = common::$sql['default']->select('SELECT `id`,`forum` FROM `{prefix_forum_access}` WHERE `pos` = ?;',array($id));
            foreach($qry as $get) {
                if(!common::array_var_exists($get['forum'],$_POST['board'])) {
                    common::$sql['default']->delete('DELETE FROM `{prefix_forum_access}` WHERE `id` = ?;',array($get['id']));
                }
            }

            //Add new Boardpermissions
            if(count($_POST['board']) >= 1) {
                foreach($_POST['board'] AS $boardpem) { 
                    if(!common::$sql['default']->rows("SELECT `id` FROM `{prefix_forum_access}` WHERE `pos` = ? AND `forum` = ?;",array($id,$boardpem))) {
                        common::$sql['default']->insert("INSERT INTO `{prefix_forum_access}` SET `pos` = ?, `forum` = ?;",array($id,$boardpem));
                    }
                }
            }

            $show = common::info(_pos_admin_edited, "?admin=positions");
        }
    break;
    case 'delete':
        $get = fetch("SELECT `id` FROM `{prefix_positions}` WHERE `id` = ?;",array(intval($_GET['id'])));
        if(common::$sql['default']->rowCount()) {
            common::$sql['default']->delete("DELETE FROM `{prefix_positions}` WHERE `id` = ?;",array($get['id']));
            common::$sql['default']->delete("DELETE FROM `{prefix_permissions}` WHERE `pos` = ?;",array($get['id']));
            $show = common::info(_pos_admin_deleted, "?admin=positions");
        }
    break;
    case 'new':
        $qry = common::$sql['default']->select("SELECT `pid`,`position` FROM `{prefix_positions}` ORDER BY `pid` DESC;"); $positions = '';
        foreach($qry as $get) {
            $positions .= show(_select_field, array("value" => ($get['pid']+1),
                                                    "what" => _nach.' '.stringParser::decode($get['position']),
                                                    "sel" => ""));
        }

        $show = show($dir."/form_pos", array("newhead" => _pos_new_head,
                                             "do" => "add",
                                             "getpermissions" => common::getPermissions(),
                                             "getboardpermissions" => common::getBoardPermissions(),
                                             "nothing" => "",
                                             "positions" => $positions,
                                             "kat" => "",
                                             "color" => "#000000",
                                             "what" => _button_value_add));

        unset($positions,$qry,$get);
    break;
    case 'add':
        if(empty($_POST['kat'])) {
            $show = common::error(_pos_empty_kat,1);
        } else {
            common::$sql['default']->update("UPDATE `{prefix_positions}` SET `pid` = (pid+1) WHERE `pid`;".
                    ($_POST['pos'] == "1" || $_POST['pos'] == "2" ? ">= " : "> ")." ?;",
                    array(intval($_POST['pos'])));
            common::$sql['default']->insert("INSERT INTO `{prefix_positions}` SET `pid` = ?, `position` = ?, `color` = ?;",
                array(intval($_POST['pos']),stringParser::encode($_POST['kat']),stringParser::encode($_POST['color'])));
            
            $posID = common::$sql['default']->lastInsertId();
            $qry = common::$sql['default']->show("SHOW FIELDS FROM `{prefix_permissions}`;"); $sql_update = '';
            foreach($qry as $get) {
                if($get['Field'] != 'id' && $get['Field'] != 'user' && $get['Field'] != 'pos' && $get['Field'] != 'intforum') {
                    $qry = array_key_exists('p_'.$get['Field'], $_POST['perm']) ? '`'.$get['Field'].'` = 1' : '`'.$get['Field'].'` = 0';
                    $sql_update .= $qry.', ';
                }
            }
            
            // Add Permissions
            common::$sql['default']->insert('INSERT INTO `{prefix_permissions}` SET '.$sql_update.'`pos` = ?;',array($posID));

            // Internal Boardpermissions Update
            if(empty($_POST['board'])) {
                $_POST['board'] = array();
            }

            //Add new Boardpermissions
            if(count($_POST['board']) >= 1) {
                foreach($_POST['board'] AS $boardpem) { 
                    if(!common::$sql['default']->rows("SELECT `id` FROM `{prefix_forum_access}` WHERE `pos` = ? AND `forum` = ?;",array($posID,$boardpem))) {
                        common::$sql['default']->insert("INSERT INTO `{prefix_forum_access}` SET `pos` = ?, `forum` = ?;",array($posID,$boardpem));
                    }
                }
            }

            $show = common::info(_pos_admin_added, "?admin=positions");
        }
    break;
    default:
        $qry = common::$sql['default']->select("SELECT `id`,`position` FROM `{prefix_positions}` ORDER BY `pid` DESC;"); $show_pos = '';
        foreach($qry as $get) {
            $edit = show("page/button_edit_single", array("id" => $get['id'],
                                                          "action" => "admin=positions&amp;do=edit",
                                                          "title" => _button_title_edit));

            $delete = show("page/button_delete_single", array("id" => $get['id'],
                                                              "action" => "admin=positions&amp;do=delete",
                                                              "title" => _button_title_del,
                                                              "del" => _confirm_del_entry));

            $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
            $show_pos .= show($dir."/positions_show", array("edit" => $edit,
                                                            "name" => stringParser::decode($get['position']),
                                                            "class" => $class,
                                                            "delete" => $delete));
        }

        if(empty($show_pos)) {
            $smarty->caching = false;
            $smarty->assign('colspan',3);
            $show_pos = $smarty->fetch('string:'._no_entrys_yet);
            $smarty->clearAllAssign();
        }

        $show = show($dir."/positions", array("show" => $show_pos));
        unset($show_pos,$qry,$get);
    break;
}