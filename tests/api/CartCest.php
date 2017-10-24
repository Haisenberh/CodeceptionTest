<?php

class CartCest
{
    public $carrier_id;
    public $country_id;

    public function _before(\ApiTester $I)
    {
        $I->createNewCookie($I);
        $this->carrier_id = $I->getCarrierIdByName($I, 'Aramex');
    }

    public function _after(\ApiTester $I)
    {
    }

    public function getCartDetailsValidTest(\ApiTester $I)
    {
        $I->wantTo('Get information event and meta positive api test');
        $I->sendGET('/action.php?a=getCartDetail&ap=V4&c=Cart&p=Cart');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseMatchesJsonType([
            "response" => 'integer',
            "cart" => [
                "id" => 'string|null',
                "id_customer" => 'string|null',
                "products" => 'string|null',
                "cart_total_cc" => 'integer',
                "cart_total_cc_display" => 'string',
                "cart_total" => 'integer',
                "cart_total_display" => 'string',
                "cart_total_with_discount" => 'integer',
                "cart_total_with_discount_display" => 'string',
                "ticket_total" => 'string|null',
                "ticket_total_display" => 'string',
                "gift_voucher_total" => 'string|null',
                "gift_voucher_total_display" => 'string',
                "accessory_total" => 'string|null',
                "accessory_total_display" => 'string',
                "economy_total" => 'string|null',
                "economy_total_display" => 'string',
                "order_paid_gift_voucher" => 'string|null',
                "order_paid_gift_voucher_display" => 'string',
                "order_paid_account_balance" => 'string|null',
                "order_paid_account_balance_display" => 'string',
                "order_rest_to_pay" => 'string|null',
                "order_rest_to_pay_display" => 'string',
                "order_rest_to_pay_cc" => 'string|null',
                "order_rest_to_pay_cc_display" => 'string',
                "order_already_paid" => 'string|null',
                "order_already_paid_display" => 'string',
                "order_already_paid_cc" => 'string|null',
                "order_already_paid_cc_display" => 'string',
                "order_total_real" => 'integer',
                "order_total_real_display" => 'string',
                "order_total_real_display_abs" => 'string',
                "order_total" => 'integer',
                "order_total_display" => 'string',
                "order_total_split_display" => [
                    "currency_signe" => 'string',
                    "currency_placement" => 'string',
                    "price_without_cents" => 'string',
                    "cents" => 'string',
                ],
                "order_total_with_installment" => 'string|null',
                "order_total_with_installment_display" => [
                    "currency_signe" => 'string',
                    "currency_placement" => 'string',
                    "price_without_cents" => 'string',
                    "cents" => 'string',
                ],
                "handlingfee_total" => 'string|null',
                "handlingfee_total_display" => 'string',
                "shipping_total" => 'integer',
                "shipping_total_display" => 'string',
                "shipping_total_cc" => 'integer',
                "shipping_total_display_cc" => 'string',
                "cart_discounts" => 'string|null',
                "banking_fee_total" => 'string|null',
                "banking_fee_total_cc" => 'string|null',
                "banking_fee_total_display" => 'string',
                "insurance_total" => 'integer',
                "insurance_total_display" => 'string',
                "discount_total" => 'string|null',
                "discount_total_display" => 'string',
                "list_of_discounts" => [],
                "installment_total" => 'string|null',
                "installment_total_display" => 'string',
                "hospitality_total" => 'string|null',
                "hospitality_total_display" => 'string',
                "downloadable_total" => 'string|null',
                "downloadable_total_display" => 'string',
                "width_total" => 'integer',
                "surprise" => 'string|null',
                "skip_funnel_address" => 'string|null',
                "has_insurance" => 'boolean',
                "id_referrer" => 'boolean',
                "type_total" => [],
                "type_total_cc" => [],
                "type_total_display" => [],
                "type_total_cc_display" => [],
                "id_address_delivery" => 'integer',
                "id_address_invoice" => 'integer',
                "continue_shopping_url" => "string",
                "is_private_sale_cart" => 'boolean',
                "total_product_cart_quantity" => 'integer',
                "shipping" => "string",
                "ticket_total_without_reduction_display" => 'string',
                "display_installment" => 'boolean',
                "active_installment" => 'boolean',
                "available_installment" => [],
                "cart_installment_number" => 'integer',
                "installment_number" => 'integer',
                "installment_plan" => 'string|null',
                "paypal_selected" => 'boolean',
                "display_paypal" => 'boolean',
                "hasGiftVoucherPayment" => 'boolean',
                "hasAccountPayment" => 'boolean'
            ]
        ]);
        $I->seeResponseIsJson();
    }

    public function addCarrierToCartApiTest(\ApiTester $I)
    {
        $I->wantTo('Add carrier to cart positive api test');
        $I->sendPOST('/dispatch.php?action=addCarrierToCart', ['id_carrier' => $this->carrier_id, 'id_cart' => 1]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        //todo find out how set id_cart parameter
        $I->seeResponseEquals('{"error":401,"error_message":"Session parameter id_cart missing"}');
        $I->seeResponseIsJson();
    }

    public function addCarrierToCartApiNegativeTest(\ApiTester $I)
    {
        $I->wantTo('Add carrier to cart without required field negative test');
        $I->sendPOST('/dispatch.php?action=addCarrierToCart');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":401,"error_message":"Session parameter id_cart missing"}');
    }

    public function getCarriersByCountry(\ApiTester $I)
    {
        $I->wantTo('Get carriers by country api test');
        $I->sendPOST('/dispatch.php?action=getCarriersByCountry', ['id_country' => '244', 'id_carrier' => $this->carrier_id]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        //todo find out how set id_cart parameter
        $I->seeResponseEquals('{"error":401,"error_message":"Session parameter id_cart missing"}');
    }


}