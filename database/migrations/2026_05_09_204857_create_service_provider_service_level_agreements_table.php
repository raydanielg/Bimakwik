<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProviderServiceLevelAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_provider_service_level_agreements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_provider_id');
            $table->unsignedBigInteger('insurer_id');
            $table->string('sla_number', 100)->unique();
            $table->integer('response_time_hours');
            $table->integer('settlement_time_days');
            $table->json('quality_standards')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('document_url', 500)->nullable();
            $table->string('status', 50)->default('active');
            $table->timestamps();

            $table->foreign('service_provider_id', 'sla_provider_fk')->references('id')->on('service_providers')->onDelete('cascade');
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
        Schema::dropIfExists('service_provider_service_level_agreements');
    }
}
