<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimFraudAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claim_fraud_alerts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('claim_id');
            $table->string('alert_type');
            $table->string('severity', 20)->default('medium');
            $table->text('description')->nullable();
            $table->decimal('ai_confidence', 5, 2)->nullable();
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->boolean('is_confirmed')->default(false);
            $table->timestamps();

            $table->foreign('claim_id')->references('id')->on('claims')->onDelete('cascade');
            $table->foreign('reviewed_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('claim_fraud_alerts');
    }
}
