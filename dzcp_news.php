<?php

/**
 *
<a href="http://www.dzcp.de/newscenter/?action=show&amp;id=1&amp;nID=258" title="DZCP 1.6.0.2 Kalender Minifix V1602.00.03" target="_blank">DZCP 1.6.0.2 Kalender Minifix V1602.00.03</a>
 * - <a href="http://www.dzcp.de/newscenter/?action=show&amp;id=1&amp;nID=259" title="Vorschau auf DZCP 1.6.0.3 * Bugfix &amp;  Enhancement Release *" target="_blank">Vorschau auf DZCP 1.6.0.3 * Bugfix &amp;  Enhancement Release *</a>
 * - <a href="http://www.dzcp.de/newscenter/?action=show&amp;id=1&amp;nID=260" title="deV!L`z Clanportal 1.6.0.3 zum Download bereit" target="_blank">deV!L`z Clanportal 1.6.0.3 zum Download bereit</a>
 */

ob_start();
define('is_api', true);
define('basePath', dirname(__FILE__));
include(basePath."/inc/common.php");
$news = new dzcp_news();
$news->getContentType();
$news->getOldNews();
ob_end_flush();