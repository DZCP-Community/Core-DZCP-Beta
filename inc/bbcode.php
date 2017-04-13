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

/**
 * BBCode to HTML converter
 *
 * Created by Kai Mallea (kmallea@gmail.com)
 *
 * Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php
 */
class BBCode_TEST {
    protected $bbcode_table = array();

    public function __construct () {

        // Replace [quote]...[/quote] with <blockquote><p>...</p></blockquote>
        $this->bbcode_table["/\[quote\](.*?)\[\/quote\]/is"] = function ($match) {
            return "<blockquote><strong>$match[1]</strong></blockquote>";
        };

        // Replace [quote="person"]...[/quote] with <blockquote><p>...</p></blockquote>
        $this->bbcode_table["/\[quote=\"([^\"]+)\"\](.*?)\[\/quote\]/is"] = function ($match) {
            return "$match[1] wrote: <blockquote><strong>$match[2]</strong></blockquote>";
        };

        // Replace [size=30]...[/size] with <span style="font-size:30%">...</span>
        $this->bbcode_table["/\[size=(\d+)\](.*?)\[\/size\]/is"] = function ($match) {
            return "<span style=\"font-size:$match[1]%\">$match[2]</span>";
        };


        // Replace [s] with <del>
        $this->bbcode_table["/\[s\](.*?)\[\/s\]/is"] = function ($match) {
            return "<del>$match[1]</del>";
        };


        // Replace [u]...[/u] with <span style="text-decoration:underline;">...</span>
        $this->bbcode_table["/\[u\](.*?)\[\/u\]/is"] = function ($match) {
            return '<span style="text-decoration:underline;">' . $match[1] . '</span>';
        };


        // Replace [center]...[/center] with <div style="text-align:center;">...</div>
        $this->bbcode_table["/\[center\](.*?)\[\/center\]/is"] = function ($match) {
            return '<div style="text-align:center;">' . $match[1] . '</div>';
        };


        // Replace [color=somecolor]...[/color] with <span style="color:somecolor">...</span>
        $this->bbcode_table["/\[color=([#a-z0-9]+)\](.*?)\[\/color\]/is"] = function ($match) {
            return '<span style="color:'. $match[1] . ';">' . $match[2] . '</span>';
        };


        // Replace [email]...[/email] with <a href="mailto:...">...</a>
        $this->bbcode_table["/\[email\](.*?)\[\/email\]/is"] = function ($match) {
            return "<a href=\"mailto:$match[1]\">$match[1]</a>";
        };


        // Replace [email=someone@somewhere.com]An e-mail link[/email] with <a href="mailto:someone@somewhere.com">An e-mail link</a>
        $this->bbcode_table["/\[email=(.*?)\](.*?)\[\/email\]/is"] = function ($match) {
            return "<a href=\"mailto:$match[1]\">$match[2]</a>";
        };


        // Replace [url]...[/url] with <a href="...">...</a>
        $this->bbcode_table["/\[url\](.*?)\[\/url\]/is"] = function ($match) {
            return "<a href=\"$match[1]\">$match[1]</a>";
        };


        // Replace [url=http://www.google.com/]A link to google[/url] with <a href="http://www.google.com/">A link to google</a>
        $this->bbcode_table["/\[url=(.*?)\](.*?)\[\/url\]/is"] = function ($match) {
            return "<a href=\"$match[1]\">$match[2]</a>";
        };


        // Replace [img]...[/img] with <img src="..."/>
        $this->bbcode_table["/\[img\](.*?)\[\/img\]/is"] = function ($match) {
            return "<img src=\"$match[1]\"/>";
        };


        // Replace [list]...[/list] with <ul><li>...</li></ul>
        $this->bbcode_table["/\[list\](.*?)\[\/list\]/is"] = function ($match) {
            $match[1] = preg_replace_callback("/\[\*\]([^\[\*\]]*)/is", function ($submatch) {
                return "<li>" . preg_replace("/[\n\r?]$/", "", $submatch[1]) . "</li>";
            }, $match[1]);

            return "<ul>" . preg_replace("/[\n\r?]/", "", $match[1]) . "</ul>";
        };


        // Replace [list=1|a]...[/list] with <ul|ol><li>...</li></ul|ol>
        $this->bbcode_table["/\[list=(1|a)\](.*?)\[\/list\]/is"] = function ($match) {
            if ($match[1] == '1') {
                $list_type = '<ol>';
            } else if ($match[1] == 'a') {
                $list_type = '<ol style="list-style-type: lower-alpha">';
            } else {
                $list_type = '<ol>';
            }

            $match[2] = preg_replace_callback("/\[\*\]([^\[\*\]]*)/is", function ($submatch) {
                return "<li>" . preg_replace("/[\n\r?]$/", "", $submatch[1]) . "</li>";
            }, $match[2]);

            return $list_type . preg_replace("/[\n\r?]/", "", $match[2]) . "</ol>";
        };


        // Replace [youtube]...[/youtube] with <iframe src="..."></iframe>
        $this->bbcode_table["/\[youtube\](?:http?:\/\/)?(?:www\.)?youtu(?:\.be\/|be\.com\/watch\?v=)([A-Z0-9\-_]+)(?:&(.*?))?\[\/youtube\]/i"] = function ($match) {
            return "<iframe class=\"youtube-player\" type=\"text/html\" width=\"640\" height=\"385\" src=\"http://www.youtube.com/embed/$match[1]\" frameborder=\"0\"></iframe>";
        };
    }

