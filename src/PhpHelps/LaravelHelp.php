<?php

namespace Chowjiawei\Helpers\PhpHelps;

use Illuminate\Support\Facades\DB;

class LaravelHelp
{
    public $country;

    public function __construct()
    {
        $this->country = config('helpers.country');
    }


    /**
     * Get All Country.
     *
     * @return  array
     */
    public function getAllCountry(): array
    {
        return $this->country;
    }

    /**
     * Get Country Name.
     *
     * @return  string
     */
    public function getCountryName($countryCode): string
    {
        if (isset($this->country[$countryCode])) {
            return $this->country[$countryCode];
        }
    }

    /**
     * Get Country Code.
     *
     * @return  string
     */
    public function getCountryCode($countryName)
    {
        if (array_search($countryName, $this->country) !== false) {
            return array_search($countryName, $this->country);
        }
        return null;
    }

    /**
     * Get All Exchange Code.
     *
     * @return  array
     */
    public function getAllExchangeCode(): array
    {
        return config('helpers.exchangeCode');
    }


    public function changeHWWord($text)
    {
        $words = config('helpers-pinyin')['hw'];
        $chinesePinYins = array_keys($words);
        $wPinYins = array_values($words);
        $wWord = '';
        $allIns = [];
        foreach ($chinesePinYins as $chinesePinYin) {
            if (stripos($text, $chinesePinYin) !== false) {
                $allIns[] = $chinesePinYin;
            }
        }
        if (!empty($allIns)) {
            $longWord = $this->getLongItem($allIns);
            $wWord = $wWord . $words[$longWord];
            $newText = substr($text, mb_strlen($longWord));
            return $wWord;
        }
        return false;
    }

    public function changeWHWord($text)
    {
        $words = config('helpers-pinyin')['wh'];
        $chinesePinYins = array_keys($words);
        $wPinYins = array_values($words);
        $wWord = '';
        $allIns = [];
        foreach ($chinesePinYins as $chinesePinYin) {
            if (stripos($text, $chinesePinYin) !== false) {
                $allIns[] = $chinesePinYin;
            }
        }
        if (!empty($allIns)) {
            $longWord = $this->getLongItem($allIns);
            $wWord = $wWord . $words[$longWord];
            $newText = substr($text, mb_strlen($longWord));
            return $wWord;
        }
        return false;
    }

    public function changeLongWHWord($text)
    {
        try {
            $texts = explode(' ', $text);
            $result = [];
            foreach ($texts as $t) {
                $result[] = $this->changeWHWord($t);
            }
            return implode(' ', $result);
        } catch (\Exception $exception) {
            throw new \Exception('Pinyin is connected with spaces');
        }
    }


    public function changeLongHWWord($text)
    {
        try {
            $texts = explode(' ', $text);
            $result = [];
            foreach ($texts as $t) {
                $result[] = $this->changeHWWord($t);
            }
            return implode(' ', $result);
        } catch (\Exception $exception) {
            throw new \Exception('Pinyin is connected with spaces');
        }
    }

    public function getLongItem($array)
    {
        $index = 0;
        foreach ($array as $k => $v) {
            if (strlen($array[$index]) < strlen($v)) {
                $index = $k;
            }
        }
        return $array[$index];
    }
}
