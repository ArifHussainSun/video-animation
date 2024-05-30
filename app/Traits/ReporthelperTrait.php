<?php

namespace App\Traits;
use App\Models\PaymentLink;
use App\Models\Payments;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

trait ReporthelperTrait {

    public function Reporthelper_api()
    {   
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
      
        return response()->json($paymentlinkArr);
    }
    public function Reporthelperyearly_api()
    {   

        $paymentlinkyearly = PaymentLink::select(DB::raw("(COUNT(created_at)) as payments , (MONTHNAME(created_at)) as month , (YEAR(created_at)) as year"))
        ->whereYear('created_at', now()->year)
        ->orderBy('created_at', 'ASC')
        ->groupBy('month','year')
        ->get(['created_at']);
      
        return response()->json($paymentlinkyearly);
    }

    public function Payments_category_api()
    {   
        $category = Payments::with('category')->get(); 

        $payment_category = Payments::select('category_id', DB::raw("COUNT('category_id') as total_category"))
        ->with('category')
        ->join('categories','payments.category_id','=','categories.id')
        ->groupBy('category_id')
        ->orderBy('category_id', 'ASC')
        ->get();
        return response()->json($payment_category);
    }
    
    public function total_payments_api()
    {   
        $total = Payments::select(DB::raw("sum(price) as price"))
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', now()->year)
        ->orderBy('id', 'ASC')->groupBy("price")->get();
        $total_payments_price = $total->sum('price');
        return response()->json($total_payments_price);
    }
    
    public function orders_api()
    {   
        $total_orders = Payments::select(DB::raw("COUNT('id') as orders"))
        ->orderBy('id', 'ASC')->groupBy("id")->get();
        $orders = $total_orders->sum('orders');
        return response()->json($orders);
    }

    public function average_price_api()
    {   
        $total = Payments::select(DB::raw("avg(price) as price"))
        ->orderBy('id', 'ASC')->groupBy("price")->get();
        $average_total = $total->avg('price');
        $average_price =  number_format($average_total,3);
        return response()->json($average_price);
    }

    public function latest_transaction_api()
    {   
        $latest_transaction = Payments::latest()->take(5)->orderBy('id', 'ASC')
        ->whereYear('created_at', now()->year)
        ->get();
        return response()->json($latest_transaction);
    }

    public function revenue_api()
    {   
        
        $revenue = Payments::select(DB::raw("sum(price) as price"))
        ->orderBy('id', 'ASC')->groupBy("price")->get();
        $total_revenue = $revenue->sum('price');
        
        return response()->json($total_revenue);
    }

    public function dateRange_filters_Apidata($request)
    {   
        if($request->from_date != '' && $request->to_date != '') {
            $from = Carbon::parse($request->from_date)->toDateString();
            $to = Carbon::parse($request->to_date)->toDateString();
            $daterange_Filterdata = DB::table('payments')->whereBetween('created_at',[$from, $to])->get();
        }else {
            $daterange_Filterdata = DB::table('payments')->orderBy('created_at', 'desc')->get();
        }
      
        return response()->json($daterange_Filterdata);
    }
}