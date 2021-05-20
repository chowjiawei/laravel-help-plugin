<?php

namespace Chowjiawei\Helpers\PhpHelps;


class LaravelHelp
{
    public function __construct()
    {
        $this->country=config('helpers.country');
    }
    /**
     * Get Two Number Count.
     *
     * @param string|integer $num1
     * @param string|integer $num2
     * @return  integer
     */
    public function getCountNumber($num1, $num2)
    {
        return $num1 + $num2;
    }

    /**
     * Get A Array Count.
     *
     * @param array $array
     * @return  integer
     */
    public function getArrayCount($array)
    {
        $sum = 0;
        foreach ($array as $num) {
            $sum += $num;
        }
        return $sum;
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
        return config('helpers.exchange_code');
    }


}
