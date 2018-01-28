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
$where = $where.': '._admin_dlkat;

switch (common::$do) {
    case 'edit':
        $get = common::$sql['default']->fetch("SELECT `name` FROM `{prefix_download_kat}` WHERE `id` = ?;",
                [(int)($_GET['id'])]);
        $smarty->caching = false;
        $smarty->assign('newhead',_dl_edit_head);
        $smarty->assign('do',"editkat&amp;id=".$_GET['id']."");
        $smarty->assign('kat',stringParser::decode($get['name']));
        $smarty->assign('what',_button_value_edit);
        $show = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/dlkats_form.tpl');
        $smarty->clearAllAssign();

    break;
    case 'editkat':
        if(empty($_POST['kat'])) {
            notification::add_error(_dl_empty_kat);
            $get = common::$sql['default']->fetch("SELECT `name` FROM `{prefix_download_kat}` WHERE `id` = ?;",
                [(int)($_GET['id'])]);
            $smarty->caching = false;
            $smarty->assign('newhead',_dl_edit_head);
            $smarty->assign('do',"editkat&amp;id=".$_GET['id']."");
            $smarty->assign('kat',stringParser::decode($get['name']));
            $smarty->assign('what',_button_value_edit);
            $show = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/dlkats_form.tpl');
            $smarty->clearAllAssign();
        } else {
            common::$sql['default']->update("UPDATE `{prefix_download_kat}` SET `name` = ? WHERE `id` = ?;",
                    [stringParser::encode($_POST['kat']),(int)($_GET['id'])]);
            notification::add_success(_dl_admin_edited);
        }
    break;
    case 'delete':
        common::$sql['default']->delete("DELETE FROM `{prefix_download_kat}` WHERE `id` = ?;",
                [(int)($_GET['id'])]);
        notification::add_success(_dl_admin_deleted);
    break;
    case 'new':
        $smarty->caching = false;
        $smarty->assign('newhead',_dl_new_head);
        $smarty->assign('do',"add");
        $smarty->assign('kat',"");
        $smarty->assign('what',_button_value_add);
        $show = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/dlkats_form.tpl');
        $smarty->clearAllAssign();
    break;
    case 'add':
        if(empty($_POST['kat'])) {
            notification::add_error(_dl_empty_kat);
            $smarty->caching = false;
            $smarty->assign('newhead',_dl_new_head);
            $smarty->assign('do',"add");
            $smarty->assign('kat',"");
            $smarty->assign('what',_button_value_add);
            $show = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/dlkats_form.tpl');
            $smarty->clearAllAssign();
        } else {
            common::$sql['default']->insert("INSERT INTO `{prefix_download_kat}` SET `name` = ?;",
                  [stringParser::encode($_POST['kat'])]);
            notification::add_success(_dl_admin_added);
        }
    break;
}

if(empty($show)) {
    $qry = common::$sql['default']->select("SELECT * FROM `{prefix_download_kat}` ORDER BY `name`;");
    foreach ($qry as $get) {
        $edit = common::getButtonEditSingle($get['id'], "admin=" . $admin . "&amp;do=edit");
        $delete = common::button_delete_single($get['id'], "admin=" . $admin . "&amp;do=delete", _button_title_del, _confirm_del_kat);

        $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst";
        $color++;
        $smarty->caching = false;
        $smarty->assign('edit', $edit);
        $smarty->assign('name', stringParser::decode($get['name']));
        $smarty->assign('class', $class);
        $smarty->assign('delete', $delete);
        $show .= $smarty->fetch('file:[' . common::$tmpdir . ']' . $dir . '/dlkats_show.tpl');
        $smarty->clearAllAssign();
    }

    $smarty->caching = false;
    $smarty->assign('show', $show);
    $show = $smarty->fetch('file:[' . common::$tmpdir . ']' . $dir . '/dlkats.tpl');
    $smarty->clearAllAssign();
}