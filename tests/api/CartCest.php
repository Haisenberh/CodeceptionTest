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

    public function getEventMetaInformationNegativeTest(\ApiTester $I)
    {
        $I->wantTo('Get information event and meta valid test');
        $I->sendGET('/action.php?a=getCartDetail&ap=V4&c=Cart&p=Cart');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseEquals('{"response":1,"cart":{"id":null,"id_customer":null,"products":null,"cart_total_cc":0,"cart_total_cc_display":"AED 0.00","cart_total":0,"cart_total_display":"AED 0.00","cart_total_with_discount":0,"cart_total_with_discount_display":"AED 0.00","ticket_total":null,"ticket_total_display":"AED 0.00","gift_voucher_total":null,"gift_voucher_total_display":"AED 0.00","accessory_total":null,"accessory_total_display":"AED 0.00","economy_total":null,"economy_total_display":"AED 0.00","order_paid_gift_voucher":null,"order_paid_gift_voucher_display":"AED 0.00","order_paid_account_balance":null,"order_paid_account_balance_display":"AED 0.00","order_rest_to_pay":null,"order_rest_to_pay_display":"AED 0.00","order_rest_to_pay_cc":null,"order_rest_to_pay_cc_display":"AED 0.00","order_already_paid":null,"order_already_paid_display":"AED 0.00","order_already_paid_cc":null,"order_already_paid_cc_display":"AED 0.00","order_total_real":0,"order_total_real_display":"AED 0.00","order_total_real_display_abs":"AED 0.00","order_total":0,"order_total_display":"AED 0.00","order_total_split_display":{"currency_signe":"AED","currency_placement":"before","price_without_cents":"0","cents":"00"},"order_total_with_installment":null,"order_total_with_installment_display":{"currency_signe":"AED","currency_placement":"before","price_without_cents":"0","cents":"00"},"handlingfee_total":null,"handlingfee_total_display":"AED 0.00","shipping_total":0,"shipping_total_display":"AED 0.00","shipping_total_cc":0,"shipping_total_display_cc":"AED 0.00","cart_discounts":null,"banking_fee_total":null,"banking_fee_total_cc":null,"banking_fee_total_display":"AED 0.00","insurance_total":0,"insurance_total_display":"AED 0.00","discount_total":null,"discount_total_display":"AED 0.00","list_of_discounts":[],"installment_total":null,"installment_total_display":"AED 0.00","hospitality_total":null,"hospitality_total_display":"AED 0.00","downloadable_total":null,"downloadable_total_display":"AED 0.00","width_total":4,"surprise":"1","skip_funnel_address":"1","has_insurance":false,"id_referrer":false,"type_total":[],"type_total_cc":[],"type_total_display":[],"type_total_cc_display":[],"id_address_delivery":0,"id_address_invoice":0,"continue_shopping_url":"home","is_private_sale_cart":false,"total_product_cart_quantity":0,"shipping":"pickup","ticket_total_without_reduction_display":"AED 0.00","display_installment":false,"active_installment":false,"available_installment":[],"cart_installment_number":0,"installment_number":0,"installment_plan":null,"paypal_selected":false,"display_paypal":false,"hasGiftVoucherPayment":true,"hasAccountPayment":false}}');
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
        $I->wantTo('Get carriers by country');
        $I->sendPOST('/dispatch.php?action=getCarriersByCountry', ['id_country' => '244','id_carrier' => $this->carrier_id]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        //todo find out how set id_cart parameter
        $I->seeResponseEquals('{"error":401,"error_message":"Session parameter id_cart missing"}');
    }


}