<?php

namespace App\Http\Controllers;

use App\Classes\SendMail;
use App\Models\BrandSettings;
use App\Models\Categories;
use App\Models\CountryCurrencies;
use App\Models\Invoice;
use App\Models\Payments;
use App\Models\User;
use App\Traits\ApplicationTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    use ApplicationTrait;

    public static function create($payment_id=1, $email_send="")
    {
        $payment_details = Payments::find($payment_id);
        $now = Carbon::now();
        $invoice_date = $now->year.$now->month.$now->day;
        $last_inv = Invoice::latest('id')->first(); 
         
        if(!empty($last_inv)){ 
            $invoice_no_str = explode("-", $last_inv->invoice_no);
            $last_id = $invoice_no_str[2];
            $invoice_no = "INV-".$invoice_date."-".($last_id+1);
        } else {
            $invoice_no = "INV-".$invoice_date."-".($last_inv+1+1000);
        }
        
        $invoice = new Invoice();
        $invoice->invoice_no = $invoice_no;
        $invoice->customer_id = (!empty($payment_details->customer_id)) ? ($payment_details->customer_id) : (1);
        $invoice->payment_id = $payment_id;
        $invoice->email_sent = $email_send;
        $invoice->status = 1;
        $invoice->save();

        $invoice_id = $invoice->id;
        $invoice_details =  Invoice::find($invoice_id);
    
        if(!empty($invoice_details->email_sent)) {
            (new InvoiceController)->email_sent($invoice_details->customer_id);
        }

    }

    public static function email_sent($user_id) {
        $customer = User::find($user_id);
        $brandSettings = (new InvoiceController)->get_setting()->toArray();
        $user_invoice = Invoice::where('customer_id',$user_id)->latest('id')->first()->toArray();
        $customer_info = User::find($user_invoice['customer_id'])->toArray();
        $payment_info = Payments::find($user_invoice['payment_id'])->toArray();
        $category_info = Categories::find($payment_info['category_id'])->toArray();
        $currency_info = CountryCurrencies::find($payment_info['currency'])->toArray();
        $createdAt = Carbon::parse($user_invoice['created_at']);
        $invoice_date = array('invoice_date' => $createdAt->format('d M Y') );
        $invoice_info = array_merge($brandSettings, $user_invoice, $customer_info, $payment_info, $category_info, $invoice_date, $currency_info);

        if($customer) {
            $sendMail = new SendMail($invoice_info, $customer, "Billing");
            $sendMail->generate();
            $sendMail->mail();
            
            return true;
        } else {
            return false;
        }
    }
}
