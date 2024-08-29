<?php
namespace App\Http\Controllers\Admin;
use DB;
use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Routing\Controller;
use Modules\Vendor\Entities\Vendor;

class SubscriptionController extends Controller
{
    // Display the subscription settings page
    public function index()
    {
        // Fetch the subscription record (assuming there's only one)
        $subscription = Subscription::first();

        return view('admin.subscription', compact('subscription'));
    }

    // Handle the subscription setup form submission
    public function setup(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);
        $subscription = Subscription::first();
        
        if (!$subscription) {
            $subscription = new Subscription();
        }

        $subscription->amount = $request->input('amount');
        $subscription->save();

        return redirect()->route('admin.general.subscription')->with('success', 'Subscription updated successfully.');
    }
    public function showSubscriptionForm($id)
    {
        $subscription = Subscription::first(); // Fetch the subscription record
        return view('vendor.subscription', compact('id', 'subscription'));
    }

    // Handle subscription form submission
    public function processSubscription($id)
    {
        $subscription = DB::table('subscriptions')->first();
        $amount = $subscription->amount ?? 0;
        $user = DB::table('vendors')->whereId($id)->first();
        $gateway = DB::Table('payment_gateways')->where('name','paypal')->first();
        $data['client_id'] = 'testing';
        $data['link'] = 'https://sandbox.paypal.com';
        if($gateway){
            $details = json_decode($gateway->credentials);
            $data['client_id'] = $gateway->test_mode == 1 ? $details->sandbox_client_id : $details->client_id;
            $data['link'] = $gateway->test_mode == 1 ? 'https://sandbox.paypal.com' : 'https://paypal.com';
        }
        if($user->subscribed == 'yes'){
            return redirect()->route('vendor.login')->with('success', 'Vendor Already subscribed');
        }
        if($amount == 0){
            return redirect()->route('vendor.login')->with('error', 'No Subscription amount found.');
        }
        $data['user'] = $user;
        $data['amount'] = $amount;
        return view('admin.subscribe_now',$data);
    }
    public function paypalSubscription(Request $request){
        $data = json_encode($request->all());
        Vendor::whereId($request->user_id)->update([
            'subscribed' => 'yes',
            'subscription_details' => $data
        ]);
        return redirect()->route('vendor.login')->with('success', 'No Subscription amount found.');
    }

}
