<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 1)->create(['name' => 'admin', 'role' => 'admin']);
        factory(App\User::class, 1)->create(['name' => 'keeper', 'role' => 'keeper']);
        factory(App\User::class, 1)->create(['name' => 'operator', 'role' => 'operator']);
    }
}
