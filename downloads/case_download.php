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

if (!defined('_Downloads')) exit();

if(settings::get("reg_dl") && !common::$chkMe)
    $index = common::error(_error_unregistered);
else {
    $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_downloads}` WHERE `id` = ?;", [(int)($_GET['id'])]);
    if(common::$sql['default']->rowCount()) {
        if(!common::permission('dlintern') && $get['intern']) {
            $index = common::error(_error_no_access);
        } else {
            $file = preg_replace("#added...#Uis", "files/", stringParser::decode($get['url']));
            if(strpos(stringParser::decode($get['url']),"../") != 0) 
                $rawfile = @basename($file);
            else 
                $rawfile = stringParser::decode($get['download']);

            $size = 0;
            if(file_exists($file)) {
                $size = filesize($file);
            }

            $size_mb = 0; $size_kb = 0; $speed_modem = 0; $speed_isdn = 0; $speed_dsl256 = 0;
            $speed_dsl512 = 0; $speed_dsl1024 = 0; $speed_dsl2048 = 0; $speed_dsl3072 = 0;
            $speed_dsl6016 = 0; $speed_dsl16128 = 0;
            if($size) {
                $size_mb = @round($size/1048576,2);
                $size_kb = @round($size/1024,2);
                $speed_dsl1024 = @round(($size/1024)/(1024/8)/60,2);
                $speed_dsl2048 = @round(($size/1024)/(2048/8)/60,2);
                $speed_dsl3072 = @round(($size/1024)/(3072/8)/60,2);
                $speed_dsl6016 = @round(($size/1024)/(6016/8)/60,2);
                $speed_dsl16128 = @round(($size/1024)/(16128/8)/60,2);
            }

            if(strlen(@round(($size/1048576)*$get['hits'],0)) >= 4)
                $traffic = @round(($size/1073741824)*$get['hits'],2).' GB';
            else
                $traffic = @round(($size/1048576)*$get['hits'],2).' MB';

            $smarty->caching = false;
            $smarty->assign('file',$rawfile);
            $getfile = $smarty->fetch('string:'._dl_getfile);
            $smarty->clearAllAssign();

            if(!$size) {
                $dlsize = $traffic = 'n/a';
                $br1 = '<!--';
                $br2 = '-->';
            } else {
                $dlsize = $size_mb.' MB ('.$size_kb.' KB)';
                $br1 = '';
                $br2 = '';
            }

            $date = 'n/a';
            if(empty($get['date']))
                $date = date("d.m.Y H:i",@filemtime($file))._uhr;
            else
                $date = date("d.m.Y H:i",$get['date'])._uhr;

            $lastdate = date("d.m.Y H:i",$get['last_dl'])._uhr;

            $smarty->caching = false;
            $smarty->assign('getfile',$getfile);
            $smarty->assign('br1',$br1);
            $smarty->assign('br2',$br2);
            $smarty->assign('date',$date);
            $smarty->assign('lastdate',$lastdate);
            $smarty->assign('id',$get['id']);
            $smarty->assign('dlname',stringParser::decode($get['download']));
            $smarty->assign('loaded',$get['hits']);
            $smarty->assign('traffic',$traffic);
            $smarty->assign('speed_dsl1024',$speed_dsl1024);
            $smarty->assign('speed_dsl2048',$speed_dsl2048);
            $smarty->assign('speed_dsl3072',$speed_dsl3072);
            $smarty->assign('speed_dsl6016',$speed_dsl6016);
            $smarty->assign('speed_dsl16128',$speed_dsl16128);
            $smarty->assign('size',$dlsize);
            $smarty->assign('besch',bbcode_old::parse_html($get['beschreibung']));
            $smarty->assign('file',$rawfile);
            $index = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/info.tpl');
            $smarty->clearAllAssign();
        }
    } else
        $index = common::error(_id_dont_exist,1);
}