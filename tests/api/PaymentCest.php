<?php

class PaymentCest
{
    public function _before(\ApiTester $I)
    {
        $I->createNewCookie($I);
    }

    public function _after(\ApiTester $I)
    {
    }

    public function getPaymentInformationValidTest(\ApiTester $I)
    {
        $I->wantTo('Get payment information valid test');
        $I->sendGET('/action.php?ap=Front&c=Payment&a=getPaymentMethods&platform=v4&id_lang=en');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"response":0,"errors":"Your cart is not valid anymore. You will be redirected shortly to the ticketshop. Please try again.","error_code":2,"ticketshop_url":"\/\/ticketsyasmarinacircuit.com\/en\/"}');
    }

}