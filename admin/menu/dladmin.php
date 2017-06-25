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
switch (common::$do) {
    case 'new':
        $qry = common::$sql['default']->select("SELECT `id`,`name` FROM `{prefix_download_kat}` ORDER BY `name`;"); $kats = '';
        foreach($qry as $get) {
            $kats .= common::select_field($get['id'],false,stringParser::decode($get['name']));
        }

        $files = common::get_files(basePath.'/downloads/files/',false,true); $dl = '';
        foreach ($files as $file) {
            $smarty->caching = false;
            $smarty->assign('dl',$file);
            $smarty->assign('sel','');
            $dl .= $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/downloads_files_exists.tpl');
            $smarty->clearAllAssign();
        }

        $smarty->caching = false;
        $smarty->assign('admin_head',_downloads_admin_head);
        $smarty->assign('ddownload','');
        $smarty->assign('dintern','');
        $smarty->assign('durl','');
        $smarty->assign('file',$dl);
        $smarty->assign('nothing','');
        $smarty->assign('what',_button_value_add);
        $smarty->assign('do',"add");
        $smarty->assign('dbeschreibung','');
        $smarty->assign('kats',$kats);
        $show = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/form_dl.tpl');
        $smarty->clearAllAssign();

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
                    [stringParser::encode($_POST['download']),$dl,time(),stringParser::encode($_POST['beschreibung']),
                        (int)($_POST['kat']),(int)($_POST['intern']),(int)($_POST['intern'])]);

            $show = common::info(_downloads_added, "?admin=dladmin");
        }
    break;
    case 'edit':
        $get  = common::$sql['default']->fetch("SELECT `download`,`intern`,`url`,`kat`,`beschreibung` FROM `{prefix_downloads}` WHERE `id` = ?;",
                [(int)($_GET['id'])]);
        $qryk = common::$sql['default']->select("SELECT `id`,`name` FROM `{prefix_download_kat}` ORDER BY `name`;"); $kats = '';
        foreach($qryk as $getk) {
            $kats .= common::select_field($getk['id'],($getk['id'] == $get['kat']),stringParser::decode($getk['name']));
        }

        $smarty->caching = false;
        $smarty->assign('admin_head',_downloads_admin_head_edit);
        $smarty->assign('ddownload',stringParser::decode($get['download']));
        $smarty->assign('dintern',$get['intern'] ? 'checked="checked"' : '');
        $smarty->assign('durl',stringParser::decode($get['url']));
        $smarty->assign('dbeschreibung',stringParser::decode($get['beschreibung']));
        $smarty->assign('what',_button_value_edit);
        $smarty->assign('do',"editdl&amp;id=".$_GET['id']."");
        $smarty->assign('kats',$kats);
        $show = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/form_dl.tpl');
        $smarty->clearAllAssign();

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
                [stringParser::encode($_POST['download']),$dl,stringParser::encode($_POST['beschreibung']),(int)($_POST['kat']),
                    (int)($_POST['intern']),(int)($_GET['id'])]);

            $show = common::info(_downloads_edited, "?admin=dladmin");
        }
    break;
    case 'delete':
        common::$sql['default']->delete("DELETE FROM `{prefix_downloads}` WHERE `id` = ?;", [(int)($_GET['id'])]);
        $show = common::info(_downloads_deleted, "?admin=dladmin");
    break;
    default:
        $qry = common::$sql['default']->select("SELECT `id`,`download` FROM `{prefix_downloads}` ORDER BY id");
        foreach($qry as $get) {
            $edit = common::getButtonEditSingle($get['id'],"admin=".$admin."&amp;do=edit");
            $delete = common::button_delete_single($get['id'],"admin=".$admin."&amp;do=delete",_button_title_del,_confirm_del_dl);

            $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
            $smarty->caching = false;
            $smarty->assign('id',$get['id']);
            $smarty->assign('dl',stringParser::decode($get['download']));
            $smarty->assign('class',$class);
            $smarty->assign('edit',$edit);
            $smarty->assign('delete',$delete);
            $show .= $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/downloads_show.tpl');
            $smarty->clearAllAssign();
        }

        if (empty($show)) {
            $show = '<tr><td colspan="3" class="contentMainSecond">'._no_entrys.'</td></tr>';
        }

        $smarty->caching = false;
        $smarty->assign('show',$show);
        $show = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/downloads.tpl');
        $smarty->clearAllAssign();

    break;
}