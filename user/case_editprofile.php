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
    $where = _site_user_editprofil;
    if (!common::$chkMe) {
        $index = common::error(_error_have_to_be_logged, 1);
    } else {
            switch ($do) {
                case 'edit':
                    $check_user = false; $check_nick = false; $check_email = false;
                    if(common::$sql['default']->rows("SELECT `id` FROM `{prefix_users}` WHERE (`user`= ? OR `nick`= ? OR `email`= ?) AND `id` != ?;",
                            array(stringParser::encode($_POST['user']),stringParser::encode($_POST['nick']),stringParser::encode($_POST['email']),common::$userid))) {
                        $check_user  = common::$sql['default']->rows("SELECT `id` FROM `{prefix_users}` WHERE `user` = ? AND `id` != ?;", array(stringParser::encode($_POST['user']),  common::$userid));
                        $check_nick  = common::$sql['default']->rows("SELECT `id` FROM `{prefix_users}` WHERE `nick` = ? AND `id` != ?;", array(stringParser::encode($_POST['nick']),  common::$userid));
                        $check_email = common::$sql['default']->rows("SELECT `id` FROM `{prefix_users}` WHERE `email`= ? AND `id` != ?;", array(stringParser::encode($_POST['email']), common::$userid));
                    }

                    if(!isset($_POST['user']) || empty($_POST['user'])) {
                        $index = common::error(_empty_user, 1);
                    } elseif (!isset($_POST['nick']) || empty($_POST['nick'])) {
                        $index = common::error(_empty_nick, 1);
                    } elseif (!isset($_POST['email']) || empty($_POST['email'])) {
                        $index = common::error(_empty_email, 1);
                    } elseif (!isset($_POST['email']) || !common::check_email($_POST['email'])) {
                        $index = common::error(_error_invalid_email, 1);
                    } elseif ($check_user) {
                        $index = common::error(_error_user_exists, 1);
                    } elseif ($check_nick) {
                        $index = common::error(_error_nick_exists, 1);
                    } elseif ($check_email) {
                        $index = common::error(_error_email_exists, 1);
                    } else {
                        $newpwd = "";
                        if (isset($_POST['pwd']) && !empty($_POST['pwd'])) {
                            if(common::pwd_encoder($_POST['pwd']) == common::pwd_encoder($_POST['cpwd'])) {
                                $_SESSION['pwd'] = common::pwd_encoder($_POST['pwd']);
                                $newpwd = "`pwd` = '".stringParser::encode($_SESSION['pwd'])."',";
                                $newpwd .= "`pwd_encoder` = ".settings::get('default_pwd_encoder').",";
                            } else {
                                $index = common::error(_error_passwords_dont_match, 1);
                            }
                        }
                        
                        $bday = ($_POST['t'] && $_POST['m'] && $_POST['j'] ? common::cal($_POST['t']) . "." . common::cal($_POST['m']) . "." . $_POST['j'] : 0);
                        $qrycustom = common::$sql['default']->select("SELECT `feldname`,`type` FROM `{prefix_profile}`"); $customfields = '';
                        foreach($qrycustom as $getcustom) {
                            $customfields .= " `".$getcustom['feldname']."` = '".($getcustom['type'] == 2 ? common::links($_POST[$getcustom['feldname']]) : stringParser::encode($_POST[$getcustom['feldname']]))."', ";
                        }
                        
                        if(empty($index)) {
                            $index = common::info(_info_edit_profile_done, "?action=user&amp;id=" . common::$userid . "");
                            common::$sql['default']->update("UPDATE `{prefix_users}` SET " . $newpwd . " " . $customfields . " `country` = ?,`user` = ?, `nick` = ?, `rlname` = ?, `sex` = ?,`status` = ?, "
                                . "`bday` = ?, `email` = ?, `nletter` = ?, `pnmail` = ?, `city` = ?, `hp` = ?,"
                                . "`signatur` = ?,`beschreibung` = ?, `startpage` = ?, `profile_access` = ?"
                                . " WHERE id = ?;", array(stringParser::encode($_POST['land']), stringParser::encode($_POST['user']), stringParser::encode($_POST['nick']), stringParser::encode($_POST['rlname']), intval($_POST['sex']), intval($_POST['status']),
                                (!$bday ? 0 : strtotime($bday)), stringParser::encode($_POST['email']), intval($_POST['nletter']), intval($_POST['pnmail']), stringParser::encode($_POST['city']),
                                stringParser::encode(common::links($_POST['hp'])),stringParser::encode($_POST['sig']), stringParser::encode($_POST['ich']),
                                intval($_POST['startpage']), intval($_POST['visibility_profile']), common::$userid));

                            $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_users}` WHERE `id` = ?;", array(intval(common::$userid)));
                            dbc_index::setIndex('user_' . $get['id'], $get); //Update Cache
                        }
                    }
                break;
                case 'delete':
                    if(!common::rootAdmin(common::$userid)) {
                        $getdel = common::$sql['default']->fetch("SELECT `id`,`nick`,`email`,`hp` FROM `{prefix_users}` WHERE `id` = ?;",array(common::$userid));
                        if(common::$sql['default']->rowCount()) {
                            common::$sql['default']->update("UPDATE `{prefix_forumthreads}` SET `t_nick` = ?, `t_email` = ?, `t_hp` = ?, `t_reg` = 0, WHERE t_reg = ?;",
                            array($getdel['nick'],$getdel['email'],stringParser::encode(common::links($getdel['hp'])),$getdel['id']));
                            common::$sql['default']->update("UPDATE `{prefix_forumposts}` SET `nick` = ?, `email` = ?, `hp` = ?, WHERE `reg` = ?;",
                            array($getdel['nick'],$getdel['email'],stringParser::encode(common::links($getdel['hp'])),$getdel['id']));
                            common::$sql['default']->update("UPDATE `{prefix_newscomments}` SET `nick` = ?,`email` = ?, `hp` = ?, `reg` = 0, WHERE `reg` = ?;",
                            array($getdel['nick'],$getdel['email'],stringParser::encode(common::links($getdel['hp'])),$getdel['id']));
                            common::$sql['default']->update("UPDATE `{prefix_acomments}` SET `nick` = ?, `email` = ?, `hp` = ?, `reg` = 0, WHERE `reg` = ?;",
                            array($getdel['nick'],$getdel['email'],stringParser::encode(common::links($getdel['hp'])),$getdel['id']));
                            common::$sql['default']->delete("DELETE FROM `{prefix_messages}` WHERE `von` = ? OR   `an`  = ?;",array($getdel['id'],$getdel['id']));
                            common::$sql['default']->delete("DELETE FROM `{prefix_news}` WHERE `autor` = ?;",array($getdel['id']));
                            common::$sql['default']->delete("DELETE FROM `{prefix_permissions}` WHERE `user` = ?;",array($getdel['id']));
                            common::$sql['default']->delete("DELETE FROM `{prefix_groupuser}` WHERE `user` = ?;",array($getdel['id']));
                            common::$sql['default']->delete("DELETE FROM `{prefix_userbuddys}` WHERE `user` = ? OR `buddy` = ?;",array($getdel['id'],$getdel['id']));
                            common::$sql['default']->delete("DELETE FROM `{prefix_userstats}` WHERE `user` = ?;",array($getdel['id']));
                            common::$sql['default']->delete("DELETE FROM `{prefix_users}` WHERE `id` = ?;",array($getdel['id']));
                            common::$sql['default']->delete("DELETE FROM `{prefix_userstats}` WHERE `user` = ?;",array($getdel['id']));
                            common::$sql['default']->delete("DELETE FROM `{prefix_clicks_ips}` WHERE `uid` = ?;",array($getdel['id']));

                            $files = common::get_files(basePath."/inc/images/uploads/userpics/",false,true,array("jpg", "gif", "png"));
                            foreach ($files as $file) {
                                if(preg_match("#".$getdel['id']."_(.*?).(gif|jpg|jpeg|png)#",strtolower($file))!= FALSE) {
                                    $res = preg_match("#".$getdel['id']."_(.*)#",$file,$match);
                                    if (file_exists(basePath."/inc/images/uploads/userpics/".$getdel['id']."_".$match[1])) {
                                        unlink(basePath."/inc/images/uploads/userpics/".$getdel['id']."_".$match[1]);
                                    }
                                }
                            }

                            $files = common::get_files(basePath."/inc/images/uploads/useravatare/",false,true,array("jpg", "gif", "png"));
                            foreach ($files as $file) {
                                if(preg_match("#".$getdel['id']."_(.*?).(gif|jpg|jpeg|png)#",strtolower($file))!= FALSE) {
                                    $res = preg_match("#".$getdel['id']."_(.*)#",$file,$match);
                                    if (file_exists(basePath."/inc/images/uploads/useravatare/".$getdel['id']."_".$match[1])) {
                                        unlink(basePath."/inc/images/uploads/useravatare/".$getdel['id']."_".$match[1]);
                                    }
                                }
                            }

                            foreach (array("jpg", "gif", "png") as $tmpendung) {
                                if (file_exists(basePath . "/inc/images/uploads/userpics/" . intval($getdel['id']) . "." . $tmpendung)) {
                                    @unlink(basePath . "/inc/images/uploads/userpics/" . intval($getdel['id']) . "." . $tmpendung);
                                }

                                if (file_exists(basePath . "/inc/images/uploads/useravatare/" . intval($getdel['id']) . "." . $tmpendung)) {
                                    @unlink(basePath . "/inc/images/uploads/useravatare/" . intval($getdel['id']) . "." . $tmpendung);
                                }
                            }

                            common::dzcp_session_destroy();
                            $index = common::info(_info_account_deletet, '../news/');
                        }
                    }
                break;
                default:
                    $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_users}` WHERE `id` = ?;",array(common::$userid));
                    switch(isset($_GET['show']) ? $_GET['show'] : '') {
                        case 'almgr':
                            switch ($do) {
                                case 'self_add':
                                    $permanent_key = md5(common::mkpwd(8));
                                    if(common::$sql['default']->rows("SELECT `id` FROM `{prefix_autologin}` WHERE `host` = ?;", array(gethostbyaddr(common::$userip)))) {
                                        //Update Autologin
                                        common::$sql['default']->update("UPDATE `{prefix_autologin}` SET "
                                                          . "`ssid` = ?, "
                                                          . "`pkey` = ?, "
                                                          . "`ip` = ?, "
                                                          . "`date` = ?, "
                                                          . "`update` = ?, "
                                                          . "`expires` = ? "
                                                    . "WHERE `host` = ?;", 
                                        array(session_id(),$permanent_key,common::$userip,$time=time(),$time,autologin_expire,
                                              gethostbyaddr(common::$userip)));
                                    } else {
                                        //Insert Autologin
                                        common::$sql['default']->insert("INSERT INTO `{prefix_autologin}` SET "
                                                               . "`uid` = ?,"
                                                               . "`ssid` = ?,"
                                                               . "`pkey` = ?,"
                                                               . "`ip` = ?,"
                                                               . "`name` = ?, "
                                                               . "`host` = ?,"
                                                               . "`date` = ?,"
                                                               . "`update` = 0,"
                                                               . "`expires` = ?;",
                                        array($get['id'],session_id(),$permanent_key,common::$userip,
                                            common::cut(gethostbyaddr(common::$userip),20), gethostbyaddr(common::$userip),
                                            $time=time(),autologin_expire));
                                    }
                                    
                                    cookie::put('id', $get['id']);
                                    cookie::put('pkey', $permanent_key);
                                    cookie::save(); unset($permanent_key);
                                    $index = common::info(_info_almgr_self_added, '../user/?action=editprofile&show=almgr');
                                break;
                                case 'self_remove':
                                    if(common::$sql['default']->rows("SELECT `id` FROM `{prefix_autologin}` WHERE `host` = ? AND `ssid` = ?;", array(gethostbyaddr(common::$userip), session_id()))) {
                                        common::$sql['default']->delete("DELETE FROM `{prefix_autologin}` WHERE `ssid` = ?;",array(session_id()));
                                        cookie::delete('pkey');
                                        cookie::delete('id');
                                        cookie::save();
                                        $index = common::info(_info_almgr_self_deletet, '../user/?action=editprofile&show=almgr');
                                    }
                                break;
                                case 'almgr_delete':
                                    if(common::$sql['default']->rows("SELECT `id` FROM `{prefix_autologin}` WHERE `id` = ?;", array(intval($_GET['id'])))) {
                                        common::$sql['default']->delete("DELETE FROM `{prefix_autologin}` WHERE `id` = ?;",array(intval($_GET['id'])));
                                        cookie::delete('pkey');
                                        cookie::delete('id');
                                        cookie::save();
                                        $index = common::info(_info_almgr_deletet, '../user/?action=editprofile&show=almgr');
                                    }
                                break;
                                case 'almgr_edit':
                                    $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_autologin}` WHERE `id` = ?;", array(intval($_GET['id'])));
                                    if(common::$sql['default']->rowCount()) {
                                        $show = show($dir . "/edit_almgr_from", array("name" => stringParser::decode($get['name']),
                                                                                      "id" => stringParser::decode($get['id']),
                                                                                      "host" => stringParser::decode($get['host']),
                                                                                      "ip" => stringParser::decode($get['ip']),
                                                                                      "ssid" => stringParser::decode($get['ssid']),
                                                                                      "pkey" => stringParser::decode($get['pkey'])));
                                    }
                                break;
                                case 'almgr_edit_save':
                                    if(common::$sql['default']->rows("SELECT id FROM `{prefix_autologin}` WHERE `id` = ?;", array(intval($_GET['id'])))) {
                                        common::$sql['default']->update("UPDATE `{prefix_autologin}` SET `name` = ? WHERE `id` = ?;", array(stringParser::encode($_POST['name']), intval($_GET['id'])));
                                        $index = common::info(_almgr_editd, '../user/?action=editprofile&show=almgr');
                                    }
                                break;
                            }
                            
                            if(empty($index)) {
                                $qry = common::$sql['default']->select("SELECT * FROM `{prefix_autologin}` WHERE `uid` = ?;",array(common::$userid)); $almgr = ""; $color = 0;
                                if(common::$sql['default']->rowCount()) {
                                    foreach($qry as $get) {
                                        $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
                                        $almgr .= show($dir . "/edit_almgr_show", array("delete" => show(_almgr_deleteicon, array("id" => $get['id'])),
                                                                                        "edit" => show(_almgr_editicon, array("id" => $get['id'])),                                            
                                                                                        "class" => $class,
                                                                                        "name" => stringParser::decode($get['name']),
                                                                                        "host" => stringParser::decode($get['host']),
                                                                                        "ip" => $get['ip'],
                                                                                        "create" => date('d.m.Y',$get['date']),
                                                                                        "lused" => !$get['update'] ? '-' : date('d.m.Y',$get['update']),
                                                                                        "expires" => date('d.m.Y',((!$get['update'] ? time() : $get['update'])+$get['expires']))));
                                    }
                                }

                                //Empty
                                if(empty($almgr))
                                    $almgr = '<tr><td colspan="6" class="contentMainSecond">'._no_entrys.'</td></tr>';

                                if(empty($show))
                                    $show = show($dir . "/edit_almgr", array("del" => _deleteicon_blank,"edit" => _editicon_blank,"showalmgr" => $almgr));
                            }
                        break;
                        default:
                            $sex = ($get['sex'] == 1 ? _pedit_male : ($get['sex'] == 2 ? _pedit_female : _pedit_sex_ka));
                            $status = ($get['status'] ? _pedit_aktiv : _pedit_inaktiv);

                            $levels = array(0,1,2,3); $perm_profile = "";
                            foreach ($levels as &$level) {
                                $selected = ($level == $get['profile_access'] ? ' selected="selected"' : '');
                                switch ($level) {
                                    case 0: $perm_profile .= '<option'.$selected.' value="'.$level.'">'._pedit_perm_public.'</option>'; break;
                                    case 1: $perm_profile .= '<option'.$selected.' value="'.$level.'">'._pedit_perm_user.'</option>'; break;
                                    case 2: $perm_profile .= '<option'.$selected.' value="'.$level.'">'._pedit_perm_member.'</option>'; break;
                                    case 3: $perm_profile .= '<option'.$selected.' value="'.$level.'">'._pedit_perm_admin.'</option>'; break;
                                }
                            }
                            
                            // Startpage
                            $sql_startpage = common::$sql['default']->select("SELECT `name`,`id` FROM `{prefix_startpage}`;");
                            $startpage = '<option value="0">'._userlobby.'</option>';
                            if(common::$sql['default']->rowCount()) {
                                foreach($sql_startpage as $get_startpage) {
                                    $startpage .= show(_select_field,array('value' => $get_startpage['id'], 'sel' => ($get_startpage['id'] == $get['startpage'] ? 'selected="selected"' : ''), 'what' => $get_startpage['name'])); }
                            }

                            $bdayday = 0; $bdaymonth = 0; $bdayyear = 0;
                            if (!empty($get['bday']) && $get['bday'])
                                list($bdayday, $bdaymonth, $bdayyear) = explode('.', date('d.m.Y', $get['bday']));

                            $dropdown_age = show(_dropdown_date, array("day" => common::dropdown("day", $bdayday, 1),
                                                                       "month" => common::dropdown("month", $bdaymonth, 1),
                                                                       "year" => common::dropdown("year", $bdayyear, 1)));

                            $pnl = ($get['nletter'] ? 'checked="checked"' : '');
                            $pnm = ($get['pnmail'] ? 'checked="checked"' : '');

                            $pic = common::userpic($get['id']); $deletepic = '';
                            if (!preg_match("#nopic#", $pic))
                                $deletepic = "| " . _profil_delete_pic;

                            $avatar = common::useravatar($get['id']); $deleteava = '';
                            if (!preg_match("#noavatar#", $avatar))
                                $deleteava = "| " . _profil_delete_ava;

                            if (common::rootAdmin(common::$userid))
                                $delete = _profil_del_admin;
                            else
                                $delete = show("page/button_delete_account", array("id" => $get['id'],
                                                                                   "action" => "action=editprofile&amp;do=delete",
                                                                                   "value" => _button_title_del_account,
                                                                                   "del" => _confirm_del_account));

                            $show = show($dir . "/edit_profil", array("country" => common::show_countrys($get['country']),
                                                                      "city" => stringParser::decode($get['city']),
                                                                      "pnl" => $pnl,
                                                                      "pnm" => $pnm,
                                                                      "pwd" => "",
                                                                      "dropdown_age" => $dropdown_age,
                                                                      "ava" => $avatar,
                                                                      "hp" => stringParser::decode($get['hp']),
                                                                      "nick" => stringParser::decode($get['nick']),
                                                                      "name" => stringParser::decode($get['user']),
                                                                      "rlname" => stringParser::decode($get['rlname']),
                                                                      "bdayday" => $bdayday,
                                                                      "bdaymonth" => $bdaymonth,
                                                                      "bdayyear" => $bdayyear,
                                                                      "sex" => $sex,
                                                                      "email" => stringParser::decode($get['email']),
                                                                      "visibility_profile" => $perm_profile,
                                                                      "sig" => stringParser::decode($get['signatur']),
                                                                      "pic" => $pic,
                                                                      "deleteava" => $deleteava,
                                                                      "deletepic" => $deletepic,
                                                                      "startpage" => $startpage,
                                                                      "position" => common::getrank($get['id']),
                                                                      "status" => $status,
                                                                      "custom_about" => getcustom(1),
                                                                      "custom_contact" => getcustom(3),
                                                                      "custom_favos" => getcustom(4),
                                                                      "custom_hardware" => getcustom(5),
                                                                      "ich" => stringParser::decode($get['beschreibung']),
                                                                      "delete" => $delete));
                        break;
                    }

                    if(empty($index))
                        $index = show($dir . "/edit", array("show" => $show),array("nick" => common::autor($get['id'])));
                break;
            }
        }
}