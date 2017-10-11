<?php
$I = new ApiTester($scenario);
$I->wantTo('Get Month parameters');
$I->authorizeToApp($I);
$I->sendPOST('/dispatch.php?action=customerInformation');
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
$I->seeResponseIsJson();
$I->seeResponseEquals('{"error":0,"title":"1","first_name":null,"last_name":null,"email":"employee-boo@platinium-group.org","contact_number":"2132132132132132","birthday":{"day":"01","month":"01","year":"1999"},"nationality":"39","newsletter":1,"optin":0}');