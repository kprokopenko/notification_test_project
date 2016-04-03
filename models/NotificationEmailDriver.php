<?php

namespace app\models;

use yii\base\Component;
use yii\mail\MessageInterface;

class NotificationEmailDriver extends Component implements NotificationDriverInterface
{
    /**
     * @param User $to
     * @param $subject
     * @param $body
     * @param $from
     * @return MessageInterface
     */
    private function composeMessage(User $to, $subject, $body, $from)
    {
        return \Yii::$app->mailer->compose('notification', [
            'body' => $body,
        ])
            ->setFrom($from)
            ->setSubject($subject)
            ->setTo($to->email);
    }

    public function sendOne(User $to, $subject, $body, $from)
    {
        $this->composeMessage($to, $subject, $body, $from)
            ->send();
    }

    public function sendAll($subject, $body, $from)
    {
        $users = User::find()
            ->select(['email']);

        $messages = [];
        foreach ($users->each() as $user) {
            $messages[] = $this->composeMessage($user, $subject, $body, $from);
        }

        \Yii::$app->mailer->sendMultiple($messages);
    }
}
