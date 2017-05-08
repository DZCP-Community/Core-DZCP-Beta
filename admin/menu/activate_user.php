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
$where = $where.': '._config_activate_user;

switch ($do) {
    case 'activate':
        common::$sql['default']->update("UPDATE `{prefix_users}` SET `level` = 1, `status` = 1, `actkey` = '' WHERE `id` = ?;", [intval($_GET['id'])]);
        $show = common::info(_actived, "?admin=activate_user", 2);

    break;
    case 'delete':
        if(($id = isset($_GET['id']) ? $_GET['id'] : false) != false) {
            common::$sql['default']->delete("DELETE FROM `{prefix_users}` WHERE `id` = ?;", [intval($id)]);
            common::$sql['default']->delete("DELETE FROM `{prefix_permissions}` WHERE `user` = ?;", [intval($id)]);
            common::$sql['default']->delete("DELETE FROM `{prefix_userstats}` WHERE `user` = ?;", [intval($id)]);
            $show = common::info(_user_deleted, "?admin=activate_user", 3);
        }
    break;
    case 'delete-all':
        if(isset($_POST['userid']) && count($_POST['userid']) >= 1) {
            foreach($_POST['userid'] as $id) {
                common::$sql['default']->delete("DELETE FROM `{prefix_users}` WHERE `id` = ?;", [intval($id)]);
                common::$sql['default']->delete("DELETE FROM `{prefix_permissions}` WHERE `user` = ?;", [intval($id)]);
                common::$sql['default']->delete("DELETE FROM `{prefix_userstats}` WHERE `user` = ?;", [intval($id)]);
            }

            $show = common::info(_users_deleted, "?admin=activate_user", 4);
        }
    break;
    case 'enable-all':
        if(isset($_POST['userid']) && count($_POST['userid']) >= 1) {
            foreach ($_POST['userid'] as $id) {
                common::$sql['default']->update("UPDATE `{prefix_users}` SET `level` = 1, `status` = 1, `actkey` = '' WHERE `id` = ?;", [intval($id)]);
            }

            $show = common::info(_actived_all, "?admin=activate_user", 3);
        }
    break;
    case 'resend':
        if(($id = isset($_GET['id']) ? $_GET['id'] : false) != false) {
            $get = common::$sql['default']->fetch("SELECT `user`,`id`,`email` FROM `{prefix_users}` WHERE `id` = ?;", [$id]);
            common::$sql['default']->update("UPDATE `{prefix_userstats}` SET `akl` = (akl+1) WHERE `user` = ?;", [$get['id']]);
            common::$sql['default']->update("UPDATE `{prefix_users}` SET `actkey` = ? WHERE `id` = ?;", [($guid=common::GenGuid()),$get['id']]);
            $akl_link = 'http://'.common::$httphost.'/user/?action=akl&do=activate&key='.$guid;
            $akl_link_page = 'http://'.common::$httphost.'/user/?action=akl&do=activate';
            $message = show(common::bbcode_email(settings::get('eml_akl_register')), 
                        ["nick" => stringParser::decode($get['user']),
                              "link_page" => '<a href="'.$akl_link_page.'" target="_blank">'.$akl_link_page.'</a>', 
                              "guid" => $guid, 
                              "link" => '<a href="'.$akl_link.'" target="_blank">Link</a>']);
            common::sendMail(stringParser::decode($get['email']), stringParser::decode(settings::get('eml_akl_register_subj')), $message);
            $show = common::info(show(_admin_akl_resend, ['email' => $get['email']]), "?admin=activate_user", 4);
        }
    break;
    case 'send-all':
        if(isset($_POST['userid']) && count($_POST['userid']) >= 1) {
            $emails = ''; $i = 0;
            foreach($_POST['userid'] as $id) {
                $get = common::$sql['default']->fetch("SELECT `user`,`id`,`email` FROM `{prefix_users}` WHERE `id` = ?;", [$id]);
                common::$sql['default']->update("UPDATE `{prefix_userstats}` SET `akl` = (akl+1) WHERE `user` = ?;", [$get['id']]);
                common::$sql['default']->update("UPDATE `{prefix_users}` SET `actkey` = '".($guid=common::GenGuid())."' WHERE `id` = ?;", [$get['id']]);
                $akl_link = 'http://'.common::$httphost.'/user/?action=akl&do=activate&key='.$guid;
                $akl_link_page = 'http://'.common::$httphost.'/user/?action=akl&do=activate';
                $message = show(common::bbcode_email(settings::get('eml_akl_register')), 
                            ["nick" => stringParser::decode($get['user']),
                                  "link_page" => '<a href="'.$akl_link_page.'" target="_blank">'.$akl_link_page.'</a>', 
                                  "guid" => $guid, 
                                  "link" => '<a href="'.$akl_link.'" target="_blank">Link</a>']);
                common::sendMail(stringParser::decode($get['email']), stringParser::decode(settings::get('eml_akl_register_subj')), $message);
                $emails .= (!$i ? $get['email'] : ', '.$get['email']); $i++;
            }

            $show = common::info(show(_admin_akl_resend, ['email' => $emails]), "?admin=activate_user", 8);
        }
    break;
    default:
        $qry = common::$sql['default']->select("SELECT `id`,`bday` FROM `{prefix_users}` WHERE `level` = 0 AND `actkey` IS NOT NULL ORDER BY nick;");
        $activate = ''; $color = 1;
        foreach($qry as $get) {
            $resend = show(_emailicon_non_mailto, ["email" => '?admin=activate_user&amp;do=resend&amp;id='.$get['id']]);
            $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
            $edit = str_replace("&amp;id=","",show("page/button_edit_akl", ["id" => $get['id'], "action" => "../user/?action=admin&edit=", "title" => _button_title_edit]));
            $akl = show("page/button_akl", ["id" => $get['id'], "action" => "admin=activate_user&amp;do=activate&amp;id=", "title" => _button_title_akl]);

            $smarty->caching = false;
            $smarty->assign('id',$get['id']);
            $smarty->assign('action',"admin=activate_user&amp;do=delete");
            $smarty->assign('title',_button_title_del);
            $delete = $smarty->fetch('file:['.common::$tmpdir.']page/buttons/button_delete.tpl');
            $smarty->clearAllAssign();

            $activate .= show($dir."/activate_user_show", ["nick" => common::autor($get['id'],'', 0, '',25),
                                                                "akt" => $akl,
                                                                "resend" => $resend,
                                                                "age" => common::getAge($get['bday']),
                                                                "sended" => common::userstats('akl',$get['id']),
                                                                "edit" => $edit,
                                                                "delete" => $delete,
                                                                "class" => $class,
                                                                "id" => $get['id'],
                                                                "onoff" => common::onlinecheck($get['id'])]);
        }

        if(empty($activate)) {
            $activate = '<tr><td colspan="9" class="contentMainSecond">'._no_entrys.'</td></tr>';
        }

        $show = show($dir."/activate_user", ["value" => _button_value_search, "show" => $activate]);
    break;
}