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

setlocale(LC_ALL, "de_DE.utf8");
$charset = 'utf-8';

## DZCP Template ##
$language_text['_color_title'] = 'Kategorie Farbe';

## Fileman ##
$language_text['_perm_fileman'] = 'Uploads verwalten';
$language_text['_fileman_uploads_'] = '## Stammverzeichnis ##';
$language_text['_fileman_group_'] = '## Gruppen ##';
$language_text['_fileman_public_'] = '## &Ouml;ffentlich ##';
$language_text['_fileman_users_'] = '## Benutzer ##';
$language_text['_fileman_error_unknown'] = 'Unbekannter Fehler';
$language_text['_fileman_error_zip_creating'] = 'Error creating zip archive.';
$language_text['_fileman_error_permissons'] = 'Du hast keine Berechtigungen um hier eine &Auml;nderung auszuf&uuml;hren!';
$language_text['_fileman_error_permissons_root'] = 'Das ROOT-Verzeichnis kann nicht ge&auml;ndert werden!';
$language_text['_fileman_error_create_dir_invalid_path'] = 'Das Verzeichnis kann nicht erstellt werden, der Pfad existiert nicht!';
$language_text['_fileman_error_create_dir_failed'] = 'Unbekannter Fehler bei erstellen des Verzeichnisses!';
$language_text['_fileman_error_create_dir_exists_failed'] = 'Das Verzeichnisses "{$dir}" existiert bereits!';
$language_text['_fileman_error_cannot_delete_root'] = 'Der Root-Ordner kann nicht gel&ouml;scht werden';
$language_text['_fileman_error_cannot_delete_dir'] = 'Fehler beim l&ouml;schen vom Verzeichnis "{$dir}"';
$language_text['_fileman_error_delete_dir_invalid_path'] = 'Verzeichnis kann nicht gel&ouml;scht werden, der Pfad existiert nicht "{$dir}"';
$language_text['_fileman_error_rename_file'] = 'Fehler bei Dateiumbenennung "{$dir}"';
$language_text['_fileman_error_rename_file_invalid_path'] = 'Datei kann nicht umbenannt werden, die Datei "{$dir}" existiert nicht';
$language_text['_fileman_error_rename_dir'] = 'Fehler bei Ordnerumbenennung "{$dir}"';
$language_text['_fileman_error_rename_dir_invalid_path'] = 'Ordner kann nicht umbenannt werden, der Ordner "{$dir}" existiert nicht';
$language_text['_fileman_error_copy_dir_invalid_path'] = 'Verzeichnis kann nicht kopiert werden, der Ordner "{$dir}" existiert nicht';
$language_text['_fileman_error_copy_dir'] = 'Fehler bei dem kopieren des Verzeichnisses "{$dir}"';
$language_text['_fileman_error_upload_extension'] = 'Gesperrter Datentyp';
$language_text['_fileman_error_upload_all'] = 'Fehler beim uploaden einiger dateien';
$language_text['_fileman_error_upload_no_files'] = 'Keine Dateien zum uploaden oder Datei zu gross.';

## DEV ##
$language_text['_config_test_menu_template'] = 'Test in Template Menu';

## Allgemein ##
$language_text['_error_no_html5_vid'] = 'Ihr Browser unterst&uuml;tzt das Video-Tag nicht.';
$language_text['_button_title_del'] = 'L&ouml;schen';
$language_text['_button_title_edit'] = 'Editieren';
$language_text['_button_title_zitat'] = 'Diesen Beitrag zitieren';
$language_text['_button_title_comment'] = 'Diesen Beitrag kommentieren';
$language_text['_button_title_menu'] = 'ins Menu eintragen';
$language_text['_button_value_add'] = 'Eintragen';
$language_text['_button_value_addto'] = 'Hinzuf&uuml;gen';
$language_text['_button_value_edit'] = 'Editieren';
$language_text['_button_value_search'] = 'Suchen';
$language_text['_button_value_search1'] = 'Suche starten';
$language_text['_button_value_vote'] = 'Abstimmen';
$language_text['_button_value_do_show'] = 'Nicht anzeigen';
$language_text['_button_value_show'] = 'Anzeigen';
$language_text['_button_value_send'] = 'Abschicken';
$language_text['_button_value_reg'] = 'Registrieren';
$language_text['_button_value_msg'] = 'Nachricht senden';
$language_text['_button_value_nletter'] = 'Newsletter abschicken';
$language_text['_button_value_config'] = 'Konfiguration abspeichern';
$language_text['_button_value_clear'] = 'Datenbank bereinigen';
$language_text['_button_value_save'] = 'Speichern';
$language_text['_button_value_upload'] = 'Hochladen';
$language_text['_editor_from'] = 'Von';
$language_text['intern'] = '<span class="fontWichtig">Intern</span>';
$language_text['_comments_head'] = 'Kommentare';
$language_text['_click_close'] = 'schlie&szlig;en';
$language_text['_lang_de'] = 'Deutsch';
$language_text['_lang_uk'] = 'Englisch';
$language_text['_template'] = 'Design';
$language_text['_perm_editby'] = 'Editby verwalten';
$language_text['_private'] = 'Privat';
$language_text['_group'] = 'Gruppe';

## Lost Password ##
$language_text['_admin_lpwd_subj'] = 'Betreff: Passwort zur&uuml;cksetzen';
$language_text['_admin_lpwd'] = 'Passwort zur&uuml;cksetzen template';

## ADDED / REDEFINED FOR 1.7.0
$language_text['_server_ip'] = 'Server-IP';
$language_text['_aktion'] = 'Aktion';
$language_text['_config_activate_user'] = 'User aktivieren';
$language_text['_profil_admin_locked'] = 'Account ist nicht aktiviert';
$language_text['_profil_locked'] = 'Der Account ist noch nicht aktiviert, <a href="?index=user&action=akl&do=send" target="_self">&lt; Aktivierungs-Mail senden &gt;</a>';
$language_text['_profil_closed'] = 'Der Account ist gesperrt';
$language_text['_admin_akl_regist_subj'] = 'Betreff: Registrierungs Aktivierungs-eMail';
$language_text['_admin_akl_regist'] = 'Registrierungs Aktivierungs-eMail Template';
$language_text['_reg_akl_invalid'] = 'Dieser Aktivierungslink ist nicht mehr g&uuml;ltig';
$language_text['_reg_akl_valid'] = 'Dein Account wurde aktiviert';
$language_text['_reg_akl_sended'] = 'Dein Aktivierungslink wurde an "{$email}" versandt, schau bitte in dein E-Mail Postfach';
$language_text['_reg_akl_email_nf'] = 'Es existiert kein Account mit dieser E-Mail Addresse';
$language_text['_reg_akl_locked'] = 'Der Account ist gesperrt und kann nicht mehr aktiviert werden';
$language_text['_reg_akl_activated'] = 'Dein Account ist bereits aktiviert';
$language_text['_info_reg_valid_akl'] = 'Du hast dich erfolgreich registriert!<br /><br />Bitte aktiviere deinen Account &uuml;ber die Aktivierungs-eMail, die wir dir an deine E-Mail Adresse gesendet haben.<br /><br />Deine Zugangsdaten wurden dir an deine E-Mail Adresse "{$email}" versandt.';
$language_text['_info_reg_valid_akl_ad'] = 'Du hast dich erfolgreich registriert!<br /><br />Deinen Account wird nach einer Pr&uuml;fung durch die Administratoren dieser Seite aktiviert.<br /><br />Deine Zugangsdaten wurden dir an deine E-Mail Adresse "{$email}" versandt.';
$language_text['_button_value_activate'] = 'Aktivieren';
$language_text['_activate_code'] = 'Aktivierungscode';
$language_text['_activate_head'] = 'Account aktivieren';
$language_text['_perm_activateusers'] = 'Account Aktivierungen verwalten';
$language_text['_admin_akl_sended'] = 'gesendet';
$language_text['_admin_akl_activated'] = 'Aktivierungen';
$language_text['_actived'] = 'User Account wurde aktiviert';
$language_text['_button_title_akl'] = 'Account aktivieren';
$language_text['_admin_akl_resend'] = 'Aktivierungslink wurde an "{$email}" versandt.';
$language_text['_akl'] = 'Aktivierungsmails';
$language_text['_akl_info'] = 'Sollen Aktivierungsmails bei Neuregistrierungen verwendet werden';
$language_text['_akl_send'] = 'Aktivierungsmail senden';
$language_text['_akl_only_admin'] = 'Nur &uuml;ber Administrator';
$language_text['_button_activate_user'] = 'User aktivieren';
$language_text['_button_del_user'] = 'User l&ouml;schen';
$language_text['_users_deleted'] = 'User gel&ouml;scht';
$language_text['_actived_all'] = 'User Accounts wurden aktiviert';
$language_text['_delete_text'] = 'L&ouml;schen';
$language_text['_config_c_cache'] = 'Cache';
$language_text['_config_c_cache_provider'] = 'Cache Provider';
$language_text['_config_c_cache_mem_host'] = 'Memcache Host';
$language_text['_config_c_cache_mem_port'] = 'Memcache Port';
$language_text['_default'] = 'Standard';
$language_text['_smtp_host'] = 'SMTP Host';
$language_text['_smtp_port'] = 'SMTP Port';
$language_text['_smtp_username'] = 'SMTP Username';
$language_text['_smtp_passwort'] = 'SMTP Passwort';
$language_text['_smtp_tls_ssl'] = 'Verschl&uuml;sselung';
$language_text['_smtp_sendmail_path'] = 'Sendmail Path';
$language_text['_admin_eml_config_head'] = 'E-Mail Einstellungen';
$language_text['_admin_eml_config_ext'] = 'Mail-Erweiterung';
$language_text['_feeds'] = 'News Feeds *rss';
$language_text['_feeds_info'] = 'Schaltet das automatische generieren von RSS Feeds an oder aus';
$language_text['_pwd_encoder_algorithm'] = 'Algorithmus';
$language_text['_pwd_encoder'] = 'Passwort-Hash Algorithmus';
$language_text['_pwd_encoder_info'] = 'Welcher Passwort-Hash Algorithmus soll verwendet werden, Standard ist *SHA256';
$language_text['_iban'] = 'IBAN';
$language_text['_bic'] = 'BIC';
$language_text['_login_head_admin'] = 'Administrator Login';
$language_text['_no_entrys'] = 'Keine Eintr&auml;ge';
$language_text['_profil_edit_almgr_link'] = '<a href="?action=editprofile&amp;show=almgr">Autologin editieren</a>';
$language_text['_almgrhead'] = 'Autologin verwalten';
$language_text['_almgr_host'] = 'Host';
$language_text['_almgr_ip'] = 'IP-Adresse';
$language_text['_almgr_create'] = 'Angelegt';
$language_text['_almgr_lused'] = 'Verwendet';
$language_text['_almgr_expires'] = 'G&uuml;ltig bis';
$language_text['_almgr_name'] = 'Ger&auml;tename';
$language_text['_almgr_edit_head'] = 'Autologin bearbeiten';
$language_text['_almgr_ssid'] = 'Session-ID';
$language_text['_almgr_pkey'] = 'Permanent-Key';
$language_text['_almgr_editd'] = 'Autologin erfolgreich bearbeitet';
$language_text['_almgr_add'] = '<a href="?action=editprofile&amp;show=almgr&amp;do=self_add">Dieses Ger&auml;t hinzuf&uuml;gen</a>';
$language_text['_almgr_remove'] = '<a href="?action=editprofile&amp;show=almgr&amp;do=self_remove">Dieses Ger&auml;t entfernen</a>';
$language_text['_info_almgr_deletet'] = 'Automatische Anmeldung wurde erfolgreich entfernt';
$language_text['_info_almgr_self_deletet'] = 'Dieses Ger&auml;t wurde erfolgreich entfernt';
$language_text['_info_almgr_self_added'] = 'Dieses Ger&auml;t wurde erfolgreich eingetragen';
$language_text['_profile_access_error'] = 'Dieses Profil ist nur Mitgliedern zug&auml;nglich';
$language_text['_pedit_visibility_profile'] = 'Eigenes Profil';
$language_text['_paginator_previous'] = 'Zur&uuml;ck';
$language_text['_paginator_next'] = 'Weiter';
$language_text['_admin_bezeichnung'] = 'Bezeichnung';
$language_text['_custom_game_icon'] = 'Custom-Icon';
$language_text['_custom_game_icon_none'] = 'Kein Custom-Icon verwenden';
$language_text['_addons'] = 'Erweiterungen';
$language_text['_capcha_sound_info'] = 'Klicke um das Audio-CAPTCHA abspielen';
$language_text['_notification_error'] = 'Fehler';
$language_text['_notification_success'] = 'Erfolg';
$language_text['_notification_notice'] = 'Hinweis';
$language_text['_notification_warning'] = 'Achtung';
$language_text['_notification_custom'] = 'Benutzerdefiniert';
$language_text['_color'] = 'Farbe';
$language_text['_description'] = 'Bezeichnung';
$language_text['_replies'] = 'Antworten';
$language_text['_no_entrys_found'] = '<tr>
  <td class="contentMainFirst" colspan="{$colspan}" align="center">Keine Eintr&auml;ge gefunden</td>
</tr>';
$language_text['_admin_news_readed'] = 'Gelesen';
$language_text['_admin_news_refresh'] = 'Aktualisieren';

