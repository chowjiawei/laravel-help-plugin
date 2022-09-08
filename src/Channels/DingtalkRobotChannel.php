<?php

namespace Chowjiawei\Helpers\Channels;

use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;

class DingtalkRobotChannel
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
        $message = $notification->toDingtalkRobot($notifiable);
        $keys = $notifiable->routes['dingtalk_robot'];
        if (is_array($message)) {
            $data = array("msgtype" => "markdown", "markdown" => [
                "title" => $message[1],
                "text" => $message[0],
            ]);
        } else {
            $data = array("msgtype" => "markdown", "markdown" => [
                "title" => '通知',
                "text" => $message,
            ]);
        }
        $client = new Client();
        if (strstr($keys, ',')) {
            $keys = explode(",", $keys);
            foreach ($keys as $key) {
                $url = 'https://oapi.dingtalk.com/robot/send?access_token=' . $key;
                $response = $client->post($url, [\GuzzleHttp\RequestOptions::JSON => $data]);
            }
            return;
        }
        $keys = is_array($keys) ? $keys : array($keys);
        foreach ($keys as $key) {
            $url = 'https://oapi.dingtalk.com/robot/send?access_token=' . $key;
            $response = $client->post($url, [\GuzzleHttp\RequestOptions::JSON => $data]);
        }
    }
}
