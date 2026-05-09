<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiRateLimitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_rate_limits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('developer_api_key_id')->nullable();
            $table->unsignedBigInteger('api_endpoint_id')->nullable();
            $table->integer('limit_per_minute');
            $table->integer('current_count')->default(0);
            $table->timestamp('reset_at');
            $table->timestamps();

            $table->foreign('developer_api_key_id')->references('id')->on('developer_api_keys')->onDelete('cascade');
            $table->foreign('api_endpoint_id')->references('id')->on('api_endpoints')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_rate_limits');
    }
}
