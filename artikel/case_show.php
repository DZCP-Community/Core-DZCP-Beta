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

if(defined('_Artikel') && isset($_GET['id']) && !empty($_GET['id'])) {
    $artikel_id = intval($_GET['id']); $add = ''; $notification_p = '';
    if (!common::$sql['default']->fetch("SELECT `public` FROM `{prefix_artikel}` WHERE `id` = ?;", [$artikel_id],'public') && !common::permission("artikel")) {
        $index = common::error(_error_wrong_permissions, 1);
    } else {
        $get_artikel = common::$sql['default']->fetch("SELECT * FROM `{prefix_artikel}` WHERE `id` = ?".(common::permission("artikel") ? ";" : " AND public = 1;"), [$artikel_id]);
        if (!common::$sql['default']->rowCount()) {
            $index = common::error(_id_dont_exist, 1);
        } else {
            switch ($do) {
                case 'add':
                    if (common::$sql['default']->rows("SELECT `id` FROM `{prefix_artikel}` WHERE `id` = ?;", [$artikel_id]) != 0) {
                        if (settings::get("reg_artikel") && !common::$chkMe) {
                            $index = common::error(_error_have_to_be_logged, 1);
                        } else {
                            if (!common::ipcheck("artid(" . $_GET['id'] . ")", settings::get('f_artikelcom'))) {
                                if (common::$userid >= 1) {
                                    $toCheck = empty($_POST['comment']);
                                } else {
                                    $toCheck = empty($_POST['nick']) || empty($_POST['email']) || empty($_POST['comment']) || !common::check_email($_POST['email']) || !common::$securimage->check($_POST['secure']);
                                }

                                if ($toCheck) {
                                    javascript::set('AnchorMove', 'startpage');
                                    if (common::$userid >= 1) {
                                        if (empty($_POST['eintrag'])) {
                                            notification::add_error(_empty_eintrag);
                                        }

                                        $form = show("page/editor_regged", ["nick" => common::autor(common::$userid)]);
                                    } else {
                                        if (empty($_POST['nick'])) {
                                            notification::add_error(_empty_nick);
                                        } else if (empty($_POST['email'])) {
                                            notification::add_error(_empty_email);
                                        } else if (!common::check_email($_POST['email'])) {
                                            notification::add_error(_error_invalid_email);
                                        } else if (empty($_POST['eintrag'])) {
                                            notification::add_error(_empty_eintrag);
                                        } else if (!common::$securimage->check($_POST['secure'])) {
                                            notification::add_error(captcha_mathematic ? _error_invalid_regcode_mathematic : _error_invalid_regcode);
                                        }

                                        $form = show("page/editor_notregged", ["posthp" => (isset($_POST['hp']) ? $_POST['hp'] : ''),
                                                                                    "postemail" => (isset($_POST['email']) ? $_POST['email'] : ''),
                                                                                    "postnick" => (isset($_POST['nick']) ? $_POST['nick'] : '')]);
                                    }
                                } else {
                                    common::$sql['default']->insert("INSERT INTO `{prefix_acomments}` SET `artikel` = ?,`datum` = ?,`nick` = ?,`email` = ?,`hp` = ?,`reg` = ?,`comment` = ?, `ip` = ?;",
                                    [$artikel_id,time(),(isset($_POST['nick']) && !common::$userid ? stringParser::encode($_POST['nick']) : common::data('nick')),(isset($_POST['email']) && !common::$userid ? stringParser::encode($_POST['email']) : common::data('email')),
                                    (isset($_POST['hp']) && !common::$userid ? stringParser::encode(common::links($_POST['hp'])) : stringParser::encode(common::links(stringParser::decode(common::data('hp'))))),intval(common::$userid),stringParser::encode($_POST['comment']),common::$userip]);
                                    common::setIpcheck("artid(" . $artikel_id . ")");
                                    notification::set_global(false);
                                    javascript::set('AnchorMove', 'notification-box');
                                    $_POST = []; //Clear Post
                                    $notification_p = notification::add_success(_comment_added);
                                    notification::set_global(true);
                                }
                            } else {
                                notification::add_error(show(_error_flood_post, ["sek" => settings::get('f_newscom')]));
                            }
                        }
                    } else {
                        notification::add_error(_id_dont_exist);
                    }
                    break;
                case 'delete':
                    javascript::set('AnchorMove', 'notification-box');
                    notification::set_global(false);
                    $reg = common::$sql['default']->fetch("SELECT `reg` FROM `{prefix_acomments}` WHERE `id` = ?;", [($cid = intval($_GET['cid']))],'reg');
                    if ($reg == common::$userid || common::permission('artikel')) {
                        common::$sql['default']->delete("DELETE FROM `{prefix_acomments}` WHERE `id` = ?;", [$cid]);
                        $notification_p = notification::add_success(_comment_deleted);
                    } else {
                        $notification_p = notification::add_error(_error_wrong_permissions);
                    }

                    notification::set_global(true);
                    break;
                case 'editcom':
                    notification::set_global(false);
                    javascript::set('AnchorMove', 'notification-box');
                    $reg = common::$sql['default']->fetch("SELECT `reg` FROM `{prefix_acomments}` WHERE `id` = ?;", [($cid = intval($_GET['cid']))],'reg');
                    if (common::$sql['default']->rowCount() && !empty($_POST['comment'])) {
                        if ($reg == common::$userid || common::permission('artikel')) {
                            //-> Editby Text
                            $smarty->caching = false;
                            $smarty->assign('autor',common::autor(common::$userid));
                            $smarty->assign('time',date("d.m.Y H:i", time()));
                            $editedby = $smarty->fetch('string:'._edited_by);
                            $smarty->clearAllAssign();

                            common::$sql['default']->update("UPDATE `{prefix_acomments}` SET `nick` = ?, `email` = ?, `hp` = ?, `comment` = ?, `editby` = ?
                                          WHERE `id` = ?;", [(isset($_POST['nick']) ? stringParser::encode($_POST['nick']) : ''),
                                          (isset($_POST['email']) ? stringParser::encode($_POST['email']) : ''),
                                          (isset($_POST['hp']) ? stringParser::encode(common::links($_POST['hp'])) : ''),
                                          (isset($_POST['comment']) ? stringParser::encode($_POST['comment']) : ''),
                                          stringParser::encode($editedby),$cid]);

                            $_POST = []; //Clear Post
                            $notification_p = notification::add_success(_comment_edited);
                        } else {
                            $notification_p = notification::add_error(_error_edit_post);
                        }
                    } else {
                        $notification_p = notification::add_error(_empty_eintrag);
                    }

                    notification::set_global(true);
                    break;
                case 'edit':
                    $get = common::$sql['default']->fetch("SELECT `reg`,`comment`,`hp`,`email`,`nick` FROM `{prefix_newscomments}` WHERE `id` = ?;", [intval($_GET['cid'])]);
                    if ($get['reg'] == common::$userid || common::permission('artikel')) {
                        javascript::set('AnchorMove', 'comForm');
                        if ($get['reg'] != 0) {
                            $form = show("page/editor_regged", ["nick" => common::autor($get['reg']), "von" => _autor]);
                        } else {
                            $form = show("page/editor_notregged", ["posthp" => stringParser::decode($get['hp']), "postemail" => stringParser::decode($get['email']), "postnick" => stringParser::decode($get['nick'])]);
                        }

                        $add = show("page/comments_add", ["titel" => _comments_edit,
                                                               "form" => $form,
                                                               "what" => _button_value_edit,
                                                               "prevurl" => '../artikel/?action=compreview&do=edit&id=' . $_GET['id'] . '&cid=' . $_GET['cid'],
                                                               "action" => '?action=show&amp;do=editcom&amp;id=' . $_GET['id'] . '&amp;cid=' . $_GET['cid'],
                                                               "id" => (isset($_GET['id']) ? $_GET['id'] : '1'),
                                                               "posteintrag" => stringParser::decode($get['comment'])]);
                    } else {
                        javascript::set('AnchorMove', 'notification-box');
                        notification::set_global(false);
                        $notification_p = notification::add_error(_error_edit_post);
                        notification::set_global(true);
                    }

                    break;
            }

            /************************
             * View Artikel
             ************************/
            //Update viewed
            if (common::count_clicks('artikel', $artikel_id)) {
                common::$sql['default']->update("UPDATE `{prefix_artikel}` SET `viewed` = (viewed+1) WHERE `id` = ?;", [$artikel_id]);
            }
            
            $viewed = show(_news_viewed, ["viewed" => $get_artikel['viewed']]);
            $links1 = ""; $rel = "";
            if (!empty($get_artikel['url1'])) {
                $rel = _related_links;
                $links1 = show(_artikel_link, ["link" => stringParser::decode($get_artikel['link1']),
                                                    "url" => $get_artikel['url1']]);
            }

            $links2 = "";
            if (!empty($get_artikel['url2'])) {
                $rel = _related_links;
                $links2 = show(_artikel_link, ["link" => stringParser::decode($get_artikel['link2']),
                                                    "url" => $get_artikel['url2']]);
            }

            $links3 = "";
            if (!empty($get_artikel['url3'])) {
                $rel = _related_links;
                $links3 = show(_artikel_link, ["link" => stringParser::decode($get_artikel['link3']),
                                                    "url" => $get_artikel['url3']]);
            }

            $links = "";
            if (!empty($links1) || !empty($links2) || !empty($links3)) {
                $links = show(_artikel_links, ["link1" => $links1,
                                                    "link2" => $links2,
                                                    "link3" => $links3,
                                                    "rel" => $rel]);
            }

            //Artikel Comments
            $qryc = common::$sql['default']->select("SELECT * FROM `{prefix_acomments}` WHERE `artikel` = ? "
                                ."ORDER BY `datum` DESC LIMIT ".($page - 1)*settings::get('m_comments').",".settings::get('m_comments').";",
                                [$artikel_id]);

            $entrys = common::cnt('{prefix_acomments}', " WHERE `artikel` = ".$artikel_id);
            $i = ($entrys - ($page - 1) * settings::get('m_comments')); $comments = '';
            foreach($qryc as $getc) {
                $edit = ""; $delete = "";
                if ((common::$chkMe >= 1 && $getc['reg'] == common::$userid) || common::permission("artikel")) {
                    $edit = show("page/button_edit_single", ["id" => $get_artikel['id'],
                                                                  "action" => "action=show&amp;do=edit&amp;cid=" . $getc['id'],
                                                                  "title" => _button_title_edit]);

                    $delete = show("page/button_delete_single", ["id" => $get_artikel['id'],
                                                                      "action" => "action=show&amp;do=delete&amp;cid=" . $getc['id'],
                                                                      "title" => _button_title_del,
                                                                      "del" => _confirm_del_entry]);
                }

                $email = ""; $hp = "";
                $avatar = "";
                if (!$getc['reg']) {
                    //-> Homepage Link
                    $hp = "";
                    if (!empty($getc['hp'])) {
                        $smarty->caching = false;
                        $smarty->assign('hp',common::links(stringParser::decode($getc['hp'])));
                        $hp = $smarty->fetch('string:'._hpicon_forum);
                        $smarty->clearAllAssign();
                    }

                    if ($getc['email']) {
                        $email = '<br />' . common::CryptMailto(stringParser::decode($getc['email']), _emailicon_forum);
                    }

                    $smarty->caching = true;
                    $smarty->assign('nick',stringParser::decode($getc['nick']));
                    $smarty->assign('email',$email);
                    $nick = $smarty->fetch('string:'._link_mailto,common::getSmartyCacheHash('_link_mailto_'.$email.'_'.stringParser::decode($getc['nick'])));
                    $smarty->clearAllAssign();
                } else {
                    $onoff = common::onlinecheck($getc['reg']);
                    $nick = common::autor($getc['reg']);
                }

                $titel = show(_eintrag_titel, ["postid" => $i,
                                                    "datum" => date("d.m.Y", $getc['datum']),
                                                    "zeit" => date("H:i", $getc['datum']) . _uhr,
                                                    "edit" => $edit,
                                                    "delete" => $delete]);

                $posted_ip = (common::$chkMe == 4 || common::permission('ipban') ? $getc['ip'] : _logged);
                $comments .= show("page/comments_show", ["titel" => $titel,
                                                              "comment" => bbcode::parse_html($getc['comment']),
                                                              "nick" => $nick,
                                                              "hp" => $hp,
                                                              "editby" => bbcode::parse_html($getc['editby']),
                                                              "email" => $email,
                                                              "avatar" => common::useravatar($getc['reg']),
                                                              "onoff" => $onoff,
                                                              "rank" => common::getrank($getc['reg']),
                                                              "ip" => $posted_ip]);
                $i--;
            }

            if (settings::get("reg_artikel") && !common::$chkMe) {
                $add = _error_unregistered_nc;
            } else {
                if (empty($form)) {
                    if (common::$userid >= 1) {
                        $form = show("page/editor_regged", ["nick" => common::autor(common::$userid)]);
                    } else {
                        $form = show("page/editor_notregged", ["postnick" => '', "postemail" => '', "posthp" => '']);
                    }
                }

                if (!common::ipcheck("artid(".$_GET['id'].")", settings::get('f_artikelcom')) && empty($add)) {
                    $add = show("page/comments_add", ["titel" => _artikel_comments_write_head,
                                                           "form" => $form,
                                                           "what" => _button_value_add,
                                                           "action" => '?action=show&amp;do=add&amp;id=' . (isset($_GET['id']) ? $_GET['id'] : '1'),
                                                           "prevurl" => '../artikel/?action=compreview&id=' . (isset($_GET['id']) ? $_GET['id'] : '1'),
                                                           "id" => (isset($_GET['id']) ? $_GET['id'] : '1'),
                                                           "posteintrag" => (isset($_POST['comment']) ? $_POST['comment'] : '')]);
                }
            }

            $seiten = common::nav($entrys, settings::get('m_comments'), "?action=show&amp;id=" . $_GET['id'] . "");
            $showmore = show($dir . "/comments", ["head" => _comments_head,
                                                       "show" => $comments,
                                                       "seiten" => $seiten,
                                                       "add" => $add]);

            $artikelimage = '../inc/images/uploads/newskat/'.common::$sql['default']->fetch("SELECT `katimg` FROM `{prefix_newskat}` WHERE `id` = ?;", [$get_artikel['kat']],'katimg');
            foreach (["jpg", "gif", "png"] as $tmpendung) {
                if (file_exists(basePath . "/inc/images/uploads/artikel/".$get_artikel['id'].".".$tmpendung)) {
                    $artikelimage = '../inc/images/uploads/artikel/'.$get_artikel['id'].'.'.$tmpendung;
                    break;
                }
            }

            $where = $where." - ".stringParser::decode($get_artikel['titel']);
            $index = show($dir."/show_more", ["titel" => stringParser::decode($get_artikel['titel']),
                                                   "id" => $get_artikel['id'],
                                                   "comments" => "",
                                                   "display" => "inline",
                                                   "notification_page" => notification::get($notification_p),
                                                   "kat" => $artikelimage,
                                                   "showmore" => $showmore,
                                                   "viewed" => $viewed,
                                                   "text" => bbcode::parse_html($get_artikel['text']),
                                                   "datum" => date("j.m.y H:i", intval($get_artikel['datum']))._uhr,
                                                   "links" => $links,
                                                   "autor" => common::autor($get_artikel['autor'])]);
        }
    }
}