    public function toHTML ($str, $escapeHTML=false, $nr2br=false) {
        if (!$str) {
            return "";
        }

        if ($escapeHTML) {
            $str = htmlspecialchars($str);
        }

        foreach($this->bbcode_table as $key => $val) {
            $str = preg_replace_callback($key, $val, $str);
        }

        if ($nr2br) {
            $str = preg_replace_callback("/\n\r?/", function ($match) { return "<br/>"; }, $str);
        }

        return $str;
    }
}

//###################################
//BBCodeParser Class
//###################################
class bbcode {
    private static $string = '';
    private static $vid_count = 0;
    private static $gl_words = array();
    private static $gl_desc = array();
    private static $simple_search = array(
      '/\[b\](.*?)\[\/b\]/is',
      '/\[i\](.*?)\[\/i\]/is',
      '/\[u\](.*?)\[\/u\]/is',
      '/\[s\](.*?)\[\/s\]/is',
      '/\[size\=(.*?)\](.*?)\[\/size\]/is',
      '/\[color\=(.*?)\](.*?)\[\/color\]/is',
      '/\[center\](.*?)\[\/center\]/is',
      '/\[font\=(.*?)\](.*?)\[\/font\]/is',
      '/\[align\=(left|center|right)\](.*?)\[\/align\]/is',

      '/\[left\](.*?)\[\/left\]/is',
      '/\[right\](.*?)\[\/right\]/is',

      '/\[url\](.*?)\[\/url\]/is',
      '/\[url\=(.*?)\](.*?)\[\/url\]/is',
      '/\[mail\=(.*?)\](.*?)\[\/mail\]/is',
      '/\[mail\](.*?)\[\/mail\]/is',
      '/\[img\](.*?)\[\/img\]/is',
      '/\[img\=(\d*?)x(\d*?)\](.*?)\[\/img\]/is',
      '/\[img (.*?)\](.*?)\[\/img\]/is',

      '/\[quote\](.*?)\[\/quote\]/is',
      '/\[quote\=(.*?)\](.*?)\[\/quote\]/is',

      '/\[sub\](.*?)\[\/sub\]/is',
      '/\[sup\](.*?)\[\/sup\]/is',
      '/\[p\](.*?)\[\/p\]/is',

      '/\[bull \/\]/i',
      '/\[copyright \/\]/i',
      '/\[registered \/\]/i',
      '/\[tm \/\]/i');

    private static $simple_replace = array(
      '<strong>$1</strong>',
      '<em>$1</em>',
      '<u>$1</u>',
      '<del>$1</del>',
      '<span style="font-size: $1;">$2</span>',
      '<span style="color: $1;">$2</span>',
      '<div style="text-align: center;">$1</div>',
      '<span style="font-family: $1;">$2</span>',
      '<div style="text-align: $1;">$2</div>',

      '<div style="text-align: left;">$2</div>',
      '<div style="text-align: right;">$2</div>',

      '<a href="$1">$1</a>',
      '<a href="$1">$2</a>',
      '<a href="mailto:$1">$2</a>',
      '<a href="mailto:$1">$1</a>',
      '<img src="$1" alt="" />',
      '<img height="$2" width="$1" alt="" src="$3" />',
      '"<img " . str_replace("&#039;", "\"",str_replace("&quot;", "\"", "$1")) . " src=\"$2\" />"',

      '<blockquote>$1</blockquote>',
      '<blockquote><strong>$1 wrote:</strong> $2</blockquote>',

      '<sub>$1</sub>',
      '<sup>$1</sup>',
      '<p>$1</p>',

      '&bull;',
      '&copy;',
      '&reg;',
      '&trade;');

