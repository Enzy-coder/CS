<?php

namespace Modules\Vendor\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Vendor\Entities\BusinessType;
use Modules\Vendor\Entities\Vendor;
use Modules\Vendor\Http\Requests\VendorRegistrationRequest;
use Modules\Wallet\Entities\Wallet;

class VendorLoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    public function redirectTo()
    {
        return route('vendor.home');
    }

    public function username()
    {
        return 'username';
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('vendor.login')
            ->with(['msg' => __('You Logged Out !!'), 'type' => 'danger']);
    }

    public function login()
    {
        return view('vendor::vendor.login.index');
    }

    public function vendor_login(Request $request): JsonResponse
{
    // First validate
    $req = $request->validate([
        'username' => 'nullable',
        'password' => 'required|min:6',
    ]);

    // Set login type
    $user_login_type = 'username';
    if (filter_var($req['username'], FILTER_VALIDATE_EMAIL)) {
        $user_login_type = 'email';
    }

    // Attempt to log in the user
    if (Auth::guard('vendor')->attempt([$user_login_type => $req['username'], 'password' => $req['password']], $request->get('remember'))) {
        $user = Auth::guard('vendor')->user();

        // Check subscription status
        if($this->isSubscriptionActive()){
            if ($user->subscribed === 'yes') {
                return response()->json([
                    'msg' => __('Login Success Redirecting'),
                    'type' => 'success',
                    'status' => 'ok',
                ]);
            } else {
                // Redirect to subscription page with vendor ID
                Auth::guard('vendor')->logout();
                return response()->json([
                    'msg' => __('Your subscription has expired. Please renew your subscription.'),
                    'type' => 'danger',
                    'status' => 'not_subscribed',
                    'redirect_url' => route('vendor.subscription', ['id' => $user->id])
                ]);
            }
        }else{
            return response()->json([
                    'msg' => __('Login Success Redirecting'),
                    'type' => 'success',
                    'status' => 'ok',
                ]);
        }
    }

    return response()->json([
        'msg' => sprintf(__('Invalid %s or Password!!'), $user_login_type),
        'type' => 'danger',
        'status' => 'not_ok',
    ]);
}

    

    public function register()
    {
        abort_if(get_static_option('enable_vendor_registration') == 'off', 403);

        $data = [
            'business_type' => BusinessType::select()->get(),
        ];

        return view('vendor::vendor.register.index', $data);
    }

    public function vendor_registration(VendorRegistrationRequest $request)
    {
        abort_if(get_static_option('enable_vendor_registration') == 'off', 403);
        // store validated data into a temporary variable
        $data = $request->all() ?? $request->validated();
        // now change password value and make it hash
        $rawPassword = $data['password'];
        $data['password'] = \Hash::make($data['password']);

        // now create vendor
        $vendor = Vendor::create($data);
        // after creating vendor now need to create wallet
        if ($vendor) {
            Wallet::create([
                'user_id',
                'vendor_id' => $vendor->id,
                'balance' => 0,
                'pending_balance' => 0,
                'status' => 0,
            ]);
        }

        // now make login vendor here
        if (Auth::guard('vendor')->attempt(['username' => $vendor['username'], 'password' => $rawPassword], true)) {
            if($this->isSubscriptionActive()){
                Auth::guard('vendor')->logout();
                return redirect()->route('vendor.subscription', ['id' => $vendor->id]);
            }
             redirect()->route('vendor.login')->with([
                'msg' => $vendor ? __('Registration success') : __('Registration failed'),
                'redirect_url' => route('vendor.subscription', ['id' => $vendor->id]),
                'status' => (bool) $vendor,
            ]);
        }

        return $vendor ? [
            'msg' => __('registration success'),
            'type' => 'success',
        ] : [
            'msg' => __('Failed to register'),
            'type' => 'error',
        ];
    }
    public function isSubscriptionActive(){
        $subscription = DB::table('subscriptions')->first();
        return (!empty($subscription) && $subscription->is_subscription_active == 'active') ? true : false;
    }
}
