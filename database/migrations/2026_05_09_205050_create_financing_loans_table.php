<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancingLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financing_loans', function (Blueprint $table) {
            $table->id();
            $table->string('loan_number', 50)->unique();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('customer_policy_id');
            $table->unsignedBigInteger('financing_partner_id');
            $table->decimal('principal_amount', 15, 2);
            $table->decimal('interest_rate', 5, 2);
            $table->decimal('total_interest', 15, 2)->nullable();
            $table->decimal('total_repayment', 15, 2)->nullable();
            $table->integer('term_months');
            $table->decimal('monthly_installment', 15, 2)->nullable();
            $table->string('status', 50)->default('pending');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('disbursed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('defaulted_at')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('customer_policy_id')->references('id')->on('customer_policies')->onDelete('cascade');
            $table->foreign('financing_partner_id', 'fl_partner_fk')->references('id')->on('financing_partners')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financing_loans');
    }
}
