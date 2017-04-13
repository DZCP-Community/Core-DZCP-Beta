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
$where = _site_sponsor;
$dir = "sponsors";
define('_Sponsors', true);
$smarty = common::getSmarty(); //Use Smarty

if(file_exists(basePath."/sponsors/case_".$action.".php"))
    require_once(basePath."/sponsors/case_".$action.".php");

## INDEX OUTPUT ##
$title = common::$pagetitle." - ".$where;
common::page($index, $title, $where);