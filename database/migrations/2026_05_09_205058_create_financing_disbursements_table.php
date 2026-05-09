<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancingDisbursementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financing_disbursements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('financing_loan_id');
            $table->unsignedBigInteger('financing_partner_id');
            $table->decimal('disbursement_amount', 15, 2);
            $table->string('disbursement_reference', 100)->nullable();
            $table->unsignedBigInteger('payment_transaction_id')->nullable();
            $table->string('destination_type', 50)->nullable();
            $table->json('destination_details')->nullable();
            $table->unsignedBigInteger('disbursed_by')->nullable();
            $table->timestamp('disbursed_at')->nullable();
            $table->string('status', 50)->default('pending');
            $table->timestamps();

            $table->foreign('financing_loan_id', 'fd_loan_fk')->references('id')->on('financing_loans')->onDelete('cascade');
            $table->foreign('financing_partner_id', 'fd_partner_fk')->references('id')->on('financing_partners')->onDelete('cascade');
            $table->foreign('disbursed_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financing_disbursements');
    }
}
