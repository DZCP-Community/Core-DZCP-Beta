<?php
/**
 * DZCP - deV!L`z ClanPortal 1.7.0
 * http://www.dzcp.de
 */

//api.php?input={"event":"version","dzcp":"1.6","edition":"stable","type":"xml"}

/**
 * Class dzcp_version
 * @property array cache_hash
 */
class dzcp_version extends dzcp_event
{
    private $version = NULL;
    private $dev_version = NULL;
    private $edition = NULL;
    private $cache_hash;

    /**
     * dzcp_version constructor.
     * @param bool $api
     */
    function __construct($api=true){
        if($api)
            parent::__construct();

        $this->version = '1.6';
        $this->dev_version = '1.7';
        $this->edition = 'stable';
    }

    /** @noinspection PhpInconsistentReturnPointsInspection */
    function getDevVersion() {
        $get = common::$sql['default']->fetch("SELECT `version`,`release` FROM `{prefix_addon_version}` WHERE `static_version` = ? AND `edition` = ?;",
            [$this->dev_version, 'dev']);
        if (common::$sql['default']->rowCount()) {
            return ['version' => stringParser::decode($get['version']),'release' => stringParser::decode($get['release'])];
        }

        return ['version' => '0.0','release' => '000000'];
    }

    /**
     * @return array
     */
    function getLiveVersion() {
        $get = common::$sql['default']->fetch("SELECT `version`,`release` FROM `{prefix_addon_version}` WHERE `static_version` = ? AND `edition` = ?;",
            [$this->version, 'stable']);
        if (common::$sql['default']->rowCount()) {
            return ['version' => stringParser::decode($get['version']),'release' => stringParser::decode($get['release'])];
        }

        return ['version' => '0.0','release' => '00000'];
    }

    function getVersion() {
        if(GUMP::is_valid($this->json_array, ['dzcp' => 'required']) === true) {
            if(count(($exp=explode('.',$this->json_array['dzcp']))) >= 4) {
                $this->json_array['dzcp'] = $exp[0].'.'.$exp[1];
            }

            $this->version = $this->json_array['dzcp'];
        }

        if(GUMP::is_valid($this->json_array, ['edition' => 'required']) === true) {
            $this->edition = $this->json_array['edition'];
        }

        //CacheHash
        $this->addCacheHashKey('av_'.$this->version);
        $this->addCacheHashKey('edition_'.$this->edition);
        $this->addCacheHashKey('contenttype_'.$this->contenttype);

        $get = common::$sql['default']->fetch("SELECT `version`,`release`,`build`,`edition` FROM `{prefix_addon_version}` WHERE `static_version` = ? AND `edition` = ?;",
            [$this->version, $this->edition]);

        if (common::$sql['default']->rowCount()) {
            switch ($this->contenttype) {
                case 'xml':
                case 'xmlrpc':
                    $output = xmlrpc_encode([
                        'dzcp' => [
                            'version' => stringParser::decode($get['version']),
                            'release' => stringParser::decode($get['release']),
                            'build' => stringParser::decode($get['build']),
                            'edition' => stringParser::decode($get['edition'])
                        ]
                    ]);

                    echo $output;
                break;
                case 'jsonp':
                default:
                    common::$gump->validation_rules(['dzcp' => 'required|min_len,1']);
                    common::$gump->filter_rules(['dzcp' => 'json_encode']);
                    $output = [
                        'dzcp' => [
                            'version' => stringParser::decode($get['version']),
                            'release' => stringParser::decode($get['release']),
                            'build' => stringParser::decode($get['build']),
                            'edition' => stringParser::decode($get['edition'])
                        ]
                    ];

                    $validated_data = common::$gump->run($output);
                    if ($validated_data !== false) {
                        echo json_encode($validated_data,JSON_FORCE_OBJECT);
                    }
                break;
            }
        }
    }

    function runUpdate(bool $force=false) {
        $update_stable = false;
        $qryv = common::$sql['default']->select("SELECT `id`,`static_version`,`edition`,`updated` FROM `{prefix_addon_version}` WHERE `enabled` = 1;");
        if(common::$sql['default']->rowCount()) {
            foreach ($qryv as $getv) {
                if ($getv['updated'] == 0 || $force || $getv['updated'] <= (time() - (30 * 60))) {
                    $xml = $this->updateGithub($getv['static_version'], $getv['edition']);
                    if (is_array($xml)) {
                        common::$sql['default']->update("UPDATE `{prefix_addon_version}` SET `version` = ?, `release` = ?, `build` = ?, `updated` = ? WHERE `id` = ?;",
                            [stringParser::encode($xml['version']), stringParser::encode($xml['release']), stringParser::encode($xml['build']), time(), $getv['id']]);
                        if($getv['static_version'] == $this->version && $getv['edition'] == 'stable') {
                            $update_stable = true;
                        }
                    }
                }
            }
        }

        if($update_stable) {
            $get = common::$sql['default']->fetch("SELECT `version` FROM `{prefix_addon_version}` WHERE `static_version` = ? AND `edition` = 'stable';",
                [$this->version]);
            if (common::$sql['default']->rowCount()) {
                $this->writeOldVersionsFile(stringParser::decode($get['version']));
            }
        }
    }

    /**
     * @param string $version
     * @param string $edition
     * @return array|bool
     */
    public function updateGithub($version='1.7', $edition='stable') {
        if($version == '1.6') {
            switch ($edition) {
                case 'dev':
                    $url = 'development';
                    break;
                default:
                    $url = 'final';
                    break;
            }
        } else {
            switch ($edition) {
                case 'dev':
                    $url = 'development';
                    break;
                case 'society':
                    $url = 'society';
                    break;
                default:
                    $url = 'stable';
                    break;
            }
        }

        $xml=false;
        $dzcp_online_v = common::get_external_contents("https://raw.githubusercontent.com/DZCP-Community/DZCP-".$version."/".$url."/dzcp_version.xml");
        if($dzcp_online_v && !empty($dzcp_online_v)) {
            $xml = ((array)simplexml_load_string($dzcp_online_v, 'SimpleXMLElement', LIBXML_NOCDATA));
        } unset($dzcp_online_v);

        return $xml;
    }

    //Old Versions <= 1.5.x

    /**
     * @param string $version
     * @return bool|int
     */
    private function writeOldVersionsFile($version='1.6.0.1') {
        if(file_exists(basePath.'/version.txt'))
            unlink(basePath.'/version.txt');

        return file_put_contents(basePath.'/version.txt',$version);
    }

    /**
     * @param $key
     */
    private function addCacheHashKey($key) {
        $this->cache_hash[] = $key;
    }

    /**
     * @return string
     */
    private function getCacheHash() {
        $hash = 'dzcp_version';
        foreach ($this->cache_hash as $key) {
            $hash .= $hash.'_'.$key;
        }
        return md5($hash);
    }
}