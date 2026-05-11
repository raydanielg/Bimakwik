<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePremiumFinancingRepaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('premium_financing_repayments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('premium_financing_request_id');
            $table->integer('installment_number');
            $table->date('due_date');
            $table->decimal('amount', 15, 2);
            $table->decimal('paid_amount', 15, 2)->default(0);
            $table->timestamp('paid_at')->nullable();
            $table->string('status', 50)->default('pending');
            $table->unsignedBigInteger('payment_transaction_id')->nullable();
            $table->timestamps();

            $table->foreign('premium_financing_request_id', 'pfrp_request_fk')->references('id')->on('premium_financing_requests')->onDelete('cascade');
            $table->foreign('payment_transaction_id', 'pfrp_pay_fk')->references('id')->on('payment_transactions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('premium_financing_repayments');
    }
}
