<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */

ob_start();
ob_implicit_flush(false);
define('basePath', dirname(dirname(__FILE__).'../'));

function can_gzip() {
    if(is_api) return false;
    if(!buffer_gzip_compress) return false;
    if(headers_sent() || connection_aborted()) return false; 
    if(!function_exists('gzcompress')) return false;
    if(strpos(common::GetServerVars('HTTP_ACCEPT_ENCODING'), 'x-gzip') !== false) return true;
    if(strpos(common::GetServerVars('HTTP_ACCEPT_ENCODING'), 'sdch')   !== false) return true;
    if(strpos(common::GetServerVars('HTTP_ACCEPT_ENCODING'), 'gzip')   !== false) return true;
    return false;
}

function gz_output($output='') {
    if(can_gzip()) {
        ini_set('zlib.output_compression','Off');
        $gzip_compress_level = (!defined('buffer_gzip_compress_level') ? 4 : buffer_gzip_compress_level);
        $output = preg_replace('#\<!--.*?\-->#', '', $output); //Remove <!-- --> Tags
        $output .= "\r\n"."<!-- [GZIP => Level ".$gzip_compress_level."] ".
            sprintf("%01.2f",((strlen(gzencode(trim(preg_replace( '/\s+/', ' ', $output ) ), $gzip_compress_level)))/1024))." kBytes | uncompressed: ".
            sprintf("%01.2f",((strlen($output))/1024 ))." kBytes -->";
        $hmtl = gzencode(trim(preg_replace( '/\s+/', ' ', $output ) ), $gzip_compress_level);
        unset($output);
        header('Content-Encoding: gzip');
        header('content-type: text/html; charset: UTF-8');
        header('cache-control: must-revalidate');
        header('expires: '.gmdate("D, d M Y H:i:s", time() + 60 * 60) . " GMT" );
        header('Content-Length: '.strlen($hmtl));
        header('Vary: Accept-Encoding');
        exit($hmtl);
    } else {
        echo($output);
        ob_end_flush();
    }
}