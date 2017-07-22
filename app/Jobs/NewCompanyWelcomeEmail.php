<?php

namespace App\Jobs;

use Mail;
use Log;
use Illuminate\Bus\Queueable;
use App\Mail\NewCompanyRegistered;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class NewCompanyWelcomeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $company;

    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $company)
    {
        $this->$user = $user;
        $this->$company = $company;
         Log::info($user);
        Log::info($company);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info($this->user);
        Log::info($this->company);
        $email = new NewCompanyRegistered($this->user, $this->company);
        Mail::to($this->user->email)->send($email);
    }
}
