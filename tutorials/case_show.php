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

if (!defined('_Tutorials')) exit();

$index = common::error(_error_wrong_permissions);

$getkat = common::$sql['default']->fetch("SELECT `name`,`beschreibung`,`id` FROM `{prefix_tutorials_kats}` WHERE `level` <= ? AND `id` = ? ORDER BY `pos`;",
    [common::$chkMe,(int)($_GET['id'])]);
if(common::$sql['default']->rowCount()) {
    $pfad = "/inc/images/uploads/tutorials/kats/".$getkat['id']; $pic_kat = "";
    foreach(common::SUPPORTED_PICTURE as $endung) {
        if (file_exists(basePath . $pfad . "." . $endung)) {
            $pic_kat = "<a href=\"index.php?action=show&amp;id=" . $getkat['id'] . "\"><img src=\"../" . $pfad . "." . $endung . "\" style=\"max-width:200px;max-height:100px\" alt=\"\" /></a>";
            break;
        }
    } //foreach

    $qry = common::$sql['default']->select("SELECT * FROM `{prefix_tutorials}` WHERE `kat` = ? ".
        common::orderby_sql(["pos","datum","name","difficulty","rating"], 'ORDER BY `datum` DESC,`name`')." LIMIT "
        .((common::$page - 1)*settings::get('m_tutorials')).",".settings::get('m_tutorials').";",
        [$getkat['id']]);

    $tutorial = '';
    if(($entrys=common::$sql['default']->rowCount())) {
        foreach($qry as $get) {
            $pfad = "inc/images/uploads/tutorials/".$get['id']; $pic = "";
            foreach(common::SUPPORTED_PICTURE as $endung) {
                if (file_exists(basePath . '/' .$pfad . "." . $endung)) {
                    $pic = common::img_size($pfad.".".$endung);
                    break;
                }
            } //foreach

            $smarty->caching = false;
            $smarty->assign('id',$get['id']);
            $smarty->assign('bezeichnung',stringParser::decode($get['name']));
            $smarty->assign('datum',date("d.m.Y H:i",$get['datum']));
            $smarty->assign('pic',$pic);
            $smarty->assign('beschreibung',BBCode::parse_html((string)$get['beschreibung']));
            $smarty->assign('v_schwierigkeit',$get['difficulty']);
            $smarty->assign('v_bewertung',tutorials::get_html_rating($get['id']));
            $smarty->assign('v_comments',common::cnt("{prefix_tutorials_comments}", " WHERE `tutorial` = ?", "id", [$get['id']]));
            $smarty->assign('autor',common::autor($get['autor']));
            $tutorial .= $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/tutorials/tutorials_show.tpl');
            $smarty->clearAllAssign();
        } //foreach
    }

    //Pagination
    $entrys = common::cnt("{prefix_tutorials}", " WHERE `kat` = ?", "id", [$getkat['id']]);
    $seiten = common::nav($entrys,settings::get('m_tutorials'),"?action=show&amp;id=".$_GET['id'].common::orderby_nav());

    $smarty->caching = false;
    $smarty->assign('katpic',$pic_kat);
    $smarty->assign('kat_beschreibung',BBCode::parse_html((string)$getkat['beschreibung']));
    $smarty->assign('id',$getkat['id']);
    $smarty->assign('kategorie_name',stringParser::decode($getkat['name']));
    $smarty->assign('orderby',isset($_GET['orderby']) ? $_GET['orderby'] : "");
    $smarty->assign('order',isset($_GET['order']) ? $_GET['order'] : "");
    $smarty->assign('seiten',$seiten);
    $smarty->assign('tutorials',$tutorial);
    $index = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/tutorials/tutorials.tpl');
    $smarty->clearAllAssign();
    unset($tutorial,$seiten,$getkat,$pic_kat,$entrys,$get,$qry,$pfad);
}
