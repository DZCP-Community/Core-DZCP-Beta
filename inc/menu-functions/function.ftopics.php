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

function smarty_function_ftopics($params, &$smarty) {
    $qry = common::$sql['default']->select("SELECT s1.*,s2.`kattopic`,s2.`id` as `subid` "
        . "FROM `{prefix_forumthreads}` as `s1`, `{prefix_forumsubkats}` as `s2`, {prefix_forumkats} as `s3` "
        . "WHERE s1.`kid` = s2.`id` AND s2.`sid` = s3.`id` ORDER BY s1.`lp` DESC LIMIT 100;");

    $f = 0; $ftopics = '';
    if(common::$sql['default']->rowCount()) {
        $smarty_ftopics = common::getSmarty(true); //Use Smarty
        foreach($qry as $get) {
            if($f == settings::get('m_ftopics')) { break; }
            if(common::forum_intern($get['kid'])) {
                $lp = common::cnt("{prefix_forumposts}", " WHERE `sid` = ?","id", [$get['id']]);
                $pagenr = ceil($lp/settings::get('m_fposts'));
                $page = !$pagenr ? 1 : $pagenr;
                $info = 'onmouseover="DZCP.showInfo(\''.common::jsconvert(stringParser::decode($get['topic'])).'\', \''.
                    _forum_kat.';'._forum_posts.';'._forum_lpost.'\', \''.stringParser::decode($get['kattopic']).';'.++$lp.';'.
                    date("d.m.Y H:i", $get['lp'])._uhr.'\')" onmouseout="DZCP.hideInfo()"';

                $smarty_ftopics->caching = false;
                $smarty_ftopics->assign('id',$get['id']);
                $smarty_ftopics->assign('pagenr',$page);
                $smarty_ftopics->assign('p',$lp);
                $smarty_ftopics->assign('titel',common::cut(stringParser::decode($get['topic']),settings::get('l_ftopics')));
                $smarty_ftopics->assign('info',$info);
                $smarty_ftopics->assign('kid',$get['kid']);
                $ftopics .= $smarty_ftopics->fetch('file:['.common::$tmpdir.']menu/forum/forum_topics.tpl');
                $smarty_ftopics->clearAllAssign();
                $f++;
            }
        }
    }

    return empty($ftopics) ? '<div style="margin:2px 0;text-align:center;">'._no_entrys.'</div>' : '<table class="navContent" cellspacing="0">'.$ftopics.'</table>';
}