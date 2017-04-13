<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */

if(defined('_UserMenu')) {
    if(common::$userid) {
        $_SESSION['lastvisit'] = time();
        common::$sql['default']->update("UPDATE `{prefix_userstats}` SET `lastvisit` = ? WHERE `user` = ?;",
                array(intval($_SESSION['lastvisit']),intval(common::$userid)));
    }

    header("Location: ?action=userlobby");
}