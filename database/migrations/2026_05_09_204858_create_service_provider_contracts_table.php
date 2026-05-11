<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProviderContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_provider_contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_provider_id');
            $table->string('contract_number', 100)->unique();
            $table->string('contract_type', 50)->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('document_url', 500)->nullable();
            $table->json('terms')->nullable();
            $table->timestamp('signed_at')->nullable();
            $table->timestamps();

            $table->foreign('service_provider_id', 'contract_sp_fk')->references('id')->on('service_providers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_provider_contracts');
    }
}
