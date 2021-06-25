<?php

namespace Chowjiawei\Helpers\Notifications;

use Carbon\Carbon;
use Chowjiawei\Helpers\Channels\WechatRobotChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class WechatRobotNotification extends Notification
{
    use Queueable;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return [WechatRobotChannel::class];
    }

    public function toWechatRobot($notifiable)
    {
        return $this->message;
    }
}
