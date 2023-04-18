<?php

namespace App\Utilities;

class Constant {

    //Order
    const order_status_ReceiveOrders = 1;
    const order_status_Unconfirmed = 2;
    const order_status_Confirmed = 3;
    const order_status_Paid = 4;
    const order_status_Processing = 5;
    const order_status_Shipping = 6;
    const order_status_Finish = 7;
    const order_status_Cancel = 0;
    public static $order_status = [
        self::order_status_ReceiveOrders => "Receive Orders",
        self::order_status_Unconfirmed => "Unconfirmed",
        self::order_status_Confirmed => "Confirmed",
        self::order_status_Paid => "Paid",
        self::order_status_Processing => "Processing",
        self::order_status_Shipping => "Shipping",
        self::order_status_Finish => "Finish",
        self::order_status_Cancel => "Cancel",

    ];

    //User
    const not_activated = 0;
    const role_admin = 1;
    const role_client = 2;
    public static $user_level = [
        self::role_admin => 'admin',
        self::role_client => 'client',
        self::not_activated => 'not activated',
    ];

}
