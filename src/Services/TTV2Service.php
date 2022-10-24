<?php

namespace Chowjiawei\Helpers\Services;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TTV2Service
{
    public function __construct()
    {
        $this->config = [
            'token' => config('helpers.tiktok.token'),
            'salt' => config('helpers.tiktok.salt'),
            'merchant_id' => config('helpers.tiktok.merchant_id'),
            'app_id' => config('helpers.tiktok.client_id'),
            'secret' => config('helpers.tiktok.client_secret'),
            'notify_url' => config('helpers.tiktok.notify_url'),
        ];
    }
    //查询订单
    public function query($trackNumber)
    {
        $config = $this->config;
        $order = ['out_order_no' => $trackNumber];
        $timestamp = Carbon::now()->timestamp;
        $str = substr(md5($timestamp), 5, 15);
        $body = json_encode($order);
        $sign = $this->makeSign('POST', '/api/apps/trade/v2/query_order', $body, $timestamp, $str);
        $client = new Client();
        $url = 'https://developer.toutiao.com/api/apps/trade/v2/query_order';
        $response = $client->post($url, [
                'json' => $order ,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Byte-Authorization' => 'SHA256-RSA2048 appid="' . $config['app_id'] . '",nonce_str=' . $str . ',timestamp="' . $timestamp . '",key_version="2",signature="' . $sign . '"'
                ]]);
        $data = json_decode($response->getBody()->getContents(), true);
        if ($data['err_no'] == 0) {
            return $data['data'];
        }
        return [];
    }


    //发起退款  发起后还需要审核 同意退款
    public function refund($trackNumber, $price, $itemOrderId)
    {
        $config = $this->config;
        $order = [
            'out_order_no' => $trackNumber,
            'out_refund_no' => $trackNumber,
            'order_entry_schema' => [
                'path' => 'pages/courseDetail/courseDetail',
                'params' => '{\"id\":\"96f8bbf8-57c6-4348-baf2-caffe18a9277\"}'
            ],
            "item_order_detail" => [
                [
                    "item_order_id" => $itemOrderId,
                    "refund_amount" => (int)$price
                ]
            ],
            'notify_url' => config('app.url') . '/api/general/tt-pay-v2/refund'
        ];

        $timestamp = Carbon::now()->timestamp;
        $str = substr(md5($timestamp), 5, 15);
        $body = json_encode($order);

        $sign = $this->makeSign('POST', '/api/apps/trade/v2/create_refund', $body, $timestamp, $str);
        $client = new Client();
        $url = 'https://developer.toutiao.com/api/apps/trade/v2/create_refund';
        $response = $client->post($url, [
                'json' => $order ,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Byte-Authorization' => 'SHA256-RSA2048 appid="' . $config['app_id'] . '",nonce_str=' . $str . ',timestamp="' . $timestamp . '",key_version="2",signature="' . $sign . '"'
                ]]);
        $data = json_decode($response->getBody()->getContents(), true);
