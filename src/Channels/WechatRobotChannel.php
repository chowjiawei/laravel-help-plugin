<?php

namespace Chowjiawei\Helpers\Channels;

use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;
use PhpParser\Node\Expr\Array_;

class WechatRobotChannel
{
    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toWechatRobot($notifiable);
        $key = $notifiable->routes['wechat_robot'];
        $data = array("msgtype" => "markdown", "markdown" => [
            "content" => $message,
        ]);
        $client = new Client();
        $key = is_array($key) ? $key : array($key);
        foreach ($key as $keys) {
            $url = 'https://qyapi.weixin.qq.com/cgi-bin/webhook/send?key=' . $keys;
            $response = $client->post($url, [\GuzzleHttp\RequestOptions::JSON => $data]);
        }
    }
}
