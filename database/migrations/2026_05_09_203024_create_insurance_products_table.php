<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsuranceProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('policy_category_id');
            $table->unsignedBigInteger('insurer_id')->nullable();
            $table->string('product_code')->unique();
            $table->string('product_name');
            $table->string('product_name_sw')->nullable();
            $table->text('description');
            $table->json('benefits')->nullable();
            $table->json('exclusions')->nullable();
            $table->integer('min_age')->nullable();
            $table->integer('max_age')->nullable();
            $table->decimal('base_premium', 15, 2);
            $table->json('premium_calculation_logic')->nullable();
            $table->string('currency', 3)->default('TZS');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('policy_category_id')->references('id')->on('policy_categories')->onDelete('cascade');
            $table->foreign('insurer_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insurance_products');
    }
}
