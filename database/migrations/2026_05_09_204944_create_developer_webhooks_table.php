<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeveloperWebhooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developer_webhooks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('developer_app_id');
            $table->string('webhook_url', 500);
            $table->json('events');
            $table->string('secret')->nullable();
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
        Schema::dropIfExists('developer_webhooks');
    }
}
