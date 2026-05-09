<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeveloperApiKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developer_api_keys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('developer_app_id');
            $table->string('api_key')->unique();
            $table->string('api_secret_hash');
            $table->string('key_name')->nullable();
            $table->json('permissions')->nullable();
            $table->json('allowed_ips')->nullable();
            $table->integer('rate_limit_per_minute')->default(60);
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('developer_app_id')->references('id')->on('developer_apps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('developer_api_keys');
    }
}
