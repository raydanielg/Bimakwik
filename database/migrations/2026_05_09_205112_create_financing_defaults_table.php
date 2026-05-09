<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancingDefaultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financing_defaults', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('financing_loan_id');
            $table->date('default_date');
            $table->string('default_reason')->nullable();
            $table->decimal('outstanding_amount', 15, 2);
            $table->integer('overdue_days');
            $table->integer('collection_attempts')->default(0);
            $table->boolean('written_off')->default(false);
            $table->timestamp('written_off_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('financing_loan_id', 'fdef_loan_fk')->references('id')->on('financing_loans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financing_defaults');
    }
}
