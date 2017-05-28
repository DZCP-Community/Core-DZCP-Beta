<?php
$get = common::$sql['default']->fetch("SELECT * FROM `{prefix_forumposts}` WHERE id = '".(int)($_GET['id'])."'");

if($get['reg'] == common::$userid || common::permission("forum"))
{
    $dowhat = show(_forum_dowhat_edit_post, array("id" => $_GET['id']));
    $index = show($dir."/post", array("titel" => _forum_edit_post_head,
        "nickhead" => _nick,
        "emailhead" => _email,
        "kid" => "",
        "id" => $_GET['id'],
        "ip" => _iplog_info,
        "dowhat" => $dowhat,
        "form" => common::editor_is_reg($get),
        "zitat" => $zitat,
        "preview" => _preview,
        "br1" => "<!--",
        "br2" => "-->",
        "security" => _register_confirm,
        "lastpost" => "",
        "last_post" => _forum_no_last_post,
        "bbcodehead" => _bbcode,
        "eintraghead" => _eintrag,
        "error" => "",
        "what" => _button_value_edit,
        "posteintrag" => stringParser::decode($get['text'])));
} else {
    $index = common::error(_error_wrong_permissions, 1);
}