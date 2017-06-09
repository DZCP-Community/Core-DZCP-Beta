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
            $smarty->caching = false;
            $smarty->assign('value',($get['kid']+1));
            $smarty->assign('what',_nach.' '.stringParser::decode($get['name']));
            $smarty->assign('sel','');
            $positions .= $smarty->fetch('string:'._select_field);
            $smarty->clearAllAssign();
        }

        $smarty->caching = false;
        $smarty->assign('fkat',_config_katname);
        $smarty->assign('head',_config_forum_kat_head);
        $smarty->assign('fkid',_position);
        $smarty->assign('fart',_kind);
        $smarty->assign('positions',$positions);
        $smarty->assign('public',_config_forum_public);
        $smarty->assign('intern',_config_forum_intern);
        $smarty->assign('value',_button_value_add);
        $smarty->assign('kat','');
        $show = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/katform.tpl');
        $smarty->clearAllAssign();

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
                $smarty->caching = false;
                $smarty->assign('value',$getpos['kid']+1);
                $smarty->assign('what',_nach.' '.stringParser::decode($getpos['name']));
                $positions .= $smarty->fetch('string:'._select_field);
                $smarty->clearAllAssign();
                }
            }

            if($get['intern'] == "1") $sel = 'selected="selected"';
            $smarty->caching = false;
            $smarty->assign('fkat',_config_katname);
            $smarty->assign('head',_config_forum_kat_head_edit);
            $smarty->assign('fkid',_position);
            $smarty->assign('fart',_kind);
            $smarty->assign('id',$get['id']);
            $smarty->assign('sel',$sel);
            $smarty->assign('positions',$positions);
            $smarty->assign('public',_config_forum_public);
            $smarty->assign('intern',_config_forum_intern);
            $smarty->assign('value',_button_value_edit);
            $smarty->assign('kat',stringParser::decode($get['name']));
            $show = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/katform_edit.tpl');
            $smarty->clearAllAssign();
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
            $smarty->caching = false;
            $smarty->assign('value',$get['pos']+1);
            $positions .= $smarty->fetch('string:'._select_field);
            $smarty->clearAllAssign();
        }

        $smarty->caching = false;
        $smarty->assign('head',_config_forum_add_skat);
        $smarty->assign('fkat',_config_forum_skatname);
        $smarty->assign('fstopic',_config_forum_stopic);
        $smarty->assign('skat','');
        $smarty->assign('what',"addskat");
        $smarty->assign('stopic','');
        $smarty->assign('id',$_GET['id']);
        $smarty->assign('nothing','');
        $smarty->assign('tposition',_position);
        $smarty->assign('position',$positions);
        $smarty->assign('value',_button_value_add);
        $show = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/skatform.tpl');
        $smarty->clearAllAssign();

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
                    $smarty->caching = false;
                    $smarty->assign('value',$getpos['pos']+1);
                    $smarty->assign('what', _nach.' '.stringParser::decode($getpos['kattopic']));
                    $positions .= $smarty->fetch('string:'._select_field);
                    $smarty->clearAllAssign();
                }
            }

            $smarty->caching = false;
            $smarty->assign('head',_config_forum_edit_skat);
            $smarty->assign('fkat',_config_forum_skatname);
            $smarty->assign('fstopic',_config_forum_stopic);
            $smarty->assign('skat',stringParser::decode($get['kattopic']));
            $smarty->assign('what',"editskat");
            $smarty->assign('stopic',stringParser::decode($get['subtopic']));
            $smarty->assign('id',$_GET['id']);
            $smarty->assign('sid',$get['sid']);
            $smarty->assign('tposition',_position);
            $smarty->assign('position',$positions);
            $smarty->assign('value',_button_value_edit);
            $show = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/skatform.tpl');
            $smarty->clearAllAssign();
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
                    $smarty->caching = false;
                    $smarty->assign('topic',stringParser::decode($getk['kattopic']));
                    $smarty->assign('subtopic',stringParser::decode($getk['subtopic']));
                    $smarty->assign('id',$getk['id']);
                    $subkat = $smarty->fetch('string:'._config_forum_subkats);
                    $smarty->clearAllAssign();

                    $edit = common::getButtonEditSingle($getk['id'],"admin=".$admin."&amp;do=editsubkat");
                    $delete = common::button_delete_single($getk['id'],"admin=forum&amp;do=deletesubkat",_button_title_del,_confirm_del_entry);

                    $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
                    $smarty->caching = false;
                    $smarty->assign('subkat',$subkat);
                    $smarty->assign('delete',$delete);
                    $smarty->assign('class',$class);
                    $smarty->assign('edit',$edit);
                    $subkats .= $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/forum_show_subkats_show.tpl');
                    $smarty->clearAllAssign();
                }

                $smarty->caching = false;
                $smarty->assign('kat',stringParser::decode($getk['name']));
                $skathead = $smarty->fetch('string:'._config_forum_subkathead);
                $smarty->clearAllAssign();

                $smarty->caching = false;
                $smarty->assign('id',$_GET['id']);
                $add = $smarty->fetch('string:'._config_forum_subkats_add);
                $smarty->clearAllAssign();

                $smarty->caching = false;
                $smarty->assign('head',_config_forum_head);
                $smarty->assign('subkathead',$skathead);
                $smarty->assign('subkats',$subkats);
                $smarty->assign('add',$add);
                $smarty->assign('subkat',_config_forum_subkat);
                $smarty->assign('delete',_deleteicon_blank);
                $smarty->assign('edit',_editicon_blank);
                $show = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/forum_show_subkats.tpl');
                $smarty->clearAllAssign();
            }
        } else {
            $qry = common::$sql['default']->select("SELECT * FROM `{prefix_forumkats}` ORDER BY `kid`;");
            foreach($qry as $get) {
                $smarty->caching = false;
                $smarty->assign('kat',stringParser::decode($get['name']));
                $smarty->assign('id',$get['id']);
                $kat = $smarty->fetch('string:'._config_forum_kats_titel);
                $smarty->clearAllAssign();

                $edit = common::getButtonEditSingle($get['id'],"admin=".$admin."&amp;do=edit");
                $delete = common::button_delete_single($get['id'],"admin=".$admin."&amp;do=delete",_button_title_del,_confirm_del_entry);

                $status = ($get['intern'] ? _config_forum_intern : _config_forum_public);

                $kats = "";
                $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
                $smarty->caching = false;
                $smarty->assign('class',$class);
                $smarty->assign('kat',$kat);
                $smarty->assign('status',$status);
                $smarty->assign('skats',common::cnt('{prefix_forumsubkats}', " WHERE sid = ?","id",array((int)($get['id']))));
                $smarty->assign('edit',$edit);
                $smarty->assign('delete',$delete);
                $kats .= $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/forum_show_kats.tpl');
                $smarty->clearAllAssign();
            }

            $smarty->caching = false;
            $smarty->assign('head',_config_forum_head);
            $smarty->assign('mainkat',_config_forum_mainkat);
            $smarty->assign('edit',_editicon_blank);
            $smarty->assign('skats',_cnt);
            $smarty->assign('status',_config_forum_status);
            $smarty->assign('delete',_deleteicon_blank);
            $smarty->assign('add',_config_forum_kats_add);
            $smarty->assign('kats',$kats);
            $show = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/forum.tpl');
            $smarty->clearAllAssign();
        }
    break;
}