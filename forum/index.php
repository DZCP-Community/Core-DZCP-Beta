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

## SETTINGS ##
$where = _site_forum;
$dir = "forum";
define('_Forum', true);
$smarty = common::getSmarty(); //Use Smarty

//-> Prueft sicherheitsrelevante Gegebenheiten im Forum
function forumcheck($tid, $what) {
    return common::$sql['default']->rows("SELECT `".$what."` FROM `{prefix_forumthreads}` WHERE `id` = ? AND ".$what." = 1;",array(intval($tid))) ? true : false;
}

//-> Funktion um Bestimmte Textstellen zu markieren
function hl($text, $word) {
    if(!empty($_GET['hl']) && $_SESSION['search_type'] == 'text') {
        if($_SESSION['search_con'] == 'or') {
            $words = explode(" ",$word);
            for($x=0;$x<count($words);$x++)
                $ret['text'] = preg_replace("#".$words[$x]."#i",'<span class="fontRed" title="'.$words[$x].'">'.$words[$x].'</span>',$text);
        } else
            $ret['text'] = preg_replace("#".$word."#i",'<span class="fontRed" title="'.$word.'">'.$word.'</span>',$text);

        if(!preg_match("#<span class=\"fontRed\" title=\"(.*?)\">#", $ret['text']))
            $ret['class'] = 'class="commentsRight"';
        else
            $ret['class'] = 'class="highlightSearchTarget"';
    } else {
        $ret['text'] = $text;
        $ret['class'] = 'class="commentsRight"';
    }

    return $ret;
}

## SECTIONS
$action = empty($action) ? 'default' : $action;
if (file_exists(basePath . "/forum/case_" . $action . ".php")) {
    require_once(basePath . "/forum/case_" . $action . ".php");
}

## INDEX OUTPUT ##
$title = common::$pagetitle." - ".$where;
common::page($index, $title, $where);