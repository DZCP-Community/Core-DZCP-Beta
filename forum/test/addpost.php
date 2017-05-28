<?php
$get_threadkid = common::$sql['default']->fetch("SELECT `id`,`kid` FROM `{prefix_forumthreads}` WHERE `id` = '".(int)$_GET['id']."'");
if(!common::$sql['default']->rowCount())
{
    $index = common::error(_id_dont_exist,1);
} else {
    if(!common::$chkMe)
    {
        $index = common::error(_error_unregistered,1);
    } else {
        $checks = common::$sql['default']->fetch("SELECT s2.id,s1.intern FROM `{prefix_forumkats}` AS s1
                                         LEFT JOIN `{prefix_forumsubkats}` AS s2
                                         ON s2.sid = s1.id
                                         WHERE s2.id = '".$_SESSION['kid']."'");

        if($checks['intern'] == 1 && !common::permission("intforum") && !common::forum_intern($checks['id'])) {
            exit();
        }

        if(common::$userid >= 1) $toCheck = empty($_POST['eintrag']);
        else $toCheck = empty($_POST['nick']) || empty($_POST['email']) || empty($_POST['eintrag']) || !common::check_email($_POST['email']) || !common::$securimage->check($_POST['secure']);

        if($toCheck)
        {
            if(empty($_POST['eintrag']))
                $error = _empty_eintrag;

            $error = show("errors/errortable", array("error" => $error));
            $getl = common::$sql['default']->fetch("SELECT * FROM `{prefix_forumposts}`
                                            WHERE kid = '".(int)($get_threadkid['kid'])."'
                                            AND sid = '".(int)($_GET['id'])."'
                                            ORDER BY date DESC");
            if(common::$sql['default']->rowCount())
            {
                if(common::data("signatur",$getl['reg'])) $sig = _sig.bbcode::parse_html(common::data("signatur",$getl['reg']));
                else $sig = "";

                if($getl['reg'] != "0") $userposts = show(_forum_user_posts, array("posts" => common::userstats("forumposts",$getl['reg'])));
                else $userposts = "";

                if($getl['reg'] == "0") $onoff = "";
                else $onoff = common::onlinecheck($getl['reg']);

                $ftxt = hl($getl['text'], $_GET['hl']);
                if($_GET['hl']) $text = bbcode::parse_html($ftxt['text']);
                else $text = bbcode::parse_html($getl['text']);

                if(common::$chkMe == 4 || common::permission('ipban')) $posted_ip = $getl['ip'];
                else $posted_ip = _logged;

                $titel = show(_eintrag_titel_forum, array("postid" => (common::cnt("{prefix_forumposts}", " WHERE sid = ".(int)($_GET['id']))+1),
                    "datum" => date("d.m.Y", $getl['date']),
                    "zeit" => date("H:i", $getl['date'])._uhr,
                    "url" => '#',
                    "edit" => "",
                    "delete" => ""));

                if($getl['reg'] != 0)
                {
                    $getu = common::$sql['default']->fetch("SELECT nick,hp,email FROM `{prefix_users}` WHERE id = '".$getl['reg']."'");

                    $email = common::CryptMailto(stringParser::decode($getu['email']),_emailicon_forum);
                    $pn = show(_pn_write_forum, array("id" => $getl['reg'],
                        "nick" => $getu['nick']));
                    //-> Homepage Link
                    $hp = "";
                    if (!empty($getu['hp'])) {
                        $smarty->caching = false;
                        $smarty->assign('hp',common::links(stringParser::decode($getu['hp'])));
                        $hp = $smarty->fetch('string:'._hpicon_forum);
                        $smarty->clearAllAssign();
                    }
                } else {
                    $pn = "";
                    $email = common::CryptMailto(stringParser::decode($getl['email']),_emailicon_forum);

                    //-> Homepage Link
                    $hp = "";
                    if (!empty($getl['hp'])) {
                        $smarty->caching = false;
                        $smarty->assign('hp',common::links(stringParser::decode($getl['hp'])));
                        $hp = $smarty->fetch('string:'._hpicon_forum);
                        $smarty->clearAllAssign();
                    }
                }

                $nick = common::autor($getl['reg'], '', $getl['nick'], stringParser::decode($getl['email']));
                if(!empty($_GET['hl']) && $_SESSION['search_type'] == 'autor')
                {
                    if(preg_match("#".$_GET['hl']."#i",$nick)) $ftxt['class'] = 'class="highlightSearchTarget"';
                }

                $lastpost = show($dir."/forum_posts_show", array("nick" => $nick,
                    "postnr" => "",
                    "text" => $text,
                    "status" => common::getrank($getl['reg']),
                    "avatar" => common::useravatar($getl['reg']),
                    "titel" => $titel,
                    "pn" => $pn,
                    "hp" => $hp,
                    "class" => $ftxt['class'],
                    "email" => $email,
                    "ip" => $posted_ip,
                    "p" => ($i+($page-1)*settings::get('m_fposts')),
                    "edited" => $getl['edited'],
                    "posts" => $userposts,
                    "signatur" => $sig,
                    "zitat" => "",
                    "onoff" => $onoff,
                    "top" => "",
                    "lp" => common::cnt("{prefix_forumposts}", " WHERE sid = '".(int)($_GET['id'])."'")+1));
            } else {
                $gett = common::$sql['default']->fetch("SELECT * FROM `{prefix_forumthreads}`
                                                WHERE kid = '".(int)($get_threadkid['kid'])."'
                                                AND id = '".(int)($_GET['id'])."'");

                if(common::data("signatur",$gett['t_reg'])) $sig = _sig.bbcode::parse_html(common::data("signatur",$gett['t_reg']));
                else $sig = "";

                if($gett['t_reg'] != "0") $userposts = show(_forum_user_posts, array("posts" => common::userstats("forumposts",$gett['t_reg'])));
                else $userposts = "";

                if($gett['t_reg'] == "0") $onoff = "";
                else $onoff = common::onlinecheck($gett['t_reg']);

                $ftxt = hl($gett['t_text'], $_GET['hl']);
                if($_GET['hl']) $text = bbcode::parse_html($ftxt['text']);
                else $text = bbcode::parse_html($gett['t_text']);

                if(common::$chkMe == 4 || common::permission('ipban')) $posted_ip = $gett['ip'];
                else $posted_ip = _logged;

                if($gett['t_reg'] != 0)
                {
                    $getu = common::$sql['default']->fetch("SELECT nick,hp,email FROM `{prefix_users}` WHERE id = '".$gett['t_reg']."'");

                    $email = common::CryptMailto(stringParser::decode($getu['email']),_emailicon_forum);
                    $pn = show(_pn_write_forum, array("id" => $gett['t_reg'], "nick" => $getu['nick']));

                    //-> Homepage Link
                    $hp = "";
                    if (!empty($getu['hp'])) {
                        $smarty->caching = false;
                        $smarty->assign('hp',common::links(stringParser::decode($getu['hp'])));
                        $hp = $smarty->fetch('string:'._hpicon_forum);
                        $smarty->clearAllAssign();
                    }
                } else {
                    $pn = "";
                    $email = common::CryptMailto(stringParser::decode($gett['t_email']),_emailicon_forum);

                    //-> Homepage Link
                    $hp = "";
                    if (!empty($gett['t_hp'])) {
                        $smarty->caching = false;
                        $smarty->assign('hp',common::links(stringParser::decode($gett['t_hp'])));
                        $hp = $smarty->fetch('string:'._hpicon_forum);
                        $smarty->clearAllAssign();
                    }
                }

                $nick = common::autor($gett['t_reg'], '', $gett['t_nick'], $gett['t_email']);
                if(!empty($_GET['hl']) && $_SESSION['search_type'] == 'autor')
                {
                    if(preg_match("#".$_GET['hl']."#i",$nick)) $ftxt['class'] = 'class="highlightSearchTarget"';
                }

                $lastpost = show($dir."/forum_posts_show", array("nick" => $nick,
                    "postnr" => "",
                    "text" => $text,
                    "status" => common::getrank($gett['t_reg']),
                    "avatar" => common::useravatar($gett['t_reg']),
                    "ip" => $posted_ip,
                    "pn" => $pn,
                    "class" => $ftxt['class'],
                    "hp" => $hp,
                    "email" => $email,
                    "edit" => "",
                    "p" => ($i+($page-1)*settings::get('m_fposts')),
                    "delete" => "",
                    "edited" => $gett['edited'],
                    "posts" => $userposts,
                    "date" => _posted_by.date("d.m.y H:i", $gett['t_date'])._uhr,
                    "signatur" => $sig,
                    "zitat" => "",
                    "onoff" => $onoff,
                    "top" => "",
                    "lp" => common::cnt("{prefix_forumposts}", " WHERE sid = '".(int)($_GET['id'])."'")+1));
            }

            $index = show($dir."/post", array("titel" => _forum_new_post_head,
                "nickhead" => _nick,
                "bbcodehead" => _bbcode,
                "emailhead" => _email,
                "zitat" => $zitat,
                "what" => _button_value_add,
                "preview" => _preview,
                "form" => common::editor_is_reg(array('reg'=>common::$userid)),
                "br1" => "",
                "br2" => "",
                "security" => _register_confirm,
                "lastpost" => $lastpost,
                "last_post" => _forum_lp_head,
                "id" => $_GET['id'],
                "id" => $_GET['id'],
                "ip" => _iplog_info,
                "kid" => $_SESSION['kid'],
                "postemail" => $_POST['email'],
                "posthp" => $_POST['hp'],
                "postnick" => stringParser::decode($_POST['nick']),
                "posteintrag" => stringParser::decode($_POST['eintrag']),
                "error" => $error,
                "eintraghead" => _eintrag));
        } else {
            $spam = 0;
            $getdp = common::$sql['default']->fetch("SELECT * FROM `{prefix_forumposts}`
                                             WHERE kid = '".(int)($get_threadkid['kid'])."'
                                             AND sid = '".(int)($_GET['id'])."'
                                             ORDER BY date DESC
                                             LIMIT 1");
            if(common::$sql['default']->rowCount())
            {
                if(common::$userid >= 1)
                {
                    if(common::$userid == $getdp['reg'] && settings::get('double_post')) $spam = 1;
                    else $spam = 0;
                } else {
                    if($_POST['nick'] == $getdp['nick'] && settings::get('double_post')) $spam = 1;
                    else $spam = 0;
                }
            } else {

                $gettdp = common::$sql['default']->fetch("SELECT * FROM `{prefix_forumthreads}`
                                    WHERE kid = '".(int)($get_threadkid['kid'])."'
                                    AND id = '".(int)($_GET['id'])."'");

                if(common::$userid >= 1)
                {
                    if(common::$userid == $gettdp['t_reg'] && settings::get('double_post')) $spam = 2;
                    else $spam = 0;
                } else {
                    if($_POST['nick'] == $gettdp['t_nick'] && settings::get('double_post')) $spam = 2;
                    else $spam = 0;
                }
            }

            if($spam == 1)
            {
                if(common::$userid >= 1) $fautor = common::autor(common::$userid);
                else $fautor = common::autor('', '', $_POST['nick'], $_POST['email']);

                $text = show(_forum_spam_text, array("autor" => $fautor,
                    "ltext" => addslashes($getdp['text']),
                    "ntext" => stringParser::encode($_POST['eintrag'])));

                common::$sql['default']->update("UPDATE `{prefix_forumthreads}`
                                                                                         SET `lp` = '".time()."'
                                    WHERE kid = '".$_SESSION['kid']."'
                                    AND id = '".(int)($_GET['id'])."'");

                common::$sql['default']->update("UPDATE `{prefix_forumposts}`
                                                 SET `date`   = '".time()."',
                                                         `text`   = '".$text."'
                                                 WHERE id = '".$getdp['id']."'");
            } elseif($spam == 2) {
                if(common::$userid >= 1) $fautor = common::autor(common::$userid);
                else $fautor = common::autor('', '', $_POST['nick'], $_POST['email']);

                $text = show(_forum_spam_text, array("autor" => $fautor,
                    "ltext" => addslashes($gettdp['t_text']),
                    "ntext" => stringParser::encode($_POST['eintrag'])));

                common::$sql['default']->update("UPDATE `{prefix_forumthreads}`
                                                 SET `lp`   = '".time()."',
                                                 `t_text`   = '".$text."',
                                                 `posts` = (posts+1) 
                                                 WHERE id = '".$gettdp['id']."'");
            } else {
                common::$sql['default']->insert("INSERT INTO `{prefix_forumposts}`
                                         SET `kid`   = '".(int)($get_threadkid['kid'])."',
                                                 `sid`   = '".(int)($_GET['id'])."',
                                                 `date`  = '".time()."',
                                                 `nick`  = '".stringParser::encode($_POST['nick'])."',
                                                 `email` = '".stringParser::encode($_POST['email'])."',
                                                 `reg`   = '".stringParser::encode(common::$userid)."',
                                                 `text`  = '".stringParser::encode($_POST['eintrag'])."',
                                                 `ip`    = '".common::$userip."'");

                common::$sql['default']->update("UPDATE `{prefix_forumthreads}`
                                                SET `lp`    = '".time()."',
                                                        `first` = '0',
                                                         `posts` = (posts+1) 
                                                WHERE id    = '".(int)($_GET['id'])."'");
            }

            common::setIpcheck("fid(".$get_threadkid['kid'].")");

            common::$sql['default']->update("UPDATE `{prefix_userstats}`
                                                SET `forumposts` = forumposts+1
                                                WHERE `user`       = '".common::$userid."'");


            send_forum_abo(false, (int)($_GET['id']),$_POST['eintrag']);

            $entrys = common::cnt("{prefix_forumposts}", " WHERE `sid` = ".(int)($_GET['id']));

            if($entrys == "0") $pagenr = "1";
            else $pagenr = ceil($entrys/settings::get('m_fposts'));

            $lpost = show(_forum_add_lastpost, array("id" => $entrys+1,
                "tid" => $_GET['id'],
                "page" => $pagenr));

            $index = common::info(_forum_newpost_successful, $lpost);
        }
    }
}