//Forum
$language_text['_forum_stats_top5'] = 'Statistik und Top 5 Posters';
$language_text['_forum_who_is_online'] = 'Wer ist online?';
$language_text['_forum_last_post'] = 'Neuesten Beitrag anzeigen';
$language_text['_forum_online_info0'] = 'Es {if $total_users == 1}{lang msgID="forum_ist"}{else}{lang msgID="forum_sind"}{/if}<b> {$users}</b> Besucher online: <b>{$regs} </b>{if $counter_users == 1}{lang msgID="forum_reg"}{else}{lang msgID="forum_regs"}{/if} und <b>{$gast} </b>{if $total_users == 1}{lang msgID="forum_gast"}{else}{lang msgID="forum_gaste"}{/if} (Basierend auf den Besuchern der letzten {$timer} Minuten)';
$language_text['_forum_online_info1'] = 'Registrierte User';
$language_text['_forum_gast'] = 'Gast';
$language_text['_forum_gaste'] = 'G&auml;ste';
$language_text['_forum_regs'] = 'Mitglieder';
$language_text['_forum_reg'] = 'Mitglied';
$language_text['_forum_ist'] = 'ist';
$language_text['_forum_sind'] = 'sind';
$language_text['_forum_total_posts'] = 'Beitr&auml;ge';
$language_text['_forum_total_topics'] = 'Themen';
$language_text['_forum_total_members'] = 'Mitglieder';
$language_text['_forum_newest_member'] = 'neuestes Mitglied';
$language_text['_forum_new_thread'] = 'Neues Thema';
$language_text['_forum_sort_bcc'] = 'Betreff';
$language_text['_forum_sort_time'] = 'Erstellungsdatum';
$language_text['_forum_sort_by'] = 'Sortiere nach';
$language_text['_forum_sort_descending'] = 'Absteigend';
$language_text['_forum_sort_ascending'] = 'Aufsteigend';
$language_text['_forum_go'] = 'Los';
$language_text['_forum_from'] = 'Von';
$language_text['_forum_admin_editby'] = 'der Nachricht "<span class="fontWichtig">zuletzt editiert</span>" anh&auml;ngen?';
$language_text['_forum_thread_lpost'] = 'von {$nick}<br />am {$date}{lang msgID="uhr"}';
$language_text['_forum_search_word'] = 'Forensuche nach...';

//Startpage
$language_text['_profil_startpage'] = 'Startseite';
$language_text['_config_startpage'] = 'Startseiten';
$language_text['_perm_startpage'] = 'Startseiten verwalten';
$language_text['_admin_startpage'] = 'Startseiten';
$language_text['_admin_startpage_url'] = 'Ziel URL';
$language_text['_admin_startpage_level'] = 'Sichtbar ab Level';
$language_text['_admin_startpage_name'] = 'Name';
$language_text['_admin_startpage_add_head'] = 'Neue Startseite anlegen';
$language_text['_admin_startpage_edit'] = 'Startseite bearbeiten';
$language_text['_admin_startpage_added'] = 'Startseite wurde erfogreich eingetragen';
$language_text['_admin_startpage_deleted'] = 'Startseite wurde erfogreich gel&ouml;scht';
$language_text['_admin_startpage_editd'] = 'Startseite wurde erfogreich bearbeitet';
$language_text['_admin_startpage_no_name'] = 'Du hast keinen Namen eingegeben';
$language_text['_admin_startpage_no_url'] = 'Du hast keine URL eingegeben';
$language_text['_admin_startpage_add'] = 'Neue Startseite hinzuf&uuml;gen';

//IP Blocker
$language_text['_ipban_admin_head'] = 'IP Blocker';
$language_text['_config_ipban'] = 'IP Blocker';
$language_text['_confirm_del_ipban'] = 'Eintrag l&ouml;schen';
$language_text['_confirm_enable_ipban'] = 'Soll die IP-Sperrung f&uuml;r {$ip} wieder aktiviert werden';
$language_text['_confirm_disable_ipban'] = 'Soll die Sperrung der IP: {$ip} deaktiviert werden';
$language_text['_ipban_admin_deleted'] = 'Der IP Ban wurde erfolgreich gel&ouml;scht!';
$language_text['_ipban_new_head'] = 'Neuen IP Ban hinzuf&uuml;gen';
$language_text['_ipban_admin_added'] = 'Der neue IP Bann wurde erfolgreich hinzugef&uuml;gt!';
$language_text['_ipban_edit_head'] = 'IP Ban bearbeiten';
$language_text['_ipban_admin_edited'] = 'IP Ban wurde erfolgreich bearbeitet!';
$language_text['_ipban_dis'] = 'Grund / Beschreibung';
$language_text['_ipban_add_new'] = 'Neuer Eintrag';
$language_text['_ipban_assuredness'] = 'Zuverl&auml;ssigkeit';
$language_text['_ipban_reports'] = 'Reports';
$language_text['_ipban_lastten_global'] = 'Letzten 10 gebanten IPs by Stopforumspam.com';
$language_text['_ipban_lastten_user'] = 'Letzten 10 gebanten IPs by User';
$language_text['_ipban_search'] = 'IP Suche';
$language_text['_ipban_error_pip'] = 'Du kannst keine privaten IP-Adressen sperren!';
$language_text['_ipban_disable'] = 'IP-Ban deaktivieren';
$language_text['_ipban_enable'] = 'IP-Ban aktivieren';
$language_text['_ip_empty'] = 'Keine IP eingegeben!';
$language_text['_total_bans'] = 'Total Bans';
$language_text['_ipban_head_admin'] = 'IP-Bans';
$language_text['_perm_ipban'] = 'IP-Bans verwalten';

## ADDED / REDEFINED FOR 1.6.0 Final
$language_text['_txt_navi_main'] = 'Главная';
$language_text['_txt_navi_clan'] = 'Kлан';
$language_text['_txt_navi_misc'] = 'Остальные';
$language_text['_txt_userarea'] = 'Область пользователя';
$language_text['_txt_vote'] = 'Опросы';
$language_text['_txt_partners'] = 'Партнеры';
$language_text['_txt_sponsors'] = 'Спонсоры';
$language_text['_txt_counter'] = 'Cтатистика';
$language_text['_txt_l_news'] = 'Hовости';
$language_text['_txt_ftopics'] = 'Сообщения форума';
$language_text['_txt_teams'] = 'Команды';
$language_text['_txt_template_switch'] = 'Изменить шаблон';
$language_text['_txt_events'] = 'События';
$language_text['_txt_kalender'] = 'Календарь';
$language_text['_txt_l_artikel'] = 'Статья';
$language_text['_txt_l_reg'] = 'Новый пользователь';
$language_text['_txt_motm'] = 'Случайный участник клана';
$language_text['_txt_top_dl'] = 'Топ закачек';
$language_text['_txt_uotm'] = 'Случайный пользователь';

$language_text['_forum_kat'] = 'Kатегория';

$language_text['_artikel_userimage'] = 'Собственные Изображение';
$language_text['_artikelpic_del'] = 'Удалить изображение?';
$language_text['_artikelpic_deleted'] = 'Изображение удаленo';

$language_text['_news_userimage'] = 'Собственные Изображение';
$language_text['_newspic_del'] = 'Удалить образ новостей?';
$language_text['_newspic_deleted'] = 'образ новостей удален';
$language_text['_max'] = 'Макс.';

$language_text['_perm_dlintern'] = 'Показать внутренние загрузки';

$language_text['_config_url_linked_head'] = 'URLs связать';

$language_text['_upload_error'] = 'Не удалось загрузить файл!';
$language_text['_login_banned'] = 'Ваш аккаунт заблокирован администратором!';
$language_text['_lobby_no_mymessages'] = '<a href="../user/?action=msg">У вас нет новых сообщений!</a>';

$language_text['_perm_protocol'] = 'См протокол администратора';
$language_text['_perm_support'] = 'Смотрите страницу поддержки';
$language_text['_perm_clear'] = 'Очистить базу данных';
$language_text['_perm_forumkats'] = 'Конфиг. категории Форумыa';
$language_text['_perm_impressum'] = 'Конфиг. контактами';
$language_text['_perm_config'] = 'Конфиг. страницы';
$language_text['_perm_positions'] = 'Конфиг. рангами пользователей';
$language_text['_perm_partners'] = 'Конфиг. партнеров';
$language_text['_perm_profile'] = 'Конфиг. поля в профилe';

## ADDED / REDEFINED FOR 1.5 Final
$language_text['_id_dont_exist'] = 'Который вы указали ID не существует!';

## ADDED / REDEFINED FOR 1.5.2
$language_text['_button_title_del_account'] = 'удалить аккаунт?';
$language_text['_confirm_del_account'] = 'вы действительно хотите удалить свой аккаунт ?';
$language_text['_profil_del_account'] = 'удалить аккаунт?';
$language_text['_profil_del_admin'] = '<b>удаление не возможно!</b>';
$language_text['_info_account_deletet'] = 'Dein Account wurde erfolgreich gel&ouml;scht';
$language_text['_news_get_timeshift'] = 'Zeitversetzte News?';
$language_text['_news_timeshift_from'] = 'News Anzeigen ab:';
$language_text['_placeholder'] = 'Template Platzhalter';
$language_text['_menu_kats_head'] = 'Menu Kategorien';
$language_text['_menu_add_kat'] = 'Neue Menu Kategorie hinzuf&uuml;gen';
$language_text['_confirm_del_menu'] = 'Soll die Kategorie wirklich gel&ouml;scht werden?';
$language_text['_menu_edit_kat'] = 'Menu Kategorie editieren';
$language_text['_menukat_updated'] = 'Die Menu Kategorie wurde erfolgreich editiert!';
$language_text['_menukat_inserted'] = 'Die Menu Kategorie wurde erfolgreich hinzugef&uuml;gt!';
$language_text['_menukat_deleted'] = 'Die Menu Kategorie wurde erfolgreich gel&ouml;scht!';
$language_text['_menu_visible'] = 'sichtbar f&uuml;r Status';
$language_text['_menu_kat_info'] = 'Die CSS-Klassen f&uuml;r die Links werden automatisch vom Template Platzhalter abgeleitet.<br />z.B. f&uuml;r den Platzhalter <i>{$nav_main}</i> lautet die CSS-Klasse <i>a.navMain</i>';
$language_text['_admin_sqauds_roster'] = 'Team-Roster';
$language_text['_admin_squads_nav_info'] = 'Hiermit wird ein Direktlink in die Navigation gesetzt, welcher zur Vollansicht des Teams f&uuml;hrt.';
$language_text['_admin_squads_teams'] = 'Team-Show';
$language_text['_admin_squads_no_navi'] = 'Nicht einf&uuml;gen';
$language_text['_config_direct_refresh'] = 'Direkte Weiterleitung';
$language_text['_config_direct_refresh_info'] = 'Wenn aktiviert, wird nach einer Aktion (z.B. Eintr&auml;ge in Forum, News, etc) direkt weitergeleitet, anstatt eine Infonachricht auszugeben.';
$language_text['_eintrag_titel_forum'] = '<a href="{$url}" title="Diesen Beitrag anzeigen"><span class="fontBold">#{$postid}</span></a> am {$datum} um {$zeit}{lang msgID="uhr"} {$edit} {$delete}';
$language_text['_eintrag_titel'] = '<span class="fontBold">#{$postid}</span> am {$datum} um {$zeit}{lang msgID="uhr"} {$edit} {$delete}';

## ADDED / REDEFINED FOR 1.5.1
$language_text['_config_double_post'] = 'Forum Doppelpost';
$language_text['_config_fotum_vote'] = 'Forum-Vote';
$language_text['_config_fotum_vote_info'] = '<div style="text-align: center;">Zeigt die Forum-Votes auch unter Umfragen an.</div>';

