<?php

namespace Modules\Product\Http\Services\Admin;
use DB;
class DummyProductDeleteServices{

    // this is the last id for dummy data in database table
    private static  $dummyProductId = 208;
    private static  $categoryIds = 26;
    private static  $subCategoryIds = 104;
    private static  $childCategoryIds = 728;
    private static  $unitIds = 9;
    private static  $tagIds = 82;
    private static  $brandIds = 16;
    private static  $colorIds = 66;
    private static  $sizeIds = 40;
    private static  $attributeIds = 40;
    private static  $badgeIds = 5;

    private static  $vendorWithdrawRequestsIds = 23;
    private static  $vendorWalletGatewaySettings=2;
    private static  $vendorWalletGatewaysIds = 7;
    private static  $vendorShopInfoIds = 230;
    private static  $vendorShippingMethodIds = 61;
    private static  $vendorBankInfoIds = 221;
    private static  $vendorAddressIds = 221;
    private static  $vendorsIds = 235;
    private static  $orderTrackIds = 494;
    private static  $orderPaymentMetaIds = 444;
    private static  $orderAddressIds = 450;
    private static  $subOrderIds = 470;
    private static  $subOrderItemIds = 545;
    private static  $subOrderCommissionIds = 470;
    private static  $ordersIds = 479;
    private static  $deliveryOptionIds = 14;
    private static  $deliveryManZoneIds = 16;
    private static  $deliveryManWithdrawRequestIds = 16;
    private static  $deliveryManWalletGatewaySavedIds = 1;
    private static  $deliveryManWalletGatewayIds = 1;
    private static  $deliveryManRatingIds = 4;
    private static  $deliveryManPresentAddressIds = 16;
    private static  $deliveryManPickupPointIds = 5;
    private static  $deliveryManPermanentAddressIds = 16;
    private static  $deliveryManOrderIds = 155;
    private static  $deliveryManCredentialIds = 9;
    private static  $deliveryManIds = 28;
    private static  $campaignSoldProductIds = 24;
    private static  $campaignProductIds = 256;
    private static  $campaignIds = 41;
    private static  $liveChatsIds = 7;
    private static  $users = 125;

    public static function dummyProductId(): int
    {
        return self::$dummyProductId;
    }

    public static function destroy()
    {
        $delete = DB::transaction(function () {
                //    products
                    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                    DB::table("products")->where('id','<=',self::dummyProductId())->delete();
                    DB::table("child_categories")->where('id','<=',self::$childCategoryIds)->delete();
                    DB::table("sub_categories")->where('id','<=',self::$subCategoryIds)->delete();
                    DB::table("categories")->where('id','<=',self::$categoryIds)->delete();
                    DB::table("units")->where('id','<=',self::$unitIds)->delete();
                    DB::table("tags")->where('id','<=',self::$tagIds)->delete();
                    DB::table("brands")->where('id','<=',self::$brandIds)->delete();
                    DB::table("colors")->where('id','<=',self::$colorIds)->delete();
                    DB::table("sizes")->where('id','<=',self::$sizeIds)->delete();
                    DB::table("product_attributes")->where('id','<=',self::$attributeIds)->delete();
                    DB::table("badges")->where('id','<=',self::$badgeIds)->delete();
                    //  vendor
                    DB::table("vendor_withdraw_requests")->where('id','<=',self::$vendorWithdrawRequestsIds)->delete();
                    DB::table("vendor_wallet_gateway_settings")->where('id','<=',self::$vendorWalletGatewaySettings)->delete();
                    DB::table("vendor_wallet_gateways")->where('id','<=',self::$vendorWalletGatewaysIds)->delete();
                    DB::table("vendor_shop_infos")->where('id','<=',self::$vendorShopInfoIds)->delete();
                    DB::table("vendor_shipping_methods")->where('id','<=',self::$vendorShippingMethodIds)->delete();
                    DB::table("vendor_bank_infos")->where('id','<=',self::$vendorBankInfoIds)->delete();
                    DB::table("vendor_addresses")->where('id','<=',self::$vendorAddressIds)->delete();
                    DB::table("order_tracks")->where('id','<=',self::$orderTrackIds)->delete();
                    DB::table("order_payment_metas")->where('id','<=',self::$orderPaymentMetaIds)->delete();
                    DB::table("order_addresses")->where('id','<=',self::$orderAddressIds)->delete();
                    DB::table("sub_orders")->where('id','<=',self::$subOrderIds)->delete();
                    DB::table("sub_order_items")->where('id','<=',self::$subOrderItemIds)->delete();
                    DB::table("sub_order_commissions")->where('id','<=',self::$subOrderCommissionIds)->delete();
                    DB::table("orders")->where('id','<=',self::$ordersIds)->delete();
                    DB::table("vendors")->where('id','<=',self::$vendorsIds)->delete();
                    // delivery man
                    DB::table("delivery_man_permanent_addresses")->where('id','<=',self::$deliveryManPermanentAddressIds)->delete();
                    DB::table("delivery_man_credentials")->where('id','<=',self::$deliveryManCredentialIds)->delete();
                    DB::table("delivery_mans")->where('id','<=',self::$deliveryManIds)->delete();
                    DB::table("delivery_options")->where('id','<=',self::$deliveryOptionIds)->delete();
                    DB::table("delivery_man_zones")->where('id','<=',self::$deliveryManZoneIds)->delete();
                    DB::table("delivery_man_withdraw_requests")->where('id','<=',self::$deliveryManWithdrawRequestIds)->delete();
                    DB::table("delivery_man_wallet_gateway_saved")->where('id','<=',self::$deliveryManWalletGatewaySavedIds)->delete();
                    DB::table("delivery_man_wallet_gateways")->where('id','<=',self::$deliveryManWalletGatewayIds)->delete();
                    DB::table("delivery_man_ratings")->where('id','<=',self::$deliveryManRatingIds)->delete();
                    DB::table("delivery_man_present_addresses")->where('id','<=',self::$deliveryManPresentAddressIds)->delete();
                    DB::table("delivery_man_pickup_points")->where('id','<=',self::$deliveryManPickupPointIds)->delete();
                    
                    DB::table("delivery_man_orders")->where('id','<=',self::$deliveryManOrderIds)->delete();
                    
                    
                    //  campaign
                    DB::table("campaign_sold_products")->where('id','<=',self::$campaignSoldProductIds)->delete();
                    DB::table("campaign_products")->where('id','<=',self::$campaignProductIds)->delete();
                    DB::table("campaigns")->where('id','<=',self::$campaignIds)->delete();
                    // live chat
                    DB::table("live_chats")->where('id','<=',self::$liveChatsIds)->delete();
                    DB::table("users")->where('id','<=',self::$users)->delete();
                    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                    return true ;
                });

        if($delete){
            return true;
        }

        return false;
    }

    public static function isDummyProduct(): bool
    {
        $ids=self::dummyProductId();
        $count=DB::table('products')->where('id','<=',$ids)->count();
        if($count>0){
            return true;
        }
        return false;
    }
}