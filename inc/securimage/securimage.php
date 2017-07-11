<?php
/**
 * Project:     Securimage: A PHP class for creating and managing form CAPTCHA images
 * File:        securimage.php
 *
 * Copyright (c) 2014, Drew Phillips
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 *  - Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 *  - Redistributions in binary form must reproduce the above copyright notice,
 *    this list of conditions and the following disclaimer in the documentation
 *    and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * Any modifications to the library should be indicated clearly in the source code
 * to inform users that the changes are not a part of the original software.
 *
 * If you found this script useful, please take a quick moment to rate it.
 * http://www.hotscripts.com/rate/49400.html  Thanks.
 *
 * @link http://www.phpcaptcha.org Securimage PHP CAPTCHA
 * @link http://www.phpcaptcha.org/latest.zip Download Latest Version
 * @link http://www.phpcaptcha.org/Securimage_Docs/ Online Documentation
 * @copyright 2013 Drew Phillips
 * @author Drew Phillips <drew@drew-phillips.com>
 * @version 3.5.4 (Aug 27, 2014)
 * @package Securimage
 * @modified Lucas Brucksch for DZCP 1.7
 *
 */

class Securimage {
    // All of the public variables below are securimage options
    // They can be passed as an array to the Securimage constructor, set below,
    // or set from securimage_show.php and securimage_play.php

    /**
     * Renders captcha as a JPEG image
     * @var int
     */
    const SI_IMAGE_JPEG = 1;
    /**
     * Renders captcha as a PNG image (default)
     * @var int
     */
    const SI_IMAGE_PNG  = 2;
    /**
     * Renders captcha as a GIF image
     * @var int
     */
    const SI_IMAGE_GIF  = 3;

    /**
     * Create a normal alphanumeric captcha
     * @var int
     */
    const SI_CAPTCHA_STRING     = 0;
    /**
     * Create a captcha consisting of a simple math problem
     * @var int
     */
    const SI_CAPTCHA_MATHEMATIC = 1;
    /**
     * Create a word based captcha using 2 words
     * @var int
     */
    const SI_CAPTCHA_WORDS      = 2;

    /*%*********************************************************************%*/
    // Properties

    /**
     * The width of the captcha image
     * @var int
     */
    public $image_width = 215;
    /**
     * The height of the captcha image
     * @var int
     */
    public $image_height = 80;
    /**
     * The type of the image, default = png
     * @var int
     */
    public $image_type   = self::SI_IMAGE_PNG;

    /**
     * The background color of the captcha
     * @var Securimage_Color
     */
    public $image_bg_color = '#ffffff';
    /**
     * The color of the captcha text
     * @var Securimage_Color
     */
    public $text_color     = '#707070';
    /**
     * The color of the lines over the captcha
     * @var Securimage_Color
     */
    public $line_color     = '#707070';
    /**
     * The color of the noise that is drawn
     * @var Securimage_Color
     */
    public $noise_color    = '#707070';

    /**
     * How transparent to make the text 0 = completely opaque, 100 = invisible
     * @var int
     */
    public $text_transparency_percentage = 20;
    /**
     * Whether or not to draw the text transparently, true = use transparency, false = no transparency
     * @var bool
     */
    public $use_transparent_text         = true;

    /**
     * The length of the captcha code
     * @var int
     */
    public $code_length    = 6;
    /**
     * Whether the captcha should be case sensitive (not recommended, use only for maximum protection)
     * @var bool
     */
    public $case_sensitive = false;
    /**
     * The character set to use for generating the captcha code
     * @var string
     */
    public $charset        = 'ABCDEFGHKLMNPRSTUVWYZabcdefghklmnprstuvwyz23456789';

    /**
     * How long in seconds a captcha remains valid, after this time it will not be accepted
     * @var integer
     */
    public $expiry_time    = 900;

    /**
     * true to use the wordlist file, false to generate random captcha codes
     * @var bool
     */
    public $use_wordlist   = false;

    /**
     * The level of distortion, 0.75 = normal, 1.0 = very high distortion
     * @var double
     */
    public $perturbation = 0.85;
    /**
     * How many lines to draw over the captcha code to increase security
     * @var int
     */
    public $num_lines    = 5;
    /**
     * The level of noise (random dots) to place on the image, 0-10
     * @var int
     */
    public $noise_level  = 2;

    /**
     * The signature text to draw on the bottom corner of the image
     * @var string
     */
    public $image_signature = '';
    /**
     * The color of the signature text
     * @var Securimage_Color
     */
    public $signature_color = '#707070';
    /**
     * The path to the ttf font file to use for the signature text, defaults to $ttf_file (AHGBold.ttf)
     * @var string
     */
    public $signature_font;

    /**
     * The type of captcha to create, either alphanumeric, or a math problem<br />
     * Securimage::SI_CAPTCHA_STRING or Securimage::SI_CAPTCHA_MATHEMATIC
     * @var int
     */
    public $captcha_type  = self::SI_CAPTCHA_STRING; // or self::SI_CAPTCHA_MATHEMATIC;

    /**
     * The captcha namespace, use this if you have multiple forms on a single page, blank if you do not use multiple forms on one page
     * @var string
     * <code>
     * <?php
     * // in securimage_show.php (create one show script for each form)
     * $img->namespace = 'contact_form';
     *
     * // in form validator
     * $img->namespace = 'contact_form';
     * if ($img->check($code) == true) {
     *     echo "Valid!";
     *  }
     * </code>
     */
    public $namespace;

    /**
     * The font file to use to draw the captcha code, leave blank for default font AHGBold.ttf
     * @var string
     */
    public $ttf_file;
    /**
     * The path to the wordlist file to use, leave blank for default words/words.txt
     * @var string
     */
    public $wordlist_file;
    /**
     * Font size is calculated by image height and this ratio - leave blank for default ratio of 0.4.
     * Valid range: 0.1 - 0.99.
     * Depending on image_width, values > 0.6 are probably too large and values < 0.3 are too small.
     *
     * @var float
     */
    public $font_ratio;
    /**
     * The directory to scan for background images, if set a random background will be chosen from this folder
     * @var string
     */
    public $background_directory;

    /**
     * The path to the securimage audio directory, can be set in securimage_play.php
     * @var string
     * <code>
     * $img->audio_path = '/home/yoursite/public_html/securimage/audio/en/';
     * </code>
     */
    public $audio_path;

    /**
     * Use SoX (The Swiss Army knife of audio manipulation) for audio effects and processing
     *
     * @see Securimage::$sox_binary_path
     * @var bool true to use SoX, false to use PHP
     */
    public $audio_use_sox = false;

