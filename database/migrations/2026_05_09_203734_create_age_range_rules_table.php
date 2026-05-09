<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgeRangeRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('age_range_rules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('insurance_product_id');
            $table->integer('min_age');
            $table->integer('max_age');
            $table->decimal('premium_multiplier', 5, 2)->default(1.00);
            $table->timestamps();

            $table->foreign('insurance_product_id')->references('id')->on('insurance_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('age_range_rules');
    }
}
