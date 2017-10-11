<?php
class LoginCest
{
    public function _before(\ApiTester $I)
    {
        $I->createNewCookie($I);
    }

    public function _after(\ApiTester $I)
    {
    }

    // tests
    public function loginAsRegisteredUser(\ApiTester $I)
    {
        $I->wantTo('Login as registered user');
        $I->sendPOST('/action.php?ap=V4&p=Customer&c=Customer&a=login',['customer' => ['email' => 'employee-boo@platinium-group.org', 'password' => '123123']]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"customer":{"id_customer":1,"first_name":null,"last_name":null,"newsletter":"1"}}');
    }

    public function loginAsNotRegisteredUser(\ApiTester $I)
    {
        $I->wantTo('Login as not registered user');
        $I->sendPOST('/action.php?ap=V4&p=Customer&c=Customer&a=login',['customer' => ['email' => 'test-boo@platinium-group.org', 'password' => '123123']]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":25,"error_message":"Wrong password or login"}');
    }

    public function loginWithoutEmailParameter(\ApiTester $I)
    {
        $I->wantTo('Login without email parameter');
        $I->sendPOST('/action.php?ap=V4&p=Customer&c=Customer&a=login',['customer' => ['password' => '123123']]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":402,"error_message":"Parameter email missing"}');
    }

    public function loginWithoutPasswordParameter(\ApiTester $I)
    {
        $I->wantTo('Login without password parameter');
        $I->sendPOST('/action.php?ap=V4&p=Customer&c=Customer&a=login',['customer' => ['email' => 'test-boo@platinium-group.org']]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":402,"error_message":"Parameter password missing"}');
    }

    public function loginWithoutEmailAndPasswordParameter(\ApiTester $I)
    {
        $I->wantTo('Login without email and password parameter');
        $I->sendPOST('/action.php?ap=V4&p=Customer&c=Customer&a=login');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::INTERNAL_SERVER_ERROR); // 500
    }
}