<?php

use Illuminate\Database\Seeder;
use App\User;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Department::class, 1)->create([
                                'name' => '总仓库',
                                'type' => 'warehouse',
                                'user_id' => User::where("role", "keeper")->first()->id,
                                ]);


        $ids = User::whereNotIn("role", ['admin', 'keeper'])->get(['id']);

        factory(App\Department::class, 15)->create(['user_id' => $ids->random()->id]);

    }
}
