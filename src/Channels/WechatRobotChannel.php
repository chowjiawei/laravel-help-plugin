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
        $keys = $notifiable->routes['wechat_robot'];
        $data = array("msgtype" => "markdown", "markdown" => [
            "content" => $message,
        ]);
        $client = new Client();
        $keys = is_array($keys) ? $keys : array($keys);
        foreach ($keys as $key) {
            $url = 'https://qyapi.weixin.qq.com/cgi-bin/webhook/send?key=' . $key;
            $response = $client->post($url, [\GuzzleHttp\RequestOptions::JSON => $data]);
        }
    }
}
