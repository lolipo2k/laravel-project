<?php

namespace App\Jobs;

use App\Models\Office;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class SendOffice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $office;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Office $office)
    {
        $this->office = $office;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $office = $this->office;

        $user = [
            'email' => $office['email'],
            'name' => $office['name'],
        ];

        // User
        Mail::send('mail.orderOffice', ['user' => $user, 'office' => $office], function ($message) use ($user, $office) {
            $message->from(config('mail.mailers.smtp.username'), 'Extra-Cleaning');
            $message->to($user['email'], $user['name'])->replyTo('extracleaningspzoo@gmail.com', 'Extra-Cleaning')->subject('Office cleaning #'.$office['id']);
        });

        foreach (User::role('admin')->get() as $user)
        {
            Mail::send('mail.office', ['user' => $user, 'office' => $office], function ($message) use ($user, $office) {
                $message->from(config('mail.mailers.smtp.username'), 'Extra-Cleaning');
                $message->to($user['email'], $user['name'])->replyTo('extracleaningspzoo@gmail.com', 'Extra-Cleaning')->subject('Office cleaning #'.$office['id']);
            });
        }
    }
}
