<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrokerCommissionWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('broker_commission_withdrawals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('broker_id');
            $table->decimal('amount', 15, 2);
            $table->string('withdrawal_method', 50);
            $table->string('destination');
            $table->string('status', 50)->default('pending');
            $table->unsignedBigInteger('processed_by')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->string('reference_number', 100)->nullable();
            $table->timestamps();

            $table->foreign('broker_id', 'bcw_broker_fk')->references('id')->on('brokers')->onDelete('cascade');
            $table->foreign('processed_by', 'bcw_admin_fk')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('broker_commission_withdrawals');
    }
}
