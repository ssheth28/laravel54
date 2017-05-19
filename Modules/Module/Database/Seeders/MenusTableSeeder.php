<?php

namespace Modules\Module\Database\Seeders;

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->delete();
        DB::table('menus')->insert([
        [
            'company_id' => 1,
            'name'       => 'Sidebar',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ],
        ]);

        // $this->call("OthersTableSeeder");
    }
}
