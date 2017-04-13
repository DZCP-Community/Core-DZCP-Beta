<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */

## OUTPUT BUFFER START ##
include("../inc/buffer.php");

## INCLUDES ##
include(basePath."/inc/common.php");

## Include PHP-Code ##
function phpParser($code,$php=false) {
    global $designpath;
    if($php && php_code_enabled) {
        ob_start(); unset($php);
        $dir = $designpath;
        $html = preg_replace_callback("/\[php\](.*?)\[\/php\]/",
                create_function('$code','$code[1] = strip_tags($code[1]); return \'[base64]\'.base64_encode($code[1]).\'[/base64]\';'), $code);
        $code_output = trim("echo \"".addslashes($html)."\";"); unset($html);
        $code_output = preg_replace_callback("/\[base64\](.*?)\[\/base64\]/",
                create_function('$base64','return \'"; \'.base64_decode($base64[1]).\' echo "\';'), $code_output);
        eval($code_output); unset($code_output);
        $output_index = ob_get_contents();
        ob_end_clean();
        return $output_index;
    }
    
    return $code;
}

## SETTINGS ##
$dir = "sites";
$where = "";
$smarty = common::getSmarty(); //Use Smarty

## SECTIONS ##
switch ($action):
default:
    $get = common::$sql['default']->fetch("SELECT s1.*,s2.`internal` "
                            . "FROM `{prefix_sites}` AS `s1` "
                            . "LEFT JOIN `{prefix_navi}` AS `s2` "
                            . "ON s1.`id` = s2.`editor` "
                            . "WHERE s1.`id` = ?;",array(intval($_GET['show'])));
    if(common::$sql['default']->rowCount()) {
        $navi_access = false;
        $navi = common::$sql['default']->fetch("SELECT s2.level FROM `{prefix_navi}` AS `s1` "
                . "LEFT JOIN `{prefix_navi_kats}` AS `s2` ON s1.`kat` = s2.`placeholder` "
                . "WHERE s1.`editor` = ?;",array($get['id']));
        if(common::$sql['default']->rowCount()) {
            $navi_access = !(common::$chkMe >= $navi['level'] || common::admin_perms(common::$userid));
        }

        if(($get['internal'] && !common::$chkMe) || $navi_access) {
            $index = common::error(_error_wrong_permissions, 1);
        } else {
            $where = stringParser::decode($get['titel']);
            if($get['html']) {
                $inhalt = bbcode::parse_html(stringParser::encode(phpParser(stringParser::decode($get['text']),$get['php'])));
            } else { 
                $inhalt = phpParser(stringParser::decode($get['text']),$get['php']);
            }

            $index = show($dir."/sites", array("titel" => stringParser::decode($get['titel']), "inhalt" => $inhalt));
        }
    } else {
        $index = common::error(_sites_not_available,1);
    }
break;
case 'preview';
    header("Content-type: text/html; charset=utf-8");
    if(isset($_POST['html'])) {
        $inhalt = bbcode::parse_html(stringParser::encode(phpParser(stringParser::decode($_POST['inhalt']),(isset($_POST['php']) && common::permission('phpexecute')))));
    } else {
        $inhalt = phpParser(stringParser::decode($_POST['inhalt']),(isset($_POST['php']) && common::permission('phpexecute')));
    }

    $index = show($dir."/sites", array("titel" => stringParser::decode($_POST['titel']), "inhalt" => $inhalt));
    exit(utf8_encode('<table class="mainContent" cellspacing="1"'.$index.'</table>'));
break;
endswitch;

## INDEX OUTPUT ##
$title = common::$pagetitle." - ".$where;
common::page($index, $title, $where);