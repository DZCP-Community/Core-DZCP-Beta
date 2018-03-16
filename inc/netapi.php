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
    var $file_db;
    var $api_version;

    public function __construct()
    {
        $this->debug = true;
        $this->error = '';
        $this->api_version = '0.1';

        // Create (connect to) SQLite database in file
        $create = false;
        if(!file_exists(basePath.'/inc/netapi.sqlite3')) {
            $create = true;
        }

        try {
            $this->file_db = new PDO('sqlite:'.basePath.'/inc/netapi.sqlite3');
            // Set errormode to exceptions
            $this->file_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            // Create table messages
            if($create) {
                $this->file_db->exec("CREATE TABLE IF NOT EXISTS `sessions` (id INTEGER PRIMARY KEY, ssid TEXT, cipher TEXT, aeskey TEXT, time INTEGER);");
                $this->file_db->exec('INSERT INTO sessions (`id`, `ssid`, `cipher`, `aeskey`, `time`) VALUES (1, \'\', \'\', '.time().');');
            }
        } catch(PDOException $e) {
            // Print PDOException message
            echo $e->getMessage();
        }

        echo '<pre>';
        var_dump($this->version());
        exit();

        /*
        echo '<pre>';
        var_dump($this->call(['event'=>'test']));
        echo '<p>';
        var_dump($this->data);
        exit();
        */
    }

    /*
 * https://api.dzcp.de/?event=handshake
 * string(427) "{"api_version":"0.1","ssid":"afa0a8a6497aca29b827503662bb3344",
 * "cipher":"5CandeUm2lHZ3o2hspBFww==",
 * "aeskey":"9Ng8Qe7Xw0Eh0Nt0Eo1Bh6Sy1Fv2Te6Ts8Pj0Kg9Kk2My9Od5Rf7Ix7Ld5Rx7Hq5Eg8Gr1Eb5Kn4Jc6Xu8Sc7Lo8Bf7Vn3Js6Fy2Id3Xn8Jx9Zu7Vm8Oy4Ka6Ev1Of8Fk7Mt9Wq4Ta3Ta1Nv6Kk5Vu5Lz4Pn6Ls0Ff7Dc4Ov4Xp4Ac3Qm7Fh5Ut4Fi0Vt7Vy9Qb0Bq8Nn4Zo5Ie0Ak3Nf1Zk4Zf1Sb1Rs2Tt8Qh3Ch8Sp0Uq4Dd6Gd1Rd3Ww4Zn1",
 * "error":false}[hash]c9661752d5c236a217eda5fa24a516b80856b463"
 */
    public function handshake() {
        $input = ['event'=>'handshake'];
        $handshake = $this->run($input,false);

        if((int)str_replace('.','',$handshake['api_version']) >= (int)str_replace('.','',$this->api_version)) {



            $this->file_db->exec('UPDATE `sessions` SET `cipher` = \''.
                $handshake['api_version'].'\', `aeskey` = \''.
                $handshake['api_version'].'\', `time` = \''.time().'\' WHERE `id` = 1;');
        }


        var_dump($handshake);
        die();

        $this->file_db->exec('UPDATE `sessions` SET `cipher` = \'\', `aeskey` = \'\', `time` = \'\' WHERE `id` = 1;');

    }

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
    private final function call(array $options,string $session_id = '') {
        if(!count($options) || !array_key_exists('event',$options))
            return false;

        $session = !empty($session_id) ? ['Session:'.$session_id] : false;
        $stream = self::get_external_contents('https://api.dzcp.de',$options,$session);
        if($stream === false || empty($stream)) //Null Check
            return false;

        unset($session,$session_id,$options);

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
        unset($api_data);

        return true;
    }
}