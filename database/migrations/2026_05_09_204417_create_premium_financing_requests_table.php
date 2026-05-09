<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePremiumFinancingRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('premium_financing_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('customer_policy_id');
            $table->decimal('premium_amount', 15, 2);
            $table->decimal('financing_amount', 15, 2);
            $table->decimal('interest_rate', 5, 2)->nullable();
            $table->integer('repayment_months')->nullable();
            $table->decimal('monthly_installment', 15, 2)->nullable();
            $table->string('status', 50)->default('pending');
            $table->unsignedBigInteger('premium_financing_partner_id')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('customer_policy_id')->references('id')->on('customer_policies')->onDelete('cascade');
            $table->foreign('premium_financing_partner_id', 'pfr_partner_fk')->references('id')->on('premium_financing_partners')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('premium_financing_requests');
    }
}