## ADDED / REDEFINED FOR 1.5
$language_text['_search_sites'] = 'Unterseiten';
$language_text['_search_results'] = 'Suchergebnisse';
$language_text['_config_useradd_head'] = 'User anlegen';
$language_text['_config_adduser'] = 'User hinzuf&uuml;gen';
$language_text['_uderadd_info'] = 'Der User wurde erfolgreich hinzugef&uuml;gt';
$language_text['_useradd_head'] = 'Neuen User anlegen';
$language_text['_useradd_about'] = 'Userdetails';
$language_text['_login_lostpwd'] = 'Passwort vergessen';
$language_text['_login_signup'] = 'Registrieren';
$language_text['_config_links'] = 'Links';
$language_text['_vote_menu_no_vote'] = 'keine Umfrage eingetragen';
$language_text['_team_logo'] = 'Team Logo';
$language_text['_sq_banner'] = 'Teambanner';
$language_text['_forum_abo_title'] = 'Thema abbonieren';
$language_text['_forum_vote'] = 'Umfrage';
$language_text['_admin_user_clanhead_info'] = 'Die Rechte hier k&ouml;nnen <u>zus&auml;tzlich</u> zu den Rechten der User-R&auml;nge vergeben werden.';
$language_text['_config_positions_boardrights'] = 'interne Forenrechte';
$language_text['_perm_editkalender'] = 'Kalendereintr&auml;ge  verwalten';
$language_text['_perm_forum'] = 'Foren Admin';
$language_text['_perm_links'] = 'Links verwalten';
$language_text['_perm_newsletter'] = 'Newsletter verschicken';
$language_text['_perm_votesadmin'] = 'Umfragen verwalten';
$language_text['_perm_artikel'] = 'Artikel verwalten';
$language_text['_perm_downloads'] = 'Downloads verwalten';
$language_text['_perm_editor'] = 'Seitenverwaltung';
$language_text['_perm_editsquads'] = 'Teams verwalten';
$language_text['_perm_editusers'] = 'darf User editieren';
$language_text['_perm_intnews'] = 'interne News lesen';
$language_text['_perm_news'] = 'Newsverwaltung';
$language_text['_perm_votes'] = 'interne Umfragen einsehen';
$language_text['_config_positions_rights'] = 'Rechte';
$language_text['_admin_pos'] = 'User R&auml;nge';
$language_text['_config_sponsors'] = 'Sponsoren';
$language_text['_sponsors_admin_head'] = 'Sponsoren';
$language_text['_sponsors_admin_add'] = 'Sponsor hinzuf&uuml;gen';
$language_text['_sponsor_added'] = 'Sponsor erfolgreich hinzugef&uuml;gt!';
$language_text['_sponsor_edited'] = 'Sponsor erfolgreich editiert!';
$language_text['_sponsor_deleted'] = 'Sponsor erfolgreich gel&ouml;scht!';
$language_text['_sponsor_name'] = 'Sponsor';
$language_text['_sponsors_admin_name'] = 'Name';
$language_text['_sponsors_admin_site'] = 'Sponsorenseite';
$language_text['_sponsors_admin_addsite'] = 'Auf Sponsorenseite';
$language_text['_sponsors_admin_add_site'] = 'Der Banner wird auf der Sponsorenseite angezeigt';
$language_text['_sponsors_admin_upload'] = 'Bild-Upload';
$language_text['_sponsors_admin_url'] = 'Oder: Bild-URL';
$language_text['_sponsors_admin_banner'] = 'Rotation Banner';
$language_text['_sponsors_admin_addbanner'] = 'In Rotations-Banner';
$language_text['_sponsors_admin_add_banner'] = 'Der Banner wird oben in den Rotations-Banner aufgenommen';
$language_text['_sponsors_admin_box'] = 'Sponsoren-Box';
$language_text['_sponsors_admin_addbox'] = 'In Sponsoren-Box';
$language_text['_sponsors_admin_add_box'] = 'Der Banner wird in der Sponsoren-Box angezeigt';
$language_text['_sponsors_empty_name'] = 'Bitte den Namen des Sponsors angeben!';
$language_text['_sponsors_empty_beschreibung'] = 'Du musst eine Beschreibung angeben!';
$language_text['_sponsors_empty_link'] = 'Du musst eine Linkadresse angeben!';
$language_text['_public'] = 'ver&ouml;ffentlichen';
$language_text['_non_public'] = 'nicht ver&ouml;ffentlichen';
$language_text['_no_public'] = '<b>unver&ouml;ffentlicht</b>';
$language_text['_no_events'] = 'keine Events geplant';
$language_text['_config_c_events'] = 'Men&uuml;: Events';
$language_text['_msg_all_leader'] = 'alle Leader & Co-Leader';
$language_text['_msg_leader'] = 'Squad-Leader';
$language_text['_pos_nletter'] = 'Diese Position in Newsletter an Squadleader und Co-Leader mit einbeziehen';
$language_text['_pwd2'] = 'Passwort wiederhohlen';
$language_text['_wrong_pwd'] = 'Die eingegebenen Passw&ouml;rter stimmen nicht &uuml;berein';
$language_text['_info_reg_valid_pwd'] = 'Du hast dich erfolgreich registriert und kannst dich nun mit deinen Zugangsdaten einloggen!<br /><br />Deine Zugangsdaten wurden dir zur Sicherheit noch an die Emailadresse {$email} gesendet.';
$language_text['_profil_pnmail'] = 'Email bei neuen Nachrichten';
$language_text['_admin_pn_subj'] = 'Betreff: PN-Email';
$language_text['_admin_pn'] = 'PN-Email Template';
$language_text['_admin_fabo_npost_subj'] = 'Betreff: ForenAbo Neuer Post';
$language_text['_admin_fabo_pedit_subj'] = 'Betreff: ForenAbo Post editiert';
$language_text['_admin_fabo_tedit_subj'] = 'Betreff: ForenAbo Thema editiert';
$language_text['_admin_fabo_npost'] = 'ForenAbo Neuer Post Template';
$language_text['_admin_fabo_pedit'] = 'ForenAbo Post editiert Template';
$language_text['_admin_fabo_tedit'] = 'ForenAbo Thema editiert Template';
$language_text['_foum_fabo_checkbox'] = 'Dieses Thema abonnieren und per E-Mail &uuml;ber neue Posts benachrichtigt werden?';
$language_text['_forum_fabo_do'] = 'E-Mail Benachrichtigung erfolgreich ge&auml;ndert!';
$language_text['_forum_vote_del'] = 'Umfrage l&ouml;schen';
$language_text['_forum_vote_preview'] = 'Hier erscheint dann die Umfrage';
$language_text['_forum_spam_text'] = '{$ltext}<p>&nbsp;</p><p>&nbsp;</p><span class="fontBold">Nachtrag von </span>{$autor}:<p>&nbsp;</p>{$ntext}';
####################################################################################
$language_text['_config_config'] = 'Allgemeine Einstellungen';
$language_text['_config_dladmin'] = 'Downloads';
$language_text['_config_editor'] = 'Seitenverwaltung';
$language_text['_config_dlkats'] = 'Downloadkategorien';
$language_text['_config_nletter'] = 'Newsletter';
$language_text['_config_protocol'] = 'Adminprotokoll';
$language_text['_partnerbuttons_textlink'] = 'Textlink';
$language_text['_config_forum_subkats_add'] = '
    <form action="" method="get" onsubmit="DZCP.submitButton()">
      <input type="hidden" name="admin" value="forum" />
      <input type="hidden" name="do" value="newskat" />
      <input type="hidden" name="id" value="{$id}" />
      <input id="contentSubmit" type="submit" class="submit" value="Neue Unterkategorie hinzuf&uuml;gen" />
    </form>
';
$language_text['_msg_answer'] = 'Antworten';
$language_text['_user_new_erase'] = '<form method="post" action="?action=userlobby"><input type="hidden" name="erase" value="1" /><input id="contentSubmit" type="submit" name="submit" class="submit" value="tempor&auml;re Neuerungen l&ouml;schen" /></form>';
$language_text['_admin_reg_info'] = 'Hier kannst du einstellen, ob sich jemand f&uuml;r einen der Bereiche registrieren muss um dort etwas tun zu k&ouml;nnen (Beitr&auml;ge schreiben, einen Download herunterladen, etc)';
$language_text['_config_c_floods_what'] = 'Hier kannst du die Zeit in Sekunden einstellen die ein User warten muss, bis er im jeweiligen Bereich was neues posten darf';

## ADDED FOR 1.4.3
$language_text['_download_last_date'] = 'Zuletzt heruntergeladen';

## EDITED FOR 1.4.1
$language_text['_ulist_normal'] = 'Rang &amp; Level';

## ADDED FOR 1.4.1
$language_text['_lobby_mymessages'] = '<a href="../user/?action=msg">Du hast <span class="fontWichtig">{$cnt}</span> neue Nachrichten!</a>';
$language_text['_lobby_mymessage'] = '<a href="../user/?action=msg">Du hast <span class="fontWichtig">{$cnt}</span> neue Nachricht!</a>';

## EDIT/ADDED FOR 1.4
//Added
$language_text['_contact_pflichtfeld'] = '<span class="fontWichtig">*</span> = Pflichtfelder';
$language_text['_protocol_action'] = 'Aktion';
$language_text['_protocol'] = 'Adminprotokoll';
$language_text['_button_title_del_protocol'] = 'Komplettes Protokoll l&ouml;schen!';
$language_text['_protocol_deleted'] = 'Das komplette Protokoll wurde erfolgreich gel&ouml;scht!';
$language_text['_vote_no_answer'] = 'Du musst eine Antwort ausw&auml;hlen!';
$language_text['_linkus_admin_edit'] = 'LinkUs editieren';
$language_text['_config_linkus'] = 'LinkUs';
$language_text['_urls_linked_info'] = 'Textlinks werden automatisch in anklickbare Links konvertiert';
$language_text['_sponsoren'] = 'Sponsoren';
$language_text['_downloads'] = 'Downloads';
$language_text['_nachrichten'] = 'Nachrichten';
$language_text['_edit_profile'] = 'Profil editieren';
$language_text['_config_c_lartikel'] = 'Men&uuml;: Last Artikel';
$language_text['_config_hover'] = 'Mouseover Informationen';
$language_text['_config_seclogin'] = 'Login Sicherheitsabfrage';
$language_text['_config_hover_standard'] = 'Standard Informationen einblenden';
$language_text['_config_hover_all'] = 'Alle Informationen einblenden';
$language_text['_error_vote_show'] = 'Dies ist eine &ouml;ffentliche Umfrage und kann somit nicht eingesehen werden!';
$language_text['_login_pwd_dont_match'] = 'Benutzername und/oder Passwort sind ung&uuml;ltig oder der Account wurde gesperrt!';
$language_text['_sq_aktiv'] = 'Aktiv';
$language_text['_sq_inaktiv'] = 'Inaktiv';
$language_text['_internal'] = 'Intern';
$language_text['_sticky'] = 'Wichtig';
$language_text['_misc'] = 'Sonstige';
$language_text['_all'] = 'Alle';
$language_text['_admin_support_head'] = 'Support Informationen';
$language_text['_admin_support_info'] = 'Nachfolgende Informationen bitte bei einer Supportanfrage z.B.im Forum von <a href="http://www.dzcp.de" target="_blank">www.dzcp.de</a> mit angeben, um schneller zu einer L&ouml;sung des Problemes zu kommen!';
$language_text['_config_support'] = 'Supportinfos';
$language_text['_search_con_or'] = 'ODER-Verkn&uuml;pfung';
$language_text['_search_con_and'] = 'UND-Verkn&uuml;pfung';
$language_text['_search_head'] = 'Suchfunktion';
$language_text['_search_word'] = 'Suchen nach...';
$language_text['_search_forum_all'] = 'In allen Foren suchen';
$language_text['_search_forum_hint'] = '(Durch dr&uuml;cken der \'Strg-Taste\' lassen<br />sich mehrere einzelne Foren ausw&auml;hlen)';
$language_text['_search_for_area'] = 'Suchbereich';
$language_text['_search_type_full'] = 'vollst&auml;ndige Suche';
$language_text['_search_type_title'] = 'nur Topic durchsuchen';
$language_text['_search_type'] = 'Suchtyp';
$language_text['_search_type_autor'] = 'Autoren finden';
$language_text['_search_type_text'] = 'Text und Topic durchsuchen';
$language_text['_search_in'] = 'Suchen in...';
$language_text['_user_profile_of'] = 'Userprofil von ';
$language_text['_sites_not_available'] = 'Die angeforderte Seite existiert nicht!';
$language_text['_wrote'] = 'schrieb';
$language_text['_voted_head'] = 'Bereits an der Umfrage teilgenommen';
$language_text['_show_who_voted'] = 'Zeige User, die bereits abgestimmt haben';
$language_text['_no_live_status'] = 'Keine Liveabfrage';
$language_text['_comment_edited'] = 'Der Kommentar wurde erfolgreich editiert!';
$language_text['_comments_edit'] = 'Kommentar editieren';
$language_text['_forum_post_where_preview'] = '<a href="javascript:void(0)">{$mainkat}</a> <span class="fontBold">Forum:</span> <a href="javascript:void(0)">{$wherekat}</a> <span class="fontBold">Thema:</span> <a href="javascript:void(0)">{$wherepost}</a>';
$language_text['_aktiv_icon'] = '<img src="../inc/images/active.gif" alt="" class="icon" />';
$language_text['_inaktiv_icon'] = '<img src="../inc/images/inactive.gif" alt="" class="icon" />';
$language_text['_pn_write_forum'] = '<a href="../user/?action=msg&amp;do=pn&amp;id={$id}"><img src="{idir}/forum_pn.gif" alt="" title="{$nick} eine Nachricht schreiben" class="icon" /></a>';
$language_text['_uhr'] = '&nbsp;Uhr';
$language_text['_kalender_admin_head'] = 'Kalender - Ereignisse';
$language_text['_preview'] = 'Vorschau';
$language_text['_error_edit_post'] = 'Du bist nicht dazu berechtigt diesen Eintrag zu editieren!';
$language_text['_nletter_prev_head'] = 'Newslettervorschau';
$language_text['_error_downloads_upload'] = 'Es gab einen Problem beim Upload (Datei zu gro&szlig;?)';
$language_text['_news_comments_prev'] = '<a href="javascript:void(0)">0 Kommentare</a>';
$language_text['_only_for_admins'] = ' (IP ist nur f&uuml;r Admins sichtbar)';
$language_text['_content'] = 'Inhalte';
$language_text['_rootadmin'] = 'Seitenadmin';
$language_text['_nletter'] = 'Newsletter';
$language_text['_subject'] = 'Betreff';
$language_text['_nletter_head'] = 'Newsletter verfassen';
$language_text['_squad'] = 'Team';
$language_text['_confirm_del_vote'] = 'Soll diese Umfrage wirklich gel&ouml;scht werden?';
$language_text['_confirm_del_dl'] = 'Soll dieser Download wirklich gel&ouml;scht werden?';
$language_text['_confirm_del_galpic'] = 'Soll dieses Bild wirklich gel&ouml;scht werden?';
$language_text['_confirm_del_entry'] = 'Soll dieser Eintrag wirklich gel&ouml;scht werden?';
$language_text['_confirm_del_navi'] = 'Soll dieser Link wirklich gel&ouml;scht werden?';
$language_text['_confirm_del_profil'] = 'Soll dieses Profilfeld wirklich gel&ouml;scht werden? \n Alle Usereingaben f&uuml;r dieses Feld gehen dabei verloren!';
$language_text['_confirm_del_smiley'] = 'Soll dieser Smiley wirklich gel&ouml;scht werden?';
$language_text['_confirm_del_kat'] = 'Soll diese Kategorie wirklich gel&ouml;scht werden?';
$language_text['_confirm_del_news'] = 'Soll diese News wirklich gel&ouml;scht werden?';
$language_text['_confirm_del_site'] = 'Soll diese Seite wirklich gel&ouml;scht werden?';
$language_text['_confirm_del_artikel'] = 'Soll dieser Artikel wirklich gel&ouml;scht werden?';
$language_text['_confirm_del_team'] = 'Soll diese Gruppe wirklich gel&ouml;scht werden?';
$language_text['_confirm_del_ranking'] = 'Soll dieses Ranking wirklich gel&ouml;scht werden?';
$language_text['_confirm_del_link'] = 'Soll dieser Link wirklich gel&ouml;scht werden?';
$language_text['_confirm_del_sponsor'] = 'Soll dieser Sponsor wirklich gel&ouml;scht werden?';
$language_text['_confirm_del_kalender'] = 'Soll dieses Ereignis wirklich gel&ouml;scht werden?';
$language_text['_link_type'] = 'Linktyp';
$language_text['_sponsor'] = 'Sponsor';
//-----------------------------------------------
$language_text['_main_info'] = 'Hier kannst du allgemein Dinge einstellen wie den Seitentitel, das Standardtemplate, die Standardsprache, etc...';
$language_text['_admin_eml_head'] = 'E-Mail Vorlagen';
$language_text['_admin_eml_info'] = 'Hier kannst du die Emailtemplates aus verschiedenen Bereichen editieren. Achte darauf, das du die Platzhalter in den Klammern nicht l&ouml;schst!';
$language_text['_admin_reg_subj'] = 'Betreff: Registrierung';
$language_text['_admin_pwd_subj'] = 'Betreff: Passwort vergessen';
$language_text['_admin_nletter_subj'] = 'Betreff: Newsletter';
$language_text['_admin_reg'] = 'Registrierungstemplate';
$language_text['_admin_pwd'] = 'Passwort vergessen-Template';
$language_text['_admin_nletter'] = 'Newslettertemplate';
$language_text['_result'] = 'Endstand';
$language_text['_opponent'] = 'Gegner';
$language_text['_played_at'] = 'Gespielt am';
$language_text['_error_empty_nachricht'] = 'Du musst eine Nachricht angeben!';
$language_text['_links_empty_text'] = 'Du musst eine Banneradresse angeben!';
$language_text['_login_secure_help'] = 'Gib den zweistelligen Zahlencode in das Feld ein um dich zu verifizieren!';
$language_text['_online_head_guests'] = 'G&auml;ste online';
$language_text['_admin_first'] = 'als erstes';
$language_text['_admin_squads_nav'] = 'Navigation';
$language_text['_admin_squad_show_info'] = '<div style="text-align: center;">Definiert, ob ein Team in der Team&uuml;bersicht standardm&auml;&szlig;ig ein- oder aufgeklappt ist</div>';
//Edited
$language_text['_dl_getfile'] = '{$file} jetzt herunterladen';
$language_text['_partners_link_add'] = 'Partnerbutton hinzuf&uuml;gen';
$language_text['_config_forum_kats_add'] = 'Neue Kategorie hinzuf&uuml;gen';
$language_text['_config_c_lnews'] = 'Men&uuml;: Last News';
$language_text['_msg_new'] = 'Neue Nachricht schreiben';
$language_text['_config_artikel'] = 'Artikel';
$language_text['_config_forum'] = 'Forenkategorien';
$language_text['_config_gruppen'] = 'Gruppen';
$language_text['_config_news'] = 'News-/Artikelkategorien';
$language_text['_config_positions'] = 'Rangbezeichnungen';
$language_text['_config_allgemein'] = 'Konfiguration';
$language_text['_config_impressum'] = 'Impressum';
$language_text['_config_downloads'] = 'Downloadkategorien';
$language_text['_config_newsadmin'] = 'News';
$language_text['_config_filebrowser'] = 'Dateieditor';
$language_text['_config_navi'] = 'Navigation';
$language_text['_config_online'] = 'Seitenverwaltung';
$language_text['_config_partners'] = 'Partnerbuttons';
$language_text['_config_clear'] = 'Datenbank&nbsp;aufr&auml;umen';
$language_text['_config_profile'] = 'Profilfelder';
$language_text['_config_votes'] = 'Umfragen';
$language_text['_config_kalender'] = 'Kalender';
$language_text['_config_einst'] = 'Einstellungen';
$language_text['_profil_sig'] = 'Foren Signatur';
$language_text['_akt_version'] = 'DZCP Version';
$language_text['_forum_searchlink'] = '- <a href="../search/">Forensuche</a> -';
$language_text['_msg_deleted'] = 'Die Nachricht wurde erfolgreich gel&ouml;scht!';
$language_text['_info_reg_valid'] = 'Du hast dich erfolgreich registriert!<br />Dein Passwort wurde dir an die Emailadresse {$email} gesendet.';
$language_text['_edited_by'] = '<br /><br /><i>zuletzt editiert von {$autor} am {$time} &nbsp;Uhr</i>';
$language_text['_linkus_empty_text'] = 'Du musst eine Banner-URL angeben!';
$language_text['_empty_news_title'] = 'Du musst einen Newstitel angeben!';
$language_text['_member_admin_votes'] = 'Interne Umfragen sehen';
$language_text['_member_admin_votesadmin'] = 'Admin: Umfragen';
$language_text['_msg_global_all'] = 'alle Mitglieder';
$language_text['_pos_empty_kat'] = 'Du musst eine Rangbezeichnung angeben!';
$language_text['_forum_lastpost'] = '<a href="?action=showthread&amp;id={$tid}&amp;page={$page}#p{$id}"><img src="../inc/images/forum_lpost.gif" alt="" title="Zum letzten Eintrag" class="icon" /></a>';
$language_text['_forum_addpost'] = 'Neuer Eintrag';
$language_text['_pn_write'] = 'eine Nachricht schreiben';
//--------------------------------------------\\
$language_text['_error_invalid_regcode'] = 'Der eingegebene Sicherheitsscode stimmt nicht mit der in der Grafik angezeigten Zeichenfolge &uuml;berein!';
$language_text['_error_invalid_regcode_mathematic'] = 'Das Rechenergebnis vom Sicherheitscode ist nicht richtig!';
$language_text['_welcome_guest'] = ' <img src="../inc/images/flaggen/nocountry.gif" alt="" class="icon" /> <a class="welcome" href="../user/?action=register">Gast</a>';
$language_text['_online_head'] = 'User online';
$language_text['_online_whereami'] = 'Bereich';
$language_text['_back'] = '<a href="javascript: history.go(-1)" class="files">zur&uuml;ck</a>';

