<?php

namespace App\Http\Controllers;

use App\Models\BrandSettings;
use App\Models\CountryCurrencies;
use App\Models\Payments;
use App\Models\PaymentLink;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Traits\ReporthelperTrait;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Support\Str;


class DashboardController extends Controller
{
    use ReporthelperTrait;
    public $numberOfDays, $currentDay, $currentMonth, $currentYear;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        return view('admin.index');
    }

    public function getPayments($month = "")
    {
        $this->currentDateFunction();

        $startDate = $this->currentYear . "-" . $this->currentMonth . "-01";
        $endDate = $this->currentYear . "-" . $this->currentMonth . "-" . $this->numberOfDays;

        //echo $this->currentYear;

        Payments::where("status", "=", 1)
            ->where("payment_on", ">", $startDate)
            ->where("payment_on", "<", $endDate)
            ->get();
    }

    // public function filter_chart(Request $request) {
    //     if($request->filterRequest) {
    //         if($request->filterRequest == 'month') {
    //             return $this->Reporthelper_api();
    //         } else {
    //             return $this->Reporthelperyearly_api();
    //         }
    //     }
    // }


    public function Payments_category()
    {
        return $this->Payments_category_api();
    }

    public function monthly_payments(Request $request)
    {
        if($request->salespersonid != ''){
            if($request->from_date != '' && $request->to_date != '') {
                $from = Carbon::parse($request->from_date)->toDateString()." 00:00:00";
                $to = Carbon::parse($request->to_date)->toDateString()." 23:59:59";
                $total = PaymentLink::select(DB::raw("sum(payment_links.price) as total_payments"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
                ->whereBetween('payment_links.created_at',[$from, $to])
                ->groupBy("payment_links.price")->get();
                $total_payments_price = $total->sum('total_payments');
            }
            else if($request->month != ''){
                $total = PaymentLink::select(DB::raw("sum(payment_links.price) as total_payments"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
                ->whereMonth('payment_links.created_at', Carbon::now()->month)
                ->whereYear('payment_links.created_at', now()->year)
                ->groupBy("payment_links.price")->get();
                $total_payments_price = $total->sum('total_payments');
            }
            else if($request->week != ''){
                $total = PaymentLink::select(DB::raw("sum(payment_links.price) as total_payments"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
                ->whereBetween('payment_links.created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->groupBy("payment_links.price")->get();
                $total_payments_price = $total->sum('total_payments');
            }
            else {
                $total = PaymentLink::select(DB::raw("sum(payment_links.price) as total_payments"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
                ->whereMonth('payment_links.created_at', Carbon::now()->month)
                ->whereYear('payment_links.created_at', now()->year)
                ->groupBy("payment_links.price")->get();
                $total_payments_price = $total->sum('total_payments');
            }
        }
        else{
            if($request->from_date != '' && $request->to_date != '') {
                $from = Carbon::parse($request->from_date)->toDateString()." 00:00:00";
                $to = Carbon::parse($request->to_date)->toDateString()." 23:59:59";
                $total = PaymentLink::select(DB::raw("sum(payment_links.price) as total_payments"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where('payments.status', 1)
                ->whereBetween('payment_links.created_at',[$from, $to])
                ->groupBy("payment_links.price")->get();
                $total_payments_price = $total->sum('total_payments');
            }
            else if($request->month != ''){
                $total = PaymentLink::select(DB::raw("sum(payment_links.price) as total_payments"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where('payments.status', 1)
                ->whereMonth('payment_links.created_at', Carbon::now()->month)
                ->whereYear('payment_links.created_at', now()->year)
                ->groupBy("payment_links.price")->get();
                $total_payments_price = $total->sum('total_payments');
            }
            else if($request->week != ''){
                $total = PaymentLink::select(DB::raw("sum(payment_links.price) as total_payments"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where('payments.status', 1)
                ->whereBetween('payment_links.created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->groupBy("payment_links.price")->get();
                $total_payments_price = $total->sum('total_payments');
            }
            else {
                $total = PaymentLink::select(DB::raw("sum(payment_links.price) as total_payments"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where('payments.status', 1)
                ->whereMonth('payment_links.created_at', Carbon::now()->month)
                ->whereYear('payment_links.created_at', now()->year)
                ->groupBy("payment_links.price")->get();
                $total_payments_price = $total->sum('total_payments');
            }
        }
        $defaultCurrency = BrandSettings::where('key_name', 'like', '%default_currency%')->first();
        $currencysymbol=CountryCurrencies::where('aplha_code2',$defaultCurrency->key_value)->first();
        return response()->json($currencysymbol->currency_symbol.$total_payments_price);
    }

    public function orders(Request $request)
    {
        if($request->salespersonid != ''){
            if($request->from_date != '' && $request->to_date != '') {
                $from = Carbon::parse($request->from_date)->toDateString()." 00:00:00";
                $to = Carbon::parse($request->to_date)->toDateString()." 23:59:59";
                $total_orders = PaymentLink::select(DB::raw("COUNT('payment_links.id') as orders"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
                ->whereBetween('payment_links.created_at',[$from, $to])
                ->orderBy('payment_links.id', 'ASC')->groupBy("payment_links.id")->get();
                 $orders = $total_orders->sum('orders');
            }
            else if($request->month != ''){
                $total_orders = PaymentLink::select(DB::raw("COUNT('payment_links.id') as orders"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
                ->whereMonth('payment_links.created_at', Carbon::now()->month)
                ->whereYear('payment_links.created_at', now()->year)
                ->orderBy('payment_links.id', 'ASC')->groupBy("payment_links.id")->get();
                 $orders = $total_orders->sum('orders');
            }
            else if($request->week != ''){
                $total_orders = PaymentLink::select(DB::raw("COUNT('payment_links.id') as orders"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
                ->whereBetween('payment_links.created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->orderBy('payment_links.id', 'ASC')->groupBy("payment_links.id")->get();
                 $orders = $total_orders->sum('orders');
            }
            else {
                $total_orders = PaymentLink::select(DB::raw("COUNT('payment_links.id') as orders"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
                ->orderBy('payment_links.id', 'ASC')->groupBy("payment_links.id")->get();
                $orders = $total_orders->sum('orders');
    
            }
        }
        else{
            if($request->from_date != '' && $request->to_date != '') {
                $from = Carbon::parse($request->from_date)->toDateString()." 00:00:00";
                $to = Carbon::parse($request->to_date)->toDateString()." 23:59:59";
                $total_orders = PaymentLink::select(DB::raw("COUNT('payment_links.id') as orders"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where('payments.status', 1)
                ->whereBetween('payment_links.created_at',[$from, $to])
                ->orderBy('payment_links.id', 'ASC')->groupBy("payment_links.id")->get();
                 $orders = $total_orders->sum('orders');
            }
            else if($request->month != ''){
                $total_orders = PaymentLink::select(DB::raw("COUNT('id') as orders"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where('payments.status', 1)
                ->whereMonth('payment_links.created_at', Carbon::now()->month)
                ->whereYear('payment_links.created_at', now()->year)
                ->orderBy('payment_links.id', 'ASC')->groupBy("payment_links.id")->get();
                 $orders = $total_orders->sum('orders');
            }
            else if($request->week != ''){
                $total_orders = PaymentLink::select(DB::raw("COUNT('id') as orders"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where('payments.status', 1)
                ->whereBetween('payment_links.created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->orderBy('payment_links.id', 'ASC')->groupBy("payment_links.id")->get();
                 $orders = $total_orders->sum('orders');
            }
            else {
                $total_orders = PaymentLink::select(DB::raw("COUNT('payment_links.id') as orders"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where('payments.status', 1)
                ->orderBy('payment_links.id', 'ASC')->groupBy("payment_links.id")->get();
                $orders = $total_orders->sum('orders');
    
            }
        }
        

        return response()->json($orders);


    }
    public function latest_transaction(Request $request)
    {
        if ($request->ajax()) {
            if($request->salespersonid != ''){
                if($request->from_date != '' && $request->to_date != '') {
                    $from = Carbon::parse($request->from_date)->toDateString()." 00:00:00";
                    $to = Carbon::parse($request->to_date)->toDateString()." 23:59:59";
                    $latest_transaction = PaymentLink::Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                    ->where('payment_links.created_by',$request->salespersonid)
                    ->whereYear('payment_links.created_at', now()->year)
                    ->whereBetween('payment_links.created_at',[$from, $to])
                    ->orderBy('payment_links.id', 'DESC')
                    ->take(5)
                    ->get();
                }
                else if($request->month != ''){
                    $latest_transaction = PaymentLink::Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                    ->where('payment_links.created_by',$request->salespersonid)
                    ->whereMonth('payment_links.created_at', Carbon::now()->month)
                    ->whereYear('payment_links.created_at', now()->year)
                    ->orderBy('payment_links.id', 'DESC')
                    ->take(5)
                    ->get();
                }
                else if($request->week != ''){
                    $latest_transaction = PaymentLink::Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                    ->where('payment_links.created_by',$request->salespersonid)
                    ->whereYear('payment_links.created_at', now()->year)
                    ->whereBetween('payment_links.created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->orderBy('payment_links.id', 'DESC')
                    ->take(5)
                    ->get();
                }
                else {
                    $latest_transaction = PaymentLink::Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                    ->where('payment_links.created_by',$request->salespersonid)
                    ->whereYear('payment_links.created_at', now()->year)
                    ->orderBy('payment_links.id', 'DESC')
                    ->take(5)
                    ->get();
                }
            }
            else{
                if($request->from_date != '' && $request->to_date != '') {
                    $from = Carbon::parse($request->from_date)->toDateString()." 00:00:00";
                    $to = Carbon::parse($request->to_date)->toDateString()." 23:59:59";
                    $latest_transaction = PaymentLink::Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                    // ->where('payments.status', 1)
                    ->whereYear('payment_links.created_at', now()->year)
                    ->whereBetween('payment_links.created_at',[$from, $to])
                    ->orderBy('payment_links.id', 'DESC')
                    ->take(5)
                    ->get();
                }
                else if($request->month != ''){
                    $latest_transaction = PaymentLink::Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                    // ->where('payments.status', 1)
                    ->whereMonth('payment_links.created_at', Carbon::now()->month)
                    ->whereYear('payment_links.created_at', now()->year)
                    ->orderBy('payment_links.id', 'DESC')
                    ->take(5)
                    ->get();
                }
                else if($request->week != ''){
                    $latest_transaction = PaymentLink::Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                    // ->where('payments.status', 1)
                    ->whereYear('payment_links.created_at', now()->year)
                    ->whereBetween('payment_links.created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->orderBy('payment_links.id', 'DESC')
                    ->take(5)
                    ->get();
                }
                else {
                    $latest_transaction = PaymentLink::Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                    // ->where('payments.status', 1)
                    ->whereYear('payment_links.created_at', now()->year)
                    ->orderBy('payment_links.id', 'DESC')
                    ->take(5)
                    ->get();
                }

            }
               
            return Datatables::of($latest_transaction)
            ->addIndexColumn()
            ->addColumn('created_at', function ($row) {
                return date('d-M-Y', strtotime($row->created_at)).'<br /> <label class="text-primary">'.Carbon::parse($row->created_at)->diffForHumans().'</label>';
            })
            ->addColumn('payment_gateway', function ($row) {
                $gateway_name = str_replace("payment_gateway_", "", $row->payment_gateway);
                $gateway_name = str_replace("_", " ", $gateway_name);
                $gateway_name = Str::upper($gateway_name);
                return $gateway_name;
            })
            ->addColumn('price', function ($row) {
                // $currency = CountryCurrencies::find($row->currency);
                $defaultCurrency = BrandSettings::where('key_name', 'like', '%default_currency%')->first();
                $currencysymbol=CountryCurrencies::where('aplha_code2',$defaultCurrency->key_value)->first();
                $html = '<span class="badge badge-pill badge-soft-success font-size-13">' . $currencysymbol->currency_symbol . " " . $row->price . '</span>';
                return  $html;
            })
            
            ->addColumn('status', function($row){
                if ($row->status == 1) {
                    $status = '<span class="bg-success badge me-2" >Paid</span>';
                }else {
                    $status = '<span class="bg-danger badge me-2">Declined</span>';
                }
                return $status;
        })->rawColumns(['price','status','created_at'])->make(true);
        }
    }

    public function average_price(Request $request)
    {
        if($request->salespersonid != ''){
            if($request->from_date != '' && $request->to_date != '') {
                $from = Carbon::parse($request->from_date)->toDateString()." 00:00:00";
                $to = Carbon::parse($request->to_date)->toDateString()." 23:59:59";
                $total = PaymentLink::select(DB::raw("avg(payment_links.price) as average_sale"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
                ->whereBetween('payment_links.created_at',[$from, $to])
                ->groupBy("payment_links.price")->get();
                $average_total = $total->avg('average_sale');
                $average_price =  number_format($average_total,3);
            }
            else if($request->month != ''){
                $total = PaymentLink::select(DB::raw("avg(payment_links.price) as average_sale"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
                ->whereMonth('payment_links.created_at', Carbon::now()->month)
                ->whereYear('payment_links.created_at', now()->year)
                ->groupBy("payment_links.price")->get();
                $average_total = $total->avg('average_sale');
                $average_price =  number_format($average_total,3);
            }
            else if($request->week != ''){
                $total = PaymentLink::select(DB::raw("avg(payment_links.price) as average_sale"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
                ->whereBetween('payment_links.created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->groupBy("payment_links.price")->get();
                $average_total = $total->avg('average_sale');
                $average_price =  number_format($average_total,3);
            }
            else {
                $total = PaymentLink::select(DB::raw("avg(payment_links.price) as average_sale"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
                ->groupBy("payment_links.price")->get();
                $average_total = $total->avg('average_sale');
                $average_price =  number_format($average_total,3);
            }
        }
        else{
            if($request->from_date != '' && $request->to_date != '') {
                $from = Carbon::parse($request->from_date)->toDateString()." 00:00:00";
                $to = Carbon::parse($request->to_date)->toDateString()." 23:59:59";
                $total = PaymentLink::select(DB::raw("avg(payment_links.price) as average_sale"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where('payments.status', 1)
                ->whereBetween('payment_links.created_at',[$from, $to])
                ->groupBy("payment_links.price")->get();
                $average_total = $total->avg('average_sale');
                $average_price =  number_format($average_total,3);
            }
            else if($request->month != ''){
                $total = PaymentLink::select(DB::raw("avg(payment_links.price) as average_sale"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where('payments.status', 1)
                ->whereMonth('payment_links.created_at', Carbon::now()->month)
                ->whereYear('payment_links.created_at', now()->year)
                ->groupBy("payment_links.price")->get();
                $average_total = $total->avg('average_sale');
                $average_price =  number_format($average_total,3);
            }
            else if($request->week != ''){
                $total = PaymentLink::select(DB::raw("avg(payment_links.price) as average_sale"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where('payments.status', 1)
                ->whereBetween('payment_links.created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->groupBy("payment_links.price")->get();
                $average_total = $total->avg('average_sale');
                $average_price =  number_format($average_total,3);
            }
            else {
                $total = PaymentLink::select(DB::raw("avg(payment_links.price) as average_sale"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where('payments.status', 1)
                ->groupBy("payment_links.price")->get();
                $average_total = $total->avg('average_sale');
                $average_price =  number_format($average_total,3);
            }
        }
        $defaultCurrency = BrandSettings::where('key_name', 'like', '%default_currency%')->first();
        $currencysymbol=CountryCurrencies::where('aplha_code2',$defaultCurrency->key_value)->first();
        return response()->json($currencysymbol->currency_symbol.$average_price);
    }

    public function revenue(Request $request)
    {
        if($request->salespersonid != ''){
            if($request->from_date != '' && $request->to_date != '') {
                $from = Carbon::parse($request->from_date)->toDateString()." 00:00:00";
                $to = Carbon::parse($request->to_date)->toDateString()." 23:59:59";
                $revenue = PaymentLink::select(DB::raw("sum(payment_links.price) as total_revenue"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
                ->whereBetween('payment_links.created_at',[$from, $to])
                ->groupBy("payment_links.price")->get();
                $total_revenue = $revenue->sum('total_revenue');
            }
            else if($request->month != ''){
                $revenue = PaymentLink::select(DB::raw("sum(payment_links.price) as total_revenue"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
                ->whereMonth('payment_links.created_at', Carbon::now()->month)
                ->whereYear('payment_links.created_at', now()->year)
                ->groupBy("payment_links.price")->get();
                $total_revenue = $revenue->sum('total_revenue');
            }
            else if($request->week != ''){
                $revenue = PaymentLink::select(DB::raw("sum(payment_links.price) as total_revenue"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
                ->whereBetween('payment_links.created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->groupBy("payment_links.price")->get();
                $total_revenue = $revenue->sum('total_revenue');
            }
            else{
                $revenue = PaymentLink::select(DB::raw("sum(payment_links.price) as total_revenue"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
                ->groupBy("payment_links.price")->get();
                $total_revenue = $revenue->sum('total_revenue');
            }
        }
        else{
            if($request->from_date != '' && $request->to_date != '') {
                $from = Carbon::parse($request->from_date)->toDateString()." 00:00:00";
                $to = Carbon::parse($request->to_date)->toDateString()." 23:59:59";
                $revenue = PaymentLink::select(DB::raw("sum(payment_links.price) as total_revenue"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where('payments.status', 1)
                ->whereBetween('payment_links.created_at',[$from, $to])
                ->groupBy("payment_links.price")->get();
                $total_revenue = $revenue->sum('total_revenue');
            }
            else if($request->month != ''){
                $revenue = PaymentLink::select(DB::raw("sum(payment_links.price) as total_revenue"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where('payments.status', 1)
                ->whereMonth('payment_links.created_at', Carbon::now()->month)
                ->whereYear('payment_links.created_at', now()->year)
                ->groupBy("payment_links.price")->get();
                $total_revenue = $revenue->sum('total_revenue');
            }
            else if($request->week != ''){
                $revenue = PaymentLink::select(DB::raw("sum(payment_links.price) as total_revenue"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where('payments.status', 1)
                ->whereBetween('payment_links.created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->groupBy("payment_links.price")->get();
                $total_revenue = $revenue->sum('total_revenue');
            }
            else{
                $revenue = PaymentLink::select(DB::raw("sum(payment_links.price) as total_revenue"))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where('payments.status', 1)
                ->groupBy("payment_links.price")->get();
                $total_revenue = $revenue->sum('total_revenue');
            }

        }
        $defaultCurrency = BrandSettings::where('key_name', 'like', '%default_currency%')->first();
        $currencysymbol=CountryCurrencies::where('aplha_code2',$defaultCurrency->key_value)->first();

        return response()->json($currencysymbol->currency_symbol.$total_revenue);
    }

    public function dateRange_DonutCharts(Request $request)
    {
        // donut charts
        if($request->from_date != '' && $request->to_date != '') {
            $from = Carbon::parse($request->from_date)->toDateString()." 00:00:00";
            $to = Carbon::parse($request->to_date)->toDateString()." 23:59:59";
            $daterange_Filterdata = DB::table('payments as p')
            ->Join('categories as c',DB::raw( 'p.category_id'),'=',DB::raw('c.id'))
            ->select(DB::raw('p.category_id'),DB::raw('c.name'), DB::raw("COUNT('p.category_id') as total_category"))
            ->whereBetween('p.created_at',[$from, $to])
            ->groupBy('p.category_id','c.name')
            ->orderBy('p.category_id', 'ASC')
            ->get();

        }
        else if($request->month != ''){
            $daterange_Filterdata = DB::table('payments as p')
            ->Join('categories as c',DB::raw( 'p.category_id'),'=',DB::raw('c.id'))
            ->select(DB::raw('p.category_id'),DB::raw('c.name'), DB::raw("COUNT('p.category_id') as total_category"))
            ->whereBetween('p.created_at', [Carbon::now()->month])
            ->groupBy('p.category_id','c.name')
            ->orderBy('p.category_id', 'ASC')
            ->get();
        }
        else if($request->week != ''){
            $daterange_Filterdata = DB::table('payments as p')
            ->Join('categories as c',DB::raw( 'p.category_id'),'=',DB::raw('c.id'))
            ->select(DB::raw('p.category_id'),DB::raw('c.name'), DB::raw("COUNT('p.category_id') as total_category"))
            ->whereBetween('p.created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->groupBy('p.category_id','c.name')
            ->orderBy('p.category_id', 'ASC')
            ->get();
        }
        else {
            $daterange_Filterdata = DB::table('payments as p')
            ->Join('categories as c',DB::raw( 'p.category_id'),'=',DB::raw('c.id'))
            ->select(DB::raw( 'p.category_id'),DB::raw('c.name'), DB::raw("COUNT('p.category_id') as total_category"))
            ->groupBy('p.category_id','c.name')
            ->orderBy('p.category_id', 'ASC')
            ->get();

        }
        return response()->json($daterange_Filterdata);

    }

    public function dateRange_LineCharts(Request $request)
    {
        // line charts
        if($request->filterRequest) {
            if($request->filterRequest == 'month') {
                if($request->from_date != '' && $request->to_date != '') {
                    $from = Carbon::parse($request->from_date)->toDateString()." 00:00:00";
                    $to = Carbon::parse($request->to_date)->toDateString()." 23:59:59";
                    $data = PaymentLink::whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', date('Y'))
                    // ->whereBetween('created_at',[$from, $to])
                    ->orderBy('created_at', 'ASC')
                    ->get(['created_at'])
                    ->groupBy(function($days) {
                        return  Carbon::parse($days->created_at)->format('d');
                    });


                    $paymentlinkdatewise = [];
                    $paymentlinkArr = [];
                    $paymentmonthwise = [];
                    $paymentArr= [];
                    foreach ($data as $key => $value) {
                        $paymentlinkdatewise[(int)$key] = count($value);
                    }

                    for($i = 1; $i <= Carbon::now()->month()->daysInMonth; $i++){
                        if(!empty($paymentlinkdatewise[$i])){
                            $paymentlinkArr[$i] = $paymentlinkdatewise[$i];
                        }else{
                            $paymentlinkArr[$i] = 0;
                        }
                    }

                    $paymentlinkyearly = PaymentLink::select(DB::raw("(COUNT(created_at)) as payments , (MONTHNAME(created_at)) as month , (YEAR(created_at)) as year"))
                    ->whereYear('created_at', now()->year)
                    ->whereBetween('created_at',[$from, $to])
                    ->orderBy('created_at', 'ASC')
                    ->groupBy('month','year')
                    ->get(['created_at']);
                }
                else {
                    $data = PaymentLink::whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', date('Y'))
                    ->orderBy('created_at', 'ASC')
                    ->get(['created_at'])
                    ->groupBy(function($days) {
                        return  Carbon::parse($days->created_at)->format('d');
                    });


                    $paymentlinkdatewise = [];
                    $paymentlinkArr = [];
                    $paymentmonthwise = [];
                    $paymentArr= [];
                    foreach ($data as $key => $value) {
                        $paymentlinkdatewise[(int)$key] = count($value);
                    }

                    for($i = 1; $i <= Carbon::now()->month()->daysInMonth; $i++){
                        if(!empty($paymentlinkdatewise[$i])){
                            $paymentlinkArr[$i] = $paymentlinkdatewise[$i];
                        }else{
                            $paymentlinkArr[$i] = 0;
                        }
                    }

                    $paymentlinkyearly = PaymentLink::select(DB::raw("(COUNT(created_at)) as payments , (MONTHNAME(created_at)) as month , (YEAR(created_at)) as year"))
                    ->whereYear('created_at', now()->year)
                    ->orderBy('created_at', 'ASC')
                    ->groupBy('month','year')
                    ->get(['created_at']);
                }
                return response()->json($paymentlinkArr);
            } else {
                if($request->from_date != '' && $request->to_date != '') {
                    $from = Carbon::parse($request->from_date)->toDateString()." 00:00:00";
                    $to = Carbon::parse($request->to_date)->toDateString()." 23:59:59";
                    $paymentlinkyearly = PaymentLink::select(DB::raw("(COUNT(created_at)) as payments , (MONTHNAME(created_at)) as month , (YEAR(created_at)) as year"))
                    ->whereYear('created_at', now()->year)
                    ->whereBetween('created_at',[$from, $to])
                    ->orderBy('created_at', 'ASC')
                    ->groupBy('month','year')
                    ->get(['created_at']);
                  }
                  else {
                      $paymentlinkyearly = PaymentLink::select(DB::raw("(COUNT(created_at)) as payments , (MONTHNAME(created_at)) as month , (YEAR(created_at)) as year"))
                      ->whereYear('created_at', now()->year)
                      ->orderBy('created_at', 'ASC')
                      ->groupBy('month','year')
                      ->get(['created_at']);
                  }

                  return response()->json($paymentlinkyearly);
            }
        }
    }



    public function currentDateFunction()
    {
        $carbonNow = Carbon::now();

        $this->numberOfDays = $carbonNow->daysInMonth;
        $this->currentDay = $carbonNow->day;
        $this->currentMonth = $carbonNow->month;
        $this->currentYear = $carbonNow->year;
    }

    public function monthEarning($month = "", $year = "", $user = "")
    {
        //$month, $year,
        $this->currentDateFunction();

        $payments = Payments::where("status", 1)
            ->where("payment_on", ">", $this->currentYear . "-" . $this->currentMonth . "-01")
            ->where("payment_on", "<", $this->currentYear . "-" . $this->currentMonth . "-" . $this->numberOfDays)
            ->get();

        $data = array(
            "payments_sum" => $payments->sum('price'),
            "percent_acheived" => number_format(($payments->sum('price') / 10000) * 100, 0)
        );

        return response()->json($data);
    }

    public function total_category_sales(Request $request)
    {
        if($request->salespersonid != ''){
            if($request->from_date != '' && $request->to_date != '') {
                $from = Carbon::parse($request->from_date)->toDateString()." 00:00:00";
                $to = Carbon::parse($request->to_date)->toDateString()." 23:59:59";
                $category_sales = $category_sales = PaymentLink::select(DB::raw( 'payment_links.category_id'),DB::raw('categories.name'),DB::raw('payment_links.currency'), DB::raw("SUM(payment_links.price) as total_sales"))
                ->Join('categories',DB::raw( 'payment_links.category_id'),'=',DB::raw('categories.id'))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
                ->whereBetween('payment_links.created_at',[$from, $to])
                ->groupBy('payment_links.category_id','categories.name','payment_links.currency')
                ->orderBy('payment_links.category_id', 'DESC')
                ->get();
            }
            else if($request->month != ''){

                $category_sales = $category_sales = PaymentLink::select(DB::raw( 'payment_links.category_id'),DB::raw('categories.name'),DB::raw('payment_links.currency'), DB::raw("SUM(payment_links.price) as total_sales"))
                ->Join('categories',DB::raw( 'payment_links.category_id'),'=',DB::raw('categories.id'))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
                ->whereMonth('payment_links.created_at', Carbon::now()->month)
                ->whereYear('payment_links.created_at', now()->year)
                ->groupBy('payment_links.category_id','categories.name','payment_links.currency')
                ->orderBy('payment_links.category_id', 'DESC')
                ->get();
            }
            else if($request->week != ''){
                $category_sales = $category_sales = PaymentLink::select(DB::raw( 'payment_links.category_id'),DB::raw('categories.name'),DB::raw('payment_links.currency'), DB::raw("SUM(payment_links.price) as total_sales"))
                ->Join('categories',DB::raw( 'payment_links.category_id'),'=',DB::raw('categories.id'))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
                ->whereBetween('payment_links.created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->groupBy('payment_links.category_id','categories.name','payment_links.currency')
                ->orderBy('payment_links.category_id', 'DESC')
                ->get();
            }
            else {
                $category_sales = $category_sales = PaymentLink::select(DB::raw( 'payment_links.category_id'),DB::raw('categories.name'),DB::raw('payment_links.currency'), DB::raw("SUM(payment_links.price) as total_sales"))
                ->Join('categories',DB::raw( 'payment_links.category_id'),'=',DB::raw('categories.id'))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
                ->groupBy('payment_links.category_id','categories.name','payment_links.currency')
                ->orderBy('payment_links.category_id', 'DESC')
                ->get();
            }
        }
        else{
            if($request->from_date != '' && $request->to_date != '') {
                $from = Carbon::parse($request->from_date)->toDateString()." 00:00:00";
                $to = Carbon::parse($request->to_date)->toDateString()." 23:59:59";
                $category_sales = PaymentLink::select(DB::raw( 'payment_links.category_id'),DB::raw('categories.name'),DB::raw('payment_links.currency'), DB::raw("SUM(payment_links.price) as total_sales"))
                ->Join('categories',DB::raw( 'payment_links.category_id'),'=',DB::raw('categories.id'))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where('payments.status', 1)
                ->whereBetween('payment_links.created_at',[$from, $to])
                ->groupBy('payment_links.category_id','categories.name','payment_links.currency')
                ->orderBy('payment_links.category_id', 'DESC')
                ->get();
            }
            else if($request->month != ''){

                $category_sales = PaymentLink::select(DB::raw( 'payment_links.category_id'),DB::raw('categories.name'),DB::raw('payment_links.currency'), DB::raw("SUM(payment_links.price) as total_sales"))
                ->Join('categories',DB::raw( 'payment_links.category_id'),'=',DB::raw('categories.id'))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where('payments.status', 1)
                ->whereMonth('payment_links.created_at', Carbon::now()->month)
                ->whereYear('payment_links.created_at', now()->year)
                ->groupBy('payment_links.category_id','categories.name','payment_links.currency')
                ->orderBy('payment_links.category_id', 'DESC')
                ->get();
            }
            else if($request->week != ''){
                $category_sales = PaymentLink::select(DB::raw( 'payment_links.category_id'),DB::raw('categories.name'),DB::raw('payment_links.currency'), DB::raw("SUM(payment_links.price) as total_sales"))
                ->Join('categories',DB::raw( 'payment_links.category_id'),'=',DB::raw('categories.id'))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where('payments.status', 1)
                ->whereBetween('payment_links.created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->groupBy('payment_links.category_id','categories.name','payment_links.currency')
                ->orderBy('payment_links.category_id', 'DESC')
                ->get();
            }
            else {
                $category_sales = PaymentLink::select(DB::raw( 'payment_links.category_id'),DB::raw('categories.name'),DB::raw('payment_links.currency'), DB::raw("SUM(payment_links.price) as total_sales"))
                ->Join('categories',DB::raw( 'payment_links.category_id'),'=',DB::raw('categories.id'))
                ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                ->where('payments.status', 1)             
                ->groupBy('payment_links.category_id','categories.name','payment_links.currency')
                ->orderBy('payment_links.category_id', 'DESC')
                ->get();
            }

        }

              
            return Datatables::of($category_sales)
            ->addColumn('sales', function ($row) {
                // $currency = CountryCurrencies::find($row->currency);
                $defaultCurrency = BrandSettings::where('key_name', 'like', '%default_currency%')->first();
                $currencysymbol=CountryCurrencies::where('aplha_code2',$defaultCurrency->key_value)->first();
                $html = '<span class="badge badge-pill badge-soft-success font-size-13">' . $currencysymbol->currency_symbol . " " . $row->total_sales . '</span>';
                return  $html;
                })
           ->rawColumns(['sales'])
           ->toJson();


    }


    public function dateRange_SalesChart(Request $request)
    {
        $defaultCurrency = BrandSettings::where('key_name', 'like', '%default_currency%')->first();
        $currencysymbol=CountryCurrencies::where('aplha_code2',$defaultCurrency->key_value)->first();

        if($request->salespersonid != ''){
            $totaldays = array();
        $json = array();
        $data = 0;
        $date = CarbonImmutable::now();

          if($request->from_date != '' && $request->to_date != '') {
            $from = Carbon::parse($request->from_date)->toDateString()." 00:00:00";
            $to = Carbon::parse($request->to_date)->toDateString()." 23:59:59";
            $period = CarbonPeriod::create($from, $to);
            foreach ($period as $day) {
                $totaldays[] = array('date' => $day->format('Y-m-d'), $data );

            }

            $paymentlinkyearly = PaymentLink::select(DB::raw("(SUM(payment_links.price)) as total_sales"), DB::raw("(COUNT(payment_links.id)) as total_orders , Date(payment_links.created_at) as date , WEEK(payment_links.created_at) as week"))
                    ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                    ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
                    ->whereBetween('payment_links.created_at',[$from, $to])
                    ->groupBy('date','week')
                    ->get();
          }
          else if($request->month != ''){
            $from =  Carbon::now()->startOfMonth();
            $to = Carbon::now()->endOfMonth();
            $period = CarbonPeriod::create($from, $to);
            foreach ($period as $day) {
                $totaldays[] = array('date' => $day->format('Y-m-d'), $data );

            }

            $paymentlinkyearly = PaymentLink::select(DB::raw("(SUM(payment_links.price)) as total_sales"), DB::raw("(COUNT(payment_links.id)) as total_orders , Date(payment_links.created_at) as date , WEEK(payment_links.created_at) as week"))
                    ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                    ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
                    ->whereBetween('payment_links.created_at',[$from, $to])
                    ->groupBy('date','week')
                    ->get();
          }
          else if($request->week != ''){
            foreach ($date->startOfWeek()->daysUntil($date->endOfWeek()) as $day) {
                $totaldays[] = array('date' => $day->format('Y-m-d'), $data );
              }

              $paymentlinkyearly = PaymentLink::select(DB::raw("(SUM(payment_links.price)) as total_sales"), DB::raw("(COUNT(payment_links.id)) as total_orders , Date(payment_links.created_at) as date , WEEK(payment_links.created_at) as week"))
                    ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                    ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
                    ->whereBetween('payment_links.created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->groupBy('date','week')
                    ->get();
          }
          else{

            foreach ($date->startOfWeek()->daysUntil($date->endOfWeek()) as $day) {
                $totaldays[] = array('date' => $day->format('Y-m-d'), $data );
              }

              $paymentlinkyearly = PaymentLink::select(DB::raw("(SUM(payment_links.price)) as total_sales"), DB::raw("(COUNT(payment_links.id)) as total_orders , Date(payment_links.created_at) as date , WEEK(payment_links.created_at) as week"))
                    ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                    ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
                    ->whereBetween('payment_links.created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->groupBy('date','week')
                    ->get();
          }

               for ($i=0; $i < count($paymentlinkyearly); $i++) {

                   $keyVal = array('total_sales'=> $paymentlinkyearly[$i]->total_sales, 'total_orders'=> $paymentlinkyearly[$i]->total_orders );
                   $json[] =  array("date"=>$paymentlinkyearly[$i]->date, $keyVal );
               }

              $date_check = $this->date_rangecheck($json,$totaldays);
              $data_new =array_merge($json,$date_check);
              asort($data_new);
              $data_new = array_values($data_new);
        }
        else{
        $totaldays = array();
        $json = array();
        $data = 0;
        $date = CarbonImmutable::now();

          if($request->from_date != '' && $request->to_date != '') {
            $from = Carbon::parse($request->from_date)->toDateString()." 00:00:00";
            $to = Carbon::parse($request->to_date)->toDateString()." 23:59:59";
            $period = CarbonPeriod::create($from, $to);
            foreach ($period as $day) {
                $totaldays[] = array('date' => $day->format('Y-m-d'), $data );

            }

            $paymentlinkyearly = PaymentLink::select(DB::raw("(SUM(payment_links.price)) as total_sales"), DB::raw("(COUNT(payment_links.id)) as total_orders , Date(payment_links.created_at) as date , WEEK(payment_links.created_at) as week"))
                    ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                    ->where('payments.status', 1)
                    ->whereBetween('payment_links.created_at',[$from, $to])
                    ->groupBy('date','week')
                    ->get();
          }
          else if($request->month != ''){
            $from =  Carbon::now()->startOfMonth();
            $to = Carbon::now()->endOfMonth();
            $period = CarbonPeriod::create($from, $to);
            foreach ($period as $day) {
                $totaldays[] = array('date' => $day->format('Y-m-d'), $data );

            }

            $paymentlinkyearly = PaymentLink::select(DB::raw("(SUM(payment_links.price)) as total_sales"), DB::raw("(COUNT(payment_links.id)) as total_orders , Date(payment_links.created_at) as date , WEEK(payment_links.created_at) as week"))
                    ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                    ->where('payments.status', 1)
                    ->whereBetween('payment_links.created_at',[$from, $to])
                    ->groupBy('date','week')
                    ->get();
          }
          else if($request->week != ''){
            foreach ($date->startOfWeek()->daysUntil($date->endOfWeek()) as $day) {
                $totaldays[] = array('date' => $day->format('Y-m-d'), $data );
              }

              $paymentlinkyearly = PaymentLink::select(DB::raw("(SUM(payment_links.price)) as total_sales"), DB::raw("(COUNT(payment_links.id)) as total_orders , Date(payment_links.created_at) as date , WEEK(payment_links.created_at) as week"))
                    ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                    ->where('payments.status', 1)
                    ->whereBetween('payment_links.created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->groupBy('date','week')
                    ->get();
          }
          else{

            foreach ($date->startOfWeek()->daysUntil($date->endOfWeek()) as $day) {
                $totaldays[] = array('date' => $day->format('Y-m-d'), $data );
              }
             
            $paymentlinkyearly = PaymentLink::select(DB::raw("(SUM(payment_links.price)) as total_sales"), DB::raw("(COUNT(payment_links.id)) as total_orders , Date(payment_links.created_at) as date , WEEK(payment_links.created_at) as week"))
                    ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
                    ->where('payments.status', 1)
                    ->whereBetween('payment_links.created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->groupBy('date','week')
                    ->get();
          }

               for ($i=0; $i < count($paymentlinkyearly); $i++) {

                   $keyVal = array('total_sales'=> $paymentlinkyearly[$i]->total_sales, 'total_orders'=> $paymentlinkyearly[$i]->total_orders );
                   $json[] =  array("date"=>$paymentlinkyearly[$i]->date, $keyVal );
               }

              $date_check = $this->date_rangecheck($json,$totaldays);
              $data_new =array_merge($json,$date_check);
              asort($data_new);
              $data_new = array_values($data_new);

        }
        

             return response()->json($data_new);


    }

    public function date_rangecheck($date1,$data2) {
        foreach ($date1 as $key => $value) {
            for($i=0; $i<count($data2); $i++) {
                if($value["date"]==$data2[$i]["date"]) {
                    unset($data2[$i]);
                }
            }
            $data2 = array_values($data2);
        }

        return $data2;
    }

    public function salesTargetChart(Request $request)
    {
        
        if($request->from_date != '' && $request->to_date != '') {
            $from = Carbon::parse($request->from_date)->toDateString()." 00:00:00";
            $to = Carbon::parse($request->to_date)->toDateString()." 23:59:59";

            $salestarget = User::select(DB::raw("sum(payment_links.price) as total_target"))
            ->Join('payment_links',DB::raw( 'users.id'),'=',DB::raw('payment_links.created_by'))
            ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
            ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
            ->whereBetween('payment_links.created_at',[$from, $to])
            ->get();
            $salestarget = $salestarget->sum('total_target');
    
            $user = User::find($request->salespersonid);
            $usersaletarget = $user->user_target;
            $caltargetpercentage = ($salestarget/$usersaletarget)*100;
            $roundtargetvalue = round($caltargetpercentage, 2);
        }
        else if($request->month != ''){

            $salestarget = User::select(DB::raw("sum(payment_links.price) as total_target"))
            ->Join('payment_links',DB::raw( 'users.id'),'=',DB::raw('payment_links.created_by'))
            ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
            ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
            ->whereMonth('payment_links.created_at', Carbon::now()->month)
            ->whereYear('payment_links.created_at', now()->year)
            ->get();
            $salestarget = $salestarget->sum('total_target');
    
            $user = User::find($request->salespersonid);
            $usersaletarget = $user->user_target;
            $caltargetpercentage = ($salestarget/$usersaletarget)*100;
            $roundtargetvalue = round($caltargetpercentage, 2);
        }
        else if($request->week != ''){
            $salestarget = User::select(DB::raw("sum(payment_links.price) as total_target"))
            ->Join('payment_links',DB::raw( 'users.id'),'=',DB::raw('payment_links.created_by'))
            ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
            ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
            ->whereBetween('payment_links.created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get();
            $salestarget = $salestarget->sum('total_target');
    
            $user = User::find($request->salespersonid);
            $usersaletarget = $user->user_target;
            $caltargetpercentage = ($salestarget/$usersaletarget)*100;
            $roundtargetvalue = round($caltargetpercentage, 2);
        }
        else {
            $salestarget = User::select(DB::raw("sum(payment_links.price) as total_target"))
            ->Join('payment_links',DB::raw( 'users.id'),'=',DB::raw('payment_links.created_by'))
            ->Join('payments',DB::raw( 'payment_links.token'),'=',DB::raw('payments.token'))
            ->where(['payment_links.created_by' => $request->salespersonid, 'payments.status' => 1])
            ->whereMonth('payment_links.created_at', Carbon::now()->month)
            ->whereYear('payment_links.created_at', now()->year)
            ->get();
            $salestarget = $salestarget->sum('total_target');
    
            $user = User::find($request->salespersonid);
            $usersaletarget = $user->user_target;
            $caltargetpercentage = ($salestarget/$usersaletarget)*100;
            $roundtargetvalue = round($caltargetpercentage, 2);
    
        }
        return response()->json($roundtargetvalue);

    }
}
