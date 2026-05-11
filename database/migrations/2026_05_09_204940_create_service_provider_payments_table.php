<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProviderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_provider_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_provider_id');
            $table->unsignedBigInteger('claim_id');
            $table->decimal('amount', 15, 2);
            $table->date('payment_date');
            $table->string('payment_reference', 100)->nullable();
            $table->string('status', 50)->default('pending');
            $table->unsignedBigInteger('processed_by')->nullable();
            $table->timestamps();

            $table->foreign('service_provider_id', 'pay_sp_fk')->references('id')->on('service_providers')->onDelete('cascade');
            $table->foreign('claim_id', 'pay_claim_fk')->references('id')->on('claims')->onDelete('cascade');
            $table->foreign('processed_by', 'pay_admin_fk')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_provider_payments');
    }
}
