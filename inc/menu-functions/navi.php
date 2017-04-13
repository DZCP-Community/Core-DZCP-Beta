<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 * Menu: Navigation
 */

function navi($kat) {
    $navi="";
    if($k = common::$sql['default']->fetch("SELECT `level` FROM `{prefix_navi_kats}` WHERE `placeholder` = ?;",array(stringParser::encode($kat)))) {
        $permissions = ($kat == 'nav_admin' && common::admin_perms(common::$userid)) ? "" : (common::$chkMe >= 2 ? '' : " AND s1.`internal` = 0")." AND ".intval(common::$chkMe)." >= ".intval($k['level']);
        $qry = common::$sql['default']->select("SELECT s1.* FROM `{prefix_navi}` AS `s1` "
                . "LEFT JOIN `{prefix_navi_kats}` AS `s2` ON s1.`kat` = s2.`placeholder` "
                . "WHERE s1.`kat` = ? AND s1.`shown` = 1 ".$permissions." "
                . "ORDER BY s1.`pos`;",array(stringParser::encode($kat)));

        if(common::$sql['default']->rowCount()) {
            foreach($qry as $get) {
                $link = '';
                if($get['type'] == 1 || $get['type'] == 2 || $get['type'] == 3) {
                    $name = ($get['wichtig']) ? '<span class="fontWichtig">'.common::navi_name(stringParser::decode($get['name'])).'</span>' : common::navi_name(stringParser::decode($get['name']));
                    $target = ($get['target']) ? '_blank' : '_self';

                    if(file_exists(common::$designpath.'/menu/'.$get['kat'].'.html')) {
                        $link = show("menu/".$get['kat']."", array("target" => $target,
                                                                   "href" => preg_replace('"( |^)(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)"i', 'http://\2', stringParser::decode($get['url'])),
                                                                   "title" => strip_tags($name),
                                                                   "css" => ucfirst(str_replace('nav_', '', stringParser::decode($get['kat']))),
                                                                   "link" => $name));
                    } else {
                        $link = show("menu/nav_link", array("target" => $target,
                                                            "href" => preg_replace('"( |^)(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)"i', 'http://\2', stringParser::decode($get['url'])),
                                                            "title" => strip_tags($name),
                                                            "css" => ucfirst(str_replace('nav_', '', stringParser::decode($get['kat']))),
                                                            "link" => $name));
                    }

                    $table = strstr($link, '<tr>') ? true : false;
                }

                $navi .= $link;
            }
        }
    }

    return empty($navi) ? '' : ($table ? '<table class="navContent" cellspacing="0">'.$navi.'</table>' : $navi);
}