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
$where = _site_upload;
define('_Upload', true);
$dir = "upload";
$index = common::error(_error_wrong_permissions, 1);
$smarty = common::getSmarty(); //Use Smarty

## SECTIONS
$action = empty($action) ? 'default' : $action;
if(file_exists(basePath."/upload/case_".$action.".php"))
    require_once(basePath."/upload/case_".$action.".php");

## INDEX OUTPUT ##
$title = common::$pagetitle." - ".$where;
common::page($index, $title, $where);