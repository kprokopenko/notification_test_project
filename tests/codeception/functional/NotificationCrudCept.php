<?php

/* @var $scenario Codeception\Scenario */

use tests\codeception\_pages\LoginPage;

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that crud for notification works');

LoginPage::loginAsAdmin($I);

$I->click('Создать шаблон уведомления');
$I->see('Создание шаблона уведомления');

$I->fillField('Название', 'test1');
$I->selectOption('Код события', 'onLogin');
$I->fillField('От кого', 'test1@example.com');
$I->fillField('Заголовок (тема письма)', 'First test notification');
$I->fillField('Текст уведомления', 'Hello {username}! Your id = {id}');
$I->selectOption('Тип уведомления', 'email');
$I->selectOption('Кому', 'Отправить всем пользователям');
$I->click('Создать');
$I->dontSee('Обязательное поле');
$I->see('ID');
$I->see('test1');

$I->click('Обновить');
$I->see('Обновление шаблона уведомления: test1');
$I->fillField('Название', 'test2');
$I->fillField('От кого', 'test2@example.com');
$I->click('Обновить');
$I->see('test2');
$I->dontSee('test1');