    /**
     * The path to the SoX binary on your system
     *
     * @var string
     */
    public $sox_binary_path = '/usr/bin/sox';

    /**
     * The path to the directory containing audio files that will be selected
     * randomly and mixed with the captcha audio.
     *
     * @var string
     */
    public $audio_noise_path;
    /**
     * Whether or not to mix background noise files into captcha audio (true = mix, false = no)
     * Mixing random background audio with noise can help improve security of audio captcha.
     * Default: securimage/audio/noise
     *
     * @since 3.0.3
     * @see Securimage::$audio_noise_path
     * @var bool
     */
    public $audio_use_noise;
    /**
     * The method and threshold (or gain factor) used to normalize the mixing with background noise.
     * See http://www.voegler.eu/pub/audio/ for more information.
     *
     * Valid: <ul>
     *     <li> >= 1 - Normalize by multiplying by the threshold (boost - positive gain). <br />
     *            A value of 1 in effect means no normalization (and results in clipping). </li>
     *     <li> <= -1 - Normalize by dividing by the the absolute value of threshold (attenuate - negative gain). <br />
     *            A factor of 2 (-2) is about 6dB reduction in volume.</li>
     *     <li> [0, 1) - (open inverval - not including 1) - The threshold
     *            above which amplitudes are comressed logarithmically. <br />
     *            e.g. 0.6 to leave amplitudes up to 60% "as is" and compress above. </li>
     *     <li> (-1, 0) - (open inverval - not including -1 and 0) - The threshold
     *            above which amplitudes are comressed linearly. <br />
     *            e.g. -0.6 to leave amplitudes up to 60% "as is" and compress above. </li></ul>
     *
     * Default: 0.8
     *
     * @since 3.0.4
     * @var float
     */
    public $audio_mix_normalization = 0.8;
    /**
     * Whether or not to degrade audio by introducing random noise (improves security of audio captcha)
     * Default: true
     *
     * @since 3.0.3
     * @var bool
     */
    public $degrade_audio;
    /**
     * Minimum delay to insert between captcha audio letters in milliseconds
     *
     * @since 3.0.3
     * @var float
     */
    public $audio_gap_min = 0;
    /**
     * Maximum delay to insert between captcha audio letters in milliseconds
     *
     * @since 3.0.3
     * @var float
     */
    public $audio_gap_max = 3000;

    /**
     * Captcha ID if using static captcha
     * @var string Unique captcha id
     */
    protected static $_captchaId = null;

    protected $im;
    protected $tmpimg;
    protected $bgimg;
    protected $iscale = 5;

    public $securimage_path = null;

    /**
     * The captcha challenge value (either the case-sensitive/insensitive word captcha, or the solution to the math captcha)
     *
     * @var string Captcha challenge value
     */
    protected $code;

    /**
     * The display value of the captcha to draw on the image (the word captcha, or the math equation to present to the user)
     *
     * @var string Captcha display value to draw on the image
     */
    protected $code_display;

    /**
     * A value that can be passed to the constructor that can be used to generate a captcha image with a given value
     * This value does not get stored in the session or database and is only used when calling Securimage::show().
     * If a display_value was passed to the constructor and the captcha image is generated, the display_value will be used
     * as the string to draw on the captcha image.  Used only if captcha codes are generated and managed by a 3rd party app/library
     *
     * @var string Captcha code value to display on the image
     */
    public $display_value;

    /**
     * Captcha code supplied by user [set from Securimage::check()]
     *
     * @var string
     */
    protected $captcha_code;

    /**
     * Flag that can be specified telling securimage not to call exit after generating a captcha image or audio file
     *
     * @var bool If true, script will not terminate; if false script will terminate (default)
     */
    protected $no_exit;

    /**
     * Flag indicating whether or not a PHP session should be started and used
     *
     * @var bool If true, no session will be started; if false, session will be started and used to store data (default)
     */
    protected $no_session;

    /**
     * Flag indicating whether or not HTTP headers will be sent when outputting captcha image/audio
     *
     * @var bool If true (default) headers will be sent, if false, no headers are sent
     */
    protected $send_headers;

    // gd color resources that are allocated for drawing the image
    protected $gdbgcolor;
    protected $gdtextcolor;
    protected $gdlinecolor;
    protected $gdsignaturecolor;

    /**
     * Create a new securimage object, pass options to set in the constructor.<br />
     * This can be used to display a captcha, play an audible captcha, or validate an entry
     * @param array $options
     * <code>
     * $options = array(
     *     'text_color' => new Securimage_Color('#013020'),
     *     'code_length' => 5,
     *     'num_lines' => 5,
     *     'noise_level' => 3,
     *     'font_file' => Securimage::getPath() . '/custom.ttf'
     * );
     *
     * $img = new Securimage($options);
     * </code>
     */
    public function __construct($options = []) {
        $this->securimage_path = dirname(__FILE__);

        if (is_array($options) && sizeof($options) > 0) {
            foreach($options as $prop => $val) {
                if ($prop == 'captchaId')
                    Securimage::$_captchaId = $val;
            }
        }

        $this->image_bg_color  = $this->initColor($this->image_bg_color,  '#ffffff');
        $this->text_color      = $this->initColor($this->text_color,      '#616161');
        $this->line_color      = $this->initColor($this->line_color,      '#616161');
        $this->noise_color     = $this->initColor($this->noise_color,     '#616161');
        $this->signature_color = $this->initColor($this->signature_color, '#616161');

        $this->case_sensitive = captcha_case_sensitive;

        if(captcha_mathematic)
            $this->captcha_type  = self::SI_CAPTCHA_MATHEMATIC;

        if (is_null($this->ttf_file))
            $this->ttf_file = $this->securimage_path . '/AHGBold.ttf';

        if (is_null($this->wordlist_file))
            $this->wordlist_file = $this->securimage_path . '/words/words.txt';

        if (is_null($this->audio_path))
            $this->audio_path = $this->securimage_path . '/audio/en/';

        if (is_null($this->audio_noise_path))
            $this->audio_noise_path = $this->securimage_path . '/audio/noise/';

        if (is_null($this->audio_use_noise))
            $this->audio_use_noise = true;

        if (is_null($this->degrade_audio))
            $this->degrade_audio = true;

        if (is_null($this->code_length) || (int)$this->code_length < 1)
            $this->code_length = 6;

        if (is_null($this->perturbation) || !is_numeric($this->perturbation))
            $this->perturbation = 0.75;

        if (is_null($this->namespace) || !is_string($this->namespace))
            $this->namespace = 'default';

        if (is_null($this->no_exit))
            $this->no_exit = false;

        if (is_null($this->send_headers))
            $this->send_headers = true;
    }

