<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendVacancies implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $vacancy;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->vacancy = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $vacancy = $this->vacancy;
        foreach (User::role('admin')->get() as $user)
        {
            Mail::send('mail.vacancy', ['user' => $user, 'vacancy' => $vacancy], function ($message) use ($user, $vacancy) {
                $message->from(config('mail.mailers.smtp.username'), 'Extra-Cleaning');
                $message->to($user['email'], $user['name'])->replyTo('extracleaningspzoo@gmail.com', 'Extra-Cleaning')->subject('Vacancies #'.$vacancy['id']);
            });
        }
    }
}
