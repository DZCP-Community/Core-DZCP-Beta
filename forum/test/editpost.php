<?php
$get = common::$sql['default']->fetch("SELECT reg FROM `{prefix_forumposts}` WHERE id = '".(int)($_GET['id'])."'");
if($get['reg'] == common::$userid || common::permission("forum"))
{
    if($get['reg'] != 0 || common::permission('forum'))
    {
        $toCheck = empty($_POST['eintrag']);
    } else {
        $toCheck = empty($_POST['nick']) || empty($_POST['email']) || empty($_POST['eintrag']) || !common::$securimage->check($_POST['secure']);
    }

    if($toCheck)
    {

        if(empty($_POST['eintrag']))
            $error = _empty_eintrag;

        $error = show("errors/errortable", array("error" => $error));
        $dowhat = show(_forum_dowhat_edit_post, array("id" => $_GET['id']));
        $index = show($dir."/post", array("titel" => _forum_edit_post_head,
            "nickhead" => _nick,
            "bbcodehead" => _bbcode,
            "preview" => _preview,
            "emailhead" => _email,
            "zitat" => $zitat,
            "form" => common::editor_is_reg(array('reg'=>common::$userid)),
            "dowhat" => $dowhat,
            "security" => _register_confirm,
            "what" => _button_value_edit,
            "ip" => _iplog_info,
            "id" => $_GET['id'],
            "kid" => $_SESSION['kid'],
            "br1" => "<!--",
            "br2" => "-->",
            "postemail" => stringParser::decode($get['email']),
            "postnick" => stringParser::decode($get['nick']),
            "posteintrag" => stringParser::decode($_POST['eintrag']),
            "error" => $error,
            "eintraghead" => _eintrag));
    } else {
        $getp = common::$sql['default']->fetch("SELECT * FROM `{prefix_forumposts}` WHERE id = '".(int)($_GET['id'])."'");

        //-> Editby Text
        $smarty->caching = false;
        $smarty->assign('autor',common::autor(common::$userid));
        $smarty->assign('time',date("d.m.Y H:i", time()));
        $editedby = $smarty->fetch('string:'._edited_by);
        $smarty->clearAllAssign();

        common::$sql['default']->update("UPDATE `{prefix_forumposts}`
                   SET `nick`   = '".stringParser::encode($_POST['nick'])."',
                       `email`  = '".stringParser::encode($_POST['email'])."',
                       `text`   = '".stringParser::encode($_POST['eintrag'])."',
                       `hp`     = '".common::links($_POST['hp'])."',
                       `edited` = '".stringParser::encode($editedby)."'
                   WHERE id = '".(int)($_GET['id'])."'");

        send_forum_abo(false, $getp['sid'],$_POST['eintrag'],true);

        $entrys = common::cnt("{prefix_forumposts}", " WHERE `sid` = ?","id",[$getp['sid']]);
        $pagenr = !$entrys ? 1 : ceil($entrys/settings::get('m_fposts'));
        $index = common::info(_forum_editpost_successful, '?action=showthread&amp;id='.$getp['sid'].'&amp;page='.$pagenr.'#p'.($entrys+1));
    }
} else {
    $index = common::error(_error_wrong_permissions, 3);
}