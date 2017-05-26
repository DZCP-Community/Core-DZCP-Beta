<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */

define('DZCPApi', true);

//Base Class
require_once(basePathAPI.'/libs/event.class.php');

//-> Neue PHP Liberty's oder Classen einbinden
if($libs_files = common::get_files(basePathAPI.'/libs/',false,true, ['php'])) {
    foreach($libs_files AS $func)
    { if($func != 'event.class.php') require_once(basePathAPI.'/libs/'.$func); }
    unset($libs_files,$func);
}
