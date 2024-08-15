<?php

namespace App\Http\Controllers;

use Modules\CountryManage\Entities\Country;
use App\Events\SupportMessage;
use App\Helpers\FlashMsg;
use App\Mail\BasicMail;
use App\Shipping\ShippingAddress;
use App\Support\SupportTicket;
use App\Support\SupportTicketMessage;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Modules\DeliveryMan\Entities\DeliveryManRating;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\OrderTrack;
use Modules\Order\Entities\SubOrder;
use Modules\Product\Entities\ProductSellInfo;
use Modules\Refund\Entities\RefundPreferredOption;
use Modules\Refund\Entities\RefundReason;
use Modules\Refund\Entities\RefundRequest;
use Modules\Refund\Http\Requests\HandleUserRefundRequest;
use Modules\Refund\Http\Services\RefundServices;

class UserDashboardController extends Controller
{
    public const BASE_PATH = 'frontend.user.dashboard.';

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function user_index()
    {
        $product_count = ProductSellInfo::where('user_id', auth('web')->user()->id)->count();
        $support_ticket_count = SupportTicket::where('user_id', auth('web')->user()->id)->count();
        $all_orders = Order::with('paymentMeta')->withCount('isDelivered')
            ->where('user_id', auth('web')->user()->id)
            ->orderBy('id', 'DESC')
            ->latest()
            ->paginate(5);

        return view(self::BASE_PATH.'user-home', compact('all_orders','product_count', 'support_ticket_count'));
    }

    public function user_email_verify_index()
    {
        $user_details = Auth::guard('web')->user();
        if ($user_details->email_verified == 1) {
            return redirect()->route('user.home');
        }
        if (empty($user_details->email_verify_token)) {
            User::find($user_details->id)->update(['email_verify_token' => \Str::random(8)]);
            $user_details = User::find($user_details->id);
            $message_body = __('Here is your verification code').' <span class="verify-code">'.$user_details->email_verify_token.'</span>';

            try {
                Mail::to($user_details->email)->send(new BasicMail([
                    'subject' => __('Verify your email address'),
                    'message' => $message_body,
                ]));
            } catch (\Exception $e) {
                //
            }
        }

        return view('frontend.user.email-verify');
    }

    public function reset_user_email_verify_code()
    {
        $user_details = Auth::guard('web')->user();
        if ($user_details->email_verified == 1) {
            return redirect()->route('user.home');
        }
        $message_body = __('Here is your verification code').' <span class="verify-code">'.$user_details->email_verify_token.'</span>';

        try {
            Mail::to($user_details->email)->send(new BasicMail([
                'subject' => __('Verify your email address'),
                'message' => $message_body,
            ]));
        } catch (\Exception $e) {
            return redirect()->route('user.email.verify')->with(['msg' => $e->getMessage(), 'type' => 'danger']);
        }

        return redirect()->route('user.email.verify')->with(['msg' => __('Resend Verify Email Success'), 'type' => 'success']);
    }

    public function user_email_verify(Request $request)
    {
        $request->validate([
            'verification_code' => 'required',
        ], [
            'verification_code.required' => __('verify code is required'),
        ]);
        $user_details = Auth::guard('web')->user();
        $user_info = User::where(['id' => $user_details->id, 'email_verify_token' => $request->verification_code])->first();
        if (empty($user_info)) {
            return redirect()->back()->with(['msg' => __('your verification code is wrong, try again'), 'type' => 'danger']);
        }
        $user_info->email_verified = 1;
        $user_info->save();

        return redirect()->route('user.home');
    }

