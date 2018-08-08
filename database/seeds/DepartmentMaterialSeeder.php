<?php

use Illuminate\Database\Seeder;
use App\Department;
use App\Material;

class DepartmentMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = App\Department::all(['id']);
        $materials = App\Material::all();
        $total_materials = $materials->count();
        foreach ($departments as $department) {
            $randoms = $materials->random(mt_rand(1, $total_materials));
            foreach ($randoms as $random) {
                $department->materials()->save($random, ['quantity' => mt_rand(1, 1000)]);
            }
        }

    }
}
