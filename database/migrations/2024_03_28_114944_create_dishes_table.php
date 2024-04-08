<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            //pfp
            $table->integer('price')->nullable(false);
            $table->integer('proteins')->nullable(false);
            $table->integer('fats')->nullable(false);
            $table->integer('carbohydrates')->nullable(false);
            $table->integer('callories')->nullable(false);
            $table->foreignId('meal_type_id')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dishes');
    }
}
