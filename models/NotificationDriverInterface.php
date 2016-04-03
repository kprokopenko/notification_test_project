<?php

namespace app\models;

/**
 * Интерфейс драйвера для отправки уведомлений
 */
interface NotificationDriverInterface
{
    /**
     * Отправка уведомления
     * @param $subject string
     * @param $body string
     */
    public function send($subject, $body);
}
