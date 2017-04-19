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
$where = $where.': '._config_newskats_edit_head;

switch($do) {
    case 'delete':
        $get = fetch("SELECT `id`,`katimg` FROM `{prefix_newskat}` WHERE `id` = ?;",array(intval($_GET['id'])));
        if(common::$sql['default']->rowCount()) {
            if(file_exists(basePath."/inc/images/uploads/newskat/".stringParser::decode($get['katimg']))) {
                unlink(basePath."/inc/images/uploads/newskat/".stringParser::decode($get['katimg']));
            }
            common::$sql['default']->delete("DELETE FROM `{prefix_newskat}` WHERE `id` = ?;",array(intval($get['id'])));
            $show = common::info(_config_newskat_deleted, "?admin=news");
        }
    break;
    case 'add':
        $files = common::get_files(basePath.'/inc/images/uploads/newskat/',false,true); $img = "";
        for($i=0; $i<count($files); $i++) {
            $img .= show(_select_field, array("value" => $files[$i],
                                              "sel" => "",
                                              "what" => $files[$i]));
        }

        $show = show($dir."/newskatform", array("head" => _config_newskats_add_head,
                                                "kat" => "",
                                                "value" => _button_value_add,
                                                "nothing" => "",
                                                "do" => "addnewskat",
                                                "upload" => _config_neskats_katbild_upload,
                                                "img" => $img));
    break;
    case 'addnewskat':
        if(empty($_POST['kat'])) {
            $show = common::error(_config_empty_katname,1);
        } else {
            common::$sql['default']->insert("INSERT INTO `{prefix_newskat}` SET `katimg` = ?, `kategorie` = ?;",
                    array(stringParser::encode($_POST['img']),stringParser::encode($_POST['kat'])));
            $show = common::info(_config_newskats_added, "?admin=news");
        }
    break;
    case 'edit':
        $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_newskat}` WHERE `id` = ?;",array(intval($_GET['id'])));
        $files = common::get_files(basePath.'/inc/images/uploads/newskat/',false,true); $img = '';
        for($i=0; $i<count($files); $i++) {
            $sel = ($get['katimg'] == $files[$i] ? 'selected="selected"' : '');
            $img .= show(_select_field, array("value" => $files[$i],
                                              "sel" => $sel,
                                              "what" => $files[$i]));
        }

        $upload = show(_config_neskats_katbild_upload_edit, array("id" => $_GET['id']));
        $do = show(_config_newskats_editid, array("id" => $_GET['id']));
        $show = show($dir."/newskatform", array("head" => _config_newskats_edit_head,
                                                "kat" => stringParser::decode($get['kategorie']),
                                                "value" => _button_value_edit,
                                                "id" => intval($_GET['id']),
                                                "do" => $do,
                                                "upload" => $upload,
                                                "img" => $img));
    break;
    case 'editnewskat':
        if(empty($_POST['kat'])) {
            $show = common::error(_config_empty_katname,1);
        } else {
            $katimg = ($_POST['img'] == "lazy" ? "" : "`katimg` = '".stringParser::encode($_POST['img'])."',");
            common::$sql['default']->update("UPDATE `{prefix_newskat}` SET ".$katimg." `kategorie` = ? WHERE id = ?;",
                    array(stringParser::encode($_POST['kat']),intval($_GET['id'])));
            $show = common::info(_config_newskats_edited, "?admin=news");
        }
    break;
    default:
        $qry = common::$sql['default']->select("SELECT `id`,`katimg`,`kategorie` FROM `{prefix_newskat}` ORDER BY `kategorie`;"); $kats = '';
        foreach($qry as $get) {
            $edit = show("page/button_edit_single", array("id" => $get['id'],
                                                          "action" => "admin=news&amp;do=edit",
                                                          "title" => _button_title_edit));

            $delete = show("page/button_delete_single", array("id" => $get['id'],
                                                              "action" => "admin=news&amp;do=delete",
                                                              "title" => _button_title_del,
                                                              "del" => _confirm_del_kat));

            $img = show(_config_newskats_img, array("img" => stringParser::decode($get['katimg'])));
            $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
            $kats .= show($dir."/newskats_show", array("mainkat" => stringParser::decode($get['kategorie']),
                                                       "class" => $class,
                                                       "img" => $img,
                                                       "delete" => $delete,
                                                       "edit" => $edit));
        }

        $show = show($dir."/newskats", array("kats" => $kats));
    break;
}