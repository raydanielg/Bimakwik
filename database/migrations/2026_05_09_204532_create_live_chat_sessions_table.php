<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiveChatSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_chat_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('customer_name', 100);
            $table->string('customer_email', 255)->nullable();
            $table->unsignedBigInteger('assigned_agent_id')->nullable();
            $table->string('status', 50)->default('waiting');
            $table->integer('waiting_time_seconds')->nullable();
            $table->integer('chat_duration_seconds')->nullable();
            $table->unsignedBigInteger('transferred_to')->nullable();
            $table->string('transferred_reason')->nullable();
            $table->integer('customer_rating')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            $table->foreign('assigned_agent_id')->references('id')->on('admins')->onDelete('set null');
            $table->foreign('transferred_to')->references('id')->on('admins')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('live_chat_sessions');
    }
}
