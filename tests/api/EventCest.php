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

    public function getEventMetaInformationNegativeTest(\ApiTester $I)
    {
        $I->wantTo('Get event meta information without id_lang parameter negative api test');
        $I->sendGET('/dispatch.php?action=getEventMetas');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":402,"error_message":"Parameter id_lang missing"}');
    }

    public function getEventMetaInformationValidTest(\ApiTester $I)
    {
        $I->wantTo('Get event meta information valid api test');
        $I->sendGET('/dispatch.php?action=getEventMetas', ['id_lang' => 'en']);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(['meta_title' => 'string', 'meta_keywords' => 'string', 'meta_description' => 'string', 'description' => 'string', 'name' => 'string']);
    }

    public function getEventSlidesImages(\ApiTester $I)
    {
        $I->wantTo('Get event slides pictures positive test');
        $I->sendGET('/dispatch.php?action=getEventSlideshowImages&id_lang=en');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('[]');
    }

    public function getEventSlidesImagesNegativeTest(\ApiTester $I)
    {
        $I->wantTo('Get event slides pictures negative api test');
        $I->sendGET('/dispatch.php?action=getEventSlideshowImages');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":402,"error_message":"Parameter id_lang missing"}');
    }

    public function getEventSocialNetwork(\ApiTester $I)
    {
        $I->wantTo('Get event social network information api test');
        $I->sendGET('/dispatch.php?action=getSocialNetwork');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('[]');
    }



}