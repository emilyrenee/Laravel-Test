<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            'name' => 'Task1',
            'description' => 'Some text.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('tasks')->insert([
            'name' => 'Task2',
            'description' => 'Some text.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('tasks')->insert([
            'name' => 'Task3',
            'description' => 'Some text.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('tasks')->insert([
            'name' => 'Task4',
            'description' => 'Some text.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('tasks')->insert([
            'name' => 'Task5',
            'description' => 'Some text.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('tasks')->insert([
            'name' => 'Task6',
            'description' => 'Some text.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('tasks')->insert([
            'name' => 'Task7',
            'description' => 'Some text.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('tasks')->insert([
            'name' => 'Task8',
            'description' => 'Some text.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('tasks')->insert([
            'name' => 'Task9',
            'description' => 'Some text.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('tasks')->insert([
            'name' => 'Task10',
            'description' => 'Some text.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('tasks')->insert([
            'name' => 'Task11',
            'description' => 'Some text.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('tasks')->insert([
            'name' => 'Task12',
            'description' => 'Some text.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
