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
    public $inUser;

    public function __construct($message, bool $inUser = false)
    {
        $this->message = $message;

        $this->inUser = $inUser;
    }

    public function via($notifiable)
    {
        return [WechatRobotChannel::class];
    }

    public function toWechatRobot($notifiable)
    {
        return $this->message;
    }
    public function toWechatRobotUser($notifiable)
    {
        return $this->inUser;
    }
}
