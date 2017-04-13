<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */

## ADDED / REDEFINED FOR 1.7.0
define('_user_mailto_texttop', '<img src=\\"../inc/images/mailto.gif\\" align=\\"texttop\\"> <a href=\\"mailto:"+d+"\\" target=\\"_blank\\">"+d+"</a>');
define('_ipban_menu_icon_enable', '<a href="[action]" title="[lang_ipban_disable]" rel="[info]" class="confirm"><img src="../inc/images/admin_lock_closed.jpg" alt="" class="icon" /></a>');
define('_ipban_menu_icon_disable', '<a href="[action]" title="[lang_ipban_enable]" rel="[info]" class="confirm"><img src="../inc/images/admin_lock_open.jpg" alt="" class="icon" /></a>');
define('_almgr_deleteicon', '<a href="?action=editprofile&amp;show=almgr&amp;do=almgr_delete&amp;id=[id]"><img alt="" src="../inc/images/delete.png" title="Delete" class="icon" /></a>');
define('_almgr_editicon', '<a href="?action=editprofile&amp;show=almgr&amp;do=almgr_edit&amp;id=[id]"><img alt="" src="../inc/images/edit.png" title="Edit" class="icon" /></a>');
define('_elevel_startpage_select', '<option value="1" [selu]>[lang_status_user]</option><option value="2" [selt]>[lang_status_trial]</option><option value="3" [selm]>[lang_status_member]</option><option value="4" [sela]>[lang_status_admin]</option>');
define('_user_link_colerd', '[country] <a class="[class]" href="../user/?action=user&amp;id=[id]"><font color="[color]">[nick]</font></a>');

//Forum
define("_forum_team_groups", '[<a style="color:[color]" href="#">[group]</a>] ');

