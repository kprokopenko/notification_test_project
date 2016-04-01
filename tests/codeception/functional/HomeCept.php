<?php

/* @var $scenario Codeception\Scenario */

use tests\codeception\_pages\LoginPage;

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that home page works');
$I->amOnPage(Yii::$app->homeUrl);
$I->see('Login', 'h1');
$loginPage = LoginPage::openBy($I);
$loginPage->login('demo', 'demo');
$I->see('My Company');
$I->seeLink('About');
$I->click('About');
$I->see('This is the About page.');
