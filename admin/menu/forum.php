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
$where = $where.': '._config_forum_head;

switch ($do) {
    case 'newkat':
        $positions = "";
        $qry = common::$sql['default']->select("SELECT * FROM `{prefix_forumkats}` ORDER BY `kid`;");
        foreach($qry as $get) {
            $positions .= show(_select_field, array("value" => ($get['kid']+1),
                                                    "what" => _nach.' '.stringParser::decode($get['name']),
                                                    "sel" => ""));
        }

        $show = show($dir."/katform", array("fkat" => _config_katname,
                                            "head" => _config_forum_kat_head,
                                            "fkid" => _position,
                                            "fart" => _kind,
                                            "positions" => $positions,
                                            "public" => _config_forum_public,
                                            "intern" => _config_forum_intern,
                                            "value" => _button_value_add,
                                            "kat" => ""));
    break;
    case 'addkat':
        if(!empty($_POST['kat'])) {
            $sign = (isset($_POST['kid']) && $_POST['kid'] == 1 
                    || $_POST['kid'] == 2 ? ">= " : "> ");

            common::$sql['default']->update("UPDATE `{prefix_forumkats}` SET `kid` = (kid+1) WHERE kid ".$sign." ?;",array((int)($_POST['kid'])));
            common::$sql['default']->insert("INSERT INTO `{prefix_forumkats}` SET `kid` = ?, `name` = ?, `intern` = ?",
                    array((int)($_POST['kid']),stringParser::encode($_POST['kat']),(int)($_POST['intern'])));

            $show = common::info(_config_forum_kat_added, "?admin=forum");
        } else {
            $show = common::error(_config_empty_katname, 1);
        }
    break;
    case 'delete':
        $get = common::$sql['default']->fetch("SELECT id,sid FROM `{prefix_forumsubkats}` WHERE sid = '".(int)($_GET['id'])."'");
        if(common::$sql['default']->rowCount()) {
            common::$sql['default']->delete("DELETE FROM `{prefix_forumkats}` WHERE `id` = ?;",array($get['sid']));
            common::$sql['default']->delete("DELETE FROM `{prefix_forumthreads}` WHERE `kid` = ?;",array($get['sid']));
            common::$sql['default']->delete("DELETE FROM `{prefix_forumposts}` WHERE `kid` = ?;",array($get['sid']));
            common::$sql['default']->delete("DELETE FROM `{prefix_forumsubkats}` WHERE `sid` = ?;",array($get['sid']));
            $show = common::info(_config_forum_kat_deleted, "?admin=forum");
        }
    break;
    case 'edit':
        $qry = common::$sql['default']->select("SELECT * FROM `{prefix_forumkats}` WHERE id = '".(int)($_GET['id'])."'");
        foreach($qry as $get) {
            $pos = common::$sql['default']->select("SELECT * FROM `{prefix_forumkats}` ORDER BY kid;");
            foreach($pos as $getpos) {
            if($get['name'] != $getpos['name']) {
                    $positions .= show(_select_field, array("value" => $getpos['kid']+1, 
                                                            "what" => _nach.' '.stringParser::decode($getpos['name'])));
                }
            }

            if($get['intern'] == "1") $sel = 'selected="selected"';
            $show = show($dir."/katform_edit", array("fkat" => _config_katname,
                                                     "head" => _config_forum_kat_head_edit,
                                                     "fkid" => _position,
                                                     "fart" => _kind,
                                                     "id" => $get['id'],
                                                     "sel" => $sel,
                                                     "positions" => $positions,
                                                     "public" => _config_forum_public,
                                                     "intern" => _config_forum_intern,
                                                     "value" => _button_value_edit,
                                                     "kat" => stringParser::decode($get['name'])));
        }
    break;
    case 'editkat':
        if(empty($_POST['kat'])) {
            $show = common::error(_config_empty_katname, 1);
        } else {
            if($_POST['kid'] == "lazy"){
                $kid = "";
            }else{
                $kid = "`kid` = '".(int)($_POST['kid'])."',";
                if($_POST['kid'] == "1" || "2") 
                    $sign = ">= ";
                else
                    $sign = "> ";

                common::$sql['default']->update("UPDATE `{prefix_forumkats}` SET `kid` = kid+1 WHERE `kid` ".$sign." '".(int)($_POST['kid'])."'");
            }

            common::$sql['default']->update("UPDATE `{prefix_forumkats}` SET `name`    = '".stringParser::encode($_POST['kat'])."', ".$kid." `intern`  = '".(int)($_POST['intern'])."' WHERE id = '".(int)($_GET['id'])."'");
            $show = common::info(_config_forum_kat_edited, "?admin=forum");
        }
    break;
    case 'newskat':
        $positions = "";
        $qry = common::$sql['default']->select("SELECT * FROM `{prefix_forumsubkats}` WHERE sid = " . (int) $_GET['id']." ORDER BY pos");
        foreach($qry as $get) {
            $positions .= show(_select_field, array("value" => $get['pos']+1,
            "what" => _nach.' '.stringParser::decode($get['kattopic']),
            "sel" => ""));
        }
        
        $show = show($dir."/skatform", array("head" => _config_forum_add_skat,
                                             "fkat" => _config_forum_skatname,
                                             "fstopic" => _config_forum_stopic,
                                             "skat" => "",
                                             "what" => "addskat",
                                             "stopic" => "",
                                             "id" => $_GET['id'],
                                             "nothing" => "",
                                             "tposition" => _position,
                                             "position" => $positions,
                                             "value" => _button_value_add));
    break;
    case 'addskat':
        if(empty($_POST['skat'])) {
            $show = common::error(_config_forum_empty_skat,1);
        } else {
            if($_POST['order'] == "1" || "2") 
                $sign = ">= ";
            else  
                $sign = "> ";

            common::$sql['default']->update("UPDATE `{prefix_forumsubkats}` SET `pos` = pos+1 WHERE `pos` ".$sign." '".(int)($_POST['order'])."'");
            common::$sql['default']->insert("INSERT INTO `{prefix_forumsubkats}` SET `sid` = '".(int)($_GET['id'])."', `pos` = '".(int)($_POST['order'])."', `kattopic` = '".stringParser::encode($_POST['skat'])."', `subtopic` = '".stringParser::encode($_POST['stopic'])."'");
            $show = common::info(_config_forum_skat_added, "?admin=forum&show=subkats&amp;id=".$_GET['id']."");
        }
    break;
    case 'editsubkat':
        $qry = common::$sql['default']->select("SELECT `sid`,`kattopic` FROM `{prefix_forumsubkats}` WHERE `id` = ?;",array((int)($_GET['id'])));
        foreach($qry as $get) {
            $pos = common::$sql['default']->select("SELECT `kattopic`,`pos` FROM `{prefix_forumsubkats}` WHERE `sid` = ? ORDER BY `pos`;",array($get['sid']));
            foreach($pos as $getpos) {
                if($get['kattopic'] != $getpos['kattopic']) {
                    $positions .= show(_select_field, array("value" => $getpos['pos']+1,
                                                            "what" => _nach.' '.stringParser::decode($getpos['kattopic'])));
                }
            }

            $show = show($dir."/skatform", array("head" => _config_forum_edit_skat,
                                                 "fkat" => _config_forum_skatname,
                                                 "fstopic" => _config_forum_stopic,
                                                 "skat" => stringParser::decode($get['kattopic']),
                                                 "what" => "editskat",
                                                 "stopic" => stringParser::decode($get['subtopic']),
                                                 "id" => $_GET['id'],
                                                 "sid" => $get['sid'],
                                                 "tposition" => _position,
                                                 "position" => $positions,
                                                 "value" => _button_value_edit));
        } //--> End while subkat sort
    break;
    case 'editskat':
        if(empty($_POST['skat'])) { 
            $show = common::error(_config_forum_empty_skat,1);
        } else {
            if($_POST['order'] == "lazy"){
                $order = "";
            }else{
                $order = "`pos` = '".(int)($_POST['order'])."',";
                if($_POST['order'] == "1" || "2") 
                    $sign = ">= ";
                else  
                    $sign = "> ";

                common::$sql['default']->update("UPDATE `{prefix_forumsubkats}` "
                        . "SET `pos` = (pos+1) "
                        . "WHERE `pos` ".$sign." '".(int)($_POST['order'])."';");
            }

            common::$sql['default']->update("UPDATE `{prefix_forumsubkats}` SET "
                    . "`kattopic` = '".stringParser::encode($_POST['skat'])."', ".$order." "
                    . "`subtopic` = '".stringParser::encode($_POST['stopic'])."' "
                    . "WHERE id = '".(int)($_GET['id'])."'");

            $show = common::info(_config_forum_skat_edited, "?admin=forum&show=subkats&amp;id=".$_POST['sid']."");
        }
    break;
    case 'deletesubkat':
        $get = common::$sql['default']->fetch("SELECT `id`,`sid` FROM `{prefix_forumsubkats}` WHERE id = ?;",array((int)($_GET['id'])));
        if(common::$sql['default']->rowCount()) {
            common::$sql['default']->delete("DELETE FROM `{prefix_forumsubkats}` WHERE `id` = ?;",array((int)($get['id'])));
            common::$sql['default']->delete("DELETE FROM `{prefix_forumthreads}` WHERE `kid` = ?;",array((int)($get['id'])));
            common::$sql['default']->delete("DELETE FROM `{prefix_forumposts}` WHERE `kid` = ?;",array((int)($get['id'])));
            $show = common::info(_config_forum_skat_deleted, "?admin=forum&show=subkats&amp;id=".$get['sid']."");
        }
    break;
    default:
        if(isset($_GET['show']) && strtolower($_GET['show']) == "subkats") {
            $qryk = common::$sql['default']->select("SELECT s1.`name`,s2.`id`,s2.`kattopic`,s2.`subtopic`,s2.`pos` "
                               . "FROM `{prefix_forumkats}` AS `s1` "
                               . "LEFT JOIN `{prefix_forumsubkats}` AS `s2` "
                               . "ON s1.`id` = s2.`sid` "
                               . "WHERE s1.`id` = ? ORDER BY s2.`pos`;",
                    array((int)($_GET['id'])));
            foreach($qryk as $getk) {
                if(!empty($getk['kattopic'])) {
                    $subkat = show(_config_forum_subkats, array("topic" => stringParser::decode($getk['kattopic']),
                                                                "subtopic" => stringParser::decode($getk['subtopic']),
                                                                "id" => $getk['id']));

                    $edit = common::getButtonEditSingle($getk['id'],"admin=".$admin."&amp;do=editsubkat");
                    $delete = common::button_delete_single($getk['id'],"admin=forum&amp;do=deletesubkat",_button_title_del,_confirm_del_entry);

                    $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
                    $subkats .= show($dir."/forum_show_subkats_show", array("subkat" => $subkat,
                                                                            "delete" => $delete,
                                                                            "class" => $class,
                                                                            "edit" => $edit));
                }

                $skathead = show(_config_forum_subkathead, array("kat" => stringParser::decode($getk['name'])));
                $add = show(_config_forum_subkats_add, array("id" => $_GET['id']));

                $show = show($dir."/forum_show_subkats", array("head" => _config_forum_head,
                                                               "subkathead" => $skathead,
                                                               "subkats" => $subkats,
                                                               "add" => $add,
                                                               "subkat" => _config_forum_subkat,
                                                               "delete" => _deleteicon_blank,
                                                               "edit" => _editicon_blank));
            }
        } else {
            $qry = common::$sql['default']->select("SELECT * FROM `{prefix_forumkats}` ORDER BY `kid`;");
            foreach($qry as $get) {
                $kat = show(_config_forum_kats_titel, array("kat" => stringParser::decode($get['name']),
                                                            "id" => $get['id']));

                $edit = common::getButtonEditSingle($get['id'],"admin=".$admin."&amp;do=edit");
                $delete = common::button_delete_single($get['id'],"admin=".$admin."&amp;do=delete",_button_title_del,_confirm_del_entry);

                $status = ($get['intern'] ? _config_forum_intern : _config_forum_public);

                $kats = "";
                $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
                $kats .= show($dir."/forum_show_kats", array("class" => $class,
                                                             "kat" => $kat,
                                                             "status" => $status,
                                                             "skats" => common::cnt('{prefix_forumsubkats}', " WHERE sid = ?","id",array((int)($get['id']))),
                                                             "edit" => $edit,
                                                             "delete" => $delete));
            }
            
            $show = show($dir."/forum", array("head" => _config_forum_head,
                                              "mainkat" => _config_forum_mainkat,
                                              "edit" => _editicon_blank,
                                              "skats" => _cnt,
                                              "status" => _config_forum_status,
                                              "delete" => _deleteicon_blank,
                                              "add" => _config_forum_kats_add,
                                              "kats" => $kats));
        }
    break;
}