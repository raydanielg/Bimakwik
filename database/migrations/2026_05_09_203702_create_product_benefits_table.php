<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBenefitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_benefits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('insurance_product_id');
            $table->string('benefit_name');
            $table->string('benefit_name_sw')->nullable();
            $table->decimal('benefit_limit', 15, 2)->nullable();
            $table->string('benefit_unit')->nullable();
            $table->text('description')->nullable();
            $table->integer('display_order')->default(0);
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
        Schema::dropIfExists('product_benefits');
    }
}
