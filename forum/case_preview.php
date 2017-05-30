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
  if($_GET['what'] == 'thread')
  {
    if($do == 'editthread')
    {
      $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_forumthreads}` WHERE id = '".(int)($_GET['id'])."'");

      $get_datum = $get['t_date'];

      if($get['t_reg'] == 0) $guestCheck = false;
      else {
        $guestCheck = true;
        $pUId = $get['t_reg'];
      }

      //-> Editby Text
      $smarty->caching = false;
      $smarty->assign('autor',common::cleanautor(common::$userid));
      $smarty->assign('time',date("d.m.Y H:i", time()));
      $editedby = $smarty->fetch('string:'._edited_by);
      $smarty->clearAllAssign();

      $tID = $get['id'];
    } else {
      $get_datum = time();

      if(!common::$chkMe) $guestCheck = false;
      else {
        $guestCheck = true;
        $pUId = common::$userid;
      }
      $tID = $_SESSION['kid'];
    }

      //Titel
      $smarty->caching = false;
      $smarty->assign('postid', 1);
      $smarty->assign('datum',date("d.m.Y", $get_datum));
      $smarty->assign('zeit',date("H:i", $get_datum));
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
        $sig = _sig.bbcode::parse_html(common::data("signatur",$pUId),true);
      else
        $sig = "";

      $onoff = common::onlinecheck(common::$userid);
      $userposts = show(_forum_user_posts, array("posts" => common::userstats("forumposts",$pUId)+1));
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

    $kat = common::$sql['default']->fetch("SELECT name FROM `{prefix_forumkats}` WHERE id = '".$getw['sid']."'");

    $wheres = show(_forum_post_where_preview, array("wherepost" => stringParser::decode($_POST['topic']),
                                                    "wherekat" => stringParser::decode($getw['kattopic']),
                                                    "mainkat" => stringParser::decode($kat['name']),
                                                    "tid" => $_GET['id'],
                                                    "kid" => $getw['kid']));

    if(empty($get['vote'])) $vote = "";
      else $vote = '<tr><td>'.fvote($get['vote']).'</td></tr>';

    if(!empty($_POST['question '])) $vote = _forum_vote_preview;
    else $vote = "";

    $index = show($dir."/forum_posts", array("head" => _forum_head,
                                             "where" => $wheres,
                                             "admin" => "",
                                             "class" => 'class="commentsRight"',
                                             "nick" => common::cleanautor($pUId, '', $_POST['nick'], $_POST['email']),
                                             "threadhead" => stringParser::decode($_POST['topic']),
                                             "titel" => $titel,
                                             "postnr" => "1",
                                             "pn" => $pn,
                                             "hp" => $hp,
                                             "email" => $email,
                                             "posts" => $userposts,
                                             "text" =>  bbcode::parse_html($_POST['eintrag'],true).$editedby,
                                             "status" => common::getrank($pUId),
                                             "avatar" => common::useravatar($pUId),
                                             "edited" => $get['edited'],
                                             "signatur" => $sig,
                                             "date" => _posted_by.date("d.m.y H:i", time())._uhr,
                                             "zitat" => _forum_zitat_preview,
                                             "onoff" => $onoff,
                                             "ip" => common::$userip.'<br />'._only_for_admins,
                                             "lpost" => $lpost,
                                             "lp" => "",
                                             "add" => "",
                                             "nav" => "",
                                             "vote" => $vote,
                                             "f_abo" => "",
                                             "show" => $show));
    common::update_user_status_preview();
    exit(utf8_encode('<table class="mainContent" cellspacing="1" style="margin-top:17px">'.$index.'</table>'));
  } else {
    if($do == 'editpost')
    {
      $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_forumposts}` WHERE id = '".(int)($_GET['id'])."'");
      $get_datum = $get['date'];

      if($get['reg'] == 0) $guestCheck = false;
      else {
        $guestCheck = true;
        $pUId = $get['reg'];
      }
      $editedby = show(_edited_by, array("autor" => common::cleanautor($userid),
                                         "time" => date("d.m.Y H:i", time())._uhr));
      $tID = $get['sid'];
      $cnt = "?";
    } else {
      $get_datum = time();

      if(!common::$chkMe) $guestCheck = false;
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
      $smarty->assign('datum',date("d.m.Y", $get_datum));
      $smarty->assign('zeit',date("H:i", $get_datum));
      $smarty->assign('url','#');
      $smarty->assign('edit',"");
      $smarty->assign('delete',"");
      $titel = $smarty->fetch('string:'._eintrag_titel_forum);
      $smarty->clearAllAssign();

    if($guestCheck)
    {
      $getu = common::$sql['default']->fetch("SELECT nick,hp,email FROM `{prefix_users}` WHERE id = '".(int)($pUId)."'");

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

      if(common::data("signatur",$pUId)) $sig = _sig.bbcode::parse_html(common::data("signatur",$pUId),true);
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

    $index = show($dir."/forum_posts_show", array("nick" => common::cleanautor($pUId, '', $_POST['nick'], $_POST['email']),
                                                  "postnr" => "#".($i+($page-1)*settings::get('m_fposts')),
                                                  "p" => ($i+($page-1)*settings::get('m_fposts')),
                                                  "class" => 'class="commentsRight"',
                                                  "text" => bbcode::parse_html($_POST['eintrag'],false).$editedby,
                                                  "pn" => $pn,
                                                  "hp" => $hp,
                                                  "email" => $email,
                                                  "status" => common::getrank($pUId),
                                                  "avatar" => common::useravatar($pUId),
                                                  "ip" => common::$userip.'<br />'._only_for_admins,
                                                  "edited" => "",
                                                  "posts" => $userposts,
                                                  "titel" => $titel,
                                                  "signatur" => $sig,
                                                  "zitat" => _forum_zitat_preview,
                                                  "onoff" => $onoff,
                                                  "p" => ""));

    common::update_user_status_preview();
    exit(utf8_encode('<table class="mainContent" cellspacing="1" style="margin-top:17px">'.$index.'</table>'));
  }
}