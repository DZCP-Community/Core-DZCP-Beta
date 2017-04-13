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
$dir = "links";
$where = _site_links;
define('_Links', true);
$smarty = common::getSmarty(); //Use Smarty

if(file_exists(basePath."/links/case_".$action.".php"))
    require_once(basePath."/links/case_".$action.".php");

## INDEX OUTPUT ##
$title = common::$pagetitle." - ".$where;
common::page($index, $title, $where);