<?php

class CurrencyCestCest
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
        $I->wantTo('Get available currencies for event');
        $I->sendGET('/dispatch.php?action=getCurrencies');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            array('name' => 'string',
                'iso' => 'string',
                'sign' => 'string')]);
    }
}