    /**
     * Return the absolute path to the Securimage directory
     * @return string The path to the securimage base directory
     */
    public static function getPath() {
        return dirname(__FILE__);
    }

    /**
     * Generate a new captcha ID or retrieve the current ID
     *
     * @param $new bool If true, generates a new challenge and returns and ID
     * @param $options array Additional options to be passed to Securimage.
     * Must include database options if not set directly in securimage.php
     *
     * @return null|string Returns null if no captcha id set and new was false, or string captcha ID
     */
    public static function getCaptchaId($new = true) {
        if (is_null($new) || (bool)$new == true) {
            $id = sha1(uniqid(common::visitorIp()['v4'], true));
            $si = new self([]);
            Securimage::$_captchaId = $id;
            $si->createCode();
            return $id;
        }
        else
            return Securimage::$_captchaId;
    }

    /**
     * Validate a captcha code input against a captcha ID
     *
     * @param string $id       The captcha ID to check
     * @param string $value    The captcha value supplied by the user
     * @param array  $options  Array of options to construct Securimage with.
     * Options must include database options if they are not set in securimage.php
     * @return bool true if the code was valid for the given captcha ID, false if not or if database failed to open
     */
    public static function checkByCaptchaId($id, $value) {
        $si = new self(['captchaId' => $id]);
        $code = $si->getCodeFromDatabase();

        if (is_array($code)) {
            $si->code         = $code['code'];
            $si->code_display = $code['code_disp'];
        }

        if ($si->check($value)) {
            $si->clearCodeFromDatabase();
            return true;
        }
        else
            return false;
    }


    /**
     * Used to serve a captcha image to the browser
     * @param string $background_image The path to the background image to use
     */
    public function show($background_image = '') {
        set_error_handler([&$this, 'errorHandler']);

        if($background_image != '' && is_readable($background_image)) {
            $this->bgimg = $background_image;
        }

        return $this->doImage();
    }

    /**
     * Check a submitted code against the stored value
     * @param string $code  The captcha code to check
     */
    public function check($code) {
        $this->code_entered = $code;
        $this->validate();
        return $this->correct_code;
    }

    /**
     * Output a wav file of the captcha code to the browser
     */
    public function outputAudioFile() {
        set_error_handler([&$this, 'errorHandler']);
        require_once dirname(__FILE__) . '/WavFile.php';

        try {
            $audio = $this->getAudibleCode();
        }
        catch (Exception $ex) {
            if (($fp = @fopen(basePath.'/inc/_logs_/si.error.log', 'a+')) !== false) {
                fwrite($fp, date('Y-m-d H:i:s') . ': Securimage audio error "' . $ex->getMessage() . '"' . "\n");
                fclose($fp);
            }

            $audio = $this->audioError();
        }

        if ($this->canSendHeaders() || $this->send_headers == false) {
            if ($this->send_headers) {
                $uniq = md5(uniqid(microtime()));
                header("Content-Disposition: attachment; filename=\"securimage_audio-{$uniq}.wav\"");
                header('Cache-Control: no-store, no-cache, must-revalidate');
                header('Expires: Sun, 1 Jan 2000 12:00:00 GMT');
                header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
                header('Content-type: audio/x-wav');

                if (extension_loaded('zlib'))
                    ini_set('zlib.output_compression', true);  // compress output if supported by browser
                else
                    header('Content-Length: ' . strlen($audio));
            }

            echo $audio;
        } else {
            echo '<hr /><strong>'
                .'Failed to generate audio file, content has already been '
                .'output.<br />This is most likely due to misconfiguration or '
                .'a PHP error was sent to the browser.</strong>';
        }

        restore_error_handler();
        if (!$this->no_exit) exit;
    }

    /**
     * Return the code from the session or sqlite database if used.  If none exists yet, an empty string is returned
     *
     * @param $array bool   True to receive an array containing the code and properties
     * @return array|string Array if $array = true, otherwise a string containing the code
     */
    public function getCode($array = false, $returnExisting = false) {
        $time = 0;
        $disp = 'error';
        $code = $this->getCodeFromDatabase();

        if ($returnExisting && strlen($this->code) > 0) {
            if ($array) {
                return ['code' => $this->code,
                             'display' => $this->code_display,
                             'code_display' => $this->code_display,
                             'time' => 0];
            }
            else
                return $this->code;
        }

        if ($array == true)
            return ['code' => $code, 'ctime' => $time, 'display' => $disp];
        else
            return $code;
    }

    /**
     * The main image drawing routing, responsible for constructing the entire image and serving it
     */
    protected function doImage() {
        if( ($this->use_transparent_text == true || $this->bgimg != '') && function_exists('imagecreatetruecolor'))
            $imagecreate = 'imagecreatetruecolor';
        else
            $imagecreate = 'imagecreate';

        $this->im     = $imagecreate($this->image_width, $this->image_height);
        $this->tmpimg = $imagecreate($this->image_width * $this->iscale, $this->image_height * $this->iscale);

        $this->allocateColors();
        imagepalettecopy($this->tmpimg, $this->im);

        $this->setBackground();
        $code = '';

        if ($this->getCaptchaId(false) !== null) {
            // a captcha Id was supplied

            // check to see if a display_value for the captcha image was set
            if (is_string($this->display_value) && strlen($this->display_value) > 0)
            {
                $this->code_display = $this->display_value;
                $this->code         = ($this->case_sensitive) ?
                                       $this->display_value   :
                                       strtolower($this->display_value);
                $code = $this->code;
            } else {
                // no display_value, check the database for existing captchaId
                $code = $this->getCodeFromDatabase();

                // got back a result from the database with a valid code for captchaId
                if (is_array($code)) {
                    $this->code         = $code['code'];
                    $this->code_display = $code['code_disp'];
                    $code = $code['code'];
                }
            }
        }

        if ($code == '') {
            // if the code was not set using display_value or was not found in
            // the database, create a new code
            $this->createCode();
        }

        if ($this->noise_level > 0) {
            $this->drawNoise();
        }

        $this->drawWord();

        if ($this->perturbation > 0 && is_readable($this->ttf_file)) {
            $this->distortedCopy();
        }

        if ($this->num_lines > 0) {
            $this->drawLines();
        }

        if (trim($this->image_signature) != '') {
            $this->addSignature();
        }

        return $this->output();
    }

