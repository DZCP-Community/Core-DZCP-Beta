<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */

//api.php?input={"event":"addons_version","id":4,"type":"xml"}

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


    }

    /**
     * Generiert eine 12 stellige ModID
     * @return string
     */
    final static function getModID() {
        $modid = '';
        for ($i = 1; $i <= 12; $i++) {
            $modid .= ($i == 1 ? mt_rand(1,9) : mt_rand(0,9));
        }

        if(common::$sql['default']->rows("SELECT `id` FROM `{prefix_addon_mods}` WHERE `mid` = ?;",[$modid])) {
            return self::getModID();
        }

        return $modid;
    }
}