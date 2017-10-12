<?php

class EventCest
{
    public function _before(\ApiTester $I)
    {
        $I->createNewCookie($I);
    }

    public function _after(\ApiTester $I)
    {
    }

    // tests
    public function getEventMetaInformationValidTest(\ApiTester $I)
    {
        $I->wantTo('Get event meta information valid test');
        $I->sendGET('/dispatch.php?action=getEventMetas', ['id_lang' => 'en']);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"meta_title":"Yas Marina Experiences Ticket-shop","meta_keywords":"","meta_description":"","description":"","name":"Driving Experiences"}');
    }

    // tests
    public function getEventMetaInformationNegativeTest(\ApiTester $I)
    {
        $I->wantTo('Get event meta information without id_lang parameter negative test');
        $I->sendGET('/dispatch.php?action=getEventMetas');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":402,"error_message":"Parameter id_lang missing"}');
    }
}