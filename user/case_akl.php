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

if(defined('_UserMenu')) {
    switch ($do) {
        case 'send':
            if (isset($_SESSION['akl_id']) && !empty($_SESSION['akl_id'])) {
                $get = common::$sql['default']->fetch("SELECT `user`,`id`,`email`,`level`,`actkey` FROM `{prefix_users}` WHERE `id` = ?;",
                        array($_SESSION['akl_id']));
            } else {
                $get = common::$sql['default']->fetch("SELECT `user`,`id`,`email`,`level`,`actkey` FROM `{prefix_users}` WHERE `email` = ?;",
                        array(isset($_GET['email']) ? stringParser::encode($_GET['email']) : ''));
            }

            if(common::$sql['default']->rowCount()) {
                if(!$get['level'] && !empty($get['actkey'])) {
                    common::$sql['default']->update("UPDATE `{prefix_userstats}` SET `akl` = (akl+1) WHERE `user` = ?;",array($get['id']));
                    common::$sql['default']->update("UPDATE `{prefix_users}` SET `actkey` = ? WHERE `id` = ?;",
                            array(stringParser::encode($guid = common::GenGuid()),$get['id']));
                    $akl_link = 'http://'.common::$httphost.'/user/?action=akl&do=activate&key='.$guid;
                    $akl_link_page = 'http://'.common::$httphost.'/user/?action=akl&do=activate';
                    $message = show(common::bbcode_email(settings::get('eml_akl_register')), 
                        array("nick" => stringParser::decode($get['user']), 
                              "link_page" => '<a href="'.$akl_link_page.'" target="_blank">'.$akl_link_page.'</a>', 
                              "guid" => $guid, 
                              "link" => '<a href="'.$akl_link.'" target="_blank">Link</a>'));
                    common::sendMail(stringParser::decode($get['email']), stringParser::decode(settings::get('eml_akl_register_subj')), $message);
                    $index = common::info(show(_reg_akl_sended,array('email' => stringParser::decode($get['email']))), "?action=login");
                } else if (!$get['level'] && empty($get['actkey'])) {
                    $index = common::info(_reg_akl_locked, "../news/");
                } else {
                    common::$sql['default']->update("UPDATE `{prefix_users}` SET `actkey` = '' WHERE `id` = ?;", array($get['id']));
                    $index = common::info(_reg_akl_activated, "../news/");
                }
            } else
                $index = common::info(_reg_akl_email_nf, "../news/");
        break;
        case 'activate':
            if ((isset($_GET['key']) && !empty($_GET['key'])) || (isset($_POST['key']) && !empty($_POST['key']))) {
                $get = common::$sql['default']->fetch("SELECT `id` FROM `{prefix_users}` WHERE `actkey` = ?;", array(strtoupper(trim(isset($_POST['key']) ? $_POST['key'] : $_GET['key']))));
                if (common::$sql['default']->rowCount()) {
                    common::$sql['default']->update("UPDATE `{prefix_users}` SET `level` = 1, `status` = 1, `actkey` = '' WHERE `id` = ?;", array($get['id']));
                    $index = common::info(_reg_akl_valid, "../user/?action=login");
                } else {
                    $index = common::info(_reg_akl_invalid, "../user/?action=akl");
                }
            } else {
                $index = show($dir . "/activate_code", array("value" => _button_value_activate));
            }
            break;
        default:
            $index = show($dir."/activate_code", array("value" => _button_value_activate));
        break;
    }
}