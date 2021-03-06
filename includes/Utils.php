<?php
/**
 *  MIT License
 *
 *  Copyright (c) 2018 Krzysztof "RouNdeL" Zdulski
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 *  SOFTWARE.
 */

/**
 * Created by PhpStorm.
 * User: Krzysiek
 * Date: 2018-10-30
 * Time: 17:06
 */
class Utils
{
    /**
     * @var Utils
     */
    private static $instance;
    const DEFAULT_LANG = "en";
    const AVAILABLE_LANGUAGES = ["en", "pl", "de"];
    const LANGUAGE_NATIVE_NAMES = ["English", "Polski", "Deutsch"];

    public $strings;
    public $lang;

    /**
     * Utils constructor.
     * @param null $lang
     */
    public function __construct($lang = null)
    {
        if($lang === null)
            $lang = isset($_COOKIE["lang"]) ? $_COOKIE["lang"] : self::DEFAULT_LANG;
        $this->lang = $lang;
        $this->loadStrings();
    }

    private function loadStrings()
    {
        $lang = $this->lang;
        $path = __DIR__ . "/../_lang/$lang.json";
        $file = file_get_contents($path);
        if($file == false)
        {
            unset($_COOKIE["lang"]);
            $this->lang = self::DEFAULT_LANG;
            $this->loadStrings();
            return;
        }
        $this->strings = json_decode($file, true);
    }

    public function _getString(string $name)
    {
        if($this->strings != null && isset($this->strings[$name]))
        {
            return $this->strings[$name];
        }

        //return null;
        //Only for development purposes
        return "_" . $name;
    }

    public static function getInstance()
    {
        if(self::$instance == null)
        {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function getString(string $name)
    {
        return self::getInstance()->_getString($name);
    }

    /**
     * @return null|string
     */
    public static function getLang()
    {
        return self::getInstance()->lang;
    }

}