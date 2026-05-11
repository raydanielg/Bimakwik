<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAggregatorReferralSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aggregator_referral_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aggregator_id');
            $table->unsignedBigInteger('aggregator_referral_link_id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('customer_policy_id')->nullable();
            $table->decimal('sale_amount', 15, 2);
            $table->decimal('commission_amount', 15, 2);
            $table->string('status', 50)->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->foreign('aggregator_id')->references('id')->on('aggregators')->onDelete('cascade');
            $table->foreign('aggregator_referral_link_id', 'arl_sale_fk')->references('id')->on('aggregator_referral_links')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            $table->foreign('customer_policy_id')->references('id')->on('customer_policies')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aggregator_referral_sales');
    }
}
