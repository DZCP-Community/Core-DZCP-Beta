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

    $entrys = common::cnt("{prefix_forumposts}", " WHERE `sid` = ?","id",[$get['sid']]);
    if(!$entrys) {
        common::$sql['default']->update("UPDATE `{prefix_forumthreads}` SET `first` = 1 WHERE `kid` = ?",[$get['kid']]);
    }

    $pagenr = !$entrys ? 1 : ceil($entrys/settings::get('m_fposts'));
    $index = common::info(_forum_delpost_successful, '?action=showthread&amp;id='.$get['sid'].'&amp;page='.$pagenr.'#p'.($entrys+1));
}