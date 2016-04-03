<?php

namespace app\models;

use yii\base\Component;

class NotificationEmailDriver extends Component implements NotificationDriverInterface
{
    public function send($subject, $body)
    {
        \Yii::info('Sended Email with ' . $body, __METHOD__);
        // TODO: Implement send() method.
    }
}
