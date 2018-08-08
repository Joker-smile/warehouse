<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(DepartmentsSeeder::class);
        $this->call(MaterialsSeeder::class);
        $this->call(DepartmentMaterialSeeder::class);
        $this->command->info('warehouse seeded.');

    }
}
