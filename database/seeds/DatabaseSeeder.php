<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DevelopersTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(UserRolesTableSeeder::class);
        $this->call(ProjectStatusesTableSeeder::class);
    }
}
