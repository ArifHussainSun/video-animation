<?php

namespace App\Http\Middleware;

use App\Models\BrandSettings;
use App\Models\CountryCurrencies;
use App\Models\PaymentLink;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class VerifyPaymentToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->has('token')) {
            $item_detail = PaymentLink::where("token", "=", $request->token);
            if($item_detail->exists()){
                $item_detail = $item_detail->first();
                $finishTime = Carbon::now()->timestamp($item_detail->valid_till);
                $currentTime =  Carbon::now();

                if(($finishTime > $currentTime) && ($item_detail->status!=2) && ($item_detail->status!=0)) {
                    return $next($request);    
                } else {
                    $data = array(
                        "heading" => "Sorry! Token is Expired.",
                        "message" => "Kindly chat with our sales team in this regard.",
                        "title" => "Sorry! Token is Expired | Token: ".$request->token,
                    );

                    return redirect()->route('payment.expired')->with(["failed_data"=>$data]);
                }
            } else {
                $data = array(
                    "heading" => "Sorry! Token isn't valid.",
                    "message" => "Kindly chat with our sales team in this regard.",
                    "title" => "Sorry! Token isn't valid | Token: ".$request->token,
                );

                return redirect()->route('payment.expired')->with(["failed_data"=>$data]);
            }        
        } else {
            $data = array(
                "heading" => "Sorry! Token isn't exist.",
                "message" => "Kindly chat with our sales team in this regard.",
                "title" => "Sorry! Token isn't exist",
            );

            return redirect()->route('payment.expired')->with(["failed_data"=>$data]);
        }
        
    }
}
