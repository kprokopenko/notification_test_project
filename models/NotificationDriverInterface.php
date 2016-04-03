<?php

namespace app\models;

/**
 * Интерфейс драйвера для отправки уведомлений
 */
interface NotificationDriverInterface
{
    /**
     * Отправка уведомления конкретному пользователю
     * @param $to User пользователь, для которого предназначено уведомление
     * @param $subject string Заголовок (тема письма)
     * @param $body string Текст уведомления
     * @param $from string email отправителя
     */
    public function sendOne(User $to, $subject, $body, $from);

    /**
     * Отправка всем уведомления всем пользователям
     * @param $subject string
     * @param $body string
     * @param $from string
     */
    public function sendAll($subject, $body, $from);
}
