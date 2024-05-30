<?php

namespace App\Http\Controllers;

use App\Models\Briefs;
use App\Models\Contactinfo;
use App\Models\Contactqueries;
use App\Models\Pages;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class FrontendController extends Controller
{

   public function slug(Request $request, $slug = null)
    {
        if ($slug == null) {
            $page = Pages::where('name', 'home')->firstOrFail();
        }
        elseif ($slug == 'brief/thankyou') {
            return redirect()->route('front.brief.thankyou.store')->with(['data' => $request->all()]);
        } else {
            $page = Pages::where('url', $slug)->firstOrFail();
        }

        

        if(Str::contains($slug, 'brief/')) {
       
        $logostyle = [
            'vin_modern' => $request->get('vin_modern'),
            'sophi_fancy' => $request->get('sophi_fancy'),
            'deli_strong' => $request->get('deli_strong'),
            'eco_expensive' => $request->get('eco_expensive'),
            'geo_organic' => $request->get('geo_organic'),
            'con_exact' => $request->get('con_exact')
        ];


        
        $cname = $request->get("cname");
        $sname = $request->get("sname");

        $industry = $request->get("industry");
        
        $logocolor = $request->get('logocolor');
       
        $logo_type = $request->get('logo_type');

        $cus_name = $request->get('cus_name');
        $cus_email = $request->get('logo_type');
        $cus_phone = $request->get('cus_phone');
        $logo_style = $request->get('logo_style');
 
        $contentWithBlade = Blade::render($page->pages_content, compact('cname','sname','industry','logostyle','logocolor','logo_type','cus_name','cus_email','cus_phone','logo_style'));
        $session = $request->session()->put('key', $page);

            return view('frontend.pages.briefs.template', compact('contentWithBlade', 'page'));
            
        } else {
        $contentWithBlade = Blade::render($page->pages_content);
        $session = $request->session()->put('key', $page);
            return view('frontend.pages.template', compact('contentWithBlade', 'page'));
        }

    }

    public function index()
    {
        $page = Pages::where('url', 'home')->first();
        return view('frontend.pages.home', compact('page'));
    }

    public function about_us()
    {
        $page = Pages::where('url', 'about_us')->first();
        return view('frontend.pages.about', compact('page'));
    }

    public function services()
    {
        $page = Pages::where('url', 'services')->first();
        return view('frontend.pages.services', compact('page'));
    }

    public function pricing()
    {
        $page = Pages::where('url', 'pricing')->first();
        return view('frontend.pages.pricing', compact('page'));
    }

    public function portfolio()
    {
        $page = Pages::where('url', 'portfolio')->first();
        return view('frontend.pages.portfolio', compact('page'));
    }

    public function contact_us()
    {
        $page = Pages::where('url', 'contact_us')->first();
        return view('frontend.pages.contact', compact('page'));
    }

    public function contact_us_footer_store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'phone' => 'nullable|string',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $contact = new Contactqueries();
        $contact->name = $request['name'];
        $contact->email = $request['email'];
        $contact->phone = $request['phone'];
        $contact->message = $request['message'];
        $contact->pages_id = '6';
        if(($request->has('website'))||($request->has('style'))||($request->has('organization'))){
            $additional_data = array('website' => ($request->has('website')) ? $request->website : '',
            'style' => ($request->has('style')) ? $request->style : '',
            'organization' => ($request->has('organization')) ? $request->organization : '',
        );
            $contact->data = json_encode($additional_data);
        }

        if($contact->save()) {
            $content['name'] = $request->name;
            $content['subject'] = $request->subject;
            $content['email'] = $request->email;
            $content['message'] = $request->message;

            return response()->json([
                'success' => 'Submit Successfully!',
               
           ]); 
        } 
        
    } 

    public function contact_us_store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'phone' => 'nullable|string',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $contact = new Contactqueries();
        $contact->name = $request['name'];
        $contact->email = $request['email'];
        $contact->phone = $request['phone'];
        $contact->message = $request['message'];
        $contact->pages_id = '6';
        
            $additional_data = array('website' => ($request->has('website')) ? $request['website'] : '',
            'style' => ($request->has('style')) ? $request['style'] : '',
            'organization' => ($request->has('organization')) ? $request->organization : '',
        );
            $contact->data = json_encode($additional_data);
       

        if($contact->save()) {
            $content['name'] = $request->name;
            $content['subject'] = $request->subject;
            $content['email'] = $request->email;
            $content['message'] = $request->message;

            return response()->json([
                'success' => 'Submit Successfully!',
               
           ]); 
        } 
        
    } 
    
    
    public function brief_thankyou(Request $request)
    {

    $briefdata = session()->get('data');
    $industries = $briefdata['industry'];
    $style = $briefdata['logo_style'];
    $logocolor = $briefdata['logocolor'];
    $logotype = $briefdata['logo_type'];

    $session = Session::get('key');
    $brief = new Briefs();
    $brief->cus_name = $briefdata['cus_name'];
    $brief->cus_email = $briefdata['cus_email'];
    $brief->cus_phone = $briefdata['cus_phone'];
    $brief->company_name = $briefdata['cname'];
    $brief->company_slogan = $briefdata['sname'];
    $brief->industry = json_encode($industries);
    $brief->logo_style = json_encode($style);
    $brief->logo_color = json_encode($logocolor);
    $brief->logo_type = json_encode($logotype);
    $brief->active = '1';

    $personalinfo = $request->session()->put('key', [
        'ip' => $briefdata['ip'],
        'city' => $briefdata['city'],
        'region' => $briefdata['region'],
        'country' => $briefdata['country'],
        'postal_code' => $briefdata['postal_code']
    ]);
    $brief->data = json_encode($personalinfo);
    $brief->created_at = Carbon::now();


        if ($brief->save()) {
        $customer_name = $brief->cus_name;
        $page = Pages::where('name', 'thankyou')->firstOrFail();
        $contentWithBlade = Blade::render($page->pages_content,compact('briefdata','customer_name'));
        $session = $request->session()->put('key', $page);
        return view('frontend.pages.briefs.template', compact('contentWithBlade', 'page'));
        } else {
            
            return redirect()->route('/')->withInput()->with($briefdata);
        }
    }
}
