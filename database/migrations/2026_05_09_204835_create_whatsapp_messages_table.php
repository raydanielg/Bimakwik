<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhatsappMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whatsapp_messages', function (Blueprint $table) {
            $table->id();
            $table->string('recipient_phone', 20);
            $table->string('message_type', 50);
            $table->text('message_body')->nullable();
            $table->string('media_url', 500)->nullable();
            $table->string('template_name', 100)->nullable();
            $table->json('template_components')->nullable();
            $table->string('status', 50)->default('pending');
            $table->string('whatsapp_message_id')->nullable();
            $table->text('provider_response')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('whatsapp_messages');
    }
}
