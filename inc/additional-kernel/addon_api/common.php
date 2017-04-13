<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */

define('DZCPApi', true);

//-> Neue PHP Liberty's oder Classen einbinden
if($libs_files = common::get_files(basePathAPI.'/libs/',false,true,array('php'))) {
    foreach($libs_files AS $func)
    { require_once(basePathAPI.'/libs/'.$func); }
    unset($libs_files,$func);
}
