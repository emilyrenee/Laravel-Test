<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProjectStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_statuses')->insert([
            'name' => 'Not Started',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('project_statuses')->insert([
            'name' => 'In Progress',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('project_statuses')->insert([
            'name' => 'Complete',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
