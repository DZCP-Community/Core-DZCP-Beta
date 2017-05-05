<?php
/**
 * DZCP - deV!L`z ClanPortal - Mainpage ( dzcp.de )
 * deV!L`z Clanportal ist ein Produkt von CodeKing,
 * geändert dürch my-STARMEDIA und Codedesigns.
 *
 * Diese Datei ist ein Bestandteil von dzcp.de
 * Diese Version wurde speziell von Lucas Brucksch (Codedesigns) für dzcp.de entworfen bzw. verändert.
 * Eine Weitergabe dieser Datei außerhalb von dzcp.de ist nicht gestattet.
 * Sie darf nur für die Private Nutzung (nicht kommerzielle Nutzung) verwendet werden.
 *
 * Homepage: http://www.dzcp.de
 * E-Mail: info@web-customs.com
 * E-Mail: lbrucksch@codedesigns.de
 * Copyright 2017 © CodeKing, my-STARMEDIA, Codedesigns
 */

if(defined('_UserMenu')) {
    $where = _site_user_buddys;
    if(!common::$chkMe) {
        $index = common::error(_error_have_to_be_logged, 1);
    } else {
        switch ($do) {
            case 'add':
                if($_POST['users'] == "-") {
                    $index = common::error(_error_select_buddy, 1);
                } elseif($_POST['users'] == common::$userid) {
                    $index = common::error(_error_buddy_self, 1);
                } elseif(!check_buddy($_POST['users'])) {
                    $index = common::error(_error_buddy_already_in, 1);
                } else {
                    common::$sql['default']->insert("INSERT INTO `{prefix_userbuddys}` SET `user` = ?, `buddy` = ?;",
                    array(intval(common::$userid),intval($_POST['users'])));
                    $msg = show(_buddy_added_msg, array("user" => common::autor(common::$userid)));
                    $title = _buddy_title;
                    common::$sql['default']->insert("INSERT INTO `{prefix_messages}` SET "
                               . "`datum` = ".time().", "
                               . "`von` = 0, "
                               . "`an` = ?, "
                               . "`titel` = ?, "
                               . "`nachricht` = ?;",array(intval($_POST['users']),stringParser::encode($title),stringParser::encode($msg)));

                    $index = common::info(_add_buddy_successful, "?action=buddys");
                }
            break;
            case 'addbuddy':
                $user = isset($_GET['id']) ? $_GET['id'] : $_POST['users'];
                if($user == "-") {
                    $index = common::error(_error_select_buddy, 1);
                } elseif($user == common::$userid) {
                    $index = common::error(_error_buddy_self, 1);
                } elseif(!check_buddy($user)) {
                    $index = common::error(_error_buddy_already_in, 1);
                } else {
                    common::$sql['default']->insert("INSERT INTO `{prefix_userbuddys}` SET `user` = ?, `buddy` = ?;",array(intval(common::$userid),intval($user)));

                    $msg = show(_buddy_added_msg, array("user" => addslashes(common::autor(common::$userid))));
                    $title = _buddy_title;
                    common::$sql['default']->insert("INSERT INTO `{prefix_messages}` SET "
                               . "`datum` = ".time().", "
                               . "`von` = 0, "
                               . "`an` = ?, "
                               . "`titel` = ?, "
                               . "`nachricht` = ?;",array(intval($user),stringParser::encode($title),stringParser::encode($msg)));

                    $index = common::info(_add_buddy_successful, "?action=buddys");
                }
            break;
            case 'delete':
                if(isset($_GET['id']) && intval($_GET['id']) >= 1) {
                    common::$sql['default']->delete("DELETE FROM `{prefix_userbuddys}` "
                               . "WHERE `buddy` = ? AND `user` = ?;",array(intval($_GET['id']),common::$userid));

                    $msg = show(_buddy_del_msg, array("user" => addslashes(common::autor(common::$userid))));
                    $title = _buddy_title;
                    common::$sql['default']->insert("INSERT INTO `{prefix_messages}` SET "
                               . "`datum` = ".time().", "
                               . "`von` = 0, "
                               . "`an` = ?, "
                               . "`titel` = ?, "
                               . "`nachricht` = ?;",array(intval($_GET['id']),stringParser::encode($title),stringParser::encode($msg)));

                    $index = common::info(_buddys_delete_successful, "../user/?action=buddys");
                }
            break;
            default:
                $qry = common::$sql['default']->select("SELECT `buddy` FROM `{prefix_userbuddys}` WHERE `user` = ?;",array(common::$userid));
                $too = ""; $buddys = ""; $usersNL=array();
                foreach($qry as $get) {
                    //Private Massage
                    $smarty->caching = false;
                    $smarty->assign('id',$get['buddy']);
                    $smarty->assign('nick',stringParser::decode(common::data("nick",$get['buddy'])));
                    $pn = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/msg/msg_pn_write.tpl');
                    $smarty->clearAllAssign();

                    $delete = show(_buddys_delete, array("id" => $get['buddy']));
                    $too = common::$sql['default']->rows("SELECT `id` FROM `{prefix_userbuddys}` where `user` = ? AND `buddy` = ?;",array($get['buddy'],common::$userid)) ? _buddys_yesicon : _buddys_noicon;
                    $usersNL[$get['buddy']] = true;
                    $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
                    $buddys .= show($dir."/buddys_show", array("nick" => common::autor($get['buddy']),
                                                               "onoff" => common::onlinecheck($get['buddy']),
                                                               "pn" => $pn,
                                                               "class" => $class,
                                                               "too" => $too,
                                                               "delete" => $delete));
                }

                $buddys = (empty($buddys) ? show(_no_entrys_found, array("colspan" => "5")) : $buddys); $users = "";
                $qry = common::$sql['default']->select("SELECT `id`,`nick` FROM `{prefix_users}` WHERE `level` != 0 ORDER BY `nick`;");
                foreach($qry as $get) {
                    if(!array_key_exists($get['id'], $usersNL) && $get['id'] != common::$userid) {
                        $users .= show(_to_users, array("id" => $get['id'], "nick" =>stringParser::decode(common::data("nick",$get['id']))));
                    }
                }

                $add = show($dir."/buddys_add", array("users" => $users));
                $index = show($dir."/buddys", array("show" => $buddys, "add" => $add));
            break;
        }
    }
}