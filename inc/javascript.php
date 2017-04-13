<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 01.04.2017
 * Time: 22:43
 */

//-> Verbertet wichtige Informationen zwischen JS und PHP
class javascript {
    private static $data_array = array();

    public static function set($key='',$var='') {
        self::$data_array[$key] = utf8_encode($var);
    }

    public static function remove($key='') {
        unset(self::$data_array[$key]);
    }

    public static function get($key='') {
        return utf8_decode(self::$data_array[$key]);
    }

    public static function encode() {
        return json_encode(self::$data_array);
    }
}