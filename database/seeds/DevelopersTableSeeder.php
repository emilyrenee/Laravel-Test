<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

// TODO: add avatar
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
            'name' => 'Tester1 Tester',
            'email' => str_random(10).'@gmail.com',
            'is_local' => false,
            'personal_site' => 'www.testerly1.com',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('developers')->insert([
            'name' => 'Tester2 Tester',
            'email' => str_random(10).'@gmail.com',
            'is_local' => false,
            'personal_site' => 'www.testerly2.com',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('developers')->insert([
            'name' => 'Tester3 Tester',
            'email' => str_random(10).'@gmail.com',
            'is_local' => false,
            'personal_site' => 'www.testerly3.com',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('teams')->insert([
            'name' => 'Javascript',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('teams')->insert([
            'name' => 'PHP',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('teams')->insert([
            'name' => 'Data Science',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('teams')->insert([
            'name' => 'BI',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('teams')->insert([
            'name' => 'Data Mining',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
