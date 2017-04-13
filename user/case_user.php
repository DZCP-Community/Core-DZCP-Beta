<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */

if(defined('_UserMenu')) {
    $where = _user_profile_of.'autor_'.$_GET['id'];
    $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_users}` WHERE `id` = ?;",array(intval($_GET['id'])));
    if (!common::$sql['default']->rowCount()) {
        $index = common::error(_user_dont_exist, 1);
    } else {
        if ((common::$userid != $get['id']) && (($get['profile_access'] >= 1 &&
                    common::checkme() == 'unlogged') || ($get['profile_access'] >= 2 &&
                    common::checkme() <= 1) || ($get['profile_access'] >= 3 && common::checkme() != 4))) {
            $index = common::error(_profile_access_error, 1);
        } else {
            if (common::count_clicks('userprofil', $get['id'])) {
                common::$sql['default']->update("UPDATE `{prefix_userstats}` SET `profilhits` = (profilhits+1) WHERE `user` = ?;",array($get['id']));
            } //Update Userstats

            $sex = $get['sex'] == 1 ? _male : ($get['sex'] == 2 ? _female : '-');
            $hp = empty($get['hp']) ? "-" : "<a href=\"" . $get['hp'] . "\" target=\"_blank\">" . $get['hp'] . "</a>";
            $email = empty($get['email']) ? "-" : common::CryptMailto(stringParser::decode($get['email']), _user_mailto_texttop);
            $pn = show(_pn_write, array("id" => $_GET['id'], "nick" => $get['nick']));
            $bday = (!$get['bday'] || empty($get['bday'])) ? "-" : date('d.m.Y', $get['bday']);

            $status = ($get['status'] == 1 || ($get['level'] != 1 && isset($_GET['sq']))) ? _aktiv_icon : _inaktiv_icon;
            $clan = "";
            if ($get['level'] != 1 || isset($_GET['sq'])) {
                $sq = common::$sql['default']->select("SELECT * FROM `{prefix_userposis}` WHERE `user` = ?;",array($get['id']));
                $cnt = common::cnt('{prefix_userposis}', " WHERE `user` = ?",'id',array($get['id'])); $i = 1;

                if (common::$sql['default']->rowCount() && !isset($_GET['sq'])) {
                    $pos = '';
                    foreach($sq as $getsq) {
                        $br = "-";
                        if ($i == $cnt) {
                            $br = "";
                        }

                        $pos .= " ".common::getrank($get['id'], $getsq['group'], 1)." ".$br;
                        $i++;
                    }
                } elseif (isset($_GET['sq'])) {
                    $pos = common::getrank($get['id'], $_GET['sq'], 1);
                } else {
                    $pos = common::getrank($get['id']);
                }
                
                $pos = (empty($pos) ? '-' : $pos);
            }

            $buddyadd = show(_addbuddyicon, array("id" => $_GET['id']));

            $edituser = "";
            if (common::permission("editusers")) {
                $edituser = str_replace("&amp;id=", "", show("page/button_edit_single", array("id" => "",
                                                                                              "action" => "action=admin&amp;edit=" . $_GET['id'],
                                                                                              "title" => _button_title_edit)));
            }

            $rlname = $get['rlname'] ? stringParser::decode($get['rlname']) : "-";
            $city = stringParser::decode($get['city']);
            $beschreibung = bbcode::parse_html($get['beschreibung']);
            $show = show($dir."/profil_show", array("country" => self::flag($get['country']),
                                                    "city" => (empty($city) ? '-' : $city),
                                                    "logins" => common::userstats("logins", $_GET['id']),
                                                    "hits" => common::userstats("hits", $_GET['id']),
                                                    "msgs" => common::userstats("writtenmsg", $_GET['id']),
                                                    "forenposts" => common::userstats("forumposts", $_GET['id']),
                                                    "votes" => common::userstats("votes", $_GET['id']),
                                                    "regdatum" => date("d.m.Y H:i", $get['regdatum']) . _uhr,
                                                    "lastvisit" => date("d.m.Y H:i", common::userstats("lastvisit", $_GET['id'])) . _uhr,
                                                    "hp" => $hp,
                                                    "buddyadd" => $buddyadd,
                                                    "nick" => common::autor($get['id']),
                                                    "rlname" => $rlname,
                                                    "bday" => $bday,
                                                    "age" => common::getAge($get['bday']),
                                                    "sex" => $sex,
                                                    "email" => $email,
                                                    "pn" => $pn,
                                                    "edituser" => $edituser,
                                                    "onoff" => common::onlinecheck($get['id']),
                                                    "picture" => common::userpic($get['id']),
                                                    "position" => common::getrank($get['id']),
                                                    "status" => $status,
                                                    "ich" => (empty($beschreibung) ? '-' : $beschreibung)));

            $profil_head = show(_profil_head, array("profilhits" => common::userstats("profilhits", $_GET['id'])));
            $index = show($dir . "/profil", array("profilhead" => $profil_head,
                                                  "show" => $show,
                                                  "nick" => common::autor($_GET['id'])));
        }
    }
}