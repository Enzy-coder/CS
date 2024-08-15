<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserEmailVerify
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (auth('web')->check() && auth('web')->user()->email_verified == 0 && empty(get_static_option('disable_user_email_verify'))) {
            return redirect()->route('user.email.verify');
        } elseif (auth('vendor')->check() && auth('vendor')->user()->email_verified == 0 && get_static_option('disable_vendor_email_verify') === 'on') {
            return redirect()->route('vendor.email.verify');
        }

        return $next($request);
    }
}
