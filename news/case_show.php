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

if(defined('_News') && isset($_GET['id']) && !empty($_GET['id'])) {
    $news_id = (int)($_GET['id']); $add = ''; $notification_p = '';
    if (common::$sql['default']->fetch("SELECT `intern` FROM `{prefix_news}` WHERE `id` = ?;", [$news_id],'intern') && !common::permission("intnews")) {
        $index = common::error(_error_wrong_permissions, 1);
    } else {
        $get_news = common::$sql['default']->fetch("SELECT * FROM `{prefix_news}` WHERE `id` = ?".(common::permission("news") ? ";" : " AND public = 1;"), [$news_id]);
        if (!common::$sql['default']->rowCount()) {
            $index = common::error(_id_dont_exist, 1);
        } else {
            switch ($do) {
                case 'add':
                    if (common::$sql['default']->rows("SELECT `id` FROM `{prefix_news}` WHERE `id` = ?;", [$news_id]) != 0) {
                        if (!common::$chkMe) {
                            $index = common::error(_error_have_to_be_logged, 1);
                        } else {
                            if (!common::ipcheck("ncid(" . $news_id . ")", settings::get('f_newscom'))) {
                                if (empty($_POST['comment'])) {
                                    javascript::set('AnchorMove', 'comForm');
                                    if (empty($_POST['eintrag'])) {
                                        notification::add_error(_empty_eintrag,'news_tr');
                                    }
                                } else {
                                    common::$sql['default']->insert("INSERT INTO `{prefix_newscomments}` SET `news` = ?,`datum` = ?,`nick` = ?,`email` = ?,`hp` = ?,`reg` = ?,`comment` = ?, `ip` = ?;",
                                    [$news_id,time(),common::data('nick'),common::data('email'),
                                        (isset($_POST['hp']) && !common::$userid ? common::links($_POST['hp']) : common::links(common::data('hp'))),
                                        (int)(common::$userid),stringParser::encode($_POST['comment']),common::$userip]);
                                    common::setIpcheck("ncid(" . $news_id . ")");
                                    javascript::set('AnchorMove', 'notification-box');
                                    $_POST = []; //Clear Post
                                    notification::add_success(_comment_added,'news');
                                }
                            } else {
                                $smarty->caching = false;
                                $smarty->assign('sek',settings::get('f_newscom'));
                                $error = $smarty->fetch('string:'._error_flood_post);
                                $smarty->clearAllAssign();
                                notification::add_error($error,'news');
                                unset($error);
                            }
                        }
                    } else {
                        notification::add_error(_id_dont_exist,'news');
                    }
                    break;
                case 'delete':
                    javascript::set('AnchorMove', 'notification-box');
                    $reg = common::$sql['default']->fetch("SELECT `reg` FROM `{prefix_newscomments}` WHERE `id` = ?;", [($cid = (int)($_GET['cid']))],'reg');
                    if (common::$userid >= 1 && ($reg == common::$userid || common::permission('news'))) {
                        common::$sql['default']->delete("DELETE FROM `{prefix_newscomments}` WHERE `id` = ?;", [$cid]);
                        notification::add_success(_comment_deleted,'news');
                    } else {
                        notification::add_error(_error_wrong_permissions,'news');
                    }
                    break;
                case 'editcom':
                    javascript::set('AnchorMove', 'notification-box');
                    $reg = common::$sql['default']->fetch("SELECT `reg` FROM `{prefix_newscomments}` WHERE `id` = ?;", [($cid = (int)($_GET['cid']))],'reg');
                    if (common::$sql['default']->rowCount() && !empty($_POST['comment'])) {
                        if (common::$userid >= 1 && ($reg == common::$userid || common::permission('news'))) {
                            //-> Editby Text
                            $smarty->caching = false;
                            $smarty->assign('autor',common::autor(common::$userid));
                            $smarty->assign('time',date("d.m.Y H:i", time()));
                            $editedby = $smarty->fetch('string:'._edited_by);
                            $smarty->clearAllAssign();

                            common::$sql['default']->update("UPDATE `{prefix_newscomments}` SET `nick` = ?, `email` = ?, `hp` = ?, `comment` = ?, `editby` = ?
                                          WHERE `id` = ?;", [(isset($_POST['nick']) ? stringParser::encode($_POST['nick']) : ''),
                                          (isset($_POST['email']) ? stringParser::encode($_POST['email']) : ''),
                                          (isset($_POST['hp']) ? common::links($_POST['hp']) : ''),
                                          (isset($_POST['comment']) ? stringParser::encode($_POST['comment']) : ''),
                                          stringParser::encode($editedby),$cid]);

                            $_POST = []; //Clear Post
                            notification::add_success(_comment_edited,'news');
                        } else {
                            notification::add_error(_error_edit_post,'news');
                        }
                    } else {
                        notification::add_error(_empty_eintrag,'news');
                    }
                    break;
                case 'edit':
                    $get = common::$sql['default']->fetch("SELECT `id`,`reg`,`comment` FROM `{prefix_newscomments}` WHERE `id` = ?;", [(int)($_GET['cid'])]);
                    if (common::$userid >= 1 && ($get['reg'] == common::$userid || common::permission('news'))) {
                        javascript::set('AnchorMove', 'comForm');

                        $smarty->caching = false;
                        $smarty->assign('nick',common::autor($get['reg']));
                        $smarty->assign('action','?action=show&amp;do=editcom&amp;id=' . $news_id .'&amp;cid=' . (int)($_GET['cid']));
                        $smarty->assign('prevurl','../news/?action=compreview&do=edit&id=' . $news_id .'&cid=' . (int)($_GET['cid']));
                        $smarty->assign('id',$get['id']);
                        $smarty->assign('posteintrag',stringParser::decode($get['comment']));
                        $smarty->assign('notification',notification::get('news',true));
                        $add = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/comments_edit.tpl');
                        $smarty->clearAllAssign();
                    } else {
                        javascript::set('AnchorMove', 'notification-box');
                        notification::add_error(_error_edit_post,'news');
                    }

                    break;
            }

            /************************
             * View News
             ************************/
            //Update viewed
            if (common::count_clicks('news', $news_id)) {
                common::$sql['default']->update("UPDATE `{prefix_news}` SET `viewed` = (viewed+1) WHERE `id` = ?;", [$news_id]);
            }

            //News Comments
            $qryc = common::$sql['default']->select("SELECT * FROM `{prefix_newscomments}` WHERE `news` = ? "
                                ."ORDER BY `datum` DESC LIMIT ".($page - 1)*settings::get('m_comments').",".settings::get('m_comments').";",
                                [$news_id]);
            
            $entrys = common::cnt('{prefix_newscomments}', " WHERE `news` = ?","id",[$news_id]);
            $i = ($entrys - ($page - 1) * settings::get('m_comments')); $comments = '';
            foreach($qryc as $getc) {
                $edit = ""; $delete = "";
                if ((common::$chkMe >= 1 && $getc['reg'] == common::$userid) || common::permission("news")) {
                    $smarty->caching = true;
                    $smarty->assign('action',"?action=show&amp;do=edit&amp;cid=" . $getc['id']."&amp;id=".$get_news['id']);
                    $smarty->assign('title',_button_title_edit);
                    $smarty->assign('idir','../inc/images');
                    $edit = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/button_edit.tpl',
                        common::getSmartyCacheHash('_button_edit_'.$get_news['id'].'_cid_'.$getc['id']));
                    $smarty->clearAllAssign();

                    $smarty->caching = true;
                    $smarty->assign('id',$get_news['id']);
                    $smarty->assign('action',"?action=show&amp;do=delete&amp;cid=".$getc['id']."&amp;id=".$get_news['id']);
                    $smarty->assign('title',_button_title_del);
                    $smarty->assign('del',_confirm_del_entry);
                    $smarty->assign('idir','../inc/images');
                    $delete = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/button_delete.tpl',
                        common::getSmartyCacheHash('_button_delete_'.$get_news['id'].'_cid_'.$getc['id']));
                    $smarty->clearAllAssign();
                }

                $email = ""; $hp = ""; $avatar = ""; $onoff = "";
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

                $smarty->caching = false;
                $smarty->assign('postid',$i);
                $smarty->assign('datum',date("d.m.Y", $getc['datum']));
                $smarty->assign('zeit',date("H:i", $getc['datum']));
                $smarty->assign('edit',$edit);
                $smarty->assign('delete',$delete);
                $titel = $smarty->fetch('string:'._eintrag_titel);
                $smarty->clearAllAssign();

                $posted_ip = (common::$chkMe == 4 || common::permission('ipban') ? $getc['ip'] : _logged);
                $smarty->caching = true;
                $smarty->assign('titel',$titel);
                $smarty->assign('comment',bbcode::parse_html($getc['comment']));
                $smarty->assign('nick',$nick);
                $smarty->assign('hp',$hp);
                $smarty->assign('editby',bbcode::parse_html($getc['editby']));
                $smarty->assign('email',$email);
                $smarty->assign('avatar',common::useravatar($getc['reg']));
                $smarty->assign('onoff',$onoff);
                $smarty->assign('rank',common::getrank($getc['reg']));
                $smarty->assign('ip',$posted_ip);
                $comments .= $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/comments_show.tpl',common::getSmartyCacheHash('news_comments_'.$getc['id']));
                $smarty->clearAllAssign();
                $i--;
            }

            if (settings::get("reg_newscomments") && !common::$chkMe) {
                $add = _error_unregistered_nc;
            } else {
                if (!common::ipcheck("ncid(".$_GET['id'].")", settings::get('f_newscom')) && empty($add)) {
                    $smarty->caching = false;
                    $smarty->assign('nick',common::autor(common::$userid));
                    $smarty->assign('action','../news/?action=show&amp;do=add&amp;id=' . (isset($_GET['id']) ? $_GET['id'] : '1'));
                    $smarty->assign('prevurl','../news/?action=compreview&id=' . (isset($_GET['id']) ? $_GET['id'] : '1'));
                    $smarty->assign('id',(isset($_GET['id']) ? $_GET['id'] : '1'));
                    $smarty->assign('posteintrag',(isset($_POST['comment']) ? $_POST['comment'] : ''));
                    $smarty->assign('notification',notification::get('news',true),true);
                    $add = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/comments_add.tpl');
                    $smarty->clearAllAssign();
                }
            }

            if(empty($comments)) {
                $smarty->caching = false;
                $smarty->assign('colspan',1);
                $comments = $smarty->fetch('string:'._no_entrys_yet);
                $smarty->clearAllAssign();
            }

            $seiten = common::nav($entrys, settings::get('m_comments'), "?action=show&amp;id=" . $_GET['id'] . "");
            $smarty->caching = false;
            $smarty->assign('show',$comments);
            $smarty->assign('seiten',$seiten);
            $smarty->assign('add',$add);
            $showmore = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/comments.tpl');
            $smarty->clearAllAssign();

            $links1 = '';
            if(!empty($get_news['url1'])) {
                $smarty->caching = false;
                $smarty->assign('link',stringParser::decode($get_news['link1']));
                $smarty->assign('url',utf8_decode($get_news['url1']));
                $smarty->assign('target',"_blank");
                $links1 = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/news_link.tpl');
                $smarty->clearAllAssign();
            }

            $links2 = '';
            if(!empty($get_news['url2'])) {
                $smarty->caching = false;
                $smarty->assign('link',stringParser::decode($get_news['link2']));
                $smarty->assign('url',utf8_decode($get_news['url2']));
                $smarty->assign('target',"_blank");
                $links2 = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/news_link.tpl');
                $smarty->clearAllAssign();
            }

            $links3 = '';
            if(!empty($get_news['url3'])) {
                $smarty->caching = false;
                $smarty->assign('link',stringParser::decode($get_news['link3']));
                $smarty->assign('url',utf8_decode($get_news['url3']));
                $smarty->assign('target',"_blank");
                $links3 = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/news_link.tpl');
                $smarty->clearAllAssign();
            }
            
            $links = '';
            if (!empty($links1) || !empty($links2) || !empty($links3)) {
                $smarty->caching = true;
                $smarty->assign('link1',$links1);
                $smarty->assign('link2',$links2);
                $smarty->assign('link3',$links3);
                $links = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/news_links.tpl',md5('news_links_'.$get_news['id']));
                $smarty->clearAllAssign();
            }

            $intern = $get_news['intern'] ? _votes_intern : "";
            $newsimage = '../inc/images/uploads/newskat/'.common::$sql['default']->fetch("SELECT `katimg` FROM `{prefix_newskat}` WHERE `id` = ?;", [$get_news['kat']],'katimg');
            foreach (["jpg", "gif", "png"] as $tmpendung) {
                if (file_exists(basePath . "/inc/images/uploads/news/".$get_news['id'].".".$tmpendung)) {
                    $newsimage = '../inc/images/uploads/news/'.$get_news['id'].'.'.$tmpendung;
                    break;
                }
            }

            //-> News [Caching]
            $where = $where." - ".stringParser::decode($get_news['titel']);
            $smarty->caching = true;
            $smarty->assign('titel',stringParser::decode($get_news['titel']));
            $smarty->assign('kat',$newsimage);
            $smarty->assign('id',$get_news['id']);
            $smarty->assign('comments',common::cnt('{prefix_newscomments}', " WHERE `news` = ?","id",[$get_news['id']]));
            $smarty->assign('sticky','');
            $smarty->assign('intern',$intern);
            $smarty->assign('showmore',$showmore,true); //Comments
            $smarty->assign('more',bbcode::parse_html($get_news['more']));
            $smarty->assign('text',bbcode::parse_html($get_news['text']));
            $smarty->assign('datum',date("j.m.y H:i", (empty($get_news['datum']) ? time() : $get_news['datum'])));
            $smarty->assign('links',$links);
            $smarty->assign('autor',common::autor($get_news['autor']));
            $index = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/news_show_full.tpl',common::getSmartyCacheHash('news_full_'.$get_news['id']));
            $smarty->clearAllAssign();
        }
    }
}