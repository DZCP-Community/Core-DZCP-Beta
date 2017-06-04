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

## ADDED / REDEFINED FOR 1.7.0
define('_user_mailto_texttop', '<img src=\\"../inc/images/mailto.gif\\" align=\\"texttop\\"> <a href=\\"mailto:"+d+"\\" target=\\"_blank\\">"+d+"</a>');
define('_ipban_menu_icon_enable', '<a href="[action]" title="[lang_ipban_disable]" rel="[info]" class="confirm"><img src="../inc/images/admin_lock_closed.jpg" alt="" class="icon" /></a>');
define('_ipban_menu_icon_disable', '<a href="[action]" title="[lang_ipban_enable]" rel="[info]" class="confirm"><img src="../inc/images/admin_lock_open.jpg" alt="" class="icon" /></a>');
define('_elevel_startpage_select', '<option value="1" [selu]>[lang_status_user]</option><option value="2" [selt]>[lang_status_trial]</option><option value="3" [selm]>[lang_status_member]</option><option value="4" [sela]>[lang_status_admin]</option>');
## ADDED / REDEFINED FOR 1.5.2
define('_dropdown_date_ts', '<select id="t_[nr]" name="t_[nr]" class="dropdown">[day]</select> <select id="m_[nr]" name="m_[nr]" class="dropdown">[month]</select> <select id="j_[nr]" name="j_[nr]" class="dropdown">[year]</select>');
define('_dropdown_time_ts', '<select id="h_[nr]" name="h_[nr]" class="dropdown">[hour]</select> <select id="min_[nr]" name="min_[nr]" class="dropdown">[minute]</select>[uhr]');
//Added for DZCP 1.4
define('_buddys_yesicon', '<img src="../inc/images/buddys_yes.gif" alt="" class="icon" />');
define('_buddys_noicon', '<img src="../inc/images/buddys_no.gif" alt="" class="icon" />');
define('_closedicon_votes', '<img src="../inc/images/closed_votes.gif" alt="" class="icon" />');
define('_hpicon_forum', '<a href="{$hp}" target="_blank"><img src="../inc/images/forum_hp.gif" alt="" title="{$hp}" class="icon" /></a>');
define('_emailicon_forum', '<a href=\\"mailto:"+d+"\\"><img src=\\"../inc/images/forum_email.gif\\" title="+d+" class=\\"icon\\" /></a>');
define('_forum_pn_preview', '<img src="../inc/images/forum_pn.gif" alt="" class="icon" style="cursor:pointer" />');
define('_forum_zitat_preview', '<img src="../inc/images/zitat.gif" alt="" class="icon" style="cursor:pointer" />');
//Edited for DZCP 1.4
define('_forum_thread_search_link', '[sticky] <a href="../forum/?action=showthread&amp;id=[id]&amp;hl=[hl]">[topic]</a> [closed]');
////////////////////
## Allgemein ##
define('_user_link_noreg', '<a class=\\"[class]\\" href=\\"mailto:"+d+"\\">[nick]</a>');
define('_link_mailto', '<a href=\\"mailto:"+d+"\\">{$nick}</a>');
define('_link_hp', '<a href="[hp]"><img src="../inc/images/hp.gif" alt="" title="[hp]" class="icon" /></a>');
define('_userava_link', '<img src="../inc/images/uploads/useravatare/[id].[endung]" width="[width]" height="[height]" alt="" />');
define('_no_userava', '<img src="../inc/images/noavatar.gif" width="[width]" height="[height]" alt="" />');
define('_userpic_link', '<img src="../inc/images/uploads/userpics/[id].[endung]" width="[width]" height="[height]" alt="" />');
define('_no_userpic', '<img src="../inc/images/nopic.gif" width="[width]" height="[height]" alt="" />');
## Icons ##
define('_closedicon', '<img src="../inc/images/closed.png" alt="" class="icon" />');
define('_hpicon', '<a href="[hp]" target="_blank"><img src="../inc/images/hp.gif" alt="" title="[hp]" class="icon" /></a>');
define('_email_mailto', '<a href="mailto:[email]">[email]</a>');
define('_emailicon', '<a href=\\"mailto:"+d+"\\"><img src=\\"../inc/images/email.gif\\" title="+d+" class=\\"icon\\" /></a>');
define('_emailicon_non_mailto', '<a href="[email]"><img src="../inc/images/email.gif" alt="" class="icon" /></a>');
define('_emailicon_blank', '<img src="../inc/images/email.gif" alt="" class="icon" />');
define('_zitaticon', '<img src="../inc/images/zitat.gif" alt="" class="icon" />');
define('_hpicon_blank', '<img src="../inc/images/hp.gif" alt="" class="icon" />');
define('_mficon_blank', '<img src="../inc/images/mf.gif" alt="" class="icon" />');
define('_maleicon', '<img src="../inc/images/male.gif" alt="" class="icon" />');
define('_femaleicon', '<img src="../inc/images/female.gif" alt="" class="icon" />');
define('_pnicon_blank', '<img src="../inc/images/pn.gif" alt="" class="icon" />');
define('_yesicon', '<img src="../inc/images/yes.gif" alt="" class="icon" />');
define('_noicon', '<img src="../inc/images/no.gif" alt="" class="icon" />');
define('_newicon', '<img src="../inc/images/forum_newpost.gif" alt="" class="icon" />');
define('_notnewicon', '<img src="../inc/images/notnew.gif" alt="" class="icon" />');
define('_deleteicon_blank', '<img alt="" src="../inc/images/delete.png" class="icon" />');
define('_editicon_blank', '<img alt="" src="../inc/images/edit.png" class="icon" />');
define('_admin_default_edit', '<a href="?action=admin&amp;edit=[id]"><img src="../inc/images/edit.png" alt="" title="Edit" class="icon" /></a>');
define('_admin_ck_edit', '<a href="?action=admin&amp;do=paycheck&amp;id=[id]"><img src="../inc/images/edit.png" alt="" title="Edit" class="icon" /></a>');
define('_msg_delete_sended', '<a href="?action=msg&amp;do=deletesended&amp;id=[id]"><img alt="" src="../inc/images/delete.png" title="Delete" class="icon" /></a>');
define('_forum_delete', '<a href="?action=post&amp;do=delete&amp;id=[id]"><img alt="" src="../inc/images/delete.png" title="Delete" class="icon" /></a>');
define('_newsc_delete', '<a href="?action=show&amp;id=[id]&amp;do=delete&cid=[cid]"><img alt="" src="../inc/images/delete.png" title="Delete" class="icon" /></a>');
## News ##
define('_news_show_link', '<a href="../news/?action=show&amp;id=[id]">[titel]</a>');
## Forum ##
define('_forum_select_field_search', '<option value="[value]" [sel]>-> [what]</option>');
## Umfragen ##
define('_votes_titel', '<a href="javascript:DZCP.toggle(\'[vid]\')"><img src="../inc/images/[icon].gif" alt="" id="img[vid]" class="icon" />[intern][titel]</a>');
define('_votes_balken', '<img src="../inc/images/vote.gif" width="[width]%" height="4" alt="[width]%" />');
## Admin ##
define('_artikel_edit_link', 'editartikel&amp;id=[id]');
define('_config_delete', '<a href="?admin=[what]&amp;do=delete&amp;id=[id]"><img src="../inc/images/delete.png" alt="" class="icon" /></a>');
define('_config_edit', '<a href="?admin=[what]&amp;do=edit&amp;id=[id]"><img src="../inc/images/edit.png" alt="" class="icon" /></a>');
define('_config_forum_kats_titel', '<a href="?admin=forum&amp;show=subkats&amp;id=[id]" style="display:block">[kat]</a>');
define('_config_newskats_img', '<img src="../inc/images/uploads/newskat/[img]" alt="" />');
define('_config_neskats_katbild_upload', '<a href="../upload/?action=newskats">upload</a>');
define('_config_neskats_katbild_upload_edit', '<a href="../upload/?action=newskats&amp;edit=[id]">upload</a>');
define('_config_newskats_editid', 'editnewskat&amp;id=[id]');
## User ##
define('_to_squads', '<option value="[id]" [sel]>-> [name]</option>');