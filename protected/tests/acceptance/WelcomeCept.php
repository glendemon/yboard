<?php 
  $I = new AcceptanceTester($scenario);
  $I->wantTo('ensure that frontpage works');
  $I->amOnPage('http://localhost/Yboard/');
  $I->see('Apple');
