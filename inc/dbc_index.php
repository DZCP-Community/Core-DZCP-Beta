<?php
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