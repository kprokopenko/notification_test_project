<?php

/* @var $scenario Codeception\Scenario */

use tests\codeception\_pages\LoginPage;
use tests\codeception\_pages\NotificationPage;
use tests\codeception\_pages\NotificationTemplatePage;
use tests\codeception\_pages\PostPage;

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that new post notifications work');

LoginPage::loginAsAdmin($I);

if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$templatePage = NotificationTemplatePage::openBy($I);
$templatePage->createPostNotification();

if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

PostPage::openBy($I);

$I->fillField('Title', 'PostTest');
$I->fillField('Body', 'Some Text About {title}');
$I->fillField('User ID', 100);

$I->click('Добавить');

if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

NotificationPage::openBy($I);

$I->see('На сайте появилась новая статья PostTest');
