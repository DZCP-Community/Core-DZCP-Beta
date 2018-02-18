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

if(_adminMenu != 'true') exit;

switch (common::$do) {
    default:
        if(isset($_GET['id'])) {
            $update_stable = false;
            $getv = common::$sql['default']->fetch("SELECT `id`,`static_version`,`edition` FROM `{prefix_addon_version}` WHERE `id` = ?;",[(int)$_GET['id']]);
            $class_dzcp_version = new dzcp_version;
            $xml = $class_dzcp_version->updateGithub($getv['static_version'], $getv['edition']);
            if (is_array($xml)) {
                switch (stringParser::decode($getv['edition'])) {
                    case 'dev':
                        $dzcp_edition = 'Development';
                        break;
                    case 'society':
                        $dzcp_edition = 'Society';
                        break;
                    case 'stable':
                        $dzcp_edition = 'Live/Stable';
                        break;
                }

                common::$sql['default']->update("UPDATE `{prefix_addon_version}` SET `version` = ?, `release` = ?, `build` = ?, `updated` = ? WHERE `id` = ?;",
                    [stringParser::encode($xml['version']), stringParser::encode($xml['release']), stringParser::encode($xml['build']), time(), $getv['id']]);
                notification::add_success('DZCP-Version: '.$dzcp_edition.' [ '.$xml['version'].' / '.$xml['release'].' / '.$xml['build'].' ] wurde aktualisiert!');
            } else {
                notification::add_error('Aktualisierung ist fehlgeschlagen!');
            }
        } else if(isset($_POST['update'])) {
            $class_dzcp_version = new dzcp_version;
            $class_dzcp_version->runUpdate(true);
            notification::add_success('Aktualisierung wurde ausgeführt!');
        }

        $qry = common::$sql['default']->select("SELECT * FROM `{prefix_addon_version}` WHERE `static_version` LIKE '1.6' ORDER BY `static_version` ASC;");
        $color = 0; $show1 = '';
        foreach($qry as $get) {
            switch (stringParser::decode($get['edition'])) {
                case 'dev':
                    $dzcp_edition = 'Development';
                   break;
                case 'society':
                    $dzcp_edition = 'Society';
                    break;
                case 'stable':
                    $dzcp_edition = 'Live/Stable';
                    break;
            }

            $title = 'DZCP-'.$get['version'].' '.$dzcp_edition.' aktualisieren';
            $smarty->caching = false;
            $smarty->assign('id', $get['id']);
            $smarty->assign('action', 'admin=version');
            $smarty->assign('title', $title);
            $update = $smarty->fetch('file:[' . common::$tmpdir . ']page/buttons/button_update.tpl');
            $smarty->clearAllAssign();

            $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
            $smarty->caching = false;
            $smarty->assign('update',$update);
            $smarty->assign('build', stringParser::decode($get['build']));
            $smarty->assign('release',stringParser::decode($get['release']));
            $smarty->assign('edition',$dzcp_edition);
            $smarty->assign('version',stringParser::decode($get['version']));
            $smarty->assign('class',$class);
            $smarty->assign('updated',date("d.m.Y - H:i:s",$get['updated']));
            $show1 .= $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/version_show.tpl');
            $smarty->clearAllAssign();;
        }

        $qry = common::$sql['default']->select("SELECT * FROM `{prefix_addon_version}` WHERE `static_version` LIKE '1.7' ORDER BY `static_version` ASC;");
        $color = 0; $show2 = '';
        foreach($qry as $get) {
            switch (stringParser::decode($get['edition'])) {
                case 'dev':
                    $dzcp_edition = 'Development';
                    break;
                case 'society':
                    $dzcp_edition = 'Society';
                    break;
                case 'stable':
                    $dzcp_edition = 'Live/Stable';
                    break;
            }

            $title = 'DZCP-'.$get['version'].' '.$dzcp_edition.' aktualisieren';
            $smarty->caching = false;
            $smarty->assign('id', $get['id']);
            $smarty->assign('action', 'admin=version');
            $smarty->assign('title', $title);
            $update = $smarty->fetch('file:[' . common::$tmpdir . ']page/buttons/button_update.tpl');
            $smarty->clearAllAssign();

            $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
            $smarty->caching = false;
            $smarty->assign('update',$update);
            $smarty->assign('build', stringParser::decode($get['build']));
            $smarty->assign('release',stringParser::decode($get['release']));
            $smarty->assign('edition',$dzcp_edition);
            $smarty->assign('version',stringParser::decode($get['version']));
            $smarty->assign('class',$class);
            $smarty->assign('updated',date("d.m.Y - H:i:s",$get['updated']));
            $show2 .= $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/version_show.tpl');
            $smarty->clearAllAssign();;
        }

        $smarty->caching = false;
        $smarty->assign('show1',$show1);
        $smarty->assign('show2',$show2);
        $show = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/version.tpl');
        $smarty->clearAllAssign();
        break;
}