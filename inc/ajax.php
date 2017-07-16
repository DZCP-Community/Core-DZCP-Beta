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

## OUTPUT BUFFER START ##
if (!ob_start("ob_gzhandler")) ob_start();
define('basePath', dirname(dirname(__FILE__) . '../'));
define('is_ajax', true);

## INCLUDES ##
include(basePath . "/inc/common.php");

## SETTINGS ##
$dir = "sites";
header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + 3600));
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
$is_debug = isset($_GET['debug']);

## SECTIONS ##
$mod = isset($_GET['i']) ? $_GET['i'] : '';
if ($mod != 'securimage' && $mod != 'securimage_audio')
    header("Content-Type: text/html; charset=utf-8");

switch ($mod):
    case 'kalender':
        require_once(basePath . "/inc/menu-functions/function.kalender.php");
        $month = (isset($_GET['month']) ? $_GET['month'] : '');
        $year = (isset($_GET['year']) ? $_GET['year'] : '');
        echo smarty_function_kalender(['js' => false, 'month' => $month, 'year' => $year],
            new Smarty_Internal_Template('kalender', common::getSmarty(true)));
        break;
    case 'counter':
        require_once(basePath . "/inc/menu-functions/function.counter.php");
        echo smarty_function_counter(['js' => false],
            new Smarty_Internal_Template('counter', common::getSmarty(true)));
        break;
    case 'fileman':
        if(!isset($_GET['run'])) {
            $fileman = new fileman();
            $fileman->run();
        } else {
            $fileman = new fileman();
            $smarty = common::getSmarty(true);
            $smarty->caching = false;
            $smarty->assign('js_config','<script language="javascript" type="text/javascript">var json=\''.
                javascript::encode().'\',config=JSON&&JSON.parse(json)||$.parseJSON(json);</script>');
            exit($smarty->fetch('file:['.common::$tmpdir.']fileman/fileman.tpl'));
        }
        break;
    case 'conjob':
        $version = new dzcp_version(false);
        $version->runUpdate();
        break;
    case 'less':
        header('Content-type: text/css');
        exit(common::less());
        break;
    case 'securimage':
        if (!headers_sent()) {
            common::$securimage->background_directory = basePath . '/inc/images/securimage/background/';
            common::$securimage->code_length = mt_rand(4, 6);
            common::$securimage->image_height = isset($_GET['height']) ? (int)($_GET['height']) : 40;
            common::$securimage->image_width = isset($_GET['width']) ? (int)($_GET['width']) : 200;
            common::$securimage->perturbation = .75;
            common::$securimage->text_color = new Securimage_Color("#CA0000");
            common::$securimage->num_lines = isset($_GET['lines']) ? (int)($_GET['lines']) : 2;
            common::$securimage->namespace = isset($_GET['namespace']) ? $_GET['namespace'] : 'default';
            if (isset($_GET['length'])) common::$securimage->code_length = (int)($_GET['length']);

            $imgData = common::$securimage->show();
            if (!$imgData['error']) {
                if ($is_debug) {
                    echo '<img src="data:image/gif;base64,' . $imgData['data'] . '" />';
                } else {
                    echo 'data:image/gif;base64,' . $imgData['data'];
                }
            } else {
                echo $imgData;
            }
        }
        break;
    case 'securimage_audio':
        if (!headers_sent()) {
            common::$securimage->audio_path = basePath . '/inc/securimage/audio/en/';
            switch ($_SESSION['language']) {
                case 'deutsch':
                    if (file_exists(basePath . '/inc/securimage/audio/de/0.wav')) {
                        common::$securimage->audio_path = basePath . '/inc/securimage/audio/de/';
                    }
                    break;
                case 'english':
                    if (file_exists(basePath . '/inc/securimage/audio/en/0.wav')) {
                        common::$securimage->audio_path = basePath . '/inc/securimage/audio/en/';
                    }
                    break;
                default:
                    if (file_exists(basePath . '/inc/securimage/audio/' . $_SESSION['language'] . '/0.wav')) {
                        common::$securimage->audio_path = basePath . '/inc/securimage/audio/' . $_SESSION['language'] . '/';
                    }
                    break;
            }

            if (captcha_audio_use_sox) {
                common::$securimage->audio_use_sox = true;
                common::$securimage->audio_use_noise = captcha_audio_use_noise;
                common::$securimage->degrade_audio = captcha_degrade_audio;
                common::$securimage->sox_binary_path = captcha_sox_binary_path;
            } else {
                common::$securimage->audio_use_sox = false;
            }

            common::$securimage->namespace = isset($_GET['namespace']) ? $_GET['namespace'] : 'default';
            echo common::$securimage->outputAudioFile();
        }
        break;
endswitch;

if (debug_save_to_file) {
    DebugConsole::save_log(); //Debug save to file
}