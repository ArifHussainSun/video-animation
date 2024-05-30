<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payments;
use App\Models\PaymentLink;
use App\Models\Contactqueries;
use App\Models\Product;
use App\Models\Subscriber;
use Illuminate\Support\Facades\DB;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\EmailTemplate;
use App\Models\Pages;
use App\Models\BrandSettings;
use App\Models\Faq;
use App\Models\Partner;
use App\Models\Testimonial;
use App\Models\Coupon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = $this->guard()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
     
        return $this->createNewToken($token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                "status" => false,
                "errors" => $validator->errors()
            ), 400);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'status' => true,
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    public function customerApiData()
    {
        $customer = User::selectRaw('id , first_name , last_name , email , phone_number , company_name , address , country , city , status')
        ->where('status' , 1)
        ->latest()
        ->take(5)
        ->role('Customer')
        ->get();
        return response()->json($customer);
    }

    public function paymentApiData()
    {
        $payments = Payments::selectRaw('id , customer_id  , item_name , price , currency , category_id  , sale_type_id  , payment_gateway , message , status')
        ->where('status' , 1)
        ->latest()
        ->take(5)
        ->get();
        return response()->json($payments);
    }

    public function paymentLinkApiData()
    {
        $paymentLink = PaymentLink::selectRaw('id , customer_id  , item_name , price , currency , category_id  , sale_type_id  , payment_gateway , comment , status')
        ->where('status' , 1)
        ->latest()
        ->take(5)
        ->get();
        return response()->json($paymentLink);
    }

    public function userApiData()
    {
        $user = User::all();
        return response()->json($user);  
    }

    public function ContactQueriesApiData()
    {
        $ContactQueries = Contactqueries::selectRaw('id , name  , email , subject , pages_id , message  , status')
        ->where('status' , 1)
        ->latest()
        ->take(5)
        ->get();
        return response()->json($ContactQueries);  
    }

    public function subscriberApiData()
    {
        $subscriber = Subscriber::selectRaw('id , name  , email , phone  , active')
        ->where('active' , 1)
        ->latest()
        ->take(5)
        ->get();
        return response()->json($subscriber);  
    }

    public function categoriesApiData()
    {
        $categories = Categories::selectRaw('id , name  , title , short_description , link , active ')
        ->where('active' , 1)
        ->latest()
        ->take(5)
        ->get();
        return response()->json($categories);  
    }

    public function SubCategoriesApiData()
    {
        $subcategories = DB::table('sub_categories as sub')
        ->Join('categories as c',DB::raw( 'sub.categories_id'),'=',DB::raw('c.id'))
        ->select(DB::raw( 'sub.id'),DB::raw( 'sub.categories_id'),DB::raw('c.name')
        ,DB::raw('sub.title'),DB::raw('sub.short_description'),DB::raw('sub.created_at')
        ,DB::raw('sub.active'),DB::raw('sub.created_at'))
        ->where('sub.active' , 1)
        ->orderBy('sub.id','desc')
        ->latest()
        ->take(5)
        ->get();
        return response()->json($subcategories);  
    }

    public function productsApiData()
    {
        $products = DB::table('products as p')
        ->Join('categories as c',DB::raw( 'p.categories_id'),'=',DB::raw('c.id'))
        ->Join('sub_categories as sub',DB::raw( 'p.sub_categories_id'),'=',DB::raw('sub.id'))
        ->select(DB::raw( 'p.id'),DB::raw( 'p.categories_id'),DB::raw('c.name')
        ,DB::raw('p.title'),DB::raw('p.short_description'),DB::raw('p.created_at')
        ,DB::raw('p.active'),DB::raw('p.created_at'))
        ->where('p.active' , 1)
        ->orderBy('p.id','desc')
        ->latest()
        ->take(5)
        ->get();
        return response()->json($products);  
    }

    public function emailTemplateApiData()
    {
        $emailTemplate = EmailTemplate::selectRaw(' id , title , name , subject , content , status')
        ->where('status' , 1)
        ->latest()
        ->take(5)
        ->get();
        return response()->json($emailTemplate);   
    }

    public function pagesApiData()
    {
        $pages = Pages::selectRaw(' id ,name , url , title , pages_header , pages_content , pages_footer , status')
        ->where('status' , 1)
        ->latest()
        ->take(5)
        ->get();
        return response()->json($pages); 

    }

    public function testimonialsApiData()
    {
        $testimonial = Testimonial::selectRaw(' id ,name , designation , company , rating  , active')
        ->where('active' , 1)
        ->latest()
        ->take(5)
        ->get();
        return response()->json($testimonial);  
    }

    public function faqsApiData()
    {
        $faqs = DB::table('faqs as f')
        ->Join('pages as pag',DB::raw( 'f.page'),'=',DB::raw('pag.id'))
        ->select(DB::raw( 'f.id')
        ,DB::raw('f.question'),DB::raw('f.answer')
        ,DB::raw('f.created_at')
        )
        ->where('f.active' , 1)
        ->orderBy('f.id','desc')
        ->latest()
        ->take(5)
        ->get();
        return response()->json($faqs);   
    }

    public function partnersApiData()
    {
        $partners = Partner::selectRaw(' id ,name ,image , active')
        ->where('active' , 1)
        ->latest()
        ->take(5)
        ->get();
        return response()->json($partners);    
    }

    public function contactInformationApiData()
    {
        $contactInformation = BrandSettings::selectRaw(' id ,key_name , key_value , status')
        ->pluck('key_name')
        ->get();
        return response()->json($contactInformation);  
    }

    public function couponApiData()
    {
        $coupon = Coupon::selectRaw(' id ,coupon_name , coupon_description , discount , discount_type  , date_from , date_to  , quantity , status')
        ->where('status' , 1)
        ->latest()
        ->take(5)
        ->get();
        return response()->json($coupon);   
    }

    
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken($this->guard()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => $this->guard()->factory()->getTTL() * 60,
            'user' => $this->guard()->user()
        ], 200, [
            'Authorization'=> $token
           
        ]);
    }

    public function guard()
    {
        return Auth::guard('api');
    }
}