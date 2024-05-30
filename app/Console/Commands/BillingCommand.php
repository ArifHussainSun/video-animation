<?php

namespace App\Console\Commands;

use App\Classes\Billing;
use App\Models\User;
use App\Traits\ApplicationTrait;
use Illuminate\Console\Command;

class BillingCommand extends Command
{
    use ApplicationTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'billing:send {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Billed to customer {user}';

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
        $user = User::where("email", $email)->first();
        $billing = new Billing($brandSettings, $user);
        $billing->invoiceTemplate();
        $billing->generate();
        $billing->mail();
        $this->info("Email sent to {$billing->getUser()}");
    }
}
