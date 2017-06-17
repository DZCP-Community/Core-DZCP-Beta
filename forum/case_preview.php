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
    header("Content-type: text/html; charset=utf-8");
    switch (strtolower($_GET['what'])) {
        case 'thread':
            if(strtolower($_GET['do']) == 'addthread') {
                $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_forumthreads}` WHERE `id` = ?;",
                    [(int)($_GET['id'])]);

                if(!$get['t_reg'])
                    $guestCheck = false;
                else {
                    $guestCheck = true;
                    $pUId = $get['t_reg'];
                }

                //-> Editby Text
                if(isset($_POST[editby])) {
                    $smarty->caching = false;
                    $smarty->assign('autor', common::cleanautor(common::$userid));
                    $smarty->assign('time', date("d.m.Y H:i", time()));
                    $editedby = $smarty->fetch('string:' . _edited_by);
                    $smarty->clearAllAssign();
                }

                $tID = $get['id'];
            } else {
                $get['t_date'] = time();

                if(!common::$chkMe)
                    $guestCheck = false;
                else {
                    $guestCheck = true;
                    $pUId = common::$userid;
                }

                $tID = $_SESSION['kid'];
            }

            //Titel
            $smarty->caching = false;
            $smarty->assign('postid', 1);
            $smarty->assign('datum',date("d.m.Y", $get['t_date']));
            $smarty->assign('zeit',date("H:i", $get['t_date']));
            $smarty->assign('url','#');
            $smarty->assign('edit',"");
            $smarty->assign('delete',"");
            $titel = $smarty->fetch('string:'._eintrag_titel_forum);
            $smarty->clearAllAssign();

            if($guestCheck)
            {
                $getu = common::$sql['default']->fetch("SELECT nick,hp,email FROM `{prefix_users}` WHERE id = '".$pUId."'");
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

                if(common::data("signatur",$pUId))
                    $sig = _sig.bbcode_base::parse_html(common::data("signatur",$pUId));
                else
                    $sig = "";

                $onoff = common::onlinecheck(common::$userid);
                $smarty->caching = false;
                $smarty->assign('posts',common::userstats("forumposts",$pUId)+1);
                $userposts = $smarty->fetch('string:'._forum_user_posts);
                $smarty->clearAllAssign();
            } else {
                $pn = "";
                $email = common::CryptMailto($_POST['email'],_emailicon_forum);

                //-> Homepage Link
                $hp = "";
                if (!empty($_POST['hp'])) {
                    $smarty->caching = false;
                    $smarty->assign('hp',common::links($_POST['hp']));
                    $hp = $smarty->fetch('string:'._hpicon_forum);
                    $smarty->clearAllAssign();
                }
            }

            $getw = common::$sql['default']->fetch("SELECT s1.kid,s1.topic,s2.kattopic,s2.sid
                FROM `{prefix_forumthreads}` AS s1
                LEFT JOIN `{prefix_forumsubkats}` AS s2
                ON s1.kid = s2.id
                WHERE s1.id = '".(int)($tID)."'");

            //Breadcrumbs
            $kat = common::$sql['default']->fetch("SELECT `name` FROM `{prefix_forumkats}` WHERE `id` = ?;",[$getw['sid']]);
            $smarty->caching = false;
            $smarty->assign('wherepost',stringParser::decode($_POST['topic']));
            $smarty->assign('wherekat',stringParser::decode($getw['kattopic']));
            $smarty->assign('mainkat',stringParser::decode($kat['name']));
            $smarty->assign('tid',$_GET['id']);
            $wheres = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/forum_subkat_where.tpl');
            $smarty->clearAllAssign(); unset($kat);

            $smarty->caching = false;
            $smarty->assign('where',$wheres);
            $smarty->assign('chkme',common::$chkMe);
            $smarty->assign('admin','');
            $smarty->assign('nick',common::cleanautor($pUId, '', stringParser::decode($_POST['nick']), stringParser::decode($_POST['email'])));
            $smarty->assign('threadhead',stringParser::decode($_POST['topic']));
            $smarty->assign('titel',$titel);
            $smarty->assign('postnr',1);
            $smarty->assign('class','class="commentsRight"');
            $smarty->assign('pn',$pn);
            $smarty->assign('hp',$hp);
            $smarty->assign('email',$email);
            $smarty->assign('posts',$userposts);
            $smarty->assign('text',bbcode_base::parse_html((string)($_POST['eintrag']).$editedby));
            $smarty->assign('status',common::getrank($pUId));
            $smarty->assign('avatar',common::useravatar($pUId));
            $smarty->assign('edited',stringParser::decode($get['edited']));
            $smarty->assign('signatur',$sig);
            $smarty->assign('zitat',_forum_zitat_preview);
            $smarty->assign('onoff',$onoff);
            $smarty->assign('ip',common::$userip['v4'].'<br />'._only_for_admins);
            $smarty->assign('id',$_GET['id']);
            $smarty->assign('lpost',$lpost);
            $smarty->assign('lp','');
            $smarty->assign('closed',!$get['closed']);
            $smarty->assign('permission',common::permission("forum"));
            $smarty->assign('nav','');
            $smarty->assign('is_vote',!empty($get['vote']));
            $smarty->assign('vote',fvote($get['vote']));
            $smarty->assign('f_abo','');
            $smarty->assign('show',$show);
            $index = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/forum_posts.tpl');
            $smarty->clearAllAssign();

            common::update_user_status_preview();
            exit(utf8_encode('<table class="mainContent" cellspacing="1" style="margin-top:17px">'.$index.'</table>'));
        break;
        default:
        case 'post':
            if($do == 'editpost')
            {
                $get = common::$sql['default']->fetch("SELECT `date`,`reg`,`sid` FROM `{prefix_forumposts}` WHERE `id` = ?;",[(int)($_GET['id'])]);

                if($get['reg'] == 0)
                    $guestCheck = false;
                else {
                    $guestCheck = true;
                    $pUId = $get['reg'];
                }

                $smarty->caching = false;
                $smarty->assign('autor',common::cleanautor($userid));
                $smarty->assign('time',date("d.m.Y H:i", time()));
                $editedby = $smarty->fetch('string:'._edited_by);
                $smarty->clearAllAssign();

                $tID = $get['sid'];
                $cnt = "?";
            } else {
                $get['date'] = time();
                if(!common::$chkMe)
                    $guestCheck = false;
                else {
                    $guestCheck = true;
                    $pUId = common::$userid;
                }

                $tID = $_GET['id'];
                $cnt = common::cnt("{prefix_forumposts}", " WHERE `sid` = ?","id",[(int)($_GET['id'])])+2;
            }

            //Titel
            $smarty->caching = false;
            $smarty->assign('postid', $cnt);
            $smarty->assign('datum',date("d.m.Y", $get['date']));
            $smarty->assign('zeit',date("H:i", $get['date']));
            $smarty->assign('url','#');
            $smarty->assign('edit',"");
            $smarty->assign('delete',"");
            $titel = $smarty->fetch('string:'._eintrag_titel_forum);
            $smarty->clearAllAssign();

            if($guestCheck) {
                $getu = common::$sql['default']->fetch("SELECT `nick`,`hp`,`email` FROM `{prefix_users}` WHERE `id` = ?;",[(int)($pUId)]);
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

                if(common::data("signatur",$pUId)) $sig = _sig.bbcode_base::parse_html(common::data("signatur",$pUId));
                else $sig = "";
            } else {
                $pn = "";
                $email = common::CryptMailto($_POST['email'],_emailicon_forum);

                //-> Homepage Link
                $hp = "";
                if (!empty($_POST['hp'])) {
                    $smarty->caching = false;
                    $smarty->assign('hp',common::links($_POST['hp']));
                    $hp = $smarty->fetch('string:'._hpicon_forum);
                    $smarty->clearAllAssign();
                }
            }

            $smarty->caching = false;
            $smarty->assign('nick', common::cleanautor($pUId, '', $_POST['nick'], $_POST['email']));
            $smarty->assign('chkme', common::$chkMe);
            $smarty->assign('postnr', "#".($i+($page-1)*settings::get('m_fposts')));
            $smarty->assign('p', ($i+($page-1)*settings::get('m_fposts')));
            $smarty->assign('text', bbcode_base::parse_html((string)($_POST['eintrag']).$editedby));
            $smarty->assign('class', 'class="commentsRight"');
            $smarty->assign('pn', $pn);
            $smarty->assign('hp', $hp);
            $smarty->assign('email', $email);
            $smarty->assign('status', common::getrank($pUId));
            $smarty->assign('avatar', common::useravatar($pUId));
            $smarty->assign('ip', common::$userip['v4'].'<br />'._only_for_admins);
            $smarty->assign('edited', '');
            $smarty->assign('posts', $userposts);
            $smarty->assign('titel', $titel);
            $smarty->assign('signatur', $sig);
            $smarty->assign('zitat', _forum_zitat_preview);
            $smarty->assign('onoff', $onoff);
            $smarty->assign('lp', common::cnt("{prefix_forumposts}", " WHERE `sid` = ?", 'id', [$id]) + 1);
            $index = $smarty->fetch('file:[' . common::$tmpdir . ']' . $dir . '/forum_posts_show.tpl');
            $smarty->clearAllAssign();

            common::update_user_status_preview();
            exit(utf8_encode('<table class="mainContent" cellspacing="1" style="margin-top:17px">'.$index.'</table>'));
        break;
    }
}