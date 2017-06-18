<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */

//api.php?input={"event":"news","count":4,"type":"xml"}

/**
 * Class dzcp_news
 */
class dzcp_news extends dzcp_event
{
    /**
     * dzcp_news constructor.
     * @param bool $api
     */
    function __construct($api=true){
        if($api)
            parent::__construct();
    }

    function getOldNews() {


    }

    function getNews() {

        
    }
}