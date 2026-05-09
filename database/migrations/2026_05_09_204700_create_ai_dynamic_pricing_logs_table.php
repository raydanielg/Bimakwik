<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAiDynamicPricingLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ai_dynamic_pricing_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('insurance_product_id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->decimal('old_price', 15, 2)->nullable();
            $table->decimal('new_price', 15, 2)->nullable();
            $table->json('pricing_factors')->nullable();
            $table->string('model_version', 50)->nullable();
            $table->timestamp('applied_at')->useCurrent();
            $table->timestamps();

            $table->foreign('insurance_product_id', 'ai_price_product_fk')->references('id')->on('insurance_products')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ai_dynamic_pricing_logs');
    }
}
