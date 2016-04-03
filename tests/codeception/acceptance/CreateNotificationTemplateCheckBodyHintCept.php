<?php

/* @var $scenario Codeception\Scenario */

use tests\codeception\_pages\LoginPage;

$I = new AcceptanceTester($scenario);
$I->wantTo('check that templates variable are correct substitute');

LoginPage::loginAsAdmin($I);
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->click('Создать шаблон уведомления');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->selectOption('Код события', 'onLogin');
$I->see('{username} {id}');
$I->selectOption('Код события', 'createTemplate');

$I->see('{title} {subject} {body}');
$I->dontSee('{username}');
