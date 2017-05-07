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
$where = $where.': '._config_global_head;

if($_POST) {
    if(settings::changed(($key='upicsize'),($var=intval($_POST['m_upicsize'])))) settings::set($key,$var);
    if(settings::changed(($key='m_artikel'),($var=intval($_POST['m_artikel'])))) settings::set($key,$var);
    if(settings::changed(($key='m_adminartikel'),($var=intval($_POST['m_adminartikel'])))) settings::set($key,$var);
    if(settings::changed(($key='allowhover'),($var=intval($_POST['ahover'])))) settings::set($key,$var);
    if(settings::changed(($key='securelogin'),($var=intval($_POST['securelogin'])))) settings::set($key,$var);
    if(settings::changed(($key='m_userlist'),($var=intval($_POST['m_userlist'])))) settings::set($key,$var);
    if(settings::changed(($key='m_adminnews'),($var=intval($_POST['m_adminnews'])))) settings::set($key,$var);
    if(settings::changed(($key='m_fthreads'),($var=intval($_POST['m_fthreads'])))) settings::set($key,$var);
    if(settings::changed(($key='m_fposts'),($var=intval($_POST['m_fposts'])))) settings::set($key,$var);
    if(settings::changed(($key='m_news'),($var=intval($_POST['m_news'])))) settings::set($key,$var);
    if(settings::changed(($key='m_comments'),($var=intval($_POST['m_comments'])))) settings::set($key,$var);
    if(settings::changed(($key='m_archivnews'),($var=intval($_POST['m_archivnews'])))) settings::set($key,$var);
    if(settings::changed(($key='maxwidth'),($var=intval($_POST['maxwidth'])))) settings::set($key,$var);
    if(settings::changed(($key='f_forum'),($var=intval($_POST['f_forum'])))) settings::set($key,$var);
    if(settings::changed(($key='f_artikelcom'),($var=intval($_POST['f_artikelcom'])))) settings::set($key,$var);
    if(settings::changed(($key='f_newscom'),($var=intval($_POST['f_newscom'])))) settings::set($key,$var);
    if(settings::changed(($key='l_newsadmin'),($var=intval($_POST['l_newsadmin'])))) settings::set($key,$var);
    if(settings::changed(($key='l_newsarchiv'),($var=intval($_POST['l_newsarchiv'])))) settings::set($key,$var);
    if(settings::changed(($key='l_forumtopic'),($var=intval($_POST['l_forumtopic'])))) settings::set($key,$var);
    if(settings::changed(($key='l_forumsubtopic'),($var=intval($_POST['l_forumsubtopic'])))) settings::set($key,$var);
    if(settings::changed(($key='m_lnews'),($var=intval($_POST['m_lnews'])))) settings::set($key,$var);
    if(settings::changed(($key='m_lartikel'),($var=intval($_POST['m_lartikel'])))) settings::set($key,$var);
    if(settings::changed(($key='m_events'),($var=intval($_POST['m_events'])))) settings::set($key,$var);
    if(settings::changed(($key='m_topdl'),($var=intval($_POST['m_topdl'])))) settings::set($key,$var);
    if(settings::changed(($key='m_ftopics'),($var=intval($_POST['m_ftopics'])))) settings::set($key,$var);
    if(settings::changed(($key='m_lreg'),($var=intval($_POST['m_lreg'])))) settings::set($key,$var);
    if(settings::changed(($key='l_topdl'),($var=intval($_POST['l_topdl'])))) settings::set($key,$var);
    if(settings::changed(($key='l_ftopics'),($var=intval($_POST['l_ftopics'])))) settings::set($key,$var);
    if(settings::changed(($key='l_lreg'),($var=intval($_POST['l_lreg'])))) settings::set($key,$var);
    if(settings::changed(($key='l_lnews'),($var=intval($_POST['l_lnews'])))) settings::set($key,$var);
    if(settings::changed(($key='l_lartikel'),($var=intval($_POST['l_lartikel'])))) settings::set($key,$var);
    if(settings::changed(($key='direct_refresh'),($var=intval($_POST['direct_refresh'])))) settings::set($key,$var);
    if(settings::changed(($key='news_feed'),($var=intval($_POST['feed'])))) settings::set($key,$var);
    if(settings::changed(($key='clanname'),($var=stringParser::encode($_POST['clanname'])))) settings::set($key,$var);
    if(settings::changed(($key='default_pwd_encoder'),($var=stringParser::encode($_POST['pwd_encoder'])))) settings::set($key,$var);
    if(settings::changed(($key='pagetitel'),($var=stringParser::encode($_POST['pagetitel'])))) settings::set($key,$var);
    if(settings::changed(($key='badwords'),($var=stringParser::encode($_POST['badwords'])))) settings::set($key,$var);
    if(settings::changed(($key='regcode'),($var=intval($_POST['regcode'])))) settings::set($key,$var);
    if(settings::changed(($key='forum_vote'),($var=intval($_POST['forum_vote'])))) settings::set($key,$var);
    if(settings::changed(($key='reg_forum'),($var=intval($_POST['reg_forum'])))) settings::set($key,$var);
    if(settings::changed(($key='reg_artikel'),($var=intval($_POST['reg_artikel'])))) settings::set($key,$var);
    if(settings::changed(($key='reg_newscomments'),($var=intval($_POST['reg_nc'])))) settings::set($key,$var);
    if(settings::changed(($key='reg_dl'),($var=intval($_POST['reg_dl'])))) settings::set($key,$var);
    if(settings::changed(($key='eml_reg_subj'),($var=stringParser::encode($_POST['eml_reg_subj'])))) settings::set($key,$var);
    if(settings::changed(($key='eml_pwd_subj'),($var=stringParser::encode($_POST['eml_pwd_subj'])))) settings::set($key,$var);
    if(settings::changed(($key='eml_nletter_subj'),($var=stringParser::encode($_POST['eml_nletter_subj'])))) settings::set($key,$var);
    if(settings::changed(($key='eml_pn_subj'),($var=stringParser::encode($_POST['eml_pn_subj'])))) settings::set($key,$var);
    if(settings::changed(($key='double_post'),($var=intval($_POST['double_post'])))) settings::set($key,$var);
    if(settings::changed(($key='eml_fabo_npost_subj'),($var=stringParser::encode($_POST['eml_fabo_npost_subj'])))) settings::set($key,$var);
    if(settings::changed(($key='eml_fabo_tedit_subj'),($var=stringParser::encode($_POST['eml_fabo_tedit_subj'])))) settings::set($key,$var);
    if(settings::changed(($key='eml_fabo_pedit_subj'),($var=stringParser::encode($_POST['eml_fabo_pedit_subj'])))) settings::set($key,$var);
    if(settings::changed(($key='eml_akl_regist_subj'),($var=stringParser::encode($_POST['eml_akl_regist_subj'])))) settings::set($key,$var);
    if(settings::changed(($key='eml_reg'),($var=stringParser::encode($_POST['eml_reg'])))) settings::set($key,$var);
    if(settings::changed(($key='eml_pwd'),($var=stringParser::encode($_POST['eml_pwd'])))) settings::set($key,$var);
    if(settings::changed(($key='eml_nletter'),($var=stringParser::encode($_POST['eml_nletter'])))) settings::set($key,$var);
    if(settings::changed(($key='eml_pn'),($var=stringParser::encode($_POST['eml_pn'])))) settings::set($key,$var);
    if(settings::changed(($key='eml_fabo_npost'),($var=stringParser::encode($_POST['eml_fabo_npost'])))) settings::set($key,$var);
    if(settings::changed(($key='eml_fabo_tedit'),($var=stringParser::encode($_POST['eml_fabo_tedit'])))) settings::set($key,$var);
    if(settings::changed(($key='eml_fabo_pedit'),($var=stringParser::encode($_POST['eml_fabo_pedit'])))) settings::set($key,$var);
    if(settings::changed(($key='eml_akl_register'),($var=stringParser::encode($_POST['eml_akl_register'])))) settings::set($key,$var);
    if(settings::changed(($key='mailfrom'),($var=stringParser::encode($_POST['mailfrom'])))) settings::set($key,$var);
    if(settings::changed(($key='tmpdir'),($var=stringParser::encode($_POST['tmpdir'])))) settings::set($key,$var);
    if(settings::changed(($key='wmodus'),($var=intval($_POST['wmodus'])))) settings::set($key,$var);
    if(settings::changed(($key='mail_extension'),($var=stringParser::encode($_POST['mail_extension'])))) settings::set($key,$var);
    if(settings::changed(($key='smtp_password'),($var=session::encode($_POST['smtp_pass'])))) settings::set($key,$var);
    if(settings::changed(($key='smtp_port'),($var=intval($_POST['smtp_port'])))) settings::set($key,$var);
    if(settings::changed(($key='smtp_hostname'),($var=stringParser::encode($_POST['smtp_host'])))) settings::set($key,$var);
    if(settings::changed(($key='smtp_username'),($var=stringParser::encode($_POST['smtp_username'])))) settings::set($key,$var);
    if(settings::changed(($key='smtp_tls_ssl'),($var=intval($_POST['smtp_tls_ssl'])))) settings::set($key,$var);
    if(settings::changed(($key='sendmail_path'),($var=stringParser::encode($_POST['sendmail_path'])))) settings::set($key,$var);
    if(settings::changed(($key='urls_linked'),($var=stringParser::encode($_POST['urls_linked'])))) settings::set($key,$var);
    if(settings::changed(($key='eml_lpwd_key'),($var=stringParser::encode($_POST['eml_lpwd'])))) settings::set($key,$var);
    if(settings::changed(($key='eml_lpwd_key_subj'),($var=stringParser::encode($_POST['eml_lpwd_subj'])))) settings::set($key,$var);
    if(settings::changed(($key='use_akl'),($var=intval($_POST['akl'])))) settings::set($key,$var);
    settings::load(true);
    notification::add_success(_config_set);
}

