<?php

class ExperiencesCest
{
    public $driving_experience_id;
    public $dirham_currency_id;
    public $product_id;

    public function _before(\ApiTester $I)
    {
        $this->driving_experience_id = $I->getExperienceIdByLegend($I, 'driving');
        $this->dirham_currency_id = $I->getCurrencyIdByName($I, 'UAE Dirham');
        $this->product_id = '90231';
        $I->createNewCookie($I);
    }

    public function _after(\ApiTester $I)
    {
    }

    public function getExperiences(\ApiTester $I)
    {
        $I->wantTo('Get experiences list');
        $I->sendPOST('/action.php?c=Experiences&a=getExperiences');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('[{"id":"13251","col":"4","row":"2","imgurl":"img\/experiences\/category\/13251.jpeg","name":"Drive YAS","description":"Thrill seekers, put your foot down and feel like a champion at Yas Marina Circuit.\nReady for some old-fashioned fun? Yas Marina Circuit Passenger Experiences offer a range of amazing rides.","is_gift_voucher_category":"0"},{"id":"13261","col":"4","row":"2","imgurl":"img\/experiences\/category\/13261.jpeg","name":"Open YAS","description":"Car Track Day, Bike Track Day, Drag Night, Drift Night","is_gift_voucher_category":"0"},{"id":"14451","col":"4","row":"3","imgurl":"img\/experiences\/category\/14451.jpeg","name":"Gift vouchers","description":"An open dated Yas Marina Circuit Experience makes a for a perfect gift. Choose from a wide range of Driver and Passenger Experiences.","is_gift_voucher_category":"1"},{"id":"14581","col":"8","row":"1","imgurl":"img\/experiences\/category\/14581.jpeg","name":"Motorsports Events","description":"Motorsports Events","is_gift_voucher_category":"0"}]');
    }

