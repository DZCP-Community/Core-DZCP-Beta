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
$where = $where.': '._dl;
switch ($do) {
    case 'new':
        $qry = common::$sql['default']->select("SELECT `id`,`name` FROM `{prefix_download_kat}` ORDER BY `name`;"); $kats = '';
        foreach($qry as $get) {
            $kats .= show(_select_field, array("value" => $get['id'],
                                               "what" => stringParser::decode($get['name']),
                                               "sel" => ""));
        }

        $files = common::get_files(basePath.'/downloads/files/',false,true); $dl = '';
        foreach ($files as $file) {
            $dl .= show(_downloads_files_exists, array("dl" => $file, "sel" => ""));
        }

        $show = show($dir."/form_dl", array("admin_head" => _downloads_admin_head,
                                            "ddownload" => "",
                                            "dintern" => "",
                                            "durl" => "",
                                            "file" => $dl,
                                            "nothing" => "",
                                            "what" => _button_value_add,
                                            "do" => "add",
                                            "dbeschreibung" => "",
                                            "kats" => $kats));
    break;
    case 'add':
        if(empty($_POST['download']) || empty($_POST['url'])) {
            if (empty($_POST['download'])) {
                $show = common::error(_downloads_empty_download, 1);
            } else if (empty($_POST['url'])) {
                $show = common::error(_downloads_empty_url, 1);
            }
        } else {
            $dl = (preg_match("#^www#i",$_POST['url']) ? common::links($_POST['url']) : stringParser::encode($_POST['url']));
            common::$sql['default']->insert("INSERT INTO `{prefix_downloads}` SET `download` = ?, "
                    . "`url` = ?, "
                    . "`date` = ?, "
                    . "`beschreibung` = ?, "
                    . "`kat` = ?, "
                    . "`intern` = ?;",
                    array(stringParser::encode($_POST['download']),$dl,time(),stringParser::encode($_POST['beschreibung']),
                        intval($_POST['kat']),intval($_POST['intern']),intval($_POST['intern'])));

            $show = common::info(_downloads_added, "?admin=dladmin");
        }
    break;
    case 'edit':
        $get  = common::$sql['default']->fetch("SELECT `download`,`intern`,`url`,`kat`,`beschreibung` FROM `{prefix_downloads}` WHERE `id` = ?;",
                array(intval($_GET['id'])));
        $qryk = common::$sql['default']->select("SELECT `id`,`name` FROM `{prefix_download_kat}` ORDER BY `name`;"); $kats = '';
        foreach($qryk as $getk) {
            $sel = ($getk['id'] == $get['kat'] ? 'selected="selected"' : '');
            $kats .= show(_select_field, array("value" => $getk['id'],
                                               "what" => stringParser::decode($getk['name']),
                                               "sel" => $sel));
        }

        $show = show($dir."/form_dl", array("admin_head" => _downloads_admin_head_edit,
                                            "ddownload" => stringParser::decode($get['download']),
                                            "dintern" => $get['intern'] ? 'checked="checked"' : '',
                                            "durl" => stringParser::decode($get['url']),
                                            "dbeschreibung" => stringParser::decode($get['beschreibung']),
                                            "what" => _button_value_edit,
                                            "do" => "editdl&amp;id=".$_GET['id']."",
                                            "kats" => $kats));
    break;
    case 'editdl':
        if(empty($_POST['download']) || empty($_POST['url'])) {
            if(empty($_POST['download'])) 
                $show = common::error(_downloads_empty_download, 1);
            elseif(empty($_POST['url']))  
                $show = common::error(_downloads_empty_url, 1);
        } else {
            $dl = preg_match("#^www#i",$_POST['url']) ? stringParser::encode(common::links($_POST['url'])) : stringParser::encode($_POST['url']);
            common::$sql['default']->update("UPDATE `{prefix_downloads}` SET `download` = ?, "
                    . "`url` = ?, "
                    . "`beschreibung` = ?, "
                    . "`kat` = ?, "
                    . "`intern` = ? "
                    . "WHERE id = ?;",
                array(stringParser::encode($_POST['download']),$dl,stringParser::encode($_POST['beschreibung']),intval($_POST['kat']),
                    intval($_POST['intern']),intval($_GET['id'])));

            $show = common::info(_downloads_edited, "?admin=dladmin");
        }
    break;
    case 'delete':
        common::$sql['default']->delete("DELETE FROM `{prefix_downloads}` WHERE `id` = ?;",array(intval($_GET['id'])));
        $show = common::info(_downloads_deleted, "?admin=dladmin");
    break;
    default:
        $qry = common::$sql['default']->select("SELECT `id`,`download` FROM `{prefix_downloads}` ORDER BY id");
        foreach($qry as $get) {
            $edit = show("page/button_edit_single", array("id" => $get['id'],
                                                          "action" => "admin=dladmin&amp;do=edit",
                                                          "title" => _button_title_edit));
          
            $delete = show("page/button_delete_single", array("id" => $get['id'],
                                                              "action" => "admin=dladmin&amp;do=delete",
                                                              "title" => _button_title_del,
                                                              "del" => _confirm_del_dl));

            $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
            $show .= show($dir."/downloads_show", array("id" => $get['id'],
                                                        "dl" => stringParser::decode($get['download']),
                                                        "class" => $class,
                                                        "edit" => $edit,
                                                        "delete" => $delete));
        }

        if (empty($show)) {
            $show = '<tr><td colspan="3" class="contentMainSecond">'._no_entrys.'</td></tr>';
        }

        $show = show($dir."/downloads", array("show" => $show));
    break;
}