## EDITED/ADDED FOR v 1.3.3
$language_text['_level_info'] = 'Beim vergeben des Levels "Admin" kann das Level nur noch &uuml;ber den Root Admin (derjenige, der das Clanportal installiert hat) ge&auml;ndert werden!<br />Ferner hat der Besitzer diesen Levels <span class="fontUnder">uneingeschr&auml;nkten</span> Zugriff auf alle Bereiche!';

## EDITED FOR v 1.3.1
$language_text['_related_links'] = 'related Links:';
$language_text['_profil_email2'] = 'E-mail #2';
$language_text['_profil_email3'] = 'E-mail #3';

## Begruessungen ##
$language_text['_welcome_18'] = 'Guten Abend,';
$language_text['_welcome_13'] = 'Guten Tag,';
$language_text['_welcome_11'] = 'Mahlzeit,';
$language_text['_welcome_5'] = 'Guten Morgen,';
$language_text['_welcome_0'] = 'Gute Nacht,';

## Monate ##
$language_text['_jan'] = 'Januar';
$language_text['_feb'] = 'Februar';
$language_text['_mar'] = 'M&auml;rz';
$language_text['_apr'] = 'April';
$language_text['_mai'] = 'Mai';
$language_text['_jun'] = 'Juni';
$language_text['_jul'] = 'Juli';
$language_text['_aug'] = 'August';
$language_text['_sep'] = 'September';
$language_text['_okt'] = 'Oktober';
$language_text['_nov'] = 'November';
$language_text['_dez'] = 'Dezember';

## Globale Userraenge ##
$language_text['_status_banned'] = 'gesperrt';
$language_text['_status_unregged'] = 'unregistriert';
$language_text['_status_user'] = 'User';
$language_text['_status_trial'] = 'Trial';
$language_text['_status_member'] = 'Member';
$language_text['_status_admin'] = 'Administrator';

## Userliste ##
$language_text['_acc_banned'] = 'Gesperrt';
$language_text['_ulist_acc_banned'] = 'Gesperrte Accounts';

## Navigation: Kalender ##
$language_text['_kal_birthday'] = 'Geburtstag von ';
$language_text['_kal_event'] = 'Event: ';

//-> Allgemein
$language_text['_years'] = 'Jahre';
$language_text['_year'] = 'Jahr';
$language_text['_months'] = 'Monate';
$language_text['_month'] = 'Monat';
$language_text['_weeks'] = 'Wochen';
$language_text['_week'] = 'Woche';
$language_text['_days'] = 'Tage';
$language_text['_day'] = 'Tag';
$language_text['_hours'] = 'Stunden';
$language_text['_hour'] = 'Stunde';
$language_text['_minutes'] = 'Minuten';
$language_text['_minute'] = 'Minute';
$language_text['_seconds'] = 'Sekunden';
$language_text['_second'] = 'Sekunde';

## News ##
$language_text['_news_kommentar'] = 'Kommentar';
$language_text['_news_kommentare'] = 'Kommentare';
$language_text['_news_archiv'] = '<a href="?action=archiv">Archiv</a>';
$language_text['_news_comments_write_head'] = 'Neuen Newskommentar schreiben';
$language_text['_news_archiv_sort'] = 'Sortieren nach';
$language_text['_news_archiv_head'] = 'Newsarchiv';
$language_text['_news_kat_choose'] = 'Kategorie w&auml;hlen';

## Artikel ##
$language_text['_artikel_comments_write_head'] = 'Neuen Artikelkommentar schreiben';

## Forum ##
$language_text['_forum_head'] = 'Forum';
$language_text['_forum_topic'] = 'Topic';
$language_text['_forum_subtopic'] = 'Untertitel';
$language_text['_forum_lpost'] = 'Letzter Beitrag';
$language_text['_forum_threads'] = 'Themen';
$language_text['_forum_thread'] = 'Thema';
$language_text['_forum_posts'] = 'Beitr&auml;ge';
$language_text['_forum_cnt_threads'] = '<span class="fontBold">Anzahl der Themen:</span> {$threads}';
$language_text['_forum_cnt_posts'] = '<span class="fontBold">Anzahl der Posts:</span> {$posts}';
$language_text['_forum_admin_head'] = 'Admin';
$language_text['_forum_admin_addsticky'] = 'als <span class="fontWichtig">wichtig</span> markieren?';
$language_text['_forum_katname_intern'] = '<span class="fontWichtig">Intern:</span> {$katname}';
$language_text['_forum_sticky'] = 'Wichtig';
$language_text['_forum_global'] = 'Global';
$language_text['_forum_closed'] = 'Geschlossen';
$language_text['_forum_head_skat_search'] = 'In dieser Kategorie suchen';
$language_text['_forum_head_threads'] = 'Themen';
$language_text['_forum_replys'] = 'Antworten';
$language_text['_forum_new_thread_head'] = 'Neues Thema erstellen';
$language_text['_empty_topic'] = 'Du musst ein Topic angeben!';
$language_text['_forum_newthread_successful'] = 'Das Thema wurde erfolgreich ins Forum eingetragen!';
$language_text['_forum_new_post_head'] = 'Neuen Forenpost eintragen';
$language_text['_forum_newpost_successful'] = 'Der Post wurde erfolgreich ins Forum eingetragen!';
$language_text['_posted_by'] = '<span class="fontBold">&raquo;</span> ';
$language_text['_forum_lpostlink'] = 'Letzter Post';
$language_text['_forum_user_posts'] = '<span class="fontBold">Posts:</span> {$posts}';
$language_text['_sig'] = '<br /><br /><hr />';
$language_text['_error_forum_closed'] = 'Dieses Thema ist geschlossen!';
$language_text['_forum_search_head'] = 'Forensuche';
$language_text['_forum_edit_post_head'] = 'Forenpost editieren';
$language_text['_forum_edit_thread_head'] = 'Thema editieren';
$language_text['_forum_editthread_successful'] = 'Das Thema wurde erfolgreich editiert!';
$language_text['_forum_editpost_successful'] = 'Der Eintrag wurde erfolgreich editiert!';
$language_text['_forum_delpost_successful'] = 'Der Eintrag wurde erfolgreich gel&ouml;scht!';
$language_text['_forum_admin_open'] = 'Thema ist ge&ouml;ffnet';
$language_text['_forum_admin_delete'] = 'Thema l&ouml;schen?';
$language_text['_forum_admin_close'] = 'Thema ist geschlossen';
$language_text['_forum_admin_moveto'] = 'Thema verschieben nach:';
$language_text['_forum_admin_thread_deleted'] = 'Das Thema wurde erfolgreich gel&ouml;scht!';
$language_text['_forum_admin_do_move'] = 'Das Thema wurde erfolgreich bearbeitet<br />und in die Kategorie <span class="fontWichtig">{$kat}</span> verschoben!';
$language_text['_forum_admin_modded'] = 'Das Thema wurde erfolgreich bearbeitet!';
$language_text['_forum_search_what'] = 'Suchen nach';
$language_text['_forum_search_kat'] = 'in Kategorie';
$language_text['_forum_search_suchwort'] = 'Suchw&ouml;rter';
$language_text['_forum_search_inhalt'] = 'Inhalt';
$language_text['_forum_search_kat_all'] = 'allen Kategorien';
$language_text['_forum_search_results'] = 'Suchergebnisse';
$language_text['_forum_online_head'] = 'Im Forum online:';
$language_text['_forum_nobody_is_online'] = 'Zur Zeit ist kein User im Forum online!';
$language_text['_forum_admin_closed'] = 'Umfrage schlie&szlig;en';

## Kalender ##
//-> Allgemein
$language_text['_kalender_head'] = 'Kalender';
$language_text['_montag'] = 'Montag';
$language_text['_dienstag'] = 'Dienstag';
$language_text['_mittwoch'] = 'Mittwoch';
$language_text['_donnerstag'] = 'Donnerstag';
$language_text['_freitag'] = 'Freitag';
$language_text['_samstag'] = 'Samstag';
$language_text['_sonntag'] = 'Sonntag';

//-> Events
$language_text['_kalender_events_head'] = 'Ereignisse am {$datum}';
$language_text['_kalender_uhrzeit'] = 'Uhrzeit';

//-> Admin
$language_text['_kalender_admin_head_add'] = 'Ereignis hinzuf&uuml;gen';
$language_text['_kalender_admin_head_edit'] = 'Ereignis editieren';
$language_text['_kalender_event'] = 'Ereignis';
$language_text['_kalender_error_no_time'] = 'Du musst ein Datum und eine Zeit angeben!';
$language_text['_kalender_error_no_title'] = 'Du musst einen Titel angeben!';
$language_text['_kalender_error_no_event'] = 'Du musst das Ereignis beschreiben!';
$language_text['_kalender_successful_added'] = 'Das Ereignis wurde erfolgreich eingetragen!';
$language_text['_kalender_successful_edited'] = 'Das Ereignis wurde erfolgreich editiert!';
$language_text['_kalender_deleted'] = 'Das Ereignis wurde erfolgreich gel&ouml;scht!';

