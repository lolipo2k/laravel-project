<?php

namespace App\Jobs;

use App\Models\Orders;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Orders $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $order = $this->order;

        $user = [
            'email' => $order['email'],
            'name' => $order['name'],
        ];

        // User
        Mail::send('mail.orderUser', ['user' => $user, 'order' => $order], function ($message) use ($user, $order) {
            $message->from(config('mail.mailers.smtp.username'), 'Extra-Cleaning');
            $message->to($user['email'], $user['name'])->replyTo('extracleaningspzoo@gmail.com', 'Extra-Cleaning')->subject('Order cleaning #'.$order['id']);
        });

        // Admin
        foreach (User::role('admin')->get() as $user)
        {
            Mail::send('mail.order', ['user' => $user, 'order' => $order], function ($message) use ($user, $order) {
                $message->from(config('mail.mailers.smtp.username'), 'Extra-Cleaning');
                $message->to($user['email'], $user['name'])->replyTo('extracleaningspzoo@gmail.com', 'Extra-Cleaning')->subject('Order cleaning #'.$order['id']);
            });
        }
    }
}
