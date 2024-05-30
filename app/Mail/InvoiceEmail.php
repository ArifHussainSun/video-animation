<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\BrandSettings;

class InvoiceEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $logo = BrandSettings::where("key_name", '=', "logo")->get()->first();
        $company_name = BrandSettings::where("key_name", '=', "company_name")->get()->first();
        $company_email = BrandSettings::where("key_name", '=', "company_email")->get()->first();
        $company_number = BrandSettings::where("key_name", '=', "company_number")->get()->first();

        $brand_settings = array(
            "logo" => $logo->key_value,
            "company_name" => $company_name->key_value,
            //"company_email" => $company_email->key_value,
            //"company_number" => $company_number->key_value,
        );


        $subject = "Payment Invoice | ".@$brand_settings["company_name"];

        return $this->from('', 'Testing')
                ->subject($subject)
                ->view('frontend.payments.invoice')->with([
                    "brand_settings" => $brand_settings, 
                    'invoice'=> $this->invoice
                ]);
    }
}
