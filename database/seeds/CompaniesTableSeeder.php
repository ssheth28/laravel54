<?php

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->truncate();
        DB::table('companies')->insert([
        [
            'name'       => 'www',
            'slug'       => 'www',
            'owner_id'  => 1,
            'company_domain_url' => 'www.test.com',
            'contact_no' => '0123456789',
            'email' => 'www@www.com',
            'country' => 'India',
            'state' => 'Gujarat',
            'city' => 'Vadodara',
            'pincode' => '390019',
            'address' => 'test address',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ],
        [
            'name'       => 'test',
            'slug'       => 'test',
            'owner_id'  => 1,
            'company_domain_url' => 'www.test.com',
            'contact_no' => '0123456789',
            'email' => 'test@test.com',
            'country' => 'Austrailia',
            'state' => 'Tasmania',
            'city' => 'Kingston',
            'pincode' => '123456',
            'address' => 'test address 1',            
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ],
        ]);
    }
}