## Umfragen ##
$language_text['_error_vote_closed'] = 'Diese Umfrage ist geschlossen!';
$language_text['_votes_admin_closed'] = 'Umfrage schlie&szlig;en';
$language_text['_votes_head'] = 'Umfragen';
$language_text['_votes_stimmen'] = 'Stimmen';
$language_text['_votes_intern'] = '<span class="fontWichtig">Intern:</span> ';
$language_text['_votes_results_head'] = 'Umfrageergebnis';
$language_text['_votes_results_head_vote'] = 'Antwortm&ouml;glichkeiten';
$language_text['_vote_successful'] = 'Du hast erfolgreich an der Umfrage teilgenommen!';
$language_text['_votes_admin_head'] = 'Neue Umfrage hinzuf&uuml;gen';
$language_text['_votes_admin_question'] = 'Frage';
$language_text['_votes_admin_answer'] = 'Antwortm&ouml;glichkeit';
$language_text['_empty_votes_question'] = 'Du musst eine Frage definieren!';
$language_text['_empty_votes_answer'] = 'Du musst mindestens 2 Antworten definieren!';
$language_text['_votes_admin_intern'] = 'Interne Umfrage';
$language_text['_vote_admin_successful'] = 'Die Umfrage wurde erfolgreich eingetragen!';
$language_text['_vote_admin_delete_successful'] = 'Die Umfrage wurde erfolgreich gel&ouml;scht!';
$language_text['_vote_admin_successful_menu'] = 'Die Umfrage ist nun im Men&uuml; eingetragen!';
$language_text['_vote_admin_menu_isintern'] = 'Du kannst keine interne Umfrage ins Men&uuml; setzen!';
$language_text['_vote_legendemenu'] = 'Umfrage im Men&uuml;?<br />(Icon klicken um die Umfrage ein- oder auszutragen)';
$language_text['_votes_admin_edit_head'] = 'Umfrage editieren';
$language_text['_vote_admin_successful_edited'] = 'Die Umfrage wurde erfolgreich editiert!';
$language_text['_vote_admin_successful_menu1'] = 'Die Umfrage wurde erfolgreich aus dem Men&uuml; ausgetragen!';
$language_text['_error_voted_again'] = 'Du hast bereits an dieser Umfrage teilgenommen!';

## Links/Sponsoren ##
$language_text['_links_head'] = 'Links';
$language_text['_links_admin_head'] = 'Neuen Link hinzuf&uuml;gen';
$language_text['_links_admin_head_edit'] = 'Link editieren';
$language_text['_links_link'] = 'Linkadresse';
$language_text['_links_beschreibung'] = 'Linkbeschreibung';
$language_text['_links_art'] = 'Linkart';
$language_text['_links_admin_textlink'] = 'Textlink';
$language_text['_links_admin_bannerlink'] = 'Bannerlink';
$language_text['_links_text'] = 'Banneradresse';
$language_text['_links_empty_beschreibung'] = 'Du musst eine Linkbeschreibung angeben!';
$language_text['_links_empty_link'] = 'Du musst eine Linkadresse angeben!';
$language_text['_link_added'] = 'Der Link wurde erfolgreich hinzugef&uuml;gt!';
$language_text['_link_edited'] = 'Der Link wurde erfolgreich editiert!';
$language_text['_link_deleted'] = 'Der Link wurde erfolgreich gel&ouml;scht!';
$language_text['_sponsor_head'] = 'Sponsoren';

## Downloads ##
$language_text['_downloads_head'] = 'Downloads';
$language_text['_downloads_download'] = 'Download';
$language_text['_downloads_admin_head'] = 'Download hinzuf&uuml;gen';
$language_text['_downloads_nofile'] = '<option value="lazy">- keine Datei -</option>';
$language_text['_downloads_admin_head_edit'] = 'Download editieren';
$language_text['_downloads_lokal'] = 'lokale Datei';
$language_text['_downloads_exist'] = 'Datei';
$language_text['_downloads_name'] = 'Downloadname';
$language_text['_downloads_url'] = 'Datei';
$language_text['_downloads_kat'] = 'Kategorie';
$language_text['_downloads_empty_download'] = 'Du musst einen Downloadnamen angeben!';
$language_text['_downloads_empty_url'] = 'Du musst eine Datei angeben!';
$language_text['_downloads_empty_beschreibung'] = 'Du musst eine Beschreibung angeben!';
$language_text['_downloads_added'] = 'Der Download wurde erfolreich hinzugef&uuml;gt!';
$language_text['_downloads_edited'] = 'Der Download wurde erfolgreich editiert!';
$language_text['_downloads_deleted'] = 'Der Download wurde erfolgreich gel&ouml;scht!';
$language_text['_dl_info'] = 'Download Informationen';
$language_text['_dl_file'] = 'Datei';
$language_text['_dl_files'] = 'Dateien';
$language_text['_dl_besch'] = 'Beschreibung';
$language_text['_dl_info2'] = 'Datei Informationen';
$language_text['_dl_size'] = 'Dateigr&ouml;&szlig;e';
$language_text['_dl_speed'] = 'Geschwindigkeit';
$language_text['_dl_traffic'] = 'verursachter Traffic';
$language_text['_dl_loaded'] = 'bisherige Downloads';
$language_text['_dl_date'] = 'Uploaddatum';
$language_text['_dl_wait'] = 'Download der Datei: ';
$language_text['_dl_fileman'] = 'Fileman &ouml;ffnen';

## User ##
$language_text['_profil_head'] = '<span class="fontBold">Userprofil von {$nick}</span> [{$profilhits} mal angesehen]';
$language_text['_user_noposi'] = '<option value="lazy" class="dropdownKat">keine Position</option>';
$language_text['_login_head'] = 'Login';
$language_text['_new_pwd'] = 'neues Passwort';
$language_text['_register_head'] = 'Registrierung';
$language_text['_register_confirm'] = 'Sicherheitsscode';
$language_text['_register_confirm_add'] = 'Code eingeben';
$language_text['_lostpwd_head'] = 'Passwort zuschicken';
$language_text['_profil_edit_head'] = 'Profil von {$nick} editieren';
$language_text['_profil_clan'] = 'Clan';
$language_text['_profil_pic'] = 'Picture';
$language_text['_profil_contact'] = 'Kontakt';
$language_text['_profil_hardware'] = 'Hardware';
$language_text['_profil_about'] = '&Uuml;ber mich';
$language_text['_profil_real'] = 'Name';
$language_text['_profil_city'] = 'Wohnort';
$language_text['_profil_bday'] = 'Geburtstag';
$language_text['_profil_age'] = 'Alter';
$language_text['_profil_hobbys'] = 'Hobbys';
$language_text['_profil_motto'] = 'Motto';
$language_text['_profil_hp'] = 'Homepage';
$language_text['_profil_sex'] = 'Geschlecht';
$language_text['_profil_board'] = 'Mainboard';
$language_text['_profil_cpu'] = 'CPU';
$language_text['_profil_ram'] = 'RAM';
$language_text['_profil_graka'] = 'Grafikkarte';
$language_text['_profil_monitor'] = 'Monitor';
$language_text['_profil_maus'] = 'Maus';
$language_text['_profil_mauspad'] = 'Mauspad';
$language_text['_profil_hdd'] = 'HDD';
$language_text['_profil_headset'] = 'Headset';
$language_text['_profil_os'] = 'System';
$language_text['_profil_inet'] = 'Internet';
$language_text['_profil_job'] = 'Job';
$language_text['_profil_position'] = 'Position';
$language_text['_profil_exclans'] = 'Ex-Clans';
$language_text['_profil_status'] = 'Status';
$language_text['_aktiv'] = '<span class=fontGreen>aktiv</span>';
$language_text['_inaktiv'] = '<span class=fontRed>inaktiv</span>';
$language_text['_male'] = 'm&auml;nnlich';
$language_text['_female'] = 'weiblich';
$language_text['_profil_ppic'] = 'Profilfoto';
$language_text['_profil_gamestuff'] = 'Gamestuff';
$language_text['_profil_userstats'] = 'Userstats';
$language_text['_profil_profilhits'] = 'Profilhits';
$language_text['_profil_forenposts'] = 'Forenposts';
$language_text['_profil_votes'] = 'teilgenommene Votes';
$language_text['_profil_msgs'] = 'versendete Nachrichten';
$language_text['_profil_logins'] = 'Logins';
$language_text['_profil_registered'] = 'Registrierungsdatum';
$language_text['_profil_last_visit'] = 'Letzter Pagebesuch';
$language_text['_profil_pagehits'] = 'Pagehits';
$language_text['_pedit_visibility'] = 'Sichtbarkeit/Berechtigungen';
$language_text['_pedit_perm_public'] = '&Ouml;ffentlich';
$language_text['_pedit_perm_user'] = 'Nur User';
$language_text['_pedit_perm_member'] = 'Nur Mitglieder';
$language_text['_pedit_perm_admin'] = 'Nur Administratoren';
$language_text['_pedit_perm_allow'] = '<option value="1" selected="selected">Zulassen</option><option value="0">Sperren</option>';
$language_text['_pedit_perm_deny'] = '<option value="1">Zulassen</option><option value="0" selected="selected">Sperren</option>';
$language_text['_profil_edit_pic'] = '<a href="../upload/?action=userpic">hochladen</a>';
$language_text['_profil_delete_pic'] = '<a href="../upload/?action=userpic&amp;do=deletepic">l&ouml;schen</a>';
$language_text['_profil_edit_ava'] = '<a href="../upload/?action=avatar">hochladen</a>';
$language_text['_profil_delete_ava'] = '<a href="../upload/?action=avatar&amp;do=delete">l&ouml;schen</a>';
$language_text['_pedit_male'] = '<option value="0">keine Angabe</option><option value="1" selected="selected">m&auml;nnlich</option><option value="2">weiblich</option>';
$language_text['_pedit_female'] = '<option value="0">keine Angabe</option><option value="1">m&auml;nnlich</option><option value="2" selected="selected">weiblich</option>';
$language_text['_pedit_sex_ka'] = '<option value="0">keine Angabe</option><option value="1">m&auml;nnlich</option><option value="2">weiblich</option>';
$language_text['_info_edit_profile_done'] = 'Du hast dein Profil erfolgreich editiert!';
$language_text['_delete_pic_successful'] = 'Dein Bild wurde erfolgreich gel&ouml;scht!';
$language_text['_no_pic_available'] = 'Es wurde kein Bild von dir gefunden!';
$language_text['_profil_edit_profil_link'] = '<a href="?action=editprofile">Profil editieren</a>';
$language_text['_profil_avatar'] = 'Avatar';
$language_text['_lostpwd_failed'] = 'Loginname und E-Mailadresse stimmen nicht &uuml;berein!';
$language_text['_lostpwd_valid'] = 'Es wurde soeben ein neues Passwort generiert und an deine Emailadresse gesendet!';
$language_text['_lostpwd_valid_sended'] = 'Dir wurde eine E-Mail mit dem &Auml;nderungslink gesendet!';
$language_text['_error_user_already_in'] = 'Du bist bereits eingeloggt!';
$language_text['_user_is_banned'] = 'Dein Account wurde vom Admin dieser Seite gesperrt und ist ab jetzt nicht mehr nutzbar!<br />Informiere dich bei einem authorisiertem Mitglied &uuml;ber den genauen Sachverhalt.';
$language_text['_msghead'] = 'Nachrichtencenter von {$nick}';
$language_text['_posteingang'] = 'Posteingang';
$language_text['_postausgang'] = 'Postausgang';
$language_text['_msg_title'] = 'Nachricht';
$language_text['_msg_absender'] = 'Absender';
$language_text['_msg_empfaenger'] = 'Empf&auml;nger';
$language_text['_msg_answer_msg'] = 'Nachricht von {$nick}';
$language_text['_msg_sended_msg'] = 'Nachricht an {$nick}';
$language_text['_msg_answer_done'] = 'Die Nachricht wurde erfolgreich versendet!';
$language_text['_msg_titel'] = 'Neue Nachricht schreiben';
$language_text['_msg_titel_answer'] = 'Antworten';
$language_text['_to'] = 'An';
$language_text['_or'] = 'oder';
$language_text['_msg_to_just_1'] = 'Du kannst nur einen Empf&auml;nger angeben!';
$language_text['_msg_not_to_me'] = 'Du kannst keine Nachricht an dich selber schreiben!';
$language_text['_legende_readed'] = 'Nachricht wurde vom Empf&auml;nger gelesen?';
$language_text['_legende_msg'] = 'Neue Nachricht';
$language_text['_msg_from_nick'] = 'Nachricht von  {$nick}';
$language_text['_msg_global_reg'] = 'alle registrierten User';
$language_text['_msg_global_squad'] = 'einzelne Teams:';
$language_text['_msg_bot'] = '<span class="fontBold">MsgBot</span>';
$language_text['_msg_global_who'] = 'Empf&auml;nger';
$language_text['_msg_reg_answer_done'] = 'Die Nachricht wurde erfolgreich an alle registrierten User versendet!';
$language_text['_msg_member_answer_done'] = 'Die Nachricht wurde erfolgreich an alle Mitglieder versendet!';
$language_text['_msg_squad_answer_done'] = 'Die Nachricht wurde erfolgreich an das ausgew&auml;hlte Team versendet!';
$language_text['_buddyhead'] = 'Buddyverwaltung';
$language_text['_addbuddys'] = 'Buddies hinzuf&uuml;gen';
$language_text['_buddynick'] = 'Buddy';
$language_text['_add_buddy_successful'] = 'Der User wurde erfolgreich als Buddy geadded!';
$language_text['_buddys_legende_addedtoo'] = 'Der User hat dich auch geadded';
$language_text['_buddys_legende_dontaddedtoo'] = 'Der User hat dich nicht geadded';
$language_text['_buddys_delete_successful'] = 'Der User wurde erfolgreich als Buddy gel&ouml;scht!';
$language_text['_buddy_added_msg'] = 'Der User <span class="fontBold">{$user}</span> hat dich soeben als Buddy geadded!';
$language_text['_buddy_title'] = 'Buddies';
$language_text['_buddy_del_msg'] = 'Der User <span class="fontBold">{$user}</span> hat dich soeben als Buddy gel&ouml;scht!';
$language_text['_ulist_lastreg'] = 'neuste User';
$language_text['_ulist_online'] = 'Onlinestatus';
$language_text['_ulist_age'] = 'Alter';
$language_text['_ulist_sex'] = 'Geschlecht';
$language_text['_ulist_country'] = 'Nationalit&auml;t';
$language_text['_ulist_sort'] = 'Sortieren nach:';
$language_text['_admin_user_edithead'] = 'Admin: User editieren';
$language_text['_admin_user_clanhead'] = 'Autorisierungen';
$language_text['_admin_user_squadhead'] = 'Team';
$language_text['_admin_user_personalhead'] = 'Pers&ouml;nliches';
$language_text['_admin_user_level'] = 'Level';
$language_text['_admin_user_edituser'] = 'User editieren';
$language_text['_admin_user_editsquads'] = 'Admin: Teams';
$language_text['_admin_user_editkalender'] = 'Admin: Kalender';
$language_text['_member_admin_newsletter'] = 'Admin: Newsletter';
$language_text['_member_admin_downloads'] = 'Admin: Downloads';
$language_text['_member_admin_links'] = 'Admin: Links';
$language_text['_member_admin_forum'] = 'Admin: Forum';
$language_text['_member_admin_intforum'] = 'Internes Forum sehen';
$language_text['_member_admin_news'] = 'Admin: News';
$language_text['_error_edit_myself'] = 'Du kannst dich nicht selber editieren!';
$language_text['_error_edit_admin'] = 'Du darfst keine Admins editieren!';
$language_text['_admin_level_banned'] = 'Account sperren';
$language_text['_admin_user_identitat'] = 'Identit&auml;t';
$language_text['_admin_user_get_identitat'] = '<a href="?action=admin&amp;do=identy&amp;id={$id}">annehmen</a>';
$language_text['_identy_admin'] = 'Du kannst nicht die Identit&auml;t von einem Admin annehmen!';
$language_text['_admin_squad_del'] = '<option value="delsq">- User aus dem Team l&ouml;schen -</option>';
$language_text['_admin_squad_nosquad'] = '<option class="dropdownKat" value="lazy">- User ist in keinem Team -</option>';
$language_text['_admin_user_edited'] = 'Der User wurde erfolgreich editiert!';
$language_text['_userlobby'] = 'Userlobby';
$language_text['_lobby_new'] = 'Neuerungen seit dem letzten Pagebesuch';
$language_text['_lobby_new_erased'] = 'Die tempor&auml;ren Neuerungen wurden erfolgreich gel&ouml;scht!';
$language_text['_last_forum'] = 'Letzten 10 Forumsbeitr&auml;ge';
$language_text['_lobby_forum'] = 'Forenbeitr&auml;ge';
$language_text['_new_post_1'] = 'neuer Post';
$language_text['_new_post_2'] = 'neue Posts';
$language_text['_new_thread'] = 'im Thema ';
$language_text['_no_new_thread'] = 'Neues Thema:';
$language_text['_new_eintrag_1'] = 'neuer Eintrag';
$language_text['_new_eintrag_2'] = 'neue Eintr&auml;ge';
$language_text['_lobby_user'] = 'Registrierte User';
$language_text['_new_users_1'] = 'neu registrierter User';
$language_text['_new_users_2'] = 'neu registrierte User';
$language_text['_lobby_news'] = 'News';
$language_text['_lobby_new_news'] = 'neue News';
$language_text['_lobby_newsc'] = 'Newskommentare';
$language_text['_lobby_new_newsc_1'] = 'neuer Newskommentar';
$language_text['_lobby_new_newsc_2'] = 'neue Newskommentare';
$language_text['_new_msg_1'] = 'neue Nachricht';
$language_text['_new_msg_2'] = 'neue Nachrichten';
$language_text['_lobby_votes'] = 'Umfragen';
$language_text['_new_vote_1'] = 'neue Umfrage';
$language_text['_new_vote_2'] = 'neue Umfragen';
$language_text['_user_delete_verify'] = '
<tr>
  <td class="contentHead"><span class="fontBold">User l&ouml;schen</span></td>
