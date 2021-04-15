<?php

namespace Chowjiawei\Helpers\Channels;

use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;

class DingtalkRobotChannel
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
        $message = $notification->toDingtalkRobot($notifiable);
        $key=$notifiable->routes['dingtalk_robot'];
        $data=array("msgtype"=>"markdown", "markdown"=> [
            "title"=> '店铺通知',
            "text"=> $message,
        ]);
        $client = new Client();
        $key=is_array($key)?$key:array($key);
        foreach ($key as $keys) {
            $url='https://oapi.dingtalk.com/robot/send?access_token='.$keys;
            $response = $client->post($url, [\GuzzleHttp\RequestOptions::JSON => $data ]);
        }
    }
}
