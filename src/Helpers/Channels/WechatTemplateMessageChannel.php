<?php

namespace Chowjiawei\Helpers\Channels;

use EasyWeChat\Factory;
use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;
use PhpParser\Node\Expr\Array_;

class WechatTemplateMessageChannel
{
    /**
     * Send the given notification.
     *
     * 1.广播消息：当仅返回 （消息内容）时 ，触发广播行为，给所有用户发送（消息内容）广播。
     * 2.指定用户：当完整返回openid，模板id，消息内容时，触发模板消息行为，使用模板id发送给指定openid用户以消息内容。
     *
     * 使用方法：
     * notification 可以使用 toWechatTemplateMessage方法
     *
     * toWechatTemplateMessage方法中返回一个数组：（   消息内容（数组格式）， 模板ID（字符串格式）   ）如：
     *
     *      $allData=[$data,$template];
     *      return $allData;
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $app = app('wechat.official_account');
        $allData = $notification->toWechatTemplateMessage($notifiable);
        $data=$allData[0];
        $template=$allData[1];
        $openId=isset($notifiable->routes['WechatTemplateMessage'])?$notifiable->routes['WechatTemplateMessage']:null;
        $broad=false;
        if (!$openId) {
            $broad=true;
        }
        if ($openId) {
            $openId=is_array($openId)?$openId:array($openId);
        }
        if ($broad==false) {
            foreach ($openId as $keys) {
                $app->template_message->send(
                    [
                        'touser' => $keys,
                        'template_id' => $template,
                        "data"=>$data
                    ]
                );
            }
        }
        // 没有指定用户，就广播
        if ($broad) {
            $app->broadcasting->sendText($data);
        }
    }
}
