<?php

namespace Modules\Widget\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class WidgetDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(WidgetTypeTableSeeder::class);
        // Model::unguard();
        // $this->call("OthersTableSeeder");
    }
}
