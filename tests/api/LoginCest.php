<?php
class LoginCest
{
    public $registered_user_email = 'employee-boo@platinium-group.org';
    public $registered_user_password = '123123';

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
        $I->sendPOST('/action.php?ap=V4&p=Customer&c=Customer&a=login',['customer' => ['email' => $this->registered_user_email, 'password' => $this->registered_user_password]]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(["customer" => ["id_customer"=> 'integer',"first_name"=>'string|null',"last_name"=>'string|null',"newsletter"=>'string|null']]);
    }

    public function loginAsNotRegisteredUser(\ApiTester $I)
    {
        $I->wantTo('Login as not registered user');
        $I->sendPOST('/action.php?ap=V4&p=Customer&c=Customer&a=login',['customer' => ['email' => 'test-boo@platinium-group.org', 'password' => $this->registered_user_password]]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":25,"error_message":"Wrong password or login"}');
    }

    public function loginWithoutEmailParameter(\ApiTester $I)
    {
        $I->wantTo('Login without email parameter');
        $I->sendPOST('/action.php?ap=V4&p=Customer&c=Customer&a=login',['customer' => ['password' => $this->registered_user_password]]);
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
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::INTERNAL_SERVER_ERROR);
    }
}