    private static $lineBreaks_search = array(
      '/\[list(.*?)\](.+?)\[\/list\]/si',
      '/\[\/list\]\s*\<br \/\>/i',
      '/\[\/code\]\s*\<br \/\>/i',
      '/\[\/quote\]\s*\<br \/\>/i',
      '/\[\/p\]\s*\<br \/\>/i',
      '/\[\/center\]\s*\<br \/\>/i',
      '/\[\/align\]\s*\<br \/\>/i');

    private static $lineBreaks_replace = array(
      "'[list$1]'.str_replace('<br />', '', '$2').'[/list]'",
      "[/list]",
      "[/code]",
      "[/quote]",
      "[/p]",
      "[/center]",
      "[/align]");

    private static $vid_search = array(
            "/\[googlevideo\](.*?)\[\/googlevideo\]/",
            "/\[myvideo\](.*?)\[\/myvideo\]/",
            "/\[youtube\](?:http?s?:\/\/)?(?:www\.)?youtu(?:\.be\/|be\.com\/watch\?v=)([A-Z0-9\-_]+)(?:&(.*?))?\[\/youtube\]/i",
            "/\[divx\](.*?)\[\/divx\]/",
            "/\[vimeo\]([0-9]{0,})\[\/vimeo\]/",
            "/\[golem\](.*?)\[\/golem\]/");

    private static $vid_replace = array(
            "<embed id=VideoPlayback src=http://video.google.de/googleplayer.swf?docid=-$1&hl=de&fs=true style=width:425px;height:344px allowFullScreen=true allowScriptAccess=always type=application/x-shockwave-flash> </embed>",

            "<object wmode=\"opaque\" style=\"width: 425px; height: 344px;\" type=\"application/x-shockwave-flash\" data=\"http://www.myvideo.de/movie/$1\"> "
        . "</param><param name=\"wmode\" value=\"opaque\"><param name=\"movie\" value=\"http://www.myvideo.de/movie/$1\"><param name=\"AllowFullscreen\" value=\"true\"></object>",

            "<object width=\"425\" height=\"344\" wmode=\"opaque\"><param name=\"movie\" value=\"http://www.youtube.com/v/$1&hl=de_DE&fs=1&color1=0x3a3a3a&color2=0x999999&border=0\">"
        . "</param><param name=\"allowFullScreen\" value=\"true\"></param><param name=\"allowscriptaccess\" value=\"always\"></param><param name=\"wmode\" value=\"opaque\">"
        . "<embed src=\"http://www.youtube.com/v/$1&hl=de_DE&fs=1&color1=0x3a3a3a&color2=0x999999&border=0\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" "
        . "allowfullscreen=\"true\" width=\"425\" height=\"344\"></embed></object>",

            "<object width=\"425\" height=\"344\" wmode=\"opaque\" codebase=\"http://go.divx.com/plugin/DivXBrowserPlugin.cab\">"
        . "<param name=\"custommode\" value=\"none\" /><param name=\"autoPlay\" value=\"false\" /><param name=\"src\" value=\"$1\" />"
        . "<embed type=\"video/divx\" src=\"$1\" custommode=\"none\" width=\"425\" height=\"344\" autoPlay=\"false\" pluginspage=\"http://go.divx.com/plugin/download/\"></embed></object>",

            "<object width=\"425\" height=\"344\" wmode=\"opaque\"><param name=\"allowfullscreen\" value=\"true\" />"
        . "</param><param name=\"wmode\" value=\"opaque\"><param name=\"allowscriptaccess\" value=\"always\" /><param name=\"movie\" value=\"http://www.vimeo.com/moogaloop.swf?clip_id=$1&server=www.vimeo.com&show_title=1&show_byline=1&show_portrait=0&color=&fullscreen=1\" /><embed src=\"http://www.vimeo.com/moogaloop.swf?clip_id=\\1&server=www.vimeo.com&show_title=1&show_byline=1&show_portrait=0&color=&fullscreen=1\" type=\"application/x-shockwave-flash\" allowfullscreen=\"true\" allowscriptaccess=\"always\" width=\"425\" height=\"344\"></embed></object>",

            "<object width=\"480\" height=\"270\" wmode=\"opaque\"></param><param name=\"wmode\" value=\"opaque\">"
        . "<param name=\"movie\" value=\"http://video.golem.de/player/videoplayer.swf?id=$1&autoPl=false\"></param><param name=\"allowFullScreen\" value=\"true\">"
        . "</param><param name=\"AllowScriptAccess\" value=\"always\"><embed src=\"http://video.golem.de/player/videoplayer.swf?id=$1&autoPl=false\" "
        . "type=\"application/x-shockwave-flash\" allowfullscreen=\"true\" AllowScriptAccess=\"always\" width=\"480\" height=\"270\"></embed></object>");

