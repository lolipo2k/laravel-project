<?php

namespace App\Observers;

use App\Jobs\SendOrder;
use App\Models\Orders;

class OrdersObserver
{
    public function updated(Orders $order)
    {
        if ($order['status'] == 1)
        {
            SendOrder::dispatch($order);
        }
    }
}
