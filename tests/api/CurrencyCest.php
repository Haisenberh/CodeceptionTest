<?php

class CurrencyCest
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
        $I->wantTo('Get available currencies for event api test');
        $I->sendGET('/dispatch.php?action=getCurrencies');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseContains('{"1":{"name":"Euro","iso":"EUR","sign":"\u20ac"},"2":{"name":"Dollar","iso":"USD","sign":"$"},"9":{"name":"Yuan Renminbi","iso":"CNY","sign":"\u5143"},"14":{"name":"UAE Dirham","iso":"AED","sign":"AED"},"17":{"name":"Roupie","iso":"INR","sign":"\u20b9"},"71":{"name":"South African Rand","iso":"ZAR","sign":"R"},"18":{"name":"Franc suisse","iso":"CHF","sign":"CHF"},"8":{"name":"Canadian Dollar","iso":"CAD","sign":"C$"},"10":{"name":"Yen","iso":"JPY","sign":"\u00a5"},"61":{"name":"New Zealand Dollar","iso":"NZD","sign":"$"},"5":{"name":"Australian Dollar","iso":"AUD","sign":"A$"}}');
    }
}