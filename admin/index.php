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

## OUTPUT BUFFER START ##
include("../inc/buffer.php");

## INCLUDES ##
include(basePath."/inc/common.php");
include(basePath."/admin/helper.php");

## SETTINGS ##
$where = _site_config;
$dir = "admin";
$rootmenu = null;
$settingsmenu = null;
$contentmenu = null;
$addonsmenu = null;
$amenu = array();

## SECTIONS ##
if (!isset($_SESSION['id']) || empty($_SESSION['id']) || !common::admin_perms($_SESSION['id'])) {
    $index = common::error(_error_wrong_permissions, 1);
} else {
    if (isset($_GET['admin']) && file_exists(basePath . '/admin/menu/' . secure_global_imput($_GET['admin']).'.php') &&
            file_exists(basePath . '/admin/menu/'.secure_global_imput($_GET['admin']).'.xml')) {
        $permission = false;
        define('_adminMenu', true);
        $xml = simplexml_load_file(basePath . '/admin/menu/'.secure_global_imput($_GET['admin']).'.xml');
        $rights = (string) $xml->Rights;
        $oa = (int) $xml->Only_Admin;
        $ora = (int) $xml->Only_Root;
        if (common::permission($rights) && !$oa && !$ora)
            $permission = true;
        if ($oa && !$ora && common::$chkMe == 4)
            $permission = true;
        if ($ora && common::$chkMe == 4 && common::rootAdmin())
            $permission = true;

        if ($permission)
            include(basePath . '/admin/menu/'.secure_global_imput($_GET['admin']).'.php');
        else
            $show = common::error(_error_wrong_permissions, 1);
    }

    //Site Permissions
    $files = common::get_files(basePath . '/admin/menu/', false, true, array('xml'));
    if (count($files)) {
        foreach ($files AS $file_xml) {
            if (file_exists(basePath . '/admin/menu/' . str_replace('.xml', '.php', $file_xml))) {
                $permission = false;
                $xml = simplexml_load_file(basePath . '/admin/menu/' . $file_xml);
                $rights = (string) $xml->Rights;
                $oa = (int) $xml->Only_Admin;
                $ora = (int) $xml->Only_Root;
                if (common::permission($rights) && !$oa && !$ora)
                    $permission = true;
                if ($oa && !$ora && common::$chkMe == 4)
                    $permission = true;
                if ($ora && common::$chkMe == 4 && common::rootAdmin())
                    $permission = true;

                foreach (array("jpg", "gif", "png") AS $end) {
                    if (file_exists(basePath . '/admin/menu/' . str_replace('.xml', '', $file_xml) . '.' . $end))
                        break;
                }

                $link = constant("_config_" . str_replace('.xml', '', $file_xml));
                $menu = (string) $xml->Menu;
                $type = str_replace('.xml', '', $file_xml);
                if (!empty($menu) && !empty($rights) && $permission)
                    $amenu[$menu][$type] = show("['[link]','?admin=[name]','background-image:url(menu/[name]." . $end . ");'],\n", array("link" => $link, 'name' => $type));
            }
        }
    }

    foreach ($amenu AS $m => $k) {
        natcasesort($k);
        foreach ($k AS $l)
            $$m .= $l;
    }

    $radmin1 = '';
    $radmin2 = '';
    if (empty($rootmenu)) {
        $radmin1 = '/*';
        $radmin2 = '*/';
    }

    $adminc1 = '';
    $adminc2 = '';
    if (empty($settingsmenu)) {
        $adminc1 = '/*';
        $adminc2 = '*/';
    }

    $cdminc1 = '';
    $cdminc2 = '';
    if (empty($contentmenu)) {
        $cdminc1 = '/*';
        $cdminc2 = '*/';
    }

    $addons1 = '';
    $addons2 = '';
    if (empty($addonsmenu)) {
        $addons1 = '/*';
        $addons2 = '*/';
    }

    //DZCP.de Version
    $version = new dzcp_version(false);
    $index = show($dir . "/admin", array("version" => '<b>DZCP-Live: '.$version->getLiveVersion()['version'].' - '.$version->getLiveVersion()['release'].
        ' / DZCP-Development: '.$version->getDevVersion()['version'].' - '.$version->getDevVersion()['release'].'</b>',
                                         "einst" => _config_einst,
                                         "content" => _content,
                                         "addons" => _addons,
                                         "rootadmin" => _rootadmin,
                                         "rootmenu" => $rootmenu,
                                         "settingsmenu" => $settingsmenu,
                                         "contentmenu" => $contentmenu,
                                         "addonsmenu" => $addonsmenu,
                                         "radmin1" => $radmin1,
                                         "radmin2" => $radmin2,
                                         "adminc1" => $adminc1,
                                         "adminc2" => $adminc2,
                                         "cdminc1" => $cdminc1,
                                         "cdminc2" => $cdminc2,
                                         "addons1" => $addons1,
                                         "addons2" => $addons2,
                                         "show" => $show));
}

## INDEX OUTPUT ##
$title = common::$pagetitle." - ".$where;
common::page($index, $title, $where);