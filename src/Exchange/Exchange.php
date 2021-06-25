<?php

namespace Chowjiawei\Helpers\Exchange;

use Cache;
use GuzzleHttp;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Exchange extends Controller
{
    /**
     * Get Exchange
     *
     * @return \Illuminate\Http\Response
     */
    public function getChangerates()
    {
        $appid = config('helpers.exchange.appid');
        $baseCurrency = config('helpers.exchange.base_currency');
        $client = new Client([
            'timeout' => 52.0,
        ]);
        $url = 'https://openexchangerates.org/api/latest.json?app_id=' . $appid . '&base=' . $baseCurrency;
        $response = $client->request('GET', $url);
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Get Exchange
     *
     * $symbols array
     * @return \Illuminate\Http\Response
     */
    public function getSymbolChangerates($symbols = [])
    {
        $symbol = implode(" ", $symbols);
        $appid = config('helpers.exchange.appid');
        $baseCurrency = config('helpers.exchange.base_currency');
        if ($symbols) {
            $url = 'https://openexchangerates.org/api/latest.json?app_id=' . $appid . '&base=' . $baseCurrency . '＆symbols=' . $symbol;
        } else {
            $url = 'https://openexchangerates.org/api/latest.json?app_id=' . $appid . '&base=' . $baseCurrency;
        }
        $client = new Client([
            'timeout' => 52.0,
        ]);
        $response = $client->request('GET', $url);
        return json_decode($response->getBody()->getContents(), true);
    }
}
