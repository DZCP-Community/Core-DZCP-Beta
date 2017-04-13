<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */

ob_start();
    define('basePath', dirname(__FILE__));
    include(basePath."/inc/common.php");
    header('Location: '.(common::$chkMe ? common::startpage() : 'news/'));
ob_end_flush();