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

final class cookie {
    private static $cname = "";
    private static $val = array();
    private static $expires;
    private static $dir = '/';
    private static $site = '';

    /**
    * Setzt die Werte fur ein Cookie und erstellt es.
    */
    public final static function init($cname, $cexpires=false, $cdir="", $csite="") {
        self::$cname=$cname;
        self::$expires = ($cexpires ? $cexpires : (time()+cookie_expires));
        self::$dir=(empty($cdir) ? '/' : cookie_dir);
        self::$site=(empty($csite) ? '' : cookie_domain);
        self::$val=array();
        self::extract();
    }

    /**
    * Extraktiert ein gespeichertes Cookie
    */
    public final static function extract($cname="") {
        $cname=(empty($cname) ? self::$cname : $cname);
        if(!empty($_COOKIE[$cname])) {
            $arr = unserialize($_COOKIE[$cname]);
            if($arr!==false && is_array($arr)) {
                foreach($arr as $var => $val)
                { $_COOKIE[$var]=$val; }
            }

            self::$val=$arr;
        }
    }

    /**
    * Liest und gibt einen Wert aus dem Cookie zuruck
    *
    * @return string
    */
    public final static function get($var) {
        if(!isset(self::$val) || empty(self::$val)) return false;
        if(!array_key_exists($var, self::$val)) return false;
        return self::$val[$var];
    }

    /**
    * Setzt ein neuen Key und Wert im Cookie
    */
    public final static function put($var, $value) {
        self::$val[$var]=$value;
        $_COOKIE[$var]=self::$val[$var];
        if(empty($value)) unset(self::$val[$var]);
    }

    /**
    * Leert das Cookie
    */
    public final static function clear()
    { self::$val=array(); self::save(); }

    /**
    * Loscht einen Wert aus dem Cookie
    */
    public final static function delete($var)
    { unset(self::$val[$var]); self::save(); }
    
    /**
    * Speichert das Cookie
    */
    public final static function save() {
        $cookie_val = (empty(self::$val) ? '' : serialize(self::$val));
        if(strlen($cookie_val)>4*1024)
            trigger_error("The cookie ".self::$cname." exceeds the specification for the maximum cookie size.  Some data may be lost", E_USER_WARNING);

        setcookie(self::$cname, $cookie_val, self::$expires, self::$dir, self::$site);
    }
}