    /**
     * Allocate the colors to be used for the image
     */
    protected function allocateColors() {
        // allocate bg color first for imagecreate
        $this->gdbgcolor = imagecolorallocate($this->im,
                                              $this->image_bg_color->r,
                                              $this->image_bg_color->g,
                                              $this->image_bg_color->b);

        $alpha = (int)($this->text_transparency_percentage / 100 * 127);

        if ($this->use_transparent_text == true) {
            $this->gdtextcolor = imagecolorallocatealpha($this->im,
                                                         $this->text_color->r,
                                                         $this->text_color->g,
                                                         $this->text_color->b,
                                                         $alpha);
            $this->gdlinecolor = imagecolorallocatealpha($this->im,
                                                         $this->line_color->r,
                                                         $this->line_color->g,
                                                         $this->line_color->b,
                                                         $alpha);
            $this->gdnoisecolor = imagecolorallocatealpha($this->im,
                                                          $this->noise_color->r,
                                                          $this->noise_color->g,
                                                          $this->noise_color->b,
                                                          $alpha);
        } else {
            $this->gdtextcolor = imagecolorallocate($this->im,
                                                    $this->text_color->r,
                                                    $this->text_color->g,
                                                    $this->text_color->b);
            $this->gdlinecolor = imagecolorallocate($this->im,
                                                    $this->line_color->r,
                                                    $this->line_color->g,
                                                    $this->line_color->b);
            $this->gdnoisecolor = imagecolorallocate($this->im,
                                                          $this->noise_color->r,
                                                          $this->noise_color->g,
                                                          $this->noise_color->b);
        }

        $this->gdsignaturecolor = imagecolorallocate($this->im,
                                                     $this->signature_color->r,
                                                     $this->signature_color->g,
                                                     $this->signature_color->b);

    }

    /**
     * The the background color, or background image to be used
     */
    protected function setBackground() {
        // set background color of image by drawing a rectangle since imagecreatetruecolor doesn't set a bg color
        imagefilledrectangle($this->im, 0, 0,
                             $this->image_width, $this->image_height,
                             $this->gdbgcolor);
        imagefilledrectangle($this->tmpimg, 0, 0,
                             $this->image_width * $this->iscale, $this->image_height * $this->iscale,
                             $this->gdbgcolor);

        if ($this->bgimg == '') {
            if ($this->background_directory != null &&
                is_dir($this->background_directory) &&
                is_readable($this->background_directory)) {
                $img = $this->getBackgroundFromDirectory();
                if ($img != false) {
                    $this->bgimg = $img;
                }
            }
        }

        if ($this->bgimg == '') {
            return;
        }

        $dat = @getimagesize($this->bgimg);
        if($dat == false) {
            return;
        }

        switch($dat[2]) {
            case 1:  $newim = @imagecreatefromgif($this->bgimg); break;
            case 2:  $newim = @imagecreatefromjpeg($this->bgimg); break;
            case 3:  $newim = @imagecreatefrompng($this->bgimg); break;
            default: return;
        }

        if(!$newim) return;
        imagecopyresized($this->im, $newim, 0, 0, 0, 0,
                         $this->image_width, $this->image_height,
                         imagesx($newim), imagesy($newim));
    }

    /**
     * Scan the directory for a background image to use
     */
    protected function getBackgroundFromDirectory() {
        $images = [];
        if ( ($dh = opendir($this->background_directory)) !== false) {
            while (($file = readdir($dh)) !== false) {
                if (preg_match('/(jpg|gif|png)$/i', $file)) $images[] = $file;
            }

            closedir($dh);

            if (sizeof($images) > 0)
                return rtrim($this->background_directory, '/') . '/' . $images[mt_rand(0, sizeof($images)-1)];
        }

        return false;
    }

    /**
     * Generates the code or math problem and saves the value to the session
     */
    public function createCode() {
        $this->code = false;

        switch($this->captcha_type) {
            case self::SI_CAPTCHA_MATHEMATIC: {
                do {
                    $signs = ['+', '-', 'x'];
                    $left  = mt_rand(1, 10);
                    $right = mt_rand(1, 5);
                    $sign  = $signs[mt_rand(0, 2)];

                    switch($sign) {
                        case 'x': $c = $left * $right; break;
                        case '-': $c = $left - $right; break;
                        default:  $c = $left + $right; break;
                    }
                } while ($c <= 0); // no negative #'s or 0

                $this->code         = $c;
                $this->code_display = "$left $sign $right";
                break;
            }

            case self::SI_CAPTCHA_WORDS:
                $words = $this->readCodeFromFile(2);
                $this->code = implode(' ', $words);
                $this->code_display = $this->code;
                break;

            default: {
                if ($this->use_wordlist && is_readable($this->wordlist_file)) {
                    $this->code = $this->readCodeFromFile();
                }

                if ($this->code == false) {
                    $this->code = $this->generateCode($this->code_length);
                }

                $this->code_display = $this->code;
                $this->code         = ($this->case_sensitive) ? $this->code : strtolower($this->code);
            } // default
        }

        $this->saveCodeToDatabase();
    }

    /**
     * Draws the captcha code on the image
     */
    protected function drawWord() {
        $width2  = $this->image_width * $this->iscale;
        $height2 = $this->image_height * $this->iscale;
        $ratio   = ($this->font_ratio) ? $this->font_ratio : 0.4;
        if ((float)$ratio < 0.1 || (float)$ratio >= 1) {
            $ratio = 0.4;
        }

        if (!is_readable($this->ttf_file)) {
            imagestring($this->im, 4, 10, ($this->image_height / 2) - 5, 'Failed to load TTF font file!', $this->gdtextcolor);
        } else {
            if ($this->perturbation > 0) {
                $font_size = $height2 * $ratio;
                $bb = imageftbbox($font_size, 0, $this->ttf_file, $this->code_display);
                $tx = $bb[4] - $bb[0];
                $ty = $bb[5] - $bb[1];
                $x  = floor($width2 / 2 - $tx / 2 - $bb[0]);
                $y  = round($height2 / 2 - $ty / 2 - $bb[1]);

                imagettftext($this->tmpimg, $font_size, 0, $x, $y, $this->gdtextcolor, $this->ttf_file, $this->code_display);
            } else {
                $font_size = $this->image_height * $ratio;
                $bb = imageftbbox($font_size, 0, $this->ttf_file, $this->code_display);
                $tx = $bb[4] - $bb[0];
                $ty = $bb[5] - $bb[1];
                $x  = floor($this->image_width / 2 - $tx / 2 - $bb[0]);
                $y  = round($this->image_height / 2 - $ty / 2 - $bb[1]);

                imagettftext($this->im, $font_size, 0, $x, $y, $this->gdtextcolor, $this->ttf_file, $this->code_display);
            }
        }
    }