    private static function process_list_items($list_items) {
        $result_list_items = array();

        // Check for [li][/li] tags
        preg_match_all("/\[li\](.*?)\[\/li\]/is", $list_items, $li_array);
        $li_array = $li_array[1];
        if (empty($li_array)) {
            // we didn't find any [li] tags
            $list_items_array = explode("[*]", $list_items);
            foreach ($list_items_array as $li_text) {
                $li_text = trim($li_text);
                if (empty($li_text)) {
                    continue;
                }

                $li_text = nl2br($li_text);
                $result_list_items[] = '<li>'.$li_text.'</li>';
            }
        } else {
            // we found [li] tags!
            foreach ($li_array as $li_text) {
                $li_text = nl2br($li_text);
                $result_list_items[] = '<li>'.$li_text.'</li>';
            }
        }

        return implode("\n", $result_list_items);
    }

    //Badword Filter
    private static function badword_filter() {
        $words = trim(stringParser::decode(settings::get('badwords')));
        if(empty($words)) return;
        $words = explode(",",$words);
        if(count($words) >= 1) {
            foreach($words as $word) { 
                self::$string = preg_replace_callback("#".$word."#i",create_function('$matches','return str_repeat("*", strlen($matches[0]));'),self::$string);
            }
        }
    }

    private static function make_url_clickable($matches) {
        $ret = '';
        $url = $matches[2];

        if ( empty($url) )
            return $matches[0];
        // removed trailing [.,;:] from URL
        if ( in_array(substr($url, -1), array('.', ',', ';', ':')) === true )
        {
            $ret = substr($url, -1);
            $url = substr($url, 0, strlen($url)-1);
        }

        return $matches[1] . "<a href=\"$url\" rel=\"nofollow\">$url</a>" . $ret;
    }

    private static function make_web_ftp_clickable($matches) {
        $ret = '';
        $dest = $matches[2];
        $dest = 'http://' . $dest;

        if ( empty($dest) )
            return $matches[0];
        // removed trailing [,;:] from URL
        if ( in_array(substr($dest, -1), array('.', ',', ';', ':')) === true )
        {
            $ret = substr($dest, -1);
            $dest = substr($dest, 0, strlen($dest)-1);
        }

        return $matches[1] . "<a href=\"$dest\" rel=\"nofollow\">$dest</a>" . $ret;
    }

    private static function make_email_clickable($matches) {
        $email = $matches[2] . '@' . $matches[3];
        return $matches[1] . "<a href=\"mailto:$email\">$email</a>";
    }

    private static function make_clickable() {
        self::$string = preg_replace_callback('#([\s>])([\w]+?://[\w\\x80-\\xff\#$%&~/.\-;:=,?@\[\]+]*)#is', 'self::make_url_clickable', self::$string);
        self::$string = preg_replace_callback('#([\s>])((www|ftp)\.[\w\\x80-\\xff\#$%&~/.\-;:=,?@\[\]+]*)#is', 'self::make_web_ftp_clickable', self::$string);
        self::$string = preg_replace_callback('#([\s>])([.0-9a-z_+-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,})#i', 'self::make_email_clickable', self::$string);
        self::$string = trim(preg_replace("#(<a( [^>]+?>|>))<a [^>]+?>([^>]+?)</a></a>#i", "$1$3</a>", self::$string));
    }

    private static function bbcodetolow($founds)
    { return "[".strtolower($founds[1])."]".trim($founds[2])."[/".strtolower($founds[3])."]"; }

    public static function search_vid() {
        self::$vid_count = 0;
        foreach (self::$vid_search as $search) {
            self::$string = preg_replace_callback($search,"self::callback_vid",self::$string);
            self::$vid_count++;
        }
    }

    private static function callback_vid($matches) {
        $htmlCode = self::$vid_replace[self::$vid_count];
        return str_replace('$1', $matches[1], $htmlCode);
    }

