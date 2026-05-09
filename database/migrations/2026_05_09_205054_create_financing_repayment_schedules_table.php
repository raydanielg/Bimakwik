<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancingRepaymentSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financing_repayment_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('financing_loan_id');
            $table->integer('installment_number');
            $table->date('due_date');
            $table->decimal('installment_amount', 15, 2);
            $table->decimal('principal_portion', 15, 2)->nullable();
            $table->decimal('interest_portion', 15, 2)->nullable();
            $table->decimal('paid_amount', 15, 2)->default(0);
            $table->timestamp('paid_at')->nullable();
            $table->unsignedBigInteger('payment_transaction_id')->nullable();
            $table->string('status', 50)->default('pending');
            $table->decimal('late_fee_amount', 15, 2)->default(0);
            $table->timestamps();

            $table->foreign('financing_loan_id', 'frs_loan_fk')->references('id')->on('financing_loans')->onDelete('cascade');
            $table->unique(['financing_loan_id', 'installment_number'], 'frs_loan_inst_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financing_repayment_schedules');
    }
}
