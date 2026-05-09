<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProviderProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_provider_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_provider_id')->unique();
            $table->integer('years_in_business')->nullable();
            $table->integer('employee_count')->nullable();
            $table->integer('branch_count')->nullable();
            $table->json('operating_hours')->nullable();
            $table->json('services_offered')->nullable();
            $table->json('certifications')->nullable();
            $table->timestamps();

            $table->foreign('service_provider_id')->references('id')->on('service_providers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_provider_profiles');
    }
}
