<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number', 50)->unique();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_email', 255);
            $table->string('customer_phone', 20)->nullable();
            $table->string('category', 50);
            $table->string('priority', 20)->default('medium');
            $table->string('subject', 255);
            $table->text('description');
            $table->string('status', 50)->default('open');
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->timestamp('sla_response_deadline')->nullable();
            $table->timestamp('sla_resolution_deadline')->nullable();
            $table->boolean('sla_breached')->default(false);
            $table->integer('rating')->nullable();
            $table->text('rating_comment')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            $table->foreign('assigned_to')->references('id')->on('admins')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('support_tickets');
    }
}
