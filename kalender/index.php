<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */

## OUTPUT BUFFER START ##
include("../inc/buffer.php");

## INCLUDES ##
include(basePath."/inc/common.php");

## SETTINGS ##
$where = _site_kalender;
$dir = "kalender";
define('_Kalender', true);
$smarty = common::getSmarty(); //Use Smarty

if(file_exists(basePath."/kalender/case_".$action.".php"))
    require_once(basePath."/kalender/case_".$action.".php");

## INDEX OUTPUT ##
$title = common::$pagetitle." - ".$where;
common::page($index, $title, $where);