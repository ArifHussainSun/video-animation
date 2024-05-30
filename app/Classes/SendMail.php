<?php
namespace App\Classes;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailTemplate;
use App\Jobs\MailTemplateJob;
use App\Models\User;
use \PDF as PDF;
use Illuminate\Support\Facades\Blade;


class SendMail
{
    public $brandSetting;
    public $invoice;
    public $user;
    public $type;
    public $templateName;
    public $template;
    public $pdf;

    function __construct($brandSetting, User $user, $templateName)
    {
        $this->brandSetting = $brandSetting;
        $this->user = $user;
        $this->templateName = $templateName;
        $this->invoiceTemplate();
    }

    function getUser() {
        return $this->user->email;
    }

    function invoiceTemplate() {
        $sendmail = EmailTemplate::where('name',"{$this->templateName}");

        if($sendmail->exists()) {
            $this->template = $sendmail->first();
            $setSMTP = new SmtpConfig('billing', $this->template->from);
            
        } else {
            throw new \ErrorException("Email template doesn't exists.");
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
        $data = Blade::render($this->template->content, $this->brandSetting);
        $mailInvoice = Mail::to($this->user->email);

        if(!empty($this->template->cc)) {
            $mailInvoice->cc($this->template->cc);
        }

        if(!empty($this->template->bcc)) {
            $mailInvoice->bcc($this->template->bcc);
        }

        $mailInvoice->send(new MailTemplate($this->pdf, $data, $this->template->subject));

        MailTemplateJob::dispatch($this->brandSetting);
    }



}
