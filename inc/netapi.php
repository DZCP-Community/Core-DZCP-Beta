<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 15.03.2018
 * Time: 19:25
 */

define('_version', '1.6.0.4');
define('_release', '23.02.2018');
define('_build', '1604.03.00');
define('_edition', 'dev');

class dzcp_network_api extends common
{
    var $debug = false;
    var $data = [];
    var $error;
    var $api_version;
    var $session_id;

    public function __construct()
    {
        $this->debug = true;
        $this->error = '';
        $this->api_version = '0.1';
        $this->session_id = '';

        echo '<pre>';
        var_dump($this->handshake());
        var_dump($this->session_id);
        var_dump($this->news());
        exit();

    }

    public function test(bool $cache=false,int $cache_time=30) {
        return $this->run(['event'=>'test','text'=>'Halloooooo'],$cache,$cache_time);
    }


    public function test1(bool $cache=false,int $cache_time=30) {
        return $this->run(['event'=>'test1'],$cache,$cache_time);
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function handshake() {
        $input = ['event'=>'handshake'];
        $handshake = $this->run($input,false);
        if(!$handshake['error']) {
            if ((int)str_replace('.', '', $handshake['api_version']) >= (int)str_replace('.', '', $this->api_version)) {
                $this->session_id = $handshake['ssid'];
                return !empty($this->session_id);
            }
        }

        return false;
    }

    /**
     * @param bool $cache
     * @param int $cache_time
     * @return array
     * @throws Exception
     */
    public function news(bool $cache=false,int $cache_time=30) {
        $input = ['event'=>'news',
            'version'=>_version,
            'edition'=>_edition];
        return $this->run($input,$cache,$cache_time);
    }

    /**
     * @param bool $cache
     * @param int $cache_time
     * @return array
     * @throws Exception
     */
    public function version(bool $cache=false,int $cache_time=30) {
        $input = ['event'=>'version',
            'version'=>_version,
            'edition'=>_edition,
            'build'=>_build,
            'release'=>_release];
        return $this->run($input,$cache,$cache_time);
    }

    /**
     * @param array $data
     * @param bool $cache
     * @param int $cache_time
     * @return array
     * @throws Exception
     */
    private final function run(array $data=[],bool $cache=false,int $cache_time=30) {
        $input = ['type'=>'json'];
        $input = array_merge($input,$data);

        //In Cache
        $cache_hash = md5(serialize($input));
        if($cache && self::$cache->AutoExists($cache_hash)) {
            $item =  self::$cache->AutoGet($cache_hash);
            if(!empty($item))
                return array_merge(['error'=>false],unserialize($item));
        }

        //Get from API-Server
        if($this->call($input)) {
            if($cache) //Set to Cache
                self::$cache->AutoSet($cache_hash,serialize($this->data),$cache_time);

            return array_merge(['error'=>false],$this->data);
        }

        return array_merge(['error'=>true],[]);
    }

    /**
     * @param array $options
     * @param string $session_id
     * @return bool
     * @throws Exception
     */
    private final function call(array $options) {
        if(!count($options) || !array_key_exists('event',$options))
            return false;

        $stream = self::get_external_contents('https://api.dzcp.de',$options);
        if($stream === false || empty($stream)) //Null Check
            return false;

        unset($options);

        //Filter Data & Hash
        $stream = explode('[hash]',$stream); $api_data = [];
        foreach ($stream as $id => $data) {
            switch ($id) {
                case 0: //json data
                    $api_data['json'] = $data;
                case 1: //hash
                    $api_data['hash'] = $data;
            }
        } unset($stream);

        //Hash Check
        if($api_data['hash'] !== sha1($api_data['json']))
            return false;

        if(self::$gump->validate($api_data, ['json' => "required|valid_json_string"]) !== true) {
            $this->error = self::$gump->get_readable_errors(true);
            return false;
        }

        $api_data = self::$gump->filter($api_data, ['json' => 'trim|json_decode']);
        if(!is_object($api_data))
            $this->error = self::$gump->get_readable_errors(true);

        $this->data = (array)$api_data['json'];
        unset($api_data,$data,$key);
        return true;
    }
}