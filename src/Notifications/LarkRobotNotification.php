<?php

namespace Chowjiawei\Helpers\Notifications;

use Chowjiawei\Helpers\Channels\LarkRobotChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LarkRobotNotification extends Notification
{
    use Queueable;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return [LarkRobotChannel::class];
    }

    public function toLarkRobot($notifiable)
    {
        return $this->message;
    }
}
