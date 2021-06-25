<?php

namespace Chowjiawei\Helpers\PhpHelps;


class LaravelHelp
{
    public $country;

    public function __construct()
    {
        $this->country=config('helpers.country');
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
}
