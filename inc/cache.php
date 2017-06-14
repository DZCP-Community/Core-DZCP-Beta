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

use phpFastCache\CacheManager;
use phpFastCache\Util;

class Cache extends CacheManager
{
    //Public Indexes
    const SETTINGS = 'dzcp_mem_settings';
    const PERMISSIONS = 'dzcp_permissions';
    const USR_HASH = 'dzcp_usr_hash';

    private $cache_index = null;

    function __construct() {
        Util\Languages::setEncoding("UTF-8");

        $this->cache_index['file'] = null;
        $this->cache_index['memory'] = null;
        $this->cache_index['net'] = null;

        //File Cache
        if(extension_loaded('Zend Data Cache') && function_exists('zend_disk_cache_store')) { //Zend Server
            $this->cache_index['file'] = self::getInstance('zenddisk');
        } else {
            $this->cache_index['file'] = self::getInstance('files',array("path" => basePath.'/inc/_cache_'));
        }

        //Memory Cache
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            if(extension_loaded('Zend Data Cache') && function_exists('zend_shm_cache_store')) { //Zend Server
                $this->cache_index['memory'] = self::getInstance('zendshm');
            } else if(extension_loaded('wincache') && function_exists('wincache_ucache_set')) {
                $this->cache_index['memory'] = self::getInstance('wincache');
            } else if(extension_loaded('apcu') && ini_get('apc.enabled')) {
                $this->cache_index['memory'] = self::getInstance('apcu');
            } else if(extension_loaded('apc') && ini_get('apc.enabled') && strpos(PHP_SAPI, 'CGI') === false) {
                $this->cache_index['memory'] = self::getInstance('apc');
            } else if(extension_loaded('xcache') && function_exists('xcache_get')) {
                $this->cache_index['memory'] = self::getInstance('xcache');
            } else {
                $this->cache_index['memory'] = null;
            }
        } else {
            if(extension_loaded('Zend Data Cache') && function_exists('zend_shm_cache_store')) { //Zend Server
                $this->cache_index['memory'] = self::getInstance('zendshm');
            } else if(extension_loaded('apcu') && ini_get('apc.enabled')) {
                $this->cache_index['memory'] = self::getInstance('apcu');
            } else if(extension_loaded('apc') && ini_get('apc.enabled') && strpos(PHP_SAPI, 'CGI') === false) {
                $this->cache_index['memory'] = self::getInstance('apc');
            } else if(extension_loaded('xcache') && function_exists('xcache_get')) {
                $this->cache_index['memory'] = self::getInstance('xcache');
            } else {
                $this->cache_index['memory'] = null;
            }
        }

        //Network Memory Cache (NetCache)
            if(config::$use_network_cache) {
                if(config::is_memcache && function_exists('memcache_connect')) {
                    $this->cache_index['net'] = self::getInstance('memcache',array('memcache' => array(config::$memcache_host, config::$memcache_port, 1)));
                } else if(config::$is_memcache && class_exists('Memcached')) {
                    $this->cache_index['net'] = self::getInstance('memcached',array('memcache' => array(config::$memcache_host, config::$memcache_port, 1)));
                } else if(config::$is_redis && class_exists('Redis')) {
                    $this->cache_index['net'] = self::getInstance('redis',array('redis' => array('host' => config::$redis_host,
                                                                                                 'port' => config::$redis_port,
                                                                                                 'password' => config::$redis_password,
                                                                                                 'database' => config::$redis_database,
                                                                                                 'timeout' => config::$redis_timeout)));
                } else if(config::$is_redis && class_exists("\\Predis\\Client")) {
                    $this->cache_index['net'] = self::getInstance('predis',array('redis' => array('host' => config::$redis_host,
                                                                                        'port' => config::$redis_port,
                                                                                        'password' => config::$redis_password,
                                                                                        'database' => config::$redis_database,
                                                                                        'timeout' => config::$redis_timeout)));
                }
            }
    }

    private function Get($type,$key) {
        if($this->cache_index[$type] != null) {
            $CachedItem = $this->cache_index[$type]->getItem($key);
            return $CachedItem->get($key);
        }

        return false;
    }

    private function Exists($type,$key) {
        if($this->cache_index[$type] != null) {
            $CachedItem = $this->cache_index[$type]->getItem($key);
            return !is_null($CachedItem->get($key));
        }

        return false;
    }

    private function Set($type,$key,$var,$ttl=600) {
        if($this->cache_index[$type] != null) {
            $CachedItem = $this->cache_index[$type]->getItem($key);
            $CachedItem->set($var)->expiresAfter($ttl);
            return $this->cache_index[$type]->save($CachedItem);
        }

        return false;
    }

    private function Delete($type,$key) {
        if($this->cache_index[$type] != null) {
            return $this->cache_index[$type]->delete($key);
        }

        return false;
    }

    //Public
    public function FileGet($key) {
        return $this->Get('file',$key);
    }

    public function FileExists($key) {
        return $this->Exists('file',$key);
    }

    public function FileSet($key,$var,$ttl=600) {
        return $this->Set('file',$key,$var,$ttl);
    }

    public function FileDelete($key) {
        return $this->Delete('file',$key);
    }

    public function MemGet($key) {
        return $this->Get('memory',$key);
    }

    public function MemExists($key) {
        return $this->Exists('memory',$key);
    }

    public function MemSet($key,$var,$ttl=600) {
        return $this->Set('memory',$key,$var,$ttl);
    }

    public function MemDelete($key) {
        return $this->Delete('memory',$key);
    }

    public function NetGet($key) {
        return $this->Get('net',$key);
    }

    public function NetExists($key) {
        return $this->Exists('net',$key);
    }

    public function NetSet($key,$var,$ttl=600) {
        return $this->Set('net',$key,$var,$ttl);
    }

    public function NetDelete($key) {
        return $this->Delete('net',$key);
    }

    public function AutoMemGet($key) {
        if($this->cache_index['net'] != null) {
            return $this->Get('net',$key);
        }

        return $this->Get('memory',$key);
    }

    public function AutoMemExists($key) {
        if($this->cache_index['net'] != null) {
            return $this->Exists('net', $key);
        }

        return $this->Exists('memory', $key);
    }

    public function AutoMemSet($key,$var,$ttl=600) {
        if($this->cache_index['net'] != null) {
            return $this->Set('net',$key,$var,$ttl);
        }

        return $this->Set('memory',$key,$var,$ttl);
    }

    public function AutoDelete($key) {
        if($this->cache_index['net'] != null) {
            return $this->Delete('net', $key);
        }

        return $this->Delete('memory', $key);
    }
}