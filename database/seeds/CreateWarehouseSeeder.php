<?php

use Illuminate\Database\Seeder;

class CreateWarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Department::class, 1)->create([
            'name'    => '总仓库',
            'type'    => 'warehouse',
            'user_id' => App\User::where("role", "keeper")->first()->id,
        ]);
    }
}
