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

if(_adminMenu != 'true') exit;
$where = $where.': '._config_useradd_head;

if(isset($_POST['user'])) {
    $check_user = common::$sql['default']->rows("SELECT `id` FROM `{prefix_users}` WHERE `user`= ?;", [stringParser::encode($_POST['user'])]);
    $check_nick = common::$sql['default']->rows("SELECT `id` FROM `{prefix_users}` WHERE `nick`= ?;", [stringParser::encode($_POST['nick'])]);
    $check_email = common::$sql['default']->rows("SELECT `id` FROM `{prefix_users}` WHERE `email`= ?;", [stringParser::encode($_POST['email'])]);

    if(empty($_POST['user'])) {
        $show = common::error(_empty_user, 1);
    } elseif(empty($_POST['nick'])) {
        $show = common::error(_empty_nick, 1);
    } elseif(empty($_POST['email'])) {
        $show = common::error(_empty_email, 1);
    } elseif(!common::check_email($_POST['email'])) {
        $show = common::error(_error_invalid_email, 1);
    } elseif($check_user) {
        $show = common::error(_error_user_exists, 1);
    } elseif($check_nick) {
        $show = common::error(_error_nick_exists, 1);
    } elseif($check_email) {
        $show = common::error(_error_email_exists, 1);
    } else {
        $mkpwd = empty($_POST['pwd']) ? common::mkpwd() : $_POST['pwd'];
        $pwd = common::pwd_encoder($mkpwd);
        $bday = ($_POST['t'] && $_POST['m'] && $_POST['j'] ? common::cal($_POST['t']).".".common::cal($_POST['m']).".".$_POST['j'] : 0);
        common::$sql['default']->insert("INSERT INTO `{prefix_users}` "
                          . "SET `user` = ?,"
                          . "`nick` = ?, "
                          . "`email` = ?,"
                          . "`pwd` = ?, "
                          . "`pwd_encoder` = ?, "
                          . "`rlname` = ?, "
                          . "`sex` = ?, "
                          . "`bday` = ?, "
                          . "`city` = ?, "
                          . "`country` = ?, "
                          . "`regdatum` = ?, "
                          . "`level` = ?, "
                          . "`time` = ?, "
                          . "`status` = 1;",
                [stringParser::encode($_POST['user']),stringParser::encode($_POST['nick']),stringParser::encode($_POST['email']),stringParser::encode($pwd),settings::get('default_pwd_encoder'),stringParser::encode($_POST['rlname']),intval($_POST['sex']),
                (!$bday ? 0 : strtotime($bday)),stringParser::encode($_POST['city']),stringParser::encode($_POST['land']),$time=time(),intval($_POST['level']),$time]);

        $insert_id = common::$sql['default']->lastInsertId();
        common::setIpcheck("createuser(".$_SESSION['id']."_".$insert_id.")");

        //Insert Permissions
        $permissions = "";
        foreach($_POST['perm'] AS $v => $k) {
            $permissions .= "`".substr($v, 2)."` = ".intval($k).", ";
        }

        if(!empty($permissions)) {
            $permissions = ', '.substr($permissions, 0, -2);
        }

        common::$sql['default']->insert("INSERT INTO `{prefix_permissions}` SET `user` = ?".$permissions.";", [$insert_id]);

        // internal boardpermissions
        if(!empty($_POST['board'])) {
            foreach ($_POST['board'] AS $boardname) {
                common::$sql['default']->insert("INSERT INTO `{prefix_f_access}` SET `user` = ?, `forum` = ?;", [$insert_id,$boardname]);
            }
        }

        $groups = common::$sql['default']->select("SELECT * FROM `{prefix_groups}`;");
        foreach($groups as $get_group) {
            if(isset($_POST['group'.$get_group['id']])) {
                common::$sql['default']->insert("INSERT INTO `{prefix_groupuser}` SET `user`  = ?, `group` = ?;", [$insert_id,intval($_POST['squad'.$get_group['id']])]);
            }

            if(isset($_POST['group'.$get_group['id']])) {
                common::$sql['default']->insert("INSERT INTO `{prefix_userposis}` SET `user` = ?, `posi` = ?, `group` = ?;", [$insert_id,intval($_POST['sqpos'.$get_group['id']]),$get_group['id']]);
            }
        }

        //Profilfoto
        if(!empty($_FILES['file'])) {
            $tmpname = $_FILES['file']['tmp_name'];
            $name = $_FILES['file']['name'];
            $type = $_FILES['file']['type'];
            $size = $_FILES['file']['size'];

            $endung = explode(".", $_FILES['file']['name']);
            $endung = strtolower($endung[count($endung)-1]);

            if($tmpname) {
                $imageinfo = getimagesize($tmpname);
                foreach(["jpg", "gif", "png"] as $tmpendung) {
                    if(file_exists(basePath."/inc/images/uploads/userpics/".$insert_id.".".$tmpendung)) {
                        @unlink(basePath."/inc/images/uploads/userpics/".$insert_id.".".$tmpendung);
                    }
                }
                copy($tmpname, basePath."/inc/images/uploads/userpics/".$insert_id.".".strtolower($endung)."");
                @unlink($_FILES['file']['tmp_name']);
            }
        }

        //Avatar
        if(!empty($_FILES['file_avatar'])) {
            $tmpname = $_FILES['file_avatar']['tmp_name'];
            $name = $_FILES['file_avatar']['name'];
            $type = $_FILES['file_avatar']['type'];
            $size = $_FILES['file_avatar']['size'];

            $endung = explode(".", $_FILES['file_avatar']['name']);
            $endung = strtolower($endung[count($endung)-1]);

            if($tmpname) {
                $imageinfo = getimagesize($tmpname);
                foreach(["jpg", "gif", "png"] as $tmpendung) {
                    if(file_exists(basePath."/inc/images/uploads/useravatare/".$insert_id.".".$tmpendung)) {
                        @unlink(basePath."/inc/images/uploads/useravatare/".$insert_id.".".$tmpendung);
                    }
                }

                copy($tmpname, basePath."/inc/images/uploads/useravatare/".$insert_id.".".strtolower($endung)."");
                @unlink($_FILES['file_avatar']['tmp_name']);
            }
        }

        common::$sql['default']->insert("INSERT INTO `{prefix_userstats}` SET `user` = ?, `lastvisit` = ?;", [$insert_id,time()]);
        $show = common::info(_uderadd_info, "../admin/");
    }
}

