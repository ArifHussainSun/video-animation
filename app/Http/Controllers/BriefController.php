<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Carbon\Carbon;
use App\Models\Briefs;

class BriefController extends Controller
{
    // public function briefslug($slug, Request $request)
    // {
    //     if ($slug == "admin") {
    //         return redirect()->route('login');
    //     }
    //     if ($slug == "login") {
    //         return view('auth.login');
    //     }
    //     if ($slug == null) {

    //         $page = Pages::where('url', 'home')->first();
    //     } else {

    //         $page = Pages::where('url', $slug)->first();
    //         // dd($page);
    //     }

    //     if (empty($page)) {
    //         abort(404);
    //     }


    //     $logotype = $request->get('logo_type');
    //     $logostyle = [
    //         'vin_modern' => $request->get('vin_modern'),
    //         'sophi_fancy' => $request->get('sophi_fancy'),
    //         'deli_strong' => $request->get('deli_strong'),
    //         'eco_expensive' => $request->get('eco_expensive'),
    //         'geo_organic' => $request->get('geo_organic'),
    //         'con_exact' => $request->get('con_exact')
    //     ];


    //     $request->session()->put('key', [$logostyle]);
    //     $logotype = $request->session()->put('key', ['logocolor' => $request->get('logocolor')]);
    //     $industry = $request->get("industry");
    //     $logocolor = $request->get('logocolor');
    //     $logo_color = $request->get('logo_color');
    //     $personalinfo = $request->session()->put('key', ['logo_type' => $request->get('logo_type')]);
    //     $logo_type = $request->get('logo_type');
    //     $contentWithBlade = Blade::render($page->pages_content, compact('industry', 'logo_color', 'logocolor', 'logotype', 'logostyle', 'personalinfo', 'logo_type'));

    //     return view('frontend.pages.briefs.template', compact('contentWithBlade', 'page'));
    // }
    public function slogan(Request $request)
    {
        $page = Pages::where('url', 'slogan')->first();
        $slogan = $request->session()->put('key', ['cname' => $request->get('cname')]);
        return view('frontend.pages.briefs.slogan', compact('page', 'slogan'));
    }

    public function industry(Request $request)
    {
        $page = Pages::where('url', 'industry')->first();
        $industry = $request->session()->put('key', ['cname' => $request->get('cname'), 'companyslogan' => $request->get('sname')]);
        // Data to pass in Second Step
        $cname = $request->get('cname');
        $sname = $request->get('sname');

        $data['id'] = $request->get('id');

        return view('frontend.pages.briefs.industry', $data, compact('page', 'industry'));
    }

    public function logo_style(Request $request)
    {

        $page = Pages::where('url', 'logo_style')->first();
        $logostyle = $request->session()->put('key', ['industry' => $request->get('industry')]);

        $industry = $request->get('industry');
        return view('frontend.pages.briefs.logo_style', compact('page', 'logostyle', 'industry'));
    }
    public function color_picker(Request $request)
    {
        $industries = $request->get("industry");
        $page = Pages::where('url', 'color_picker')->first();

        $logostyle = [
            'vin_modern' => $request->get('vin_modern'),
            'sophi_fancy' => $request->get('sophi_fancy'),
            'deli_strong' => $request->get('deli_strong'),
            'eco_expensive' => $request->get('eco_expensive'),
            'geo_organic' => $request->get('geo_organic'),
            'con_exact' => $request->get('con_exact')
        ];
        $request->session()->put('key', ['logostyle' => $logostyle]);
        // dd($logocolor);
        return view('frontend.pages.briefs.color_picker', compact('page', 'logostyle', 'industries'));
    }

    public function logo_type(Request $request)
    {
        $page = Pages::where('url', 'logo_type')->first();
        $logotype = $request->session()->put('key', ['logocolor' => $request->get('logocolor')]);
        $industries = $request->get("industry");
        $logostyle = $request->get('logo_style');
        $logocolor = $request->get('logocolor');

        return view('frontend.pages.briefs.logo_type', compact('page', 'logocolor', 'logotype', 'logostyle', 'industries'));
    }

    public function personal_info(Request $request)
    {
        $industries = $request->get("industry");
        $logostyle = $request->get('logo_style');
        $logocolor = $request->get('logo_color');
        $page = Pages::where('url', 'personal_info')->first();
        $personalinfo = $request->session()->put('key', ['logo_type' => $request->get('logo_type')]);
        $logo_type = $request->get('logo_type');
        
        return view('frontend.pages.briefs.personal_info', compact('page', 'personalinfo', 'logo_type', 'industries', 'logocolor', 'logostyle'));
    }

    public function thankyou(Request $request)
    {
       
        $industries = $request->get("industry");
        $style = $request->get('logo_style');
        $logocolor = $request->get('logo_color');
        $logotype = $request->get('logo_type');
        $page = Pages::where('url', 'thankyou')->first();
        $request->validate([
            'cus_name' => 'required|string',
            'cus_email' => 'required|email',

        ]);
        $session = Session::get('key');
        $brief = new Briefs();
        $brief->cus_name = $request->cus_name;
        $brief->cus_email = $request->cus_email;
        $brief->cus_phone = $request->cus_phone;
        $brief->company_name = $request->cname;
        $brief->company_slogan = $request->sname;
        $brief->industry = json_encode($industries);
        $brief->logo_style = json_encode($style);
        $brief->logo_color = json_encode($logocolor);
        $brief->logo_type = json_encode($logotype);
        $brief->active = '1';

        $personalinfo = $request->session()->put('key', [
            'gclid' => $request->get('gclid'),
            'ip' => $request->get('ip'),
            'city' => $request->get('city'),
            'region' => $request->get('region'),
            'country' => $request->get('country'),
            'postal_code' => $request->get('postal_code')
        ]);
        $brief['data'] = json_encode($personalinfo);
        $brief->created_at = Carbon::now();

        if ($brief->save()) {
            $content['cus_name'] = $request->cus_name;
            $notification['type'] = "success";
            $notification['message'] = "Your Message Sent Successfully.";

            return view('frontend.pages.briefs.thankyou', compact('page'))->with('notify_response', $notification);
        } else {
            $notification['type'] = "danger";
            $notification['message'] = "Some error occured, please try again.";

            return redirect()->back()->with('notify_response', $notification);
        }
    }
}
