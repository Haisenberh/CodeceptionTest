<?php

class RegistrationCest
{
    public $faker;
    public $valid_email;
    public $phoneNumber;
    public $valid_password;

    public function _before(\ApiTester $I)
    {
        $I->createNewCookie($I);
        $this->faker = Faker\Factory::create();
    }

    public function _after(\ApiTester $I)
    {
    }

    public function registerNewUserPositiveTest(\ApiTester $I)
    {
        $this->phoneNumber = $this->faker->e164PhoneNumber;
        $this->valid_email = $this->faker->email;
        $this->valid_password = 'passWord99';

        $I->wantTo('Register new user positive api test');
        $I->sendPOST('/action.php?ap=V4&p=Customer&c=Customer&a=registration', ['customer' => ['email' => $this->valid_email,
            'password' => $this->valid_password, 'passwordConfirm' => $this->valid_password, 'contact_number' => $this->faker->e164PhoneNumber, 'gender' => '1', 'nationality' => '38', 'birthDay' => '1', 'birthMonth' => '01', 'birthYear' => '2000', 'isFirstTime' => 'yes']]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseContains('"error":0');
        $I->seeResponseMatchesJsonType(['error' => 'integer', 'customer' => ["id_customer" => 'integer', "email" => 'string|null', "newsletter" => 'integer']]);
    }

    public function registerNewUserWithDuplicateEmailTest(\ApiTester $I)
    {
        $I->wantTo('Register new user with duplicate email parameter api test');
        $I->sendPOST('/action.php?ap=V4&p=Customer&c=Customer&a=registration', ['customer' => ['email' => $this->valid_email,
            'password' => $this->valid_password, 'passwordConfirm' => $this->valid_password, 'contact_number' => $this->phoneNumber, 'gender' => '1', 'nationality' => '38', 'birthDay' => '1', 'birthMonth' => '01', 'birthYear' => '2000', 'isFirstTime' => 'yes']]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":402,"error_message":"The email is already used"}');
    }

    public function registerNewUserWithoutEmail(\ApiTester $I)
    {
        $I->wantTo('Register new user without email parameter api test');
        $I->sendPOST('/action.php?ap=V4&p=Customer&c=Customer&a=registration', ['customer' => ['password' => $this->valid_password, 'passwordConfirm' => $this->valid_password,
            'contact_number' => $this->phoneNumber, 'gender' => '1', 'nationality' => '38', 'birthDay' => '1', 'birthMonth' => '01', 'birthYear' => '2000', 'isFirstTime' => 'yes']]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":402,"error_message":"Parameter email missing"}');
    }

    public function registerNewUserWithoutPassword(\ApiTester $I)
    {
        $I->wantTo('Register new user without password parameter api test');
        $I->sendPOST('/action.php?ap=V4&p=Customer&c=Customer&a=registration', ['customer' => ['email' => $this->valid_email, 'passwordConfirm' => $this->valid_password,
            'contact_number' => $this->phoneNumber, 'gender' => '1', 'nationality' => '38', 'birthDay' => '1', 'birthMonth' => '01', 'birthYear' => '2000', 'isFirstTime' => 'yes']]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":402,"error_message":"Parameter password missing"}');
    }

    public function registerNewUserWithoutConfirmPassword(\ApiTester $I)
    {
        $I->wantTo('Register new user without confirm password parameter api test');
        $I->sendPOST('/action.php?ap=V4&p=Customer&c=Customer&a=registration', ['customer' => ['email' => $this->valid_email, 'password' => $this->valid_password,
            'contact_number' => $this->phoneNumber, 'gender' => '1', 'nationality' => '38', 'birthDay' => '1', 'birthMonth' => '01', 'birthYear' => '2000', 'isFirstTime' => 'yes']]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":402,"error_message":"Parameter passwordConfirm missing"}');
    }

    public function registerNewUserWithoutContactNumberPassword(\ApiTester $I)
    {
        $I->wantTo('Register new user without contact number parameter api test');
        $I->sendPOST('/action.php?ap=V4&p=Customer&c=Customer&a=registration', ['customer' => ['email' => $this->valid_email, 'password' => $this->valid_password, 'passwordConfirm' => $this->valid_password,
            'gender' => '1', 'nationality' => '38', 'birthDay' => '1', 'birthMonth' => '01', 'birthYear' => '2000', 'isFirstTime' => 'yes']]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":402,"error_message":"Parameter contact_number missing"}');
    }

    public function registerNewUserWithoutGender(\ApiTester $I)
    {
        $I->wantTo('Register new user without gender api parameter test');
        $I->sendPOST('/action.php?ap=V4&p=Customer&c=Customer&a=registration', ['customer' => ['email' => $this->valid_email, 'password' => $this->valid_password, 'passwordConfirm' => $this->valid_password,
            'contact_number' => $this->phoneNumber, 'nationality' => '38', 'birthDay' => '1', 'birthMonth' => '01', 'birthYear' => '2000', 'isFirstTime' => 'yes']]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":402,"error_message":"Parameter gender missing"}');
    }

    public function registerNewUserWithoutNationality(\ApiTester $I)
    {
        $I->wantTo('Register new user without nationality parameter api test');
        $I->sendPOST('/action.php?ap=V4&p=Customer&c=Customer&a=registration', ['customer' => ['email' => $this->valid_email, 'password' => $this->valid_password, 'passwordConfirm' => $this->valid_password,
            'contact_number' => $this->phoneNumber, 'gender' => '1', 'birthDay' => '1', 'birthMonth' => '01', 'birthYear' => '2000', 'isFirstTime' => 'yes']]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":402,"error_message":"Parameter nationality missing"}');
    }

    public function registerNewUserWithoutBirthDay(\ApiTester $I)
    {
        $I->wantTo('Register new user without birth day parameter api test');
        $I->sendPOST('/action.php?ap=V4&p=Customer&c=Customer&a=registration', ['customer' => ['email' => $this->valid_email, 'password' => $this->valid_password, 'passwordConfirm' => $this->valid_password,
            'contact_number' => $this->phoneNumber, 'gender' => '1', 'nationality' => '38', 'birthMonth' => '01', 'birthYear' => '2000', 'isFirstTime' => 'yes']]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":402,"error_message":"Parameter birthDay missing"}');
    }

    public function registerNewUserWithoutBirthMonth(\ApiTester $I)
    {
        $I->wantTo('Register new user without birth month parameter api test');
        $I->sendPOST('/action.php?ap=V4&p=Customer&c=Customer&a=registration', ['customer' => ['email' => $this->valid_email, 'password' => $this->valid_password, 'passwordConfirm' => $this->valid_password,
            'contact_number' => $this->phoneNumber, 'gender' => '1', 'nationality' => '38', 'birthDay' => '1', 'birthYear' => '2000', 'isFirstTime' => 'yes']]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":402,"error_message":"Parameter birthMonth missing"}');
    }

    public function registerNewUserWithoutBirthYear(\ApiTester $I)
    {
        $I->wantTo('Register new user without birth year parameter api test');
        $I->sendPOST('/action.php?ap=V4&p=Customer&c=Customer&a=registration', ['customer' => ['email' => $this->valid_email, 'password' => $this->valid_password, 'passwordConfirm' => $this->valid_password,
            'contact_number' => $this->phoneNumber, 'gender' => '1', 'nationality' => '38', 'birthDay' => '1', 'birthMonth' => '01', 'isFirstTime' => 'yes']]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":402,"error_message":"Parameter birthYear missing"}');
    }

    public function registerNewUserWithoutIsFirstTime(\ApiTester $I)
    {
        $I->wantTo('Register new user without is first time parameter api test');
        $I->sendPOST('/action.php?ap=V4&p=Customer&c=Customer&a=registration', ['customer' => ['email' => $this->valid_email, 'password' => $this->valid_password, 'passwordConfirm' => $this->valid_password,
            'contact_number' => $this->phoneNumber, 'gender' => '1', 'nationality' => '38', 'birthDay' => '1', 'birthMonth' => '01', 'birthYear' => '2000',]]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":402,"error_message":"Parameter isFirstTime missing"}');
    }


}