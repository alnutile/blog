<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

/**
 * Class PasswordReset
 * @package App\Console\Commands
 * @codeCoverageIgnore
 */
class PasswordReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'password_reset {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get new password';

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
     * @return mixed
     */
    public function handle()
    {
        $password = str_random(16);

        $user = User::where('email', $this->argument('email'))->first();
        
        $user->password = bcrypt($password);
        
        $user->save();
        
        $this->info(sprintf("New password %s", $password));
    }
}
