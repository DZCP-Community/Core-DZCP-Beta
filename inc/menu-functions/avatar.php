<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 * Menu: Avatar
 */

function avatar() {
    return common::$chkMe >= 1 ? show("menu/avatars", array("avatar_show" => common::useravatar(0,70,70))) : '';
}