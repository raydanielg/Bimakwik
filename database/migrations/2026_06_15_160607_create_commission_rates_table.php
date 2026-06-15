<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('insurer_id')->nullable()->index();
            $table->unsignedBigInteger('insurance_product_id')->nullable()->index();
            $table->unsignedBigInteger('policy_category_id')->nullable()->index();
            $table->string('channel_type', 50); // agent, broker, bancassurance, sfe, direct, partner
            $table->enum('rate_type', ['percentage', 'fixed'])->default('percentage');
            $table->decimal('rate_value', 8, 4);
            $table->decimal('min_premium_amount', 15, 2)->nullable();
            $table->decimal('max_premium_amount', 15, 2)->nullable();
            $table->date('effective_from')->nullable();
            $table->date('effective_to')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();

            $table->foreign('insurer_id')->references('id')->on('insurers')->onDelete('cascade');
            $table->foreign('insurance_product_id')->references('id')->on('insurance_products')->onDelete('cascade');
            $table->foreign('policy_category_id')->references('id')->on('policy_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commission_rates');
    }
}
