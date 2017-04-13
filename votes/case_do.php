<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */

if(defined('_Votes')) {
    if(isset($_GET['what']) && $_GET['what'] == "vote") {
        if(empty($_POST['vote'])) {
            $index = common::error(_vote_no_answer);
        } else {
            $get = common::$sql['default']->fetch("SELECT `id`,`closed`,`intern` FROM `{prefix_votes}` WHERE `id` = ?;",array(intval($_GET['id'])));
            if($get['intern'] && common::$chkMe >= 1) {
                if(!common::count_clicks('vote',$get['id'])) {
                    $index = common::error(_error_voted_again,1);
                } else if($get['closed']) {
                    $index = common::error(_error_vote_closed,1);
                } else {
                    common::$sql['default']->update("UPDATE `{prefix_userstats}` SET `votes` = (votes+1) WHERE `user` = ?;",array(common::$userid));
                    common::$sql['default']->update("UPDATE `{prefix_vote_results}` SET `stimmen` = (stimmen+1) WHERE `id` = ?;",array(intval($_POST['vote'])));

                    common::setIpcheck("vid_".intval($_GET['id']),false);
                    common::setIpcheck("vid(".intval($_GET['id']).")");

                    if(!isset($_GET['ajax'])) {
                        $index = common::info(_vote_successful, "?show=".$_GET['id']."");
                    }
                }
            } else {
                if(!common::count_clicks('vote',intval($_GET['id']))) {
                    $index = common::error(_error_voted_again,1);
                } else if($get['closed']) {
                    $index = common::error(_error_vote_closed,1);
                } else {
                    if(common::$userid >= 1) {
                        common::$sql['default']->update("UPDATE `{prefix_userstats}` SET `votes` = (votes+1) WHERE `user` = ?;",array(common::$userid));
                    }

                    common::$sql['default']->update("UPDATE `{prefix_vote_results}` SET `stimmen` = (stimmen+1) WHERE `id` = ?;",array(intval($_POST['vote'])));
                    common::setIpcheck("vid_".intval($_GET['id']),false);
                    common::setIpcheck("vid(".intval($_GET['id']).")");

                    if(!isset($_GET['ajax'])) {
                        $index = common::info(_vote_successful, "?show=".intval($_GET['id'])."");
                    }
                }
            }

            $cookie = (common::$userid >= 1 ? common::$userid : "voted");
            cookie::put('vid_'.intval($_GET['id']), $cookie);
        }

        if(isset($_GET['ajax'])) {
            header("Content-type: text/html; charset=utf-8");
            require_once(basePath.'/inc/menu-functions/vote.php');
            echo utf8_encode('<table class="navContent" cellspacing="0">'.vote(1).'</table>');
            cookie::save();
            exit();
        }
    }

    if(isset($_GET['what']) && $_GET['what'] == "fvote") {
        if(empty($_POST['vote'])) {
            $index = common::error(_vote_no_answer);
        } else {
            $get = common::$sql['default']->fetch("SELECT `id`,`closed` FROM `{prefix_votes}` WHERE `id` = ?;",array(intval($_GET['id'])));
            if(!common::count_clicks('vote',$get['id'])) {
                $index = common::error(_error_voted_again,1);
            } else if($get['closed']) {
                $index = common::error(_error_vote_closed,1);
            } else {
                if(common::$userid >= 1) {
                    common::$sql['default']->update("UPDATE `{prefix_userstats}` SET `votes` = (votes+1) WHERE `user` = ?;",array(common::$userid));
                }

                common::$sql['default']->update("UPDATE `{prefix_vote_results}` SET `stimmen` = (stimmen+1) WHERE `id` = ?;",array(intval($_POST['vote'])));
                common::setIpcheck("vid_".intval($_GET['id']),false);
                common::setIpcheck("vid(".intval($_GET['id']).")");

                if(!isset($_GET['fajax'])) {
                    $index = common::info(_vote_successful, "../forum/?action=showthread&amp;kid=".intval($_POST['kid'])."&amp;id=".intval($_POST['fid'])."");
                }
            }
        }

        $cookie = common::$userid >= 1 ? common::$userid : "voted";
        cookie::put('vid_'.intval($_GET['id']), $cookie);
    }

    if(isset($_GET['fajax'])) {
        require_once(basePath.'/inc/menu-functions/fvote.php');
        header("Content-type: text/html; charset=utf-8");
        echo utf8_encode(fvote($_GET['id'], 1));
        cookie::save();
        exit();
    }
}