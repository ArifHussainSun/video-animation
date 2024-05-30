<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrandSettings;
use App\Models\CountryCurrencies;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\QuickNotify;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;


class BrandSettingsController extends Controller
{
    function __construct()
    {
        $this->brandsettingsimagepath = 'backend/assets/images/weblogos/';

        $this->faqsimagepath = 'backend/assets/images/faqs/';
        //$this->middleware('permission:Faq-Create|Faq-Edit|Faq-View|Faq-Delete', ['only' => ['index','store']]);

    }

    // start logo & favicon
    public function form()
    {
        $data["logo"] = BrandSettings::where("key_name", '=', "logo")->first();
        $data["logo_white"] = BrandSettings::where("key_name", '=', "logo_white")->first();
        $data["favicon"] = BrandSettings::where("key_name", '=', "favicon")->first();

        return view('admin.brandsettings.brandsettinglogos', $data);
    }

    public function general_setting()
    {
        $data["logo"] = BrandSettings::where("key_name", '=', "logo")->first();
        $data["logo_white"] = BrandSettings::where("key_name", '=', "logo_white")->first();
        $data["favicon"] = BrandSettings::where("key_name", '=', "favicon")->first();
        $data["company_alias"] = BrandSettings::where("key_name", '=', "company_alias")->first();
        $data["company_name"] = BrandSettings::where("key_name", '=', "company_name")->first();
        $data["company_phone"] = BrandSettings::where("key_name", '=', "company_phone")->first();
        $data["company_email"] = BrandSettings::where("key_name", '=', "company_email")->first();
        $data["company_address"] = BrandSettings::where("key_name", '=', "company_address")->first();
        $data["social_facebook"] = BrandSettings::where("key_name", '=', "social_facebook")->first();
        $data["social_instagram"] = BrandSettings::where("key_name", '=', "social_instagram")->first();
        $data["social_twitter"] = BrandSettings::where("key_name", '=', "social_twitter")->first();
        $data["social_youtube"] = BrandSettings::where("key_name", '=', "social_youtube")->first();
        $data["social_linkedin"] = BrandSettings::where("key_name", '=', "social_linkedin")->first();
        $data["primary_color"] = BrandSettings::where("key_name", '=', "primary_color")->first();
        $data["secondary_color"] = BrandSettings::where("key_name", '=', "secondary_color")->first();
        $data["default_customer_password"] = BrandSettings::where("key_name", '=', "default_customer_password")->first();
        return view('admin.brandsettings.general-setting', $data);
    }

