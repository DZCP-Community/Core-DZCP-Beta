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

if(_adminMenu != 'true') exit;

$where = $where.': '._kalender_head;
switch ($do) {
    case 'add':
        if(isset($_POST['title'])) {
            if(empty($_POST['title']) || empty($_POST['event'])) {
                if(empty($_POST['title']))     
                    $show = common::error(_kalender_error_no_title,1);
                elseif(empty($_POST['event'])) 
                    $show = common::error(_kalender_error_no_event,1);
            } else {
                $time = mktime($_POST['h'],$_POST['min'],0,$_POST['m'],$_POST['t'],$_POST['j']);
                common::$sql['default']->insert("INSERT INTO `{prefix_events}` SET `datum` = ?, `title` = ?, `event` = ?;",
                    array(intval($time),stringParser::encode($_POST['title']),stringParser::encode($_POST['event'])));

                $show = common::info(_kalender_successful_added,"?admin=kalender");
            }
        } else {
            $dropdown_date = common::dropdown_date(common::dropdown("day",date("d",time())),
                common::dropdown("month",date("m",time())),
                common::dropdown("year",date("Y",time())));

            $dropdown_time = common::dropdown_date(common::dropdown("hour",date("H",time())),
                common::dropdown("minute",date("i",time())));

            $show = show($dir."/form_kalender", array("dropdown_time" => $dropdown_time,
                                                      "dropdown_date" => $dropdown_date,
                                                      "what" => _button_value_add,
                                                      "do" => "addevent",
                                                      "k_event" => "",
                                                      "k_beschreibung" => "",
                                                      "head" => _kalender_admin_head));
        }
    break;
    case 'edit':
        $get = common::$sql['default']->fetch("SELECT `datum`,`title`,`event` FROM `{prefix_events}` WHERE `id` = ?;",array(intval($_GET['id'])));

        $dropdown_date = common::dropdown_date(common::dropdown("day",date("d",$get['datum'])),
            common::dropdown("month",date("m",$get['datum'])),
            common::dropdown("year",date("Y",$get['datum'])));

        $dropdown_time = common::dropdown_time(common::dropdown("hour",date("H",$get['datum'])),
            common::dropdown("minute",date("i",$get['datum'])));

        $show = show($dir."/form_kalender", array("dropdown_time" => $dropdown_time,
                                                  "dropdown_date" => $dropdown_date,
                                                  "what" => _button_value_edit,
                                                  "do" => "editevent&amp;id=".$_GET['id'],
                                                  "k_event" => stringParser::decode($get['title']),
                                                  "k_beschreibung" => stringParser::decode($get['event']),
                                                  "head" => _kalender_admin_head_edit));
    break;
    case 'editevent':
        if(empty($_POST['title']) || empty($_POST['event'])) {
            if(empty($_POST['title']))     
                $show = common::error(_kalender_error_no_title,1);
            elseif(empty($_POST['event'])) 
                $show = common::error(_kalender_error_no_event,1);
        } else {
            $time = mktime($_POST['h'],$_POST['min'],0,$_POST['m'],$_POST['t'],$_POST['j']);
            common::$sql['default']->update("UPDATE `{prefix_events}` SET `datum` = ?, `title` = ?, `event` = ? WHERE `id` = ?;",
            array(intval($time),stringParser::encode($_POST['title']),stringParser::encode($_POST['event']),intval($_GET['id'])));
            $show = common::info(_kalender_successful_edited,"?admin=kalender");
        }
    break;
    case 'delete':
        common::$sql['default']->delete("DELETE FROM `{prefix_events}` WHERE `id` = ?;",array(intval($_GET['id'])));
        $show = common::info(_kalender_deleted,"?admin=kalender");
    break;
    default:
        $qry = common::$sql['default']->select("SELECT * FROM `{prefix_events}` ".common::orderby_sql(array("event","datum"),'ORDER BY `datum` DESC').";");
        foreach($qry as $get) {
            $edit = common::getButtonEditSingle($get['id'],"admin=".$admin."&amp;do=edit");
            $delete = show("page/button_delete_single", array("id" => $get['id'],
                                                              "action" => "admin=kalender&amp;do=delete",
                                                              "title" => _button_title_del,
                                                              "del" => _confirm_del_kalender));

            $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
            $show .= show($dir."/kalender_show", array("datum" => date("d.m.y H:i", $get['datum'])._uhr,
                                                       "event" => stringParser::decode($get['title']),
                                                       "time" => $get['datum'],
                                                       "class" => $class,
                                                       "edit" => $edit,
                                                       "delete" => $delete));
        }

        if (empty($show)) {
            $show = '<tr><td colspan="4" class="contentMainSecond">' . _no_entrys . '</td></tr>';
        }

        $show = show($dir."/kalender", array("show" => $show, "order_date" => common::orderby('datum'), "order_titel" => common::orderby('event')));
    break;
}