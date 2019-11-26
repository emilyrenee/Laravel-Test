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
            'name' => 'Rando Rando1',
            'email' => str_random(10).'@gmail.com',
            'is_local' => false,
            'personal_site' => 'www.testerly1.com',
            'avatar' => 'noimage.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('developers')->insert([
            'name' => 'Rando Rando2',
            'email' => str_random(10).'@gmail.com',
            'is_local' => false,
            'personal_site' => 'www.testerly2.com',
            'avatar' => 'noimage.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('developers')->insert([
            'name' => 'Rando Rando3',
            'email' => str_random(10).'@gmail.com',
            'is_local' => false,
            'personal_site' => 'www.testerly3.com',
            'avatar' => 'noimage.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('developers')->insert([
            'name' => 'Rando Rando4',
            'email' => str_random(10).'@gmail.com',
            'is_local' => false,
            'personal_site' => 'www.testerly4.com',
            'avatar' => 'noimage.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('developers')->insert([
            'name' => 'Rando Rando5',
            'email' => str_random(10).'@gmail.com',
            'is_local' => false,
            'personal_site' => 'www.testerly5.com',
            'avatar' => 'noimage.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
