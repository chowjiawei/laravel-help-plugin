<?php

namespace Chowjiawei\Helpers\Exchange;

use App\Http\Controllers\Controller;
use http\Client\Response;
use Illuminate\Http\Request;
use Cache;
use GuzzleHttp;
use GuzzleHttp\Client;


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
        $appid=config('helpers.exchange.appid');
        $baseCurrency=config('helpers.exchange.base_currency');
        $client = new Client([
            'timeout'  => 52.0,
        ]);
        $url='https://openexchangerates.org/api/latest.json?app_id='.$appid.'&base='.$baseCurrency;
        $response = $client->request('GET', $url);
        $value=json_decode($response->getBody()->getContents(), true);
        return $value;
    }
}
