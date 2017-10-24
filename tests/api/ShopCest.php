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
        $I->wantTo('Get shop information api test');
        $I->sendGET('/dispatch.php?action=getShop');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            "events" => [[
                "eventId" => 'string',
                "url" => 'string',
                "name" => 'string',
                "additionalUrl" => 'string',
                "title" => 'string',
            ]]]);
    }
}