    public function getExperiencesSettings(\ApiTester $I)
    {
        $I->wantTo('Get experiences settings');
        $I->sendPOST('/action.php?c=Experiences&a=getExperienceSettings');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"id_experience_setting":"2","scope":"event","id_scope":"8481","sort_by_popularity":"1","sort_by_sale":"0","sort_by_alpha":"1","sort_by_price":"1","use_filter_category":"0","can_search":"0","availability_threshold":"5","id_lang":"1","search_text":"Find your experience","meta_title":"","meta_description":"","meta_keywords":"","description":"<b>YAS MARINA CIRCUIT EXPERIENCES <\/b><br \/> Find out what you\u2019re made of at Yas Marina Circuit. Put yourself in the driver\u2019s seat for a life-defining moment of glory in some of the world\u2019s most impressive race cars, or buckle up in the passenger seat for a heart-stopping ride. Learn how to drive like the pros you\u2019ve always idolised or step behind the scenes with access usually reserved for F1\u00ae teams and drivers. It doesn\u2019t get better than this!","home_title":"Yas Marina Circuit Experiences","home_subtitle":"Experiences categories"}');
    }

    public function getExperiencesCategoryName(\ApiTester $I)
    {
        $I->wantTo('Get experiences category name');
        $I->sendPOST('/action.php?c=Experiences&a=getCategoryName', ['id_experience' => $this->driving_experience_id]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals("{\"name\":\"Drive YAS\",\"description\":\"<b> Drive YAS <\/b><br \/><br \/>Thrill seekers, put your foot down and feel like a champion at Yas Marina Circuit. From taking the famous Formula Yas 3000\u2019s for a spin to drifting, drag racing and kids\u2019 first driving lessons, Yas Marina Circuit Driver Experiences is about putting you in control as you make your own phenomenal memories.<br \/>Buckle up in the passenger seat of some of the wildest rides imaginable: the classy Aston Martin GT4; the Chevrolet Camaro, king of the muscle cars; the Mercedes AMG, Formula 1\u00ae safety car; the rebellious open cock-pit Yas Radical SST or the bad boy of them all, the Yas Three-Seater Dragster. What will it be?\",\"id_category\":\"13251\",\"meta_title\":\"\",\"meta_description\":\"\",\"meta_keywords\":\"\",\"is_gift_voucher_category\":\"0\"}");
    }

    public function getExperiencesCurrency(\ApiTester $I)
    {
        $I->wantTo('Get experiences currency');
        $I->sendPOST('/action.php?c=Experiences&a=getCurrency', ['id_currency' => $this->dirham_currency_id]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals("{\"format\":\"1\",\"sign\":\"AED\"}");
    }

    public function getExperiencesHasAvailability(\ApiTester $I)
    {
        $I->wantTo('Get experiences availability');
        $I->sendPOST('/action.php?c=Experiences&a=hasAvailability', ['id_product' => $this->product_id]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals("{\"result\":\"1\",\"min_price\":\"1750.00\",\"first_month_availability\":\"10\",\"first_year_availability\":\"2017\",\"min_price_display\":\"AED 1,750.00\"}");
    }

    public function getExperiencesNextAvailabilities(\ApiTester $I)
    {
        $I->wantTo('Get experiences next availabilities');
        $I->sendPOST('/action.php?c=Experiences&a=getProductNextAvailabilities', ['id_product' => $this->product_id, 'month_day' => '2018-03-01']);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(['0' => 'string', '1' => 'string']);
    }

    public function experiencesGetMonth(\ApiTester $I)
    {
        $I->wantTo('Get experiences availability groped by month ');
        $I->sendPOST('/action.php?c=Experiences&a=getMonths', ['id_experience' => $this->driving_experience_id]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(['month' => 'string', 'available' => 'string']);
    }

    public function getExperiencesMonthAvailabilities(\ApiTester $I)
    {
        $I->wantTo('Get experiences month availability information ');
        $I->sendPOST('/action.php?c=Experiences&a=getMonthAvailabilities', ['id_product' => $this->product_id, 'date_for_month' => '2017-10-01', 'isFront' => 'true']);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
    }

    public function getExperiencesQuickFilters(\ApiTester $I)
    {
        $I->wantTo('Get experiences quick filters information ');
        $I->sendPOST('/action.php?c=Experiences&a=getQuickFilters');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('[{"id":1,"name":"Popularity"},{"id":3,"name":"Alphabetical (A-Z)"},{"id":4,"name":"Alphabetical (Z-A)"},{"id":5,"name":"Price (+ to -)"},{"id":6,"name":"Price (- to +)"}]');
    }

    public function getExperienceProductInformation(\ApiTester $I)
    {
        $I->wantTo('Get experiences product information ');
        $I->sendPOST('/action.php?c=Experiences&a=getProduct', ['id_product' => $this->product_id]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"id_product":"90231","id_category_default":"13251","category_name":"Drive YAS","name":"ASTON MARTIN GT4 DRIVE","videoUrl":"https:\/\/www.youtube.com\/embed\/3tllnYuJa0M","isVideoDefault":"1","meta_title":"","meta_description":"","meta_keywords":"","sliderImages":["110750-astonmartingt4carousel2jpg.jpeg?v=1466000422","202846-01AstonMartin1210x435jpg.jpeg?v=1474465713","531365-astonmartinticketingjpeg.jpeg?v=1480495188","61046-Experience2jpg.jpeg?v=1475507571","72180-astonmartingt4carousel3jpg.jpeg?v=1466000422"],"defaultImage":"\/img\/experiences\/products\/no-photo.jpg"}');
    }

    public function getExperienceProducts(\ApiTester $I)
    {
        $I->wantTo('Get experiences products');
        $I->sendPOST('/action.php?c=Experiences&a=getProducts', ['id_experience' => $this->driving_experience_id]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('[{"id":"90231","position":"2","price":"AED 1,750.00","imgUrl":"img\/experiences\/products\/90231\/thumb.jpeg?v=1480495389","name":"ASTON MARTIN GT4 DRIVE","description":"Beautiful to look at and brilliant to drive: the Aston Martin GT4 is the ultimate racing experience.","reduction":"0","price_reducted":"AED 1,750.00","available_qty":"34","attributes":[null]},{"id":"90761","position":"3","price":"AED 1,500.00","imgUrl":"img\/experiences\/products\/90761\/thumb.jpeg?v=1480495599","name":"MERCEDES-AMG GTS DRIVE","description":"This is your chance to drive in one of the most prestigious cars ever made with our new AMG experiences.","reduction":"0","price_reducted":"AED 1,500.00","available_qty":"7","attributes":[null]},{"id":"91291","position":"5","price":"AED 1,300.00","imgUrl":"img\/experiences\/products\/91291\/thumb.jpeg?v=1480160972","name":"JAGUAR F-TYPE S COUPE DRIVE","description":"A true Jaguar sports car, the Jaguar F-TYPE S delivers responsive performance that sets your pulse racing .","reduction":"0","price_reducted":"AED 1,300.00","available_qty":"5","attributes":[null]},{"id":"91481","position":"1","price":"AED 1,750.00","imgUrl":"img\/experiences\/products\/91481\/thumb.jpeg?v=1480495785","name":"FORMULA YAS 3000 DRIVE","description":"Put yourself in the shoes of a professional racing driver revving a 3000cc V6 engine.","reduction":"0","price_reducted":"AED 1,750.00","available_qty":"68","attributes":[null]},{"id":"91821","position":"4","price":"AED 650.00","imgUrl":"img\/experiences\/products\/91821\/thumb.jpeg?v=1472221189","name":"CHEVROLET CAMARO DRAG RACING","description":"Feel like a champion with a firsthand encounter of the awesomely gritty Chevrolet Camaro.","reduction":"0","price_reducted":"AED 650.00","available_qty":"40","attributes":[null]},{"id":"92071","position":"6","price":"AED 440.00","imgUrl":"img\/experiences\/products\/92071\/thumb.jpeg?v=1472221246","name":"YAS RADICAL SST DRIVE","description":"What could be better than a day in the life of a professional racing driver?","reduction":"0","price_reducted":"AED 440.00","available_qty":"0","attributes":[null]},{"id":"92111","position":"10","price":"AED 400.00","imgUrl":"img\/experiences\/products\/92111\/thumb.jpeg?v=1481126380","name":"1ST GEAR JUNIOR DRIVE","description":"Make your first experience, a racing experience!","reduction":"0","price_reducted":"AED 400.00","available_qty":"3","attributes":[null]},{"id":"92391","position":"7","price":"AED 750.00","imgUrl":"img\/experiences\/products\/92391\/thumb.jpeg?v=1472221578","name":"ASTON MARTIN GT4 PASSENGER","description":"Imagine the drive of your life in the customized racing passenger seat of the distinguished Aston Martin GT4 and flying around the Yas Marina Circuit at pace.","reduction":"0","price_reducted":"AED 750.00","available_qty":"2","attributes":[null]},{"id":"93401","position":"100","price":"AED 440.00","imgUrl":"img\/experiences\/products\/93401\/thumb.jpeg?v=1474206849","name":"SUPERSPORT SST PASSENGER","description":"You don\u2019t have to be behind the wheel to get a taste of the track.","reduction":"0","price_reducted":"AED 440.00","available_qty":"12","attributes":[null]},{"id":"94311","position":"9","price":"AED 500.00","imgUrl":"img\/experiences\/products\/94311\/thumb.jpeg?v=1472221690","name":"JAGUAR F-TYPE S COUPE PASSENGER","description":"MOMENT THAT TAKES YOUR BREATH AWAY","reduction":"0","price_reducted":"AED 500.00","available_qty":"6","attributes":[null]},{"id":"94451","position":"12","price":"AED 60.00","imgUrl":"img\/experiences\/products\/94451\/thumb.jpeg?v=1472221838","name":"VENUE TOUR ","description":"Explore of one of the world\u2019s most advanced Formula 1\u00ae circuits from the inside out.","reduction":"0","price_reducted":"AED 60.00","available_qty":"456","attributes":[null]},{"id":"96201","position":"8","price":"AED 550.00","imgUrl":"img\/experiences\/products\/96201\/thumb.jpeg?v=1472221611","name":"MERCEDES AMG GTS PASSENGER","description":"Race around the track with this compact beast and feel the power of this vehicle from the moment you start the engine.","reduction":"0","price_reducted":"AED 550.00","available_qty":"8","attributes":[null]},{"id":"193971","position":"4","price":"AED 4,000.00","imgUrl":"img\/experiences\/products\/no-photo.jpg","name":"Ferrari 458 GT DRIVE","description":"Ferrari 458 GT","reduction":"0","price_reducted":"AED 4,000.00","available_qty":"3","attributes":[null]}]');
    }

    public function getExperienceProductsFilters(\ApiTester $I)
    {
        $I->wantTo('Get experiences products filters');
        $I->sendPOST('/action.php?c=Experiences&a=getProductsFilters', ['id_product' => $this->product_id]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('[]');
    }

    public function getExperienceMasterProductData(\ApiTester $I)
    {
        $I->wantTo('Get experiences products filters');
        $I->sendPOST('/action.php?c=Experiences&a=getProductsFilters', ['id_product' => $this->product_id]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('[]');
    }

    public function getExperienceDescription(\ApiTester $I)
    {
        $I->wantTo('Get experiences product description');
        $I->sendPOST('/action.php?c=Experiences&a=getDescriptions', ['id_product' => $this->product_id]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseContains('"id":"631","name":"about","text":"<b>ASTON MARTIN GT4<\/b>\n<br><\/br>\nThe Aston Martin GT4 has the look of its distinguished Vantage sibling, but moves fearlessly like a race car.');
    }

    public function getMightAlsoBeLikedProducts(\ApiTester $I)
    {
        $I->wantTo('Get experience products list that might be also interested to clients');
        $I->sendPOST('/action.php?c=Experiences&a=getMightAlsoBeLikedProducts', ['id_product' => $this->product_id, 'limit' => 5]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('[{"id":"91481","price":"1750.00","imgUrl":"img\/experiences\/products\/91481\/thumb.jpeg?v=1480495785","name":"FORMULA YAS 3000 DRIVE","description":"Put yourself in the shoes of a professional racing driver revving a 3000cc V6 engine.","reduction":"0","price_reducted":"1750.00","available_qty":"1201","price_display":"AED 1,750.00","price_reducted_display":"AED 1,750.00"},{"id":"90761","price":"1500.00","imgUrl":"img\/experiences\/products\/90761\/thumb.jpeg?v=1480495599","name":"MERCEDES-AMG GTS DRIVE","description":"This is your chance to drive in one of the most prestigious cars ever made with our new AMG experiences.","reduction":"0","price_reducted":"1500.00","available_qty":"189","price_display":"AED 1,500.00","price_reducted_display":"AED 1,500.00"},{"id":"91821","price":"650.00","imgUrl":"img\/experiences\/products\/91821\/thumb.jpeg?v=1472221189","name":"CHEVROLET CAMARO DRAG RACING","description":"Feel like a champion with a firsthand encounter of the awesomely gritty Chevrolet Camaro.","reduction":"0","price_reducted":"650.00","available_qty":"1379","price_display":"AED 650.00","price_reducted_display":"AED 650.00"},{"id":"193971","price":"4000.00","imgUrl":"img\/experiences\/products\/193971\/thumb.jpeg?v=0","name":"Ferrari 458 GT DRIVE","description":"Ferrari 458 GT","reduction":"0","price_reducted":"4000.00","available_qty":"178","price_display":"AED 4,000.00","price_reducted_display":"AED 4,000.00"},{"id":"91291","price":"1300.00","imgUrl":"img\/experiences\/products\/91291\/thumb.jpeg?v=1480160972","name":"JAGUAR F-TYPE S COUPE DRIVE","description":"A true Jaguar sports car, the Jaguar F-TYPE S delivers responsive performance that sets your pulse racing .","reduction":"0","price_reducted":"1300.00","available_qty":"213","price_display":"AED 1,300.00","price_reducted_display":"AED 1,300.00"}]');
    }

    public function getExperienceFrontPriceLists(\ApiTester $I)
    {
        $I->wantTo('Get experiences product price data');
        $I->sendPOST('/action.php?c=Experiences&a=getFrontPriceLists', ['id_product' => $this->product_id]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('[{"available_quantity":"9905","id_product_type":"15","id_master_product":"90231","id_price_list":"7541","name":"Adult","price":"1925.00","reduction":"0.00","info":"","id":"124231","price_display":"AED 1,925.00","reduction_display":"AED 0.00","price_reducted":"AED 1,925.00"}]');
    }

    public function getExperienceSearchResult(\ApiTester $I)
    {
        $I->wantTo('Get experiences search result by date');
        $I->sendPOST('/action.php?c=Experiences&a=getSearchResults', ['id_experience' => $this->driving_experience_id, 'month_date' => '2018-03-01']);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('[{"id":"90231","position":"2","score":"0","price":"1750.00","type":"","imgUrl":"img\/experiences\/products\/90231\/thumb.jpeg?v=1480495389","name":"ASTON MARTIN GT4 DRIVE","id_category":"13251","category_name":"Drive YAS","description":"The Aston Martin GT4 has the look of its distinguished Vantage sibling, but moves fearlessly like a race car. Light on its wheels, this vehicle navigates sharp corners with ease and crosses a straight with the swiftness of a predator. Ever wonder what it would be like to feel the roar for yourself?","reduction":"0.00","available_qty":"15"},{"id":"90761","position":"3","score":"0","price":"1500.00","type":"","imgUrl":"img\/experiences\/products\/90761\/thumb.jpeg?v=1480495599","name":"MERCEDES-AMG GTS DRIVE","id_category":"13251","category_name":"Drive YAS","description":"This is your chance to drive in one of the most prestigious cars ever made with our new AMG experiences.  AMG line-up includes Mercedes E63 and GTS ready for your driving pleasure.  These stylish yet incredibly powerful vehicles will have your heart beating while adrenaline rushes throughout your body.","reduction":"0.00","available_qty":"2"},{"id":"91291","position":"5","score":"0","price":"1300.00","type":"","imgUrl":"img\/experiences\/products\/91291\/thumb.jpeg?v=1480160972","name":"JAGUAR F-TYPE S COUPE DRIVE","id_category":"13251","category_name":"Drive YAS","description":"A true Jaguar sports car, the Jaguar F-TYPE S delivers responsive performance that sets your pulse racing . The dramatic design makes you stop and stare. Get behind the wheel and experience the thrill of the latest in a distinguished sporting bloodline","reduction":"0.00","available_qty":"2"},{"id":"91481","position":"1","score":"0","price":"1750.00","type":"","imgUrl":"img\/experiences\/products\/91481\/thumb.jpeg?v=1480495785","name":"FORMULA YAS 3000 DRIVE","id_category":"13251","category_name":"Drive YAS","description":"Put yourself in the shoes of a professional racing driver revving a 3000cc V6 engine. This race-worthy engine was developed specifically for the circuit by high performance Formula 1\u00ae engineer Cosworth.","reduction":"0.00","available_qty":"32"},{"id":"91821","position":"4","score":"0","price":"650.00","type":"","imgUrl":"img\/experiences\/products\/91821\/thumb.jpeg?v=1472221189","name":"CHEVROLET CAMARO DRAG RACING","id_category":"13251","category_name":"Drive YAS","description":"Feel like a champion with a firsthand encounter of the awesomely gritty Chevrolet Camaro. As the official vehicle of the Yas Drag Racing Academy, it provides the ideal introduction to becoming a professional drag racer. Seize your chance to unleash the velocity and horsepower of this car on our safe and NHRA certified drag racing strip.","reduction":"0.00","available_qty":"10"},{"id":"92391","position":"7","score":"0","price":"750.00","type":"","imgUrl":"img\/experiences\/products\/92391\/thumb.jpeg?v=1472221578","name":"ASTON MARTIN GT4 PASSENGER","id_category":"13251","category_name":"Drive YAS","description":"Imagine the drive of your life in the customized racing passenger seat of the distinguished Aston Martin GT4 and flying around the Yas Marina Circuit at pace.","reduction":"0.00","available_qty":"2"},{"id":"93401","position":"100","score":"0","price":"440.00","type":"","imgUrl":"img\/experiences\/products\/93401\/thumb.jpeg?v=1474206849","name":"SUPERSPORT SST PASSENGER","id_category":"13251","category_name":"Drive YAS","description":"You don\u2019t have to be behind the wheel to get a taste of the track. Let a professional racing driver take you for an incredible ride in the Yas Radical SST.","reduction":"0.00","available_qty":"3"},{"id":"94311","position":"9","score":"0","price":"500.00","type":"","imgUrl":"img\/experiences\/products\/94311\/thumb.jpeg?v=1472221690","name":"JAGUAR F-TYPE S COUPE PASSENGER","id_category":"13251","category_name":"Drive YAS","description":"MOMENT THAT TAKES YOUR BREATH AWAY","reduction":"0.00","available_qty":"2"},{"id":"96201","position":"8","score":"0","price":"750.00","type":"","imgUrl":"img\/experiences\/products\/96201\/thumb.jpeg?v=1472221611","name":"MERCEDES AMG GTS PASSENGER","id_category":"13251","category_name":"Drive YAS","description":"Race around the track with this compact beast and feel the power of this vehicle from the moment you start the engine.","reduction":"0.00","available_qty":"2"},{"id":"193971","position":"4","score":"0","price":"4000.00","type":"","imgUrl":"img\/experiences\/products\/193971\/thumb.jpeg","name":"Ferrari 458 GT DRIVE","id_category":"13251","category_name":"Drive YAS","description":"Brace yourself motorsport fans\u2026 the Ferrari 458 GT is now available at the iconic Yas Marina Circuit!  For a limited time only get behind the wheel of this magnificent automotive marvel and feel every bit of power coming from its 570 HP 4.5 litre V8 engine. <br \/><br><br \/><br><br \/>You will not be disappointed with the raw top speed of 320 km\/h down the longest straight in F1\uf0d2 .  Imagine racing through the most modern F1\uf0d2 circuit with such a fierce yet elegant machine.  <br \/><br><br \/><br><br \/>Don\u2019t miss your chance for an experience of a lifetime!<br \/><br>","reduction":"0.00","available_qty":"2"}]');
    }

}