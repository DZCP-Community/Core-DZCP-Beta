<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */
ob_start();
    define('is_api', true);
    define('basePath', dirname(__FILE__));
    include(basePath."/inc/common.php");
    $event = new dzcp_event();
    switch ($event->getEvent()) {
        case 'version':
            $version = new dzcp_version();
            $version->getContentType();
            $version->getVersion();
            break;
        case 'news':
			$news = new dzcp_news();
			$news->getContentType();
			$news->getNews();
            break;
	}
ob_end_flush();