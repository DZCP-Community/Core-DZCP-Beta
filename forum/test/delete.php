<?php
$get = common::$sql['default']->fetch("SELECT * FROM `{prefix_forumposts}` WHERE id = '".(int)($_GET['id'])."'");
if($get['reg'] == common::$userid || common::permission("forum"))
{
    common::$sql['default']->delete("DELETE FROM `{prefix_forumposts}`
                 WHERE id = '".(int)($_GET['id'])."'");

    common::$sql['default']->update("UPDATE `{prefix_forumthreads}`
                                                SET `posts` = (posts-1) 
                                                WHERE id = '".(int)($get['sid'])."'");

    $fposts = common::userstats("forumposts",$get['reg'])-1;
    common::$sql['default']->update("UPDATE `{prefix_userstats}`
                 SET `forumposts` = '".(int)($fposts)."'
                 WHERE user = '".$get['reg']."'");

    $entrys = common::cnt("{prefix_forumposts}", " WHERE `sid` = ".$get['sid']);

    if($entrys == "0")
    {
        $pagenr = "1";
        common::$sql['default']->update("UPDATE `{prefix_forumthreads}`
                      SET `first` = '1'
                      WHERE kid = '".$get['kid']."'");
    } else {
        $pagenr = ceil($entrys/settings::get('m_fposts'));
    }

    $lpost = show(_forum_add_lastpost, array("id" => $entrys+1,
        "tid" => $get['sid'],
        "page" => $pagenr));

    $index = common::info(_forum_delpost_successful, $lpost);
}