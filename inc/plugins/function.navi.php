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

/**
 * Usage {dir}
 * @param $params
 * @param $smarty
 * @return string
 */
function smarty_function_navi($params, &$smarty) {
    $navi=""; $params['kat'] = 'nav_'.trim($params['kat']);
    $k = common::$sql['default']->fetch("SELECT `level` FROM `{prefix_navi_kats}` WHERE `placeholder` = ?;",[stringParser::encode($params['kat'])]);
    if(common::$sql['default']->rowCount()) {
        $smarty_nav = common::getSmarty(true); //Use Smarty
        $permissions = ($params['kat'] == 'nav_admin' && common::admin_perms(common::$userid)) ? "" : (common::$chkMe >= 2 ? '' : " AND s1.`internal` = 0")." AND ".
            (int)(common::$chkMe)." >= ".(int)($k['level']);
        $qry = common::$sql['default']->select("SELECT s1.* FROM `{prefix_navi}` AS `s1` "
            . "LEFT JOIN `{prefix_navi_kats}` AS `s2` ON s1.`kat` = s2.`placeholder` "
            . "WHERE s1.`kat` = ? AND s1.`shown` = 1 ".$permissions." "
            . "ORDER BY s1.`pos`;", [stringParser::encode($params['kat'])]);

        if(common::$sql['default']->rowCount()) {
            foreach($qry as $get) {
                $link = '';
                if($get['type'] == 1 || $get['type'] == 2 || $get['type'] == 3) {
                    $name = ($get['wichtig']) ? '<span class="fontWichtig">'.common::navi_name(stringParser::decode($get['name'])).'</span>' : common::navi_name(stringParser::decode($get['name']));
                    $target = ($get['target']) ? '_blank' : '_self';
                    if(file_exists(common::$designpath.'/menu/navi/'.$get['kat'].'.tpl')) {
                        $smarty_nav->caching = false;
                        $smarty_nav->assign('target',$target);
                        $smarty_nav->assign('href',preg_replace('"( |^)(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)"i', 'http://\2', stringParser::decode($get['url'])));
                        $smarty_nav->assign('title',strip_tags($name));
                        $smarty_nav->assign('css',ucfirst(str_replace('nav_', '', stringParser::decode($get['kat']))));
                        $smarty_nav->assign('link',$name);
                        $link = $smarty_nav->fetch('file:['.common::$tmpdir.']menu/navi/'.stringParser::decode($get['kat']).'.tpl');
                        $smarty_nav->clearAllAssign();
                    } else {
                        $smarty_nav->caching = false;
                        $smarty_nav->assign('target',$target);
                        $smarty_nav->assign('href',preg_replace('"( |^)(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)"i', 'http://\2', stringParser::decode($get['url'])));
                        $smarty_nav->assign('title',strip_tags($name));
                        $smarty_nav->assign('css',ucfirst(str_replace('nav_', '', stringParser::decode($get['kat']))));
                        $smarty_nav->assign('link',$name);
                        $link = $smarty_nav->fetch('file:['.common::$tmpdir.']menu/navi/nav_link.tpl');
                        $smarty_nav->clearAllAssign();
                    }

                    $table = strstr($link, '<tr>') ? true : false;
                }

                $navi .= $link;
            }
        }
    }

    unset($smarty_nav);
    return empty($navi) ? '' : ($table ? '<table class="navContent" cellspacing="0">'.$navi.'</table>' : $navi);
}