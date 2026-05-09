<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePredictiveAnalyticsReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('predictive_analytics_reports', function (Blueprint $table) {
            $table->id();
            $table->string('report_type', 50);
            $table->date('report_period_start')->nullable();
            $table->date('report_period_end')->nullable();
            $table->json('forecast_data')->nullable();
            $table->json('accuracy_metrics')->nullable();
            $table->unsignedBigInteger('generated_by')->nullable();
            $table->timestamp('generated_at')->useCurrent();
            $table->timestamps();

            $table->foreign('generated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('predictive_analytics_reports');
    }
}