</tr>
<tr>
  <td class="contentMainFirst" align="center">
    Bist du dir sicher das du den User {$user} l&ouml;schen willst?<br />
    <span class="fontUnder">Alle</span> Aktivit&auml;ten dieses Users auf dieser Seite werden damit gel&ouml;scht!<br /><br />
    <a href="?action=admin&amp;do=delete&verify=yes&amp;id={$id}">Ja, l&ouml;schen!</a>
  </td>
</tr>';
$language_text['_user_deleted'] = 'Der User wurde erfolgreich gel&ouml;scht!';
$language_text['_userlobby_kal_today'] = 'N&auml;chster Event ist';
$language_text['_userlobby_kal_not_today'] = 'N&auml;chstes Event ist am';
$language_text['_profil_country'] = 'Land';
$language_text['_profil_favos'] = 'Favoriten';
$language_text['_profil_sonst'] = 'Sonstiges';
$language_text['_profil_url1'] = 'Page #1';
$language_text['_profil_url2'] = 'Page #2';
$language_text['_profil_url3'] = 'Page #3';
$language_text['_profil_ich'] = 'Beschreibung';

## Upload ##
$language_text['_upload_ext_error'] = 'Nur jpg, gif oder png Dateien!';
$language_text['_upload_wrong_size'] = 'Die ausgew&auml;hlte Datei ist gr&ouml;&szlig;er als zugelassen!';
$language_text['_upload_no_data'] = 'Du musst eine Datei angeben!';
$language_text['_info_upload_success'] = 'Die Datei wurde erfolgreich hochgeladen!';
$language_text['_upload_info'] = 'Info';
$language_text['_upload_file'] = 'Datei';
$language_text['_upload_beschreibung'] = 'Beschreibung';
$language_text['_upload_button'] = 'Hochladen';
$language_text['_upload_over_limit'] = 'Du darfst nicht mehr Bilder hochladen! L&ouml;sche alte Bilder um neue hochladen zu d&uuml;rfen!';
$language_text['_upload_file_exists'] = 'Die angegebene Datei existiert bereits! Benenne die Datei um oder w&auml;hle eine andere Datei aus!';
$language_text['_upload_head'] = 'Userbild uploaden';
$language_text['_upload_userpic_info'] = 'Nur jpg, gif oder png Dateien mit einer maximalen Gr&ouml;&szlig;e von {$userpicsize}KB!<br />Die empfohlene Gr&ouml;&szlig;e ist 170px * 210px ';
$language_text['_upload_ava_head'] = 'Useravatar';
$language_text['_upload_userava_info'] = 'Nur jpg, gif oder png Dateien mit einer maximalen Gr&ouml;&szlig;e von {$userpicsize}KB!<br />Die empfohlene Gr&ouml;&szlig;e ist 100px * 100px ';
$language_text['_upload_newskats_head'] = 'Kategoriebilder';
$language_text['_upload_usergallery_info'] = 'Nur jpg, gif oder png Dateien mit einer maximalen Gr&ouml;&szlig;e von {$userpicsize}KB!';

## Unzugeordnet ##
$language_text['_forum_no_last_post'] = 'Der letzte Post kann leider nicht angezeigt werden!';
$language_text['_config_maxwidth'] = 'Bilder autom. verkleinern';
$language_text['_config_maxwidth_info'] = 'Hier kannst du einstellen, ab wann ein zu breites Bild verkleinert werden soll!';
$language_text['_forum_top_posts'] = 'Top 5 Poster';
$language_text['_user_cant_delete_admin'] = 'Du darfst keine Member oder Admins l&ouml;schen!';
$language_text['_no_entrys_yet'] = '
<tr>
  <td class="contentMainFirst" colspan="{$colspan}" align="center">Bisher noch kein Eintrag vorhanden!</td>
</tr>';
$language_text['_nav_no_ftopics'] = 'Noch kein Eintrag!';
$language_text['_target'] = 'Neues Fenster';
$language_text['_fopen'] = 'Der Webhoster dieser Seite erlaubt die ben&ouml;tigte Funktion fopen() nicht!';
$language_text['_and'] = 'und';
$language_text['_lobby_artikelc'] = 'Artikelkommentare';
$language_text['_lobby_new_art_1'] = 'neuer Artikel';
$language_text['_lobby_new_art_2'] = 'neue Artikel';
$language_text['_lobby_new_artc_1'] = 'neuer Artikelkommentar';
$language_text['_lobby_new_artc_2'] = 'neue Artikelkommentare';
$language_text['_profil_nletter'] = 'Newsletter empfangen?';
$language_text['_forum_admin_addglobal'] = '<span class="fontWichtig">Globaler</span> Eintrag? (In allen Foren und Subforen)';
$language_text['_forum_admin_global'] = '<span class="fontWichtig">Globaler</span> Eintrag?';
$language_text['_admin_config_badword'] = 'Badword-Filter';
$language_text['_admin_config_badword_info'] = 'Hier kannst du W&ouml;rter angeben, die bei Eingabe mit **** versehen werden. Die W&ouml;rter m&uuml;ssen mit Komma getrennt werden!';
$language_text['_iplog_info'] = '<span class="fontBold">Hinweis:</span> Aus Sicherheitsgr&uuml;nden wird deine IP geloggt!';
$language_text['_logged'] = 'IP gespeichert';
$language_text['_info_ip'] = 'IP-Adresse';
$language_text['_nav_montag'] = 'Mo';
$language_text['_nav_dienstag'] = 'Di';
$language_text['_nav_mittwoch'] = 'Mi';
$language_text['_nav_donnerstag'] = 'Do';
$language_text['_nav_freitag'] = 'Fr';
$language_text['_nav_samstag'] = 'Sa';
$language_text['_nav_sonntag'] = 'So';
$language_text['_age'] = 'Alter';
$language_text['_error_empty_age'] = 'Du musst dein aktuelles Alter angeben!';
$language_text['_member_admin_intforums'] = 'interne Forumauthorisierungen';
$language_text['_access'] = 'Authorisierung';
$language_text['_error_no_access'] = 'Du hast nicht die n&ouml;tigen Rechte um diesen Bereich betreten zu d&uuml;rfen!';
$language_text['_artikel_show_link'] = '<a href="../artikel/?action=show&amp;id={$id}">{$titel}</a>';
$language_text['_ulist_bday'] = 'Geburtstag';
$language_text['_ulist_last_login'] = 'Letzter Login';

