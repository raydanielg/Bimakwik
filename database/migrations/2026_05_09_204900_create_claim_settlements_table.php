<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claim_settlements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('claim_id')->unique();
            $table->decimal('settlement_amount', 15, 2);
            $table->date('settlement_date');
            $table->string('payment_transaction_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('approval_number')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('claim_id')->references('id')->on('claims')->onDelete('cascade');
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
        Schema::dropIfExists('claim_settlements');
    }
}
