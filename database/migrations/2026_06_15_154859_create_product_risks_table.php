<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRisksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_risks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('insurance_product_id')->nullable()->index();
            $table->string('risk_code', 50)->unique();
            $table->string('risk_name');
            $table->string('product_code', 50)->nullable()->index();
            $table->string('class_of_insurance', 100)->nullable();
            $table->decimal('minimum_rate', 10, 4)->nullable();
            $table->decimal('minimum_amount', 15, 2)->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('product_risks');
    }
}
