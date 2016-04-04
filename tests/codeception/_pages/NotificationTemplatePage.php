<?php

namespace tests\codeception\_pages;

use yii\codeception\BasePage;

class NotificationTemplatePage extends BasePage
{
    public $route = 'notification-template/create';

    public function createPostNotification()
    {
        /* @var $I \AcceptanceTester */
        $I = $this->actor;

        $I->fillField('Название', 'Уведомление о создании новой статьи');
        $I->selectOption('Код события', 'newPost');
        $I->fillField('От кого', 'admin@example.com');
        $I->selectOption('Кому', 'Отправить всем пользователям');
        $I->fillField('Заголовок (тема письма)', 'На сайте появилась новая статья {title}');
        $I->fillField('Текст уведомления', 'На сайте появился новая статья с названием {title}! В ней много всего интересно!');
        $I->selectOption('Тип уведомления', 'browser');
        $I->click('Создать');
    }
}
