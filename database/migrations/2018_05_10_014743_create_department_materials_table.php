<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_materials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('department_id')->comment('车间id');
            $table->integer('material_id')->comment('物料id');
            $table->integer('quantity')->comment('数量')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('department_materials');
    }
}
