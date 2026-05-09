<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeveloperWebhookDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developer_webhook_deliveries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('developer_webhook_id');
            $table->string('event_type');
            $table->json('payload');
            $table->integer('response_status')->nullable();
            $table->text('response_body')->nullable();
            $table->integer('attempt_number')->default(1);
            $table->boolean('success')->default(false);
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();

            $table->foreign('developer_webhook_id', 'dwd_webhook_fk')->references('id')->on('developer_webhooks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('developer_webhook_deliveries');
    }
}
