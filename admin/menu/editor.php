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

$where = $where.': '._editor_head;

switch($do) {
    case 'add':
        $qry = common::$sql['default']->select("SELECT s2.*, s1.`name` AS `katname`, s1.`placeholder` "
                . "FROM `{prefix_navi_kats}` AS `s1` "
                . "LEFT JOIN `{prefix_navi}` AS `s2` "
                . "ON s1.`placeholder` = s2.`kat` "
                . "ORDER BY s1.`name`, s2.`pos`;");

        $thiskat = ''; $position = '';
        foreach($qry as $get) {
            if($thiskat != $get['kat']) {
                $position .= '<option class="dropdownKat" value="lazy">'.stringParser::decode($get['katname']).'</option>
                              <option value="'.stringParser::decode($get['placeholder']).'-1">-> '._admin_first.'</option>';
            }

            $thiskat = $get['kat'];
            $sel = ($get['editor'] == (isset($_GET['id']) ? $_GET['id'] : 0)) ? 'selected="selected"' : '';
            $position .= empty($get['name']) ? '' : '<option value="'.stringParser::decode($get['placeholder']).'-'.($get['pos']+1).'" '.$sel.'>'._nach.' -> '.common::navi_name(stringParser::decode($get['name'])).'</option>';
        }

        $show = show($dir."/form_editor", array("head" => _editor_add_head,
                                                "what" => _button_value_add,
                                                "bbcode" => _bbcode,
                                                "titel" => _titel,
                                                "preview" => _preview,
                                                "e_titel" => "",
                                                "e_inhalt" => "",
                                                "checked" => "",
                                                "checked_php" => "",
                                                "disabled_php" => (php_code_enabled ? '' : ' disabled'),
                                                "pos" => _position,
                                                "name" => _editor_linkname,
                                                "n_name" => "",
                                                "position" => $position,
                                                "ja" => _yes,
                                                "nein" => _no,
                                                "wichtig" => _navi_wichtig,
                                                "error" => "",
                                                "allow_html" => _editor_allow_html,
                                                "inhalt" => _inhalt,
                                                "do" => "addsite"));
    break;
    case 'addsite':
        if(empty($_POST['titel']) || empty($_POST['inhalt']) || $_POST['pos'] == "lazy") {
            if(empty($_POST['titel']))
                $error = _empty_titel;
            elseif(empty($_POST['inhalt']))
                $error = _empty_editor_inhalt;
            elseif($_POST['pos'] == "lazy")
                $error = _navi_no_pos;

            $error = show("errors/errortable", array("error" => $error));
            $checked = isset($_POST['html']) ? 'checked="checked"' : '';
            $checked_php = isset($_POST['php']) ? 'checked="checked"' : '';
            $kat_ = preg_replace('/-(\d+)/','',$_POST['pos']);
            $pos_ = preg_replace("=nav_(.*?)-=","",$_POST['pos']);

            $qry = common::$sql['default']->select("SELECT s2.*, s1.`name` AS `katname`, s1.`placeholder` "
                    . "FROM `{prefix_navi_kats}` AS `s1` "
                    . "LEFT JOIN `{prefix_navi}` AS `s2` "
                    . "ON s1.`placeholder` = s2.`kat` "
                    . "ORDER BY s1.`name`, s2.`pos`;");
            $thiskat = ''; $position = '';
            foreach($qry as $get) {
                if($thiskat != $get['kat']) {
                    $position .= '<option class="dropdownKat" value="lazy">'.stringParser::decode($get['katname']).'</option>
                    <option value="'.stringParser::decode($get['placeholder']).'-1">-> '._admin_first.'</option>';
                }

                $thiskat = $get['kat'];
                $sel = ($get['kat'] == $kat_ && ($get['pos']+1) == $pos_) ? 'selected="selected"' : '';
                $position .= empty($get['name']) ? '' : '<option value="'.stringParser::decode($get['placeholder']).'-'.($get['pos']+1).'" '.$sel.'>'._nach.' -> '.common::navi_name(stringParser::decode($get['name'])).'</option>';
            }

            $show = show($dir."/form_editor", array("head" => _editor_add_head,
                                                    "what" => _button_value_add,
                                                    "preview" => _preview,
                                                    "bbcode" => _bbcode,
                                                    "error" => $error,
                                                    "checked" => $checked,
                                                    "checked_php" => $checked_php,
                                                    "disabled_php" => (php_code_enabled ? '' : ' disabled'),
                                                    "pos" => _position,
                                                    "ja" => _yes,
                                                    "nein" => _no,
                                                    "name" => _editor_linkname,
                                                    "position" => $position,
                                                    "n_name" => stringParser::decode($_POST['name']),
                                                    "wichtig" => _navi_wichtig,
                                                    "titel" => _titel,
                                                    "e_titel" => stringParser::decode($_POST['titel']),
                                                    "e_inhalt" => stringParser::decode($_POST['inhalt']),
                                                    "allow_html" => _editor_allow_html,
                                                    "inhalt" => _inhalt,
                                                    "do" => "addsite"));
        } else {
            $_POST['html'] = (isset($_POST['html']) ? $_POST['html'] : 0);
            $_POST['php'] = (isset($_POST['php']) ? $_POST['php'] : 0);
            common::$sql['default']->insert("INSERT INTO `{prefix_sites}` SET `titel` = ?, `text` = ?, `html` = ?, `php` = ?;",
                    array(stringParser::encode($_POST['titel']),stringParser::encode($_POST['inhalt']),intval($_POST['html']),(php_code_enabled ? intval($_POST['php']) : 0)));

            $insert_id = common::$sql['default']->lastInsertId();
            $sign = (isset($_POST['pos']) && ($_POST['pos'] == "1" || $_POST['pos'] == "2")) ? ">= " : "> ";
            $kat = preg_replace('/-(\d+)/','',$_POST['pos']);
            $pos = preg_replace("=nav_(.*?)-=","",$_POST['pos']);
            $url = "../sites/?show=".$insert_id."";

            common::$sql['default']->update("UPDATE `{prefix_navi}` SET `pos` = (pos+1) WHERE `pos` ".$sign." ?;",array(intval($pos)));
            common::$sql['default']->insert("INSERT INTO `{prefix_navi}` SET `pos` = ?, `kat` = ?, `name` = ?, `url` = ?, `shown` = 1, `type` = 3, `editor` = ?, `wichtig` = 0;",
                    array(intval($pos),stringParser::encode($kat),stringParser::encode($_POST['name']),stringParser::encode($url),intval($insert_id)));

            $show = common::info(_site_added, "?admin=editor");
        }
    break;
    case 'edit':
        $gets = common::$sql['default']->fetch("SELECT * FROM `{prefix_sites}` WHERE `id` = ?;",array(intval($_GET['id'])));
        $qry = common::$sql['default']->select("SELECT s2.*, s1.`name` AS `katname`, s1.`placeholder` "
                . "FROM `{prefix_navi_kats}` AS `s1` "
                . "LEFT JOIN `{prefix_navi}` AS `s2` "
                . "ON s1.`placeholder` = s2.`kat` "
                . "ORDER BY s1.`name`, s2.`pos`;");

        $thiskat = ''; $position = '';
        foreach($qry as $get) {
            if($thiskat != $get['kat']) {
                $position .= '<option class="dropdownKat" value="lazy">'.stringParser::decode($get['katname']).'</option>
                  <option value="'.stringParser::decode($get['placeholder']).'-1">-> '._admin_first.'</option>';
            }

            $thiskat = $get['kat'];
            $sel = ($get['editor'] == $_GET['id']) ? 'selected="selected"' : '';
            $position .= empty($get['name']) ? '' : '<option value="'.stringParser::decode($get['placeholder']).'-'.($get['pos']+1).'" '.$sel.'>'._nach.' -> '.common::navi_name(stringParser::decode($get['name'])).'</option>';
        }

        $getn = common::$sql['default']->fetch("SELECT `name` FROM `{prefix_navi}` WHERE `editor` = ?;",array(intval($_GET['id'])));
        $checked = ($gets['html'] ? 'checked="checked"' : '');
        $checked_php = $gets['php'] ? 'checked="checked"' : '';

        $show = show($dir."/form_editor", array("head" => _editor_edit_head,
                                                "what" => _button_value_edit,
                                                "bbcode" => _bbcode,
                                                "preview" => _preview,
                                                "titel" => _titel,
                                                "e_titel" => stringParser::decode($gets['titel']),
                                                "e_inhalt" => stringParser::decode($gets['text']),
                                                "checked" => $checked,
                                                "checked_php" => $checked_php,
                                                "disabled_php" => (php_code_enabled ? '' : ' disabled'),
                                                "pos" => _position,
                                                "name" => _editor_linkname,
                                                "n_name" => stringParser::decode($getn['name']),
                                                "position" => $position,
                                                "ja" => _yes,
                                                "nein" => _no,
                                                "wichtig" => _navi_wichtig,
                                                "error" => "",
                                                "allow_html" => _editor_allow_html,
                                                "inhalt" => _inhalt,
                                                "do" => "editsite&amp;id=".$_GET['id'].""));
    break;
    case 'editsite':
        if(empty($_POST['titel']) || empty($_POST['inhalt']) || $_POST['pos'] == "lazy") {
            if(empty($_POST['titel']))
                $error = _empty_titel;
            elseif(empty($_POST['inhalt']))
                $error = _empty_editor_inhalt;
            elseif($_POST['pos'] == "lazy")
                $error = _navi_no_pos;

            $error = show("errors/errortable", array("error" => $error));
            $checked = isset($_POST['html']) ? 'checked="checked"' : '';
            $checked_php = isset($_POST['php']) ? 'checked="checked"' : '';

            $qry = common::$sql['default']->select("SELECT s2.*, s1.`name` AS `katname`, s1.`placeholder` "
                    . "FROM `{prefix_navi_kats}` AS `s1` "
                    . "LEFT JOIN `{prefix_navi}` AS `s2` "
                    . "ON s1.`placeholder` = s2.`kat` "
                    . "ORDER BY s1.`name`, s2.`pos`;");

            $thiskat = ''; $position = '';
            foreach($qry as $get) {
                if($thiskat != $get['kat']) {
                    $position .= '<option class="dropdownKat" value="lazy">'.stringParser::decode($get['katname']).'</option>'
                            . '<option value="'.stringParser::decode($get['placeholder']).'-1">-> '._admin_first.'</option>';
                }

                $thiskat = $get['kat'];
                $sel = (isset($_GET['id']) && $get['editor'] == $_GET['id']) ? 'selected="selected"' : '';
                $position .= empty($get['name']) ? '' : '<option value="'.stringParser::decode($get['placeholder']).'-'.($get['pos']+1).'" '.$sel.'>'._nach.' -> '.common::navi_name(stringParser::decode($get['name'])).'</option>';
            }

            $show = show($dir."/form_editor", array("head" => _editor_edit_head,
                                                    "what" => _button_value_edit,
                                                    "bbcode" => _bbcode,
                                                    "preview" => _preview,
                                                    "error" => $error,
                                                    "checked" => $checked,
                                                    "checked_php" => $checked_php,
                                                    "disabled_php" => (php_code_enabled ? '' : ' disabled'),
                                                    "pos" => _position,
                                                    "ja" => _yes,
                                                    "nein" => _no,
                                                    "name" => _editor_linkname,
                                                    "position" => $position,
                                                    "n_name" => stringParser::decode($_POST['name']),
                                                    "wichtig" => _navi_wichtig,
                                                    "titel" => _titel,
                                                    "e_titel" => stringParser::decode($_POST['titel']),
                                                    "e_inhalt" => stringParser::decode($_POST['inhalt']),
                                                    "allow_html" => _editor_allow_html,
                                                    "inhalt" => _inhalt,
                                                    "do" => "editsite&amp;id=".$_GET['id'].""));
        } else {
            $_POST['html'] = isset($_POST['html']) ? $_POST['html'] : 0;
            $_POST['php'] = isset($_POST['php']) ? $_POST['php'] : 0;
            common::$sql['default']->update("UPDATE `{prefix_sites}` SET `titel` = ?,`text` = ?,`html` = ?, `php` = ? WHERE `id` = ?;",
                    array(stringParser::encode($_POST['titel']),stringParser::encode($_POST['inhalt']),intval($_POST['html']),(php_code_enabled ? intval($_POST['php']) : 0),intval($_GET['id'])));

            $sign = (isset($_POST['pos']) && ($_POST['pos'] == "1" || $_POST['pos'] == "2")) ? ">= " : "> ";
            $kat = preg_replace('/-(\d+)/','',$_POST['pos']);
            $pos = preg_replace("=nav_(.*?)-=","",$_POST['pos']);

            $url = "../sites/?show=".$_GET['id'];
            common::$sql['default']->update("UPDATE `{prefix_navi}` SET `pos` = (pos+1) WHERE `pos` ".$sign." ?;",array(intval($pos)));
            common::$sql['default']->update("UPDATE `{prefix_navi}` SET `pos` = ?, `kat` = ?, `name` = ?,`url` = ? WHERE `editor` = ?;",
                    array(intval($pos),stringParser::encode($kat),stringParser::encode($_POST['name']),stringParser::encode($url),intval($_GET['id'])));

            $show = common::info(_site_edited, "?admin=editor");
        }
    break;
    case 'delete':
        common::$sql['default']->delete("DELETE FROM `{prefix_sites}` WHERE `id` = ?;",array(intval($_GET['id'])));
        common::$sql['default']->delete("DELETE FROM `{prefix_navi}` WHERE `editor` = ?;",array(intval($_GET['id'])));
        $show = common::info(_editor_deleted, "?admin=editor");
    break;
    default:
        $qry = common::$sql['default']->select("SELECT * FROM `{prefix_sites}`;");
        foreach($qry as $get) {
            $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
            $edit = show("page/button_edit_single", array("id" => $get['id'],
                                                          "action" => "admin=editor&amp;do=edit",
                                                          "title" => _button_title_edit));

            $delete = show("page/button_delete_single", array("id" => $get['id'],
                                                              "action" => "admin=editor&amp;do=delete",
                                                              "title" => _button_title_del,
                                                              "del" => _confirm_del_site));

            $show .= show($dir."/editor_show", array("name" => "<a href='../sites/?show=".$get['id']."'>".stringParser::decode($get['titel'])."</a>",
                                                      "del" => $delete,
                                                      "edit" => $edit,
                                                      "class" => $class));
        }

        if(empty($show)) {
            $smarty->caching = false;
            $smarty->assign('colspan',4);
            $show = $smarty->fetch('string:'._no_entrys_yet);
            $smarty->clearAllAssign();
        }

        $show = show($dir."/editor", array("show" => $show));
    break;
}