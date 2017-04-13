<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */

if(defined('_UserMenu')) {
    $where = _site_user_logout;
    if(common::$chkMe && common::$userid) {
        common::$sql['default']->update("UPDATE `{prefix_users}` SET `online` = 0, `sessid` = '' WHERE `id` = ?;",array(common::$userid));
        common::$sql['default']->delete("DELETE FROM `{prefix_autologin}` WHERE `ssid` = ?;",array(session_id()));
        common::setIpcheck("logout(".common::$userid.")");
        common::dzcp_session_destroy();
    }

    header("Location: ../news/");
}