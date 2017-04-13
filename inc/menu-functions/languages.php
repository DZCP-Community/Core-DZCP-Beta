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

/**
 * Sprachdateien auflisten
 * @return string/html
 **/
function languages() {
    $lang="";
    $files = common::get_files(basePath.'/inc/lang/languages/',false,true,array('php'));
    for($i=0;$i<=count($files)-1;$i++) {
        $file = str_replace('.php','',$files[$i]);
        $upFile = strtoupper(substr($file,0,1)).substr($file,1);
        if(file_exists('../inc/lang/flaggen/'.$file.'.gif'))
            $lang .= '<a href="?set_language='.$file.'"><img src="../inc/lang/flaggen/'.$file.'.gif" alt="'.$upFile.'" title="'.$upFile.'" class="icon" /></a> ';
    }

    return $lang;
}