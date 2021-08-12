<?php

namespace Chowjiawei\Helpers\Facade;

use \Illuminate\Support\Facades\Facade as LaravelFacade;

class Helper extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'Helper';
    }

    public static function allCountry() {
        return config('helpers.country');
    }
    /**
     * Get Country Name.
     *
     * @return  string
     */
    public static function getCountryName($countryCode): string
    {
        if (isset(self::allCountry()[$countryCode])) {
            return self::allCountry()[$countryCode];
        }
    }

    /**
     * Get Country Code.
     *
     * @return  string
     */
    public static function getCountryCode($countryName)
    {
        if (array_search($countryName, self::allCountry()) !== false) {
            return array_search($countryName, self::allCountry());
        }
        return null;
    }

    /**
     * Get All Exchange Code.
     *
     * @return  array
     */
    public static function getAllExchangeCode(): array
    {
        return config('helpers.exchangeCode');
    }


    public static function changeHWWord($text)
    {
        $words=config('helpers-pinyin')['hw'];
        $chinesePinYins=array_keys($words);
        $wPinYins=array_values($words);
        $wWord='';
        $allIns=[];
        foreach ($chinesePinYins as $chinesePinYin){
            if(stripos($text,$chinesePinYin)!==false){
                $allIns[]=$chinesePinYin;
            }
        }
        if(!empty($allIns)){
            $longWord=self::getLongItem($allIns);
            $wWord=$wWord.$words[$longWord];
            $newText = substr($text, mb_strlen($longWord));
            return $wWord;
        }
        return false;
    }

    public static function changeWHWord($text)
    {
        $words=config('helpers-pinyin')['wh'];
        $chinesePinYins=array_keys($words);
        $wPinYins=array_values($words);
        $wWord='';
        $allIns=[];
        foreach ($chinesePinYins as $chinesePinYin){
            if(stripos($text,$chinesePinYin)!==false){
                $allIns[]=$chinesePinYin;
            }
        }
        if(!empty($allIns)){
            $longWord=self::getLongItem($allIns);
            $wWord=$wWord.$words[$longWord];
            $newText = substr($text, mb_strlen($longWord));
            return $wWord;
        }
        return false;
    }

    public static function changeLongWHWord($text)
    {
        try {
            $texts=explode(' ',$text);
            $result=[];
            foreach ($texts as $t){
                $result[]=self::changeWHWord($t);
            }
            return implode(' ',$result);
        }catch (\Exception $exception){
            throw new \Exception('Pinyin is connected with spaces');
        }

    }


    public static function changeLongHWWord($text)
    {
        try {
            $texts=explode(' ',$text);
            $result=[];
            foreach ($texts as $t){
                $result[]=self::changeHWWord($t);
            }
            return implode(' ',$result);
        }catch (\Exception $exception){
            throw new \Exception('Pinyin is connected with spaces');
        }

    }

    public static function getLongItem($array) {
        $index = 0;
        foreach ($array as $k => $v) {
            if (strlen($array[$index]) < strlen($v))
                $index = $k;
        }
        return $array[$index];
    }
}
