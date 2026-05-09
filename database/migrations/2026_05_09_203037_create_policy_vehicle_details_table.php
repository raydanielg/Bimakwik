<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolicyVehicleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policy_vehicle_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_policy_id');
            $table->string('registration_number', 20);
            $table->string('make', 100);
            $table->string('model', 100);
            $table->integer('year_of_manufacture');
            $table->string('engine_number', 100)->nullable();
            $table->string('chassis_number', 100);
            $table->decimal('vehicle_value', 15, 2);
            $table->boolean('is_commercial')->default(false);
            $table->timestamps();

            $table->foreign('customer_policy_id')->references('id')->on('customer_policies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('policy_vehicle_details');
    }
}
