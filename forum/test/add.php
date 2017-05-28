<?php
if(!common::$chkMe) {
    $index = common::error(_error_unregistered,1);
} else {
    if(!common::ipcheck("fid(".$_SESSION['kid'].")", settings::get('f_forum')))  {
        $lastpost = '';
        $checks = common::$sql['default']->fetch("SELECT s2.`id`,s1.`intern` FROM `{prefix_forumkats}` AS s1 LEFT JOIN `{prefix_forumsubkats}` AS s2 ON s2.`sid` = s1.`id` WHERE s2.`id` = ?;",
              [$_SESSION['kid']]);

        if(common::$sql['default']->rows("SELECT `id` FROM `{prefix_forumthreads}` WHERE `id` = ? AND `closed` = 1;",
            [(int)($_GET['id'])])) {
            $index = common::error(_error_forum_closed);
        } elseif($checks['intern'] && !common::permission("intforum") && !common::forum_intern($checks['id'])) {
            $index = common::error(_error_no_access);
        } else {
            $postnick = ""; $postemail = "";
            if(common::$userid >= 1) {
                $postnick = stringParser::decode(common::data("nick"));
                $postemail = stringParser::decode(common::data("email"));
            }

            //Zitat
            $zitat = "";
            if(isset($_GET['zitat'])) {
                $getzitat = common::$sql['default']->fetch("SELECT `nick`,`reg`,`text` FROM `{prefix_forumposts}` WHERE `id` = ?;",
                    array((int)($_GET['zitat'])));

                $nick = (!$getzitat['reg'] ? $getzitat['nick'] : common::autor($getzitat['reg']));
                $zitat = bbcode::zitat($nick, $getzitat['text']);
            } else if(isset($_GET['zitat_thread'])) {
                $getzitat = common::$sql['default']->fetch("SELECT `t_nick`,`t_reg`,`t_text` FROM `{prefix_forumthreads}` WHERE `id` = ?;",
                    array((int)($_GET['zitat_thread'])));

                $nick = (!$getzitat['t_reg'] ? $getzitat['t_nick'] : stringParser::decode(common::data("nick",$getzitat['t_reg'])));
                $zitat = bbcode::zitat($nick, $getzitat['t_text']);
            }

            //Show last post
            $getl = common::$sql['default']->fetch("SELECT * FROM `{prefix_forumposts}` WHERE `kid` = ? AND `sid` = ? ORDER BY `date` DESC;",
                [$_SESSION['kid'],(int)($_GET['id'])]);

            if(common::$sql['default']->rowCount()) {
                $sig = "";
                if(common::data("signatur",$getl['reg']))
                    $sig = _sig.bbcode::parse_html(common::data("signatur",$getl['reg']));

                //User Posts ( Uber Avatar )
                $userposts = '';
                if($getl['reg']) {
                    $smarty->caching = false;
                    $smarty->assign('posts',common::userstats("forumposts",$getl['reg']));
                    $userposts = $smarty->fetch('string:'._forum_user_posts);
                    $smarty->clearAllAssign();
                }

                //User Online check
                $onoff = ($getl['reg'] ? common::onlinecheck($getl['reg']) : '');

                $text = bbcode::parse_html($getl['text']);

                if(common::$chkMe == 4 || common::permission('ipban'))
                    $posted_ip = $getl['ip'];
                else
                    $posted_ip = _logged;

                $titel = show(_eintrag_titel_forum, array("postid" => (common::cnt("{prefix_forumposts}", " WHERE sid =".(int)($_GET['id']))+1),
                    "datum" => date("d.m.Y", $getl['date']),
                    "zeit" => date("H:i", $getl['date'])._uhr,
                    "url" => '#',
                    "edit" => "",
                    "delete" => ""));
                if($getl['reg'] != 0)
                {
                    $getu = common::$sql['default']->fetch("SELECT nick,hp,email FROM `{prefix_users}` WHERE id = '".$getl['reg']."'");

                    $email = common::CryptMailto(stringParser::decode($getu['email']),_emailicon_forum);
                    $pn = _forum_pn_preview;

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

                $smarty->caching = false;
                $smarty->assign('nick',common::cleanautor($getl['reg'], '', $getl['nick'], stringParser::decode($getl['email'])));
                $smarty->assign('postnr',"");
                $smarty->assign('p',($page-1*settings::get('m_fposts')));
                $smarty->assign('text',$text);
                $smarty->assign('class', 'class="commentsRight"');
                $smarty->assign('pn',$pn);
                $smarty->assign('hp',$hp);
                $smarty->assign('email',$email);
                $smarty->assign('status',common::getrank($getl['reg']));
                $smarty->assign('avatar',common::useravatar($getl['reg']));
                $smarty->assign('ip',$posted_ip);
                $smarty->assign('edited',stringParser::decode($getl['edited']));
                $smarty->assign('posts',$userposts);
                $smarty->assign('titel',$titel);
                $smarty->assign('signatur',$sig);
                $smarty->assign('zitat',$zitat);
                $smarty->assign('onoff',$onoff);
                $smarty->assign('lp',common::cnt("{prefix_forumposts}", " WHERE `sid` = ?",'id',[(int)($_GET['id'])])+1);
                $lastpost = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/forum_posts_show.tpl');
                $smarty->clearAllAssign();
            }

            if(empty($lastpost)) { //Show last forum thread ( if last post is empty )
                $gett = common::$sql['default']->fetch("SELECT * FROM `{prefix_forumthreads}`
                        WHERE kid = '".$_SESSION['kid']."'
                        AND id = '".(int)($_GET['id'])."'");

                if(common::data("signatur",$gett['t_reg'])) $sig = _sig.bbcode::parse_html(common::data("signatur",$gett['t_reg']));
                else $sig = "";

                if($gett['t_reg'] != "0")
                    $userposts = show(_forum_user_posts, array("posts" => common::userstats("forumposts",$gett['t_reg'])));
                else $userposts = "";

                if($gett['t_reg'] == "0") $onoff = "";
                else                      $onoff = common::onlinecheck($gett['t_reg']);

                $ftxt = hl($gett['t_text'], (isset($_GET['hl']) ? $_GET['hl'] : ''));
                if(isset($_GET['hl'])) $text = bbcode::parse_html($ftxt['text']);
                else $text = bbcode::parse_html($gett['t_text']);

                if(common::$chkMe == 4 || common::permission('ipban')) $posted_ip = $gett['ip'];
                else                 $posted_ip = _logged;

                $titel = show(_eintrag_titel_forum, array("postid" => "1",
                    "datum" => date("d.m.Y", $gett['t_date']),
                    "zeit" => date("H:i", $gett['t_date'])._uhr,
                    "url" => '#',
                    "edit" => "",
                    "delete" => ""));
                if($gett['t_reg'] != 0)
                {
                    $getu = common::$sql['default']->fetch("SELECT nick,hp,email FROM `{prefix_users}`
                          WHERE id = '".$gett['t_reg']."'");

                    $email = common::CryptMailto(stringParser::decode($getu['email']),_emailicon_forum);
                    $pn = show(_pn_write_forum, array("id" => $gett['t_reg'],"nick" => $getu['nick']));

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
                    $email = common::CryptMailto(stringParser::decode($gett['email']),_emailicon_forum);

                    //-> Homepage Link
                    $hp = "";
                    if (!empty($gett['t_hp'])) {
                        $smarty->caching = false;
                        $smarty->assign('hp',common::links(stringParser::decode($gett['t_hp'])));
                        $hp = $smarty->fetch('string:'._hpicon_forum);
                        $smarty->clearAllAssign();
                    }
                }

                $lastpost = show($dir."/forum_posts_show", array("nick" => common::cleanautor($gett['t_reg'], '', $gett['t_nick'], $gett['t_email']),
                    "postnr" => "",
                    "text" => $text,
                    "status" => common::getrank($gett['t_reg']),
                    "avatar" => common::useravatar($gett['t_reg']),
                    "pn" => $pn,
                    "class" => $ftxt['class'],
                    "hp" => $hp,
                    "email" => $email,
                    "titel" => $titel,
                    "ip" => $posted_ip,
                    "p" => ($page-1*settings::get('m_fposts')),
                    "edited" => stringParser::decode($gett['edited']),
                    "posts" => $userposts,
                    "date" => _posted_by.date("d.m.y H:i", $gett['t_date'])._uhr,
                    "signatur" => $sig,
                    "zitat" => "",
                    "onoff" => $onoff,
                    "top" => "",
                    "lp" => common::cnt("{prefix_forumposts}", " WHERE sid = '".(int)($_GET['id'])."'")+1));
            }

            $gett = common::$sql['default']->fetch("SELECT `topic` FROM `{prefix_forumthreads}` WHERE `kid` = ? AND `id` = ?;",
                [$_SESSION['kid'],(int)($_GET['id'])]);
            $where = $where.' - '.stringParser::decode($gett['topic']);

            $smarty->caching = false;
            $smarty->assign('zitat',$zitat);
            $smarty->assign('lastpost',$lastpost);
            $smarty->assign('from',common::editor_is_reg());
            $smarty->assign('br1','');
            $smarty->assign('br2','');
            $smarty->assign('id',$_GET['id']);
            $smarty->assign('error','');
            $smarty->assign('posteintrag','');
            $index = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/post.tpl');
            $smarty->clearAllAssign();
        }
    } else {
        $smarty->caching = false;
        $smarty->assign('sek',settings::get('f_forum'));
        $error = $smarty->fetch('string:'._error_flood_post);
        $smarty->clearAllAssign();
        $index = common::error($error);
        unset($error);
    }
}