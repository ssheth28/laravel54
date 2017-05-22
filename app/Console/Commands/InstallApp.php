<?php

namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\Command;

class InstallApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate and seed operations.';

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
        Artisan::call('migrate');
        Artisan::call('module:migrate');
        Artisan::call('db:seed');
        Artisan::call('module:seed');
        $this->info('Migration and seeder done.');
    }
}
