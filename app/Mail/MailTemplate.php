<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Blade;
use \PDF;


class MailTemplate extends Mailable
{
    use Queueable, SerializesModels;

    public $pdf;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdf, $data, $subject)
    {
        $this->pdf = $pdf;
        $this->data = $data;
        $this->subject = $subject;
    }

    public function build()
    {


        // return $this->from(env('MAIL_FROM_ADDRESS'))
        return $this->view('admin.emailtemplate.invoice', ["data"=>$this->data])
        ->subject($this->subject)
        ->attachData($this->pdf->output(), 'invoice.pdf');

        // return $this->from(env('MAIL_FROM_ADDRESS'))
        // ->view('admin.emailtemplate.invoice', ["data"=>$this->data]);

    }


}
