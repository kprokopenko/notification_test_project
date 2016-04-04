<?php

use yii\web\User;

return [
    'onLogin' => [
        'class' => User::className(),
        'event' => User::EVENT_AFTER_LOGIN,
        'templateAttributes' => [
            'username' => function (User $model) {
                /* @var $user \app\models\User */
                $user = $model->getIdentity();
                return $user->username;
            },
            'id',
        ]
    ],
    'createTemplate' => [
        'class' => 'app\models\NotificationTemplate',
        'event' => 'afterInsert',
        'templateAttributes' => [
            'title',
            'subject',
            'body',
        ],
    ],
    'newPost' => [
        'class' => 'app\models\Post',
        'event' => 'afterInsert',
        'templateAttributes' => [
            'title',
            'body',
        ],
    ]
];
