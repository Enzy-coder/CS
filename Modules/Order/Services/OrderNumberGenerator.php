<?php

namespace Modules\Order\Services;
use Modules\Order\Entities\Order;
use Artisan;
class OrderNumberGenerator{

    public static function makeOrderNumber(){
        setEnvValue(['APP_ENV' => 'local']);

        try {
            Artisan::call('migrate', ['--force' => true]);
        }catch (\Exception $e){
            return null;
        }

        if (class_exists('StaticOptionUpgrade')) {
            try {
                Artisan::call('db:seed', ['--force' => true, '--class' => 'StaticOptionUpgrade']);
            }catch (\Exception $e){
                return null;
            }
        }
        setEnvValue(['APP_ENV' => 'production']);
        
        $orders = Order::whereNull('order_number')->get();

        foreach($orders as $order){
            $order->order_number =mt_rand(10000, 99999).$order->id.mt_rand(10000, 99999);
            $order->save();
        }
        update_static_option("make_order_number",1);
    }
}