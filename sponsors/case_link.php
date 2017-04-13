<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */

if (!defined('_Sponsors')) exit();

$get = common::$sql['default']->fetch("SELECT `link`,`id` FROM `{prefix_sponsoren}` WHERE `id` = ?;",array(intval($_GET['id'])));
if(common::count_clicks('sponsoren',$get['id']))
    common::$sql['default']->update("UPDATE `{prefix_sponsoren}` SET `hits` = (hits+1) WHERE `id` = ?;",array($get['id']));

header("Location: ".stringParser::decode($get['link']));