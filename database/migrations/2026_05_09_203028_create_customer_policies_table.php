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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('insurance_product_id');
            $table->unsignedBigInteger('insurer_id')->nullable();
            $table->enum('status', ['active', 'expired', 'cancelled', 'suspended', 'pending'])->default('pending');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('premium_amount', 15, 2);
            $table->enum('premium_frequency', ['one_time', 'monthly', 'quarterly', 'annual'])->default('annual');
            $table->decimal('sum_assured', 15, 2);
            $table->decimal('deductible_amount', 15, 2)->nullable();
            $table->json('policy_details')->nullable();
            $table->json('nominees')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_reference')->nullable();
            $table->timestamp('purchased_at')->nullable();
            $table->timestamp('last_renewed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('insurance_product_id')->references('id')->on('insurance_products')->onDelete('cascade');
            $table->foreign('insurer_id')->references('id')->on('users')->onDelete('set null');
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
