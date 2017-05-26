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
    $checks = common::$sql['default']->fetch("SELECT s3.`name`,s3.`intern`,s2.`sid`,s1.`kid`,s2.`id` FROM ".
        "`{prefix_forumkats}` AS s3, `{prefix_forumsubkats}` AS s2, `{prefix_forumthreads}` AS s1 WHERE ".
        "s1.`kid` = s2.`id` AND s2.`sid` = s3.`id` AND s1.`id` = ?;",[(int)($_GET['id'])]);

    if(common::$sql['default']->rows("SELECT * FROM `{prefix_forumthreads}` WHERE `id` = ? AND `kid` = ?;",[(int)($_GET['id']),$checks['kid']])) {
        if($checks['intern'] == 1 && !common::permission("intforum") && !common::forum_intern($checks['id'])) {
            $index = common::error(_error_wrong_permissions, 1);
        } else {
            //Update Hits
            if(!common::$CrawlerDetect->isCrawler()) {
                common::$sql['default']->update("UPDATE `{prefix_forumthreads}` SET `hits` = (hits+1) WHERE `id` = ?;", [(int)($_GET['id'])]);
            }

            $qryp = common::$sql['default']->select("SELECT * FROM `{prefix_forumposts}` WHERE sid = ? ".
                "ORDER BY id LIMIT ".($page - 1)*($m_fposts=settings::get('m_fposts')).",".$m_fposts.";",
                [(int)($_GET['id'])]);

            //Button "Zum letzten Eintrag"
            $entrys = common::cnt("{prefix_forumposts}", " WHERE `sid` = ?",'id',[(int)($_GET['id'])]);
            $pagenr = (!$entrys ? "1" : ceil($entrys/settings::get('m_fposts')));
            $hL = (!empty($_GET['hl']) ? '&amp;hl='.$_GET['hl'] : '');

            $smarty->caching = false;
            $smarty->assign('id',$entrys+1);
            $smarty->assign('tid',$_GET['id']);
            $smarty->assign('page',$pagenr.$hL);
            $lpost = $smarty->fetch('string:'._forum_lastpost);
            $smarty->clearAllAssign();

            $i = 2; //Begin Post ID 2 (1 is thread)
            /*
             * ###################################
             * Posts
             * ###################################
             */
            foreach($qryp as $getp) {
                //User Signatur ausgeben
                $signatur = common::data("signatur",$getp['reg']); $sig = '';
                if(!empty($signatur)) {
                    $sig = sprintf('%s%s',_sig,bbcode::parse_html($signatur));
                } unset($signatur);

                //User Posts ( Uber Avatar )
                $userposts = '';
                if($getp['reg']) {
                    $smarty->caching = false;
                    $smarty->assign('posts',common::userstats("forumposts",$getp['reg']));
                    $userposts = $smarty->fetch('string:'._forum_user_posts);
                    $smarty->clearAllAssign();
                }

                //User Online check
                $onoff = ($getp['reg'] ? common::onlinecheck($getp['reg']) : '');

                //Button Zitat
                $smarty->caching = false;
                $smarty->assign('action',"action=post&amp;do=add&amp;kid=".$getp['kid']."&amp;zitat=".$getp['id']."&amp;id=".$_GET['id']);
                $zitat = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/buttons/button_zitat.tpl');
                $smarty->clearAllAssign();

                //Delete & Edit Button
                $delete = ""; $edit = "";
                if($getp['reg'] == common::$userid || common::permission("forum")) {
                    $edit = common::getButtonEditSingle($getp['id'],"action=post&amp;do=edit");
                    $delete = common::button_delete_single($getp['id'],"action=post&amp;do=delete",_button_title_del,_confirm_del_entry);
                }

                $ftxt = hl($getp['text'], (isset($_GET['hl']) ? $_GET['hl'] : ''));
                $text = isset($_GET['hl']) ? bbcode::parse_html($ftxt['text']) : bbcode::parse_html($getp['text']);
                $posted_ip = (common::$chkMe == 4 || common::permission('ipban') ? $getp['ip'] : _logged);

                //Titel
                $smarty->caching = false;
                $smarty->assign('postid', $i+($page-1)*settings::get('m_fposts'));
                $smarty->assign('datum',date("d.m.Y", $getp['date']));
                $smarty->assign('zeit',date("H:i", $getp['date']));
                $smarty->assign('url','?action=showthread&amp;id='.(int)($_GET['id']).'&amp;page='.$page.'#p'.($i+($page-1)*settings::get('m_fposts')));
                $smarty->assign('edit',$edit);
                $smarty->assign('delete',$delete);
                $titel = $smarty->fetch('string:'._eintrag_titel_forum);
                $smarty->clearAllAssign();

                if($getp['reg'] != 0) {
                    $getu = common::$sql['default']->fetch("SELECT nick,hp,email FROM `{prefix_users}` WHERE id = '".$getp['reg']."'");
                    $email = common::CryptMailto(stringParser::decode($getu['email']),_emailicon_forum);
                    $pn = show(_pn_write_forum, array("id" => $getp['reg'],"nick" => $getu['nick']));

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
                    $email = common::CryptMailto(stringParser::decode($getp['email']),_emailicon_forum);

                    //-> Homepage Link
                    $hp = "";
                    if (!empty($getp['hp'])) {
                        $smarty->caching = false;
                        $smarty->assign('hp',common::links(stringParser::decode($getp['hp'])));
                        $hp = $smarty->fetch('string:'._hpicon_forum);
                        $smarty->clearAllAssign();
                    }
                }

                $nick = common::autor($getp['reg'], '', $getp['nick'], stringParser::decode($getp['email']));
                if(!empty($_GET['hl']) && $_SESSION['search_type'] == 'autor') {
                    if(preg_match("#".$_GET['hl']."#i",$nick))
                        $ftxt['class'] = 'class="highlightSearchTarget"';
                }

        $show .= show($dir."/forum_posts_show", array("nick" => $nick,
                                                      "postnr" => "#".($i+($page-1)*settings::get('m_fposts')),
                                                      "p" => ($i+($page-1)*settings::get('m_fposts')),
                                                      "text" => $text,
                                                      "pn" => $pn,
                                                      "class" => $ftxt['class'],
                                                      "hp" => $hp,
                                                      "email" => $email,
                                                      "status" => common::getrank($getp['reg']),
                                                      "avatar" => common::useravatar($getp['reg']),
                                                      "ip" => $posted_ip,
                                                      "edited" => stringParser::decode($getp['edited']),
                                                      "posts" => $userposts,
                                                      "titel" => $titel,
                                                      "signatur" => $sig,
                                                      "zitat" => $zitat,
                                                      "onoff" => $onoff,
                                                      "top" => _topicon,
                                                      "lp" => common::cnt("{prefix_forumposts}", " WHERE sid = '".(int)($_GET['id'])."'")+1));
        $i++;
      }

      $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_forumthreads}` WHERE id = '".(int)($_GET['id'])."'");

      $getw = common::$sql['default']->fetch("SELECT s1.kid,s1.topic,s2.kattopic,s2.sid
                  FROM `{prefix_forumthreads}` AS s1
                  LEFT JOIN `{prefix_forumsubkats}` AS s2
                  ON s1.kid = s2.id
                  WHERE s1.id = '".(int)($_GET['id'])."'");

      $kat = common::$sql['default']->fetch("SELECT name FROM `{prefix_forumkats}`
                    WHERE id = '".$getw['sid']."'");

        //Breadcrumbs
        $smarty->caching = false;
        $smarty->assign('wherepost',stringParser::decode($getw['topic']));
        $smarty->assign('wherekat',stringParser::decode($getw['kattopic']));
        $smarty->assign('mainkat',stringParser::decode($kat['name']));
        $smarty->assign('tid',$_GET['id']);
        $smarty->assign('kid',$getw['kid']);
        $wheres = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/forum_subkat_where.tpl');
        $smarty->clearAllAssign();

      if($get['t_reg'] == "0")
      {
        $userposts = "";
        $onoff = "";
      } else {
        $onoff = common::onlinecheck($get['t_reg']);
        $userposts = show(_forum_user_posts, array("posts" => common::userstats("forumposts",$get['t_reg'])));
      }

      $zitat = show($dir."/button_zitat", array("id" => $_GET['id'],
                                               "action" => "action=post&amp;do=add&amp;kid=".$getw['kid']."&amp;zitatt=".$get['id'],
                                               "title" => _button_title_zitat));
      if($get['closed'] == 1)
      {
        $add = show($dir."/button_closed", array());
      } else {
        $add = show(_forum_addpost, array("id" => $_GET['id'],
                                          "kid" => $_GET['kid']));
      }

      $nav = common::nav($entrys,settings::get('m_fposts'),"?action=showthread&amp;id=".$_GET['id'].$hL);

      if(common::data("signatur",$get['t_reg'])) $sig = _sig.bbcode::parse_html(common::data("signatur",$get['t_reg']));
      else $sig = "";

        $editt = '';
      if($get['t_reg'] == common::$userid || common::permission("forum"))
        $editt = common::getButtonEditSingle($get['id'],"action=thread&amp;do=edit&amp;kid=".$_GET['kid']);

      $admin = '';
      if(common::permission("forum"))
      {
        $sticky = $get['sticky'] ? 'checked="checked"' : "";
        $global = $get['global'] ? 'checked="checked"' : "";

        if($get['closed'] == "1")
        {
          $closed = 'checked="checked"';
          $opened = "";
        } else {
          $opened = 'checked="checked"';
          $closed = "";
        }

        $qryok = common::$sql['default']->select("SELECT * FROM `{prefix_forumkats}` ORDER BY kid");
        $move = '';
        foreach($qryok as $getok) {
          $skat = "";
          $qryo = common::$sql['default']->select("SELECT * FROM `{prefix_forumsubkats}` WHERE sid = '".$getok['id']."' ORDER BY kattopic");
          foreach($qryo as $geto) {
            $skat .= show(_forum_select_field_skat, array("value" => $geto['id'],"what" => stringParser::decode($geto['kattopic'])));
          }

          $move .= show(_forum_select_field_kat, array("value" => "lazy",
                                                       "what" => stringParser::decode($getok['name']),
                                                       "skat" => $skat));
        }

        $admin = show($dir."/admin", array("admin" => _admin,
                                           "id" => $get['id'],
                                           "open" => _forum_admin_open,
                                           "close" => _forum_admin_close,
                                           "asticky" => _forum_admin_addsticky,
                                           "delete" => _forum_admin_delete,
                                           "moveto" => _forum_admin_moveto,
                                           "aglobal" => _forum_admin_global,
                                           "move" => $move,
                                           "closed" => $closed,
                                           "opened" => $opened,
                                           "global" => $global,
                                           "sticky" => $sticky));
      }

      $hl = isset($_GET['hl']) ? $_GET['hl'] : '';
      $ftxt = hl($get['t_text'], $hl);
      if(isset($_GET['hl'])) $text = stringParser::decode($ftxt['text']);
      else $text = bbcode::parse_html($get['t_text']);

      if(common::$chkMe == 4 || common::permission('ipban')) $posted_ip = $get['ip'];
      else $posted_ip = _logged;

      $titel = show(_eintrag_titel_forum, array("postid" => "1",
                                                "datum" => date("d.m.Y", $get['t_date']),
                                                "zeit" => date("H:i", $get['t_date'])._uhr,
                                                "url" => '?action=showthread&amp;id='.(int)($_GET['id']).'&amp;page=1#p1',
                                                "edit" => $editt,
                                                "delete" => ""));


      if($get['t_reg'] != 0)
      {
        $getu = common::$sql['default']->fetch("SELECT nick,hp,email FROM `{prefix_users}` WHERE id = '".$get['t_reg']."'");
        $email = common::CryptMailto(stringParser::decode($getu['email']),_emailicon_forum);
        $pn = show(_pn_write_forum, array("id" => $get['t_reg'],"nick" => $getu['nick']));

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
        $email = common::CryptMailto(stringParser::decode($get['t_email']),_emailicon_forum);

        //-> Homepage Link
        $hp = "";
        if (!empty($get['t_hp'])) {
          $smarty->caching = false;
          $smarty->assign('hp',common::links(stringParser::decode($get['t_hp'])));
          $hp = $smarty->fetch('string:'._hpicon_forum);
          $smarty->clearAllAssign();
        }
      }

      $nick = common::autor($get['t_reg'], '', $get['t_nick'], $get['t_email']);
      if(!empty($_GET['hl']) && $_SESSION['search_type'] == 'autor')
      {
        if(preg_match("#".$_GET['hl']."#i",$nick)) $ftxt['class'] = 'class="highlightSearchTarget"';
      }

      $abo = common::$sql['default']->rows("SELECT user FROM `{prefix_forum_abo}`
                 WHERE user = '".common::$userid."'
                 AND fid = '".(int)($_GET['id'])."'") ? 'checked="checked"' : '';
      if(!common::$chkMe) {
          $f_abo = '';
      } else {
          $f_abo = show($dir."/forum_abo", array("id" => (int)($_GET['id']),
                                             "abo" => $abo,
                                             "abo_info" => _foum_fabo_checkbox,
                                             "abo_title" => _forum_abo_title,
                                             "submit" => _button_value_save));
        }

      $vote = "";
      if(!empty($get['vote'])) {
        $vote = '<tr><td>'.fvote($get['vote']).'</td></tr>';
      }

      $where = $where.' - '.stringParser::decode($getw['topic']);
      $index = show($dir."/forum_posts", array("head" => _forum_head,
                                               "where" => $wheres,
                                               "admin" => $admin,
                                               "nick" => $nick,
                                               "threadhead" => stringParser::decode($getw['topic']),
                                               "titel" => $titel,
                                               "postnr" => "1",
                                               "class" => $ftxt['class'],
                                               "pn" => $pn,
                                               "hp" => $hp,
                                               "email" => $email,
                                               "posts" => $userposts,
                                               "text" => $text,
                                               "status" => common::getrank($get['t_reg']),
                                               "avatar" => common::useravatar($get['t_reg']),
                                               "edited" => stringParser::decode($get['edited']),
                                               "signatur" => $sig,
                                               "date" => _posted_by.date("d.m.y H:i", $get['t_date'])._uhr,
                                               "zitat" => $zitat,
                                               "onoff" => $onoff,
                                               "ip" => $posted_ip,
                                               "top" => _topicon,
                                               "lpost" => $lpost,
                                               "lp" => common::cnt("{prefix_forumposts}", " WHERE sid = '".(int)($_GET['id'])."'")+1,
                                               "add" => $add,
                                               "nav" => $nav,
                                               "vote" => $vote,
                                               "f_abo" => $f_abo,
                                               "show" => $show));
    }
  } else {
    $index = common::error(_error_wrong_permissions, 1);
  }
}