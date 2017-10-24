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
        $I->wantTo('Get organizer information api test');
        $I->sendGET('/dispatch.php?action=getOrganizerInformation');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(['url' => 'string', 'phone' => 'string', 'cssOrganizer' => 'boolean', 'copyright' => 'string|null', 'default_page_url' => 'string|null']);
    }
}