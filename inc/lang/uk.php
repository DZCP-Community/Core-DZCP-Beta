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

setlocale(LC_ALL, "en_US.utf8");

## Allgemein ##
define('_button_title_del' , 'Delete');
define('_button_title_edit' , 'Edit');
define('_button_title_zitat' , 'Quote this entry');
define('_button_title_comment' , 'Commentate this entry');
define('_button_title_menu' , 'Set to menu');
define('_button_value_add' , 'Insert');
define('_button_value_addto' , 'Insert');
define('_button_value_edit' , 'Edit');
define('_button_value_search' , 'Search');
define('_button_value_search1' , 'Start search');
define('_button_value_upload' , 'Upload');
define('_button_value_vote' , 'Vote');
define('_button_value_show' , 'Show');
define('_button_value_do_show', 'don`t Show');
define('_button_value_send' , 'Send');
define('_button_value_reg' , 'Register');
define('_button_value_msg' , 'Send message');
define('_button_value_nletter' , 'Send newsletter');
define('_button_value_config' , 'Store configuration');
define('_button_value_clear' , 'Clear database');
define('_button_value_save' , 'Save');
define('_editor_from' , 'From');
define('intern' , '<span class="fontWichtig">Internal</span>');
define('_comments_head' , 'Comments');
define('_click_close' , 'close');
define('_lang_de', 'German');
define('_lang_uk', 'English');

## Lost Password ##
define('_admin_lpwd_subj', 'Betreff: Passwort zur&uuml;cksetzen');
define('_admin_lpwd', 'Passwort zur&uuml;cksetzen template');

## ADDED / REDEFINED FOR 1.7.0
define('_years', 'Years');
define('_year', 'Year');
define('_months', 'Months');
define('_month', 'Month');
define('_weeks', 'Weeks');
define('_week', 'Week');
define('_days', 'Days');
define('_day', 'Day');
define('_hours', 'Hours');
define('_hour', 'Hour');
define('_minutes', 'Minutes');
define('_minute', 'Minute');
define('_seconds', 'Seconds');
define('_second', 'Second');

