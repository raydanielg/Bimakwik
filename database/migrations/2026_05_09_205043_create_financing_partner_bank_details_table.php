<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancingPartnerBankDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financing_partner_bank_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('financing_partner_id');
            $table->string('bank_name');
            $table->string('account_name');
            $table->string('account_number', 100);
            $table->string('branch_name')->nullable();
            $table->string('swift_code', 50)->nullable();
            $table->boolean('is_default')->default(false);
            $table->timestamps();

            $table->foreign('financing_partner_id', 'fpbd_partner_fk')->references('id')->on('financing_partners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financing_partner_bank_details');
    }
}
