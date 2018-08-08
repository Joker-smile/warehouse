<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id")->comment("操作者");
            $table->integer('department_id')->unsigned()->comment('部门id');
            $table->integer('material_id')->unsigned()->comment('物料id');
            $table->string('type')->comment('类型');
            $table->integer('before')->default(0)->comment('更改之前的库存');
            $table->integer('after')->default(0)->comment(' 更改之后的库存');
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
        Schema::dropIfExists('records');
    }
}
