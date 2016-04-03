<?php

namespace app\models;

use yii\base\Component;
use yii\base\Event;

/**
 * Компонент уведомлений
 */
class NotificationComponent extends Component
{
    private $_drivers = [];

    /**
     * @var array Правила уведомлений
     *
     * Пример:
     *
     * ```php
     * [
     * 'onLogin' => [
     * 'class' => User::className(),
     * 'event' => User::EVENT_AFTER_LOGIN,
     * 'templateAttributes' => [
     * 'username',
     * 'id',
     * ]
     *],
     * ]
     * ```
     */
    public $rules = [];

    /**
     * @var array Список типов отсылок (драйверы)
     */
    public $drivers = [];

    private static function renderTemplateAttributes($attributes, $model)
    {
        $result = [];

        foreach ($attributes as $name => $value) {
            if (is_callable($value)) {
                $result[$name] = call_user_func($value, $model);
            } else {
                $result[$name] = $model->$value;
            }
        }

        return $result;
    }

    private function normalizeAttributeNames($templateAttributes)
    {
        $result = [];

        foreach ($templateAttributes as $key => $value) {
            $name = is_string($key) ? $key : $value;
            $result['{' . $name . '}'] = $value;
        }

        return $result;
    }

    public function init()
    {
        foreach ($this->rules as $name => &$values) {
            $values['templateAttributes'] = $this->normalizeAttributeNames($values['templateAttributes']);
            Event::on($values['class'], $values['event'], [static::className(), 'callback'], [
                'code' => $name,
                'templateAttributes' => $values['templateAttributes'],
            ]);
        }

        foreach ($this->drivers as $name => $driver) {
            $this->_drivers[$name] = \Yii::createObject($driver);
        }
    }

    public static function callback(Event $event) {
        $templates = NotificationTemplate::find()
            ->andWhere([
                'event_code' => $event->data['code'],
            ]);

        $templateAttributes = static::renderTemplateAttributes($event->data['templateAttributes'], $event->sender);

        foreach ($templates->each() as $template) {
            /* @var $template NotificationTemplate */
            \Yii::$app->notification->sendNotification(
                $template->subject,
                $template->renderBody($templateAttributes),
                $template->to,
                $template->from
            );
        }
    }

    /**
     * Отсылка уведомления по всем каналам
     * @param $subject string
     * @param $body string
     */
    public function sendNotification($subject, $body, $to, $from)
    {
        foreach ($this->_drivers as $driver) {
            /* @var $driver NotificationDriverInterface */
            if ($to === NotificationTemplate::TO_ALL) {
                $driver->sendAll($subject, $body, $from);
            } else {
                $user = \Yii::$app->user->getIdentity();
                if ($user instanceof User) {
                    $driver->sendOne($user, $subject, $body, $from);
                }
            }
        }
    }
}
