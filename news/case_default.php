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

if(defined('_News')) {
    //-> Kategorie Filter
    if(!($kat = isset($_GET['newskat']) ? intval($_GET['newskat']) : 0)) {
        $navKat = 'lazy';
        $n_kat = '';
        $navWhere = "WHERE `public` = 1 ".(!common::permission("intnews") ? "AND `intern` = 0" : '')."";
    } else {
        $n_kat = "AND `kat` = ".$kat;
        $navKat = $kat;
        $navWhere = "WHERE `kat` = '".$kat."' AND public = 1 ".(!common::permission("intnews") ? "AND `intern` = 0" : '')."";
    }

    //Sticky News
    $qry = common::$sql['default']->select("SELECT * FROM `{prefix_news}` WHERE `sticky` >= ? AND `datum` <= ? AND "
            . "`public` = 1 ".(common::permission("intnews") ? "" : "AND `intern` = 0")." ".$n_kat." "
            . "ORDER BY `datum` DESC LIMIT ".(($page - 1)*settings::get('m_news')).",".settings::get('m_news').";",
            [($time=time()),$time]);

    $show_sticky = '';
    if(common::$sql['default']->rowCount()) {
        foreach($qry as $get) {
            //-> Viewed
            $smarty->caching = false;
            $smarty->assign('viewed',$get['viewed']);
            $viewed = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/news_viewed.tpl');
            $smarty->clearAllAssign();

            //Bild
            $newsimage = '../inc/images/newskat/'.stringParser::decode(common::$sql['default']->fetch("SELECT `katimg` FROM `{prefix_newskat}` WHERE `id` = ?;",
                    [$get['kat']],'katimg'));
            foreach(["jpg", "gif", "png"] as $tmpendung) {
                if(file_exists(basePath."/inc/images/uploads/news/".$get['id'].".".$tmpendung)) {
                    $newsimage = '../inc/images/uploads/news/'.$get['id'].'.'.$tmpendung;
                    break;
                }
            }

            //-> News [Caching]
            $smarty->caching = true;
            $smarty->assign('titel',stringParser::decode($get['titel']));
            $smarty->assign('kat',$newsimage);
            $smarty->assign('id',$get['id']);
            $smarty->assign('comments',common::cnt('{prefix_newscomments}', " WHERE `news` = ".intval($get['id'])));
            $smarty->assign('showmore','');
            $smarty->assign('dp','none');
            $smarty->assign('dir',$designpath);
            $smarty->assign('intern',boolval($get['intern']));
            $smarty->assign('sticky',_news_sticky);
            $smarty->assign('more',bbcode::parse_html($get['klapptext']));
            $smarty->assign('viewed',$viewed);
            $smarty->assign('text',bbcode::parse_html($get['text']));
            $smarty->assign('datum',date("d.m.y H:i", $get['datum']));
            $smarty->assign('links',$links);
            $smarty->assign('autor',common::autor($get['autor']));
            $show_sticky .= $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/news_show.tpl',common::getSmartyCacheHash('news_'.$get['id']));
            $smarty->clearAllAssign();
        }

        unset($get,$newsimage,$viewed,$links);
    }

    //News
    $qry = common::$sql['default']->select("SELECT * FROM `{prefix_news}` WHERE `sticky` < ? AND `datum` <= ? "
            . "AND `public` = 1 ".(common::permission("intnews") ? "" : "AND `intern` = 0")." ".$n_kat." "
            . "ORDER BY `datum` DESC LIMIT ".($page - 1)*settings::get('m_news').",".settings::get('m_news').";",
            [($time=time()),$time]);
    if(common::$sql['default']->rowCount()) {
        foreach($qry as $get) {
            //-> Viewed
            $smarty->caching = false;
            $smarty->assign('viewed',$get['viewed']);
            $viewed = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/news_viewed.tpl');
            $smarty->clearAllAssign();

            //-> News-Kategorie Bild
            $newsimage = '../inc/images/newskat/'.stringParser::decode(common::$sql['default']->fetch("SELECT `katimg` FROM `{prefix_newskat}` WHERE `id` = ?;",
                    [$get['kat']],'katimg'));
            foreach(["jpg", "gif", "png"] as $tmpendung) {
                //-> News Bild by ID
                if(file_exists(basePath."/inc/images/uploads/news/".$get['id'].".".$tmpendung)) {
                    $newsimage = '../inc/images/uploads/news/'.$get['id'].'.'.$tmpendung;
                    break;
                }
            }

            //-> News [Caching]
            $smarty->caching = true;
            $smarty->assign('titel',stringParser::decode($get['titel']));
            $smarty->assign('kat',$newsimage);
            $smarty->assign('id',$get['id']);
            $smarty->assign('comments',common::cnt('{prefix_newscomments}', " WHERE `news` = ".intval($get['id'])));
            $smarty->assign('showmore','');
            $smarty->assign('dp','none');
            $smarty->assign('dir',common::$designpath);
            $smarty->assign('intern',boolval($get['intern']));
            $smarty->assign('sticky','');
            $smarty->assign('more',bbcode::parse_html($get['klapptext']));
            $smarty->assign('viewed',$viewed);
            $smarty->assign('text',bbcode::parse_html($get['text']));
            $smarty->assign('datum',date("d.m.y H:i", $get['datum']));
            $smarty->assign('autor',common::autor($get['autor']));
            $show .= $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/news_show.tpl',common::getSmartyCacheHash('news_'.$get['id']));
            $smarty->clearAllAssign();
        }

        unset($get,$newsimage,$viewed,$links);
    }

    //-> Kategorie Filter Menu
    $qrykat = common::$sql['default']->select("SELECT `id`,`kategorie` FROM `{prefix_newskat}`;");
    $kategorien = '';
    if(common::$sql['default']->rowCount()) {
        foreach($qrykat as $getkat) {
            $sel = (isset($_GET['kat']) && intval($_GET['kat']) == $getkat['id'] ? 'selected' : '');
            $kategorien .= "<option value='".$getkat['id']."' ".$sel.">".$getkat['kategorie']."</option>";
        }
    }

    //-> Index Output
    $smarty->caching = false;
    $smarty->assign('show',$show);
    $smarty->assign('show_sticky',$show_sticky);
    $smarty->assign('nav',common::nav(common::cnt('{prefix_news}',$navWhere),settings::get('m_news'),"?kat=".$navKat));
    $smarty->assign('kategorien',$kategorien);
    $index = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/news.tpl');
    unset($smarty,$show,$show_sticky,$kategorien);
}