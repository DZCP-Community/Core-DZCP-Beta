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
  if(common::permission("forum"))
  {
    if($do == "mod")
    {
      if(isset($_POST['delete']))
      {
         $getv = common::$sql['default']->fetch("SELECT * FROM `{prefix_forumthreads}` WHERE id = '".intval($_GET['id'])."'");
        
        $userPostReduction = array();
		    $userPostReduction[$getv['t_reg']] = 1;

        if(!empty($getv['vote']))
        {
          common::$sql['default']->delete("DELETE FROM `{prefix_votes}` WHERE id = '".$getv['vote']."'");

          common::$sql['default']->delete("DELETE FROM `{prefix_vote_results}` WHERE vid = '".$getv['vote']."'");

          common::setIpcheck("vid_".$getv['vote'],false);
        }
        common::$sql['default']->delete("DELETE FROM `{prefix_forumthreads}` WHERE id = '".intval($_GET['id'])."'");

        // grab user to reduce post count
        $tmpSid = intval($_GET['id']);
        $userPosts = common::$sql['default']->select('SELECT p.`reg` FROM `{prefix_forumposts}` p WHERE sid = ' . $tmpSid . ' AND p.`reg` != 0');
        foreach($userPosts as $get) {
            if(!isset($userPostReduction[$get['reg']])) {
                $userPostReduction[$get['reg']] = 1;
            } else {
                $userPostReduction[$get['reg']] = $userPostReduction[$get['reg']] + 1;
            }
        }
        
        foreach($userPostReduction as $key_id => $value_postDecrement) {
          common::$sql['default']->update('UPDATE {prefix_userstats}'.
                 ' SET `forumposts` = `forumposts` - '. $value_postDecrement .
                 ' WHERE user = ' . $key_id);
        }

        common::$sql['default']->delete("DELETE FROM `{prefix_forumposts}` WHERE sid = '" . $tmpSid . "'");
        common::$sql['default']->delete("DELETE FROM {prefix_f_abo} WHERE fid = '".intval($_GET['id'])."'");
        
        $index = common::info(_forum_admin_thread_deleted, "../forum/");
      } else {
        if($_POST['closed'] == "0")
        {
          common::$sql['default']->update("UPDATE `{prefix_forumthreads}`
                      SET `closed` = '0'
                      WHERE id = '".intval($_GET['id'])."'");
        } elseif($_POST['closed'] == "1") {
          common::$sql['default']->update("UPDATE `{prefix_forumthreads}`
                       SET `closed` = '1'
                       WHERE id = '".intval($_GET['id'])."'");
        }

        if(isset($_POST['sticky']))
        {
          common::$sql['default']->update("UPDATE `{prefix_forumthreads}`
                        SET `sticky` = '1'
                        WHERE id = '".intval($_GET['id'])."'");
        } else {
          common::$sql['default']->update("UPDATE `{prefix_forumthreads}`
                        SET `sticky` = '0'
                        WHERE id = '".intval($_GET['id'])."'");
        }

        if(isset($_POST['global']))
        {
          common::$sql['default']->update("UPDATE `{prefix_forumthreads}`
                        SET `global` = '1'
                        WHERE id = '".intval($_GET['id'])."'");
        } else {
          common::$sql['default']->update("UPDATE `{prefix_forumthreads}`
                        SET `global` = '0'
                        WHERE id = '".intval($_GET['id'])."'");
        }

        if($_POST['move'] == "lazy")
        {
          $index = common::info(_forum_admin_modded, "?action=showthread&amp;id=".$_GET['id']."");
        } else {
          common::$sql['default']->update("UPDATE `{prefix_forumthreads}`
                      SET `kid` = '".$_POST['move']."'
                      WHERE id = '".intval($_GET['id'])."'");

          common::$sql['default']->update("UPDATE `{prefix_forumposts}`
                      SET `kid` = '".$_POST['move']."'
                      WHERE sid = '".intval($_GET['id'])."'");

          $getm = common::$sql['default']->fetch("SELECT s1.kid,s2.kattopic,s2.id
                      FROM `{prefix_forumthreads}` AS s1
                      LEFT JOIN `{prefix_forumsubkats}` AS s2
                      ON s1.kid = s2.id
                      WHERE s1.id = '".intval($_GET['id'])."'");

          $i_move = show(_forum_admin_do_move, array("kat" => stringParser::decode($getm['kattopic'])));
          $index = common::info($i_move, "?action=showthread&amp;id=".$_GET['id']."");
        }
      }
    }
  } else {
    $index = common::error(_error_wrong_permissions, 1);
  }
}