$files = common::get_files(basePath.'/inc/lang/languages/',false,true,array('php')); $lang = '';
foreach($files as $file) {
    $lng = preg_replace("#.php#", "",$file);
    $lang .= common::select_field($lng,(stringParser::decode(settings::get('language')) == $lng),$lng);

}
unset($files,$file,$lng,$sel);

$tmps = common::get_files(basePath.'/inc/_templates_/',true); $tmplsel = '';
foreach($tmps as $tmp) {
    $tmplsel .= common::select_field($tmp,(stringParser::decode(settings::get('tmpdir')) == $tmp),$tmp);
}
unset($tmps,$tmp,$selt);

$pwde_options = show('<option '.(!settings::get('default_pwd_encoder') ? 'selected="selected"' : '').' value="0">MD5 [lang_pwd_encoder_algorithm]</option>'
. '<option '.(settings::get('default_pwd_encoder') == 1 ? 'selected="selected"' : '').' value="1">SHA1 [lang_pwd_encoder_algorithm]</option>'
. '<option '.(settings::get('default_pwd_encoder') == 2 ? 'selected="selected"' : '').' value="2">SHA256 [lang_pwd_encoder_algorithm]</option>'
. '<option '.(settings::get('default_pwd_encoder') == 3 ? 'selected="selected"' : '').' value="3">SHA512 [lang_pwd_encoder_algorithm]</option>');

