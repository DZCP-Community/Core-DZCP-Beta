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
$where = $where.': '._news_admin_head;

switch ($do) {
    case 'add':
        //Insert
        $notification_p = ""; $saved = false;
        if(isset($_POST['titel'])) {
            if(empty($_POST['titel']) || empty($_POST['newstext'])) {
                if(empty($_POST['newstext'])) {
                    notification::add_error(_empty_news);
                }
                
                if(empty($_POST['titel'])) {
                    notification::add_error(_empty_news_title);
                }
                
                javascript::set('AnchorMove', 'notification-box');
            } else {
                $timeshift = ''; $public = ''; $datum = ''; $params = array();
                $stickytime = isset($_POST['sticky']) ? mktime($_POST['h'],$_POST['min'],0,$_POST['m'],$_POST['t'],$_POST['j']) : '0';
                if(isset($_POST['timeshift'])) {
                    $timeshifttime = mktime($_POST['h_ts'],$_POST['min_ts'],0,$_POST['m_ts'],$_POST['t_ts'],$_POST['j_ts']);
                    $timeshift = "`timeshift` = 1,";
                    $public = "`public` = 1,";
                    $params[] = intval($timeshifttime);
                    $datum = "`datum` = ?,";
                }

                common::$sql['default']->insert("INSERT INTO `{prefix_news}` SET `autor` = ?,`kat` = ?,`titel` = ?,`text` = ?,`more` = ?,"
                        . "`link1` = ?,`link2` = ?,`link3` = ?,`url1` = ?,`url2` = ?,`url3` = ?,`intern` = ?,".$timeshift."".$public."".$datum."`sticky` = ?;",
                        array_merge(array(intval(common::$userid),intval($_POST['kat']),stringParser::encode($_POST['titel']),stringParser::encode($_POST['newstext']),
                            stringParser::encode($_POST['morenews']),stringParser::encode($_POST['link1']),stringParser::encode($_POST['link2']),stringParser::encode($_POST['link3']),
                            stringParser::encode(common::links($_POST['url1'])),stringParser::encode(common::links($_POST['url2'])),stringParser::encode(common::links($_POST['url3'])),(isset($_POST['intern']) ? 1 : 0)),
                                $params,array(intval($stickytime))));

                $picUploadError = false;
                if(isset($_FILES['newspic']['tmp_name']) && !empty($_FILES['newspic']['tmp_name'])) {
                    $tmpname = $_FILES['newspic']['tmp_name'];
                    $file_name = $_FILES['newspic']['name'];
                    if($tmpname) {
                        $file_info = getimagesize($tmpname);
                        if(!$file_info) {
                            notification::add_error(_upload_error);
                            $picUploadError = true;
                        } else {
                            $file_info['width']  = $file_info[0];
                            $file_info['height'] = $file_info[1];
                            $file_info['mime']   = $file_info[2];
                            unset($file_info[3],$file_info['bits'],$file_info['channels'],
                                $file_info[0],$file_info[1],$file_info[2]);

                            if(!array_key_exists($file_info['mime'], config::$extensions)) {
                                notification::add_error(_upload_ext_error);
                                $picUploadError = true;
                            } else {
                                $endung = explode(".", $file_name);
                                $endung = strtolower($endung[count($endung)-1]);
                                if(!move_uploaded_file($tmpname, basePath."/inc/images/uploads/news/".common::$sql['default']->lastInsertId().".".strtolower($endung))) {
                                    notification::add_error(_upload_error);
                                    $picUploadError = true;
                                }
                            }
                        }
                    }
                }

                if(!$picUploadError) {
                    javascript::set('AnchorMove', 'notification-box');
                    notification::add_success(_news_sended, "?admin=newsadmin",2);
                    $saved = true;
                } else {
                    javascript::set('AnchorMove', 'notification-box');
                }
            }
        }
        
        //Show
        $qryk = common::$sql['default']->select("SELECT id,kategorie FROM `{prefix_newskat}`"); $kat = '';
        foreach($qryk as $getk) {
            $sel = (isset($_POST['kat']) && $_POST['kat'] == $getk['id'] ? 'selected="selected"' : '');
            $kat .= show(_select_field, array("value" => $getk['id'],
                                              "sel" => $sel,
                                              "what" => stringParser::decode($getk['kategorie'])));
        }

        $dropdown_date = show(_dropdown_date, array("day" => common::dropdown("day",isset($_POST['t']) ? intval($_POST['t']) : date("d")),
                                                    "month" => common::dropdown("month",isset($_POST['m']) ? intval($_POST['m']) : date("m")),
                                                    "year" => common::dropdown("year",isset($_POST['j']) ? intval($_POST['j']) : date("Y"))));

        $dropdown_time = show(_dropdown_time, array("hour" => common::dropdown("hour",isset($_POST['h']) ? intval($_POST['h']) : date("H")),
                                                    "minute" => common::dropdown("minute",isset($_POST['min']) ? intval($_POST['min']) : date("i")),
                                                    "uhr" => _uhr));

        $timeshift_date = show(_dropdown_date_ts, array("nr" => "ts",
                                                        "day" => common::dropdown("day",isset($_POST['t_ts']) ? intval($_POST['t_ts']) : date("d")),
                                                        "month" => common::dropdown("month",isset($_POST['m_ts']) ? intval($_POST['m_ts']) : date("m")),
                                                        "year" => common::dropdown("year",isset($_POST['j_ts']) ? intval($_POST['j_ts']) : date("Y"))));

        $timeshift_time = show(_dropdown_time_ts, array("nr" => "ts",
                                                        "hour" => common::dropdown("hour",isset($_POST['h_ts']) ? intval($_POST['h_ts']) : date("H")),
                                                        "minute" => common::dropdown("minute",isset($_POST['min_ts']) ? intval($_POST['min_ts']) : date("i")),
                                                        "uhr" => _uhr));

        $show = show($dir."/news_form", array("head" => _admin_news_head,
                                              "autor" => common::autor(),
                                              "n_newspic" => "",
                                              "delnewspic" => "",
                                              "kat" => $kat,
                                              "do" => "add",
                                              "all_disabled" => ($saved ? " disabled" : ""),
                                              "titel" => (isset($_POST['titel']) ? $_POST['titel'] : ''),
                                              "newstext" => (isset($_POST['newstext']) ? $_POST['newstext'] : ''),
                                              "morenews" => (isset($_POST['morenews']) ? $_POST['morenews'] : ''),
                                              "link1" => (isset($_POST['link1']) ? $_POST['link1'] : ''),
                                              "link2" => (isset($_POST['link2']) ? $_POST['link2'] : ''),
                                              "link3" => (isset($_POST['link3']) ? $_POST['link3'] : ''),
                                              "url1" => (isset($_POST['url1']) ? $_POST['url1'] : ''),
                                              "url2" => (isset($_POST['url2']) ? $_POST['url2'] : ''),
                                              "url3" => (isset($_POST['url3']) ? $_POST['url3'] : ''),
                                              "klapplink" => (isset($_POST['klapptitel']) ? $_POST['klapptitel'] : ''),
                                              "sticky" => (isset($_POST['sticky']) ? 'checked="checked"' : ''),
                                              "button" =>  _button_value_add,
                                              "intern" => (isset($_POST['intern']) ? 'checked="checked"' : ''),
                                              "dropdown_time" => $dropdown_time,
                                              "dropdown_date" => $dropdown_date,
                                              "timeshift_date" => $timeshift_date,
                                              "timeshift_time" => $timeshift_time,
                                              "timeshift" => (isset($_POST['timeshift']) ? 'checked="checked"' : '')));
    break;
    case 'edit':
        if(isset($_GET['id'])) {
            $_SESSION['editID'] = intval($_GET['id']);
        } else if(!array_key_exists('editID', $_SESSION)) {
            $_SESSION['editID'] = 0;
        }
        
        $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_news}` WHERE id = ".$_SESSION['editID'].";");
        if(isset($_POST['titel'])) {
            if(empty($_POST['titel']) || empty($_POST['newstext'])) {
                if(empty($_POST['newstext'])) {
                    notification::add_error(_empty_news);
                }
                
                if(empty($_POST['titel'])) {
                    notification::add_error(_empty_news_title);
                }
                
                javascript::set('AnchorMove', 'notification-box');
            } else {
                $timeshift = ''; $public = ''; $datum = ''; $params = array();
                $stickytime = isset($_POST['sticky']) ? mktime($_POST['h'],$_POST['min'],0,$_POST['m'],$_POST['t'],$_POST['j']) : '0';
                if(isset($_POST['timeshift'])) {
                    $timeshifttime = mktime($_POST['h_ts'],$_POST['min_ts'],0,$_POST['m_ts'],$_POST['t_ts'],$_POST['j_ts']);
                    $timeshift = "`timeshift` = 1,";
                    $public = "`public` = 1,";
                    $params[] = intval($timeshifttime);
                    $datum = "`datum` = ?,";
                }

                $picUploadError = false;
                if(isset($_FILES['newspic']['tmp_name']) && !empty($_FILES['newspic']['tmp_name'])) {
                    $tmpname = $_FILES['newspic']['tmp_name'];
                    $file_name = $_FILES['newspic']['name'];
                    if($tmpname) {
                        $file_info = getimagesize($tmpname);
                        if(!$file_info) {
                            notification::add_error(_upload_error);
                            $picUploadError = true;
                        } else {
                            $file_info['width']  = $file_info[0];
                            $file_info['height'] = $file_info[1];
                            $file_info['mime']   = $file_info[2];
                            unset($file_info[3],$file_info['bits'],$file_info['channels'],
                                $file_info[0],$file_info[1],$file_info[2]);

                            if(!array_key_exists($file_info['mime'], config::$extensions)) {
                                notification::add_error(_upload_ext_error);
                                $picUploadError = true;
                            } else {
                                //Remove Pic
                                foreach(array("jpg", "gif", "png") as $tmpendung) {
                                    if(file_exists(basePath."/inc/images/uploads/news/".intval($get['id']).".".$tmpendung))
                                        @unlink(basePath."/inc/images/uploads/news/".intval($get['id']).".".$tmpendung);
                                }

                                //Remove minimize
                                $files = common::get_files(basePath."/inc/images/uploads/news/",false,true,array("jpg", "gif", "png"));
                                if($files) {
                                    foreach ($files as $file) {
                                        if(preg_match("#".intval($_GET['id'])."(.*?).(gif|jpg|jpeg|png)#",strtolower($file))!= FALSE) {
                                            $res = preg_match("#".intval($_GET['id'])."_(.*)#",$file,$match);
                                            if(file_exists(basePath."/inc/images/uploads/news/".intval($get['id'])."_".$match[1]))
                                                @unlink(basePath."/inc/images/uploads/news/".intval($get['id'])."_".$match[1]);
                                        }
                                    }
                                }
                                
                                $endung = explode(".", $file_name);
                                $endung = strtolower($endung[count($endung)-1]);
                                if(!move_uploaded_file($tmpname, basePath."/inc/images/uploads/news/".$get['id'].".".strtolower($endung))) {
                                    notification::add_error(_upload_error);
                                    $picUploadError = true;
                                }
                            }
                        }
                    }
                }

                if(!$picUploadError) {
                    common::$sql['default']->update("UPDATE `{prefix_news}`
                        SET `kat`        = '".intval($_POST['kat'])."',
                            `titel`      = '".stringParser::encode($_POST['titel'])."',
                            `text`       = '".stringParser::encode($_POST['newstext'])."',
                            `more`  = '".stringParser::encode($_POST['morenews'])."',
                            `link1`      = '".stringParser::encode($_POST['link1'])."',
                            `url1`       = '".common::links($_POST['url1'])."',
                            `link2`      = '".stringParser::encode($_POST['link2'])."',
                            `url2`       = '".common::links($_POST['url2'])."',
                            `link3`      = '".stringParser::encode($_POST['link3'])."',
                            `intern`     = '".(isset($_POST['intern']) ? intval($_POST['intern']) : 0)."',
                            `url3`       = '".stringParser::encode(common::links($_POST['url3']))."',
                            ".$timeshift."
                            ".$public."
                            ".$datum."
                            `sticky`     = '".intval($stickytime)."'
                        WHERE id = ".$get['id'].";");
                    
                    $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_news}` WHERE id = ".$get['id'].";");
                    javascript::set('AnchorMove', 'notification-box');
                    notification::add_success(_news_edited, "?admin=newsadmin",2);
                    $saved = true;
                } else {
                    javascript::set('AnchorMove', 'notification-box');
                }
            }
        }
        
        $qryk = common::$sql['default']->select("SELECT id,kategorie FROM `{prefix_newskat}`"); $kat = '';
        foreach($qryk as $getk) {
            $sel = ($get['kat'] == $getk['id'] ? 'selected="selected"' : '');
            $kat .= show(_select_field, array("value" => $getk['id'],
                                              "sel" => $sel,
                                              "what" => stringParser::decode($getk['kategorie'])));
        }

        $int = ($get['intern'] ? 'checked="checked"' : '');
        $timeshift = ($get['timeshift'] ? 'checked="checked"' : '');
        $sticky = ($get['sticky'] ? 'checked="checked"' : '');

        $dropdown_date = show(_dropdown_date, array("day" => common::dropdown("day",date("d")), "month" => common::dropdown("month",date("m")), "year" => common::dropdown("year",date("Y"))));
        $dropdown_time = show(_dropdown_time, array("hour" => common::dropdown("hour",date("H")), "minute" => common::dropdown("minute",date("i")), "uhr" => _uhr));
        if($get['sticky']) {
            $dropdown_date = show(_dropdown_date, array("day" => common::dropdown("day",date("d",$get['sticky'])),
                                                        "month" => common::dropdown("month",date("m",$get['sticky'])),
                                                        "year" => common::dropdown("year",date("Y",$get['sticky']))));

            $dropdown_time = show(_dropdown_time, array("hour" => common::dropdown("hour",date("H",$get['sticky'])),
                                                        "minute" => common::dropdown("minute",date("i",$get['sticky'])),
                                                        "uhr" => _uhr));
        }

        $timeshift_date = show(_dropdown_date_ts, array("nr" => "ts", "day" => common::dropdown("day",date("d")), "month" => common::dropdown("month",date("m")), "year" => common::dropdown("year",date("Y"))));
        $timeshift_time = show(_dropdown_time_ts, array("nr" => "ts", "hour" => common::dropdown("hour",date("H")), "minute" => common::dropdown("minute",date("i")), "uhr" => _uhr));
        
        if($get['timeshift']) {
            $timeshift_date = show(_dropdown_date_ts, array("nr" => "ts",
                                                            "day" => common::dropdown("day",date("d",$get['datum'])),
                                                            "month" => common::dropdown("month",date("m",$get['datum'])),
                                                            "year" => common::dropdown("year",date("Y",$get['datum']))));

            $timeshift_time = show(_dropdown_time_ts, array("nr" => "ts",
                                                            "hour" => common::dropdown("hour",date("H",$get['datum'])),
                                                            "minute" => common::dropdown("minute",date("i",$get['datum'])),
                                                            "uhr" => _uhr));
        }

        $newsimage = ""; $delnewspic = "";
        foreach(array("jpg", "gif", "png") as $tmpendung) {
            if(file_exists(basePath."/inc/images/uploads/news/".$get['id'].".".$tmpendung)) {
                $newsimage = common::img_size('inc/images/uploads/news/'.$get['id'].'.'.$tmpendung)."<br /><br />";
                $delnewspic = '<a href="?admin=newsadmin&do=delnewspic&id='.$get['id'].'">'._newspic_del.'</a><br /><br />';
                break;
            }
        }

        $show = show($dir."/news_form", array("head" => _admin_news_edit_head,
                                              "autor" => common::autor($get['autor']),
                                              "n_newspic" => $newsimage,
                                              "delnewspic" => $delnewspic,
                                              "kat" => $kat,
                                              "all_disabled" => "",
                                              "do" => "edit",
                                              "titel" => stringParser::decode($get['titel']),
                                              "newstext" => stringParser::decode($get['text']),
                                              "morenews" => stringParser::decode($get['more']),
                                              "link1" => stringParser::decode($get['link1']),
                                              "link2" => stringParser::decode($get['link2']),
                                              "link3" => stringParser::decode($get['link3']),
                                              "url1" => stringParser::decode($get['url1']),
                                              "url2" => stringParser::decode($get['url2']),
                                              "url3" => stringParser::decode($get['url3']),
                                              "dropdown_date" => $dropdown_date,
                                              "dropdown_time" => $dropdown_time,
                                              "timeshift_date" => $timeshift_date,
                                              "timeshift_time" => $timeshift_time,
                                              "timeshift" => $timeshift,
                                              "error" => "",
                                              "button" => _button_value_edit,
                                              "intern" => $int,
                                              "sticky" => $sticky));
    break;
    case 'public':
        if(isset($_GET['what']) && $_GET['what'] == 'set')
            common::$sql['default']->update("UPDATE `{prefix_news}` SET `public` = '1', `datum`  = '".time()."' WHERE id = '".intval($_GET['id'])."'");
        else
            common::$sql['default']->update("UPDATE `{prefix_news}` SET `public` = '0' WHERE id = '".intval($_GET['id'])."'");

        header("Location: ?admin=newsadmin");
    break;
    case 'delete':
        common::$sql['default']->delete("DELETE FROM `{prefix_news}` WHERE id = '".intval($_GET['id'])."'");
        common::$sql['default']->delete("DELETE FROM `{prefix_newscomments}` WHERE news = '".intval($_GET['id'])."'");

        //Remove Pic
        foreach(array("jpg", "gif", "png") as $tmpendung) {
            if(file_exists(basePath."/inc/images/uploads/news/".intval($_GET['id']).".".$tmpendung))
                @unlink(basePath."/inc/images/uploads/news/".intval($_GET['id']).".".$tmpendung);
        }

        //Remove minimize
        $files = common::get_files(basePath."/inc/images/uploads/news/",false,true,array("jpg", "gif", "png"));
        if($files) {
            foreach ($files as $file) {
                if(preg_match("#".intval($_GET['id'])."(.*?).(gif|jpg|jpeg|png)#",strtolower($file))!= FALSE) {
                    $res = preg_match("#".intval($_GET['id'])."_(.*)#",$file,$match);
                    if(file_exists(basePath."/inc/images/uploads/news/".intval($_GET['id'])."_".$match[1]))
                        @unlink(basePath."/inc/images/uploads/news/".intval($_GET['id'])."_".$match[1]);
                }
            }
        }

        notification::add_success(_news_deleted, "?admin=newsadmin",2);
    break;
    case 'delnewspic':
        //Remove Pic
        foreach(array("jpg", "gif", "png") as $tmpendung) {
            if(file_exists(basePath."/inc/images/uploads/news/".intval($_GET['id']).".".$tmpendung))
                @unlink(basePath."/inc/images/uploads/news/".intval($_GET['id']).".".$tmpendung);
        }

        //Remove minimize
        $files = common::get_files(basePath."/inc/images/uploads/news/",false,true,array("jpg", "gif", "png"));
        foreach ($files as $file) {
            if(preg_match("#".intval($_GET['id'])."(.*?).(gif|jpg|jpeg|png)#",strtolower($file))!= FALSE) {
                $res = preg_match("#".intval($_GET['id'])."_(.*)#",$file,$match);
                if(file_exists(basePath."/inc/images/uploads/news/".intval($_GET['id'])."_".$match[1]))
                    @unlink(basePath."/inc/images/uploads/news/".intval($_GET['id'])."_".$match[1]);
            }
        }

        $show = common::info(_newspic_deleted, "?admin=newsadmin&do=edit&id=".intval($_GET['id'])."");
    break;
    default:
        $entrys = common::cnt('{prefix_news}'); $show_ = '';
        $qry = common::$sql['default']->select("SELECT * FROM `{prefix_news}` ".common::orderby_sql(array("titel","datum","autor"), 'ORDER BY `public` ASC, `datum` DESC')."
                   LIMIT ".($page - 1)*settings::get('m_adminnews').",".settings::get('m_adminnews')."");
        foreach($qry as $get) {
            $edit = common::getButtonEditSingle($get['id'],"admin=".$admin."&amp;do=edit");
            $delete = show("page/button_delete_single", array("id" => $get['id'],
                                                              "action" => "admin=newsadmin&amp;do=delete",
                                                              "title" => _button_title_del,
                                                              "del" => _confirm_del_news));

            $titel = show(_news_show_link, array("titel" =>stringParser::decode(common::cut($get['titel'],settings::get('l_newsadmin'))), "id" => $get['id']));
            $intern = ($get['intern'] ? _votes_intern : '');
            $sticky = ($get['sticky'] ? _news_sticky : '');
            $datum = empty($get['datum']) ? _no_public : date("d.m.y H:i", $get['datum'])._uhr;
            $public = ($get['public'] ? '<a href="?admin=newsadmin&amp;do=public&amp;id='.$get['id'].'&amp;what=unset"><img src="../inc/images/public.gif" alt="" title="'._non_public.'" /></a>'
                    : '<a href="?admin=newsadmin&amp;do=public&amp;id='.$get['id'].'&amp;what=set"><img src="../inc/images/nonpublic.gif" alt="" title="'._public.'" /></a>');

            $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
            $show .= show($dir."/admin_show", array("date" => $datum,
                                                    "titel" => $titel,
                                                    "class" => $class,
                                                    "autor" => common::autor($get['autor']),
                                                    "intnews" => $intern,
                                                    "sticky" => $sticky,
                                                    "public" => $public,
                                                    "edit" => $edit,
                                                    "delete" => $delete));
        }

        if(empty($show))
            $show = '<tr><td colspan="3" class="contentMainSecond">'._no_entrys.'</td></tr>';

        $nav = common::nav($entrys,settings::get('m_adminnews'),"?admin=newsadmin".(isset($_GET['show']) ? $_GET['show'].common::orderby_nav() : common::orderby_nav()));
        $show = show($dir."/admin_news", array("head" => _news_admin_head,
                                               "nav" => $nav,
                                               "autor" => _autor,
                                               "titel" => _titel,
                                               "val" => "newsadmin",
                                               "date" => _datum,
                                               "show" => $show,
                                               "order_autor" => common::orderby('autor'),
                                               "order_date" => common::orderby('datum'),
                                               "order_titel" => common::orderby('titel'),
                                               "edit" => _editicon_blank,
                                               "delete" => _deleteicon_blank,
                                               "add" => _admin_news_head));
    break;
}