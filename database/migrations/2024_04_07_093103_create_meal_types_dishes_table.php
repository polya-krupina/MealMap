<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealTypesDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('meal_types_dishes', function (Blueprint $table) {
        //     $table->foreignId('dish_id')->constrained()->cascadeOnDelete();
        //     $table->foreignId('meal_type_id')->constrained()->cascadeOnDelete();
        //     $table->primary(['dish_id','meal_type_id']);
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meal_types_dishes');
    }
}