$mail_options = show('<option '.(settings::get('mail_extension') == 'mail' ? 'selected="selected"' : '').' value="mail">'._default.'</option>'
. '<option '.(settings::get('mail_extension') == 'sendmail' ? 'selected="selected"' : '').' value="sendmail">Sendmail</option>'
. '<option '.(settings::get('mail_extension') == 'smtp' ? 'selected="selected"' : '').' value="smtp">SMTP</option>');

$smtp_secure_options = show('<option '.(!settings::get('smtp_tls_ssl') ? 'selected="selected"' : '').' value="0">[lang_default]</option>'
. '<option '.(settings::get('smtp_tls_ssl') == 1 ? 'selected="selected"' : '').' value="1">TLS</option>'
. '<option '.(settings::get('smtp_tls_ssl') == 2 ? 'selected="selected"' : '').' value="2">SSL</option>');

$show = show($dir."/form_config", array( "main_info"             => _main_info,
                                         "badword_info"          => _admin_config_badword_info,
                                         "eml_info"              => _admin_eml_info,
                                         "reg_info"              => _admin_reg_info,
                                         "c_limits_what"         => _config_c_limits_what,
                                         "c_floods_what"         => _config_c_floods_what,
                                         "c_length_what"         => _config_c_length_what,
                                         "c_eml_reg_subj"        => stringParser::decode(settings::get('eml_reg_subj')),
                                         "c_eml_pwd_subj"        => stringParser::decode(settings::get('eml_pwd_subj')),
                                         "c_eml_nletter_subj"    => stringParser::decode(settings::get('eml_nletter_subj')),
                                         "c_eml_pn_subj"         => stringParser::decode(settings::get('eml_pn_subj')),
                                         "c_eml_fabo_npost_subj" => stringParser::decode(settings::get('eml_fabo_npost_subj')),
                                         "c_eml_fabo_tedit_subj" => stringParser::decode(settings::get('eml_fabo_tedit_subj')),
                                         "c_eml_fabo_pedit_subj" => stringParser::decode(settings::get('eml_fabo_pedit_subj')),
                                         "c_eml_akl_regist_subj" => stringParser::decode(settings::get('eml_akl_register_subj')),
                                         "c_eml_reg"             => stringParser::decode(settings::get('eml_reg')),
                                         "c_eml_pwd"             => stringParser::decode(settings::get('eml_pwd')),
                                         "c_eml_nletter"         => stringParser::decode(settings::get('eml_nletter')),
                                         "c_eml_pn"              => stringParser::decode(settings::get('eml_pn')),
                                         "c_eml_fabo_tedit"      => stringParser::decode(settings::get('eml_fabo_tedit')),
                                         "c_eml_fabo_pedit"      => stringParser::decode(settings::get('eml_fabo_pedit')),
                                         "c_eml_fabo_nposr"      => stringParser::decode(settings::get('eml_fabo_npost')),
                                         "c_eml_akl_register"    => stringParser::decode(settings::get('eml_akl_register')),
                                         "c_eml_lpwd_subj"       => stringParser::decode(settings::get('eml_lpwd_key_subj')),
                                         "c_eml_lpwd"            => stringParser::decode(settings::get('eml_lpwd_key')),
                                         "memcache_host"         => stringParser::decode(settings::get('memcache_host')),
                                         "memcache_port"         => intval(settings::get('memcache_port')),
                                         "tmplsel"               => $tmplsel,
                                         "maxwidth"              => intval(settings::get('maxwidth')),
                                         "mailfrom"              => stringParser::decode(settings::get('mailfrom')),
                                         "l_lreg"                => intval(settings::get('l_lreg')),
                                         "m_lreg"                => intval(settings::get('m_lreg')),
                                         "badwords"              => stringParser::decode(settings::get('badwords')),
                                         "regcode"               => intval(settings::get('regcode')),
                                         "m_lnews"               => intval(settings::get('m_lnews')),
                                         "m_lartikel"            => intval(settings::get('m_lartikel')),
                                         "m_ftopics"             => intval(settings::get('m_ftopics')),
                                         "m_events"              => intval(settings::get('m_events')),
                                         "m_topdl"               => intval(settings::get('m_topdl')),
                                         "m_userlist"            => intval(settings::get('m_userlist')),
                                         "m_adminnews"           => intval(settings::get('m_adminnews')),
                                         "m_comments"            => intval(settings::get('m_comments')),
                                         "m_archivnews"          => intval(settings::get('m_archivnews')),
                                         "m_fthreads"            => intval(settings::get('m_fthreads')),
                                         "m_fposts"              => intval(settings::get('m_fposts')),
                                         "m_news"                => intval(settings::get('m_news')),
                                         "m_upicsize"            => intval(settings::get('upicsize')),
                                         "f_forum"               => intval(settings::get('f_forum')),
                                         "f_newscom"             => intval(settings::get('f_newscom')),
                                         "m_artikel"             => intval(settings::get('m_artikel')),
                                         "m_adminartikel"        => intval(settings::get('m_adminartikel')),
                                         "c_wmodus"              => intval(settings::get('wmodus')),
                                         "l_newsadmin"           => intval(settings::get('l_newsadmin')),
                                         "l_newsarchiv"          => intval(settings::get('l_newsarchiv')),
                                         "l_forumtopic"          => intval(settings::get('l_forumtopic')),
                                         "l_forumsubtopic"       => intval(settings::get('l_forumsubtopic')),
                                         "l_topdl"               => intval(settings::get('l_topdl')),
                                         "l_ftopics"             => intval(settings::get('l_ftopics')),
                                         "l_lnews"               => intval(settings::get('l_lnews')),
                                         "l_lartikel"            => intval(settings::get('l_lartikel')),
                                         "f_artikelcom"          => intval(settings::get('f_artikelcom')),
                                         "clanname"              => stringParser::decode(settings::get('clanname')),
                                         "pagetitel"             => stringParser::decode(settings::get('pagetitel')),
                                         "smtp_host"             => stringParser::decode(settings::get('smtp_hostname')),
                                         "smtp_username"         => stringParser::decode(settings::get('smtp_username')),
                                         "smtp_pass"             => session::decode(settings::get('smtp_password')),
                                         "smtp_port"             => intval(settings::get('smtp_port')),
                                         "sendmail_path"         => stringParser::decode(settings::get('sendmail_path')),
                                         "smtp_tls_ssl"          => $smtp_secure_options,
                                         "lang"                  => $lang,
                                         "mail_ext_select"       => $mail_options,
                                         "sel_akl"               => (settings::get('use_akl') == 1 ? 'selected="selected"' : ''),
                                         "sel_akl_ad"            => (settings::get('use_akl') == 2 ? 'selected="selected"' : ''),
                                         "selyes"                => (settings::get('regcode') ? 'selected="selected"' : ''),
                                         "selno"                 => (!settings::get('regcode') ? 'selected="selected"' : ''),
                                         "selwm"                 => (settings::get('wmodus') ? 'selected="selected"' : ''),
                                         "sel_fv"                => (settings::get('forum_vote') ? 'selected="selected"' : ''),
                                         "sel_sl"                => (settings::get('securelogin') ? 'selected="selected"' : ''),
                                         "sel_dp"                => (settings::get('double_post') ? 'selected="selected"' : ''),
                                         "selr_nc"               => (settings::get('reg_newscomments') ? 'selected="selected"' : ''),
                                         "selr_forum"            => (settings::get('reg_forum') ? 'selected="selected"' : ''),
                                         "selr_dl"               => (settings::get('reg_dl') ? 'selected="selected"' : ''),
                                         "selr_artikel"          => (settings::get('reg_artikel') ? 'selected="selected"' : ''),
                                         "sel_url"               => (settings::get('urls_linked') ? 'selected="selected"' : ''),
                                         "selfeed"               => (settings::get('news_feed') ? 'selected="selected"' : ''),
                                         "sel_refresh"           => (settings::get('direct_refresh') ? ' selected="selected"' : ''),
                                         "pwde_options"          => $pwde_options));

$show = show($dir."/form", array("head" => _config_global_head, "what" => "config", "value" => _button_value_config, "show" => $show));