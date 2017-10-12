<?php

class OrganizerCest
{
    public function _before(\ApiTester $I)
    {
        $I->createNewCookie($I);
    }

    public function _after(\ApiTester $I)
    {
    }

    // tests
    public function getOrganizerInformation(\ApiTester $I)
    {
        $I->wantTo('Get organizer information');
        $I->sendGET('/dispatch.php?action=getOrganizerInformation');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"url":"http:\/\/www.yasmarinacircuit.com\/","phone":"+971 0 2659 9800","cssOrganizer":false,"copyright":"","default_page_url":null}');
    }
}