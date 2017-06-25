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

    $where = $where.': '._navi_head;
      if(common::$do == "add")
      {
        $qry = common::$sql['default']->select("SELECT s2.*, s1.name AS katname, s1.placeholder FROM `{prefix_navi_kats}` AS s1 LEFT JOIN `{prefix_navi}` AS s2 ON s1.`placeholder` = s2.`kat` ORDER BY s1.name, s2.pos;");
        $thiskat = ""; $position = "";
        foreach($qry as $get) {
          if($thiskat != $get['kat']) {
            $position .= '
              <option class="dropdownKat" value="lazy">'.stringParser::decode($get['katname']).'</option>
              <option value="'.stringParser::decode($get['placeholder']).'-1">-> '._admin_first.'</option>
            ';
          }
          $thiskat = $get['kat'];

          $position .= empty($get['name']) ? '' : '<option value="'.stringParser::decode($get['placeholder']).'-'.($get['pos']+1).'">'._nach.' -> '.common::navi_name(stringParser::decode($get['name'])).'</option>';
        }

          $smarty->caching = false;
          $smarty->assign('do',"addnavi");
          $smarty->assign('what',_button_value_add);
          $smarty->assign('head',_navi_add_head);
          $smarty->assign('ja',_yes);
          $smarty->assign('intern',_config_forum_intern);
          $smarty->assign('nein',_no);
          $smarty->assign('n_name','');
          $smarty->assign('n_url','');
          $smarty->assign('atarget','');
          $smarty->assign('target',_target);
          $smarty->assign('position',$position);
          $smarty->assign('name',_navi_name);
          $smarty->assign('url',_navi_url_to);
          $smarty->assign('wichtig',_navi_wichtig);
          $smarty->assign('pos',_posi);
          $show = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/form_navi.tpl');
          $smarty->clearAllAssign();
      } elseif(common::$do == "addnavi") {
        if(empty($_POST['name']))
        {
          $show = common::error(_navi_no_name,1);
        } elseif(empty($_POST['url'])) {
          $show = common::error(_navi_no_url,1);
        } elseif($_POST['pos'] == "lazy") {
          $show = common::error(_navi_no_pos,1);
        } else {
          if($_POST['pos'] == "1" || "2") $sign = ">= ";
          else $sign = "> ";

          $kat = preg_replace('/-(\d+)/','',$_POST['pos']);
          $pos = preg_replace("=nav_(.*?)-=","",$_POST['pos']);

          common::$sql['default']->update("UPDATE `{prefix_navi}`
                      SET `pos` = pos+1
                      WHERE pos ".$sign." '".(int)($pos)."'");

          common::$sql['default']->insert("INSERT INTO `{prefix_navi}`
                      SET `pos`       = '".(int)($pos)."',
                          `kat`       = '".stringParser::encode($kat)."',
                          `name`      = '".stringParser::encode($_POST['name'])."',
                          `url`       = '".stringParser::encode($_POST['url'])."',
                          `shown`     = '1',
                          `target`    = '".(int)($_POST['target'])."',
                          `internal`  = '".(int)($_POST['internal'])."',
                          `type`      = '2',
                          `wichtig`   = '".(int)($_POST['wichtig'])."'");
          $show = common::info(_navi_added,"?admin=navi");
        }
      } elseif(common::$do == "delete") {
        $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_navi}` WHERE id = '".(int)($_GET['id'])."'");

        common::$sql['default']->delete("DELETE FROM `{prefix_sites}` WHERE id = '".(int)($get['editor'])."'");
        common::$sql['default']->delete("DELETE FROM `{prefix_navi}` WHERE id = '".(int)($_GET['id'])."'");

        $show = common::info(_navi_deleted, "?admin=navi");
      } elseif(common::$do == "edit") {
        $qry = common::$sql['default']->select("SELECT s2.*, s1.name AS katname, s1.placeholder "
                . "FROM `{prefix_navi_kats}` AS s1 "
                . "LEFT JOIN `{prefix_navi}` AS s2 "
                . "ON s1.`placeholder` = s2.`kat` "
                . "ORDER BY s1.name, s2.pos");
         $i = 1;
         $thiskat = '';
         foreach($qry as $get) {
          if($thiskat != $get['kat']) {
            $position .= '
              <option class="dropdownKat" value="lazy">'.stringParser::decode($get['katname']).'</option>
              <option value="'.stringParser::decode($get['placeholder']).'-1">-> '._admin_first.'</option>
            ';
          }
          $thiskat = $get['kat'];
          $sel[$i] = ($get['id'] == $_GET['id']) ? 'selected="selected"' : '';

          $position .= empty($get['name']) ? '' : '<option value="'.stringParser::decode($get['placeholder']).'-'.($get['pos']+1).'" '.$sel[$i].'>'._nach.' -> '.common::navi_name(stringParser::decode($get['name'])).'</option>';

          $i++;
        }

        $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_navi}` WHERE id = '".(int)($_GET['id'])."'");

        if($get['type'] == "1")
        {
          $name = stringParser::decode($get['name']);
          $read = "readonly";
        } else {
          $name = stringParser::decode($get['name']);
          $read = "";
        }

        if($get['wichtig'] == "1") $selw = 'selected="selected"';
        if($get['shown'] == "1") $sels = 'selected="selected"';
        if($get['internal'] == "1") $seli = 'selected="selected"';
        if($get['target'] == "1") $target = 'selected="selected"';

          $smarty->caching = false;
          $smarty->assign('name',_navi_name);
          $smarty->assign('url',_navi_url_to);
          $smarty->assign('wichtig',_navi_wichtig);
          $smarty->assign('pos',_posi);
          $smarty->assign('atarget',$target);
          $smarty->assign('target',_target);
          $smarty->assign('n_name',$name);
          $smarty->assign('n_url',$get['url']);
          $smarty->assign('what',_button_value_edit);
          $smarty->assign('do',"editlink&amp;id=".$get['id']."");
          $smarty->assign('ja',_yes);
          $smarty->assign('intern',_config_forum_intern);
          $smarty->assign('seli',$seli);
          $smarty->assign('sichtbar',_navi_shown);
          $smarty->assign('sels',$sels);
          $smarty->assign('position',$position);
          $smarty->assign('selw',$selw);
          $smarty->assign('read',$read);
          $smarty->assign('nein',_no);
          $smarty->assign('head',_navi_edit_head);
          $show = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/form_navi_edit.tpl');
          $smarty->clearAllAssign();
      } elseif(common::$do == "editlink") {
        if($_POST['pos'] == "1" || "2") $sign = ">= ";
        else $sign = "> ";

        $kat = preg_replace('/-(\d+)/','',$_POST['pos']);
        $pos = preg_replace("=nav_(.+)-=","",$_POST['pos']);

        common::$sql['default']->update("UPDATE `{prefix_navi}`
                    SET pos = pos+1
                    WHERE pos ".$sign." '".(int)($pos)."'");

        common::$sql['default']->update("UPDATE `{prefix_navi}`
                    SET `pos`       = '".(int)($pos)."',
                        `kat`       = '".stringParser::encode($kat)."',
                        `name`      = '".stringParser::encode($_POST['name'])."',
                        `url`       = '".stringParser::encode($_POST['url'])."',
                        `target`    = '".(int)($_POST['target'])."',
                        `shown`     = '".(int)($_POST['sichtbar'])."',
                        `internal`  = '".(int)($_POST['internal'])."',
                        `wichtig`   = '".(int)($_POST['wichtig'])."'
                    WHERE id = '".(int)($_GET['id'])."'");

        $show = common::info(_navi_edited,"?admin=navi");
      } elseif(common::$do == "menu") {
        common::$sql['default']->update("UPDATE `{prefix_navi}`
                    SET `shown`     = '".(int)($_GET['set'])."'
                    WHERE id = '".(int)($_GET['id'])."'");

        header("Location: ?admin=navi");
      } else if(common::$do == 'intern') {
        common::$sql['default']->update("UPDATE `{prefix_navi_kats}`
                    SET `intern` = '".(int)($_GET['set'])."'
                    WHERE id = '".(int)($_GET['id'])."'");

        header("Location: ?admin=navi");
      } else if(common::$do == 'editkat') {
        $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_navi_kats}` WHERE `id` = '".(int)($_GET['id'])."'");

          $smarty->caching = false;
          $smarty->assign('head',_menu_edit_kat);
          $smarty->assign('name',_sponsors_admin_name);
          $smarty->assign('placeholder',_placeholder);
          $smarty->assign('visible',_menu_visible);
          $smarty->assign('what',_menu_edit_kat);
          $smarty->assign('menu_kat_info',_menu_kat_info);
          $smarty->assign('n_name',stringParser::decode($get['name']));
          $smarty->assign('n_placeholder',str_replace('nav_', '', stringParser::decode($get['placeholder'])));
          $smarty->assign('sel_user',($get['level'] == 1 ? ' selected="selected"' : ''));
          $smarty->assign('sel_trial',($get['level'] == 2 ? ' selected="selected"' : ''));
          $smarty->assign('sel_member',($get['level'] == 3 ? ' selected="selected"' : ''));
          $smarty->assign('sel_admin',($get['level'] == 4 ? ' selected="selected"' : ''));
          $smarty->assign('guest',_status_unregged);
          $smarty->assign('user',_status_user);
          $smarty->assign('trial',_status_trial);
          $smarty->assign('member',_status_member);
          $smarty->assign('admin',_status_admin);
          $smarty->assign('do','updatekat&amp;id='.$get['id']);
          $show = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/form_navi_kats.tpl');
          $smarty->clearAllAssign();
      } else if(common::$do == 'updatekat') {
        common::$sql['default']->update("UPDATE `{prefix_navi_kats}`
            SET `name`        = '".stringParser::encode($_POST['name'])."',
                `placeholder` = 'nav_".stringParser::encode($_POST['placeholder'])."',
                `level`       = '".(int)($_POST['level'])."'
            WHERE `id` = '".(int)($_GET['id'])."'");

        $show = common::info(_menukat_updated, '?admin=navi');
      } else if(common::$do == 'deletekat') {
        common::$sql['default']->delete("DELETE FROM `{prefix_navi_kats}` WHERE `id` = '".(int)($_GET['id'])."'");
        $show = common::info(_menukat_deleted, '?admin=navi');
      }  else if(common::$do == 'addkat') {
        $get = common::$sql['default']->fetch("SELECT * FROM `{prefix_navi_kats}` WHERE `id` = '".(int)($_GET['id'])."'");

          $smarty->caching = false;
          $smarty->assign('head',_menu_add_kat);
          $smarty->assign('name',_sponsors_admin_name);
          $smarty->assign('placeholder',_placeholder);
          $smarty->assign('visible',_menu_visible);
          $smarty->assign('what',_menu_add_kat);
          $smarty->assign('menu_kat_info',_menu_kat_info);
          $smarty->assign('n_name','');
          $smarty->assign('n_placeholder','');
          $smarty->assign('sel_user','');
          $smarty->assign('sel_trial','');
          $smarty->assign('sel_member','');
          $smarty->assign('sel_admin','');
          $smarty->assign('guest',_status_unregged);
          $smarty->assign('user',_status_user);
          $smarty->assign('trial',_status_trial);
          $smarty->assign('member',_status_member);
          $smarty->assign('admin',_status_admin);
          $smarty->assign('do','insertkat');
          $show = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/form_navi_kats.tpl');
          $smarty->clearAllAssign();
      } else if(common::$do == 'insertkat') {
        common::$sql['default']->insert("INSERT INTO `{prefix_navi_kats}`
            SET `name`        = '".stringParser::encode($_POST['name'])."',
                `placeholder` = 'nav_".stringParser::encode($_POST['placeholder'])."',
                `level`       = '".(int)($_POST['intern'])."'");

        $show = common::info(_menukat_inserted, '?admin=navi');
      } else {
	//default
	$kat = "";
	$show_ = "";
	$color = 0;

        $qry = common::$sql['default']->select("SELECT s1.*, s2.name AS katname FROM `{prefix_navi}` AS s1 LEFT JOIN `{prefix_navi_kats}` AS s2 ON s1.kat = s2.placeholder ORDER BY s2.name, s1.kat,s1.pos");
        foreach($qry as $get) {
          $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;

          if($get['type'] == "0")
          {
                $delete = common::button_delete_single($get['id'],"admin=".$admin."&amp;do=delete",_button_title_del,_confirm_del_navi);
                $edit = "&nbsp;";
                $type = _navi_space;
          } else {
                $type = stringParser::decode($get['name']);
                $edit = common::getButtonEditSingle($get['id'],"admin=".$admin."&amp;do=edit");
                $delete = common::button_delete_single($get['id'],"admin=".$admin."&amp;do=delete",_button_title_del,_confirm_del_navi);
          }

          if($get['shown'] == "1")
          {
            $shown = _yesicon;
            $set = 0;
          } else {
            $shown = _noicon;
            $set = 1;
          }
          if($get['katname'] != $kat) {
              $kat = $get['katname'];
              $show_ .= '<tr><td align="center" colspan="8" class="contentHead"><span class="fontBold">'.$get['katname'].'</span></td></tr>';
          }
            $smarty->caching = false;
            $smarty->assign('class',$class);
            $smarty->assign('name',$type);
            $smarty->assign('id', $get['id']);
            $smarty->assign('set',$set);
            $smarty->assign('url',common::cut($get['url'],34));
            $smarty->assign('kat',stringParser::decode($get['katname']));
            $smarty->assign('shown',$shown);
            $smarty->assign('edit',$edit);
            $smarty->assign('del',$delete);
            $show_ .= $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/navi_show.tpl');
            $smarty->clearAllAssign();
        }
	//default
	$show_kats = "";
        $color = 0;

	$qry = common::$sql['default']->select("SELECT * FROM `{prefix_navi_kats}` ORDER BY `name` ASC");
        foreach($qry as $get) {
          $class = ($color % 2) ? 'contentMainFirst' : 'contentMainSecond'; $color++;

          $type = stringParser::decode($get['name']);
          if($get['placeholder'] == 'nav_admin') {
            $edit = '';
            $delete = '';
          } else {
            $edit = common::getButtonEditSingle($get['id'],"admin=".$admin."&amp;do=editkat");
            $delete = common::button_delete_single($get['id'],"admin=".$admin."&amp;do=deletekat",_button_title_del,_confirm_del_menu);
          }
            $smarty->caching = false;
            $smarty->assign('name',stringParser::decode($get['name']));
            $smarty->assign('intern',(empty($get['intern']) ? _noicon : _yesicon));
            $smarty->assign('id',$get['id']);
            $smarty->assign('set', (empty($get['intern']) ? 1 : 0));
            $smarty->assign('placeholder', str_replace('nav_', '', stringParser::decode($get['placeholder'])));
            $smarty->assign('class',$class);
            $smarty->assign('edit',$edit);
            $smarty->assign('del',$delete);
            $show_kats .= $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/navi_kats.tpl');
            $smarty->clearAllAssign();
        }

          $smarty->caching = false;
          $smarty->assign('show',$show_);
          $smarty->assign('intern',_config_forum_intern);
          $smarty->assign('name',_navi_name);
          $smarty->assign('info',_navi_info);
          $smarty->assign('kat',_config_newskats_kat);
          $smarty->assign('placeholder',_placeholder);
          $smarty->assign('head_kat',_menu_kats_head);
          $smarty->assign('add_kat',_menu_add_kat);
          $smarty->assign('show_kats',$show_kats);
          $smarty->assign('url',_navi_url);
          $smarty->assign('intern',_internal);
          $smarty->assign('shown',_navi_shown);
          $smarty->assign('head',_navi_head);
          $smarty->assign('add',_navi_add_head);
          $smarty->assign('type',_navi_type);
          $smarty->assign('wichtig',_navi_wichtig);
          $smarty->assign('edit',_editicon_blank);
          $smarty->assign('del',_deleteicon_blank);
          $show = $smarty->fetch('file:['.common::$tmpdir.']'.$dir.'/navi.tpl');
          $smarty->clearAllAssign();
      }
