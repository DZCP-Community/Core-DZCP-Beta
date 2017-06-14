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

/* block attempts to directly run this script */
if (getcwd() == dirname(__FILE__)) {
    die('block directly run');
}

//-> Speichert Ruckgaben der MySQL Datenbank zwischen um SQL-Queries einzusparen
final class dbc_index {
    private static $index = array();

    public static final function setIndex($index_key,$data,$time=2) {
        if (show_dbc_debug) {
            DebugConsole::insert_info('dbc_index::setIndex()', 'Set index: "' . $index_key . '"');
        }

        self::$index[$index_key] = $data;
    }

    public static final function getIndex($index_key) {
        if (!self::issetIndex($index_key)) {
            return false;
        }

        if (show_dbc_debug) {
            DebugConsole::insert_info('dbc_index::getIndex()', 'Get full index: "' . $index_key . '"');
        }

        return self::$index[$index_key];
    }

    public static final function getIndexKey($index_key,$key) {
        if (!self::issetIndex($index_key)) {
            return false;
        }

        $data = self::$index[$index_key];
        if (empty($data) || !array_key_exists($key, $data)) {
            return false;
        }

        if (show_dbc_debug) {
            DebugConsole::insert_info('dbc_index::getIndexKey()', 'Get from index: "' . $index_key . '" get key: "' . $key . '"');
        }

        return $data[$key];
    }

    public static final function issetIndex($index_key) {
        if(array_key_exists($index_key, self::$index)) {
            return true;
        }

        return false;
    }
}