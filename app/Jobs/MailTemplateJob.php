<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\EmailTemplate;
use App\Notifications\QuickNotify;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailTemplate;
use Barryvdh\DomPDF\Facade\PDF as PDF;
use App\Traits\ApplicationTrait;


class MailTemplateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels , ApplicationTrait;

    protected $details;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        // $email = new MailTemplate($this->details["data"], $this->details["data"]);
        //Mail::to($this->details['email'])->send($email);
    }
}
