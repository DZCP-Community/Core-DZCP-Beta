<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */

//api.php?input={"event":"news","count":4,"type":"xml"}

if(!DZCPApi) die();
class dzcp_news extends dzcp_event
{
    function __construct($api=true){
        if($api)
            parent::__construct();
    }

    function getOldNews() {
        global $sql;



    }

    function getNews() {
        global $sql;

        
    }
}