## Impressum ##
$language_text['_impressum_head'] = 'Impressum';
$language_text['_impressum_autor'] = 'Autor der Seite';
$language_text['_impressum_domain'] = 'Domain:';
$language_text['_impressum_disclaimer'] = 'Haftungsausschluss';
$language_text['_impressum_txt'] = '<blockquote>
<h2><span class="fontBold">1. Inhalt des Onlineangebotes</span></h2>
<br />
Der Autor &uuml;bernimmt keinerlei Gew&auml;hr f&uuml;r die Aktualit&auml;t, Korrektheit, Vollst&auml;ndigkeit oder Qualit&auml;t der bereitgestellten Informationen. Haftungsanspr&uuml;che
gegen den Autor, welche sich auf Sch&auml;den materieller oder ideeller Art beziehen, die durch die Nutzung oder Nichtnutzung der dargebotenen Informationen bzw. durch die Nutzung fehlerhafter und unvollst&auml;ndiger Informationen verursacht wurden, sind grunds&auml;tzlich ausgeschlossen, sofern seitens
des Autors kein nachweislich vors&auml;tzliches oder grob fahrl&auml;ssiges Verschulden vorliegt.
<br />
<br />Alle Angebote sind freibleibend und unverbindlich. Der Autor beh&auml;lt es sich ausdr&uuml;cklich vor,
Teile der Seiten oder das gesamte Angebot ohne gesonderte Ank&uuml;ndigung zu ver&auml;ndern, zu erg&auml;nzen, zu l&ouml;schen oder die Ver&ouml;ffentlichung zeitweise oder endg&uuml;ltig einzustellen.
<br />
<br /><h2><span class="fontBold">2. Verweise und Links</span></h2>
<br />
Bei direkten oder indirekten Verweisen auf fremde Webseiten (\'Hyperlinks\'), die au&szlig;erhalb des Verantwortungsbereiches
des Autors liegen, w&uuml;rde eine Haftungsverpflichtung ausschlie&szlig;lich in dem Fall
in Kraft treten, in dem der Autor von den Inhalten Kenntnis hat und es ihm technisch m&ouml;glich und zumutbar w&auml;re, die Nutzung im Falle rechtswidriger Inhalte zu verhindern.
<br /><br />
Der Autor erkl&auml;rt hiermit ausdr&uuml;cklich, dass zum Zeitpunkt der Linksetzung keine illegalen Inhalte auf den zu verlinkenden Seiten erkennbar waren. Auf die aktuelle und zuk&uuml;nftige
Gestaltung, die Inhalte oder die Urheberschaft der verlinkten/verkn&uuml;pften Seiten hat der Autor keinerlei Einfluss. Deshalb distanziert er sich hiermit ausdr&uuml;cklich von allen Inhalten aller verlinkten
/verkn&uuml;pften Seiten, die nach der Linksetzung ver&auml;ndert wurden. Diese Feststellung gilt f&uuml;r alle innerhalb des eigenen Internetangebotes gesetzten Links und Verweise sowie f&uuml;r Fremdeintr&auml;ge in vom Autor eingerichteten G&auml;steb&uuml;chern, Diskussionsforen, Linkverzeichnissen, Mailinglisten und in allen anderen Formen von Datenbanken, auf deren Inhalt externe Schreibzugriffe m&ouml;glich sind. F&uuml;r illegale, fehlerhafte oder unvollst&auml;ndige Inhalte und insbesondere f&uuml;r Sch&auml;den, die aus der Nutzung oder Nichtnutzung solcherart dargebotener Informationen entstehen, haftet allein der Anbieter der Seite, auf welche verwiesen wurde, nicht derjenige, der &uuml;ber Links auf die jeweilige Ver&ouml;ffentlichung lediglich verweist.
<br />
<br /><h2><span class="fontBold">3. Urheber- und Kennzeichenrecht</span></h2>
<br />
Der Autor ist bestrebt, in allen Publikationen die Urheberrechte der verwendeten Bilder, Grafiken, Tondokumente, Videosequenzen und Texte
zu beachten, von ihm selbst erstellte Bilder, Grafiken, Tondokumente, Videosequenzen und Texte zu nutzen oder auf lizenzfreie Grafiken, Tondokumente, Videosequenzen und Texte zur&uuml;ckzugreifen.
<br />
Alle innerhalb des Internetangebotes genannten und ggf. durch Dritte gesch&uuml;tzten Marken- und Warenzeichen unterliegen uneingeschr&auml;nkt den Bestimmungen des jeweils g&uuml;ltigen Kennzeichenrechts und den Besitzrechten der jeweiligen eingetragenen Eigent&uuml;mer. Allein aufgrund der blo&szlig;en Nennung ist nicht der Schluss zu ziehen, dass Markenzeichen nicht durch Rechte Dritter gesch&uuml;tzt sind!
<br />
Das Copyright f&uuml;r ver&ouml;ffentlichte, vom Autor selbst erstellte Objekte bleibt allein beim Autor der Seiten.
Eine Vervielf&auml;ltigung oder Verwendung solcher Grafiken, Tondokumente, Videosequenzen und Texte in anderen elektronischen oder gedruckten Publikationen ist ohne ausdr&uuml;ckliche Zustimmung des Autors nicht gestattet.
<br />
<br /><h2><span class="fontBold">4. Datenschutz</span></h2>
<br />
Sofern innerhalb des Internetangebotes die M&ouml;glichkeit zur Eingabe pers&ouml;nlicher oder gesch&auml;ftlicher Daten (Emailadressen, Namen, Anschriften) besteht, so erfolgt die Preisgabe dieser Daten seitens des Nutzers auf ausdr&uuml;cklich freiwilliger Basis. Die Inanspruchnahme und Bezahlung aller angebotenen Dienste ist - soweit technisch m&ouml;glich und zumutbar - auch ohne Angabe solcher Daten bzw. unter Angabe anonymisierter Daten oder eines Pseudonyms gestattet.
Die Nutzung der im Rahmen des Impressums oder vergleichbarer Angaben ver&ouml;ffentlichten Kontaktdaten wie Postanschriften, Telefon- und Faxnummern sowie Emailadressen durch Dritte zur &Uuml;bersendung von nicht ausdr&uuml;cklich angeforderten Informationen ist nicht gestattet. Rechtliche Schritte gegen die Versender von sogenannten Spam-Mails bei Verst&ouml;ssen gegen dieses Verbot sind ausdr&uuml;cklich vorbehalten.
<br />
<br /><h2><span class="fontBold">5. Rechtswirksamkeit dieses Haftungsausschlusses</span></h2>
<br />
Dieser Haftungsausschluss ist als Teil des Internetangebotes zu betrachten, von dem aus auf diese Seite verwiesen wurde. Sofern Teile oder einzelne Formulierungen dieses Textes der geltenden Rechtslage nicht, nicht mehr oder nicht vollst&auml;ndig entsprechen sollten, bleiben die &uuml;brigen Teile des Dokumentes in ihrem Inhalt und ihrer G&uuml;ltigkeit davon unber&uuml;hrt.
</blockquote>';
## Admin ##
$language_text['_config_head'] = 'Adminbereich';
$language_text['_config_empty_katname'] = 'Du musst eine Kategoriebezeichnung angeben!';
$language_text['_config_katname'] = 'Kategoriebezeichnung';
$language_text['_config_set'] = 'Die Einstellungen wurden erfolgreich &uuml;bernommen!';
$language_text['_config_forum_status'] = 'Status';
$language_text['_config_forum_head'] = 'Forenkategorien';
$language_text['_config_forum_mainkat'] = 'Hauptkategorie';
$language_text['_config_forum_subkathead'] = 'Unterkategorien von <span class="fontUnder">{$kat}</span>';
$language_text['_config_forum_subkat'] = 'Unterkategorie';
$language_text['_config_forum_subkats'] = '<span class="fontBold">{$topic}</span><br /><span class="fontItalic">{$subtopic}</span>';
$language_text['_config_forum_kat_head'] = 'neue Kategorie hinzuf&uuml;gen';
$language_text['_config_forum_public'] = '&ouml;ffentlich';
$language_text['_config_forum_intern'] = 'Intern';
$language_text['_config_forum_kat_added'] = 'Die Kategorie wurde erfolgreich hinzugef&uuml;gt!';
$language_text['_config_forum_kat_deleted'] = 'Die Kategorie wurde erfolgreich gel&ouml;scht!';
$language_text['_config_forum_kat_head_edit'] = 'Kategorie editieren';
$language_text['_config_forum_kat_edited'] = 'Die Kategorie wurde erfolgreich editiert!';
$language_text['_config_forum_add_skat'] = 'Neue Unterkategorie hinzuf&uuml;gen';
$language_text['_config_forum_skatname'] = 'Unterkategoriebezeichnung';
$language_text['_config_forum_empty_skat'] = 'Du musst eine Unterkategoriebezeichnung angeben!';
$language_text['_config_forum_skat_added'] = 'Die Unterkategorie wurde erfolgreich hinzugef&uuml;gt!';
$language_text['_config_forum_stopic'] = 'Untertitel';
$language_text['_config_forum_skat_edited'] = 'Die Unterkategorie wurde erfolreich editiert!';
$language_text['_config_forum_edit_skat'] = 'Unterkategorie editieren';
$language_text['_config_forum_skat_deleted'] = 'Die Unterkategorie wurde erfolgreich gel&ouml;scht!';
$language_text['_config_newskats_kat'] = 'Kategorie';
$language_text['_config_newskats_head'] = 'News-/Artikelkategorien';
$language_text['_config_newskats_katbild'] = 'Katbild';
$language_text['_config_newskats_add'] = '<a href="?admin=news&amp;do=add">Neue Kategorie hinzuf&uuml;gen</a>';
$language_text['_config_newskat_deleted'] = 'Die Kategorie wurde erfolgreich gel&ouml;scht!';
$language_text['_config_newskats_add_head'] = 'Neue Kategorie hinzuf&uuml;gen';
$language_text['_config_newskats_added'] = 'Die Kategorie wurde erfolgreich hinzugef&uuml;gt!';
$language_text['_config_newskats_edit_head'] = 'Kategorie editieren';
$language_text['_config_newskats_edited'] = 'Die Kategorie wurde erfolgreich editiert!';
$language_text['_config_impressum_head'] = 'Impressum';
$language_text['_config_impressum_domains'] = 'Domains';
$language_text['_config_impressum_autor'] = 'Autor der Seite';
$language_text['_config_konto_head'] = 'Kontodaten';
$language_text['_news_admin_head'] = 'Newsbereich';
$language_text['_admin_news_add'] = '<a href="?admin=newsadmin&amp;do=add">News hinzuf&uuml;gen</a>';
$language_text['_admin_news_head'] = 'News hinzuf&uuml;gen';
$language_text['_news_admin_kat'] = 'Kategorie';
$language_text['_news_admin_klapptitel'] = 'Klapptexttitel';
$language_text['_news_admin_more'] = 'More';
$language_text['_empty_news'] = 'Du musst eine News eintragen!';
$language_text['_news_sended'] = 'Die News wurde erfolgreich eingetragen!';
$language_text['_admin_news_edit_head'] = 'News editieren';
$language_text['_news_edited'] = 'Die News wurde erfolgreich editiert!';
$language_text['_news_deleted'] = 'Die News wurde erfolgreich gel&ouml;scht!';
$language_text['_member_admin_header'] = 'Gruppenbereich';
$language_text['_member_admin_squad'] = 'Gruppe';
$language_text['_member_admin_add'] = '<a href="?admin=gruppe&amp;do=add">Gruppe hinzuf&uuml;gen</a>';
$language_text['_admin_squad_deleted'] = 'Die Gruppe wurde erfolgreich gel&ouml;scht!';
$language_text['_member_admin_add_header'] = 'Gruppe hinzuf&uuml;gen';
$language_text['_admin_squad_no_squad'] = 'Du musst einen Gruppennamen angeben!';
$language_text['_admin_squad_add_successful'] = 'Die Gruppe wurde erfolgreich hinzugef&uuml;gt!';
$language_text['_admin_squad_edit_successful'] = 'Die Gruppe wurde erfolgreich editiert!';
$language_text['_member_admin_edit_header'] = 'Gruppe editieren';
$language_text['_error_empty_clanname'] = 'Du musst euren Clannamen angeben!';
$language_text['_admin_dlkat'] = 'Downloadkategorien';
$language_text['_dl_add_new'] = '<a href="?admin=dl&amp;do=new">Neue Kategorie hinzuf&uuml;gen</a>';
$language_text['_dl_new_head'] = 'Neue Downloadkategorie hinzuf&uuml;gen';
$language_text['_dl_dlkat'] = 'Kategorie';
$language_text['_dl_empty_kat'] = 'Du musst eine Kategoriebezeichnung angeben!';
$language_text['_dl_admin_added'] = 'Die Downloadkategorie wurde erfolgreich hinzugef&uuml;gt!';
$language_text['_dl_admin_deleted'] = 'Die Downloadkategorie wurde erfolgreich gel&ouml;scht!';
$language_text['_dl_edit_head'] = 'Downloadkategorie editieren';
$language_text['_dl_admin_edited'] = 'Die Downloadkategorie wurde erfolgreich editiert!';
$language_text['_config_global_head'] = 'Konfiguration';
$language_text['_config_c_limits'] = 'Seitenaufteilungen (LIMITS)';
$language_text['_config_c_limits_what'] = 'Hier kannst du die Eintr&auml;ge einstellen, die pro Bereich maximal angezeigt werden';
$language_text['_config_c_archivnews'] = 'News-Archiv';
$language_text['_config_c_news'] = 'News';
$language_text['_config_c_banned'] = 'Bannliste';
$language_text['_config_c_adminnews'] = 'News-Admin';
$language_text['_config_c_userlist'] = 'Userliste';
$language_text['_config_c_comments'] = 'Newskommentare';
$language_text['_config_c_fthreads'] = 'Forumsbeitr&auml;ge';
$language_text['_config_c_fposts'] = 'Forumposts';
$language_text['_config_c_floods'] = 'Anti-Flooding';
$language_text['_config_c_forum'] = 'Forum';
$language_text['_config_c_length'] = 'L&auml;ngenangaben';
$language_text['_config_c_length_what'] = 'Hier kannst du die L&auml;nge in Anzahl der Zeichen angeben, bei der nach &Uuml;berschreitung die Ausgabe gek&uuml;rzt wird.';
$language_text['_config_c_newsadmin'] = 'Newsadmin: Titel';
$language_text['_config_c_newsarchiv'] = 'Newsarchiv: Titel';
$language_text['_config_c_forumtopic'] = 'Forum: Topic';
$language_text['_config_c_forumsubtopic'] = 'Forum: Subtopic';
$language_text['_config_c_topdl'] = 'Men&uuml;: Top Downloads';
$language_text['_config_c_ftopics'] = 'Men&uuml;: Last Forumtopics';
$language_text['_config_c_main'] = 'Allgemeine Einstellungen';
$language_text['_config_c_clanname'] = 'Clanname';
$language_text['_config_c_pagetitel'] = 'Seitentitel';
$language_text['_config_c_language'] = 'Default-Sprache';
$language_text['_config_c_upicsize'] = 'Global: Uploadgr&ouml;sse Bilder';
$language_text['_config_c_upicsize_what'] = 'erlaubte Gr&ouml;&szlig;e der Bilder in KB (Newsbilder, Userprofilbilder usw.)';
$language_text['_config_c_regcode'] = 'Reg: Sicherheitscode';
$language_text['_config_c_regcode_what'] = 'Fragt bei der Registrierung einen Sicherheitscode ab';
$language_text['_pos_add_new'] = '<a href="?admin=positions&amp;do=new">Neuen Rang hinzuf&uuml;gen</a>';
$language_text['_pos_new_head'] = 'Neuen Rang hinzuf&uuml;gen';
$language_text['_pos_edit_head'] = 'Rang editieren';
$language_text['_pos_admin_edited'] = 'Der Rang wurde erfolgreich editiert!';
$language_text['_pos_admin_deleted'] = 'Der Rang wurde erfolgreich gel&ouml;scht!';
$language_text['_pos_admin_added'] = 'Der Rang wurde erfolgreich hinzugef&uuml;gt!';
$language_text['_admin_nc'] = 'Newskommentare';
$language_text['_admin_reg_head'] = 'Registrierungspflicht';
$language_text['_wartungsmodus_info'] = 'wenn eingeschaltet kann keiner, ausser der Admin die Seite betreten.';
$language_text['_navi_kat'] = 'Bereich';
$language_text['_navi_name'] = 'Linkname';
$language_text['_navi_url'] = 'Weiterleitung';
$language_text['_navi_shown'] = 'Sichtbar';
$language_text['_navi_type'] = 'Art';
$language_text['_navi_wichtig'] = 'Markieren';
$language_text['_navi_space'] = '<b>Leerzeile</b>';
$language_text['_navi_head'] = 'Navigationsverwaltung';
$language_text['_navi_add'] = '<a href="?admin=navi&amp;do=add">Neuen Link hinzuf&uuml;gen</a>';
$language_text['_navi_add_head'] = 'Neuen Link hinzuf&uuml;gen';
$language_text['_navi_edit_head'] = 'Link editieren';
$language_text['_navi_url_to'] = 'Weiterleiten nach';
$language_text['_posi'] = 'Position';
$language_text['_nach'] = 'nach';
$language_text['_navi_no_name'] = 'Du musst einen Linknamen angeben!';
$language_text['_navi_no_url'] = 'Du musst ein Weiterleitungsziel angeben!';
$language_text['_navi_no_pos'] = 'Du musst die Position f&uuml;r den Link festlegen!';
$language_text['_navi_added'] = 'Der Link wurde erfolgreich angelegt!';
$language_text['_navi_deleted'] = 'Der Link wurde erfolgreich gel&ouml;scht!';
$language_text['_navi_edited'] = 'Der Link wurde erfolgreich editiert!';
$language_text['_editor_head'] = 'Seiten erstellen/verwalten';
$language_text['_editor_name'] = 'Seitenbezeichnung';
$language_text['_editor_add'] = '<a href="?admin=editor&amp;do=add">Neue Seite erstellen</a>';
$language_text['_editor_add_head'] = 'Neue Seite hinzuf&uuml;gen';
$language_text['_inhalt'] = 'Inhalt';
$language_text['_allow'] = 'Erlauben';
$language_text['_deny'] = 'Verbieten';
$language_text['_editor_allow_html'] = 'HTML/BBCODE erlauben?';
$language_text['_empty_editor_inhalt'] = 'Du musst einen Text schreiben!';
$language_text['_site_added'] = 'Die Seite wurde erfolgreich eingetragen!';
$language_text['_editor_linkname'] = 'Link-Name';
$language_text['_editor_deleted'] = 'Die Seite wurde erfolgreich gel&ouml;scht!';
$language_text['_editor_edit_head'] = 'Seite editieren';
$language_text['_site_edited'] = 'Die Seite wurde erfolgreich editiert!';
$language_text['_navi_standard'] = 'Der Standard wurde erfolgreich wieder hergestellt!';
$language_text['_standard_sicher'] = 'Bist du dir sicher das du den Standard wiederherstellen willst?<br />Alle bisher erstellten Links und neue Seiten werden gel&ouml;scht!';
$language_text['_partners_head'] = 'Partnerbuttons';
$language_text['_partners_button'] = 'Button';
$language_text['_partners_add_head'] = 'Neuen Partnerbutton hinzuf&uuml;gen';
$language_text['_partners_edit_head'] = 'Partnerbutton editieren';
$language_text['_partners_added'] = 'Der Partnerbutton wurde erfolgreich hinzugef&uuml;gt!';
$language_text['_partners_edited'] = 'Der Partnerbutton wurde erfolgreich editiert!';
$language_text['_partners_deleted'] = 'Der Partnerbutton wurde erfolgreich gel&ouml;scht!';
$language_text['_clear_head'] = 'Datenbank aufr&auml;umen';
$language_text['_clear_news'] = 'Newseintr&auml;ge mit einbeziehen?';
$language_text['_clear_forum'] = 'Forumeintr&auml;ge mit einbeziehen?';
$language_text['_clear_forum_info'] = 'Forumeintr&auml;ge, die als <span class="fontWichtig">wichtig</span> markiert sind werden nicht gel&ouml;scht!';
$language_text['_clear_misc'] = 'Sonstiges mit einbeziehen (empfohlen)?';
$language_text['_clear_days'] = 'Eintr&auml;ge l&ouml;schen, die &auml;lter sind als';
$language_text['_clear_what'] = 'Tage';
$language_text['_clear_deleted'] = 'Es wurden {$deleted} Eintr&auml;ge gel&ouml;scht!';
$language_text['_clear_error_days'] = 'Du musst die Tage angeben, ab wann etwas gel&ouml;scht werden soll!';
$language_text['_error_unregistered'] = 'Du musst registriert sein um diese Funktion Nutzen zu k&ouml;nnen!';
$language_text['_seiten'] = 'Seite:';
$language_text['_admin_artikel_add'] = '<a href="?admin=artikel&amp;do=add">Artikel hinzuf&uuml;gen</a>';
$language_text['_artikel_add'] = 'Artikel hinzuf&uuml;gen';
$language_text['_artikel_added'] = 'Der Artikel wurde erfolgreich hinzugef&uuml;gt';
$language_text['_artikel_edit'] = 'Artikel editieren';
$language_text['_artikel_edited'] = 'Der Artikel wurde erfolgreich editiert!';
$language_text['_artikel_deleted'] = 'Der Artikel wurde erfolgreich gel&ouml;scht!';
$language_text['_empty_artikel_title'] = 'Du musst einen Titel angeben!';
$language_text['_empty_artikel'] = 'Du musst einen Artikel angeben!';
$language_text['_admin_artikel'] = 'Admin: Artikel';
$language_text['_config_c_martikel'] = 'Artikel';
$language_text['_config_c_madminartikel'] = 'Artikel-Admin';
$language_text['_reg_artikel'] = 'Artikelkommentare';
$language_text['_on'] = 'eingeschaltet';
$language_text['_off'] = 'ausgeschaltet';
$language_text['_config_lreg'] = 'Men&uuml;: Last reg. User';
$language_text['_config_mailfrom'] = 'E-Mail Absender';
$language_text['_config_mailfrom_info'] = 'Diese Emailadresse wird bei versendeten Emails wie Newsletter, Registrierung, etc als Absender angezeigt!';

## Misc ##
$language_text['_error_have_to_be_logged'] = 'Du musst eingeloggt sein um diese Funktion Nutzen zu k&ouml;nnen!';
$language_text['_error_invalid_email'] = 'Du hast eine ung&uuml;ltige Emailadresse angegeben!';
$language_text['_error_invalid_url'] = 'Die angegebene Homepage ist nicht erreichbar!';
$language_text['_error_nick_exists'] = 'Der Nickname ist leider schon vergeben!';
$language_text['_error_user_exists'] = 'Der Loginname ist leider schon vergeben!';
$language_text['_error_passwords_dont_match'] = 'Die eingegebenen Passw&ouml;rter stimmen nicht &uuml;berein!';
$language_text['_error_email_exists'] = 'Die von dir angegebene EMailadresse wird schon von jemandem verwendet!';
$language_text['_info_edit_profile_done_pwd'] = 'Du hast dein Profil erfolgreich editiert!';
$language_text['_error_select_buddy'] = 'Du hast keinen User angegeben!';
$language_text['_error_buddy_self'] = 'Du kannst dich nicht selbst als Buddy adden!';
$language_text['_error_buddy_already_in'] = 'Der User steht schon in deiner Buddyliste!';
$language_text['_error_msg_self'] = 'Du kannst dir nicht selber eine Nachricht schreiben!';
$language_text['_error_back'] = 'zur&uuml;ck';
$language_text['_user_dont_exist'] = 'Der von dir angegebene User existiert nicht!';
$language_text['_error_fwd'] = 'weiter';
$language_text['_error_wrong_permissions'] = 'Du hast nicht die erforderlichen Rechte um diese Aktion durchzuf&uuml;hren!';
$language_text['_error_flood_post'] = 'Du kannst nur alle {$sek} Sekunden einen neuen Eintrag schreiben!';
$language_text['_empty_titel'] = 'Du musst einen Titel angeben!';
$language_text['_empty_eintrag'] = 'Du musst einen Beitrag schreiben!';
$language_text['_empty_nick'] = 'Du musst deinen Nick angeben!';
$language_text['_empty_email'] = 'Du musst eine E-Mailadresse angeben!';
$language_text['_empty_user'] = 'Du musst einen Loginnamen angeben!';
$language_text['_empty_to'] = 'Du musst einen Empf&auml;nger  angeben!';
$language_text['_empty_url'] = 'Du musst eine URL angeben!';
$language_text['_empty_datum'] = 'Du musst ein Datum angeben!';
$language_text['_site_sponsor'] = 'Sponsoren';
$language_text['_site_user'] = 'User';
$language_text['_site_online'] = 'Besucher online';
$language_text['_site_member'] = 'Member';
$language_text['_site_forum'] = 'Forum';
$language_text['_site_links'] = 'Links';
$language_text['_site_dl'] = 'Downloads';
$language_text['_site_news'] = 'News';
$language_text['_site_upload'] = 'Upload';
$language_text['_site_ulist'] = 'Userliste';
$language_text['_site_msg'] = 'Nachrichten';
$language_text['_site_reg'] = 'Registrierung';
$language_text['_site_user_login'] = 'Login';
$language_text['_site_user_lostpwd'] = 'Lostpwd';
$language_text['_site_user_logout'] = 'Logout';
$language_text['_site_artikel'] = 'Artikel';
$language_text['_site_user_lobby'] = 'Userlobby';
$language_text['_site_user_profil'] = 'Userprofil';
$language_text['_site_user_editprofil'] = 'Profil editieren';
$language_text['_site_user_buddys'] = 'Buddies';
$language_text['_site_impressum'] = 'Impressum';
$language_text['_site_votes'] = 'Umfragen';
$language_text['_site_config'] = 'Adminbereich';
$language_text['_login'] = 'Login';
$language_text['_register'] = 'registrieren';
$language_text['_userlist'] = 'Userliste';
$language_text['_news'] = 'News';
$language_text['_newsarchiv'] = 'Newsarchiv';
$language_text['_links'] = 'Links';
$language_text['_impressum'] = 'Impressum';
$language_text['_contact'] = 'Kontakt';
$language_text['_artikel'] = 'Artikel';
$language_text['_dl'] = 'Downloads';
$language_text['_votes'] = 'Umfragen';
$language_text['_forum'] = 'Forum';
$language_text['_squads'] = 'Teams';
$language_text['_editprofil'] = 'Profil editieren';
$language_text['_logout'] = 'Logout';
$language_text['_msg'] = 'Nachrichten';
$language_text['_lobby'] = 'Lobby';
$language_text['_buddys'] = 'Buddies';
$language_text['_admin_config'] = 'Admin';
$language_text['_head_online'] = 'Online';
$language_text['_head_visits'] = 'Besucher';
$language_text['_head_max'] = 'Max.';
$language_text['_cnt_user'] = 'User';
$language_text['_cnt_guests'] = 'G&auml;ste';
$language_text['_cnt_today'] = 'Heute';
$language_text['_cnt_yesterday'] = 'Gestern';
$language_text['_cnt_online'] = 'Online';
$language_text['_cnt_all'] = 'Gesamt';
$language_text['_cnt_pperday'] = '&oslash; Tag';
$language_text['_cnt_perday'] = 'pro Tag';
$language_text['_show'] = 'Anzeigen';
$language_text['_dont_show'] = 'Nicht anzeigen';
$language_text['_status'] = 'Status';
$language_text['_position'] = 'Position';
$language_text['_kind'] = 'Art';
$language_text['_cnt'] = '#';
$language_text['_pwd'] = 'Passwort';
$language_text['_loginname'] = 'Login-Name';
$language_text['_email'] = 'E-Mail';
$language_text['_hp'] = 'Homepage';
$language_text['_member'] = 'Member';
$language_text['_user'] = 'User';
$language_text['_gast'] = 'unregistriert';
$language_text['_nothing'] = '<option value="lazy" class="dropdownKat">- nichts &auml;ndern -</option>';
$language_text['_pn'] = 'Nachricht';
$language_text['_nick'] = 'Nick';
$language_text['_info'] = 'Info';
$language_text['_error'] = 'Fehler';
$language_text['_datum'] = 'Datum';
$language_text['_legende'] = 'Legende';
$language_text['_link'] = 'Link';
$language_text['_linkname'] = 'Linkname';
$language_text['_url'] = 'URL';
$language_text['_admin'] = 'Admin';
$language_text['_hits'] = 'Zugriffe';
$language_text['_hit'] = 'Zugriff';
$language_text['_autor'] = 'Autor';
$language_text['_yes'] = 'Ja';
$language_text['_no'] = 'Nein';
$language_text['_maybe'] = 'Vielleicht';
$language_text['_beschreibung'] = 'Beschreibung';
$language_text['_admin_user_get_identy'] = 'Du hast erfolgreich die Identit&auml;t von {$nick} angenommen!';
$language_text['_comment_added'] = 'Dein Kommentar wurde erfolgreich gespeichert!';
$language_text['_comment_deleted'] = 'Der Kommentar wurde erfolgreich gel&ouml;scht!';
$language_text['_stichwort'] = 'Stichwort';
$language_text['_eintragen_titel'] = 'Eintragen';
$language_text['_titel'] = 'Titel';
$language_text['_answer'] = 'Antwort';
$language_text['_eintrag'] = 'Eintrag';
$language_text['_weiter'] = 'weiter';
$language_text['_site_msg_new'] = 'Du hast neue Nachrichten!<br /> Klicke <a href="../user/?action=msg">hier</a> um ins Nachrichtenmenu zu gelangen!';
$language_text['_site_kalender'] = 'Kalender';
$language_text['_login_permanent'] = ' Autologin';
$language_text['_msg_del'] = 'markierte l&ouml;schen';
$language_text['_wartungsmodus'] = 'Die Webseite ist momentan wegen Wartungsarbeiten geschlossen!<br />
Bitte versuche es in ein paar Minuten erneut!';
$language_text['_wartungsmodus_head'] = 'Wartungsmodus';
$language_text['_kalender'] = 'Kalender';
$language_text['_config_tmpdir'] = 'Standardtemplate';
$language_text['_navi_info'] = 'Alle in "_" eingebetteten Linknamen (wie _admin_) sind Platzhalter, die f&uuml;r die jeweiligen &Uuml;bersetzungen ben&ouml;tigt werden!';
$language_text['_member_admin_intnews'] = 'Interne News sehen';
$language_text['_news_admin_intern'] = 'interne News?';
$language_text['_news_sticky'] = '<span class="fontWichtig">Angeheftet:</span>';
$language_text['_news_get_sticky'] = 'News anheften?';
$language_text['_news_sticky_till'] = 'bis zum:';
$language_text['_forum_lp_head'] = 'Letzter Forenpost';
$language_text['_forum_previews'] = 'Vorschau';
$language_text['_error_unregistered_nc'] = 'Du musst registriert sein um einen Kommentar schreiben zu k&ouml;nnen!';
$language_text['_upload_partners_head'] = 'Partnerbuttons';
$language_text['_upload_partners_info'] = 'Nur jpg, gif oder png Dateien. Empfohlene Gr&ouml;e: 88px * 31px';