## ADDED / REDEFINED FOR 1.5.2
define('_dropdown_date_ts', '<select id="t_[nr]" name="t_[nr]" class="dropdown">[day]</select> <select id="m_[nr]" name="m_[nr]" class="dropdown">[month]</select> <select id="j_[nr]" name="j_[nr]" class="dropdown">[year]</select>');
define('_dropdown_time_ts', '<select id="h_[nr]" name="h_[nr]" class="dropdown">[hour]</select> <select id="min_[nr]" name="min_[nr]" class="dropdown">[minute]</select>[uhr]');
## ADDED / REDEFINED FOR 1.5.1
define('_elevel_admin_select', '
<option value="banned">[lang_admin_level_banned]</option>
<option value="1" [selu]>[lang_status_user]</option>
<option value="4" [sela]>[lang_status_admin]</option>');
define('_elevel_perm_select', '
<option value="banned">[lang_admin_level_banned]</option>
<option value="1" [selu]>[lang_status_user]</option>');
## ADDED / REDEFINED FOR 1.5
define('_profil_edit_custom', '
<tr>
  <td class="contentMainTop" width="30%"><span class="fontBold">[name]</span></td>
  <td class="contentMainFirst" align="center">
    <input type="text" name="[feldname]" value="[value]" class="inputField_dis_profil"
    onfocus="this.className=\'inputField_en_profil\';"
    onblur="this.className=\'inputField_dis_profil\';" />
  </td>
</tr>');
define('_profil_custom_url', '
<tr>
  <td class="contentMainTop" width="20%"><span class="fontBold">[name]:</span></td>
  <td class="contentMainFirst" align="center"><a href="[value]" target="_blank" class="icon" />[value]</a></td>
</tr>');
define('_sponsors_textlink', '<a href="../sponsors/?action=link&amp;id=[id]" target="_blank">[name]</a>');
define('_sponsors_bannerlink', '<a href="../sponsors/?action=link&amp;id=[id]" target="_blank" title="[title]"><img src="[banner]" alt="" /></a>');
define('_next_event_link', '[datum] - <a class="navLastReg" href="../kalender/?action=show&amp;time=[timestamp]">[event]</a>');
define('_user_link_blank', '[nick]');
define('_dropdown_date2', '<select id="tag" name="tag" class="dropdown">[tag]</select> <select id="monat" name="monat" class="dropdown">[monat]</select> <select id="jahr" name="jahr" class="dropdown">[jahr]</select>');
//Added for DZCP 1.4
define('_buddys_yesicon', '<img src="../inc/images/buddys_yes.gif" alt="" class="icon" />');
define('_buddys_noicon', '<img src="../inc/images/buddys_no.gif" alt="" class="icon" />');
define('_closedicon_votes', '<img src="../inc/images/closed_votes.gif" alt="" class="icon" />');
define('_hpicon_forum', '<a href="[hp]" target="_blank"><img src="../inc/images/forum_hp.gif" alt="" title="[hp]" class="icon" /></a>');
define('_emailicon_forum', '<a href=\\"mailto:"+d+"\\"><img src=\\"../inc/images/forum_email.gif\\" title="+d+" class=\\"icon\\" /></a>');
define('_forum_pn_preview', '<img src="../inc/images/forum_pn.gif" alt="" class="icon" style="cursor:pointer" />');
define('_forum_zitat_preview', '<img src="../inc/images/zitat.gif" alt="" class="icon" style="cursor:pointer" />');
define('_user_link_preview', '[country] <a class="[class]" href="javascript:void(0)">[nick]</a>');
define('_userpic_link_raw', '<img src=../inc/images/uploads/userpics/[id].[endung] width=[width] height=[height] alt= />');
define('_no_userpic_raw', '<img src=../inc/images/nopic.gif width=[width] height=[height] alt= />');
//Edited for DZCP 1.4
define('_downloads_link', '<a href="?action=download&amp;id=[id]" style="display:block" title="[titel]"><img src="../inc/images/download.gif" alt="" class="icon" /> [download]</a>');
define('_forum_thread_search_link', '[sticky] <a href="../forum/?action=showthread&amp;id=[id]&amp;hl=[hl]">[topic]</a> [closed]');
define('_dropdown_time', '<select id="h" name="h" class="dropdown">[hour]</select> <select id="min" name="min" class="dropdown">[minute]</select>[uhr]');
define('_no_userpic_small_link', '<a href="../user/?action=user&amp;id=[id]"><img src="../inc/images/nopic.gif" width="60" height="80" alt="" /></a>');
////////////////////
## Allgemein ##
define('_user_link', '[country] <a class="[class]" href="../user/?action=user&amp;id=[id][get]">[nick]</a>');
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
define('_topicon', '<img src="../inc/images/top.gif" alt="" class="icon" />');
define('_mficon_blank', '<img src="../inc/images/mf.gif" alt="" class="icon" />');
define('_maleicon', '<img src="../inc/images/male.gif" alt="" class="icon" />');
define('_femaleicon', '<img src="../inc/images/female.gif" alt="" class="icon" />');
define('_pnicon_blank', '<img src="../inc/images/pn.gif" alt="" class="icon" />');
define('_yesno', '<img src="../inc/images/yesno.gif" alt="" class="icon" />');
define('_yesicon', '<img src="../inc/images/yes.gif" alt="" class="icon" />');
define('_noicon', '<img src="../inc/images/no.gif" alt="" class="icon" />');
define('_newicon', '<img src="../inc/images/forum_newpost.gif" alt="" class="icon" />');
define('_notnewicon', '<img src="../inc/images/notnew.gif" alt="" class="icon" />');
define('_deleteicon_blank', '<img alt="" src="../inc/images/delete.png" class="icon" />');
define('_buddys_delete', '<a href="?action=buddys&amp;do=delete&amp;id=[id]"><img src="../inc/images/delete.png" alt="" class="icon" /></a>');
define('_addbuddyicon_blank', '<img alt="" src="../inc/images/add.gif" class="icon" />');
define('_editicon_blank', '<img alt="" src="../inc/images/edit.png" class="icon" />');
define('_addbuddyicon', '<a href="../user/?action=buddys&amp;do=addbuddy&amp;id=[id]"><img alt="" src="../inc/images/add.gif" class="icon" /></a>');
define('_gameicon', '<img alt="" src="../inc/images/gameicons/custom/[icon]" class="icon" />');
define('_admin_default_edit', '<a href="?action=admin&amp;edit=[id]"><img src="../inc/images/edit.png" alt="" title="Edit" class="icon" /></a>');
define('_admin_ck_edit', '<a href="?action=admin&amp;do=paycheck&amp;id=[id]"><img src="../inc/images/edit.png" alt="" title="Edit" class="icon" /></a>');
define('_msg_delete_sended', '<a href="?action=msg&amp;do=deletesended&amp;id=[id]"><img alt="" src="../inc/images/delete.png" title="Delete" class="icon" /></a>');
define('_delete', '<a href="?action=msg&amp;do=deletethis&amp;id=[id]"><img alt="" src="../inc/images/delete.png" title="Delete" class="icon" /></a>');
define('_forum_delete', '<a href="?action=post&amp;do=delete&amp;id=[id]"><img alt="" src="../inc/images/delete.png" title="Delete" class="icon" /></a>');
define('_newsc_delete', '<a href="?action=show&amp;id=[id]&amp;do=delete&cid=[cid]"><img alt="" src="../inc/images/delete.png" title="Delete" class="icon" /></a>');
## News ##
define('_news_kat', '<img src="../inc/images/newskat/[img]" alt="" />');
define('_artikel_links', '<span class="fontItalic">[rel]</span><br />[link1] [link2] [link3]');
define('_news_show_link', '<a href="../news/?action=show&amp;id=[id]">[titel]</a>');
define('_news_stats', 'Insgesamt <span class="fontBold">[news] News</span> mit <span class="fontBold">[comments] [com]</span>');
define('_news_com', '#');
## Artikel ##
define('_artikel_link', '<span class="fontBold">&raquo;</span> <a href="[url]" target="_blank">[link]</a> ');
## Forum ##
define('_forum_dowhat_add_thread', 'addthread&amp;kid=[kid]');
define('_forum_add_lastpost', '?action=showthread&amp;id=[tid]&amp;page=[page]#p[id]');
define('_forum_dowhat_add_post', 'addpost&amp;kid=[kid]&amp;id=[id]');
define('_forum_avatar', '<img src="../inc/images/uploads/useravatare/[id].[endung]" border="1" width="100" height="100" alt="" />');
define('_forum_dowhat_edit_thread', 'editthread&amp;id=[id]');
define('_forum_dowhat_edit_post', 'editpost&amp;id=[id]');
define('_forum_select_field_kat', '<option value="[value]" class="dropdownKat">[what]</option> [skat]');
define('_forum_select_field_skat', '<option value="[value]">-> [what]</option>');
define('_forum_select_field_search', '<option value="[value]" [sel]>-> [what]</option>');
## DropDownmenu-Datum/Zeit ##
define('_dropdown_date', '<select id="t" name="t" class="dropdown">[day]</select> <select id="m" name="m" class="dropdown">[month]</select> <select id="j" name="j" class="dropdown">[year]</select>');
## Umfragen ##
define('_votes_titel', '<a href="javascript:DZCP.toggle(\'[vid]\')"><img src="../inc/images/[icon].gif" alt="" id="img[vid]" class="icon" />[intern][titel]</a>');
define('_votes_balken', '<img src="../inc/images/vote.gif" width="[width]%" height="4" alt="[width]%" />');
## Downloads ##
define('_downloads_files_exists', '<option value="[dl]" [sel]>[dl]</option>');
## Links ##
define('_links_textlink', '<center><a href="?action=link&amp;id=[id]" target="_blank">[text]</a></center>');
define('_links_bannerlink', '<center><a href="?action=link&amp;id=[id]" target="_blank"><img src="[banner]" alt="" /></a></center>');
## Squads ##
define('_member_squad_squadlink', '<a href="javascript:DZCP.toggle(\'[id]\')">[squad]</a>');
define('_userpic_small_link', '<a href="../user/?action=user&amp;id=[id]"><img src="../inc/images/uploads/userpics/[id].[endung]" width="60" height="80" alt="" /></a>');
define('_no_userpic_small', '<img src="../inc/images/nopic.gif" width="60" height="80" alt="" />');
## Kontaktformulare ##
define('_contact_hp', '<a href="[hp]" target="_blank">[hp]</a>');
## Admin ##
define('_artikel_edit_link', 'editartikel&amp;id=[id]');
define('_config_delete', '<a href="?admin=[what]&amp;do=delete&amp;id=[id]"><img src="../inc/images/delete.png" alt="" class="icon" /></a>');
define('_config_edit', '<a href="?admin=[what]&amp;do=edit&amp;id=[id]"><img src="../inc/images/edit.png" alt="" class="icon" /></a>');
define('_config_forum_kats_titel', '<a href="?admin=forum&amp;show=subkats&amp;id=[id]" style="display:block">[kat]</a>');
define('_config_newskats_img', '<img src="../inc/images/newskat/[img]" alt="" />');
define('_config_neskats_katbild_upload', '<a href="../upload/?action=newskats">upload</a>');
define('_config_neskats_katbild_upload_edit', '<a href="../upload/?action=newskats&amp;edit=[id]">upload</a>');
define('_config_newskats_editid', 'editnewskat&amp;id=[id]');
define('_icon_edit_news', '<a href="?admin=newsadmin&amp;do=edit&amp;id=[id]"><img alt="" src="../inc/images/edit.png" class="icon" /></a>');
define('_icon_delete_news', '<a href="?admin=newsadmin&amp;do=delete&amp;id=[id]"><img alt="" src="../inc/images/delete.png" class="icon" /></a>');
define('_icon_edit_squads', '<a href="?admin=squads&amp;do=edit&amp;id=[id]"><img alt="" src="../inc/images/edit.png" class="icon" /></a>');
define('_icon_delete_squads', '<a href="?admin=squads&amp;do=delete&amp;id=[id]"><img alt="" src="../inc/images/delete.png" class="icon" /></a>');
define('_checkfield_squads', '
<tr>
  <td><input class="checkbox" type="checkbox" id="squad_[id]" name="squad[id]" value="[id]" [check] /><label for="squad_[id]"> [squad]</label></td>
  <td align="center">
    <select name="sqpos[id]" class="dropdown">
      [lang_user_noposi]
      [eposi]
    </select>
  </td>
</tr>');
define('_select_field_posis', '<option value="[value]" [sel]>[what]</option>');
## Userprofile ##
define('_profil_custom', '
<tr>
  <td class="contentMainTop" width="20%"><span class="fontBold">[name]:</span></td>
  <td class="contentMainFirst" align="center">[value]</td>
</tr>');
define('_profil_custom_mail', '
<tr>
  <td class="contentMainTop" width="20%"><span class="fontBold">[name]:</span></td>
  <td class="contentMainFirst" align="center"><img src="../inc/images/mailto.gif" alt="" class="icon" /> [value]</td>
</tr>');
## Userprofil editieren ##
define('_profil_head_cont', '
<tr>
  <td class="contentMainTop" colspan="4" align="center"><span class="fontBold">[what]</span></td>
</tr>');
## User ##
define('_msg_in_title', '<a href="?action=msg&amp;do=show&amp;id=[id]">[titel]</a>');
define('_msg_out_title', '<a href="?action=msg&amp;do=showsended&amp;id=[id]">[titel]</a>');
define('_to_buddys', '<option value="[id]" [selected="selected"]>[nick]</option>');
define('_to_users', '<option value="[id]" [selected="selected"]>[nick]</option>');
define('_to_squads', '<option value="[id]" [sel]>-> [name]</option>');
define('_user_new_forum', '&nbsp;&nbsp;<a href="../forum/?action=showthread&amp;id=[tid]&amp;page=[page]#p[lp]">[intern][wichtig]<span class="fontWichtig">[cnt]</span> [post] [nthread] <span class="fontWichtig">[thread]</span></a><br />');
define('_user_new_users', '&nbsp;&nbsp;<a href="?action=userlist&amp;show=newreg"><span class="fontWichtig">[cnt]</span> [eintrag]</a><br />');
define('_user_new_news', '&nbsp;&nbsp;<a href="../news/"><span class="fontWichtig">[cnt]</span> [eintrag]</a><br />');
define('_user_new_msg', '&nbsp;&nbsp;<a href="?action=msg"><span class="fontWichtig">[cnt]</span> [eintrag]</a><br />');
define('_user_new_votes', '&nbsp;&nbsp;<a href="../votes/"><span class="fontWichtig">[cnt]</span> [eintrag]</a><br />');
define('_select_field', '<option value="[value]" [sel]> [what]</option>');
## Unzugeordnet ##
define('_user_new_artc', '&nbsp;&nbsp;<a href="../artikel/?action=show&amp;id=[id]#lastcomment"><span class="fontWichtig">[cnt]</span> [eintrag]</a><br />');
define('_artike_sites', '<a href="?action=show&amp;id=[id]&part=[part]">[num]</a> ');
## Sonstiges ##
define('_klapptext_show', '<a href="javascript:DZCP.toggle(\'[id]\')"><img id="img[id]" src="../inc/images/collapse.gif" alt="" class="icon" /></a>');
define('_klapptext_dont_show', '<a href="javascript:DZCP.toggle(\'[id]\')"><img id="img[id]" src="../inc/images/expand.gif" alt="" class="icon" /></a>');
define('_klapptext_show_link', '<a href="javascript:DZCP.toggle(\'[id]\')"><img id="img[id]" src="../inc/images/expand.gif" alt="" class="icon" />[link]</a>');
