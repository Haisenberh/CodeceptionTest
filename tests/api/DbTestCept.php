<?php
$I = new ApiTester($scenario);
$I->wantTo('Get experiences category name');
$I->createNewCookie($I);
$alias = $I->grabFromDatabase('ps_address', 'alias', array('id_address' => 1));
$I->sendPOST('/action.php?c=Experiences&a=getCategoryName', ['id_experience' => $alias]);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
$I->seeResponseIsJson();
$I->seeResponseEquals('test');