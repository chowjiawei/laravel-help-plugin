<?php

namespace Chowjiawei\Helpers\Notifications;

use Carbon\Carbon;
use Chowjiawei\Helpers\Channels\DingtalkRobotChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DingtalkRobotNotification extends Notification
{
    use Queueable;
    public function __construct($text, $title)
    {
        $this->text=$text;
        $this->title=$title;
    }

    public function via($notifiable)
    {
        return [DingtalkRobotChannel::class];
    }

    public function toDingtalkRobot($notifiable)
    {
        return [
            $this->text,
            $this->title
        ];
    }
}
