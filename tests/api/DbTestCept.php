<?php
$I = new ApiTester($scenario);
$I->wantTo('Get experiences category name');
$I->createNewCookie($I);
$experienceId = $I->getExperienceIdByLegend2($I, 'driving');
$I->sendPOST('/action.php?c=Experiences&a=getCategoryName', ['id_experience' => $experienceId]);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
$I->seeResponseIsJson();
$I->seeResponseEquals('test');