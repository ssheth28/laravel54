<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->delete();
        if (($handle = fopen ( public_path () . '/csvimport/countries.csv', 'r' )) !== FALSE) {
            while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
                DB::table('countries')->insert([
                    'id' => $data[0],
                    'shortname' => $data[1],
                    'name' => $data[2]
                ]);
            }
            fclose ( $handle );
        }
    }
}
