<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiUsageStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_usage_statistics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('developer_api_key_id')->nullable();
            $table->unsignedBigInteger('api_endpoint_id')->nullable();
            $table->integer('request_count')->default(0);
            $table->bigInteger('total_response_time_ms')->default(0);
            $table->integer('error_count')->default(0);
            $table->date('date');
            $table->integer('hour')->nullable();
            $table->timestamps();

            $table->foreign('developer_api_key_id')->references('id')->on('developer_api_keys')->onDelete('set null');
            $table->foreign('api_endpoint_id')->references('id')->on('api_endpoints')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_usage_statistics');
    }
}
