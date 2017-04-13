<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */

if(defined('_UserMenu')) {
    $where = _site_user_lostpwd;
    if (!common::$chkMe) {
        if ($do == "sended") {
            $get = common::$sql['default']->fetch("SELECT `id`,`user`,`level` FROM `{prefix_users}` WHERE `user` = ? AND `email` = ?;", array(stringParser::encode($_POST['user']), stringParser::encode($_POST['email'])));
            if (common::$sql['default']->rowCount() && (isset($_POST['secure']) || common::$securimage->check($_POST['secure']))) {
                $pwd = common::mkpwd();
                common::$sql['default']->update("UPDATE `{prefix_users}` SET `pwd` = ?, `pwd_encoder` = ? WHERE `id` = ?;",
                    array(common::pwd_encoder($pwd),settings::get('default_pwd_encoder'),$get['id']));
                common::setIpcheck("pwd(" . $get['id'] . ")");
                $message = show(common::bbcode_email(stringParser::decode(settings::get('eml_pwd'))), array("user" => $get['user'], "pwd" => $pwd));
                common::sendMail($_POST['email'],stringParser::decode(settings::get('eml_pwd_subj')), $message);
                $index = common::info(_lostpwd_valid, "../user/?action=login");
            } else {
                common::setIpcheck("trypwd(" . $get['id'] . ")");
                if (settings::get('securelogin') && isset($_POST['secure']) && !common::$securimage->check($_POST['secure'])) {
                    $index = common::error(captcha_mathematic ? _error_invalid_regcode_mathematic : _error_invalid_regcode, 1);
                } else {
                    $index = common::error(_lostpwd_failed, 1);
                }
            }
        } else {
            $index = show($dir . "/lostpwd");
        }
    } else {
        $index = common::error(_error_user_already_in, 1);
    }
}