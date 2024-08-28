<?php

namespace App\Http\Controllers\Admin;

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
    public function processSubscription(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        // Update user's subscription status
        $user = Vendor::findOrFail($id);
        $user->subscribed = 'yes'; // Mark user as subscribed
        $user->save();

        return redirect()->route('vendor.dashboard')->with('success', 'Subscription updated successfully.');
    }

}
