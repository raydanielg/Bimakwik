<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurerBankDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurer_bank_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('insurer_id');
            $table->string('bank_name');
            $table->string('account_name');
            $table->string('account_number');
            $table->string('branch_name')->nullable();
            $table->string('swift_code')->nullable();
            $table->boolean('is_default')->default(false);
            $table->timestamps();

            $table->foreign('insurer_id')->references('id')->on('insurers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insurer_bank_details');
    }
}
