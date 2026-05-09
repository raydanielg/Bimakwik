<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiEndpointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_endpoints', function (Blueprint $table) {
            $table->id();
            $table->string('endpoint_path');
            $table->string('endpoint_method', 10);
            $table->text('description')->nullable();
            $table->string('version', 20)->nullable();
            $table->boolean('is_public')->default(false);
            $table->json('required_permissions')->nullable();
            $table->integer('rate_limit_default')->default(60);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['endpoint_path', 'endpoint_method']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_endpoints');
    }
}