    public function store(Request $request)
    {
        $valid =  $request->validate([
            'logo' => 'image|mimes:png,webp,svg|max:2048',
            'logo_white' => 'image|mimes:png,webp,svg|max:2048',
            'favicon' => 'image|mimes:jpeg,png,jpg,webp,svg,ico|max:2048',
        ]);

        if ($valid) {
            if ($request->hasFile('logo')) {
                $logo = BrandSettings::where("key_name", '=', "logo")->first();

                if ($logo) {
                    $logo = BrandSettings::find($logo->id);
                    $logo->key_name = 'logo';
                    $image = $request->file('logo');
                    $imagename = 'logo.' . $image->getClientOriginalExtension();
                    $image_destinationPath = public_path($this->brandsettingsimagepath);
                    $image->move($image_destinationPath, $imagename);
                    $imagename = $this->brandsettingsimagepath . $imagename;
                    $logo->key_value = $imagename;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $logo->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated Company Logo",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                } else {
                    $logo = new BrandSettings();

                    $logo->key_name = 'logo';
                    $image = $request->file('logo');
                    $imagename = 'logo.' . $image->getClientOriginalExtension();
                    $image_destinationPath = public_path($this->brandsettingsimagepath);
                    $image->move($image_destinationPath, $imagename);
                    $imagename = $this->brandsettingsimagepath . $imagename;
                    $logo->key_value = $imagename;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $logo->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Added new Company Logo",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                }
            }

            if ($request->hasFile('logo_white')) {
                $logo_white = BrandSettings::where("key_name", '=', "logo_white")->first();

                if ($logo_white) {
                    $logo_white = BrandSettings::find($logo_white->id);
                    $logo_white->key_name = 'logo_white';
                    $logo = $request->file('logo_white');
                    $imagename = 'logo_white.' . $logo->getClientOriginalExtension();
                    $image_destinationPath = public_path($this->brandsettingsimagepath);
                    $logo->move($image_destinationPath, $imagename);
                    $imagename = $this->brandsettingsimagepath . $imagename;
                    $logo_white->key_value = $imagename;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $logo_white->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated Company Logo White",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                } else {
                    $logo_white = new BrandSettings();

                    $logo_white->key_name = 'logo_white';
                    $logo = $request->file('logo_white');
                    $imagename = 'logo_white.' . $logo->getClientOriginalExtension();
                    $image_destinationPath = public_path($this->brandsettingsimagepath);
                    $logo->move($image_destinationPath, $imagename);
                    $imagename = $this->brandsettingsimagepath . $imagename;
                    $logo_white->key_value = $imagename;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $logo_white->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Added new Company Logo White",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                }
            }

            if ($request->hasFile('favicon')) {
                $favicon = BrandSettings::where("key_name", '=', "favicon")->first();

                if ($favicon) {
                    $favicon = BrandSettings::find($favicon->id);
                    $favicon->key_name = 'favicon';
                    $image = $request->file('favicon');
                    $imagename = 'favicon.' . $image->getClientOriginalExtension();
                    $image_destinationPath = public_path($this->brandsettingsimagepath);
                    $image->move($image_destinationPath, $imagename);
                    $imagename = $this->brandsettingsimagepath . $imagename;
                    $favicon->key_value = $imagename;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $favicon->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated Company favicon",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                } else {
                    $favicon = new BrandSettings();

                    $favicon->key_name = 'favicon';
                    $image = $request->file('favicon');
                    $imagename = 'favicon.' . $image->getClientOriginalExtension();
                    $image_destinationPath = public_path($this->brandsettingsimagepath);
                    $image->move($image_destinationPath, $imagename);
                    $imagename = $this->brandsettingsimagepath . $imagename;
                    $favicon->key_value = $imagename;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $favicon->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Added new Company favicon",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                }
            }

            Session::flash('success', 'Logo has been successfully Save.');
            return redirect()->back()->with('success', 'Logo has been successfully Save.');
        } else {
            return redirect()->back();
        }
    }

    public function themestore(Request $request)
    {
        $valid =  $request->validate([
            'primary_color' => 'nullable',
            'secondary_color' => 'nullable',
            'default_customer_password' => 'nullable',
        ]);

        if ($valid) {
            if ($request->primary_color) {
                $primary_color = BrandSettings::where("key_name", '=', "primary_color")->first();

                if ($primary_color) {
                    $primary_color = BrandSettings::find($primary_color->id);
                    $primary_color->key_name = 'primary_color';
                    $primary_color->key_value = $request->primary_color;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $primary_color->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated Contact Information Company Alias",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                } else {
                    $primary_color = new BrandSettings();

                    $primary_color->key_name = 'primary_color';
                    $primary_color->key_value = $request->primary_color;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $primary_color->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Added New  Theme Primary Color",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                }
            }

            if ($request->secondary_color) {
                $secondary_color = BrandSettings::where("key_name", '=', "secondary_color")->first();

                if ($secondary_color) {
                    $secondary_color = BrandSettings::find($secondary_color->id);
                    $secondary_color->key_name = 'secondary_color';
                    $secondary_color->key_value = $request->secondary_color;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $secondary_color->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated Contact Information Company Name",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                } else {
                    $secondary_color = new BrandSettings();

                    $secondary_color->key_name = 'secondary_color';
                    $secondary_color->key_value = $request->secondary_color;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $secondary_color->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Added New  Theme Secondary color",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                }
            }

            if ($request->default_customer_password) {
                $default_customer_password = BrandSettings::where("key_name", '=', "default_customer_password")->first();

                if ($default_customer_password) {
                    $default_customer_password = BrandSettings::find($default_customer_password->id);
                    $default_customer_password->key_name = 'default_customer_password';
                    $default_customer_password->key_value = $request->default_customer_password;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $default_customer_password->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated Contact Information Company Name",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                } else {
                    $default_customer_password = new BrandSettings();

                    $default_customer_password->key_name = 'default_customer_password';
                    $default_customer_password->key_value = $request->default_customer_password;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $default_customer_password->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Added New  Theme Secondary color",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                }
            }

            Session::flash('success', 'Theme has been successfully Save.');
            return redirect()->back()->with('success', 'Theme has been successfully Save.');
        } else {
            return redirect()->back();
        }
    }
    // end logo & favicon

    // start contactin formation

    public function contactinformationstore(Request $request)
    {
        $valid =  $request->validate([
            'company_alias' => 'nullable',
            'company_name' => 'nullable',
            'company_phone' => 'nullable',
            'company_email' => 'nullable',
            'company_address' => 'nullable',
        ]);

        if ($valid) {
            if ($request->company_alias) {
                $company_alias = BrandSettings::where("key_name", '=', "company_alias")->first();

                if ($company_alias) {
                    $company_alias = BrandSettings::find($company_alias->id);
                    $company_alias->key_name = 'company_alias';
                    $company_alias->key_value = $request->company_alias;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $company_alias->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated Contact Information Company Alias",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                } else {
                    $company_alias = new BrandSettings();

                    $company_alias->key_name = 'company_alias';
                    $company_alias->key_value = $request->company_alias;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $company_alias->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Added New  Contact Information Company Alias",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                }
            }

            if ($request->company_name) {
                $company_name = BrandSettings::where("key_name", '=', "company_name")->first();

                if ($company_name) {
                    $company_name = BrandSettings::find($company_name->id);
                    $company_name->key_name = 'company_name';
                    $company_name->key_value = $request->company_name;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $company_name->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated Contact Information Company Name",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                } else {
                    $company_name = new BrandSettings();

                    $company_name->key_name = 'company_name';
                    $company_name->key_value = $request->company_name;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $company_name->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Added New  Contact Information Company Name",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                }
            }

            if ($request->company_phone) {
                $phone = BrandSettings::where("key_name", '=', "company_phone")->first();

                if ($phone) {
                    $phone = BrandSettings::find($phone->id);
                    $phone->key_name = 'company_phone';
                    $phone->key_value = $request->company_phone;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $phone->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated Contact Information Company Phone",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                } else {
                    $phone = new BrandSettings();

                    $phone->key_name = 'company_phone';
                    $phone->key_value = $request->company_phone;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $phone->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Added New  Contact Information Company Phone",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                }
            }

            if ($request->company_email) {
                $email = BrandSettings::where("key_name", '=', "company_email")->first();

                if ($email) {
                    $email = BrandSettings::find($email->id);
                    $email->key_name = 'company_email';
                    $email->key_value = $request->company_email;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $email->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated Contact Information Company Email",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                } else {
                    $email = new BrandSettings();
                    $email->key_name = 'company_email';
                    $email->key_value = $request->company_email;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $email->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Added New  Contact Information Company Email",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                }
            }

            if ($request->company_address) {
                $address = BrandSettings::where("key_name", '=', "company_address")->first();

                if ($address) {
                    $address = BrandSettings::find($address->id);
                    $address->key_name = 'company_address';
                    $address->key_value = $request->company_address;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $address->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated  Contact Information Company Address",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                } else {
                    $address = new BrandSettings();
                    $address->key_name = 'company_address';
                    $address->key_value = $request->company_address;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $address->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Added New  Contact Information Company Address",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                }
            }

            Session::flash('success', 'Contact Information has been successfully Save.');
            return redirect()->back()->with('success', 'Contact Information has been successfully Save.');
        } else {
            return redirect()->back();
        }
    }
    // end contactin formation

    // start social link

    public function sociallinkstore(Request $request)
    {
        $valid =  $request->validate([
            'social_facebook' => 'nullable',
            'social_instagram' => 'nullable',
            'social_twitter' => 'nullable',
            'social_youtube' => 'nullable',
            'social_linkedin' => 'nullable',
        ]);

        if ($valid) {
            if ($request->social_facebook) {
                $social_facebook = BrandSettings::where("key_name", '=', "social_facebook")->first();

                if ($social_facebook) {
                    $social_facebook = BrandSettings::find($social_facebook->id);
                    $social_facebook->key_name = 'social_facebook';
                    $social_facebook->key_value = $request->social_facebook;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $social_facebook->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated Social Links Company Facebook",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                } else {
                    $social_facebook = new BrandSettings();
                    $social_facebook->key_name = 'social_facebook';
                    $social_facebook->key_value = $request->social_facebook;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $social_facebook->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Added New  Social Links Company Facebook",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                }
            }

            if ($request->social_instagram) {
                $social_instagram = BrandSettings::where("key_name", '=', "social_instagram")->first();

                if ($social_instagram) {
                    $social_instagram = BrandSettings::find($social_instagram->id);
                    $social_instagram->key_name = 'social_instagram';
                    $social_instagram->key_value = $request->social_instagram;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $social_instagram->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated Social Links Company Instagram",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                } else {
                    $social_instagram = new BrandSettings();
                    $social_instagram->key_name = 'social_instagram';
                    $social_instagram->key_value = $request->social_instagram;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $social_instagram->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Added New  Social Links Company Instagram",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                }
            }

            if ($request->social_twitter) {
                $social_twitter = BrandSettings::where("key_name", '=', "social_twitter")->first();

                if ($social_twitter) {
                    $social_twitter = BrandSettings::find($social_twitter->id);
                    $social_twitter->key_name = 'social_twitter';
                    $social_twitter->key_value = $request->social_twitter;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $social_twitter->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated  Social Links Company Twitter",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                } else {
                    $twitter = new BrandSettings();
                    $twitter->key_name = 'social_twitter';
                    $twitter->key_value = $request->social_twitter;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $twitter->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Added New  Social Links Company Twitter",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                }
            }

            if ($request->social_youtube) {
                $social_youtube = BrandSettings::where("key_name", '=', "social_youtube")->first();

                if ($social_youtube) {
                    $social_youtube = BrandSettings::find($social_youtube->id);
                    $social_youtube->key_name = 'social_youtube';
                    $social_youtube->key_value = $request->social_youtube;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $social_youtube->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated  Social Links Company Youtube",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                } else {
                    $social_youtube = new BrandSettings();
                    $social_youtube->key_name = 'social_youtube';
                    $social_youtube->key_value = $request->social_youtube;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $social_youtube->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Added New  Social Links Company Youtube",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                }
            }

            if ($request->social_linkedin) {
                $social_linkedin = BrandSettings::where("key_name", '=', "social_linkedin")->first();

                if ($social_linkedin) {
                    $social_linkedin = BrandSettings::find($social_linkedin->id);
                    $social_linkedin->key_name = 'social_linkedin';
                    $social_linkedin->key_value = $request->social_linkedin;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $social_linkedin->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated  Social Links Company Linkedin",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                } else {
                    $social_linkedin = new BrandSettings();
                    $social_linkedin->key_name = 'social_linkedin';
                    $social_linkedin->key_value = $request->social_linkedin;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $social_linkedin->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Added New  Social Links Company Linkedin",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                }
            }

            Session::flash('success', 'Social Links has been successfully Save.');
            return redirect()->back()->with('success', 'Social Links has been successfully Save.');
        } else {
            return redirect()->back();
        }
    }
    // end social link

    // start custom header & footer
    public function customheaderfooterform()
    {
        $data["customheader"] = BrandSettings::where("key_name", '=', "customheader")->first();
        $data["customfooter"] = BrandSettings::where("key_name", '=', "customfooter")->first();
        return view('admin.brandsettings.customheaderfooter', $data);
    }

    public function customheaderfooterstore(Request $request)
    {
        $valid =  $request->validate([
            'customheader' => 'nullable',
            'customfooter' => 'nullable',
        ]);

            if ($request->customheader) {
                $customheader = BrandSettings::where("key_name", '=', "customheader")->first();

                if ($customheader) {
                    $customheader = BrandSettings::find($customheader->id);
                    $customheader->key_name = 'customheader';
                    $customheader->key_value = ($request->customheader == "<p><br></p>") ? "" : $request->customheader;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $customheader->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated Custom Header",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                } else {
                    $customheader = new BrandSettings();

                    $customheader->key_name = 'customheader';
                    $customheader->key_value = ($request->customheader == "<p><br></p>") ? "" : $request->customheader;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $customheader->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Added Custom Header",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                }
            }

            if ($request->customfooter) {
                $customfooter = BrandSettings::where("key_name", '=', "customfooter")->first();

                if ($customfooter) {
                    $customfooter = BrandSettings::find($customfooter->id);
                    $customfooter->key_name = 'customfooter';
                    $customfooter->key_value = ($request->customfooter == "<p><br></p>") ? "" : $request->customfooter;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $customfooter->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated Custom Footer",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                } else {
                    $customfooter = new BrandSettings();
                    $customfooter->key_name = 'customfooter';
                    $customfooter->key_value = ($request->customfooter == "<p><br></p>") ? "" : $request->customfooter;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $customfooter->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Added Custom Footer",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                }
            }

            Session::flash('success', 'Custom Footer & Header has been successfully Save.');
            return response()->json(['success' => true, 'route' => route('admin-brand-settings-custom-header-footer-form')], 200);
            // return redirect()->back()->with('success', 'Custom Footer & Header has been successfully Saved.');
    }
    // end custom header & footer

    // start mail setting
    public function mailsettingform()
    {
        $data['mailSettings'] = BrandSettings::where('key_name', 'like', '%mail_setting_%')->get();
        return view('admin.brandsettings.mailsetting', $data);
    }

    public function mailsettingstore(Request $request)
    {
        $mail_setting = Str::lower($request->name);
        $mail_setting_email = Str::lower($request->email);

        $mail_settings = "mail_setting_" . str_replace(' ', '_', $mail_setting);
        $request->name = $mail_settings;

        $request->merge([
            'name' => $mail_settings,
        ]);

        $valid =  $request->validate([
            'name' => 'required|unique:brand_settings,key_name',
            'email' => 'required|email',
        ]);

        if ($valid) {
            $mail_setting = new BrandSettings();
            $mail_setting->key_name = $request->name;
            $mail_setting->key_value = json_encode(
                array(
                    "mail_protocol" => "",
                    "mail_smtp_host" => "",
                    "mail_smtp_port" => "",
                    "mail_smtp_user" => "",
                    "mail_smtp_email" => $request->email,
                    "mail_smtp_pass" => "",
                    "mail_charset" => "",
                    "mail_wordwrap" => "",
                    "mail_mailtype" => "",
                    'mail_smtpcrypto' => "",
                )
            );
            $management = User::role(['Admin', 'Brand Manager'])->get();
            $management->pluck('id');
            if ($mail_setting->save()) {
                $notify = array(
                    "performed_by" => Auth::user()->id,
                    "title" => "Added New  Email Setting Name",
                    "desc" => array(
                        "added_title" => $request->input('key_value'),
                    )
                );
                Notification::send($management, new QuickNotify($notify));
                Session::flash('success', 'Mail Settings has been successfully Save.');
                return redirect()->back()->with('success', 'Mail Settings has been successfully Save.');
            } else {
                Session::flash('error', 'Mail Settings has been Saving failed.');
                return redirect()->back()->with('error', 'Mail Settings has been Saving failed');
            }

            /* if ($request->mail_protocol) {
                $mail_protocol = BrandSettings::where("key_name", '=', "mail_protocol")->first();

                if ($mail_protocol) {
                    $mail_protocol = BrandSettings::find($mail_protocol->id);
                    $mail_protocol->key_name = 'mail_protocol';
                    $mail_protocol->key_value = $request->mail_protocol;
                    $mail_protocol->save();
                } else {
                    $mail_protocol = new BrandSettings();
                    $mail_protocol->key_name = 'mail_protocol';
                    $mail_protocol->key_value = $request->mail_protocol;
                    $mail_protocol->save();
                }
            }

            if ($request->mail_smtp_host) {
                $mail_smtp_host = BrandSettings::where("key_name", '=', "mail_smtp_host")->first();

                if ($mail_smtp_host) {
                    $mail_smtp_host = BrandSettings::find($mail_smtp_host->id);
                    $mail_smtp_host->key_name = 'mail_smtp_host';
                    $mail_smtp_host->key_value = strip_tags($request->mail_smtp_host);
                    $mail_smtp_host->save();
                } else {
                    $mail_smtp_host = new BrandSettings();
                    $mail_smtp_host->key_name = 'mail_smtp_host';
                    $mail_smtp_host->key_value = strip_tags($request->mail_smtp_host);
                    $mail_smtp_host->save();
                }
            }

            if ($request->mail_smtp_port) {
                $mail_smtp_port = BrandSettings::where("key_name", '=', "mail_smtp_port")->first();

                if ($mail_smtp_port) {
                    $mail_smtp_port = BrandSettings::find($mail_smtp_port->id);
                    $mail_smtp_port->key_name = 'mail_smtp_port';
                    $mail_smtp_port->key_value = strip_tags($request->mail_smtp_port);
                    $mail_smtp_port->save();
                } else {
                    $mail_smtp_port = new BrandSettings();
                    $mail_smtp_port->key_name = 'mail_smtp_port';
                    $mail_smtp_port->key_value = strip_tags($request->mail_smtp_port);
                    $mail_smtp_port->save();
                }
            }

            if ($request->mail_smtp_user) {
                $mail_smtp_user = BrandSettings::where("key_name", '=', "mail_smtp_user")->first();

                if ($mail_smtp_user) {
                    $mail_smtp_user = BrandSettings::find($mail_smtp_user->id);
                    $mail_smtp_user->key_name = 'mail_smtp_user';
                    $mail_smtp_user->key_value = strip_tags($request->mail_smtp_user);
                    $mail_smtp_user->save();
                } else {
                    $mail_smtp_user = new BrandSettings();
                    $mail_smtp_user->key_name = 'mail_smtp_user';
                    $mail_smtp_user->key_value = strip_tags($request->mail_smtp_user);
                    $mail_smtp_user->save();
                }
            }

            if ($request->mail_smtp_pass) {
                $mail_smtp_pass = BrandSettings::where("key_name", '=', "mail_smtp_pass")->first();

                if ($mail_smtp_pass) {
                    $mail_smtp_pass = BrandSettings::find($mail_smtp_pass->id);
                    $mail_smtp_pass->key_name = 'mail_smtp_pass';
                    $mail_smtp_pass->key_value = strip_tags($request->mail_smtp_pass);
                    $mail_smtp_pass->save();
                } else {
                    $mail_smtp_pass = new BrandSettings();
                    $mail_smtp_pass->key_name = 'mail_smtp_pass';
                    $mail_smtp_pass->key_value = strip_tags($request->mail_smtp_pass);
                    $mail_smtp_pass->save();
                }
            }

            if ($request->mail_charset) {
                $mail_charset = BrandSettings::where("key_name", '=', "mail_charset")->first();

                if ($mail_charset) {
                    $mail_charset = BrandSettings::find($mail_charset->id);
                    $mail_charset->key_name = 'mail_charset';
                    $mail_charset->key_value = strip_tags($request->mail_charset);
                    $mail_charset->save();
                } else {
                    $mail_charset = new BrandSettings();
                    $mail_charset->key_name = 'mail_charset';
                    $mail_charset->key_value = strip_tags($request->mail_charset);
                    $mail_charset->save();
                }
            }

            if ($request->mail_wordwrap) {
                $mail_wordwrap = BrandSettings::where("key_name", '=', "mail_wordwrap")->first();

                if ($mail_wordwrap) {
                    $mail_wordwrap = BrandSettings::find($mail_wordwrap->id);
                    $mail_wordwrap->key_name = 'mail_wordwrap';
                    $mail_wordwrap->key_value = strip_tags($request->mail_wordwrap);
                    $mail_wordwrap->save();
                } else {
                    $mail_wordwrap = new BrandSettings();
                    $mail_wordwrap->key_name = 'mail_wordwrap';
                    $mail_wordwrap->key_value = strip_tags($request->mail_wordwrap);
                    $mail_wordwrap->save();
                }
            }

            if ($request->mail_mailtype) {
                $mail_mailtype = BrandSettings::where("key_name", '=', "mail_mailtype")->first();

                if ($mail_mailtype) {
                    $mail_mailtype = BrandSettings::find($mail_mailtype->id);
                    $mail_mailtype->key_name = 'mail_mailtype';
                    $mail_mailtype->key_value = strip_tags($request->mail_mailtype);
                    $mail_mailtype->save();
                } else {
                    $mail_mailtype = new BrandSettings();
                    $mail_mailtype->key_name = 'mail_mailtype';
                    $mail_mailtype->key_value = strip_tags($request->mail_mailtype);
                    $mail_mailtype->save();
                }
            } */

            /* Session::flash('success', 'Mail Settings has been successfully Save.');
            return redirect()->back()->with('success', 'Mail Settings has been successfully Save.'); */
        } else {
            return redirect()->back();
        }
    }

    public function mailSettingUpdate(Request $request)
    {
        $valid =  $request->validate([
            'mail_setting_key' => 'required',
            'mail_protocol' => 'required',
            'mail_mailtype' => 'nullable',
            'mail_charset' => 'required',
            'mail_wordwrap' => 'required',
            'mail_smtp_host' => 'required',
            'mail_smtp_port' => 'required',
            'mail_smtpcrypto' => 'required',
            'mail_smtp_user' => 'nullable',
            'mail_smtp_email' => 'nullable|email',
            'mail_smtp_pass' => 'nullable',
        ]);

        if ($valid) {
            $mail_settings = BrandSettings::where("key_name", '=', $request->mail_setting_key)->first();
            
            if ($mail_settings) {
                $mail_settings = BrandSettings::find($mail_settings->id);
                $mail_settings->key_name = $request->mail_setting_key;
                $mail_settings->key_value = json_encode(
                    array(
                        "mail_protocol" => $request->mail_protocol,
                        "mail_mailtype" => $request->mail_mailtype,
                        "mail_charset" => $request->mail_charset,
                        "mail_wordwrap" => $request->mail_wordwrap,
                        "mail_smtp_host" => $request->mail_smtp_host,
                        "mail_smtp_port" => $request->mail_smtp_port,
                        "mail_smtpcrypto" => $request->mail_smtpcrypto,
                        "mail_smtp_user" => $request->mail_smtp_user,
                        "mail_smtp_email" => $request->mail_smtp_email,
                        "mail_smtp_pass" => $request->mail_smtp_pass,
                    )
                );
                
                $management = User::role(['Admin', 'Brand Manager'])->get();
                $management->pluck('id');
                if ($mail_settings->save()) {
                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated  Email Setting Name",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                    Session::flash('success', 'Mail Settings has been successfully Save.');
                    return redirect()->back()->with('success', 'Mail Settings has been successfully Save.');
                } else {
                    Session::flash('error', 'Mail Settings was save failed.');
                    return redirect()->back()->with('error', 'Mail Settings was save failed.');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Mail Settings was save failed.');
        }
    }

    public function paymentsettingform()
    {
        $currency = CountryCurrencies::all();
        $default_currency = BrandSettings::where("key_name", '=', 'default_currency')->first();
        $default_payment_gateway = BrandSettings::where("key_name", '=', 'default_payment_gateway')->first();
        $paymentGateways = BrandSettings::where('key_name', 'like', '%payment_gateway_%')->get();

        return view('admin.brandsettings.paymentsetting', compact('currency', 'paymentGateways', 'default_payment_gateway', 'default_currency'));
    }

    public function paymentsetting_default(Request $request)
    {
        $valid = $request->validate([
            'default_payment_gateway' => 'required',
            'default_currency' => 'required'
        ]);

        if ($valid) {
            if ($request->default_payment_gateway) {
                $default_payment_gateway = BrandSettings::where("key_name", '=', "default_payment_gateway")->first();

                if ($default_payment_gateway) {
                    $default_payment_gateway->key_name = 'default_payment_gateway';
                    $default_payment_gateway->key_value = $request->default_payment_gateway;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $default_payment_gateway->save();
                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated  Payment Gateway Setting Default Payment Gateway",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                } else {
                    $default_payment_gateway = new BrandSettings();
                    $default_payment_gateway->key_name = 'default_payment_gateway';
                    $default_payment_gateway->key_value = $request->default_payment_gateway;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $default_payment_gateway->save();
                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Added New  Payment Gateway Setting Default Payment Gateway",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                }
            }

            if ($request->default_currency) {
                $default_currency = BrandSettings::where("key_name", '=', "default_currency")->first();

                if ($default_currency) {
                    $default_currency = BrandSettings::find($default_currency->id);
                    $default_currency->key_name = 'default_currency';
                    $default_currency->key_value = $request->default_currency;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $default_currency->save();
                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated  Payment Gateway Setting Default Currency",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                } else {
                    $default_currency = new BrandSettings();
                    $default_currency->key_name = 'default_currency';
                    $default_currency->key_value = $request->default_currency;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $default_currency->save();
                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Added New  Payment Gateway Setting Default Currency",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                }
            }

            Session::flash('success', 'Payment Default Settings has been successfully Save.');
            return redirect()->back()->with('success', 'Payment Default Settings has been successfully Save.');
        } else {
            return redirect()->back();
        }
    }

    public function paymentsettingstore(Request $request)
    {
        $gateway_type = Str::lower($request->payment_gateway_type);
        $gateway_name = Str::lower($request->name);
        $gateway_key = "payment_gateway_" . $gateway_type . "_" . str_replace(' ', '_', $gateway_name);
        $request->name = $gateway_key;

        $request->merge([
            'name' => $gateway_key,
        ]);

        $valid =  $request->validate([
            'payment_gateway_type' => 'required',
            'name' => 'required|unique:brand_settings,key_name',
        ]);

        if ($valid) {
            if ($request->name) {
                //$paymentgateway = BrandSettings::where("key_name", '=', $gateway_key)->first();

                /* if ($paymentgateway) {
                    $paymentgateway->key_name = $gateway_key;
                    $paymentgateway->key_value = $paymentsettingjson;
                    $paymentgateway->save();
                } else { */

                $paymentgateway = new BrandSettings();
                $paymentgateway->key_name = $gateway_key;
                $paymentgateway->key_value = json_encode(
                    array(
                        "merchant_id" => "",
                        "public_key" => "",
                        "secret_key" => "",
                        "statement_descriptor" => "",
                        "environment" => "",
                    )
                );
                $management = User::role(['Admin', 'Brand Manager'])->get();
                $management->pluck('id');
                $paymentgateway->save();
                $notify = array(
                    "performed_by" => Auth::user()->id,
                    "title" => "Added New  Payment Gateway Setting Payment Gateway",
                    "desc" => array(
                        "added_title" => $request->input('key_value'),
                    )
                );
                Notification::send($management, new QuickNotify($notify));
                //}
            }

            Session::flash('success', 'Payment Setting has been successfully Save.');
            return redirect()->back()->with('success', 'Payment Setting has been successfully Save.');
        } else {
            return redirect()->back();
        }
    }

    public function updateGatewaySetting(Request $request)
    {
        $valid =  $request->validate([
            'gateway_key' => 'required',
            'merchant_id' => 'nullable',
            'public_key' => 'required',
            'secret_key' => 'required',
            'statement_descriptor' => 'nullable',
            'environment' => 'required',
        ]);

        if ($valid) {
            $paymentgateway = BrandSettings::where("key_name", '=', $request->gateway_key)->first();

            if ($paymentgateway) {
                $paymentgateway = BrandSettings::find($paymentgateway->id);
                $paymentgateway->key_name = $request->gateway_key;
                $paymentgateway->key_value = json_encode(
                    array(
                        "merchant_id" => $request->merchant_id,
                        "public_key" => $request->public_key,
                        "secret_key" => $request->secret_key,
                        "statement_descriptor" => $request->statement_descriptor,
                        "environment" => $request->environment,
                    )
                );
                $management = User::role(['Admin', 'Brand Manager'])->get();
                $management->pluck('id');
                $paymentgateway->save();
                $notify = array(
                    "performed_by" => Auth::user()->id,
                    "title" => "Updated  Payment Gateway Setting Payment Gateway",
                    "desc" => array(
                        "added_title" => $request->input('key_value'),
                    )
                );
                Notification::send($management, new QuickNotify($notify));

                Session::flash('success', 'Payment Gateway has been successfully Save.');
                return redirect()->back()->with('success', 'Payment Setting has been successfully Save.');
            }
        } else {
            return redirect()->back();
        }
    }
    
}
