<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class SmtpSettingProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('SmtpSettingProvider', function($app, $parameters) {   
            if(!empty($parameters['smtp_user']) && !empty($parameters['smtp_pass'])) {
                $config = array(
                    'driver'     => $parameters['protocol'],
                    'host'       => $parameters['smtp_host'],
                    'port'       => $parameters['smtp_port'],
                    'from'       => array('address' => $parameters['smtp_user'], 'name' => $parameters['from_name']),
                    'encryption' => $parameters['encryption'],
                    'username'   => $parameters['smtp_user'],
                    'password'   => Crypt::decryptString($parameters['smtp_pass']),
                    'sendmail'   => '/usr/sbin/sendmail -bs',
                    'pretend'    => false,
                    'stream' => [
                        'ssl' => [
                            'allow_self_signed' => true,
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                        ],
                    ],
                );
            } else {
                $config = array(
                    'driver'     => env('MAIL_MAILER'),
                    'host'       => env('MAIL_HOST'),
                    'port'       => env('MAIL_PORT'),
                    'from'       => array('address' => env('MAIL_FROM_ADDRESS'), 'name' => env('MAIL_FROM_NAME')),
                    'encryption' => env('MAIL_ENCRYPTION'),
                    'username'   => env('MAIL_USERNAME'),
                    'password'   => env('MAIL_PASSWORD'),
                    'sendmail'   => '/usr/sbin/sendmail -bs',
                    'pretend'    => false,
                    'stream' => [
                        'ssl' => [
                            'allow_self_signed' => true,
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                        ],
                    ],
                );
            }
            
            Config::set('mail', $config);
            
            return new SmtpSettingProvider($parameters);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
