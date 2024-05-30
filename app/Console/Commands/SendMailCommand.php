<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\SendMail;
use App\Models\User;
use App\Traits\ApplicationTrait;
use Throwable;

class SendMailCommand extends Command
{
    use ApplicationTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send {user} {--template=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending Mailing';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $brandSettings = $this->get_setting();
        $email = $this->argument('user');
        $template = $this->option('template');

        $user = User::select("email")->where("email", $email)->first();

        try {
            if(!empty($user)) {
                $sendMail = new SendMail($brandSettings, $user, $template);
                $sendMail->generate();
                $sendMail->mail();
                $this->info("Email sent to {$user} - {$template}");
            } else {
                $this->error("{$email} not exists.");
            }
        } catch(Throwable $e) {
            $this->error("{$e->getMessage()}");
        }
    }
}