    /**
     * Führt den allgemeinen BBCode aus.
     *
     * @param string $string
     * @param boolean $htmlentities
     * @param boolean $nolinks
     * @return string
     */
    public static function parse_html($string='',$htmlentities=false, $nolinks=false) {
        self::$string = stringParser::decode($string);
        if(empty(self::$string)) return self::$string;
        self::$string = $htmlentities ? htmlentities(self::$string) : self::$string;

        self::$string = preg_replace_callback("/\[(.*?)\](.*?)\[\/(.*?)\]/","self::bbcodetolow",self::$string);
        self::$string = preg_replace_callback("#\<img(.*?)\>#", 
                create_function('$img','if(preg_match("#class#i",$img[1])) return '
                        . '"<img".$img[1].">"; else return "<img class=\"content\"".$img[1].">";'), 
                self::$string);
        
        //Hide Tag
        self::$string = (common::checkme() >= 1 ? str_replace(array('[hide]','[/hide]'),'',self::$string) : preg_replace("/\[hide\](.*?)\[\/hide\]/", "",self::$string));

        // Badword Filter
        self::badword_filter();

        // Preappend http:// to url address if not present
        if(settings::get('urls_linked') && !$nolinks) {
            self::make_clickable();
        }

        self::$string = preg_replace_callback('/\[url\=([^(http)].+?)\](.*?)\[\/url\]/i',create_function('$matches','return \'[url=http://\'.$matches[1].\']\'.$matches[2].\'[/url]\';'),self::$string);
        self::$string = preg_replace_callback('/\[url\]([^(http)].+?)\[\/url\]/i',create_function('$matches','return \'[url=http://\'.$matches[1].\']\'.$matches[1].\'[/url]\';'),self::$string);

        // Remove \n line breaks
        self::$string = str_replace( "\n", "", self::$string ); 

        // Remove the trash made by previous
        self::$string = preg_replace(self::$lineBreaks_search, self::$lineBreaks_replace, self::$string);

        // Parse bbcode
        self::$string = preg_replace(self::$simple_search, self::$simple_replace, self::$string);
        
        // Parse CodeTag
        self::$string = preg_replace_callback('/\[code\](.*?)\[\/code\]/i', create_function('$matches','return \'<pre><code>\'.$matches[1].\'</code></pre>\';'), self::$string);

        // Parse Movie Players
        self::search_vid();

        // Parse [list] tags
        self::$string = preg_replace('/\[list\](.*?)\[\/list\]/si', '"<ul>\n".self::process_list_items("$1")."\n</ul>"', self::$string);
        
        return preg_replace('/\[list\=(disc|circle|square|decimal|decimal-leading-zero|lower-roman|upper-roman|lower-greek|lower-alpha|'
                . 'lower-latin|upper-alpha|upper-latin|hebrew|armenian|georgian|cjk-ideographic|hiragana|katakana|hiragana-iroha|katakana-iroha|none)\](.*?)\[\/list\]/si',
                '"<ol style=\"list-style-type: $1;\">\n".self::process_list_items("$2")."\n</ol>"', self::$string);
    }

    public static function search_lineBreaks() {
        self::$lineBreaks_count = 0;
        foreach (self::$lineBreaks_search as $search) {
            self::$string = preg_replace_callback($search,"self::callback_lineBreaks",self::$string);
            self::$lineBreaks_count++;
        }
    }

    private static function callback_lineBreaks($matches) {
        $htmlCode = self::$lineBreaks_replace[self::$lineBreaks_count];
        return str_replace('$1', $matches[1], $htmlCode);
    }

    /**
     * Textteil in ein Zitat setzen * blockquote *
     * @param string $nick,string $zitat,
     * @return string (html-code)
     */
    public static function zitat($nick,$zitat) {
        $search  = array(chr(145),chr(146),"'",chr(147),chr(148),chr(10),chr(13));
        $replace = array(chr(39),chr(39),"&#39;",chr(34),chr(34)," "," ");
        $zitat = preg_replace("#[\n\r]+#", "<br />", str_replace($search, $replace, $zitat));
        return '<br /><br /><br /><blockquote><b>'.$nick.' '._wrote.':</b><br />'.stringParser::decode($zitat).'</blockquote>';
    }

    public static function nletter($txt)
    { return '<style type="text/css">p { margin: 0px; padding: 0px; }</style>'.$txt; }

    /** 
     * Generates version 1: MAC address 
     */  
    public static function uuid() {  
      if (!function_exists('uuid_create'))  
        return false;  

      $context = $uuid = null;  
      uuid_create($context);  
      uuid_make($context, UUID_MAKE_V1);  
      uuid_export($context, UUID_FMT_STR, $uuid);  
      return trim($uuid);  
    }
}