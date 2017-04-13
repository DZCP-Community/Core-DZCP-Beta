<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */

if(_adminMenu != 'true') exit;
$where = $where.': '._votes_head;

switch ($do) {
    case 'new':
        $error = '';
        if($_POST) {
            if(empty($_POST['question']) || empty($_POST['a1']) || empty($_POST['a2'])) {
                if(empty($_POST['question'])) 
                    $error = _empty_votes_question;
                elseif(empty($_POST['a1']))   
                    $error = _empty_votes_answer;
                elseif(empty($_POST['a2']))   
                    $error = _empty_votes_answer;

                $error = show("errors/errortable", array("error" => $error));
            } else {
                common::$sql['default']->insert("INSERT INTO `{prefix_votes}` SET `datum` = ?, `titel` = ?, `intern` = ?, `von` = ?",
                      array(time(),stringParser::encode($_POST['question']),intval($_POST['intern']),intval(common::$userid)));

                $vid = common::$sql['default']->lastInsertId();
                for($i=1; $i<=10; $i++) {
                    if(!empty($_POST['a'.$i])) {
                        common::$sql['default']->insert("INSERT INTO `{prefix_vote_results}` SET `vid` = ?, `what` = ?, `sel` = ?;",
                            array($vid,'a'.$i,stringParser::encode($_POST['a'.$i])));
                    }
                }

                $show = common::info(_vote_admin_successful, "?admin=votes");
            }
        }
        
        $intern = (isset($_POST['intern']) ? 'checked="checked"' : '');
        $show = show($dir."/form_vote", array("head" => _votes_admin_head,
                                              "value" => _button_value_add,
                                              "what" => "&amp;do=add",
                                              "question1" => isset($_POST['question']) ? $_POST['question'] : '',
                                              "a1" => isset($_POST['a1']) ? $_POST['a1'] : '',
                                              "closed" => "",
                                              "br1" => "<!--",
                                              "br2" => "-->",
                                              "a2" => isset($_POST['a2']) ? $_POST['a2'] : '',
                                              "a3" => isset($_POST['a3']) ? $_POST['a3'] : '',
                                              "a4" => isset($_POST['a4']) ? $_POST['a4'] : '',
                                              "a5" => isset($_POST['a5']) ? $_POST['a5'] : '',
                                              "a6" => isset($_POST['a6']) ? $_POST['a6'] : '',
                                              "a7" => isset($_POST['a7']) ? $_POST['a7'] : '',
                                              "error" => $error,
                                              "a8" => isset($_POST['a8']) ? $_POST['a8'] : '',
                                              "a9" => isset($_POST['a9']) ? $_POST['a9'] : '',
                                              "a10" => isset($_POST['a10']) ? $_POST['a10'] : '',
                                              "intern" => $intern));
    break;
    case 'delete':
        common::$sql['default']->delete("DELETE FROM `{prefix_votes}` WHERE `id` = ?;",array(intval($_GET['id'])));
        common::$sql['default']->delete("DELETE FROM `{prefix_vote_results}` WHERE `vid` = ?;",array(intval($_GET['id'])));
        common::$sql['default']->delete("DELETE FROM `{prefix_ipcheck}` WHERE `what` = ?;",array('vid_'.intval($_GET['id'])));
        $show = common::info(_vote_admin_delete_successful, "?admin=votes");
    break;
    case 'editvote':
        $get = common::$sql['default']->fetch("SELECT `id` FROM `{prefix_vote_results}` WHERE `vid` = ?;",array(intval($_GET['id'])));
        if(common::$sql['default']->rowCount()) {
            common::$sql['default']->update("UPDATE `{prefix_votes}` SET `titel`  = ?, `intern` = ?, `closed` = ? WHERE `id` = ?;",
                    array(stringParser::encode($_POST['question']),intval($_POST['intern']),intval($_POST['closed']),$get['id']));

            for($i=1; $i<=10; $i++) {
              if(!empty($_POST['a'.$i.''])) {
                if(common::cnt("{prefix_vote_results}", " WHERE `vid` = ? AND `what` = ?;","id",array(intval($_GET['id']),'a'.$i)) != 0) {
                    common::$sql['default']->update("UPDATE `{prefix_vote_results}` SET `sel` = ? WHERE `what` = ? AND `vid` = ?;",array(stringParser::encode($_POST['a'.$i]),'a'.$i,$get['id']));
                } else {
                    common::$sql['default']->insert("INSERT INTO `{prefix_vote_results}` SET `vid` = ?, `what` = ?, `sel` = ?;",array($get['id'],'a'.$i,stringParser::encode($_POST['a'.$i.''])));
                }
              }

              if(common::cnt("{prefix_vote_results}", " WHERE vid = '".$get['id']."' AND what = 'a".$i."'") != 0 && empty($_POST['a'.$i.'']))
              {
                  common::$sql['default']->delete("DELETE FROM `{prefix_vote_results}` WHERE vid = '".$get['id']."' AND what = 'a".$i."'");
              }
            }

            $show = common::info(_vote_admin_successful_edited, "?admin=votes");
        }
    break;
    case 'edit':
        $get = common::$sql['default']->fetch("SELECT `id`,`titel`,`intern` FROM `{prefix_votes}` WHERE `id` = ?;",array(intval($_GET['id'])));
        $intern = ($get['intern'] ? 'checked="checked"' : '');
        $isclosed = ($get['intern'] ? 'checked="checked"' : '');
        $what = "&amp;do=editvote&amp;id=".$_GET['id']."";

        $show = show($dir."/form_vote", array("head" => _votes_admin_edit_head,
                                              "value" => "edit",
                                              "id" => $_GET['id'],
                                              "what" => $what,
                                              "value" => _button_value_edit,
                                              "br1" => "",
                                              "br2" => "",
                                              "question1" => stringParser::decode($get['titel']),
                                              "a1" => common::voteanswer("a1",$get['id']),
                                              "a2" => common::voteanswer("a2",$get['id']),
                                              "a3" => common::voteanswer("a3",$get['id']),
                                              "a4" => common::voteanswer("a4",$get['id']),
                                              "a5" => common::voteanswer("a5",$get['id']),
                                              "a6" => common::voteanswer("a6",$get['id']),
                                              "a7" => common::voteanswer("a7",$get['id']),
                                              "error" => "",
                                              "a8" => common::voteanswer("a8",$get['id']),
                                              "a9" => common::voteanswer("a9",$get['id']),
                                              "a10" => common::voteanswer("a10",$get['id']),
                                              "intern" => $intern,
                                              "isclosed" => $isclosed));
    break;
    case 'menu':
        if(common::$sql['default']->rows("SELECT `intern` FROM `{prefix_votes}` WHERE `id` = ? AND `intern` = 1;",array(intval($_GET['id'])))) {
          $show = common::error(_vote_admin_menu_isintern, 1);
        } else {
          $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_votes}` WHERE `id` = ?;",array(intval($_GET['id'])));
          if($get['menu'] == 1) {
              common::$sql['default']->update("UPDATE `{prefix_votes}` SET menu = 0;");
                header("Location: ?admin=votes");
            } else {
              common::$sql['default']->update("UPDATE `{prefix_votes}` SET `menu` = 0;");
              common::$sql['default']->update("UPDATE `{prefix_votes}` SET `menu` = 1 WHERE `id` = ?;",array(intval($_GET['id'])));
                header("Location: ?admin=votes");
            }
        }
    break;
    default:
        $qry = common::$sql['default']->select("SELECT * FROM `{prefix_votes}` WHERE `forum` = 0 ORDER BY `datum` DESC;");
        foreach($qry as $get) {
            if(common::$sql['default']->rowCount()) {
                $edit = show("page/button_edit_single", array("id" => $get['id'],
                                                              "action" => "admin=votes&amp;do=edit",
                                                              "title" => _button_title_edit));

                $delete = show("page/button_delete_single", array("id" => $get['id'],
                                                                  "action" => "admin=votes&amp;do=delete",
                                                                  "title" => _button_title_del,
                                                                  "del" => _confirm_del_vote));

                $icon = $get['menu'] ? "yes" : "no";
                $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
                $show .= show($dir."/votes_show", array("date" => date("d.m.Y",$get['datum']),
                                                         "vote" => stringParser::decode($get['titel']),
                                                         "class" => $class,
                                                         "edit" => $edit,
                                                         "icon" => $icon,
                                                         "delete" => $delete,
                                                         "autor" => common::autor($get['von']),
                                                         "id" => $get['id']));
            }
        }

        if(empty($show))
            $show = show(_no_entrys_yet, array("colspan" => "6"));
        
        $show = show($dir."/votes", array("show" => $show));
    break;
}