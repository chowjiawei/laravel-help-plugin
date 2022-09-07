<?php

namespace Chowjiawei\Helpers\Channels;

use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;

class LarkRobotChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toLarkRobot($notifiable);
        $key = $notifiable->routes['lark'];
        $data = array(
            "msg_type" => "text",
            "content" => [
                "text" => $message
            ]
        );
        $client = new Client();
        $key = is_array($key) ? $key : array($key);
        foreach ($key as $keys) {
            $url = 'https://open.feishu.cn/open-apis/bot/v2/hook/' . $keys;
            $response = $client->post($url, [\GuzzleHttp\RequestOptions::JSON => $data ]);
        }
    }
}
