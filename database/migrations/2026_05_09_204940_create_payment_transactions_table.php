<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number')->unique();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('customer_policy_id')->nullable();
            $table->unsignedBigInteger('payment_gateway_id')->nullable();
            $table->decimal('amount', 15, 2);
            $table->string('currency', 3)->default('TZS');
            $table->string('payment_method', 50);
            $table->string('status', 50)->default('pending');
            $table->string('gateway_reference')->nullable();
            $table->json('gateway_response')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            $table->foreign('customer_policy_id')->references('id')->on('customer_policies')->onDelete('set null');
            $table->foreign('payment_gateway_id')->references('id')->on('payment_gateways')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_transactions');
    }
}
