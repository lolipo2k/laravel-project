<?php

namespace App\Providers;

use App\Models\Office;
use App\Models\Orders;
use App\Models\Vacancies;
use App\Observers\OfficeObserver;
use App\Observers\OrdersObserver;
use App\Observers\VacancyObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
 use App\Models\User;
 use App\Observers\UserObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Orders::observe(OrdersObserver::class);
        Office::observe(OfficeObserver::class);
        Vacancies::observe(VacancyObserver::class);
    }
}
