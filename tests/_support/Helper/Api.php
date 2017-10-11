<?php

namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Api extends \Codeception\Module
{
    public function authorizeToApp(\ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('https://ticketsyasmarinacircuit.com');
        $I->sendPOST('/action.php?ap=V4&p=Customer&c=Customer&a=login',['customer' => ['email' => 'employee-boo@platinium-group.org', 'password' => '123123']]);
    }

    public function createNewCookie(\ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('https://ticketsyasmarinacircuit.com');
    }
}
