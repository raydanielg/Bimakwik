<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrokerProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('broker_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('broker_id')->unique();
            $table->integer('years_in_business')->nullable();
            $table->integer('employee_count')->nullable();
            $table->integer('branch_count')->nullable();
            $table->json('regions_covered')->nullable();
            $table->json('insurance_types')->nullable();
            $table->timestamps();

            $table->foreign('broker_id')->references('id')->on('brokers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('broker_profiles');
    }
}