    public function user_profile_update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191|unique:users,id,'.$request->user_id,
            'phone' => 'nullable|string|max:191',
            'state' => 'nullable|string|max:191',
            'city' => 'nullable|string|max:191',
            'zipcode' => 'nullable|string|max:191',
            'country' => 'nullable|string|max:191',
            'address' => 'nullable|string',
            'image' => 'nullable|string',
        ], [
            'name.' => __('name is required'),
            'email.required' => __('email is required'),
            'email.email' => __('provide valid email'),
        ]);

        User::find(Auth::guard()->user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $request->image,
            'phone' => $request->phone,
            'state' => $request->state,
            'city' => $request->city,
            'zipcode' => $request->zipcode,
            'country' => $request->country,
            'address' => $request->address,
        ]);

        return redirect()->back()->with(['msg' => __('Profile Update Success'), 'type' => 'success']);
    }

    public function user_password_change(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'old_password.required' => __('Old password is required'),
            'password.required' => __('Password is required'),
            'password.confirmed' => __('password must have to be confirmed'),
        ]);

        $user = User::findOrFail(Auth::guard()->user()->id);

        if (Hash::check($request->old_password, $user->password)) {

            $user->password = Hash::make($request->password);
            $user->save();
            Auth::guard('web')->logout();

            return redirect()->route('user.login')->with(['msg' => __('Password Changed Successfully'), 'type' => 'success']);
        }

        return redirect()->back()->with(['msg' => __('Somethings Going Wrong! Please Try Again or Check Your Old Password'), 'type' => 'danger']);
    }

    public function edit_profile()
    {
        return view(self::BASE_PATH.'edit-profile')
            ->with(['user_details' => $this->logged_user_details()]);
    }

    public function change_password()
    {
        return view(self::BASE_PATH.'change-password');
    }

    public function logged_user_details()
    {
        $old_details = '';
        if (empty($old_details)) {
            $old_details = User::findOrFail(Auth::guard('web')->user()->id);
        }

        return $old_details;
    }

    /** ============================================================================
     *                  SHIPPING ADDRESS FUNCTIONS
    ============================================================================ */
    public function allShippingAddress()
    {
        if (! auth()->check('web')) {
            return redirect()->route('homepage');
        }

        $all_shipping_address = ShippingAddress::where('user_id', getUserByGuard('web')->id)->paginate(10);

        return view(self::BASE_PATH.'shipping.all', compact('all_shipping_address'));
    }

    public function createShippingAddress()
    {
        $all_country = Country::where('status', 'publish')->get();

        return view(self::BASE_PATH.'shipping.new', compact('all_country'));
    }

    public function storeShippingAddress(Request $request): \Illuminate\Http\RedirectResponse
    {
        if (! auth('web')->user()) {
            return back()->with(FlashMsg::explain('danger', __('Login to add new ')));
        }

        $request->validate([
            'shipping_address_name' => 'nullable|string|max:191',
            'name' => 'required|string|max:191',
            'email' => 'nullable|string|max:191',
            'phone' => 'required|string|max:191',
            'country' => 'required|string|max:191',
            'state' => 'nullable|string|max:191',
            'city' => 'nullable|string|max:191',
            'zipcode' => 'nullable|string|max:191',
            'address' => 'nullable|string|max:191',
        ]);

        $user_shipping_address = ShippingAddress::create([
            'shipping_address_name' => $request->shipping_address_name,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'user_id' => getUserByGuard('web')->id ?? null,
            'country_id' => $request->country,
            'state_id' => $request->state,
            'city' => $request->city,
            'zip_code' => $request->zipcode,
            'address' => $request->address,
        ]);

        return $user_shipping_address->id
            ? back()->with(FlashMsg::create_succeed('Shipping address'))
            : back()->with(FlashMsg::create_failed('Shipping address'));
    }

    public function deleteShippingAddress($id)
    {
        if (ShippingAddress::findOrFail($id)->delete()) {
            return back()->with(FlashMsg::delete_succeed('Shipping address'));
        }

        return back()->with(FlashMsg::delete_failed('Shipping address'));
    }

    /** ============================================================================
     *                  ORDER PAGE FUNCTIONS
     * ============================================================================ */
    public function allOrdersPage(): Factory|View|Application
    {
        $all_orders = Order::with('paymentMeta')->withCount('isDelivered')
            ->where('user_id', auth('web')->user()->id)
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view(self::BASE_PATH.'order.all', compact('all_orders'));
    }

    /** ============================================================================
     *                  ORDER PAGE FUNCTIONS
     * ============================================================================ */
    public function allRefundsPage(): Factory|View|Application
    {
        if(!moduleExists("Refund")){
            abort(404);
        }

        $refundRequests = RefundRequest::withCount('requestProduct')
            ->with('currentTrackStatus', 'user:id,name,email,phone', 'order:id,order_status,created_at', 'order.paymentMeta')
            ->where('user_id', auth('web')->user()->id)->orderByDesc('id')
            ->paginate(20);

        return view(self::BASE_PATH.'refund.all', compact('refundRequests'));
    }

    public function viewRequest($id)
    {
        if(!moduleExists("Refund")){
            abort(404);
        }

        // fetch all information about this request
        $request = RefundRequest::with(['currentTrackStatus', 'preferredOption', 'products', 'user', 'order' => function ($query) {
            $query->withCount('orderItems');
        }, 'order.paymentMeta', 'requestFile', 'requestTrack', 'requestProduct', 'productVariant', 'productVariant.productColor', 'productVariant.productSize'])
            ->findOrFail($id);

        return view(self::BASE_PATH.'refund.view-request', compact('request'));
    }

    public function orderRefundPage($id)
    {
        if(!moduleExists("Refund")){
            abort(404);
        }

        // get all order items
        $order = Order::with(['refundRequest', 'paymentMeta', 'orderItems', 'orderItems.product', 'orderItems.variant', 'orderItems.variant.productColor', 'orderItems.variant.productSize'])
            ->withCount('isDelivered', 'refundRequest')
            ->whereHas('isDelivered')
            ->whereHas('address')
            ->where('user_id', auth('web')->user()->id)->orderBy('id', 'DESC')
            ->where('id', $id)
            ->firstOrFail();

        $refundable_items = RefundServices::getProduct($id);
        $refundReasons = RefundReason::all();
        $refundPreferredOptions = RefundPreferredOption::all();

        return view(self::BASE_PATH.'order.refund', compact('id', 'order', 'refundable_items', 'refundReasons', 'refundPreferredOptions'));
    }

    public function handleRefundRequest(HandleUserRefundRequest $request, $id)
    {
        if(!moduleExists("Refund")){
            abort(404);
        }

        // get prepare for product data for request refund
        $refundProducts = RefundServices::prepareRefundRequestData($request->validated(), $id);

        return back()->with([
            'msg' => $refundProducts ? __('Your request has been sent') : __('Failed to send request something went wrong.'),
            'type' => $refundProducts ? 'success' : 'danger',
        ]);
    }

    public function orderDetailsPage($item): Factory|View|Application
    {
        $orders = SubOrder::with(['order', 'vendor', 'orderItem', 'orderItem.product', 'orderItem.variant', 'orderItem.variant.productColor', 'orderItem.variant.productSize'])
            ->where('order_id', $item)->get();
        $payment_details = Order::with('address', 'paymentMeta')
            ->when(moduleExists("DeliveryMan"), function ($query){
                $query->with("deliveryMan");
            })->find($item);
        $orderTrack = OrderTrack::where('order_id', $payment_details->id)->orderByDesc('id')->first();

        return view(self::BASE_PATH.'order.details', compact('item', 'orders', 'payment_details', 'orderTrack'));
    }

    public function orderDeliveryManRatting($item, Request $request)
    {
        // first verified user input data then insert ratting into database
        $data = $request->validate([
            'ratting' => 'required|integer',
            'review' => 'nullable|string',
        ]);

        if(!moduleExists("DeliveryMan")){
            abort(403);
        }

        // check order is exist or not if order not exist then show 404 page
        $order = Order::with('deliveryMan')->findOrFail($item); // if order is not found on database then it will show 404 page
        // check this order is contain delivery man or not if this order does not have assigned delivery man then show exception
        if (! empty($order->deliveryMan)) {
            // first check if this order is have already a ratting then user can't give ratting again
            if (DeliveryManRating::where('delivery_man_id', $order->deliveryMan?->delivery_man_id)->count() < 1) {
                DeliveryManRating::create([
                    'user_id' => auth()->id(),
                    'delivery_man_id' => $order->deliveryMan?->delivery_man_id,
                    'rating' => $data['ratting'],
                    'review' => $data['review'],
                    'status' => 'active',
                ]);

                return back()->with([
                    'msg' => __('Successfully sent your feedback'),
                    'type' => 'success',
                ]);
            }

            return back()->with([
                'msg' => __('This order already have a feedback'),
                'type' => 'danger',
            ]);
        }

        throw new \Exception('Delivery man not assigned for this order');
    }

    /** ===================================================================
     *                  SUPPORT TICKETS
     * =================================================================== */
    public function support_tickets()
    {
        $all_tickets = SupportTicket::where('user_id', auth('web')->user()->id)->paginate(10);

        return view(self::BASE_PATH.'support-tickets.all')->with(['all_tickets' => $all_tickets]);
    }

    public function support_ticket_view(Request $request, $id)
    {
        $ticket_details = SupportTicket::findOrFail($id);
        $all_messages = SupportTicketMessage::where(['support_ticket_id' => $id])->get();
        $q = $request->q ?? '';

        return view(self::BASE_PATH.'support-tickets.view')->with(['ticket_details' => $ticket_details, 'all_messages' => $all_messages, 'q' => $q]);
    }

    public function support_ticket_message(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required',
            'user_type' => 'required|string|max:191',
            'message' => 'required',
            'send_notify_mail' => 'nullable|string',
            'file' => 'nullable|mimes:zip',
        ]);

        $ticket_info = SupportTicketMessage::create([
            'support_ticket_id' => $request->ticket_id,
            'type' => $request->user_type,
            'message' => $request->message,
            'notify' => $request->send_notify_mail ? 'on' : 'off',
        ]);

        if ($request->hasFile('file')) {
            $uploaded_file = $request->file;
            $file_extension = $uploaded_file->getClientOriginalExtension();
            $file_name = pathinfo($uploaded_file->getClientOriginalName(), PATHINFO_FILENAME).time().'.'.$file_extension;
            $uploaded_file->move('assets/uploads/ticket', $file_name);
            $ticket_info->attachment = $file_name;
            $ticket_info->save();
        }

        //send mail to user
        event(new SupportMessage($ticket_info));

        return back()->with(FlashMsg::settings_update(__('Message send')));
    }

    public function support_ticket_priority_change(Request $request)
    {
        $request->validate([
            'priority' => 'required|string|max:191',
        ]);
        SupportTicket::findOrFail($request->id)->update([
            'priority' => $request->priority,
        ]);

        return 'ok';
    }

    public function support_ticket_status_change(Request $request)
    {
        $request->validate([
            'status' => 'required|string|max:191',
        ]);
        SupportTicket::findOrFail($request->id)->update([
            'status' => $request->status,
        ]);

        return 'ok';
    }
}