    /**
     * Copies the captcha image to the final image with distortion applied
     */
    protected function distortedCopy() {
        $numpoles = 3; // distortion factor
        // make array of poles AKA attractor points
        for ($i = 0; $i < $numpoles; ++ $i) {
            $px[$i]  = mt_rand($this->image_width  * 0.2, $this->image_width  * 0.8);
            $py[$i]  = mt_rand($this->image_height * 0.2, $this->image_height * 0.8);
            $rad[$i] = mt_rand($this->image_height * 0.2, $this->image_height * 0.8);
            $tmp     = ((- $this->frand()) * 0.15) - .15;
            $amp[$i] = $this->perturbation * $tmp;
        }

        $bgCol = imagecolorat($this->tmpimg, 0, 0);
        $width2 = $this->iscale * $this->image_width;
        $height2 = $this->iscale * $this->image_height;
        imagepalettecopy($this->im, $this->tmpimg); // copy palette to final image so text colors come across
        // loop over $img pixels, take pixels from $tmpimg with distortion field
        for ($ix = 0; $ix < $this->image_width; ++ $ix) {
            for ($iy = 0; $iy < $this->image_height; ++ $iy) {
                $x = $ix;
                $y = $iy;
                for ($i = 0; $i < $numpoles; ++ $i) {
                    $dx = $ix - $px[$i];
                    $dy = $iy - $py[$i];
                    if ($dx == 0 && $dy == 0) {
                        continue;
                    }
                    $r = sqrt($dx * $dx + $dy * $dy);
                    if ($r > $rad[$i]) {
                        continue;
                    }
                    $rscale = $amp[$i] * sin(3.14 * $r / $rad[$i]);
                    $x += $dx * $rscale;
                    $y += $dy * $rscale;
                }
                $c = $bgCol;
                $x *= $this->iscale;
                $y *= $this->iscale;
                if ($x >= 0 && $x < $width2 && $y >= 0 && $y < $height2) {
                    $c = imagecolorat($this->tmpimg, $x, $y);
                }
                if ($c != $bgCol) { // only copy pixels of letters to preserve any background image
                    imagesetpixel($this->im, $ix, $iy, $c);
                }
            }
        }
    }

    /**
     * Draws distorted lines on the image
     */
    protected function drawLines() {
        for ($line = 0; $line < $this->num_lines; ++ $line) {
            $x = $this->image_width * (1 + $line) / ($this->num_lines + 1);
            $x += (0.5 - $this->frand()) * $this->image_width / $this->num_lines;
            $y = mt_rand($this->image_height * 0.1, $this->image_height * 0.9);

            $theta = ($this->frand() - 0.5) * M_PI * 0.7;
            $w = $this->image_width;
            $len = mt_rand($w * 0.4, $w * 0.7);
            $lwid = mt_rand(0, 2);

            $k = $this->frand() * 0.6 + 0.2;
            $k = $k * $k * 0.5;
            $phi = $this->frand() * 6.28;
            $step = 0.5;
            $dx = $step * cos($theta);
            $dy = $step * sin($theta);
            $n = $len / $step;
            $amp = 1.5 * $this->frand() / ($k + 5.0 / $len);
            $x0 = $x - 0.5 * $len * cos($theta);
            $y0 = $y - 0.5 * $len * sin($theta);

            for ($i = 0; $i < $n; ++ $i) {
                $x = $x0 + $i * $dx + $amp * $dy * sin($k * $i * $step + $phi);
                $y = $y0 + $i * $dy - $amp * $dx * sin($k * $i * $step + $phi);
                imagefilledrectangle($this->im, $x, $y, $x + $lwid, $y + $lwid, $this->gdlinecolor);
            }
        }
    }

    /**
     * Draws random noise on the image
     */
    protected function drawNoise() {
        if ($this->noise_level > 10) {
            $noise_level = 10;
        } else {
            $noise_level = $this->noise_level;
        }

        $t0 = microtime(true);
        $noise_level *= 125; // an arbitrary number that works well on a 1-10 scale
        $height = $this->image_height * $this->iscale;
        $width  = $this->image_width * $this->iscale;
        for ($i = 0; $i < $noise_level; ++$i) {
            $x = mt_rand(10, $width);
            $y = mt_rand(10, $height);
            $size = mt_rand(7, 10);
            if ($x - $size <= 0 && $y - $size <= 0) { continue; } // dont cover 0,0 since it is used by imagedistortedcopy
            imagefilledarc($this->tmpimg, $x, $y, $size, $size, 0, 360, $this->gdnoisecolor, IMG_ARC_PIE);
        }

        $t1 = microtime(true);
    }

    /**
    * Print signature text on image
    */
    protected function addSignature() {
        $bbox = imagettfbbox(10, 0, $this->signature_font, $this->image_signature);
        $textlen = $bbox[2] - $bbox[0];
        $x = $this->image_width - $textlen - 5;
        $y = $this->image_height - 3;

        imagettftext($this->im, 10, 0, $x, $y, $this->gdsignaturecolor, $this->signature_font, $this->image_signature);
    }

    /**
     * Sends the appropriate image and cache headers and outputs image to the browser
     */
    protected function output() {
        ob_start(); $error = false;
        if ($this->canSendHeaders()) {
            switch ($this->image_type) {
                case self::SI_IMAGE_JPEG:
                    imagejpeg($this->im, null, 90);
                break;
                case self::SI_IMAGE_GIF:
                    imagegif($this->im);
                break;
                default:
                    imagepng($this->im);
                break;
            }
        } else {
            $error = true;
            echo '<hr /><strong>'
                .'Failed to generate captcha image, content has already been '
                .'output.<br />This is most likely due to misconfiguration or '
                .'a PHP error was sent to the browser.</strong>';
        }

        imagedestroy($this->im);
        $imgData = ob_get_contents();
        ob_end_clean();
        restore_error_handler();
        return ['error' => $error, 'data' => base64_encode($imgData)];
    }