if(empty($show)) {
    $dropdown_age = show(_dropdown_date, ["day" => common::dropdown("day",0,1),
                                               "month" => common::dropdown("month",0,1),
                                               "year" => common::dropdown("year",0,1)]);

    $qrygroups = common::$sql['default']->select("SELECT `id`,`name` FROM `{prefix_groups}` ORDER BY `id`;"); $egroups = "";
    foreach($qrygroups as $getgroups) {
        $qrypos = common::$sql['default']->select("SELECT `id`,`position` FROM `{prefix_positions}` ORDER BY `pid`;"); $posi = "";
        foreach($qrypos as $getpos) {
            $posi .= show(_select_field_posis, ["value" => $getpos['id'], "sel" => "", "what" => stringParser::decode($getpos['position'])]);
        }

        $egroups .= show(_checkfield_squads, ["id" => $getgroups['id'], "check" => "","eposi" => $posi,"squad" => stringParser::decode($getgroups['name'])]);
    }

    $show = show($dir."/register", ["groups" => $egroups,
                                         "getpermissions" => common::getPermissions(),
                                         "getboardpermissions" => common::getBoardPermissions(),
                                         "dropdown_age" => $dropdown_age,
                                         "country" => common::show_countrys(),
                                         "alvl" => ""]);
}