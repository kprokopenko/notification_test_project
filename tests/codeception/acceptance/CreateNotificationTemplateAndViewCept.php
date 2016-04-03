<?php
use tests\codeception\_pages\LoginPage;

$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');

LoginPage::loginAsAdmin($I);
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->click('Создать шаблон');
$I->fillField('Название', 'Уведомление о входе пользователя');
$I->selectOption('Код события', 'onLogin');
$I->fillField('От кого', 'admin@example.com');
$I->selectOption('Кому', 'Отправить всем пользователям');
$I->fillField('Заголовок (тема письма)', 'На сайте появился новый пользователь {username}');
$I->fillField('Текст уведомления', 'На сайте появился новый пользователь {username}! Поприветствуем!!');
$I->selectOption('Тип уведомления', 'browser');
$I->click('Создать');

if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->see('Уведомление о входе пользователя', 'h1');
$I->click('Выйти');

if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

LoginPage::loginAsDemo($I);
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->see('На сайте появился новый пользователь demo', 'h4');