    /**
     * Gets the code and returns the binary audio file for the stored captcha code
     *
     * @return string|The audio representation of the captcha in Wav format
     */
    protected function getAudibleCode() {
        $letters = []; $eq = null;
        $code    = $this->getCode(true, true);

        if ($code['code'] == '') {
            if (strlen($this->display_value) > 0) {
                $code = ['code' => $this->display_value, 'display' => $this->display_value];
            } else {
                $this->createCode();
                $code = $this->getCode(true);
            }
        }

        if (preg_match('/(\d+) (\+|-|x) (\d+)/i', $code['display'], $eq)) {
            $left  = $eq[1];
            $sign  = str_replace(['+', '-', 'x'], ['plus', 'minus', 'times'], $eq[2]);
            $right = $eq[3];
            $letters = [$left, $sign, $right];
        } else {
            $length = strlen($code['code']);
            for($i = 0; $i < $length; ++$i) {
                $letter    = $code['code']{$i};
                $letters[] = $letter;
            }
        }

        try {
            return $this->generateWAV($letters);
        } catch(Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Gets a captcha code from a wordlist
     */
    protected function readCodeFromFile($numWords = 1) {
        $fp = fopen($this->wordlist_file, 'rb');
        if (!$fp) {
            return false;
        }

        $fsize = filesize($this->wordlist_file);
        if ($fsize < 128) return false; // too small of a list to be effective

        if ((int)($numWords) < 1 || (int)($numWords) > 5) $numWords = 1;

        $words = [];
        $i = 0;
        do {
            fseek($fp, mt_rand(0, $fsize - 64), SEEK_SET); // seek to a random position of file from 0 to filesize-64
            $data = fread($fp, 64); // read a chunk from our random position
            $data = preg_replace("/\r?\n/", "\n", $data);

            $start = @strpos($data, "\n", mt_rand(0, 56)) + 1; // random start position
            $end   = @strpos($data, "\n", $start);          // find end of word

            if ($start === false) {
                // picked start position at end of file
                continue;
            } else if ($end === false) {
                $end = strlen($data);
            }

            $word = strtolower(substr($data, $start, $end - $start)); // return a line of the file
            $words[] = $word;
        } while (++$i < $numWords);

        fclose($fp);

        if ($numWords < 2) {
            return $words[0];
        } else {
            return $words;
        }
    }

    /**
     * Generates a random captcha code from the set character set
     * @param int $code_length
     * @return string
     */
    protected function generateCode(int $code_length = 6) {
        $code = '';
        $code_length = $this->code_length != $code_length ? $code_length : $this->code_length;
        if (function_exists('mb_strlen')) {
            for($i = 1, $cslen = mb_strlen($this->charset); $i <= $code_length; ++$i) {
                $code .= mb_substr($this->charset, mt_rand(0, $cslen - 1), 1, 'UTF-8');
            }
        } else {
            for($i = 1, $cslen = strlen($this->charset); $i <= $code_length; ++$i) {
                $code .= substr($this->charset, mt_rand(0, $cslen - 1), 1);
            }
        }

        return $code;
    }

    /**
     * Checks the entered code against the value stored in the session or sqlite database, handles case sensitivity
     * Also clears the stored codes if the code was entered correctly to prevent re-use
     */
    protected function validate() {
        $this->correct_code = false;

        if (!is_string($this->code) || strlen($this->code) == 0) {
            $code = $this->getCode();
        } else {
            $code = $this->code;
        }

        if (empty($code)) { return; }
        if ($this->case_sensitive == false && preg_match('/[A-Z]/', $code)) {
            $this->case_sensitive = true;
        }

        $code_entered = trim( (($this->case_sensitive) ? $this->code_entered : strtolower($this->code_entered)));
        if (!empty($code) && !empty($code_entered)) {
            if (strpos($code, ' ') !== false) {
                // for multi word captchas, remove more than once space from input
                $code_entered = preg_replace('/\s+/', ' ', $code_entered);
                $code_entered = strtolower($code_entered);
            }

            if ((string)$code == (string)$code_entered) {
                $this->correct_code = true;
                $this->clearCodeFromDatabase();
            }
        }
    }

    /**
     * Saves the code to the sqlite database
     */
    protected function saveCodeToDatabase() {
        $id = $this->getCaptchaId(false);
        $id = empty($id) ? common::visitorIp()['v4'] : $id;
        $this->clearCodeFromDatabase();
        common::$sql['default']->insert("INSERT INTO `{prefix_captcha}` SET "
                    . "`id` = ?, "
                    . "`code` = ?, "
                    . "`code_display` = ?, "
                    . "`namespace` = ?, "
                    . "`created` = ?;",
        [md5($id),stringParser::encode($this->code),stringParser::encode($this->code_display),stringParser::encode($this->namespace),time()]);
        if(common::$sql['default']->lastInsertId() >= 1) {
            return true;
        }

        return false;
    }

    /**
     * Get a code from the sqlite database for ip address/captchaId.
     *
     * @return string|array Empty string if no code was found or has expired,
     * otherwise returns the stored captcha code.  If a captchaId is set, this
     * returns an array with indices "code" and "code_disp"
     */
    protected function getCodeFromDatabase() {
        $params = [md5(common::visitorIp()['v4']),stringParser::encode($this->namespace)];
        if (Securimage::$_captchaId !== null) {
            $params = [md5(Securimage::$_captchaId),stringParser::encode($this->namespace)];
        }

        $row = common::$sql['default']->fetch("SELECT `code`,`created`,`code_display` FROM `{prefix_captcha}` WHERE `id` = ? AND `namespace` = ?;",$params);
        if(common::$sql['default']->rowCount()) {
            if (!$this->isCodeExpired($row['created'])) {
                if (Securimage::$_captchaId !== null) {
                    return ['code' => stringParser::decode($row['code']), 'code_disp' => stringParser::decode($row['code_display'])]; // return an array when using captchaId
                } else {
                    return stringParser::decode($row['code']);
                }
            }
        }

        return '';
    }
    
    /**
     * Set the namespace for the captcha being stored in the session or database.
     *
     * @param string $namespace  Namespace value, String consisting of characters "a-zA-Z0-9_-"
     */
    public function setNamespace($namespace) {
        $namespace = substr(preg_replace('/[^a-z0-9-_]/i', '', $namespace), 0, 64);
        if (!empty($namespace)) {
            $this->namespace = $namespace;
        } else {
            $this->namespace = 'default';
        }
    }

    /**
     * Remove an entered code from the database
     */
    protected function clearCodeFromDatabase() {
        $id = empty(Securimage::$_captchaId) ? common::visitorIp()['v4'] : Securimage::$_captchaId;
        common::$sql['default']->delete("DELETE FROM `{prefix_captcha}` WHERE `id` = ? AND `namespace` = ?;", [md5($id),stringParser::encode($this->namespace)]);
        $qry = common::$sql['default']->select("SELECT `id` FROM `{prefix_captcha}` WHERE `created` < ".(time()-(30*30)).";");
        foreach($qry as $get) {
            common::$sql['default']->delete("DELETE FROM `{prefix_captcha}` WHERE `id` = ?;", [$get['id']]);
        }
    }

    /**
     * Deletes old codes from sqlite database
     */
    public function clearOldCodesFromDatabase() {
        $limit = (!is_numeric($this->expiry_time) || $this->expiry_time < 1) ? 86400 : $this->expiry_time;
        common::$sql['default']->delete("DELETE FROM `{prefix_captcha}` WHERE (? - created) > ?;", [time(),$limit]);
    }

    /**
     * Checks to see if the captcha code has expired and cannot be used
     * @param integer $creation_time
     */
    protected function isCodeExpired(int $creation_time) {
        $expired = true;
        if (!is_numeric($this->expiry_time) || $this->expiry_time < 1) {
            $expired = false;
        } else if (time() - $creation_time < $this->expiry_time) {
            $expired = false;
        }

        return $expired;
    }

    /**
     * Generate a wav file given the $letters in the code
     * @todo Add ability to merge 2 sound files together to have random background sounds
     * @param array $letters
     * @return string The binary contents of the wav file
     */
    protected function generateWAV($letters) {
        $wavCaptcha = new WavFile();
        $first      = true;     // reading first wav file
        if ($this->audio_use_sox && !is_executable($this->sox_binary_path)) {
            throw new Exception("Path to SoX binary is incorrect or not executable");
        }

        foreach ($letters as $letter) {
            $letter = strtoupper($letter);
            try {
                $letter_file = realpath($this->audio_path) . DIRECTORY_SEPARATOR . $letter . '.wav';
                if ($this->audio_use_sox) {
                    $sox_cmd = sprintf("%s %s -t wav - %s",
                                       $this->sox_binary_path,
                                       $letter_file,
                                       $this->getSoxEffectChain());

                    $data = `$sox_cmd`;

                    $l = new WavFile();
                    $l->setIgnoreChunkSizes(true);
                    $l->setWavData($data);
                } else {
                    $l = new WavFile($letter_file);
                }

                if ($first) {
                    // set sample rate, bits/sample, and # of channels for file based on first letter
                    $wavCaptcha->setSampleRate($l->getSampleRate())
                               ->setBitsPerSample($l->getBitsPerSample())
                               ->setNumChannels($l->getNumChannels());
                    $first = false;
                }

                // append letter to the captcha audio
                $wavCaptcha->appendWav($l);

                // random length of silence between $audio_gap_min and $audio_gap_max
                if ($this->audio_gap_max > 0 && $this->audio_gap_max > $this->audio_gap_min) {
                    $wavCaptcha->insertSilence( mt_rand($this->audio_gap_min, $this->audio_gap_max) / 1000.0 );
                }
            } catch (Exception $ex) {
                // failed to open file, or the wav file is broken or not supported
                // 2 wav files were not compatible, different # channels, bits/sample, or sample rate
                throw new Exception("Error generating audio captcha on letter '$letter': " . $ex->getMessage());
            }
        }

        /********* Set up audio filters *****************************/
        $filters = [];
        if ($this->audio_use_noise == true) {
            // use background audio - find random file
            $wavNoise   = false;
            $randOffset = 0;

            // uncomment to try experimental SoX noise generation.
            // warning: sounds may be considered annoying
            if ($this->audio_use_sox) {
                $duration = $wavCaptcha->getDataSize() / ($wavCaptcha->getBitsPerSample() / 8) /
                            $wavCaptcha->getNumChannels() / $wavCaptcha->getSampleRate();
                $duration = round($duration, 2);
                $wavNoise = new WavFile();
                $wavNoise->setIgnoreChunkSizes(true);
                $noiseData = $this->getSoxNoiseData($duration,
                                                    $wavCaptcha->getNumChannels(),
                                                    $wavCaptcha->getSampleRate(),
                                                    $wavCaptcha->getBitsPerSample());
                $wavNoise->setWavData($noiseData, true);

            } else if ( ($noiseFile = $this->getRandomNoiseFile()) !== false) {
                try {
                    $wavNoise = new WavFile($noiseFile, false);
                } catch(Exception $ex) {
                    throw $ex;
                }

                // start at a random offset from the beginning of the wavfile
                // in order to add more randomness

                $randOffset = 0;

                if ($wavNoise->getNumBlocks() > 2 * $wavCaptcha->getNumBlocks()) {
                    $randBlock = mt_rand(0, $wavNoise->getNumBlocks() - $wavCaptcha->getNumBlocks());
                    $wavNoise->readWavData($randBlock * $wavNoise->getBlockAlign(), $wavCaptcha->getNumBlocks() * $wavNoise->getBlockAlign());
                } else {
                    $wavNoise->readWavData();
                    $randOffset = mt_rand(0, $wavNoise->getNumBlocks() - 1);
                }
            }

            if ($wavNoise !== false) {
                $mixOpts = ['wav'  => $wavNoise,
                                 'loop' => true,
                                 'blockOffset' => $randOffset];

                $filters[WavFile::FILTER_MIX]       = $mixOpts;
                $filters[WavFile::FILTER_NORMALIZE] = $this->audio_mix_normalization;
            }
        }

        if ($this->degrade_audio == true) {
            // add random noise.
            // any noise level below 95% is intensely distorted and not pleasant to the ear
            $filters[WavFile::FILTER_DEGRADE] = mt_rand(95, 98) / 100.0;
        }

        if (!empty($filters)) {
            $wavCaptcha->filter($filters);  // apply filters to captcha audio
        }

        return $wavCaptcha->__toString();
    }

    public function getRandomNoiseFile() {
        $return = false;
        if ( ($dh = opendir($this->audio_noise_path)) !== false ) {
            $list = [];

            while ( ($file = readdir($dh)) !== false ) {
                if ($file == '.' || $file == '..') continue;
                if (strtolower(substr($file, -4)) != '.wav') continue;

                $list[] = $file;
            }

            closedir($dh);

            if (sizeof($list) > 0) {
                $file   = $list[array_rand($list, 1)];
                $return = $this->audio_noise_path . DIRECTORY_SEPARATOR . $file;
            }
        }

        return $return;
    }
    
    protected function getSoxEffectChain($numEffects = 2) {
        $effectsList = ['bend', 'chorus', 'overdrive', 'pitch', 'reverb', 'tempo', 'tremolo'];
        $effects     = array_rand($effectsList, $numEffects);
        $outEffects  = [];

        if (!is_array($effects)) $effects = [$effects];

        foreach($effects as $effect) {
            $effect = $effectsList[$effect];

            switch($effect) {
                case 'bend':
                    $delay = mt_rand(0, 15) / 100.0;
                    $cents = mt_rand(-120, 120);
                    $dur   = mt_rand(75, 400) / 100.0;
                    $outEffects[] = "$effect $delay,$cents,$dur";
                    break;

                case 'chorus':
                    $gainIn  = mt_rand(75, 90) / 100.0;
                    $gainOut = mt_rand(70, 95) / 100.0;
                    $chorStr = "$effect $gainIn $gainOut";

                    for ($i = 0; $i < mt_rand(2, 3); ++$i) {
                        $delay = mt_rand(20, 100);
                        $decay = mt_rand(10, 100) / 100.0;
                        $speed = mt_rand(20, 50) / 100.0;
                        $depth = mt_rand(150, 250) / 100.0;

                        $chorStr .= " $delay $decay $speed $depth -s";
                    }

                    $outEffects[] = $chorStr;
                    break;

                case 'overdrive':
                    $gain = mt_rand(5, 25);
                    $color = mt_rand(20, 70);
                    $outEffects[] = "$effect $gain $color";
                    break;

                case 'pitch':
                    $cents = mt_rand(-300, 300);
                    $outEffects[] = "$effect $cents";
                    break;

                case 'reverb':
                    $reverberance = mt_rand(20, 80);
                    $damping      = mt_rand(10, 80);
                    $scale        = mt_rand(85, 100);
                    $depth        = mt_rand(90, 100);
                    $predelay     = mt_rand(0, 5);
                    $outEffects[] = "$effect $reverberance $damping $scale $depth $predelay";
                    break;

                case 'tempo':
                    $factor = mt_rand(65, 135) / 100.0;
                    $outEffects[] = "$effect -s $factor";
                    break;

                case 'tremolo':
                    $hz    = mt_rand(10, 30);
                    $depth = mt_rand(40, 85);
                    $outEffects[] = "$effect $hz $depth";
                    break;
            }
        }

        return implode(' ', $outEffects);
    }

    /**
     * Not yet used - Generate random background noise from sweeping oscillators
     *
     * @param float $duration  How long in seconds the generated sound will be
     * @param int $numChannels Number of channels in output wav
     * @param int $sampleRate  Sample rate of output wav
     * @param int $bitRate     Bits per sample (8, 16, 24)
     * @return string          Audio data in wav format
     */
    protected function getSoxNoiseData($duration, $numChannels, $sampleRate, $bitRate) {
        $shapes = ['sine', 'square', 'triangle', 'sawtooth', 'trapezium'];
        $steps  = [':', '+', '/', '-'];
        $selShapes = array_rand($shapes, 2);
        $selSteps  = array_rand($steps, 2);
        $sweep0    = [];
        $sweep0[0] = mt_rand(100, 700);
        $sweep0[1] = mt_rand(1500, 2500);
        $sweep1    = [];
        $sweep1[0] = mt_rand(500, 1000);
        $sweep1[1] = mt_rand(1200, 2000);

        if (mt_rand(0, 10) % 2 == 0) {
            $sweep0 = array_reverse($sweep0);
        }

        if (mt_rand(0, 10) % 2 == 0) {
            $sweep1 = array_reverse($sweep1);
        }

        $cmd = sprintf("%s -c %d -r %d -b %d -n -t wav - synth noise create vol 0.3 synth %.2f %s mix %d%s%d vol 0.3 synth %.2f %s fmod %d%s%d vol 0.3",
                       $this->sox_binary_path,
                       $numChannels,
                       $sampleRate,
                       $bitRate,
                       $duration,
                       $shapes[$selShapes[0]],
                       $sweep0[0],
                       $steps[$selSteps[0]],
                       $sweep0[1],
                       $duration,
                       $shapes[$selShapes[1]],
                       $sweep1[0],
                       $steps[$selSteps[1]],
                       $sweep1[1]);
        $data = `$cmd`;

        return $data;
    }

    /**
     * Return a wav file saying there was an error generating file
     *
     * @return string The binary audio contents
     */
    protected function audioError() {
        return file_get_contents(basePath. '/inc/securimage/audio/en/error.wav');
    }

    /**
     * Checks to see if headers can be sent and if any error has been output to the browser
     *
     * @return bool true if headers haven't been sent and no output/errors will break audio/images, false if unsafe
     */
    protected function canSendHeaders() {
        if (headers_sent()) {
            return false;
        } // output has been flushed and headers have already been sent
        else if (strlen((string) ob_get_contents()) > 0) {
            return false;
        } // headers haven't been sent, but there is data in the buffer that will break image and audio data

        return true;
    }

    /**
     * Return a random float between 0 and 0.9999
     *
     * @return float Random float between 0 and 0.9999
     */
    function frand() {
        return 0.0001 * mt_rand(0,9999);
    }

    /**
     * Convert an html color code to a Securimage_Color
     * @param string $color
     * @param Securimage_Color $default The defalt color to use if $color is invalid
     * @return Securimage_Color
     */
    protected function initColor($color, $default) {
        if ($color == null) {
            return new Securimage_Color($default);
        } else if (is_string($color)) {
            try {
                return new Securimage_Color($color);
            } catch (Exception $e) {
                return new Securimage_Color($default);
            }
        } else if (is_array($color) && sizeof($color) == 3) {
            return new Securimage_Color($color[0], $color[1], $color[2]);
        } else {
            return new Securimage_Color($default);
        }
    }

    /**
     * Error handler used when outputting captcha image or audio.
     * This error handler helps determine if any errors raised would
     * prevent captcha image or audio from displaying.  If they have
     * no effect on the output buffer or headers, true is returned so
     * the script can continue processing.
     * See https://github.com/dapphp/securimage/issues/15
     *
     * @param int $errno
     * @param string $errstr
     * @param string $errfile
     * @param int $errline
     * @param array $errcontext
     * @return boolean true if handled, false if PHP should handle
     */
    public function errorHandler($errno, $errstr, $errfile = '', $errline = 0, $errcontext = []) {
        // get the current error reporting level
        $level = error_reporting();

        // if error was supressed or $errno not set in current error level
        if ($level == 0 || ($level & $errno) == 0) return true;

        return false;
    }
}
