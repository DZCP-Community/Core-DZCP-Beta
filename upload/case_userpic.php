<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */

if(defined('_Upload')) {
    if(common::$chkMe >= 1 && common::$userid) {
        switch($do) {
            case 'upload':
                $tmpname = $_FILES['file']['tmp_name'];
                if(!$tmpname) {
                    $index = common::error(_upload_no_data, 1);
                } else {
                    $file_info = getimagesize($tmpname);
                    if(!$file_info) {
                        $index = common::error(_upload_error, 1);
                    } else {
                        $file_info['width']  = $file_info[0];
                        $file_info['height'] = $file_info[1];
                        $file_info['mime']   = $file_info[2];
                        unset($file_info[3],$file_info['bits'],$file_info['channels'],
                            $file_info[0],$file_info[1],$file_info[2]);

                        if(!array_key_exists($file_info['mime'], config::$extensions)) {
                           $error = show(_upload_usergallery_info, array('userpicsize' => settings::get('upicsize')));
                           $index = common::error($error, 1);
                        } else {
                            if($_FILES['file']['size'] > (settings::get('upicsize')*1000)) {
                                $index = common::error(_upload_wrong_size, 1);
                            } else {
                                foreach(array("jpg", "gif", "png") as $tmpendung) {
                                    if(file_exists(basePath."/inc/images/uploads/userpics/".common::$userid.".".$tmpendung))
                                        unlink(basePath."/inc/images/uploads/userpics/".common::$userid.".".$tmpendung);
                                }
                                
                                if(!move_uploaded_file($tmpname, basePath."/inc/images/uploads/userpics/".common::$userid.".".config::$extensions[$file_info['mime']])) {
                                    $index = common::error(_upload_error, 1);
                                } else {
                                    $index = common::info(_info_upload_success, "../user/?action=editprofile");
                                }
                            }
                        }
                    }
                }
            break;
            case 'deletepic':
                foreach(array("jpg", "gif", "png") as $tmpendung) {
                    if(file_exists(basePath."/inc/images/uploads/userpics/".common::$userid.".".$tmpendung))
                        unlink(basePath."/inc/images/uploads/userpics/".common::$userid.".".$tmpendung);
                }

                $index = common::info(_delete_pic_successful, "../user/?action=editprofile");
            break;
            default:
                $infos = show(_upload_userpic_info, array("userpicsize" => settings::get('upicsize')));
                $index = show($dir."/upload", array("uploadhead" => _upload_head,
                                                    "name" => "file",
                                                    "action" => "?action=userpic&amp;do=upload",
                                                    "infos" => $infos));
            break;
        }
    }
}