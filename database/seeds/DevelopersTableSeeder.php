<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DevelopersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('developers')->insert([
            'id' => 9001,
            'name' => 'Testerly Testerlying',
            'email' => str_random(10).'@gmail.com',
            'is_local' => false,
            'personal_site' => 'www.testerly.com',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
