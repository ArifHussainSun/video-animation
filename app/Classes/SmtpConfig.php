<?php
namespace App\Classes;

use App\Models\BrandSettings;
use Illuminate\Support\Facades\Crypt;

class SmtpConfig
{
   
    function __construct($mail_settings_name, $from="")
    {      
        $this->mail_settings_name = $mail_settings_name;
        if($from!=''){
            $this->mail_smtp_email = $from;
        }
        else{
        $smtpEmail = BrandSettings::where('key_name', 'like', '%mail_setting_'.$this->mail_settings_name.'%');
        
            if($smtpEmail->exists()) {
            $getsmtpEmail = $smtpEmail->first();
            $smtp_decode = json_decode($getsmtpEmail->key_value);
            $this->mail_smtp_email = $smtp_decode->mail_smtp_email;
            }
            else{
                throw new \ErrorException("SMTP Configuration doesn't exists.");
            }   
     }
        
        $this->setSmtpConfig();
    }

    function setSmtpConfig() {

            $smtp_settings = BrandSettings::where('key_name', 'like', '%mail_setting_'.$this->mail_settings_name.'%');
           
            if($smtp_settings->exists()) {
                $get_smtp_settings = $smtp_settings->first();
                $company_name = BrandSettings::where('key_name', 'like', '%company_name%')->first();
                $smtp_decode = json_decode($get_smtp_settings->key_value);
                $mailConfig =['transport' => (!empty($smtp_decode->mail_protocol)) ? $smtp_decode->mail_protocol : '',
                'host' => (!empty($smtp_decode->mail_smtp_host)) ? $smtp_decode->mail_smtp_host : '',
                'port' =>  (!empty($smtp_decode->mail_smtp_port)) ? $smtp_decode->mail_smtp_port : '',
                'username' =>  (!empty($smtp_decode->mail_smtp_user)) ? $smtp_decode->mail_smtp_user : '',
                'password' =>   (!empty($smtp_decode->mail_smtp_pass)) ? $smtp_decode->mail_smtp_pass : '',
                'encryption' =>   ($smtp_decode->mail_smtp_host != 'localhost') ? $smtp_decode->mail_smtpcrypto : ''
            ];
            
            $mailFrom = ['address' => (!empty($this->mail_smtp_email)) ? $this->mail_smtp_email :'',
            'name' => (!empty($company_name->key_value)) ? $company_name->key_value : ''];
            config(['mail.default' => (!empty($smtp_decode->mail_protocol)) ? $smtp_decode->mail_protocol : '']);
            config(['mail.mailers.smtp' => $mailConfig]);
            config(['mail.from' => $mailFrom]);
                
            } else {
                throw new \ErrorException("SMTP Configuration doesn't exists.");
            }
            
    }

    

}
