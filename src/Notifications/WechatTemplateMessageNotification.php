<?php

namespace Chowjiawei\Helpers\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Chowjiawei\Helpers\Channels\WechatTemplateMessageChannel;
use EasyWeChat\Factory;
use EasyWeChat\Kernel\Messages\Text;

class WechatTemplateMessageNotification extends Notification
{
    use Queueable;

    public $data;
    public $template;

    public function __construct($data, $template = null)
    {
        $this->data = $data;
        $this->template = $template;
    }

    public function via($notifiable)
    {
        return [WechatTemplateMessageChannel::class];
    }

    public function toWechatTemplateMessage($notifiable)
    {
        $data = $this->data;
        $template = $this->template;
        return [$data, $template];
    }
}
