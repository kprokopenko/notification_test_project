<?php

/* @var $scenario Codeception\Scenario */

use tests\codeception\_pages\LoginPage;

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that unauthorized user see login page');
$I->amOnPage(Yii::$app->homeUrl);
$I->see('Войти', 'h1');

$I->wantTo('login as admin');
$loginPage = LoginPage::openBy($I);
$loginPage->login('admin', 'admin');

$I->wantTo('ensure that admin see notification CRUD');

$I->see('Шаблоны уведомлений');
$I->seeLink('Создать шаблон уведомления');

$I->wantTo('ensure that not admin not see notification CRUD');
$I->click('Выйти');
$I->see('Войти', 'h1');

