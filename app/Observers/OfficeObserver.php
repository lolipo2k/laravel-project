<?php

namespace App\Observers;

use App\Jobs\SendOffice;
use App\Models\Office;

class OfficeObserver
{
    public function created(Office $office)
    {
        SendOffice::dispatch($office);
    }
}
