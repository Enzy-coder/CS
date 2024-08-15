<?php

namespace Modules\Order\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\DeliveryMan\Entities\DeliveryMan;
use Modules\DeliveryMan\Entities\DeliveryManZone;
use Modules\DeliveryMan\Services\GoogleMapServices;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\SubOrder;
use Modules\Order\Services\OrderService;
use Modules\Order\Services\OrderServices;
use Modules\Order\Traits\OrderDetailsTrait;
use Modules\Order\Traits\StoreOrderTrait;
use Modules\ShippingModule\Entities\Zone;
use Modules\Vendor\Entities\Vendor;
use Modules\Wallet\Http\Services\WalletService;

class AdminOrderController extends Controller
{
    use OrderDetailsTrait;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // first of all we need to get all sub order for login user
        $all_orders = SubOrder::with("order:id,payment_status,created_at")
            ->withCount("orderItem")
            ->orderByDesc("id")->paginate(20);

        return view('order::admin.index', compact("all_orders"));
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function orders()
    {
        // first of all we need to get all sub order for login user
        $all_orders = Order::with(["paymentMeta","orderTrack" => function ($query){
                $query->orderByDesc('id')->limit(1);
            }])
            ->orderByDesc("id")
            ->paginate(20);

        return view('order::admin.order-list', compact("all_orders"));
    }

    public function subOrderDetails($id){
        return OrderService::subOrderDetails($id);
    }

    public function orderVendorList(){
        // first of all i need to get all vendor with some order information
        $vendors = Vendor::with("logo","cover_photo")
        ->withCount(["order as total_order" => function ($order){
            $order->orderByDesc("orders.id");
        },"order as complete_order" => function ($order){
            $order->where("orders.order_status", "complete");
        },"order as pending_order" => function ($order){
            $order->where("orders.order_status", "pending");
        },"product"])
        ->whereHas("order")
        ->withSum("subOrder as total_earning","sub_orders.total_amount")
        ->paginate(get_static_option("order_vendor_list") ?? 20);

        return view("order::admin.vendors", compact("vendors"));
    }

    public function details($id){
        $order = $this->orderDetailsMethod($id);

        // let's check some condition if those condition are not matched then render blade file otherwise redirect to sub order details page
        // first condition will be count sub orders if sub order is less then 2 order and bigger then 0
        // second condition will be if sub order do not have any vendor id on this collection

//        if($order->SubOrders->count() == 1 &&  !empty($order->SubOrders->first()->vendor_id)){
//            return "Working";
//        }


        return view("order::admin.details", compact("order"));
    }

    public function vendorOrders($username){
        $vendor = Vendor::select("id","username")->where("username", $username)->firstOrFail();

        // first of all we need to get all sub order for login user
        $all_orders = SubOrder::with("order:id,payment_status,created_at")
            ->withCount("orderItem")
            ->where("vendor_id", $vendor->id)
            ->orderByDesc("id")
            ->paginate(get_static_option("order_vendor_list"));

        return view('order::admin.index', compact("all_orders"));
    }

    public function edit($orderId){
        $order = $this->orderDetailsMethod($orderId);

        // let's check some condition if those condition are not matched then render blade file otherwise redirect to sub order details page
        // first condition will be count sub orders if sub order is less then 2 order and bigger then 0
        // second condition will be if sub order do not have any vendor id on this collection

        if($order->SubOrders->count() == 1 &&  !empty($order->SubOrders->first()->vendor_id)){
        }

        $edit = true;

        return view("order::admin.details", compact("order","edit"));
    }

    public function updateOrderTrack(Request $request){
        $orderTrack = $request->validate([
            "order_id" => "required",
            "order_track" => "required",
            "order_track.*" => "required"
        ]);

        foreach($orderTrack["order_track"] as $track){
            if($track == 'delivered'){
                //todo:: add order amount from pending balance to main balance
                WalletService::completeOrderAmount($orderTrack["order_id"]);
                //todo:: add wallet history that mean's transaction history
            }

            OrderServices::storeOrderTrack($orderTrack["order_id"],$track, auth()->user()->id, 'admin');
        }

        return back()->with(["type" => "success", "msg" => __("Order track updated successfully.")]);
    }

    public function updateOrderStatus(Request $request){
        $orderData = $request->validate([
            "order_status" => "required",
            "payment_status" => "required",
            "order_id" => "required"
        ]);

        //todo:: now update into database
        Order::where("id", $orderData["order_id"])->update([
            "order_status" => $orderData["order_status"],
            "payment_status" => $orderData["payment_status"],
        ]);

        return back()->with(["type" => "success", "msg" => __("Status updated successfully.")]);
    }
}
