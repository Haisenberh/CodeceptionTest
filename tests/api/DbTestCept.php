<?php
$I = new ApiTester($scenario);
$I->wantTo('Login as registered user');
$I->seeInDatabase('ps_customer', array('lastname' => 'Lastname', 'email like' => 'firstname.lastname%'));