//        dump($data);
        if ($data['err_no'] == 0) {
            return true;
        }
        return false;
    }

    //同意退款   钱在这里就会直接退回去
    public function agreeRefund($trackNumber)
    {
        $config = $this->config;

        $order = [
            'out_refund_no' => $trackNumber,
            'refund_audit_status' => 1,
        ];
        $timestamp = Carbon::now()->timestamp;
        $str = substr(md5($timestamp), 5, 15);
        $body = json_encode($order);

        $sign = $this->makeSign('POST', '/api/apps/trade/v2/merchant_audit_callback', $body, $timestamp, $str);
        $client = new Client();
        $url = 'https://developer.toutiao.com/api/apps/trade/v2/merchant_audit_callback';
        $response = $client->post($url, [
                'json' => $order ,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Byte-Authorization' => 'SHA256-RSA2048 appid="' . $config['app_id'] . '",nonce_str=' . $str . ',timestamp="' . $timestamp . '",key_version="2",signature="' . $sign . '"'
                ]]);
        $data = json_decode($response->getBody()->getContents(), true);
        if ($data['err_no'] == 0) {
            return true;
        }
        return false;
    }



    //发起分账
    public function settle($trackNumber, $desc)
    {
//        $trackNumber  分账的时候 财务写  这是分账的自定义id   $desc 分账描述
        $config = $this->config;

        $order = [
            'out_order_no' => $trackNumber,
            'out_settle_no' => $trackNumber,
            'settle_desc' => $desc,
//            'settle_params'=>"[{\"merchant_uid\":\"71034295218686712630\",\"amount\":".$amount."}]",
            'notify_url' => config('app.url') . '/api/general/tt-pay-v2/settle-callback'
        ];



        $timestamp = Carbon::now()->timestamp;
        $str = substr(md5($timestamp), 5, 15);
        $body = json_encode($order);

        $sign = $this->makeSign('POST', '/api/apps/trade/v2/create_settle', $body, $timestamp, $str);
        $client = new Client();
        $url = 'https://developer.toutiao.com/api/apps/trade/v2/create_settle';
        $response = $client->post($url, [
                'json' => $order ,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Byte-Authorization' => 'SHA256-RSA2048 appid="' . $config['app_id'] . '",nonce_str=' . $str . ',timestamp="' . $timestamp . '",key_version="2",signature="' . $sign . '"'
                ]]);
        $data = json_decode($response->getBody()->getContents(), true);
        if ($data['err_no'] == 0) {
            return true;
        }
        return false;
    }


    //查询退款
    public function getRefund($trackNumber)
    {
        $config = $this->config;

        $order = [
            'out_refund_no' => $trackNumber,
        ];
        $timestamp = Carbon::now()->timestamp;
        $str = substr(md5($timestamp), 5, 15);
        $body = json_encode($order);

        $sign = $this->makeSign('POST', '/api/apps/trade/v2/query_refund', $body, $timestamp, $str);
        $client = new Client();
        $url = 'https://developer.toutiao.com/api/apps/trade/v2/query_refund';
        $response = $client->post($url, [
                'json' => $order ,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Byte-Authorization' => 'SHA256-RSA2048 appid="' . $config['app_id'] . '",nonce_str=' . $str . ',timestamp="' . $timestamp . '",key_version="2",signature="' . $sign . '"'
                ]]);
        $data = json_decode($response->getBody()->getContents(), true);
        return $data;
    }



    //设置回调
    public function settingReturn()
    {
        $config = $this->config;
        $order = [
            'create_order_callback' => config('app.url') . '/api/general/tt-pay-v2/return-callback',
            'refund_callback' => config('app.url') . '/api/general/tt-pay-v2/refund',
            'pay_callback' => config('app.url') . '/api/general/tt-pay-v2/return',
        ];
        $timestamp = Carbon::now()->timestamp;
        $str = substr(md5($timestamp), 5, 15);
        $body = json_encode($order);
        $sign = $this->makeSign('POST', '/api/apps/trade/v2/settings', $body, $timestamp, $str);
        $client = new Client();
        $url = 'https://developer.toutiao.com/api/apps/trade/v2/settings';
        $response = $client->post($url, [
                'json' => $order ,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Byte-Authorization' => 'SHA256-RSA2048 appid="' . $config['app_id'] . '",nonce_str=' . $str . ',timestamp="' . $timestamp . '",key_version="2",signature="' . $sign . '"'
                ]]);
        $data = json_decode($response->getBody()->getContents(), true);
        return $data;
    }


    //查询设置的回调
    public function getSettingReturn()
    {
        $config = $this->config;
        $order = [];
        $timestamp = Carbon::now()->timestamp;
        $str = substr(md5($timestamp), 5, 15);
        $body = json_encode($order);
        $sign = $this->makeSign('POST', '/api/apps/trade/v2/query_settings', $body, $timestamp, $str);
        $client = new Client();
        $url = 'https://developer.toutiao.com/api/apps/trade/v2/query_settings';
        $response = $client->post($url, [
                'json' => $order ,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Byte-Authorization' => 'SHA256-RSA2048 appid="' . $config['app_id'] . '",nonce_str=' . $str . ',timestamp="' . $timestamp . '",key_version="2",signature="' . $sign . '"'
                ]]);
        $data = json_decode($response->getBody()->getContents(), true);
        if ($data['err_no'] == 0) {
            return $data['data'];
        }
        return [];
    }


//支付回调  处理支付的事情
    public function return(Request $request)
    {
        $status = $this->verify(json_encode($request->post()), $request->header()['byte-timestamp'][0], $request->header()['byte-nonce-str'][0], $request->header()['byte-signature'][0]);
        //搬运原来旧的逻辑
        if ($status) {
            return [
                "err_no" => 0,
                "err_tips" => "success"
            ];
        }
    }

    //预下单回调
    public function returnCallback(Request $request)
    {
        $status = $this->verify(str_replace("\\/", "/", json_encode($request->post(), JSON_UNESCAPED_UNICODE)), $request->header()['byte-timestamp'][0], $request->header()['byte-nonce-str'][0], $request->header()['byte-signature'][0]);
        if ($status) {

        }
    }

    public function makeSign($method, $url, $body, $timestamp, $nonce_str)
    {
        $text = $method . "\n" . $url . "\n" . $timestamp . "\n" . $nonce_str . "\n" . $body . "\n";
        $priKey = file_get_contents(storage_path() . '/pay/tt/private_key.pem');
        $privateKey = openssl_get_privatekey($priKey, '');
        openssl_sign($text, $sign, $privateKey, OPENSSL_ALGO_SHA256);
        $sign = base64_encode($sign);
        return $sign;
    }

    public function verify($http_body, $timestamp, $nonce_str, $sign)
    {
        $data = $timestamp . "\n" . $nonce_str . "\n" . $http_body . "\n";
        $publicKey = file_get_contents(storage_path() . '/pay/tt/platform_public_key.pem');
        if (!$publicKey) {
            return null;
        }
        $res = openssl_get_publickey($publicKey);
        $result = (bool)openssl_verify($data, base64_decode($sign), $res, OPENSSL_ALGO_SHA256);
        openssl_free_key($res);
        return $result;  //bool
    }
}
