<?php

/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 12.03.2017
 * Time: 11:23
 */
class dzcp_event
{
    public $event = NULL;
    public $json_array = array();
    public $contenttype = NULL;
    private $get = NULL;

    function __construct()
    {
        $this->get = $_GET;
        $this->event = '';
        $this->contenttype = 'json';
        if(GUMP::is_valid($this->get, array('input' => 'required|valid_json_string')) === true) {
            $this->json_array = json_decode($this->get['input'],true);
            if(GUMP::is_valid($this->json_array, array('event' => 'required|alpha')) === true) {
                $this->event = strtolower(trim($this->json_array['event']));
            }

            //ContentType XML,JSON OR JSONP for Javascript
            if(GUMP::is_valid($this->json_array, array('type' => 'required|alpha')) === true) {
                switch ($this->json_array['type']) {
                    case 'xml':
                        $this->contenttype = 'xml';
                        break;
                    case 'jsonp':
                        $this->contenttype = 'jsonp';
                        break;
                    default:
                        $this->contenttype = 'json';
                        break;
                }
            }
        }
    }

    function getEvent() {
        return $this->event;
    }

    function getContentType() {
        header('Cache-Control: no-store, no-cache, must-revalidate' );
        header('Cache-Control: post-check=0, pre-check=0', false );
        header('Pragma: no-cache' );
        header("Expires: ".gmdate("D, d M Y H:i:s", time()-1)." GMT");
        switch ($this->contenttype) {
            case 'xml':
                header('Content-Type: application/xml');
            case 'jsonp':
                header('Content-Type: application/javascript');
            default:
                header('Content-Type: application/json');
        }
    }
}