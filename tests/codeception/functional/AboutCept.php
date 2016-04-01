<?php

use tests\codeception\_pages\AboutPage;
use tests\codeception\_pages\LoginPage;

/* @var $scenario Codeception\Scenario */

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that about works');
AboutPage::openBy($I);
$I->see('Login', 'h1');

$loginPage = LoginPage::openBy($I);
$loginPage->login('admin', 'admin');
$I->see('About', 'h1');
