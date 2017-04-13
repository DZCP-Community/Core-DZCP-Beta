<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */

if(defined('_UserMenu')) {
    if (!common::permission("editusers")) {
        $index = common::error(_error_wrong_permissions, 1);
    } elseif (isset($_GET['edit']) && $_GET['edit'] == common::$userid) {
        $qrySquads = common::$sql['default']->select("SELECT `id`,`name` FROM `{prefix_groups}` ORDER BY `id`;");
        $esquads = '';
        foreach($qrySquads as $getsq) {
            $qrypos = common::$sql['default']->select("SELECT `id`,`position` FROM `{prefix_positions}` ORDER BY `pid`;");
            $posi = "";
            foreach($qrypos as $getpos) {
                $sel = common::$sql['default']->rows("SELECT `id` FROM `{prefix_userposis}` WHERE `posi` = ? AND `group` = ? AND `user` = ?;",array($getpos['id'],$getsq['id'],intval($_GET['edit']))) ? 'selected="selected"' : '';
                $posi .= show(_select_field_posis, array("value" => $getpos['id'], "sel" => $sel, "what" => stringParser::decode($getpos['position'])));
            }

            $check = common::$sql['default']->rows("SELECT `id` FROM `{prefix_groupuser}` WHERE `user` = ? AND `group` = ?;", array(intval($_GET['edit']),$getsq['id'])) ? 'checked="checked"' : '';
            $esquads .= show(_checkfield_squads, array("id" => $getsq['id'],
                                                       "check" => $check,
                                                       "eposi" => $posi,
                                                       "squad" => stringParser::decode($getsq['name'])));
        }

        $index = show($dir . "/admin_self", array("showpos" => common::getrank($_GET['edit']), "esquad" => $esquads, "eposi" => $posi));
    } elseif (isset($_GET['edit']) && (common::data("level", intval($_GET['edit'])) == 4 || common::rootAdmin(intval($_GET['edit']))) && !common::rootAdmin(common::$userid)) {
        $index = common::error(_error_edit_admin, 1);
    } else {
        if ($do == "identy") {
            if((common::data("level", intval($_GET['id'])) == 4 && !common::rootAdmin(intval($_GET['id'])) && !common::rootAdmin(common::$userid))) {
                $index = common::error(_identy_admin, 1);
            } else {
                $msg = show(_admin_user_get_identy, array("nick" => common::autor($_GET['id'])));
                common::$sql['default']->update("UPDATE `{prefix_users}` SET `online` = 0, `sessid` = '' WHERE id = ?;",array(common::$userid)); //Logout
                session_regenerate_id();

                $_SESSION['id'] = intval($_GET['id']);
                $_SESSION['pwd'] =stringParser::decode(common::data("pwd", intval($_GET['id'])));
                $_SESSION['ip'] = common::$userip;

                common::$sql['default']->update("UPDATE `{prefix_users}` SET `online` = 1, `sessid` = ?, `ip` = ? WHERE `id` = ?;",
                array(session_id(),common::$userip,intval($_GET['id'])));
                common::setIpcheck("ident(" . common::$userid . "_" . intval($_GET['id']) . ")");

                $index = common::info($msg, "?action=user&amp;id=" . $_GET['id'] . "");
            }
        } else if ($do == "update") {
            if ($_POST && isset($_GET['user'])) {
                $edituser = intval($_GET['user']);

                // Permissions Update
                if (empty($_POST['perm'])) {
                    $_POST['perm'] = array();
                }

                $qry_fields = common::$sql['default']->show("SHOW FIELDS FROM `{prefix_permissions}`;");
                $sql_update = '';
                foreach($qry_fields as $get) {
                    if ($get['Field'] != 'id' && $get['Field'] != 'user' && $get['Field'] != 'pos' && $get['Field'] != 'intforum') {
                        $sql_qry = array_key_exists('p_' . $get['Field'], $_POST['perm']) ? '`' . $get['Field'] . '` = 1' : '`' . $get['Field'] . '` = 0';
                        $sql_update .= $sql_qry . ', ';
                    }
                }

                // Check User Permissions is exists
                if (!common::$sql['default']->rows('SELECT `id` FROM `{prefix_permissions}` WHERE `user` = ? LIMIT 1;',array($edituser))) {
                    common::$sql['default']->insert("INSERT INTO `{prefix_permissions}` SET `user` = ?;",array($edituser));
                }

                // Update Permissions
                common::$sql['default']->update('UPDATE `{prefix_permissions}` SET '.substr($sql_update, 0, -2).' WHERE `user` = ?;',array($edituser));

                // Internal Boardpermissions Update
                if (empty($_POST['board'])) {
                    $_POST['board'] = array();
                }

                // Boardpermissions Cleanup
                $qry = common::$sql['default']->select('SELECT `id`,`forum` FROM `{prefix_f_access}` WHERE `user` = ?;',array($edituser));
                foreach($qry as $get) {
                    if (!common::array_var_exists($get['forum'], $_POST['board'])) {
                        common::$sql['default']->delete('DELETE FROM `{prefix_f_access}` WHERE `id` = ?;',array($get['id']));
                    }
                }

                //Add new Boardpermissions
                if (count($_POST['board']) >= 1) {
                    foreach ($_POST['board'] AS $boardpem) {
                        if (!common::$sql['default']->rows("SELECT `id` FROM `{prefix_f_access}` WHERE `user` = ? AND `forum` = ?;", array($edituser,$boardpem))) {
                            common::$sql['default']->insert("INSERT INTO `{prefix_f_access}` SET `user` = ?, `forum` = ?;",array($edituser,$boardpem));
                        }
                    }
                }

                common::$sql['default']->delete("DELETE FROM `{prefix_groupuser}` WHERE `user` = ?;",array($edituser));
                common::$sql['default']->delete("DELETE FROM `{prefix_userposis}` WHERE `user` = ?;",array($edituser));

                $sq = common::$sql['default']->select("SELECT `id` FROM `{prefix_groups}`;");
                foreach($sq as $getsq) {
                    if (isset($_POST['squad' . $getsq['id']])) {
                        common::$sql['default']->insert("INSERT INTO `{prefix_groupuser}` SET `user` = ?, `group`  = ?;",
                        array($edituser,intval($_POST['squad' . $getsq['id']])));
                    }

                    if (isset($_POST['squad' . $getsq['id']])) {
                        common::$sql['default']->insert("INSERT INTO {prefix_userposis} SET `user` = ?, `posi` = ?, `group` = ?;",
                        array($edituser,intval($_POST['sqpos' . $getsq['id']]),intval($getsq['id'])));
                    }
                }

                $level = intval($_POST['level']);
                if(common::permission("editusers") && common::data("level") != 4 && !common::rootAdmin(common::$userid) && $level == 4) {
                    $level = common::data("level",$edituser);
                }
                
                $newpwd = !empty($_POST['passwd']) ? "`pwd` = '" . md5($_POST['passwd']) . "'," : "";
                $update_level = $_POST['level'] == 'banned' ? 0 : $level;
                $update_banned = $_POST['level'] == 'banned' ? 1 : 0;
                common::$sql['default']->update("UPDATE {prefix_users} SET ".$newpwd." "
                        . "`nick`   = ?, "
                        . "`email`  = ?, "
                        . "`user`   = ?, "
                        . "`listck` = ?, "
                        . "`level`  = ?, "
                        . "`banned`  = ? "
                        . "WHERE `id` = ?;",
                        array(stringParser::encode($_POST['nick']),stringParser::encode($_POST['email']),stringParser::encode($_POST['loginname']),(isset($_POST['listck']) ? intval($_POST['listck']) : 0),
                        intval($update_level),intval($update_banned),$edituser));

                common::setIpcheck("upduser(" . common::$userid . "_" . $edituser . ")");
            }

            $index = common::info(_admin_user_edited, "?action=userlist");
        } elseif ($do == "updateme") {
            common::$sql['default']->delete("DELETE FROM `{prefix_groupuser}` WHERE `user` = ?;",array(common::$userid));
            common::$sql['default']->delete("DELETE FROM `{prefix_userposis}` WHERE `user` = ?;",array(common::$userid));

            $squads = $sql->select("SELECT `id` FROM `{prefix_groups}`;");
            foreach($squads as $getsq) {
                if (isset($_POST['squad' . $getsq['id']])) {
                    common::$sql['default']->insert("INSERT INTO `{prefix_groupuser}` SET `user`  = ?, `group` = ?;",
                    array(intval(common::$userid),intval($_POST['squad' . $getsq['id']])));
                }

                if (isset($_POST['squad' . $getsq['id']])) {
                    common::$sql['default']->insert("INSERT INTO `{prefix_userposis}` SET `user` = ?, `posi` = ?, `group`  = ?",
                    array(intval(common::$userid),intval($_POST['sqpos'.$getsq['id']]),intval($getsq['id'])));
                }
            }

            $index = common::info(_admin_user_edited, "?action=user&amp;id=" . common::$userid . "");
        } elseif ($do == "delete") {
            $index = show(_user_delete_verify, array("user" => common::autor(intval($_GET['id'])), "id" => $_GET['id']));
            $delUID = intval($_GET['id']);
            if ($_GET['verify'] == "yes") {
                if (common::data("level", intval($_GET['id'])) == 4 || common::data("level", intval($_GET['id'])) == 3 || common::rootAdmin($delUID))
                    $index = common::error(_user_cant_delete_admin, 2);
                else {
                    if($delUID >= 1) {
                        common::setIpcheck("deluser(" . common::$userid . "_" . $delUID . ")");
                        common::$sql['default']->update("UPDATE `{prefix_forumposts}` SET `reg` = 0 WHERE `reg` = ?;",array($delUID));
                        common::$sql['default']->update("UPDATE `{prefix_forumthreads}` SET `t_reg` = 0 WHERE `t_reg` = ?;",array($delUID));
                        common::$sql['default']->update("UPDATE `{prefix_newscomments}` SET `reg` = 0 WHERE `reg` = ?;",array($delUID));
                        common::$sql['default']->delete("DELETE FROM `{prefix_messages}` WHERE `von` = ? OR `an` = ?;",array($delUID,$delUID));
                        common::$sql['default']->delete("DELETE FROM `{prefix_news}` WHERE `autor` = ?;",array($delUID));
                        common::$sql['default']->delete("DELETE FROM `{prefix_permissions}` WHERE `user` = ?;",array($delUID));
                        common::$sql['default']->delete("DELETE FROM `{prefix_groupuser}` WHERE `user` = ?;",array($delUID));
                        common::$sql['default']->delete("DELETE FROM `{prefix_userbuddys}` WHERE `user` = ? OR `buddy` = ?;",array($delUID,$delUID));
                        common::$sql['default']->delete("DELETE FROM `{prefix_userposis}` WHERE `user` = ?;",array($delUID));
                        common::$sql['default']->delete("DELETE FROM `{prefix_users}` WHERE `id` = ?;",array($delUID));
                        common::$sql['default']->delete("DELETE FROM `{prefix_userstats}` WHERE `user` = ?;",array($delUID));
                        common::$sql['default']->delete("DELETE FROM `{prefix_clicks_ips}` WHERE `uid` = ?;",array($delUID));
                        $index = common::info(_user_deleted, "?action=userlist");
                    }
                }
            }
        } elseif ($do == "full_delete") {
            $index = show(_user_delete_verify, array("user" => common::autor(intval($_GET['id'])), "id" => $_GET['id']));
            $delUID = intval($_GET['id']);
            if ($_GET['verify'] == "yes") {
                if (common::data("level", intval($_GET['id'])) == 4 || common::data("level", intval($_GET['id'])) == 3 || common::rootAdmin($delUID))
                    $index = common::error(_user_cant_delete_admin, 2);
                else {
                    if($delUID >= 1) {
                        common::setIpcheck("deluser(" . common::$userid . "_" . $delUID . ")");
                        common::$sql['default']->update("DELETE FROM `{prefix_forumposts}` WHERE `reg` = ?;",array($delUID));
                        common::$sql['default']->update("DELETE FROM `{prefix_forumthreads}` WHERE `t_reg` = ?;",array($delUID));
                        common::$sql['default']->update("DELETE FROM `{prefix_newscomments}` WHERE `reg` = ?;",array($delUID));
                        common::$sql['default']->delete("DELETE FROM `{prefix_messages}` WHERE `von` = ? OR `an` = ?;",array($delUID,$delUID));
                        common::$sql['default']->delete("DELETE FROM `{prefix_news}` WHERE `autor` = ?;",array($delUID));
                        common::$sql['default']->delete("DELETE FROM `{prefix_permissions}` WHERE `user` = ?;",array($delUID));
                        common::$sql['default']->delete("DELETE FROM `{prefix_groupuser}` WHERE `user` = ?;",array($delUID));
                        common::$sql['default']->delete("DELETE FROM `{prefix_userbuddys}` WHERE `user` = ? OR `buddy` = ?;",array($delUID,$delUID));
                        common::$sql['default']->delete("DELETE FROM `{prefix_userposis}` WHERE `user` = ?;",array($delUID));
                        common::$sql['default']->delete("DELETE FROM `{prefix_users}` WHERE `id` = ?;",array($delUID));
                        common::$sql['default']->delete("DELETE FROM `{prefix_userstats}` WHERE `user` = ?;",array($delUID));
                        common::$sql['default']->delete("DELETE FROM `{prefix_clicks_ips}` WHERE `uid` = ?;",array($delUID));
                        $index = common::info(_user_deleted, "?action=userlist");
                    }
                }
            }
        } else {
            $get = common::$sql['default']->fetch("SELECT `id`,`user`,`nick`,`pwd`,`email`,`level`,`position`,`listck` "
                                    . "FROM `{prefix_users}` "
                                    . "WHERE `id` = ?;",array(intval($_GET['edit'])));
            if (common::$sql['default']->rowCount()) {
                $where = _user_profile_of . 'autor_'.intval($_GET['edit']);
                $qrysq = common::$sql['default']->select("SELECT `id`,`name` FROM `{prefix_groups}` ORDER BY `id`;");
                $esquads = '';
                foreach($qrysq as $getsq) {
                    $qrypos = common::$sql['default']->select("SELECT `id`,`position` FROM `{prefix_positions}` ORDER BY `pid`;");
                    $posi = "";
                    foreach($qrypos as $getpos) {
                        $check = common::$sql['default']->rows("SELECT `id` FROM `{prefix_userposis}` WHERE `posi` = ? AND `group` = ? AND `user` = ?;",
                        array($getpos['id'],$getsq['id'],intval($_GET['edit'])));
                        $sel = $check ? 'selected="selected"' : '';
                        $posi .= show(_select_field_posis, array("value" => $getpos['id'], "sel" => $sel, "what" => stringParser::decode($getpos['position'])));
                    }

                    $checksquser = common::$sql['default']->rows("SELECT `id` FROM `{prefix_groupuser}` WHERE `user` = ? AND `group` = ?;",
                    array(intval($_GET['edit']),$getsq['id']));
                    $check = $checksquser ? 'checked="checked"' : '';
                    $esquads .= show(_checkfield_squads, array("id" => $getsq['id'],
                                                               "check" => $check,
                                                               "eposi" => $posi,
                                                               "squad" => stringParser::decode($getsq['name'])));
                }

                $get_identy = show(_admin_user_get_identitat, array("id" => intval($_GET['edit'])));
                $editpwd = show($dir . "/admin_editpwd", array("epwd" => ""));

                $selu = $get['level'] == 1 ? 'selected="selected"' : '';
                $sela = $get['level'] == 4 ? 'selected="selected"' : '';
                if (common::$chkMe == 4) {
                    $elevel = show(_elevel_admin_select, array("selu" => $selu,
                                                               "sela" => $sela));
                } elseif (common::permission("editusers")) {
                    $elevel = show(_elevel_perm_select, array("selu" => $selu,
                                                              "selt" => $selt));
                }

                $index = show($dir . "/admin", array("enick" => stringParser::decode($get['nick']),
                                                     "user" => intval($_GET['edit']),
                                                     "eemail" => stringParser::decode($get['email']),
                                                     "eloginname" => $get['user'],
                                                     "esquad" => $esquads,
                                                     "editpwd" => $editpwd,
                                                     "eposi" => $posi,
                                                     "getpermissions" => common::getPermissions(intval($_GET['edit'])),
                                                     "getboardpermissions" => common::getBoardPermissions(intval($_GET['edit'])),
                                                     "forenrechte" => _config_positions_boardrights,
                                                     "showpos" => common::getrank($_GET['edit']),
                                                     "listck" => (empty($get['listck']) ? '' : ' checked="checked"'),
                                                     "alvl" => $get['level'],
                                                     "elevel" => $elevel,
                                                     "get" => $get_identy));
            } else
                $index = common::error(_user_dont_exist, 1);
        }
    }
}