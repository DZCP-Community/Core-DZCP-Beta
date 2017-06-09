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

function smarty_function_templateswitch($params, &$smarty) {
    $tmpldir="";
    $tmps = common::get_files(basePath.'/inc/_templates_/',true);
    foreach ($tmps as $tmp) {
          $tmpldir .= common::select_field("?tmpl_set=".$tmp,(common::$tmpdir == $tmp),ucfirst($tmp));
    }

    $smarty->assign('templates',$tmpldir);
    $template_switch = $smarty->fetch('file:['.common::$tmpdir.']page/template_switch.tpl');
    return $template_switch;
}