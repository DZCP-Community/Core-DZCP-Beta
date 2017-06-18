<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */

define('DZCPApi', true);

//Base Class
require_once(basePathAPI.'/libs/event.class.php');

//-> Neue Languages einbinden
if($language_files = common::get_files(basePathAPI.'/lang/',false,true, ['php'])) {
    foreach($language_files AS $languages) {
        if($_SESSION['language'] == str_replace('.php','',$languages) ||
            str_replace('.php','',$languages) == 'global')
            include_once(basePathAPI.'/lang/'.$languages);
    } unset($language_files,$languages);
}

//-> Neue PHP Liberty's oder Classen einbinden
if($libs_files = common::get_files(basePathAPI.'/libs/',false,true, ['php'])) {
    foreach($libs_files AS $func)
    { if($func != 'event.class.php') require_once(basePathAPI.'/libs/'.$func); }
    unset($libs_files,$func);
}
