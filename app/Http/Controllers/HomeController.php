<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payments;
use App\Models\Partner;
use App\Models\PaymentLink;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Notification;
use PDF;
use App\Notifications\QuickNotify;
use App\Traits\ReporthelperTrait;

class HomeController extends Controller
{
    use ReporthelperTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard(Request $request)
    {
        if(Auth::user()->hasRole('Salesperson')) {
            
            $salespersonid = Auth::user()->id;
            return view('admin.index',compact('salespersonid'));

        } else {
           
            return view('admin.index');
        }
    }

    public function sendOfferNotification()
    {

        return view('admin.notification');
    }
    public function notification_store(Request $request)
    {
        $user = Auth::user();
        $notification = new Partner();
        $notification->name = $request->name;
        $notification->desc = $request->desc;
        $notification->created_by = auth()->user()->id;
        $notification->save();


        Notification::send($user, new QuickNotify($notification));

        return back()->with('success', 'Notification , Added Successfully.');
    }
    public function markAllRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->route('admin-notification.main');
    }

    public function invoice_form()
    {
        // return view('admin.invoice');

        $pdf = PDF::loadView('admin.invoice');

        return $pdf->download('invoice.pdf');
    }
}
