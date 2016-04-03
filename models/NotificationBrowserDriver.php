<?php

namespace app\models;

use yii\base\Component;

class NotificationBrowserDriver extends Component implements NotificationDriverInterface
{
    public function sendOne(User $to, $subject, $body, $from)
    {
        $notification = new Notification();
        $notification->user_id = $to->id;
        $notification->subject = $subject;
        $notification->body = $body;
        $notification->from = $from;
        if (!$notification->save()) {
            \Yii::error('Не удалось отправить уведомление через браузер', __METHOD__);
            \Yii::error($notification->errors, __METHOD__);
        }
    }

    public function sendAll($subject, $body, $from)
    {
        //TODO сделать через batchInsert
        foreach (User::find()->each() as $user) {
            $this->sendOne($user, $subject, $body, $from);
        }
    }
}
