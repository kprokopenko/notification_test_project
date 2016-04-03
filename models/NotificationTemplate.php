<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "notification_template".
 *
 * @property integer $id
 * @property string $title
 * @property string $event_code
 * @property integer $from
 * @property integer $to
 * @property string $subject
 * @property string $body
 * @property string[] $type
 */
class NotificationTemplate extends \yii\db\ActiveRecord
{
    const TO_ALL = 0;
    const TO_CREATOR = 1;

    private function render($text, $templateParameters)
    {
        return strtr($text, $templateParameters);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification_template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['to'], 'integer'],
            [['body'], 'string'],
            [['title', 'subject'], 'string', 'max' => 255],

            [['event_code', 'type', 'to', 'title', 'subject', 'body', 'from'], 'required',
                'message' => 'Обязательное поле',
            ],
            ['event_code', 'in', 'range' => static::eventCodes()],
            ['type', 'each', 'rule' => [
                'in', 'range' => static::eventTypes(),
            ]],
            ['to', 'in', 'range' => array_keys(static::toTypes())],
            ['from', 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'event_code' => 'Код события',
            'from' => 'От кого',
            'to' => 'Кому',
            'subject' => 'Заголовок (тема письма)',
            'body' => 'Текст уведомления',
            'type' => 'Тип уведомления',
        ];
    }

    public function beforeSave($insert)
    {
        $this->type = implode(',', $this->type); //сериализуем типы отправки

        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->type = explode(',', $this->type); //десереализуем типы отправки

        parent::afterSave($insert, $changedAttributes);
    }

    public function afterFind()
    {
        $this->type = explode(',', $this->type); //десереализуем типы отправки

        parent::afterFind();
    }

    /**
     * Список кодов событий
     * @return array
     */
    public static function eventCodes()
    {
        $codes = array_keys(Yii::$app->notification->rules);

        return array_combine($codes, $codes);
    }

    /**
     * Список доступных типов отправки
     * @return array
     */
    public static function eventTypes()
    {
        $types = array_keys(Yii::$app->notification->drivers);

        return array_combine($types, $types);
    }

    /**
     * Список доступных вариантов получателей
     * @return array
     */
    public static function toTypes()
    {
        return [
            self::TO_ALL => 'Отправить всем пользователям',
            self::TO_CREATOR => 'Определенный юзер',
        ];
    }

    /**
     * Подставляет переменные шаблонов (напр., {subject}) и возвращает готовый текст
     * @param array $templateParameters
     * @return string
     */
    public function renderBody($templateParameters)
    {
        return $this->render($this->body, $templateParameters);
    }

    /**
     * Подставляет переменные шаблонов (напр., {subject}) и возвращает готовый текст
     * @param array $templateParameters
     * @return string
     */
    public function renderSubject($templateParameters)
    {
        return $this->render($this->subject, $templateParameters);
    }

    public function attributeHints()
    {
        $bodyTemplates = $this->event_code ? implode(' ', $this->bodyTemplateHints()[$this->event_code]) : '';

        $hints = [
            'body' => 'Допустимые элементы для подстановки: <span>' . $bodyTemplates . '</span>',
            'from' => 'Укажите email, который будет указан в поле "От" уведомлений',
        ];

        return ArrayHelper::merge($hints, parent::attributeHints());
    }

    /**
     * Список доступных для каждого события переменных в шаблонах
     * @return array
     */
    public function bodyTemplateHints()
    {
        $result = [];

        foreach (Yii::$app->notification->rules as $rule => $params) {
            $result[$rule] = array_keys($params['templateAttributes']);
        }

        return $result;
    }
}
