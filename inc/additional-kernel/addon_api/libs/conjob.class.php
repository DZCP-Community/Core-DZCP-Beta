<?php

/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 05.05.2017
 * Time: 22:29
 */
//Run by ZendServer @ 30 Min
class conjob
{
    private $version = null;

    function __construct()
    {
        $this->version = new dzcp_version();
    }

    function run()
    {
        $this->version->runUpdate();
    }

    function getOutput() {
        return true;
    }
}