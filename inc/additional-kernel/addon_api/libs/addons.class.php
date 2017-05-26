<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */

//api.php?input={"event":"addons_version","id":4,"type":"xml"}

if(!DZCPApi) die();

/**
 * Class dzcp_news
 */
class dzcp_addons_version extends dzcp_event
{
    /**
     * dzcp_news constructor.
     * @param bool $api
     */
    function __construct($api=true){
        if($api)
            parent::__construct();
    }

    function getVersion() {
        global $sql;


    }
}