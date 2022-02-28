<?php

namespace Chowjiawei\Helpers\Notifications;

use Chowjiawei\Helpers\Channels\WechatRobotChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class WechatRobotNotification extends Notification
{
    use Queueable;

    public $message;
    public $isUserBroadcast;

    public function __construct($message, bool $isUserBroadcast = false)
    {
        $this->message = $message;

        $this->isUserBroadcast = $isUserBroadcast;
    }

    public function via($notifiable)
    {
        return [WechatRobotChannel::class];
    }

    public function toWechatRobot($notifiable)
    {
        return $this->message;
    }
    public function toWechatRobotBroadcast($notifiable)
    {
        return $this->isUserBroadcast;
    }
}
