<?php

class ShopCest
{
    public function _before(\ApiTester $I)
    {
        $I->createNewCookie($I);
    }

    public function _after(\ApiTester $I)
    {
    }

    // tests
    public function getCurrenciesAvailableForEvent(\ApiTester $I)
    {
        $I->wantTo('Get shop information');
        $I->sendGET('/dispatch.php?action=getShop');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"events":[{"eventId":"3086","url":"\/3086-abu-dhabi-ymc","name":"Formula 1","additionalUrl":"","title":"Yas Marina Formula 1 Ticket-shop"},{"eventId":"8481","url":"\/8481-driving-experiences","name":"Experiences","additionalUrl":"experiences\/home\/","title":"Yas Marina Experiences Ticket-shop"}]}');
    }
}