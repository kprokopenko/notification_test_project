<?php

namespace app\models;

use yii\base\Component;

class NotificationBrowserDriver extends Component implements NotificationDriverInterface
{
    public function send($subject, $body)
    {
        \Yii::info('Sended to browser', __METHOD__);
        // TODO: Implement send() method.
    }
}
