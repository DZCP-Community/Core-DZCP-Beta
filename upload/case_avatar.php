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

if(defined('_Upload')) {
    if(common::$chkMe >= 1) {
        switch ($do) {
            case 'upload':
                $tmpname = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];
                $type = $_FILES['file']['type'];
                $size = $_FILES['file']['size'];

                $endung = explode(".", $_FILES['file']['name']);
                $endung = strtolower($endung[count($endung)-1]);

                if(!$tmpname)
                    $index = common::error(_upload_no_data, 1);
                else if($size > settings::get('upicsize')."000")
                    $index = common::error(_upload_wrong_size, 1);
                else  {
                    foreach(array("jpg", "gif", "png") as $tmpendung) {
                        if(file_exists(basePath."/inc/images/uploads/useravatare/".common::$userid.".".$tmpendung))
                            @unlink(basePath."/inc/images/uploads/useravatare/".common::$userid.".".$tmpendung);
                    }

                    if(move_uploaded_file($tmpname, basePath."/inc/images/uploads/useravatare/".common::$userid.".".strtolower($endung)))
                        $index = common::info(_info_upload_success, "../user/?action=editprofile");
                    else
                        $index = common::error(_upload_error, 1);
                }
            break;
            case 'delete':
                foreach(array("jpg", "gif", "png") as $tmpendung) {
                    if(file_exists(basePath."/inc/images/uploads/useravatare/".common::$userid.".".$tmpendung))
                        @unlink(basePath."/inc/images/uploads/useravatare/".common::$userid.".".$tmpendung);
                }

                $index = common::info(_delete_pic_successful, "../user/?action=editprofile");
            break;
            default:
                $infos = show(_upload_userava_info, array("userpicsize" => settings::get('upicsize')));
                $index = show($dir."/upload", array("uploadhead" => _upload_ava_head,
                                                    "name" => "file",
                                                    "action" => "?action=avatar&amp;do=upload",
                                                    "infos" => $infos));
            break;
        }
    }
}