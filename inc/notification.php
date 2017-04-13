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

//-> Generiert die Infobox bei Fehlern oder Erfolg etc. / neuer Ersatz fur function info() & error()
class notification {
    static private $notification_index = array();
    static private $notification_global = true;
    static private $notification_success = false;

    public static function add_error($msg = '', $link = false, $time = 3) {
        self::$notification_success = false;
        return self::import('error', $msg, $link, $time);
    }

    public static function add_success($msg = '', $link = false, $time = 3) {
        self::$notification_success = true;
        return self::import('success', $msg, $link, $time);
    }

    public static function add_notice($msg = '', $link = false, $time = 3) {
        return self::import('notice', $msg, $link, $time);
    }

    public static function add_warning($msg = '', $link = false, $time = 3) {
        return self::import('warning', $msg, $link, $time);
    }

    public static function add_custom($status = 'custom', $msg = '', $link = false, $time = 3) {
        return self::import($status, $msg, $link, $time);
    }

    public static function get($input=false) {
        $notification = '';
        if(!empty($input)) {
            if($input['link']) {
                $input['link'] = '<script language="javascript" type="text/javascript">window.setTimeout("DZCP.goTo(\''.$input['link'].'\');", '.($input['time']*1000).');</script>'
                    . '<noscript><meta http-equiv="refresh" content="'.$input['time'].';url='.$input['link'].'"></noscript>';
            } else { $input['link'] = ''; } unset($input['time']);

            $input['status_msg'] = (defined('_notification_'.$input['status']) ? constant('_notification_'.$input['status']) : $input['status']);
            return show("page/notification_box",$input);
        }

        if(count(self::$notification_index) >= 1) {
            foreach (self::$notification_index as $data) {
                if($data['link']) {
                    $data['link'] = '<script language="javascript" type="text/javascript">window.setTimeout("DZCP.goTo(\''.$data['link'].'\');", '.($data['time']*1000).');</script>'
                        . '<noscript><meta http-equiv="refresh" content="'.$data['time'].';url='.$data['link'].'"></noscript>';
                } else { $data['link'] = ''; } unset($data['time']);
                $data['status_msg'] = (defined('_notification_'.$data['status']) ? constant('_notification_'.$data['status']) : $data['status']);
                $notification .= show("page/notification_box",$data);
            }
        }

        return $notification;
    }

    public static function has() {
        return (count(self::$notification_index) >= 1);
    }

    public static function is_success() {
        return self::$notification_success;
    }

    public static function get_tr($input=false) {
        $notification = self::get($input);
        return (!empty($notification) ? '<tr><td class="contentMainFirst" colspan="2" align="center">'.$notification.'</td></tr>' : '');
    }

    public static function set_global($global = true) {
        self::$notification_global = $global;
    }

    //Private
    private static function import($status, $msg, $link, $time) {
        $data = array('status' => strtolower($status), 'msg' => $msg, 'link' => $link, 'time' => $time);
        if(self::$notification_global) {
            self::$notification_index[] = $data;
        }

        return $data;
    }
}