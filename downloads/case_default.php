<?php
/**
 * DZCP - deV!L`z ClanPortal - Mainpage ( dzcp.de )
 * deV!L`z Clanportal ist ein Produkt von CodeKing,
 * geändert durch my-STARMEDIA und Codedesigns.
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

$qry = common::$sql['default']->select("SELECT * FROM `{prefix_download_kat}` ORDER BY `name`;");
$t = 1; $cnt = 0; $kats = '';
foreach($qry as $get) {
    $intern =  common::permission('dlintern') ? "" : "AND `intern` = 0 "; $show = "";
    $qrydl = common::$sql['default']->select("SELECT * FROM `{prefix_downloads}` WHERE `kat` = ? ".$intern."ORDER BY `download`;", [$get['id']]);
    if(common::$sql['default']->rowCount()) {
        //Files
        foreach($qrydl as $getdl) {
            $smarty->caching = false;
            $smarty->assign('id',$getdl['id']);
            $smarty->assign('download',stringParser::decode($getdl['download']));
            $smarty->assign('titel',stringParser::decode($getdl['download']));
            $link = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/downloads_link.tpl');
            $smarty->clearAllAssign();

            $smarty->caching = false;
            $smarty->assign('color',$color);
            $smarty->assign('link',$link);
            $smarty->assign('hits',$getdl['hits']);
            $show .= $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/downloads_show.tpl');
            $smarty->clearAllAssign();
            $color++;
        }
    }

    //Kat
    $cntKat = common::cnt("{prefix_downloads}", " WHERE `kat` = ?","id", [$get['id']]);
    $dltitel = ($cntKat == 1 ? _dl_file : _dl_files);

    $smarty->caching = false;
    $smarty->assign('file',$dltitel);
    $smarty->assign('cnt',$cntKat);
    $smarty->assign('name',stringParser::decode($get['name']));
    $kat = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/download_titel.tpl');
    $smarty->clearAllAssign();

    $smarty->caching = false;
    $smarty->assign('kat',$kat);
    $smarty->assign('show',$show);
    $kats .= $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/download_kats.tpl');
    $smarty->clearAllAssign();
}

$smarty->caching = false;
$smarty->assign('kats',$kats);
$index = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/downloads.tpl');
$smarty->clearAllAssign();