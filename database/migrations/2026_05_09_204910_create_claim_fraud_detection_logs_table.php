<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimFraudDetectionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claim_fraud_detection_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('claim_id');
            $table->string('detection_model')->nullable();
            $table->json('input_data')->nullable();
            $table->json('output_result')->nullable();
            $table->decimal('score', 5, 2)->nullable();
            $table->timestamps();

            $table->foreign('claim_id')->references('id')->on('claims')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('claim_fraud_detection_logs');
    }
}
