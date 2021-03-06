<?php 

namespace MVsoft\Webdefault\Commands;

use Illuminate\Console\Command;

use MVsoft\Webdefault\Models\User;

use Hash, File;

class SetDefaultAdminCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'mvsoft:setDefaultAdmin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set default admin in database';

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

        $user = new User;
        $user->first_name= 'Martins';
        $user->last_name = 'Vecbralis';
        $user->email='vecbralis@gmail.com';
        $user->password='$2y$10$hN9bs0yWgdIn06wilLGPSOSAMtytg/EaC3DsjLssKuZzcnV4HcH9e';
        $user->status=1;
        $user->blocked=1;
        $user->save();
        
    }

}