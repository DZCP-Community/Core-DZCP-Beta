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

if(defined('_Forum')) {
    if(common::$userid && common::$chkMe >= 1) {
        switch ($do) {
            case 'edit':
                $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_forumposts}` WHERE `id` = ?;", [(int)($_GET['id'])]);
                if (common::$sql['default']->rowCount() && ($get['reg'] == common::$userid || common::permission("forum"))) {
                    /*
                     * ########################################################
                     * POST
                     * ########################################################
                     */
                    if (array_key_exists('eintrag', $_POST)) {
                        if (!$get['reg']) {
                            //validation
                            common::$gump->validation_rules(array('eintrag' => 'required',
                                'nick' => 'required|alpha_numeric',
                                'email' => 'required|valid_email'));

                            //filter
                            common::$gump->filter_rules(array('eintrag' => 'trim',
                                'nick' => 'trim|sanitize_string',
                                'email' => 'trim|sanitize_email'));
                        } else {
                            //validation
                            common::$gump->validation_rules(array('eintrag' => 'required|min_len,1'));

                            //filter
                            common::$gump->filter_rules(array('eintrag' => 'trim'));
                        }

                        $validated_post_data = common::$gump->run($_POST);
                        if ($validated_post_data !== false && $get['id'] >= 1) {
                            //-> Editby Text
                            $smarty->caching = false;
                            $smarty->assign('autor', common::autor(common::$userid));
                            $smarty->assign('time', date("d.m.Y H:i", time()));
                            $editedby = $smarty->fetch('string:' . _edited_by);
                            $smarty->clearAllAssign();

                            if (!$get['reg']) {
                                common::$sql['default']->update("UPDATE `{prefix_forumposts}` SET `nick` = ?, `email`  = ?, `text` = ?, `hp` = ?, `edited` = ? WHERE `id` = ?;",
                                    [stringParser::encode($_POST['nick']), stringParser::encode($_POST['email']), stringParser::encode($_POST['eintrag']),
                                        stringParser::encode(common::links($_POST['hp'])), stringParser::encode($editedby), $get['id']]);
                            } else {
                                common::$sql['default']->update("UPDATE `{prefix_forumposts}` SET `text` = ?, `edited` = ? WHERE `id` = ?;",
                                    [stringParser::encode($_POST['eintrag']), stringParser::encode($editedby), $get['id']]);
                            }

                            send_forum_abo(false, $get['sid'], $_POST['eintrag'], true);

                            $entrys = common::cnt("{prefix_forumposts}", " WHERE `sid` = ?", "id", [$getp['sid']]);
                            $pagenr = !$entrys ? 1 : ceil($entrys / settings::get('m_fposts'));
                            $index = common::info(_forum_editpost_successful, '?action=showthread&amp;id=' . $getp['sid'] . '&amp;page=' . $pagenr . '#p' . ($entrys + 1));
                        } else {
                            DebugConsole::insert_info('forum/case_post.php', common::$gump->get_readable_errors(true));
                            //Errors
                            if (!isset($_POST['eintrag']) || empty($_POST['eintrag'])) {
                                notification::add_error(_empty_eintrag);
                            }

                            //Errors on reg is 0
                            if (!$get['reg']) {
                                if (!isset($_POST['nick']) || empty($_POST['nick'])) {
                                    notification::add_error(_empty_nick);
                                }

                                if (!isset($_POST['email']) || empty($_POST['email'])) {
                                    notification::add_error(_empty_email);
                                }
                            }
                        }
                    }

                    /*
                     * ########################################################
                     * EDITOR
                     * ########################################################
                     */

                    $smarty->caching = false;
                    $smarty->assign('is_edit', true);
                    $smarty->assign('zitat', '');
                    $smarty->assign('lastpost', '');
                    $smarty->assign('from', common::editor_is_reg($get));
                    $smarty->assign('br', false);
                    $smarty->assign('id', $get['id']);
                    $smarty->assign('notification', notification::get('global', true));
                    $smarty->assign('posteintrag', isset($_POST['eintrag']) ? stringParser::decode($_POST['eintrag']) : stringParser::decode($get['text']));
                    $index = $smarty->fetch('file:[' . common::$tmpdir . ']' . $dir . '/post.tpl');
                    $smarty->clearAllAssign();
                } else {
                    $index = common::error(_error_wrong_permissions);
                }
                break;
            case 'add':
                if (!common::$chkMe) {
                    $index = common::error(_error_unregistered, 1);
                } else {
                    common::$sql['default']->fetch("SELECT `id` FROM `{prefix_forumthreads}` WHERE `id` = ?;", [(int)$_GET['id']]);
                    if (!common::$sql['default']->rowCount()) {
                        $index = common::error(_id_dont_exist, 1);
                    } else {
                        if (!common::ipcheck("fid(" . $_SESSION['kid'] . ")", settings::get('f_forum'))) {
                            $lastpost = '';
                            $checks = common::$sql['default']->fetch("SELECT s2.`id`,s1.`intern` FROM `{prefix_forumkats}` AS s1 LEFT JOIN `{prefix_forumsubkats}` AS s2 ON s2.`sid` = s1.`id` WHERE s2.`id` = ?;",
                                [$_SESSION['kid']]);

                            if (common::$sql['default']->rows("SELECT `id` FROM `{prefix_forumthreads}` WHERE `id` = ? AND `closed` = 1;",
                                    [($id = (int)($_GET['id']))]) && common::$chkMe != 4 && !common::permission("forum")
                            ) {
                                $index = common::error(_error_forum_closed);
                            } elseif ($checks['intern'] && !common::permission("intforum") && !common::forum_intern($checks['id'])) {
                                $index = common::error(_error_no_access);
                            } else {
                                /*
                                 * ########################################################
                                 * POST
                                 * ########################################################
                                 */
                                if (array_key_exists('eintrag', $_POST)) {
                                    //validation
                                    common::$gump->validation_rules(array('eintrag' => 'required|min_len,1'));

                                    //filter
                                    common::$gump->filter_rules(array('eintrag' => 'trim'));

                                    $validated_post_data = common::$gump->run($_POST);
                                    if ($validated_post_data !== false && $id >= 1) {
                                        $getdp = common::$sql['default']->fetch("SELECT * FROM `{prefix_forumposts}` WHERE `kid` = ? AND `sid` = ? LIMIT 1;",
                                            [$_SESSION['kid'], $id]);

                                        $double_post = 0;
                                        if (common::$sql['default']->rowCount()) {
                                            $gettdp = array();
                                            if (common::$userid >= 1) {
                                                $double_post = (common::$userid == $getdp['reg'] && settings::get('double_post')) ? common::FORUM_DOUBLE_POST_TH_ADD : 0;
                                            } else {
                                                $double_post = (stringParser::encode($_POST['nick']) == $getdp['nick'] && settings::get('double_post')) ? common::FORUM_DOUBLE_POST_TH_ADD : 0;
                                            }
                                        } else {
                                            $gettdp = common::$sql['default']->fetch("SELECT * FROM `{prefix_forumthreads}` WHERE `kid` = ? AND `id` = ?;",
                                                [$_SESSION['kid'], $id]);

                                            if (common::$userid >= 1) {
                                                $double_post = (common::$userid == $gettdp['t_reg'] && settings::get('double_post')) ? common::FORUM_DOUBLE_POST_PO_ADD : 0;
                                            } else {
                                                $double_post = ($_POST['nick'] == $gettdp['t_nick'] && settings::get('double_post')) ? common::FORUM_DOUBLE_POST_PO_ADD : 0;
                                            }
                                        }

                                        switch ($double_post) {
                                            case common::FORUM_DOUBLE_POST_TH_ADD:
                                                $smarty->caching = false;
                                                $smarty->assign('autor', common::autor(common::$userid));
                                                $smarty->assign('ltext', stringParser::decode($getdp['text']));
                                                $smarty->assign('ntext', stringParser::encode($_POST['eintrag']));
                                                $text = $smarty->fetch('string:' . _forum_spam_text);
                                                $smarty->clearAllAssign();

                                                common::$sql['default']->update("UPDATE `{prefix_forumthreads}` SET `lp` = ? WHERE `kid` = ? AND `id` = ?;",
                                                    [time(), $_SESSION['kid'], $id]);
                                                common::$sql['default']->update("UPDATE `{prefix_forumposts}` SET `date` = ?, `text` = ? WHERE `id` = ?;",
                                                    [time(), $text, $getdp['id']]);
                                                unset($getdp, $text);
                                                break;
                                            case common::FORUM_DOUBLE_POST_PO_ADD:
                                                $smarty->caching = false;
                                                $smarty->assign('autor', common::autor(common::$userid));
                                                $smarty->assign('ltext', stringParser::decode($gettdp['t_text']));
                                                $smarty->assign('ntext', stringParser::encode($_POST['eintrag']));
                                                $text = $smarty->fetch('string:' . _forum_spam_text);
                                                $smarty->clearAllAssign();

                                                common::$sql['default']->update("UPDATE `{prefix_forumthreads}` SET `lp`= ?, `t_text` = ?, `posts` = (posts+1)  WHERE `id` = ?;",
                                                    [time(), $text, $gettdp['id']]);
                                                unset($gettdp, $text);
                                                break;
                                            default:
                                            case common::FORUM_DOUBLE_POST_INSERT:
                                                common::$sql['default']->insert("INSERT INTO `{prefix_forumposts}` SET `kid` = ?, `sid` = ?, `date` = ?, `nick` = ?,`email` = ?,`reg` = ?,`text` = ?,`ipv4`= ?;",
                                                    [$_SESSION['kid'], $id, time(), stringParser::encode($_POST['nick']), stringParser::encode($_POST['email']),
                                                        common::$userid, stringParser::encode($_POST['eintrag']), common::$userip['v4']]);

                                                common::$sql['default']->update("UPDATE `{prefix_forumthreads}` SET `lp` = ?,`first` = 0,`posts` = (posts+1) WHERE id = ?;",
                                                    [time(), $id]);
                                                break;
                                        }
                                        unset($double_post);

                                        common::setIpcheck("fid(" . $_SESSION['kid'] . ")");
                                        common::userstats_increase('forumposts');
                                        send_forum_abo(false, $id, $_POST['eintrag']);

                                        $entrys = common::cnt("{prefix_forumposts}", " WHERE `sid` = ?", "id", [$id]);
                                        $pagenr = !$entrys ? 1 : ceil($entrys / settings::get('m_fposts'));
                                        $index = common::info(_forum_newpost_successful, '?action=showthread&amp;id=' . $_GET['id'] . ($pagenr >= 2 ? '&amp;page=' . $pagenr : '') . '#p' . ($entrys + 1));
                                    } else {
                                        DebugConsole::insert_info('forum/case_post.php', common::$gump->get_readable_errors(true));
                                        //Errors
                                        if (!isset($_POST['eintrag']) || empty($_POST['eintrag'])) {
                                            notification::add_error(_empty_eintrag);
                                        }
                                    }
                                }

                                /*
                                 * ########################################################
                                 * EDITOR
                                 * ########################################################
                                 */

                                if (empty($index)) {
                                    $postnick = "";
                                    $postemail = "";
                                    if (common::$userid >= 1) {
                                        $postnick = stringParser::decode(common::data("nick"));
                                        $postemail = stringParser::decode(common::data("email"));
                                    }

                                    //Zitat
                                    $zitat = "";
                                    if (isset($_GET['zitat'])) {
                                        $getzitat = common::$sql['default']->fetch("SELECT `nick`,`reg`,`text` FROM `{prefix_forumposts}` WHERE `id` = ?;",
                                            array((int)($_GET['zitat'])));

                                        $nick = (!$getzitat['reg'] ? $getzitat['nick'] : common::autor($getzitat['reg']));
                                        $zitat = bbcode_base::zitat($nick, $getzitat['text']);
                                    } else if (isset($_GET['zitat_thread'])) {
                                        $getzitat = common::$sql['default']->fetch("SELECT `t_nick`,`t_reg`,`t_text` FROM `{prefix_forumthreads}` WHERE `id` = ?;",
                                            array((int)($_GET['zitat_thread'])));

                                        $nick = (!$getzitat['t_reg'] ? $getzitat['t_nick'] : stringParser::decode(common::data("nick", $getzitat['t_reg'])));
                                        $zitat = bbcode_base::zitat($nick, $getzitat['t_text']);
                                    }

                                    //Show last post
                                    $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_forumposts}` WHERE `kid` = ? AND `sid` = ? ORDER BY `date` DESC;",
                                        [$_SESSION['kid'], $id]);

                                    if (common::$sql['default']->rowCount()) {
                                        $sig = "";
                                        if (common::data("signatur", $get['reg']))
                                            $sig = _sig . bbcode_base::parse_html(common::data("signatur", $get['reg']));

                                        //User Posts ( Uber Avatar )
                                        $userposts = '';
                                        if ($get['reg']) {
                                            $smarty->caching = false;
                                            $smarty->assign('posts', common::userstats("forumposts", $get['reg']));
                                            $userposts = $smarty->fetch('string:' . _forum_user_posts);
                                            $smarty->clearAllAssign();
                                        }

                                        //User Online check
                                        $onoff = ($get['reg'] ? common::onlinecheck($get['reg']) : '');
                                        $posted_ip = (common::$chkMe == 4 || common::permission('ipban') ? $get['ip'] : _logged);

                                        //Titel
                                        $smarty->caching = false;
                                        $smarty->assign('postid', (common::cnt("{prefix_forumposts}", " WHERE sid = ?", "id", [$id]) + 1));
                                        $smarty->assign('datum', date("d.m.Y", $get['date']));
                                        $smarty->assign('zeit', date("H:i", $get['date']));
                                        $smarty->assign('url', '#');
                                        $smarty->assign('edit', "");
                                        $smarty->assign('delete', "");
                                        $titel = $smarty->fetch('string:' . _eintrag_titel_forum);
                                        $smarty->clearAllAssign();

                                        if ($get['reg']) {
                                            $getu = common::$sql['default']->fetch("SELECT `nick`,`hp`,`email` FROM `{prefix_users}` WHERE `id` = ?;", [$get['reg']]);
                                            $email = common::CryptMailto(stringParser::decode($getu['email']), _emailicon_forum);
                                            $pn = _forum_pn_preview;

                                            //-> Homepage Link
                                            $hp = "";
                                            if (!empty($getu['hp'])) {
                                                $smarty->caching = false;
                                                $smarty->assign('hp', common::links(stringParser::decode($getu['hp'])));
                                                $hp = $smarty->fetch('string:' . _hpicon_forum);
                                                $smarty->clearAllAssign();
                                            }
                                        } else {
                                            $pn = "";
                                            $email = common::CryptMailto(stringParser::decode($get['email']), _emailicon_forum);

                                            //-> Homepage Link
                                            $hp = "";
                                            if (!empty($get['hp'])) {
                                                $smarty->caching = false;
                                                $smarty->assign('hp', common::links(stringParser::decode($get['hp'])));
                                                $hp = $smarty->fetch('string:' . _hpicon_forum);
                                                $smarty->clearAllAssign();
                                            }
                                        }

                                        $class = 'class="commentsRight"';
                                        if (!empty($_GET['hl']) && $_SESSION['search_type'] == 'autor') {
                                            if (preg_match("#" . $_GET['hl'] . "#i", $nick))
                                                $class = 'class="highlightSearchTarget"';
                                        }

                                        $smarty->caching = false;
                                        $smarty->assign('nick', common::cleanautor($get['reg'], '', $get['nick'], stringParser::decode($get['email'])));
                                        $smarty->assign('chkme', common::$chkMe);
                                        $smarty->assign('postnr', "");
                                        $smarty->assign('p', ($page - 1 * settings::get('m_fposts')));
                                        $smarty->assign('text', bbcode_base::parse_html((string)$get['text']));
                                        $smarty->assign('class', $class);
                                        $smarty->assign('pn', $pn);
                                        $smarty->assign('hp', $hp);
                                        $smarty->assign('email', $email);
                                        $smarty->assign('status', common::getrank($get['reg']));
                                        $smarty->assign('avatar', common::useravatar($get['reg']));
                                        $smarty->assign('ip', $posted_ip);
                                        $smarty->assign('edited', stringParser::decode($get['edited']));
                                        $smarty->assign('posts', $userposts);
                                        $smarty->assign('titel', $titel);
                                        $smarty->assign('signatur', $sig);
                                        $smarty->assign('zitat', $zitat);
                                        $smarty->assign('onoff', $onoff);
                                        $smarty->assign('lp', common::cnt("{prefix_forumposts}", " WHERE `sid` = ?", 'id', [$id]) + 1);
                                        $lastpost = $smarty->fetch('file:[' . common::$tmpdir . ']' . $dir . '/forum_posts_show.tpl');
                                        $smarty->clearAllAssign();
                                    }

                                    if (empty($lastpost)) { //Show last forum thread ( if last post is empty )
                                        $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_forumthreads}` WHERE `kid` = ? AND `id` = ?;", [$_SESSION['kid'], $id]);
                                        $sig = (($signatur = common::data("signatur", $get['t_reg'])) ? _sig . bbcode_base::parse_html((string)$signatur) : '');

                                        //User Posts ( Uber Avatar )
                                        $userposts = '';
                                        if ($get['t_reg']) {
                                            $smarty->caching = false;
                                            $smarty->assign('posts', common::userstats("forumposts", $get['t_reg']));
                                            $userposts = $smarty->fetch('string:' . _forum_user_posts);
                                            $smarty->clearAllAssign();
                                        }

                                        //User Online check
                                        $onoff = ($get['t_reg'] ? common::onlinecheck($get['t_reg']) : '');

                                        $ftxt = hl($get['t_text'], (isset($_GET['hl']) ? $_GET['hl'] : ''));
                                        $text = isset($_GET['hl']) ? bbcode_base::parse_html((string)$ftxt['text']) : bbcode_base::parse_html((string)$get['t_text']);
                                        $posted_ip = common::$chkMe == 4 || common::permission('ipban') ? $get['ip'] : _logged;

                                        //Titel
                                        $smarty->caching = false;
                                        $smarty->assign('postid', '1');
                                        $smarty->assign('datum', date("d.m.Y", $get['t_date']));
                                        $smarty->assign('zeit', date("H:i", $get['t_date']));
                                        $smarty->assign('url', '#');
                                        $smarty->assign('edit', "");
                                        $smarty->assign('delete', "");
                                        $titel = $smarty->fetch('string:' . _eintrag_titel_forum);
                                        $smarty->clearAllAssign();

                                        if ($get['t_reg'] != 0) {
                                            $getu = common::$sql['default']->fetch("SELECT `nick`,`hp`,`email` FROM `{prefix_users}` WHERE `id` = ?;", [$get['t_reg']]);
                                            $email = common::CryptMailto(stringParser::decode($getu['email']), _emailicon_forum);

                                            //PM Link
                                            $smarty->caching = false;
                                            $smarty->assign('id', $get['t_reg']);
                                            $smarty->assign('nick', stringParser::decode($getu['nick']));
                                            $pn = $smarty->fetch('string:' . _pn_write_forum);
                                            $smarty->clearAllAssign();

                                            //-> Homepage Link
                                            $hp = "";
                                            if (!empty($getu['hp'])) {
                                                $smarty->caching = false;
                                                $smarty->assign('hp', common::links(stringParser::decode($getu['hp'])));
                                                $hp = $smarty->fetch('string:' . _hpicon_forum);
                                                $smarty->clearAllAssign();
                                            }
                                        } else {
                                            $pn = "";
                                            $email = common::CryptMailto(stringParser::decode($get['email']), _emailicon_forum);

                                            //-> Homepage Link
                                            $hp = "";
                                            if (!empty($get['t_hp'])) {
                                                $smarty->caching = false;
                                                $smarty->assign('hp', common::links(stringParser::decode($get['t_hp'])));
                                                $hp = $smarty->fetch('string:' . _hpicon_forum);
                                                $smarty->clearAllAssign();
                                            }
                                        }

                                        $smarty->caching = false;
                                        $smarty->assign('nick', common::cleanautor($get['t_reg'], '', $get['t_nick'], stringParser::decode($get['t_email'])));
                                        $smarty->assign('chkme', common::$chkMe);
                                        $smarty->assign('postnr', "");
                                        $smarty->assign('p', ($page - 1 * settings::get('m_fposts')));
                                        $smarty->assign('text', bbcode_base::parse_html((string)$get['t_text']));
                                        $smarty->assign('class', $ftxt['class']);
                                        $smarty->assign('pn', $pn);
                                        $smarty->assign('hp', $hp);
                                        $smarty->assign('email', $email);
                                        $smarty->assign('status', common::getrank($get['t_reg']));
                                        $smarty->assign('avatar', common::useravatar($get['t_reg']));
                                        $smarty->assign('ip', $posted_ip);
                                        $smarty->assign('edited', stringParser::decode($get['edited']));
                                        $smarty->assign('posts', $userposts);
                                        $smarty->assign('titel', $titel);
                                        $smarty->assign('signatur', $sig);
                                        $smarty->assign('zitat', '');
                                        $smarty->assign('onoff', $onoff);
                                        $smarty->assign('lp', common::cnt("{prefix_forumposts}", " WHERE `sid` = ?", 'id', [$id]) + 1);
                                        $lastpost = $smarty->fetch('file:[' . common::$tmpdir . ']' . $dir . '/forum_posts_show.tpl');
                                        $smarty->clearAllAssign();
                                    }

                                    unset($get, $hp, $text, $pn, $ftxt, $email, $titel, $posted_ip, $page, $userposts, $sig, $onoff);

                                    //Get topic for $where
                                    $topic = common::$sql['default']->fetch("SELECT `topic` FROM `{prefix_forumthreads}` WHERE `kid` = ? AND `id` = ?;",
                                        [$_SESSION['kid'], $id], 'topic');
                                    $where = $where . ' - ' . stringParser::decode($topic);
                                    unset($topic);

                                    $smarty->caching = false;
                                    $smarty->assign('is_edit', false);
                                    $smarty->assign('zitat', $zitat);
                                    $smarty->assign('lastpost', $lastpost);
                                    $smarty->assign('from', common::editor_is_reg());
                                    $smarty->assign('br', true);
                                    $smarty->assign('id', $_GET['id']);
                                    $smarty->assign('notification', notification::get('global', true));
                                    $smarty->assign('posteintrag', isset($_POST['eintrag']) ? stringParser::decode($_POST['eintrag']) : '');
                                    $index = $smarty->fetch('file:[' . common::$tmpdir . ']' . $dir . '/post.tpl');
                                    $smarty->clearAllAssign();
                                    unset($zitat, $lastpost);
                                }
                            }
                        } else {
                            $smarty->caching = false;
                            $smarty->assign('sek', settings::get('f_forum'));
                            $error = $smarty->fetch('string:' . _error_flood_post);
                            $smarty->clearAllAssign();
                            $index = common::error($error);
                            unset($error);
                        }
                    }
                }
                break;
            case 'delete':
                $get = common::$sql['default']->fetch("SELECT `id`,`reg`,`sid`,`kid` FROM `{prefix_forumposts}` WHERE `id` = ?;", [(int)($_GET['id'])]);
                if (common::$sql['default']->rowCount() && ($get['reg'] == common::$userid || common::permission("forum"))) {
                    //Update forumstats
                    common::$sql['default']->update("UPDATE `{prefix_forumthreads}` SET `posts` = (posts-1)  WHERE `id` = ?;", [$get['sid']]);

                    //Update userstats
                    common::$sql['default']->update("UPDATE `{prefix_userstats}`SET `forumposts` = (forumposts-1) WHERE `user` = ?;", [$get['reg']]);

                    //Delete post
                    common::$sql['default']->delete("DELETE FROM `{prefix_forumposts}` WHERE `id` = ?;", [$get['id']]);

                    //Update thread
                    $entrys = common::cnt("{prefix_forumposts}", " WHERE `sid` = ?", "id", [$get['sid']]);
                    if (!$entrys) {
                        common::$sql['default']->update("UPDATE `{prefix_forumthreads}` SET `first` = 1 WHERE `kid` = ?", [$get['kid']]);
                    }

                    $pagenr = !$entrys ? 1 : ceil($entrys / settings::get('m_fposts'));
                    $index = common::info(_forum_delpost_successful, '?action=showthread&amp;id=' . $get['sid'] . '&amp;page=' . $pagenr . '#p' . ($entrys + 1));
                }
                break;
        }
    } else {
        $index = common::error(_error_have_to_be_logged);
    }
}