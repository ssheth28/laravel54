<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;

class WidgetTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('widget_type')->truncate();
        DB::table('widget_type')->insert([
        [
            'name' => 'Count',
            'parent_id' => null,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ],
        [
            'name' => 'Graphs',
            'parent_id' => null,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ],
        [
            'name' => 'Line chart',
            'parent_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ],
        [
            'name' => 'Pie chart',
            'parent_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ],
        [
            'name' => 'Comments',
            'parent_id' => null,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ],
        [
            'name' => 'Quick Actions',
            'parent_id' => null,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ],
        [
            'name' => 'Stats',
            'parent_id' => null,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ],
        [
            'name' => 'General stats',
            'parent_id' => 7,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ],
        [
            'name' => 'Server stats',
            'parent_id' => 7,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ],
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}