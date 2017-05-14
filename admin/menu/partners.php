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
$where = $where.': '._partners_head;

      if($do == "add")
      {
        $files = common::get_files(basePath.'/banner/partners/',false,true);
        for($i=0; $i<count($files); $i++)
        {
          $banners .= show(_partners_select_icons, array("icon" => $files[$i],
                                                         "sel" => ""));
        }
        $show = show($dir."/form_partners", array("do" => "addbutton",
                                                  "head" => _partners_add_head,
                                                  "nothing" => "",
                                                  "banner" => _partners_button,
                                                  "link" => _link,
                                                  "e_link" => "",
                                                  "e_textlink" => "",
                                                  "or" => _or,
                                                  "textlink" => _partnerbuttons_textlink,
                                                  "banners" => $banners,
                                                  "what" => _button_value_add));
      } elseif($do == "addbutton") {
        if(empty($_POST['link']))
        {
          $show = common::error(_empty_url, 1);
        } else {
          common::$sql['default']->insert("INSERT INTO `{prefix_partners}` SET `link` = ?, `banner` = ?, `textlink` = ?;",
                  array(stringParser::encode(common::links($_POST['link'])),stringParser::encode(empty($_POST['textlink']) ? $_POST['banner'] : $_POST['textlink']),(int)(empty($_POST['textlink']) ? 0 : 1)));

          $show = common::info(_partners_added, "?admin=partners");
        }
      } elseif($do == "edit") {
        $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_partners}` WHERE `id` = ?;",array((int)($_GET['id'])));

        $files = common::get_files(basePath.'/banner/partners/',false,true);
        for($i=0; $i<count($files); $i++)
        {
          if(stringParser::decode($get['banner']) == $files[$i]) $sel = 'selected="selected"';
          else $sel = "";

          $banners .= show(_partners_select_icons, array("icon" => $files[$i],
                                                         "sel" => $sel));
        }
        $show = show($dir."/form_partners", array("do" => "editbutton&amp;id=".$get['id']."",
                                                  "head" => _partners_edit_head,
                                                  "nothing" => "",
                                                  "banner" => _partners_button,
                                                  "link" => _link,
                                                  "e_link" => stringParser::decode($get['link']),
                                                  "e_textlink" => (empty($get['textlink']) ? '' : stringParser::decode($get['banner'])),
                                                  "or" => _or,
                                                  "textlink" => _partnerbuttons_textlink,
                                                  "banners" => $banners,
                                                  "what" => _button_value_edit));
      } elseif($do == "editbutton") {
        if(empty($_POST['link'])) {
          $show = common::error(_empty_url, 1);
        } else {
          common::$sql['default']->update("UPDATE `{prefix_partners}` SET `link` = ?, `banner` = ?, `textlink` = ? WHERE `id` = ?;",
                  array(stringParser::encode(common::links($_POST['link'])),
                      stringParser::encode(empty($_POST['textlink']) ? $_POST['banner'] : $_POST['textlink']),
                      (int)(empty($_POST['textlink']) ? 0 : 1),(int)($_GET['id'])));
          $show = common::info(_partners_edited, "?admin=partners");
        }
      } elseif($do == "delete") {
        common::$sql['default']->delete("DELETE FROM `{prefix_partners}` WHERE `id` = ?;",array((int)($_GET['id'])));
        $show = common::info(_partners_deleted,"?admin=partners");
      } else {
        $qry = common::$sql['default']->select("SELECT * FROM `{prefix_partners}` ORDER BY id;");
        foreach ($qry as $get) {
            $edit = common::getButtonEditSingle($get['id'],"admin=".$admin."&amp;do=edit");
            $delete = common::button_delete_single($get['id'],"admin=".$admin."&amp;do=delete",_button_title_del,_confirm_del_entry);

          $rlink = common::links(stringParser::decode($get['link']));
          $button = '<img src="../banner/partners/'.stringParser::decode($get['banner']).'" alt="'.$rlink.'" title="'.$rlink.'" />';
          $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
          $show .= show($dir."/partners_show", array("class" => $class,
                                                      "button" => (empty($get['textlink']) ? $button : '<center>'._partnerbuttons_textlink.': <b>'.stringParser::decode($get['banner']).'</b></center>'),
                                                      "link" => stringParser::decode($get['link']),
                                                      "id" => $get['id'],
                                                      "edit" => $edit,
                                                      "delete" => $delete));
        }

        $show = show($dir."/partners", array("head" => _partners_head,
                                             "add" => _partners_link_add,
                                             "show" => $show,
                                             "edit" => _editicon_blank,
                                             "del" =>_deleteicon_blank,
                                             "link" => _link,
                                             "button" => _partners_button));
      }