<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAggregatorCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aggregator_commissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aggregator_id');
            $table->unsignedBigInteger('aggregator_referral_sale_id');
            $table->decimal('amount', 15, 2);
            $table->string('status', 50)->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->string('payment_transaction_id')->nullable();
            $table->timestamps();

            $table->foreign('aggregator_id')->references('id')->on('aggregators')->onDelete('cascade');
            $table->foreign('aggregator_referral_sale_id', 'arc_sale_fk')->references('id')->on('aggregator_referral_sales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aggregator_commissions');
    }
}
