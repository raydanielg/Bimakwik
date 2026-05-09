<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAggregatorReferralLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aggregator_referral_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aggregator_id');
            $table->unsignedBigInteger('insurance_product_id')->nullable();
            $table->string('link_token')->unique();
            $table->string('link_url', 500);
            $table->integer('click_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('aggregator_id')->references('id')->on('aggregators')->onDelete('cascade');
            $table->foreign('insurance_product_id')->references('id')->on('insurance_products')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aggregator_referral_links');
    }
}
