<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 01.04.2017
 * Time: 22:43
 */

//-> Codiert Text zur Speicherung
final class stringParser {
    /**
     * Codiert Text in das UTF8 Charset.
     *
     * @param string $txt
     */
    public static function encode($txt='',$htmlentities=true) {
        return utf8_encode(stripcslashes(($htmlentities ? htmlentities($txt, ENT_COMPAT, 'UTF-8') : $txt)));
    }

    /**
     * Decodiert UTF8 Text in das aktuelle Charset der Seite.
     *
     * @param utf8 string $txt
     */
    public static function decode($txt='') {
        return trim(stripslashes(html_entity_decode(utf8_decode($txt), ENT_COMPAT, 'UTF-8')));
    }
}