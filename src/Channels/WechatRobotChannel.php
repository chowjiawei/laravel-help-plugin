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
        $inUserBroadcast = $notification->toWechatRobotBroadcast($notifiable);
        $key=$notifiable->routes['wechat_robot'];
        if (!$inUserBroadcast) {
            $data=array("msgtype"=>"markdown", "markdown"=> [
                "content"=> $message,
            ]);
        }
        if ($inUserBroadcast) {
            $data=array("msgtype"=>"text", "text"=> [
                "content"=> $message,
                "mentioned_list"=>["@all"],
            ]);
        }
        $client = new Client();
        $key=is_array($key)?$key:array($key);
        foreach ($key as $keys) {
            $url='https://qyapi.weixin.qq.com/cgi-bin/webhook/send?key='.$keys;
            $client->post($url, [\GuzzleHttp\RequestOptions::JSON => $data ]);
        }
    }
}
