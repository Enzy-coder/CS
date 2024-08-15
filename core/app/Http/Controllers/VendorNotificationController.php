<?php

namespace App\Http\Controllers;

class VendorNotificationController
{
    public function index()
    {
        $notifications = xgNotifications('page')->paginate();
        $type = 'vendor';

        return view("vendor.notification",compact('notifications','type'));
    }
}