define('_server_ip', 'Server-IP');
define('_aktion', 'Aktion');
define('_config_activate_user', 'User aktivieren');
define('_profil_admin_locked', 'Account ist nicht aktiviert');
define('_profil_locked', 'Der Account ist noch nicht aktiviert, <a href="?index=user&amp;action=akl&do=send" target="_self">&lt; Aktivierungs-Mail senden &gt;</a>');
define('_profil_closed', 'Der Account ist gesperrt');
define('_admin_akl_regist_subj', 'Betreff: Registrierungs Aktivierungs-eMail');
define('_admin_akl_regist', 'Registrierungs Aktivierungs-eMail Template');
define('_reg_akl_invalid', 'Dieser Aktivierungslink ist nicht mehr g&uuml;ltig!');
define('_reg_akl_valid', 'Dein Account wurde aktiviert!');
define('_reg_akl_sended', 'Dein Aktivierungslink wurde an "[email]" versandt, schau bitte in dein E-Mail Postfach');
define('_reg_akl_email_nf', 'Es existiert kein Account mit dieser E-Mail Addresse!');
define('_reg_akl_locked', 'Der Account ist gesperrt und kann nicht mehr aktiviert werden!');
define('_reg_akl_activated', 'Dein Account ist bereits aktiviert');
define('_lostpwd_valid_sended', 'Dir wurde eine E-Mail mit dem &Auml;nderungslink gesendet!');
define('_info_reg_valid_akl', 'Du hast dich erfolgreich registriert!<br /><br />Bitte aktiviere deinen Account &uuml;ber die Aktivierungs-eMail, die wir dir an deine E-Mail Adresse gesendet haben.<br /><br />Deine Zugangsdaten wurden dir an deine E-Mail Adresse "{$email}" versandt.');
define('_info_reg_valid_akl_ad', 'Du hast dich erfolgreich registriert!<br /><br />Deinen Account wird nach einer Pr&uuml;fung durch die Administratoren dieser Seite aktiviert.<br /><br />Deine Zugangsdaten wurden dir an deine E-Mail Adresse "{$email}" versandt.');
define('_button_value_activate', 'Aktivieren');
define('_activate_code', 'Aktivierungscode');
define('_activate_head', 'Account aktivieren');
define('_perm_activateusers', 'Account Aktivierungen verwalten');
define('_admin_akl_sended', 'gesendet');
define('_admin_akl_activated', 'Aktivierungen');
define('_actived', 'User Account wurde aktiviert!');
define('_button_title_akl', 'Account aktivieren');
define('_admin_akl_resend', 'Aktivierungslink wurde an "{$email}" versandt.');
define('_akl', 'Aktivierungsmails');
define('_akl_info', 'Sollen Aktivierungsmails bei Neuregistrierungen verwendet werden');
define('_akl_send', 'Aktivierungsmail senden');
define('_akl_only_admin', 'Nur &uuml;ber Administrator');
define('_button_activate_user', 'User aktivieren');
define('_button_del_user', 'User l&ouml;schen');
define('_users_deleted', 'User gel&ouml;scht');
define('_actived_all', 'User Accounts wurden aktiviert!');
define('_config_c_cache' , 'Cache');
define('_config_c_cache_provider' , 'Cache Provider');
define('_config_c_cache_mem_host' , 'Memcache Host');
define('_config_c_cache_mem_port' , 'Memcache Port');
define('_default', 'Default');
define('_smtp_host', 'SMTP Host');
define('_smtp_port', 'SMTP Port');
define('_smtp_username', 'SMTP Username');
define('_smtp_passwort', 'SMTP Passwort');
define('_smtp_tls_ssl', 'Verschl&uuml;sselung');
define('_smtp_sendmail_path', 'Sendmail Path');
define('_admin_eml_config_head', 'E-Mail Settings');
define('_admin_eml_config_ext', 'Mail-Extension');
define('_feeds', 'News Feeds *rss');
define('_feeds_info', 'Switches the automatically RSS feeds to on or off');
define('_pwd_encoder_algorithm', 'Algorithm');
define('_pwd_encoder', 'Password-Hash Algorithm');
define('_pwd_encoder_info', 'Which password hash algorithm to use, default is * SHA256');
define('_iban', 'IBAN');
define('_bic', 'BIC');
define('_login_head_admin', 'Administrator Login');
define('_no_entrys', 'No entrys');
define('_profil_edit_almgr_link', '<a href="?action=editprofile&amp;show=almgr">Autologin editieren</a>');
define('_almgrhead', 'Autologin verwalten');
define('_almgr_host', 'Host');
define('_almgr_ip', 'IP-Adresse');
define('_almgr_create', 'Angelegt');
define('_almgr_lused', 'Verwendet');
define('_almgr_expires', 'G&uuml;ltig bis');
define('_almgr_name', 'Ger&auml;tename');
define('_almgr_edit_head', 'Autologin bearbeiten');
define('_almgr_ssid', 'Session-ID');
define('_almgr_pkey', 'Permanent-Key');
define('_almgr_editd', 'Autologin erfolgreich bearbeitet');
define('_almgr_add', '<a href="?action=editprofile&amp;show=almgr&amp;do=self_add">Dieses Ger&auml;t hinzuf&uuml;gen</a>');
define('_almgr_remove', '<a href="?action=editprofile&amp;show=almgr&amp;do=self_remove">Dieses Ger&auml;t entfernen</a>');
define('_info_almgr_deletet', 'Automatische Anmeldung wurde erfolgreich entfernt');
define('_info_almgr_self_deletet', 'Dieses Ger&auml;t wurde erfolgreich entfernt');
define('_info_almgr_self_added', 'Dieses Ger&auml;t wurde erfolgreich eingetragen');
define('_profile_access_error', 'This profile is accessible only to members');
define('_pedit_visibility_profile', 'My Profile');
define('_paginator_previous', 'Previous');
define('_paginator_next', 'Next');
define('_admin_bezeichnung', 'Description');
define('_custom_game_icon', 'Custom-Icon');
define('_custom_game_icon_none', 'Not use custom icon');
define('_addons', 'Add-ons');
define('_capcha_sound_info', 'Click for Play Audio-CAPTCHA');
define("_notification_error", 'Error');
define("_notification_success", 'Success');
define("_notification_notice", 'Notice');
define("_notification_warning", 'Warning');
define("_notification_custom", 'Custom');
define("_color", 'Color');
define("_description", 'Description');
define("_replies", 'Replies');
define('_no_entrys_found', '<tr>
  <td class="contentMainFirst" colspan="[colspan]" align="center">No entrys found</td>
</tr>');
define('_admin_news_readed', 'Readed');
define('_admin_news_refresh', 'Refresh');

//Forum
define("_forum_stats_top5", 'Statistics and Top 5 Posters');
define('_forum_who_is_online', 'Who is online?');
define('_forum_last_post', 'View the latest post');
define('_forum_online_info0', 'In total there are <b>{$users}</b> users online: <b>{$regs}</b> registered and <b>{$gast}</b> guests (based on users active over the past {$timer} minutes)');
define('_forum_online_info1', 'Registered users');
define("_forum_gast", 'guests');
define("_forum_gaste", 'guests');
define("_forum_regs", 'registered');
define("_forum_reg", 'registered');
define("_forum_ist", ''); //Not used
define("_forum_sind", ''); //Not used
define("_forum_total_posts", 'Total posts');
define("_forum_total_topics", 'Total topics');
define("_forum_total_members", 'Total members');
define("_forum_newest_member", 'Our newest member');
define("_forum_new_thread", 'New Thread');
define("_forum_sort_bcc", 'Subject');
define("_forum_sort_time", 'Creation Date');
define("_forum_sort_by", 'Sort by');
define("_forum_sort_descending", 'Descending');
define("_forum_sort_ascending", 'Ascending');
define("_forum_go", 'Go');
define("_forum_from", 'From');
define('_forum_admin_closed' , 'Close vote');
define("_forum_admin_editby", 'der Nachricht "<span class="fontWichtig">zuletzt editiert</span>" anh&auml;ngen?');

//Startpage
define('_profil_startpage', 'Startseite');
define('_config_startpage', 'Startseiten');
define('_admin_startpage', 'Startseiten');
define('_perm_startpage', 'Startseiten verwalten');
define('_admin_startpage_url', 'Ziel URL');
define('_admin_startpage_level', 'Sichtbar ab Level');
define('_admin_startpage_name', 'Name');
define('_admin_startpage_add_head', 'Neue Startseite anlegen');
define('_admin_startpage_edit', 'Startseite bearbeiten');
define('_admin_startpage_added', 'Startseite wurde erfogreich eingetragen');
define('_admin_startpage_deleted', 'Startseite wurde erfogreich gel&ouml;scht');
define('_admin_startpage_editd', 'Startseite wurde erfogreich editiert');
define('_admin_startpage_no_name', 'Du hast keinen Namen eingegeben');
define('_admin_startpage_no_url', 'Du hast keine URL eingegeben');
define('_admin_startpage_add', 'Neue Startseite hinzuf�gen');

//IP Blocker
define('_ipban_admin_head', 'IP Blocker');
define('_config_ipban', 'IP Blocker');
define('_confirm_del_ipban', 'Delete Record');
define('_confirm_enable_ipban', 'Should the IP Ban for [ip] be reactivated');
define('_confirm_disable_ipban', 'Should the IP Ban for [ip] be deactivated');
define('_ipban_admin_deleted', 'The IP Ban has been successfully deleted!');
define('_ipban_new_head', 'Add new IP Ban');
define('_ipban_admin_added', ' The IP Ban has been successfully added');
define('_ipban_edit_head', 'Edit IP Ban');
define('_ipban_admin_edited', 'IP Ban has been successfully edited');
define('_ipban_dis', 'Reason / Description');
define('_ipban_add_new', 'New Record');
define('_ipban_assuredness', 'Reliability');
define('_ipban_reports', 'Reports');
define('_ipban_lastten_global', 'Last 10 banned IPs by Stopforumspam.com ');
define('_ipban_lastten_user', ' Last 10 banned IPs by User ');
define('_ipban_search', 'IP Search');
define('_ipban_error_pip', 'You cant ban private IP Addresses');
define('_ipban_disable', 'Disable IP Ban');
define('_ipban_enable', 'Enable IP Ban');
define('_ip_empty', 'The IP is missing');
define('_total_bans', 'Total Bans');
define('_ipban_head_admin', 'IP-Bans');
define('_perm_ipban', 'Manage IP-Bans');

## Navigation / Server ##
define('_navi_gsv_players_online', 'Online');
define('_navi_gsv_on_the_game', 'Players');
define('_navi_gsv_view_players', 'View Players');
define('_navi_gsv_game', 'Game');
define('_navi_gsv_no_name_available', 'no Name available');
define('_navi_gsv_no_players_available', 'no Players online');
define('_navi_gsv_password', 'Password');

## ADDED / REDEFINED FOR 1.6.0 Final
define('_txt_navi_main', 'Main Navigation');
define('_txt_navi_clan', 'Clan Navigation');
define('_txt_navi_misc', 'Misc Navigation');
define('_txt_userarea', 'Userarea');
define('_txt_vote', 'Vote');
define('_txt_partners', 'Partners');
define('_txt_sponsors', 'Sponsors');
define('_txt_counter', 'Counter');
define('_txt_l_news', 'News');
define('_txt_ftopics', 'Topics');
define('_txt_teams', 'Teams');
define('_txt_template_switch', 'Switch Template');
define('_txt_events', 'Events');
define('_txt_kalender', 'Calendar');
define('_txt_l_artikel', 'Articles');
define('_txt_l_reg', 'new Users');
define('_txt_motm', 'Member of the Moment');
define('_txt_top_dl', 'Top Downloads');
define('_txt_uotm', 'User of the Moment');

define('_forum_kat', 'Categorie');

define('_artikel_userimage', 'Own Articlepicture');
define('_artikelpic_del', 'delete Articlepicture?');
define('_artikelpic_deleted', 'Articlepicture successfully deleted');

define('_news_userimage', 'Own Newspicture');
define('_newspic_del', 'delete Newspicture?');
define('_newspic_deleted', 'Newspicture successfully deleted');
define('_max', 'max.');

define('_perm_dlintern','View internal Downloads');

define('_config_url_linked_head', "URLs linking");

define('_upload_error', 'Failed to upload the file!');
define('_login_banned', 'Your account has been banned by administrator!');
define('_lobby_no_mymessages', '<a href="../user/?action=msg">You have no new messages!</a>');

define('_perm_protocol', 'can see admin protocol');
define('_perm_support', 'can see support page');
define('_perm_clear', 'clean database');
define('_perm_forumkats', 'manage forums categories');
define('_perm_impressum', 'manage impressum');
define('_perm_config', 'manage configuration page');
define('_perm_positions', 'manage user ranks');
define('_perm_partners', 'manage partner');
define('_perm_profile', 'manage profile fields');

## ADDED / REDEFINED FOR 1.5 Final
define('_id_dont_exist', 'The requested ID does not exist!');

## ADDED / REDEFINED FOR 1.5.2
define('_button_title_del_account' , 'User-Account delete');
define('_confirm_del_account' , 'You really want to delete your Account on dzcp.de');
define('_profil_del_account' , 'Account delete');
define('_info_account_deletet' , 'Your Account has been successfully deleted!');
define('_profil_del_admin' , '<b>Deleting not possible!</b>');
define('_news_get_timeshift' , "Timeshift News?");
define('_news_timeshift_from', 'Show news from:');
define('_placeholder' , 'Template Placeholder');
define('_menu_kats_head' , 'Menu Categories');
define('_menu_add_kat' , 'Add new menu category');
define('_confirm_del_menu' , 'Dyo you really want to delet the menu category?');
define('_menu_edit_kat' , 'Edit menu category');
define('_menukat_updated' , 'The menu category has been successfully edited!');
define('_menukat_inserted' , 'The menu category has been successfully added!');
define('_menukat_deleted' , 'The menu category has been successfully deleted!');
define('_menu_visible' , 'visible for status');
define('_menu_kat_info' , 'The css classes for the link will be constructed from the template placeholder, automatically.<br />e.g. for the placeholder <i>[nav_main]</i>, the css class will be <i>a.navMain</i>');
define('_admin_sqauds_roster' , 'Team-Roster');
define('_admin_squads_nav_info' , 'This will put a direct link in the navigation, which target to full size of the Team.');
define('_admin_squads_teams' , 'Team-Show');
define('_admin_squads_no_navi' , 'Don\'t show');
define('_config_cache_info' , 'here you can set intervals, when teamspeak and gamserver will be reloaded. Outherwise the informations will be read from the cache.');
define('_config_direct_refresh' , 'Direct Forward');
define('_config_direct_refresh_info' , 'If activated, the site will be forwarded directly, instead of showing the status information.');
define('_eintrag_titel_forum' , '<a href="{$url}" title="Show this post"><span class="fontBold">#{$postid}</span></a> at {$datum} on {$zeit}{lang msgID="uhr"} {$edit} {$delete}');
define('_eintrag_titel' , '<span class="fontBold">#{$postid}</span> at {$datum} on {$zeit}{lang msgID="uhr"} {$edit} {$delete}');

## ADDED / REDEFINED FOR 1.5.1
define('_config_double_post' , 'Forum double post');
define('_config_fotum_vote' , 'Forum-Vote');
define('_config_fotum_vote_info' , '<center>Here you can specify whether a Forum-Vote also Vote to be displayed.</center>');

## ADDED / REDEFINED FOR 1.5
define('_search_sites' , 'Sites');
define('_search_results' , 'Search Results');
define('_config_useradd_head' , 'Add User');
define('_config_adduser' , 'Add User');
define('_uderadd_info' , 'The User has been successfully added');
define('_useradd_head' , 'Add new User');
define('_useradd_about' , 'Userdetails');
define('_login_signup' , 'Register');
define('_login_lostpwd' , 'Password?');
define('_config_links' , 'Links');
define('_vote_menu_no_vote' , 'no vote registered');
define('_no_top_match' , 'no top match registered!');
define('_team_logo' , 'Team Logo');
define('_sq_banner' , 'Teambanner');
define('_forum_abo_title' , 'Suscribe Thread');
define('_forum_vote' , 'Vote');
define('_admin_user_clanhead_info' , 'These permissions can be set <u>additional</u> to the permissions in the user ranks.');
define('_user_noposi' , '<option value="lazy" class="dropdownKat">no user rank</option>');
define('_config_positions_boardrights' , 'internal board permissions');
define('_perm_contact' , 'receive contact form');
define('_perm_editkalender' , 'manage calendar entries');
define('_perm_forum' , 'board admin');
define('_perm_links' , 'manage links');
define('_perm_newsletter' , 'manage newsletter');
define('_perm_votesadmin' , 'manage votes');
define('_perm_artikel' , 'manage articles');
define('_perm_downloads' , 'manage dowloads');
define('_perm_editor' , 'manage sites');
define('_perm_editsquads' , 'manage teams');
define('_perm_editusers' , 'can edit users');
define('_perm_intnews' , 'can read internal news');
define('_perm_news' , 'manage news');
define('_perm_votes' , 'can see internal votes');
define('_config_positions_rights' , 'Permissions');
define('_config_positions' , 'User Ranks');
define('_admin_pos' , 'User Ranks');
define('_config_sponsors' , 'Sponsors');
define('_sponsors_admin_head' , 'Sponsors');
define('_sponsors_admin_add' , 'Add Sponsor');
define('_sponsor_added' , 'The sponsor has been successfully registered!');
define('_sponsor_edited' , 'The sponsor has been successfully edited!');
define('_sponsor_deleted' , 'The sponsor has been successfully deleted!');
define('_sponsor_name' , 'Sponsorname');
define('_sponsors_admin_name' , 'Name');
define('_sponsors_admin_site' , 'Sponsor site');
define('_sponsors_admin_addsite' , 'To sponsorsite');
define('_sponsors_admin_add_site' , 'This banner will be displayed at the sponsor page');
define('_sponsors_admin_upload' , 'Pic-Upload');
define('_sponsors_admin_url' , 'or: Pic-URL');
define('_sponsors_admin_banner' , 'Rotation Banner');
define('_sponsors_admin_addbanner' , 'To Rotation-Banner');
define('_sponsors_admin_add_banner' , 'This banner will be displayed at the top of the rotationbanners');
define('_sponsors_admin_box' , 'Sponsor-Box');
define('_sponsors_admin_addbox' , 'To Sponsor-Box');
define('_sponsors_admin_add_box' , 'This banner will be displayed in the sponsors box');
define('_sponsors_empty_name' , 'Insert the name of the sponsor!');
define('_sponsors_empty_beschreibung' , 'You have to indicate a title tag!');
define('_sponsors_empty_link' , 'You have to indivate a link url!');
define('_public' , 'Public');
define('_non_public' , 'non Public');
define('_no_public' , '<b>unpublished</b>');
define('_no_events' , '<center>no events available</center>');
define('_config_c_events' , 'Menu: Events');
define('_msg_all_leader' , "all Leader & Co-Leader");
define('_msg_leader' , "Squad-Leader");
define('_pos_nletter' , 'Include this position in newsletter to Leader and Co-Leader');
define('_pwd2' , 'repeat password');
define('_wrong_pwd' , 'The password entered does not match');
define('_info_reg_valid_pwd' , 'You has been successfully registered and can login now with your access data!<br /><br />Your access data has been send to your email address [email], too.');
define('_profil_pnmail' , 'Email on new message');
define('_admin_pn_subj' , 'Subject: PN-Email');
define('_admin_pn' , 'PN-Email Template');
define('_admin_fabo_npost_subj' , 'Subject: Board Subscription: New Post');
define('_admin_fabo_pedit_subj' , 'Subject: Board Subscription: Post edit');
define('_admin_fabo_tedit_subj' , 'Subject: Board Subscription: Thread edit');
define('_admin_fabo_npost' , 'Board Subscription: New Post Template');
define('_admin_fabo_pedit' , 'Board Subscription: Post edit Template');
define('_admin_fabo_tedit' , 'Board Subscription: Thread edit Template');
define('_foum_fabo_checkbox' , 'Subscribe to this thread and for notification via e-mail about new posts?');
define('_forum_fabo_do' , 'E-Mail notification has been successfully edited!');
define('_forum_vote_del' , 'Delete Vote');
define('_forum_vote_preview' , 'Here the vote appears.');
define('_forum_spam_text' , '{$ltext}<p>&nbsp;</p><p>&nbsp;</p><span class="fontBold">Addendum by </span>{$autor}:<p>&nbsp;</p>{$ntext}');
####################################################################################
define('_config_config' , 'Global Settings');
define('_config_dladmin' , 'Downloads');
define('_config_editor' , 'Sites');
define('_config_konto' , 'Clancash');
define('_config_dlkats' , 'Download Categories');
define('_config_nletter' , 'Newsletter');
define('_config_protocol' , 'Adminprotocoll');
define('_partnerbuttons_textlink' , 'Textlink');
define('_config_forum_subkats_add' , '
    <form action="" method="get" onsubmit="DZCP.submitButton()">
      <input type="hidden" name="admin" value="forum" />
      <input type="hidden" name="do" value="newskat" />
      <input type="hidden" name="id" value="[id]" />
      <input id="contentSubmit" type="submit" class="submit" value="Insert sub-category" />
    </form>
');
define('_msg_answer' , 'Answer');
define('_user_new_erase' , '<form method="post" action="?action=userlobby"><input type="hidden" name="erase" value="1" /><input id="contentSubmit" type="submit" name="submit" class="submit" value="Mark all as readed" /></form>');
define('_target' , 'New window');
define('_profile_add' , '<form action="" method="get" onsubmit="return(DZCP.submitButton())">
      <input type="hidden" name="admin" value="profile" />
      <input type="hidden" name="do" value="add" />
      <input id="contentSubmit" type="submit" class="submit" value="Insert profile field" />
    </form>');
define('_config_c_floods_what' , 'Here you can adjust the time in secontds which a user have to wait<br />to write something new in this area');

## ADDED FOR 1.4.3
define('_download_last_date' , 'Last downloaded');

## EDITED FOR 1.4.1
define('_ulist_normal' , 'Rank &amp; Level');

## ADDED FOR 1.4.1
define('_lobby_mymessages' , '<a href="../user/?action=msg">You have <span class="fontWichtig">[cnt]</span> new messages!</a>');
define('_lobby_mymessage' , '<a href="../user/?action=msg">You have <span class="fontWichtig">1</span> new message!</a>');

## EDIT/ADDED FOR 1.4
define('_protocol_action' , 'Action');
define('_protocol' , 'Admin protocol');
define('_button_title_del_protocol' , 'Completely delete the protocol!');
define('_protocol_deleted' , 'The admin protocol was successfull deleted!');
define('_vote_no_answer' , 'You have to choose an answer!');
define('_linkus_admin_edit' , 'Edit linkus');
define('_config_linkus' , 'Linkus');
define('_urls_linked_info', 'Convert text links into clickable hyperlinks');
define('_sponsoren' , 'Sponsors');
define('_downloads' , 'Downloads');
define('_nachrichten' , 'Messages');
define('_edit_profile' , 'Edit profile');
define('_config_c_lartikel' , 'Menu: Last article');
define('_config_hover' , 'Mouseover informations');
define('_config_seclogin' , 'Login securitycode');
define('_config_hover_standard' , 'Show standard informations');
define('_config_hover_all' , 'Show all informations');
define('_error_vote_show' , 'This is a public vote! Just internal votes can be shown detailed.');
define('_login_pwd_dont_match' , 'Loginname and/or password are invalid or account has been banned!');
define('_sq_aktiv' , 'Active');
define('_sq_inaktiv' , 'Inactive');
define('_sq_sstatus' , '<center>If checked, the team will be also shown in figtus form, etc</center>');
define('_internal' , 'Internal');
define('_sticky' , 'Important');
define('_misc' , "Misc");
define('_all' , "All");
define('_admin_support_head' , 'Support informations');
define('_admin_support_info' , 'The following informations are very helpful if you ask a support-question in the board of <a href="http://www.dzcp.de" target="_blank">www.dzcp.de</a>.');
define('_config_support' , 'Supportinformations');
define('_search_con_or' , 'OR-Operation');
define('_search_con_and' , 'AND-Operation');
define('_search_head' , 'Search');
define('_search_word' , 'Search in...');
define('_search_forum_all' , 'Search in all boards');
define('_search_forum_hint' , '(Through press the \'Strg key\', more<br />boards can be selected seperately)');
define('_search_for_area' , 'Searcharea');
define('_search_type_full' , 'Complete search');
define('_search_type_title' , 'Search in topics only');
define('_search_type' , 'Search type');
define('_search_type_autor' , 'Find authors');
define('_search_type_text' , 'Search in text and topics');
define('_search_in' , 'Search in...');
define('_user_profile_of' , 'Userprofile from ');
define('_sites_not_available' , 'The requested site does not exist!');
define('_wrote' , 'wrote');
define('_voted_head' , 'Already participated in the vote');
define('_show_who_voted' , 'Show user, who voted already');
define('_no_live_status' , 'No live status');
define('_comment_edited' , 'The comment was successfully edited!');
define('_comments_edit' , 'Edit comment');
define('_forum_post_where_preview' , '<a href="javascript:void(0)">[mainkat]</a> <span class="fontBold">Board:</span> <a href="javascript:void(0)">[wherekat]</a> <span class="fontBold">Thread:</span> <a href="javascript:void(0)">[wherepost]</a>');
define('_aktiv_icon' , '<img src="../inc/images/active.gif" alt="" class="icon" />');
define('_inaktiv_icon' , '<img src="../inc/images/inactive.gif" alt="" class="icon" />');
define('_pn_write_forum' , '<a href="../user/?action=msg&amp;do=pn&amp;id={$id}"><img src="{idir}/forum_pn.gif" alt="" title="write {$nick} a message" class="icon" /></a>');
define('_uhr' , 'h');
define('_kalender_admin_head' , 'Calendar - Events');
define('_preview' , 'Preview');
define('_error_edit_post' , 'You are not allowed to edit this entry!');
define('_nletter_prev_head' , 'Newsletter preview');
define('_error_downloads_upload' , 'There was an errow during the upload (filesize to big?)');
define('_news_comments_prev' , '<a href="javascript:void(0)">0 comments</a>');
define('_only_for_admins' , ' (IP is only visible for admins)');
define('_content' , 'Content');
define('_rootadmin' , 'Siteadmin');
define('_nletter' , 'Newsletter');
define('_subject' , 'Subject');
define('_nletter_head' , 'Write newsletter');
define('_squad', 'Team');
define('_confirm_del_vote' , 'You really want to delete this vote?');
define('_confirm_del_dl' , 'You really want to deletethis download?');
define('_confirm_del_entry' , 'You really want to delete this entry?');
define('_confirm_del_navi' , 'You really want to delete this link?');
define('_confirm_del_profil' , 'You really want to delete this profile field?');
define('_confirm_del_smiley' , 'You really want to delete this smiley?');
define('_confirm_del_kat' , 'You really want to delete this category?');
define('_confirm_del_artikel' , 'You really want to delete this article?');
define('_confirm_del_news' , 'You really want to delete this news?');
define('_confirm_del_site' , 'You really want to delete this site?');
define('_confirm_del_team' , 'You really want to delete this team?');
define('_confirm_del_ranking' , 'You really want to delete this ranking?');
define('_confirm_del_link' , 'You really want to delete this link?');
define('_confirm_del_sponsor' , 'You really want to delete this sponsor?');
define('_confirm_del_kalender' , 'You really want to delete this event?');
define('_link_type' , 'Link type');
define('_sponsor' , 'Sponsor');
//-----------------------------------------------
define('_main_info' , 'Here you can set global settings like default language, default template, title of the site, etc...');
define('_admin_eml_head' , 'Emailtemplates');
define('_admin_eml_info' , 'Here you can edit the emailtemplates from different areas.<br />Make sure that you do not delete the placeholders in the triggers [...]!');
define('_admin_reg_subj' , 'Subject: Registration');
define('_admin_pwd_subj' , 'Subject: Lost password');
define('_admin_nletter_subj' , 'Subject: Newsletter');
define('_admin_reg' , 'Template for registration');
define('_admin_pwd' , 'Template for lost password');
define('_admin_nletter' , 'Template for newsletter');
define('_result' , 'Result');
define('_opponent' , 'Opponent');
define('_played_at' , 'Played at');
define('_login_secure_help' , 'To verify, put the two-digit number code in the inputfield.');
define('_online_head_guests' , 'Guests online');
define('_admin_first' , 'at first');
define('_admin_squads_nav' , 'Navigation');
define('_admin_squad_show_info' , 'Defined weather a team in the team overview is shown or not shown by default.');
//Edited
define('_dl_getfile' , 'download {$file} now');
define('_partners_link_add' , 'Insert partner button');
define('_config_forum_kats_add' , 'Insert category');
define('_config_c_lnews' , 'Menu: Last news');
define('_msg_new' , 'Write new message');
define('_config_artikel' , 'Article');
define('_config_forum' , 'Board categories');
define('_config_gruppen' , 'Groups');
define('_config_news' , 'News-/Article categories');
define('_config_allgemein' , 'Configuration');
define('_config_impressum' , 'Imprint');
define('_config_downloads' , 'Download categories');
define('_config_newsadmin' , 'News');
define('_config_filebrowser' , 'Filebrowser');
define('_config_navi' , 'Navigation');
define('_config_online' , 'Site administration');
define('_config_partners' , 'Partner buttons');
define('_config_clear' , 'Clear database');
define('_config_profile' , 'Profile fields');
define('_config_votes' , 'Votes');
define('_config_kalender' , 'Calendar');
define('_config_einst' , 'Attitudes');
define('_profil_sig' , 'Board signature');
define('_akt_version' , 'DZCP Version');
define('_forum_searchlink' , '- <a href="../search/">Board search</a> -');
define('_msg_deleted' , 'The message was successfully deleted!');
define('_info_reg_valid' , 'You successfully registered on this page!<br />
Your password were send to your e-mail adress [email]');
define('_edited_by' , '<br /><br /><i>last edited by {$autor} at {$time}&nbsp;h</i>');
define('_linkus_empty_text' , 'You have to indicate an url of the banner!');
define('_empty_news_title' , 'You have to indicate a news headline!');
define('_member_admin_votes' , 'View internal votes');
define('_member_admin_votesadmin' , 'Admin: Votes');
define('_msg_global_all' , 'all members');
define('_pos_empty_kat' , 'You have to indicate a position!');
define('_forum_lastpost' , '<a href="?action=showthread&amp;id={$tid}&amp;page={$page}#p{$id}"><img src="../inc/images/forum_lpost.gif" alt="" title="Go to the last entry" class="icon" /></a>');
define('_forum_addpost' , 'New entry');
define('_pn_write' , '{$nick} a new message');
//--------------------------------------------\\
define('_error_invalid_regcode' , 'The entered safety code does not agree with the character sequence indicated in the diagram!');
define('_error_invalid_regcode_mathematic', 'Your calculation result from security code is not correct!');
define('_welcome_guest' , ' <img src="../inc/images/flaggen/nocountry.gif" alt="" class="icon" /> <a class="welcome" href="../user/?action=register">Guest</a>');
define('_online_head' , 'User online');
define('_online_whereami' , 'Area');
define('_back' , '<a href="javascript: history.go(-1)" class="files">back</a>');
define('_contact_text_fightus' , '
Someone filled out the fightus contactform!<br />
Each clanwar admin received this message!<br /><br />
<span class="fontBold">Team:</span> [squad]<br /><br />
<span class="fontUnder"><span class="fontBold">Contact:</span></span><br />
<span class="fontBold">Nick:</span> [nick]<br />
<span class="fontBold">Email:</span> [email]<br />
<span class="fontBold"><span class="fontUnder">Clandata:</span></span><br />
<span class="fontBold">Clan name:</span> [clan]<br />
<span class="fontBold">Homepage:</span> [hp]<br />
<span class="fontBold">Game:</span> [game]<br />
<span class="fontBold">XonX:</span> [us] vs. [to]<br />
<span class="fontBold">Our Map:</span> [map]<br />
<span class="fontBold">Date:</span> [date]<br /><span class="fontUnder">
<span class="fontBold">Comment:</span></span><br />[text]');
## EDITED/ADDED FOR v 1.3.3
define('_level_info' , 'By set the level "admin", the level can be unset by root admin only! (the one who installed the clanportal)!<br />Furthermore the owner this level has <span class="fontUnder">unrestricted</span> access to all administrative areas!');

## EDITED FOR v 1.3.1
define('_related_links','related Links:');
define('_profil_email2' , 'E-mail #2');
define('_profil_email3' , 'E-mail #3');

## Begruessungen ##
define('_welcome_18' , 'Good evening,');
define('_welcome_13' , 'Good day,');
define('_welcome_11' , 'Good lunch,');
define('_welcome_5' , 'Good morning,');
define('_welcome_0' , 'Good night,');

## Monate ##
define('_jan' , 'January');
define('_feb' , 'February');
define('_mar' , 'March');
define('_apr' , 'April');
define('_mai' , 'May');
define('_jun' , 'June');
define('_jul' , 'July');
define('_aug' , 'August');
define('_sep' , 'September');
define('_okt' , 'October');
define('_nov' , 'November');
define('_dez' , 'Dezember');

## Laenderliste ##
define('_country_list' , '
<option value="al"> Albania</option>
<option value="dz"> Algeria</option>
<option value="ao"> Angola</option>
<option value="ar"> Argentinia</option>
<option value="am"> Armenia</option>
<option value="aw"> Aruba</option>
<option value="au"> Australia</option>
<option value="at"> Austria</option>
<option value="az"> Azerbaijan</option>
<option value="bs"> Bahamas</option>
<option value="bh"> Bahrain</option>
<option value="bd"> Bangladesh</option>
<option value="bb"> Barbados</option>
<option value="be"> Belgium</option>
<option value="bz"> Belize</option>
<option value="bj"> Benin</option>
<option value="bm"> Bermuda</option>
<option value="bt"> Bhutan</option>
<option value="bo"> Bolivia</option>
<option value="ba"> Bosnia Herzegovina</option>
<option value="bw"> Botswana</option>
<option value="br"> Brazil</option>
<option value="bn"> Brunei Darussalam</option>
<option value="bg"> Bulgaria</option>
<option value="bf"> Burkina Faso</option>
<option value="bi"> Burundi</option>
<option value="ca"> Canada</option>
<option value="cv"> Cape Verde</option>
<option value="ky"> Cayman Islands</option>
<option value="cf"> Central African republic</option>
<option value="cl"> Chile</option>
<option value="cn"> China</option>
<option value="co"> Colombia</option>
<option value="cg"> Congo</option>
<option value="ck"> Cook Islands</option>
<option value="cr"> Costa Rica</option>
<option value="ci"> Cote D"Ivoire</option>
<option value="hr"> Croatia</option>
<option value="cu"> Cuba</option>
<option value="cy"> Cyprus</option>
<option value="cz"> Czech Republic</option>
<option value="dk"> Denmark</option>
<option value="tp"> East Timor</option>
<option value="ec"> Ecuador</option>
<option value="eg"> Egypt</option>
<option value="er"> Eritrea</option>
<option value="ee"> Estonia</option>
<option value="et"> Ethiopia</option>
<option value="fo"> Faroer islands</option>
<option value="fj"> Fiji</option>
<option value="fi"> Finland</option>
<option value="fr"> France</option>
<option value="pf"> French Polynesia</option>
<option value="ga"> Gabon</option>
<option value="ge"> Georgia</option>
<option value="de"> Germany</option>
<option value="gi"> Gibraltar</option>
<option value="gr"> Greece</option>
<option value="uk"> Great Britain</option>
<option value="gl"> Greenland</option>
<option value="gp"> Guadeloupe</option>
<option value="gu"> Guam</option>
<option value="gt"> Guatemala</option>
<option value="gy"> Guyana</option>
<option value="ht"> Haiti</option>
<option value="hk"> Hong Kong</option>
<option value="hu"> Hungary</option>
<option value="is"> Iceland</option>
<option value="in"> India</option>
<option value="id"> Indonesia</option>
<option value="ir"> Iran</option>
<option value="iq"> Iraq</option>
<option value="ie"> Ireland</option>
<option value="il"> Israel</option>
<option value="it"> Italia</option>
<option value="jm"> Jamaica</option>
<option value="jp"> Japan</option>
<option value="jo"> Jordan</option>
<option value="kh"> Kambodscha</option>
<option value="cm"> Kamerun</option>
<option value="qa"> Katar</option>
<option value="kz"> Kazachstan</option>
<option value="ke"> Kenya</option>
<option value="ki"> Kiribati</option>
<option value="kg"> Kyrgyzstan</option>
<option value="lv"> Latvia</option>
<option value="lb"> Lebanon</option>
<option value="ly"> Lybia</option>
<option value="li"> Liechtenstein</option>
<option value="lt"> Lithuania</option>
<option value="lu"> Luxembourg</option>
<option value="mo"> Macau</option>
<option value="mk"> Macedonia</option>
<option value="mg"> Madagascar</option>
<option value="my"> Malaysia</option>
<option value="mx"> Mexico</option>
<option value="md"> Moldova</option>
<option value="mc"> Monaco</option>
<option value="mn"> Mongolia</option>
<option value="ms"> Montserrat</option>
<option value="ma"> Marocco</option>
<option value="mz"> Mozambique</option>
<option value="na"> Namibia</option>
<option value="nr"> Nauru</option>
<option value="np"> Nepal</option>
<option value="nl"> Netherlands</option>
<option value="an"> Netherlands Antilles</option>
<option value="nc"> New Caledonia</option>
<option value="nz"> New Zealand</option>
<option value="kp"> North Korea</option>
<option value="nf"> Norfolk Island</option>
<option value="mp"> Northern Marianen</option>
<option value="no"> Norway</option>
<option value="om"> Oman</option>
<option value="pk"> Pakistan</option>
<option value="pa"> Panama</option>
<option value="py"> Paraguay</option>
<option value="pe"> Peru</option>
<option value="ph"> Philippines</option>
<option value="pl"> Poland</option>
<option value="pt"> Portugal</option>
<option value="pr"> Puerto Rico</option>
<option value="ro"> Romania</option>
<option value="ru"> Russia</option>
<option value="lc"> Saint Lucia</option>
<option value="pm"> Saint Pierre and Miquelon</option>
<option value="ws"> Samoa</option>
<option value="sa"> Saudi Arabien</option>
<option value="sx"> Scottland</option>
<option value="sl"> Sierra Leone</option>
<option value="sg"> Singapur</option>
<option value="sk"> Slovakia</option>
<option value="si"> Slovenia</option>
<option value="sb"> Solomon Islands</option>
<option value="so"> Somalia</option>
<option value="za"> South Afrika</option>
<option value="kr"> South Korea</option>
<option value="es"> Spain</option>
<option value="lk"> Sri Lanka</option>
<option value="sd"> Sudan</option>
<option value="sr"> Suriname</option>
<option value="se"> Sweden</option>
<option value="ch"> Switzerland</option>
<option value="sy"> Syria</option>
<option value="tw"> Taiwan</option>
<option value="tz"> Tanzania</option>
<option value="th"> Thailand</option>
<option value="tg"> Togo</option>
<option value="to"> Tonga</option>
<option value="tt"> Trinidad and Tobago</option>
<option value="tn"> Tunisia</option>
<option value="tr"> Turkey</option>
<option value="tc"> Turks and Caicos Islands</option>
<option value="tv"> Tuvalu</option>
<option value="ug"> Uganda</option>
<option value="ua"> Ukraine</option>
<option value="uy"> Uruguay</option>
<option value="us"> USA</option>
<option value="ve"> Venezuela</option>
<option value="va"> Vatikan</option>
<option value="ae"> United Arab Emirates</option>
<option value="vn"> Vietnam</option>
<option value="vg"> Virgin Islands, Britisch</option>
<option value="vi"> Virgin Islands, U.S.</option>
<option value="by"> White Russia</option>
<option value="yu"> Yugoslavia</option>
<option value="ye"> Yemen</option>
<option value="zm"> Zambia</option>');

## Globale Userraenge ##
define('_status_banned' , 'banned');
define('_status_unregged' , 'unregistered');
define('_status_user' , 'User');
define('_status_trial' , 'Trial');
define('_status_member' , 'Member');
define('_status_admin' , 'Admin');

## Userliste ##
define('_acc_banned' , 'Banned');
define('_ulist_acc_banned' , 'Banned accounts');

## Navigation: Kalender ##
define('_kal_birthday' , 'Birthday from ');
define('_kal_event' , 'Event: ');

## News ##
define('_news_kommentar' , 'Comment');
define('_news_kommentare' , 'Comments');
define('_news_archiv' , '<a href="?action=archiv">Archive</a>');
define('_news_comments_write_head' , 'Write new comment');
define('_news_archiv_sort' , 'Sort by');
define('_news_archiv_head' , 'News archive');
define('_news_kat_choose' , 'Choose category');

## Artikel ##
define('_artikel_comments_write_head' , 'Write new comment');

## Forum ##
define('_forum_head' , 'Board');
define('_forum_topic' , 'Topic');
define('_forum_subtopic' , 'Subtitle');
define('_forum_lpost' , 'Last entry');
define('_forum_threads' , 'Threads');
define('_forum_thread' , 'Thread');
define('_forum_posts' , 'Posts');
define('_forum_cnt_threads' , '<span class="fontBold">Amount of threads:</span> [threads]');
define('_forum_cnt_posts' , '<span class="fontBold">Amount of Posts:</span> [posts]');
define('_forum_admin_head' , 'Admin');
define('_forum_admin_addsticky' , 'mark as <span class="fontWichtig">important</span>?');
define('_forum_katname_intern' , '<span class="fontWichtig">Internal:</span> {$katname}');
define('_forum_sticky' , '<span class="fontWichtig">Important:</span>');
define('_forum_head_skat_search' , 'Search in this category');
define('_forum_head_threads' , 'Threads');
define('_forum_replys' , 'Answers');
define('_forum_new_thread_head' , 'Insert thread');
define('_empty_topic' , 'You have to indicate a topic!');
define('_forum_newthread_successful' , 'The thread was successfully registered to the board!');
define('_forum_new_post_head' , 'Add new post');
define('_forum_newpost_successful' , 'The post was successfully registered to the board!');
define('_posted_by' , '<span class="fontBold">&raquo;</span> ');
define('_forum_post_where' , '<a href="../forum/">[mainkat]</a> <span class="fontBold">Board:</span> <a href="?action=show&amp;id=[kid]">[wherekat]</a> <span class="fontBold">Thread:</span> <a href="?action=showthread&amp;id=[tid]">[wherepost]</a>');
define('_forum_lpostlink' , 'Last post');
define('_forum_user_posts' , '<span class="fontBold">posts:</span> {$posts}');
define('_sig' , '<br /><br /><hr />');
define('_error_forum_closed' , 'This thread is closed!');
define('_forum_search_head' , 'Board search');
define('_forum_edit_post_head' , 'Edit post');
define('_forum_edit_thread_head' , 'Edit thread');
define('_forum_editthread_successful' , 'The thread was successfully edited!');
define('_forum_editpost_successful' , 'The entry was successfully edited!');
define('_forum_delpost_successful' , 'The entry was successfully deleted!');
define('_forum_admin_open' , 'Thread is opened');
define('_forum_admin_delete' , 'Delete thread?');
define('_forum_admin_close' , 'Thread is closed');
define('_forum_admin_moveto' , 'Move thread to:');
define('_forum_admin_thread_deleted' , 'The thread was successfully deleted!');
define('_forum_admin_do_move' , 'The thread was successfully edited<br />and moved into the category <span class="fontWichtig">[kat]</span>!');
define('_forum_admin_modded' , 'The thread was successfully edited!');
define('_forum_search_what' , 'Search for');
define('_forum_search_kat' , 'in category');
define('_forum_search_suchwort' , 'Keywords');
define('_forum_search_inhalt' , 'Content');
define('_forum_search_kat_all' , 'all Categories');
define('_forum_search_results' , 'Search results');
define('_forum_online_head' , 'Browsing the board');
define('_forum_nobody_is_online' , 'Right now no user is browsing the board!');

## Kalender ##
//-> Allgemein
define('_kalender_head' , 'Calendar');
define('_kalender_month_select' , '<option value="[i]" [sel]>[month]</option>');
define('_kalender_year_select' , '<option value="[i]" [sel]>[year]</option>');
define('_montag' , 'Monday');
define('_dienstag' , 'Tuesday');
define('_mittwoch' , 'Wednesday');
define('_donnerstag' , 'Thursday');
define('_freitag' , 'Friday');
define('_samstag' , 'Saturday');
define('_sonntag' , 'Sunday');

//-> Events
define('_kalender_events_head' , 'Events at [datum]');
define('_kalender_uhrzeit' , 'Time');

//-> Admin
define('_kalender_admin_head_add' , 'Insert event');
define('_kalender_admin_head_edit' , 'Edit event');
define('_kalender_event' , 'Event');
define('_kalender_error_no_time' , 'You have to indcate the date and time for this event!');
define('_kalender_error_no_title' , 'You have to indicate a title!');
define('_kalender_error_no_event' , 'You have to describe this event!');
define('_kalender_successful_added' , 'The event was successfully registered!');
define('_kalender_successful_edited' , 'The event was successfully edited!');
define('_kalender_deleted' , 'The event was successfully deleted!');

## Umfragen ##
define('_error_vote_closed' , 'This vote is closed!');
define('_votes_admin_closed' , 'Close vote');
define('_votes_head' , 'Votes');
define('_votes_stimmen' , 'Voted');
define('_votes_intern' , '<span class="fontWichtig">Internal:</span> ');
define('_votes_results_head' , 'Vote results');
define('_votes_results_head_vote' , 'Answers');
define('_vote_successful' , 'You successfully participated in this vote!');
define('_votes_admin_head' , 'Insert Vote');
define('_votes_admin_question' , 'Question');
define('_votes_admin_answer' , 'Possible answers');
define('_empty_votes_question' , 'You have to indicate a question!');
define('_empty_votes_answer' , 'You have to indicate at least 2 answers!');
define('_votes_admin_intern' , 'internal vote');
define('_vote_admin_successful' , 'The vote was successfully registered!');
define('_vote_admin_delete_successful' , 'The vote was successfully deleted!');
define('_vote_admin_successful_menu' , 'The vote is successfully registered into the menu!');
define('_vote_admin_menu_isintern' , 'It`s impossible to set an internal vote into the menu!');
define('_vote_legendemenu' , 'Vote set into menu?<br />(Press icon to set/unset vote)');
define('_votes_admin_edit_head' , 'Edit vote');
define('_vote_admin_successful_edited' , 'The vote was successfully edited!');
define('_vote_admin_successful_menu1' , 'The menu was successfully unset from the menu!');
define('_error_voted_again' , 'You already participated in this vote!');

## Links/Sponsoren ##
define('_links_head' , 'Links');
define('_links_admin_head' , 'Insert link');
define('_links_admin_head_edit' , 'Edit link');
define('_links_link' , 'URL');
define('_links_beschreibung' , 'Description');
define('_links_art' , 'Type');
define('_links_admin_textlink' , 'Textlink');
define('_links_admin_bannerlink' , 'Bannerlink');
define('_links_text' , 'Banner URL');
define('_links_empty_beschreibung' , 'You have to indicate a description!');
define('_links_empty_link' , 'You have to indicate an url!');
define('_link_added' , 'The link was successfully registered!');
define('_link_edited' , 'The link was successfully edited!');
define('_link_deleted' , 'The link was successfully deleted!');
define('_sponsor_head' , 'Sponsors');

## Downloads ##
define('_downloads_head' , 'Downloads');
define('_downloads_download' , 'Download');
define('_downloads_admin_head' , 'Insert Download');
define('_downloads_nofile' , '<option value="lazy">- no file -</option>');
define('_downloads_admin_head_edit' , 'Edit download');
define('_downloads_lokal' , 'lokal file');
define('_downloads_exist' , 'File');
define('_downloads_name' , 'Download name');
define('_downloads_url' , 'File');
define('_downloads_kat' , 'Categorie');
define('_downloads_empty_download' , 'You have to indicate a download name!');
define('_downloads_empty_url' , 'You have to indicate a file!');
define('_downloads_empty_beschreibung' , 'You have to indicate a description!');
define('_downloads_added' , 'The download was successfully registered!');
define('_downloads_edited' , 'The download was successfully edited!');
define('_downloads_deleted' , 'The download was successfully deleted!');
define('_dl_info' , 'Download informations');
define('_dl_file' , 'File');
define('_dl_files' , 'Files');
define('_dl_besch' , 'Descriptopm');
define('_dl_info2' , 'File informations');
define('_dl_size' , 'Filesize');
define('_dl_speed' , 'Download speed');
define('_dl_traffic' , 'Caused traffic');
define('_dl_loaded' , 'Downloaded');
define('_dl_date' , 'Upload date');
define('_dl_wait' , 'Download of file: ');

## Teams ##
define('_member_squad_head' , 'Teams');
define('_member_squad_no_entrys' , '<tr><td align="center"><span class="fontBold">No registered members</span></td></tr>');
define('_member_squad_weare' , 'Alltogether we are <span class="fontBold">[cm] members</span>, seperated in <span class="fontBold">[cs] team(s)</span>');

define('_contact_pflichtfeld' , '<span class="fontWichtig">*</span> = Required field');
define('_contact_nachricht' , 'Message');
define('_contact_sended' , 'Your message was successfully sent to the site`s admin!');
define('_contact_title' , 'Contact form');
define('_contact_text' , '
Somebody filled out the contact form!<br /><br />
<span class="fontBold">Nick:</span> [nick]<br />
<span class="fontBold">Email:</span> [email]<br /><br />
<span class="fontUnder"><span class="fontBold">Message:</span></span><br />[text]');
## User ##
define('_profil_head' , '<span class="fontBold">Userprofile from {$nick}</span> [{$profilhits} times viewed]');
define('_login_head' , 'Login');
define('_new_pwd' , 'new password');
define('_register_head' , 'Registration');
define('_register_confirm' , 'Securitycode');
define('_register_confirm_add' , 'Enter code');
define('_lostpwd_head' , 'Send password');
define('_profil_edit_head' , 'Edit profile from {$nick}');
define('_profil_clan' , 'Clan');
define('_profil_pic' , 'Picture');
define('_profil_contact' , 'Contact');
define('_profil_hardware' , 'Hardware');
define('_profil_about' , 'About me');
define('_profil_real' , 'Name');
define('_profil_city' , 'City');
define('_profil_bday' , 'Birthday');
define('_profil_age' , 'Age');
define('_profil_hobbys' , 'Hobbys');
define('_profil_motto' , 'Slogan');
define('_profil_hp' , 'Homepage');
define('_profil_sex' , 'Sex');
define('_profil_board' , 'Mainboard');
define('_profil_cpu' , 'CPU');
define('_profil_ram' , 'RAM');
define('_profil_graka' , 'Videocard');
define('_profil_monitor' , 'Monitor');
define('_profil_maus' , 'Mouse');
define('_profil_mauspad' , 'Mousepad');
define('_profil_hdd' , 'HDD');
define('_profil_headset' , 'Headset');
define('_profil_os' , 'System');
define('_profil_inet' , 'Internet');
define('_profil_job' , 'Job');
define('_profil_position' , 'Position');
define('_profil_exclans' , 'Ex-Clans');
define('_profil_status' , 'Status');
define('_aktiv' , '<span class=fontGreen>active</span>');
define('_inaktiv' , '<span class=fontRed>inactive</span>');
define('_male' , 'male');
define('_female' , 'female');
define('_profil_ppic' , 'Profile picture');
define('_profil_gamestuff' , 'Gamestuff');
define('_profil_userstats' , 'Userstats');
define('_profil_navi_profil' , '<a href="?action=user&amp;id=[id]">Profile</a>');
define('_profil_profilhits' , 'Profile hits');
define('_profil_forenposts' , 'Posts in board');
define('_profil_votes' , 'participated votes');
define('_profil_msgs' , 'messages sent');
define('_profil_logins' , 'Logins');
define('_profil_registered' , 'Date of registration');
define('_profil_last_visit' , 'Last page visit');
define('_profil_pagehits' , 'Pagehits');
define('_pedit_visibility', 'Visibility/Permissions');
define('_pedit_perm_public', 'Public');
define('_pedit_perm_user', 'User only');
define('_pedit_perm_member', 'Member only');
define('_pedit_perm_admin', 'Admin only');
define('_pedit_perm_allow', '<option value="1" selected="selected">Allow</option><option value="0">Deny</option>');
define('_pedit_perm_deny', '<option value="1">Allow</option><option value="0" selected="selected">Deny</option>');
define('_profil_edit_pic' , '<a href="../upload/?action=userpic">upload</a>');
define('_profil_delete_pic' , '<a href="../upload/?action=userpic&amp;do=deletepic">delete</a>');
define('_profil_edit_ava' , '<a href="../upload/?action=avatar">upload</a>');
define('_profil_delete_ava' , '<a href="../upload/?action=avatar&amp;do=delete">delete</a>');
define('_pedit_male' , '<option value="0">no indication</option><option value="1" selected="selected">male</option><option value="2">female</option>');
define('_pedit_female' , '<option value="0">no indication</option><option value="1">male</option><option value="2" selected="selected">female</option>');
define('_pedit_sex_ka' , '<option value="0">no indication</option><option value="1">male</option><option value="2">female</option>');
define('_info_edit_profile_done' , 'Your profile was successfully edited!');
define('_delete_pic_successful' , 'Your picture was successfully deleted!');
define('_no_pic_available' , 'No picture from you are available!');
define('_profil_edit_profil_link' , '<a href="?action=editprofile">Edit profile</a>');
define('_profil_avatar' , 'Avatar');
define('_lostpwd_failed' , 'Loginname and email address does not match!');
define('_lostpwd_valid' , 'A new password was generated and sent to you by e-mail!');
define('_error_user_already_in' , 'You are logged in already!');
define('_user_is_banned' , 'Your account is banned by a site admin.');
define('_msghead' , 'Messagecenter from {$nick}');
define('_posteingang' , 'Inbox');
define('_postausgang' , 'Outbox');
define('_msg_title' , 'Message');
define('_msg_absender' , 'From');
define('_msg_empfaenger' , 'To');
define('_msg_answer_msg' , 'Message from {$nick}');
define('_msg_sended_msg' , 'Message to {$nick}');
define('_msg_answer_done' , 'The message was successfuly sent!');
define('_msg_titel' , 'Write new message');
define('_msg_titel_answer' , 'Answer');
define('_to' , 'To');
define('_or' , 'or');
define('_msg_to_just_1' , 'You can indicate just one receiver!');
define('_msg_not_to_me' , 'You can`t write yourself!');
define('_legende_readed' , 'Message was read by receiver?');
define('_legende_msg' , 'New message');
define('_msg_from_nick' , 'Message from {$nick}');
define('_msg_global_reg' , 'all registered user');
define('_msg_global_squad' , 'following team:');
define('_msg_bot' , '<span class="fontBold">MsgBot</span>');
define('_msg_global_who' , 'Receiver');
define('_msg_reg_answer_done' , 'The message was successfully sent to all registered users!');
define('_msg_member_answer_done' , 'The message was successfully sent to all members!');
define('_msg_squad_answer_done' , 'The message was successfully sent to all members of the selected team!');
define('_buddyhead' , 'Buddies');
define('_addbuddys' , 'Add buddies');
define('_buddynick' , 'Buddy');
define('_add_buddy_successful' , 'The user was successfully added as buddy!');
define('_buddys_legende_addedtoo' , 'The user aded you as buddy, too');
define('_buddys_legende_dontaddedtoo' , 'The user didn`t added you as buddy, too');
define('_buddys_delete_successful' , 'The user was successfully deleted as buddy!');
define('_buddy_added_msg' , 'The user <span class="fontBold">{$user}</span> added you to his buddies!');
define('_buddy_title' , 'Buddies');
define('_buddy_del_msg' , 'The user <span class="fontBold">{$user}</span> deleted you from his buddies!');
define('_ulist_lastreg' , 'newest user');
define('_ulist_online' , 'Onlinestatus');
define('_ulist_age' , 'Age');
define('_ulist_sex' , 'Sex');
define('_ulist_country' , 'Nationality');
define('_ulist_sort' , 'Sort by:');
define('_admin_user_edithead' , 'Admin: Edit users');
define('_admin_user_clanhead' , 'Authorisation');
define('_admin_user_squadhead' , 'Team');
define('_admin_user_personalhead' , 'Personal');
define('_admin_user_level' , 'Level');
define('_admin_user_edituser' , 'Edit users');
define('_admin_user_editsquads' , 'Admin: Teams');
define('_admin_user_editkalender' , 'Admin: Calendar');
define('_member_admin_newsletter' , 'Admin: Newsletter');
define('_member_admin_downloads' , 'Admin: Downloads');
define('_member_admin_links' , 'Admin: Links');
define('_member_admin_forum' , 'Admin: Forum');
define('_member_admin_intforum' , 'View internal boards');
define('_member_admin_news' , 'Admin: News');
define('_error_edit_myself' , 'You can`t edit yourself!');
define('_error_edit_admin' , 'You are not allowed to edit admins!');
define('_admin_level_banned' , 'Ban account');
define('_admin_user_identitat' , 'Identity');
define('_admin_user_get_identitat' , '<a href="?action=admin&amp;do=identy&amp;id={$id}">take identity</a>');
define('_identy_admin' , 'You can`t take the identity from an admin!');
define('_admin_squad_del' , '<option value="delsq">- delete user out of this team -</option>');
define('_admin_squad_nosquad' , '<option class="dropdownKat" value="lazy">- user isn`t in a team -</option>');
define('_admin_user_edited' , 'The user successfully was edited!');
define('_userlobby' , 'Userlobby');
define('_lobby_new' , 'New stuff since your last page visit');
define('_lobby_new_erased' , 'You successfully marked everything as readed!');
define('_last_forum' , 'last 10 board posts');
define('_lobby_forum' , 'Board posts');
define('_new_post_1' , 'new post');
define('_new_post_2' , 'new posts');
define('_new_thread' , 'in thread ');
define('_no_new_thread' , 'New thread:');
define('_new_eintrag_1' , 'new entry');
define('_new_eintrag_2' , 'new entries');
define('_lobby_user' , 'Registered user');
define('_new_users_1' , 'new registered User');
define('_new_users_2' , 'new registered Users');
define('_lobby_news' , 'News');
define('_lobby_new_news' , 'new news');
define('_lobby_newsc' , 'News comments');
define('_lobby_new_newsc_1' , 'new comment');
define('_lobby_new_newsc_2' , 'new comments');
define('_new_msg_1' , 'new message');
define('_new_msg_2' , 'new messages');
define('_lobby_votes' , 'Votes');
define('_new_vote_1' , 'new Vote');
define('_new_vote_2' , 'new Votes');
define('_user_delete_verify' , '
<tr>
  <td class="contentHead"><span class="fontBold">Delete user</span></td>
</tr>
<tr>
  <td class="contentMainFirst" align="center">
    Are you sure to delete the user {$user}?<br />
    <span class="fontUnder">Every</span> activities from this user will be deleted, too!<br /><br />
    <a href="?action=admin&amp;do=delete&verify=yes&amp;id={$id}">Yes, delete {$user}!</a>
  </td>
</tr>');
define('_user_deleted' , 'The user successfully was deleted!');
define('_userlobby_kal_today' , 'Next event is');
define('_userlobby_kal_not_today' , 'Next event is at');
define('_profil_country' , 'Country');
define('_profil_favos' , 'Favorites');
define('_profil_drink' , 'Drink');
define('_profil_essen' , 'Meal');
define('_profil_film' , 'Film');
define('_profil_musik' , 'Music');
define('_profil_song' , 'Song');
define('_profil_buch' , 'Book');
define('_profil_autor' , 'Author');
define('_profil_person' , 'Person');
define('_profil_sport' , 'Sport');
define('_profil_sportler' , 'Sportsman');
define('_profil_auto' , 'Car');
define('_profil_favospiel' , 'Game');
define('_profil_game' , 'Game');
define('_profil_favoclan' , 'Clan');
define('_profil_spieler' , 'Player');
define('_profil_sonst' , 'Misc');
define('_profil_url1' , 'Page #1');
define('_profil_url2' , 'Page #2');
define('_profil_url3' , 'Page #3');
define('_profil_ich' , 'Description');
## Upload ##
define('_upload_ext_error' , 'Only jpg, gif or png files!');
define('_upload_wrong_size' , 'The uploaded file is bigger than allowed!!');
define('_upload_no_data' , 'You have to indicate a file!');
define('_info_upload_success' , 'The file was successfully uploaded!');
define('_upload_info' , 'Info');
define('_upload_file' , 'File');
define('_upload_beschreibung' , 'Description');
define('_upload_button' , 'upLoad');
define('_upload_over_limit' , 'You are not allowed to upload more pictuires! Delete present pictures to upload a new one!');
define('_upload_file_exists' , 'The uploaded file already exists! Rename the file and upload again or upload another file!');
define('_upload_head' , 'Upload userpic');
define('_upload_userpic_info' , ' Only jpg, gif or png files with a maximum filesize of {$userpicsize}KB!<br />The recommended dimension is 170px * 210px ');
define('_upload_ava_head' , 'Useravatar');
define('_upload_userava_info' , 'Only jpg, gif or png files with a maximum filesize of {$userpicsize}KB!<br />The recommended dimension is 100px * 100px ');
define('_upload_newskats_head' , 'Category pictures');

## Unzugeordnet ##
define('_config_maxwidth' , 'Resize pictures automatically');
define('_config_maxwidth_info' , 'Here you can adjust at which width a picture will be resized!');
define('_forum_top_posts' , 'Top 5 poster');
define('_user_cant_delete_admin' , 'You can`t delete members or admins!');
define('_no_entrys_yet' , '
<tr>
  <td class="contentMainFirst" colspan="{$colspan}" align="center">No entry yetn!</td>
</tr>');
define('_nav_no_ftopics' , 'No entry yet!');
define('_fopen' , 'The webhoster of this site does not allow the function fopen() which is needed!');
define('_and' , 'and');
define('_lobby_artikelc' , 'Article comments');
define('_lobby_new_art_1' , 'new article');
define('_lobby_new_art_2' , 'new article');
define('_user_new_art' , '&nbsp;&nbsp;<a href="../artikel/"><span class="fontWichtig">[cnt]</span> [eintrag]</span><br />');
define('_lobby_new_artc_1' , 'new comment');
define('_lobby_new_artc_2' , 'new comments');
define('_page' , '<span class="fontBold">[num]</span>  ');
define('_profil_nletter' , 'Receive newsletter?');
define('_forum_admin_addglobal' , '<span class="fontWichtig">Global</span> entry? (In all boards and subboards)');
define('_forum_admin_global' , '<span class="fontWichtig">Global</span> entry?');
define('_forum_global' , '<span class="fontWichtig">global:</span>');
define('_admin_config_badword' , 'Badwordfilter');
define('_admin_config_badword_info' , 'Here you can indicate the words, which will be filter and replaced with ***. The words have to be seperated with a comma!');
define('_iplog_info' , '<span class="fontBold">Note:</span> In case of security reasons your ip will be logged!');
define('_logged' , 'IP saved');
define('_info_ip' , 'IP Address');
define('_info_browser' , 'Browser');
define('_info_res' , 'Solution');
define('_unknown_browser' , 'unknown browser');
define('_unknown_system' , 'unknown system');
define('_info_sys' , 'System');
define('_nav_montag' , 'Mo');
define('_nav_dienstag' , 'Tu');
define('_nav_mittwoch' , 'We');
define('_nav_donnerstag' , 'Th');
define('_nav_freitag' , 'Fr');
define('_nav_samstag' , 'Sa');
define('_nav_sonntag' , 'Su');
define('_age' , 'Age');
define('_error_empty_age' , 'You have to indicate your actual age!');
define('_member_admin_intforums' , 'internal board authorisation');
define('_access' , 'Authorisation');
define('_error_no_access' , 'You don`t have the rights to enter this area!');
define('_artikel_show_link' , '<a href="../artikel/?action=show&amp;id=[id]">[titel]</a>');
define('_ulist_bday' , 'Birthday');
define('_ulist_last_login' , 'Last login');

## Impressum ##
define('_impressum_head' , 'Imprint');
define('_impressum_autor' , 'Author of the site');
define('_impressum_domain' , 'Domain:');
define('_impressum_disclaimer' , 'Disclaimer');
define('_impressum_txt' , '<blockquote>
<h2><span class="fontBold">1. Content</span></h2>
<br />
The author reserves the right not to be responsible for the topicality, correctness,
completeness or quality of the information provided. Liability claims regarding
damage caused by the use of any information provided, including any kind
of information which is incomplete or incorrect,will therefore be rejected.
<br />All offers are not-binding and without obligation. Parts of the pages or the complete
publication including all offers and information might be extended, changed
or partly or completely deleted by the author without separate announcement.
<br /><br />
<h2><span class="fontBold">2. Referrals and links</span></h2>
<br />
The author is not responsible for any contents linked or referred to from his pages - unless he has full knowledge of illegal contents and would be able to prevent the visitors of his site fromviewing those pages.
If any damage occurs by the use of information presented there, only the author of the respective pages might be liable, not the one who has linked to these pages. Furthermore the author is not liable for any postings or messages published by users of discussion boards, guestbooks or mailinglists provided on his page.
<br /><br />
<h2><span class="fontBold">3. Copyright</span></h2>
<br />
The author intended not to use any copyrighted material for the publication or, if not possible, to indicate the copyright of the respective object.
<br />
The copyright for any material created by the author is reserved. Any duplication or use of objects such as images, diagrams, sounds or texts in other
electronic or printed publications is not permitted without the author\'s agreement.
<br /><br />
<h2><span class="fontBold">4. Privacy policy<</span></h2>
<br />
If the opportunity for the input of personal or business data (email addresses, name, addresses) is given, the input of these data takes place voluntarily. The use and payment of all offered services are permitted - if and so far technically possible and reasonable - without specification of any personal data or under specification of anonymized data or an alias.
The use of published postal addresses, telephone or fax numbers and email addresses for marketing purposes is prohibited, offenders sending unwanted spam messages will be punished.
<br /><br />
<h2><span class="fontBold">5. Legal validity of this disclaimer</span></h2>
<br />
This disclaimer is to be regarded as part of the internet publication which you were referred from. If sections or individual terms of this statement are not legal or correct, the content or validity of the other parts remain uninfluenced by this fact.
</blockquote>');

## Admin ##
define('_config_head' , 'Administrative area');
define('_config_empty_katname' , 'You have to indicate a category description!');
define('_config_katname' , 'Category description');
define('_config_set' , 'The attitudes were successfully saved!');
define('_config_forum_status' , 'Status');
define('_config_forum_head' , 'Board categories');
define('_config_forum_mainkat' , 'Main category');
define('_config_forum_subkathead' , 'Sub categories from <span class="fontUnder">[kat]</span>');
define('_config_forum_subkat' , 'Sub  category');
define('_config_forum_subkats' , '<span class="fontBold">[topic]</span><br /><span class="fontItalic">[subtopic]</span>');
define('_config_forum_kat_head' , 'Insert category');
define('_config_forum_public' , 'public');
define('_config_forum_intern' , 'internal');
define('_config_forum_kat_added' , 'The category was successfully registered!');
define('_config_forum_kat_deleted' , 'The category was successfully deleted!');
define('_config_forum_kat_head_edit' , 'Edit category');
define('_config_forum_kat_edited' , 'The category was successfully edited!');
define('_config_forum_add_skat' , 'Insert sub category');
define('_config_forum_skatname' , 'Sub category description');
define('_config_forum_empty_skat' , 'You have to indicate a sub category description!');
define('_config_forum_skat_added' , 'The sub category was successfully registered!');
define('_config_forum_stopic' , 'Subtitle');
define('_config_forum_skat_edited' , 'The sub category was successfully edited!');
define('_config_forum_edit_skat' , 'Edit sub category');
define('_config_forum_skat_deleted' , 'The sub category was successfully deleted!');
define('_config_newskats_kat' , 'Category');
define('_config_newskats_head' , 'News-/Article categories');
define('_config_newskats_katbild' , 'Category pic');
define('_config_newskats_add' , '<a href="?admin=news&amp;do=add">Insert category picture</a>');
define('_config_newskat_deleted' , 'The category was successfully deleted!');
define('_config_newskats_add_head' , 'Insert category');
define('_config_newskats_added' , 'The category was sucessfully registeredD!');
define('_config_newskats_edit_head' , 'Edit category');
define('_config_newskats_edited' , 'The category was successfully edited!');
define('_config_impressum_head' , 'Imprint');
define('_config_impressum_domains' , 'Domains');
define('_config_impressum_autor' , 'Author of this site');
define('_news_admin_head' , 'Newsarea');
define('_admin_news_add' , '<a href="?admin=newsadmin&amp;do=add">Insert news</a>');
define('_admin_news_head' , 'Insert news');
define('_news_admin_kat' , 'Category');
define('_news_admin_klapptitel' , 'Cliptitle');
define('_news_admin_more' , 'More');
define('_empty_news' , 'You have to indicate a news!');
define('_news_sended' , 'The news was successfully registered!');
define('_admin_news_edit_head' , 'Edit news');
define('_news_edited' , 'The news was successfully edited!');
define('_news_deleted' , 'The news was successfully deleted!');
define('_member_admin_header' , 'Teamarea');
define('_member_admin_squad' , 'Group');
define('_member_admin_game' , 'Game');
define('_member_admin_icon' , 'Icon');
define('_member_admin_add' , '<a href="?admin=squads&amp;do=add">Insert team</a>');
define('_admin_squad_deleted' , 'The team was successfully deleted!');
define('_member_admin_add_header' , 'Insert team');
define('_admin_squad_no_squad' , 'You have to indicate a team`s name!');
define('_admin_squad_no_game' , 'You have to indicate the game which the team plays!');
define('_admin_squad_add_successful' , 'The team was successfully registered!');
define('_admin_squad_edit_successful' , 'The team was successfully edited!');
define('_member_admin_edit_header' , 'Edit team');
define('_error_empty_clanname' , 'You have to indicate your clan`s name!');
define('_admin_dlkat' , 'Download categories');
define('_dl_add_new' , '<a href="?admin=dl&amp;do=new">Insert new category</a>');
define('_dl_new_head' , 'Insert new download categorie');
define('_dl_dlkat' , 'Category');
define('_dl_empty_kat' , 'You have to indicate a category description!');
define('_dl_admin_added' , 'The download category was successfully registered!');
define('_dl_admin_deleted' , 'The download category was successfully deleted!');
define('_dl_edit_head' , 'Edit download category');
define('_dl_admin_edited' , 'The download category was successfully edited!');
define('_config_global_head' , 'Configuration');
define('_config_c_limits' , 'Limits');
define('_config_c_limits_what' , 'Here you can adjust the amount of entrys which will be maximum shown');
define('_config_c_archivnews' , 'News archive');
define('_config_c_news' , 'News');
define('_config_c_banned' , 'Banlist');
define('_config_c_adminnews' , 'Newsadmin');
define('_config_c_userlist' , 'Userlist');
define('_config_c_comments' , 'Newscomments');
define('_config_c_fthreads' , 'Board threads');
define('_config_c_fposts' , 'Board posts');
define('_config_c_floods' , 'Anti-Flooding');
define('_config_c_forum' , 'Board');
define('_config_c_length' , 'Length specifications');
define('_config_c_length_what' , 'Here you can adjust the maximum length of an entry (longer entries will be cutted automatically).');
define('_config_c_newsadmin' , 'Newsadmin: Title');
define('_config_c_newsarchiv' , 'Newsarchiv: Title');
define('_config_c_forumtopic' , 'Board: Topic');
define('_config_c_forumsubtopic' , 'Board: Subtopic');
define('_config_c_topdl' , 'Menu: Top Downloads');
define('_config_c_ftopics' , 'Menu: Last Forumtopics');
define('_config_c_main' , 'General configuration');
define('_config_c_clanname' , 'Clan`s name');
define('_config_c_pagetitel' , 'Site title');
define('_config_c_language' , 'Default language');
define('_config_c_upicsize' , 'Global: Pictureupload Size');
define('_config_c_upicsize_what' , 'allowed filesize of the pictures in KB (Newspicture, Userpicture etc.)');
define('_config_c_regcode' , 'Reg: Securitycodee');
define('_config_c_regcode_what' , 'User have to enter a securitycode during the registration');
define('_pos_add_new' , '<a href="?admin=positions&amp;do=new">Insert position</a>');
define('_pos_new_head' , 'Insert position');
define('_pos_edit_head' , 'Edit position');
define('_pos_admin_edited' , 'The position was successfully edited!');
define('_pos_admin_deleted' , 'The position was successfully deleted!');
define('_pos_admin_added' , 'The position was successfully registered!');
define('_admin_nc' , 'Newscomments');
define('_admin_reg_info' , 'Here you can djust, if users have to be registered to do stuff (write comments, download things, etc)');
define('_admin_reg_head' , 'Registration required');
define('_config_zeichen_info' , 'Here you can adjust, how many chars an entry can have.');
define('_wartungsmodus_info' , 'if set to \'on\' admins only can enter the site.');
define('_navi_kat' , 'Area');
define('_navi_name' , 'Link`s name');
define('_navi_url' , 'Forwarding');
define('_navi_shown' , 'Viewable');
define('_navi_type' , 'Type');
define('_navi_wichtig' , 'Mark');
define('_navi_space' , '<b>Blank line</b>');
define('_navi_head' , 'Navigation administration');
define('_navi_add_head' , 'Insert link');
define('_navi_edit_head' , 'Edit link');
define('_navi_url_to' , 'Weiterleiten nach');
define('_posi' , 'Position');
define('_nach' , 'after');
define('_navi_no_name' , 'You have to indicate a link`s name!');
define('_navi_no_url' , 'You have to indicate a target!');
define('_navi_no_pos' , 'You have to indicate a position!');
define('_navi_added' , 'The link was successfully registered!');
define('_navi_deleted' , 'The link was successfully deleted!');
define('_navi_edited' , 'The link was successfully edited!');
define('_editor_head' , 'Insert site');
define('_editor_name' , 'Site description');
define('_editor_add_head' , 'Insert site');
define('_inhalt' , 'Content');
define('_allow', 'Allow');
define('_deny', 'Deny');
define('_editor_allow_html' , 'allow HTML/BBCODE?');
define('_editor_allow_php', 'allow PHP-Code?');
define('_empty_editor_inhalt' , 'You have to indicate a text!');
define('_site_added' , 'The site was successfully registered!');
define('_editor_linkname' , 'Linkname');
define('_editor_deleted' , 'The site was successfully deleted!');
define('_editor_edit_head' , 'Edit site');
define('_site_edited' , 'The site was successfully edited!');
define('_partners_head' , 'Partnerbuttons');
define('_partners_button' , 'Button');
define('_partners_add_head' , 'Insert partnerbutton');
define('_partners_edit_head' , 'Edit partnerbutton');
define('_partners_select_icons' , '<option value="[icon]" [sel]>[icon]</option>');
define('_partners_added' , 'The partnerbutton was successfully registered!');
define('_partners_edited' , 'The partnerbutton was successfully edited!');
define('_partners_deleted' , 'The partnerbutton was successfully deleted!');
define('_clear_head' , 'Clear database');
define('_clear_news' , 'Newsentrys?');
define('_clear_forum' , 'Boardentrys?');
define('_clear_forum_info' , 'Boardentrys which are marked as <span class="fontWichtig">important</span> won`t be deleted!');
define('_clear_days' , 'Delete entrys which are older than');
define('_clear_what' , 'days');
define('_clear_deleted' , 'The database was successfully cleared up!');
define('_clear_error_days' , 'You have to indicate the days when something is supposed to be deleted!');
define('_admin_status' , 'Livestatus');
define('_error_unregistered' , 'You have to be registered to use this function!');
define('_seiten' , 'Site:');
define('_user_admin_contact' , 'Receive contact?');
define('_user_admin_formulare' , 'Forms');
define('_head_waehrung' , 'Currency');
define('_dl_version' , 'downloadable Version');
define('_admin_artikel_add' , '<a href="?admin=artikel&amp;do=add">insert article</a>');
define('_artikel_add' , 'Insert article');
define('_artikel_added' , 'The article was successfully registered');
define('_artikel_edit' , 'Edit article');
define('_artikel_edited' , 'The article was successfully edited!');
define('_artikel_deleted' , 'The article was successfully deleted!');
define('_empty_artikel_title' , 'You have to indicate a title!');
define('_empty_artikel' , 'You have to indicate an article!');
define('_admin_artikel' , 'Admin: Article');
define('_config_c_martikel' , 'Article');
define('_config_c_madminartikel' , 'Articleadmin');
define('_reg_artikel' , 'Articlecomments');
define('_on' , 'on');
define('_off' , 'off');
define('_pers_info_info' , 'Shows an infobox in the header with personal Informations like ip, browser, solution, etc');
define('_pers_info' , 'Infobox');
define('_config_lreg' , 'Menu: Last reg. user');
define('_config_mailfrom' , 'Email mailfrom');
define('_config_mailfrom_info' , 'This email address will be used for sent emails like newsletter, registration, etc!');
define('_profile_del_confirm' , 'Caution! All user`s entrys for this field will be lost. Do you really want to delete this field?');
define('_profile_about' , 'About me');
define('_profile_clan' , 'Clan');
define('_profile_contact' , 'Contact');
define('_profile_favos' , 'Favorites');
define('_profile_hardware' , 'Hardware');
define('_profile_name' , 'Field`s name');
define('_profile_type' , 'Field`s type');
define('_profile_kat' , 'Category');
define('_profile_head' , 'Profile field administration');
define('_profile_edit_head' , 'Edit profile field');
define('_profile_shown' , 'Visible');
define('_profile_type_1' , 'Textfield');
define('_profile_type_2' , 'URL');
define('_profile_type_3' , 'Email address');
define('_profile_shown_dropdown' , '
<option value="1">Show</option>
<option value="2">Hide</option>');
define('_profile_kat_dropdown' , '
<option value="1">About me</option>
<option value="2">Clan</option>
<option value="3">Contact</option>
<option value="4">Favorites</option>
<option value="5">Hardware</option>');
define('_profile_type_dropdown' , '
<option value="1">Textfield</option>
<option value="2">URL</option>
<option value="3">Email-Adresse</option>');
define('_profile_add_head' , 'Insert profile field');
define('_profile_added' , 'The profile field was successfully registered!');
define('_profil_no_name' , 'You have to indicate the field`s name!');
define('_profil_deleted' , 'The profile field was successfully deleted!');
define('_profile_edited' , 'The profile field was successfully edited!');
## Misc ##
define('_error_have_to_be_logged' , 'You havet to be logged in to use this feature!');
define('_error_invalid_email' , 'The indicated email address is invalid!');
define('_error_invalid_url' , 'The indicated homepage isn`t reachable!');
define('_error_nick_exists' , 'The indicated nickname is already in use!');
define('_error_user_exists' , 'The indicated loginname is already in use!');
define('_error_passwords_dont_match', "Passwords don't match!");
define('_error_email_exists' , 'The indicated email address is already in use!');
define('_info_edit_profile_done_pwd' , 'Your profile was successfully edited!');
define('_error_select_buddy' , 'You didn`t selected an user!');
define('_error_buddy_self' , 'You can`t add yourself as a buddy!');
define('_error_buddy_already_in' , 'You already added this user to your buddies list!');
define('_error_msg_self' , 'You can`t write yourself a message!');
define('_error_back' , 'back');
define('_user_dont_exist' , 'The requested user does not exist!');
define('_error_fwd' , 'forward');
define('_error_wrong_permissions' , 'You don`t have the right permissions to do this!');
define('_error_flood_post' , 'You just can write a new entry every {$sek} seconds!');
define('_empty_titel' , 'You have to indicate a title!');
define('_empty_eintrag' , 'You have to indicate an entry!');
define('_empty_nick' , 'You have to indicate a nick!');
define('_empty_email' , 'You have to indicate an email address!');
define('_empty_user' , 'You have to indicate a loginname!');
define('_empty_to' , 'You have to indicate a receiver!');
define('_empty_url' , 'You have to indicate an url!');
define('_empty_datum' , 'You have to indicate a date!');
define('_index_headtitle' , '[clanname]');
define('_site_sponsor' , 'Sponsors');
define('_site_user' , 'User');
define('_site_online' , 'Visitors online');
define('_site_member' , 'Member');
define('_site_forum' , 'Board');
define('_site_links' , 'Links');
define('_site_dl' , 'Downloads');
define('_site_news' , 'News');
define('_site_messerjocke' , 'Messerjocke');
define('_site_banned' , 'Banlist');
define('_site_upload' , 'Upload');
define('_site_ulist' , 'Userlist');
define('_site_msg' , 'Messages');
define('_site_reg' , 'Registration');
define('_site_user_login' , 'Login');
define('_site_user_lostpwd' , 'Lost pwd');
define('_site_user_logout' , 'Logout');
define('_site_artikel' , 'Article');
define('_site_user_lobby' , 'Userlobby');
define('_site_user_profil' , 'Userprofile');
define('_site_user_editprofil' , 'Edit profile');
define('_site_user_buddys' , 'Buddies');
define('_site_impressum' , 'Imprint');
define('_site_votes' , 'Votes');
define('_site_config' , 'Administrative area');
define('_login' , 'Login');
define('_register' , 'Registration');
define('_userlist' , 'Userlist');
define('_news' , 'News');
define('_newsarchiv' , 'Newsarchive');
define('_links' , 'Links');
define('_impressum' , 'Imprint');
define('_contact' , 'Contact');
define('_artikel' , 'Article');
define('_dl' , 'Downloads');
define('_votes' , 'Votes');
define('_forum' , 'Board');
define('_squads' , 'Teams');
define('_editprofil' , 'Edit profile');
define('_logout' , 'Logout');
define('_msg' , 'Messages');
define('_lobby' , 'Lobby');
define('_buddys' , 'Buddies');
define('_admin_config' , 'Admin');
define('_head_online' , 'Online');
define('_head_visits' , 'Visitors');
define('_head_max' , 'Max.');
define('_cnt_user' , 'User');
define('_cnt_guests' , 'Guests');
define('_cnt_today' , 'Today');
define('_cnt_yesterday' , 'Yesterday');
define('_cnt_online' , 'Online');
define('_cnt_all' , 'Total');
define('_cnt_pperday' , '&oslash; day');
define('_cnt_perday' , 'per day');
define('_show' , 'Show');
define('_dont_show' , 'Don`t show');
define('_status' , 'Status');
define('_position' , 'Position');
define('_kind' , 'Type');
define('_cnt' , '#');
define('_pwd' , 'Password');
define('_loginname' , 'Loginname');
define('_email' , 'Email');
define('_hp' , 'Homepage');
define('_member' , 'Member');
define('_user' , 'User');
define('_gast' , 'unregistered');
define('_nothing' , '<option value="lazy" class="dropdownKat">- change nothing -</option>');
define('_pn' , 'Message');
define('_nick' , 'Nick');
define('_info' , 'Info');
define('_error' , 'Error');
define('_datum' , 'Date');
define('_legende' , 'Legend');
define('_link' , 'Link');
define('_linkname' , 'Linkname');
define('_url' , 'URL');
define('_admin' , 'Admin');
define('_hits' , 'Hits');
define('_map' , 'Map');
define('_game' , 'Game');
define('_autor' , 'Author');
define('_yes' , 'Yes');
define('_no' , 'No');
define('_maybe' , 'Maybe');
define('_beschreibung' , 'Description');
define('_admin_user_get_identy' , 'You was successfully took the identity of {$nick}!');
define('_comment_added' , 'The comment was successfully registered!');
define('_comment_deleted' , 'The comment was successfullydeleted!');
define('_stichwort' , 'Keyword');
define('_eintragen_titel' , 'insert');
define('_titel' , 'Title');
define('_answer' , 'Answer');
define('_eintrag' , 'Entry');
define('_weiter' , 'forward');
define('_site_contact' , 'Contact form');
define('_site_msg_new' , 'You have new messages!<br />Click <a href="../user/?action=msg">here</a> to go to the message center!');
define('_site_kalender' , 'Calendar');
define('_login_permanent' , ' Autologin');
define('_msg_del' , 'Delete marked');
define('_wartungsmodus' , 'This website is closed in case of maintenance work!<br />Please try it again later!');
define('_wartungsmodus_head' , 'Maintenance modes');
define('_kalender' , 'Calender');
define('_config_tmpdir' , 'Standardtemplate');
define('_navi_info' , 'Every link names shown in "_" (like _admin_) are placeholders, which will be used for the several languages!');
define('_member_admin_intnews' , 'View internal news');
define('_news_admin_intern' , 'Internal News?');
define('_news_sticky' , '<span class="fontWichtig">Announcment:</span>');
define('_news_get_sticky' , 'Announce news?');
define('_news_sticky_till' , 'until:');
define('_forum_lp_head' , 'Last post');
define('_forum_previews' , 'Preview');
define('_error_unregistered_nc' , '
<tr>
  <td class="contentMainFirst" colspan="2" align="center">
    <span class="fontBold">You have to be registered to write a comment!</span>
  </td>
</tr>');
define('_upload_partners_head' , 'Partnerbuttons');
define('_upload_partners_info' , 'Only jpg, gif or png files. Recommended dimensions: 88px * 31px');
define('_select_field_ranking_add' , '<option value="[value]" [sel]>[what]</option>');
