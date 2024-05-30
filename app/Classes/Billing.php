<?php
namespace App\Classes;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailTemplate;
use App\Jobs\MailTemplateJob;
use \PDF as PDF;
use Illuminate\Support\Facades\Blade;

class Billing
{
    public $brandSetting;
    public $invoice;
    public $user;
    public $template;
    public $pdf;

    function __construct($brandSetting, User $user)
    {
        $this->brandSetting = $brandSetting;
        $this->user = $user;
        $this->invoiceTemplate();
    }

    function getUser() {
        return $this->user->email;
    }

    function invoiceTemplate() {
        $billings = EmailTemplate::all();
        foreach($billings as $billing)
        {
            if (!empty($billing->name)) {
                $this->template = EmailTemplate::latest()->first();
            } else {
                return "Billing does not exit";
            }
        }
    }

    function render($template) {
      $this->invoice = Blade::render($template->content, $this->brandSetting->toArray());
      return Blade::render('admin.emailtemplate.invoice', [ 'data' => $this->invoice ] );
    }

    function generate() {
        $parseHTML = Blade::render($this->template->content  , $this->brandSetting );
        $downloadPdf = $this->pdf = PDF::loadHtml($parseHTML);
        return $downloadPdf->download('invoice.pdf');



    }

    function mail() {
        $mailInvoice = Mail::to($this->user->email);

        if(!empty($this->template->cc)) {
            $mailInvoice->cc($this->template->cc);
        }

        if(!empty($this->template->bcc)) {
            $mailInvoice->bcc($this->template->bcc);
        }

        $mailInvoice->send(new MailTemplate($this->pdf, $this->template));

        MailTemplateJob::dispatch($this->brandSetting);
    }
}
