<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */

if(file_exists(basePath.'/inc/additional-kernel/addon_api/common.php')) {
    if(!defined('basePathAPI')) {
        define('basePathAPI', basePath."/inc/additional-kernel/addon_api");
    }
    require_once(basePath.'/inc/additional-kernel/addon_api/common.php');
} else DebugConsole::insert_warning('additional-kernel/addon_api.php', basePath.'/inc/additional-kernel/addon_api/common.php not found!');