<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAiChatbotMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ai_chatbot_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ai_chatbot_conversation_id');
            $table->string('sender', 20);
            $table->text('message');
            $table->string('intent_detected', 100)->nullable();
            $table->decimal('confidence_score', 5, 4)->nullable();
            $table->unsignedBigInteger('faq_article_id')->nullable();
            $table->timestamps();

            $table->foreign('ai_chatbot_conversation_id', 'acm_conv_fk')->references('id')->on('ai_chatbot_conversations')->onDelete('cascade');
            $table->foreign('faq_article_id')->references('id')->on('faq_articles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ai_chatbot_messages');
    }
}
