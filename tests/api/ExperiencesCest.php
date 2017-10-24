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
        $I->seeResponseMatchesJsonType([
            "id" => 'string',
            "col" => 'string',
            "row" => 'string',
            "imgurl" => 'string',
            "name" => 'string',
            "description" => 'string',
            "is_gift_voucher_category" => 'string'
        ]);
    }

    public function getExperiencesSettings(\ApiTester $I)
    {
        $I->wantTo('Get experiences settings api test');
        $I->sendPOST('/action.php?c=Experiences&a=getExperienceSettings');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            "id_experience_setting" => 'string',
            "scope" => "string",
            "id_scope" => 'string',
            "sort_by_popularity" => 'string',
            "sort_by_sale" => 'string',
            "sort_by_alpha" => 'string',
            "sort_by_price" => 'string',
            "use_filter_category" => 'string',
            "can_search" => 'string',
            "availability_threshold" => 'string',
            "id_lang" => 'string',
            "search_text" => 'string',
            "meta_title" => 'string',
            "meta_description" => 'string',
            "meta_keywords" => 'string',
            "home_title" => 'string',
            "home_subtitle" => 'string'
        ]);
    }

    public function getExperiencesCategoryName(\ApiTester $I)
    {
        $I->wantTo('Get experiences category name api test');
        $I->sendPOST('/action.php?c=Experiences&a=getCategoryName', ['id_experience' => $this->driving_experience_id]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            "name" => 'string',
            "description" => 'string',
            "id_category" => 'string',
            "meta_title" => 'string|null',
            "meta_description" => 'string|null',
            "meta_keywords" => 'string|null',
            "is_gift_voucher_category" => 'string'
        ]);
    }

    public function getExperiencesCurrency(\ApiTester $I)
    {
        $I->wantTo('Get experiences currency api test');
        $I->sendPOST('/action.php?c=Experiences&a=getCurrency', ['id_currency' => $this->dirham_currency_id]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            "format" => 'string',
            "sign" => 'string',
        ]);
    }

    public function getExperiencesHasAvailability(\ApiTester $I)
    {
        $I->wantTo('Get experiences availability api test');
        $I->sendPOST('/action.php?c=Experiences&a=hasAvailability', ['id_product' => $this->product_id]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            "result" => 'string',
            "min_price" => 'string',
            "first_month_availability" => 'string',
            "first_year_availability" => 'string',
            "min_price_display" => 'string',
        ]);
    }

    public function getExperiencesNextAvailabilities(\ApiTester $I)
    {
        $I->wantTo('Get experiences next availabilities api test');
        $I->sendPOST('/action.php?c=Experiences&a=getProductNextAvailabilities', ['id_product' => $this->product_id, 'month_day' => '2017-03-01']);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(['string']);
    }

    public function experiencesGetMonth(\ApiTester $I)
    {
        $I->wantTo('Get experiences availability groped by month api test');
        $I->sendPOST('/action.php?c=Experiences&a=getMonths', ['id_experience' => $this->driving_experience_id]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(['month' => 'string', 'available' => 'string']);
    }

    public function getExperiencesMonthAvailabilities(\ApiTester $I)
    {
        $I->wantTo('Get experiences month availability information api test');
        $I->sendPOST('/action.php?c=Experiences&a=getMonthAvailabilities', ['id_product' => $this->product_id, 'date_for_month' => '2017-10-01', 'isFront' => 'true']);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
    }

    public function getExperiencesQuickFilters(\ApiTester $I)
    {
        $I->wantTo('Get experiences quick filters information api test');
        $I->sendPOST('/action.php?c=Experiences&a=getQuickFilters');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            "id" => 'integer',
            "name" => 'string'
        ]);
    }

    public function getExperienceProductInformation(\ApiTester $I)
    {
        $I->wantTo('Get experiences product information api test');
        $I->sendPOST('/action.php?c=Experiences&a=getProduct', ['id_product' => $this->product_id]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            "id_product" => 'string',
            "id_category_default" => 'string',
            "category_name" => 'string',
            "name" => 'string',
            "videoUrl" => 'string',
            "isVideoDefault" => "string",
            "meta_title" => "string",
            "meta_description" => "string",
            "meta_keywords" => 'string',
            "sliderImages" => 'array',
            "defaultImage" => 'string',
        ]);
    }

    public function getExperienceProducts(\ApiTester $I)
    {
        $I->wantTo('Get experiences products api test');
        $I->sendPOST('/action.php?c=Experiences&a=getProducts', ['id_experience' => $this->driving_experience_id]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            "id" => 'string',
            "position" => 'string',
            "price" => 'string',
            "imgUrl" => 'string',
            "name" => 'string',
            "reduction" => "string",
            "price_reducted" => "string",
            "available_qty" => "string",
            "attributes" => 'array'
        ]);
    }

    public function getExperienceProductsFilters(\ApiTester $I)
    {
        $I->wantTo('Get experiences products filters api test');
        $I->sendPOST('/action.php?c=Experiences&a=getProductsFilters', ['id_product' => $this->product_id]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('[]');
    }

    public function getExperienceMasterProductData(\ApiTester $I)
    {
        $I->wantTo('Get experiences master product data api test');
        $I->sendPOST('/action.php?c=Experiences&a=getMasterProductData', ['id_product' => $this->product_id]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            "id_product" => 'string',
            "category_name" => 'string',
            "name" => 'string',
            "videoUrl" => 'string',
            "meta_title" => 'string',
            "meta_keywords" => 'string',
            "sliderImages" => 'array',
            "defaultImage" => 'string',
        ]);
    }

    public function getExperienceDescription(\ApiTester $I)
    {
        $I->wantTo('Get experiences product description api test');
        $I->sendPOST('/action.php?c=Experiences&a=getDescriptions', ['id_product' => $this->product_id]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            "id" => 'string',
            "name" => 'string',
            "text" => 'string'
        ]);
    }

    public function getMightAlsoBeLikedProducts(\ApiTester $I)
    {
        $I->wantTo('Get experience products list that might be also interested to clients');
        $I->sendPOST('/action.php?c=Experiences&a=getMightAlsoBeLikedProducts', ['id_product' => $this->product_id, 'limit' => 5]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            "id" => 'string',
            "price" => 'string',
            "imgUrl" => 'string',
            "name" => 'string',
            "description" => 'string',
            "reduction" => 'string',
            "price_reducted" => 'string',
            "available_qty" => 'string',
            "price_display" => 'string',
            "price_reducted_display" => 'string'
        ]);
    }

    public function getExperienceFrontPriceLists(\ApiTester $I)
    {
        $I->wantTo('Get experiences product price data');
        $I->sendPOST('/action.php?c=Experiences&a=getFrontPriceLists', ['id_product' => $this->product_id]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            "available_quantity" => 'string',
            "id_product_type" => 'string',
            "id_master_product" => 'string',
            "id_price_list" => 'string',
            "name" => 'string',
            "reduction" => 'string',
            "id" => 'string',
            "price_display" => 'string',
            "reduction_display" => 'string',
            "price_reducted" => 'string'
        ]);
    }

    public function getExperienceSearchResult(\ApiTester $I)
    {
        $I->wantTo('Get experiences search result by date');
        $I->sendPOST('/action.php?c=Experiences&a=getSearchResults', ['id_experience' => $this->driving_experience_id, 'month_date' => '2018-03-01']);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            "id" => 'string',
            "position" => 'string',
            "score" => 'string',
            "price" => 'string',
            "type" => 'string',
            "imgUrl" => 'string',
            "name" => 'string',
            "id_category" => 'string',
            "category_name" => 'string',
            "description" => 'string',
            "reduction" => 'string',
            "available_qty" => 'string',
        ]);
    }

}