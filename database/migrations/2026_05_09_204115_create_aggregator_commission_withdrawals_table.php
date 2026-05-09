<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAggregatorCommissionWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aggregator_commission_withdrawals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aggregator_id');
            $table->decimal('amount', 15, 2);
            $table->string('withdrawal_method', 50);
            $table->string('destination');
            $table->string('status', 50)->default('pending');
            $table->unsignedBigInteger('processed_by')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->string('reference_number', 100)->nullable();
            $table->timestamps();

            $table->foreign('aggregator_id', 'acw_aggregator_fk')->references('id')->on('aggregators')->onDelete('cascade');
            $table->foreign('processed_by', 'acw_admin_fk')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aggregator_commission_withdrawals');
    }
}
