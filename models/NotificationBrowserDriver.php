<?php

namespace app\models;

use yii\base\Component;

class NotificationBrowserDriver extends Component implements NotificationDriverInterface
{
    public function sendOne(User $to, $subject, $body, $from)
    {
        \Yii::info('Sended to browser', __METHOD__);
        // TODO: Implement send() method.
    }

    public function sendAll($subject, $body, $from)
    {
        // TODO: Implement sendAll() method.
    }
}
