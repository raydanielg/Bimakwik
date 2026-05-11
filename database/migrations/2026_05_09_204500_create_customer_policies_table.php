<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerPoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_policies', function (Blueprint $table) {
            $table->id();
            $table->string('policy_number')->unique();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('insurance_product_id');
            $table->unsignedBigInteger('insurer_id');
            $table->unsignedBigInteger('broker_id')->nullable();
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->string('status', 50)->default('active');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('premium_amount', 15, 2);
            $table->string('premium_frequency', 50)->default('annual');
            $table->decimal('sum_assured', 15, 2);
            $table->decimal('deductible_amount', 15, 2)->nullable();
            $table->json('policy_details');
            $table->json('nominees')->nullable();
            $table->string('payment_method', 50);
            $table->string('payment_reference', 100)->nullable();
            $table->timestamp('purchased_at')->useCurrent();
            $table->timestamp('last_renewed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('insurance_product_id')->references('id')->on('insurance_products')->onDelete('cascade');
            $table->foreign('insurer_id')->references('id')->on('insurers')->onDelete('cascade');
            $table->foreign('broker_id')->references('id')->on('brokers')->onDelete('set null');
            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_policies');
    }
}
