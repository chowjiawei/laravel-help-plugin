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
     * 获取汇率
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
        $value = json_decode($response->getBody()->getContents(), true);
        return $value;
    }
}
