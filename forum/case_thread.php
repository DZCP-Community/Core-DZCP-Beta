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
    if($do == "edit") {
    $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_forumthreads}` WHERE id = '".(int)($_GET['id'])."'");
    if($get['t_reg'] == common::$userid || common::permission("forum"))
    {
      if(common::permission("forum"))
      {
        $sticky = $get['sticky'] ? 'checked="checked"' : "";
        $global = $get['global'] ? 'checked="checked"' : "";
        $admin = show($dir."/form_admin", array("adminhead" => _forum_admin_head,
                                                "addsticky" => _forum_admin_addsticky,
                                                "sticky" => $sticky,
                                                "addglobal" => _forum_admin_addglobal,
                                                "global" => $global));
      }

      if($get['t_reg'] != 0)
      {
        $form = show("page/editor_regged", array("nick" => common::autor($get['t_reg']),
                                                 "von" => _autor));

      } else {
        $form = show("page/editor_notregged", array("nickhead" => _nick,
                                                    "emailhead" => _email,
                                                    "hphead" => _hp));
      }

        $getv = common::$sql['default']->fetch("SELECT * FROM `{prefix_votes}` WHERE id = '".$get['vote']."'");
        $fget = common::$sql['default']->fetch("SELECT s1.intern,s2.id FROM `{prefix_forumkats}` AS s1
                    LEFT JOIN `{prefix_forumsubkats}` AS s2 ON s2.`sid` = s1.id
                    WHERE s2.`id` = '".(int)($get['kid'])."'");

        $intern = ''; $intern_kat = ''; $isclosed = ''; $display = ''; $toggle = 'collapse';
        $internVisible = '';
        if($getv['intern'])
            $intern = 'checked="checked"';

        if($fget['intern']) {
            $intern = 'checked="checked"'; $internVisible = 'style="display:none"';
        }

        if($getv['closed']) {
            $isclosed = 'checked="checked"';
            $display = 'none';
            $toggle = 'expand';
        }

        if(empty($get['vote'])) {
        $vote = show($dir."/form_vote", array("head" => _votes_admin_head,
                                              "value" => _button_value_add,
                                              "what" => "&amp;do=add",
                                              "closed" => "",
                                              "question1" => "",
                                              "a1" => "",
                                              "a2" => "",
                                              "a3" => "",
                                              "a4" => "",
                                              "a5" => "",
                                              "a6" => "",
                                              "a7" => "",
                                              "error" => "",
                                              "br1" => "<!--",
                                              "br2" => "-->",
                                              "display" => "none",
                                              "a8" => "",
                                              "a9" => "",
                                              "a10" => "",
                                              "intern" => "",
                                              "tgl" => "expand",
                                              "vote_del" => _forum_vote_del,
                                              "interna" => _votes_admin_intern,
                                              "question" => _votes_admin_question,
                                              "answer" => _votes_admin_answer));
        } elseif(!empty($get['vote'])) {
        $vote = show($dir."/form_vote", array("head" => _votes_admin_edit_head,
                                              "value" => "edit",
                                              "id" => $getv['id'],
                                              "what" => '',
                                              "value" => _button_value_edit,
                                              "br1" => "",
                                              "br2" => "",
                                              "tgl" => $toggle,
                                                                    "display" => $display,
                                              "question1" => stringParser::decode($getv['titel']),
                                              "a1" => common::voteanswer("a1", $getv['id']),
                                              "a2" => common::voteanswer("a2", $getv['id']),
                                              "a3" => common::voteanswer("a3", $getv['id']),
                                              "a4" => common::voteanswer("a4", $getv['id']),
                                              "a5" => common::voteanswer("a5", $getv['id']),
                                              "a6" => common::voteanswer("a6", $getv['id']),
                                              "a7" => common::voteanswer("a7", $getv['id']),
                                              "error" => "",
                                              "a8" => common::voteanswer("a8", $getv['id']),
                                              "a9" => common::voteanswer("a9", $getv['id']),
                                              "a10" => common::voteanswer("a10", $getv['id']),
                                              'intern_kat' => $internVisible,
                                              "intern" => $intern,
                                              "isclosed" => $isclosed,
                                                                    "vote_del" => _forum_vote_del,
                                              "closed" => _votes_admin_closed,
                                              "interna" => _votes_admin_intern,
                                              "question" => _votes_admin_question,
                                              "answer" => _votes_admin_answer));

      }
      $dowhat = show(_forum_dowhat_edit_thread, array("id" => $_GET['id']));
      $index = show($dir."/thread", array("titel" => _forum_edit_thread_head,
                                          "nickhead" => _nick,
                                          "topichead" => _forum_topic,
                                          "subtopichead" => _forum_subtopic,
                                          "emailhead" => _email,
                                          "form" => $form,
                                          "reg" => $get['t_reg'],
                                          "id" => "",
                                          "security" => _register_confirm,
                                          "preview" => _preview,
                                          "ip" => _iplog_info,
                                          "bbcodehead" => _bbcode,
                                          "eintraghead" => _eintrag,
                                          "what" => _button_value_edit,
                                          "dowhat" => $dowhat,
                                          "error" => "",
                                          "posttopic" => stringParser::decode($get['topic']),
                                          "postsubtopic" => stringParser::decode($get['subtopic']),
                                          "postnick" => stringParser::decode($get['t_nick']),
                                          "postemail" => $get['t_email'],
                                          "posthp" => $get['t_hp'],
                                          "admin" => $admin,
                                          "vote" => $vote,
                                          "posteintrag" => bbcode::parse_html($get['t_text'],false,true)));
    } else {
      $index = common::error(_error_wrong_permissions, 1);
    }
  } elseif($do == "editthread") {
    $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_forumthreads}` WHERE id = '".(int)($_GET['id'])."'");

    if($get['t_reg'] == common::$userid || common::permission("forum"))
    {
      if($get['t_reg'] != 0 || common::permission('forum'))
      {
        $toCheck = empty($_POST['eintrag']);
      } else {
        $toCheck = empty($_POST['topic']) || empty($_POST['nick']) || empty($_POST['email']) || empty($_POST['eintrag']) || !common::$securimage->check($_POST['secure']);
      }

      if($toCheck)
        {
        if($get['t_reg'] != 0)
        {
          if(empty($_POST['eintrag'])) $error = _empty_eintrag;
          $form = show("page/editor_regged", array("nick" => common::autor($get['t_reg']),
                                                   "von" => _autor));

        } else {
          if(!common::$securimage->check($_POST['secure'])) $error = captcha_mathematic ? _error_invalid_regcode_mathematic : _error_invalid_regcode;
          elseif(empty($_POST['topic'])) $error = _empty_topic;
            elseif(empty($_POST['nick'])) $error = _empty_nick;
            elseif(empty($_POST['email'])) $error = _empty_email;
            elseif(!common::check_email($_POST['email'])) $error = _error_invalid_email;
            elseif(empty($_POST['eintrag'])) $error = _empty_eintrag;

          $form = show("page/editor_notregged", array("nickhead" => _nick,
                                                      "emailhead" => _email,
                                                      "hphead" => _hp));
        }

          $error = show("errors/errortable", array("error" => $error));

        if(common::permission("forum"))
        {
          if(isset($_POST['sticky'])) $sticky = "checked";
          if(isset($_POST['global'])) $global = "checked";

          $admin = show($dir."/form_admin", array("adminhead" => _forum_admin_head,
                                                  "addsticky" => _forum_admin_addsticky,
                                                  "sticky" => $sticky,
                                                  "addglobal" => _forum_admin_addglobal,
                                                  "global" => $global));
        }
          $getv = common::$sql['default']->fetch("SELECT * FROM `{prefix_votes}` WHERE id = '".$get['vote']."'");
          $fget = common::$sql['default']->fetch("SELECT s1.intern,s2.id FROM `{prefix_forumkats}` AS s1
                         LEFT JOIN `{prefix_forumsubkats}` AS s2 ON s2.`sid` = s1.id
                         WHERE s2.`id` = '".(int)($_GET['kid'])."'");

            if($_POST['intern']) $intern = 'checked="checked"';
          $intern = ''; $intern_kat = ''; $internVisible = '';
          if($fget['intern'] == "1") { $intern = 'checked="checked"'; $internVisible = 'style="display:none"'; };
            if($_POST['closed']) $closed = 'checked="checked"';

            if(empty($_POST['question'])) $display = "none";
            $display = "";

          $vote = show($dir."/form_vote", array("head" => _votes_admin_head,
                                              "value" => _button_value_add,
                                              "what" => "&amp;do=add",
                                              "question1" => stringParser::decode($_POST['question']),
                                              "a1" => $_POST['a1'],
                                              "closed" => $closed,
                        "tgl" => "expand",
                                              "br1" => "<!--",
                                              "br2" => "-->",
                                              "display" => $display,
                                              "a2" => $_POST['a2'],
                                              "a3" => $_POST['a3'],
                                              "a4" => $_POST['a4'],
                                              "a5" => $_POST['a5'],
                                              "a6" => $_POST['a6'],
                                              "a7" => $_POST['a7'],
                                              "error" => $error,
                                              "a8" => $_POST['a8'],
                                              "a9" => $_POST['a9'],
                                              "a10" => $_POST['a10'],
                                              'intern_kat' => $internVisible,
                                              "intern" => $intern,
                                              "vote_del" => _forum_vote_del,
                                              "interna" => _votes_admin_intern,
                                              "question" => _votes_admin_question,
                                              "answer" => _votes_admin_answer));

        $dowhat = show(_forum_dowhat_edit_thread, array("id" => $_GET['id']));
          $index = show($dir."/thread", array("titel" => _forum_edit_thread_head,
                                                "nickhead" => _nick,
                                            "subtopichead" => _forum_subtopic,
                                            "topichead" => _forum_topic,
                                            "ip" => _iplog_info,
                                            "form" => $form,
                                                "bbcodehead" => _bbcode,
                                            "reg" => $_POST['reg'],
                                            "preview" => _preview,
                                                "emailhead" => _email,
                                                "id" => "",
                                            "security" => _register_confirm,
                                            "what" => _button_value_edit,
                                            "dowhat" => $dowhat,
                                            "posthp" => $_POST['hp'],
                                              "postemail" => $_POST['email'],
                                              "postnick" => stringParser::decode($_POST['nick']),
                                              "posteintrag" => stringParser::decode($_POST['eintrag']),
                                            "posttopic" => stringParser::decode($_POST['topic']),
                                            "postsubtopic" => stringParser::decode($_POST['subtopic']),
                                              "error" => $error,
                                            "admin" => $admin,
                                                "vote" => $vote,
                                            "eintraghead" => _eintrag));
      } else {
        $gett = common::$sql['default']->fetch("SELECT * FROM `{prefix_forumthreads}` WHERE id = '".(int)($_GET['id'])."'");
          if(!empty($gett['vote']))
      {
       $getv = common::$sql['default']->fetch("SELECT * FROM `{prefix_vote_results}` WHERE vid = '".$gett['vote']."'");

       $vid = $gett['vote'];

          common::$sql['default']->update("UPDATE `{prefix_votes}`
                   SET `titel`  = '".stringParser::encode($_POST['question'])."',
                       `intern` = '".(int)($_POST['intern'])."',
                       `closed` = '".(int)($_POST['closed'])."'
                   WHERE id = '".$gett['vote']."'");

          common::$sql['default']->update("UPDATE `{prefix_vote_results}`
                    SET `sel` = '".stringParser::encode($_POST['a1'])."'
                    WHERE what = 'a1'
                    AND vid = '".$gett['vote']."'");

          common::$sql['default']->update("UPDATE `{prefix_vote_results}`
                    SET `sel` = '".stringParser::encode($_POST['a2'])."'
                    WHERE what = 'a2'
                    AND vid = '".$gett['vote']."'");

        for($i=3; $i<=10; $i++)
        {
          if(!empty($_POST['a'.$i.'']))
          {
            if(common::cnt(`{prefix_vote_results}`, " WHERE vid = '".$gett['vote']."' AND what = 'a".$i."'") != 0)
            {
                common::$sql['default']->update("UPDATE `{prefix_vote_results}`
                         SET `sel` = '".stringParser::encode($_POST['a'.$i.''])."'
                         WHERE what = 'a".$i."'
                         AND vid = '".$gett['vote']."'");
            } else {
                common::$sql['default']->insert("INSERT INTO `{prefix_vote_results}`
                         SET `vid` = '".$gett['vote']."',
                             `what` = 'a".$i."',
                             `sel` = '".stringParser::encode($_POST['a'.$i.''])."'");
            }
          }

          if(common::cnt("{prefix_vote_results}", " WHERE vid = '".$gett['vote']."' AND what = 'a".$i."'") != 0 && empty($_POST['a'.$i.'']))
          {
              common::$sql['default']->delete("DELETE FROM `{prefix_vote_results}`
                       WHERE vid = '".$gett['vote']."'
                       AND what = 'a".$i."'");
          }
        }
        } elseif(empty($gett['vote']) && !empty($_POST['question'])) {
              common::$sql['default']->insert("INSERT INTO `{prefix_votes}`
                     SET `datum`  = '".time()."',
                         `titel`  = '".stringParser::encode($_POST['question'])."',
                         `intern` = '".(int)($_POST['intern'])."',
                         `forum`  = 1,
                         `von`    = '".(int)(common::$userid)."'");

          $vid = common::$sql['default']->lastInsertId();
              common::$sql['default']->insert("INSERT INTO `{prefix_vote_results}`
                    SET `vid`   = '".(int)($vid)."',
                        `what`  = 'a1',
                        `sel`   = '".stringParser::encode($_POST['a1'])."'");

              common::$sql['default']->insert("INSERT INTO `{prefix_vote_results}`
                     SET `vid`  = '".(int)($vid)."',
                         `what` = 'a2',
                         `sel`  = '".stringParser::encode($_POST['a2'])."'");

          if(!empty($_POST['a3']))
          {
              common::$sql['default']->insert("INSERT INTO `{prefix_vote_results}`
                       SET `vid`  = '".(int)($vid)."',
                           `what` = 'a3',
                           `sel`  = '".stringParser::encode($_POST['a3'])."'");
          }
          if(!empty($_POST['a4']))
          {
              common::$sql['default']->insert("INSERT INTO `{prefix_vote_results}`
                       SET `vid`  = '".(int)($vid)."',
                           `what` = 'a4',
                           `sel`  = '".stringParser::encode($_POST['a4'])."'");
          }
          if(!empty($_POST['a5']))
          {
              common::$sql['default']->insert("INSERT INTO `{prefix_vote_results}`
                       SET `vid`  = '".(int)($vid)."',
                           `what` = 'a5',
                           `sel`  = '".stringParser::encode($_POST['a5'])."'");
          }
          if(!empty($_POST['a6']))
          {
              common::$sql['default']->insert("INSERT INTO `{prefix_vote_results}`
                       SET `vid`  = '".(int)($vid)."',
                           `what` = 'a6',
                           `sel`  = '".stringParser::encode($_POST['a6'])."'");
          }
          if(!empty($_POST['a7']))
          {
              common::$sql['default']->insert("INSERT INTO `{prefix_vote_results}`
                       SET `vid`  = '".(int)($vid)."',
                           `what` = 'a7',
                           `sel`  = '".stringParser::encode($_POST['a7'])."'");
          }
          if(!empty($_POST['a8']))
          {
              common::$sql['default']->insert("INSERT INTO `{prefix_vote_results}`
                       SET `vid`  = '".(int)($vid)."',
                           `what` = 'a8',
                           `sel`  = '".stringParser::encode($_POST['a8'])."'");
          }
          if(!empty($_POST['a9']))
          {
              common::$sql['default']->insert("INSERT INTO `{prefix_vote_results}`
                       SET `vid`  = '".(int)($vid)."',
                           `what` = 'a9',
                           `sel`  = '".stringParser::encode($_POST['a9'])."'");
          }
          if(!empty($_POST['a10']))
          {
              common::$sql['default']->insert("INSERT INTO `{prefix_vote_results}`
                       SET `vid`  = '".(int)($vid)."',
                           `what` = 'a10',
                           `sel`  = '".stringParser::encode($_POST['a10'])."'");
          }
        } else { $vid = ""; }

        if($_POST['vote_del'] == 1) {
            common::$sql['default']->delete("DELETE FROM `{prefix_votes}` WHERE id = '".$gett['vote']."'");
            common::$sql['default']->delete("DELETE FROM `{prefix_vote_results}` WHERE vid = '".$gett['vote']."'");

            common::setIpcheck("vid_".$gett['vote'],false);
        $vid = "";
        }

          //-> Editby Text
          $smarty->caching = false;
          $smarty->assign('autor',common::autor(common::$userid));
          $smarty->assign('time',date("d.m.Y H:i", time()));
          $editedby = $smarty->fetch('string:'._edited_by);
          $smarty->clearAllAssign();

          common::$sql['default']->update("UPDATE `{prefix_forumthreads}`
                             SET `topic`    = '".stringParser::encode($_POST['topic'])."',
                       `subtopic` = '".stringParser::encode($_POST['subtopic'])."',
                       `t_nick`   = '".stringParser::encode($_POST['nick'])."',
                       `t_email`  = '".stringParser::encode($_POST['email'])."',
                       `t_hp`     = '".common::links($_POST['hp'])."',
                       `t_text`   = '".stringParser::encode($_POST['eintrag'])."',
                       `sticky`   = '".(int)($_POST['sticky'])."',
                       `global`   = '".(int)($_POST['global'])."',
                                            `vote`     = '".$vid."',
                       `edited`   = '".stringParser::encode($editedby)."'
                   WHERE id = '".(int)($_GET['id'])."'");

      $checkabo = common::$sql['default']->select("SELECT s1.user,s1.fid,s2.nick,s2.id,s2.email FROM `{prefix_forum_abo}` AS s1
                        LEFT JOIN `{prefix_users}` AS s2 ON s2.id = s1.user
                      WHERE s1.fid = '".(int)($_GET['id'])."'");
      foreach($checkabo as $getabo) {
        if(common::$userid != $getabo['user'])
        {
          $gettopic = common::$sql['default']->fetch("SELECT topic FROM `{prefix_forumthreads}` WHERE id = '".(int)($_GET['id'])."'");

          $subj = show(stringParser::decode(settings::get('eml_fabo_tedit_subj')), array("titel" => $title));

           $message = show(common::bbcode_email(settings::get('eml_fabo_tedit')), array("nick" => stringParser::decode($getabo['nick']),
                                                                "postuser" => common::fabo_autor(common::$userid),
                                                            "topic" => $gettopic['topic'],
                                                            "titel" => $title,
                                                            "domain" => common::$httphost,
                                                            "id" => (int)($_GET['id']),
                                                            "entrys" => "1",
                                                            "page" => "1",
                                                            "text" => bbcode::parse_html($_POST['eintrag']),
                                                            "clan" => settings::get('clanname')));

            common::sendMail(stringParser::decode($getabo['email']),$subj,$message);
        }
      }

        $index = common::info(_forum_editthread_successful, "?action=showthread&amp;id=".$gett['id']."");

      }
    } else $index = common::error(_error_wrong_permissions, 1);
  } elseif($do == "add") {
    if(settings::get("reg_forum") && !common::$chkMe)
    {
      $index = common::error(_error_unregistered,1);
    } else {
      if(!common::ipcheck("fid(".$_GET['kid'].")", settings::get('f_forum')))
      {
        if(common::permission("forum"))
        {
          $admin = show($dir."/form_admin", array("adminhead" => _forum_admin_head,
                                                  "addsticky" => _forum_admin_addsticky,
                                                  "sticky" => "",
                                                  "addglobal" => _forum_admin_addglobal,
                                                  "global" => ""));
        } else {
          $admin = "";
        }

        $internVisible = '';
        $fget = common::$sql['default']->fetch("SELECT s1.intern,s2.id FROM `{prefix_forumkats}` AS s1
                       LEFT JOIN `{prefix_forumsubkats}` AS s2 ON s2.`sid` = s1.id
                       WHERE s2.`id` = '".(int)($_GET['kid'])."'");
                $intern = ''; $intern_kat = ''; $internVisible = '';
                if($fget['intern'] == "1") { $intern = 'checked="checked"'; $internVisible = 'style="display:none"'; };

                if(common::$userid >= 1)
          {
              $form = show("page/editor_regged", array("nick" => common::autor(common::$userid),
                                                   "von" => _autor));
          } else {
          $form = show("page/editor_notregged", array("nickhead" => _nick,
                                                      "emailhead" => _email,
                                                      "hphead" => _hp));
        }

        $vote = show($dir."/form_vote", array("head" => _votes_admin_head,
                                              "value" => _button_value_add,
                                              "what" => "&amp;do=add",
                                              "closed" => "",
                                              "question1" => "",
                                              "tgl" => "expand",
                                              "a1" => "",
                                              "a2" => "",
                                              "a3" => "",
                                              "a4" => "",
                                              "a5" => "",
                                              "a6" => "",
                                              "a7" => "",
                                              "error" => "",
                                              "br1" => "<!--",
                                              "br2" => "-->",
                                              "display" => "none",
                                              "a8" => "",
                                              "a9" => "",
                                              "a10" => "",
                                              'intern_kat' => $internVisible,
                                              "intern" => $intern,
                                              "vote_del" => _forum_vote_del,
                                              "interna" => _votes_admin_intern,
                                              "question" => _votes_admin_question,
                                              "answer" => _votes_admin_answer));

        $dowhat = show(_forum_dowhat_add_thread, array("kid" => $_GET['kid']));

        $index = show($dir."/thread", array("titel" => _forum_new_thread_head,
                                            "nickhead" => _nick,
                                            "topichead" => _forum_topic,
                                            "subtopichead" => _forum_subtopic,
                                            "emailhead" => _email,
                                            "id" => $_GET['kid'],
                                            "bbcodehead" => _bbcode,
                                            "reg" => "",
                                            "security" => _register_confirm,
                                            "ip" => _iplog_info,
                                            "preview" => _preview,
                                            "form" => $form,
                                            "eintraghead" => _eintrag,
                                            "what" => _button_value_add,
                                            "dowhat" => $dowhat,
                                            "error" => "",
                                            "posttopic" => "",
                                            "postsubtopic" => "",
                                            "posthp" => "",
                                            "postnick" => "",
                                            "postemail" => "",
                                            "admin" => $admin,
                                            "vote" => $vote,
                                            "posteintrag" => ""));
      } else {
        $index = common::error(show(_error_flood_post, array("sek" => settings::get('f_forum'))), 1);
      }
    }
  } elseif($do == "addthread") {
      if(common::$sql['default']->rows("SELECT id FROM `{prefix_forumsubkats}` WHERE id = '".(int)($_GET['kid'])."'") == 0) {
          $index = common::error(_id_dont_exist, 1);
      } else {
        if(settings::get("reg_forum") && !common::$chkMe)
        {
            $index = common::error(_error_have_to_be_logged, 1);
        } else {
            if(common::$userid >= 1)
                $toCheck = empty($_POST['eintrag']) || empty($_POST['topic']);
            else
                $toCheck = empty($_POST['topic']) || empty($_POST['nick']) || empty($_POST['email']) || empty($_POST['eintrag']) || !common::check_email($_POST['email']) || !common::$securimage->check($_POST['secure']);
            if($toCheck) {
                if(common::$userid >= 1) {
                    if(empty($_POST['eintrag'])) $error = _empty_eintrag;
                    elseif(empty($_POST['topic'])) $error = _empty_topic;
                } else {
                    if(!common::$securimage->check($_POST['secure'])) $error = captcha_mathematic ? _error_invalid_regcode_mathematic : _error_invalid_regcode;
                    elseif(empty($_POST['topic'])) $error = _empty_topic;
                    elseif(empty($_POST['nick'])) $error = _empty_nick;
                    elseif(empty($_POST['email'])) $error = _empty_email;
                    elseif(!common::check_email($_POST['email'])) $error = _error_invalid_email;
                    elseif(empty($_POST['eintrag'])) $error = _empty_eintrag;
                }

                $error = show("errors/errortable", array("error" => $error));

                if(common::permission("forum")) {
                    if(isset($_POST['sticky'])) $sticky = "checked";
                    if(isset($_POST['global'])) $global = "checked";

                    $admin = show($dir."/form_admin", array("adminhead" => _forum_admin_head,
                                                                                                    "addsticky" => _forum_admin_addsticky,
                                                                                                    "sticky" => $sticky,
                                                                                                    "addglobal" => _forum_admin_addglobal,
                                                                                                    "global" => $global));
                } else {
                    $admin = "";
                }

                if(common::$userid >= 1)
                {
                    $form = show("page/editor_regged", array("nick" => common::autor(common::$userid),
                                                                                                     "von" => _autor));
                } else {
                    $form = show("page/editor_notregged", array("nickhead" => _nick,
                                                                                                            "emailhead" => _email,
                                                                                                            "hphead" => _hp));
                }

            $fget = common::$sql['default']->fetch("SELECT s1.intern,s2.id FROM `{prefix_forumkats}` AS s1
                                                 LEFT JOIN `{prefix_forumsubkats}` AS s2 ON s2.`sid` = s1.id
                                                 WHERE s2.`id` = '".(int)($_GET['kid'])."'");

            if($_POST['intern']) $intern = 'checked="checked"';
            $intern = ''; $intern_kat = ''; $internVisible = '';
            if($fget['intern'] == 1) { $intern = 'checked="checked"'; $internVisible = 'style="display:none"'; };
            if($_POST['closed']) $closed = 'checked="checked"';

            if(!empty($_POST['question'])) $display = "";
            $display = "none";

            $vote = show($dir."/form_vote", array("head" => _votes_admin_head,
                            "value" => _button_value_add,
                            "what" => "&amp;do=add",
                            "question1" => stringParser::decode($_POST['question']),
                            "a1" => $_POST['a1'],
                            "closed" => $closed,
                            "br1" => "<!--",
                            "br2" => "-->",
                            "tgl" => "expand",
                            "display" => $display,
                            "a2" => $_POST['a2'],
                            "a3" => $_POST['a3'],
                            "a4" => $_POST['a4'],
                            "a5" => $_POST['a5'],
                            "a6" => $_POST['a6'],
                            "a7" => $_POST['a7'],
                            "error" => $error,
                            "a8" => $_POST['a8'],
                            "a9" => $_POST['a9'],
                            "a10" => $_POST['a10'],
                            "vote_del" => _forum_vote_del,
                            'intern_kat' => $internVisible,
                            "intern" => $intern,
                            "interna" => _votes_admin_intern,
                            "question" => _votes_admin_question,
                            "answer" => _votes_admin_answer));

                    $dowhat = show(_forum_dowhat_add_thread, array("kid" => $_GET['kid']));
                $index = show($dir."/thread", array("titel" => _forum_new_thread_head,
                                                    "nickhead" => _nick,
                                                                                            "reg" => "",
                                                                                            "subtopichead" => _forum_subtopic,
                                                                                            "topichead" => _forum_topic,
                                                                                            "form" => $form,
                                                    "bbcodehead" => _bbcode,
                                                    "emailhead" => _email,
                                                    "id" => $_GET['kid'],
                                                                                            "security" => _register_confirm,
                                                                                            "what" => _button_value_add,
                                                                                            "preview" => _preview,
                                                                                            "dowhat" => $dowhat,
                                                                                            "posthp" => $_POST['hp'],
                                                "postemail" => $_POST['email'],
                                                "postnick" => stringParser::decode($_POST['nick']),
                                                                                            "ip" => _iplog_info,
                                                "posteintrag" => stringParser::decode($_POST['eintrag']),
                                                                                            "posttopic" => stringParser::decode($_POST['topic']),
                                                                                            "postsubtopic" => stringParser::decode($_POST['subtopic']),
                                                "error" => $error,
                                                                                            "admin" => $admin,
                                                "vote" => $vote,
                                                    "eintraghead" => _eintrag));
            } else {
                if(!empty($_POST['question']))
                {
                        $fgetvote = common::$sql['default']->fetch("SELECT s1.intern,s2.id "
                                . "FROM `{prefix_forumkats}` AS s1 "
                                . "LEFT JOIN `{prefix_forumsubkats}` AS s2 "
                                . "ON s2.`sid` = s1.id "
                                . "WHERE s2.`id` = '".(int)($_GET['kid'])."'");

                        if($fgetvote['intern'] == 1) $ivote = "`intern` = '1',";
                        else $ivote = "`intern` = '".(int)($_POST['intern'])."',";

                    common::$sql['default']->insert("INSERT INTO `{prefix_votes}`
                                             SET `datum`  = '".time()."',
                                                     `titel`  = '".stringParser::encode($_POST['question'])."',
                                                     ".$ivote."
                                                     `forum`  = 1,
                                                     `von`    = '".(int)(common::$userid)."'");

                        $vid = common::$sql['default']->lastInsertId();

                    common::$sql['default']->insert("INSERT INTO `{prefix_vote_results}`
                                            SET `vid`   = '".(int)($vid)."',
                                                    `what`  = 'a1',
                                                    `sel`   = '".stringParser::encode($_POST['a1'])."'");

                    common::$sql['default']->insert("INSERT INTO `{prefix_vote_results}`
                                             SET `vid`  = '".(int)($vid)."',
                                                     `what` = 'a2',
                                                     `sel`  = '".stringParser::encode($_POST['a2'])."'");

                        if(!empty($_POST['a3']))
                        {
                            common::$sql['default']->insert("INSERT INTO `{prefix_vote_results}`
                                                 SET `vid`  = '".(int)($vid)."',
                                                         `what` = 'a3',
                                                         `sel`  = '".stringParser::encode($_POST['a3'])."'");
                        }
                        if(!empty($_POST['a4']))
                        {
                            common::$sql['default']->insert("INSERT INTO `{prefix_vote_results}`
                                                 SET `vid`  = '".(int)($vid)."',
                                                         `what` = 'a4',
                                                         `sel`  = '".stringParser::encode($_POST['a4'])."'");
                        }
                        if(!empty($_POST['a5']))
                        {
                            common::$sql['default']->insert("INSERT INTO `{prefix_vote_results}`
                                                 SET `vid`  = '".(int)($vid)."',
                                                         `what` = 'a5',
                                                         `sel`  = '".stringParser::encode($_POST['a5'])."'");
                        }
                        if(!empty($_POST['a6']))
                        {
                            common::$sql['default']->insert("INSERT INTO `{prefix_vote_results}`
                                                 SET `vid`  = '".(int)($vid)."',
                                                         `what` = 'a6',
                                                         `sel`  = '".stringParser::encode($_POST['a6'])."'");
                        }
                        if(!empty($_POST['a7']))
                        {
                            common::$sql['default']->insert("INSERT INTO `{prefix_vote_results}`
                                                 SET `vid`  = '".(int)($vid)."',
                                                         `what` = 'a7',
                                                         `sel`  = '".stringParser::encode($_POST['a7'])."'");
                        }
                        if(!empty($_POST['a8']))
                        {
                            common::$sql['default']->insert("INSERT INTO `{prefix_vote_results}`
                                                 SET `vid`  = '".(int)($vid)."',
                                                         `what` = 'a8',
                                                         `sel`  = '".stringParser::encode($_POST['a8'])."'");
                        }
                        if(!empty($_POST['a9']))
                        {
                            common::$sql['default']->insert("INSERT INTO `{prefix_vote_results}`
                                                 SET `vid`  = '".(int)($vid)."',
                                                         `what` = 'a9',
                                                         `sel`  = '".stringParser::encode($_POST['a9'])."'");
                        }
                        if(!empty($_POST['a10']))
                        {
                            common::$sql['default']->insert("INSERT INTO `{prefix_vote_results}`
                                                 SET `vid`  = '".(int)($vid)."',
                                                         `what` = 'a10',
                                                         `sel`  = '".stringParser::encode($_POST['a10'])."'");
                        }
            } else { $vid = ""; }

                common::$sql['default']->insert("INSERT INTO `{prefix_forumthreads}`
                                 SET     `kid`      = '".(int)($_GET['kid'])."',
                                                `t_date`   = '".time()."',
                                                `topic`    = '".stringParser::encode($_POST['topic'])."',
                                                `subtopic` = '".stringParser::encode($_POST['subtopic'])."',
                                                `t_reg`    = '".(int)(common::$userid)."',
                                                `t_text`   = '".stringParser::encode($_POST['eintrag'])."',
                                                `sticky`   = '".(int)($_POST['sticky'])."',
                                                `global`   = '".(int)($_POST['global'])."',
                                                `ip`       = '".common::$userip."',
                                                `lp`       = '".time()."',
                                                `vote`     = '".$vid."',
                                                `first`    = '1'");
                $thisFID = common::$sql['default']->lastInsertId();
                common::setIpcheck("fid(".$_GET['kid'].")");
                common::$sql['default']->update("UPDATE `{prefix_userstats}` SET `forumthreads` = forumthreads+1 WHERE `user` = '".common::$userid."'");

                $index = common::info(_forum_newthread_successful, "?action=showthread&amp;id=".$thisFID."#p1");
            }
        }
  }
  }
}