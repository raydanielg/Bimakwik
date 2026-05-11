<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProviderBankDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_provider_bank_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_provider_id');
            $table->string('bank_name');
            $table->string('account_name');
            $table->string('account_number', 100);
            $table->string('branch_name')->nullable();
            $table->string('swift_code', 50)->nullable();
            $table->string('mobile_money_number', 20)->nullable();
            $table->boolean('is_default')->default(false);
            $table->timestamps();

            $table->foreign('service_provider_id', 'sp_bank_fk')->references('id')->on('service_providers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_provider_bank_details');
    }
}
